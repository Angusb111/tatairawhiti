<?php
print_r($_FILES);

header('Content-Type: application/json');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database credentials
$servername = "localhost";
$username = "user";
$password = "iott3";
$dbname = "poi_database";           

// Define allowed file types and size limit
$allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
$maxFileSize = 8 * 1024 * 1024; // 8MB

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decode the JSON-encoded place data from the FormData (which was added as 'placeData')
    $placeData = json_decode($_POST['placeData'], true);

    // Ensure placeData is properly decoded
    if (!$placeData) {
        $response['message'] = 'Error: Invalid place data.';
        echo json_encode($response);
        exit;
    }

    // Extract values from placeData array
    $placeName = filter_var($placeData['placeName'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $placeDescription = filter_var($placeData['placeDescription'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $placeCategory = $placeData['placeCategory'];  // From the sub-array (placeData)
    $latitude = $placeData['latitude'];            // From the sub-array (placeData)
    $longitude = $placeData['longitude'];          // From the sub-array (placeData)

    if (isset($_FILES['placeImage']) && $_FILES['placeImage']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['placeImage']['tmp_name'];
        $fileName = $_FILES['placeImage']['name'];
        $fileSize = $_FILES['placeImage']['size'];
        $fileType = $_FILES['placeImage']['type'];

        // Check file size
        if ($fileSize > $maxFileSize) {
            $response['message'] = 'Error: File size exceeds the maximum limit of 8MB.';
            echo json_encode($response);
            exit;
        }

        // Check file type
        if (!in_array($fileType, $allowedTypes)) {
            $response['message'] = 'Error: Only JPEG, PNG, and GIF files are allowed.';
            echo json_encode($response);
            exit;
        }

        // Define the upload directory
        $uploadFileDir = '../media/uploaded_images/';
        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0755, true);
        }

        // Sanitize file name
        $newFileName = md5(time() . $fileName) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
        $destPath = $uploadFileDir . $newFileName;

        // Move the file to the destination directory
        if (move_uploaded_file($fileTmpPath, $destPath)) {
            // File upload successful, now insert into database
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                $response['message'] = "Connection failed: " . $conn->connect_error;
                echo json_encode($response);
                exit;
            }

            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO poi (category, name, latitude, longitude, description, image) VALUES (?, ?, ?, ?, ?, ?)");
            if (!$stmt) {
                $response['message'] = "Prepare failed: (" . $conn->errno . ") " . $conn->error;
                echo json_encode($response);
                exit;
            }

            $stmt->bind_param("dsddss", $placeCategory, $placeName, $latitude, $longitude, $placeDescription, $destPath);

            // Execute the prepared statement
            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = "New record created successfully";
            } else {
                $response['message'] = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            // Close the statement and connection
            $stmt->close();
            $conn->close();
        } else {
            $response['message'] = 'Error: There was an error moving the uploaded file.';
        }
    } else {
        $response['message'] = 'Error: No file uploaded or there was an upload error.';
    }
} else {
    $response['message'] = 'Error: Invalid request method.';
}

echo json_encode($response);

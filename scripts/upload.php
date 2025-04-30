<?php
header('Content-Type: application/json');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database credentials
$servername = "localhost";
$username = "user";
$password = "iott3";
$dbname = "poi_database";

$response = ['success' => false, 'message' => '', 'postData' => $_POST, 'filesData' => $_FILES];

// Debugging: Log all received data
file_put_contents('debug.log', print_r($_POST, true) . "\n\n" . print_r($_FILES, true), FILE_APPEND);

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response['message'] = "Invalid request method.";
    echo json_encode($response);
    exit;
}

// Collect form data
$category = isset($_POST['category']) ? intval($_POST['category']) : null;
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$latitude = isset($_POST['latitude']) ? floatval($_POST['latitude']) : null;
$longitude = isset($_POST['longitude']) ? floatval($_POST['longitude']) : null;
$description = isset($_POST['description']) ? trim($_POST['description']) : '';

// Validate required fields
if (empty($name) || empty($latitude) || empty($longitude) || empty($description) || is_null($category)) {
    $response['message'] = "All required fields must be filled.";
    echo json_encode($response);
    exit;
}

// Handle file upload
$imagePath = 'placeholder.jpg'; // Default value
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    // Validate file type and size
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $maxSize = 5 * 1024 * 1024; // 5MB
    $file = $_FILES['image'];

    if (!in_array($file['type'], $allowedTypes)) {
        $response['message'] = "Invalid file type. Only JPEG, PNG, and GIF are allowed.";
        echo json_encode($response);
        exit;
    }

    if ($file['size'] > $maxSize) {
        $response['message'] = "File size exceeds the limit of 5MB.";
        echo json_encode($response);
        exit;
    }

    // Define upload directory
    $uploadDir = __DIR__ . '/../media/uploaded_images/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Create directory if it doesn't exist
    }

    // Generate unique file name
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newFileName = uniqid('img_', true) . '.' . $extension;
    $destPath = $uploadDir . $newFileName;

    // Move uploaded file to destination
    if (!move_uploaded_file($file['tmp_name'], $destPath)) {
        $response['message'] = "Failed to move uploaded file.";
        echo json_encode($response);
        exit;
    }

    // Prepare relative path for database
    $imagePath = '../media/uploaded_images/' . $newFileName;
}

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    $response['message'] = "Connection failed: " . $conn->connect_error;
    echo json_encode($response);
    exit;
}

// Insert data into the database
$stmt = $conn->prepare("INSERT INTO submissions (category, name, lat, lng, description, image_url) VALUES (?, ?, ?, ?, ?, ?)");
if (!$stmt) {
    $response['message'] = "Database preparation failed: " . $conn->error;
    echo json_encode($response);
    $conn->close();
    exit;
}

$stmt->bind_param("isddss", $category, $name, $latitude, $longitude, $description, $imagePath);

if ($stmt->execute()) {
    $response['success'] = true;
    $response['message'] = "Place added successfully.";
} else {
    $response['message'] = "Database insertion failed: " . $stmt->error;
}

// Close resources
$stmt->close();
$conn->close();

// Return response
echo json_encode($response);
?>
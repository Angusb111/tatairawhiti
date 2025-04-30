<?php
// Database connection
$servername = "localhost";
$username = "user";
$password = "iott3";
$dbname = "poi_database";

$input = json_decode(file_get_contents('php://input'), true);
$submission_id = $input['id'];
$action = $input['action']; // 'approve' or 'reject'

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($action === 'approve') {
        // Fetch submission details
        $stmt = $conn->prepare("SELECT * FROM submissions WHERE id = :id");
        $stmt->bindParam(':id', $submission_id, PDO::PARAM_INT);
        $stmt->execute();
        $submission = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($submission) {
            // Insert into poi table
            $insertStmt = $conn->prepare("
                INSERT INTO poi (category, name, latitude, longitude, description, image)
                VALUES (:category, :name, :latitude, :longitude, :description, :image)
            ");
            $insertStmt->bindParam(':category', $submission['category']);
            $insertStmt->bindParam(':name', $submission['name']);
            $insertStmt->bindParam(':latitude', $submission['lat']);
            $insertStmt->bindParam(':longitude', $submission['lng']);
            $insertStmt->bindParam(':description', $submission['description']);
            $insertStmt->bindParam(':image', $submission['image_url']);
            $insertStmt->execute();

            // Delete from submissions table
            $deleteStmt = $conn->prepare("DELETE FROM submissions WHERE id = :id");
            $deleteStmt->bindParam(':id', $submission_id, PDO::PARAM_INT);
            $deleteStmt->execute();
        }
    } elseif ($action === 'reject') {
        // Delete from submissions table
        $stmt = $conn->prepare("DELETE FROM submissions WHERE id = :id");
        $stmt->bindParam(':id', $submission_id, PDO::PARAM_INT);
        $stmt->execute();
    }

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
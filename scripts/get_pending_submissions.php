<?php
// Database connection
$servername = "localhost";
$username = "user";
$password = "iott3";
$dbname = "poi_database";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch pending submissions
    $stmt = $conn->prepare("SELECT * FROM submissions WHERE approved = 0 ORDER BY submitted_at DESC");
    $stmt->execute();
    $submissions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($submissions); // Return as JSON for the frontend
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
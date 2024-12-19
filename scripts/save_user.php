<?php
// Database connection details
$servername = "localhost";
$username = "user";
$password = "iott3";
$dbname = "poi_database";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the user data from the POST request
$userData = json_decode(file_get_contents('php://input'), true);

$email = $conn->real_escape_string($userData['email']);
$name = $conn->real_escape_string($userData['name']);
$avatar = $conn->real_escape_string($userData['avatar']);

// Check if the user already exists
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    // Insert the new user into the database if they don't exist
    $sql = "INSERT INTO users (email, name, avatar) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $email, $name, $avatar);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to insert user']);
    }
} else {
    // User already exists, send success without inserting
    echo json_encode(['success' => true]);
}

$stmt->close();
$conn->close();
?>

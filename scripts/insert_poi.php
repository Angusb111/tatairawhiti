<?php
header('Content-Type: application/json');

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "poi_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die(json_encode(["success" => false, "message" => "Connection failed: " . $conn->connect_error]));
}

// Get data from POST request
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$name = $_POST['name'];
$website = $_POST['website'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO poi (latitude, longitude, name, website) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ddss", $latitude, $longitude, $name, $website);

if ($stmt->execute()) {
  echo json_encode(["success" => true, "message" => "New record created successfully"]);
} else {
  echo json_encode(["success" => false, "message" => "Error: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>

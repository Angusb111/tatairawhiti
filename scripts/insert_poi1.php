<?php
header('Content-Type: application/json');

// Database credentials
$servername = "localhost";
$username = "user";
$password = "iott3";
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
$category = $_POST['category']; // Add category variable

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO poi (latitude, longitude, name, website, category) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ddsds", $latitude, $longitude, $name, $website, $category);


// Execute the prepared statement
if ($stmt->execute()) {
  echo json_encode(["success" => true, "message" => "New record created successfully"]);
} else {
  // If there is an error, capture and return the error message
  echo json_encode(["success" => false, "message" => "Error: " . $stmt->error]);
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>

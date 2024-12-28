<?php
// Database connection details
$servername = "localhost";
$username = "user";
$password = "iott3";
$dbname = "poi_database";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    // Insert feedback into the database
    $sql = "INSERT INTO feedback (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Feedback submitted successfully!"); window.location.href="../index.php";</script>';
    } else {
        echo '<script>alert("Error: ' . $conn->error . '"); window.location.href="../index.php";</script>';
    }
}

// Close the connection
$conn->close();
?>

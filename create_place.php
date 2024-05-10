<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <title>Unhidden Tairāwhiti | Discover & Share Local Gems!</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="css/master1.css">
  <link rel="icon" href="media/icon.svg">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</head>
<style>
  #map { height: 100%; }
</style>
<body class="d-flex flex-direction-row align-items-center">
<div class="create-form pt-5 mt-5">
  <p class="page-heading">Create New Place</p>
  <div class="line-break"></div>
  <div class="d-flex flex-direction-row my-5">
      <p class="form-heading">Place Name</p>
      <input type="text" class="form-control" id="PlaceNameInput" placeholder="">
  </div>
  <div class="d-flex flex-direction-row my-5">
      <p class="form-heading me-4">Latitude</p>
      <input type="text" class="form-control" id="LatitudeInput" placeholder="">
      <p class="form-heading mx-4">Longitude</p>
      <input type="text" class="form-control" id="LongitideInput" placeholder="">
  </div>        
</div>
<?php
// Connect to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "poi_database";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Fetch POI data from the database
$sql = "SELECT * FROM poi";
$result = $conn->query($sql);

// Generate JavaScript code to add markers to the Leaflet map
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $latitude = $row['latitude'];
    $longitude = $row['longitude'];
    $name = $row['name'];
    $website = $row['website'];

    echo "<script>
      var marker = L.marker([$latitude, $longitude]).addTo(map);
      marker.bindPopup('<b>$name</b><br><a href=\"$website\">More Info</a>');
    </script>";
  }
}

$conn->close();
?>

</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

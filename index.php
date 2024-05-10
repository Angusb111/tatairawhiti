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
<body id="home-page">
  <?php include 'mini/header.php'; ?>
  <div id="map"></div>
  <!-- Modal -->
  <div class="modal modal-xl fade" id="createMarkerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-frame d-flex">
      <div class="modal-dialog">
        <div class="modal-content rounded-4 border-0">
          <div class="modal-body">
          <button type="button" class="btn btn-gray" data-bs-dismiss="modal">Close</button>
            <div class="create-form pt-5 mt-5" id="">
              <p class="page-heading">Create New Place</p>
              <div class="line-break"></div>
              <div class="d-flex flex-direction-row my-5">
                  <p class="form-heading">Place Name</p>
                  <input type="text" class="form-control" id="PlaceNameInput" placeholder="">
              </div>
              <div class="marker-form-type-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tree" viewBox="0 0 16 16">
                  <path d="M8.416.223a.5.5 0 0 0-.832 0l-3 4.5A.5.5 0 0 0 5 5.5h.098L3.076 8.735A.5.5 0 0 0 3.5 9.5h.191l-1.638 3.276a.5.5 0 0 0 .447.724H7V16h2v-2.5h4.5a.5.5 0 0 0 .447-.724L12.31 9.5h.191a.5.5 0 0 0 .424-.765L10.902 5.5H11a.5.5 0 0 0 .416-.777zM6.437 4.758A.5.5 0 0 0 6 4.5h-.066L8 1.401 10.066 4.5H10a.5.5 0 0 0-.424.765L11.598 8.5H11.5a.5.5 0 0 0-.447.724L12.69 12.5H3.309l1.638-3.276A.5.5 0 0 0 4.5 8.5h-.098l2.022-3.235a.5.5 0 0 0 .013-.507"/>
                </svg>
              </div>
              <div class="marker-form-type-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-buildings" viewBox="0 0 16 16">
                  <path d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022M6 8.694 1 10.36V15h5zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5z"/>
                  <path d="M2 11h1v1H2zm2 0h1v1H4zm-2 2h1v1H2zm2 0h1v1H4zm4-4h1v1H8zm2 0h1v1h-1zm-2 2h1v1H8zm2 0h1v1h-1zm2-2h1v1h-1zm0 2h1v1h-1zM8 7h1v1H8zm2 0h1v1h-1zm2 0h1v1h-1zM8 5h1v1H8zm2 0h1v1h-1zm2 0h1v1h-1zm0-2h1v1h-1z"/>
                </svg>
              </div>
            </div>
          </div>
          <div class="modal-footer border-0">
            <button type="button" class="btn btn-gray" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-sky">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  
  <script>
  var map = L.map('map', {zoomControl: false}).setView([-38.66398800969844, 178.0225992971014], 13);
  L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
  }).addTo(map);
  var zoomControl = L.control.zoom({
    position: 'bottomleft'
  }).addTo(map);
</script>

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

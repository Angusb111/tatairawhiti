<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Tairāwhiti Uncovered | Discover & Share Local Gems!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="css/master1.css">
    <link rel="icon" href="media/icon.svg">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
              <div class="w-100 d-flex flex-direction-row justify-content-end">
                <button type="button" class="btn-close m-2" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="create-form pt-5 mt-5" id="">
                <p class="page-heading">Create New Place</p>
                <div class="line-break"></div>
                <div class="d-flex flex-direction-row my-5">
                  <p class="form-heading">Place Name</p>
                  <input type="text" class="form-control" id="PlaceNameInput" placeholder="Enter place name">
                </div>
                <div class="d-flex flex-direction-row my-5">
                  <p class="form-heading">Website</p>
                  <input type="text" class="form-control" id="PlaceWebsiteInput" placeholder="Enter website URL">
                </div>
                <input type="hidden" id="PlaceLatitudeInput">
                <input type="hidden" id="PlaceLongitudeInput">
              </div>
            </div>
            <div class="modal-footer border-0">
              <button type="button" class="btn btn-sky" id="savePlaceBtn">Save changes</button>
            </div>
          </div>
        </div>
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

    $poiData = array();
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $poiData[] = $row;
      }
    }

    $conn->close();
    ?>

    <script>
      var map = L.map('map', {zoomControl: false}).setView([-38.66398800969844, 178.0225992971014], 14);
      L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
      }).addTo(map);
      var zoomControl = L.control.zoom({
        position: 'bottomleft'
      }).addTo(map);

      function buttonClick(lat, lng) {
        $('#PlaceLatitudeInput').val(lat);
        $('#PlaceLongitudeInput').val(lng);
        $('#createMarkerModal').modal('show');
      }

      // Add click event listener to the map
      map.on('click', function(e) {
        // Get the coordinates where the user clicked
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;

        // Create a popup with a form
        var popupContent = `
          <div class="d-flex flex-column area-selector-popup" >
            <p class="p-2 m-0 area-selector-coords flex-grow-1">${lat.toFixed(4)}, ${lng.toFixed(4)}</p>
            <button class=" p-2 border-0 border-top w-100 create-marker-btn" onClick="buttonClick(${lat.toFixed(6)}, ${lng.toFixed(6)});">Create Marker</button>
          </div>
        `;

        // Create a new popup
        var popup = L.popup({minWidth: 160})
          .setLatLng(e.latlng)
          .setContent(popupContent)
          .openOn(map);
      });

      // Handle form submission
      $('#savePlaceBtn').on('click', function() {
        var name = $('#PlaceNameInput').val();
        var website = $('#PlaceWebsiteInput').val();
        var lat = $('#PlaceLatitudeInput').val();
        var lng = $('#PlaceLongitudeInput').val();

        var formData = {
          name: name,
          website: website,
          latitude: lat,
          longitude: lng
        };

        $.ajax({
          type: 'POST',
          url: 'scripts/insert_poi.php',
          data: formData,
          dataType: 'json',
          success: function(response) {
            if (response.success) {
              console.log('POI added successfully!');
              // Add the marker to the map
              var marker = L.marker([lat, lng]).addTo(map);
              marker.bindPopup(`<b>${name}</b><br><a href="${website}">More Info</a>`);
              $('#createMarkerModal').modal('hide');
            } else {
              console.log('Error: ' + response.message);
            }
          },
          error: function(xhr, status, error) {
            console.log('AJAX error: ' + status + ' - ' + error);
          }
        });
      });

      // Pass the POI data from PHP to JavaScript
      var poiData = <?php echo json_encode($poiData); ?>;

      // Add markers to the map
      poiData.forEach(function(poi) {
        var marker = L.marker([poi.latitude, poi.longitude]).addTo(map);
        var popupContent = `
          <div class="d-flex flex-column flex-grow-1 marker-card-content" style="width: 18rem;">
            <img src="media/${poi.image}" class="card-img-top" alt="...">
            <div class="card-body p-3">
              <h5 class="card-title">${poi.name}</h5>
              <p class="card-text">${poi.description}</p>
            </div>
            <ul class="list-group list-group-flush marker-card-bottom">
              <li class="list-group-item">An item</li>
              <li class="list-group-item">A second item</li>
              <li class="list-group-item">A third item</li>
            </ul>
          </div>
        `;
        marker.bindPopup(popupContent, {className: 'marker-card'});
      });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>

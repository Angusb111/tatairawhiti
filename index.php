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
                  <p class="form-heading">Description</p>
                  <textarea class="form-control" id="PlaceDescriptionInput" name="description" rows="3" required></textarea>
                </div>
                <div class="d-flex flex-direction-row my-5">
                  <p class="form-heading">Category</p>
                  <p>Thing</p>
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
        $('#PlaceLatitudeInput').val(lat); // Insert coords into hidden form inputs
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
      var nature_icon = L.icon({
          iconUrl: 'media/nature-marker.png',
          shadowUrl: 'media/shadow.png',
          iconSize: [34, 50],
          iconAnchor: [17, 50],
          popupAnchor: [0, 0],
          shadowSize:   [34, 40],
          shadowAnchor: [2, 35]
        });
        var monument_icon = L.icon({
          iconUrl: 'media/monument-marker.png',
          shadowUrl: 'media/shadow.png',
          iconSize: [34, 50],
          iconAnchor: [17, 50],
          popupAnchor: [0, 0],
          shadowSize:   [34, 40],
          shadowAnchor: [2, 35]
        });
        var historical_icon = L.icon({
          iconUrl: 'media/historical-marker.png',
          shadowUrl: 'media/shadow.png',
          iconSize: [34, 50],
          iconAnchor: [17, 50],
          popupAnchor: [0, 0],
          shadowSize:   [34, 40],
          shadowAnchor: [2, 35]
        });
      // Add markers to the map
      poiData.forEach(function(poi) {

        if (poi.category == 0) {
          markerIcon = historical_icon;
        } else if (poi.category == 1) {
          markerIcon = nature_icon;
        } else if (poi.category == 2) {
          markerIcon = monument_icon;
        }
        var marker = L.marker([poi.latitude, poi.longitude], {icon: markerIcon}).addTo(map);
        var popupContent = `
          <div class="d-flex flex-column flex-grow-1 marker-card-content" style="width: 18rem;">
            <img src="media/${poi.image}" class="card-img-top" alt="POI Image">
            <div class="card-body p-3 marker-card-bottom">
              <h5 class="card-title">${poi.name}</h5>
              <p class="card-text">${poi.description}</p>
            </div>
            <div class="d-flex marker-card-bottom mb-1">
              <a class="col-6 d-flex justify-content-center text-black border-end border-dark p-2" href="https://www.google.com/maps?q=${poi.latitude},${poi.longitude}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google me-2" viewBox="0 0 16 16">
                  <path d="M15.545 6.558a9.4 9.4 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.7 7.7 0 0 1 5.352 2.082l-2.284 2.284A4.35 4.35 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.8 4.8 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.7 3.7 0 0 0 1.599-2.431H8v-3.08z"/>
                </svg>
                Google Maps
              </a>
              <a class="col-6 d-flex justify-content-center text-black p-2" href="https://maps.apple.com/?q=${poi.latitude},${poi.longitude}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-apple me-2" viewBox="0 0 16 16">
                  <path d="M11.182.008C11.148-.03 9.923.023 8.857 1.18c-1.066 1.156-.902 2.482-.878 2.516s1.52.087 2.475-1.258.762-2.391.728-2.43m3.314 11.733c-.048-.096-2.325-1.234-2.113-3.422s1.675-2.789 1.698-2.854-.597-.79-1.254-1.157a3.7 3.7 0 0 0-1.563-.434c-.108-.003-.483-.095-1.254.116-.508.139-1.653.589-1.968.607-.316.018-1.256-.522-2.267-.665-.647-.125-1.333.131-1.824.328-.49.196-1.422.754-2.074 2.237-.652 1.482-.311 3.83-.067 4.56s.625 1.924 1.273 2.796c.576.984 1.34 1.667 1.659 1.899s1.219.386 1.843.067c.502-.308 1.408-.485 1.766-.472.357.013 1.061.154 1.782.539.571.197 1.111.115 1.652-.105.541-.221 1.324-1.059 2.238-2.758q.52-1.185.473-1.282"/>
                  <path d="M11.182.008C11.148-.03 9.923.023 8.857 1.18c-1.066 1.156-.902 2.482-.878 2.516s1.52.087 2.475-1.258.762-2.391.728-2.43m3.314 11.733c-.048-.096-2.325-1.234-2.113-3.422s1.675-2.789 1.698-2.854-.597-.79-1.254-1.157a3.7 3.7 0 0 0-1.563-.434c-.108-.003-.483-.095-1.254.116-.508.139-1.653.589-1.968.607-.316.018-1.256-.522-2.267-.665-.647-.125-1.333.131-1.824.328-.49.196-1.422.754-2.074 2.237-.652 1.482-.311 3.83-.067 4.56s.625 1.924 1.273 2.796c.576.984 1.34 1.667 1.659 1.899s1.219.386 1.843.067c.502-.308 1.408-.485 1.766-.472.357.013 1.061.154 1.782.539.571.197 1.111.115 1.652-.105.541-.221 1.324-1.059 2.238-2.758q.52-1.185.473-1.282"/>
                </svg>
                Apple Maps
              </a>
            </div>
          </div>
        `;
        marker.bindPopup(popupContent, {className: 'marker-card'});
      });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>
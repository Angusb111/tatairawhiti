<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta charset="utf-8">
    <title>Tairāwhiti Uncovered | Discover & Share Local Gems!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="css/master1.css">
    <link rel="icon" href="media/icon.svg">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <style>
    #map { height: 100%; }
  </style>
  <body id="home-page">
    <?php include 'mini/header.php'; ?>
    <div id="map"></div>

    <!-- Modal for Creating a New Place -->
    <div class="modal modal-xl fade" id="createMarkerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-frame d-flex">
        <div class="modal-dialog modal-dialog-createplace">
          <div class="modal-content rounded-4 border-0 modal-content-createplace">
            <div class="modal-body modal-body-createplace d-flex flex-column">
              <!-- Close Button -->
              <div class="w-100 d-flex flex-direction-row justify-content-end">
                <button type="button" class="btn-close m-2" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <!-- Form for Creating a New Place -->
              <div class="d-flex justify-content-center create-form flex-grow-1 pt-0 ">

                <!-- Section 1: Place Name -->
                <div class="form-section active flex-column justify-content-center align-items-center text-center col-12 col-lg-6" id="section1">
                  <div class="d-flex flex-column my-4 form-input-container">
                    <p class="form-heading pb-3">Place Name</p>
                    <input type="text" class="form-input text-center" id="PlaceNameInput" placeholder="Enter place name" required>
                  </div>
                  <button type="button" class="form-next-button py-4" id="nextToSection2">
                    <div class="d-flex flex-direction-row align-items-center">
                      Next
                    </div>
                    <div class="form-next-button-rect"></div>
                  </button>
                </div>

                <!-- Section 2: Description -->
                <div class="form-section flex-column justify-content-center align-items-center text-center col-12 col-lg-6" id="section2">
                  <div class="d-flex flex-column my-4 form-input-container">
                    <p class="form-heading pb-3">Description</p>
                    <textarea class="form-control text-center" id="PlaceDescriptionInput" name="description" rows="3" placeholder="Enter description" required></textarea>
                  </div>
                  <button type="button" class="form-next-button py-4" id="nextToSection3">
                    <div class="d-flex flex-direction-row align-items-center">
                      Next
                    </div>
                    <div class="form-next-button-rect"></div>
                  </button>
                </div>

                <!-- Section 3: Category Selection -->
                <div class="form-section flex-column justify-content-center align-items-center text-center col-12 col-lg-6" id="section3">
                  <div class="d-flex flex-column my-4 form-input-container">
                    <p class="form-heading pb-3">Category</p>
                    <div class="d-flex flex-row category-selector-row justify-content-center">
                      <!-- Nature Category -->
                      <div class="d-flex flex-column align-items-center px-4 py-4 border rounded category-selector-item" data-category="1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-tree mt-2" viewBox="0 0 16 16">
                          <path d="M8.416.223a.5.5 0 0 0-.832 0l-3 4.5A.5.5 0 0 0 5 5.5h.098L3.076 8.735A.5.5 0 0 0 3.5 9.5h.191l-1.638 3.276a.5.5 0 0 0 .447.724H7V16h2v-2.5h4.5a.5.5 0 0 0 .447-.724L12.31 9.5h.191a.5.5 0 0 0 .424-.765L10.902 5.5H11a.5.5 0 0 0 .416-.777zM6.437 4.758A.5.5 0 0 0 6 4.5h-.066L8 1.401 10.066 4.5H10a.5.5 0 0 0-.424.765L11.598 8.5H11.5a.5.5 0 0 0-.447.724L12.69 12.5H3.309l1.638-3.276A.5.5 0 0 0 4.5 8.5h-.098l2.022-3.235a.5.5 0 0 0 .013-.507"/>
                        </svg>
                        <p class="m-0 mt-1">Nature</p>
                      </div>
                      <!-- Monument Category -->
                      <div class="d-flex flex-column align-items-center px-4 py-4 border rounded category-selector-item" data-category="2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-tree mt-2" viewBox="0 0 16 16">
                          <g id="layer1" transform="matrix(0.18633051,0,0,0.18632812,-1.3165219,-178.69338)" style="fill:none;fill-opacity:1;stroke:#000000;stroke-width:5.37529374;stroke-dasharray:none;stroke-opacity:1;stroke-linejoin:round">
                            <path d="m 49.999999,962.7787 c 0,0 -10.793917,8.35041 -10.416667,12.49999 v 45.83331 h -8.333333 c -2.308375,0 -4.166667,1.8583 -4.166667,4.1666 v 8.3334 h -4.166666 c -2.308292,0 -4.166667,1.8583 -4.166667,4.1666 v 4.1667 H 81.25 v -4.1667 c 0,-2.3083 -1.858376,-4.1666 -4.166667,-4.1666 h -4.166667 v -8.3334 c 0,-2.3083 -1.858292,-4.1666 -4.166667,-4.1666 h -8.333333 v -45.83331 c 0,-4.16666 -10.416667,-12.49999 -10.416667,-12.49999 z" id="path11719" style="color:#000000;display:inline;overflow:visible;visibility:visible;fill:none;fill-opacity:1;stroke:#000000;stroke-width:5.37529374;stroke-dasharray:none;stroke-opacity:1;marker:none;enable-background:accumulate;stroke-linejoin:round"/>
                          </g>
                        </svg>
                        <p class="m-0 mt-1">Monument</p>
                      </div>
                      <!-- Historic Site Category -->
                      <div class="d-flex flex-column align-items-center px-4 py-4 border rounded category-selector-item" data-category="0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-hourglass-split mt-2" viewBox="0 0 16 16">
                          <path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z"/>
                        </svg>
                        <p class="m-0 mt-1">Historic Site</p>
                      </div>
                    </div>
                  </div>
                  <button type="button" class="form-next-button py-4" id="savePlaceBtn">
                    <div class="d-flex flex-direction-row align-items-center">
                      Save changes
                    </div>
                    <div class="form-next-button-rect"></div>
                  </button>
                </div>

                <!-- Hidden Inputs for Latitude and Longitude -->
                <input type="hidden" id="PlaceLatitudeInput">
                <input type="hidden" id="PlaceLongitudeInput">
                
              </div>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer border-0 p-0">
                  <!-- No footer buttons, they are in the form sections -->
            </div>
          </div>
        </div>
      </div>
    </div>


    <script>
      
      $(document).ready(function () {
        // Handle section transitions
        $('#nextToSection2').click(function () {
          $('#section1').removeClass('active').fadeOut(function () {
            $('#section2').addClass('active').fadeIn();
          });
        });

        $('#nextToSection3').click(function () {
          $('#section2').removeClass('active').fadeOut(function () {
            $('#section3').addClass('active').fadeIn();
          });
        });

        // Handle category selection
        $('.category-selector-item').click(function () {
          $('.category-selector-item').removeClass('selected');
          $(this).addClass('selected');
          // Save the selected category to a hidden input or a variable if needed
          var selectedCategory = $(this).data('category');
          $('#selectedCategoryInput').val(selectedCategory);
        });

        // Handle form submission
        $('#savePlaceBtn').click(function () {
          // Save the form data here
          alert('Place saved!');
        });
      });
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

    $poiData = array();
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $poiData[] = $row;
      }
    }

    $conn->close();
    ?>

    <script>
      // Enable tooltips
      document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
          return new bootstrap.Tooltip(tooltipTriggerEl)
        })
      });

      function setInitialBackdropColor() {
        var savedBackdrop = localStorage.getItem('backdrop');
        if (savedBackdrop) {
          $('.leaflet-container').css('background-color', savedBackdrop);
        }
      }

      var map = L.map('map', {
        zoomControl: false,
        zoomDelta: 2,
        minZoom: 9,   // Minimum zoom level
        maxZoom: 17,  // Maximum zoom level
        maxBounds: L.latLngBounds([[-39.3, 177.0], [-37.5, 178.9]])
      }).setView([-38.66398800969844, 178.0225992971014], 13);

      // Function to handle mouse wheel zoom
      function handleMouseWheel(event) {
        var delta = Math.sign(event.deltaY); // Determine scroll direction
        var zoom = map.getZoom();
        if (delta > 0) {
          map.setZoom(zoom - 2); // Zoom out by 2 levels
        } else {
          map.setZoom(zoom + 2); // Zoom in by 2 levels
        }

        // Prevent default scroll behavior
        event.preventDefault();
      }

      var mapContainer = document.getElementById('map');
      mapContainer.addEventListener('wheel', handleMouseWheel);

      // Initialize mapLayer in localStorage if not already set
      if (!localStorage.getItem('mapLayer')) {
        localStorage.setItem('mapLayer', 'https://tile.openstreetmap.org/{z}/{x}/{y}.png');
        localStorage.setItem('backdrop', '#aad3df');
      }

      // Create the tile layer from localStorage
      var currentLayer = L.tileLayer(localStorage.getItem('mapLayer'), {
        maxZoom: 18,
        attribution: `
          <button type="button" class="attribution-button" data-bs-toggle="tooltip" data-bs-html="true" data-bs-title='&copy; CNES, Distribution Airbus DS, © Airbus DS, © PlanetObserver (Contains Copernicus Data) | &copy; <a href="https://www.stadiamaps.com/" target="_blank">Stadia Maps</a> &copy; <a href="https://openmaptiles.org/" target="_blank">OpenMapTiles</a> &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'>
            Attributions
          </button>`
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
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;

        // Create a popup with a form
        var popupContent = `
          <div class="d-flex flex-column area-selector-popup">
            <p class="p-2 m-0 area-selector-coords flex-grow-1">${lat.toFixed(4)}, ${lng.toFixed(4)}</p>
            <button class="p-2 border-0 border-top w-100 create-marker-btn" onClick="buttonClick(${lat.toFixed(6)}, ${lng.toFixed(6)});">Create Marker</button>
          </div>
        `;

        // Create a new popup
        var popup = L.popup({minWidth: 160, className: 'mapclick-popup'})
          .setLatLng(e.latlng)
          .setContent(popupContent)
          .openOn(map);
      });

      // Handle category selection
      $('.category-selector-item').click(function () {
        $('.category-selector-item').removeClass('selected');
        $(this).addClass('selected');
      });

      // Handle form submission
      $('#savePlaceBtn').click(function () {
        // Collect form data
        var placeName = $('#PlaceNameInput').val();
        var description = $('#PlaceDescriptionInput').val();
        var category = $('.category-selector-item.selected').data('category'); // Get the selected category
        var latitude = $('#PlaceLatitudeInput').val();
        var longitude = $('#PlaceLongitudeInput').val();

        // Perform AJAX request to save the form data
        $.ajax({
          url: 'scripts/insert_poi.php', // Replace with your server endpoint
          method: 'POST',
          data: {
            latitude: latitude,
            longitude: longitude,
            name: placeName,
            website: description, // Assuming 'website' in PHP is meant to be 'description' from the form
            category: category // Add category to the data sent
          },
          success: function (response) {
            // Handle success response
            if (response.success) {
              alert('Place saved successfully!');
              // Optionally, close the modal or reset the form
              $('#createMarkerModal').modal('hide');
            } else {
              alert('Error: ' + response.message);
            }
          },
          error: function (error) {
            // Handle error response
            alert('Failed to save place. Please try again.');
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
        shadowSize: [34, 40],
        shadowAnchor: [2, 35]
      });
      var monument_icon = L.icon({
        iconUrl: 'media/monument-marker.png',
        shadowUrl: 'media/shadow.png',
        iconSize: [34, 50],
        iconAnchor: [17, 50],
        popupAnchor: [0, 0],
        shadowSize: [34, 40],
        shadowAnchor: [2, 35]
      });
      var historical_icon = L.icon({
        iconUrl: 'media/historical-marker.png',
        shadowUrl: 'media/shadow.png',
        iconSize: [34, 50],
        iconAnchor: [17, 50],
        popupAnchor: [0, 0],
        shadowSize: [34, 40],
        shadowAnchor: [2, 35]
      });

      // Add markers to the map
      poiData.forEach(function(poi) {
        var markerIcon;
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

      function switchMapLayer(newLayerUrl) {
        // Remove the current layer
        map.removeLayer(currentLayer);
        
        // Add the new layer
        currentLayer = L.tileLayer(newLayerUrl, {
          maxZoom: 18,
          attribution: `
            <button type="button" class="attribution-button" data-bs-toggle="tooltip" data-bs-html="true" data-bs-title='&copy; CNES, Distribution Airbus DS, © Airbus DS, © PlanetObserver (Contains Copernicus Data) | &copy; <a href="https://www.stadiamaps.com/" target="_blank">Stadia Maps</a> &copy; <a href="https://openmaptiles.org/" target="_blank">OpenMapTiles</a> &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'>
              Attributions
            </button>`
        }).addTo(map);
      }

      function toggleLayerString() {
        if (localStorage.getItem('mapLayer') == 'https://tiles.stadiamaps.com/tiles/alidade_satellite/{z}/{x}/{y}{r}.jpg') {
          newBackdrop = '#aad3df';
          return 'https://tile.openstreetmap.org/{z}/{x}/{y}.png';
        } else {
          newBackdrop = '#010a1b';
          return 'https://tiles.stadiamaps.com/tiles/alidade_satellite/{z}/{x}/{y}{r}.jpg';
        }
      }

      // Handle layer toggle button click
      $('#toggleMapLayerButton').click(function () {
        var newLayerUrl = toggleLayerString();
        localStorage.setItem('mapLayer', newLayerUrl);
        localStorage.setItem('backdrop', newBackdrop);
        switchMapLayer(newLayerUrl);
        $('.leaflet-container').css('background-color', newBackdrop);
      });

      $(document).ready(function() {
        setInitialBackdropColor();
      });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>
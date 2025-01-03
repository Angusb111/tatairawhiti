<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta charset="utf-8">
    <title>Discover Tairāwhiti | Discover & Share Local Gems!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="css/master1.css">
    <link rel="icon" href="media/icon.svg">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script src="js/googleauth.js"></script>
    <script src="js/buttonsinit.js"></script>
  </head>




  <body id="home-page">
    <?php include 'mini/header.php'; ?>
    <div id="map"></div>

<!-- About Modal -->
<div class="modal modal-xl fade" id="aboutModal" tabindex="-1" aria-hidden="true">
  <div class="modal-frame d-flex">
    <div class="modal-dialog modal-dialog-createplace">
      <div class="modal-content rounded-4 border-0 modal-content-createplace">
        <div class="modal-body modal-body-createplace d-flex flex-column">
          <!-- Close Button -->
          <div class="w-100 d-flex flex-direction-row justify-content-between">
          <h1 class="px-5">About Discover Tairawhiti</h1>
            <button type="button" class="modal-close-button m-2 p-2" data-bs-dismiss="modal" aria-label="Close">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" width="16" height="16">
                <path d="M.293.293a1 1 0 0 1 1.414 0L8 6.586 14.293.293a1 1 0 1 1 1.414 1.414L9.414 8l6.293 6.293a1 1 0 0 1-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 0 1-1.414-1.414L6.586 8 .293 1.707a1 1 0 0 1 0-1.414z"/>
              </svg>
            </button>
          </div>
          
          <div class="d-flex flex-column justify-content-center flex-grow-1 pt-0">
            <div class="content px-5">
              <p><strong>Discover Tairāwhiti</strong> is a web application designed to help locals and tourists explore the hidden gems of the Tairāwhiti region. The platform allows users to discover and share points of interest, providing a crowd-sourced map of unique locations to explore.</p>
              
              <h2>Features in Progress</h2>
              <ul class="features-list">
                <li>Image Submission</li>
              </ul>
              
              <h2>Up-Next</h2>
              <ul class="features-list">
                <li>Tags</li>
              </ul>
            </div>
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


<div class="modal fade" id="createMarkerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-frame d-flex align-items-center">
    <div class="modal-dialog modal-dialog-createplace">
      <div class="modal-content rounded-4 border-0 modal-content-createplace">
        <div class="modal-body modal-body-createplace d-flex flex-column">
          <!-- Close Button -->
          <div class="w-100 d-flex flex-direction-row justify-content-end">
            <button type="button" class="modal-close-button m-2 p-2" data-bs-dismiss="modal" aria-label="Close">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" width="16" height="16">
                <path d="M.293.293a1 1 0 0 1 1.414 0L8 6.586 14.293.293a1 1 0 1 1 1.414 1.414L9.414 8l6.293 6.293a1 1 0 0 1-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 0 1-1.414-1.414L6.586 8 .293 1.707a1 1 0 0 1 0-1.414z"/>
              </svg>
            </button>
          </div>
          <!-- Form for Creating a New Place -->
          <form action="scripts/upload.php" method="post" enctype="multipart/form-data" class="d-flex justify-content-center align-items-center create-form flex-grow-1 pt-0">

            <!-- Section 1: Place Name -->
            <div class="form-section active flex-column justify-content-center align-items-center text-center col-12 col-lg-6" id="section1">
              <div class="d-flex flex-column my-4 form-input-container">
                <p class="form-heading pb-3">Place Name</p>
                <div class="input-wrapper">
                  <input type="text" class="form-input text-center" id="PlaceNameInput" name="placeName" placeholder="Enter place name" required>
                </div>
              </div>
              <button type="button" class="form-next-button" id="nextToSection2">
                <div class="d-flex flex-direction-row align-items-center">
                  Next
                </div>
              </button>
            </div>

            <!-- Section 2: Description -->
            <div class="form-section flex-column justify-content-center align-items-center text-center col-12 col-lg-6" id="section2">
              <div class="d-flex flex-column my-4 form-input-container">
                <p class="form-heading pb-3">Description</p>
                <textarea class="form-control text-center" id="PlaceDescriptionInput" name="placeDescription" rows="3" placeholder="Enter description" required></textarea>
              </div>
              <button type="button" class="form-next-button" id="nextToSection3">
                <div class="d-flex flex-direction-row align-items-center">
                  Next
                </div>
              </button>
            </div>

            <!-- Section 3: Category Selection -->
            <div class="form-section flex-column justify-content-center align-items-center text-center col-12 col-lg-6" id="section3">
              <div class="d-flex flex-column my-4 form-input-container align-items-center">
                <p class="form-heading pb-3">Category</p>

                <div class="d-flex flex-column justify-content-center">

                  <div class="d-flex flex-wrap category-selector-row justify-content-start flex-shrink-1">
                    
                    <!-- Nature Category -->
                    <div class="d-flex flex-column align-items-center px-4 py-4 border rounded category-selector-item" data-category="1">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-tree mt-2" viewBox="0 0 16 16">
                        <path d="M8.416.223a.5.5 0 0 0-.832 0l-3 4.5A.5.5 0 0 0 5 5.5h.098L3.076 8.735A.5.5 0 0 0 3.5 9.5h.191l-1.638 3.276a.5.5 0 0 0 .447.724H7V16h2v-2.5h4.5a.5.5 0 0 0 .447-.724L12.31 9.5h.191a.5.5 0 0 0 .424-.765L10.902 5.5H11a.5.5 0 0 0 .416-.777zM6.437 4.758A.5.5 0 0 0 6 4.5h-.066L8 1.401 10.066 4.5H10a.5.5 0 0 0-.424.765L11.598 8.5H11.5a.5.5 0 0 0-.447.724L12.69 12.5H3.309l1.638-3.276A.5.5 0 0 0 4.5 8.5h-.098l2.022-3.235a.5.5 0 0 0 .013-.507"/>
                      </svg>
                      <p class="m-0 mt-1">Nature</p>
                    </div>
                    
                    <!-- Monument Category -->
                    <div class="d-flex flex-column align-items-center px-4 py-4 border rounded category-selector-item" data-category="2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" stroke="currentColor" class="bi bi-tree mt-2" viewBox="0 0 16 16">
                        <path d="m 49.999999,962.7787 c 0,0 -10.793917,8.35041 -10.416667,12.49999 v 45.83331 h -8.333333 c -2.308375,0 -4.166667,1.8583 -4.166667,4.1666 v 8.3334 h -4.166666 c -2.308292,0 -4.166667,1.8583 -4.166667,4.1666 v 4.1667 H 81.25 v -4.1667 c 0,-2.3083 -1.858376,-4.1666 -4.166667,-4.1666 h -4.166667 v -8.3334 c 0,-2.3083 -1.858292,-4.1666 -4.166667,-4.1666 h -8.333333 v -45.83331 c 0,-4.16666 -10.416667,-12.49999 -10.416667,-12.49999 z" transform="matrix(0.18633051,0,0,0.18632812,-1.3165219,-178.69338)" style="fill:none;fill-opacity:1;stroke-width:5.37529374;stroke-dasharray:none;stroke-opacity:1;stroke-linejoin:round"/>
                    </svg>
                      <p class="m-0 mt-1">Monument</p>
                    </div>
                    
                    <!-- Historic Site Category -->
                    <div class="d-flex flex-column align-items-center px-4 py-4 border rounded category-selector-item" data-category="0">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-hourglass-split mt-2" viewBox="0 0 16 16">
                        <path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.5 0 .5 1h6c0-1 .5-1 .5-1a3.5 3.5 0 0 0-2.989-3.158C8.478 9.586 8 9.051 8 8.35z"/>
                      </svg>
                      <p class="m-0 mt-1">Historic Site</p>
                    </div>

                  </div>
                </div>
              </div>
              <button type="button" class="form-next-button" id="nextToSection4">
                <div class="d-flex flex-direction-row align-items-center">
                  Next
                </div>
              </button>
            </div>

<!-- Section 4: Image Upload -->
<div class="form-section flex-column justify-content-center align-items-center text-center col-12 col-lg-6" id="section4">
  <div class="d-flex flex-column my-4 form-input-container">
    <p class="form-heading pb-3">Upload Image</p>
    <div class="input-wrapper">
      <input 
        type="file" 
        class="form-input text-center" 
        id="PlaceImageInput" 
        name="placeImage" 
        accept="image/*" 
        required 
        onchange="showImagePreview(event)">
    </div>
    <!-- Preview container -->
    <div class="image-preview mt-3" id="imagePreviewContainer" style="display: none;">
      <img id="imagePreview" src="#" alt="Selected Image Preview" style="max-width: 100%; max-height: 300px; border: 1px solid #ddd; padding: 10px;"/>
    </div>
  </div>
  <button type="submit" class="form-next-button" id="savePlaceBtn">
    <div class="d-flex flex-direction-row align-items-center">
      Save changes
    </div>
  </button>
</div>

<script>
  function showImagePreview(event) {
    const fileInput = event.target;
    const previewContainer = document.getElementById('imagePreviewContainer');
    const previewImage = document.getElementById('imagePreview');
    
    if (fileInput.files && fileInput.files[0]) {
      const reader = new FileReader();
      
      reader.onload = function (e) {
        previewImage.src = e.target.result; // Set the image source to the file
        previewContainer.style.display = 'block'; // Show the preview container
      };
      
      reader.readAsDataURL(fileInput.files[0]); // Read the file as a data URL
    } else {
      previewImage.src = "#";
      previewContainer.style.display = 'none'; // Hide the preview container if no file is selected
    }
  }
</script>

            <input type="hidden" id="PlaceLatitudeInput" name="latitude">
            <input type="hidden" id="PlaceLongitudeInput" name="longitude">
          </form>
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

    $('#nextToSection4').click(function () {
      $('#section3').removeClass('active').fadeOut(function () {
        $('#section4').addClass('active').fadeIn();
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
    $('#savePlaceBtn').click(function (e) {
      e.preventDefault();
      var formData = new FormData($('form')[0]);

      // Add extra data to formData
      formData.append('latitude', $('#PlaceLatitudeInput').val());
      formData.append('longitude', $('#PlaceLongitudeInput').val());
      formData.append('placeCategory', $('.category-selector-item.selected').data('category'));

      $.ajax({
        url: 'scripts/upload.php', // Replace with your server endpoint
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          console.log(response); // Log the response for debugging
          if (response.success) {
            $('form')[0].reset();
            $('.category-selector-item').removeClass('selected'); // Reset category selection
            $('#createMarkerModal').modal('hide');
          } else {
            alert('Error: ' + response.message);
          }
        },
        error: function (error) {
          console.log(error); // Log the error for debugging
          alert('Failed to save place. Please try again.');
        }
      });
    });
  });
</script>

    <?php
    // Connect to MySQL database
    $servername = "localhost";
    $username = "user";
    $password = "iott3";
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

      var map = L.map('map', {
        zoomControl: false,
        minZoom: 9,   // Minimum zoom level
        maxZoom: 18,  // Maximum zoom level
        maxBounds: L.latLngBounds([[-39.3, 177.0], [-37, 178.9]])
      }).setView([-38.66398800969844, 178.0225992971014], 13);

      var mapContainer = document.getElementById('map');

      // Create the tile layer from localStorage
      var currentLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: `
          <button type="button" class="attribution-button" data-bs-toggle="tooltip" data-bs-html="true" data-bs-title='&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'>
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
            <button class="p-2 border-0 w-100 accent-btn bg-none" onClick="buttonClick(${lat.toFixed(6)}, ${lng.toFixed(6)});">Create Marker</button>
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

      // Pass the POI data from PHP to JavaScript
      var poiData = <?php echo json_encode($poiData); ?>;

      // Add markers to the map
      poiData.forEach(function(poi) {
    var markerIconHtml;
    
    // Choose the correct icon based on the category
    if (poi.category == 0) {
        markerIconHtml = '<div class="custom-marker"><img src="media/histicon.png" alt="Historical Icon"></div>';
    } else if (poi.category == 1) {
        markerIconHtml = '<div class="custom-marker"><img src="media/fernicon.png" alt="Nature Icon"></div>';
    } else if (poi.category == 2) {
        markerIconHtml = '<div class="custom-marker"><img src="media/monicon.png" alt="Monument Icon"></div>';
    }
    
    // Create a DivIcon for the marker
    var markerIcon = L.divIcon({
        html: markerIconHtml,
        className: 'custom-div-icon', // Optional: You can define custom CSS classes for additional styling
        iconSize: [34, 40],  // Set size as needed
        iconAnchor: [17, 40], // Anchor the icon correctly
        popupAnchor: [0, -15] // Adjust to position the popup above the marker
    });
    
    // Add marker to the map
    var marker = L.marker([poi.latitude, poi.longitude], {icon: markerIcon}).addTo(map);

    // Add the popup content as before
    var popupContent = `
      <div class="d-flex flex-column flex-grow-1 marker-card-content" style="width: 18rem;">
        <img src="media/${poi.image}" class="card-img-top" alt="POI Image">
        <div class="card-body p-3 marker-card-bottom">
          <h5 class="card-title">${poi.name}</h5>
          <p class="card-text">${poi.description}</p>
        </div>
        <a class="col-12 d-flex justify-content-center align-items-center border-bottom border-top p-2" href="wiki.php?poiId=${poi.id}">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-info-lg" viewBox="0 0 16 16">
            <path d="m9.708 6.075-3.024.379-.108.502.595.108c.387.093.464.232.38.619l-.975 4.577c-.255 1.183.14 1.74 1.067 1.74.72 0 1.554-.332 1.933-.789l.116-.549c-.263.232-.65.325-.905.325-.363 0-.494-.255-.402-.704zm.091-2.755a1.32 1.32 0 1 1-2.64 0 1.32 1.32 0 0 1 2.64 0"/>
          </svg>
        Mātauranga / Info
        </a>
        <div class="d-flex marker-card-bottom mb-1">
          <a class="col-6 d-flex justify-content-center border-end p-2" href="https://www.google.com/maps?q=${poi.latitude},${poi.longitude}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google me-2" viewBox="0 0 16 16">
              <path d="M15.545 6.558a9.4 9.4 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.7 7.7 0 0 1 5.352 2.082l-2.284 2.284A4.35 4.35 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.8 4.8 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.7 3.7 0 0 0 1.599-2.431H8v-3.08z"/>
            </svg>
            Google Maps
          </a>
          <a class="col-6 d-flex justify-content-center p-2" href="https://maps.apple.com/?q=${poi.latitude},${poi.longitude}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-apple me-2" viewBox="0 0 16 16">
              <path d="M11.182.008C11.148-.03 9.923.023 8.857 1.18c-1.066 1.156-.902 2.482-.878 2.516s1.52.087 2.475-1.258.762-2.391.728-2.43m3.314 11.733c-.048-.096-2.325-1.234-2.113-3.422s1.675-2.789 1.698-2.854-.597-.79-1.254-1.157a3.7 3.7 0 0 0-1.563-.434c-.108-.003-.483-.095-1.254.116-.508.139-1.653.589-1.968.607-.316.018-1.256-.522-2.267-.665-.647-.125-1.333.131-1.824.328-.49.196-1.422.754-2.074 2.237-.652 1.482-.311 3.83-.067 4.56s.625 1.924 1.273 2.796c.576.984 1.34 1.667 1.659 1.899s1.219.386 1.843.067c.502-.308 1.408-.485 1.766-.472.357.013 1.061.154 1.782.539.571.197 1.111.115 1.652-.105.541-.221 1.324-1.059 2.238-2.758q.52-1.185.473-1.282"/>
            </svg>
            Apple Maps
          </a>
        </div>
      </div>
    `;
    
    marker.bindPopup(popupContent, {
        className: 'marker-card',
        autoPan: true,
        autoPanPaddingTopLeft: L.point(20, 100),
        autoPanPaddingBottomRight: L.point(20, 100)
    });
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

    </script>
    <script src="js/theme.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>

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
        maxBounds: L.latLngBounds([[-40, 177.0], [-36.5, 178.9]])
      }).setView([-38.66398800969844, 178.0225992971014], 13);

      var mapContainer = document.getElementById('map');

      function loadTiles() {
        if (localStorage.getItem('mapLayer') == 'sat') {
          var currentLayer = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
            maxZoom: 20,
            subdomains:['mt0','mt1','mt2','mt3'],
          attribution: `<p class="attribution-text">Map Data ©2025 Google</p>`
        }).addTo(map);
        } else {
          var currentLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          maxZoom: 18,
          attribution: `
            <button type="button" class="attribution-button" data-bs-toggle="tooltip" data-bs-html="true" data-bs-title='&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'>
              Attributions
            </button>`
        }).addTo(map);
        }
      }
      
      loadTiles();

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
        autoPanPaddingTopLeft: L.point(20, 150),
        autoPanPaddingBottomRight: L.point(20, 100)
    });
});

    </script>
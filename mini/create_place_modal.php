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

    $('#savePlaceBtn').click(function (e) {
      e.preventDefault();
      var formData = new FormData($('form')[0]);

      // Create an object for all form data, including place name, description, coordinates, and category
      var placeData = {
        placeName: $('#PlaceNameInput').val(),
        placeDescription: $('#PlaceDescriptionInput').val(),
        latitude: $('#PlaceLatitudeInput').val(),
        longitude: $('#PlaceLongitudeInput').val(),
        placeCategory: $('.category-selector-item.selected').data('category')
      };

      // Append the placeData object as a JSON string for server-side parsing
      formData.append('placeData', JSON.stringify(placeData));

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

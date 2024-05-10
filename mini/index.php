<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Angus Photo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="css/master.css">
    <link rel="icon" href="media/icon.svg">
  </head>
  <body id="home-page">
    <?php include 'mini/header.php'; ?>
    <div class="d-flex justify-content-center align-items-center backdrop px-md-5">
    
    <div id="carouselExampleSlidesOnly" class="carousel slide h-100 d-md-none" data-bs-ride="carousel">
      
      <div class="carousel-inner h-100">
        <div class="carousel-item h-100 active">
          <img src="media/wallpaper/1.webp" alt="Fern Wallpaper" class="d-block d-md-none mobile-backdrop">
        </div>
        <div class="carousel-item h-100">
          <img src="media/wallpaper/2.webp" alt="Forest Stream Wallpaper" class="d-block d-md-none mobile-backdrop">
        </div>
        <div class="carousel-item h-100">
          <img src="media/wallpaper/3.webp" alt="Glowing Tiki Wallpaper" class="d-block d-md-none mobile-backdrop">
        </div>
      </div>
      <div class="floating-text p-5 h-100 text-white">
        <p class="welcome-sign">Welcome</p>
      <div class="fs-4 welcome-text">
        <p>to my Photo Gallery.</p>
        <p>Choose a Collection from</p>
        <p>the Menu to Get Started!</p>
      </div>
      </div>
    </div>
      <div class="collections column w-100 pt-lg-5 mt-lg-5 d-none d-md-flex">
        <div class="" id="collections">
          <div class="collections-bar d-flex justify-content-center flex-wrap px-md-5" id="collections-bar">
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

<script src="js/jsall.js" charset="utf-8"></script>

<script type="text/javascript">
fetch('js/collections.json')
.then(response => response.json())
.then(json => {
  json.images.forEach((value, index) => {
    const collectionsItem = document.createElement('a');
    collectionsItem.classList.add('d-flex', 'flex-column', 'collections-item', 'text-decoration-none');
    collectionsItem.href = `gallery?collection=${value.name}`;

    const collectionsImage = document.createElement('img');
    collectionsImage.classList.add('collections-image', 'm-0');
    collectionsImage.src = `media/collections/${value.imagePath}.webp`;
	collectionsImage.alt = `${value.name}Collection`;
	collectionsImage.width = `480`;
	collectionsImage.height = `320`;

    const collectionCapt = document.createElement('p');
    collectionCapt.classList.add('collection-capt', 'text-white', 'text-left', 'p-3');
    collectionCapt.textContent = value.imageName;

    collectionsItem.appendChild(collectionsImage);
    collectionsItem.appendChild(collectionCapt);

    document.querySelector('#collections-bar').appendChild(collectionsItem);

    console.log(index);
  });
});
</script>

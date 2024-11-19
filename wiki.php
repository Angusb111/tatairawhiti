<?php
// wiki.php

// Database connection details
$host = 'localhost';    // Change to your database host
$db   = 'poi_database';  // Change to your database name
$user = 'root';          // Change to your database username
$pass = '';              // Change to your database password
$charset = 'utf8mb4';

// Set up the DSN (Data Source Name) for PDO
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// Try to connect to the database
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Check if the POI ID is passed via POST
if (isset($_POST['poiId'])) {
    $poiId = $_POST['poiId'];

    // Prepare a SQL statement to fetch POI details by ID
    $stmt = $pdo->prepare('SELECT name, description, image FROM poi WHERE id = :poiId');
    $stmt->execute(['poiId' => $poiId]);
    $poi = $stmt->fetch();

    // If the POI ID doesn't exist in the database
    if (!$poi) {
        echo "POI not found.";
        exit();
    }
} else {
    echo "No POI ID provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wiki - <?php echo htmlspecialchars($poi['name']); ?></title>
    <link rel="stylesheet" href="css/master1.css">
    <link rel="icon" href="media/icon.svg">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body style="margin: 0px;">
    <div class="container">
        <div class="wiki-content">
            <div class="image-wrapper">
                <img src="<?php echo "media/" . htmlspecialchars($poi['image']); ?>" alt="Example Image" class="responsive-image">
            </div>

            <h1 class="wiki-title"><?php echo htmlspecialchars($poi['name']); ?></h1>
            <p><?php echo htmlspecialchars($poi['description']); ?></p>
        </div>

        <script>
            // Get the color theme from localStorage
            const savedColorTheme = localStorage.getItem('colorTheme') || 'light'; // Default to light if not set

            // Apply the theme based on localStorage value
            function applyTheme(theme) {
                if (theme === 'dark') {
                    document.body.style.setProperty('--background', 'rgb(24, 26, 37)');
                    document.body.style.setProperty('--text', 'rgb(233, 233, 233)');
                } else {
                    document.body.style.setProperty('--background', 'rgb(250, 250, 250)');
                    document.body.style.setProperty('--text', 'rgb(0, 0, 0)');
                }
            }

            // Apply the initial theme when the page loads
            applyTheme(savedColorTheme);
        </script>
    </div>
</body>
</html>

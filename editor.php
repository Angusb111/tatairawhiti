<?php
date_default_timezone_set("Pacific/Auckland");
// Database connection details
$servername = "localhost";
$username = "user";
$password = "iott3";
$dbname = "poi_database";           
$charset = 'utf8mb4';

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the POI ID is passed via GET
if (isset($_GET['p'])) {
    $poiId = $_GET['p'];
    // Fetch POI data for the specified ID
    $sql = "SELECT * FROM poi WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $poiId);
    $stmt->execute();
    $result = $stmt->get_result();

    $poi = $result->fetch_assoc();

    $stmt->close();
    $conn->close();

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
    <title><?php echo htmlspecialchars($poi['name']); ?> | Tairawhiti Local</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="css/master1.css">
    <link rel="stylesheet" href="css/wiki.css">
    <link rel="icon" href="media/icon.svg">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script src="js/googleauth.js"></script>
    <script src="js/buttonsinit.js"></script>
    <script>
        const poiData = <?php echo json_encode($poi, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>;
        
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelector('.info-title').textContent = poiData.name
            document.querySelector('.info-description').innerHTML = poiData.description;
            document.querySelector('.wiki-image').src = `media/${poiData.image}`;
            
            const textboxArray = Array.from(document.querySelectorAll('.editor-textbox'));
            
            textboxArray.forEach(textbox => {
                textbox.style.height = textbox.scrollHeight + 'px';
                textbox.addEventListener('input', () => {
                    textbox.style.height = 'auto';
                    textbox.style.height = textbox.scrollHeight + 'px';
                });
            });

        });
    </script>
</head>
<body class="wiki-page">
<?php include 'mini/header.php'; ?>
<?php include 'mini/about.php'; ?>


<div class="info-wrapper">
    <img class="wiki-image"></img>
    <form action="scripts/submit_edit.php" method="post" enctype="multipart/form-data" class="d-flex flex-column">
        <div class="d-flex flex-row flex-grow-1">
            <input class="d-flex flex-grow-1" name="changeNotes" id="" placeholder="Edit Notes...."></input>
            <button class="wiki-inline-button">Submit Edit</button>
        </div>

        <div class="d-flex flex-column info-section p-3">
            <div class="d-flex flex-direction-row justify-content-between flex-wrap wiki-top-bar">
                <h1 class="info-title m-0 mb-3"></h1>
            </div>
            <textarea class="info-description editor-textbox" name="description"></textarea>
        </div>
        <!-- MAIN WIKI SECTION -->
        <div class="wiki-wrapper p-3">
            <?php
            // GET WIKI SECTIONS
            $conn = new mysqli($servername, $username, $password, $dbname);
            $stmt = $conn->prepare("
                SELECT 
                    ws.id AS section_id,
                    ws.section_title,
                    ws.content,
                    ws.`order`,
                    w.id AS wiki_id,
                    w.poi_id
                FROM wiki_sections ws
                JOIN wiki w ON ws.wiki_id = w.id
                WHERE w.poi_id = ?
                ORDER BY ws.`order` ASC;
            ");

            $stmt->bind_param("i", $poiId);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if there are any results
            if ($result->num_rows > 0) {
                // Loop through the comments and display them
                while ($section = $result->fetch_assoc()) {
                    $sectionTitle = $section['section_title']; // Get the avatar from the users table
                    $content = $section['content'];
                    $sectionId = $section['section_id'];

                    echo '
                    <div class="wiki-section pb-3">
                        <div class="d-flex flex-column wiki-section-content">
                            <p class="section-title pb-2">section_' . $sectionTitle . '</p>
                            <textarea class="editor-textbox section-text ms-2" name="' . $sectionId . '">' . $content . '</textarea>
                        </div>
                    </div>';
                }

            } else {
                // If no wiki sections are found, display a message
                echo '<p>No Wiki for this page yet :/</p>';
            }

            $stmt->close();
            $conn->close();
            ?>
        </div>
    </form>
</div>

</body>
<script src="js/theme.js"></script>
<script src="js/togglemaplayer.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</html>

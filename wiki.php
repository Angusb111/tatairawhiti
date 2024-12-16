<?php
// Database connection details
$host = 'localhost';    
$db   = 'poi_database'; 
$user = 'root';          
$pass = '';              
$charset = 'utf8mb4';

// Create database connection
$conn = new mysqli($host, $user, $pass, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the POI ID is passed via GET
if (isset($_GET['poiId'])) {
    $poiId = $_GET['poiId'];
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

// Handle comment submission (if any)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    // Sanitize user input
    $user_name = htmlspecialchars($_POST['user_name']);
    $user_email = htmlspecialchars($_POST['user_email']);
    $comment = htmlspecialchars($_POST['comment']);

    // Save the comment to the database
    $conn = new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO comments (poi_id, user_name, user_email, comment) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $poiId, $user_name, $user_email, $comment);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    
    header("Location: " . $_SERVER['REQUEST_URI']); // Reload the page to show new comment
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($poi['name']); ?> | Discover Tairawhiti</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="css/master1.css">
    <link rel="stylesheet" href="css/wiki.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script src="js/googleauth.js"></script>
    <script src="js/buttonsinit.js"></script>
    
    <script>
        const poiData = <?php echo json_encode($poi, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>;

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelector('.info-title').textContent = poiData.name;
            document.querySelector('.info-description').innerHTML = poiData.description;
            document.querySelector('.wiki-image').src = `media/${poiData.image}`;
            const mapLink = document.querySelector('#googlemaps_button');
            mapLink.href = `https://www.google.com/maps?q=${poiData.latitude},${poiData.longitude}`;
        });
    </script>
</head>
<body class="wiki-page">
<?php include 'mini/header.php'; ?>
    <img class="wiki-image"></img>
    
    <div class="info-section">
        <h1 class="info-title"></h1>
        <p class="info-description"></p>
        <button class="p-2 accent-btn bg-button border-0" id="googlemaps_button" target="_blank">View on Google Maps</button>
    </div>

    <!-- Comment Section -->
    <div class="comment-section d-flex flex-column flex-grow justify-content-center">
        <h2>Comments</h2>
        <form method="POST" class="d-flex">
            <input type="hidden" id="user_name" name="user_name">
            <input type="hidden" id="user_email" name="user_email">
            <textarea id="comment-input" class="flex-grow-1" name="comment" placeholder="Write your comment..." required></textarea><br>
            <button type="submit" class="p-2 accent-btn bg-button border-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                </svg>
            </button>
        </form>
        <div id="comments-list">
            <?php
                // Fetch and display comments for this POI
                $conn = new mysqli($host, $user, $pass, $db);
                $stmt = $conn->prepare("SELECT * FROM comments WHERE poi_id = ? ORDER BY timestamp DESC");
                $stmt->bind_param("i", $poiId);
                $stmt->execute();
                $result = $stmt->get_result();

                while ($comment = $result->fetch_assoc()) {
                    echo '<div class="comment">';
                    echo '<div class="content">';
                    echo '<strong>' . htmlspecialchars($comment['user_name']) . '</strong><br>';
                    echo '<small>' . $comment['timestamp'] . '</small><br>';
                    echo '<p>' . htmlspecialchars($comment['comment']) . '</p>';
                    echo '</div></div>';
                }

                $stmt->close();
                $conn->close();
            ?>
        </div>
        
    </div>
</body>
<script src="js/theme.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</html>

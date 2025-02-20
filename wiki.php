<?php
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
    $conn = new mysqli($servername, $username, $password, $dbname);
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
    <link rel="icon" href="media/icon.svg">
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
            document.querySelector('#google-maps-link').href = `https://www.google.com/maps?q=${poiData.latitude},${poiData.longitude}`;
            document.querySelector('#apple-maps-link').href = `https://maps.apple.com/?q=${poiData.latitude},${poiData.longitude}`;
        });
    </script>
    
</head>
<body class="wiki-page">
<?php include 'mini/header.php'; ?>
<?php include 'mini/about.php'; ?>
<div class="info-wrapper">
    <img class="wiki-image"></img>
    
    <div class="info-section p-3">
        <h1 class="info-title"></h1>
        <p class="info-description"></p>
        <div class="d-flex flex-direction-row align-items-center pt-3">
            <a class="col-6 d-flex justify-content-center align-items-center p-2 wiki-external-map-link" id="google-maps-link" href="https://www.google.com/maps?q=${poi.latitude},${poi.longitude}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google me-2" viewBox="0 0 16 16">
                    <path d="M15.545 6.558a9.4 9.4 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.7 7.7 0 0 1 5.352 2.082l-2.284 2.284A4.35 4.35 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.8 4.8 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.7 3.7 0 0 0 1.599-2.431H8v-3.08z"/>
                </svg>
            Google Maps
            </a>
            <a class="col-6 d-flex justify-content-center align-items-center p-2 wiki-external-map-link" id="apple-maps-link" href="https://maps.apple.com/?q=${poi.latitude},${poi.longitude}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-apple me-2" viewBox="0 0 16 16">
                    <path d="M11.182.008C11.148-.03 9.923.023 8.857 1.18c-1.066 1.156-.902 2.482-.878 2.516s1.52.087 2.475-1.258.762-2.391.728-2.43m3.314 11.733c-.048-.096-2.325-1.234-2.113-3.422s1.675-2.789 1.698-2.854-.597-.79-1.254-1.157a3.7 3.7 0 0 0-1.563-.434c-.108-.003-.483-.095-1.254.116-.508.139-1.653.589-1.968.607-.316.018-1.256-.522-2.267-.665-.647-.125-1.333.131-1.824.328-.49.196-1.422.754-2.074 2.237-.652 1.482-.311 3.83-.067 4.56s.625 1.924 1.273 2.796c.576.984 1.34 1.667 1.659 1.899s1.219.386 1.843.067c.502-.308 1.408-.485 1.766-.472.357.013 1.061.154 1.782.539.571.197 1.111.115 1.652-.105.541-.221 1.324-1.059 2.238-2.758q.52-1.185.473-1.282"/>
                </svg>
            Apple Maps
            </a>
        </div>
    </div>

    <!-- Comment Section -->
    <div class="comment-section d-flex flex-column flex-grow justify-content-center">
        
        <form method="POST" class="d-flex">
            <input type="hidden" id="user_name" name="user_name">
            <input type="hidden" id="user_email" name="user_email">
            <textarea id="comment-input" class="flex-grow-1" name="comment" placeholder="Write your comment..." required></textarea><br>
            <button type="submit" class="comment-submit-button p-2 accent-btn bg-button border-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                </svg>
            </button>
        </form>
        <h2 class="pb-3 pt-5">Kōrero</h2>
        <div id="comments-list">
        <script>console.log(user.email);</script>
        <?php
// Fetch and display comments for this POI
$conn = new mysqli($servername, $username, $password, $dbname);

// Modified query to join the comments and users tables
$stmt = $conn->prepare("
    SELECT c.*, u.avatar 
    FROM comments c
    LEFT JOIN users u ON c.user_email = u.email
    WHERE c.poi_id = ? 
    ORDER BY c.timestamp DESC
");
$stmt->bind_param("i", $poiId);
$stmt->execute();
$result = $stmt->get_result();

// Check if there are any results
if ($result->num_rows > 0) {
    // Loop through the comments and display them
    while ($comment = $result->fetch_assoc()) {
        $avatar = $comment['avatar']; // Get the avatar from the users table
        $userName = $comment['user_name'];
        $timestamp = $comment['timestamp'];
        $commentText = $comment['comment'];

        $timestampUnix = strtotime($timestamp);
        $timestampUnix -= 43200; // CORRECTION- REMOVE LATER -12 hours

        $timeDiff = time() - $timestampUnix;
        // Calculate the "wordy" version of the timestamp
        if ($timeDiff < 60) {
            $timeAgo = "Just Now";
        } elseif ($timeDiff < 3600) {
            $timeAgo = floor($timeDiff / 60) . "m ago";
        } elseif ($timeDiff < 86400) {
            $timeAgo = floor($timeDiff / 3600) . "h ago";
        } elseif ($timeDiff < 604800) {
            $timeAgo = floor($timeDiff / 86400) . "d ago";
        } elseif ($timeDiff < 2592000) {
            $timeAgo = floor($timeDiff / 604800) . "w ago";
        } else {
            $timeAgo = floor($timeDiff / 31536000) . "y ago";
        }

        echo '
        <div class="comment">
            <div class="content">
                <div class="comment-top-row d-flex flex-row align-items-center justify-content-left">
                    <img class="comment-avatar" src="' . ($avatar ? $avatar : 'media/googlelogo.png') . '" referrerpolicy="no-referrer" alt="User Avatar"
                    onError="this.onerror=null; this.src=\'media/googlelogo.png\';" style="width: 40px; height: 40px; margin: 0px; border-radius: 8.5px;" />
                    <div class="comment-name-column d-flex flex-column">
                        <p class="comment-name">' . $userName . '</p>
                        <p class="comment-time">' . $timeAgo . '</p>
                    </div>
                </div>
                
                <p>' . $commentText . '</p>
            </div>
        </div>';
    }

} else {
    // If no comments are found, display a message
    echo '<p>Nothing here yet. Tīmata te Kōrero!</p>';
}

$stmt->close();
$conn->close();
?>



        </div>
        
    </div>
</div>
</body>
<script src="js/theme.js"></script>
<script src="js/togglemaplayer.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</html>

<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "interview_coaching";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch past sessions from the database
$sql = "SELECT * FROM session WHERE client_id = ?"; // Adjust the query according to your table structure
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("i", $_SESSION['user_id']); // Assuming user_id is stored in the session
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Past Sessions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('img4.jpg'); /* Specify the path to your background image */
            background-size: cover;
            background-repeat: no-repeat;
            color: #333;
            padding: 20px;
        }
        h1 {
            color: #444;
        }
        .session {
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .logout {
            display: block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #d9534f;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }
        .logout:hover {
            background-color: #c9302c;
        }
    </style>
</head>
<body>
    <h1>Past Sessions</h1>
    <?php
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo '<div class="session">';
            echo "Session ID: " . $row["session_id"] . "<br>";
            echo "Date: " . $row["date"] . "<br>";
            echo "Duration: " . $row["duration"] . " minutes<br>";
            echo "Notes: " . $row["notes"] . "<br>";
            echo "</div>";
        }
    } else {
        echo "No past sessions found.";
    }
    ?>
    <a class="logout" href="logout.php">Logout</a>
</body>
</html>

<?php
// Close connection
$stmt->close();
$conn->close();
?>

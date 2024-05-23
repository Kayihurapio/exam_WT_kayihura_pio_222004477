<?php
session_start();

// Check if user is logged in and role is client
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'client') {
    header("Location: login.php");
    exit;
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "interview_coaching";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get client's username
$client_username = isset($_SESSION['username']) ? $_SESSION['username'] : "";

// Retrieve notifications for clients
$sql = "SELECT * FROM notifications WHERE sender_role = 'coach'";
$result = $conn->query($sql);

$notifications = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $notifications[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('img4.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        a {
            text-decoration: none;
            color: #007bff;
            font-size: 18px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Client Dashboard 🚀</h2>
        <p>Welcome, <?php echo $client_username; ?>!</p>
        <h3>Notifications:</h3>
        <ul>
            <?php foreach ($notifications as $notification): ?>
                <li><?php echo $notification['message']; ?></li>
            <?php endforeach; ?>
        </ul>
        <ul>
            <li><a href="user_upcoming_sessions.php">View Upcoming Sessions 📅</a></li>
            <li><a href="view_past_sessions.php">View Past Sessions ⏪</a></li>
            <li><a href="provide_feedback.php">Provide Feedback 💬</a></li>
            <li><a href="make_payment.php">Make Payment 💳</a></li>
            <li><a href="create_profile.php">Update Profile 🛠️</a></li>
            <li><a href="profile.php">Profile 🛠️</a></li>
            <li><a href="logout.php">Logout 🚪</a></li>
            <li><a href="interaction.php">Interaction 🚪</a></li>
           <li><a href="view_mock_interview.php" class="btn">view Mock Interview 📅</a></li>

        </ul>
    </div>
</body>
</html>

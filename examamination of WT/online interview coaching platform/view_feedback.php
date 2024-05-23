<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "interview_coaching";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch feedback from the database
$sql = "SELECT * FROM feedback";
$result = $conn->query($sql);
$feedbacks = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $feedbacks[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <style>
        body {
            background-image: url('img4.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        h1 {
            text-align: center;
            color: #fff;
            margin-bottom: 20px;
        }

        table {
            width: 80%;
            margin: 0 auto;
            background-color: rgba(255, 255, 255, 0.8);
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        p {
            text-align: center;
            color: #fff;
        }
    </style>
</head>
<body>
    <h1>View Feedback</h1>
    <?php if (!empty($feedbacks)): ?>
        <table border="1">
            <tr>
                <th>Client ID</th> <!-- Assuming you also want to display the client ID -->
                <th>Feedback</th>
                <th>Rating</th>
            </tr>
            <?php foreach ($feedbacks as $feedback): ?>
                <tr>
                    <td><?php echo $feedback['client_id']; ?></td>
                    <td><?php echo $feedback['feedback_text']; ?></td>
                    <td><?php echo $feedback['rating']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No feedback available.</p>
    <?php endif; ?>
</body>
</html>

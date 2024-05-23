<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "interview_coaching";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch client profiles
$sql = "SELECT full_name, date_of_birth, address, phone_number, photo_path FROM client_profile";
$result = $conn->query($sql);

if ($result === false) {
    die("Error executing query: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Profiles</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background-image: url('img4.jpg');
            background-size: cover;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #555;
        }
        .profile {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .profile img {
            max-width: 100%;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Client Profiles</h1>
    <?php
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<div class='profile'>";
            echo "<h2>Profile:</h2>";
            echo "Full Name: " . $row["full_name"]. "<br>";
            echo "Date of Birth: " . $row["date_of_birth"]. "<br>";
            echo "Address: " . $row["address"]. "<br>";
            echo "Phone Number: " . $row["phone_number"]. "<br>";
            // Output the image directly in HTML
            if ($row["photo_path"]) {
                echo '<img src="' . $row["photo_path"] . '" alt="Photo"><br><br>';
            } else {
                echo "No photo available<br><br>";
            }
            echo "</div>";
        }
    } else {
        echo "No client profiles found.";
    }
    ?>
</body>
</html>

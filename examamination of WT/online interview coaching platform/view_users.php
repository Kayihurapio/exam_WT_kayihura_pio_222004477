<?php
// Connect to the database
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

// Query to fetch data from the view
$sql = "SELECT * FROM user";
$result = $conn->query($sql);

// Check if query execution was successful
if ($result === false) {
    echo "Error executing the query: " . $conn->error;
} else {
    if ($result->num_rows > 0) {
        // Prepare data for client
        $data = [];
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        // Send data to client
        echo "<!DOCTYPE html>
                <html lang='en'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>User Information</title>
                    <style>
                        body {
                            background-image: url('img4.jpg');
                            background-size: cover;
                            font-family: Arial, sans-serif;
                            color: white;
                        }
                        table {
                            width: 100%;
                            border-collapse: collapse;
                        }
                        th, td {
                            padding: 10px;
                            text-align: left;
                            border-bottom: 1px solid white;
                        }
                        th {
                            background-color: #333;
                        }
                        tr:nth-child(even) {
                            background-color: #555;
                        }
                        tr:nth-child(odd) {
                            background-color: #444;
                        }
                    </style>
                </head>
                <body>
                    <h1>User Information</h1>
                    <table>
                        <tr>
                            <th>User ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Date Created</th>
                        </tr>";
        foreach($data as $user) {
            echo "<tr>
                    <td>".$user["user_id"]."</td>
                    <td>".$user["username"]."</td>
                    <td>".$user["email"]."</td>
                    <td>".$user["role_name"]."</td>
                    <td>".$user["date_created"]."</td>
                  </tr>";
        }
        echo "</table>
              </body>
              </html>";
    } else {
        echo "0 results";
    }
}

$conn->close();
?>

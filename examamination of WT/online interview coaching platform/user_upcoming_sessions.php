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

// Check if the user is logged in
session_start();
if(isset($_SESSION["username"])) {
    $current_username = $_SESSION["username"];

    // Query to fetch upcoming sessions for the current user
    $sql = "SELECT session_id, coach.username AS coach_username, client.username AS client_username, `date`, duration, notes 
            FROM session 
            INNER JOIN user AS coach ON session.coach_id = coach.user_id 
            INNER JOIN user AS client ON session.client_id = client.user_id 
            WHERE `date` >= CURDATE() AND (coach.username = ? OR client.username = ?)
            ORDER BY `date` ASC";

    // Prepare and bind parameter
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $current_username, $current_username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there are upcoming sessions for the current user
    if ($result->num_rows > 0) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Upcoming Sessions</title>
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
            <h1>Upcoming Sessions</h1>
            <table>
                <tr>
                    <th>Session ID</th>
                    <th>Coach Username</th>
                    <th>Client Username</th>
                    <th>Date</th>
                    <th>Duration</th>
                    <th>Notes</th>
                </tr>
                <?php
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["session_id"] . "</td>
                            <td>" . $row["coach_username"] . "</td>
                            <td>" . $row["client_username"] . "</td>
                            <td>" . $row["date"] . "</td>
                            <td>" . $row["duration"] . "</td>
                            <td>" . $row["notes"] . "</td>
                          </tr>";
                }
                ?>
            </table>
        </body>
        </html>
        <?php
    } else {
        echo "No upcoming sessions for the current user.";
    }

    // Close statement and connection
    $stmt->close();
} else {
    echo "User not logged in.";
}

// Close connection
$conn->close();
?>

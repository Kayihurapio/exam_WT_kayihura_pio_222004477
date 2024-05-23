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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $coach_id = $_POST["coach_id"];
    $client_id = $_POST["client_id"];
    $date = $_POST["date"];
    $duration = $_POST["duration"];
    $notes = $_POST["notes"];

    // Prepare SQL statement
    $sql = "INSERT INTO session (coach_id, client_id, date, duration, notes) VALUES (?, ?, ?, ?, ?)";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisis", $coach_id, $client_id, $date, $duration, $notes);

    // Execute the query
    if ($stmt->execute()) {
        echo "Session added successfully.";
    } else {
        echo "Error adding session: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Session</title>
    <style>
        body {
            background-image: url('img4.jpg');
            background-size: cover;
            font-family: Arial, sans-serif;
            color: white;
        }
        form {
            max-width: 400px;
            margin: 50px auto;
            background: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
        }
        input[type="text"],
        input[type="date"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            display: inline-block;
            border: none;
            border-radius: 5px;
            background: #f2f2f2;
        }
        input[type="submit"] {
            background: #333;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h2>Add Session</h2>
        <label for="coach_id">Coach ID:</label>
        <input type="number" name="coach_id" required>
        <label for="client_id">Client ID:</label>
        <input type="number" name="client_id" required>
        <label for="date">Date:</label>
        <input type="date" name="date" required>
        <label for="duration">Duration (in minutes):</label>
        <input type="number" name="duration" required>
        <label for="notes">Notes:</label>
        <textarea name="notes" rows="4" cols="50"></textarea>
        <input type="submit" value="Add Session">
    </form>
</body>
</html>

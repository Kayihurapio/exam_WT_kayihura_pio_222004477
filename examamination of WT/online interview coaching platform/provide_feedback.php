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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $client_id = $_SESSION['user_id'];
    $feedback_text = isset($_POST['feedback_text']) ? $_POST['feedback_text'] : '';
    $rating = isset($_POST['rating']) ? $_POST['rating'] : '';

    // Insert feedback into database
    if (!empty($feedback_text) && !empty($rating)) {
        $sql = "INSERT INTO feedback (client_id, feedback_text, rating) VALUES ('$client_id', '$feedback_text', '$rating')";
        if ($conn->query($sql) === TRUE) {
            echo "Feedback provided successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Please fill in all required fields.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provide Feedback</title>
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

        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            font-weight: bold;
            margin-bottom: 10px;
        }

        textarea, input[type="number"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            margin-bottom: 15px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Provide Feedback</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="feedback_text">Feedback:</label>
            <textarea id="feedback_text" name="feedback_text" required></textarea>
            <label for="rating">Rating (out of 5):</label>
            <input type="number" id="rating" name="rating" min="1" max="5" required>
            <input type="submit" value="Submit Feedback">
        </form>
    </div>
</body>
</html>

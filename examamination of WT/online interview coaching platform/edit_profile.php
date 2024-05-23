<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>coach Profile </title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #7ed957; 
        }

        .container {
            max-width: 400px; 
            margin: 50px auto;
            padding: 10px;
            background-color: #ffffff; 
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
            color: #007bff; 
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center; 
        }

        label {
            margin-bottom: 3px;
            font-weight: bold;
            color: #333; 
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: calc(100% - 20px); 
            padding: 3px;
            margin-bottom: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 6px 12px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .profile-info {
            margin-top: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Database connection details
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

            // Prepare and bind parameters
            $stmt = $conn->prepare("INSERT INTO coach_profile (coach_name, coach_email, coach_bio) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $about);

            // Set parameters
            $name = $_POST['name'];
            $email = $_POST['email'];
            $about = $_POST['about'];

            // Execute prepared statement
            if ($stmt->execute()) {
                echo "<h2>User Profile</h2>";
                echo "<div class='profile-info'>";
                echo "<p><strong>Name:</strong> $name</p>";
                echo "<p><strong>Email:</strong> $email</p>";
                echo "<p><strong>About:</strong> $about</p>";
                echo "</div>";
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close statement and connection
            $stmt->close();
            $conn->close();
        }
        ?>
        <h2>EDIT PROFILE</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="about">About:</label>
            <textarea id="about" name="about" rows="4"></textarea>
            
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"],
        select,
        textarea,
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #4caf50;
            color: white;
            padding: 10px;
            margin-top: 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>User Registration</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        
        <label for="role">Role:</label><br>
        <select id="role" name="role" onchange="showFields()">
            <option value="user">Select Role</option>
            <option value="client">Client</option>
            <option value="coach">Coach</option>
        </select><br>

        <!-- Additional fields for client registration -->
        <div id="clientFields" style="display: none;">
            <label for="occupation">Occupation:</label><br>
            <input type="text" id="occupation" name="occupation"><br>
            
            <label for="goals">Goals:</label><br>
            <textarea id="goals" name="goals"></textarea><br>
            
            <label for="interests">Interests:</label><br>
            <textarea id="interests" name="interests"></textarea><br>
        </div>

        <!-- Additional fields for coach registration -->
        <div id="coachFields" style="display: none;">
            <label for="specialization">Specialization:</label><br>
            <input type="text" id="specialization" name="specialization"><br>
            
            <label for="bio">Bio:</label><br>
            <textarea id="bio" name="bio"></textarea><br>
            
            <label for="rating">Rating:</label><br>
            <input type="number" id="rating" name="rating" min="0" max="5" step="0.1"><br>
            
            <label for="availability">Availability:</label><br>
            <input type="text" id="availability" name="availability"><br>
        </div>
        
        <input type="submit" value="Register">
    </form>

    <?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "interview_coaching";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Fetching form data
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $role = $_POST['role'];

        // Inserting data into the user table
        $sql_user = "INSERT INTO `user` (`username`, `password`, `email`, `role_name`) VALUES ('$username', '$password', '$email', '$role')";

        if ($conn->query($sql_user) === TRUE) {
            // Get the user ID of the newly inserted user
            $user_id = $conn->insert_id;

            // Inserting data into the client or coach table based on the selected role
            if ($role === 'client') {
                $occupation = $_POST['occupation'];
                $goals = $_POST['goals'];
                $interests = $_POST['interests'];

                $sql_client = "INSERT INTO `client` (`user_id`, `occupation`, `goals`, `interests`) VALUES ('$user_id', '$occupation', '$goals', '$interests')";
                
                if ($conn->query($sql_client) !== TRUE) {
                    echo "Error inserting client data: " . $conn->error;
                }
            } elseif ($role === 'coach') {
                $specialization = $_POST['specialization'];
                $bio = $_POST['bio'];
                $rating = $_POST['rating'];
                $availability = $_POST['availability'];

                $sql_coach = "INSERT INTO `coach` (`user_id`, `specialization`, `bio`, `rating`, `availability`) VALUES ('$user_id', '$specialization', '$bio', '$rating', '$availability')";
                
                if ($conn->query($sql_coach) !== TRUE) {
                    echo "Error inserting coach data: " . $conn->error;
                }
            }

            echo "<p style='text-align:center;'>Registration successful!</p>";
        } else {
            echo "<p style='text-align:center;'>Error: " . $sql_user . "<br>" . $conn->error . "</p>";
        }
    }

    $conn->close();
    ?>

    <script>
        function showFields() {
            var role = document.getElementById('role').value;
            var clientFields = document.getElementById('clientFields');
            var coachFields = document.getElementById('coachFields');

            if (role === 'client') {
                clientFields.style.display = 'block';
                coachFields.style.display = 'none';
            } else if (role === 'coach') {
                clientFields.style.display = 'none';
                coachFields.style.display = 'block';
            } else {
                clientFields.style.display = 'none';
                coachFields.style.display = 'none';
            }
        }
    </script>
</body>
</html>

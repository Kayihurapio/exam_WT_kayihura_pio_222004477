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
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Validate username and password (add more validation if needed)
    $sql = "SELECT * FROM `user` WHERE `username`='$username' AND `password`='$password' AND `role_name`='$role'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // User found, store user details in session
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['role'] = $row['role_name'];
        $_SESSION['username'] = $row['username']; // Store username in session

        // Redirect to respective dashboard based on role
        if ($role === 'client') {
            header("Location: client_dashboard.php");
            exit;
        } elseif ($role === 'coach') {
            header("Location: coach_dashboard.php");
            exit;
        }
    } else {
        $login_error = "Invalid username, password, or role.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        <h2>Login</h2>
        <?php if(isset($login_error)) echo "<p style='color:red;'>$login_error</p>"; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br>
            
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br>
            
            <label for="role">Role:</label><br>
            <select id="role" name="role">
                <option value="client">Client</option>
                <option value="coach">Coach</option>
            </select><br>
            
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>

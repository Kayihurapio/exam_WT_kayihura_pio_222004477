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

// Fetch usernames from the user table
$usernames = array();
$sql = "SELECT user_id, username FROM user";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $usernames[$row["user_id"]] = $row["username"];
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if file upload is successful
    if ($_FILES["photo"]["error"] !== UPLOAD_ERR_OK) {
        die("File upload failed with error code: " . $_FILES["photo"]["error"]);
    }

    $user_id = $_POST["user_id"]; // User ID is selected from the dropdown
    $full_name = $_POST["full_name"];
    $date_of_birth = $_POST["date_of_birth"];
    $address = $_POST["address"];
    $phone_number = $_POST["phone_number"];

    // File upload code...
    $target_dir = "uploads/";
    $target_file = $_SERVER['DOCUMENT_ROOT'] . "/" . $target_dir . basename($_FILES["photo"]["name"]);

    // Ensure the uploads directory exists
    if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/" . $target_dir)) {
        mkdir($_SERVER['DOCUMENT_ROOT'] . "/" . $target_dir, 0777, true);
    }

    if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        die("Failed to move uploaded file.");
    }

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO client_profile (user_id, full_name, date_of_birth, address, phone_number, photo) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $user_id, $full_name, $date_of_birth, $address, $phone_number, $target_file);

    // Execute SQL statement
    if ($stmt->execute()) {
        echo "Profile created successfully.";
    } else {
        die("Error: " . $stmt->error);
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Client Profile</title>
</head>
<body>
    <h1>Create Client Profile</h1>
    <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="user_id">Username:</label><br>
        <select id="user_id" name="user_id" required>
            <?php foreach ($usernames as $user_id => $username) { ?>
                <option value="<?php echo $user_id; ?>"><?php echo $username; ?></option>
            <?php } ?>
        </select><br><br>
        
        <label for="full_name">Full Name:</label><br>
        <input type="text" id="full_name" name="full_name" required><br><br>

        <label for="date_of_birth">Date of Birth:</label><br>
        <input type="date" id="date_of_birth" name="date_of_birth" required><br><br>

        <label for="address">Address:</label><br>
        <input type="text" id="address" name="address"><br><br>

        <label for="phone_number">Phone Number:</label><br>
        <input type="text" id="phone_number" name="phone_number"><br><br>

        <label for="photo">Photo:</label><br>
        <input type="file" id="photo" name="photo" accept="image/*" required><br><br>

        <input type="submit" value="Create Profile">
    </form>
</body>
</html>

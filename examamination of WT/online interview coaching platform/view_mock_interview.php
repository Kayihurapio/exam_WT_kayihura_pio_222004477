

<!DOCTYPE html>
<html>
<head>
    <title>Interview Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('img4.jpg');
            background-size: cover;
            background-position: center;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .interview-card {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .interview-card h2 {
            margin-top: 0;
        }
        .interview-card p {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<?php
// Database connection parameters
$host = 'localhost';
$dbname = 'interview_coaching';
$username = 'root';
$password = '';

try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Set PDO to throw exceptions on error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Prepare SQL query
    $sql = "SELECT * FROM mockinterview";
    $stmt = $pdo->prepare($sql);
    
    // Execute the query
    $stmt->execute();
    
    // Fetch all rows as an associative array
    $interviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Output the fetched data
    foreach ($interviews as $interview) {
        echo '<div class="interview-card">';
        foreach ($interview as $column => $value) {
            echo "<p><strong>" . ucfirst($column) . ":</strong> " . $value . "</p>";
        }
        echo '</div>';
    }
} catch (PDOException $e) {
    // Handle database connection error
    echo "Error: " . $e->getMessage();
}
?>

</body>
</html>


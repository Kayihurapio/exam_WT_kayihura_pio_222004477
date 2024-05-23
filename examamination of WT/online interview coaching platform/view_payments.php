<?php
// Database connection parameters
$host = 'localhost';
$dbname = 'interview_coaching';
$username = 'root';
$password = '';

// Attempt database connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set PDO to throw exceptions on error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Fetch payment data from the database
$sql = "SELECT * FROM payment";
$stmt = $pdo->query($sql);
$payments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Payments</title>
    <style>
        body {
            background-image: url('img4.jpg');
            background-size: cover;
            font-family: Arial, sans-serif;
            padding: 20px;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Payment Information</h1>
    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>Amount</th>
                <th>Payment Date</th>
                <th>Payment Method</th>
                <th>Payment Code</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($payments as $payment): ?>
            <tr>
                <td><?php echo $payment['user_id']; ?></td>
                <td><?php echo $payment['amount']; ?></td>
                <td><?php echo $payment['payment_date']; ?></td>
                <td><?php echo $payment['payment_method']; ?></td>
                <td><?php echo $payment['payment_code']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

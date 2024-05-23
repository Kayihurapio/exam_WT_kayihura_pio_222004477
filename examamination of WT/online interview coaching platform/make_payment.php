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

// Start the session
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form data
    $amount = $_POST['amount'];
    // Check if 'method' key exists in $_POST before accessing it
    $method = isset($_POST['method']) ? $_POST['method'] : null;
    
    // Perform basic validation (you might want to add more robust validation)
    if (empty($amount) || empty($method)) {
        echo "Please fill in all required fields.";
    } else {
        // Insert payment record into the database
        $payment_code = generate_payment_code();
        $sql = "INSERT INTO payment (user_id, amount, payment_date, payment_method, payment_code) 
                VALUES (:user_id, :amount, NOW(), :method, :payment_code)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'user_id' => isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null, // Check if $_SESSION['user_id'] is set
            'amount' => $amount,
            'method' => $method,
            'payment_code' => $payment_code
        ]);
        
        // Check if payment record was inserted successfully
        if ($stmt->rowCount() > 0) {
            echo "Payment successful!";
        } else {
            echo "Error: Payment could not be processed.";
        }
    }
}

// Fetch payment codes from the database
$sql = "SELECT payment_code FROM payment WHERE user_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['user_id' => isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null]); // Check if $_SESSION['user_id'] is set
$paymentCodes = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Function to generate a unique payment code
function generate_payment_code() {
    // Generate a random alphanumeric code
    // For this task, we'll return the fixed code
    return "241769";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment System</title>
    <style>
        body {
            background-image: url('img4.jpg');
            background-size: cover;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            text-align: center;
            color: #333;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Make a Payment</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="amount">Amount:</label>
            <input type="text" id="amount" name="amount" required><br><br>
            <label for="method">Payment Method:</label>
            <select id="method" name="method" required>
                <option value="Credit Card">Credit Card</option>
                <option value="Mobile Money">Mobile Money</option>
                <option value="Bank Transfer">Bank Transfer</option>
            </select><br><br>
            <input type="submit" value="Submit Payment">
        </form>

        <h2>Payment Codes</h2>
        <ul>
           <?php 
            $uniquePaymentCodes = array_unique($paymentCodes); // Get unique payment codes
            foreach ($uniquePaymentCodes as $code): ?>
                <!-- Display the virtual message for each unique payment code -->
                <li>Pay to kayihura pio: <?php echo $code; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>

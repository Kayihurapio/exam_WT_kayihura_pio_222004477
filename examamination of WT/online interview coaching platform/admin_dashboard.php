<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body{
         font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('PIO.jpeg');
            background-size: cover;
            background-position: center;
            display:flex;
            justify-content: center;
            align-items: center;
            height:200vh;
        }
 {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 700px;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        h2 {
            text-align: center;
            margin-bottom: 16px;
        }

        ul {
            list-style-type: none;
            padding: 0;
            text-align: center;
        }

        li {
            margin-bottom: 10px;
        }

        .btn {
            display: inline-block;
            padding: 6px 32px;
            background-color:blue;
            color:white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 3s ease;
        }

        .btn:hover {
            background-color:yellow;
        }

        .btn:active {
            transform: translateY(1px);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Dashboard 🚀</h2>
        <ul>
            <li><a href="view_users.php" class="btn">View All Users 👨‍💼</a></li>
        <li><a href="view_schedule_mock_interview.php" class="btn">view Mock Interview 📅</a></li>
            <li><a href="send_notification.php" class="btn">Send Notification 📩</a></li>
            <li><a href="view_payments.php" class="btn">View All Payments 💳</a></li>
            <li><a href="add_sessions.php" class="btn">Add Sessions 🎓</a></li>
            <li><a href="upcoming_session.php" class="btn">upcoming New Session 🕒</a></li>
             <li><a href="view_feedback.php">View Feedback 💬</a></li>
            
        </ul>
    </div>

    <!-- Image -->
    <img src="img4.jpg" alt="Dashboard Image" style="position: absolute; bottom: 20px; right: 20px; max-width: 200px; border-radius: 5px;">
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Mock Interview Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 15px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            color: #333333;
            font-size: 1.5em;
        }

        table {
            width: 100%;
        }

        table th, table td {
            padding: 8px;
            border-bottom: 1px solid #cccccc;
            text-align: left;
        }

        input, select, textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #cccccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 0.9em;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Mock Interview Form</h2>
        <form action="" method="POST">
            <table>
                <tr>
                    <th><label for="candidate_name">Candidate Name:</label></th>
                    <td><input type="text" id="candidate_name" name="candidate_name" required></td>
                </tr>
                <tr>
                    <th><label for="position">Position:</label></th>
                    <td><input type="text" id="position" name="position" required></td>
                </tr>
                <tr>
                    <th><label for="interview_date">Interview Date:</label></th>
                    <td><input type="date" id="interview_date" name="interview_date" required></td>
                </tr>
                <tr>
                    <th><label for="interview_type">Interview Type:</label></th>
                    <td>
                        <select id="interview_type" name="interview_type" required>
                            <option value="In-Person">In-Person</option>
                            <option value="Video">Video</option>
                            <option value="Phone">Phone</option>
                        </select>
                    </td>
                </tr>
                <!-- Add more rows for other form fields -->
            </table>
            <input type="submit" value="Submit">
        </form>
   


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO MockInterview (candidate_name, position, interview_date, interview_type, interview_duration, interviewer_names, agenda, resume_review, technical_questions, behavioral_questions, situational_questions, skills_assessment, cultural_fit, candidate_questions, feedback_next_steps, closing_remarks, interviewer_notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssisisssssssssss", $candidate_name, $position, $interview_date, $interview_type, $interview_duration, $interviewer_names, $agenda, $resume_review, $technical_questions, $behavioral_questions, $situational_questions, $skills_assessment, $cultural_fit, $candidate_questions, $feedback_next_steps, $closing_remarks, $interviewer_notes);

    // Set parameters and execute
    $candidate_name = $_POST['candidate_name'];
    $position = $_POST['position'];
    $interview_date = $_POST['interview_date'];
    $interview_type = $_POST['interview_type'];
    $interview_duration = $_POST['interview_duration'];
    $interviewer_names = $_POST['interviewer_names'];
    $agenda = $_POST['agenda'];
    $resume_review = $_POST['resume_review'];
    $technical_questions = $_POST['technical_questions'];
    $behavioral_questions = $_POST['behavioral_questions'];
    $situational_questions = $_POST['situational_questions'];
    $skills_assessment = $_POST['skills_assessment'];
    $cultural_fit = $_POST['cultural_fit'];
    $candidate_questions = $_POST['candidate_questions'];
    $feedback_next_steps = $_POST['feedback_next_steps'];
    $closing_remarks = $_POST['closing_remarks'];
    $interviewer_notes = $_POST['interviewer_notes'];

    if ($stmt->execute()) {
        echo "<p>New record created successfully</p>";
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>
    </div>
</body>
</html>

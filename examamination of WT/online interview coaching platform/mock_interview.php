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
 <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('img4.jpg'); /* Replace 'img4.jpg' with your image path */
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 15px;
            background-color: rgba(255, 255, 255, 0.8); /* Adjust the opacity if necessary */
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

    <div class="container">
        <h2>Mock Interview Form</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <table>
                <tr>
                    <th><label for="candidate_name">Interviewee Name:</label></th>
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
                <tr>
                    <th><label for="interview_duration">Interview Duration (minutes):</label></th>
                    <td><input type="number" id="interview_duration" name="interview_duration" required></td>
                </tr>
                <tr>
                    <th><label for="interviewer_names">Interviewer Names:</label></th>
                    <td><input type="text" id="interviewer_names" name="interviewer_names"></td>
                </tr>
                <tr>
                    <th><label for="resume_review">Resume Review:</label></th>
                    <td><textarea id="resume_review" name="resume_review"></textarea></td>
                </tr>
                <tr>
                    <th><label for="technical_questions">Technical Questions:</label></th>
                    <td><textarea id="technical_questions" name="technical_questions"></textarea></td>
                </tr>
                <tr>
                    <th><label for="behavioral_questions">Behavioral Questions:</label></th>
                    <td><textarea id="behavioral_questions" name="behavioral_questions"></textarea></td>
                </tr>
                <tr>
                    <th><label for="situational_questions">Situational Questions:</label></th>
                    <td><textarea id="situational_questions" name="situational_questions"></textarea></td>
                </tr>
                <tr>
                    <th><label for="skills_assessment">Skills Assessment:</label></th>
                    <td><textarea id="skills_assessment" name="skills_assessment"></textarea></td>
                </tr>
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
    $stmt = $conn->prepare("INSERT INTO MockInterview (candidate_name, position, interview_date, interview_type, interview_duration, interviewer_names, resume_review, technical_questions, behavioral_questions, situational_questions, skills_assessment) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssissssss", $candidate_name, $position, $interview_date, $interview_type, $interview_duration, $interviewer_names, $resume_review, $technical_questions, $behavioral_questions, $situational_questions, $skills_assessment);

    // Set parameters and execute
    $candidate_name = isset($_POST['candidate_name']) ? $_POST['candidate_name'] : '';
    $position = isset($_POST['position']) ? $_POST['position'] : '';
    $interview_date = isset($_POST['interview_date']) ? $_POST['interview_date'] : '';
    $interview_type = isset($_POST['interview_type']) ? $_POST['interview_type'] : '';
    $interview_duration = isset($_POST['interview_duration']) ? $_POST['interview_duration'] : '';
    $interviewer_names = isset($_POST['interviewer_names']) ? $_POST['interviewer_names'] : '';
    $resume_review = isset($_POST['resume_review']) ? $_POST['resume_review'] : '';
    $technical_questions = isset($_POST['technical_questions']) ? $_POST['technical_questions'] : '';
    $behavioral_questions = isset($_POST['behavioral_questions']) ? $_POST['behavioral_questions'] : '';
    $situational_questions = isset($_POST['situational_questions']) ? $_POST['situational_questions'] : '';
    $skills_assessment = isset($_POST['skills_assessment']) ? $_POST['skills_assessment'] : '';

    // Validate required fields
    if (!empty($candidate_name) && !empty($position) && !empty($interview_date) && !empty($interview_type) && !empty($interview_duration)) {
        if ($stmt->execute()) {
            echo "<p>New record created successfully</p>";
        } else {
            echo "<p>Error: " . $stmt->error . "</p>";
        }
    } else {
        echo "<p>All required fields must be filled out</p>";
    }

    $stmt->close();
    $conn->close();
}
?>

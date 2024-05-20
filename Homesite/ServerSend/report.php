<?php
// Connection details
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'brainbox';

// Create a database connection
$mysqli = new mysqli($host, $username, $password, $database);

// Check the connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Assuming you have received question_id, user_id, and report_txt through POST method
$question_id = $_POST['questionid'] ?? null;
$user_id = $_POST['userid'] ?? null;
$report_txt = $_POST['report_txt'] ?? null;

// Validate input data
if ($question_id === null || $user_id === null || $report_txt === null) {
    die("Invalid input data.");
}

// Check if the user exists
$user_check_sql = "SELECT user_id FROM user WHERE user_id = ?";
$user_check_stmt = $mysqli->prepare($user_check_sql);

if ($user_check_stmt) {
    $user_check_stmt->bind_param("i", $user_id);
    $user_check_stmt->execute();
    
    $user_check_stmt->store_result();
    
    if ($user_check_stmt->num_rows == 0) {
        die("Invalid user_id. User does not exist.");
    }

    $user_check_stmt->close();
} else {
    die("Error in preparing user check statement: " . $mysqli->error);
}

// Insert data into the report table
$report_status = true;
$report_date = date('Y-m-d');

$sql = "INSERT INTO report (user_id, question_id, report_txt, report_status, report_date) 
        VALUES (?, ?, ?, ?, ?)";

$stmt = $mysqli->prepare($sql);

if ($stmt) {
    $stmt->bind_param("iisss", $user_id, $question_id, $report_txt, $report_status, $report_date);
    $stmt->execute();

    // Check for success
    if ($stmt->affected_rows > 0) {
        header("Location: http://localhost/BrainBox/website/homesite/index..php");
    } else {
        echo "Failed to submit report. Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error in preparing statement: " . $mysqli->error;
}

// Close the database connection
$mysqli->close();
?>

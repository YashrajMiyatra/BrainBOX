<?php
session_start();


// Database connection details
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

// Get user information from the session
$user_id = $_SESSION['user_id'];
$stmt = $mysqli->prepare("SELECT username FROM user WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
    $username = $user_data['username'];
} else {
    // Handle the case where user information is not found
    header("Location: C:\xampp\htdocs\BrainBox\Website\Homesite\index.html");
    exit();
}

$stmt->close();

// Process the submitted answer
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $response_text = $_POST['answer_txt'];
    $question_id = $_POST['question_id']; // Assuming you have a hidden input in your form for question_id

    // Insert the answer into the database
    $stmt = $mysqli->prepare("INSERT INTO responses (user_id, question_id, response_txt, response_date) VALUES (?, ?, ?,  NOW())");
    if (!$stmt) {
        die("Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error);
    }
    
    // Continue with bind_param and execution
    $stmt->bind_param("iis", $user_id, $question_id, $response_text);

    if ($stmt->execute()) {
        header("Location: http://localhost/BrainBox/website/homesite/Answer.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Close the connection
$mysqli->close();
?>

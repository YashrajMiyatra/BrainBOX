<?php
// starredreceived.php

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if user is logged in
    session_start();
    if (!isset($_SESSION['user_id'])) {
        // Handle the case where the user is not logged in
        echo json_encode(['error' => 'User not logged in']);
        exit();
    }

    // Get user_id from the session
    $user_id = $_SESSION['user_id'];

    // Get the list of questions that the user has starred
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'brainbox';

    // Create a database connection
    $mysqli = new mysqli($host, $username, $password, $database);

    // Check the connection
    if ($mysqli->connect_error) {
        echo json_encode(['error' => 'Connection failed: ' . $mysqli->connect_error]);
        exit();
    }

    // Fetch starred questions for the user
    $stmt = $mysqli->prepare("SELECT question_id FROM starred WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $starredQuestions = [];
    while ($row = $result->fetch_assoc()) {
        $starredQuestions[] = $row['question_id'];
    }

    // Send the list of starred questions to index.php
    echo json_encode(['success' => true, 'starredQuestions' => $starredQuestions]);

    // Close the database connections
    $stmt->close();
    $mysqli->close();

    // Use cURL to send the same data to starred.php through AJAX
    $starredUrl = 'C:\xampp\htdocs\BrainBox\Website\Homesite\starred.php';  // Replace with the actual URL of starred.php
    $starredData = [
        'user_id' => $user_id,
        'starredQuestions' => $starredQuestions
    ];

    $ch = curl_init($starredUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($starredData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
} else {
    // Handle the case where the request method is not POST
    echo json_encode(['error' => 'Invalid request method']);
}
?>

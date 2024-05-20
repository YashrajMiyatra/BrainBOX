<?php
// starredsend.php

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if user is logged in
    session_start();
    if (!isset($_SESSION['user_id'])) {
        // Handle the case where the user is not logged in
        echo json_encode(['error' => 'User not logged in']);
        exit();
    }

    // Get user_id and question_id from the POST data
    $user_id = $_SESSION['user_id'];
    $question_id = filter_input(INPUT_POST, 'question_id', FILTER_VALIDATE_INT);

    // Validate question_id
    if ($question_id === false || $question_id === null) {
        echo json_encode(['error' => 'Invalid question_id']);
        exit();
    }

    // Database connection details (replace with your actual credentials)
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

    // Check if the user has already starred the question
    $stmtCheck = $mysqli->prepare("SELECT * FROM starred WHERE user_id = ? AND question_id = ?");
    $stmtCheck->bind_param("ii", $user_id, $question_id);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();

    if (isset($_POST['check']) && $_POST['check'] == 'true') {
        // Check if the user has already starred the question
        if ($resultCheck->num_rows > 0) {
            echo json_encode(['error' => 'Question already starred by the user']);
        } else {
            echo json_encode(['success' => 'User has not starred the question yet']);
        }
    } else {
        // Handle the click case (toggling star)
        if ($resultCheck->num_rows > 0) {
            // User has already starred the question, handle as needed
            echo json_encode(['error' => 'Question already starred by the user']);
        } else {
            // User has not starred the question yet, proceed with toggling

            // Prepare and execute the query to insert data into the 'starred' table
            $stmt = $mysqli->prepare("INSERT INTO starred (user_id, question_id, star_type) VALUES (?, ?, 1)");
            $stmt->bind_param("ii", $user_id, $question_id);

            if ($stmt->execute()) {
                // Successfully inserted into the database
                echo json_encode(['success' => 'Starred successfully']);
            } else {
                // Failed to insert into the database
                echo json_encode(['error' => 'Failed to star']);
            }

            // Close the statement for inserting data
            $stmt->close();
        }
    }

    // Close the database connections
    $stmtCheck->close();
    $mysqli->close();
} else {
    // Handle the case where the request method is not POST
    echo json_encode(['error' => 'Invalid request method']);
}
?>

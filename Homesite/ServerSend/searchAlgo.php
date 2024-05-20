<?php
// searchAlgo.php

// Start the session
session_start();

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form was submitted using POST method

    // Retrieve the search query from the POST data
    $searchQuery = isset($_POST['search']) ? $_POST['search'] : '';

    // Perform the search in the database
    $searchQuery = $mysqli->real_escape_string($searchQuery);

    // Step 1: Search in question_txt column
    $sqlText = "SELECT question_id, question_txt, que_keyword 
                FROM question 
                WHERE MATCH(question_txt) AGAINST ('$searchQuery' IN BOOLEAN MODE)";

    $resultText = $mysqli->query($sqlText);
    if ($resultText === false) {
        die("Text Search Query failed: " . $mysqli->error);
    }

    // Process the results and store question IDs in an array
    $matchedQuestionIDsText = array();
    while ($row = $resultText->fetch_assoc()) {
        $matchedQuestionIDsText[] = $row['question_id'];
    }

    // Step 2: Search in que_keyword column
    $sqlJson = "SELECT question_id, question_txt, que_keyword 
                FROM question 
                WHERE JSON_SEARCH(que_keyword, 'one', '%$searchQuery%') IS NOT NULL";

    $resultJson = $mysqli->query($sqlJson);
    if ($resultJson === false) {
        die("JSON Search Query failed: " . $mysqli->error);
    }

    // Process the results and store question IDs in an array
    $matchedQuestionIDsJson = array();
    while ($row = $resultJson->fetch_assoc()) {
        $matchedQuestionIDsJson[] = $row['question_id'];
    }

    // Merge the results from both searches
    $mergedQuestionIDs = array_merge($matchedQuestionIDsText, $matchedQuestionIDsJson);

    // Remove duplicates
    $uniqueQuestionIDs = array_unique($mergedQuestionIDs);
    // echo json_encode($uniqueQuestionIDs);

    // // Store the result in the session
    $_SESSION['search_response'] = array(
        'status' => 'success',
        'matched_question_ids' => $uniqueQuestionIDs
    );

    // Redirect to a result page or do further processing
    header("Location: /BrainBox/Website/Homesite/index.php");
    // exit();
}
?>

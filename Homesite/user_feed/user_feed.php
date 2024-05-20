<?php
include 'connection files/conn.php';

// SQL query to fetch interest for a specific user_id
$sqlInterest = "SELECT interest FROM users WHERE user_id = $_SESSION[user_id]";

// Execute the SQL query
$interestResult = $mysqli->query($sqlInterest);

// Initialize a variable to store the result
$userInterest = null;

// Check if there is a row in the result set
if ($interestResult->num_rows > 0) {
    // Fetch the row and store the interest value
    $row = $interestResult->fetch_assoc();
    $userInterest = $row['interest'];
}

// SQL query to fetch JSON data for user_action for a specific user_id
$sqlAction = "SELECT action_data FROM user_action WHERE user_id = $_SESSION[user_id]";

// Execute the SQL query
$actionResult = $mysqli->query($sqlAction);

// Initialize an array to store the result
$userActionResult = array();

// Check if there are rows in the result set
if ($actionResult->num_rows > 0) {
    // Fetch each row and store the values in the array
    while ($row = $actionResult->fetch_assoc()) {
        // Decode the JSON data
        $jsonData = json_decode($row['action_data'], true);
        $userActionResult[] = $jsonData;
    }
}

// SQL query to fetch JSON data for starred table for a specific user_id
$starredQuery = "SELECT starred_data FROM starred WHERE user_id = $_SESSION[user_id]";

// Execute the starred query
$starredResult = $mysqli->query($starredQuery);

// Initialize an array to store the result
$queKeywordResult = array();

// Check if there are rows in the result set
if ($starredResult->num_rows > 0) {
    // Fetch each row and store the values in the array
    while ($row = $starredResult->fetch_assoc()) {
        // Decode the JSON data
        $jsonData = json_decode($row['starred_data'], true);
        $queKeywordResult[] = $jsonData['que_keyword'];
    }
}

// Create main response array
$mainResponse = array(
    'user_interest_response' => array(
        'status' => 'success',
        'user_interest' => $userInterest
    ),
    'user_action_response' => array(
        'status' => 'success',
        'user_action_result' => $userActionResult
    ),
    'starred_response' => array(
        'status' => 'success',
        'que_keyword_result' => $queKeywordResult
    )
);

// Encode the response array to JSON format
$mainResponseJSON = json_encode($mainResponse);

// Output the JSON response
echo $mainResponseJSON;
?>

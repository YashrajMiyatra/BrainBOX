<?php
// // ServerSend/Options.php - Server-side script to handle AJAX requests

// // Database connection details
// $host = 'localhost';
// $username = 'root';
// $password = 'shivamask@lancer';
// $database = 'brainbox';

// // Create a database connection
// $mysqli = new mysqli($host, $username, $password, $database);

// // Check the connection
// if ($mysqli->connect_error) {
//     die("Connection failed: " . $mysqli->connect_error);
// }

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Get the keyword from the AJAX request
//     $keyword = $_POST["ajaxKeyword"];

//     // Fetch suggestions from the database
//     $suggestions = fetchSuggestionsFromDatabase($mysqli, $keyword);

//     // Send the suggestions as a JSON response
//     header('Content-Type: application/json');
//     echo json_encode($suggestions);
// }

// function fetchSuggestionsFromDatabase($mysqli, $keyword) {
//     // Using prepared statement to prevent SQL injection
//     $stmt = $mysqli->prepare("SELECT Keyword_txt FROM Keyword_table WHERE Keyword_txt LIKE ?");

//     // Add wildcard '%' to match any part of the suggestion
//     $likeKeyword = "%" . $keyword . "%";

//     if (!$stmt) {
//         die('Error in SQL query: ' . $mysqli->error); // Check for errors in preparing the statement
//     }

//     $stmt->bind_param("s", $likeKeyword);

//     // Execute the statement
//     $stmt->execute();

//     if ($stmt->error) {
//         die('Error in execution: ' . $stmt->error); // Check for errors in executing the statement
//     }

//     // Bind the result
//     $stmt->bind_result($suggestion);

//     $result = [];

//     // Fetch suggestions
//     while ($stmt->fetch()) {
//         $result[] = $suggestion;
//     }

//     // Close the statement
//     $stmt->close();

//     return $result;
// }

// $mysqli->close();
?>

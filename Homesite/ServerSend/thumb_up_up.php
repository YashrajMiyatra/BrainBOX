<?php
// thumb_up.php

// Assuming you have a database connection already established
// Replace these values with your actual database credentials
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

$questionId = (int)$_POST['question_id'];
$userId = (int)$_POST['user_id'];
$like_id = (int)$_POST['like_id'];


// Check if the user has already liked the question
$checkLikeSql = "SELECT like_type FROM question_likes WHERE question_id = ? AND user_id = ?";
$checkLikeStmt = $mysqli->prepare($checkLikeSql);

if ($checkLikeStmt === false) {
    echo json_encode(['status' => 'error', 'message' => 'Error preparing check statement: ' . $mysqli->error]);
} else {
    // Bind parameters
    $checkLikeStmt->bind_param("ii", $questionId, $userId);

    // Execute the check statement
    $checkLikeStmt->execute();

    // Bind result variable
    $checkLikeStmt->bind_result($likeType);

    // Fetch the result
    $checkLikeStmt->fetch();

    $checkLikeStmt->close();

    // Check if the user has already liked the question
    if ($likeType === 1) {
        // User has already liked the question, set the span color to blue
        echo json_encode(['status' => 'already_liked', 'already_liked' => true]);
    } else {
        // User has not liked the question, proceed to insert the like
        // Insert into question_likes table using prepared statement
        $updateLikeSql = "UPDATE question_likes SET like_type = 1 WHERE like_id = ?";
        $updateLikeStmt = $mysqli->prepare($updateLikeSql);

        if ($updateLikeStmt === false) {
            echo json_encode(['status' => 'error', 'message' => 'Error preparing statement: ' . $mysqli->error]);
        } else {
            // Bind parameters
            $updateLikeStmt->bind_param("i", $like_id);

            // Execute the statement
            $executeResult = $updateLikeStmt->execute();

            if ($executeResult === false) {
                echo json_encode(['status' => 'error', 'message' => 'Error executing statement: ' . $updateLikeStmt->error]);
            } else {
                // Update question table - increment like_by, click, and view_count
                $updateQuestionSql = "UPDATE question SET like_count = like_count + 1, click = click + 1, dislike_count = dislike_count - 1 WHERE question_id = ?";
                $updateQuestionStmt = $mysqli->prepare($updateQuestionSql);

                if ($updateQuestionStmt === false) {
                    echo json_encode(['status' => 'error', 'message' => 'Error preparing update statement: ' . $mysqli->error]);
                } else {
                    // Bind parameters
                    $updateQuestionStmt->bind_param("i", $questionId);

                    // Execute the update statement
                    $updateResult = $updateQuestionStmt->execute();

                    if ($updateResult === false) {
                        echo json_encode(['status' => 'error', 'message' => 'Error executing update statement: ' . $updateQuestionStmt->error]);
                    } else {
                        echo json_encode(['status' => 'success' , 'q_id' => $questionId , 'u_id' => $userId]);
                    }

                    $updateQuestionStmt->close();
                }
            }

           $updateLikeStmt->close();
        }
    }
}

// Close the database connection
$mysqli->close();
?>

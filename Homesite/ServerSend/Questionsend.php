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

// Fetch user data from the database
$user_id = $_SESSION['user_id'];
$stmt = $mysqli->prepare("SELECT * FROM user WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if the user exists
if ($result->num_rows > 0) {
    // User found, fetch data
    $user_data = $result->fetch_assoc();
    $username = $user_data['username'];
    $email = $user_data['email'];

    // Store user information in the session
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
} else {
    // User not found, redirect to index.html
    redirectTo("index.html");
}

$stmt->close();

// Process the submitted question
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question_txt = $_POST['question_txt'];

    // Initialize $que_snapshot_img
    $que_snapshot_img = '';

    if (isset($_FILES['que_snapshot_img']) && $_FILES['que_snapshot_img']['error'] === UPLOAD_ERR_OK) {
        $imgTmpPath = $_FILES['que_snapshot_img']['tmp_name']; // Temporary file path
        $uploadDir = 'C:/xampp/htdocs/BrainBox/Website/Homesite/uploads/snapshot/';
        $imgDestination = $uploadDir . $_FILES['que_snapshot_img']['name'];

        if (move_uploaded_file($imgTmpPath, $imgDestination)) {
            // Store the image URL in $que_snapshot_img
            $que_snapshot_img = 'uploads/snapshot/' . $_FILES['que_snapshot_img']['name'];
            echo "Image uploaded successfully. Image URL: " . $que_snapshot_img;
        } else {
            echo "Error moving the uploaded image.";
        }
    } else {
        echo "Error uploading image. Please check if the image was uploaded properly.";
    }

    // Check if 'keywords' is set in $_POST
    $keywordsArray = isset($_POST['keywords']) ? json_decode($_POST['keywords'], true) : [];

    // Check if the user has not entered any keywords
    if (empty($keywordsArray)) {
        // Set default keywords
        $keywordsArray = ["problem", "Need Help", "Solution"];
    }

    // Ensure $keywordsArray is an array
    if (is_array($keywordsArray)) {
        // Re-index the array after filtering
        $filtered_keywords = json_encode(array_values($keywordsArray));

        // Original question insertion query
        $stmt = $mysqli->prepare("INSERT INTO question (question_txt, que_keyword, user_id, que_snapshot_img, question_date) VALUES (?, ?, ?, ?, NOW())");

        // Check if the prepare statement was successful
        if ($stmt === false) {
            die("Error in prepare: " . $mysqli->error);
        }

        // Bind parameters
        $stmt->bind_param("ssss", $question_txt, $filtered_keywords, $user_id, $que_snapshot_img);

        // Execute the query
        if (executeStatement($stmt)) {
            // Additional actions related to the user_action table
            $checkStmt = $mysqli->prepare("SELECT * FROM user_action WHERE user_id = ? AND user_action_date = CURDATE()");

            // Check if the prepare statement was successful
            if ($checkStmt === false) {
                die('Error in preparing the statement: ' . $mysqli->error);
            }

            // Bind parameters
            $checkStmt->bind_param("i", $user_id);

            // Execute the query
            if (executeStatement($checkStmt)) {
                $checkResult = $checkStmt->get_result();

                if ($checkResult->num_rows > 0) {
                    // Row exists, update the existing row in user_action
                    $updateStmt = $mysqli->prepare("UPDATE user_action SET que_keyword = CONCAT(que_keyword, ?) WHERE user_id = ? AND user_action_date = CURDATE()");
                    // Check if the prepare statement was successful
                    if ($updateStmt === false) {
                        die('Error in preparing the statement: ' . $mysqli->error);
                    }

                    // Bind parameters
                    $updateStmt->bind_param("si", $filtered_keywords, $user_id);

                    // Execute the query
                    if (!executeStatement($updateStmt)) {
                        echo "Error updating user_action: " . $updateStmt->error;
                    }
                } else {
                    // Row does not exist, insert a new row into user_action
                    $insertStmt = $mysqli->prepare("INSERT INTO user_action (user_id, que_keyword, user_action_date) VALUES (?, ?, CURDATE())");

                    // Check if the prepare statement was successful
                    if ($insertStmt === false) {
                        die('Error in preparing the statement: ' . $mysqli->error);
                    }

                    // Bind parameters
                    $insertStmt->bind_param("is", $user_id, $filtered_keywords);

                    // Execute the query
                    if (!executeStatement($insertStmt)) {
                        echo "Error inserting into user_action: " . $insertStmt->error;
                    }
                }
            } else {
                echo "Error executing user_action select query: " . $checkStmt->error;
            }

            // Redirect to index.php
            redirectTo("http://localhost/BrainBox/website/homesite/index.php");
        } else {
            echo "Error executing question insert query: " . $stmt->error;
        }

        // Close the statements
        $stmt->close();
        $checkStmt->close();
        if (isset($updateStmt)) {
            $updateStmt->close();
        }
        if (isset($insertStmt)) {
            $insertStmt->close();
        }
    } else {
        echo "Error: Invalid keywords format";
    }
}

// Close the connection
$mysqli->close();

// Function to execute a prepared statement
function executeStatement($stmt) {
    if ($stmt->execute()) {
        return true;
    } else {
        echo "Error executing statement: " . $stmt->error;
        return false;
    }
}

// Function to redirect to a specified location
function redirectTo($location) {
    header("Location: C:/xampp/htdocs/BrainBox/Website/Homesite/{$location}");
    exit();
}
?>

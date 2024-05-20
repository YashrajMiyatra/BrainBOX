<?php
session_start(); // Start the session

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'brainbox';

// Create a database connection
$mysqli = new mysqli($host, $username, $password, $database);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Process the form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get user_id from the session
    $user_id = $_SESSION['user_id'];

    // Function to check if a value is set and not empty
    function isValueSet($value) {
        return isset($value) && !empty($value);
    }

    // Function to prepare and execute an update query
    function executeUpdateQuery($mysqli, $updateQuery, $params, $redirectLocation) {
        $stmt = $mysqli->prepare($updateQuery);

        // Check if the preparation was successful
        if ($stmt) {
            // Dynamically bind parameters
            $paramTypes = str_repeat('s', count($params));
            $stmt->bind_param($paramTypes, ...$params);

            if ($stmt->execute() === TRUE) {
                // Redirect to the specified location
                header("Location: $redirectLocation");
                exit(); // Ensure that the script stops execution after redirection
            } else {
                echo "Error updating data: " . $stmt->error . "<br>";
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error preparing update statement: " . $mysqli->error . "<br>";
        }
    }

    // Update user table
    $updateUserQuery = "UPDATE user SET";
    $userParams = [];

  
    if (isValueSet($_POST['profession'])) {
        $updateUserQuery .= " about_you=?,";
        $userParams[] = $_POST['profession'];
    }

    if (!empty($userParams)) {
        $updateUserQuery = rtrim($updateUserQuery, ','); // Remove the trailing comma
        $updateUserQuery .= " WHERE user_id = ?";
        $userParams[] = $user_id;
        executeUpdateQuery($mysqli, $updateUserQuery, $userParams, "C:/xampp/htdocs/BrainBox/Website/Homesite/profile.php");
    }

    // Update profile table
    $updateProfileQuery = "UPDATE profile SET";
    $profileParams = [];

    if (isValueSet($_POST['hobbies'])) {
        $updateProfileQuery .= " hobby=?,";
        $profileParams[] = json_encode([$_POST['hobbies']]);
    }
    if (isValueSet($_POST['codinglanguage'])) {
        $updateProfileQuery .= " coding_lang=?,";
        $profileParams[] = json_encode([$_POST['codinglanguage']]);
    }
    if (isValueSet($_POST['contactinformation'])) {
        $updateProfileQuery .= " contact=?,";
        $profileParams[] = $_POST['contactinformation'];
    }
    if (isValueSet($_POST['companynameurl'])) {
        $updateProfileQuery .= " company_name=?,";
        $profileParams[] = $_POST['companynameurl'];
    }
    if (isValueSet($_POST['bio'])) {
        $updateProfileQuery .= " description=?,";
        $profileParams[] = $_POST['bio'];
    }
    if (isValueSet($_POST['twitterurl'])) {
        $updateProfileQuery .= " twitter=?,";
        $profileParams[] = $_POST['twitterurl'];
    }
    if (isValueSet($_POST['githuburl'])) {
        $updateProfileQuery .= " github=?,";
        $profileParams[] = $_POST['githuburl'];
    }

    if (!empty($profileParams)) {
        $updateProfileQuery = rtrim($updateProfileQuery, ','); // Remove the trailing comma
        $updateProfileQuery .= " WHERE user_id = ?";
        $profileParams[] = $user_id;
        executeUpdateQuery($mysqli, $updateProfileQuery, $profileParams, "C:/xampp/htdocs/BrainBox/Website/Homesite/profile.php");
    }

    // Handle profile picture upload
    if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] == 0 && $_FILES['profilePicture']['size'] > 0) {
        $profilePicture = $_FILES['profilePicture']['name'];
        $uploadDir = 'C:/xampp/htdocs/BrainBox/Website/Homesite/uploads/profile/';
        $uploadPath = $uploadDir . $profilePicture;

        // Update profile table with the picture URL in the database
        $urlInDatabase = 'uploads/profile/' . $profilePicture;
        move_uploaded_file($_FILES['profilePicture']['tmp_name'], $uploadPath);

        // Update profile table with the URL in the database only if a picture is uploaded
        $updateProfilePictureQuery = "UPDATE user SET pic=? WHERE user_id = ?";
        $profilePictureParams = [$urlInDatabase, $user_id];
        executeUpdateQuery($mysqli, $updateProfilePictureQuery, $profilePictureParams, "C:/xampp/htdocs/BrainBox/Website/Homesite/profile.php");
    }
    header("location:C:/xampp/htdocs/BrainBox/Website/Homesite/profile.php");
    // Close the database connection
    $mysqli->close();
    
}
?>

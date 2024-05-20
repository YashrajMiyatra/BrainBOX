<?php
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

// Start the session
session_start();

// Process registration form (if submitted)
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['registration'])) {
    $username = $_POST['username'];
    $email = strtolower($_POST['email']); // Convert email to lowercase
    //$about_you = $_POST['about_you'];
    $interest = json_decode($_POST['keywords']); // Updated to match the input field name
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    // Check if file was uploaded without errors
    if (isset($_FILES['pic']) && $_FILES['pic']['error'] === UPLOAD_ERR_OK) {
        $picTmpPath = $_FILES['pic']['tmp_name']; // Temporary file path

// Move the uploaded file to a desired location
$uploadDir = 'uploads/profile/';
$picDestination = $uploadDir . $_FILES['pic']['name'];

if (move_uploaded_file($picTmpPath, $picDestination)) {
    // Store the file URL in $pic
    $pic = $picDestination; // Update to use relative path
    echo "File uploaded successfully. File URL: " . $pic;
} else {
    echo "Error moving the uploaded file.";
    exit(); // Stop execution if file move fails
}

} // <-- Missing closing brace for if (isset($_POST['registration']))

// Check for duplicates individually
$error_message = "";

// Check for duplicate username
$stmt = $mysqli->prepare("SELECT * FROM user WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $error_message .= "Username already exists.<br>";
}

// Check for duplicate email
$stmt = $mysqli->prepare("SELECT * FROM user WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $error_message .= "Email already exists.<br>";
}

// Display specific error alerts and redirect to index.php on OK
if ($error_message) {
    $exploded_errors = explode("<br>", $error_message);
    echo "<script>";
    foreach ($exploded_errors as $error) {
        switch (trim($error)) {
            case "Username already exists.":
                echo "alert('The username you selected is already taken. Please choose a different username.');";
                break;
            case "Email already exists.":
                echo "alert('The email address you entered is already associated with an account. Please use a different email address.');";
                break;
        }
    }
    echo "window.location.href = 'index.php';";
    echo "</script>";
    exit(); // Stop execution on error
} else {
    // No duplicates, proceed with registration
    $stmt = $mysqli->prepare("INSERT INTO user (username, email, password, about_you, interest, pic, registration_date) VALUES (?, ?, ?, ?, ?, ?, CURDATE())");
    $stmt->bind_param("ssssss", $username, $email, $password, $about_you, $interest, $pic);

    // Execute the statement
    if ($stmt->execute()) {
        // Registration successful
        $user_id = $stmt->insert_id; // Get the last inserted user_id
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;
        
        // Optionally, you can redirect the user to a success page or index page
        header("Location: index.php");
        // exit();
    } else {
        // Registration failed
        echo "Error during registration. Please try again. Error: " . $stmt->error;
        exit(); // Stop execution on error
    }

    // Close the statement
    $stmt->close();
}

    }


// Process login form (if submitted)
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute the SELECT statement
    $stmt = $mysqli->prepare("SELECT user_id, username, password FROM user WHERE email = ?");
    
    // Check for errors in prepare statement
    if (!$stmt) {
        die("Error in prepare statement: " . $mysqli->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if a user with the given email exists
    if ($result->num_rows > 0) {
        // Fetch user details
        $row = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Password matches, log them in
            $_SESSION['user_id'] = $row['user_id']; // Assuming 'user_id' is the column name
            $_SESSION['username'] = $row['username'];
            
            // Redirect to the main page after successful login
            header("Location: index.php");
            exit();
        } else {
            // Password incorrect
            echo "<script>alert('Incorrect password. Please try again.');  window.location.href = 'index.php';</script>";
            exit(); // Stop execution on error
        }
    } else {
        // User not found, redirect to registration page
        echo "<script>alert('Invalid email or password. Please try again or create an account.');";
        echo "window.location.href = 'index.php';</script>";
        exit(); // Stop execution on error
    }
}

// Close the connection
$mysqli->close();
?>
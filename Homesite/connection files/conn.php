<?php
include 'Transfer file/transfer.php';
session_start();

// Check if user is not logged in, redirect to index.html
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}

// Database connection details
$host = 'localhost';
$username = 'root';
// $password = 'shivam';
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

// Check if user exists
if ($result->num_rows > 0) {
    // User found, fetch data
    $user_data = $result->fetch_assoc();
    $username = $user_data['username'];
    $email = $user_data['email'];

       // Store user information in the session
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
   

 
} 
else {
    // User not found, redirect to index.html
    header("Location: index.html");
    exit();


   
}
// call the fuction in transfer.php
$encrypted_user_id = encryptUserId($user_id);
  

?>
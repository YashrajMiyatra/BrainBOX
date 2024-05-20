<?php
// Database connection details
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'brainbox';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL query to check if the user exists in the database
    $sql = "SELECT * FROM admin WHERE Admin_email = '$username' AND Admin_password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User exists, redirect to index.php
        header("Location: index.php");
        exit();
    } else {
        // User doesn't exist or incorrect credentials
        echo "Invalid username or password";
    }
}


// Close database connection
$conn->close();
?>

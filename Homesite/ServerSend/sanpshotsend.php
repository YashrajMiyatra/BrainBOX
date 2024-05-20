<?php
session_start();

// Check if user is not logged in, redirect to index.html
if (!isset($_SESSION['user_id'])) {
    header("Location: /BrainBox/Website/Homesite/index.html");
    exit();
}

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

// Get user information from the session
$user_id = $_SESSION['user_id'];
$stmt = $mysqli->prepare("SELECT username FROM user WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
    $username = $user_data['username'];
} else {
    // Handle the case where user information is not found
    header("Location: /BrainBox/Website/Homesite/index.html");
    exit();
}

$stmt->close();

// Handle file upload
$uploadDir = 'C:/xampp/htdocs/BrainBox/Website/Homesite/uploads/snapshot/';
$uploadFile = $uploadDir . basename($_FILES['image']['name']);

if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
    // File successfully uploaded, now insert data into the database
    $snapshot_txt = $_POST['snapshot_txt'];
    $snapshot_img = 'uploads/snapshot/' . basename($_FILES['image']['name']);

    // Prepare the INSERT statement
    $stmt = $mysqli->prepare("INSERT INTO snapshot (user_id, snapshot_txt, snapshot_img) VALUES (?, ?, ?)");
    
    // Check if prepare was successful
    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("iss", $user_id, $snapshot_txt, $snapshot_img);
        
        // Execute the query
        if ($stmt->execute()) {
            $stmt->close();
            header("Location: /BrainBox/Website/Homesite/snapshot.php"); // Redirect to a success page
            exit();
        } else {
            echo "Query execution failed: " . $stmt->error;
        }
    } else {
        echo "Prepare statement failed: " . $mysqli->error;
    }
} else {
    // Handle the case where file upload fails
    echo "File upload failed!";
}
?>

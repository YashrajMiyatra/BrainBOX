<?php
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

// Function to handle errors
function handle_error($message) {
    echo json_encode(array('success' => false, 'message' => $message));
    exit;
}

// Function to close the database connection
function close_connection() {
    global $mysqli;
    $mysqli->close();
}

// Specify upload directories
$uploadDir = 'C:/xampp/htdocs/BrainBox/Website/Homesite/uploads/certificate/';
$upload_dir = 'uploads/certificate/';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file is selected
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Validate file type
        $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
        $file_info = pathinfo($_FILES['image']['name']);
        $file_extension = strtolower($file_info['extension']);

        if (!in_array($file_extension, $allowed_types)) {
            handle_error('Invalid file type. Please upload a valid image file.');
        }

        // Upload file to the server
        $upload_path = $upload_dir . basename($_FILES['image']['name']);
        $full_upload_path = $uploadDir . basename($_FILES['image']['name']);

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $full_upload_path)) {
            handle_error('Error uploading the file. Please try again.');
        }

        // Get the user's ID (replace 'user_id' with your actual user identifier)
        $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : null;

        if ($user_id === null) {
            handle_error('Invalid user ID.');
        }

        // Fetch existing certificates from the database
        $query = "SELECT certificates FROM profile WHERE user_id = $user_id";
        $result = $mysqli->query($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Check if 'certificates' is null and initialize an empty array
            $existing_certificates = json_decode($row['certificates'], true);
            $existing_certificates = is_array($existing_certificates) ? $existing_certificates : array();

            // Add the new certificate to the array
            $existing_certificates[] = $upload_path;

            // Update the database with the new certificates array
            $update_query = "UPDATE profile SET certificates = '" . json_encode($existing_certificates) . "' WHERE user_id = $user_id";
            $update_result = $mysqli->query($update_query);

            if (!$update_result) {
                handle_error('Error updating the database. Please try again.');
            }
        } else {
            // If the user's entry does not exist, insert a new row
            $insert_query = "INSERT INTO profile (user_id, certificates) VALUES ($user_id, '" . json_encode(array($upload_path)) . "')";
            $insert_result = $mysqli->query($insert_query);

            if (!$insert_result) {
                handle_error('Error inserting data into the database. Please try again.');
            }
        }

        // Close the database connection
        close_connection();

        header("Location: /BrainBox/Website/Homesite/profile.php"); 
    } else {
        handle_error('No file selected or an error occurred during file upload.');
    }
} else {
    handle_error('Invalid request method.');
}
?>

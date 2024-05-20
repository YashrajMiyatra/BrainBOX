<?php
include 'connection files/conn.php';

?>


<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Google Font Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link rel="stylesheet" href="style/styles.css" />
<link rel="stylesheet" href="style/toggel.css">

  <title>BrainBox- SnapShot - Page</title>

  <style>
/* Container for Snapshots */
.sanpshots {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

/* Individual Snapshot Container */
.snapshot__container {
    width: 23%; /* Adjust the width as needed */
    margin-bottom: 20px;
}

/* Snapshot Box */
.sanpshot {
    border: 1px solid #ddd;
    padding: 15px;
    box-sizing: border-box;
}

/* Snapshot Image */
.snapshot__thumbnail img {
    width: 400px;
    height: 350px;
    object-fit: cover; /* Maintain aspect ratio while covering the box */
    border-radius: 8px; /* Optional: Add border radius for a nicer look */
}

/* Snapshot Details */
.snapshot__details {
    margin-top: 10px;
}

/* Author Image */
.author img {
    width: 40px; /* Adjust the size as needed */
    height: 40px;
    border-radius: 50%; /* Make it circular */
    object-fit: cover; /* Maintain aspect ratio while covering the box */
    margin-right: 10px;
}

/* Title and Author Details */
.title h3 {
    margin: 0;
}

.title a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
    display: block;
    margin-top: 5px;
}

.title span {
    color: #777;
    font-size: 14px;
}

</style>

</head>

<body>
  <!-- Header Starts -->
  <div class="header">
    <div class="header__left">
     
      <img src="company.png" alt="" />
    </div>

    <div class="header__middle">
      <span class="material-icons"> search </span>
      <input type="text" placeholder="Search Here!" />
      <button class="material-icons"> send</button>
    </div>
    <span class="material-icons" id="openPopup" style="cursor:pointer;" >record_voice_over</span>

    <div class="header__right">

    
    <?php
          $sql = "SELECT pic FROM user WHERE user_id = $_SESSION[user_id]";

          // Execute the query
          $result = $mysqli->query($sql);
          if ($result->num_rows > 0) {
            // Fetch the result
            $row = $result->fetch_assoc();
            $user_pic = $row['pic'];
          }
          ?>
         <img src='<?php echo $user_pic ; ?>' alt='Profile Picture' class='account-setting' >


    
  
    </div>
  </div>
  <!-- Header Ends -->

  <!-- Main Body Starts -->
  <div class="main__body">
  <!-- Sidebar Starts -->
<div class="sidebar">

  <a href="index.php">
  <div class="sidebarOption ">
    <span class="material-icons">home</span>
    <h3>Home</h3>
  </div>
</a>
  <a href="starred.php">
    <div class="sidebarOption">
      <span class="material-icons">star</span>
      <h3>Starred</h3>
    </div>
  </a>

  <a href="sent.php">
  <div class="sidebarOption">
    <span class="material-icons">near_me</span>
    <h3>Sent</h3>
  </div>
</a>

 
  <a href="snapshot.php">
    <div class="sidebarOption sidebarOption__active">
      <span class="material-icons">photo</span>
      <h3>Snapshot</h3>
    </div>
    </a>

  <a href="profile.php">
  <div class="sidebarOption ">
    <span class="material-icons">person</span>
    <h3>Profile</h3>
  </div>
  </a>



<a href="#">
  <div class="sidebarOption">
    <span class="material-icons">exit_to_app
    </span>
    <h3>Logout</h3>
  </div>
  </a>
</div>
<!-- Sidebar Ends -->

<div id="popupForm" class="popupformss">
<form action="ServerSend/sanpshotsend.php" method="post" enctype="multipart/form-data">
    <label for="fname">Post snapshot</label>
    <input type="text" placeholder="Explain your problem" name="snapshot_txt" required>
    <input type="file" id="imageInput" name="image" accept="image/*">

    
 
    
    <button type="submit" >submit</button>
</form>


</div>

<script>
    document.getElementById('openPopup').addEventListener('click', function () {
        var popup = document.getElementById('popupForm');
        popup.style.display = (popup.style.display === 'none' || popup.style.display === '') ? 'block' : 'none';

       
    });

</script>


<?php
// Assuming you have a MySQL database connection
$host = 'localhost';
$username = 'root';
$password = 'shivamask@lancer';
$database = 'brainbox';

// Create connection
$mysqli = new mysqli($host, $username, $password, $database);

// Check connection
if ($mysqli->connect_error) {
  die("Connection failed: " . $mysqli->connect_error);
}

// SQL query to fetch data from snapshot table
$snapshot_query = "SELECT snapshot.user_id, snapshot.snapshot_txt, snapshot.snapshot_img, snapshot.time, user.username,user.pic FROM snapshot JOIN user ON snapshot.user_id = user.user_id";

// Execute the query
$snapshot_result = $mysqli->query($snapshot_query);

// Check if there are rows in the result
if ($snapshot_result->num_rows > 0) {
    // Loop through each row
    while ($snapshot_row = $snapshot_result->fetch_assoc()) {
        // Now you have user_id, username, snapshot_txt, snapshot_img, and time
        $user_id = $snapshot_row['user_id'];
        $username = $snapshot_row['username'];
        $snapshot_txt = $snapshot_row['snapshot_txt'];
        $snapshot_img = $snapshot_row['snapshot_img'];
        $time = $snapshot_row['time'];
        $pic = $snapshot_row['pic'];

        // Output HTML for each snapshot
        echo '<div class="snapshots">
        <div class="snapshot__container">
           
        <div class="sanpshot">
                <div class="snapshot__thumbnail">
                    <img src="' . $snapshot_img . '" alt="" />
                </div>
                <div class="snapshot__details">
                    <div class="author">
                        <img src="'.$pic.'" alt="" />
                    </div>
                    <div class="title">
                        <h3>' . $snapshot_txt . '</h3>
                        <a href="">' . $username . '</a>
                        <span>' . $time . '</span>
                    </div>
                </div>
              </div>
              </div>
              </div>';
    }
} else {
    echo "No records found in snapshot table.";
}

// Close the database connection
$mysqli->close();
?>

          <!-- Single snapshot Ends -->
   
</body>

</html>
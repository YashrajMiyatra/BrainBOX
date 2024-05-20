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
  <title>BrainBox- Home</title>
  <script>
      function openPopup2() {
      document.getElementById('popupForm').style.display = 'block';
    }

    function closePopup2() {
      document.getElementById('popupForm').style.display = 'none';
    }
  </script>
  <style>
   /* Style for the popup container */
.popup-container {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: #fff;
  border: 1px solid #ccc;
  padding: 20px;
  max-width: 80%;
  max-height: 80%;
  overflow: auto;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  z-index: 999;
}

/* Style for the close button */
.close-btn {
  position: absolute;
  top: 10px;
  right: 10px;
  font-size: 30px;
  cursor: pointer;
  width: 30px;
}


  #popupForm {
  
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 20px;
    border: 1px solid #ccc;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    z-index: 1000;
}

.popupformss label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

.popupformss input[type="text"] {
    width: 100%;
    padding: 8px;
    margin-bottom: 16px;
    box-sizing: border-box;
}

.popupformss button {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: #fff;
    border: none;
    cursor: pointer;
}

.popupformss button[type="submit"] {
    background-color: #4CAF50;
}

.popupformss button[type="button"] {
    background-color: #f44336;
}

.popupformss button:hover {
    opacity: 0.8;
}

/* Add more styles as needed */
</style>
</head>

<body>
  <!-- Header Starts -->
  <div class="header">
    <div class="header__left">
      <span class="material-icons"> menu </span>
      <img src="company.png" alt="" />
    </div>

    <div class="header__middle">
      <span class="material-icons"> search </span>
      <input type="text" placeholder="Search Here!" />
      <button class="material-icons"> send</button>
    </div>

    <div class="header__right">

      <span class="material-icons"> notifications </span>
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
<div class="sidebarOption sidebarOption__active">
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
  <h3>My&nbsp;Question&nbsp;List  </h3>
</div>
</a>



<a href="profile.php">
<div class="sidebarOption">
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

    <?php
// Answer.php

// Retrieve question_id from the query string
$question_id = $_GET['question_id'];

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

// Prepare the SQL query
$stmt = $mysqli->prepare("SELECT question_txt FROM question WHERE question_id = ?");
$stmt->bind_param("i", $question_id);

// Execute the query
$stmt->execute();

// Get the result set
$result = $stmt->get_result();

// Check if there are rows returned
if ($result->num_rows > 0) {
    // Fetch the result
    $row = $result->fetch_assoc();
  
    // Use the fetched value
    $question_txt = $row['question_txt'];
    
} else {
    echo "No question found for the provided question_id.";
}
?>

    <div class="QuestionList">

      <div class="Questionbox">




       
          <div class="header__middle" >
           
            <h2><?php echo $question_txt ?> </h2>
           <span class="material-icons" style="padding-left:50px;" onclick="openPopup2()">lightbulb</span>
            
          </div>
       
      </div>


      <div id="popupForm" class="popupformss">
<form action="ServerSend/Answersend.php" method="post" enctype="multipart/form-data" >

    <label for="fname">Post Your Answer</label>
    <input type="text" placeholder="Explain your problem" name="answer_txt" required>

    <input type="file" id="imageInput"  name="que_snapshot_img" accept="image/*">

    <input type="hidden" value="<?php echo $question_id ?>" name="question_id"> 
 
    
    <button type="submit" >submit</button> &nbsp;<button type="button" onclick="closePopup2()">Close</button>
</form>


</div>



<?php

$stmt = $mysqli->prepare("SELECT r.user_id, r.response_txt, r.response_date,r.response_img, u.username, u.about_you
                        FROM responses r
                        JOIN user u ON r.user_id = u.user_id
                        WHERE r.question_id = ?
                        ORDER BY r.response_date DESC");

// Check for errors in prepare
if (!$stmt) {
    die("Error in prepare statement: " . $mysqli->error);
}

// Bind the parameter
$stmt->bind_param("i", $question_id);

// Execute the query
$stmt->execute();

// Get the result set
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
  
  $response_txt = $row['response_txt'];
  $response_date = $row['response_date'];
  $username = $row['username'];
  $about_you = $row['about_you'];
  $response_img = $row['response_img'];

?>

      <!-- Question List rows starts -->


 

      <div class="box">
        <div class="profile-container">
          <div class="profile-text">
            <img src="me.jpg" alt="Profile Picture" class="profile-image">
            <div>
              <span><?php echo $username ;?></span>
              <div>
                <span><?php echo $about_you;?></span>
              </div>
            </div>
          </div>
          <div class="menu-container">
            <span class="material-icons ellipsis-icon" id="ellipsisIcon" onclick="toggleDropdown()">more_vert</span>
            <div class="dropdown-menu" id="myDropdown">
          
              <a href="#"><span class="material-icons">report</span> </a>
             
              <a href="#"><span class="material-icons">delete</span> </a>
            </div>
          </div>
        </div>

        <div class="body">
          <p><?php echo $response_txt ;?></p>
        </div>
     
        <div class="footer">
    <div>
    
    <a href="javascript:void(0);"  style="margin-right: 30px;" onclick="thumbUpIcon(
      <?php echo $question_id ; ?>, 
      <?php echo $user_id ; ?>,
      <?php if($like_type==1 || $like_type == 0){ echo $like_id; } else{ echo null; } ; ?>
      )">
    <span class="material-icons" id="thumbup_<?php echo $question_id ?>" 
    style="<?php 
    
        if ($like_type === 1) {
          echo 'color: blue;';
        }
        else{
          echo 'color: black;';
        }
    

    ?>">thumb_up</span>

  </a>



            <a href="javascript:void(0);" style="margin-right: 30px;"  onclick="thumbDownIcon(
              <?php echo $question_id ; ?>, 
              <?php echo $user_id ; ?>,
              <?php if($like_type == 1 || $like_type == 0){ echo $like_id; } else{ echo null; } ; ?>
              )">

            <span class="material-icons" id="thumbdown_<?php echo $question_id ?>" 
    style="<?php 
    
        if ($like_type === 0) {
          echo 'color: blue;';
        }
        else{
          echo 'color: black;';
        }
    

    ?>">thumb_down</span>
              
            
          
          </a>
    
  

          <?php
  if($response_img !== null){
?>
<i class="material-icons" style="font-size: 28px; cursor: pointer;" onclick="showPopup('<?php echo $response_img; ?>')">attachment</i>



<?php
  }
?>

   
  


</div>
        <span class="date" ><?php echo $response_date; ?></span>
    
</div>
</div>

   <?php
}
   ?>
  <div id="imagePopup" class="popup-container" style="display: none;">
  <button type="button" class="close-btn" onclick="closePopup()">&times;</button>
  <img id="popupImage" src="" alt="Popup Image">
</div>

<script>
    // JavaScript function to show the image in a popup
    function showPopup(imageUrl) {
      // Check if the URL is not empty
      if (imageUrl.trim() !== "") {
        // Get the popup container and image elements
        var popupContainer = document.getElementById("imagePopup");
        var popupImage = document.getElementById("popupImage");

        // Set the source of the image in the popup
        popupImage.src = imageUrl;

        // Display the popup
        popupContainer.style.display = "block";
      }
    }
    function closePopup() {
  var popupContainer = document.getElementById("imagePopup");
  popupContainer.style.display = "none";
}

  </script>
</body>

</html>
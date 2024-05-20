<?php
include 'connection files/conn.php';



// SQL query to fetch username, pic, and about_you
$sql = "SELECT username, pic, about_you FROM user where user_id = $_SESSION[user_id]";
$result = $mysqli->query($sql);

// Check if the query was successful
if ($result === FALSE) {
    die("Error executing query: " . $mysqli->error);
}

// Fetch the data into variables
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    $username = $row['username'];
    $pic = $row['pic'];
    $about_you = $row['about_you'];

    // Now you can use $username, $pic, and $about_you as needed
} else {
    echo "No results found";
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['usernamename']) && isset($_POST['aboutyou'])) {
      $username = $_POST['usernamename'];
      $about_you = $_POST['aboutyou'];

      // Update user information
      $sql = "UPDATE user SET username='$username', about_you='$about_you' WHERE user_id = $_SESSION[user_id]"; // Replace 'user_id' with the actual primary key of your user table

      if ($mysqli->query($sql) === TRUE) {
          echo "User information updated successfully";
      } else {
          echo "Error updating user information: " . $mysqli->error;
      }

      // Handle profile picture upload
      if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] == 0) {
          $targetDir = "uploads/"; // Specify your upload directory
          $targetFile = $targetDir . basename($_FILES['profilePicture']['name']);
          $uploadOk = 1;
          $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

          // Check if the file is an actual image
          $check = getimagesize($_FILES['profilePicture']['tmp_name']);
          if ($check !== false) {
              $uploadOk = 1;
          } else {
              echo "File is not an image.";
              $uploadOk = 0;
          }

          // Check file size
          if ($_FILES['profilePicture']['size'] > 500000) {
              echo "Sorry, your file is too large.";
              $uploadOk = 0;
          }

          // Allow only certain file formats
          if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
              echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
              $uploadOk = 0;
          }

          // Move the uploaded file to the specified directory
          if ($uploadOk) {
              if (move_uploaded_file($_FILES['profilePicture']['tmp_name'], $targetFile)) {
                  // Update the database with the file name or path
                  $sql = "UPDATE user SET pic='$targetFile' WHERE user_id = $_SESSION[user_id]"; // Replace 'user_id' with the actual primary key of your user table

                  if ($mysqli->query($sql) === TRUE) {
                      echo "Profile picture updated successfully";
                  } else {
                      echo "Error updating profile picture: " . $mysqli->error;
                  }
              } else {
                  echo "Sorry, there was an error uploading your file.";
              }
          }
      }
  }
}
?>













<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Google Font Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />

  <link rel="stylesheet" href="style/styles.css" />
  <link rel="stylesheet" href="style/profile.css" />

  <title>BrainBox- Profile-Pages</title>
<style>
  @import url(https://fonts.googleapis.com/css?family=Open+Sans:300,400,700);

/* css class for the edit profile generated errors */
.profilepress-edit-profile-status {
  width: 400px;
  text-align: center;
  background-color: #e74c3c;
  color: #ffffff;
  border: medium none;
  border-radius: 4px;
  font-size: 17px;
  font-weight: normal;
  line-height: 1.4;
  padding: 8px 5px;
  margin: auto;
}

.memo-edprofile-success {
  width: 400px;
  text-align: center;
  background-color: #2ecc71;
  color: #ffffff;
  border: medium none;
  border-radius: 4px;
  font-size: 17px;
  font-weight: normal;
  line-height: 1.4;
  padding: 8px 5px;
  margin: auto;
}
#sc-edprofile {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: white;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      z-index: 999;
    }

    #sc-edprofile h1 {
      background: #3399cc;
      padding: 20px 0;
      font-size: 140%;
      font-weight: 300;
      text-align: center;
      color: #fff;
      margin-bottom: 10px;
    }

    .sc-container {
      padding: 6% 4%;
    }

    .sc-container input,
    .sc-container textarea,
    .sc-container select {
      width: 100%;
      margin-bottom: 10px;
      padding: 8px;
      box-sizing: border-box;
    }

    .sc-container select {
      width: calc(100% - 16px); /* Adjust for padding */
    }

    .sc-container button {
      background-color: blue;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .sc-container button:hover {
      background-color: red;
    }
    .popupformss {
            display: none;
            /* Add your styles for the popup here */
        }
</style>
<script>
    function openPopup() {
        var popupForm = document.getElementById('popupForm');
        popupForm.style.display = 'block';
    }

    function closePopup() {
        var popupForm = document.getElementById('popupForm');
        popupForm.style.display = 'none';
    }
</script>
<script>
  function showPopup() {
    document.getElementById('sc-edprofile').style.display = 'block';
  }

  function hidePopup() {
    document.getElementById('sc-edprofile').style.display = 'none';
  }
</script>
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
    <h3>My&nbsp;Question&nbsp;List  </h3>

  </div>
</a>

  <a href="profile.php">
  <div class="sidebarOption sidebarOption__active">
    <span class="material-icons">person</span>
    <h3>Profile</h3>
  </div>
  </a>



  <a href="logout.php">
  <div class="sidebarOption">
    <span class="material-icons">exit_to_app
    </span>
    <h3>Logout</h3>
  </div>
  </a>
</div>
<!-- Sidebar Ends -->

<!-- profile edit starts -->
<div id="sc-edprofile">
  <h1>Edit Profile Form</h1>
  <div class="sc-container">
    <form action="C:\xampp\htdocs\BrainBox\Website\Homesite\ServerSend\editprofile.php" method="POST" enctype="multipart/form-data">
      <input type="file" name="profile Picture"  />
    
    <input type="text" placeholder="hobbies "name="hobbies" />
    <input type="text" placeholder="coding language" name="codinglanguage" />
    <input type="text" placeholder="contact information" name="contactinformation" />
    <input type="text" placeholder="company name url" name="companynameurl" />
    <input type="text" placeholder="profession" name="profession" />         
    <textarea placeholder="Bio" name="bio"></textarea>  
        <input type="text" placeholder="Twitter Profile URL" name="twitterurl" />   
    <input type="text" placeholder="Github Profile URL" name="githuburl" />
    <button type="submit"  style="margin-left:45px;background-color: blue; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='red'" onmouseout="this.style.backgroundColor='blue'">submit</button>

   <button  type = "button"onclick="hidePopup()" style="margin-left:45px;background-color: blue; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='red'" onmouseout="this.style.backgroundColor='blue'">Close</button>

    </form>

  </div>
</div>
<!-- profile edit ends -->
<?php
$user_id = isset($_GET['user_id']) ? (int)$_GET['user_id'] : (int)$_SESSION['user_id'];

$stmt = $mysqli->prepare("SELECT p.company_name,p.github,p.twitter, p.contact,p.description,  p.hobby, p.coding_lang, p.certificates, u.username, u.about_you, u.pic,u.about_you
  FROM profile p
  JOIN user u ON p.user_id = u.user_id
  WHERE p.user_id = ?");

$stmt->bind_param("i", $user_id);

// Execute the query
$stmt->execute();

// Check for errors in prepare statement
if ($stmt === false) {
    die('Error in prepare statement: ' . htmlspecialchars($mysqli->error));
}

// Execute the prepared statement
if (!$stmt->execute()) {
    die('Error executing statement: ' . htmlspecialchars($stmt->error));
}

// Get the result
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // Fetch the result
  $row = $result->fetch_assoc();
  $contact = $row['contact'];
 $company_name = $row['company_name'];
  $coding_lang = json_decode($row['coding_lang'], true);
  $hobby = json_decode($row['hobby'], true);
  $certificates = json_decode($row['certificates'], true);
  $username = $row['username'];
  $about_you = $row['about_you'];
  $pic = $row['pic'];
  $description = $row['description'];
  $github = $row['github'];
  $twitter = $row['twitter'];
}

 ?>

<div class="landing">

<div class="profile">
  <div class="left">
    <div class="img">
      <img src="<?php echo $pic;?>" alt="avatar-05" style="height:200px; width:200px; object-fit:cover;" />
    </div>
   <p class="level"> <span><?php echo $username; ?></span></p>
    <p class="level" style="color:red">EP Points<span> 8</span></p>
    <?php 
    if($user_id == $_SESSION['user_id']){
     echo '<button id="editprofile" onclick="showPopup()" style="margin-left:45px;background-color: blue; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor=\'red\'" onmouseout="this.style.backgroundColor=\'blue\'">Update Profile</button>';
    }
    ?>

    
  </div>
    <div class="right">
    <div class="points container">
    <h4>About Me</h4>
    <p class="first">Profession<span>&nbsp;<?php echo isset($about_you) ? $about_you : "N/A"; ?></span></p>
        <p class="sec">Company <span style="cursor:pointer">&nbsp;<?php echo isset($company_name) ? $company_name : "N/A"; ?></span></p>
        <p class="third">Coding Languages<span> <?php echo isset($coding_lang) ? implode(', ', $coding_lang) : "N/A"; ?></span></p>
        <p class="third">Hobbies<span> <?php echo isset($hobby) ? implode(', ', $hobby) : "N/A"; ?></span></p>
        <p class="third">Contact Me<span> <?php echo isset($contact) ? $contact : "N/A"; ?> </span></p>
  
 
</div>
  </div>
  <div class="right">
  <div class="points container">
  <h4>Achivements</h4>
  <p class="first" style="display: flex; align-items: center;">&nbsp;&nbsp;<span class="material-icons">thumb_up</span>Total Question likes <span>&nbsp;&nbsp;5665</span></p>
  <p class="sec"style="display: flex; align-items: center;">&nbsp;&nbsp;<span class="material-icons">thumb_up</span>Total Answer likes <span>&nbsp;&nbsp;8994</span></p>
  <p class="third" style="display: flex; align-items: center;"><i class="material-icons" style="margin-left:-65px;"> github</i><span style="color:#279EFF;">&nbsp;<?php echo isset($github) ? $github : "N/A"; ?></span></p>
  <p class="third" style="display: flex; align-items: center;">
  <i style="margin-left: 5px;"><img src="twittericon.svg" alt=""></i>
  <span style="color:#279EFF;">&nbsp;<?php echo isset($twitter) ? $twitter : "N/A"; ?></span>
</p>


  

 
</div>
  </div>
</div>
<div id="popupForm" class="popupformss">
<form class="custom-form" action="ServerSend/trophies.php" method="post" enctype="multipart/form-data">
    <label for="snapshot_txt">Post snapshot</label>
    
    <input type="file" id="imageInput" name="image" accept="image/*">
  <!-- Add a hidden input field for user_id -->
  <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
  
    <button type="submit"  style="margin-left:45px;background-color: blue; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='red'" onmouseout="this.style.backgroundColor='blue'">submit</button>
    <button type="button" onclick="closePopup()"  style="margin-left:45px;background-color: blue; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='red'" onmouseout="this.style.backgroundColor='blue'">Close</button>

  </form>


</div>

<div class="trophies  container">
  <h3>Trophies</h3> 
  <?php 
  if($user_id == $_SESSION['user_id']){
    echo '<button id="trophiesadd" onclick="openPopup()" style="background-color: blue; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor=\'red\'" onmouseout="this.style.backgroundColor=\'blue\'">Add Trophies</button>';
  }
?>
 <?php 
$stmt = $mysqli->prepare("SELECT certificates FROM profile WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $certificates = json_decode($result->fetch_assoc()['certificates'], true);

    echo '<div class="images">';
    foreach ($certificates as $certificate) {
        echo '<img src="' . htmlspecialchars($certificate) . '" alt="">&nbsp;&nbsp;&nbsp;';
    }
    echo '</div> ';
    
} else {
    echo 'No certificates found for the specified user.';
}

$stmt->close();
?>
</div>
<div class="ladder  container">
  <h3>Bio</h3>
  <p><?php echo isset($description) ? $description : "N/A"; ?></p>
</div>

</div>
    </div>
    <!-- Main Body Ends -->
   
</body>

</html>
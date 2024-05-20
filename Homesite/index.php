<?php
include("connection files/conn.php");
?>

<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Google Font Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


  <link rel="stylesheet" href="style/styles.css" />
<link rel="stylesheet" href="style/toggel.css">
<link rel="stylesheet" href="style/keyword.css">
<link rel="stylesheet" href="style/editor.css">





  <title>BrainBox- Home</title>

 
 <style>
  
 </style>

</head>

<body>
 
  <!-- Header Starts -->
  <div class="header">
    <div class="header__left">
  
   
      <img src="company.png" alt="" />
    </div>
    <form style="flex:0.5" action="ServerSend/searchAlgo.php" method="post"> 
    <div class="header__middle">
  
      <span class="material-icons"> search </span>
      
      <input  class ="search" type="text" placeholder=" Search Here!"  name="search" id="search"  />
      <button class="material-icons" value="Search"> send</button>
      
     
    </div>
    </form>
    <button class="post-button" id="openPopup">
    <span>Ask Question</span>
    <span class="material-icons">record_voice_over</span>
</button>


     

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

  

<a href="logout.php">
  <div class="sidebarOption">
    <span class="material-icons">exit_to_app
    </span>
    <h3>Logout</h3>
  </div>
  </a>

  
  
  
  

</div>
<!-- Sidebar Ends -->
<div id="popupForm" class="popupformss">

<form  class="editor" action = "ServerSend/Questionsend.php" method="post" enctype="multipart/form-data">
    <label for="fname">Ask Question</label>
    <input type="text" placeholder="Ask anything you want" name="question_txt" required>
    <input type="file" id="imageInput"  name="que_snapshot_img" accept="image/*">


    <div id="selectedValuesContainer"></div>
    <input type="hidden" id="selectedValuesInput" name="keywords" value=""   >
 
    <div class="text-field">
        <input type="text" id="textInput" oninput="filterOptions()" placeholder="Type and select keyword" autocomplete="off">
        <div id="dropdownList" class="dropdown-list"></div>
    </div>
    <button class ="ask" type="submit" >submit</button>
    <button class ="close" type="close" >&times;</button>

  

</form>

</div>

<script>
   document.getElementById('openPopup').addEventListener('click', function () {
    var popup = document.getElementById('popupForm');
    popup.style.display = (popup.style.display === 'none' || popup.style.display === '') ? 'block' : 'none';
});

document.querySelector('.close').addEventListener('click', function () {
    var popup = document.getElementById('popupForm');
    popup.style.display = 'none';
});

</script>

    <div class="QuestionList" >
   <?php
    
      if (isset($_SESSION['search_response'])) {
    // If search response exists, use this statement
    $searchResponse = $_SESSION['search_response'];

    // Check if the status is 'success' and matched_question_ids is not empty
    if ($searchResponse['status'] === 'success' && !empty($searchResponse['matched_question_ids'])) {
        // Retrieve the matched_question_ids array
        $matchedQuestionIDs = $searchResponse['matched_question_ids'];

        // Convert the array to a comma-separated string
        $questionIDsString = implode(',', $matchedQuestionIDs);

        // Prepare the SQL statement
        $stmt = $mysqli->prepare("SELECT q.question_id, q.user_id, q.question_txt, q.que_keyword, q.question_date, q.que_snapshot_img, u.username, u.about_you, u.pic
                                FROM question q
                                JOIN user u ON q.user_id = u.user_id
                                WHERE q.question_id IN ($questionIDsString)
                                ORDER BY q.question_id DESC");

        // Check for errors in prepare statement
        if ($stmt === false) {
            die('Error in prepare statement: ' . htmlspecialchars($mysqli->error));
        }

        // Unset the 'search_response' key from the session
        unset($_SESSION['search_response']);
    }
} else {
    // If search response doesn't exist, use the default statement
    $stmt = $mysqli->prepare("SELECT q.question_id, q.user_id, q.question_txt, q.que_keyword, q.question_date, q.que_snapshot_img, u.username, u.about_you, u.pic
                            FROM question q
                            JOIN user u ON q.user_id = u.user_id
                            ORDER BY q.question_id DESC");

    // Check for errors in prepare statement
    if ($stmt === false) {
        die('Error in prepare statement: ' . htmlspecialchars($mysqli->error));
    }
}

// Execute the prepared statement
if (!$stmt->execute()) {
    die('Error executing statement: ' . htmlspecialchars($stmt->error));
}

// Get the result
$result = $stmt->get_result();

// Fetch and display data
while ($row = $result->fetch_assoc()) {
    $question_id = $row['question_id'];
    $question_txt = $row['question_txt'];
    $que_keyword = $row['que_keyword'];
    $question_date = $row['question_date'];
    $snapshot_img = $row['que_snapshot_img'];
    $username = $row['username'];
    $owner_id = $row['user_id'];
    $about_you = $row['about_you'];
    $pic = $row['pic'];


    

   $stmt1 = $mysqli->prepare("SELECT like_type, like_id FROM question_likes WHERE question_id = ? AND user_id = ?");
$stmt1->bind_param("ii", $question_id, $user_id); // Assuming both columns are integers
$stmt1->execute();
$result1 = $stmt1->get_result();
   
   $like_type = null;
   $like_id = null;

  if ($stmt1->error) {
    echo "Error: " . $stmt1->error;
}
   
   if ($result1->num_rows > 0) {
       $like_type_data = $result1->fetch_assoc();
       $like_type = $like_type_data['like_type'];
       $like_id = $like_type_data['like_id'];
       
   }
   
   ?>


   <div class="box">
    <div class="profile-container">
        <div class="profile-text">
            <img src="<?php echo $pic; ?>" alt="Profile Picture" class="profile-image">
            <div>
                <h3><a href="profile.php?user_id=<?php echo $owner_id; ?>" style="text-decoration: none; color:#212121;"><?php echo $username; ?></a>
</h3>
                <div>
                    <span><?php echo $about_you; ?></span>
                </div>
            </div>
        </div>

   
        <div class="menu-container">
            <span class="material-icons ellipsis-icon" onclick="toggleDropdown('DropdownContainer_<?php echo $question_id; ?>')">more_vert</span>
            <div class="dropdown-menu" id="DropdownContainer_<?php echo $question_id; ?>"> <!-- Corrected ID here -->
                <!-- <a href="javascript:void(0);" id="starIcon_<?php echo $question_id; ?>" onclick="toggleStarred(<?php echo $question_id; ?>)">
                    <span class="material-icons">star</span>
                </a> -->
                <i class="material-icons" onclick="openPopup(<?php echo $question_id;?>, <?php echo $_SESSION['user_id']; ?>)">report</i>



                <?php
                if ($owner_id == $_SESSION['user_id']) {
        // Display the delete links
       
        echo '<i class="material-icons">delete</i>';
    }?>
            </div>
        </div>
    </div>
    
     <script>
    

    var encrypted_user_id = <?php echo json_encode(base64_encode($encrypted_user_id)); ?>;

</script> 

    <div class="body">
        <p><?php echo $question_txt; ?></p>
    </div>

    <div class="keyword">
     
        <?php
        // Display keywords (you can modify this part based on your actual implementation)
        $que_keyword = $row['que_keyword'];

        // Check if que_keyword is not null and is valid JSON
        if ($que_keyword !== null && ($keywordsArray = json_decode($que_keyword, true)) !== null) {
            // Display each keyword as a button
            foreach ($keywordsArray as $keyword) {
                echo '<button>' . $keyword . '</button>&nbsp;&nbsp;';
            }
        }
        ?>
    </div><br>

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
    
  

<a style="margin-right: 30px;"  href="Answer.php?question_id=<?php echo $question_id; ?>" class="material-icons">lightbulb</a>
<a style="margin-right: 30px; "  href="javascript:void(0);" id="starIcon_<?php echo $question_id; ?>" onclick="toggleStarred(<?php echo $question_id; ?>)">
                    <span class="material-icons" style="font-size: 27px;">star</span>
                </a>
               <!-- Add this HTML structure for the popup -->
      
       
        
   
    
<!-- Your original HTML for the attachment icon -->
<?php
  if($snapshot_img !== null){
?>
<i class="material-icons" style="font-size: 28px; cursor: pointer;" onclick="showPopup('<?php echo $snapshot_img; ?>')">attachment</i>
<?php
  }
?>

</div>
        <span class="date" ><?php echo $question_date; ?></span>
       

    
</div>
</div>

   <?php

}

?>
<!-- report send div -->
<div class="popups">
<div class="reportsendform">
  <form action="ServerSend/report.php" method="POST">
    <label > write reasons for reporting </label>
    <input type="hidden" name="questionid" value="">
    <input type="hidden" name="userid" value="">
    <input type="text" name="report_txt">
    <button type="submit">send</button>
<button type="button" onclick="closePopup()">Close</button>

   
  </form>
  
 
</div>
</div>







<!-- image show div -->
<div id="popup" class="popup">
  <button class="close" onclick="closePopup2()" style="background-color: blue; color:white;">&times;</button>
  <img class="popup_img_content" id="popup_img_content" src="" alt="">
</div>


</div>
    <!-- Main Body Ends -->
    <!-- script  -->
    <script src="Javascript/indexAjax.js"></script>
    <script src="Javascript/keyword.js"></script>
    <script src="Javascript/thumbupAjax.js"></script>
 <script>
    function showPopup(img_ul) {
  var popup = document.getElementById("popup");
  var popupImg = document.getElementById("popup_img_content");

  popupImg.src = img_ul;
  popup.style.display = "block";
}

function closePopup2() {
  var popup = document.getElementById("popup");
  popup.style.display = "none";
}
</script>
<script>
         function openPopup(questionId, userId) {
        // Set the values of the hidden input fields
        document.querySelector('input[name="questionid"]').value = questionId;
        document.querySelector('input[name="userid"]').value = userId;
  var popup = document.querySelector(".popups");

            // Show the popup
            popup.style.display = "block";
        }

        function closePopup() {
            // Get the popup element
            var popup = document.querySelector(".popups");

            // Hide the popup
            popup.style.display = "none";
        }
    </script>
 
</body>

</html>
<?php 
// Close the connection
$stmt->close();
?>
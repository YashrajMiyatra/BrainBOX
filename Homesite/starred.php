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
  <title>BrainBox- Star-Page</title>

  <script>
        var encrypted_user_id = <?php echo json_encode(base64_encode($encrypted_user_id)); ?>;


   
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
  <div class="sidebarOption">
    <span class="material-icons">home</span>
    <h3>Home</h3>
  </div>
</a>
  <a href="starred.php">
    <div class="sidebarOption sidebarOption__active">
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
<?php
// Assuming you have the user_id from the session (replace it with your actual session retrieval method)
$current_user_id = $_SESSION['user_id'];

// Prepare the statement
$stmt_starred = $mysqli->prepare("SELECT s.question_id
                        FROM starred s
                        WHERE s.user_id = ? AND s.star_type = 1
                        ORDER BY s.starred_id DESC");

// Check for errors in prepare statement
if ($stmt_starred === false) {
    die('Error in prepare statement: ' . htmlspecialchars($mysqli->error));
}

// Bind parameters
$stmt_starred->bind_param("i", $current_user_id);

// Execute the statement
if (!$stmt_starred->execute()) {
    die('Error executing statement: ' . htmlspecialchars($stmt_starred->error));
}
// Check if the first prepared statement is valid
if (!$stmt_starred) {
    die('Error in the query: ' . $mysqli->error);
}

$stmt_starred->execute();
$result_starred = $stmt_starred->get_result();

// Opening the QuestionList container
echo '<div class="QuestionList">';

while ($row_starred = $result_starred->fetch_assoc()) {
    $question_id = $row_starred['question_id'];

    // Ensure $question_id is an integer
    if (!is_int($question_id)) {
        die('Invalid question_id value');
    }

    // Retrieve additional information from the 'question' table based on $question_id
    $stmt_question = $mysqli->prepare("SELECT q.question_id, q.user_id, q.question_txt, q.que_keyword, q.question_date, q.que_snapshot_img, u.username, u.about_you, u.pic
                                       FROM question q
                                     JOIN user u ON q.user_id = u.user_id
                                     WHERE q.question_id = ?");

    // Check if the second prepared statement is valid
    if (!$stmt_question) {
        die('Error in the query: ' . $mysqli->error);
    }

    $stmt_question->bind_param("i", $question_id);
    $stmt_question->execute();
    $result_question = $stmt_question->get_result();

    // Check for errors in query execution
    if ($stmt_question->errno) {
        die('Error executing the query: ' . $stmt_question->error);
    }

    if ($row_question = $result_question->fetch_assoc()) {
        // Assign values from the fetched result
        $username = $row_question['username'];
        $que_keyword = $row_question['que_keyword'];
        $question_date=$row_question['question_date'];
        $question_txt = $row_question['question_txt'];
        $owner_id = $row_question['user_id'];
        $about_you=$row_question['about_you'];
        $pic=$row_question['pic'];
        // You may want to fetch and assign $question_date as well from the result


// fetch the like and dislike on this satrred qustion
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




        // Display the information
        ?>
                <div class="box">
            <div class="profile-container">
                <div class="profile-text">
            <img src="<?php echo $pic; ?>" alt="Profile Picture" class="profile-image">

                    <div>
                        <h3><?= $username ?></h3>
                        <div>
                            <span><?= $about_you ?></span>
                        </div>
                    </div>
                </div>
                <div class="menu-container">
            <span class="material-icons ellipsis-icon" onclick="toggleDropdown('DropdownContainer_<?php echo $question_id; ?>')">more_vert</span>
            <div class="dropdown-menu" id="DropdownContainer_<?php echo $question_id; ?>"> <!-- Corrected ID here -->
                <!-- <a href="javascript:void(0);" id="starIcon_<?php echo $question_id; ?>" onclick="toggleStarred(<?php echo $question_id; ?>)">
                    <span class="material-icons">star</span>
                </a> -->
                <a href="#"><span class="material-icons">report</span> </a>
                 <?php 
                if ($owner_id == $_SESSION['user_id']) {
        // Display the delete links
       
        echo '<a href="#"><span class="material-icons">delete</span></a>';
    }?>
            </div>
        </div>
    </div>

 

            <div class="body">
                <p><?= $question_txt ?></p>
            </div>
           
    <div class="keyword">
        <?php

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
<a style="margin-right: 30px;"  href="javascript:void(0);" id="starIcon_<?php echo $question_id; ?>" onclick="toggleStarred(<?php echo $question_id; ?>)">
                    <span class="material-icons">star</span>
                </a>
  
</div>
      
        <span class="date" ><?php echo $question_date; ?></span>
    </div>
</div>

       
        <?php
    }

    $result_question->close();
    $stmt_question->close();
}

// Closing the QuestionList container
echo '</div> </div> ';

$result_starred->close();
$stmt_starred->close();
?>
<!-- script file  -->
<script src="Javascript/starredR.js"></script>

<!-- scrippt file ends -->
</body>

</html>
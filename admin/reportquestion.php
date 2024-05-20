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
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>BrainBox - Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
<link href="https://demo.dashboardpack.com/architectui-html-free/main.css" rel="stylesheet"></head>
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
               <img src="company.png" alt="" style="width: 150px; height: 30px;">
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>    <div class="app-header__content">
                <div class="app-header-left">
                   
                    <ul class="header-menu nav">
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-link-icon fa fa-database"> </i>
                                Statistics
                            </a>
                        </li>
                        <li class="btn-group nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-link-icon fa fa-edit"></i>
                                Projects
                            </a>
                        </li>
                        <li class="dropdown nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-link-icon fa fa-cog"></i>
                                Settings
                            </a>
                        </li>
                    </ul>        </div>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                              
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                        Alina Mclourd
                                    </div>
                                    <div class="widget-subheading">
                                        VP People Manager
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>        </div>
            </div>
        </div>      
              <div class="app-main">
                <div class="app-sidebar sidebar-shadow">
                    <div class="app-header__logo">
                        <div class="logo-src"></div>
                        <div class="header__pane ml-auto">
                            <div>
                                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="app-header__mobile-menu">
                        <div>
                            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="app-header__menu">
                        <span>
                            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                                </span>
                            </button>
                        </span>
                    </div>    <div class="scrollbar-sidebar">
                        <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">
                                <li class="app-sidebar__heading">Dashboards</li>
                                <li>
                                    <a href="index.php" >
                                        <i class="metismenu-icon pe-7s-rocket"></i>
                                    Dashboard
                                    </a>
                                </li>
                                <li class="app-sidebar__heading">Contact US</li>
                                <li
                                        
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                           
                                    
                                >
                                    <a href="querry.php" >
                                        <i class="metismenu-icon pe-7s-car"></i>
                                       Querry
                                       
                                    </a>
                                   
                                    </li>
                                 
                                    <li class="app-sidebar__heading">Admin</li>
                                    <li>
                                        <a href="adminM.php">
                                            <i class="metismenu-icon pe-7s-display2"></i>
                                           Admin Profile
                                        </a>
                                    </li>
                                    <li class="app-sidebar__heading">User ReachOut</li>
                                    <li>
                                        <a href="reportquestion.php" class="mm-active">
                                            <i class="metismenu-icon pe-7s-mouse">
                                            </i>Report Question & Answer
                                        </a>
                                    </li>
                                    <!-- <li>
                                        <a href="reportanswer.php">
                                            <i class="metismenu-icon pe-7s-eyedropper">
                                            </i>Report Answer
                                        </a>
                                    </li> -->
                                    <!-- <li>
                                        <a href="forms-validation.html">
                                            <i class="metismenu-icon pe-7s-pendrive">
                                            </i>User Feedback
                                        </a>
                                    </li> -->
                                   
                                    
                                </ul>
                            </div>
                        </div>
                    </div>    <div class="app-main__outer">
                        <div class="app-main__inner">
                             
                                           
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-header"> Users
                                        <div class="btn-actions-pane-right">
                                            <div role="group" class="btn-group-sm btn-group">
                                              <input type="date" name="" id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th class="text-center">user_id</th>
                                                
                                                <th class="text-center">report_txt</th>
                                                <th class="text-center">Which part is reported</th>
                                            

                                                <th class="text-center">Status</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php                                                                                         
                                                                                          // Fetch all records from the contactus table
                                                    $query = "SELECT * FROM report";
                                                                                          $result = $mysqli->query($query);
                                        
                                                                                          // Check for query execution success
                                                                                          if (!$result) {
                                                                                              die("Query failed: " . $mysqli->error);
                                                                                          }
                                        
                                                                                          
                                                                                  while ($row = $result->fetch_assoc()) {
                                                                             // Store each column in separate variables
                                                                                              $user_id = $row['user_id'];
                                                                                              $question_id = $row['question_id'];
                                                                                              $response_id = $row['response_id'];
                                                                                              $report_txt= $row['report_txt'];
                                                                                              $report_status = $row['report_status'];                                                                                      
                                                                                              $date= $row['report_date'];
                                        
                                                                                 ?>
                                            <tr>
                                                <td class="text-center text-muted"><?php echo $user_id ;?></td>
                                                <td>
                                                    <div class="widget-content p-0"><?php echo $report_txt;?>
                                                        <div class="widget-content-wrapper">
                                                            
                                                            <div class="widget-content-left flex2">
                                                                <td class="text-center"><?php if($question_id){echo "Q--".$question_id;}if($response_id){echo "R--".$response_id;} ?></td>
                                                                <!-- <div class="widget-subheading opacity-7">Web Developer</div> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                               
                                                <td class="text-center">
                                                    <div class="badge badge-warning"><?php echo $report_status;?></div>
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm">Details</button>
                                                </td>
                                            </tr>
                                            <?php
                                                                                  }
                                                                                  $mysqli->close();
                                            ?>
                                                                                       </tbody>
                                        </table>

        </div>
    </div>
<script type="text/javascript" src="https://demo.dashboardpack.com/architectui-html-free/assets/scripts/main.js"></script></body>
</html>

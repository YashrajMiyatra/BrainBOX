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

// Fetch data from the database
$result = $mysqli->query("SELECT registration_date, COUNT(*) AS total_users FROM user GROUP BY registration_date");

if (!$result) {
    die("Query failed: " . $mysqli->error);
}

// Store data in PHP arrays
$dates = [];
$totalUsers = [];

while ($row = $result->fetch_assoc()) {
    $dates[] = $row['registration_date'];
    $totalUsers[] = $row['total_users'];
}

// Close the database connection
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link rel="stylesheet" href="styles.css" />
    <script
src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>
<style>
  /* Add this CSS for the canvas in the main body */
  #userChart {
           
            max-width: 1000px; /* Set a maximum width if needed */
            height: 400px; /* Set a fixed height */
            margin: 10px;
        }

        
  </style>
    <title>BrainBox - AdminPanel</title>
</head>
<body>
    <div class="header">
        <div class="header__left">
            <img src="company.png" alt=""  style="height: 50px; width: 200px;" />
        </div>
        <div class="header__search">
            <form action="">
                <input type="text" placeholder="Search" />
                <button><i class="material-icons">search</i></button>
            </form>
        </div>
        <div class="header__icons">
            <div class="date-picker-container">
                <label for="datePicker">Select Date: </label>
                <input type="date" id="datePicker" onchange="updateChart()">
            </div>
        </div>
    </div>

    <div class="mainBody">
        <div class="sidebar">
            <div class="sidebar__categories">
                <div class="sidebar__category">
                    <a href="index.php" style="text-decoration: none; align-items: center; display: flex; justify-content: center; ">
                        <i class="material-icons">home</i>
                        <span>Home</span>
                    </a>
                </div>
               
            </div>
            <hr />
            <div class="sidebar__categories">
                <div class="sidebar__category">
                    <a href="RQ.php" style="text-decoration: none; align-items: center; display: flex; justify-content: center; ">
                        <i class="material-icons">library_add_check</i>
                        <span>Report Question</span>
                    </a>
                </div>
                <div class="sidebar__category">
                    <a href="RTC.php" style="text-decoration: none; align-items: center; display: flex; justify-content: center; ">
                        <i class="material-icons">edit</i>
                        <span>Response To Contact Us</span>
                    </a>
                </div>
                <div class="sidebar__category">
                    <a href="adminM.php" style="text-decoration: none; align-items: center; display: flex; justify-content: center; ">
                        <i class="material-icons">key</i>
                        <span>Admin Management</span>
                    </a>
                </div>
            </div>
            <hr />
        </div>
      </div>
      <div class="section__body">
        <canvas id="userChart" ></canvas>

        <script>
    // Use PHP variables in JavaScript
    var dates = <?php echo json_encode($dates); ?>;
    var totalUsers = <?php echo json_encode($totalUsers); ?>;

    // Create the chart
    var ctx = document.getElementById('userChart').getContext('2d');
    var userChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: dates,
            datasets: [{
                label: 'Total Users',
                data: totalUsers,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                x: { 
                    type: 'time', 
                    time: { 
                        unit: 'day', 
                        parser: 'YYYY-MM-DD',  // Specify the date format in your registration_date
                        tooltipFormat: 'll',
                        displayFormats: {
                            day: 'YYYY-MM-DD'
                        }
                    } 
                },
                y: { beginAtZero: true }
            }
        }
    });

   
      function updateChart() {
        // Get the selected date from the date picker
        var selectedDate = document.getElementById('datePicker').value;

        // Find the index of the selected date in the dates array
        var index = dates.indexOf(selectedDate);

        // Update the chart data to show only the selected date
        userChart.data.labels = [dates[index]];
        userChart.data.datasets[0].data = [totalUsers[index]];

        // Update the chart
        userChart.update();
    }
  
</script>

    </div>
</body>
</html>

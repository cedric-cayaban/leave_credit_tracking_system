
 <?php
    require('../config.php');
    session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/dashboard.css?ver=0001">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/9c6f27a8d7.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 
    <title>Doc</title>
</head>
<style>
    

</style>
<body>
<?php 
  if(isset($_SESSION['admin_id'])){
      $adminId = $_SESSION['admin_id'];
  }
    $pendingLeave = $con->query("SELECT * FROM admin 
    WHERE admin.admin_id = '$adminId'");
    while($admin = $pendingLeave -> fetch_assoc()){
    ?>
    
<div class="clock-container" style="display: flex; justify-content: flex-end;">
    <h5 id="clock" class="mt-3 mx-4"></h5>
</div>

<div class="card card-outline card-primary mt-2" id="load-content">
<div class="card-header d-flex justify-content-between align-items-center">
    <h1 class="card-title">Welcome to Leave Credit Tracking System</h1>
    <div class="infos d-flex flex-column mx-3">
        <h5><?=$admin['fname'] . " " . $admin['lname']?></h5>
        
       <?php } ?>
    </div>
</div>

	<div class="card-body">
		
        <div class="container-fluid">
        <div class="row">
           
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3" onclick="loadContent('requests.php')">
              <span class="info-box-icon bg-white elevation-1"><i class="fas fa-file-alt fa-lg "></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Pending Requests: </span>
                <span class="info-box-number text-right">
                    <?php 
                        if(isset($_SESSION['department'])){
                          $adminDept = $_SESSION['department'];
                        }
                        $pendingLeave = $con->query("SELECT COUNT(*) AS pending_count
                        FROM employee_leave
                        INNER JOIN employee ON employee_leave.employee_id = employee.employee_id
                        WHERE employee_leave.status = 'Pending' AND employee.department = '$adminDept'"
                        )->fetch_assoc()['pending_count'];


                        echo number_format($pendingLeave);
                    ?>
                  <?php ?>
                </span>
              </div>
             
            </div>
           
          </div>
          
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3" onclick="loadContent('verify_acc.php')">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-user fa-lg text-white"></i></span>
              
              <div class="info-box-content">
                <span class="info-box-text">Pending Accounts: </span>
                <span class="info-box-number text-right">
                  <?php 
                   if(isset($_SESSION['department'])){
                      $adminDept = $_SESSION['department'];
                    }
                    $pendingAccount = $con->query("SELECT COUNT(*) AS pending_count 
                                FROM employee 
                                WHERE acc_status = 'Pending' AND department = '$adminDept'"
                            )->fetch_assoc()['pending_count'];
                    echo number_format($pendingAccount);
                  ?>
                </span>
              </div>
              
            </div>
            
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3" onclick="loadContent('reports.php')">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-chart-bar fa-lg text-white"></i></span>
              
              <div class="info-box-content">
                <span class="info-box-text">Leave Reports: </span>
                <span class="info-box-number text-right">
                  <?php 
                    if(isset($_SESSION['department'])){
                      $adminDept = $_SESSION['department'];
                    }
                    $totalReports = $con->query("SELECT COUNT(*) AS pending_count
                    FROM employee_leave
                    INNER JOIN employee ON employee_leave.employee_id = employee.employee_id
                    WHERE employee.department = '$adminDept' AND
                    (status = 'Accepted' OR status = 'Rejected')"
                    )->fetch_assoc()['pending_count'];
                    echo number_format($totalReports);
                  ?>
                </span>
              </div>
              
            </div>
            
          </div>
        </div>
		</div>
		
	</div>
</div>
    
        
 
 

 
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
      function updateClock() {
            var now = new Date();

            var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            var month = months[now.getMonth()];
            var date = now.getDate();
            var year = now.getFullYear();
            var dateString = month + ' ' + date + ', ' + year;

            var hours = now.getHours();
            var ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12;
            var minutes = now.getMinutes();
            var seconds = now.getSeconds();
            
            var timeString = ' ' + ampm + ' - ' + hours + ':' + 
                            (minutes < 10 ? '0' : '') + minutes + ':' +
                            (seconds < 10 ? '0' : '') + seconds 
                            ;

            document.getElementById('clock').innerHTML = dateString + ' <br> ' + timeString;
        }

        setInterval(updateClock, 1000);

        updateClock();
    </script>
</body>
</html>
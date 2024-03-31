<?php
    require('../config.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/contents.css?ver=0003">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/9c6f27a8d7.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+I4dHt0YIvI3Mpjs4L+AdfYqlA3oWeBSwF8umNikyJZYhEN" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<style>
    



</style>
<body>
<div class="card">
    <div class="card-body">
        <?php 
            if(isset($_SESSION['employee_id'])){
                $employeeId = $_SESSION['employee_id'];
            }
            $infoSql = $con -> query("SELECT *
            FROM employee 
            LEFT JOIN leave_type ON employee.employee_type = leave_type.type_id 
            LEFT JOIN employee_type ON employee.employee_type = employee_type.type_id 
            LEFT JOIN academic_rank ON employee.academic_rank = academic_rank.rank_id
            LEFT JOIN designation ON employee.designation = designation.designation_id
            LEFT JOIN department ON employee.department = department.dept_id
            WHERE employee.employee_id = '$employeeId'
            "); 
            while($employee = $infoSql -> fetch_assoc()){
        ?>
        <div class="w-100 d-flex justify-content-between mb-3 my-3">
            <h2>My Information</h2>
            <a href="" class="btn btn-flat btn-primary me-3"><span class="fas fa-edit"></span>Edit Information</a>   
        </div>


        <div id="print_out">
            <table class="table info-table">
                    <tr>
                    <td width='20%'>
                        <div class="w-100 d-flex align-items-center justify-content-center mt-3">
                            <div class="profile-frame">
                                <i class="fas fa-user fa-5x user-icon"></i>
                            </div>
                        </div>
                    </td>

                        
                        <td width="80%">
                            <div class="row">
                                <div class="col-11">
                                    <div class="d-flex w-max-100">
                                        <label class="float-left w-auto whitespace-nowrap">Identification:</label>
                                        <p class="col-md border-bottom px-2 border-dark w-100"><b>&nbsp<?=$employee['employee_id'] ?></b></p>
                                    </div>
                                    <div class="d-flex w-max-100">
                                        <label class="float-left w-auto whitespace-nowrap">Name:</label>
                                        <p class="col-md border-bottom px-2 border-dark w-100"><b>&nbsp<?=$employee['lname']?>, <?=$employee['fname']?> <?=$employee['mname'] ?></b></p>
                                    </div>
                                    <div class="row justify-content-between w-max-100 mr-0">
                                        <div class="col-6 d-flex w-max-100">
                                            <label class="float-left w-auto whitespace-nowrap">Birthdate: </label>
                                            <p class="col-md border-bottom px-2 border-dark w-100"><b><?= date("M d, Y", strtotime($employee['birthdate'])) ?></b></p>
                                        </div>
                                        <div class="col-6 d-flex w-max-100">
                                            <label class="float-left w-auto whitespace-nowrap">Contact: </label>
                                            <p class="col-md border-bottom px-2 border-dark w-100"><b><?= $employee['contact'] ?></b></p>
                                        </div>
                                    </div>
                                    <div class="d-flex w-max-100">
                                        <label class="float-left w-auto whitespace-nowrap">Address:</label>
                                        <p class="col-md border-bottom border-dark w-100"><b><?= $employee['address'] ?></b></p>
                                    </div>
                                    <div class="row justify-content-between w-max-100 mr-0">
                                        <div class="col-6 d-flex w-max-100">
                                            <label class="float-left w-auto whitespace-nowrap">Employee type: </label>
                                            <p class="col-md border-bottom px-2 border-dark w-100"><b><?= empty($employee['dept_name'])? 'N/A' : $employee['type_name'] ?></b></p>
                                        </div>
                                        <div class="col-6 d-flex w-max-100">
                                            <label class="float-left w-auto whitespace-nowrap">Department: </label>
                                            <p class="col-md border-bottom px-2 border-dark w-100"><b><?= empty($employee['dept_name'])? 'N/A' : $employee['dept_name'] ?></b></p>
                                        </div>
                                        <div class="col-6 d-flex w-max-100">
                                            <label class="float-left w-auto whitespace-nowrap">Designation: </label>
                                            <p class="col-md border-bottom px-2 border-dark w-100"><b><?=empty($employee['designation_name']) ? 'N/A' : $employee['designation_name'] ?></b></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                <?php } ?>
            <hr class="border-dark">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div id="bottom-box" class="callout px-3 py-3">
                        <h5 class="mb-2">Leave Credits</h5>
                        <table class="table table-hover ">
                            <colgroup>
                                <col width="70%">
                                <col width="15%">
                                <col width="15%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th class="py-1 px-2">Type</th>
                                    <th class="py-1 px-2">Credits</th>
                                    <th class="py-1 px-2">Available</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                            <tr>
                                <td>
                                <?php 
                                    $firstIteration = true;
                                    while($leaveType = $leaveTypeSql->fetch_assoc()) {
                                        if (!$firstIteration) {
                                            echo "<br> <br>"; 
                                        } else {
                                            $firstIteration = false; 
                                        }
                                        echo $leaveType['leave_name']; 
                                    }
                                ?>

                                </td>
                                <td style="text-align: center;">
                                    <?php
                                        if(isset($_SESSION['employee_id'])){
                                            $employeeId = $_SESSION['employee_id'];
                                        }
                                        $sql = $con -> query("SELECT * FROM employee WHERE employee.employee_id = '$employeeId'");
                                        while($credits = $sql -> fetch_assoc()){
                                    ?>
                                    <?php echo $credits['vacation_leave'] . "<br> <br>"?> 
                                    <?php echo $credits['sick_leave'] ?> 

                                    <?php } ?>
                                </td>

                                <td> / <br><br> /</td>
                            </tr>
                            
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="col-md-8 col-sm-12 py-5">
                <div id="bottom-box" class="callout px-3 py-3 d-flex flex-column align-items-center justify-content-center ">
                    <h5>Leave History</h5>
                    <button id='view-records' class="btn btn-primary mt-3">View</button>
                </div>

                </div>


            </div>
        </div>
    </div>
   
</div>




<script>

    

    
    
    
</script>





</body>
</html>
<?php
    require('../config.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/contents.css?ver=0001">
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
<div class="card card-outline card-primary mt-4" id="load-content">
	<div class="card-header d-flex justify-content-between">
		<h3 class="card-title">Verify Employee Accounts</h3>
    <!-- NUMBER 2 -->
    <!-- ANDITO BUTTON PARA SA CREATE NEW NAKA COMMENT OUT LANG, MERON YAN SA LAHAT NG PHP FILE SA ADMIN -->

		<!-- <div class="card-tools">
			<a href="" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a>
		</div> -->

    <!-- ANDITO BUTTON PARA SA CREATE NEW NAKA COMMENT OUT LANG, MERON YAN SA LAHAT NG PHP FILE SA ADMIN -->
	</div>
	<div class="card-body">
		
        <div class="container-fluid">
			<table class="table table-hover table-stripped">
				
				<colgroup>
                    <col width="10%">
					<col width="15%">
					<col width="15%">
					<col width="15%">
					<col width="10%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Employee Type</th>
						<th>Academic Rank</th>
						<th>Designation</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
                        <?php
                            if(isset($_SESSION['department'])){
                                $adminDept = $_SESSION['department'];
                            }
                            $empVerifySql = $con -> query("SELECT employee.employee_id, employee.fname, employee.lname, employee_type.type_name, academic_rank.rank_name, designation.designation_name 
                            FROM employee 
                            LEFT JOIN employee_leave ON employee.employee_id = employee_leave.employee_id 
                            LEFT JOIN leave_type ON employee_leave.leave_type = leave_type.type_id 
                            LEFT JOIN employee_type ON employee.employee_type = employee_type.type_id 
                            LEFT JOIN academic_rank ON employee.academic_rank = academic_rank.rank_id
                            LEFT JOIN designation ON employee.designation = designation.designation_id
                            WHERE employee.acc_status = 'Pending' AND employee.department = '$adminDept'
                            ");
                            while($employee = $empVerifySql -> fetch_assoc()){
                        ?>
						<tr>
							
							<td>
                            <small> <?=$employee['employee_id']?></small><br>
                            </td>
							<td>
								
								<small><?=$employee['fname'] . ' ' . $employee['lname']?> </small>
                            </td>
							
							<td><?=$employee['type_name']?></td>
							<td><?=$employee['rank_name'] ?? 'N/A' ?></td>
							<td><?=$employee['designation_name'] ?? 'N/A' ?></td>
							<td>
                            <div class="dropdown">
                                <button class="btn btn-flat btn-default btn-sm dropdown-toggle" onclick="toggleDropdown()" aria-expanded="false">Action</button>
                                <div class="dropdown-content" id="dropdownMenu">
                                    <a href="#" onclick="accAction('<?=($employee['employee_id'])?>', 'accept')"><i class="fa-solid fa-circle-check text-success"></i> Accept</a>
                                    <a href="#" onclick="accAction('<?=($employee['employee_id'])?>', 'reject')"><i class="fa-solid fa-circle-xmark text-danger"></i> Reject</a>
                                </div>
                            </div>

							</td>
						</tr>

                        <?php
                            }
                        ?>
					
				</tbody>
			</table>
		</div>
		
	</div>
</div>




<script>

    

    function accAction(empId, action){
       
        $.post('../ajax/acc_action.php', 
        {
            empId: empId,
            action: action
        }, 
        function(data, status){
            if(data === 'success'){
                $('#contents').load('verify_acc.php');
            }
            else{
                alert('Error');
            }
        });
    }
    function toggleDropdown() {
        var dropdownContent = document.getElementById("dropdownMenu");
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
        } else {
            dropdownContent.style.display = "block";
        }
    }
    
    
    
</script>





</body>
</html>
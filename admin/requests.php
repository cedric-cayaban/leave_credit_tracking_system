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
		<h3 class="card-title">List of Leave Requests</h3>
		<!-- <div class="card-tools">
			<a href="" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>Create New</a>
		</div> -->
	</div>
	<div class="card-body">
		
        <div class="container-fluid">
			<table class="table table-hover table-stripped">
				
				<colgroup>
                    <col width="10%">
					<col width="15%">
					<col width="15%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th>ID</th>
						<th>Employee</th>
						<th>Leave Type</th>
						<th>Days</th>
						<th>Reason</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
                        <?php
                            if(isset($_SESSION['department'])){
                                $adminDept = $_SESSION['department'];
                            }
                            $requestSql = $con -> query("SELECT * FROM 
                            employee_leave 
                            INNER JOIN employee ON employee_leave.employee_id=employee.employee_id 
                            INNER JOIN leave_type ON employee_leave.leave_type = leave_type.type_id 
                            WHERE employee_leave.status = 'Pending' AND employee.department = '$adminDept' ORDER BY leave_id DESC"
                            );
                            while($employee = $requestSql -> fetch_assoc()){
                        ?>
						<tr>  
							<td>
                                <input type="hidden" id="empId" value="<?=$employee['employee_id']?>">
                                <input type="hidden" id="cost" value="<?=$employee['credit_cost']?>">
                                <input type="hidden" id="sickCredits" value="<?=$employee['sick_credits']?>">
                                <input type="hidden" id="vacationCredits" value="<?=$employee['vacation_credits']?>">
                                <input type="hidden" id="leaveType" value="<?=$employee['leave_name']?>">
                                <small><?=$employee['employee_id']?></small><br>
                            </td>
							<td>
							    <small><?=$employee['fname'] . ' ' . $employee['lname']?> </small>
                            </td>
							
							<td><?=$employee['leave_name']?></td>
							<td><?=$employee['days']?></td>
							<td>
                                <button class="btn btn-flat btn-default btn-sm view_application" type="button" data-reason="<?=$employee['reason']?>">
                                    <i class="fa fa-eye text-primary"></i> View
                                </button>
							</td>
							<td>
                            <div class="dropdown">
                                <button class="btn btn-flat btn-default btn-sm dropdown-toggle" onclick="toggleDropdown()" aria-expanded="false">Action</button>
                                <div class="dropdown-content" id="dropdownMenu">
                                    <a href="#" onclick="reqAction('<?=($employee['leave_id'])?>', 'accept')"><i class="fa-solid fa-circle-check text-success"></i> Accept</a>
                                    <a href="#" onclick="reqAction('<?=($employee['leave_id'])?>', 'reject')"><i class="fa-solid fa-circle-xmark text-danger"></i> Reject</a>
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

    function toggleDropdown() {
        var dropdownContent = document.getElementById("dropdownMenu");
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
        } else {
            dropdownContent.style.display = "block";
        }
    }


    function reqAction(leaveId, action){
        var empId = $('#empId').val();
        var cost = $('#cost').val();
        var sickCredits = $('#sickCredits').val();
        var vacationCredits = $('#vacationCredits').val();
        var leaveType = $('#leaveType').val();

        $.post('../ajax/request_action.php', 
        {
            empId: empId,
            leaveId: leaveId,
            cost: cost,
            action: action,
            leaveType: leaveType,
            sickCredits: sickCredits,
            vacationCredits: vacationCredits
        }, 
        function(data, status){
            if(data === 'success'){ 
                $('#contents').load('requests.php');
            }
            else{
                alert('Error');
            }
        });
    }
    


    $(".view_application").click(function() {
        var reason = $(this).data('reason');
        $('#reason').text(reason);
        $('#applicationDetailsModal').modal('show');
    });
 
</script>

<div class="modal fade" id="applicationDetailsModal" tabindex="-1" aria-labelledby="applicationDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 600px;"> 
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="applicationDetailsModalLabel"> Reason of leave:</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="reason"></p>
            </div>
        </div>
    </div>
</div>



</body>
</html>
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
    <!-- Bootstrap Bundle with Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+I4dHt0YIvI3Mpjs4L+AdfYqlA3oWeBSwF8umNikyJZYhEN" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">My Leave requests</h3>
		<div class="card-tools">
			<a href="#" onclick="loadContent('new_request.php')" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-hover table-stripped">
				
				<colgroup>
					<col width="15%">
					<col width="10%">
					<col width="10%">
					<col width="15%">
					<col width="10%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th>Leave Type</th>
						<th>Days</th>
						<th>Credit Cost</th>
						<th>Date</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
                        <?php
							if(isset($_SESSION['employee_id'])){
								$employeeId = $_SESSION['employee_id'];
							}
							$requestSql = $con -> query("SELECT * FROM 
								employee_leave 
								INNER JOIN employee ON employee_leave.employee_id=employee.employee_id 
								INNER JOIN leave_type ON employee_leave.leave_type = leave_type.type_id 
								WHERE employee_leave.status = 'Pending' AND employee.employee_id = '$employeeId' ORDER BY leave_id DESC"
							);
                            while($employee = $requestSql -> fetch_assoc()){
                        ?>
						<tr>
							
							<td>
                            <?=$employee['leave_name']?>
                            </td>
							<td>
								
								<?=$employee['days']?> 
                            </td>
							
							<td><?=$employee['credit_cost']?></td>
							<td><?= date('F j, Y', strtotime($employee['date'])) ?></td>
							<td>
                            <?php if($employee['status'] == 'Approved'): ?>
									<b class="text-success">Approved</b>
								<?php elseif($employee['status'] == 'Denied'): ?>
									<b class="text-danger">Denied</b>
								<?php else: ?>
									<b class="text-primary">Pending</b>
								<?php endif; ?>
							</td>
							<td>
								<div class="dropdown">
									<button class="btn btn-flat btn-default btn-sm dropdown-toggle" onclick="toggleDropdown()" aria-expanded="false">Action</button>
									<div class="dropdown-content" id="dropdownMenu">
										<a href="#" onclick="reqAction('<?=($employee['leave_id'])?>', 'view')"><i class="fa fa-eye text-primary text-dark"></i> View</a>
										<a href="#" onclick="reqAction('<?=($employee['leave_id'])?>', 'cancel')"><i class="fa-solid fa-circle-xmark text-danger"></i> Cancel</a>
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

        $.post('../ajax/user_request_action.php', 
        {
            leaveId: leaveId,
            action: action
        }, 
        function(data, status){
            if(data === 'cancelled'){ 
                $('#contents').load('requests.php');
            }
			else if(data === 'error'){
				$('#employeeInfo').html('No data');
                $('#employeeModal').modal('show');
			}
            else{
                $('#employeeInfo').html(data);
                $('#employeeModal').modal('show');
            }
        });
    }
 
							
    
    
</script>

	<div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="employeeModalLabel">Leave Information</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body" id="employeeInfo">
				
				</div>
			</div>
		</div>
	</div>

</body>
</html>
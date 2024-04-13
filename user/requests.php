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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
	<script src="https://kit.fontawesome.com/9c6f27a8d7.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
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
			<table id="tableData" class="table table-striped">
				
				<colgroup>
					<col width="15%">
					<col width="10%">
					<col width="10%">
					<col width="15%">
					<col width="15%">
					<col width="10%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th>Leave Type</th>
						<th>Days</th>
						<th>Credit Cost</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
                        <?php
							if(isset($_SESSION['employee_id'])){
								$employeeId = $_SESSION['employee_id'];
							}
							$counter = 0;
							$requestSql = $con -> query("SELECT * FROM 
								employee_leave 
								INNER JOIN employee ON employee_leave.employee_id=employee.employee_id 
								INNER JOIN leave_type ON employee_leave.leave_type = leave_type.type_id 
								WHERE employee_leave.status = 'Pending' AND employee.employee_id = '$employeeId' ORDER BY leave_id DESC"
							);
                            while($employee = $requestSql -> fetch_assoc()){
							$counter++;
                        ?>
						<tr>
								<?php
                                    echo '<input type="hidden" id="empId' . $counter . '" value="' . $employee['employee_id'] . '">';
                                    echo '<input type="hidden" id="leaveId' . $counter . '" value="' . $employee['leave_id'] . '">';
                                    echo '<input type="hidden" id="cost' . $counter . '" value="' . $employee['credit_cost'] . '">';
                                    echo '<input type="hidden" id="sickCredits' . $counter . '" value="' . $employee['sick_credits'] . '">';
                                    echo '<input type="hidden" id="vacationCredits' . $counter . '" value="' . $employee['vacation_credits'] . '">';
                                    echo '<input type="hidden" id="leaveType' . $counter . '" value="' . $employee['leave_name'] . '">';
                                ?>
							<td>
                            <?=$employee['leave_name']?>
                            </td>
							<td>
								
								<?=$employee['days']?> 
                            </td>
							
							<td><?=$employee['credit_cost']?></td>
							<td><?= date('F j, Y', strtotime($employee['start_date'])) ?></td>
							<td><?= date('F j, Y', strtotime($employee['end_date'])) ?></td>
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
									<button class="btn btn-flat btn-default btn-sm dropdown-toggle" onclick="toggleDropdown(<?=$counter?>)" aria-expanded="false">Action</button>
									<div class="dropdown-content" id="dropdownMenu<?=$counter?>">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

<script>

	$(document).ready(function() {
        $('#tableData').DataTable({
            searching: true
        });
    });

	function toggleDropdown(counter) {
        var dropdownContent = document.getElementById("dropdownMenu" + counter);
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
        } else {
            dropdownContent.style.display = "block";
        }
    }



    function reqAction(leaveId, action){ 

        $.post('../ajax/user/user_request_action.php', 
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
					<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body" id="employeeInfo">
				
				</div>
			</div>
		</div>
	</div>

</body>
</html>
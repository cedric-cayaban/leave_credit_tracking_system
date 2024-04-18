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
			<table id="tableData" class="table table-striped">
				
				<colgroup>
                    <col width="10%">
					<col width="15%">
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
						<th>Start date</th>
                        <th>End date</th>
						<th>Uploads</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
                        <?php
                            if(isset($_SESSION['department'])){
                                $adminDept = $_SESSION['department'];
                            }
                            $counter = 0;
                            $sickChecker = false;
                            $requestSql = $con -> query("SELECT * FROM 
                            employee_leave 
                            INNER JOIN employee ON employee_leave.employee_id=employee.employee_id 
                            INNER JOIN leave_type ON employee_leave.leave_type = leave_type.type_id 
                            WHERE employee_leave.status = 'Pending' AND employee.department = '$adminDept' ORDER BY leave_id DESC"
                            );
                           
                            while($employee = $requestSql -> fetch_assoc()){
                            $counter++;
                        ?>
						<tr>  
							<td>
                                <?php
                                    echo '<input type="hidden" id="empId' . $counter . '" value="' . $employee['employee_id'] . '">';
                                    echo '<input type="hidden" id="leaveId' . $counter . '" value="' . $employee['leave_id'] . '">';
                                    echo '<input type="hidden" id="cost' . $counter . '" value="' . $employee['credit_cost'] . '">';
                                    echo '<input type="hidden" id="sickCredits' . $counter . '" value="' . $employee['sick_credits'] . '">';
                                    echo '<input type="hidden" id="vacationCredits' . $counter . '" value="' . $employee['vacation_credits'] . '">';
                                    echo '<input type="hidden" id="leaveType' . $counter . '" value="' . $employee['leave_name'] . '">';
                                    
                                ?>
                                <input type="hidden" id="medicalCertificate<?=$counter?>" value="<?=$employee['med_cert']?>">
                                <input type="hidden" id="leaveForm<?=$counter?>" value="<?=$employee['leave_form']?>">

                                <small><?=$employee['employee_id']?></small><br>
                            </td>
							<td>
							    <small><?=$employee['fname'] . ' ' . $employee['lname']?> </small>
                            </td>
							
							<td><?=$employee['leave_name']?></td>
                            <?php if($employee['leave_type'] == 2) $sickChecker = true; ?>
							<td><?= date("F j, Y", strtotime($employee['start_date'])) ?></td>
                            <td><?= date("F j, Y", strtotime($employee['end_date'])) ?></td>
							<td>
                            <div class="dropdown">
                                <button class="btn btn-flat btn-default btn-sm dropdown-toggle" onclick="toggleFiles(<?=$counter?>)" aria-expanded="false">Select</button>
                                <div class="dropdown-content" id="filesMenu<?=$counter?>">
                                    <?php
                                    if($sickChecker){
                                        echo '<a href="#"onclick="selectForm(\'medical\', ' . $counter . ')"><i class="fas fa-file-medical"></i> Med Certificate</a>';
                                    }
                                
                                    ?>

                                    <a href="#"onclick="selectForm('leave', <?=$counter?>)"><i class="fas fa-file-alt"></i> Leave Form</a>
                                </div>
                            </div>
							</td>
							<td>
                            <div class="dropdown">
                                <button class="btn btn-flat btn-default btn-sm dropdown-toggle" onclick="toggleAction(<?=$counter?>)" aria-expanded="false">Action</button>
                                <div class="dropdown-content" id="actionMenu<?=$counter?>">
                                <a href="#" onclick="reqAction(<?=$counter?>, 'view')"><i class="fa fa-eye text-primary"></i> View</a>
                                    <a href="#" onclick="reqAction(<?=$counter?>, 'accept')"><i class="fa-solid fa-circle-check text-success"></i> Accept</a>
                                    <a href="#" onclick="rejectAction(<?=$counter?>, 'reject')"><i class="fa-solid fa-circle-xmark text-danger"></i> Reject</a>
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

    function toggleAction(counter) {
       
        var dropdownContent = document.getElementById("actionMenu" + counter);
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
        } else {
            dropdownContent.style.display = "block";
        }
    }

    function toggleFiles(counter) {
        
        var dropdownContent = document.getElementById("filesMenu" + counter);
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
        } else {
            dropdownContent.style.display = "block";
        }
    }


    function reqAction(counter, action){
        var empId = $('#empId' + counter).val();
        var leaveId = $('#leaveId' + counter).val();
        var cost = $('#cost'+ counter).val();
        var sickCredits = $('#sickCredits' + counter).val();
        var vacationCredits = $('#vacationCredits' + counter).val();
        var leaveType = $('#leaveType' + counter).val();
        
        $.post('../ajax/admin/admin_request_action.php', 
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
            else if(data === 'error'){
                alert(data);
            }
            else{
                $('#employeeInfo').html(data);
                $('#employeeModal').modal('show');
            }
        });
    }
    
    $("#show_forms").click(function() {
        $('#formsModal').modal('show');
    });

    function selectForm(formType, counter) {
        var fileName;
        if (formType === 'medical') {
            fileName = $('#medicalCertificate' + counter).val();
            if (fileName) {
                window.open('images/' + fileName, '_blank');
            } else {
                alert('No medical certificate uploaded.');
            }
        } else if (formType === 'leave') {
            fileName = $('#leaveForm' + counter).val();
            if (fileName) {
                window.open('images/' + fileName, '_blank');
            } else {
                alert('No leave form uploaded.');
            }
        }
        $('#formsModal').modal('hide');
    }

    function rejectAction(counter, action) {
       
        $('#rejectionReasonModal').modal('show');

        $('#confirmRejection').click(function() {
           
            var rejectReason = $('#rejectionReason').val();

           
            $.post('../ajax/admin/admin_request_action.php', {
                empId: $('#empId' + counter).val(),
                leaveId: $('#leaveId' + counter).val(),
                cost: $('#cost' + counter).val(),
                action: action,
                leaveType: $('#leaveType' + counter).val(),
                sickCredits: $('#sickCredits' + counter).val(),
                vacationCredits: $('#vacationCredits' + counter).val(),
                rejectReason: rejectReason 
            }, function(data, status) {
                if (data === 'success') {
                    $('#rejectionReasonModal').modal('hide');
                    // $('#contents').load('requests.php');
                } else if (data === 'error') {
                    alert(data);
                }
                else{
                    alert(data);
                }
            });

            
            $('#contents').load('requests.php');
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

    <div class="modal fade" id="rejectionReasonModal" tabindex="-1" aria-labelledby="rejectionReasonModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectionReasonModalLabel">Enter Rejection Reason</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <textarea id="rejectionReason" class="form-control" placeholder="Enter reason for rejection"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmRejection">OK</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formsModal" tabindex="-1" aria-labelledby="formsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formsModalLabel">Select Form</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center"> 
                    <div class="col">
                            <?php
                                if($sickChecker){
                                    echo '<button class="btn btn-primary" onclick="selectForm(\'medical\', ' . $counter . ')">Medical Certificate</button>';
                                }
                            
                            ?>
                            <button class="btn btn-primary" onclick="selectForm('leave', <?=$counter?>)">Leave Form</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





</body>
</html>
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
		<h3 class="card-title">Leave Report History</h3>
	</div>
	<div class="card-body">
		
        <div class="container-fluid">
			<table id="tableData" class="table table-hover table-stripped">
				
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
						<th>Reason</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
                        <?php
                            if(isset($_SESSION['employee_id'])){
                                $employeeId = $_SESSION['employee_id'];
                            }
                            $reportSql = $con -> query("SELECT * FROM 
                                employee_leave 
                                INNER JOIN employee ON employee_leave.employee_id=employee.employee_id 
                                INNER JOIN leave_type ON employee_leave.leave_type = leave_type.type_id 
                                WHERE employee.employee_id = '$employeeId' AND  employee_leave.status = 'Accepted' OR employee_leave.status = 'Rejected' OR employee_leave.status = 'Canceled'" 
                            );
                            while($employee = $reportSql -> fetch_assoc()){
                        ?>
						<tr>
							
							<td><?=$employee['leave_name']?></td>
							<td><?=$employee['days']?></td>
							<td><?=$employee['credit_cost']?></td>
							<td><?= date('F j, Y', strtotime($employee['date'])) ?></td>
							<td>
                                <button class="btn btn-flat btn-default btn-sm view_application" type="button" data-reason="<?=$employee['reason']?>">
                                    <i class="fa fa-eye text-primary"></i> View
                                </button>
							</td>
							<td>
                            <?php if($employee['status'] == 'Accepted'): ?>
									<b class="text-success">Approved</b>
								<?php elseif($employee['status'] == 'Rejected'): ?>
									<b class="text-danger">Denied</b>
                                    <?php elseif($employee['status'] == 'Canceled'): ?>
									<b class="text-muted">Canceled</b>
								<?php else: ?>
									<b class="text-primary">Pending</b>
								<?php endif; ?>

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
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="reason"></p>
            </div>
        </div>
    </div>
</div>




</body>
</html>
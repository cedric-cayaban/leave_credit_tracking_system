<?php
    require('../config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/contents.css">
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
		<!-- <div class="card-tools">
			<a href="?page=leave_applications/manage_application" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a>
		</div> -->
	</div>
	<div class="card-body">
		
        <div class="container-fluid">
			<table class="table table-hover table-stripped">
				
				<colgroup>
					<col width="10%">
					<col width="25%">
					<col width="25%">
					<col width="15%">
					<col width="15%">
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
							<td><?=$employee['rank_name']?></td>
							<td><?=$employee['designation_name']?></td>
							<td>
                                <div class="dropdown">
                                    <button class="btn btn-flat btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      
                                        <li><a onclick="accAction('<?=$employee['employee_id']?>', 'accept')" class="dropdown-item" href="#"><i class="fa-solid fa-circle-check text-success"></i> Accept</a></li>
                                        <li><a onclick="accAction('<?=$employee['employee_id']?>', 'reject')" class="dropdown-item update_status" href="#"><i class="fa-solid fa-circle-xmark text-danger"></i> Reject</a></li>

                                    </ul>
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
    
    
</script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+I4dHt0YIvI3Mpjs4L+AdfYqlA3oWeBSwF8umNikyJZYhEN" crossorigin="anonymous"></script>

</body>
</html>
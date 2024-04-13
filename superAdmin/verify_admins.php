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
		<h3 class="card-title">Verify Employee Accounts</h3>
    <!-- NUMBER 2 -->
    <!-- ANDITO BUTTON PARA SA CREATE NEW NAKA COMMENT OUT LANG, -->

		<!-- <div class="card-tools">
			<a href="" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a>
		</div> -->

    <!-- ANDITO BUTTON PARA SA CREATE NEW NAKA COMMENT OUT LANG, -->
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
				</colgroup>
				<thead>
					<tr>
						<th>admin ID</th>
						<th>First name</th>
						<th>Middle name</th>
						<th>Last name</th>
						<th>Department</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
                        <?php
                            
                            $counter = 0;
                            $adminVerifySql = $con -> query("SELECT * FROM admin
                            LEFT JOIN department ON admin.department=department.dept_id
                            WHERE admin.acc_status = 'Pending'
                            ");
                            while($admin = $adminVerifySql -> fetch_assoc()){
                            $counter++;
                        ?>
						<tr>
							
							<td>
                                <?php
                                    echo '<input type="hidden" id="adminId' . $counter . '" value="' . $admin['admin_id'] . '">';
                                ?>
                            <small> <?=$admin['admin_id']?></small><br>
                            </td>
							<td>
								
								<small><?=$admin['fname']?> </small>
                            </td>
							
							<td><?=$admin['mname']?></td>
							<td><?=$admin['lname']?></td>
							<td><?=$admin['dept_name']?></td>
							<td>
                            <div class="dropdown">
                                <button class="btn btn-flat btn-default btn-sm dropdown-toggle" onclick="toggleDropdown(<?=$counter?>)" aria-expanded="false">Action</button>
                                <div class="dropdown-content" id="dropdownMenu<?=$counter?>">
                                    <a href="#" onclick="accAction(<?=$counter?>, 'accept')"><i class="fa-solid fa-circle-check text-success"></i> Accept</a>
                                    <a href="#" onclick="accAction(<?=$counter?>, 'reject')"><i class="fa-solid fa-circle-xmark text-danger"></i> Reject</a>
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

    

    function toggleDropdown(counter) {
        var dropdownContent = document.getElementById("dropdownMenu" + counter);
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
        } else {
            dropdownContent.style.display = "block";
        }
    }

    function accAction(counter, action){
        var adminId = $('#adminId' + counter).val();
       
        $.post('../ajax/super_admin/acc_action.php', 
        {
            adminId: adminId,
            action: action
        }, 
        function(data, status){
            if(data === 'success'){
                $('#contents').load('verify_admins.php');
            }
            else{
                alert(data);
            }
        });
    }

    
    
    
    
</script>





</body>
</html>
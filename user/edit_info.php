<?php
    require('../config.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/register.css?ver=0011">

        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/979ee355d9.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>Document</title>
</head>
<body>
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
            LEFT JOIN working_status ON employee.working_status = working_status.status_id
            WHERE employee.employee_id = '$employeeId'
            "); 
            while($employee = $infoSql -> fetch_assoc()){
    ?>
    
   <div class="header">
        <h1>Employee Information</h1>
    </div>
    <div class="card card-outline card-primary">
            <div class="card-body">
                <div class="container-fluid">
                    <form action="" id="manage-user">	
                        <div class="row">
                            <div class="col-6">
                                <input type="hidden" id='empId' value='<?=$employee['employee_id']?>'>
                                <div class="form-group">
                                    <label for="firstname">First Name</label>
                                    <input type="text" name="firstname" id="firstname" class="form-control rounded-0" value="<?=$employee['fname']?>" >
                                </div>
                                <div class="form-group">
                                    <label for="middlename">Middle Name</label>
                                    <input type="text" name="middlename" id="middlename" class="form-control rounded-0" value="<?=$employee['mname']?>" >
                                </div>
                                <div class="form-group">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" name="lastname" id="lastname" class="form-control rounded-0" value="<?=$employee['lname']?>" >
                                </div>
                                <div class="form-group">
                                    <label for="birthdate">Birthdate</label>
                                    <input type="date" name="birthdate" id="birthdate" class="form-control rounded-0" value="<?= $employee['birthdate']?>" >
                                </div>
                                
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea rows="5" name="address" id="address" class="form-control rounded-0" style="resize:none !important" ><?= $employee['address']?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="date_hired">Date hired</label>
                                    <input type="date" name="date_hired" id="date_hired" class="form-control rounded-0" value="<?= $employee['date_hired']?>" >
                                </div>
                            
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="contact">Contact #</label>
                                    <input type="number" name="contact" id="contact" class="form-control rounded-0" value="<?= $employee['contact']?>" >
                                </div>
                                <div class="form-group">
                                    <label for="department">Department</label>
                                    <select name="department" id="department" class="form-control select2bs4 select2 rounded-0" data-placeholder="Please Select Department here" reqiured>
                                        <option value="<?= $employee['department']?>">-- <?= $employee['dept_name']?> --</option>
                                        <?php while($department = $departmentSql -> fetch_assoc()){ ?>
                                            <option value="<?=$department['dept_id'] ?>"><?=$department['dept_name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="employee_type">Employee type</label>
                                    <select name="employee_type" id="employee_type" class="form-control select2bs4 select2 rounded-0" data-placeholder="Please Select Department here" reqiured>
                                        <option value="<?= $employee['employee_type']?>">-- <?= $employee['type_name'] ?? 'N/A'?> --</option>
                                        <?php while($employeeType = $empTypeSql -> fetch_assoc()){ ?>
                                            <option value="<?=$employeeType['type_id'] ?>"><?=$employeeType['type_name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="working_status">Working status</label>
                                    <select name="working_status" id="working_status" class="form-control select2bs4 select2 rounded-0" data-placeholder="Please Select Department here" reqiured>
                                        <option value="<?= $employee['status_id']?>">-- <?= $employee['status_name'] ?? 'N/A'?> --</option>
                                        <?php while($status = $statusSql -> fetch_assoc()){ ?>
                                            <option value="<?=$status['status_id'] ?>"><?=$status['status_name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="rank">Academic rank</label>
                                    <select name="rank" id="rank" class="form-control select2bs4 select2 rounded-0" data-placeholder="Please Select Department here" reqiured>
                                        <option value="<?= $employee['academic_rank']?>">-- <?= $employee['rank_name'] ?? 'N/A'?> --</option>
                                        <?php while($rank = $rankSql -> fetch_assoc()){ ?>
                                            <option value="<?=$rank['rank_id']?>"><?=$rank['rank_name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="designation">Designation </label>
                                    <select name="designation" id="designation" class="form-control select2bs4 select2 rounded-0" data-placeholder="Please Select Designation here" reqiured>
                                        <option value="<?= $employee['designation']?>">-- <?= $employee['designation_name'] ?? 'N/A'?> --</option>
                                        <?php while($designation = $designationSql -> fetch_assoc()){ ?>
                                            <option value="<?=$designation['designation_id']?>"><?=$designation['designation_name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
        
        <?php } ?>
        <div class="registerBtn">
            <button id='save'>Save</button>
            
        </div>
        
    <script>
        $('#save').click(function(){
            var empId = $('#empId').val();
            var fname = $('#firstname').val();
            var mname = $('#middlename').val();
            var lname = $('#lastname').val();
            var birthdate = $('#birthdate').val();
            var address = $('#address').val();
            var contact = $('#contact').val();
            var employee_type = $('#employee_type').val();
            var rank = $('#rank').val();
            var department = $('#department').val();
            var designation = $('#designation').val();
            var date_hired = $('#date_hired').val();
            var working_status = $('#working_status').val();

            if(empId !== '' || fname !== '' || mname !== '' || lname !== '' || birthdate !== '' || address !== '' || contact !== '' || employee_type !== '' || department !== '' || date_hired !== '' || working_status !== ''){
                $.post('../ajax/user/save_info.php',
                {
                    empId: empId,
                    fname: fname, 
                    contact: contact,
                    mname: mname, 
                    employee_type: employee_type,
                    lname: lname, 
                    rank: rank,
                    department: department,
                    birthdate: birthdate, 
                    designation: designation,
                    address: address, 
                    date_hired: date_hired,
                    working_status: working_status
                    
                }, 
                function(data, status){
                    data = data.trim();
                    if(data === 'success'){
                        Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Information saved'
                            }).then((result) =>{
                                loadContent('edit_info.php');
                                if(result.isConfirmed){
                                    loadContent('credits.php');
                                }
                            });
                    }
                    else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data,
                        });
                    }
                });
            }
            else{
                Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please fill out all required fields.'
                });
            }
            
            
            
        });
    </script>
</body>
</html>
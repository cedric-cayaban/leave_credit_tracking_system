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
            WHERE employee.employee_id = '$employeeId'
            "); 
            while($employee = $infoSql -> fetch_assoc()){
    ?>
   <div class="header">
        <h1>New Leave</h1>
    </div>
    <div class="card-container">
        <div class="card card-outline card-primary">
            <div class="card-body">
                <div class="container-fluid">
                    <form action="" id="manage-user">	
                        <div class="row">
                            <div class="col m-auto">
                                <div class="form-group">
                                    <label for="department">Leave Type</label>
                                    <select name="department" id="department" class="form-control select2bs4 select2 rounded-0" data-placeholder="Please Select Department here" reqiured>
                                        
                                        <?php while($leaveType = $leaveTypeSql -> fetch_assoc()){ ?>
                                            <option value="<?=$leaveType['type_id'] ?>"><?=$leaveType['leave_name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="employee_type">Date</label>
                                    <input type="date" name="date" id="date" class="form-control rounded-0" value="">
                                </div>
                                <div class="form-group">
                                    <label for="rank">Days</label>
                                    <input type="number" name="days" id="days" class="form-control rounded-0" value="" >
                                </div>
                                <div class="form-group">
                                    <label for="designation">Credits cost</label>
                                    <input type="number" disabled name="days" id="days" class="form-control rounded-0" value="0" >
                                </div>
                                <div class="form-group">
                                    <label for="designation">Reason</label>
                                    <textarea rows="5" name="address" id="address" class="form-control rounded-0" style="resize:none !important" ></textarea>
                                </div>
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
    
        
        <?php } ?>
        <div class="registerBtn">
            <button id='register'>Apply</button>
            
        </div>
        
    <script>
        $('#register').click(function(){
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
            
            
            $.post('../ajax/save_info.php',
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
                
            }, 
            function(data, status){
                data = data.trim();
                if(data === 'success'){

                    Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Registration successful'
                        }).then((result) =>{
                            loadContent('edit_info.php');
                            if(result.isConfirmed){
                                window.location.href = '../index.php';
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
        });
    </script>
</body>
</html>
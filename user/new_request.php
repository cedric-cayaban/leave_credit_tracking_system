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
                                    <input type="hidden" id="empId" value="<?=$employee['employee_id']?>">
                                    <label for="leave_type">Leave Type</label>
                                    <select name="leave_type" id="leave_type" class="form-control select2bs4 select2 rounded-0">
                                        <?php while($leaveType = $leaveTypeSql -> fetch_assoc()){ ?>
                                            <option value="<?=$leaveType['type_id'] ?>"><?=$leaveType['leave_name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="date">Start Date</label>
                                    <input type="date" name="endDate" id="start_Date" class="form-control rounded-0">
                                </div>
                                <div class="form-group">
                                    <label for="date">End Date</label>
                                    <input type="date" name="endDate" id="end_Date" class="form-control rounded-0" onchange="computeCredit()">
                                </div>
                                <input type="hidden" id="days">
                                <div class="form-group">
                                    
                                    <label for="rank">Leave length</label>
                                    <select name="leave_length" id="leave_length" class="form-control select2bs4 select2 rounded-0" onchange="computeCredit()">
                                            <option value="whole">Whole day</option>
                                            <option value="half">Half day</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="cost">Credits cost</label>
                                    <input type="number" disabled name="cost" id="cost" class="form-control rounded-0" value="" >
                                </div>
                                <div class="form-group">
                                    <label for="reason">Reason</label>
                                    <textarea rows="5" name="reason" id="reason" class="form-control rounded-0" style="resize:none !important" ></textarea>
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
            <button id='submit'>Submit</button>
            
        </div>
        
    <script>

        function computeCredit(){
            var leaveType =  $('#leave_type').val();
            var startDate = new Date($('#start_Date').val());
            var endDate = new Date($('#end_Date').val());
            var leaveLength = $('#leave_length').val();
            var days;
            var creditCost;
            
            days = (endDate - startDate) / (1000 * 3600 * 24);
           
            
            if(leaveLength == 'whole'){
                creditCost = days * 1;
                $("#cost").val(creditCost);
                $("#days").val(creditCost);
            }
            
            else if(leaveLength == 'half'){
                creditCost = days * 0.5;
                $("#cost").val(creditCost);
                $("#days").val(creditCost);
            }
            
           
        }

        $('#submit').click(function(){
            var empId = $('#empId').val();
            var type =  $('#leave_type').val();
            var date = $('#start_Date').val();
            var days = $('#days').val();
            var cost = $('#cost').val();
            var reason = $('#reason').val();
            
            $.post('../ajax/new_request_ajax.php',
                {
                    empId: empId,
                    type: type,
                    date: date,
                    days: days,
                    cost: cost,
                    reason: reason
                    
                }, 
                function(data, status){
                    data = data.trim();
                    if(data === 'success'){
                        Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Application successful'
                            }).then((result) => {
                                if(result.isConfirmed){
                                    loadContent('requests.php');
                                }
                            });
                        
                    }
                    else if(data === 'insufficient'){
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Insufficient leave credits',
                            }).then((result) => {
                                if(result.isConfirmed){
                                    loadContent('requests.php');
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
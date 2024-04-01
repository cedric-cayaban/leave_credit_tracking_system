<?php
    require('../config.php');

    $empId = $_POST['empId'];
    $leaveId = $_POST['leaveId'];
    $action = $_POST['action'];
    $cost = $_POST['cost'];
    $vacationCredits = $_POST['vacationCredits'];
    $sickCredits = $_POST['sickCredits'];
    $leaveType = $_POST['leaveType'];
   

    if($action == 'accept'){
        $acceptLeaveSql = $con -> query("UPDATE employee_leave SET employee_leave.status = 'Accepted' WHERE employee_leave.leave_id = '$leaveId'");
        if($acceptLeaveSql){
            if($leaveType == 'Vacation leave'){
                $totalVCredits = $vacationCredits - $cost;
                $updateVacationSql = $con -> query("UPDATE employee SET employee.vacation_credits = $totalVCredits WHERE employee.employee_id = '$empId'");
                echo 'success';
            }

            else if($leaveType == 'Sick leave'){
                $totalCCredits = $sickCredits - $cost;
                $updateSickSql = $con -> query("UPDATE employee SET employee.sick_credits = $totalCCredits WHERE employee.employee_id = '$empId'");
                echo 'success';
            }
            else{
                // echo 'error';
                echo $con->error;
            }
            
        }
    }
    else if($action == 'reject'){
        $rejectLeaveSql = $con -> query("UPDATE employee_leave SET employee_leave.status = 'Rejected' WHERE employee_leave.leave_id = '$leaveId'");
        if($rejectLeaveSql){
            echo 'success';
        }
    }
    else{
        echo 'error';
    }
    

?>
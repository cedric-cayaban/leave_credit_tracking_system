<?php
    require('../../config.php');

    $empId = $_POST['empId'];
    $leaveId = $_POST['leaveId'];
    $action = $_POST['action'];
    $cost = $_POST['cost'];
    $vacationCredits = $_POST['vacationCredits'];
    $sickCredits = $_POST['sickCredits'];
    $leaveType = $_POST['leaveType'];

    if(isset($_POST['rejectReason']) && !empty($_POST['rejectReason'])) {
        $rejectReason = $_POST['rejectReason'];
    }
   

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
                echo 'error';
                // echo $con->error;
            }
            
        }
    }
    else if($action == 'view'){
        $employeeInfoSql = $con->query("SELECT * FROM 
                                    employee 
                                    INNER JOIN employee_leave ON employee.employee_id=employee_leave.employee_id 
                                    INNER JOIN leave_type ON employee_leave.leave_type=leave_type.type_id 
                                    WHERE employee_leave.leave_id = '$leaveId'");

        if($employeeInfoSql){
            $employee = $employeeInfoSql->fetch_assoc();

            $html = '<p><strong>First Name:</strong> ' . $employee['fname'] . '</p>';
            $html .= '<p><strong>Middle Name:</strong> ' . $employee['mname'] . '</p>';
            $html .= '<p><strong>Last Name:</strong> ' . $employee['lname'] . '</p>';
            $html .= '<p><strong>Leave Type:</strong> ' . $employee['leave_name'] . '</p>';
            $html .= '<p><strong>Days:</strong> ' . $employee['days'] . '</p>';
            $html .= '<p><strong>Credit Cost:</strong> ' . $employee['credit_cost'] . '</p>';
            $html .= '<p><strong>Start Date:</strong> ' . date('F j, Y', strtotime($employee['start_date'])) . '</p>';
            $html .= '<p><strong>End Date:</strong> ' . date('F j, Y', strtotime($employee['end_date'])) . '</p>';
            $html .= '<p><strong>Reason:</strong> ' . $employee['reason'] . '</p>';
            
            echo $html;
        }
    }
    else if($action == 'reject'){
        $rejectLeaveSql = $con -> query("UPDATE employee_leave SET employee_leave.status = 'Rejected', employee_leave.reject_reason = '$rejectReason' WHERE employee_leave.leave_id = '$leaveId'");
        if($rejectLeaveSql){
            echo 'success';
        }
    }
    else{
        echo 'error';
    }


    

?>
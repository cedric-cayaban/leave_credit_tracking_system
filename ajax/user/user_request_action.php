<?php
    require('../../config.php');

    $leaveId = $_POST['leaveId'];
    $action = $_POST['action'];

    if($action == 'view'){
        $employeeInfoSql = $con->query("SELECT * FROM 
                                    employee_leave 
                                    INNER JOIN employee ON employee_leave.employee_id=employee.employee_id 
                                    INNER JOIN leave_type ON employee_leave.leave_type = leave_type.type_id 
                                    WHERE leave_id = '$leaveId'");
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
    else if($action == 'cancel'){
        $rejectLeaveSql = $con -> query("UPDATE employee_leave SET employee_leave.status = 'Canceled' WHERE employee_leave.leave_id = '$leaveId'");
        if($rejectLeaveSql){
            echo 'cancelled';
        }
    }
    else if($action == 'reason'){
        $employeeInfoSql = $con->query("SELECT * FROM 
                                    employee_leave 
                                    INNER JOIN employee ON employee_leave.employee_id=employee.employee_id 
                                    INNER JOIN leave_type ON employee_leave.leave_type = leave_type.type_id 
                                    WHERE leave_id = '$leaveId'");
        if($employeeInfoSql){
            $reason = $employeeInfoSql -> fetch_assoc();
            echo $reason['reject_reason'];
        }
    }
    else{
        echo 'error';
    }
    

?>
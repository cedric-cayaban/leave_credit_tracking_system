<?php
    require('../config.php');

    $leaveId = $_POST['leaveId'];
    $action = $_POST['action'];

    if($action == 'accept'){
        $acceptLeaveSql = $con -> query("UPDATE employee_leave SET employee_leave.status = 'Accepted' WHERE employee_leave.leave_id = '$leaveId'");
        if($acceptLeaveSql){
            echo 'success';
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
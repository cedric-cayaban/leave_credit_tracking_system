<?php
    require('../../config.php');

    $empId = $_POST['empId'];
    $action = $_POST['action'];

    if($action == 'accept'){
        $acceptLeaveSql = $con -> query("UPDATE employee SET employee.acc_status = 'Accepted' WHERE employee.employee_id = '$empId'");
        if($acceptLeaveSql){
            echo 'success';
        }
    }
    else if($action == 'reject'){
        $rejectLeaveSql = $con -> query("UPDATE employee SET employee.acc_status = 'Rejected' WHERE employee.employee_id = '$empId'");
        if($rejectLeaveSql){
            echo 'success';
        }
    }
    else{
        echo 'error';
    }
    

?>
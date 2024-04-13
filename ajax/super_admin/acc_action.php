<?php
    require('../../config.php');

    $adminId = $_POST['adminId'];
    $action = $_POST['action'];

    if($action == 'accept'){
        $acceptLeaveSql = $con -> query("UPDATE admin SET admin.acc_status = 'Accepted' WHERE admin.admin_id = '$adminId'");
        if($acceptLeaveSql){
            echo 'success';
        }
    }
    else if($action == 'reject'){
        $rejectLeaveSql = $con -> query("UPDATE admin SET admin.acc_status = 'Rejected' WHERE admin.admin_id = '$adminId'");
        if($rejectLeaveSql){
            echo 'success';
        }
    }
    else{
        echo 'Error: ' . mysqli_error($con);
    }
    

?>
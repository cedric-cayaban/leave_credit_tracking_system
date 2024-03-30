<?php
    session_start();
    if(isset($_SESSION['admin_id'])){
        session_destroy();
        echo 'success';
    }

    if(isset($_SESSION['employee_id'])){
        session_destroy();
        echo 'success';
    }
    
    
?>
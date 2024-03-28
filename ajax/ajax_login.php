<?php
    require '../config.php';
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $employeeSql = $con -> query("SELECT employee.employee_id, employee.username, employee.password FROM employee WHERE employee.username = '$username' AND employee.password = '$password'");
    $adminSql = $con -> query("SELECT admin.admin_id, admin.username, admin.password FROM admin WHERE admin.username = '$username' AND admin.password = '$password'");

    if(mysqli_num_rows($employeeSql) >=1 ){
        $employee = $employeeSql -> fetch_assoc();
        if($username == $employee['username'] && $password == $employee['password']){
            $_SESSION['employee_id'] = $employee['employee_id'];
            echo 'success';
        }
        
    }
    else if(mysqli_num_rows($adminSql) >=1 ){
        $admin = $adminSql -> fetch_assoc();
        if($username == $admin['username'] && $password == $admin['password']){
            $_SESSION['admin_id'] = $admin['admin_id'];
            echo 'success';
        }
        
    }
    else{
        echo 'error';
    }
    
    
   


?>
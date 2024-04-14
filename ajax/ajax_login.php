<?php
    require '../config.php';
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $employeeSql = $con -> query("SELECT * FROM employee WHERE employee.username = '$username' AND employee.password = '$password' AND employee.acc_status = 'Accepted'");
    $adminSql = $con -> query("SELECT * FROM admin WHERE admin.username = '$username' AND admin.password = '$password' AND admin.acc_status = 'Accepted'");
    $superAdminSql = $con -> query("SELECT * FROM super_admin WHERE super_admin.username = '$username' AND super_admin.password = '$password'");

    if(mysqli_num_rows($employeeSql) >=1 ){
        $employee = $employeeSql -> fetch_assoc();
        if($username == $employee['username'] && $password == $employee['password']){
            $_SESSION['employee_id'] = $employee['employee_id'];
            echo 'success1';
           
        }
        
    }
    else if(mysqli_num_rows($adminSql) >=1 ){
        $admin = $adminSql -> fetch_assoc();
        if($username == $admin['username'] && $password == $admin['password']){
            $_SESSION['admin_id'] = $admin['admin_id'];
            $_SESSION['department'] = $admin['department'];
            echo 'success2';
           
        }
        
    }
    else if(mysqli_num_rows($superAdminSql) >=1 ){
        $superAdmin = $superAdminSql -> fetch_assoc();
        if($username == $superAdmin['username'] && $password == $superAdmin['password']){
            echo 'success3';
           
        }
        
    }
    else{
        echo 'error';
    }
    
    
   


?>
<?php
    require('../config.php');
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $birthdate = $_POST['birthdate'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $department = $_POST['department'];
    $employee_type = $_POST['employee_type'];
    $rank = $_POST['rank'];
    $designation = $_POST['designation'];
   

   $regSql = $con->query("INSERT INTO employee(username, password, fname, mname, lname, birthdate, contact, address, department, employee_type, academic_rank, designation) 
    VALUES('$username', '$password', '$fname', '$mname', '$lname', '$birthdate', '$contact', '$address', '$department', '$employee_type', " . ($rank !== '' ? "'$rank'" : "NULL") . ", " . ($designation !== '' ? "'$designation'" : "NULL") . ")");


    
    if ($regSql) {
        echo "success";
    } else {
        echo "Error: " . $con->error;
    }
?>


<?php
    require '../config.php';
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $employeeSql = $con -> query("SELECT employee.employee_id, employee.username, employee.password FROM employee WHERE username = '$username' AND password = '$password'");
    $adminSql = $con -> query("SELECT admin.admin_id, admin.username, admin.password FROM admin WHERE username = '$username' AND password = '$password'");

    if($employeeSql){
        $employee = $employee -> fetch_assoc();
        if($username == $employee['username'] && $password == $employee['password']){
            $_SESSION['employee_id'] = $employee['employee_id'];
            echo 'success';
        }
    }
    else{
        
    }
    
    
    


?>


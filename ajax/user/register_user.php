<?php
    require('../../config.php');
    $empId = $_POST['empId'];
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
    $hired = $_POST['date_hired'];
    $working_status = $_POST['working_status'];

   $regSql = $con->query("INSERT INTO employee(employee_id, username, password, acc_status, fname, mname, lname, sick_credits, vacation_credits, birthdate, contact, date_hired, address, department, employee_type, working_status,  academic_rank, designation) 
    VALUES('$empId', '$username', '$password', 'Pending',  '$fname', '$mname', '$lname', 0, 0, '$birthdate', $contact, '$hired', '$address', '$department', '$employee_type', $working_status, " . ($rank !== '' ? "'$rank'" : "NULL") . ", " . ($designation !== '' ? "'$designation'" : "NULL") . ")");
  
    if ($regSql) {
        echo 'success';
    } else {
        echo "Error: " . $con->error;
    }
?>





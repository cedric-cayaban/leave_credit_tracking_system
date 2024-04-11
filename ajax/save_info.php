<?php
    require('../config.php');
    $empId = $_POST['empId'];
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

    $updateSql = $con->query("UPDATE employee SET 
        fname = '$fname', 
        mname = '$mname', 
        lname = '$lname', 
        birthdate = '$birthdate', 
        contact = $contact, 
        address = '$address', 
        department = '$department', 
        employee_type = '$employee_type', 
        academic_rank = " . ($rank !== '' ? "'$rank'" : "NULL") . ", 
        designation = " . ($designation !== '' ? "'$designation'" : "NULL") . " 
        WHERE employee_id = '$empId'");

    if ($updateSql) {
        echo 'success';
    } else {
        echo "Error: " . $con->error;
    }
?>

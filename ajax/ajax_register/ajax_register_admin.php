<?php
    require('../../config.php');
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $birthdate = $_POST['birthdate'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $department = $_POST['department'];
   
   

   $regSql = $con->query("INSERT INTO admin(username, password, fname, mname, lname, contact, birthdate, address, department) 
    VALUES('$username', '$password', '$fname', '$mname', '$lname', '$contact', '$birthdate', '$address', '$department')");


    
    if ($regSql) {
        echo 'success';
    } else {
        echo "Error: " . $con->error;
    }
?>





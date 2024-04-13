<?php
    require('../../config.php');
    $empId = $_POST['empId'];
    $type = $_POST['type'];
    $sdate = $_POST['sdate'];
    $edate = $_POST['edate'];
    $days = $_POST['days'];
    $cost = $_POST['cost'];
    $reason = $_POST['reason'];
    $leaveFormFile = $_FILES['leave_form'];
    $medCertFile = $_FILES['medical_certificate'];

    
    $leaveFormPath = "../../images/uploads/leave_forms/" . basename($leaveFormFile['name']);
    $medCertPath = "../../images/uploads/medical_certificates/" . basename($medCertFile['name']);

    if (move_uploaded_file($leaveFormFile['tmp_name'], $leaveFormPath) &&
        move_uploaded_file($medCertFile['tmp_name'], $medCertPath)) {

        $employeeCreditSql = $con -> query("SELECT * FROM employee where employee_id = '$empId'");

        if($employeeCreditSql){
            $employee = $employeeCreditSql -> fetch_assoc();
            if($type == 1){
                $employeeCredit = $employee['vacation_credits'];
                
            }

            else if($type == 2){
                $employeeCredit = $employee['vacation_credits'];
            }

            $creditsComputation = $employeeCredit - $cost;

            if($creditsComputation >= 0){
                
                $newLeaveSql = $con->query("INSERT INTO employee_leave (
                    employee_id, leave_type, start_date, end_date, status, reason, leave_form, med_cert, days, credit_cost) 
                    VALUES ('$empId', '$type', '$sdate', '$edate', 'Pending', '$reason', '$leaveFormPath', '$medCertPath', '$days', '$cost')");
                if ($newLeaveSql) {
                    echo 'success';
                } else {
                    echo "Error: " . $con->error;
                }
            } else if($creditsComputation < 0){
                echo 'insufficient';
            }
        }
    } else {
       
        echo "Error uploading files.";
    }
?>

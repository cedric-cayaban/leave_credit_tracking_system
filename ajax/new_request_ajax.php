<?php
    require('../config.php');
    $empId = $_POST['empId'];
    $type = $_POST['type'];
    $date = $_POST['date'];
    $days = $_POST['days'];
    $cost = $_POST['cost'];
    $reason = $_POST['reason'];


    //condition pag kulang credits
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
            $newLeaveSql = $con->query("INSERT INTO employee_leave(
                employee_id, leave_type, date, status, reason, days, credit_cost) 
                VALUES('$empId', '$type', '$date', 'Pending', '$reason', $days, $cost)");
                if ($newLeaveSql) {
                    echo 'success';
                } else {
                    echo "Error: " . $con->error;
                }
        }

        else if($creditsComputation < 0){
            echo 'insufficient';
        }

        
    }
    

   

    
?>





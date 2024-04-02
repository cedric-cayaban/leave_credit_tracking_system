<?php
require('../config.php');

// Function to calculate leave credits based on work hours
function calculateLeaveCredits($employeeId, $workHours) {
    $sickLeaveRate = 0.042;
    $vacationLeaveRate = 0.5;

    // Calculate sick leave credits
    $sickCredits = $workHours * $sickLeaveRate;
    // Calculate vacation leave credits
    $vacationCredits = $workHours * $vacationLeaveRate;

    // Update leave credits in the database for the employee
    $updateQuery = "UPDATE employee SET sick_credits = sick_credits + $sickCredits, vacation_credits = vacation_credits + $vacationCredits WHERE employee_id = '$employeeId'";
    if ($con->query($updateQuery) === TRUE) {
        return array("sickCredits" => $sickCredits, "vacationCredits" => $vacationCredits);
    } else {
        return array("error" => "Error updating leave credits: " . $con->error);
    }
}

// Get all employees
$getEmployeesQuery = "SELECT employee_id FROM employee";
$employeesResult = $con->query($getEmployeesQuery);
if ($employeesResult->num_rows > 0) {
    // Loop through each employee
    while ($row = $employeesResult->fetch_assoc()) {
        $employeeId = $row["employee_id"];
        // Assuming 8 hours of work for each employee
        $workHours = 8;

        // Calculate leave credits for the employee
        $leaveCredits = calculateLeaveCredits($employeeId, $workHours);
        // Log or output the result (optional)
        echo "Leave credits updated for employee ID: " . $employeeId . "<br>";
        echo "Sick Leave Credits Added: " . $leaveCredits['sickCredits'] . "<br>";
        echo "Vacation Leave Credits Added: " . $leaveCredits['vacationCredits'] . "<br><br>";
    }
} else {
    echo "No employees found!";
}
?>

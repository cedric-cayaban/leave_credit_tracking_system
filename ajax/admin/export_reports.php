<?php
    require('../../config.php');
    session_start();

    // Check if user is logged in
    if(!isset($_SESSION['department'])){
        header("Location: ../index.php");
        exit; // Terminate script execution after redirection
    }

    // Fetch data from database
    $adminDept = $_SESSION['department'];
    $reportSql = $con->query("SELECT * FROM 
                                employee_leave 
                                INNER JOIN employee ON employee_leave.employee_id=employee.employee_id 
                                INNER JOIN leave_type ON employee_leave.leave_type = leave_type.type_id 
                                WHERE employee.department = '$adminDept' AND employee_leave.status IN ('Accepted', 'Rejected')"
                            );

    // Output CSV headers
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="employee_reports.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');

    // Open the output stream
    $output = fopen('php://output', 'w');

    // Output the CSV column headers
    fputcsv($output, array('Employee ID', 'Employee Name', 'Leave Type', 'Start Date', 'End Date', 'Days', 'Status'));

    // Output each row of the data
    while ($row = $reportSql->fetch_assoc()) {
        fputcsv($output, array(
            $row['employee_id'],
            $row['fname'] . ' ' . $row['lname'],
            $row['leave_name'],
            date('F j, Y', strtotime($row['start_date'])),
            date('F j, Y', strtotime($row['end_date'])),
            $row['days'],
            $row['status']
        ));
    }

    // Close the output stream
    fclose($output);
    exit;
?>

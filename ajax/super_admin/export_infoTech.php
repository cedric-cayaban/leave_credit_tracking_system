<?php
    require('../../config.php');
    session_start();

    
    $reportSql = $con->query("SELECT * FROM 
                                employee_leave 
                                INNER JOIN employee ON employee_leave.employee_id=employee.employee_id 
                                INNER JOIN leave_type ON employee_leave.leave_type = leave_type.type_id 
                                WHERE employee.department = 6 AND employee_leave.status IN ('Accepted', 'Rejected')"
                            );

   
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="information_technology_report.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');

   
    $output = fopen('php://output', 'w');

    
    fputcsv($output, array('Employee ID', 'Employee Name', 'Leave Type', 'Start Date', 'End Date', 'Days', 'Status'));

    
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

    
    fclose($output);
    exit;
?>

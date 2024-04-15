<?php
    require('../../../config.php');
    session_start();

    
    $reportSql = $con->query("SELECT *, COUNT(employee_leave.leave_id) AS leave_count FROM 
                            employee_leave 
                            INNER JOIN employee ON employee_leave.employee_id=employee.employee_id 
                            INNER JOIN leave_type ON employee_leave.leave_type = leave_type.type_id 
                            WHERE employee.department = 7 AND employee_leave.status = 'Accepted'
                            GROUP BY employee.employee_id
                            ORDER BY leave_count DESC"
                        );

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="mathematics_most_leaves.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');

    
    $output = fopen('php://output', 'w');

  
    fputcsv($output, array('#', 'Employee ID', 'First Name', 'Middle Name', 'Last Name', 'No. Of Leaves'));

   
    $counter = 0;

    
    while ($employee = $reportSql->fetch_assoc()) {
        $counter++;
        fputcsv($output, array(
            $counter,
            $employee['employee_id'],
            $employee['fname'],
            $employee['mname'],
            $employee['lname'],
            $employee['leave_count']
        ));
    }

    // Close the output stream
    fclose($output);
    exit;
?>

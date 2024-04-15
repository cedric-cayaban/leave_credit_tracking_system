<?php
   
    require('../../config.php');
    session_start();

    
    if(!isset($_SESSION['employee_id'])){
        header("Location: ../index.php");
        exit; 
    }

   
    $employeeId = $_SESSION['employee_id'];
    $reportSql = $con->query("SELECT 
                                leave_type.leave_name AS LeaveType, 
                                employee_leave.days AS Days, 
                                employee_leave.credit_cost AS CreditCost, 
                                DATE_FORMAT(employee_leave.start_date, '%b-%d %Y') AS StartDate, 
                                DATE_FORMAT(employee_leave.end_date, '%b-%d %Y') AS EndDate, 
                                CASE 
                                    WHEN employee_leave.status = 'Accepted' THEN 'Approved'
                                    WHEN employee_leave.status = 'Rejected' THEN 'Denied'
                                    WHEN employee_leave.status = 'Canceled' THEN 'Canceled'
                                    ELSE 'Pending'
                                END AS Status
                            FROM 
                                employee_leave 
                                INNER JOIN employee ON employee_leave.employee_id = employee.employee_id 
                                INNER JOIN leave_type ON employee_leave.leave_type = leave_type.type_id 
                            WHERE 
                                employee.employee_id = '$employeeId' AND  
                                (employee_leave.status IN ('Accepted', 'Rejected', 'Canceled'))
                            ORDER BY 
                                leave_id DESC");

    
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="leave_report.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');

    
    $output = fopen('php://output', 'w');

    
    fputcsv($output, array('Leave Type', 'Days', 'Credit Cost', 'Start Date', 'End Date', 'Status'));

   
    while ($row = $reportSql->fetch_assoc()) {
        fputcsv($output, $row);
    }

    
    fclose($output);
    exit;
?>

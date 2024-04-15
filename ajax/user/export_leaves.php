<?php

require('../../config.php');
session_start();


require_once '../../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;


if (isset($_SESSION['employee_id'])) {
    $employeeId = $_SESSION['employee_id'];

    
    $reportSql = $con->query("SELECT * FROM 
        employee_leave 
        INNER JOIN employee ON employee_leave.employee_id=employee.employee_id 
        INNER JOIN leave_type ON employee_leave.leave_type = leave_type.type_id 
        WHERE employee.employee_id = '$employeeId' AND (employee_leave.status = 'Accepted' OR employee_leave.status = 'Rejected' OR employee_leave.status = 'Canceled')
        ORDER BY leave_id DESC"
    );

    
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $dompdf = new Dompdf($options);

    
    ob_start();
    ?>
    <style>
       
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .text-success {
            color: green;
        }

        .text-danger {
            color: red;
        }

        .text-muted {
            color: gray;
        }

        .text-primary {
            color: blue;
        }
    </style>
    <table id="tableData" class="table table-striped">
        <thead>
            <tr>
                <th>Leave Type</th>
                <th>Days</th>
                <th>Credit Cost</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($employee = $reportSql->fetch_assoc()): ?>
            <tr>
                <td><?= $employee['leave_name'] ?></td>
                <td><?= $employee['days'] ?></td>
                <td><?= $employee['credit_cost'] ?></td>
                <td><?= date('F j, Y', strtotime($employee['start_date'])) ?></td>
                <td><?= date('F j, Y', strtotime($employee['end_date'])) ?></td>
                <td>
                    <?php 
                    $status = '';
                    switch ($employee['status']) {
                        case 'Accepted':
                            $status = '<b class="text-success">Approved</b>';
                            break;
                        case 'Rejected':
                            $status = '<b class="text-danger">Denied</b>';
                            break;
                        case 'Canceled':
                            $status = '<b class="text-muted">Canceled</b>';
                            break;
                        default:
                            $status = '<b class="text-primary">Pending</b>';
                            break;
                    }
                    echo $status;
                    ?>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php
    $html = ob_get_clean();

    
    $dompdf->loadHtml($html);

    
    $dompdf->setPaper('A4', 'portrait');

    
    $dompdf->render();

   
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="personal_reports.pdf"');

   
    echo $dompdf->output();
}
?>

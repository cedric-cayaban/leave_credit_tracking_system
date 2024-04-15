<?php
require('../../../config.php');
session_start();

$reportSql = $con->query("SELECT *, COUNT(employee_leave.leave_id) AS leave_count FROM 
                            employee_leave 
                            INNER JOIN employee ON employee_leave.employee_id=employee.employee_id 
                            INNER JOIN leave_type ON employee_leave.leave_type = leave_type.type_id 
                            WHERE employee.department = 3 AND employee_leave.status = 'Accepted'
                            GROUP BY employee.employee_id
                            ORDER BY leave_count DESC"
                        );


require_once '../../../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;


$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$dompdf = new Dompdf($options);


ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Reports</title>
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
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Employee ID</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>No. Of Leaves</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $counter = 0;
            while ($employee = $reportSql->fetch_assoc()): 
                $counter++;
            ?>
                <tr>
                    <td><?= $counter ?></td>
                    <td><?= $employee['employee_id'] ?></td>
                    <td><?= $employee['fname'] ?></td>
                    <td><?= $employee['mname'] ?></td>
                    <td><?= $employee['lname'] ?></td>
                    <td><?= $employee['leave_count'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
<?php
$html = ob_get_clean();


$dompdf->loadHtml($html);


$dompdf->setPaper('A4', 'portrait');


$dompdf->render();


header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="civil_most_leaves.pdf"');


echo $dompdf->output();
exit;
?>

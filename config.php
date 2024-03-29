<?php

    $con = new mysqli('localhost', 'root', '', 'leave_system');
    

    //SINGLE TABLE SQL SELECT
    $departmentSql = $con -> query('SELECT * FROM department');
    $empTypeSql = $con -> query('SELECT * FROM employee_type');
    $designationSql = $con -> query('SELECT * FROM designation');
    $employeeSql = $con -> query('SELECT * FROM employee');
    $rankSql = $con -> query('SELECT * FROM academic_rank');

   

    //INNER JOIN SQL
    $requestSql = $con -> query("SELECT * FROM 
    employee_leave 
    INNER JOIN employee ON employee_leave.employee_id=employee.employee_id 
    INNER JOIN leave_type ON employee_leave.leave_type = leave_type.type_id 
    WHERE employee_leave.status = 'Pending'"
    );

    $reportSql = $con -> query("SELECT * FROM 
    employee_leave 
    INNER JOIN employee ON employee_leave.employee_id=employee.employee_id 
    INNER JOIN leave_type ON employee_leave.leave_type = leave_type.type_id 
    WHERE employee_leave.status = 'Accepted' OR employee_leave.status = 'Rejected'"
    );

    

     //VERIFY ACC
     $empVerifySql = $con -> query("SELECT employee.employee_id, employee.fname, employee.lname, employee_type.type_name, academic_rank.rank_name, designation.designation_name 
     FROM employee 
     LEFT JOIN employee_leave ON employee.employee_id = employee_leave.employee_id 
     LEFT JOIN leave_type ON employee_leave.leave_type = leave_type.type_id 
     LEFT JOIN employee_type ON employee.employee_type = employee_type.type_id 
     LEFT JOIN academic_rank ON employee.academic_rank = academic_rank.rank_id
     LEFT JOIN designation ON employee.designation = designation.designation_id
     WHERE employee.acc_status = 'Pending'
     ");
    

   
?>
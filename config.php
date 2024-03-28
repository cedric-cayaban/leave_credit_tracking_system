<?php

    $con = new mysqli('localhost', 'root', '', 'leave_system');

    //SINGLE TABLE SQL SELECT
    $departmentSql = $con -> query('SELECT * FROM department');
    $empTypeSql = $con -> query('SELECT * FROM employee_type');
    $designationSql = $con -> query('SELECT * FROM designation');
    $employeeSql = $con -> query('SELECT * FROM employee');
    $rankSql = $con -> query('SELECT * FROM academic_rank');
    
?>
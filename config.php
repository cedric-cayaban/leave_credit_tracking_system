<?php

    $con = new mysqli('localhost', 'root', '', 'leave_system');

    //SINGLE TABLE SQL
    $departmentSql = $con -> query('SELECT * FROM department');
    $empTypeSql = $con -> query('SELECT * FROM employee_type');
    $designationSql = $con -> query('SELECT * FROM designation');

?>
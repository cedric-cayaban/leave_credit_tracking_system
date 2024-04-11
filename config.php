<?php

    $con = new mysqli('localhost', 'root', '', 'leave_system');
    

    //SINGLE TABLE SQL SELECT
    $departmentSql = $con -> query('SELECT * FROM department');
    $empTypeSql = $con -> query('SELECT * FROM employee_type');
    $designationSql = $con -> query('SELECT * FROM designation');
    $employeeSql = $con -> query('SELECT * FROM employee');
    $rankSql = $con -> query('SELECT * FROM academic_rank');
    $leaveTypeSql = $con -> query("SELECT * FROM leave_type");
    $statusSql = $con -> query("SELECT * FROM working_status");
   

    //INNER JOIN SQL
    

    

    //ALL INFORMATION
    // $infoSql = $con -> query("SELECT employee.employee_id
    // FROM employee 
    // LEFT JOIN leave_type ON employee_leave.leave_type = leave_type.type_id 
    // LEFT JOIN employee_type ON employee.employee_type = employee_type.type_id 
    // LEFT JOIN academic_rank ON employee.academic_rank = academic_rank.rank_id
    // LEFT JOIN designation ON employee.designation = designation.designation_id
    // LEFT JOIN department ON employee.department = department.dept_id
    // WHERE employee.employee_id = '$employeeId'
    // "); 

     //VERIFY ACC
     
    

   
?>
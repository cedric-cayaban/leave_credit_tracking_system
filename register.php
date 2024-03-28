<?php
    require('config.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/register.css?ver=0007">

        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/979ee355d9.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    
<div class="container">
    <div class="header">
        <h1>Employee Registration</h1>
    </div>
    <div class="card card-outline card-primary">
        <div class="card-body">
            <div class="container-fluid">
                <form action="" id="manage-user">	
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="firstname">First Name</label>
                                <input type="text" name="firstname" id="firstname" class="form-control rounded-0" value="<?php echo isset($meta['firstname']) ? $meta['firstname']: '' ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="middlename">Middle Name</label>
                                <input type="text" name="middlename" id="middlename" class="form-control rounded-0" value="<?php echo isset($meta['middlename']) ? $meta['middlename']: '' ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" name="lastname" id="lastname" class="form-control rounded-0" value="<?php echo isset($meta['lastname']) ? $meta['lastname']: '' ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="birthdate">Birthdate</label>
                                <input type="date" name="birthdate" id="birthdate" class="form-control rounded-0" value="<?php echo isset($meta['dob']) ? date("Y-m-d",strtotime($meta['dob'])): '' ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea rows="5" name="address" id="address" class="form-control rounded-0" style="resize:none !important" required><?php echo isset($meta['address']) ? $meta['address']: '' ?></textarea>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="contact">Contact #</label>
                                <input type="text" name="contact" id="contact" class="form-control rounded-0" value="<?php echo isset($meta['contact']) ? $meta['contact']: '' ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="employee_type">Employee type</label>
                                <select name="employee_type" id="employee_type" class="form-control select2bs4 select2 rounded-0" data-placeholder="Please Select Department here" reqiured>
                                    <option value="" disabled <?php echo !isset($meta['employee_id']) ? 'selected' : '' ?>></option>
                                    <?php while($employeeType = $empTypeSql -> fetch_assoc()){ ?>
                                        <option value="<?=$employeeType['type_name'] ?>"><?=$employeeType['type_name']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="department">Department</label>
                                <select name="department" id="department" class="form-control select2bs4 select2 rounded-0" data-placeholder="Please Select Department here" reqiured>
                                    <option value="" disabled <?php echo !isset($meta['department_id']) ? 'selected' : '' ?>></option>
                                    <?php while($department = $departmentSql -> fetch_assoc()){ ?>
                                        <option value="<?=$department['dept_name'] ?>"><?=$department['dept_name']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="designation">Designation</label>
                                <select name="designation" id="designation" class="form-control select2bs4 select2 rounded-0" data-placeholder="Please Select Designation here" reqiured>
                                    <option value="" <?php echo !isset($meta['designation_id']) ? 'selected' : '' ?>></option>
                                    <?php while($designation = $designationSql -> fetch_assoc()){ ?>
                                        <option value="<?=$designation['designation_name']?>"><?=$designation['designation_name']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control rounded-0" required  autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="text" name="password" id="password" class="form-control rounded-0" required  autocomplete="off">
                            </div>  
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="registerBtn">
        <button id='register'>Register</button>
        
    </div>
</div>

<script>
    $('#register').click(
        function(){
            var fname = $('#firstname').val();
            var mname = $('#middlename').val();
            var lname = $('#lastname').val();
            var birthdate = $('#birthdate').val();
            var address = $('#address').val();
            var contact = $('#contact').val();
            var employee_type = $('#employee_type').val();
            var department = $('#department').val();
            var designation = $('#designation').val();
            var username = $('#username').val();
            var password = $('#password').val();

            $.post('ajax/ajax_register.php',
            {
                fname: fname, contact: contact,
                mname: mname, employee_type: employee_type,
                lname: lname, department: department,
                birthdate: birthdate, designation: designation,
                address: address, username: username,
                password: password,
            }
            function(data, status){

            });
        });
</script>

    
</body>
</html>
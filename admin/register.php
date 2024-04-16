<?php
    require('../config.php');
    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/register.css?ver=0010">

        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/979ee355d9.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>Document</title>
</head>
<body>
    
<div class="container">
    <div class="header">
        <h1>Admin Registration</h1>
    </div>
    <div class="card card-outline card-primary">
        <div class="card-body">
            <div class="container-fluid">
                <form action="" id="manage-user">	
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="admin_Id">Admin ID</label>
                                <input type="text" name="admin_Id" id="admin_Id" class="form-control rounded-0" value="" >
                            </div>
                            <div class="form-group">
                                <label for="firstname">First Name</label>
                                <input type="text" name="firstname" id="firstname" class="form-control rounded-0" value="" >
                            </div>
                            <div class="form-group">
                                <label for="middlename">Middle Name</label>
                                <input type="text" name="middlename" id="middlename" class="form-control rounded-0" value="" >
                            </div>
                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" name="lastname" id="lastname" class="form-control rounded-0" value="" >
                            </div>
                            <div class="form-group">
                                <label for="birthdate">Birthdate</label>
                                <input type="date" name="birthdate" id="birthdate" class="form-control rounded-0" value="" >
                            </div>
                            
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea rows="5" name="address" id="address" class="form-control rounded-0" style="resize:none !important" ></textarea>
                            </div>
                            
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="contact">Contact #</label>
                                <input type="number" name="contact" id="contact" class="form-control rounded-0" value="" >
                            </div>
                            <div class="form-group">
                                <label for="department">Department</label>
                                <select name="department" id="department" class="form-control select2bs4 select2 rounded-0" data-placeholder="Please Select Department here" reqiured>
                                    <option value="" disabled ></option>
                                    <?php while($department = $departmentSql -> fetch_assoc()){ ?>
                                        <option value="<?=$department['dept_id'] ?>"><?=$department['dept_name']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control rounded-0"   autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control rounded-0"   autocomplete="off">
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
    $('#register').click(function(){
            var adminId = $('#admin_Id').val();
            var fname = $('#firstname').val();
            var mname = $('#middlename').val();
            var lname = $('#lastname').val();
            var birthdate = $('#birthdate').val();
            var address = $('#address').val();
            var contact = $('#contact').val();
            var department = $('#department').val();
            var username = $('#username').val();
            var password = $('#password').val();
            if(adminId !== "" && fname !== "" && mname !== "" && lname !== "" && birthdate !== "" && address !== "" && contact !== "" && username !== "" && password !== ""){
                $.post('../ajax/admin/ajax_register_admin.php',
                {
                    adminId: adminId,
                    fname: fname, 
                    mname: mname, 
                    lname: lname,
                    address: address,  
                    contact: contact,
                    department: department,
                    birthdate: birthdate, 
                    username: username,
                    password: password
                }, 
                function(data, status){
                    data = data.trim();
                    if(data === 'success'){
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Registration successful'
                        }).then((result) =>{
                            if(result.isConfirmed){
                                window.location.href = '../index.php';
                            }
                        });
                    }
                    else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error',
                        });
                    }
                });
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please fill up all required fields',
                });
            }
            
        });
</script>


    
</body>
</html>
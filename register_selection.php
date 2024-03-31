<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/user-type.css?ver=0003">
    <script src="https://kit.fontawesome.com/979ee355d9.js" crossorigin="anonymous"></script>
    <title>Login</title>
</head>

<body>
    <div class="wrapper">
        <div class="header">
            <img class="logo" src="images/logo.png.png" alt="Logo">
            
        </div>

        <div class="title">
            <label for="">LEAVE CREDIT TRACKING SYSTEM</label>
        </div>

        <form action="login.php" method="post" class="field-input">

            <div class="labels">
                <label for="">Register as</label>
            </div>
            

            <div class="type">
                <a href="user/register.php">
                    <i class="fa-solid fa-user fa-xl"></i> <br>
                    Employee
                </a>

                <a href="admin/register.php">
                    <i class="fa-solid fa-user-tie fa-xl"></i> <br>
                    Admin
                </a>
                </div>
            

        </form>

         <a href="index.php" id="reg">Back to Login</a>

    </div>
</body>

</html>
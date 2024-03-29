<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/login.css?ver=0002">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=3.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/979ee355d9.js" crossorigin="anonymous"></script>

    <title>Document</title>
</head>

<body>
    
<div class="wrapper fadeInDown">
  <div id="formContent">
    
    <div class="header">
        <img class="logo" src="images/logo.png" alt="Leave Tracker Logo">
    </div>

   
    <div id="loginForm">
      <input type="text" id="username" class="fadeIn second" name="username" placeholder="Username" required>
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="Password" required> 
      <p id='message'></p>
      <input type="button" class="fadeIn fourth" id="submitBtn" value="Log In">
      
    </div>

    

    <div id="formFooter">
      <a class="underlineHover" href="register_selection.php">Register</a>
    </div>

  </div>
</div>

<script>

    $("#submitBtn").click(
      function () {
        var username = $("#username").val();
        var password = $("#password").val();
       
        $.post('ajax/ajax_login.php', 
        {
            username: username,
            password: password
        },
        function(data, status){
          data = data.trim();
            if(data === 'success1'){
                
                window.location.href = 'user/home.php';
            }
            else if(data === 'success2'){
                
                window.location.href = 'admin/home.php';
                
            }
            else{
                $('#message').html('Invalid credentials').css('color', 'red');
            }
        });
    });



</script>

</body>
</html>

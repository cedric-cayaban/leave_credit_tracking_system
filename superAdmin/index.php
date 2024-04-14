<?php
    require('../config.php');
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/home.css?ver=0002">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/9c6f27a8d7.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>Super Admin</title>
</head>

<style>
    
</style>

<body onload="loadContent('dashboard.php')">
<div class="container-fluid">
    <div class="row flex-nowrap">
        
        <div class="bg-primary-custom col-auto col-md-4 col-lg-2 min-vh-100 d-flex flex-column justify-content-between position-sticky">
            <div class="bg-primary-custom p-2">
                <a class="d-flex justify-content-center text-decoration-none mt-1 align-items-center text-white">
                    <span class="fs-4 d-none d-sm-inline">SUPER ADMIN</span>
                </a>
                <ul class="nav nav-pills flex-column mt-4">
                    <li class="nav-item py-2 py-sm-0">
                        <a href="#" class="nav-link text-white" onclick="loadContent('dashboard.php')">
                            <i class="fas fa-tachometer-alt"></i><span class="fs-5 ms-3 d-none d-sm-inline">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item py-2 py-sm-0">
                        <a href="#" class="nav-link text-white" onclick="loadContent('verify_admins.php')">
                        <i class="fa-solid fa-check"></i><span class="fs-5 ms-3 d-none d-sm-inline">Verify Admins</span>
                        </a>
                    </li>
                <!-- NUMBER 3 -->
                    
                </ul>
                
            </div>
            
            <div class="mb-5 p-2"> 
                <ul class="nav nav-pills flex-column mt-4">
                    <li class="nav-item py-2 py-sm-0">
                        <a href="#" class="nav-link text-white" onclick="logout()">
                            <i class="fas fa-angle-left"></i><span class="fs-5 ms-3 d-none d-sm-inline"><b>Logout</b></span>
                        </a>
                    </li>
                </ul>
            </div>
           
            
        </div>
        <div class="col-md-8 col-lg-10 bg-light">
                <div id="contents">
                
                </div>
            
        </div>
    </div>
</div>

    
<script>

    

    function loadContent(page) { 
        $('#contents').load(page); 
    }

    


    function toggleDropdowns() {
        var listDropdown = document.getElementById("listDropdown");
        if (listDropdown.style.display === "none") {
            listDropdown.style.display = "block";
        } else {
            listDropdown.style.display = "none";
        }
    }
    function logout() {

        $.post('../ajax/logout.php', 
        {},
        function(data, status){
            
          data = data.trim();
            if(data === 'success'){
                
                window.location.href = '../index.php';
            }
            
        });
    }
</script>

</body>
</html>

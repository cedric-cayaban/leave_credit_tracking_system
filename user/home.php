<?php
    require('../config.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/adminhome.css?ver=0002">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/9c6f27a8d7.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>Document</title>
</head>
<body onload="loadContent('credits.php')">
    

<div class="container-fluid">
    <div class="row flex-nowrap">
        
        <div class="bg-primary-custom col-auto col-md-4 col-lg-2 min-vh-100 d-flex flex-column justify-content-between">
            
            <div class="bg-primary-custom p-2">
                <a class="d-flex justify-content-center text-decoration-none mt-1 align-items-center text-white">
                    <span class="fs-4 d-none d-sm-inline">EMPLOYEE</span>
                </a>
                <ul class="nav nav-pills flex-column mt-4">
                    <li class="nav-item py-2 py-sm-0">
                        <a href="#" class="nav-link text-white" onclick="loadContent('credits.php')">
                            <i class="fa-solid fa-credit-card"></i><span class="fs-5 ms-3 d-none d-sm-inline">Credits</span>
                        </a>
                    </li>
                    <li class="nav-item py-2 py-sm-0">
                        <a href="#" class="nav-link text-white" onclick="loadContent('requests.php')">
                            <i class="fa-solid fa-file-invoice"></i><span class="fs-5 ms-3 d-none d-sm-inline">My Requests</span>
                        </a>
                    </li>
                    <li class="nav-item py-2 py-sm-0">
                        <a href="#" class="nav-link text-white" onclick="loadContent('history.php')">
                        <i class="fas fa-chart-bar"></i><span class="fs-5 ms-3 d-none d-sm-inline">Leave History</span>
                        </a>
                    </li>
                <!-- NUMBER 3 -->
                    <!-- <li class="nav-item py-2 py-sm-0">
                        <a href="#" class="nav-link text-white" onclick="toggleDropdowns()">
                            <i class="fas fa-list"></i><span class="fs-5 ms-3 d-none d-sm-inline">Lists</span>
                        </a>
                    </li>
                    <div id="listDropdown" style="display: none; margin-left: 20px;">
                        <ul class="nav nav-pills flex-column mt-1">
                            <li class="nav-item py-2 py-sm-0">
                                <a href="#" class="nav-link text-white" onclick="">
                                    <i class="fas fa-user-tag"></i><span class="fs-6 ms-3 d-none d-sm-inline">Designation List</span>
                                </a>
                            </li>
                            <li class="nav-item py-2 py-sm-0">
                                <a href="#" class="nav-link text-white" onclick="">
                                    <i class="fas fa-file-alt"></i><span class="fs-6 ms-3 d-none d-sm-inline">Leave Type List</span>
                                </a>
                            </li>
                        </ul>
                    </div> -->
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
        <!-- ETO YUNG DIV NG CONTENTS NA LUMALABAS KADA PINDOT SA SIDEBAR -->

        <div class="col-md-8 col-lg-10 mt-4 bg-light">
                <div id="contents">
                
                </div>
            
        </div>

         <!-- ETO YUNG DIV NG CONTENTS NA LUMALABAS KADA PINDOT SA SIDEBAR -->
    </div>
</div>

    
<script>

    //  ETO YUNG FUNCTION NA NAGLOLOAD NUNG MGA LALABAS NA CONTENTS KADA PUMIPINDOT SA SIDEBAR

    function loadContent(page) { // YUNG PARAMETER NYA EH YUNG FILE NAME NG PHP, CTRL F MO NALANG YUNG NAME NG FUNCTION PARA MAGETS MO PROCESS
        $('#contents').load(page); // NILOLOAD NYA YUNG PHP FILE SA #CONTENT NA DIV
    }

    //  ETO YUNG FUNCTION NA NAGLOLOAD NUNG MGA LALABAS NA CONTENTS KADA PUMIPINDOT SA SIDEBAR


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

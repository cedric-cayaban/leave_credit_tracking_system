<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/adminhome.css">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/9c6f27a8d7.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

   
   
 
    <title>Document</title>
</head>
<body>
 
    <div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="bg-primary-custom col-auto col-md-4 col-lg-2 min-vh-100 d-flex flex-column justify-content-between">
            <div class="bg-primary-custom p-2">
                <a class="d-flex justify-content-center text-decoration-none mt-1 align-items-center text-white">
                    <span class="fs-4 d-none d-sm-inline">ADMIN</span>
                </a>
                <ul class="nav nav-pills flex-column mt-4">
                    <li class="nav-item py-2 py-sm-0">
                        <a href="#" class="nav-link text-white" onclick="loadContent('dashboard.php')">
                            <i class="fas fa-tachometer-alt"></i><span class="fs-5 ms-3 d-none d-sm-inline">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item py-2 py-sm-0">
                        <a href="#" class="nav-link text-white" onclick="loadContent('requests.php')">
                            <i class="fa-solid fa-file-invoice"></i><span class="fs-5 ms-3 d-none d-sm-inline">Leave Requests</span>
                        </a>
                    </li>
                    <li class="nav-item py-2 py-sm-0">
                        <a href="#" class="nav-link text-white" onclick="loadContent('verify_acc.php')">
                        <i class="fa-solid fa-check"></i><span class="fs-5 ms-3 d-none d-sm-inline">Verify Accounts</span>
                        </a>
                    </li>
                    <li class="nav-item py-2 py-sm-0">
                        <a href="#" class="nav-link text-white" onclick="loadContent('reports.php')">
                            <i class="fas fa-chart-bar"></i><span class="fs-5 ms-3 d-none d-sm-inline">Reports</span>
                        </a>
                    </li>
                    
                    <li class="nav-item py-2 py-sm-0">
                        <a href="#" class="nav-link text-white" data-bs-toggle="collapse" data-bs-target="#listsMenu">
                            <i class="fas fa-list"></i><span class="fs-5 ms-3 d-none d-sm-inline">Lists</span>
                        </a>
                        <div class="collapse" id="listsMenu">
                           
                            <ul class="nav flex-column mt-2">
                                <li class="nav-item">
                                    <a href="#" class="nav-link text-white" onclick="loadContent('designation.php')">
                                        <i class="fas fa-id-badge"></i><span class="fs-6 ms-2 d-none d-sm-inline">Designation</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link text-white" onclick="loadContent('leaveType.php')">
                                        <i class="fas fa-clipboard-list"></i><span class="fs-6 ms-2 d-none d-sm-inline">Leave type</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link text-white" onclick="loadContent('admin.php')">
                                        <i class="fas fa-user"></i><span class="fs-6 ms-2 d-none d-sm-inline">Employee Verify</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
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
 
 

 
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <script>
          function loadContent(page) { 
            $('#contents').load(page);
        }
    </script>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8f9fa;
        }

        .wrapper {
            display: flex;
            width: 100%;
        }

        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background: #007bff; /* Blue sidebar background */
            color: #fff;
            transition: all 0.3s;
            position: fixed;
            height: 100%;
            overflow-y: auto;
        }

        #sidebar.active {
            margin-left: -250px;
        }

        #sidebar .sidebar-header {
            padding: 20px;
            background: #007bff; /* Blue sidebar header background */
        }

        #sidebar ul.components {
            padding: 20px 0;
            border-bottom: 1px solid #47748b;
        }

        #sidebar ul p {
            color: #fff;
            padding: 10px;
        }

        #sidebar ul li a {
            padding: 10px;
            font-size: 1.1em;
            display: block;
            color: #fff;
        }

        #sidebar ul li a:hover {
            background: #0056b3; /* Darker blue on hover */
            color: #fff;
            text-decoration: none;
        }

        #sidebar ul li.active > a, a[aria-expanded="true"] {
            background: #0056b3; /* Darker blue for active item */
        }

        #sidebar a[data-toggle="collapse"] {
            position: relative;
        }

        #sidebar .collapse.show {
            background: #0056b3; /* Darker blue for expanded menu */
        }

        #content {
            width: 100%;
            padding: 20px;
            transition: all 0.3s;
        }

        #admin-text {
            padding: 20px;
            text-align: center;
            background: #0056b3;
            color: white;
            font-weight: bold;
        }

        /* Icon styles */
        #sidebar ul li i {
            margin-right: 10px;
        }
    </style>
</head>
<body>

<div class="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar">
        <div id="admin-text">ADMIN</div>
        <ul class="list-unstyled components">
            <li class="active">
                <a href="#" onclick="loadContent('admindashboard.php')"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </li>
            <li>
                <a href="#" onclick="loadContent('employeeList.php')"><i class="fas fa-users"></i> Employee List</a>
            </li>
            <li>
                <a href="#" onclick="loadContent('application.php')"><i class="fas fa-tasks"></i> Application List</a>
            </li>
            <li>
                <a href="#" onclick="loadContent('department.php')"><i class="fas fa-building"></i> Department List</a>
            </li>
            <li>
                <a href="#" onclick="loadContent('designation.php')"><i class="fas fa-id-badge"></i> Designation List</a>
            </li>
            <li>
                <a href="#" onclick="loadContent('leave_type.php')"><i class="fas fa-clipboard-list"></i> Leave Type List</a>
            </li>
            <li>
                <a href="#" onclick="loadContent('user.php')"><i class="fas fa-user"></i> User List</a>
            </li>
            <li>
                <a href="#" onclick="loadContent('reports.php')"><i class="fas fa-chart-bar"></i> Reports</a>
            </li>
            <li>
                <a href="#" onclick="loadContent('settings.php')"><i class="fas fa-cog"></i> Settings</a>
            </li>
        </ul>
    </nav>

    <!-- Content area -->
    <div id="content">
        <!-- Content will be loaded dynamically here -->
    </div>
</div>

<script>
    function loadContent(page) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("content").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", page, true);
        xhttp.send();
    }
</script>

</body>
</html>

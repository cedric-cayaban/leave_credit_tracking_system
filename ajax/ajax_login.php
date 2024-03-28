<?php
    require 'config.php';
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = $con -> query('SELECT employee.username, employee.password FROM employee');
    while($result = $sql->fetch_assoc()){
        if($username == $result['username'] && $password == $result['password']){
            $_SESSION['username'] = $result['username'];
            echo 'success';
        }
        else
        {
            echo 'error';
        }

    }


?>
















<?php
            require "config.php";
            session_start();

            if (isset($_POST['btnLogin'])) {
                $idNumber = $_POST['idNumber'];
                $password = $_POST['password'];

                if (!empty($idNumber) && !empty($password)) {
                    $sql = "SELECT `userID`, `password` FROM user WHERE user.userID = '$idNumber' AND user.password = '$password'";
                    $result = mysqli_query($connect, $sql);

                    if (mysqli_num_rows($result) >= 1) {
                        $row = mysqli_fetch_assoc($result);
                        if ($row['userID'] == $idNumber && $row['password'] == $password) {
                            // echo "<script>alert('Logged in successfully!')</script>";
                            $_SESSION['userID'] = $row['userID'];
                            $_SESSION['password'] = $row['password'];
                            echo "<p style='color: green;'>Logged in.</p>";
                            header("Refresh: 1; url='../user/user-home.php'");
                        } else {
                            echo "<p style='color: red;'>Invalid credentials.</p>";
                        }
                    } else if (!empty($idNumber) && !empty($password)) {

                        $sql = "SELECT `professorID`, `password` FROM professor WHERE professor.professorID = '$idNumber' AND professor.password = '$password'";
                        $result = mysqli_query($connect, $sql);

                        if (mysqli_num_rows($result) >= 1) {
                            $row = mysqli_fetch_assoc($result);
                            if ($row['professorID'] == $idNumber && $row['password'] == $password) {
                                // echo "<script>alert('Logged in successfully!')</script>";
                                $_SESSION['professorID'] = $row['professorID'];
                                $_SESSION['profPassword'] = $row['password'];
                                echo "<p style='color: green;'>Logged in.</p>";
                                header("Refresh: 1; url='../manager/professor_home.php'");
                            } else {
                                echo "<p style='color: red;'>Invalid credentials.</p>";
                            }
                        } else if (!empty($idNumber) && !empty($password)) {
                            $sql = "SELECT `adminID`, `password` FROM `admin` WHERE admin.adminID = '$idNumber' AND admin.password = '$password'";
                            $result = mysqli_query($connect, $sql);

                            if (mysqli_num_rows($result) >= 1) {
                                $row = mysqli_fetch_assoc($result);
                                if ($row['adminID'] == $idNumber && $row['password'] == $password) {
                                    // echo "<script>alert('Logged in successfully!')</script>";
                                    $_SESSION['adminID'] = $row['adminID'];
                                    $_SESSION['adminPassword'] = $row['password'];
                                    echo "<p style='color: green;'>Logged in.</p>";
                                    header("Refresh: 1; url='../admin/admin_home.php'");
                                } else {
                                    echo "<p style='color: red;'>Invalid credentials.</p>";
                                }
                            } else {
                                echo "<p style='color: red;'>Invalid credentials.</p>";
                            }
                        } else {
                            echo "<p style='color: red;'>Invalid credentials.</p>";
                        }
                    } else {
                        echo "<p style='color: red;'>Invalid credentials.</p>";
                    }
                } else {
                    echo "<p style='color: red;'>Invalid credentials.</p>";
                }
            } else if (isset($_POST['btnRegister'])) {
                header("Refresh: 0, url='registration.php'");
            }
            ?>
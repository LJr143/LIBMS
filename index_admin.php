<?php
session_start();
require_once 'C:\wamp64\www\LIBMS\LIBMS\db_config\config.php';
include "operations/authentication.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
$db = new Database();
$userAuth = new UserAuthentication($db);

if (isset($_POST['form_submit_btn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['admin_role'];

    if ($userAuth->loginAdmin($username, $password, $role)) {
        if($role == 'Librarian'){
            header('Location: superadmin/dashboard.php');
            exit();
        }else {
            header('Location: admin/dashboard.php');
            exit();
        }

    } else {
        $loginError = 'Invalid username or password';
    }
}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>USeP | LMS</title>
    <link rel="icon" href="icons/usep-logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div>
    <nav class="navbar navbar-light bg-light header">
        <div class="container-fluid">

            <div class="head-text">
               <div> <img src="icons/usep-logo.png" alt="" class="custom_img"></div>
                <div class="usep-text">
                        <p style="font-size: 14px; font-weight: bold">University of Southeastern Philippines Tagum - Mabini Campus</p>
                    <p style="font-size: 12px; font-weight: 600; margin-top: -20px">Apokon RD, Tagum City Davao Del Norte 8100</p>
                </div>
            </div>
            <div class="right-side">
                <div class="right-side-text">
                    <p style="font-size: 14px; font-weight: bold;">LIBRARY MANAGEMENT SYSTEM</p>
                    <p style="font-size: 12px; font-weight: 600; margin-top: -20px">E - System Environment</p>
                </div>
            </div>
        </div>
    </nav>
    <div class="main-content">
        <div class="form-box">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-content">
                    <div style="margin-top: 30px"> <img src="icons/usep-logo.png" alt="" style="width: 70px"></div>


                    <div style="display: inline;">
                       <div style="margin-top: 50px">
                           <select name="admin_role" id="admin_role">
                               <option value="">Select Admin</option>
                               <option value="Librarian">Librarian</option>
                               <option value="Staff">Staff</option>
                           </select>
                       </div>
                        <label for="user_username">Username</label>
                        <br>
                        <input  name="username" type="text" id="user_username">
                        <br>
                        <label for="user_username">Password</label>
                        <br>
                        <input name="password" id="user_password">
                        <br>
                        <div style="display: flex; justify-content: space-between">
                            <div style="display:flex;">
                                <input type="checkbox" style="width: 12px"></input>
                                <label style="font-size: 8px; margin-top: 7.5px">&nbsp;show password</label>
                            </div>
                            <div>
                                <a href="" style="font-size: 8px">forgot password?</a>
                            </div>
                        </div>
                        <input name="form_submit_btn" type="submit" value="LOGIN" id="form_submit_btn">
                    </div>

                    <div class="google-button">
                        <button style=" border-radius: 5px; background-color: white; color: black; border: 1px solid black;" id="google_login"><img style="width: 20px" src="icons/google.png" alt="" class="custom_img">
                            <span style="font-size: 8px;">LOGIN WITH GOOGLE</span>
                        </button>
                    </div>
                </div>


            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("user_password");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    }
</script>

</body>
</html>

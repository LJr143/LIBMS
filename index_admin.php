<?php
session_start();
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
include "operations/authentication.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
$db = new Database();
$userAuth = new UserAuthentication($db);

if($userAuth->isAuthenticated()) {
    if($_SESSION['admin_role'] == 'Staff'){
        header('Location: admin/dashboard.php');
    }else if ($_SESSION['admin_role'] == 'Librarian'){
        header('Location: superadmin/dashboard.php');
    }else {
        echo 'eRROr';
    }
}

if (isset($_POST['form_submit_btn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['admin_role'];

    if ($userAuth->loginAdmin($username, $password, $role)) {
        header('Location: admin/dashboard.php');
            exit();
    } elseif ($userAuth->loginSuperAdmin($username, $password, $role)){

        header('Location: superadmin/dashboard.php');
    }else {
        header('Location: index_admin.php');
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
    <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div>
    <?php include 'header.php'?>
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
                        <input name="password" type="password" id="user_password">
                        <br>
                        <div style="display: flex; justify-content: space-between">
                            <div style="display:flex;">
                                <input type="checkbox" style="width: 12px" id="show_password_checkbox" onclick="togglePasswordVisibility()"></input>
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

<script src="node_modules/jquery/dist/jquery.min.js"></script>
<script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
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

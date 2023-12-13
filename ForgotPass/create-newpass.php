<?php
session_start();
require_once 'db_config\config.php';
include "operations/authentication.php";
$db = new Database();
$userAuth = new UserAuthentication($db);


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CREATE NEW PASSWORD</title>
    <link rel="icon" href="../icons/usep-logo.png">
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body style="">
<div>
    <?php include 'header.php' ?>
    <div class="main-content">
        <div class="form-box" >
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-content">
                <a href="confirm-email.php">
                    <div style="position: absolute; top: 70px; left: 520px; transform: translate(0, 100); padding: 10px ">
                    <img src="img/ArrowLeft.png" alt="arrow" class="arrow" style="width: 20px; height: 20px;">
                   </a> 
                </div>
                
                    <div style="margin-top: 30px"> <img src="../icons/usep-logo.png" alt="" style="width: 70px"></div>
                    <div>
                        <p style="font-weight: 700; font-size: 10px; padding: 10px; letter-spacing: 0.2px; margin-top: 15px;">CREATE NEW PASSWORD</p>
                    </div>

    <div style="display: inline;">
    <input type="text" id="userType" value="Student" style="display: none">
    <label for="user_newpassword">New Password</label>
    <br>
    <input name="new_password" type="password" id="user_newpassword" autofocus>
    <br>
    <span id="passwordStrengthWarning" style="display: none; color: red;font-size: 8px;">Password is weak</span>
    <span id="passwordStrengthMessage" style="display: none; color: green; font-size: 8px;">Password is strong</span>
    
    <label for="user_confirmnewpass">Confirm New Password</label>
    <br>
    <input name="confirmnewpass" type="password" id="user_confirmnewpass">
    <br>
    <span id="passwordMatchWarning" style="display: none; color: red;font-size: 8px;">Passwords do not match</span>
</div>
<div>
    <input type="submit" name="form_submit_btn" value="CONFIRM" id="form_submit_btn">
</div>



<script>
    document.getElementById("form_submit_btn").addEventListener("click", function(e) {
        var newPassword = document.getElementById("user_newpassword").value;
        var confirmNewPass = document.getElementById("user_confirmnewpass").value;

        
        var isPasswordWeak = newPassword.length < 8;
        var doPasswordsMatch = newPassword === confirmNewPass;

        if (isPasswordWeak) {
            e.preventDefault(); 
            document.getElementById("passwordStrengthMessage").style.display = "none";
            document.getElementById("passwordStrengthWarning").style.display = "block";
            document.getElementById("passwordMatchWarning").style.display = "none";
        } else {
            document.getElementById("passwordStrengthMessage").style.display = "none";
            document.getElementById("passwordStrengthWarning").style.display = "none";
        }

        if (!doPasswordsMatch) {
            e.preventDefault(); 
            document.getElementById("passwordMatchWarning").style.display = "block";
        } else {
            document.getElementById("passwordMatchWarning").style.display = "none";
           
        }
    });

    document.getElementById("user_newpassword").addEventListener("input", function() {
        var newPassword = document.getElementById("user_newpassword").value;
        var isPasswordWeak = newPassword.length < 8;

        if (newPassword === "") {
            document.getElementById("passwordStrengthMessage").style.display = "none";
            document.getElementById("passwordStrengthWarning").style.display = "none";
        } else {
            if (isPasswordWeak) {
                document.getElementById("passwordStrengthMessage").style.display = "none";
                document.getElementById("passwordStrengthWarning").style.display = "block";
            } else {
                document.getElementById("passwordStrengthMessage").style.display = "none";
                document.getElementById("passwordStrengthWarning").style.display = "none";
            }
        }
    });
    
    document.getElementById("user_confirmnewpass").addEventListener("input", function() {
        var newPassword = document.getElementById("user_newpassword").value;
        var confirmNewPass = document.getElementById("user_confirmnewpass").value;
        var doPasswordsMatch = newPassword === confirmNewPass;

        if (confirmNewPass === "") {
            document.getElementById("passwordMatchWarning").style.display = "none";
        } else {
            if (!doPasswordsMatch) {
                document.getElementById("passwordMatchWarning").style.display = "block";
            } else {
                document.getElementById("passwordMatchWarning").style.display = "none";
            }
        }
    });
</script>

</body>
</html>

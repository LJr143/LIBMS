<?php
session_start();
require_once '../db_config/config.php';
include "../operations/authentication.php";
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
    <title>CONFIRM EMAIL</title>
    <link rel="icon" href="../icons/usep-logo.png">
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="css/confrim-email.css">

</head>
<body style="">
<div>
    <?php include 'header.php' ?>
    <div class="main-content">
        <div class="form-box" >
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-content">
                <a href="forgotpassword.php">
                    <div style="position: absolute; top: 70px; left: 520px; transform: translate(0, 100); padding: 10px ">
                    <img src="img/ArrowLeft.png" alt="arrow" class="arrow" style="width: 20px; height: 20px;">
                   </a> 
                </div>
                    <div style="margin-top: 30px"> <img src="../icons/usep-logo.png" alt="" style="width: 70px"></div>
                    <div>
                    <p style="font-weight: 700; font-size: 10px;  letter-spacing: 0.2px; margin-top: 15px;">CONFIRM EMAIL</p>
                    </div>
                    <div style="text-align: center;">
                    <p style="font-weight: 500; font-size: 10px;  letter-spacing: 0.2px;letter-spacing: 0.1px; margin-bottom: 50px; padding: 0;">A six-digit code has been sent to your email</p>
                    </div>
                
    <div style="display: inline; margin: 0; padding: 0;">
    <div style="display: flex; justify-content: center" class="otp-container">
      <div style="display: flex; gap: 10px; margin-top: 40px" class="otp-input ">
        <input style="width: 20px; height: 1px; border: none; background-color: #000; outline: none;color: #000; font-size: 16px; text-align: center;" type="text" maxlength="1" oninput="handleInput(event, 0)" required>
        <input style="width: 20px; height: 1px; border: none; background-color: #000; outline: none;color: #000; font-size: 16px; text-align: center;" type="text" maxlength="1" oninput="handleInput(event, 1)" required>
        <input style="width: 20px; height: 1px; border: none; background-color: #000; outline: none;color: #000; font-size: 16px; text-align: center;" type="text" maxlength="1" oninput="handleInput(event, 2)" required>
        <input style="width: 20px; height: 1px; border: none; background-color: #000; outline: none;color: #000; font-size: 16px; text-align: center;" type="text" maxlength="1" oninput="handleInput(event, 3)" required>
        <input style="width: 20px; height: 1px; border: none; background-color: #000; outline: none;color: #000; font-size: 16px; text-align: center;" type="text" maxlength="1" oninput="handleInput(event, 4)" required>
        <input style="width: 20px; height: 1px; border: none; background-color: #000; outline: none;color: #000; font-size: 16px; text-align: center;" type="text" maxlength="1" oninput="handleInput(event, 5)" required>
      </div>
    </div>
    <span id="emailWarning" style="color: red; display: none; font-size: 8px">Invalid pin</span><br>
    <div style=" position: relative; top:-10px;text-align: center; margin: 0; padding: 0; ">
      <p style="font-weight: 500; font-size: 7px; letter-spacing: 0.2px;">RESEND (45)</p>
    </div>
    <div style="position: relative; top:-20px; margin: 0; padding: 0;">
      <input type="submit" name="form_submit_btn" value="CONFIRM" id="form_submit_btn">
    </div>
  </div>

                    
                </div>


            </form>
        </div>
    </div>
</div>

<script>
   
  </script>

</body>
</html>

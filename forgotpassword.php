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
    <title>FORGOT PASSWORD</title>
    <link rel="icon" href="icons/usep-logo.png">
    <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="node_modules/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body style="">
<div>
    <?php include 'header.php'?>
    <div class="main-content">
        <div class="form-box" >
            <form action="confirm-email.php" method="POST">
                <div class="form-content">
                    <div style="margin-top: 30px"> <img src="icons/usep-logo.png" alt="" style="width: 70px"></div>
                    <div>
                    <p style="font-weight: 700; font-size: 10px;  letter-spacing: 0.2px; margin-top: 15px;">TROUBLE LOGGING IN?</p>
                    </div>
                    <div style="text-align: center;">
                    <p style="font-weight: 500; font-size: 10px;  letter-spacing: 0.2px;letter-spacing: 0.1px; margin: 0; padding: 0;">Enter the email associated with your account</p>
                    <p style="font-weight: 500; font-size: 10px;  letter-spacing: 0.2px;letter-spacing: 0.1px; margin-bottom: 30px; padding: 0;">a code will be sent to your email.</p>
                    </div>
                
                    <div style="display: inline;">
                        <input type="text" id="userType" value="Student" style="display: none">
                        <label for="user_email">Enter Email</label>
                        <br>
                        <input name="username" type="text" id="user_email" autofocus><br>
                        <span id="emailWarning" style="color: red; display: none; font-size: 8px">Invalid email address</span>
                        
                        <div>
                            <input type="submit" name="form_submit_btn" value="SUBMIT" id="form_submit_btn">
                        </div>
                        
                    </div>

                    
                </div>


            </form>
        </div>
    </div>
</div>

<script src="node_modules/jquery/dist/jquery.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>

<script>
  document.getElementById("form_submit_btn").addEventListener("click", function() {
    var emailInput = document.getElementById("user_email").value;
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (emailRegex.test(emailInput)) {
      document.getElementById("emailWarning").style.display = "none";
      // Your additional logic or actions for valid email
      window.location.href = "otherfile.php";
    } else {
      document.getElementById("emailWarning").style.display = "inline";
      // Your additional logic or actions for invalid email
    }
  });

  document.getElementById("user_email").addEventListener("input", function() {
    var emailInput = document.getElementById("user_email").value;
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (emailRegex.test(emailInput)) {
      document.getElementById("emailWarning").style.display = "none";
    } else {
      document.getElementById("emailWarning").style.display = "inline";
    }
  });
</script>
<!--<script>-->
<!--    $(document).ready(function(){-->
<!--        $("#loginForm").submit(function (event) {-->
<!--            event.preventDefault();-->
<!--            $("#form_submit_btn").prop("disabled", true);-->
<!---->
<!--            var username = $("#user_username").val();-->
<!--            var password = $("#user_password").val();-->
<!---->
<!--            $.ajax({-->
<!--                type: "POST",-->
<!--                url: "operations/authentication.php",-->
<!--                data: {-->
<!--                    username: username,-->
<!--                    password: password-->
<!--                },-->
<!--                dataType: 'json',-->
<!---->
<!--                success: function (response) {-->
<!--                    $("#form_submit_btn").prop("disabled", false);-->
<!--                    console.log(response);-->
<!---->
<!--                    var login_result = response.login_result;-->
<!---->
<!--                    if (login_result == "login_successful") {-->
<!--                        window.location = 'user/home.php';-->
<!--                    } else if (login_result == "wrong_password") {-->
<!--                        Swal.fire({-->
<!--                            title: 'Login Failed!',-->
<!--                            text: "Incorrect username or password",-->
<!--                            icon: 'error',-->
<!--                            confirmButtonColor: '#A24D4D',-->
<!--                            confirmButtonText: 'Try Again',-->
<!--                        });-->
<!--                    } else if (login_result == "empty_fields") {-->
<!--                        Swal.fire({-->
<!--                            title: 'Login Failed!',-->
<!--                            text: "Some fields are empty. Make sure to fill in all fields.",-->
<!--                            icon: 'error',-->
<!--                            confirmButtonColor: '#A24D4D',-->
<!--                            confirmButtonText: 'Try Again!'-->
<!--                        });-->
<!--                    } else {-->
<!--                        Swal.fire({-->
<!--                            title: 'Login Failed!',-->
<!--                            text: "Account does not exist in our database!",-->
<!--                            icon: 'error',-->
<!--                            confirmButtonColor: '#A24D4D',-->
<!--                            confirmButtonText: 'Try Again!'-->
<!--                        });-->
<!--                    }-->
<!--                },-->
<!--                error: function () {-->
<!--                    $("#form_submit_btn").prop("disabled", false);-->
<!--                }-->
<!--            });-->
<!--        });-->
<!--    });-->
<!--</script>-->

</body>
</html>

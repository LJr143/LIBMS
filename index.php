<?php
session_start();
require_once 'db_config/config.php';
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
    <title>USeP | LMS</title>
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
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-content">
                    <div style="margin-top: 30px"> <img src="icons/usep-logo.png" alt="" style="width: 70px"></div>
                    <div>
                        <p style="font-weight: 700; font-size: 10px; padding: 10px; letter-spacing: 0.2px; margin-top: 15px;">Hello! Please Login To Continue</p>
                    </div>

                    <div style="display: inline;">
                        <input type="text" id="userType" value="Student" style="display: none">
                        <label for="user_username">Username</label>
                        <br>
                        <input name="username" type="text" id="user_username" autofocus>
                        <br>
                        <label for="user_username">Password</label>
                        <br>
                        <input name="password" type="password" id="user_password">
                        <br>
                        <div style="display: flex; justify-content: space-between">
                            <div style="display:flex;">
                                <input type="checkbox" id="show_password_checkbox" onclick="togglePasswordVisibility()" style="width: 12px">
                                <label style="font-size: 8px; margin-top: 7.5px">&nbsp;show password</label>
                            </div>
                            <div>
                                <a href="" style="font-size: 8px">forgot password?</a>
                            </div>
                        </div>
                        <input type="submit" name="form_submit_btn" value="LOGIN" id="form_submit_btn">
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
<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
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
<script>
    $(document).ready(function() {
        $("#form_submit_btn").click(function(e) {
            e.preventDefault();

            var username = $("#user_username").val();
            var password = $("#user_password").val();
            var role = $("#userType").val();

            console.log(username);
            console.log(password);
            console.log(role);

            $.ajax({
                type: "POST",
                url: "operations/login.php", // Replace with the actual path to your PHP script
                data: {
                    username: username,
                    password: password,
                    admin_role: role,
                    form_submit_btn: 1
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.status === "success") {
                        window.location.href = "user/home.php";
                    }
                    else {
                        alert("Login failed. " + response.message);
                    }
                }
            });
        });
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

<?php
session_start();
require_once 'db_config/config.php';
$db = new Database();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <form id="loginForm">
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
                        <input name="form_submit_btn" type="button" value="LOGIN" id="form_submit_btn">
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
<script>
    $(document).ready(function() {
        $("#form_submit_btn").click(function(e) {
            e.preventDefault();
            submitForm();
        });
        
        $('#user_username, #user_password, #admin_role').keypress(function (e) {
            if (e.which === 13) {
                e.preventDefault();
                submitForm();
            }
        });

        function submitForm() {
            var username = $("#user_username").val();
            var password = $("#user_password").val();
            var role = $("#admin_role").val();

            $.ajax({
                type: "POST",
                url: "operations/login.php",
                data: {
                    username: username,
                    password: password,
                    admin_role: role,
                    form_submit_btn: 1
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.status === "admin_success") {
                        window.location.href = "admin/dashboard.php";
                    } else if (response.status === "superadmin_success"){
                        window.location.href = "superadmin/dashboard.php";
                    } else {
                        alert("Login failed. " + response.message);
                    }
                }
            });
        }
    });
</script>
<script>
    document.addEventListener('keydown', async function(event) {
        if (event.ctrlKey && event.shiftKey) {
            switch (event.key) {
                case 'H':
                    const result = await Swal.fire({
                        title: "Enter Access Code",
                        input: "password",
                        inputPlaceholder: "Enter your access code",
                        inputAttributes: {
                            maxlength: "10",
                            autocapitalize: "off",
                            autocorrect: "off",
                        },
                        showCancelButton: true,
                        customClass: {
                            input: 'custom-input-class',
                            cancelButton: 'custom-cancel-button-class'
                        }
                    });

                    if (result.isConfirmed) {
                        const code = result.value;
                        $.ajax({
                            type: "POST",
                            url: "../operations/access_code.php",
                            data: {
                                code: code
                            },
                            dataType: 'json',
                            success: function (response) {
                                if (response.administrator) {
                                    let timerInterval;
                                    Swal.fire({
                                        title: "Redirecting to Admin Login!",
                                        html: "please wait <b></b> milliseconds.",
                                        timer: 2000,
                                        timerProgressBar: true,
                                        didOpen: () => {
                                            Swal.showLoading();
                                            const timer = Swal.getPopup().querySelector("b");
                                            timerInterval = setInterval(() => {
                                                timer.textContent = `${Swal.getTimerLeft()}`;
                                            }, 100);
                                        },
                                        willClose: () => {
                                            clearInterval(timerInterval);
                                        }
                                    }).then((result) => {
                                        if (result.dismiss === Swal.DismissReason.timer) {
                                            window.location.href='index_admin.php';
                                        }
                                    });
                                }
                                else if (response.user) {
                                    let timerInterval;
                                    Swal.fire({
                                        title: "Redirecting to User Page!",
                                        html: "please wait <b></b> milliseconds.",
                                        timer: 2000,
                                        timerProgressBar: true,
                                        didOpen: () => {
                                            Swal.showLoading();
                                            const timer = Swal.getPopup().querySelector("b");
                                            timerInterval = setInterval(() => {
                                                timer.textContent = `${Swal.getTimerLeft()}`;
                                            }, 100);
                                        },
                                        willClose: () => {
                                            clearInterval(timerInterval);
                                        }
                                    }).then((result) => {
                                        if (result.dismiss === Swal.DismissReason.timer) {
                                            window.location.href='index.php';
                                        }
                                    });
                                }




                                else {
                                    Swal.fire({
                                        title: "Invalid Code",
                                        text: "The entered password is not valid.",
                                        icon: "error"
                                    });
                                }
                            },
                            error: function () {
                                Swal.fire({
                                    title: "Error",
                                    text: "An error occurred while checking the password.",
                                    icon: "error"
                                });
                            }
                        });
                    }
                    break;
            }
        }
    });
</script>

</body>
</html>

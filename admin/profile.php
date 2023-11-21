<?php
session_start();
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
include 'C:\wamp64\www\LIBMS\operations\authentication.php';
include 'C:\wamp64\www\LIBMS\includes\fetch_user_data.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$loggedAdmin ='';

$database = new Database();
$userAuth = new UserAuthentication($database);
$userData = new UserData($database);

if ($userAuth->isAuthenticated()) {
} else {
    header('Location: ../index_admin.php');
    exit();
}

if (isset($_POST['logout'])) {
    $userAuth->logout();
    header('Location: ../index_admin.php');
    exit();
}
if (isset($_SESSION['user'])) {
    $adminUsername = $_SESSION['user'];

    $adminID = $userData->getAdminIdByUsername($adminUsername);
    if (!empty($adminID)) {
        $admin = $userData->getAdminById($adminID);

        if (!empty($admin)) {
            $loggedAdmin = $admin[0];
        } else {
            echo 'Admin data not found.';
        }
    } else {
        echo 'Invalid admin ID.';
    }

}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>USeP | LMS</title>
    <link rel="icon" href="../icons/usep-logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/admin_profile.css">
    <link rel="stylesheet" href="../css/logout.css">
</head>

<body style="">
    <div>
        <nav class="navbar navbar-light bg-light header">
            <div class="container-fluid">

                <div class="head-text">
                    <div> <img src="../icons/usep-logo.png" alt="" class="custom_img" id="usep-logo"></div>
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

        <div class="main-content d-flex">
            <div class="col col-md-2 side_bar">
                <div class="profile_section">
                    <div>
                        <img style="width: 60px; border-radius: 60px;" src="../img/me_sample_profile.jpg" alt="">
                    </div>
                    <div style="display: block; text-align: center; color: white; height: 20px;">
                        <ul style="margin-right: 36px;">
                            <li style="font-size: 12px; color: #0cb90c; font-weight: 600">Active</li>
                        </ul>
                    </div>
                </div>
                <div>
                    <ul class="menu_icon">
                        <li><img class="custom_menu_icon" src="../icons/dashboard_icon.png" alt=""><span><a href="dashboard.php">Dashboard</a></span></li>
                        <li><img class="custom_menu_icon" src="../icons/staff_icon.png" alt=""><span><a href="student.php">Student</a></span></li>
                        <li><img class="custom_menu_icon" src="../icons/reports_icon.png" alt=""><span><a href="report.php">Reports</a></span></li>
                        <li><img class="custom_menu_icon" src="../icons/logs_icon.png" alt=""><span><a href="logs.php">Logs</a></span></li>
                        <li><img class="custom_menu_icon" src="../icons/admin_inventory_menu.png" alt=""><span><a href="inventory.php">Inventory</a></span></li>

                    </ul>
                </div>

            </div>
            <div class="col" style=" width: 100%; height: 100vh; ">
                <div style="background-color: white; width: 95%; height: 45px; margin: 15px; border-radius: 5px;display: flex; box-shadow: 0px 4px 8px rgba(0,0,0,0.27); align-content: center; align-items: center">
                    <div style="width: 90%">
                        <p style="font-size: 10px; font-weight: 700; margin: 14px">HOME | PROFILE | MANAGE PROFILE</p>
                    </div>
                    <div class=" d-flex justify-content-end align-items-center" style="height: 50px; width: 10%; margin-right: 20px ">
                        <div class="dropdown" style=" margin-right: 0px; position: absolute">
                            <button style="background: none; border: none;" class=" dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="../img/<?= $loggedAdmin['img'] ?>" alt="" width="35px" style="border-radius: 60px; border: 1px solid #4d0202">
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark dropdown_menu_setting" aria-labelledby="dropdownMenuButton2">
                                <li><a style="font-size: 12px; color: white;" class="dropdown-item" href="profile.php"><img src="../icons/manage_account.png" alt="" class="custom_icon"><span>Manage Account</span></a></li>
                                <li><a style="font-size: 12px; color: white;" class="dropdown-item" href="#"><img src="../icons/help.png" alt="" class="custom_icon"><span>Help</span></a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <form action="" method="post" style="margin-left: 20px;">

                                    <label for="logout"><img src="../icons/plug.png" style="width: 20px; " alt=""></label>
                                    <input id="logoutButton" style="font-size: 12px; color: white; background: none; border: none;" name="logout" type="submit" value="Logout">
                                </form>
                            </ul>
                        </div>
                    </div>
                </div>

                <div style="display: flex; justify-content: center; ">
                    <div style="background-color: white; width: 95%; height: 40px; margin: 0px; border-radius: 5px;display: flex; box-shadow: 0px 4px 8px rgba(0,0,0,0.27); align-items: center; align-content: center">
                        <p style="color: rgb(116,0,0); font-weight: 600; font-size: 12px; margin: 0px 0px 0px 15px;">PROFILE</p>

                    </div>
                </div>
                <div style="display: flex; justify-content: center;">
                    <div class="row " style="width: 95%; display: flex; justify-content: space-between">
                        <div style="height: 300px; width: 20rem; box-shadow:0px 4px 8px rgba(0,0,0,0.27); margin: 20px 0px; ">
                            <div style="width: 100%; display: flex; justify-content: center; margin: 50px 0 0 0;">
                                <img style="width: 150px; border-radius: 100px; border: 1px solid rgb(116,0,0)" src="../img/me_sample_profile.jpg" alt="">
                            </div>
                            <div style="margin: 14px 0 0 0;">
                                <div style="display: flex; width: 100%; justify-content: center">
                                    <p style="font-size: 12px; color: rgb(116,0,0); font-weight: 600; font-style: italic">Lorjohn M. Raña</p>
                                    <span><button style="border: none; background: transparent">
                                            <img id="editStudentBtn" style="width: 15px; margin: -10px 0 0 5px;" src="../icons/edit_profile_icon.png" alt="">
                                        </button></span>
                                </div>
                                <div style="width: 100%; display: flex; justify-content: center; margin-top: -15px">
                                    <p style="font-size: 12px; font-weight: 700;">LIBRARIAN</p>
                                </div>

                            </div>

                        </div>
                        <div style=" width: 57rem; height: 300px; box-shadow:0px 4px 8px rgba(0,0,0,0.27); margin: 20px 0px; ">

                            <div style="margin: 30px 20px">
                                <h6 style="font-size: 12px; color: rgb(116,0,0)">PERSONAL INFORMATION</h6>
                                <p class="personal_infor_p">STAFF ID &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; 2021-0001</p>
                                <p class="personal_infor_p">FULL NAME &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;Lorjohn M. Raña</p>
                                <p class="personal_infor_p">PHONE NUMBER&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;09096763912</p>
                                <p class="personal_infor_p">TELEPHONE NUMBER&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;09096763912</p>
                                <p class="personal_infor_p">HOME ADDRESS&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Prk. 3-C Sabina Homes Apokon Tagum City Davao Del Norte</p>

                            </div>

                            <div style="margin: 30px 20px">
                                <h6 style="font-size: 12px; color: rgb(116,0,0)">ACCOUNT</h6>
                                <p class="personal_infor_p">EMAIL&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; lmrana00027@usep.edu.ph</p>
                                <p class="personal_infor_p">USERNAME &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;imOutOffLoveBoyah143</p>
                                <p class="personal_infor_p">PASSWORD&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;*********</p>
                            </div>

                        </div>
                    </div>
                </div>
                <div style="display: flex; justify-content: center;">
                    <div style="background-color: white; width: 95%; height: 200px; margin: 0px; border-radius: 5px;display: flex; box-shadow: 0px 4px 8px rgba(0,0,0,0.27);">
                        <div style="margin: 30px 20px; width: 28rem">
                            <h6 style="font-size: 12px; color: rgb(116,0,0)">CHANGE PASSWORD</h6>
                            <p style="margin-top: 10px; margin-bottom: 30px; margin-left: 10px;font-size: 10px; font-weight: 600">To protect your account, make sure your password:</p>
                            <ul class="list_password_accept">
                                <li>
                                    <p style="margin-left: 10px;font-size: 10px; font-weight: 600"> Is longer than 8 letters.</p>
                                </li>
                                <li>
                                    <p style="margin-left: 10px;font-size: 10px; font-weight: 600"> Contains an uppercase character.</p>
                                </li>
                                <li>
                                    <p style="margin-left: 10px;font-size: 10px; font-weight: 600"> Contains lowercase character.</p>
                                </li>
                                <li>
                                    <p style="margin-left: 10px;font-size: 10px; font-weight: 600"> Contains a number.</p>
                                </li>
                                <li>
                                    <p style="margin-left: 10px;font-size: 10px; font-weight: 600"> Contains a special character.</p>
                                </li>
                            </ul>

                        </div>

                        <!--FOR CHANGE PASS-->
                       <div style="margin: 30px 20px; width: 100%;">
                           <div style="display: flex; align-items: center">
                              <div style="margin-right: 30px">
                                <form class="row needs-validation" style="margin-left: 30px; width: 100%; height: 65%;" novalidate>

                                    <div class="col col-md-4 mt-3">
                                        <div style="margin-right: 30px">
                                            <label style="font-size: 12px; font-weight: 600" for="change_password_old_pass">OLD PASSWORD</label>
                                            <br>
                                            <input type="password" class="form-control" value="Newpass_1" id="validationPassword" style="font-size: 12px;" aria-describedby="inputGroupPrepend"
                                                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@_]).{8,}"
                                                   title="Must contain at least one number, one uppercase and lowercase letter, one symbol, and at least 8 or more characters"
                                                   required>
                                            <div class="invalid-feedback" id="passwordRequirements" style="font-size: 8px; display: none;">
                                                Not a valid password!
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col col-md-4 mt-3">
                                        <div style="margin-right: 30px">
                                            <label style="font-size: 12px;font-weight: 600" for="change_password_new_pass">NEW PASSWORD</label>
                                            <br>
                                            <input type="password" class="form-control" placeholder="Type New Password" id="validationPassword" style="font-size: 12px;" aria-describedby="inputGroupPrepend"
                                                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@_]).{8,}"
                                                   title="Must contain at least one number, one uppercase and lowercase letter, one symbol, and at least 8 or more characters"
                                                   required>
                                            <div class="invalid-feedback" id="passwordRequirements" style="font-size: 8px; display: none;">
                                                Not a valid password!
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col col-md-4 mt-3">
                                        <div style="margin-right: 30px">
                                            <label style="font-size: 12px; font-weight: 600" for="change_password_new_pass">CONFIRM NEW PASSWORD</label>
                                            <br>
                                            <input type="password" class="form-control" placeholder="Confirm New Password" id="validationPassword" style="font-size: 12px;" aria-describedby="inputGroupPrepend"
                                                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@_]).{8,}"
                                                   title="Must contain at least one number, one uppercase and lowercase letter, one symbol, and at least 8 or more characters"
                                                   required>
                                            <div class="invalid-feedback" id="passwordRequirements" style="font-size: 8px; display: none;">
                                                Not a valid password!
                                            </div>
                                        </div>
                                    </div>


                                    <div style="width: 100%; display: flex; margin-top: 40px">
                                        <button class="change_pass_btn" style="margin-left: 540px; background: transparent; color: rgb(116,0,0); border: 1px solid rgb(116,0,0)">CLEAR</button>
                                        <button class="change_pass_btn" style="margin-left: 20px">SAVE</button>
                                    </div>
                              </form>
                            </div>
                           </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editStudentModal" tabindex="-1" role="dialog" aria-labelledby="editStudentModalLabel" aria-hidden="true">
      <div class="modal-dialog  modal-dialog-centered" role="document" style="max-width: 800px;">
          <div class="modal-content">
                <div class="modal-header" style="height: 15px;">

                    <p class="modal-title" id="borrowModalLabel " style="font-size: 12px; color: #800000; font-weight: 600;">
                        <i class="bi bi-pencil-square ml-3 m-3" style="font-size: 16px; color: #800000;"></i>EDIT PROFILE
                    </p>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="background-color: transparent; border:none;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid " style="padding-left: 40px ; padding-right: 40px">
                        <div class="row">

                            <!-- uploading image -->
                            <div style="width: 100px; height: 100px; overflow: hidden; border: 1px solid maroon; border-radius: 50%; margin: 0 auto; margin-top:40px;">
                                <label for="profilePictureInput" class="AddImageContainer" style="display: flex; justify-content: center; align-items: center; width: 100%; height: 100%;">
                                    <i class="bi bi-plus-circle" title="Add Image" style="color: grey;"></i>
                                    <img src="../img/me_sample_profile.jpg" width="100" height="100" id="Profile-Pic" style="display: block; margin-left: -14px;">
                                </label>
                                <input type="file" accept="image/jpeg, image/png, image/jpg" id="profilePictureInput" class="visually-hidden mb-0" accept="image/*" onchange="updateProfilePicture(event)">
                            </div>


                            <form class="row needs-validation" style="margin-left: 30px; width: 80%; height: 65%;" novalidate>
                                <div class="col-md-5 firstname">
                                    <label for="validationFirstName" class="form-label mb-0" style="font-size: 12px;">FIRST NAME</label>
                                    <input type="text" class="form-control" placeholder="Juan" id="validationFirstName" style="font-size: 10px; text-transform: capitalize !important;" required pattern="[A-Za-z]+" required>
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid first name!
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <label for="validationLastName" class="form-label mb-0" style="font-size: 12px;">LAST NAME</label>
                                    <input type="text" class="form-control" placeholder="Dela Cruz" id="validationLastName" style="font-size: 10px; text-transform: capitalize !important;" required pattern="[A-Za-z]+" required>
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid last name!
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="validationMI" class="form-label mb-0" style="font-size: 12px;">M.I.</label>
                                    <input type="text" class="form-control mb-0" placeholder="I" id="validationMI" style="font-size: 10px; text-transform: uppercase !important;" required pattern="[A-Za-z]{1}">
                                    <div class="invalid-feedback" style="font-size:8px">
                                        Not a valid M.I. !
                                    </div>
                                </div>

                                <div class="col-md-5 mt-3">
                                    <label for="validationEmail" class="form-label mb-0" style="font-size: 12px;">EMAIL ADDRESS</label>
                                    <div class="input-group has-validation">
                                        <input type="email" class="form-control" id="validationEmail" aria-describedby="inputGroupPrepend" placeholder="juan001@usep.edu.ph" style="font-size: 10px;" required>
                                        <div class="invalid-feedback" style="font-size: 8px;">
                                            Not a valid email address!
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-3">
                                    <label for="validationPhoneNumber" class="form-label mb-0" style="font-size: 12px;">PHONE NUMBER</label>
                                    <input type="tel" class="form-control" id="validationPhoneNumber" pattern="[0-9]{11}" placeholder="091234567890" style="font-size: 10px;" required>
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid phone number with 11 digits!
                                    </div>
                                </div>

                                <div class="col-md-8 mt-2">
                                    <label for="validationAddress" class="form-label mb-0" style="font-size: 12px; ">ADDRESS</label>
                                    <input type="text" class="form-control" id="validationAddress" style="font-size: 10px; text-transform: capitalize !important;" placeholder="Purok, Baranggay, City/Municipality, Province" required>
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid address!
                                    </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                    <label for="validationTelNumber" class="form-label mb-0" style="font-size: 12px;">TELEPHONE NUMBER</label>
                                    <input type="tel" class="form-control" id="validationTelNumber" pattern="[0-9]{2}-[0-9]{4}-[0-9]{4}" placeholder="02-1234-5678" style="font-size: 10px;" required>
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid tel number with 10 digits!
                                    </div>
                                </div>

                                <div class="col col-md-5 mt-3">
                                    <label for="validationOfficeAdd" class="form-label mb-0" style="font-size: 12px;">OFFICE ADDRESS</label>
                                    <div class="input-group has-validation">
                                        <input type="text" class="form-control " id="validationOfficeAdd" aria-describedby="inputGroupPrepend" value="lmrana00027@usep.edu.ph" style="font-size: 10px;" readonly>
                                    </div>
                                </div>

                                <div class=" col col-md-3 mt-3">
                                    <label for="validationUsername" class="form-label mb-0" style="font-size: 12px;">USERNAME</label>
                                    <div class="input-group has-validation">
                                        <input type="text" class="form-control" id="validationUsername" aria-describedby="inputGroupPrepend" value="johnjohn" style="font-size: 10px;" readonly>
                                    </div>
                                </div>


                        <div class=" wishlist-container  mt-4 mb-0 " style=" display: flex; justify-content: flex-end; width: 664px; ">
                            <button style="height: 25px; width: 100px" type="button" class="clear shadow " onclick="clearPhoto()">CLEAR</button>
                            <button style="height: 25px; width: 100px" type="submit" class="add shadow" >SAVE</button>
                        </div>
                     </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src='../js/logout_script.js'></script>
    <script src='../js/student.js'></script>

    <script>
        $(document).ready(function() {
            // Attach a click event to the "ADD STUDENT" button
            $("#editStudentBtn").click(function() {
                // Show the student modal
                $("#editStudentModal").modal("show");
            });

            // Handle the file input change event
            $("#input-file").change(function() {
                readURL(this);
            });

        });

        // Function to handle adding a student (you can replace this with your actual logic)
        function addStudent() {
            // Add your logic here
            $("#editStudentModal").modal("hide");
        }

        // Function to clear the displayed photo
        function clearPhoto() {
            $('#Profile-Pic').attr('src', '');
            $(".AddImageContainer i").show();
        }
    </script>

    <script>
        function updateProfilePicture(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const profilePic = document.getElementById('Profile-Pic');
                    profilePic.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>


</body>

</html>
<?php
session_start();
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
include 'C:\wamp64\www\LIBMS\operations\authentication.php';
include 'C:\wamp64\www\LIBMS\includes\fetch_user_data.php';

include 'C:\wamp64\www\LIBMS\includes\fetch_staff_data.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$loggedAdmin ='';

$database = new Database();
$userAuth = new UserAuthentication($database);
$adminData = new StaffData($database);
$userData = new UserData($database);
$userList = $userData->getAllUsers();

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

    $adminID = $adminData->getStaffIdByUsername($adminUsername);
    if (!empty($adminID)) {
        $admin = $adminData->getStaffById($adminID);

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/admin_student.css">
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
                    <img style="border: 3px solid white; width: 60px; border-radius: 60px;" src="../img/<?= $loggedAdmin['img'] ?>" alt="">
                    <div style="position: absolute; top: 55px; right: 72px; background:#01d501; height: 15px; width: 15px; border-radius: 60px;"></div>
                </div>
                <div style="display: block; text-align: center; color: white; height: 20px;">

                </div>
            </div>
            <div>
                <ul class="menu_icon">
                    <li><img class="custom_menu_icon" src="../icons/dashboard_icon.png" alt=""><span><a href="dashboard.php">Dashboard</a></span></li>
                    <li class="active"><img class="custom_menu_icon" src="../icons/staff_icon.png" alt=""><span><a href="student.php">Student</a></span></li>
                    <li><img class="custom_menu_icon" src="../icons/reports_icon.png" alt=""><span><a href="report.php">Reports</a></span></li>
                    <li><img class="custom_menu_icon" src="../icons/logs_icon.png" alt=""><span><a href="logs.php">Logs</a></span></li>
                    <li><img class="custom_menu_icon" src="../icons/admin_inventory_menu.png" alt=""><span><a href="inventory.php">Inventory</a></span></li>

                </ul>
            </div>

        </div>
        <div class="col" style=" width: 100%; height: 100vh; ">
            <div style="background-color: white; width: 95%; height: 45px; margin: 15px; border-radius: 5px;display: flex; box-shadow: 0px 4px 8px rgba(0,0,0,0.27); align-content: center; align-items: center">
                <div style="width: 90%">
                    <p style="font-size: 10px; font-weight: 700; margin: 14px">HOME | STUDENT</p>
                </div>
                <div class=" d-flex justify-content-end align-items-center" style="height: 50px; width: 10%; margin-right: 20px ">
                    <div class="dropdown" style=" margin-right: 0px; position: absolute">
                        <button style="background: none; border: none;" class=" dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="../img/<?= $loggedAdmin['img'] ?>" alt="" width="35px" style="border-radius: 60px; border: 1px solid #4d0202">
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark dropdown_menu_setting aria-labelledby="dropdownMenuButton2">
                        <li><a style="font-size: 12px; color: white;" class="dropdown-item" href="profile.php"><img src="../icons/manage_account.png" alt="" class="custom_icon"><span>Manage Account</span></a></li>
                        <li><a style="font-size: 12px; color: white;"class="dropdown-item" href="#"><img src="../icons/help.png" alt="" class="custom_icon"><span>Help</span></a></li>
                        <li><hr class="dropdown-divider"></li>

                        <form action="" method="post" style="margin-left: 20px;">

                            <label for="logoutButton"><img src="../icons/plug.png" style="width: 20px; " alt=""></label>
                            <input id="logoutButton" style="font-size: 12px; color: white; background: none; border: none;" name="logout" type="submit" value="Logout">
                        </form>
                        </ul>
                    </div>
                </div>
            </div>

            <div style="display: flex; justify-content: center; ">
                <div style="background-color: white; width: 95%; height: 55px; margin: 15px; border-radius: 5px;display: flex; box-shadow: 0px 4px 8px rgba(0,0,0,0.27); align-items: center">
                    <div class="col col-md-10" style="display: flex">
                        <select name="" id="" style="width: 150px; padding: 0px 10px; margin-left: 10px; border-radius: 5px;  height: 30px; font-size: 12px;">
                            <option value="">SEARCH BY</option>
                            <option value="">College</option>
                            <option value="">Course</option>
                            <option value="">Section</option>
                            <option value="">Department</option>

                        </select>
                        <div class="input_search-wrapper" style="margin-left: 20px;">
                            <input type="search" class="search-input" id="studentSearch" placeholder="Search Student">

                        </div>
                    </div>

                    <div class="col col-md-2">
                        <button style="width: 30px; border: none; background: transparent;"><img style="width: 25px; margin-right: 20px;" src="../icons/download_icon.png" alt=""></button>
                        <button id="addStudentBtn" style="font-size: 12px; width: 150px; height: 30px; border-radius: 5px; background-color: rgb(128,0,0); color: white; border: none">ADD STUDENT</button>
                    </div>
                </div>
            </div>

            <div style="display: flex; justify-content: center; ">
                <div style="font-size: 12px; background-color: white; width: 95%; max-height: 550px; box-shadow: 0px 4px 8px rgba(0,0,0,0.27);">
                    <div style="width: 100%; display: flex; justify-content: center; border-radius: 5px">
                        <table class="table text-center" style="width: 98%;">
                            <thead>
                            <tr>
                                <th><input type="checkbox" id="selectAllCheckbox" style="position: absolute; margin: 2px 0px 0px -20px;">Select All</th>
                                <th></th>
                                <th>Name</th>
                                <th>Course</th>
                                <th>Year Level</th>
                                <th>Status</th>
                                <th>Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($userList as $user) : ?>
                                <tr style="height: 10px"></tr>
                                <tr style="height: 40px; background-color: rgb(246, 246, 246); margin-bottom: 10px; border: 1px solid rgba(0, 0, 0, 0.25);">
                                    <td><input type="checkbox"></td>
                                    <td><img src="../img/<?= $user['img'] ?>" alt="" width="35px" height="35px" style="border-radius: 60px; border: 1px solid #4d0202"></td>
                                    <td><?= ucfirst($user['fname']) . ' ' . ucfirst($user['initial']) . '. ' . ucfirst($user['lname']); ?></td>                                    <td><?= $user['course'] ?></td>
                                    <td><?= $user['year'] ?></td>
                                    <td style="color: <?= ($user['status'] == 'Active') ? 'green' : 'red'; ?>;"><?= $user['status'] ?></td>
                                    <td style="padding: 1px;">
                                        <div class="btn-group" role="group">
                                            <a href="#" class="btn custom-btn editStudentProfile" data-user-id="<?= $user['user_id']; ?>">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a href="#" class="btn custom-btn deleteStudent" data-user-id="<?= $user['user_id']; ?>" data-student-name="<?= $user['fname'] . ' ' . $user['lname']; ?>">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                            <?php if ($user['status'] == 'Active') : ?>
                                                <a href="#" style="color: red" class="btn custom-btn suspend_student" data-user-id="<?= $user['id']; ?>" data-student-name="<?= $user['fname'] . ' ' . $user['lname']; ?>">
                                                    <i class="bi bi-exclamation-octagon"></i>
                                                </a>
                                            <?php else : ?>
                                                <a href="#" style="color: green" class="btn custom-btn activate_student" data-user-id="<?= $user['id']; ?>" data-student-name="<?= $user['fname'] . ' ' . $user['lname']; ?>">
                                                    <i class="bi bi-check"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                        </table>


                    </div>
                    <div style="width: 100%; display: flex; justify-content: center; margin: 20px 0px">
                        <div class="row" style="width: 98%;">
                            <div class="col col-md-8" style="">
                                <img style="width: 180px" src="../icons/pagination_sample.png" alt="">
                            </div>
                            <div class="col col-md-4" style="display: flex; padding: 0; margin: 0">
                                <button style="margin-left: 160px" id="deleteAllUser" class="operation_all_btn">Delete All</button>
                                <button style="margin-left: 10px; " id="suspendAll" class="operation_all_btn">Suspend All</button>
                            </div>
                        </div>

                    </div>


                </div>
            </div>

        </div>
    </div>
</div>

<!-- Add Student Modal-->
<div class="modal fade" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="studentModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document" style="max-width: 800px;">
        <div class="modal-content">
            <div class="modal-header" style="height: 15px;">

                <p class="modal-title" id="borrowModalLabel " style="font-size: 12px; color: #800000; font-weight: 600;">
                    <i class="bi bi-pencil-square ml-3 m-3" style="font-size: 16px; color: #800000;"></i>ADD STUDENT
                </p>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="background-color: transparent; border:none;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid " style="padding-left: 40px ; padding-right: 40px">
                    <div class="row">

                        <!-- uploading image -->
                        <!-- add new photo -->
                        <div style="width: 100px; height:220px;">
                            <div class="col-md-2" style="margin-bottom: 0px; margin-left: 8px;">
                                <div class="AddImageContainer" style="margin-top: 60px; display: flex; justify-content: center; border: 1px solid maroon; width: 100px; height: 100px">
                                    <i class="bi bi-plus-circle" title="Add Image" style="color: grey; "></i>
                                    <img src="" width="110" height="120" id="Profile-Pic" style="margin-top: -10px;">

                                </div>
                                <input type="file" accept="image/jpeg, image/png, image/jpg" id="addStudentinput-file" class="visually-hidden mb-0" required>
                            </div>
                        </div>


                        <form id="AddStudentModal" class="row needs-validation "  style="margin-left: 30px; width: 80%; height: 65%; "  novalidate >
                            <div class="col-md-5 firstname">
                                <label for="addStudentFirstName" class="form-label mb-0" style="font-size: 12px;">FIRST NAME</label>
                                <input type="text" class="form-control" placeholder="Juan" id="addStudentFirstName" style="font-size: 10px; text-transform: capitalize !important;" pattern="[A-Za-z]+(?: [A-Za-z]+)?" required>
                                <div class="invalid-feedback" style="font-size: 8px">
                                    Not a valid first name!
                                </div>
                                <div class="valid-feedback" style="font-size: 8px">Looks good!</div>
                            </div>


                            <div class="col-md-5">
                                <label for="addStudentLastName" class="form-label mb-0" style="font-size: 12px;">LAST NAME</label>
                                <input type="text" class="form-control" placeholder="Dela Cruz" id="addStudentLastName" style="font-size: 10px; text-transform: capitalize !important;" pattern="[A-Za-z]+" required>
                                <div class="invalid-feedback" style="font-size: 8px">
                                    Not a valid last name!
                                </div>
                                <div class="valid-feedback" style="font-size: 8px">Looks good!</div>

                            </div>
                            <div class="col-md-2">
                                <label for="addStudentMI" class="form-label mb-0" style="font-size: 12px;">M.I.</label>
                                <input type="text" class="form-control mb-0" placeholder="I" id="addStudentMI" style="font-size: 10px; text-transform: uppercase !important;" required pattern="[A-Za-z]{1}">
                                <div class="valid-feedback" style="font-size: 8px">Looks good!</div>

                            </div>


                            <div class="col-md-3 mt-2">
                                <label for="addStudentStudID" class="form-label mb-0" style="font-size: 12px;">STUDENT ID</label>
                                <input type="text" class="form-control" id="addStudentStudID" pattern="202[0-9]{1}-[0-9]{5}" placeholder="2021-12345" style="font-size: 10px;" required>
                                <div class="invalid-feedback" style="font-size: 8px">
                                    Not a valid student ID!
                                </div>
                                <div class="valid-feedback" style="font-size: 8px">Looks good!</div>
                            </div>


                            <div class="col-md-5 mt-2">
                                <label for="addStudentPersonalEmail" class="form-label mb-0" style="font-size: 12px;">PERSONAL EMAIL ADDRESS</label>
                                <div class="input-group has-validation">
                                    <input type="email" class="form-control" id="addStudentPersonalEmail" aria-describedby="inputGroupPrepend" placeholder="juan001@gmail.com" style="font-size: 10px;" required>
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid email address!
                                    </div>
                                    <div class="valid-feedback" style="font-size: 8px">Looks good!</div>

                                </div>
                            </div>


                            <div class="col-md-4 mt-2">
                                <label for="addStudentPhoneNumber" class="form-label mb-0" style="font-size: 12px;">PHONE NUMBER</label>
                                <input type="tel" class="form-control" id="addStudentPhoneNumber" pattern="[0-9]{11}" placeholder="091234567890" style="font-size: 10px;" required>
                                <div class="invalid-feedback" style="font-size: 8px">
                                    Not a valid phone number with 11 digits!
                                </div>
                                <div class="valid-feedback" style="font-size: 8px">Looks good!</div>

                            </div>


                            <div class="col-md-8 mt-2">
                                <label for="addStudentAddress" class="form-label mb-0" style="font-size: 12px; ">ADDRESS</label>
                                <input type="text" class="form-control" id="addStudentAddress" style="font-size: 10px; text-transform: capitalize !important;" placeholder="Purok, Baranggay, City/Municipality, Province" required>
                                <div class="invalid-feedback" style="font-size: 8px">
                                    Not a valid address!
                                </div>
                                <div class="valid-feedback" style="font-size: 8px">Looks good!</div>

                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="addStudentSectionYear" class="form-label mb-0" style="font-size: 12px; ">SECTION/YEAR</label>
                                <select class="form-select" id="addStudentSectionYear" style="font-size: 10px; text-transform: capitalize !important;" required>
                                    <option value="" disabled selected>Select Section/Year</option>
                                    <option value="1st">1st</option>
                                    <option value="2nd">2nd</option>
                                    <option value="3rd">3rd</option>
                                    <option value="4th">4th</option>
                                    <option value="5th">5th</option>
                                </select>
                                <div class="invalid-feedback" style="font-size: 8px">
                                    Not a valid section/year!
                                </div>
                                <div class="valid-feedback" style="font-size: 8px">Looks good!</div>

                            </div>

                            <div class="col-md-8 mt-2">
                                <label for="addStudentCourse" class="form-label mb-0" style="font-size: 12px; ">COURSE</label>
                                <select class="form-select" id="addStudentCourse" style="font-size: 10px; text-transform: uppercase !important;" required>
                                    <option value="" disabled selected>Select Course</option>
                                    <option value="BSIT">BSIT</option>
                                    <option value="BTVTED">BTVTED</option>
                                    <option value="BECED">BECED</option>
                                    <option value="BECED">BECED</option>
                                    <option value="BSED">BSED</option>
                                    <option value="BSABE">BSABE</option>
                                    <option value="BSNED">BSNED</option>
                                </select>
                                <div class="invalid-feedback" style="font-size: 8px">
                                    Not a valid course!
                                </div>
                                <div class="valid-feedback" style="font-size: 8px">Looks good!</div>

                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="addStudentMajor" class="form-label mb-0" style="font-size: 12px; ">MAJOR</label>
                                <select class="form-select" id="addStudentMajor" style="font-size: 10px; " required>
                                    <option value="" disabled selected>Select Major</option>
                                    <option value="Information Security">Information Security</option>
                                    <option value="English">English</option>
                                    <option value="Mathematics">Mathematics</option>
                                    <option value="Filipino">Filipino</option>
                                </select>
                                <div class="invalid-feedback" style="font-size: 8px">
                                    Not a valid major!
                                </div>
                                <div class="valid-feedback" style="font-size: 8px">Looks good!</div>

                            </div>


                            <div class="col-md-5 mt-3">
                                <label for="addStudentUsepEmail" class="form-label mb-0" style="font-size: 12px;">EMAIL ADDRESS</label>
                                <div class="input-group has-validation">
                                    <input type="email" class="form-control" id="addStudentUsepEmail" aria-describedby="inputGroupPrepend" placeholder="juan001@usep.edu.ph" style="font-size: 10px;" required>
                                    <div class="invalid-feedback" style="font-size: 8px;">
                                        Not a valid email address!
                                    </div>
                                    <div class="valid-feedback" style="font-size: 8px">Looks good!</div>

                                </div>
                            </div>

                            <div class="col col-md-3 mt-3">
                                <label for="addStudentUsername" class="form-label mb-0" style="font-size: 12px;">USERNAME</label>
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" id="addStudentUsername" aria-describedby="inputGroupPrepend" placeholder="juandlz" style="font-size: 10px;" required pattern="^(?=.*[A-Za-z0-9])[A-Za-z0-9]{6,}$">
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid username! Follow the format.
                                    </div>
                                    <div class="valid-feedback" style="font-size: 8px">Looks good!</div>
                                </div>
                            </div>


                            <div class="col col-md-4 mt-3">
                                <label for="addStudentPassword" class="form-label mb-0" style="font-size: 12px;">PASSWORD</label>
                                <div class="input-group has-validation">
                                    <input type="password" class="form-control" placeholder="Password_123" id="addStudentPassword" style="font-size: 10px;" aria-describedby="inputGroupPrepend"
                                           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@_]).{8,}"
                                           title="Must contain at least one number, one uppercase and lowercase letter, one symbol, and at least 8 or more characters"
                                           required>
                                    <div class="invalid-feedback" id="passwordRequirements" style="font-size: 8px; display: none;">
                                        Not a valid password!
                                    </div>
                                    <div class="valid-feedback" style="font-size: 8px">Looks good!</div>

                                </div>
                            </div>


                            <div class="wishlist-container mt-4 mb-0" style="display: flex; justify-content: flex-end; width: 664px;">
                                <button style="height: 25px; width: 100px" type="button" class="clear shadow" onclick="clearForm()">CLEAR</button>
                                <button style="height: 25px; width: 100px" type="submit" id="addStdntBtn" class="add shadow">ADD</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Student Modal -->
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

                            <label for="profilePictureInput" class="AddImageCon" style="display: flex; justify-content: center; align-items: center; width: 100%; height: 100%;">
                                <i class="bi bi-plus-circle" title="Add Image" style="color: grey;"></i>
                                <img src="../img/me_sample_profile.jpg" width="250px" height="100px" id="ProfilePic" style="display: block; margin-left: -4px;">
                            </label>
                            <input type="file" accept="image/jpeg, image/png, image/jpg" id="profilePictureInput" class="visually-hidden mb-0" accept="image/*" onchange="updateProfilePicture(event)">
                        </div>

                        <form class="row needs-validation"  style="margin-left: 30px; width: 80%; height: 65%; "  novalidate >
                            <div class="col-md-5 firstname">
                                <label for="editStudentFname" class="form-label mb-0" style="font-size: 12px;">FIRST NAME</label>
                                <input type="text" class="form-control" placeholder="Juan" id="editStudentFname" style="font-size: 10px; text-transform: capitalize !important;" required pattern="[A-Za-z]+" required>
                                <div class="invalid-feedback" style="font-size: 8px">
                                    Not a valid first name!
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label for="editStudentLname" class="form-label mb-0" style="font-size: 12px;">LAST NAME</label>
                                <input type="text" class="form-control" placeholder="Dela Cruz" id="editStudentLname" style="font-size: 10px; text-transform: capitalize !important;" required pattern="[A-Za-z]+" required>
                                <div class="invalid-feedback" style="font-size: 8px">
                                    Not a valid last name!
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="editStudentInitial" class="form-label mb-0" style="font-size: 12px;">M.I.</label>
                                <input type="text" class="form-control mb-0" placeholder="I" id="editStudentInitial" style="font-size: 10px; text-transform: uppercase !important;" required pattern="[A-Za-z]{1}">
                                <div class="invalid-feedback" style="font-size:8px">
                                    Not a valid M.I. !
                                </div>
                            </div>


                            <div class="col-md-3 mt-2">
                                <label for="editStudentID" class="form-label mb-0" style="font-size: 12px;">STUDENT ID</label>
                                <input type="text" class="form-control" id="editStudentID" pattern="[0-9]{4}-[0-9]{5}" placeholder="2021-00565" style="font-size: 10px;" required>
                                <div class="invalid-feedback" style="font-size: 8px">
                                    Not a valid student ID!
                                </div>
                            </div>


                            <div class="col-md-5 mt-2">
                                <label for="editStudentEmail" class="form-label mb-0" style="font-size: 12px;">EMAIL ADDRESS</label>
                                <div class="input-group has-validation">
                                    <input type="email" class="form-control" id="editStudentEmail" aria-describedby="inputGroupPrepend" placeholder="juan001@usep.edu.ph" style="font-size: 10px;" required>
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid email address!
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-4 mt-2">
                                <label for="editStudentNumber" class="form-label mb-0" style="font-size: 12px;">PHONE NUMBER</label>
                                <input type="tel" class="form-control" id="editStudentNumber" pattern="[0-9]{11}" placeholder="091234567890" style="font-size: 10px;" required>
                                <div class="invalid-feedback" style="font-size: 8px">
                                    Not a valid phone number with 11 digits!
                                </div>
                            </div>


                            <div class="col-md-8 mt-2">
                                <label for="editStudentAddress" class="form-label mb-0" style="font-size: 12px; ">ADDRESS</label>
                                <input type="text" class="form-control" id="editStudentAddress" style="font-size: 10px; text-transform: capitalize !important;" placeholder="Purok, Baranggay, City/Municipality, Province" required>
                                <div class="invalid-feedback" style="font-size: 8px">
                                    Not a valid address!
                                </div>
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="editStudentYear" class="form-label mb-0" style="font-size: 12px; ">SECTION/YEAR</label>
                                <select class="form-select" id="editStudentYear" style="font-size: 10px; text-transform: capitalize !important;" required>
                                    <option value="" disabled selected>Select Section/Year</option>
                                    <option value="1st">1st</option>
                                    <option value="2nd">2nd</option>
                                    <option value="3rd">3rd</option>
                                    <option value="4th">4th</option>
                                    <option value="5th">5th</option>
                                </select>
                                <div class="invalid-feedback" style="font-size: 8px">
                                    Not a valid section/year!
                                </div>
                            </div>

                            <div class="col-md-8 mt-2">
                                <label for="editStudentCourse" class="form-label mb-0" style="font-size: 12px; ">COURSE</label>
                                <select class="form-select" id="editStudentCourse" style="font-size: 10px; text-transform: uppercase !important;" required>
                                    <option value="" disabled selected>Select Course</option>
                                    <option value="BSIT">BSIT</option>
                                    <option value="BTVTED">BTVTED</option>
                                    <option value="BECED">BECED</option>
                                    <option value="BECED">BECED</option>
                                    <option value="BSED">BSED</option>
                                    <option value="BSABE">BSABE</option>
                                    <option value="BSNED">BSNED</option>
                                </select>
                                <div class="invalid-feedback" style="font-size: 8px">
                                    Not a valid course!
                                </div>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="editStudentMajor" class="form-label mb-0" style="font-size: 12px; ">MAJOR</label>
                                <select class="form-select" id="editStudentMajor" style="font-size: 10px; " required>
                                    <option value="" disabled selected>Select Major</option>
                                    <option value="Information Security">Information Security</option>
                                    <option value="English">English</option>
                                    <option value="Mathematics">Mathematics</option>
                                    <option value="Filipino">Filipino</option>
                                </select>
                                <div class="invalid-feedback" style="font-size: 8px">
                                    Not a valid major!
                                </div>
                            </div>


                            <div class="col-md-5 mt-3">
                                <label for="editStudentUsepEmail" class="form-label mb-0" style="font-size: 12px;">EMAIL ADDRESS</label>
                                <div class="input-group has-validation">
                                    <input type="email" class="form-control" id="editStudentUsepEmail" aria-describedby="inputGroupPrepend" placeholder="juan001@usep.edu.ph" style="font-size: 10px;" readonly>

                                </div>
                            </div>

                            <div class=" col col-md-3 mt-3">
                                <label for="editStudentUsername" class="form-label mb-0" style="font-size: 12px;">USERNAME</label>
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" id="editStudentUsername" aria-describedby="inputGroupPrepend" placeholder="juandlz" style="font-size: 10px;" readonly>
                                </div>
                            </div>

                            <div class="col col-md-4 mt-3">
                                <label for="editpsw" class="form-label mb-0" style="font-size: 12px;">PASSWORD</label>
                                <div class="input-group has-validation">
                                    <input type="password" class="form-control" placeholder="Password_123" id="editpsw" style="font-size: 10px;" aria-describedby="inputGroupPrepend"
                                           readonly>

                                </div>
                            </div>


                            <div class="wishlist-container mt-4 mb-0" style="display: flex; justify-content: flex-end; width: 664px;">
                                <button style="height: 25px; width: 100px" type="submit" class="clear shadow" onclick="clearPhoto()">CLEAR</button>
                                <button style="height: 25px; width: 100px" type="submit" class="add shadow"  id="saveButton">SAVE</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="../node_modules/jquery/dist/jquery.min.js"></script>
<script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../node_modules/swiper/swiper-bundle.min.js"></script>
<script src="../node_modules/sweetalert2/dist/sweetalert2.all.js"></script>
<script src='../js/logout_script.js'></script>
<script src="../js/navbar_select.js"></script>
<script src="../js/student.js"></script>
<script src="../js/add_student_clear.js"></script>




//search student
<script>
    $(document).ready(function() {
        // Event listener for the search input
        $('#studentSearch').on('input', function() {
            var searchTerm = $(this).val().toLowerCase();

            // Loop through each row in the table body
            $('tbody tr').each(function() {
                var rowText = $(this).text().toLowerCase();

                // Check if the row contains the search term
                if (rowText.includes(searchTerm)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>



</script>
</script>

<script>
    $(document).ready(function() {
        // Attach a click event to the "ADD STUDENT" button
        $("#addStudentBtn").click(function() {
            // Show the student modal
            $("#studentModal").modal("show");
        });

        // Handle the file input change event
        $("#addStudentinput-file").change(function() {
            readURL(this);
        });

        // Handle click event on the Add Image icon
        $(".AddImageContainer i").click(function() {
            $("#addStudentinput-file").click();
        });
    });

    // Function to display the selected image in the modal
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#Profile-Pic').attr('src', e.target.result);
                $(".AddImageContainer i").hide();
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    // Function to change the displayed photo
    function changePhoto() {
        $("#addStudentinput-file").click();
    }

    // Function to clear the displayed photo
    function clearPhoto() {
        $('#Profile-Pic').attr('src', '');
        $(".AddImageContainer i").show();
    }

</script>
<script>
    $(document).ready(function() {
        $('.editStudentProfile').click(function(e) {
            e.preventDefault();

            // Get the user_id from the data attribute
            var userId = $(this).data('user-id');

            // Make an AJAX request to fetch Student data
            $.ajax({
                url: '../operations/fetch_student.php', // Replace with your backend endpoint
                type: 'POST',
                data: { userId: userId },
                dataType: 'json',
                success: function(response) {
                    // Log the response to inspect the structure
                    console.log(response);

                    // Handle the response and populate your modal with data
                    populateModal(response);
                },
                error: function() {
                    // Handle errors
                    console.error('Error fetching Student data.');
                }
            });
        });

        function populateModal(data) {
            // Log the data to inspect the structure
            console.log(data);

            // Populate the modal fields with data received from the server
            $('#editStudentFname').val(data[0].fname);
            $('#editStudentLname').val(data[0].lname);
            $('#editStudentInitial').val(data[0].initial);
            $('#editStudentID').val(data[0].user_id);
            $('#editStudentEmail').val(data[0].email);
            $('#editStudentNumber').val(data[0].phone_number);
            $('#editStudentAddress').val(data[0].address);
            $('#editStudentYear').val(data[0].year);
            $('#editStudentCourse').val(data[0].course);
            $('#editStudentMajor').val(data[0].major);
            $('#editpsw').val(data[0].password);
            $('#editStudentUsername').val(data[0].username);
            $('#editStudentUsepEmail').val(data[0].email);

            var imagePath = '../img/' + data[0].img;
            $('#ProfilePic').attr('src', imagePath);

            // Show the modal
            $('#editStudentModal').modal('show');
        }
    });


    // Function to handle adding a student
    function addStudent() {
        // Add your logic here
        $("#editStudentModal").modal("hide");
    }

    // Function to clear the displayed photo
    function clearPhoto() {
        $('#ProfilePic').attr('src', '../img/me_sample_profile.jpg');
        $(".AddImageCon i").show();
    }

    // Function to update the profile picture
    function updateProfilePicture(event) {
        const input = event.target;
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const profilePic = document.getElementById('ProfilePic');
                profilePic.src = e.target.result;

                // Hide the icon when a new image is selected
                $(".AddImageCon i").hide();
            };
            reader.readAsDataURL(input.files[0]);
        }
    }


</script>
<script>
    // The deleteAllBook button
    const deleteAllButton = document.getElementById('deleteAllUser');
    if (deleteAllButton) {
        deleteAllButton.addEventListener('click', function() {
            showDeleteConfirmation(1); // Pass a unique identifier
        });
    }

    function showDeleteConfirmation(id) {
        Swal.fire({
            title: 'ARE YOU SURE?',
            text: 'Do you really want to delete this account? Process cannot be undone.',
            icon: 'error', // Set the icon as 'error'
            iconHtml: '<div style="background-color: white; display: inline-block; padding: 20px; border-radius: 5px;"><i class="bi bi-trash3-fill" style="font-size: 50px; color: #711717;"></i></div>',
            showCancelButton: true,
            confirmButtonColor: '#711717',
            confirmButtonText: 'DELETE',
            cancelButtonText: 'CANCEL',
            cancelButtonColor: '#e3e6e9',
            customClass: {
                popup: 'my-swal-popup',
                content: 'my-swal-content',
                title: 'swal-title',
                cancelButton: 'my-cancel-button',
                confirmButton: 'my-confirm-button'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'DELETED!',
                    text: 'SUCCESSFULLY DELETED!',
                    icon: 'success',
                    customClass: {
                        popup: 'my-swal-popup',
                        title: 'swal-title',
                        content: 'my-swal-content',
                        confirmButton: 'my-confirm-button'
                    }
                });
            }
        });
    }
</script>
<script>

    // The SUSPENDAllBook button
    const suspendAllButton = document.getElementById('suspendAll');
    if (suspendAllButton) {
        suspendAllButton.addEventListener('click', function() {
            showSuspendConfirmation(1); // Pass a unique identifier
        });
    }

    function showSuspendConfirmation(id) {
        Swal.fire({
            title: 'ARE YOU SURE?',
            text: 'Do you really want to suspend this account?',
            icon: 'error', // Set the icon as 'error'
            iconHtml: '<div style="background-color: white; display: inline-block; padding: 20px; border-radius: 5px;"><i class="bi bi-exclamation-triangle" style="font-size: 50px; color: #711717; "></i></div>',
            showCancelButton: true,
            confirmButtonColor: '#711717',
            confirmButtonText: 'SUSPEND',
            cancelButtonText: 'CANCEL',
            cancelButtonColor: '#e3e6e9',
            customClass: {
                popup: 'my-swal-popup',
                content: 'my-swal-content',
                title: 'swal-title',
                cancelButton: 'my-cancel-button',
                confirmButton: 'my-confirm-button'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'SUSPENDED!',
                    text: 'SUCCESSFULLY SUSPENDED!',
                    icon: 'success',
                    customClass: {
                        popup: 'my-swal-popup',
                        title: 'swal-title',
                        content: 'my-swal-content',
                        confirmButton: 'my-confirm-button'
                    }
                });
            }
        });
    }
</script>
<script src="../js/add_student.js"></script>
<script src="../js/delete_student.js"></script>
<script src="../js/suspend_student.js"></script>
<script src="../js/update_student.js"></script>





</body>
</html>
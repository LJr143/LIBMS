<?php
session_start();
require_once '../db_config/config.php';
include '../includes/authentication.php';
include '../includes/fetch_user_data.php';
include '../includes/fetch_books_data.php';
include '../includes/fetch_staff_data.php';
include '../includes/fetch_superadmin_data.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$loggedAdmin = '';

$database = new Database();
$userAuth = new UserAuthentication($database);
$bookData = new BookData($database);
$superAdminData = new SuperAdminData($database);
$staffData = new StaffData($database);
$staffList = $staffData->getAllStaff();


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
    $adminID = $superAdminData->getSuperadminIdByUsername($adminUsername);
    $_SESSION['loggedAdminID'] = $adminID;
    if (!empty($adminID)) {
        $admin = $superAdminData->getSuperadminById($adminID);

        if (!empty($admin)) {
            $loggedAdmin = $admin[0];
            $userId = $loggedAdmin['admin_id'];
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
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/superadmin_staff.css">
    <link rel="stylesheet" href="../css/logout.css">

</head>

<body style="">
        <?php include 'header.php' ?>
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
                        <li class="active"><img class="custom_menu_icon" src="../icons/staff_icon.png" alt=""><span><a href="staff.php">Staff</a></span></li>
                        <li><img class="custom_menu_icon" src="../icons/reports_icon.png" alt=""><span><a href="report.php">Reports</a></span></li>
                        <li><img class="custom_menu_icon" src="../icons/logs_icon.png" alt=""><span><a href="logs.php">Logs</a></span></li>
                        <li><img class="custom_menu_icon" src="../icons/feedback_icon_dashboard.png" alt=""><span><a href="feedback.php">Feedback</a></span></li>
                        <li>
                            <i class="bi bi-bookmark-star custom_menu_icon" style="font-size: 20px; color:#fff"></i>
                            <span><a href="book_review.php">Book Review</a></span>
                        </li>
                    </ul>
                </div>

            </div>
            <div class="col" style=" width: 100%; height: 100vh; ">
                <div style="background-color: white; width: 95%; height: 45px; margin: 15px 15px 15px 30px; border-radius: 5px;display: flex; box-shadow: 0px 4px 8px rgba(0,0,0,0.27); align-content: center; align-items: center">
                    <div style="width: 90%">
                        <p style="font-size: 10px; font-weight: 700; margin: 14px">HOME | STAFF</p>
                    </div>
                    <div class=" d-flex justify-content-end align-items-center" style="height: 50px; width: 10%; margin-right: 20px ">
                        <div class="dropdown" style=" margin-right: 0px; position: absolute">
                            <button style="background: none; border: none;" class=" dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="../img/<?= $loggedAdmin['img'] ?>" alt="" width="35px" style="border-radius: 60px; border: 1px solid #4d0202">
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark dropdown_menu_setting aria-labelledby=" dropdownMenuButton2">
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
                    <div style="background-color: white; width: 95%; height: 55px; margin: 15px; border-radius: 5px;display: flex; box-shadow: 0px 4px 8px rgba(0,0,0,0.27); align-items: center">
                        <div class="col col-md-10">
                            <select id="searchBySelect" name="searchBySelect" style="font-weight: bold; border: 2px solid black; width: 200px; padding: 0px 10px; margin-left: 10px; border-radius: 5px;  height: 30px; font-size: 12px;">
                                <option value="">Search By</option>
                                <option value="Active">Active</option>
                                <option value="Suspended">Suspended</option>
                            </select>
                        </div>
                        <div class="col col-md-2">
                            <button id="printButton" style="width: 30px; border: none; background: transparent;"><img style="width: 25px; margin-right: 20px;" src="../icons/download_icon.png" alt=""></button>
                            <button id="addStaffBtn" style="font-size: 12px; width: 150px; height: 30px; border-radius: 5px; background-color: rgb(128,0,0); color: white; border: none">ADD STAFF</button>
                        </div>
                    </div>
                </div>
                <div style="display: flex; justify-content: center; ">
                    <div style="font-size: 12px; background-color: white; width: 95%; max-height: 550px; box-shadow: 0px 4px 8px rgba(0,0,0,0.27);">
                        <div style="width: 100%; display: flex; justify-content: center; border-radius: 5px">
                            <table style="width: 98%; font-size: 12px;" class=" table table-bordered text-center" id="staffTable">
                                <thead>
                                    <tr style="background-color: #440404; color: white">
                                        <th style="max-width: 80px; min-width: 80px;"><input type="checkbox" id="selectAllCheckbox" style="position: absolute; margin: 2px 0px 0px -20px;">Select All</th>
                                        <th style="max-width: 150px; min-width: 150px;"></th>
                                        <th style="max-width: 150px; min-width: 150px;">Employee</th>
                                        <th style="max-width: 100px; min-width: 100px;">Role</th>
                                        <th style="max-width: 150px; min-width: 150px;">Status</th>
                                        <th style="max-width: 150px; min-width: 150px;">Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($staffList as $staff) { ?>
                                        <tr class="employee-info" style="height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25);">
                                            <td><input type="checkbox"></td>
                                            <td><img class="custom_img" src="../img/<?= $staff['img']; ?>" alt=""></td>
                                            <td class="employee-name"><?php echo ucwords( $staff  ['fname'] )?>&nbsp;<?php echo ucwords( $staff['lname']); ?></td>
                                            <td class="employee-role"><?php echo $staff['admin_role'] ?></td>
                                            <td class="<?php echo ($staff['status'] == 'Active') ? 'active-status' : 'inactive-status'; ?> employee-status">
                                                <?php echo $staff['status']; ?>
                                            </td>
                                            <td style="padding: 1px;">
                                                <div class="btn-group" role="group">
                                                    <a href="#" class="btn custom-btn editStaffProfile" data-admin-id="<?php echo $staff['admin_id']; ?>">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <a href="#" class="btn custom-btn deleteStudent" data-admin-id="<?php echo $staff['admin_id']; ?>" data-staff-name="<?php echo $staff['fname'] . " " . $staff['lname']; ?>">
                                                        <i class="bi bi-trash"></i>
                                                    </a>

                                                    <?php if ($staff['status'] == 'Active') { ?>
                                                        <!-- Show "Suspend" button when status is Active -->
                                                        <a href="#" class="btn custom-btn suspend_staff" data-admin-id="<?php echo $staff['id']; ?>" data-staff-name="<?php echo $staff['fname'] . " " . $staff['lname']; ?>">
                                                            <i class="bi bi-exclamation-octagon"></i>
                                                        </a>
                                                    <?php } else { ?>
                                                        <!-- Show "Activate" button when status is Suspended -->
                                                        <a href="#" class="btn custom-btn activate_staff" data-admin-id="<?php echo $staff['id']; ?>" data-staff-name="<?php echo $staff['fname'] . " " . $staff['lname']; ?>">
                                                            <i class="bi bi-check"></i>
                                                        </a>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>
                        <div style="width: 100%; display: flex; justify-content: center; margin: 20px 0px">
                            <div class="row" style="width: 98%;">
                                <div class="col col-md-8" style="">

                                </div>
                                <div class="col col-md-4" style="display: flex; padding: 0; margin: 0">
                                    <button style="margin-left: 160px" id="deleteAllStaff" class="operation_all_btn" data-admin-id="<?= $userId?>">Delete All</button>
                                    <button style="margin-left: 10px;" id="suspendAll" class="operation_all_btn" data-admin-id="<?= $userId?>">Suspend All</button>
                                </div>
                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>

    <!-- Add Staff Modal-->
    <div class="modal fade" id="staffModal" tabindex="-1" role="dialog" aria-labelledby="staffModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document" style="max-width: 800px;">
            <div class="modal-content">
                <div class="modal-header" style="height: 15px;">

                    <p class="modal-title" id="borrowModalLabel " style="font-size: 12px; color: #800000; font-weight: 600;">
                        <i class="bi bi-pencil-square ml-3 m-3" style="font-size: 16px; color: #800000;"></i>ADD STAFF
                    </p>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="background-color: transparent; border:none;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid " style="padding-left: 40px ; padding-right: 40px">
                        <div class="row">

                            <div style="width: 100px; height:220px;">
                                <div class="col-md-2" style="margin-bottom: 0px; margin-left: 8px;">
                                    <div class="AddImageContainer" style="margin-top: 60px; display: flex; justify-content: center; border: 1px solid maroon; width: 100px; height: 100px">
                                        <i class="bi bi-plus-circle" title="Add Image" style="color: grey; "></i>
                                        <img src="" width="110" height="120" id="Profile-Pic" style="margin-top: -10px;">

                                    </div>
                                        <input type="file" accept="image/jpeg, image/png, image/jpg" id="addStaffinput-file" name="profileAdd" class="visually-hidden mb-0">
                                </div>
                            </div>


                            <form id="addStaffForm" class="row" style="margin-left: 30px; width: 80%; height: 65%; ">
                                <div class="col-md-5 firstname">
                                    <label for="addStaffFname" class="form-label mb-0" style="font-size: 12px;">FIRST NAME</label>
                                    <input type="text" class="form-control" placeholder="Juan" id="addStaffFname" name="addStaffFname" style="font-size: 10px; text-transform: capitalize !important;" required>
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid first name!
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <label for="addStaffLname" class="form-label mb-0" style="font-size: 12px;">LAST NAME</label>
                                    <input type="text" class="form-control" placeholder="Dela Cruz" id="addStaffLname" name="addStaffLname" style="font-size: 10px; text-transform: capitalize !important;" required>
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid last name!
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <label for="addStaffInitial" class="form-label mb-0" style="font-size: 12px;">M.I.</label>
                                    <input type="text" class="form-control mb-0" placeholder="I" id="addStaffInitial" pattern="[A-Za-z]{1}" name="addStaffInitial" style="font-size: 10px; text-transform: capitalize !important;" >
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid M.I.!
                                    </div>
                                </div>


                                <div class="col-md-3 mt-2">
                                    <label for="addStaffID" class="form-label mb-0" style="font-size: 12px;">STAFF ID</label>
                                    <input type="text" class="form-control" id="addStaffID" name="addStaffID" placeholder="2021-00565" pattern="20[0-9]{2}-[0-9]{5}" style="font-size: 10px;" required>
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid student ID!
                                    </div>
                                </div>

                                <div class="col-md-5 mt-2">
                                    <label for="addStaffPemail" class="form-label mb-0" style="font-size: 12px;">PERSONAL EMAIL ADDRESS</label>
                                    <div class="input-group has-validation">
                                        <input type="email" class="form-control " id="addStaffPemail" name="addStaffPemail" aria-describedby="inputGroupPrepend" placeholder="juan001@gmail.com" style="font-size: 10px;" required>
                                        <div class="invalid-feedback" style="font-size: 8px">
                                            Not a valid email address!
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                    <label for="addStaffPnumber" class="form-label mb-0" style="font-size: 12px;">PHONE NUMBER</label>
                                    <input type="text" class="form-control" id="addStaffPnumber" name="addStaffPnumber" pattern="[0-9]{11}" placeholder="091234567890" style="font-size: 10px;" required>
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid phone number with 11 digits!
                                    </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                    <label for="addStaffTnumber" class="form-label mb-0" style="font-size: 12px;">TELEPHONE NUMBER</label>
                                    <input type="text" class="form-control" id="addStaffTnumber" name="addStaffTnumber" placeholder="291-3288" pattern="[0-9]{3}-[0-9]{4}" style="font-size: 10px;" required>
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid tel number with 10 digits!
                                    </div>
                                </div>


                                <div class="col-md-5 mt-2">
                                    <label for="addStaffAddress" class="form-label mb-0" style="font-size: 12px; ">ADDRESS</label>
                                    <input type="text" class="form-control" id="addStaffAddress" name="addStaffAddress" style="font-size: 10px; text-transform: capitalize !important;" placeholder="Purok, Baranggay, City/Municipality, Province" required>
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid address!
                                    </div>
                                </div>

                                <div class="col-md-3 mt-2">
                                    <label for="addStaffRole" class="form-label mb-0" style="font-size: 12px; ">ROLE</label>
                                    <select class="form-select" id="addStaffRole" style="font-size: 10px; " required>
                                        <option value="" disabled selected>Select Role</option>
                                        <option value="Staff">Staff</option>

                                    </select>
                                </div>


                                <div class="col col-md-5 mt-3">
                                    <label for="addStaffOemail" class="form-label mb-0" style="font-size: 12px;">EMAIL ADDRESS</label>
                                    <div class="input-group has-validation">
                                        <input type="email" class="form-control " id="addStaffOemail" name="addStaffOemail" aria-describedby="inputGroupPrepend" placeholder="juan001@usep.edu.ph" style="font-size: 10px;" required>
                                        <div class="invalid-feedback" style="font-size: 8px;">
                                            Not a valid email address!
                                        </div>
                                    </div>
                                </div>

                                <div class=" col col-md-3 mt-3">
                                    <label for="addStaffUsername" class="form-label mb-0" style="font-size: 12px;">USERNAME</label>
                                    <div class="input-group has-validation">
                                        <input type="text" class="form-control" id="addStaffUsername" name="addUsername" aria-describedby="inputGroupPrepend" placeholder="juandlz" style="font-size: 10px;" required minlength="6">
                                        <div class="invalid-feedback" style="font-size: 8px">
                                            Not valid, at least 6 characters!
                                        </div>
                                    </div>
                                </div>

                                <div class="col col-md-4 mt-3">
                                    <label for="psw" class="form-label mb-0" style="font-size: 12px;">PASSWORD</label>
                                    <div class="input-group has-validation">
                                        <input type="password" class="form-control" placeholder="Password_123" id="psw" name="psw" style="font-size: 10px;" aria-describedby="inputGroupPrepend"
                                               pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@_]).{8,}" title="Must contain at least one number, one uppercase and lowercase letter,
                                               one symbol, and at least 8 or more characters" required>
                                        <div class="invalid-feedback" id="passwordRequirements" style="font-size: 8px; display: none;">
                                            Not a valid password!
                                        </div>
                                    </div>
                                </div>


                                <div class=" wishlist-container  mt-4 mb-0 " style=" display: flex; justify-content: flex-end; width: 664px; ">
                                    <button style="height: 25px; width: 100px" type="button" class="clear shadow " onclick="clearPhoto()">CLEAR</button>
                                    <button style="height: 25px; width: 100px" type="submit" class="add shadow" onclick="addStaff()">ADD</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Staff Modal -->
    <div class="modal fade" id="editStaffModal" tabindex="-1" role="dialog" aria-labelledby="editStaffModalLabel" aria-hidden="true">
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
                                <label for="EditprofilePictureInput" class="AddImageCon" style="display: flex; justify-content: center; align-items: center; width: 100%; height: 100%;">

                                    <img src="" width="220px" height="100px" id="EditProfilePic" style="display: block;">
                                </label>
                                    <input type="file" accept="image/jpeg, image/png, image/jpg" id="EditprofilePictureInput" class="visually-hidden mb-0" accept="image/*" onchange="updateProfilePicture(event)">
                            </div>


                            <form id="editStaffForm" class="row" style="margin-left: 30px; width: 80%; height: 65%; ">
                                <div class="col-md-5 firstname">
                                    <label for="EditStaffFname" class="form-label mb-0" style="font-size: 12px;">FIRST NAME</label>
                                    <input type="text" class="form-control" placeholder="Juan" id="EditStaffFname" name="EditStaffFname" pattern="^[\s\S]*$" style="font-size: 10px; text-transform: capitalize !important;" required>
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid first name!
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <label for="EditStaffLname" class="form-label mb-0" style="font-size: 12px;">LAST NAME</label>
                                    <input type="text" class="form-control" placeholder="Dela Cruz" id="EditStaffLname" name="EditStaffLname" style="font-size: 10px; text-transform: capitalize !important;" required>
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid last name!
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="EditStaffInitial" class="form-label mb-0" style="font-size: 12px;">M.I.</label>
                                    <input type="text" class="form-control mb-0" placeholder="I" id="EditStaffInitial" name="EditStaffInitial" style="font-size: 10px; text-transform: capitalize !important;" >
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid M.I.!
                                    </div>
                                </div>

                                <div class="col-md-3 mt-2">
                                    <label for="EditStaffID" class="form-label mb-0" style="font-size: 12px;">STAFF ID</label>
                                    <input type="text" class="form-control" id="EditStaffID" name="EditStaffID" placeholder="2021-00565" style="font-size: 10px;" required>
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid student ID!
                                    </div>
                                </div>

                                <div class="col-md-5 mt-2">
                                    <label for="EditStaffPemail" class="form-label mb-0" style="font-size: 12px;">PERSONAL EMAIL ADDRESS</label>
                                    <div class="input-group has-validation">
                                        <input type="email" class="form-control " id="EditStaffPemail" name="EditStaffPemail" aria-describedby="inputGroupPrepend" placeholder="juancruz@gmail.com" style="font-size: 10px;" required>
                                        <div class="invalid-feedback" style="font-size: 8px">
                                            Not a valid email address!
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                    <label for="EditStaffPnumber" class="form-label mb-0" style="font-size: 12px;">PHONE NUMBER</label>
                                    <input type="text" class="form-control" id="EditStaffPnumber" name="EditStaffPnumber" placeholder="091234567890"  style="font-size: 10px;" required>
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid phone number with 11 digits!
                                    </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                    <label for="EditStaffTnumber" class="form-label mb-0" style="font-size: 12px;">TELEPHONE NUMBER</label>
                                    <input type="text" class="form-control" id="EditStaffTnumber" name="EditStaffTnumber" placeholder="291-3281-919" style="font-size: 10px;" required>
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid tel number with 10 digits!
                                    </div>
                                </div>


                                <div class="col-md-5 mt-2">
                                    <label for="EditStaffAddress" class="form-label mb-0" style="font-size: 12px; ">ADDRESS</label>
                                    <input type="text" class="form-control" id="EditStaffAddress" name="EditStaffAddress" style="font-size: 10px; text-transform: capitalize !important;" placeholder="Purok, Baranggay, City/Municipality, Province">
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid address!
                                    </div>
                                </div>
                                <div class="col-md-3 mt-2">
                                    <label for="EditStaffRole" class="form-label mb-0" style="font-size: 12px; ">ROLE</label>
                                    <select class="form-select" id="EditStaffRole" style="font-size: 10px; " required>
                                        <option value="" disabled selected>Select Role</option>
                                        <option value="Staff">Staff</option>
                                    </select>
                                </div>


                                <div class="col col-md-5 mt-3">
                                    <label for="EditStaffOemail" class="form-label mb-0" style="font-size: 12px;">EMAIL ADDRESS</label>
                                    <div class="input-group has-validation">
                                        <input type="email" class="form-control " id="EditStaffOemail" name="EditStaffOemail" aria-describedby="inputGroupPrepend" placeholder="juan@usep.edu.ph" style="font-size: 10px;" readonly>
                                        <div class="invalid-feedback" style="font-size: 8px;">
                                            Not a valid email address!
                                        </div>
                                    </div>
                                </div>

                                <div class=" col col-md-3 mt-3">
                                    <label for="EditStaffUsername" class="form-label mb-0" style="font-size: 12px;">USERNAME</label>
                                    <div class="input-group has-validation">
                                        <input type="text" class="form-control" id="EditStaffUsername" name="EditUsername" aria-describedby="inputGroupPrepend" pattern="^.{6,}$" placeholder="juandlz" style="font-size: 10px;" readonly>
                                        <div class="invalid-feedback" style="font-size: 8px">
                                            Not a valid username!
                                        </div>
                                    </div>
                                </div>

                                <div class="col col-md-4 mt-3">
                                    <label for="Editpsw" class="form-label mb-0" style="font-size: 12px;">PASSWORD</label>
                                    <div class="input-group has-validation">
                                        <input type="password" class="form-control" placeholder="Password_456" id="Editpsw" name="Editpsw" style="font-size: 10px;" aria-describedby="inputGroupPrepend"
                                               pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" readonly>
                                        <div class="invalid-feedback" id="passwordRequirements" style="font-size: 8px; display: none;">
                                            Not a valid password!
                                        </div>
                                    </div>
                                </div>


                                <div class=" wishlist-container  mt-4 mb-0 " style=" display: flex; justify-content: flex-end; width: 664px; ">
                                    <button style="height: 25px; width: 100px" type="button" class="clear shadow " onclick="clearPhoto()">CLEAR</button>
                                    <button style="height: 25px; width: 100px" type="submit" class="add shadow" id="saveButton">SAVE</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../node_modules/swiper/swiper-bundle.min.js"></script>
    <script src="../node_modules/sweetalert2/dist/sweetalert2.all.js"></script>

        <script>
            $(document).ready(function () {
                $('#searchBySelect').on('change', function () {
                    var selectedStatus = $(this).val();

                    $('.employee-info').show();

                    if (selectedStatus) {
                        $('.employee-status:not(:contains("' + selectedStatus + '"))').parent().hide();
                    }
                });
            });
        </script>
        <script>
        const listItems = document.querySelectorAll('li');
        listItems.forEach((listItem) => {
            listItem.addEventListener('click', () => {
                listItems.forEach((item) => {
                    item.classList.remove('active');
                });

                listItem.classList.add('active');
            });
        });
        // Get references to the "Select All" checkbox and all the other checkboxes in the table
        const selectAllCheckbox = document.getElementById('selectAllCheckbox');
        const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]');

        // Add an event listener to the "Select All" checkbox
        selectAllCheckbox.addEventListener('change', () => {
            checkboxes.forEach((checkbox) => {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });
    </script>
        <script>
        $(document).ready(function() {

            // Handle the file input change event
            $("#addStaffinput-file").change(function() {
                readURL(this);
            });

            // Handle click event on the Add Image icon
            $(".AddImageContainer i").click(function() {
                $("#addStaffinput-file").click();
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
            $("#addStaffinput-file").click();
        }

        // Function to clear the displayed photo
        function clearPhoto() {
            $('#Profile-Pic').attr('src', '');
            $(".AddImageContainer i").show();
        }

        // Function to handle adding a staff (you can replace this with your actual logic)
        // function addStaff() {
        //     // Add your logic here
        //     $("#staffModal").modal("hide");
        // }
    </script>
        <script>
        $(document).ready(function() {
            $('.editStaffProfile').click(function(e) {
                e.preventDefault();

                var adminId = $(this).data('admin-id');

                $.ajax({
                    url: '../operations/fetch_staff.php',
                    type: 'POST',
                    data: {
                        adminId: adminId
                    },
                    dataType: 'json',
                    success: function(response) {
                        populateModal(response);
                    },
                    error: function() {
                        console.error('Error fetching staff data.');
                    }
                });
            });

            function populateModal(data) {
                // Populate the modal fields with data received from the server
                $('#EditStaffFname').val(data[0].fname);
                $('#EditStaffLname').val(data[0].lname);
                $('#EditStaffInitial').val(data[0].initial);
                $('#EditStaffID').val(data[0].admin_id);
                $('#EditStaffPemail').val(data[0].personal_email);
                $('#EditStaffPnumber').val(data[0].phone_number);
                $('#EditStaffTnumber').val(data[0].tele_number);
                $('#EditStaffAddress').val(data[0].address);
                $('#EditStaffRole').val(data[0].admin_role);
                $('#Editpsw').val(data[0].password);
                $('#EditStaffUsername').val(data[0].username);
                $('#EditStaffOemail').val(data[0].email);

                var imagePath = '../img/' + data[0].img;
                $('#EditProfilePic').attr('src', imagePath);

                if (data[0].img) {
                    var imagePath = '../img/' + data[0].img;
                    $('#EditProfilePic').attr('src', imagePath);
                } else {
                    // Display the default 'user.png' if there is no photo
                    $('#EditProfilePic').attr('src', '../icons/user.png');
                }
                // Show the modal
                $('#editStaffModal').modal('show');
            }
        });


        // Function to handle adding a student
        function addStudent() {
            // Add your logic here
            $("#editStudentModal").modal("hide");
        }

        // Function to clear the displayed photo
        function clearPhoto() {
            $('#EditProfilePic').attr('src', '../icons/user.png');
            $(".AddImageCon i").show();
        }

        // Function to update the profile picture
        function updateProfilePicture(event) {
            const input = event.target;
            const profilePic = document.getElementById('EditProfilePic');
            const icon = $(".AddImageCon i");

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    profilePic.src = e.target.result;

                    // Hide the icon when a new image is selected
                    icon.hide();
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                // If no new file is selected, use the default 'user.png'
                profilePic.src = '../img/user.png';

                // Hide the icon when no new image is selected
                icon.hide();
            }
        }
    </script>
        <script>
        $(document).ready(function () {

            // Hide elements with class 'no-print'
            $('.no-print').hide();

            // Add a click event for the print button
            $("#printButton").click(function () {
                printTable();
            });

            // Function to print the table
            function printTable() {
                // Create a new window
                var printWindow = window.open('', '_blank');

                // Write the HTML content of the table to the new window
                printWindow.document.write('<html><head><title>University Library Staff Report</title>');

                // Add University logo and header
                printWindow.document.write('<div style="text-align: center; font-size: 12px;">' +
                    '<img id="logo" style="width: 100px;" src="../icons/usep-logo.png" alt="">' +
                    '</br>' +
                    '<h1>University of Southeastern Philippines Tagum-Mabini Campus</h1></div>');

                // Add custom print styles
                printWindow.document.write('<style>' +
                    'body { font-size: 10pt; margin: 0; }' +
                    '#logo { width: 50px; height: auto; margin-right: 10px; }' +
                    'h1 { text-align: center; font-size: 14px; margin-bottom: 20px; }' +
                    'table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }' +
                    'th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }' +
                    '.active-status { color: green; }' +
                    '.inactive-status { color: red; }' +
                    '@media print {' +
                    '   .no-print { display: none; }' +
                    '   th, td { padding: 6px; }' +
                    '}' +
                    '</style>');

                printWindow.document.write('</head><body>');
                printWindow.document.write('<table style="width:100%; border-collapse: collapse;">');
                printWindow.document.write('<tr> <th style="text-align: center">NAME</th>' +
                    '<th style="text-align: center">STATUS</th>' +
                    '<th style="text-align: center">ROLE</th>');

                var employeeElements = $(".employee-info");
                employeeElements.each(function () {

                    // Extract employee information from the selected element
                    var employeeName = $(this).find('.employee-name').text();
                    var employeeStatus = $(this).find('.employee-status').text();
                    var employeeRole = $(this).find('.employee-role').text();

                    // Add rows to the table for name, status, and role
                    printWindow.document.write('<tr>');
                    printWindow.document.write('<td style="text-align: center;">' + employeeName + '</td>');
                    printWindow.document.write('<td style="text-align: center;">' + employeeStatus + '</td>');
                    printWindow.document.write('<td style="text-align: center;">' + employeeRole + '</td>');
                    printWindow.document.write('</tr>');



                });
                printWindow.document.write('</table>');


                // Close the document of the new window
                printWindow.document.write('</body><footer style="margin-top: 50px;">University of Southeastern Philippines Tagum-Mabini Campus Electronic Generated Report</footer></html>');
                printWindow.document.close();

                // Wait for the image to load before triggering the print
                var logoImage = printWindow.document.getElementById('logo');
                if (logoImage.complete) {
                    // If the image is already loaded, trigger the print
                    printWindow.print();
                } else {
                    // If the image is still loading, wait for the 'load' event
                    logoImage.onload = function () {
                        printWindow.print();
                    };
                }
            }
        });

    </script>

    <script src="../js/add_staff.js"></script>
    <script src="../js/update_staff.js"></script>
    <script src="../js/delete_staff.js"></script>
    <script src="../js/suspend_staff.js"></script>
    <script src="../js/logout_script.js"></script>

</body>

</html>
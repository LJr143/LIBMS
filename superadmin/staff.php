<?php
session_start();
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
include 'C:\wamp64\www\LIBMS\operations\authentication.php';
include 'C:\wamp64\www\LIBMS\includes\fetch_user_data.php';
include 'C:\wamp64\www\LIBMS\includes\fetch_books_data.php';
include 'C:\wamp64\www\LIBMS\includes\fetch_staff_data.php';
include 'C:\wamp64\www\LIBMS\includes\fetch_superadmin_data.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$loggedAdmin = '';

$database = new Database();
$userAuth = new UserAuthentication($database);
$bookData = new BookData($database);
$superAdminData = new SuperAdminData($database);

if($userAuth->isAuthenticated()) {
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
    <link rel="stylesheet" href="../css/superadmin_staff.css">
</head>

<body style="">
    <div>
        <?php include 'header.php'?>
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
                    </ul>
                </div>

            </div>
            <div class="col" style=" width: 100%; height: 100vh; ">
                <div style="background-color: white; width: 95%; height: 45px; margin: 15px; border-radius: 5px;display: flex; box-shadow: 0px 4px 8px rgba(0,0,0,0.27); align-content: center; align-items: center">
                    <div style="width: 90%">
                        <p style="font-size: 10px; font-weight: 700; margin: 14px">HOME | STAFF</p>
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

                                <label for="logout"><img src="../icons/plug.png" style="width: 20px; " alt=""></label>
                                <input style="font-size: 12px; color: white; background: none; border: none;" name="logout" type="submit" value="Logout">
                            </form>
                            </ul>
                        </div>
                    </div>
                </div>

                <div style="display: flex; justify-content: center; ">
                    <div style="background-color: white; width: 95%; height: 55px; margin: 15px; border-radius: 5px;display: flex; box-shadow: 0px 4px 8px rgba(0,0,0,0.27); align-items: center">
                        <div class="col col-md-10">
                            <select name="" id="" style="width: 150px; padding: 0px 10px; margin-left: 10px; border-radius: 5px;  height: 30px; font-size: 12px;">
                                <option value="">Search By</option>
                                <option value="">Part Time</option>
                                <option value="">Full Time</option>
                                <option value="">Staff</option>
                                <option value="">Faculty</option>

                            </select>
                        </div>
                        <div class="col col-md-2">
                            <button style="width: 30px; border: none; background: transparent;"><img style="width: 25px; margin-right: 20px;" src="../icons/download_icon.png" alt=""></button>
                            <button id="addStaffBtn" style="font-size: 12px; width: 150px; height: 30px; border-radius: 5px; background-color: rgb(128,0,0); color: white; border: none">ADD STAFF</button>
                        </div>
                    </div>
                </div>

                <div style="display: flex; justify-content: center; ">
                    <div style="font-size: 12px; background-color: white; width: 95%; max-height: 550px; box-shadow: 0px 4px 8px rgba(0,0,0,0.27);">
                        <div style="width: 100%; display: flex; justify-content: center; border-radius: 5px">
                            <table style="width: 98%; font-size: 12px;" class=" table text-center">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="selectAllCheckbox" style="position: absolute; margin: 2px 0px 0px -20px;">Select All</th>
                                        <th></th>
                                        <th>Employee</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Manage</th>

                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($staffList as $staff) { ?>
                                    <tr style="height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25);">
                                        <td><input type="checkbox"></td>
                                        <td></td>
                                        <td><?php echo $staff['fname'] ?>&nbsp;<?php echo $staff['lname']; ?></td>
                                        <td><?php echo $staff['admin_role'] ?></td>
                                        <td><?php echo $staff['status']; ?></td>
                                        <td style="padding: 1px;">
                                            <div class="btn-group" role="group">
                                                <a href="#" class="btn custom-btn editStudentProfile" data-admin-id="<?php echo $staff['admin_id']; ?>">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="#" class="btn custom-btn deleteStudent" data-admin-id="<?php echo $staff['admin_id']; ?>" data-staff-name="<?php echo $staff['fname'] . " " . $staff['lname']; ?>" >
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                                <a href="#" class="btn custom-btn" id="<?php echo $staff['admin_id']; ?>">
                                                    <i class="bi bi-exclamation-octagon"></i>
                                                </a>
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
                                    <img style="width: 180px" src="../icons/pagination_sample.png" alt="">
                                </div>
                                <div class="col col-md-4" style="display: flex; padding: 0; margin: 0">
                                    <button style="margin-left: 160px" id="deleteAllStaff" class="operation_all_btn">Delete All</button>
                                    <button style="margin-left: 10px;" id="suspendAll" class="operation_all_btn">Suspend All</button>
                                </div>
                            </div>

                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>

    <!--           Add Staff Modal-->
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

                            <!-- uploading image -->
                            <!-- add new photo -->
                            <div style="width: 100px; height:220px;">
                                <div class="col-md-2" style="margin-bottom: 0px; margin-left: 8px;">
                                    <div class="AddImageContainer" style="margin-top: 60px; display: flex; justify-content: center; border: 1px solid maroon; width: 100px; height: 100px">
                                        <i class="bi bi-plus-circle" title="Add Image" style="color: grey; "></i>
                                        <img src="" width="110" height="120" id="Profile-Pic" style="margin-top: -10px;">

                                    </div>
                                    <form action="" method="post" name="addStaffForm" enctype="multipart/form-data">
                                        <input type="file" accept="image/jpeg, image/png, image/jpg" id="addStaffinput-file" name="profileAdd" class="visually-hidden mb-0">
                                </div>
                            </div>



                            <div class="row" style="margin-left: 30px; width: 80%; height: 65%;">
                                <div class="col-md-5 firstname">
                                    <label for="validationCustom01" class="form-label mb-0" style="font-size: 12px;">FIRST NAME</label>
                                    <input type="text" class="form-control" placeholder="Juan" id="addStaffFname" name="addStaffFname" style="font-size: 10px; text-transform: capitalize !important;" required>

                                </div>
                                <div class="col-md-5">
                                    <label for="validationCustom02" class="form-label mb-0" style="font-size: 12px;">LAST NAME</label>
                                    <input type="text" class="form-control" placeholder="Dela Cruz" id="addStaffLname" name="addStaffLname"  style="font-size: 10px; text-transform: capitalize !important;" required>

                                </div>
                                <div class="col-md-2">
                                    <label for="validationCustom02" class="form-label mb-0" style="font-size: 12px;">M.I.</label>
                                    <input type="text" class="form-control mb-0" placeholder="I" id="addStaffInitial" name="addStaffInitial"  style="font-size: 10px; text-transform: capitalize !important;" required>
                                    <div class="invalid-feedback">
                                        Please type the middle initial .
                                    </div>
                                </div>

                                <div class="col-md-3 mt-2">
                                    <label for="validationCustom01" class="form-label mb-0" style="font-size: 12px;">STAFF ID</label>
                                    <input type="text" class="form-control" id="addStaffID" name="addStaffID"  placeholder="2021-00565" style="font-size: 10px;" required>

                                </div>

                                <div class="col-md-5 mt-2">
                                    <label for="validationCustomUsername" class="form-label mb-0" style="font-size: 12px;">EMAIL ADDRESS</label>
                                    <div class="input-group has-validation">
                                        <input type="text" class="form-control " id="addStaffPemail" name="addStaffPemail"  aria-describedby="inputGroupPrepend" placeholder="@usep.edu.ph" style="font-size: 10px;" required>

                                    </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                    <label for="validationCustom01" class="form-label mb-0" style="font-size: 12px;">PHONE NUMBER</label>
                                    <input type="tex" class="form-control" id="addStaffPnumber" name="addStaffPnumber"  placeholder="091234567890" style="font-size: 10px;" required>

                                </div>
                                <div class="col-md-4 mt-2">
                                    <label for="validationCustom01" class="form-label mb-0" style="font-size: 12px;">TELEPHONE NUMBER</label>
                                    <input type="text" class="form-control" id="addStaffTnumber" name="addStaffTnumber"  placeholder="291-3281-919" style="font-size: 10px;" required>

                                </div>




                                <div class="col-md-8 mt-2">
                                    <label for="validationCustom03" class="form-label mb-0" style="font-size: 12px; ">ADDRESS</label>
                                    <input type="text" class="form-control" id="addStaffAddress" name="addStaffAddress"  style="font-size: 10px; text-transform: capitalize !important;" placeholder="Purok, Baranggay, City/Municipality, Province">

                                </div>
                                <div class="col-md-4 mt-2">
                                    <label for="validationCustom03" class="form-label mb-0" style="font-size: 12px; ">ROLE</label>
                                    <input type="text" class="form-control" id="addStaffRole" name="addStaffRole" style="font-size: 10px; text-transform: capitalize !important;" placeholder="Librarian">

                                </div>

                            </div>
                            <div class="row">
                                <div class="col col-md-5 mt-3">
                                    <label for="validationCustomUsername" class="form-label mb-0" style="font-size: 12px;">EMAIL ADDRESS</label>
                                    <div class="input-group has-validation">
                                        <input type="text" class="form-control " id="addStaffOemail" name="addStaffOemail" aria-describedby="inputGroupPrepend" placeholder="@usep.edu.ph" style="font-size: 10px;" required>

                                    </div>
                                </div>

                                <div class=" col col-md-3 mt-3">
                                    <label for="validationCustomUsername" class="form-label mb-0" style="font-size: 12px;">USERNAME</label>
                                    <div class="input-group has-validation">
                                        <input type="text" class="form-control" id="addStaffUsername" name="addUsername" aria-describedby="inputGroupPrepend" placeholder="juandlz" style="font-size: 10px;" required>

                                    </div>
                                </div>

                                <div class="col col-md-4 mt-3">
                                    <label for="validationCustomUsername" class="form-label mb-0" style="font-size: 12px;">PASSWORD</label>
                                    <div class="input-group has-validation">
                                        <input type="password" class="form-control" placeholder="Password123." id="psw" name="psw" style="font-size: 10px;" aria-describedby="inputGroupPrepend" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>

                                    </div>
                                </div>

                        </div>

                        <div class=" wishlist-container  mt-4 mb-0 " style=" display: flex; justify-content: flex-end; width: 664px; ">
                            <button style="height: 25px; width: 100px; border-radius: 5px; border: 1px solid #800000; background: #FFFEFB; color: #740000; box-shadow: 0px 4px 7px 0px rgba(0, 0, 0, 0.25); margin-right: 10px; " type="button" class="clear shadow " onclick="clearPhoto()">CLEAR</button>
                            <button style="height: 25px; width: 100px; border-radius: 5px; border: 1px solid #800000; background: #740000; color: white ; box-shadow: 0px 4px 7px 0px rgba(0, 0, 0, 0.25);" type="button" class="add shadow" onclick="addStaff()">ADD</button>
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
                            <form  id="editStudentForm" class="row" method="post" enctype="multipart/form-data">

                                <!-- uploading image -->
                                <div style="width: 100px; height: 100px; overflow: hidden; border: 1px solid maroon; border-radius: 50%; margin: 0 auto; margin-top:40px;">
                                    <label for="profilePictureInput" class="AddImageCon" style="display: flex; justify-content: center; align-items: center; width: 100%; height: 100%;">

                                        <img src="" width="220px" height="100px" id="ProfilePic" style="display: block;">
                                    </label>
                                    <input type="file" accept="image/jpeg, image/png, image/jpg" id="profilePictureInput" class="visually-hidden mb-0" accept="image/*" onchange="updateProfilePicture(event)">
                                </div>

                                <div class="row" style="margin-left: 30px; width: 80%; height: 65%;">
                                    <div class="col-md-5 firstname">
                                        <label for="validationCustom01" class="form-label mb-0" style="font-size: 12px;">FIRST NAME</label>
                                        <input type="text" class="form-control" placeholder="Juan" id="EditStaffFname" name="EditStaffFname" style="font-size: 10px; text-transform: capitalize !important;" required>

                                    </div>
                                    <div class="col-md-5">
                                        <label for="validationCustom02" class="form-label mb-0" style="font-size: 12px;">LAST NAME</label>
                                        <input type="text" class="form-control" placeholder="Dela Cruz" id="EditStaffLname" name="EditStaffLname"  style="font-size: 10px; text-transform: capitalize !important;" required>

                                    </div>
                                    <div class="col-md-2">
                                        <label for="validationCustom02" class="form-label mb-0" style="font-size: 12px;">M.I.</label>
                                        <input type="text" class="form-control mb-0" placeholder="I" id="EditStaffInitial" name="EditStaffInitial"  style="font-size: 10px; text-transform: capitalize !important;" required>
                                        <div class="invalid-feedback">
                                            Please type the middle initial .
                                        </div>
                                    </div>

                                    <div class="col-md-3 mt-2">
                                        <label for="validationCustom01" class="form-label mb-0" style="font-size: 12px;">STAFF ID</label>
                                        <input type="text" class="form-control" id="EditStaffID" name="EditStaffID"  placeholder="2021-00565" style="font-size: 10px;" required>

                                    </div>

                                    <div class="col-md-5 mt-2">
                                        <label for="validationCustomUsername" class="form-label mb-0" style="font-size: 12px;">EMAIL ADDRESS</label>
                                        <div class="input-group has-validation">
                                            <input type="text" class="form-control " id="EditStaffPemail" name="EditStaffPemail"  aria-describedby="inputGroupPrepend" placeholder="@usep.edu.ph" style="font-size: 10px;" required>

                                        </div>
                                    </div>

                                    <div class="col-md-4 mt-2">
                                        <label for="validationCustom01" class="form-label mb-0" style="font-size: 12px;">PHONE NUMBER</label>
                                        <input type="tex" class="form-control" id="EditStaffPnumber" name="EditStaffPnumber"  placeholder="091234567890" style="font-size: 10px;" required>

                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <label for="validationCustom01" class="form-label mb-0" style="font-size: 12px;">TELEPHONE NUMBER</label>
                                        <input type="text" class="form-control" id="EditStaffTnumber" name="EditStaffTnumber"  placeholder="291-3281-919" style="font-size: 10px;" required>

                                    </div>




                                    <div class="col-md-8 mt-2">
                                        <label for="validationCustom03" class="form-label mb-0" style="font-size: 12px; ">ADDRESS</label>
                                        <input type="text" class="form-control" id="EditStaffAddress" name="EditStaffAddress"  style="font-size: 10px; text-transform: capitalize !important;" placeholder="Purok, Baranggay, City/Municipality, Province">

                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <label for="validationCustom03" class="form-label mb-0" style="font-size: 12px; ">ROLE</label>
                                        <input type="text" class="form-control" id="EditStaffRole" name="EditStaffRole" style="font-size: 10px; text-transform: capitalize !important;" placeholder="Librarian">

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col col-md-5 mt-3">
                                        <label for="validationCustomUsername" class="form-label mb-0" style="font-size: 12px;">EMAIL ADDRESS</label>
                                        <div class="input-group has-validation">
                                            <input type="text" class="form-control " id="EditStaffOemail" name="EditStaffOemail" aria-describedby="inputGroupPrepend" placeholder="@usep.edu.ph" style="font-size: 10px;" required>

                                        </div>
                                    </div>

                                    <div class=" col col-md-3 mt-3">
                                        <label for="validationCustomUsername" class="form-label mb-0" style="font-size: 12px;">USERNAME</label>
                                        <div class="input-group has-validation">
                                            <input type="text" class="form-control" id="EditStaffUsername" name="EditUsername" aria-describedby="inputGroupPrepend" placeholder="juandlz" style="font-size: 10px;" required>

                                        </div>
                                    </div>

                                    <div class="col col-md-4 mt-3">
                                        <label for="validationCustomUsername" class="form-label mb-0" style="font-size: 12px;">PASSWORD</label>
                                        <div class="input-group has-validation">
                                            <input type="password" class="form-control" placeholder="Password123." id="Editpsw" name="Editpsw" style="font-size: 10px;" aria-describedby="inputGroupPrepend" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>

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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
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
            // Attach a click event to the "ADD STAFF" button
            $("#addStaffBtn").click(function() {
                // Show the staff modal
                $("#staffModal").modal("show");
            });

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
        function addStaff() {
            // Add your logic here
            $("#staffModal").modal("hide");
        }
    </script>
    <script>
        document.getElementById('deleteAllStaff').addEventListener('click', function() {
            showDeleteConfirmation(1); // Pass a unique identifier
        });

        function showDeleteConfirmation(id) {
            const iconHtml = '<div style="background-color: white; padding: 21px; "><i class="bi bi-trash3-fill" style="font-size: 50px; color: #711717;"></i></div>';

            Swal.fire({
                title: 'ARE YOU SURE?',
                text: 'Do you really want to delete this / these staff? Process cannot be undone.',
                icon: null, // Remove the 'icon' property, as it's overridden by 'iconHtml'
                iconHtml: iconHtml, // Set the custom iconHtml with the trash icon
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
                },
                width: '520px'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If the user confirms, you can proceed with the deletion logic here
                    Swal.fire('DELETED!', 'SUCCESSFULLY DELETED!.', 'success');
                }
            });
        }
    </script>
    <script>
        document.getElementById('suspendAll').addEventListener('click', function() {
            showSuspendConfirmation(1); // Pass a unique identifier
        });

        function showSuspendConfirmation(id) {
            const iconHtml = '<div style="background-color: white; padding: 21px; "><i class="bi bi-exclamation-triangle fill" style="font-size: 50px; color: #711717;"></i></div>';

            Swal.fire({
                title: 'ARE YOU SURE?',
                text: 'Do you really want to suspend this / these staff? Process cannot be undone. ',
                icon: null, // Remove the 'icon' property, as it's overridden by 'iconHtml'
                iconHtml: iconHtml, // Set the custom iconHtml with the trash icon
                showCancelButton: true,
                cancelButtonText: 'CANCEL',
                cancelButtonColor: '#611818',
                confirmButtonText: 'SUSPEND',
                confirmButtonColor: '#711717',
                customClass: {
                    popup: 'my-swal-popup',
                    content: 'my-swal-content',
                    title: 'swal-title',
                    cancelButton: 'my-cancel-button',
                    confirmButton: 'my-confirm-button',
                },
                width: '520px'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If the user confirms, you can proceed with the suspension logic here
                    Swal.fire('Suspended!', 'The account has been suspended.', 'success');
                }
            });
        }
    </script>
    <script>
            function addStaff() {
                var formData = new FormData();
                var profileFileInput = $('#addStaffinput-file')[0];
                if (profileFileInput.files.length > 0) {
                    formData.append('profile', profileFileInput.files[0]);
                }
                formData.append('first_name', $('#addStaffFname').val());
                formData.append('last_name', $('#addStaffLname').val());
                formData.append('mi', $('#addStaffInitial').val());
                formData.append('staffID', $('#addStaffID').val());
                formData.append('officeEmail', $('#addStaffOemail').val());
                formData.append('PhoneNumber', $('#addStaffPnumber').val());
                formData.append('Telephone', $('#addStaffTnumber').val());
                formData.append('address', $('#addStaffAddress').val());
                formData.append('role', $('#addStaffRole').val());
                formData.append('personalEmail', $('#addStaffPemail').val());
                formData.append('username', $('#addStaffUsername').val());
                formData.append('password', $('#psw').val());

                for (var pair of formData.entries()) {
                    console.log(pair[0] + ', ' + pair[1]);
                }

                $.ajax({
                    url: '../operations/add_staff.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        console.log('Response:', response);
                        try {
                            var result = JSON.parse(response);
                            if (result.success) {
                                alert('Staff member added successfully!');
                                location.reload();
                            } else {
                                alert('Failed to add staff member: ' + result.error);
                            }
                        } catch (e) {
                            console.error('Failed to parse JSON response:', response);
                        }
                    },
                    error: function () {
                        alert('AJAX request failed.');
                    }
                });
            }
        </script>
    <script>
        $(document).ready(function() {
            $('.editStudentProfile').click(function(e) {
                e.preventDefault();

                // Get the admin_id from the data attribute
                var adminId = $(this).data('admin-id');

                // Make an AJAX request to fetch staff data
                $.ajax({
                    url: '../operations/fetch_staff.php', // Replace with your backend endpoint
                    type: 'POST',
                    data: { adminId: adminId },
                    dataType: 'json',
                    success: function(response) {
                        // Log the response to inspect the structure
                        console.log(response);

                        // Handle the response and populate your modal with data
                        populateModal(response);
                    },
                    error: function() {
                        // Handle errors
                        console.error('Error fetching staff data.');
                    }
                });
            });

            function populateModal(data) {
                // Log the data to inspect the structure
                console.log(data);

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
    <script src="../js/update_staff.js"></script>
    <script src="../js/delete_staff.js"></script>


</body>

</html>
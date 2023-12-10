<?php
session_start();
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
include 'C:\wamp64\www\LIBMS\operations\authentication.php';
include 'C:\wamp64\www\LIBMS\includes\fetch_user_data.php';

include 'C:\wamp64\www\LIBMS\includes\fetch_staff_data.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$loggedAdmin = '';

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
    <link rel="stylesheet" href="../css/side_bar.css">


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
                <div class="container mt-4">
                    <ul class="menu_icon">
                        <li class="active"><img class="custom_menu_icon" src="../icons/dashboard_icon.png" alt=""><span><a href="dashboard.php">Dashboard</a></span></li>
                        <li class="accordion-item">
                            <div class="headermenu">
                                <button  class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#studentCollapse" aria-expanded="false" aria-controls="studentCollapse">
                                    <img class="custom_menu_icon" src="../icons/staff_icon.png" alt="" style="margin-right: 10px; "> Student
                                </button>
                            </div>
                            <div id="studentCollapse" class="accordion-collapse collapse ms-4" data-bs-parent="#menuAccordion">
                                <div class="accordion-body">
                                    <a href="student.php">All Students</a><br>
                                    <a href="college.php">Colleges</a><br>
                                    <a href="course.php">Courses</a><br>
                                    <a href="section.php">Sections</a>
                                </div>
                            </div>
                        </li>
                        <li><img class="custom_menu_icon" src="../icons/reports_icon.png" alt=""><span><a href="report.php">Reports</a></span></li>
                        <li><img class="custom_menu_icon" src="../icons/logs_icon.png" alt=""><span><a href="logs.php">Logs</a></span></li>
                        <li><img class="custom_menu_icon" src="../icons/admin_inventory_menu.png" alt=""><span><a href="inventory.php">Inventory</a></span></li>
                        <li>
                            <i class="bi bi-bookshelf custom_menu_icon" style="font-size: 20px; color:#fff"></i>
                            <span><a href="shelf.php">Shelf</a></span>
                        </li>

                    </ul>
                </div>

            </div>
            <div class="col" style=" width: 100%; height: 100vh; ">
                <div style="background-color: white; width: 95%; height: 45px; margin: 15px; border-radius: 5px;display: flex; box-shadow: 0px 4px 8px rgba(0,0,0,0.27); align-content: center; align-items: center">
                    <div style="width: 90%">
                        <p style="font-size: 10px; font-weight: 700; margin: 14px">HOME | COLLEGE</p>
                    </div>
                    <!-- Notification Bell Icon -->
                    <div class="mr-3" style="margin-left: 40px;">
                        <a href="#" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-bell" style="font-size: 20px; color: #4d0202;"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="notificationDropdown" style="padding: 25px; font-size: 13px; background-color: white;">
                            <li style="margin-bottom: 15px;"><span><b>NOTIFICATION</b></span></li>
                            <li>
                                <div class="d-flex justify-content-between align-items-center" style=" background-color: #F8F8FF; padding: 10px; height: 35px; box-shadow: 0px 4px 8px rgba(0,0,0,0.27); margin-bottom: 8px;">
                                    <span>Sheena Pagas has requested to borrow a book</span>
                                    <div class="btn-group ms-4">
                                        <button type="button" class="btn custom-btn" data-bs-toggle="modal" onclick="handleButtonClick(event)" data-bs-target="#infoModal1">
                                            <i class="bi bi-info-circle" style="color:blue; font-size: 20px;"></i>
                                        </button>
                                        <button type="button" class="btn custom-btn" onclick="handleButtonClick(event)">
                                            <i class="bi bi-check-circle" style="color:green; font-size: 20px;"></i>
                                        </button>
                                        <button type="button" class="btn custom-btn" onclick="handleButtonClick(event)">
                                            <i class="bi bi-x-circle" style="color:red; font-size: 20px;"></i>
                                        </button>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex justify-content-between align-items-center" style=" background-color: #F8F8FF; padding: 10px; height: 35px; box-shadow: 0px 4px 8px rgba(0,0,0,0.27); margin-bottom: 8px;">
                                    <span>Sheena Pagas has requested to borrow a book</span>
                                    <div class="btn-group ms-4">
                                        <button type="button" class="btn custom-btn" data-bs-toggle="modal" onclick="handleButtonClick(event)" data-bs-target="#infoModal1">
                                            <i class="bi bi-info-circle" style="color:blue; font-size: 20px;"></i>
                                        </button>
                                        <button type="button" class="btn custom-btn" onclick="handleButtonClick(event)">
                                            <i class="bi bi-check-circle" style="color:green; font-size: 20px;"></i>
                                        </button>
                                        <button type="button" class="btn custom-btn" onclick="handleButtonClick(event)">
                                            <i class="bi bi-x-circle" style="color:red; font-size: 20px;"></i>
                                        </button>
                                    </div>
                                </div>
                            </li>



                        </ul>
                    </div>
                    <div class=" d-flex justify-content-end align-items-center" style="height: 50px; width: 6%; margin-right: 20px ">
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

                                    <label for="logoutButton"><img src="../icons/plug.png" style="width: 20px; " alt=""></label>
                                    <input id="logoutButton" style="font-size: 12px; color: white; background: none; border: none;" name="logout" type="submit" value="Logout">
                                </form>
                            </ul>
                        </div>
                    </div>
                </div>

                <div style="display: flex; justify-content: center; ">
                    <div style="background-color: white; width: 95%; height: 55px; margin: 15px; border-radius: 5px;display: flex; box-shadow: 0px 4px 8px rgba(0,0,0,0.27); align-items: center">
                        <div class="col col-md-2" style="margin-left: 85%;">
                            <button id="addCollegeBtn" style="font-size: 12px; width: 150px; height: 30px; border-radius: 5px; background-color: rgb(128,0,0); color: white; border: none">ADD COLLEGE</button>
                        </div>
                    </div>
                </div>

                <div style="display: flex; justify-content: center; ">
                    <div style="font-size: 12px; background-color: white; width: 95%; max-height: 550px; box-shadow: 0px 4px 8px rgba(0,0,0,0.27);">
                        <div style="width: 100%; display: flex; justify-content: center; border-radius: 5px">
                            <table class="table text-center" style="width: 98%;">
                                <tbody>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>COLLEGE</th>
                                            <th>MANAGE</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                    <tr style="height: 10px">

                                    </tr>
                                    <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25);">
                                        <td>COL0111</td>
                                        <td>College of Teacher Education and Technology</td>
                                        <td style="padding: 1px;">
                                            <div class="btn-group" role="group">
                                                <a href="#" class="btn custom-btn editStudentProfile" id="editCollegeBtn">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="#" class="btn custom-btn deleteStudent" id="deleteCollegeBtn">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>


                        </div>
                        <div style="width: 100%; display: flex; justify-content: center; margin: 20px 0px; margin-top: 100px;">
                            <div class="row" style="width: 98%;">
                                <div class="col col-md-8" style="">
                                    <img style="width: 180px" src="../icons/pagination_sample.png" alt="">
                                </div>
                            </div>

                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Add College Modal-->
    <div class="modal fade" id="collegeModal" tabindex="-1" role="dialog" aria-labelledby="collegeModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document" style="max-width: 700px;">
            <div class="modal-content">
                <div class="modal-header" style="height: 15px;">

                    <p class="modal-title" id="borrowModalLabel " style="font-size: 10px; color: #800000; font-weight: 600;">
                        <i class="bi bi-pencil-square ml-3 m-3" style="font-size: 12px; color: #800000;"></i>ADD COLLEGE
                    </p>
                    <button style="font-size: 16px; background-color: transparent; border:none;" type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid " style="padding-left: 40px ; padding-right: 40px">
                        <div class="row">


                            <form id="AddCollegeModal" class="row needs-validation " style="margin-left: 30px; width: 80%; height: 65%; " novalidate>
                                <div class="col-md-5 firstname">
                                    <label for="addCollegeId" class="form-label mb-0" style="font-size: 12px;">COLLEGE ID</label>
                                    <input type="text" class="form-control" placeholder="COL0111" id="addCollegeId" style="font-size: 10px; text-transform: capitalize !important;" required>
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid first name!
                                    </div>
                                    <div class="valid-feedback" style="font-size: 8px">Looks good!</div>
                                </div>


                                <div class="col-md-12">
                                    <label for="addCollegeName" class="form-label mb-0" style="font-size: 12px;">COLLEGE NAME</label>
                                    <input type="text" class="form-control" placeholder="College of Teacher Eucation and Technology" id="addCollegeName" style="font-size: 10px; text-transform: capitalize !important;" required>
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid last name!
                                    </div>
                                    <div class="valid-feedback" style="font-size: 8px">Looks good!</div>

                                </div>


                                <div class="wishlist-container mt-4 mb-0" style="display: flex; justify-content: flex-end; width: 664px; margin-left: 30%;">
                                    <button style="height: 25px; width: 100px" type="button" class="clear shadow" onclick="clearForm()">CLEAR</button>
                                    <button style="height: 25px; width: 100px" type="submit" id="addCllgBtn" class="add shadow">ADD</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit College Modal-->
    <div class="modal fade" id="editCollegeModal" tabindex="-1" role="dialog" aria-labelledby="editcollegeModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document" style="max-width: 700px;">
            <div class="modal-content">
                <div class="modal-header" style="height: 15px;">

                    <p class="modal-title" id="borrowModalLabel " style="font-size: 10px; color: #800000; font-weight: 600;">
                        <i class="bi bi-pencil-square ml-3 m-3" style="font-size: 12px; color: #800000;"></i>EDIT COLLEGE
                    </p>
                    <button style="font-size: 16px; background-color: transparent; border:none;" type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid " style="padding-left: 40px ; padding-right: 40px">
                        <div class="row">


                            <form id="EditCollegeModal" class="row needs-validation " style="margin-left: 30px; width: 80%; height: 65%; " novalidate>
                                <div class="col-md-5 firstname">
                                    <label for="editCollegeId" class="form-label mb-0" style="font-size: 12px;">COLLEGE ID</label>
                                    <input type="text" class="form-control" value="COL0111" id="editCollegeId" style="font-size: 10px; text-transform: capitalize !important;" required>
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid first name!
                                    </div>
                                    <div class="valid-feedback" style="font-size: 8px">Looks good!</div>
                                </div>


                                <div class="col-md-12">
                                    <label for="editCollegeName" class="form-label mb-0" style="font-size: 12px;">COLLEGE NAME</label>
                                    <input type="text" class="form-control" value="College of Teacher Eucation and Technology" id="editCollegeName" style="font-size: 10px; text-transform: capitalize !important;" required>
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid last name!
                                    </div>
                                    <div class="valid-feedback" style="font-size: 8px">Looks good!</div>

                                </div>


                                <div class="wishlist-container mt-4 mb-0" style="display: flex; justify-content: flex-end; width: 664px;  margin-left: 30%;">
                                    <button style="height: 25px; width: 100px" type="button" class="clear shadow" onclick="clearForm()">CLEAR</button>
                                    <button style="height: 25px; width: 100px" type="submit" id="saveCllgBtn" class="add shadow">SAVE</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Information Modal -->
    <div class="modal fade" id="infoModal1" tabindex="-1" aria-labelledby="infoModal1Label" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document" style="max-width: 800px;">
            <div class="modal-content">
                <div class="modal-header" style="height: 15px;">

                    <p class="modal-title" id="borrowModalLabel " style="font-size: 12px; color: #800000; font-weight: 600;">
                        <i class="bi bi-info-circle" style="color:#800000; font-size: 17px; margin-right: 10px;"></i>TRANSACTION DETAILS
                    </p>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="background-color: transparent; border:none;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style=" margin-left: 20px;">
                    <!-- Student Information -->
                    <div class="row" style="font-size: 12px;">
                        <div class="col-md-5">
                            <p>Student ID: <span id="studentId"></span></p>
                            <p>Name: <span id="studentName"></span></p>
                            <p>Course: <span id="studentCourse"></span></p>
                        </div>
                        <div class="col-md-5">
                            <p>Year: <span id="studentYear"></span></p>
                            <p>Major: <span id="studentMajor"></span></p>
                        </div>
                    </div>

                    <!-- Book Information -->
                    <div class="row" style="font-size: 12px;">

                        <div class="col-md-2">
                            <!-- Book Image -->
                            <img src="../book_img/1984.jpg" alt="Book Image" class="img-fluid" style="max-height: 160px; max-width: 100%;">
                        </div>

                        <div class="col-md-5">
                            <p>Book Title: <span id="bookTitle"></span></p>
                            <p>Author: <span id="author"></span></p>
                            <p>Borrow date: <span id="borrowDate"></span></p>
                        </div>

                        <div class="col-md-5">
                            <p>Shelf: <span id="shelf"></span></p>
                            <p>Publisher: <span id="publisher"></span></p>
                            <p>Due Date: <span id="dueDate"></span></p>
                        </div>
                    </div>
                    <!-- Buttons -->
                    <button style="margin-left: 70%; background-color:white; border-color:#4d0202; color:#4d0202; height: 35px; font-size:13px" type="button" class="btn" onclick="rejectBorrow()">REJECT</button>
                    <button style="margin-left: 10px; background-color:#740000; color:#fff; height: 35px; font-size:13px" type="button" class="btn" onclick="approveBorrow()">APPROVE</button>
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

    <script>
        // Prevent the dropdown from closing when clicking on the buttons
        function handleButtonClick(event) {
            event.stopPropagation();
        }
    </script>

    <script>
        $(document).ready(function() {
            // Attach a click event to the "ADD STUDENT" button
            $("#addCollegeBtn").click(function() {
                // Show the student modal
                $("#collegeModal").modal("show");
            });

            $("#editCollegeBtn").click(function() {
                // Show the student modal
                $("#editCollegeModal").modal("show");
            });

            // Handle the file input change event
            $("#addStudentinput-file").change(function() {
                readURL(this);
            });
        });
    </script>

    <script>
        // The deleteAllBook button
        const deleteButton = document.getElementById('deleteCollegeBtn');
        if (deleteButton) {
            deleteButton.addEventListener('click', function() {
                showDeleteConfirmation(1); // Pass a unique identifier
            });
        }

        function showDeleteConfirmation(id) {
            Swal.fire({
                title: 'ARE YOU SURE?',
                text: 'Do you really want to delete this college? Process cannot be undone.',
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

</body>

</html>
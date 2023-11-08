<?php
session_start();
require_once 'C:\wamp64\www\LIBMS\LIBMS\db_config\config.php';
include 'C:\wamp64\www\LIBMS\LIBMS\operations\authentication.php';
include 'C:\wamp64\www\LIBMS\LIBMS\includes\fetch_user_data.php';
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/admin_student.css">
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
                                <img src="../img/me_sample_profile.jpg" alt="" width="35px" style="border-radius: 60px; border: 1px solid #4d0202">
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark dropdown_menu_setting aria-labelledby=" dropdownMenuButton2">
                                <li><a class="dropdown-item" href="manage_account.php"><img src="../icons/manage_account.png" alt="" class="custom_icon"><span>Manage Account</span></a></li>
                                <li><a class="dropdown-item" href="#"><img src="../icons/help.png" alt="" class="custom_icon"><span>Help</span></a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="../operations/logout.php"><img src="../icons/plug.png" alt="" class="custom_icon"><span>Logout</span></a></li>
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
                                <input type="search" class="search-input" placeholder="Search Book">
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
                            <table style="width: 98%; " class=" table text-center">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="selectAllCheckbox" style="position: absolute; margin: 2px 0px 0px -20px;">Select All</th>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Course</th>
                                        <th>Year Level</th>
                                        <th>Manage</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="height: 10px">

                                    </tr>
                                    <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25);">
                                        <td><input type="checkbox"></td>
                                        <td>Sheena Marie Pagas</td>
                                        <td>880423897-57838</td>
                                        <td>IT</td>
                                        <td>Stephen King</td>
                                        <td>7 hours</td>


                                    </tr>
                                    <tr style="height: 10px">

                                    </tr>
                                    <tr style=" height: 40px;background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25); border-radius: 5px;">

                                        <td><input type="checkbox"></td>
                                        <td>Lorjohn M. Raña</td>
                                        <td>880423897-57838</td>
                                        <td>IT</td>
                                        <td>Stephen King</td>
                                        <td>7 hours</td>


                                    </tr>
                                    <tr style="height: 10px">

                                    </tr>
                                    <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px;border: 1px solid rgba(0,0,0,0.25);">
                                        <td><input type="checkbox"></td>
                                        <td>Sheena Marie Pagas</td>
                                        <td>880423897-57838</td>
                                        <td>IT</td>
                                        <td>Stephen King</td>
                                        <td>7 hours</td>


                                    </tr>
                                    <tr style="height: 10px">

                                    </tr>
                                    <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25);">
                                        <td><input type="checkbox"></td>
                                        <td>Sheena Marie Pagas</td>
                                        <td>880423897-57838</td>
                                        <td>IT</td>
                                        <td>Stephen King</td>
                                        <td>7 hours</td>


                                    </tr>
                                    <tr style="height: 10px">

                                    </tr>

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

    <div class="modal fade" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="studentModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document" style="max-width: 800px;">
            <div class="modal-content">
                <div class="modal-header" style="height: 15px;">

                    <p class="modal-title" id="borrowModalLabel " style="font-size: 16px; color: #800000; font-weight: 600;">
                        <i class="bi bi-pencil-square ml-3 m-3" style="font-size: 20px; color: #800000;"></i>ADD STUDENT
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
                                    <input type="file" accept="image/jpeg, image/png, image/jpg" id="input-file" class="visually-hidden mb-0">
                                </div>
                            </div>



                            <form class="row" style="margin-left: 30px; width: 80%; height: 65%;">
                                <div class="col-md-5 firstname">
                                    <label for="validationCustom01" class="form-label mb-0" style="font-size: 12px;">FIRST NAME</label>
                                    <input type="text" class="form-control" placeholder="Juan" id="validationCustom01" style="font-size: 10px; text-transform: capitalize !important;" required>

                                </div>
                                <div class="col-md-5">
                                    <label for="validationCustom02" class="form-label mb-0" style="font-size: 12px;">LAST NAME</label>
                                    <input type="text" class="form-control" placeholder="Dela Cruz" id="validationCustom02" style="font-size: 10px; text-transform: capitalize !important;" required>

                                </div>
                                <div class="col-md-2">
                                    <label for="validationCustom02" class="form-label mb-0" style="font-size: 12px;">M.I.</label>
                                    <input type="text" class="form-control mb-0" placeholder="I" id="validationCustom02" style="font-size: 10px; text-transform: capitalize !important;" required>
                                    <div class="invalid-feedback">
                                        Please type the middle initial .
                                    </div>
                                </div>

                                <div class="col-md-3 mt-2">
                                    <label for="validationCustom01" class="form-label mb-0" style="font-size: 12px;">STUDENT ID</label>
                                    <input type="number" class="form-control" id="validationCustom01 " min="9" max="9" placeholder="2021-00565" style="font-size: 10px;" required>

                                </div>

                                <div class="col-md-5 mt-2">
                                    <label for="validationCustomUsername" class="form-label mb-0" style="font-size: 12px;">EMAIL ADDRESS</label>
                                    <div class="input-group has-validation">
                                        <input type="text" class="form-control " id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="@usep.edu.ph" style="font-size: 10px;" required>

                                    </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                    <label for="validationCustom01" class="form-label mb-0" style="font-size: 12px;">PHONE NUMBER</label>
                                    <input type="number" class="form-control" id="validationCustom01" placeholder="091234567890" style="font-size: 10px;" required>

                                </div>




                                <div class="col-md-8 mt-2">
                                    <label for="validationCustom03" class="form-label mb-0" style="font-size: 12px; ">ADDRESS</label>
                                    <input type="text" class="form-control" id="validationCustom03" style="font-size: 10px; text-transform: capitalize !important;" placeholder="Purok, Baranggay, City/Municipality, Province">

                                </div>
                                <div class="col-md-4 mt-2">
                                    <label for="validationCustom03" class="form-label mb-0" style="font-size: 12px; ">SECTION/YEAR</label>
                                    <input type="text" class="form-control" id="validationCustom03" style="font-size: 10px; text-transform: capitalize !important;" placeholder="Section/Year">

                                </div>
                                <div class="col-md-8 mt-2">
                                    <label for="validationCustom03" class="form-label mb-0" style="font-size: 12px; ">COURSE</label>
                                    <input type="text" class="form-control" id="validationCustom03" style="font-size: 10px; text-transform: capitalize !important;" placeholder="Purok, Baranggay, City/Municipality, Province">

                                </div>
                                <div class="col-md-4 mt-2">
                                    <label for="validationCustom03" class="form-label mb-0" style="font-size: 12px; ">MAJOR</label>
                                    <input type="text" class="form-control" id="validationCustom03" style="font-size: 10px; text-transform: capitalize !important;" placeholder="Section/Year">

                                </div>
                            </form>
                            <form class="row">
                                <div class="col col-md-5 mt-3">
                                    <label for="validationCustomUsername" class="form-label mb-0" style="font-size: 12px;">EMAIL ADDRESS</label>
                                    <div class="input-group has-validation">
                                        <input type="text" class="form-control " id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="@usep.edu.ph" style="font-size: 10px;" required>

                                    </div>
                                </div>

                                <div class=" col col-md-3 mt-3">
                                    <label for="validationCustomUsername" class="form-label mb-0" style="font-size: 12px;">USERNAME</label>
                                    <div class="input-group has-validation">
                                        <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="juandlz" style="font-size: 10px;" required>

                                    </div>
                                </div>

                                <div class="col col-md-4 mt-3">
                                    <label for="validationCustomUsername" class="form-label mb-0" style="font-size: 12px;">PASSWORD</label>
                                    <div class="input-group has-validation">
                                        <input type="password" class="form-control" placeholder="Password123." id="psw" style="font-size: 10px;" aria-describedby="inputGroupPrepend" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>

                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class=" wishlist-container  mt-4 mb-0 " style=" display: flex; justify-content: flex-end; width: 664px; ">
                            <button style="height: 25px; width: 100px" type="button" class="clear shadow " onclick="clearPhoto()">CLEAR</button>
                            <button style="height: 25px; width: 100px" type="button" class="add shadow" onclick="addStudent()">ADD</button>
                        </div>
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
            // Attach a click event to the "ADD STUDENT" button
            $("#addStudentBtn").click(function() {
                // Show the student modal
                $("#studentModal").modal("show");
            });

            // Handle the file input change event
            $("#input-file").change(function() {
                readURL(this);
            });

            // Handle click event on the Add Image icon
            $(".AddImageContainer i").click(function() {
                $("#input-file").click();
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
            $("#input-file").click();
        }

        // Function to clear the displayed photo
        function clearPhoto() {
            $('#Profile-Pic').attr('src', '');
            $(".AddImageContainer i").show();
        }

        // Function to handle adding a student (you can replace this with your actual logic)
        function addStudent() {
            // Add your logic here
            $("#studentModal").modal("hide");
        }
    </script>
    <script>
        document.getElementById('deleteAllUser').addEventListener('click', function() {
            showDeleteConfirmation(1); // Pass a unique identifier
        });

        function showDeleteConfirmation(id) {
            const iconHtml = '<div style="background-color: white; padding: 21px; "><i class="bi bi-trash3-fill" style="font-size: 50px; color: #711717;"></i></div>';

            Swal.fire({
                title: 'ARE YOU SURE?',
                text: 'Do you really want to delete this / these student? Process cannot be undone.',
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
                }
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
                text: 'Do you really want to suspend this / these student? Process cannot be undone. ',
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
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // If the user confirms, you can proceed with the suspension logic here
                    Swal.fire('Suspended!', 'The account has been suspended.', 'success');
                }
            });
        }
    </script>

</body>

</html>
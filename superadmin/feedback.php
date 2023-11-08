<?php
session_start();
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
include 'C:\wamp64\www\LIBMS\operations\authentication.php';
include 'C:\wamp64\www\LIBMS\includes\fetch_user_data.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$loggedAdmin = '';

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
    <link rel="stylesheet" href="../css/superadmin_staff.css">
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
                        <li><img class="custom_menu_icon" src="../icons/staff_icon.png" alt=""><span><a href="staff.php">Staff</a></span></li>
                        <li><img class="custom_menu_icon" src="../icons/reports_icon.png" alt=""><span><a href="report.php">Reports</a></span></li>
                        <li><img class="custom_menu_icon" src="../icons/logs_icon.png" alt=""><span><a href="logs.php">Logs</a></span></li>
                        <li class="active"><img class="custom_menu_icon" src="../icons/feedback_icon_dashboard.png" alt=""><span><a href="">Feedback</a></span></li>
                    </ul>
                </div>

            </div>
            <div class="col" style=" width: 100%; height: 100vh;">
                <div style="background-color: white; width: 95%; height: 45px; margin: 15px; border-radius: 5px;display: flex; box-shadow: 0px 4px 8px rgba(0,0,0,0.27); align-content: center; align-items: center">
                    <div style="width: 90%">
                        <p style="font-size: 10px; font-weight: 700; margin: 14px">HOME | FEEDBACK</p>
                    </div>
                    <div class=" d-flex justify-content-end align-items-center" style="height: 50px; width: 10%; margin-right: 20px ">
                        <div class="dropdown" style=" margin-right: 0px; position: absolute">
                            <button style="background: none; border: none;" class=" dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="../img/<?= $loggedAdmin['img'] ?>" alt="" width="35px" style="border-radius: 60px; border: 1px solid #4d0202">
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
                    <div>

                    </div>
                    <div style="width: 95%; min-height: 80vh;border-radius: 5px; box-shadow: 0px 4px 8px rgba(0,0,0,0.27);">
                        <div class="row" style="width: 98%; height: 50px; margin: 10px 20px; display:flex; justify-content: center; align-content: center; align-items: center">
                            <div class="col col-md-10" style="display: flex; align-items: center; font-size: 12px;">
                                <input type="checkbox" id="selectAllCheckbox" style="vertical-align: middle; margin-right: 10px;">
                                <label for="selectAllCheckbox" style="vertical-align: middle;">Select All</label>
                            </div>
                            <div class="col col-md-2" style="display: flex; justify-content: flex-end">
                                <div style="margin-right: 50px;"> 
                                    <button style="border: none; background-color: transparent;">
                                        <img style="width: 20px;" src="../icons/export_icon.png" alt="">
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div style="margin: 0px 20px 20px 20px; width: 97%; display:flex; justify-content: space-between; flex-wrap: wrap ">
                            <div class="card" style="width: 37.5rem; height: 200px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26); margin: 10px 0px;">
                                <div class="card-body">
                                    <h6 class="card-title"><input type="checkbox"></h6>
                                    <div class="row" style="margin-top: -10px">
                                        <div class="col col-md-6" style="display: flex; height: 40px; align-items: center; align-content: center">
                                            <div>
                                                <img style="width: 35px" src="../icons/user.png" alt="">
                                            </div>
                                            <div style="padding: 0; margin: 0 0 0 5px; height: 35px; width: 15ch;">
                                                <div style="margin-top: 2px">
                                                    <p style="font-size: 12px; font-weight:600">Sheena Mariz Pagas</p>
                                                    <p style="font-size: 10px; margin-top: -20px;">07 November 2023</p>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col col-md-6" style=" display: flex; justify-content: flex-end; align-content: center; align-items: center;">
                                            <img style="width: 80px; height: 15px" src="../icons/sample_star_rating.png" alt="">
                                        </div>
                                    </div>
                                    <div style="width: 100%; display: flex; justify-content: center; margin-top: 10px; text-align: center">
                                        <p style="width: 70ch; font-size: 12px" class="card-text">“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.”</p>
                                    </div>
                                    <div style="display: flex; justify-content: flex-end; margin-top: 10px">
                                        <button style="border: none; background: none;" class="deleteFeedback"><img style="width: 20px" src="../icons/delete_rating.png" alt=""></button>
                                    </div>

                                </div>
                            </div>
                            <div class="card" style="width: 37.5rem; height: 200px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26); margin: 10px 0px;">
                                <div class="card-body">
                                    <h6 class="card-title"><input type="checkbox"></h6>
                                    <div class="row" style="margin-top: -10px">
                                        <div class="col col-md-6" style="display: flex; height: 40px; align-items: center; align-content: center">
                                            <div>
                                                <img style="width: 35px" src="../icons/user.png" alt="">
                                            </div>
                                            <div style="padding: 0; margin: 0 0 0 5px; height: 35px; width: 15ch;">
                                                <div style="margin-top: 2px">
                                                    <p style="font-size: 12px; font-weight:600">Sheena Mariz Pagas</p>
                                                    <p style="font-size: 10px; margin-top: -20px;">07 November 2023</p>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col col-md-6" style=" display: flex; justify-content: flex-end; align-content: center; align-items: center;">
                                            <img style="width: 80px; height: 15px" src="../icons/sample_star_rating.png" alt="">
                                        </div>
                                    </div>
                                    <div style="width: 100%; display: flex; justify-content: center; margin-top: 10px; text-align: center">
                                        <p style="width: 70ch; font-size: 12px" class="card-text">“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.”</p>
                                    </div>
                                    <div style="display: flex; justify-content: flex-end; margin-top: 10px">
                                        <button style="border: none; background: none;" class="deleteFeedback"><img style="width: 20px" src="../icons/delete_rating.png" alt=""></button>
                                    </div>

                                </div>
                            </div>
                            <div class="card" style="width: 37.5rem; height: 200px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26); margin: 10px 0px;">
                                <div class="card-body">
                                    <h6 class="card-title"><input type="checkbox"></h6>
                                    <div class="row" style="margin-top: -10px">
                                        <div class="col col-md-6" style="display: flex; height: 40px; align-items: center; align-content: center">
                                            <div>
                                                <img style="width: 35px" src="../icons/user.png" alt="">
                                            </div>
                                            <div style="padding: 0; margin: 0 0 0 5px; height: 35px; width: 15ch;">
                                                <div style="margin-top: 2px">
                                                    <p style="font-size: 12px; font-weight:600">Sheena Mariz Pagas</p>
                                                    <p style="font-size: 10px; margin-top: -20px;">07 November 2023</p>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col col-md-6" style=" display: flex; justify-content: flex-end; align-content: center; align-items: center;">
                                            <img style="width: 80px; height: 15px" src="../icons/sample_star_rating.png" alt="">
                                        </div>
                                    </div>
                                    <div style="width: 100%; display: flex; justify-content: center; margin-top: 10px; text-align: center">
                                        <p style="width: 70ch; font-size: 12px" class="card-text">“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.”</p>
                                    </div>
                                    <div style="display: flex; justify-content: flex-end; margin-top: 10px">
                                        <button style="border: none; background: none;" class="deleteFeedback"><img style="width: 20px" src="../icons/delete_rating.png" alt=""></button>
                                    </div>

                                </div>
                            </div>
                            <div class="card" style="width: 37.5rem; height: 200px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26); margin: 10px 0px;">
                                <div class="card-body">
                                    <h6 class="card-title"><input type="checkbox"></h6>
                                    <div class="row" style="margin-top: -10px">
                                        <div class="col col-md-6" style="display: flex; height: 40px; align-items: center; align-content: center">
                                            <div>
                                                <img style="width: 35px" src="../icons/user.png" alt="">
                                            </div>
                                            <div style="padding: 0; margin: 0 0 0 5px; height: 35px; width: 15ch;">
                                                <div style="margin-top: 2px">
                                                    <p style="font-size: 12px; font-weight:600">Sheena Mariz Pagas</p>
                                                    <p style="font-size: 10px; margin-top: -20px;">07 November 2023</p>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col col-md-6" style=" display: flex; justify-content: flex-end; align-content: center; align-items: center;">
                                            <img style="width: 80px; height: 15px" src="../icons/sample_star_rating.png" alt="">
                                        </div>
                                    </div>
                                    <div style="width: 100%; display: flex; justify-content: center; margin-top: 10px; text-align: center">
                                        <p style="width: 70ch; font-size: 12px" class="card-text">“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.”</p>
                                    </div>
                                    <div style="display: flex; justify-content: flex-end; margin-top: 10px">
                                        <button style="border: none; background: none;" class="deleteFeedback"><img style="width: 20px" src="../icons/delete_rating.png" alt=""></button>
                                    </div>

                                </div>
                            </div>
                            <div class="card" style="width: 37.5rem; height: 200px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26); margin: 10px 0px;">
                                <div class="card-body">
                                    <h6 class="card-title"><input type="checkbox"></h6>
                                    <div class="row" style="margin-top: -10px">
                                        <div class="col col-md-6" style="display: flex; height: 40px; align-items: center; align-content: center">
                                            <div>
                                                <img style="width: 35px" src="../icons/user.png" alt="">
                                            </div>
                                            <div style="padding: 0; margin: 0 0 0 5px; height: 35px; width: 15ch;">
                                                <div style="margin-top: 2px">
                                                    <p style="font-size: 12px; font-weight:600">Sheena Mariz Pagas</p>
                                                    <p style="font-size: 10px; margin-top: -20px;">07 November 2023</p>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col col-md-6" style=" display: flex; justify-content: flex-end; align-content: center; align-items: center;">
                                            <img style="width: 80px; height: 15px" src="../icons/sample_star_rating.png" alt="">
                                        </div>
                                    </div>
                                    <div style="width: 100%; display: flex; justify-content: center; margin-top: 10px; text-align: center">
                                        <p style="width: 70ch; font-size: 12px" class="card-text">“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.”</p>
                                    </div>
                                    <div style="display: flex; justify-content: flex-end; margin-top: 10px">
                                        <button style="border: none; background: none;" class="deleteFeedback"><img style="width: 20px" src="../icons/delete_rating.png" alt=""></button>
                                    </div>

                                </div>
                            </div>
                            <div class="card" style="width: 37.5rem; height: 200px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26); margin: 10px 0px;">
                                <div class="card-body">
                                    <h6 class="card-title"><input type="checkbox"></h6>
                                    <div class="row" style="margin-top: -10px">
                                        <div class="col col-md-6" style="display: flex; height: 40px; align-items: center; align-content: center">
                                            <div>
                                                <img style="width: 35px" src="../icons/user.png" alt="">
                                            </div>
                                            <div style="padding: 0; margin: 0 0 0 5px; height: 35px; width: 15ch;">
                                                <div style="margin-top: 2px">
                                                    <p style="font-size: 12px; font-weight:600">Sheena Mariz Pagas</p>
                                                    <p style="font-size: 10px; margin-top: -20px;">07 November 2023</p>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col col-md-6" style=" display: flex; justify-content: flex-end; align-content: center; align-items: center;">
                                            <img style="width: 80px; height: 15px" src="../icons/sample_star_rating.png" alt="">
                                        </div>
                                    </div>
                                    <div style="width: 100%; display: flex; justify-content: center; margin-top: 10px; text-align: center">
                                        <p style="width: 70ch; font-size: 12px" class="card-text">“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.”</p>
                                    </div>
                                    <div style="display: flex; justify-content: flex-end; margin-top: 10px">
                                        <button style="border: none; background: none;" class="deleteFeedback"><img style="width: 20px" src="../icons/delete_rating.png" alt=""></button>
                                    </div>

                                </div>
                            </div>
                            <div style="width: 100%; display: flex; justify-content: center; margin: 20px 0px">
                                <div class="row" style="width: 100%;">
                                    <div class="col col-md-8" style="text-align: left;">
                                        <img style="width: 180px" src="../icons/pagination_sample.png" alt="">
                                    </div>
                                    <div class="col" style="text-align: right;">
                                        <button id="deleteAllFeedback" style="font-size: 12px;" class="operation_all_btn">Delete All</button>
                                    </div>
                                </div>
                            </div>
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
    </script>

    <script>
        window.onload = function() {
            var elements = document.getElementsByClassName('deleteFeedback');

            for (var i = 0; i < elements.length; i++) {
                elements[i].addEventListener('click', function() {
                    showDeleteConfirmation(1); // Pass a unique identifier
                });
            }

            function showDeleteConfirmation(id) {
                const iconHtml = '<div style="background-color: white; padding: 21px; "><i class="bi bi-trash3-fill" style="font-size: 50px; color: #711717;"></i></div>';

                Swal.fire({
                    title: 'ARE YOU SURE?',
                    text: 'Do you really want to delete this ? Process cannot be undone.',
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

            var selectAllCheckbox = document.getElementById('selectAllCheckbox');
            selectAllCheckbox.addEventListener('change', function() {
                var checkboxes = document.querySelectorAll('input[type="checkbox"]');
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i] != selectAllCheckbox) checkboxes[i].checked = selectAllCheckbox.checked;
                }
            });
        }
    </script>

<script>
        document.getElementById('deleteAllFeedback').addEventListener('click', function() {
            showDeleteConfirmation(1); // Pass a unique identifier
        });

        function showDeleteConfirmation(id) {
            const iconHtml = '<div style="background-color: white; padding: 21px; "><i class="bi bi-trash3-fill" style="font-size: 50px; color: #711717;"></i></div>';

            Swal.fire({
                title: 'ARE YOU SURE?',
                text: 'Do you really want to delete these feedbacks? Process cannot be undone.',
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
</body>

</html>
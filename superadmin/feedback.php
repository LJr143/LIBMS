<?php
session_start();
require_once '../db_config/config.php';
include '../operations/authentication.php';
include '../includes/fetch_user_data.php';
include '../includes/fetch_books_data.php';
include '../includes/fetch_staff_data.php';
include '../includes/fetch_superadmin_data.php';
include '../includes/fetch_feedback_data.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$loggedAdmin = '';

$database = new Database();
$userAuth = new UserAuthentication($database);
$bookData = new BookData($database);
$userData = new UserData($database);
$adminData = new StaffData($database);
$superAdminData = new SuperAdminData($database);


$numberOfBooks = $bookData->getNumberOfBooks();
$numberOfUsers = $userData->getNumberOfUser();

//Authenticate
if ($userAuth->isAuthenticated()) {
} else {
    header('Location: ../index_admin.php');
    exit();
}
//Logout
if (isset($_POST['logout'])) {
    $userAuth->logout();
    header('Location: ../index_admin.php');
    exit();
}
//Check if the user logs and checks the access type
if (isset($_SESSION['user'])) {
    $adminUsername = $_SESSION['user'];

    if (isset($_SESSION['admin_role'])) {
        $accessType = $_SESSION['admin_role'];
        if ($accessType == 'Librarian') {
            $adminID = $superAdminData->getSuperadminIdByUsername($adminUsername);
            if (!empty($adminID)) {
                $admin = $superAdminData->getSuperadminById($adminID);
                $loggedAdmin = $admin[0];
            } else {
                echo 'SuperAdmin data not found.';
            }
        } else if ($accessType == 'Staff') {
            $adminID = $adminData->getStaffIdByUsername($adminUsername);
            if (!empty($adminID)) {
                $admin = $adminData->getStaffById($adminID);
                $loggedAdmin = $admin[0];
            } else {
                echo 'SuperAdmin data not found.';
            }
        }
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

<body>
    <div>
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
                        <li><img class="custom_menu_icon" src="../icons/staff_icon.png" alt=""><span><a href="staff.php">Staff</a></span></li>
                        <li><img class="custom_menu_icon" src="../icons/reports_icon.png" alt=""><span><a href="report.php">Reports</a></span></li>
                        <li><img class="custom_menu_icon" src="../icons/logs_icon.png" alt=""><span><a href="logs.php">Logs</a></span></li>
                        <li  class="active"><img class="custom_menu_icon" src="../icons/feedback_icon_dashboard.png" alt=""><span><a href="feedback.php">Feedback</a></span></li>
                        <li>
                            <i class="bi bi-bookmark-star custom_menu_icon" style="font-size: 20px; color:#fff"></i>
                            <span><a href="book_review.php">Book Review</a></span>
                        </li>
                    </ul>
                </div>

            </div>
            <div class="col" style=" width: 100%; height: 100vh; ">
                <div style="background-color: white; width: 95%; height: 45px; margin: 15px; border-radius: 5px;display: flex; box-shadow: 0px 4px 8px rgba(0,0,0,0.27); align-content: center; align-items: center">
                    <div style="width: 90%">
                        <p style="font-size: 10px; font-weight: 700; margin: 14px">HOME | REPORT</p>
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
                                    <input style="font-size: 12px; color: white; background: none; border: none;" name="logout" type="submit" value="Logout">
                                </form>
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
                                                        <p style="font-size: 12px; font-weight:600"></p>
                                                        <p style="font-size: 10px; margin-top: -20px;"></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col col-md-6" style=" display: flex; justify-content: flex-end; align-content: center; align-items: center;">
                                                <div class="user-rating" data-rating="">

                                                        <span class="star" data-value="">&#9733;</span>

                                                </div>
                                            </div>
                                        </div>
                                        <div style="width: 100%; display: flex; justify-content: center; margin-top: 10px; text-align: center">
                                            <p style="width: 70ch; font-size: 12px; border: 1px solid black" class="card-text"></p>
                                        </div>
                                        <button style="border: none; background: none; margin-top: 10px; margin-left: 90%;" class="deleteFeedback" data-feedback-id="">
                                            <img style="width: 20px" src="../icons/delete_rating.png" alt="">
                                        </button>

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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="..."></script>
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
                    var feedbackId = this.getAttribute('data-feedback-id');
                    showDeleteConfirmation(feedbackId);
                });
            }

            function showDeleteConfirmation(feedbackId) {
                const iconHtml = '<div style="background-color: white; padding: 21px; "><i class="bi bi-trash3-fill" style="font-size: 50px; color: #711717;"></i></div>';

                Swal.fire({
                    title: 'ARE YOU SURE?',
                    text: 'Do you really want to delete this? The process cannot be undone.',
                    icon: null,
                    iconHtml: iconHtml,
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
                        // If the user confirms, send an AJAX request to delete_feedback.php
                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', 'delete_feedback.php', true);
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr.onload = function() {
                            // Refresh the page or update the UI as needed
                            location.reload();
                        };
                        xhr.send('feedback_id=' + feedbackId);
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
    <script>
        // JavaScript code to handle star rating interactions
        document.addEventListener('DOMContentLoaded', function() {
            let userRating = document.querySelector('.user-rating');
            let stars = userRating.querySelectorAll('.star');

            // Add click event listeners to stars
            stars.forEach(function(star) {
                star.addEventListener('click', function() {
                    let value = this.getAttribute('data-value');
                    userRating.setAttribute('data-rating', value);

                    // Reset all stars to empty
                    stars.forEach(function(s) {
                        s.classList.remove('filled');
                    });

                    // Fill stars up to the clicked star
                    for (let i = 1; i <= value; i++) {
                        stars[i - 1].classList.add('filled');
                    }

                    // You can send an AJAX request to update the database with the new rating
                    // For simplicity, I'm just logging the selected rating here
                    console.log('Selected Rating:', value);
                });
            });
        });
    </script>

    <!-- Add this script in your HTML file, preferably at the end of the body tag -->

</body>

</html>
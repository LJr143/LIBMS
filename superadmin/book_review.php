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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/superadmin_book_review.css">
</head>

<body style="">
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
                        <li><img class="custom_menu_icon" src="../icons/feedback_icon_dashboard.png" alt=""><span><a href="feedback.php">Feedback</a></span></li>
                        <li class="active">
                            <i class="bi bi-bookmark-star custom_menu_icon" style="font-size: 20px; color:#fff"></i>
                            <span><a href="book_review.php">Book Review</a></span>
                        </li>
                    </ul>
                </div>

            </div>
            <div class="col" style=" width: 100%; height: 100vh;">
                <div style="background-color: white; width: 95%; height: 45px; margin: 15px; border-radius: 5px;display: flex; box-shadow: 0px 4px 8px rgba(0,0,0,0.27); align-content: center; align-items: center">
                    <div style="width: 90%">
                        <p style="font-size: 10px; font-weight: 700; margin: 14px">HOME | BOOK REVIEW</p>
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
                <div class="row" style="background-color: white; width: 95%; height: 45px; margin: 15px; border-radius: 5px;display: flex; box-shadow: 0px 4px 8px rgba(0,0,0,0.27); align-content: center; align-items: center">
                    <div class="col col-md-10" style="display: flex; align-items: center;">
                        <div class="search_by" style="font-size: 13px;">
                            <select name="" id="select-book-category">
                                <option value="option">Search Categories</option>
                                <option value="option">Environment and Forestry</option>
                                <option value="option">Agriculture and Agriculture Engineering</option>
                                <option value="option">Usepiana</option>
                                <option value="option">General Information</option>
                                <option value="option">Filipiñiana </option>
                                <option value="option">Educational</option>
                                <option value="option"> Video Tapes</option>
                                <option value="option"> Special Education</option>
                                <option value="option">Others</option>
                            </select>
                        </div>
                        <div class="input_search-wrapper" style="margin-left: 20px;">
                            <input type="search" class="search-input" id="search-review" placeholder="Search Book">
                        </div>
                    </div>
                    <div class="col col-md-2" style="display: flex; justify-content: flex-end">
                        <div style="margin-right: 50px;">
                            <button style="border: none; background-color: transparent;">
                                <img style="width: 20px;" src="../icons/export_icon.png" alt="">
                            </button>
                        </div>
                    </div>
                </div>
                <div style="display: flex; justify-content: center; ">
                    <div>

                    </div>
                    <div style="width: 95%; min-height: 90vh; border-radius: 5px; box-shadow: 0px 4px 8px rgba(0,0,0,0.27);">
                        <div style="margin: 10px 20px 20px 20px; width: 97%; display: flex; justify-content: space-between; flex-wrap: wrap; align-items: flex-start;">
                            <div class="card" style="width: calc(33.33% - 20px); height: 290px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26); margin: 10px 0px; border: 1px solid black;">
                                <div class="card-body">
                                    <div style="width: 100%; height: 21vh; display: flex; margin-top: 10px;">
                                        <div style=" height: 26vh; width: 148px; overflow: hidden ">
                                            <img style="width: 100%" src="../img/The Hobbit.jpg" alt="">
                                        </div>
                                        <div style="width: 100%; height: 21vh; margin-left: 15px;">
                                            <div style="display: flex;">
                                                <h6 style="font-size: 14px; font-weight: 700; font-style: italic">The Hobbit</h6>
                                                <h6 style="color: #FFCA00; font-size: 14px; margin-left: 100px;"><i class="bi bi-star-fill"></i> 4.2 out of 5</h6>
                                            </div>
                                            <div class="book_information" style="font-size: 12px; line-height: .3;  margin-top: 5px;">
                                                <p>1234777658366</p> <!-- book isbn -->
                                                <p>J.R.R Tolkien</p> <!-- book author -->
                                            </div>
                                            <div>
                                                <!-- stars supposed to be in here -->
                                                <?php include('../includes/star_rating.php'); ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <a href="student_book_reviews.php"><button class="view_button">VIEW</button></a>
                            </div>

                            <div class="card" style="width: calc(33.33% - 20px); height: 290px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26); margin: 10px 0px; border: 1px solid black;">
                                <div class="card-body">
                                    <div style="width: 100%; height: 21vh; display: flex; margin-top: 10px;">
                                        <div style=" height: 26vh; width: 148px; overflow: hidden ">
                                            <img style="width: 100%" src="../img/The Hobbit.jpg" alt="">
                                        </div>
                                        <div style="width: 100%; height: 21vh; margin-left: 15px;">
                                            <div style="display: flex;">
                                                <h6 style="font-size: 14px; font-weight: 700; font-style: italic">The Hobbit</h6>
                                                <h6 style="color: #FFCA00; font-size: 14px; margin-left: 100px;"><i class="bi bi-star-fill"></i> 4.2 out of 5</h6>
                                            </div>
                                            <div class="book_information" style="font-size: 12px; line-height: .3;  margin-top: 5px;">
                                                <p>1234777658366</p> <!-- book isbn -->
                                                <p>J.R.R Tolkien</p> <!-- book author -->
                                            </div>
                                            <div>
                                                <!-- stars supposed to be in here -->
                                                <?php include('../includes/star_rating.php'); ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <a href="student_book_reviews.php"><button  class="view_button">VIEW</button></a>
                            </div>


                            <div class="card" style="width: calc(33.33% - 20px); height: 290px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26); margin: 10px 0px; border: 1px solid black;">
                                <div class="card-body">
                                    <div style="width: 100%; height: 21vh; display: flex; margin-top: 10px;">
                                        <div style=" height: 26vh; width: 148px; overflow: hidden ">
                                            <img style="width: 100%" src="../img/cat.jpeg" alt="">
                                        </div>
                                        <div style="width: 100%; height: 21vh; margin-left: 15px;">
                                            <div style="display: flex;">
                                                <h6 style="font-size: 14px; font-weight: 700; font-style: italic">The Bitten Cat</h6>
                                                <h6 style="color: #FFCA00; font-size: 14px; margin-left: 100px;"><i class="bi bi-star-fill"></i> 5 out of 5</h6>
                                            </div>
                                            <div class="book_information" style="font-size: 12px; line-height: .3;  margin-top: 5px;">
                                                <p>1234777658366</p> <!-- book isbn -->
                                                <p>Chuchu</p> <!-- book author -->
                                            </div>
                                            <div>
                                                <!-- stars supposed to be in here -->
                                                <?php include('../includes/star_rating.php'); ?>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <a href="student_book_reviews.php"><button class="view_button">VIEW</button></a>
                            </div>

                            <div class="card" style="width: calc(33.33% - 20px); height: 290px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26); margin: 10px 0px; border: 1px solid black;">
                                <div class="card-body">
                                    <div style="width: 100%; height: 21vh; display: flex; margin-top: 10px;">
                                        <div style=" height: 26vh; width: 148px; overflow: hidden ">
                                            <img style="width: 100%" src="../img/The Hobbit.jpg" alt="">
                                        </div>
                                        <div style="width: 100%; height: 21vh; margin-left: 15px;">
                                            <div style="display: flex;">
                                                <h6 style="font-size: 14px; font-weight: 700; font-style: italic">The Hobbit</h6>
                                                <h6 style="color: #FFCA00; font-size: 14px; margin-left: 100px;"><i class="bi bi-star-fill"></i> 4.2 out of 5</h6>
                                            </div>
                                            <div class="book_information" style="font-size: 12px; line-height: .3;  margin-top: 5px;">
                                                <p>1234777658366</p> <!-- book isbn -->
                                                <p>J.R.R Tolkien</p> <!-- book author -->
                                            </div>
                                            <div>
                                                <!-- stars supposed to be in here -->
                                                <?php include('../includes/star_rating.php'); ?>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <a href="student_book_reviews.php"><button class="view_button">VIEW</button></a>
                            </div>

                            <div class="card" style="width: calc(33.33% - 20px); height: 290px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26); margin: 10px 0px; border: 1px solid black;">
                                <div class="card-body">
                                    <div style="width: 100%; height: 21vh; display: flex; margin-top: 10px;">
                                        <div style=" height: 26vh; width: 148px; overflow: hidden ">
                                            <img style="width: 100%" src="../img/The Hobbit.jpg" alt="">
                                        </div>
                                        <div style="width: 100%; height: 21vh; margin-left: 15px;">
                                            <div style="display: flex;">
                                                <h6 style="font-size: 14px; font-weight: 700; font-style: italic">The Hobbit</h6>
                                                <h6 style="color: #FFCA00; font-size: 14px; margin-left: 100px;"><i class="bi bi-star-fill"></i> 4.2 out of 5</h6>
                                            </div>
                                            <div class="book_information" style="font-size: 12px; line-height: .3;  margin-top: 5px;">
                                                <p>1234777658366</p> <!-- book isbn -->
                                                <p>J.R.R Tolkien</p> <!-- book author -->
                                            </div>
                                            <div>
                                                <!-- stars supposed to be in here -->
                                                <?php include('../includes/star_rating.php'); ?>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <a href="student_book_reviews.php"><button class="view_button">VIEW</button></a>
                            </div>

                            <div class="card" style="width: calc(33.33% - 20px); height: 290px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26); margin: 10px 0px; border: 1px solid black;">
                                <div class="card-body">
                                    <div style="width: 100%; height: 21vh; display: flex; margin-top: 10px;">
                                        <div style=" height: 26vh; width: 148px; overflow: hidden ">
                                            <img style="width: 100%" src="../img/sinag.jpg" alt="">
                                        </div>
                                        <div style="width: 100%; height: 21vh; margin-left: 15px;">
                                            <div style="display: flex;">
                                                <h6 style="font-size: 14px; font-weight: 700; font-style: italic">Sinag ng Araw</h6>
                                                <h6 style="color: #FFCA00; font-size: 14px; margin-left: 100px;"><i class="bi bi-star-fill"></i> 3 out of 5</h6>
                                            </div>
                                            <div class="book_information" style="font-size: 12px; line-height: .3;  margin-top: 5px;">
                                                <p>1234777658366</p> <!-- book isbn -->
                                                <p>J.R.R Tolkien</p> <!-- book author -->
                                            </div>
                                            <div>
                                                <!-- stars supposed to be in here -->
                                                <?php include('../includes/star_rating.php'); ?>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <a href="student_book_reviews.php"><button class="view_button">VIEW</button></a>
                            </div>


                        </div>
                        <div class="col col-md-8 ms-5" style="">
                            <img style="width: 180px" src="../icons/pagination_sample.png" alt="">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</body>

</html>
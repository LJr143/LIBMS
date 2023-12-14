<?php
session_start();
require_once '../db_config/config.php';
include '../includes/fetch_books_data.php';
include '../operations/authentication.php';
include '../includes/fetch_student_data.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
$database = new Database();
$userAuth = new UserAuthentication($database);
$bookData = new BookData($database);
$userData = new StudentData($database);

$book = $bookData->getAllBook();

if ($userAuth->isAuthenticated()) {
} else {
    header('Location: ../index.php');
}
if (isset($_POST['logout'])) {
    $userAuth->logout();
    header('Location: ../index.php');
    exit();
}

if (isset($_SESSION['user'])) {
    $userUsername = $_SESSION['user'];

    $userID = $userData->getStudentIdByUsername($userUsername);
    if (!empty($userID)) {
        $user = $userData->getStudentById($userID);

        if (!empty($user)) {
            $loggedUser = $user[0];
            $_SESSION['user_id'] = $loggedUser['user_id'];
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
    <meta http-equiv="X-UA-Compatible" content="ie=edvge">
    <title>USeP | LMS</title>
    <link rel="icon" href="../icons/usep-logo.png">
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../node_modules/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/user_home.css">
    <link rel="stylesheet" href="../css/logout.css">
    <style>
        /* style for feedback modal */
        .rating {
            display: flex;
            align-items: center;
            gap: 20px;
            /* Adjust this value for spacing between stars within a group */
            height: 30px;

        }
    </style>

</head>

<body>
    <?php include 'header.php' ?>
    <div style=" height: 100%; width: 100%; overflow-x: hidden; position: relative">

        <div class="user-nav  text-white" style="position: relative">
            <ul class="nav justify-content-center align-items-center align-content-center" style="width: 100%">
                <li class="nav-item active">
                    <a class="nav-link" aria-current="page" href="home.php">BOOKS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="wishlist.php">WISHLIST</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="penalties.php">TRANSACTION</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="credit_score.php">CREDIT SCORE</a>
                </li>
            </ul>

            <div class=" d-flex justify-content-center align-items-center" style="height: 50px; width: 60px; right: 10px; position: absolute">
                <div class="dropdown" style=" margin-right: 0px; position: absolute">
                    <button style="background: none; border: none;" class=" dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../img/<?php echo $loggedUser['img'] ?>" alt="" width="35px" style="border-radius: 60px; border: 1px solid #4d0202">
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark dropdown_menu_setting aria-labelledby=" dropdownMenuButton2">
                        <li><a style="font-size: 12px; color: white;" class="dropdown-item" href="manage_account.php"><img src="../icons/manage_account.png" alt="" class="custom_icon"><span>Manage Account</span></a></li>
                        <li><a style="font-size: 12px; color: white;" class="dropdown-item" href="#"><img src="../icons/help.png" alt="" class="custom_icon"><span>Help</span></a></li>

                        <li id="FeedbackBtn"><a style="font-size: 12px; color: white;" class="dropdown-item" href="#"><i class="bi bi-chat" style="margin-right: 10px; font-size: 15px; color: black"></i><span>Feedback</span></a></li> <!--button for feedback modal -->
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
        <div class="main-content">
            <div class="container-fluid">
                <p class="text-main">HOME</p>
            </div>
            <div class=" row search-by">
                <div class="dropdown col-md-4">
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

                <div class="search-input col-md-8 d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search Books" aria-label="Search" autocomplete="off">
                    <button>Search</button>
                </div>

            </div>

            <div class="container new-books">
                <div id="book-section">
                    <h6>New Arrivals</h6>
                </div>
                <div class="container" style="box-shadow: 0px 4px 8px rgba(91, 3, 3, 0.26)">
                    <div class="swiper mySwiper">
                        <div class="book-container-new swiper-wrapper" style="padding: 20px">
                            <?php foreach ($book as $books) { ?>
                                <div class="custom_book_container d-flex flex-column align-items-center justify-content-center swiper-slide">
                                    <p class="custom-book-text" style="background-color: #FFB93E; padding: 5px 0px 5px 20px; margin-top: -20px; width: 100px; font-size: 8px; color: white">
                                        OUT OF STOCK
                                    </p>
                                    <img src="../book_img/<?php echo $books['book_img']; ?>" alt="" class="custom-book-img">
                                    <div style="width: 100%; height: 30px; margin-top: 10px;" class="d-flex align-items-center  flex-column">
                                        <p style="font-size: 12px; text-align: center" class="custom-book-text"><?php echo $books['book_title']; ?></p>
                                        <p style="margin-top: -20px; font-size: 8px;" class="custom-book-text"><?php echo $books['author']; ?></p>
                                    </div>
                                    <div style="width: 100%; margin-top: 10px;" class="d-flex justify-content-center">
                                        <button data-bs-toggle="modal" data-bs-target="#bookModal" data-book-id="<?php echo $books['book_id']; ?>" style="font-size: 10px; width: 80%; border: 1px solid black" class="btn btn-view-book">View Book</button>

                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>


            <div class="container new-books">
                <div id="book-section">
                    <h6>Recommendations</h6>
                </div>
                <div class="container d-flex flex-column" style="box-shadow: 0px 4px 8px rgba(91, 3, 3, 0.26); width: 100%;">
                    <div class="book-container-new swiper-wrapper d-flex flex-wrap mt-5"> <!-- Use flex-wrap to allow elements to wrap -->
                        <?php foreach ($book as $books) { ?>
                            <div class="custom_book_container mb-5 d-flex flex-column align-items-center justify-content-center swiper-slide">
                                <p class="custom-book-text" style="background-color: #FFB93E; padding: 5px 0px 5px 20px; margin-top: -20px; width: 100px; font-size: 8px; color: white">OUT OF STOCKS</p>
                                <img src="../book_img/<?php echo $books['book_img']; ?>" alt="" class="custom-book-img" style="">
                                <div style="width: 100%; height: 30px; margin-top: 10px;" class="d-flex align-items-center  flex-column">
                                    <p style="font-size: 12px" class="custom-book-text"><?php echo $books['book_title']; ?></p>
                                    <p style="margin-top: -20px; font-size: 8px;" class="custom-book-text"><?php echo $books['author']; ?></p>
                                </div>
                                <div style="width: 100%; margin-top: 10px;" class="d-flex justify-content-center">
                                    <button data-bs-toggle="modal" data-book-id="<?php echo $books['book_id']; ?>" style="font-size: 10px; width: 80%; border: 1px solid black" class="btn btn-view-book">View Book</button>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>

    </div>


    <!-- View Modal -->
    <div class="modal fade " id="bookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-size: 10px;" class="modal-title" id="exampleModalLabel">BOOK INFORMATION</h5>
                    <button style="font-size: 8px;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div id="img_container_vw" style=" display: flex; align-items: center">
                            <div id="img_container_vw_2" style="display: flex; justify-content: center; align-items: center; width: 30%; height: 300px; overflow: hidden;">
                                <img id="book-pic" style="width: 190px;" src="../book_img/book1.jpg " alt="">
                            </div>
                            <div id="img_container_vw_3" style="width: 70%;height: 300px;">
                                <div class="row" style="display: flex; flex-wrap: wrap;height: 70px">
                                    <label for="book_id"></label><input type="text" id="book_id" style="display: none">
                                    <div class="col col-md-6" style=" height: 80px; display: flex; flex-wrap: wrap; overflow: hidden">
                                        <label style="font-size: 10px; font-weight: bold; padding: 0" for="vw_bookTitle">Book Title:</label>
                                        <input style="width: 200px; height: 17px; font-size: 10px; margin-top: -2px; padding: 0px 5px; border: none; outline: none" type="text" id="vw_bookTitle" readonly>
                                        <label style="font-size: 10px; font-weight: bold; padding: 0" for="vw_bookAuthor">Author:</label>
                                        <input style="width: 200px; height: 17px; font-size: 10px; margin-top: -2px; padding: 0px 5px; border: none; outline: none" type="text" id="vw_bookAuthor" readonly>
                                        <label style="font-size: 10px; font-weight: bold; padding: 0" for="vw_bookGenre">Genre:</label>
                                        <input style="width: 200px; height: 17px; font-size: 10px; margin-top: -2px; padding: 0px 5px; border: none; outline: none" type="text" id="vw_bookGenre" readonly>
                                    </div>
                                    <div class="col col-md-6" style="height: 80px; display: flex; flex-wrap: wrap; overflow: hidden">
                                        <label style="font-size: 10px; font-weight: bold; padding: 0" for="vw_bookShelf">Shelf:</label>
                                        <input style="width: 200px; height: 17px; font-size: 10px; margin-top: -2px; padding: 0px 5px; border: none; outline: none" type="text" id="vw_bookShelf" readonly>
                                        <label style="font-size: 10px; font-weight: bold; padding: 0" for="vw_bookPublisher">Publisher:</label>
                                        <input style="width: 200px; height: 17px; font-size: 10px; margin-top: -2px; padding: 0px 5px; border: none; outline: none" type="text" id="vw_bookPublisher" readonly>
                                        <label style="font-size: 10px; font-weight: bold; padding: 0" for="vw_bookStatus">Status:</label>
                                        <input style="width: 200px; height: 17px; font-size: 10px; margin-top: -2px; padding: 0px 5px; border: none; outline: none" type="text" id="vw_bookStatus" readonly>
                                    </div>
                                </div>
                                <div class="row" style="display: flex; flex-wrap: wrap;height: 200px; width: 100%; padding: 10px 15px;">
                                    <label style="font-size: 10px; font-weight: bold; padding: 0;" for="vw_bookDescription">Description:</label>
                                    <textarea style="resize: none; width: 100%; height: 100%; font-size: 10px; padding: 10px 10px; margin-bottom: 20px; border: none; outline: none" type="text" id="vw_bookDescription" readonly></textarea>

                                </div>

                                <div class="row vw_btns_borrow_reserve" style="display: flex; flex-wrap: wrap; height: 30px; width: 550px;">
                                    <button data-bs-toggle="modal" data-bs-target="#borrowModal" type="button" class="btn btn-secondary borrow-button">Borrow</button>
                                    <button data-bs-toggle="modal" data-bs-target="#reserveModal" data-user-id="<?php echo $_SESSION['user_id']; ?>" id="reserveBookBtn" type="button" class="btn btn-secondary reserve-button">Reserve</button>
                                    <img src="../icons/heart.png" alt="" style="width: 20px">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Borrow Modal -->
    <div class="modal fade " id="borrowModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-size: 10px;" class="modal-title" id="exampleModalLabel">BORROWING CREDENTIALS</h5>
                    <button style="font-size: 8px;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div id="img_container_borrow" style="width: 100%; height: 330px; text-align: center">
                            <div style="width: 100%; display: flex; justify-content: center;"><img src="../icons/confirmation.png" alt="" style="width: 80px;height: 80px"></div>
                            <div style="font-size: 14px; letter-spacing: 0.2px; width: 100%; color: #711717; display: flex; justify-content: center;">
                                <p style="font-style: italic; font-weight: 700;">Confirmation</p>
                            </div>
                            <div style="font-size: 12px; width: 100%; display: flex; justify-content: center;">
                                <p style="font-weight: 700;">Would you like to borrow <span id="book_title"></span>
                                    by <span id="book_author"></span>   ?</p>
                            </div>

                            <div style="font-size: 12px; width: 100%; display: flex; justify-content: center;">
                                <p style="padding: 5px 0px; font-weight: 700;">Borrowed Date: &nbsp;&nbsp;</p>
                                <span>
                                    <label for="date_borrowed_vw"></label>
                                    <input name="date_for_borrow" id="date_borrowed_vw" style="padding: 2px 10px;" type="date" required>
                                </span>
                            </div>

                            <div style="font-size: 12px; width: 100%; display: flex; justify-content: center;">
                                <p style="padding: 5px 0px; font-weight: 700;">Due Date: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                                <span>
                                    <label for="date_due_vw"></label>
                                    <input name="date_for_due" id="date_due_vw" style="padding: 2px 10px;" type="date" required>
                                </span>
                            </div>
                            <div style="font-size: 12px; width: 100%; display: flex; justify-content: center;">
                                <p style="padding: 5px 0px; font-weight: 700;">
                                    <button data-bs-dismiss="modal" type="button" style="width: 100px; margin: 0px 20px; font-weight: bold; border-radius: 5px; padding: 10px; color: #711717; background-color: transparent; border: 1px solid #711717">Cancel</button>
                                    <button data-bs-toggle="modal" class="barrow_confirm_btn" data-user-id="<?php echo $_SESSION['user_id']; ?>" id="confirmBorrowBookBtn" type="button" style="width: 100px; font-weight: bold; border-radius: 5px; padding: 10px; color: white; background-color: #740000; border: 1px solid #711717">Confirm</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Borrow Confirmation Modal -->
    <div class="modal fade " id="borrowConfirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-size: 10px;" class="modal-title" id="exampleModalLabel">BORROWING CREDENTIALS</h5>
                    <button style="font-size: 8px;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="img_container_borrow" style="width: 100%; height: 330px">
                        <div style="width: 100%; display: flex; justify-content: center;"><img src="../icons/confirmation.png" alt="" style="width: 80px;height: 80px"></div>
                        <div style=" font-size: 14px; letter-spacing: 0.2px ;width: 100%; color: #711717;display: flex; justify-content: center;">
                            <p style="font-style: italic; font-weight: 700;">Confirmation</p>
                        </div>
                        <div style="font-size: 12px; width: 100%;display: flex; justify-content: center;">
                            <p style=" width: 60ch; font-size: 10px;text-align:center;font-weight: 700;">Please return the book before or on MM/DD/YYYY, 5:00 PM at the Campus Library. Penalties will be given once it is overdue, including a daily late fee of Php X and a suspension of borrowing privileges until the book is returned. Please proceed to the Library for pickup.</p>
                        </div>
                        <div style="font-size: 12px; width: 100%;display: flex; justify-content: center;">
                            <p style="padding: 5px 0px; font-weight: 700;">
                                <button data-bs-dismiss="modal" type="button" style="width: 100px; margin: 0px 20px; font-weight: bold; border-radius: 5px; padding:  10px; color: #711717; background-color: transparent; border: 1px solid #711717">Close</button>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Reserve Modal -->
    <div class="modal fade " id="reserveModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-size: 10px;" class="modal-title" id="exampleModalLabel">RESERVING CREDENTIALS</h5>
                    <button style="font-size: 8px;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div id="img_container_borrow" style="width: 100%; height: 330px">
                            <div style="width: 100%; display: flex; justify-content: center;"><img src="../icons/reserve.png" alt="" style="width: 80px;height: 80px"></div>
                            <div style="font-size: 14px; letter-spacing: 0.2px; width: 100%; color: #711717; display: flex; justify-content: center;">
                                <p style="font-style: italic; font-weight: 700;">RESERVE BOOK</p>
                            </div>
                            <div style="font-size: 12px; width: 100%; display: flex; justify-content: center; height: 70px">
                                <div class="row d-flex justify-content-center">
                                    <div class="col col-md-6 " style="overflow: hidden;">
                                        <p style=" margin-left: 50px; width: 40ch; overflow: hidden; padding: 5px 0px; font-weight: 700;">Book Title: &nbsp;&nbsp; <span id="reserveBookTitle"></span></p>
                                        <p style="margin-left: 50px; width: 40ch; overflow: hidden; padding: 0px 0px; font-weight: 700;">Author: &nbsp;&nbsp; <span id="reserveBookAuthor"></span></p>
                                    </div>
                                    <div class="col col-md-6" style="overflow: hidden;">
                                        <p style="margin-left: 50px; width: 40ch; overflow: hidden; padding: 5px 0px; font-weight: 700;">Genre: &nbsp;&nbsp; <span id="reserveBookGenre"></span></p>
                                        <p style="margin-left: 50px;width: 40ch; overflow: hidden; padding: 0px 0px; font-weight: 700;">Publisher: &nbsp;&nbsp; <span id="reserveBookPublisher"></span></p>

                                    </div>
                                </div>
                            </div>

                            <div style="font-size: 12px; width: 100%; display: flex; align-content: center;">
                                <p style="padding: 5px 0px; margin-left: 100px; font-weight: 700;">Reservation Date: &nbsp;&nbsp;</p>
                                <span>
                                    <label for="date_reserve_vw"></label>
                                    <input name="date_reserve_vw" id="date_reserve_vw" style="padding: 2px 10px;" type="date" required min="<?php echo date('Y-m-d'); ?>" onchange="updateReturnDateConstraints()">
                                </span>
                            </div>
                            <div style="font-size: 12px; width: 100%; display: flex; align-content: center;">
                                <p style="padding: 5px 0px; margin-left: 100px; font-weight: 700;">Return Date: &nbsp;&nbsp;</p>
                                <span>
                                    <label for="date_return_vw"></label>
                                    <input name="date_return_vw" id="date_return_vw" style="margin-left: 30px;padding: 2px 10px;" type="date" required>
                                </span>
                            </div>
                            <div style="font-size: 12px; width: 100%; display: flex; justify-content: center;">
                                <p style="padding: 5px 0px;  font-weight: 700;">
                                    <button data-bs-dismiss="modal" type="button" style="width: 100px; margin: 0px 20px; font-weight: bold; border-radius: 5px; padding: 10px; color: #711717; background-color: transparent; border: 1px solid #711717">Cancel</button>
                                    <button data-bs-toggle="modal" id="reserveConfirmBtn" class="barrow_confirm_btn" type="button" style="width: 100px; font-weight: bold; border-radius: 5px; padding: 10px; color: white; background-color: #740000; border: 1px solid #711717">Confirm</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Feedback Modal -->
    <div class="modal fade " id="feedbackModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="" method="post">

                        <input type="text" id="user_id" data-user-id="<?= $_SESSION['user_id'];  ?>" style="display: none;">
                        <div style="width: 100%; height: 300px">
                            <div style="font-size: 14px; letter-spacing: 0.2px; width: 100%; color: #711717; display: flex; justify-content: center; margin-top: 30px">
                                <p style="font-style: italic; font-weight: 700;">FEEDBACK</p>
                            </div>
                            <div style="font-size: 30px; width: 40%; display: flex; justify-content: center; height: 70px; margin-left: 30%;">
                                <div class="rating">
                                    <i class="bi bi-star" data-index="0"></i>
                                    <i class="bi bi-star" data-index="1"></i>
                                    <i class="bi bi-star" data-index="2"></i>
                                    <i class="bi bi-star" data-index="3"></i>
                                    <i class="bi bi-star" data-index="4"></i>
                                </div>
                            </div>
                            <p style="padding: 5px 0px; margin-left: 117px; font-weight: 700; font-size:12px;">Tell us what can be improved! Thank you!</p>
                            <div style="font-size: 12px; width: 85%; display: flex; align-content: center; margin-left:35px;">
                                <textarea id="feedbackComment" type="text" rows="6" class="form-control" aria-describedby="inputGroupPrepend" style="font-size: 10px; resize: none;" required></textarea>
                            </div>
                        </div>
                        <div style="font-size: 12px; width: 100%; display: flex; justify-content: center;">
                            <button data-bs-dismiss="modal" type="button" style="width: 95px; margin: 0px 20px; font-weight: bold; border-radius: 5px; padding: 8px; color: #711717; background-color: transparent; border: 1px solid #711717">CANCEL</button>
                            <button id="submitFeedbackBtn" class="feedback_submit_btn" type="button" style="width: 95px; font-weight: bold; border-radius: 5px; padding: 8px; color: white; background-color: #740000; border: 1px solid #711717">SUBMIT</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>

    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../node_modules/swiper/swiper-bundle.min.js"></script>
    <script src="../node_modules/chart.js/dist/chart.umd.js"></script>
    <script>
        $(document).ready(function() {
            $('.btn-view-book').click(function(e) {
                e.preventDefault();

                // Get the book_id from the data attribute
                var bookId = $(this).data('book-id');

                // Make an AJAX request to fetch Book data
                $.ajax({
                    url: '../operations/fetch_book.php', // Replace with your backend endpoint
                    type: 'POST',
                    data: {
                        bookId: bookId
                    },
                    dataType: 'json',
                    success: function(response) {
                        // Log the response to inspect the structure
                        console.log(response);

                        // Handle the response and populate your modal with data
                        populateModal(response);
                    },
                    error: function() {
                        // Handle errors
                        console.error('Error fetching Book data.');
                    }
                });
            });

            function populateModal(data) {
                // Log the data to inspect the structure
                console.log(data);

                // Populate the modal fields with data received from the server
                $('#vw_bookTitle').val(data[0].book_title);
                $('#vw_bookAuthor').val(data[0].author);
                $('#vw_bookGenre').val(data[0].genre);
                $('#vw_bookShelf').val(data[0].shelf);
                $('#vw_bookPublisher').val(data[0].publisher);
                ``
                $('#vw_bookStatus').val(data[0].status);
                $('#vw_bookDescription').val(data[0].description);
                $('#book_id').val(data[0].book_id);

                var imagePath = '../book_img/' + data[0].book_img;
                $('#book-pic').attr('src', imagePath);

                // Show the modal
                $('#bookModal').modal('show');
            }
        });


        // Function to handle adding a student
        function addStudent() {
            // Add your logic here
            $("#bookModal").modal("hide");
        }
    </script>
    <script>
        const listItems = document.querySelectorAll('.user-nav .nav-item');
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
        var swiper = new Swiper(".mySwiper", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: true,
            },
            pagination: {
                el: ".swiper-pagination",
            },
            initialSlide: 3,
        });
    </script>




    <script src="../js/borrow_book.js"></script>
    <script src="../js/reserve_book.js"></script>
    <script src="../js/add_feedback.js"></script>
    <script>
    function updateReturnDateConstraints() {
        // Get the selected reservation date
        const reservationDate = new Date(document.getElementById('date_reserve_vw').value);

        // Calculate the minimum allowed return date (the selected reservation date)
        const minReturnDate = reservationDate.toLocaleDateString('en-CA'); // 'en-CA' for 'YYYY-MM-DD' format

        // Calculate the maximum allowed return date (3 days from the reservation date)
        const maxReturnDate = new Date(reservationDate);
        maxReturnDate.setDate(maxReturnDate.getDate() + 2);

        // Format the min and max return dates in the required format (YYYY-MM-DD)
        const formattedMinReturnDate = minReturnDate;
        const formattedMaxReturnDate = maxReturnDate.toLocaleDateString('en-CA');

        // Set the min and max attributes of the return date input
        document.getElementById('date_return_vw').setAttribute('min', formattedMinReturnDate);
        document.getElementById('date_return_vw').setAttribute('max', formattedMaxReturnDate);
    }

    // Call the function initially to set initial constraints
    updateReturnDateConstraints();
</script>



</body>

</html>
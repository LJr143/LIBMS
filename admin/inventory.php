<?php
session_start();
require_once '../db_config/config.php';
include '../includes/authentication.php';
include '../includes/fetch_staff_data.php';
include '../includes/fetch_books_data.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$loggedAdmin = '';

$database = new Database();
$userAuth = new UserAuthentication($database);
$userData = new StaffData($database);
$booksData = new BookData($database);
$books = $booksData->getAllBook();
$numberBooks = $booksData->getNumberOfBooks();

$totalBooks = count($books);
$booksPerPage = 9;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$totalPages = ceil($totalBooks / $booksPerPage);

$startIndex = ($currentPage - 1) * $booksPerPage;
$endIndex = min($startIndex + $booksPerPage - 1, $totalBooks - 1);

$rowCount = min(3, ceil($booksPerPage / 3));
$colCount = min(3, ceil($booksPerPage / $rowCount));

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

    $adminID = $userData->getStaffIdByUsername($adminUsername);
    if (!empty($adminID)) {
        $admin = $userData->getStaffById($adminID);
        if (!empty($admin)) {
            $loggedAdmin = $admin[0];
           $_SESSION['loggedAdminID'] = $loggedAdmin['admin_id'];
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
    <link rel="stylesheet" href="../css/admin_inventory.css">
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
                        <img style="border: 3px solid white; width: 60px; height: 60px; border-radius: 60px;" src="../img/<?= $loggedAdmin['img'] ?>" alt="">
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
                        <p style="font-size: 10px; font-weight: 700; margin: 14px">HOME | INVENTORY</p>
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
                                <img src="../img/<?= $loggedAdmin['img'] ?>" alt="" width="35px" height="35px" style="border-radius: 60px; border: 1px solid #4d0202">
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
                    <div style="width: 95%; height: 40px;border-radius: 5px; display: flex; align-items: center; ">
                        <div class="col col-md-10" style="display: flex; align-items: center;">
                            <input id="select_all_book" type="checkbox">
                            <label style="font-size: 12px; font-weight: 600; margin-left: 5px" for="select_all_book">Select All</label>

                            <div class="search_by" style="margin-left: 40px;">
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
                                <input type="search" class="search-input" placeholder="Search Book">
                            </div>
                        </div>
                        <div class="col col-md-2" style="display: flex; align-items: center; justify-content: flex-end;">
                            <button style="width: 30px; border: none; background: transparent;"><img style="width: 25px; margin-right: 20px;" src="../icons/download_icon.png" alt=""></button>
                            <button data-bs-toggle="modal" data-bs-target="#addBookModal" style="font-size: 12px; width: 150px; height: 30px; border-radius: 5px; background-color: rgb(128,0,0); color: white; border: none">ADD BOOK</button>
                        </div>
                    </div>
                </div>
                <div style="display: flex; justify-content: center;">
                    <div style="width: 95%; min-height: 100vh; margin-top: 10px; ">
                        <?php
                        for ($row = 0; $row < $rowCount; $row++) {
                            if ($totalBooks == 0) {
                                break;
                            }
                        ?>
                            <div class="col col-md-12" style="background: rgb(255,255,255); height: 38vh; border-radius: 5px; box-shadow: 0px 4px 8px rgba(0,0,0,0.2); display: flex; align-items: center; padding: 15px 5px 15px 15px; margin: 20px 0px 0px 0px;">
                                <?php
                                for ($col = 0; $col < $colCount; $col++) {
                                    $bookIndex = $startIndex + ($row * $colCount) + $col;
                                    if ($bookIndex <= $endIndex) {
                                        $book = $books[$bookIndex];
                                ?>
                                        <div class="card" style="width: 25rem; height: 250px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26); margin: 0px 10px 0px 0px;">
                                            <div class="card-body">
                                                <h6 class="card-title"><input type="checkbox"></h6>
                                                <div style="width: 100%; height: 21vh; display: flex;">
                                                    <div style=" height: 21vh; width: 138px; overflow: hidden ">
                                                        <img style="width: 97px" src="../book_img/<?php echo $book['book_img']; ?>" alt="">
                                                    </div>
                                                    <div style="width: 100%; height: 21vh; margin-left: 15px; ">
                                                        <h6 style="font-size: 12px; font-weight: 700; font-style: italic"><?php echo ucwords(strtolower($book['book_title'])); ?></h6>
                                                        <div class="book_information_inventory" style="display: flex;">
                                                            <div>
                                                                <!-- book author -->

                                                                <p><?php echo ucfirst ($book['author'] )?></p>
                                                                <p>Status: <span style="color: green; font-weight: 700"><?php echo $book['status'] ?></span></p>

                                                            </div>
                                                            <div style="margin-left: 20px">
                                                                <p><?php echo ucfirst($book['genre']); ?></p>
                                                                <p>Shelf: <span style="color: #711717; font-weight: 700"><?php echo ucfirst($book['shelf']) ?></span></p>
                                                            </div>
                                                        </div>
                                                        <div style="line-height: 15px; font-size: 10px; padding: 0px 0px 0px 5px; overflow: hidden; height: 110px;">
                                                            <p>Description:</p>
                                                            <p style="margin-top: -15px;"><?php echo ucfirst( $book['description']); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="width: 96px; height: 18px; display: flex; justify-content: center; padding: 2px 0px 0px 0px;">
                                                    <p style="font-size: 10px; font-weight: 600">Copies Left: <?php echo $book['copy'] ?></p>
                                                </div>
                                                <div style="display: flex; justify-content: flex-end;">
                                                    <button class="editBook" data-book-id="<?= $book['book_id']; ?>" data-book-name="<?= $book['book_title']; ?>" style="border: none; background: transparent; margin-right: 15px;"><img style="width: 17px" src="../icons/edit_profile_icon.png" alt=""></button>
                                                    <button class="deleteBook" style="border: none; background: transparent" ; data-book-id="<?= $book['book_id']; ?>" data-book-name="<?= $book['book_title']; ?>"><img style="width: 20px" src="../icons/delete_book_inventory.png" alt=""></button>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        <?php
                        }
                        ?>
                        <div style="margin-top: 30px; display: flex; width: 100%;">
                            <div style="width: 200px;">
                                <ul class="pagination">
                                    <?php for ($page = 1; $page <= $totalPages; $page++) { ?>
                                        <li class="page-item <?php echo ($currentPage == $page) ? 'active' : ''; ?>">
                                            <a class="page-link" href="?page=<?php echo $page; ?>"><?php echo $page; ?></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <?php
                            if ($totalBooks != 0) {

                            ?>
                                <div style="display: flex; justify-content: flex-end; width: 100%; font-size: 10px;  ">
                                    <button style="color: #800000;font-weight: 700; border-radius: 5px; border: 1px solid #740000; width: 100px; height: 28px; background: transparent; margin-right: 35px;">CANCEL</button>
                                    <button id="deleteAllBook" style="color: #800000;font-weight: 700; border-radius: 5px; border: 1px solid #740000; width: 100px; height: 28px; background: transparent; ">DELETE ALL</button>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>


            </div>


        </div>
    </div>

    <!-- Add book Modal -->
    <div class="modal fade " id="addBookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="height: 15px;">
                    <p class="modal-title" id="borrowModalLabel " style="font-size: 12px; color: #800000; font-weight: 600;">
                        <i class="bi bi-pencil-square ml-3 m-3" style="font-size: 16px; color: #800000;"></i>ADD BOOK
                    </p>
                    <button style="font-size: 8px;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid " style="padding-left: 40px ; padding-right: 40px">
                        <div class="row">

                            <!-- add new photo -->
                            <div style="width: 180px; height:220px; background-color:ghostwhite">
                                <div class="col-md-2" style="margin-bottom: 0px; margin-left: 8px;">
                                    <label for="profilePictureInput" style="display: block; cursor: pointer; text-decoration: underline; margin-top: 5px; margin-left:35px; margin-top:50px;">
                                        <!-- Icon for adding an image -->
                                        <i class="bi bi-plus" style="font-size: 60px; color:#711717;" id="addImageIcon"></i>
                                        <input type="file" id="profilePictureInput" style="display: none;" accept="image/*" onchange="updateProfilePicture(event)">
                                    </label>
                                    <img id="displayBookPicture" src="" alt="" style="max-width: 150px; max-height: 230px;">
                                </div>
                            </div>


                            <!-- input details -->
                            <form id="AddBookDisplay" class="row needs-validation" style="width: 70%; height: 65%;" novalidate>
                                <div class="col-md-3 firstname">
                                    <label for="bookBookID" class="form-label mb-0" style="font-size: 12px;">BOOK ID</label>
                                    <input type="text" class="form-control" placeholder="BK20210001" pattern="^[0-9A-Za-z]+$" id="bookBookID" style="font-size: 10px; text-transform: capitalize !important;" required>
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid book ID!
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="bookBookTitle" class="form-label mb-0" style="font-size: 12px;">BOOK TITLE</label>
                                    <input type="text" class="form-control" placeholder="Programming 1" id="bookBookTitle"  style="font-size: 10px; text-transform: capitalize !important;" required>
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid book title!
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="bookGenre" class="form-label mb-0" style="font-size: 12px;">GENRE</label>
                                    <select class="form-select" id="bookGenre" style="font-size: 10px; text-transform: capitalize !important;" required>
                                        <option value="" disabled selected>Select Genre</option>
                                        <option value="Fiction">Fiction</option>
                                        <option value="Non-Fiction">Non-Fiction</option>
                                    </select>
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid genre!
                                    </div>
                                </div>


                                <div class="col-md-6 mt-2">
                                    <label for="bookBookAuthor" class="form-label mb-0" style="font-size: 12px;">BOOK AUTHOR</label>
                                    <input type="text" class="form-control" placeholder="Programming 1" id="bookBookAuthor"  style="font-size: 10px; text-transform: capitalize !important;" required>
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid book author!
                                    </div>
                                </div>

                                <div class="col-md-3 mt-2">
                                    <label for="bookISBN" class="form-label mb-0" style="font-size: 12px;">ISBN</label>
                                    <input type="text" class="form-control" placeholder="1234567891111" pattern="[0-9]{13}" id="bookISBN" style="font-size: 10px; text-transform: capitalize !important;" required>
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid format of 13 digits!
                                    </div>
                                </div>

                                <div class="col-md-3 mt-2">
                                    <label for="bookCopies" class="form-label mb-0" style="font-size: 12px;">COPIES</label>
                                    <input type="text" class="form-control" id="bookCopies" pattern = "[0-9]+" placeholder="1" style="font-size: 10px;" required>
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid format 1 !
                                    </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                    <label for="bookShelf" class="form-label mb-0" style="font-size: 12px; ">SHELF</label>
                                    <input type="text" class="form-control" placeholder="Circulation Module" id="bookShelf"  style="font-size: 10px; text-transform: capitalize !important;" required>
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid shelf!
                                    </div>
                                </div>


                                <div class="col-md-4 mt-2">
                                    <label for="bookPublishers" class="form-label mb-0" style="font-size: 12px;">PUBLISHERS</label>
                                    <div class="input-group has-validation">
                                        <input type="text" class="form-control" placeholder="SITS Corp." id="bookPublishers"  style="font-size: 10px; text-transform: capitalize !important;" required>
                                        <div class="invalid-feedback" style="font-size: 8px">
                                            Not a valid publishers!
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mt-2">
                                    <label for="bookCategory" class="form-label mb-0" style="font-size: 12px;">CATEGORY</label>
                                    <div class="input-group has-validation">
                                        <select name="" id="bookCategory" style="font-size: 10px; width: 130px; height: 28px; padding: 2px 5px; border-radius: 5px" required>
                                            <option value="">Select category</option>
                                            <option value="General Information">General Information</option>
                                            <option value="Filipiñiana">Filipiñiana </option>
                                            <option value="Educational">Educational</option>
                                            <option value="Video Tapes">Video Tapes</option>
                                            <option value="Special Education">Special Education</option>
                                            <option value="Usepiana">Usepiana</option>
                                            <option value="Others">Others</option>
                                        </select>
                                        <div class="invalid-feedback" style="font-size: 8px">
                                            Not a valid category!
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12 mt-2">
                                    <label for="bookSummary" class="form-label mb-0" style="font-size: 12px;">SUMMARY</label>
                                    <div class="input-group has-validation">
                                        <textarea type="text" rows="7" class="form-control" id="bookSummary" aria-describedby="inputGroupPrepend"  style="font-size: 10px; resize: none;" required>
                                    </textarea>
                                        <div class="invalid-feedback" style="font-size: 8px">
                                            Not a valid summary!
                                        </div>
                                    </div>
                                </div>

                                <div class=" wishlist-container  mt-4 mb-0 " style=" display: flex; justify-content: flex-end; width: 664px; ">
                                    <button style="height: 25px; width: 100px" type="button" class="clear shadow " onclick="clearPhoto()">CLEAR</button>
                                    <button style="height: 25px; width: 100px" type="button" id="addBookBtn" class="add shadow" >ADD</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- update book Modal -->
    <div class="modal fade " id="editBookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="height: 15px;">
                    <p class="modal-title" id="borrowModalLabel " style="font-size: 12px; color: #800000; font-weight: 600;">
                        <i class="bi bi-pencil-square ml-3 m-3" style="font-size: 16px; color: #800000;"></i>EDIT BOOK
                    </p>
                    <button style="font-size: 8px;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid " style="padding-left: 40px ; padding-right: 40px">
                        <div class="row">

                            <!-- uploading image -->
                            <div style="width:190px;">
                                <div class="col-md-2" style="margin-bottom: 0px; ">
                                    <label for="editprofilePictureInput" style="display: block; cursor: pointer; text-decoration: underline; margin-top: 5px;">


                                        <img id="edit-Book-Pic" src="" width="150px" height="230px" style="margin-left: -5px; margin-top: 0px;">

                                    </label>
                                    <input type="file" id="editprofilePictureInput" style="display: none;" accept="image/*" onchange="updateEditProfilePicture(event)">
                                </div>
                            </div>

                            <!-- input details -->
                            <form id="UpdateBookDisplay" class="row needs-validation" style="width: 70%; height: 65%;" novalidate>
                                <div class="col-md-3 firstname">
                                    <label for="editBookID" class="form-label mb-0" style="font-size: 12px;">BOOK ID</label>
                                    <input type="text" class="form-control" placeholder="1234-56789" pattern="[0-9]{4}-[0-9]{5}" id="editBookID" style="font-size: 10px; text-transform: capitalize !important;" readonly>
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid book ID!
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="editBookTitle" class="form-label mb-0" style="font-size: 12px;">BOOK TITLE</label>
                                    <input type="text" class="form-control" placeholder="Programming 1" id="editBookTitle"  style="font-size: 10px; text-transform: capitalize !important;" required>
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid book title!
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="editBookGenre" class="form-label mb-0" style="font-size: 12px;">GENRE</label>
                                    <select class="form-select" id="editBookGenre" style="font-size: 10px; text-transform: capitalize !important;" required>
                                        <option value="" disabled selected>Select Genre</option>
                                        <option value="Fiction">Fiction</option>
                                        <option value="Non-Fiction">Non-Fiction</option>
                                    </select>
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid genre!
                                    </div>
                                </div>


                                <div class="col-md-6 mt-2">
                                    <label for="editBookAuthor" class="form-label mb-0" style="font-size: 12px;">BOOK AUTHOR</label>
                                    <input type="text" class="form-control" placeholder="Programming 1" id="editBookAuthor"  style="font-size: 10px; text-transform: capitalize !important;" required>
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid book author!
                                    </div>
                                </div>

                                <div class="col-md-3 mt-2">
                                    <label for="editBookISBN" class="form-label mb-0" style="font-size: 12px;">ISBN</label>
                                    <input type="text" class="form-control" placeholder="1234567891111" pattern="[0-9]{13}" id="editBookISBN" style="font-size: 10px; text-transform: capitalize !important;" required>
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid format of 13 digits!
                                    </div>
                                </div>

                                <div class="col-md-3 mt-2">
                                    <label for="editBookCopies" class="form-label mb-0" style="font-size: 12px;">COPIES</label>
                                    <input type="text" class="form-control" id="editBookCopies" pattern = "[0-9]+"  placeholder="1" style="font-size: 10px;" required>
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid format 1 !
                                    </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                    <label for="editBookShelf" class="form-label mb-0" style="font-size: 12px; ">SHELF</label>
                                    <input type="text" class="form-control" placeholder="Circulation Module" id="editBookShelf"  style="font-size: 10px; text-transform: capitalize !important;" required>
                                    <div class="invalid-feedback" style="font-size: 8px">
                                        Not a valid shelf!
                                    </div>
                                </div>


                                <div class="col-md-4 mt-2">
                                    <label for="editBookPublishers" class="form-label mb-0" style="font-size: 12px;">PUBLISHERS</label>
                                    <div class="input-group has-validation">
                                        <input type="text" class="form-control" placeholder="SITS Corp." id="editBookPublishers"  style="font-size: 10px; text-transform: capitalize !important;" required>
                                        <div class="invalid-feedback" style="font-size: 8px">
                                            Not a valid publishers!
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mt-2">
                                    <label for="editBookCategory" class="form-label mb-0" style="font-size: 12px;">CATEGORY</label>
                                    <div class="input-group has-validation">
                                        <select name="" id="editBookCategory" style="font-size: 10px; width: 130px; height: 28px; padding: 2px 5px; border-radius: 5px" required>
                                         <option value="">Select category</option>
                                        <option value="General Information">General Information</option>
                                        <option value="Filipiñiana">Filipiñiana </option>
                                        <option value="Educational">Educational</option>
                                        <option value="Video Tapes">Video Tapes</option>
                                        <option value="Special Education">Special Education</option>
                                        <option value="Usepiana">Usepiana</option>
                                        <option value="Others">Others</option>
                                        </select>
                                        <div class="invalid-feedback" style="font-size: 8px">
                                            Not a valid category!
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12 mt-2">
                                    <label for="editBookSummary" class="form-label mb-0" style="font-size: 12px;">SUMMARY</label>
                                    <div class="input-group has-validation">
                                        <textarea type="text" rows="7" class="form-control" id="editBookSummary" aria-describedby="inputGroupPrepend"  style="font-size: 10px; resize: none;" required>
                                    </textarea>
                                        <div class="invalid-feedback" style="font-size: 8px">
                                            Not a valid summary!
                                        </div>
                                    </div>
                                </div>

                                <div class=" wishlist-container  mt-4 mb-0 " style=" display: flex; justify-content: flex-end; width: 664px; ">
                                    <button style="height: 25px; width: 100px" type="button" class="clear shadow" onclick="clearPhoto()">CLEAR</button>
                                    <button style="height: 25px; width: 100px"  type="button" id="updateBookBtn" class="add shadow" >SAVE</button>
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

    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../node_modules/swiper/swiper-bundle.min.js"></script>
    <script src="../node_modules/chart.js/dist/chart.umd.js"></script>
    <script>
        function updateBookPicture(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                const img = document.getElementById('displayBookPicture');
                const icon = document.getElementById('addImageIcon');

                reader.onload = function (e) {
                    img.src = e.target.result;
                    icon.style.display = 'none'; // Hide the icon
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script>

        function showDeleteConfirmation(id) {
            Swal.fire({
                title: 'ARE YOU SURE?',
                text: 'Do you really want to delete this book? Process cannot be undone.',
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
        $(document).ready(function() {
            $('.editBook').click(function(e) {
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
                $('#editBookID').val(data[0].book_id);
                $('#editBookTitle').val(data[0].book_title);
                $('#editBookGenre').val(data[0].genre);
                $('#editBookAuthor').val(data[0].author);
                $('#editBookISBN').val(data[0].ISBN);
                $('#editBookCopies').val(data[0].copy);
                $('#editBookShelf').val(data[0].shelf);
                $('#editBookPublishers').val(data[0].publisher);
                $('#editBookCategory').val(data[0].category);
                $('#editBookSummary').val(data[0].description);


                var imagePath = '../book_img/' + data[0].book_img;
                $('#edit-Book-Pic').attr('src', imagePath);

                // Show the modal
                $('#editBookModal').modal('show');
            }
        });


        // Function to handle adding a student
        function addBook() {
            // Add your logic here
            $("#editStudentModal").modal("hide");
        }

        // Function to clear the displayed photo
        function clearPhoto() {
            $('#ProfilePic').attr('src', '../img/me_sample_profile.jpg');
            $(".AddImageCon i").show();
        }

        // Function to update the profile picture
        function updateEditProfilePicture(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const profilePic = document.getElementById('edit-Book-Pic');
                    profilePic.src = e.target.result;

                    // Hide the icon when a new image is selected
                    $(".AddImageCon i").hide();
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script src='../js/logout_script.js'></script>
    <script src="../js/navbar_select.js"></script>
    <script src="../js/add_book.js"></script>
    <script src="../js/delete_book.js"></script>
    <script src="../js/update_book.js"></script>
    <script>
        // Prevent the dropdown from closing when clicking on the buttons
        function handleButtonClick(event) {
            event.stopPropagation();
        }
    </script>
</body>

</html>
<?php
session_start();
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
include 'C:\wamp64\www\LIBMS\operations\authentication.php';
include 'C:\wamp64\www\LIBMS\includes\fetch_staff_data.php';


error_reporting(E_ALL);
ini_set('display_errors', 1);

$loggedAdmin = '';

$database = new Database();
$userAuth = new UserAuthentication($database);
$userData = new StaffData($database);


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
        } else {
            echo 'Admin data not found.';
        }
    } else {
        echo 'Invalid admin ID.';
    }
}

include 'C:\wamp64\www\LIBMS\includes\fetch_borrow_data.php';
include 'C:\wamp64\www\LIBMS\includes\fetch_borrow_details.php';
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
    <link rel="stylesheet" href="../css/superadmin_report.css">
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
                        <img style="width: 60px; border-radius: 60px;" src="../img/me_sample_profile.jpg" alt="">
                    </div>
                    <div style="display: block; text-align: center; color: white; height: 20px;">
                        <ul style="margin-right: 36px;">
                            <li style="font-size: 12px; color: #0cb90c; font-weight: 600">Active</li>
                        </ul>
                    </div>
                </div>
                <div>
                    <ul class="menu_icon">
                        <li><img class="custom_menu_icon" src="../icons/dashboard_icon.png" alt=""><span><a href="dashboard.php">Dashboard</a></span></li>
                        <li><img class="custom_menu_icon" src="../icons/staff_icon.png" alt=""><span><a href="student.php">Student</a></span></li>
                        <li><img class="custom_menu_icon" src="../icons/reports_icon.png" alt=""><span><a href="report.php">Reports</a></span></li>
                        <li><img class="custom_menu_icon" src="../icons/logs_icon.png" alt=""><span><a href="logs.php">Logs</a></span></li>
                        <li><img class="custom_menu_icon" src="../icons/admin_inventory_menu.png" alt=""><span><a href="inventory.php">Inventory</a></span></li>

                </div>

            </div>
            <div class="col" style=" width: 100%; height: 100vh; ">
                <div style="background-color: white; width: 95%; height: 45px; margin: 15px; border-radius: 5px;display: flex; box-shadow: 0px 4px 8px rgba(0,0,0,0.27); align-content: center; align-items: center">
                    <div style="width: 90%">
                        <p style="font-size: 10px; font-weight: 700; margin: 14px">HOME | REPORT</p>
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

                                    <label for="logout"><img src="../icons/plug.png" style="width: 20px; " alt=""></label>
                                    <input id="logoutButton" style="font-size: 12px; color: white; background: none; border: none;" name="logout" type="submit" value="Logout">
                                </form>
                            </ul>
                        </div>
                    </div>
                </div>
                <div style="display: flex; justify-content: center; ">
                    <div style="background-color: white; width: 95%; height: 40px; margin: 0px; border-radius: 5px;display: flex;  align-items: center; align-content: center;">
                        <div style="width: 100%; display: flex; justify-content: space-between">
                            <button id="bookInventoryButton" style="background-color: white; font-size: 12px; width: 170px; height: 35px; border-radius: 5px; border: none; box-shadow: 0px 4px 8px rgba(0,0,0,0.27);"><img style="width: 20px;" src="../icons/book_inventory_report_icon.png" alt=""><span style="margin-left: 10px;">Book Inventory</span></button>
                            <button id="categoriesButton" style="background-color: white; font-size: 12px; width: 170px; height: 35px; border-radius: 5px; border: none; box-shadow: 0px 4px 8px rgba(0,0,0,0.27);"><img style="width: 20px;" src="../icons/categories_report_icon.png" alt=""><span style="margin-left: 10px;">Categories</span></button>
                            <button id="newUsersButton" style="background-color: white; font-size: 12px; width: 170px; height: 35px; border-radius: 5px; border: none; box-shadow: 0px 4px 8px rgba(0,0,0,0.27);"><img style="width: 20px;" src="../icons/newuser_report_icon.png" alt=""><span style="margin-left: 10px;">New Users/Visitors</span></button>
                            <button id="bookStatusButton" style="background-color: white; font-size: 12px; width: 170px; height: 35px; border-radius: 5px; border: none; box-shadow: 0px 4px 8px rgba(0,0,0,0.27);"><img style="width: 20px;" src="../icons/book_status_icon.png" alt=""><span style="margin-left: 10px;">Book Status</span></button>
                            <button id="bookBorrowButton" style="font-size: 12px; width: 170px; height: 35px; border-radius: 5px; border: none; box-shadow: 0px 4px 8px rgba(0,0,0,0.27);"><i class="bi bi-book custom_menu_icon" style="font-size: 20px;"></i><span style="margin-left: 10px;">Borrowed Books</span></button>
                        </div>
                        <div style="width: 40%; display: flex; justify-content: flex-end; align-items: center; height: 35px;">
                            <div style="margin-right: 50px;"> <button style="border: none; background-color: transparent;"><img style="width: 20px;" src="../icons/export_icon.png" alt=""></button></div>
                        </div>
                    </div>
                </div>
                <div style="display: flex; justify-content: center; width: 100%; height: 70px;">
                    <div style="width: 95%; height: 50px; margin: 10px 0 0 0; border-radius: 5px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.27);">
                        <div style="display: flex; align-items: center; justify-content: space-between; padding: 0 20px;">
                            <div class="input_search-wrapper">
                                <input type="search" class="search-input" placeholder="Search Book">
                            </div>
                            <form class="row g-2 mt-1" id="dateRangeForm">
                                <div class="col-auto">
                                    <div class="d-flex align-items-center">
                                        <label for="fromDate" class="form-label" style="margin-right: 10px; font-size: 13px;">From:</label>
                                        <input type="date" class="form-control" id="fromDate" style="height: 32px; font-size: 13px;" required>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="d-flex align-items-center">
                                        <label for="toDate" class="form-label" style="margin-right: 10px; font-size: 13px;">To:</label>
                                        <input type="date" class="form-control" id="toDate" style="height: 32px; font-size: 13px;" required>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-custom" onclick="checkDateRange()" style="background-color: #740000; color: #fff; width: 80px; height: 33px; font-size: 13px;">APPLY</button>

                                </div>
                            </form>
                        </div>
                        <div id="resultMessage" class="mt-3"></div>
                    </div>
                </div>

                <div style="display: flex; justify-content: center; width: 100%; height: 600px">
                    <div style="width: 95%; border-radius: 5px; margin-top: 10px; font-size: 12px; box-shadow: 0px 4px 8px rgba(0,0,0,0.13)">
                        <table style="width: 95%;" class="table text-center mx-auto" cellpadding="0">
                            <thead>
                                <tr style=" font-size: 12px;">
                                    <th>BOOK ID</th>
                                    <th>TITLE</th>
                                    <th>ISSUED TO</th>
                                    <th>BORROW DATE</th>
                                    <th>RETURN DATE</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody cellspacing="6" style=" font-size: 12px;">
                                <?php foreach ($borrowData->fetchBorrowData() as $borrow) : ?>
                                    <?php
                                    $book_id = $borrow['book_id'];
                                    $title = $borrow['book_title'];
                                    $issued_to = $borrow['fname'] . ' ' . $borrow['initial'] . ' ' . $borrow['lname'];
                                    $date_barrowed = $borrow['date_barrowed'];
                                    $date_return = $borrow['date_return'];
                                    ?>
                                    <tr class="mb-3 me-auto" style="margin-top: 20px; background-color: rgb(246,246,246); border: 1px solid rgba(0,0,0,0.25);">
                                        <td style="padding: 5px;"><?= $book_id; ?></td>
                                        <td style="padding: 5px;"><?= $title; ?></td>
                                        <td style="padding: 5px;"><?= $issued_to; ?></td>
                                        <td style="padding: 5px;"><?= $date_barrowed; ?></td>
                                        <td style="padding: 5px;"><?= $date_return; ?></td>
                                        <td style="padding: 5px;"> <button class="returnBtn" data-bs-toggle="modal" data-bs-target="#returnModal" data-book-id="<?= $book_id ?>" data-title="<?= $title ?>" data-issued-to="<?= $issued_to ?>" data-date-barrowed="<?= $date_barrowed ?>" data-date-return="<?= $date_return ?>" style="font-size: 12px; width: 150px; height: 25px; border-radius: 5px; background-color: #1FBA05; color: white; border: none">
                                                RETURN
                                            </button></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>


        </div>


    </div>
    </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="returnModal" tabindex="-1" role="dialog" aria-labelledby="returnModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document" style="max-width: 800px;">
            <div class="modal-content">
                <div class="modal-header" style="height: 15px;">

                    <p class="modal-title" id="borrowModalLabel " style="font-size: 12px; color: #800000; font-weight: 600;">
                        <i class="bi bi-pencil-square ml-3 m-3" style="font-size: 16px; color: #800000;"></i>BOOK RETURN
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
                            <div class="col-md-9 mt-4">
                                <label for="returnDate">Returned Date:</label>
                                <input type="date" id="returnDate" style=" height: 30px; font-size: 13px;" class="form-control mb-3" required>
                                <label for="fineAmount">Fine Amount:</label>
                                <input type="text" id="fineAmount" style=" height: 30px; font-size: 13px;" class="form-control mb-3" placeholder="Enter fine amount">
                            </div>
                        </div>

                        <div class="col-md-5">
                            <p>Shelf: <span id="shelf"></span></p>
                            <p>Publisher: <span id="publisher"></span></p>
                            <p>Due Date: <span id="dueDate"></span></p>
                            <div class="col-md-9 mt-4">
                                <label for="bookStatus">Book Status:</label>
                                <select class="form-select mb-3" style=" height: 30px; font-size: 13px;" id="bookStatus" required>
                                    <option value="status">book status</option>
                                    <option value="lost">Lost</option>
                                    <option value="damaged">Damaged</option>
                                    <option value="overdue">Overdue</option>
                                    <option value="returned">Returned</option>
                                    <option value="fine">Fine</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Buttons -->
                    <button style="margin-left: 70%; background-color:silver; color:#fff; height: 35px; font-size:13px" type="button" class="btn" data-bs-dismiss="modal">CANCEL</button>
                    <button style="margin-left: 10px; background-color:#740000; color:#fff; height: 35px; font-size:13px" type="button" class="btn" onclick="confirmReturn()">CONFIRM</button>
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


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js" integrity="sha512-JPcRR8yFa8mmCsfrw4TNte1ZvF1e3+1SdGMslZvmrzDYxS69J7J49vkFL8u6u8PlPJK+H3voElBtUCzaXj+6ig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/chart.js-plugin-labels-dv/dist/chartjs-plugin-labels.min.js"></script>
    <script src='../js/logout_script.js'></script>

    <script>
        // Wait for the document to be ready
        $(document).ready(function() {
            // Fetch data using AJAX
            $.ajax({
                url: 'http://localhost/LIBMS/includes/fetch_borrow_data.php?ajax=1',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log('Response:', response);

                    // Process the fetched data
                    if (response && response.length > 0) {
                        console.log('Data received:', response);

                        // Clear existing content in the container
                        $('#borrowDataContainer').empty();

                        // Iterate through the fetched data and append to the table
                        $.each(response, function(index, borrow) {
                            console.log('Processing row:', borrow);

                            var rowHtml = '<tr style="height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25);">' +
                                '<td>' + borrow.book_id + '</td>' +
                                '<td>' + borrow.title + '</td>' +
                                '<td>' + borrow.issued_to + '</td>' +
                                '<td>' + borrow.date_barrowed + '</td>' +
                                '<td>' + borrow.date_return + '</td>' +
                                '<td><button class="returnBtn" data-borrow-id="' + borrow.borrow_id + '" style="font-size: 12px; width: 150px; height: 25px; border-radius: 5px; background-color: #1FBA05; color: white; border: none">RETURN</button></td>' +
                                '</tr>';

                            $('#borrowDataContainer').append(rowHtml);
                        });
                    } else {
                        console.log('No data received.');
                    }
                },
                error: function(error) {
                    console.log('Error fetching data:', error);
                }
            });

        });
    </script>

    <script>
        function checkDateRange() {
            var fromDate = $('#fromDate').val();
            var toDate = $('#toDate').val();

            $.ajax({
                url: 'http://localhost/LIBMS/includes/fetch_borrow_details.php',
                type: 'POST',
                data: {
                    fromDate: fromDate,
                    toDate: toDate
                },
                success: function(response) {
                    $('#resultMessage').html(response);
                },
                error: function() {
                    $('#resultMessage').html('<div class="alert alert-danger">An error occurred.</div>');
                }
            });
        }
    </script>



    <script>
        // Get the buttons by their IDs
        const bookInventoryButton = document.getElementById('bookInventoryButton');
        const categoriesButton = document.getElementById('categoriesButton');
        const newUsersButton = document.getElementById('newUsersButton');
        const bookStatusButton = document.getElementById('bookStatusButton');

        // Define the page URLs for each button
        const pageUrls = {
            bookInventoryButton: 'report.php',
            categoriesButton: 'report_categories_inventory.php',
            newUsersButton: 'report_users_inventory.php',
            bookStatusButton: 'report_book_status_inventory.php',
            bookBorrowButton: 'report_book_return_inventory.php',
        };

        // Attach click event listeners to the buttons
        bookInventoryButton.addEventListener('click', () => {
            window.location.href = pageUrls.bookInventoryButton;
        });

        categoriesButton.addEventListener('click', () => {
            window.location.href = pageUrls.categoriesButton;
        });

        newUsersButton.addEventListener('click', () => {
            window.location.href = pageUrls.newUsersButton;
        });

        bookStatusButton.addEventListener('click', () => {
            window.location.href = pageUrls.bookStatusButton;
        });

        bookBorrowButton.addEventListener('click', () => {
            window.location.href = pageUrls.bookBorrowButton;
        });
    </script>

    <script>
        $(document).ready(function() {
            // Event listener for RETURN buttons
            $('.returnBtn').on('click', function() {
                // Extract data attributes
                var borrowId = $(this).data('borrow-id');

                // AJAX call to fetch data
                $.ajax({
                    url: 'http://localhost/LIBMS/includes/fetch_borrow_details.php',
                    method: 'POST',
                    data: {
                        borrowId: borrowId
                    },
                    dataType: 'json',
                    success: function(data) {
                        // Populate modal content with data from the fetched record
                        $('#studentId').text(data.user_id);
                        $('#studentName').text(data.full_name);
                        $('#studentCourse').text(data.course);
                        $('#studentYear').text(data.year);
                        $('#studentMajor').text(data.major);

                        $('#bookTitle').text(data.book_title);
                        $('#author').text(data.Author_id);
                        $('#borrowDate').text(data.date_barrowed);
                        $('#shelf').text(data.shelf);
                        $('#publisher').text(data.publisher);
                        $('#dueDate').text(data.date_return);
                        $('#bookStatus').val(data.status);

                        // Show the modal
                        $('#returnModal').modal('show');
                    },
                    error: function() {
                        console.error('Error fetching data');
                        // Handle error, show an alert, etc.
                    }
                });
            });
        });
    </script>

    <script>
        // Prevent the dropdown from closing when clicking on the buttons
        function handleButtonClick(event) {
            event.stopPropagation();
        }
    </script>

</body>

</html>
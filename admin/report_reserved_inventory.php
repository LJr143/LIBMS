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
$userData = new UserData($database);
$adminData = new StaffData($database);
$superAdminData = new SuperAdminData($database);



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
    <link rel="stylesheet" href="../css/superadmin_report.css">
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
                        <li class="active"><img class="custom_menu_icon" src="../icons/reports_icon.png" alt=""><span><a href="report.php">Reports</a></span></li>
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
                    <div style="background-color: white; width: 95%; height: 40px; margin: 0px; border-radius: 5px;display: flex;  align-items: center; align-content: center;">
                        <div style="width: 70%; display: flex; justify-content: space-between">
                            <button style="font-size: 12px; width: 170px; height: 35px; border-radius: 5px; border: none; box-shadow: 0px 4px 8px rgba(0,0,0,0.27);"><img style="width: 20px;" src="../icons/book_inventory_report_icon.png" alt=""><span style="margin-left: 10px;">Book Inventory</span></button>
                            <button style="background-color: white; font-size: 12px; width: 170px; height: 35px; border-radius: 5px; border: none; box-shadow: 0px 4px 8px rgba(0,0,0,0.27);"><img style="width: 20px;" src="../icons/categories_report_icon.png" alt=""><span style="margin-left: 10px;"><a href="report_categories_inventory.php" style="text-decoration: none; color: inherit;">Categories</a></span></button>
                            <button style="background-color: white; font-size: 12px; width: 170px; height: 35px; border-radius: 5px; border: none; box-shadow: 0px 4px 8px rgba(0,0,0,0.27);"><img style="width: 20px;" src="../icons/newuser_report_icon.png" alt=""><span style="margin-left: 10px;"><a href="report_users_inventory.php" style="text-decoration: none; color: inherit;">New Users/Visitors</a></span></button>
                            <button style="background-color: white; font-size: 12px; width: 170px; height: 35px; border-radius: 5px; border: none; box-shadow: 0px 4px 8px rgba(0,0,0,0.27);"><img style="width: 20px;" src="../icons/book_status_icon.png" alt=""><span style="margin-left: 10px;"><a href="report_book_status_inventory.php" style="text-decoration: none; color: inherit;">Book Status</a></span></button>
                            <button id="bookBorrowButton" style="background-color: white; font-size: 12px; width: 170px; height: 35px; border-radius: 5px; border: none; box-shadow: 0px 4px 8px rgba(0,0,0,0.27);"><i class="bi bi-book custom_menu_icon" style="font-size: 20px;"></i><span style="margin-left: 10px;"><a href="report_book_return_inventory.php" style="text-decoration: none; color: inherit;"> Borrowed Books</a></span></button>
                        </div>
                        <div style="width: 40%; display: flex; justify-content: flex-end; align-items: center; height: 35px;">
                            <div style="margin-right: 50px;"> <button id="printButton" style="border: none; background-color: transparent;"><img style="width: 20px;" src="../icons/export_icon.png" alt=""></button></div>
                        </div>
                    </div>
                </div>
                <div style="display: flex; justify-content: center; ">
                    <div style=" width: 95%; height: 500px; margin: 10px 0 0 0; border-radius: 5px; box-shadow: 0 4px 8px rgba(0,0,0,0.27);    ">
                        <div style=" margin: 20px 30px; display: flex">
                            <div style="width: 85%;">
                                <h6 style="font-size: 12px; font-weight: 700;">QUARTERLY REPORTS</h6>
                            </div>
                            <div style="width: 15%; display: flex; justify-content: flex-end">
                                <select name="" id="mySelect" style="font-size: 12px; width: 150px; padding: 2px 5px; border-radius: 5px">
                                    <option value="report.php">OVERALL</option>
                                    <option value="report_reserve_inventory.php">reserve</option>
                                    <option selected value="">RESERVED</option>
                                    <option value="report_returned_inventory.php">RETURNED</option>
                                    <option value="report_copies_inventory.php">BOOK COPIES</option>
                                </select>
                            </div>
                        </div>
                        <div style=" margin: 0px 30px; display: flex; height: 400px;">
                            <div style="width: 50%; height: 400px; display: flex; align-items: center; align-content: center; box-shadow: 0 4px 8px rgba(0,0,0,0.27); ">
                                <div style="width: 100%;height: 85%; margin: 0px 40px 0px 40px;">
                                    <canvas id="overallchart"></canvas>
                                </div>

                            </div>
                            <div style="width: 50%; height: 400px; overflow: hidden">
                                <div style="margin: 0px 0px; display: flex; flex-wrap: wrap;">
                                    <div style=" margin: 0px 0 0 50px; height: 40px; width: 450px; border-radius: 5px; background-color: #F3F3F3; display: flex; box-shadow: 0px 1px 6px rgba(0,0,0,0.15);">
                                        <div style="width: 80%; height: 40px; display: flex; align-items: center;margin-left: 20px; font-size: 12px; font-weight: bold">TOTAL BOOKS</div>
                                        <div style="width: 20%; height: 40px;display: flex; align-items: center;margin-left: 20px; font-size: 12px; font-weight: bold;"><?= $numberOfBooks = $bookData->getNumberOfBooks(); ?></div>
                                    </div>
                                    <div style="width: 90px; height: 40px; display: flex; justify-content: center; align-content: center; align-items: center">
                                        <select name="" id="" style="width: 70px; height: 25px; font-size: 12px; font-weight: 600; border-radius: 5px;">
                                            <option value="">Q1</option>
                                            <option value="">Q2</option>
                                            <option value="">Q3</option>
                                            <option value="">Q4</option>

                                        </select>
                                    </div>
                                    <div style=" margin: 15px 0 0 50px; height: 40px; width: 450px; border-radius: 5px; background-color: #FF0000; display: flex">
                                        <div style="width: 80%; height: 40px; display: flex; align-items: center;margin-left: 20px; font-size: 12px; font-weight: bold; color: white">RESERVED DAILY</div>
                                        <div style="width: 20%; height: 40px;display: flex; align-items: center;margin-left: 20px; font-size: 12px; font-weight: bold; color: white">0</div>
                                    </div>
                                    <div style=" margin: 15px 0 0 50px; height: 40px; width: 450px; border-radius: 5px; background-color: #B50000; display: flex">
                                        <div style="width: 80%; height: 40px;display: flex; align-items: center;margin-left: 20px; font-size: 12px; font-weight: bold; color: white">RESERVED WEEKLY</div>
                                        <div style="width: 20%; height: 40px;display: flex; align-items: center;margin-left: 20px; font-size: 12px; font-weight: bold; color: white">0</div>
                                    </div>
                                    <div style=" margin: 15px 0 0 50px; height: 40px; width: 450px; border-radius: 5px; background-color: #5A0202; display: flex">
                                        <div style="width: 80%; height: 40px;display: flex; align-items: center;margin-left: 20px; font-size: 12px; font-weight: bold; color: white">RESERVED WHOLE QUARTER</div>
                                        <div style="width: 20%; height: 40px;display: flex; align-items: center;margin-left: 20px; font-size: 12px; font-weight: bold; color: white">0</div>
                                    </div>
                                    <div style=" margin: 15px 0 0 50px; height: 40px; width: 450px; border-radius: 5px; background-color: #390000; display: flex">
                                        <div style="width: 80%; height: 40px;display: flex; align-items: center;margin-left: 20px; font-size: 12px; font-weight: bold; color: white">RESERVED REPORTS BY CATEGORY</div>
                                        <div style="width: 20%; height: 40px;display: flex; align-items: center;margin-left: 20px; font-size: 12px; font-weight: bold; color: white">
                                            <a href="report_reserved_inventory_category.php"><button style="border: none; background-color: transparent"><img style="width: 20px" src="../icons/go_to.png" alt=""></a></button>
                                        </div>
                                    </div>

                                </div>

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
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js" integrity="sha512-JPcRR8yFa8mmCsfrw4TNte1ZvF1e3+1SdGMslZvmrzDYxS69J7J49vkFL8u6u8PlPJK+H3voElBtUCzaXj+6ig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/chart.js-plugin-labels-dv/dist/chartjs-plugin-labels.min.js"></script>


    <script>
        const ctx = document.getElementById('overallchart').getContext('2d');

        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['First Quarter', 'Second Quarter', 'Third Quarter', 'Fourth Quarter'],
                datasets: [{
                        label: 'daily',
                        data: [40, 50, 60, 70],
                        backgroundColor: '#FF0000',
                        barThickness: 26,

                    },
                    {
                        label: 'weekly',
                        data: [200, 220, 230, 240],
                        backgroundColor: '#B50000',
                        barThickness: 26,

                    },
                    {
                        label: 'quarterly',
                        data: [260, 270, 280, 290],
                        backgroundColor: '#5A0202',
                        barThickness: 26,

                    }

                ]
            },
            options: {
                maintainAspectRatio: false,

                scales: {
                    x: {
                        grid: {
                            display: false,
                        }
                    },

                },
                plugins: {
                    legend: {
                        display: false,
                    },
                }

            }
        });
    </script>
    <script>
        document.getElementById('mySelect').addEventListener('change', function() {
            window.location.href = this.value;
        });
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
                printWindow.document.write('<tr> <th style="text-align: center">CATEGORY</th>' +
                    '<th style="text-align: center">TOTAL BOOKS</th>' +
                    '<th style="text-align: center">DAILY</th>' +
                    '<th style="text-align: center">WEEKLY</th>' +
                    '<th style="text-align: center">WHOLE QUARTER</th>');

                var employeeElements = $(".book-info");
                employeeElements.each(function () {

                    // Extract employee information from the selected element
                    var bookCategory = $(this).find('.bookCategory').text();
                    var bookTotal = $(this).find('.bookTotal').text();
                    var reserveDaily = $(this).find('.reserveDaily').text();
                    var reserveWeekly = $(this).find('.reserveWeekly').text();
                    var reserveWholeQuarter = $(this).find('.reserveWholeQuarter').text();

                    // Add rows to the table for name, status, and role
                    printWindow.document.write('<tr>');
                    printWindow.document.write('<td style="text-align: center;">' + bookCategory + '</td>');
                    printWindow.document.write('<td style="text-align: center;">' + bookTotal + '</td>');
                    printWindow.document.write('<td style="text-align: center;">' + reserveDaily + '</td>');
                    printWindow.document.write('<td style="text-align: center;">' + reserveWeekly+ '</td>');
                    printWindow.document.write('<td style="text-align: center;">' + reserveWholeQuarter + '</td>');
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
</body>

</html>
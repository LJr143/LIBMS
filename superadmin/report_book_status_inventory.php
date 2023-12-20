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
                        <div style="width: 60%; display: flex; justify-content: space-between">
                            <button style="background-color: white; font-size: 12px; width: 170px; height: 35px; border-radius: 5px; border: none; box-shadow: 0px 4px 8px rgba(0,0,0,0.27);"><img style="width: 20px;" src="../icons/book_inventory_report_icon.png" alt=""><span style="margin-left: 10px;"><a href="report.php" style="text-decoration: none; color: inherit;">Book Inventory</a></span></button>
                            <button style="background-color: white; font-size: 12px; width: 170px; height: 35px; border-radius: 5px; border: none; box-shadow: 0px 4px 8px rgba(0,0,0,0.27);"><img style="width: 20px;" src="../icons/categories_report_icon.png" alt=""><span style="margin-left: 10px;"><a href="report_categories_inventory.php" style="text-decoration: none; color: inherit;">Categories</a></span></button>
                            <button style="background-color: white; font-size: 12px; width: 170px; height: 35px; border-radius: 5px; border: none; box-shadow: 0px 4px 8px rgba(0,0,0,0.27);"><img style="width: 20px;" src="../icons/newuser_report_icon.png" alt=""><span style="margin-left: 10px;"><a href="report_users_inventory.php" style="text-decoration: none; color: inherit;">New Users/Visitors</a></span></button>
                            <button style=" font-size: 12px; width: 170px; height: 35px; border-radius: 5px; border: none; box-shadow: 0px 4px 8px rgba(0,0,0,0.27);"><img style="width: 20px;" src="../icons/book_status_icon.png" alt=""><span style="margin-left: 10px;">Book Status</span></button>

                        </div>

                    </div>
                </div>
                <div style="display: flex; justify-content: center; ">
                    <div style=" width: 95%; height: 50px; margin: 10px 0 0 0; border-radius: 5px; box-shadow: 0 4px 8px rgba(0,0,0,0.27);    ">
                        <div style=" margin: 15px 30px; display: flex; ">
                            <div style="width: 85%;">
                                <h6 style="font-size: 12px; font-weight: 700;">BOOK STATUS</h6>
                            </div>
                            <div style="width: 15%; display: flex; justify-content: flex-end">
                                <div style=" margin-top: -10px; width: 40%; display: flex; justify-content: flex-end; align-items: center; height: 35px;">
                                    <button style="border: none; background-color: transparent;"><img style="width: 20px;" src="../icons/export_icon.png" alt=""></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="display: flex; justify-content: center; width: 100%; height: 70px; ">
                    <div style=" width: 95%; max-height: 620px; margin: 10px 0 0 0; border-radius: 5px; box-shadow: 0 4px 8px rgba(0,0,0,0.27);     ">
                        <div style="width: 100%; display: flex; margin-top: 10px;">
                            <div style="width: 80%;">
                                <div style="width: 80%; height: 40px; display: flex;  align-content: center; align-items: center">
                                    <select name="" id="" style=" margin: 0px 0px 0px 40px;width: 100px; height: 25px; font-size: 12px; font-weight: 600; border-radius: 5px;">
                                        <option value="">Quarter 1</option>
                                        <option value="">Quarter 2</option>
                                        <option value="">Quarter 3</option>
                                        <option value="">Quarter 4</option>

                                    </select>
                                    <div class="input_search-wrapper" style="margin-left: 40px;">
                                        <input type="search" class="search-input" placeholder="Search Book">
                                    </div>
                                </div>
                            </div>

                            <div style="width: 20%; height: 40px; display: flex; justify-content: flex-end; align-items: center; ">
                                <img style="width: 180px; margin-right: 20px;" src="../icons/pagination_sample.png" alt="" ;>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="display: flex; justify-content: center; width: 100%; height: 600px">
                    <div style="width: 95%; display: flex; justify-content: center; border-radius: 5px; margin-top: 10px; font-size: 12px; box-shadow: 0px 4px 8px rgba(0,0,0,0.13)">
                        <table style="width: 95%; " class=" table text-center">
                            <thead>
                                <tr>
                                    <th>BOOK ID</th>
                                    <th>TITLE</th>
                                    <th>ISBN</th>
                                    <th>ISSUED TO</th>
                                    <th>ISSUED DATE</th>
                                    <th>FINE</th>
                                    <th>STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="height: 10px">

                                </tr>
                                <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25);">
                                    <td>1</td>
                                    <td>The Adventures of Sherlock Holmes</td>
                                    <td>1234567890</td>
                                    <td>John Doe</td>
                                    <td>2023-10-15</td>
                                    <td>$2.50</td>
                                    <td>Issued</td>
                                </tr>
                                <tr style="height: 10px">

                                </tr>
                                <tr style=" height: 40px;background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25); border-radius: 5px;">

                                    <td>2</td>
                                    <td>To Kill a Mockingbird</td>
                                    <td>2345678901</td>
                                    <td>Jane Smith</td>
                                    <td>2023-10-20</td>
                                    <td>$3.00</td>
                                    <td>Issued</td>



                                </tr>
                                <tr style="height: 10px">

                                </tr>
                                <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px;border: 1px solid rgba(0,0,0,0.25);">
                                    <td>3</td>
                                    <td>The Great Gatsby</td>
                                    <td>3456789012</td>
                                    <td>David Johnson</td>
                                    <td>2023-10-22</td>
                                    <td>$1.50</td>
                                    <td>Returned</td>



                                </tr>
                                <tr style="height: 10px">

                                </tr>
                                <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25);">
                                    <td>4</td>
                                    <td>Harry Potter and the Sorcerer's Stone</td>
                                    <td>4567890123</td>
                                    <td>Susan Brown</td>
                                    <td>2023-10-25</td>
                                    <td>$2.00</td>
                                    <td>Lost</td>



                                </tr>
                                <tr style="height: 10px">

                                </tr>
                                <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25);">
                                    <td>5</td>
                                    <td>The Catcher in the Rye</td>
                                    <td>5678901234</td>
                                    <td>Michael White</td>
                                    <td>2023-10-28</td>
                                    <td>$1.75</td>
                                    <td>Returned</td>



                                </tr>
                                <tr style="height: 10px">

                                </tr>
                                <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25);">
                                    <td>6</td>
                                    <td>Brave New World</td>
                                    <td>6789012345</td>
                                    <td>Linda Martin</td>
                                    <td>2023-11-02</td>
                                    <td>$2.25</td>
                                    <td>Issued</td>
                                </tr>
                                <tr style="height: 10px">

                                </tr>
                                <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25);">
                                    <td>7</td>
                                    <td>The Lord of the Rings</td>
                                    <td>7890123456</td>
                                    <td>Peter Davis</td>
                                    <td>2023-11-05</td>
                                    <td>$3.20</td>
                                    <td>Issued</td>



                                </tr>
                                <tr style="height: 10px">

                                </tr>
                                <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25);">
                                    <td>8</td>
                                    <td> Pride and Prejudice</td>
                                    <td>8901234567</td>
                                    <td>Emily Wilson</td>
                                    <td>2023-11-08</td>
                                    <td>$1.90</td>
                                    <td>Returned</td>



                                </tr>
                                <tr style="height: 10px">

                                </tr>
                                <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25);">
                                    <td>9</td>
                                    <td>The Hunger Games</td>
                                    <td>9012345678</td>
                                    <td>Andrew Hall</td>
                                    <td>2023-11-12</td>
                                    <td>$2.50</td>
                                    <td>Lost</td>



                                </tr>
                                <tr style="height: 10px">

                                </tr>
                                <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25);">
                                    <td>10</td>
                                    <td> The Alchemist</td>
                                    <td>0123456789</td>
                                    <td>Olivia Miller</td>
                                    <td>2023-11-15</td>
                                    <td>$1.75</td>
                                    <td>Returned</td>



                                </tr>
                                <tr style="height: 10px">

                                </tr>

                            </tbody>
                        </table>
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

</body>

</html>
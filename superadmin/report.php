<?php
session_start();
require_once '../db_config/config.php';
include '../operations/authentication.php';
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
                            <button style="font-size: 12px; width: 170px; height: 35px; border-radius: 5px; border: none; box-shadow: 0px 4px 8px rgba(0,0,0,0.27);"><img style="width: 20px;" src="../icons/book_inventory_report_icon.png" alt=""><span style="margin-left: 10px;">Book Inventory</span></button>
                            <button style="background-color: white; font-size: 12px; width: 170px; height: 35px; border-radius: 5px; border: none; box-shadow: 0px 4px 8px rgba(0,0,0,0.27);"><img style="width: 20px;" src="../icons/categories_report_icon.png" alt=""><span style="margin-left: 10px;"><a href="report_categories_inventory.php" style="text-decoration: none; color: inherit;">Categories</a></span></button>
                            <button style="background-color: white; font-size: 12px; width: 170px; height: 35px; border-radius: 5px; border: none; box-shadow: 0px 4px 8px rgba(0,0,0,0.27);"><img style="width: 20px;" src="../icons/newuser_report_icon.png" alt=""><span style="margin-left: 10px;"><a href="report_users_inventory.php" style="text-decoration: none; color: inherit;">New Users/Visitors</a></span></button>
                            <button style="background-color: white; font-size: 12px; width: 170px; height: 35px; border-radius: 5px; border: none; box-shadow: 0px 4px 8px rgba(0,0,0,0.27);"><img style="width: 20px;" src="../icons/book_status_icon.png" alt=""><span style="margin-left: 10px;"><a href="report_book_status_inventory.php" style="text-decoration: none; color: inherit;">Book Status</a></span></button>

                        </div>
                        <div style="width: 40%; display: flex; justify-content: flex-end; align-items: center; height: 35px;">
                            <div style="margin-right: 50px;"> <button style="border: none; background-color: transparent;"><img style="width: 20px;" src="../icons/export_icon.png" alt=""></button></div>
                        </div>
                    </div>
                </div>
                <div style="display: flex; justify-content: center; ">
                    <div style=" width: 95%; height: 500px; margin: 10px 0 0 0; border-radius: 5px; box-shadow: 0 4px 8px rgba(0,0,0,0.27);    ">
                        <div style=" margin: 20px 30px; display: flex">
                            <div style="width: 85%;">
                                <h6 style="font-size: 13px; font-weight: 700;">OVERALL REPORTS <span style="font-size: 10px; color: #CA0C00; margin: 0px 10px;">* From the start of the academic year until the present</span></h6>
                            </div>
                            <div style="width: 15%; display: flex; justify-content: flex-end">
                                <select name="" id="mySelect" style="font-size: 12px; width: 150px; padding: 2px 5px; border-radius: 5px">
                                    <option selected value="">OVERALL</option>
                                    <option value="report_borrowed_inventory.php">BORROWED</option>
                                    <option value="report_reserved_inventory.php">RESERVED</option>
                                    <option value="report_returned_inventory.php">RETURNED</option>
                                    <option value="report_copies_inventory.php">BOOK COPIES</option>
                                </select>
                            </div>
                        </div>
                        <div style=" margin: 0px 30px; display: flex; height: 400px;">
                            <div style="width: 50%; height: 400px; display: flex; align-items: center; align-content: center; box-shadow: 0 4px 8px rgba(0,0,0,0.27); ">
                                <div style="width: 100%;height: 75%; margin: 0px 0px 0 0px;">
                                    <canvas id="overallchart"></canvas>
                                </div>

                            </div>
                            <div style="width: 50%; height: 400px; overflow: hidden">
                                <div style="margin: 0px 0px;">
                                    <div style=" margin: 0px 0 0 50px; height: 40px; width: 450px; border-radius: 5px; background-color: #F3F3F3; display: flex; box-shadow: 0px 1px 6px rgba(0,0,0,0.15);">
                                        <div style="width: 80%; height: 40px; display: flex; align-items: center;margin-left: 20px; font-size: 12px; font-weight: bold">TOTAL BOOKS</div>
                                        <div style="width: 20%; height: 40px;display: flex; align-items: center;margin-left: 20px; font-size: 12px; font-weight: bold;"><?php echo $numberOfBooks ?></div>
                                    </div>
                                    <div style=" margin: 15px 0 0 50px; height: 40px; width: 450px; border-radius: 5px; background-color: #740000; display: flex">
                                        <div style="width: 80%; height: 40px; display: flex; align-items: center;margin-left: 20px; font-size: 12px; font-weight: bold; color: white">BOOKS RESERVED</div>
                                        <div style="width: 20%; height: 40px;display: flex; align-items: center;margin-left: 20px; font-size: 12px; font-weight: bold; color: white">...</div>
                                    </div>
                                    <div style=" margin: 15px 0 0 50px; height: 40px; width: 450px; border-radius: 5px; background-color: #9D0101; display: flex">
                                        <div style="width: 80%; height: 40px;display: flex; align-items: center;margin-left: 20px; font-size: 12px; font-weight: bold; color: white">BOOKS BORROWED</div>
                                        <div style="width: 20%; height: 40px;display: flex; align-items: center;margin-left: 20px; font-size: 12px; font-weight: bold; color: white">...</div>
                                    </div>
                                    <div style=" margin: 15px 0 0 50px; height: 40px; width: 450px; border-radius: 5px; background-color: #E10000; display: flex">
                                        <div style="width: 80%; height: 40px;display: flex; align-items: center;margin-left: 20px; font-size: 12px; font-weight: bold; color: white">BOOKS RETURNED</div>
                                        <div style="width: 20%; height: 40px;display: flex; align-items: center;margin-left: 20px; font-size: 12px; font-weight: bold; color: white">...</div>
                                    </div>
                                    <div style=" margin: 15px 0 0 50px; height: 40px; width: 450px; border-radius: 5px; background-color: #F54B02; display: flex">
                                        <div style="width: 80%; height: 40px;display: flex; align-items: center;margin-left: 20px; font-size: 12px; font-weight: bold; color: white">BOOKS UNRETURNED</div>
                                        <div style="width: 20%; height: 40px;display: flex; align-items: center;margin-left: 20px; font-size: 12px; font-weight: bold; color: white">...</div>
                                    </div>
                                    <div style=" margin: 15px 0 0 50px; height: 40px; width: 450px; border-radius: 5px; background-color: #78220F; display: flex">
                                        <div style="width: 80%; height: 40px; display: flex; align-items: center;margin-left: 20px; font-size: 12px; font-weight: bold; color: white">LOST BOOKS</div>
                                        <div style="width: 20%; height: 40px;display: flex; align-items: center;margin-left: 20px; font-size: 12px; font-weight: bold; color: white">...</div>
                                    </div>
                                    <div style=" margin: 15px 0 0 50px; height: 40px; width: 450px; border-radius: 5px; background-color: #000000; display: flex">
                                        <div style="width: 80%; height: 40px;display: flex; align-items: center;margin-left: 20px; font-size: 12px; font-weight: bold; color: white">DAMAGED BOOKS</div>
                                        <div style="width: 20%; height: 40px;display: flex; align-items: center;margin-left: 20px; font-size: 12px; font-weight: bold; color: white">...</div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <div style="display: flex; justify-content: center; margin-top: 30px; ">
                    <div style="font-size: 12px; background-color: white; width: 95%; max-height: 550px; box-shadow: 0px 4px 8px rgba(0,0,0,0.27);">
                        <div style="width: 100%; display: flex; justify-content: center; border-radius: 5px">
                            <table style="width: 98%; " class=" table text-center">
                                <thead>
                                    <tr>
                                        <th>CATEGORY</th>
                                        <th>TOTAL</th>
                                        <th>RESERVED</th>
                                        <th>BORROWED</th>
                                        <th>RETURNED</th>
                                        <th>UNRETURNED</th>
                                        <th>LOST</th>
                                        <th>DAMAGED</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="height: 10px">

                                    </tr>
                                    <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25);">
                                        <td>Environment and Forestry</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>


                                    </tr>
                                    <tr style="height: 10px">

                                    </tr>
                                    <tr style=" height: 40px;background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25); border-radius: 5px;">

                                        <td>Agriculture and Agricultural Engineering</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>


                                    </tr>
                                    <tr style="height: 10px">

                                    </tr>
                                    <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px;border: 1px solid rgba(0,0,0,0.25);">
                                        <td>Usepiana</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>


                                    </tr>
                                    <tr style="height: 10px">

                                    </tr>
                                    <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25);">
                                        <td>General Information</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>


                                    </tr>
                                    <tr style="height: 10px">

                                    </tr>
                                    <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25);">
                                        <td>Filipiniana</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>


                                    </tr>
                                    <tr style="height: 10px">

                                    </tr>
                                    <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25);">
                                        <td>Educational</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>


                                    </tr>
                                    <tr style="height: 10px">

                                    </tr>
                                    <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25);">
                                        <td>Video Tapes</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>


                                    </tr>
                                    <tr style="height: 10px">

                                    </tr>
                                    <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25);">
                                        <td>Special Education</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>
                                        <td>1200</td>


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
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js" integrity="sha512-JPcRR8yFa8mmCsfrw4TNte1ZvF1e3+1SdGMslZvmrzDYxS69J7J49vkFL8u6u8PlPJK+H3voElBtUCzaXj+6ig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/chart.js-plugin-labels-dv/dist/chartjs-plugin-labels.min.js"></script>

    <script>
        // Fetch data from the server
        fetch('../includes/fetch_overall_counts.php')
            .then(response => response.json())
            .then(data => {
                console.log(data);
                const ctx = document.getElementById('overallchart').getContext('2d');

                const colors = [
                    'rgba(139, 21, 0, 1)',
                    'rgba(182, 28, 0, 1)',
                    'rgba(246, 37, 0, 1)',
                    'rgba(255, 78, 47, 1)',
                    'rgba(143, 48, 31, 1)',
                    'rgba(0, 0, 0, 1)'
                ];

                const chart1 = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['Overall Borrow', 'Damage', 'Reserved', 'Returned', 'Unreturned', 'Lost'],
                        datasets: [{
                            label: '',
                            data: [
                                data.overall_borrow_count,
                                data.damage_count,
                                data.reserved_count,
                                data.returned_count,
                                data.unreturned_count,
                                data.lost_count
                            ],
                            backgroundColor: colors,
                            borderColor: colors,
                            borderWidth: 0,
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        layout: {
                            padding: 10,
                        },
                        plugins: {
                            legend: {
                                display: false,
                            },
                            labels: {
                                render: function (args) {
                                    return args.value; // Display the count instead of the percentage
                                },
                                fontColor: 'black',
                                fontStyle: 'bolder',
                                position: 'outside',
                                textMargin: 6,
                            }
                        }
                    },
                });
            })
            .catch(error => console.error('Error fetching data:', error));

    </script>


    <script>
        document.getElementById('mySelect').addEventListener('change', function() {
            window.location.href = this.value;
        });
    </script>
</body>

</html>
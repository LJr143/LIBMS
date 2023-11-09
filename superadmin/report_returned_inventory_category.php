<?php
session_start();
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
include 'C:\wamp64\www\LIBMS\operations\authentication.php';
include 'C:\wamp64\www\LIBMS\includes\fetch_user_data.php';
include 'C:\wamp64\www\LIBMS\includes\fetch_books_data.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$loggedAdmin ='';

$database = new Database();
$userAuth = new UserAuthentication($database);
$bookData = new BookData($database);
$userData = new UserData($database);
$numberOfBooks = $bookData->getNumberOfBooks();
$numberOfUsers = $userData->getNumberOfUser();

if($userAuth->isAuthenticated()) {
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
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>USeP | LMS</title>
    <link rel="icon" href="../icons/usep-logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../css/superadmin_report.css">
</head>
<body style="">
<div>
    <?php include 'header.php'?>
    <div class="main-content d-flex" >
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
                    <li><img class="custom_menu_icon" src="../icons/staff_icon.png" alt=""><span><a href="staff.php">Staff</a></span></li>
                    <li class="active"><img class="custom_menu_icon" src="../icons/reports_icon.png" alt=""><span><a href="report.php">Reports</a></span></li>
                    <li><img class="custom_menu_icon" src="../icons/logs_icon.png" alt=""><span><a href="logs.php">Logs</a></span></li>
                    <li><img class="custom_menu_icon" src="../icons/feedback_icon_dashboard.png" alt=""><span><a href="feedback.php">Feedback</a></span></li>
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
                        <ul class="dropdown-menu dropdown-menu-dark dropdown_menu_setting aria-labelledby="dropdownMenuButton2">
                        <li><a style="font-size: 12px; color: white;" class="dropdown-item" href="profile.php"><img src="../icons/manage_account.png" alt="" class="custom_icon"><span>Manage Account</span></a></li>
                        <li><a style="font-size: 12px; color: white;"class="dropdown-item" href="#"><img src="../icons/help.png" alt="" class="custom_icon"><span>Help</span></a></li>
                        <li><hr class="dropdown-divider"></li>

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

                    </div>
                </div>
                </div>
            <div style="display: flex; justify-content: center; margin-top: 10px; ">
                <div style="background-color: #390000; width: 95%; height: 40px; margin: 0px; border-radius: 5px;display: flex;  align-items: center; align-content: center;">
                <div style="margin: 0px 20px; width: 100%; display: flex;">
                    <div style=" width: 85%;">
                    <a href="report_borrowed_inventory.php"><button style="border: none; background-color: transparent"><img style="width: 20px" src="../icons/back_to.png" alt=""></a></button>
                        <span style="font-size: 12px; font-weight: 400; color: white; margin: 0px 20px"> RETURNED REPORTS BY CATEGORY</span>
                    </div>
                    <div style="width: 15%; display: flex; align-items: center; justify-content: space-between;">
                        <select name="" id="" style="width: 130px; font-size: 12px; height: 25px; border-radius: 5px; padding: 0px 5px;background-color: transparent; border: 1px solid white; color: white">
                            <option style="color: black" value="">Quarter 1</option>
                            <option style="color: black" value="">Quarter 2</option>
                            <option style="color: black" value="">Quarter 3</option>
                            <option style="color: black" value="">Quarter 4</option>
                        </select>

                        <div style="display: flex; align-items: center; align-content: center; padding: 0; margin: 0">
                            <button style="border: none; background-color: transparent;"><img  style="width: 22px; margin-bottom: 3px;" src="../icons/export_icon_white.png" alt=""></button>
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
                                <th>TOTAL BOOKS</th>
                                <th>DAILY</th>
                                <th>WEEKLY</th>
                                <th>WHOLE QUARTER</th>


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



                            </tr>
                            <tr style="height: 10px">

                            </tr>
                            <tr style=" height: 40px;background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25); border-radius: 5px;">

                                <td>Agriculture and Agricultural Engineering</td>
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



                            </tr>
                            <tr style="height: 10px">

                            </tr>
                            <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25);">
                                <td>General Information</td>
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



                            </tr>
                            <tr style="height: 10px">

                            </tr>
                            <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25);">
                                <td>Educational</td>
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



                            </tr>
                            <tr style="height: 10px">

                            </tr>
                            <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25);">
                                <td>Special Education</td>
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
    const ctx = document.getElementById('overallchart').getContext('2d');

    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['First Quarter', 'Second Quarter', 'Third Quarter', 'Fourth Quarter'],
            datasets: [{
                label: 'daily',
                data: [40,50,60,70],
                backgroundColor: '#FF0000',
                barThickness: 26,

            },
                {
                    label: 'weekly',
                    data: [200,220,230,240],
                    backgroundColor: '#B50000',
                    barThickness: 26,

                },
                {
                    label: 'quarterly',
                    data: [ 260,270,280,290],
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
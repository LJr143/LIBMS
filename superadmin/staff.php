<?php
session_start();
require_once 'C:\wamp64\www\LIBMS\LIBMS\db_config\config.php';
include 'C:\wamp64\www\LIBMS\LIBMS\operations\authentication.php';
include 'C:\wamp64\www\LIBMS\LIBMS\includes\fetch_user_data.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$loggedAdmin ='';

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
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>USeP | LMS</title>
    <link rel="icon" href="../icons/usep-logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
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

    <div class="main-content d-flex" >
        <div class="col col-md-2 side_bar">
            <div class="profile_section">
                <div>
                    <img style="border: 3px solid white; width: 60px; border-radius: 60px;" src="../img/<?= $loggedAdmin['img'] ?>" alt="">
                    <div style="position: absolute; top: 55px; right: 72px; background:#01d501; height: 15px; width: 15px; border-radius: 60px;"></div>
                </div>
                <div style="display: block; text-align: center; color: white; height: 20px;">

                </div>
            </div>         <div>
                <ul class="menu_icon">
                    <li><img class="custom_menu_icon" src="../icons/dashboard_icon.png" alt=""><span><a href="dashboard.php">Dashboard</a></span></li>
                    <li class="active"><img class="custom_menu_icon" src="../icons/staff_icon.png" alt=""><span><a href="staff.php">Staff</a></span></li>
                    <li><img class="custom_menu_icon" src="../icons/reports_icon.png" alt=""><span><a href="report.php">Reports</a></span></li>
                    <li><img class="custom_menu_icon" src="../icons/logs_icon.png" alt=""><span><a href="logs.php">Logs</a></span></li>
                    <li><img class="custom_menu_icon" src="../icons/feedback_icon_dashboard.png" alt=""><span><a href="feedback.php">Feedback</a></span></li>
                </ul>
            </div>

        </div>
        <div class="col" style=" width: 100%; height: 100vh; ">
            <div style="background-color: white; width: 95%; height: 45px; margin: 15px; border-radius: 5px;display: flex; box-shadow: 0px 4px 8px rgba(0,0,0,0.27); align-content: center; align-items: center">
                <div style="width: 90%">
                    <p style="font-size: 10px; font-weight: 700; margin: 14px">HOME | STAFF</p>
                </div>
                <div class=" d-flex justify-content-end align-items-center" style="height: 50px; width: 10%; margin-right: 20px ">
                    <div class="dropdown" style=" margin-right: 0px; position: absolute">
                        <button style="background: none; border: none;" class=" dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="../img/<?= $loggedAdmin['img'] ?>" alt="" width="35px" style="border-radius: 60px; border: 1px solid #4d0202">
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark dropdown_menu_setting aria-labelledby="dropdownMenuButton2">
                        <li><a class="dropdown-item" href="manage_account.php"><img src="../icons/manage_account.png" alt="" class="custom_icon"><span>Manage Account</span></a></li>
                        <li><a class="dropdown-item" href="#"><img src="../icons/help.png" alt="" class="custom_icon"><span>Help</span></a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../operations/logout.php"><img src="../icons/plug.png" alt="" class="custom_icon"><span>Logout</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div style="display: flex; justify-content: center; ">
                <div style="background-color: white; width: 95%; height: 55px; margin: 15px; border-radius: 5px;display: flex; box-shadow: 0px 4px 8px rgba(0,0,0,0.27); align-items: center">
                   <div class="col col-md-10">
                       <select name="" id="" style="width: 150px; padding: 0px 10px; margin-left: 10px; border-radius: 5px;  height: 30px; font-size: 12px;">
                           <option value="">Search By</option>
                           <option value="">Part Time</option>
                           <option value="">Full Time</option>
                           <option value="">Staff</option>
                           <option value="">Faculty</option>

                       </select>
                   </div>
                    <div class="col col-md-2">
                        <button style="font-size: 12px; width: 150px; height: 30px; border-radius: 5px; background-color: rgb(128,0,0); color: white; border: none">ADD STAFF</button>
                    </div>
                </div>
            </div>

            <div style="display: flex; justify-content: center; ">
                <div style="font-size: 12px; background-color: white; width: 95%; max-height: 550px; box-shadow: 0px 4px 8px rgba(0,0,0,0.27);">
                        <div style="width: 100%; display: flex; justify-content: center; border-radius: 5px">
                            <table style="width: 98%; " class=" table text-center">
                                <thead>
                                <tr>
                                    <th><input type="checkbox" style="position: absolute; margin: 2px 0px 0px -20px;">Select All</th>
                                    <th></th>
                                    <th>Employee</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Manage</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr style="height: 10px">

                                </tr>
                                <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25);">
                                    <td><input type="checkbox"></td>
                                    <td>Sheena Marie Pagas</td>
                                    <td>880423897-57838</td>
                                    <td>IT</td>
                                    <td>Stephen King</td>
                                    <td>7 hours</td>


                                </tr>
                                <tr style="height: 10px">

                                </tr>
                                <tr style=" height: 40px;background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25); border-radius: 5px;">

                                    <td><input type="checkbox"></td>
                                    <td>Lorjohn M. Raña</td>
                                    <td>880423897-57838</td>
                                    <td>IT</td>
                                    <td>Stephen King</td>
                                    <td>7 hours</td>


                                </tr>
                                <tr style="height: 10px">

                                </tr>
                                <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px;border: 1px solid rgba(0,0,0,0.25);">
                                    <td><input type="checkbox"></td>
                                    <td>Sheena Marie Pagas</td>
                                    <td>880423897-57838</td>
                                    <td>IT</td>
                                    <td>Stephen King</td>
                                    <td>7 hours</td>


                                </tr>
                                <tr style="height: 10px">

                                </tr>
                                <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25);">
                                    <td><input type="checkbox"></td>
                                    <td>Sheena Marie Pagas</td>
                                    <td>880423897-57838</td>
                                    <td>IT</td>
                                    <td>Stephen King</td>
                                    <td>7 hours</td>


                                </tr>
                                <tr style="height: 10px">

                                </tr>

                                </tbody>
                            </table>

                        </div>
                    <div  style="width: 100%; display: flex; justify-content: center; margin: 20px 0px">
                        <div class="row" style="width: 98%;">
                            <div class="col col-md-8" style="">
                                <img style="width: 180px" src="../icons/pagination_sample.png" alt="">
                            </div>
                            <div class="col col-md-4" style="display: flex; padding: 0; margin: 0">
                                <button style="margin-left: 160px" class="operation_all_btn">Delete All</button>
                                <button style="margin-left: 10px; " class="operation_all_btn">Suspend All</button>
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
</body>
</html>
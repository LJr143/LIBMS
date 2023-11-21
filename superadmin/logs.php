<?php
session_start();
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
include 'C:\wamp64\www\LIBMS\operations\authentication.php';
include 'C:\wamp64\www\LIBMS\includes\fetch_user_data.php';
include 'C:\wamp64\www\LIBMS\includes\fetch_books_data.php';
include 'C:\wamp64\www\LIBMS\includes\fetch_staff_data.php';
include 'C:\wamp64\www\LIBMS\includes\fetch_superadmin_data.php';
include 'C:\wamp64\www\LIBMS\includes\logs_operation.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$loggedAdmin ='';

$database = new Database();
$userAuth = new UserAuthentication($database);
$bookData = new BookData($database);
$userData = new UserData($database);
$adminData = new StaffData($database);
$superAdminData = new SuperAdminData($database);
$log = new Logs($database);


$numberOfBooks = $bookData->getNumberOfBooks();
$numberOfUsers = $userData->getNumberOfUser();

//Authenticate
if($userAuth->isAuthenticated()) {
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

    if(isset($_SESSION['admin_role'])){
        $accessType = $_SESSION['admin_role'];
        if($accessType == 'Librarian'){
            $adminID =$superAdminData->getSuperadminIdByUsername($adminUsername);
            if(!empty($adminID)){
                $admin = $superAdminData->getSuperadminById($adminID);
                $loggedAdmin = $admin[0];
                $_SESSION['loggedAdmin'] = $loggedAdmin;
            }
            else {
                echo 'SuperAdmin data not found.';
            }
        }
        else if($accessType == 'Staff'){
            $adminID =$adminData->getStaffIdByUsername($adminUsername);
            if(!empty($adminID)){
                $admin = $adminData->getStaffById($adminID);
                $loggedAdmin = $admin[0];
            }
            else {
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
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>USeP | LMS</title>
    <link rel="icon" href="../icons/usep-logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../css/superadmin_logs.css">
</head>
<body style="">
<div>
    <?php include 'header.php'?>
    <div class="main-content d-flex" >
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
                    <li class="active"><img class="custom_menu_icon" src="../icons/logs_icon.png" alt=""><span><a href="logs.php">Logs</a></span></li>
                    <li><img class="custom_menu_icon" src="../icons/feedback_icon_dashboard.png" alt=""><span><a href="feedback.php">Feedback</a></span></li>
                </ul>
            </div>

        </div>
        <div class="col" style=" width: 100%; height: 100vh; ">
            <div style="background-color: white; width: 95%; height: 45px; margin: 15px; border-radius: 5px;display: flex; box-shadow: 0px 4px 8px rgba(0,0,0,0.27); align-content: center; align-items: center">
                <div style="width: 90%">
                    <p style="font-size: 10px; font-weight: 700; margin: 14px">HOME | SYSTEM LOGS</p>
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
                <div style="background-color: white; width: 95%; height: 60px; margin: 0px; border-radius: 5px;display: flex; box-shadow: 0px 4px 8px rgba(0,0,0,0.27); align-items: center; align-content: center">
                    <div style=" width: 90%; display: flex">
                        <select name="" id="" style="width: 180px; height: 30px; font-size: 12px; border-radius: 5px;font-weight: 600; margin-left: 10px; padding: 0 5px;">
                            <option value="">Select Time Frame</option>
                            <option value="">Today</option>
                            <option value="">Yesterday</option>
                        </select>
                        <div class="input_search-wrapper" style="margin-left: 20px;">
                            <input type="search" class="search-input" placeholder="Search Book">
                        </div>
                    </div>
                    <div style=" display: flex; justify-content: space-around; width: 100px;">
                        <button style="border: none; background: transparent"><img  style="width: 20px" src="../icons/logs_btn_idk.png" alt=""></button>
                        <button style="border: none; background: transparent"><img  style="width: 20px" src="../icons/export_icon.png" alt=""></button>

                    </div>

                </div>
            </div>
            <div style="display: flex; justify-content: center; margin-top: 20px; ">
                <div style="background-color: white; width: 95%; min-height: 80vh; margin: 0px; border-radius: 5px;display: flex; box-shadow: 0px 4px 8px rgba(0,0,0,0.27); justify-content: center">
                    <table style="width: 95%; height: 50px; margin-top: 10px; text-align: center ">
                        <thead >
                        <tr style="width: 80px; background: #F6F6F6; height: 40px; position: relative; border-radius: 5px; font-size: 12px; border: 1px solid rgba(0,0,0,0.28); box-shadow: 0px 2px 4px rgba(0,0,0,0.2)">
                            <th >DATE & TIME</th>
                            <th>USER ID</th>
                            <th>USER TYPE</th>
                            <th>ACTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($logsList as $logs){ ?>
                            <tr style="height: 20px">

                            </tr>
                            <tr style=" font-size: 12px; height: 30px; border-bottom: 1px solid rgba(0,0,0,0.14)">
                                <td><?php echo $logs['date'];?></td>
                                <td><?php echo $logs['admin_id']?></td>
                                <td></td>
                                <td><?php echo $logs['action'];?></td>

                            </tr>
                        <?php } ?>




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



</body>
</html>
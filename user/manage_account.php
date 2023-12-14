<?php
session_start();
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
include 'C:\wamp64\www\LIBMS\includes\fetch_books_data.php';
include 'C:\wamp64\www\LIBMS\operations\authentication.php';
include 'C:\wamp64\www\LIBMS\includes\fetch_student_data.php';
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
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edvge">
    <title>USeP | LMS | Settings</title>
    <link rel="icon" href="../icons/usep-logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="../css/user_manage_account.css">
</head>
<body>
<?php include 'header.php'?>
<div style=" height: 100%; width: 100%; overflow-x: hidden; position: relative">

        <div class="user-nav  text-white" style="position: relative">
            <ul class="nav justify-content-center align-items-center align-content-center" style="width: 100%">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="home.php">BOOKS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="wishlist.php">WISHLIST</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="penalties.php">TRANSACTION</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="credit_score.php"  >CREDIT SCORE</a>
                </li>
            </ul>

            <div class=" d-flex justify-content-center align-items-center" style="height: 50px; width: 60px; right: 10px; position: absolute">
                <div class="dropdown" style=" margin-right: 0px; position: absolute">
                    <button style="background: none; border: none;" class=" dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../img/<?php echo $loggedUser['img'] ?>" alt="" width="35px" style="border-radius: 60px; border: 1px solid #4d0202">
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark dropdown_menu_setting aria-labelledby="dropdownMenuButton2">
                    <li><a style="font-size: 12px; color: white;" class="dropdown-item" href="manage_account.php"><img src="../icons/manage_account.png" alt="" class="custom_icon"><span>Manage Account</span></a></li>
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
  <div class="main-content" >
      <div style="width: 100%;display: flex; justify-content: center">
          <div style="background-color: white; width: 95%; height: 40px; margin-top: 30px; border-radius: 5px; box-shadow: 0px 4px 8px rgba(0,0,0,0.18); display: flex; align-items: center; align-content: center ">
              <span style="color: #740000; font-size: 12px; font-weight: 500;margin: 0px 20px">MANAGE ACCOUNT</span>
          </div>

      </div>
      <div style="width: 100%; height: 100vh;display: flex; justify-content: center;margin-top: 20px;">
          <div style=" width: 95%; min-height: 80vh; display: flex;">
            <div style=" height: 80vh; width: 390px;border-radius: 5px;">
                <div style=" height: 280px; width: 360px;border-radius: 5px; box-shadow: 0px 4px 8px rgba(0,0,0,0.18);">
                    <div style="height: 180px; display: flex; justify-content: center; width: 100%;">
                        <img style=" margin-top: 50px;width: 130px; height: 130px; border-radius: 80px; border: 1px solid black" src="../img/me_sample_profile.jpg" alt="">
                    </div>
                    <div style="margin: 14px 0 0 0;">
                        <div style="display: flex; width: 100%; justify-content: center">
                            <p style="font-size: 12px; color: rgb(116,0,0); font-weight: 600; font-style: italic">Lorjohn M. Raña</p>
                            <span><button style="border: none; background: transparent">
                                   <img
                                           style="width: 15px; margin: -10px 0 0 5px;" src="../icons/edit_profile_icon.png" alt="">
                               </button></span>
                        </div>
                        <div style="width: 100%; display: flex; justify-content: center; margin-top: -15px">
                            <p style="font-size: 12px; font-weight: 700;">STUDENT</p>
                        </div>

                    </div>

                </div>
                <div style="  height: 150px; width: 360px; display: flex; justify-content: center;">
                    <div style=" margin-top: 30px; height: 180px; width: 320px; display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center">
                    <div style="background-color: rgb(128,0,0); height: 45%; width: 48.5%; border-radius: 5px; box-shadow: 0px 4px 8px rgba(0,0,0,0.2); display: flex; align-content: center; align-items: center; flex-wrap: wrap; justify-content: center">
                        <div>
                            <img style="width: 25px; margin-right: 20px;" src="../icons/profile_reservation_icon.png" alt="">
                        </div>
                        <div style="text-align: center;  color: white">
                            <h6 style="font-size: 10px; font-weight: 200; margin-top: 20px;">RESERVATIONS</h6>
                            <p style="margin-top: -10px; font-style: italic; font-size: 18px">02</p>
                        </div>
                    </div>
                    <div style="background-color: white; height: 45%; width: 48.5%; border-radius: 5px; box-shadow: 0px 4px 8px rgba(0,0,0,0.2);display: flex; align-content: center; align-items: center; flex-wrap: wrap; justify-content: center ">
                        <div>
                            <img style="width: 25px; margin-right: 20px;" src="../icons/profile_wishlist_icon.png" alt="">
                        </div>
                        <div style="text-align: center;  color: black">
                            <h6 style="font-size: 10px; font-weight: 600; margin-top: 20px;">WISHLIST</h6>
                            <p style="margin-top: -10px; font-style: italic; font-size: 18px">13</p>
                        </div>
                    </div>
                    <div style="background-color: white; height: 45%; width: 48.5%; border-radius: 5px; box-shadow: 0px 4px 8px rgba(0,0,0,0.2); display: flex; align-content: center; align-items: center; flex-wrap: wrap; justify-content: center  ">
                        <div>
                            <img style="width: 25px; margin-right: 20px;" src="../icons/profile_borrowed_icon.png" alt="">
                        </div>
                        <div style="text-align: center;  color: black">
                            <h6 style="font-size: 10px; font-weight: 600; margin-top: 20px;">BORROWED</h6>
                            <p style="margin-top: -10px; font-style: italic; font-size: 18px">05</p>
                        </div>
                    </div>
                    <div style="background-color: #800000; height: 45%; width: 48.5%; border-radius: 5px; box-shadow: 0px 4px 8px rgba(0,0,0,0.2); display: flex; align-content: center; align-items: center; flex-wrap: wrap; justify-content: center ">
                        <div>
                            <img style="width: 25px; margin-right: 20px;" src="../icons/profile_returned_icon.png" alt="">
                        </div>
                        <div style="text-align: center;  color: white">
                            <h6 style="font-size: 10px; font-weight: 200; margin-top: 20px;">RETURNED</h6>
                            <p style="margin-top: -10px; font-style: italic; font-size: 18px">10</p>
                        </div>
                    </div>
                </div>
                </div>
                </div>
             <div style=" margin: 0px 25px;background-color:white; height: 70vh; width: 550px;border-radius: 5px; box-shadow: 0px 4px 8px rgba(0,0,0,0.18)">
                 <div style="margin: 50px 50px;">
                     <h6 style="color: #740000; font-size: 12px; font-weight: 500;">PERSONAL INFORMATION</h6>
                     <div style="margin: 0px 30px; width: 100%; display: flex">
                        <table style="width: 100%;">

                            <tr style="height: 20px;">
                                <td style="font-size: 11px; font-weight: 600; margin-top: 15px; width: 180px;">STUDENT ID</td>
                                <td style="font-size: 11px; font-weight: 400; margin-top: 15px">2021-00027</td>
                            </tr>
                            <tr style="height: 20px;">
                                <td style="font-size: 11px; font-weight: 600; margin-top: 15px">FULL NAME</td>
                                <td style="font-size: 11px; font-weight: 400; margin-top: 15px">Lorjohn M. Rana</td>
                            </tr>
                            <tr style="height: 20px;">
                                <td style="font-size: 11px; font-weight: 600; margin-top: 15px">PHONE NUMBER</td>
                                <td style="font-size: 11px; font-weight: 400; margin-top: 15px">09096763912</td>
                            </tr>
                            <tr style="height: 20px;">
                                <td style="font-size: 11px; font-weight: 600; margin-top: 15px">ADDRESS</td>
                                <td style="font-size: 11px; font-weight: 400; margin-top: 15px">Purok, Baranggay, City/Municipality, Province</td>
                            </tr>
                            <tr style="height: 20px;">
                                <td style="font-size: 11px; font-weight: 600; margin-top: 15px">SECTION/YEAR</td>
                                <td style="font-size: 11px; font-weight: 400; margin-top: 15px">3IT / Third Year</td>
                            </tr>
                            <tr style="height: 20px;">
                                <td style="font-size: 11px; font-weight: 600; margin-top: 15px">COLLEGE</td>
                                <td style="font-size: 11px; font-weight: 400; margin-top: 15px">College of Teacher Education and Technology</td>
                            </tr>

                            <tr style="height: 20px;">
                                <td style="font-size: 11px; font-weight: 600; margin-top: 15px">COURSE</td>
                                <td style="font-size: 11px; font-weight: 400; margin-top: 15px">Bachelor of Science in Information Technology</td>
                            </tr>
                            <tr style="height: 20px;">
                                <td style="font-size: 11px; font-weight: 600; margin-top: 15px">MAJOR</td>
                                <td style="font-size: 11px; font-weight: 400; margin-top: 15px">Information Security</td>
                            </tr>



                        </table>
                     </div>
                     <h6 style="color: #740000; font-size: 12px; font-weight: 500; margin-top: 80px;">ACCOUNT</h6>
                     <div style="margin: 0px 30px;">
                         <table style="width: 100%;">

                             <tr style="height: 20px;">
                                 <td style="font-size: 11px; font-weight: 600; margin-top: 15px; width: 180px;">EMAIL</td>
                                 <td style="font-size: 11px; font-weight: 400; margin-top: 15px">lmrana00027@usep.edu.ph</td>
                             </tr>
                             <tr style="height: 20px;">
                                 <td style="font-size: 11px; font-weight: 600; margin-top: 15px">USERNAME</td>
                                 <td style="font-size: 11px; font-weight: 400; margin-top: 15px">GisapOtKoAtay143</td>
                             </tr>
                             <tr style="height: 20px;">
                                 <td style="font-size: 11px; font-weight: 600; margin-top: 15px">PASSWORD</td>
                                 <td style="font-size: 11px; font-weight: 400; margin-top: 15px">****************</td>
                             </tr>
                         </table>
                     </div>
                 </div>
             </div>
              <div style=" background-color:white; height: 70vh; width: 500px;border-radius: 5px; box-shadow: 0px 4px 8px rgba(0,0,0,0.18)">
                  <div style="margin: 50px 50px;">
                      <h6 style="color: #740000; font-size: 12px; font-weight: 500;">CHANGE PASSWORD</h6>
                      <div style="margin: 20px 30px; width: 100%;">
                          <p style="font-size: 10px; font-weight: 600">To protect your account, make sure your password:</p>
                          <ul style="list-style: none; margin-top: -10px; margin-left: -20px">
                              <li style="font-size: 10px; font-weight: 600">
                                  +  Is longer than 8 letters.
                              </li>
                              <li style="font-size: 10px; font-weight: 600">
                                  +  Contains an uppercase character.
                              </li>
                              <li style="font-size: 10px; font-weight: 600">
                                  +  Contains an lowercase character.
                              </li>
                              <li style="font-size: 10px; font-weight: 600">
                                  +  Contains a number.
                              </li>
                              <li style="font-size: 10px; font-weight: 600">
                                  +  Contains a special character.
                              </li>
                          </ul>


                      </div>
                      <div style="display: flex; justify-content: center;  text-align: left; -webkit-flex-wrap: wrap">
                          <div>
                              <label style="font-size: 10px; font-weight: 600" for="old_Password_Profile">OLD PASSWORD</label>
                              <br>
                              <input style="border-radius: 5px; border: 1px solid black; height: 35px" type="password">
                          </div>
                          <div style="margin-top: 30px;">
                              <label style="font-size: 10px; font-weight: 600" for="old_Password_Profile">NEW PASSWORD</label>
                              <br>
                              <input style="border-radius: 5px; border: 1px solid black; height: 35px" type="password">
                          </div>
                          <div style="margin-top: 10px;">
                              <label style="font-size: 10px; font-weight: 600" for="old_Password_Profile">CONFIRM NEW PASSWORD</label>
                              <br>
                              <input style="border-radius: 5px; border: 1px solid black; height: 35px" type="password">
                          </div>

                      </div>
                      <div style="margin-top: 30px; display: flex; justify-content: flex-end">
                          <div>
                              <button style="margin-right: 10px; font-size: 10px; font-weight: 600; height: 30px; width: 80px; box-shadow: 0px 4px 8px rgba(0,0,0,0.2); background-color: transparent; border-radius: 5px; color: #740000; border: 1px solid #740000;">CLEAR</button>
                              <button style="font-size: 10px; font-weight: 600; height: 30px; width: 80px; border-radius: 5px; color: white; background-color: #740000; border: none; box-shadow: 0px 4px 8px rgba(0,0,0,0.2)">SAVE</button>
                          </div>
                      </div>

                  </div>
              </div>
          </div>

      </div>





  </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

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


    window.addEventListener('scroll', function () {
        const nav = document.querySelector('nav');
        nav.classList.toggle("sticky", window.scrollY > 0);
    });

</script>
</body>
</html>

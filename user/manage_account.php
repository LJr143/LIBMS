<?php
session_start();
include 'C:\wamp64\www\LIBMS\db_config\config.php';
include 'C:\wamp64\www\LIBMS\includes\fetch_books.php';
$database = new Database();
$bookData = new BookData($database);

$books = $bookData->getAllBooks();




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
    <link rel="stylesheet" href="../css/user_home.css">
</head>
<body>
<nav class="navbar navbar-light bg-light header" id="navbar" >
    <div class="container-fluid">

        <div class="head-text">
            <div> <img src="../icons/usep-logo.png" alt="" class="custom_img"></div>
            <div class="usep-text">
                <p style="font-size: 14px; font-weight: bold">University of Southeastern Philippines Tagum - Mabini Campus</p>
                <p style="font-size: 12px; font-weight: 600; margin-top: -20px">Apokon RD, Tagum City Davao Del Norte 8100</p>
            </div>
        </div>
        <div class="right-side" >
            <div class="right-side-text">
                <p style="font-size: 14px; font-weight: bold;">LIBRARY MANAGEMENT SYSTEM</p>
                <p style="font-size: 12px; font-weight: 600; margin-top: -20px">E - System Environment</p>
            </div>
        </div>
    </div>
</nav>
<div style=" height: 100%; width: 100%; overflow-x: hidden; position: relative">

        <div class="user-nav bg-dark text-white" style="position: relative">
            <ul class="nav justify-content-center align-items-center align-content-center" style="width: 100%">
                <li class="nav-item active">
                    <a class="nav-link" aria-current="page" href="home.php">BOOKS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="wishlist.php">WISHLIST</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="penalties.php">PENALTIES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="credit_score.php"  >CREDIT SCORE</a>
                </li>
            </ul>

            <div class=" d-flex justify-content-center align-items-center" style="height: 50px; width: 60px; right: 10px; position: absolute">
                <div class="dropdown" style=" margin-right: 0px; position: absolute">
                    <button style="background: none; border: none;" class=" dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../icons/user.png" alt="" width="30px" style="border-radius: 60px;">
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark dropdown_menu_setting aria-labelledby="dropdownMenuButton2">
                        <li><a class="dropdown-item" href="#"><img src="../icons/manage_account.png" alt="" class="custom_icon"><span>Manage Account</span></a></li>
                        <li><a class="dropdown-item" href="#"><img src="../icons/bookmark.png" alt="" class="custom_icon"><span>Book Status</span></a></li>
                        <li><a class="dropdown-item" href="#"><img src="../icons/help.png" alt="" class="custom_icon"><span>Help</span></a></li>
                        <li><a class="dropdown-item" href="#"><img src="../icons/connect.png" alt="" class="custom_icon"><span>Feedback</span></a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#"><img src="../icons/plug.png" alt="" class="custom_icon"><span>Logout</span></a></li>
                    </ul>
                </div>

            </div>
        </div>
  <div class="main-content" >
        <div class="container-fluid">
            <p class="text-main"">MANAGE ACCOUNT</p>
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

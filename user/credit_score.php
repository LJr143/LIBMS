<?php
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
    <link rel="stylesheet" href="../css/user_wishlist.css">

</head>
<body>
<div style=" width: 100%; overflow-x: hidden">
    <nav class="navbar navbar-light bg-light header">
        <div class="container-fluid">

            <div class="head-text">
                <div> <img src="../icons/usep-logo.png" alt="" class="custom_img"></div>
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
    <div class="user-nav bg-dark text-white">
        <ul class="nav justify-content-center align-items-center align-content-center" style="width: 100%">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="home.php">BOOKS</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="wishlist.php">WISHLIST</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="penalties.php">PENALTIES</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link " href="credit_score.php"  >CREDIT SCORE</a>
            </li>
        </ul>
    </div>
    <div class="main-content">
        <div class="container-fluid">
            <p class="text-main"">HOME</p>
        </div>
        <div class="row search-by">
            <div class="dropdown col-md-4">
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
                    <option value="option">Overall</option>
                </select>

            </div>

            <div class="search-input col-md-8 d-flex">
                <input class="form-control me-2" type="search" placeholder="Search Books" aria-label="Search" autocomplete="off">
                <button>Search</button>
            </div>

        </div>

    </div>

</div>
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


</body>


</html>

<?php
session_start();
//error_reporting(0);
if(!isset($_SESSION['authenticate_user'])){
    header('Location: ../index.php');
}
require_once 'C:\wamp64\www\LIBMS\LIBMS\db_config\config.php';
include 'C:\wamp64\www\LIBMS\LIBMS\includes\fetch_books.php';
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
    <title>USeP | LMS</title>
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

        <div class="user-nav  text-white" style="position: relative">
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
                        <li><a class="dropdown-item" href="manage_account.php"><img src="../icons/manage_account.png" alt="" class="custom_icon"><span>Manage Account</span></a></li>
                        <li><a class="dropdown-item" href="#"><img src="../icons/bookmark.png" alt="" class="custom_icon"><span>Book Status</span></a></li>
                        <li><a class="dropdown-item" href="#"><img src="../icons/help.png" alt="" class="custom_icon"><span>Help</span></a></li>
                        <li><a class="dropdown-item" href="#"><img src="../icons/connect.png" alt="" class="custom_icon"><span>Feedback</span></a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../operations/logout.php"><img src="../icons/plug.png" alt="" class="custom_icon"><span>Logout</span></a></li>
                    </ul>
                </div>

            </div>
        </div>
  <div class="main-content" >
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
                  <option value="option">Others</option>
              </select>

          </div>

          <div class="search-input col-md-8 d-flex">
              <input class="form-control me-2" type="search" placeholder="Search Books" aria-label="Search" autocomplete="off">
                <button>Search</button>
          </div>

      </div>

      <div class="container new-books">
          <div id="book-section">
              <h6>New Arrivals</h6>
          </div>
          <div class="container" style="box-shadow: 0px 4px 8px rgba(91, 3, 3, 0.26)">
              <div class="swiper mySwiper">
                  <div class="book-container-new swiper-wrapper" style="padding: 20px">
                      <?php foreach ($books as $book) { ?>
                          <div class="custom_book_container d-flex flex-column align-items-center justify-content-center swiper-slide">
                              <p class="custom-book-text" style="background-color: #FFB93E; padding: 5px 0px 5px 20px; margin-top: -20px; width: 100px; font-size: 8px; color: white">
                                    OUT OF STOCK
                              </p>
                              <img src="../book_img/<?php echo $book['book_img']; ?>" alt="" class="custom-book-img">
                              <div style="width: 100%; height: 30px; margin-top: 10px;" class="d-flex align-items-center  flex-column">
                                  <p style="font-size: 12px; text-align: center" class="custom-book-text"><?php echo $book['book_title']; ?></p>
                                  <p style="margin-top: -20px; font-size: 8px;" class="custom-book-text"><?php echo $book['Author_id']; ?></p>
                              </div>
                              <div style="width: 100%; margin-top: 10px;" class="d-flex justify-content-center">
                                  <button  data-bs-toggle="modal" data-bs-target="#bookModal" data-book-id="<?php echo $book['book_id']; ?>" style="font-size: 10px; width: 80%; border: 1px solid black" class="btn btn-view-book">View Book</button>

                              </div>
                          </div>
                      <?php } ?>
                  </div>
              </div>
          </div>
      </div>


      <div class="container new-books">
          <div id="book-section"><h6>Recommendations</h6></div>
          <div class="container d-flex flex-column" style="box-shadow: 0px 4px 8px rgba(91, 3, 3, 0.26); width: 100%;">
              <div class="book-container-new swiper-wrapper d-flex flex-wrap mt-5"> <!-- Use flex-wrap to allow elements to wrap -->
                  <?php foreach ($books as $book) { ?>
                      <div class="custom_book_container mb-5 d-flex flex-column align-items-center justify-content-center swiper-slide">
                          <p class="custom-book-text" style="background-color: #FFB93E; padding: 5px 0px 5px 20px; margin-top: -20px; width: 100px; font-size: 8px; color: white">OUT OF STOCKS</p>
                          <img src="../book_img/<?php echo $book['book_img']; ?>" alt="" class="custom-book-img" style="">
                          <div style="width: 100%; height: 30px; margin-top: 10px;" class="d-flex align-items-center  flex-column">
                              <p style="font-size: 12px" class="custom-book-text"><?php echo $book['book_title']; ?></p>
                              <p style="margin-top: -20px; font-size: 8px;" class="custom-book-text"><?php echo $book['Author_id']; ?></p>
                          </div>
                          <div style="width: 100%; margin-top: 10px;" class="d-flex justify-content-center">
                              <button data-bs-toggle="modal" data-bs-target="#bookModal" data-book-id="<?php echo $book['book_id']; ?>" style="font-size: 10px; width: 80%; border: 1px solid black" class="btn btn-view-book">View Book</button>
                          </div>
                      </div>
                  <?php } ?>
              </div>
          </div>
      </div>

  </div>

</div>


<!-- View Modal -->
<div class="modal fade " id="bookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">BOOK INFORMATION</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>

        </div>
    </div>
</div>

<!-- Borrow Modal -->
<div class="modal fade " id="borrowModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">BORROWING CREDENTIALS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>

        </div>
    </div>
</div>

<!-- Borrow Confirmation Modal -->
<div class="modal fade " id="borrowConfirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">BORROWING CREDENTIALS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>

        </div>
    </div>
</div>
<!-- Reserve Modal -->
<div class="modal fade " id="reserveModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">RESERVING CREDENTIALS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>

        </div>
    </div>
</div>


<!-- Borrow Success Modal -->
<div class="modal fade " id="borrowSuccessModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">BORROWING SUCCESSFUL</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>

        </div>
    </div>
</div>

<!-- Reserve Success Modal -->
<div class="modal fade " id="reserveSuccessModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">RESERVING SUCCESSFUL</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>

        </div>
    </div>
</div>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
    $('.btn-view-book').on('click', function() {
        var bookId = $(this).data('book-id');
        var modalBody = $('.modal-body');
        console.log(bookId);

        $.ajax({
            url: '../includes/fetch.php?book_id=' + bookId,
            method: 'GET',
            success: function(data) {
                modalBody.html(data);
            },
            error: function() {
                modalBody.html('Failed to fetch book details.');
            }
        });
    });
</script>

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
    var swiper = new Swiper(".mySwiper", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: "auto",
        coverflowEffect: {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: true,
        },
        pagination: {
            el: ".swiper-pagination",
        },
        initialSlide: 3,
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

<?php
$host = 'localhost';
$database = 'lms_db';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

if (isset($_GET['book_id'])) {
    $bookId = $_GET['book_id'];

    $query = "SELECT * FROM tbl_book WHERE book_id = :bookId";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':bookId', $bookId, PDO::PARAM_INT);

    // Execute the query
    $stmt->execute();

    // Fetch the book details
    $book = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($book) {
        // Format the response as HTML
        echo '<div id="img_container_vw" style=" display: flex; align-items: center">';
        echo '<div id="img_container_vw_2" style="display: flex; justify-content: center; align-items: center; width: 30%; height: 300px; overflow: hidden;">';
        echo '<img style="width: 190px;" src="../book_img/'.$book['book_img'].'" alt="">';
        echo '</div>';
        echo '<div id="img_container_vw_3" style="width: 70%;height: 300px;">';
        echo '<div class="row" style="display: flex; flex-wrap: wrap;height: 60px">';
        echo '<div class="col col-md-6" style=" height: 80px">';
        echo '<p>Book Title:&nbsp;'.$book['book_title'].'</p>';
        echo '<p>Author:&nbsp;'.$book['Author_id'].'</p>';
        echo '<p>Genre:&nbsp;'.$book['genre'].'</p>';
        echo '</div>';
        echo '<div class="col col-md-6" style="height: 80px">';
        echo '<p>Shelf:&nbsp;'.$book['shelf'].'</p>';
        echo '<p>Publisher:&nbsp;'.$book['publisher'].'</p>';
        $statusClass = ($book['status'] === 'Available') ? 'delivered' : 'cancelled';
        echo '<p class="vw_book_status">Status: <b class="'.$statusClass.'">'.$book['status'].'</b></p>';
        echo '</div>';
        echo '</div>';
        echo '<div class="row" style="display: flex; flex-wrap: wrap">';
        echo '<p style="font-size: 10px; font-weight: 600;">Description: </p>';
        echo '</div>';
        echo '<div class="row" style="display: flex; flex-wrap: wrap; height: 180px">';
        echo '<p style="font-size: 12px; font-style: italic; width: 50ch; font-weight: 600;">'.$book['description'].'</p>';
        echo '</div>';
        echo '<div class="row vw_btns_borrow_reserve" style="display: flex; flex-wrap: wrap; height: 30px; width: 550px;">';
        echo '<button data-bs-toggle="modal" data-bs-target="#borrowModal"  data-book-id="' . $book['book_id'] . '" type="button"  class="btn btn-secondary borrow-button">Borrow</button>';
        echo '<button data-bs-toggle="modal" data-bs-target="#reserveModal"  data-book-id="' . $book['book_id'] . '" type="button"  class="btn btn-secondary reserve-button">Reserve</button>';
        echo '<img src="../icons/heart.png" alt="" style="width: 20px">';
        echo '</div>';
        echo '</div>';
        echo '</div>';


        ?>
        <script>
            $('.borrow-button').on('click', function() {
                $('.modal').modal('hide');


                var bookId = $(this).data('book-id');
                var modalBody = $('.modal-body');
                console.log(bookId);
                console.log('clicked!');
                $.ajax({
                    url: '../includes/borrowing.php?book_id=' + bookId,
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
            $('.reserve-button').on('click', function() {
                $('.modal').modal('hide');


                var bookId = $(this).data('book-id');
                var modalBody = $('.modal-body');
                console.log(bookId);
                console.log('clicked!');
                $.ajax({
                    url: '../includes/reserve.php?book_id=' + bookId,
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
<?php

        $conn = null;
    } else {
        echo 'Book not found';
    }
} else {
    echo 'Invalid request';
}
?>

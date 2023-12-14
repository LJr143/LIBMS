<?php
$host = 'localhost';
$database = 'u657994792_lms_db';
$username = 'u657994792_usep_tagum_lms';
$password = 'Usep_tagum_lms123';

try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

if (isset($_GET['book_id'])) {
    $bookId = $_GET['book_id'];

    $datum = isset($_POST['date_for_borrow']);
    // Prepare a SQL query to fetch book details based on book_id
    $query = "SELECT * FROM tbl_book WHERE book_id = :bookId";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':bookId', $bookId, PDO::PARAM_INT);

    // Execute the query
    $stmt->execute();

    // Fetch the book details
    $book = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($book) {
        ?>
        <form action="" method="post">
            <div id="img_container_borrow" style="width: 100%; height: 350px">
                <div style="width: 100%; display: flex; justify-content: center;"><img src="../icons/reserve.png" alt="" style="width: 80px;height: 80px"></div>
                <div style="font-size: 14px; letter-spacing: 0.2px; width: 100%; color: #711717; display: flex; justify-content: center;"><p style="font-style: italic; font-weight: 700;">RESERVE BOOK</p></div>
                <div style="font-size: 12px; width: 100%; display: flex; justify-content: center; height: 70px">
                    <div class="row d-flex justify-content-center">
                        <div class="col col-md-6 " style="overflow: hidden;">
                            <p style=" margin-left: 50px; width: 40ch; overflow: hidden; padding: 5px 0px; font-weight: 700;">Book Title: &nbsp;&nbsp; <?php echo $book['book_title'] ?></p>
                            <p style="margin-left: 50px; width: 40ch; overflow: hidden; padding: 0px 0px; font-weight: 700;">Author: &nbsp;&nbsp; <?php echo $book['Author_id'] ?></p>
                        </div>
                        <div class="col col-md-6" style="overflow: hidden;">
                            <p style="margin-left: 50px; width: 40ch; overflow: hidden; padding: 5px 0px; font-weight: 700;">Genre: &nbsp;&nbsp; <?php echo $book['genre'] ?></p>
                            <p style="margin-left: 50px;width: 40ch; overflow: hidden; padding: 0px 0px; font-weight: 700;">Publisher: &nbsp;&nbsp; <?php echo $book['publisher'] ?></p>

                        </div>
                    </div>
                </div>

                <div style="font-size: 12px; width: 100%; display: flex; flex-wrap: wrap; justify-content: center;">
                <div style="margin-top: -20px; margin-left: 100px"><p style="margin-left: 50px; width: 40ch; overflow: hidden; padding: 5px 0px; font-weight: 700;">Reservation Date: &nbsp;&nbsp; mm/dd/yyyy</p>
                </div>
                    <div  style="margin-top: -25px;  margin-left: 100px"><p style="margin-left: 50px;width: 40ch; overflow: hidden; padding: 0px 0px; font-weight: 700;">Publisher: &nbsp;&nbsp; <b style="margin-left: 46px;">mm/dd/yyyy</b></p>
                    </div>
                    <div  style="margin-top: -20px;  margin-left: 100px"><p style="margin-left: 50px;width: 40ch; overflow: hidden; padding: 0px 0px; font-weight: 700;">Due Date: &nbsp;&nbsp;<b style="margin-left: 48px;"> mm/dd/yyyy</b></p>
                    </div>
                       </div>
                <div style="font-size: 12px; width: 100%; display: flex; justify-content: center;"><p style="padding: 5px 0px;  font-weight: 700;">
                        <button data-bs-dismiss="modal" type="button" style="width: 100px; margin: 0px 20px; font-weight: bold; border-radius: 5px; padding: 10px; color: #711717; background-color: transparent; border: 1px solid #711717">Cancel</button>
                        <button data-bs-toggle="modal" data-bs-target="#reserveSuccessModal" data-book-id="<?php echo $book['book_id'] ?>" class="barrow_confirm_btn" type="button" style="width: 100px; font-weight: bold; border-radius: 5px; padding: 10px; color: white; background-color: #740000; border: 1px solid #711717">Confirm</button>
                </div>
            </div>
        </form>

        <script>
            $(document).ready(function() {
                var modalBody = $('.modal-body');
                var dateInput = $('#date_borrowed_vw');

                $('.barrow_confirm_btn').on('click', function() {
                    console.log('button clicked!');
                    $('.modal').modal('hide');
                    var bookId = $(this).data('book-id');
                    var date = '<?php echo $datum; ?>';
                    console.log("Date: " + date);

                    // Make an AJAX request to insert the record into the database
                    $.ajax({
                        url: '../includes/insert_borrow_book.php',
                        method: 'POST',
                        data: {
                            book_id: bookId,
                            date: date
                        },
                        success: function(response) {
                            console.log(response);
                            $.ajax({
                                url: '../includes/reserve_confirmation.php',
                                method: 'GET',
                                data: {
                                    book_id: bookId,
                                    date: date
                                },
                                success: function(data) {
                                    modalBody.html(data);
                                },
                                error: function() {
                                    modalBody.html('Failed to fetch book details.');
                                }
                            });
                        },
                        error: function() {
                            modalBody.html('Failed to insert the record.');
                        }
                    });
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

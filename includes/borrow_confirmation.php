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
        <div id="img_container_borrow" style="width: 100%; height: 330px">
            <div style="width: 100%; display: flex; justify-content: center;"><img src="../icons/confirmation.png" alt="" style="width: 80px;height: 80px"></div>
            <div style=" font-size: 14px; letter-spacing: 0.2px ;width: 100%; color: #711717;display: flex; justify-content: center;"> <p style="font-style: italic; font-weight: 700;">Confirmation</p></div>
            <div style="font-size: 12px; width: 100%;display: flex; justify-content: center;"> <p style=" width: 60ch; font-size: 10px;text-align:center;font-weight: 700;">Please return the book before or on MM/DD/YYYY, 5:00 PM at the Campus Library. Penalties will be given once it is overdue, including a daily late fee of Php X and a suspension of borrowing privileges until the book is returned.  Please proceed to the Library for pickup.</p></div>
            <div style="font-size: 12px; width: 100%;display: flex; justify-content: center;"> <p style="padding: 5px 0px; font-weight: 700;">
                    <button data-bs-dismiss="modal" type="button" style="width: 100px; margin: 0px 20px; font-weight: bold; border-radius: 5px; padding:  10px; color: #711717; background-color: transparent; border: 1px solid #711717">Close</button>

            </div>

        </div>



        <?php



        $conn = null;
    } else {
        echo 'Book not found';
    }
} else {
    echo 'Invalid request';
}
?>

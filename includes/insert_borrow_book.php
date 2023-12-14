<?php
require_once '../db_config/config.php';
require_once '../includes/fetch_books.php';
class BorrowBookInsert {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function insertRecord($borrowredId,$user_id,$bookId, $date,$status) {
        $sql = "INSERT INTO tbl_borrow (borrowed_id,user_id,book_id, date_borrowed,status) VALUES (:borrowed_id,:user_id,:book_id, :date_borrowed,:status)";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':borrowed_id', $borrowredId, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':book_id', $bookId, PDO::PARAM_INT);
            $stmt->bindParam(':date_borrowed', $date, PDO::PARAM_STR);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
            $stmt->execute();

            echo "Record inserted successfully!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

require_once 'C:\wamp64\www\LIBMS\LIBMS\db_config\config.php';
require_once 'C:\wamp64\www\LIBMS\LIBMS\includes\fetch_books.php';

// Create a database connection
$database = new Database();
// Create an instance of the BorrowBookInsert class
$recordInsert = new BorrowBookInsert($database);
$getBook = new BookData($database);



// Check if the date and book_id are provided (you can add this check before inserting)
if (isset($_GET['date']) && isset($_GET['book_id'])) {
    $date = $_GET['date'];
    $bookId = $_GET['book_id'];
    $user_id = '2021-00027';
    $borrowredId = $getBook->getBookById($bookId);
    $status = 'Borrowed';

    // Insert the record
    $recordInsert->insertRecord($borrowredId, $user_id, $bookId, $date, $status); // Make sure to set values for $borrowredId and $status as needed
} else {
    echo "Date and book_id are required.";
}


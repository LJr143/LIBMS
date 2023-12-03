<?php
require_once 'C:\wamp64\www\LIBMS\db_config\config.php'; 

class BorrowData {
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function getBookTitle($bookId) {
        try {
            // Your SQL query to fetch the book title from tbl_book
            $sql = "SELECT book_title FROM tbl_book WHERE book_id = :book_id";
            $stmt = $this->database->executeQuery($sql, [':book_id' => $bookId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result ? $result['book_title'] : 'Title Not Found';
        } catch (PDOException $e) {
            // Handle database connection or query errors here
            return 'Error Fetching Title';
        }
    }

    function fetchBorrowData()
    {
        error_log('Fetching borrow data...');
        try {
            // Connect to your database (modify the connection details accordingly)
            $pdo = new PDO("mysql:host=localhost;dbname=lms_db", "root", "");

            // Your SQL query to fetch data from the view
            $sql = "SELECT * FROM vw_borrow_data";

            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            // Fetch data as an associative array
            $borrowData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $borrowData;
        } catch (PDOException $e) {
            // Log the error
            error_log('Error fetching data: ' . $e->getMessage());

            // Handle database connection or query errors here
            return [];
        }
    }
}

$database = new Database(); // Assuming you have a Database class for handling database connections
$borrowData = new BorrowData($database);

// Encode the data as JSON and echo it for AJAX requests
echo json_encode($borrowData->fetchBorrowData());

?>

<?php
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';

class BorrowDetails
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    function fetchBorrowDetails()
{
    error_log('Fetching borrow details...');
    try {
        // Connect to your database (modify the connection details accordingly)
        $pdo = new PDO("mysql:host=localhost;dbname=lms_db", "root", "");

        // Check if 'borrowId' is set in the POST data
        if (isset($_POST['borrowId'])) {
            $borrowId = $_POST['borrowId'];

            // Your SQL query to fetch data from the view
            $sql = "SELECT * FROM vw_modal_return_data WHERE borrow_id = :borrowId";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':borrowId', $borrowId, PDO::PARAM_INT);
            $stmt->execute();

            // Fetch data as an associative array
            $borrowData = $stmt->fetch(PDO::FETCH_ASSOC);

            return $borrowData;
        } else {
            // Handle case where 'borrowId' is not set
            return [];
        }
    } catch (PDOException $e) {
        // Log the error
        error_log('Error fetching data: ' . $e->getMessage());

        // Handle database connection or query errors here
        return [];
    }
}

}
$database = new Database(); // Assuming you have a Database class for handling database connections
$borrowDetails = new BorrowDetails($database);

?>

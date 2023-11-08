<?php
require_once 'C:\wamp64\www\LIBMS\db_config\config.php'; // Adjust the path accordingly

class BorrowedData
{
    protected $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getAllBooks(): array
    {
        $sql = "SELECT * FROM vw_borrowed_books";
        $stmt = $this->database->executeQuery($sql);

        // Fetch all records
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

class BorrowDataWithStatus extends BorrowedData
{
    public function getBooksByStatus($status): array
    {
        $sql = "SELECT * FROM vw_borrowed_books WHERE status = :status";
        $params = array(':status' => $status);
        $stmt = $this->database->executeQuery($sql, $params);

        // Fetch all records
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

// Example usage:
$database = new Database();
$borrowData = new BorrowDataWithStatus($database);

// Get all books
$allBooks = $borrowData->getAllBooks();

// Get available books
$availableBooks = $borrowData->getBooksByStatus('available');

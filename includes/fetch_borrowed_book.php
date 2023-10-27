<?php
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';

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
        $result = $this->database->executeQuery($sql);

        $wishbooks = array();

        while ($row = $result->fetch_assoc()) {
            $wishbooks[] = $row;
        }

        return $wishbooks;
    }
}

class BorrowDataWithStatus extends BorrowedData
{
    public function getBooksByStatus($status): array
    {
        $sql = "SELECT * FROM vw_borrowed_books WHERE status = '$status'";
        $result = $this->database->executeQuery($sql);

        $borrowedbooks = array();

        while ($row = $result->fetch_assoc()) {
            $borrowedbooks[] = $row;
        }

        return $borrowedbooks;
    }
}

// Example usage:
//$database = new Database();
//$borrowData = new BarrowDataWithStatus($database);
//
//$allBooks = $wishData->getAllBooks();
//$availableBooks = $wishData->getBooksByStatus('available');

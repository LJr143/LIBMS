<?php
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';

class WishData
{
    protected $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getAllBooks(): array
    {
        $sql = "SELECT * FROM tbl_wishlist";
        $result = $this->database->executeQuery($sql);

        $wishbooks = array();

        while ($row = $result->fetch_assoc()) {
            $wishbooks[] = $row;
        }

        return $wishbooks;
    }
}

class WishDataWithStatus extends WishData
{
    public function getBooksByStatus($status): array
    {
        $sql = "SELECT * FROM tbl_wishlist WHERE status = '$status'";
        $result = $this->database->executeQuery($sql);

        $wishbooks = array();

        while ($row = $result->fetch_assoc()) {
            $wishbooks[] = $row;
        }

        return $wishbooks;
    }
}

// Example usage:
//$database = new Database();
//$wishData = new WishDataWithStatus($database);
//
//$allBooks = $wishData->getAllBooks();
//$availableBooks = $wishData->getBooksByStatus('available');

<?php
require_once 'C:\wamp64\www\LIBMS\LIBMS\db_config\config.php';

class BookData
{
    protected $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getAllBooks(): array
    {
        $sql = "SELECT * FROM tbl_book";
        $result = $this->database->executeQuery($sql);

        if ($result) {
            return $result;
        } else {
            return array();
        }
    }


    public function getBookById($bookId): ?array
    {
        // Ensure $bookId is safe from SQL injection (e.g., use prepared statements)
        $safeBookId = $this->database->real_escape_string($bookId);

        $sql = "SELECT * FROM tbl_book WHERE book_id = '$safeBookId'";
        $result = $this->database->executeQuery($sql);

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return null;
    }
}
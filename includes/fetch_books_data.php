<?php
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

class BookData
{
    protected $database;

    public function __construct($database)
    {
        $this->database = $database->getDb();
    }

    public function getAllBook(): array
    {
        $sql = "SELECT * FROM tbl_book";
        $stmt = $this->database->query($sql);

        if ($stmt) {
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $users;
        } else {
            return array();
        }
    }

    public function getNumberOfBooks(): int
    {
        $sql = "SELECT COUNT(*) as num_books FROM tbl_book";
        $stmt = $this->database->prepare($sql);

        if ($stmt->execute()) {
            return (int) $stmt->fetch(PDO::FETCH_ASSOC)['num_books'];
        } else {
            return 0;
        }
    }



    public function getBookById($bookId): array
    {
        $sql = "SELECT * FROM tbl_book WHERE book_id = :bookId";
        $stmt = $this->database->prepare($sql);
        $stmt->bindParam(':bookId', $bookId, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return array();
        }
    }

}


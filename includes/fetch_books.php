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

        $books = array();

        while ($row = $result->fetch_assoc()) {
            $books[] = $row;
        }

        return $books;
    }
}
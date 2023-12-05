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
    public function addBook($bookID, $bookTitle, $bookGenre, $bookAuthor, $bookISBN, $bookCopies, $bookShelf, $bookPublisher, $bookCategory, $bookSummary, $profile): bool
    {

        $sql = "INSERT INTO tbl_book (book_id, book_title, genre, Author_id, ISBN, copy, shelf, publisher, category, description, book_img)
            VALUES (:bookID, :bookTitle, :bookGenre, :bookAuthor, :bookISBN, :bookCopies, :bookShelf, :bookPublisher, :bookCategory, :bookSummary, :img)";
        $stmt = $this->database->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':bookID', $bookID, PDO::PARAM_STR);
        $stmt->bindParam(':bookTitle', $bookTitle, PDO::PARAM_STR);
        $stmt->bindParam(':bookGenre', $bookGenre, PDO::PARAM_STR);
        $stmt->bindParam(':bookAuthor', $bookAuthor, PDO::PARAM_STR);
        $stmt->bindParam(':bookISBN', $bookISBN, PDO::PARAM_STR);
        $stmt->bindParam(':bookCopies', $bookCopies, PDO::PARAM_STR);
        $stmt->bindParam(':bookShelf', $bookShelf, PDO::PARAM_STR);
        $stmt->bindParam(':bookPublisher', $bookPublisher, PDO::PARAM_STR);
        $stmt->bindParam(':bookCategory', $bookCategory, PDO::PARAM_STR);
        $stmt->bindParam(':bookSummary', $bookSummary, PDO::PARAM_STR);
        $stmt->bindParam(':img', $profile, PDO::PARAM_STR);

        // Execute the query
        return $stmt->execute();
    }

    public function deleteBook($bookId){
        $sql = "DELETE FROM tbl_book WHERE book_id = :book_ID";

        $stmt = $this->database->prepare($sql);
        $stmt->bindParam(':book_ID', $bookId, PDO::PARAM_STR);

        return $stmt->execute();
    }

}


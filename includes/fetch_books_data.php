
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
            $errorInfo = $stmt->errorInfo();
            if ($errorInfo[0] !== '00000') {
                // Log or print the error information
                error_log("Database error: " . $errorInfo[2]);
            }

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return array();
        }
    }
    public function addBook($bookID, $bookTitle, $bookGenre, $bookAuthor, $bookISBN, $bookCopies, $bookShelf, $bookPublisher, $bookCategory, $bookSummary, $profile): bool
    {

        $sql = "INSERT INTO tbl_book (book_id, book_title, genre, author, ISBN, copy, shelf, publisher, category, description, book_img)
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
    public function updateBook($bookId, $bookTitle, $bookGenre, $bookAuthor, $bookISBN,$bookCopy, $bookShelf, $bookPublisher, $bookCategory, $bookSummary,$profile)
    {
        $sql = "UPDATE tbl_book 
        SET book_id = :bookId, book_title = :bookTitle, ISBN = :bookISBN, 
            author = :bookAuthor, publisher = :bookPublisher, 
            genre = :bookGenre,
            category = :bookCategory, description = :bookSummary, shelf = :bookShelf, copy = :bookCopy";

// If $profile is not null, include the img column in the SQL query
        if ($profile !== null) {
            $sql .= ", book_img = :bookPicture";
        }

        $sql .= " WHERE book_id = :bookId";

        $stmt = $this->database->prepare($sql);

// Bind parameters (excluding the img parameter if $profile is null)
        $stmt->bindParam(':bookId', $bookId, PDO::PARAM_STR);
        $stmt->bindParam(':bookTitle', $bookTitle, PDO::PARAM_STR);
        $stmt->bindParam(':bookISBN', $bookISBN, PDO::PARAM_STR);
        $stmt->bindParam(':bookAuthor', $bookAuthor, PDO::PARAM_STR);
        $stmt->bindParam(':bookPublisher', $bookPublisher, PDO::PARAM_STR);
        $stmt->bindParam(':bookGenre', $bookGenre, PDO::PARAM_STR);
        $stmt->bindParam(':bookCategory', $bookCategory, PDO::PARAM_STR);
        $stmt->bindParam(':bookSummary', $bookSummary, PDO::PARAM_STR);
        $stmt->bindParam(':bookShelf', $bookShelf, PDO::PARAM_STR);
        $stmt->bindParam(':bookCopy', $bookCopy, PDO::PARAM_STR);

// Bind the img parameter if $profile is not null
        if ($profile !== null) {
            $stmt->bindParam(':bookPicture', $profile, PDO::PARAM_STR);
        }

// Execute the query
        return $stmt->execute();
    }


    public function borrowBook($user_id, $bookId, $date): array
    {
        $transaction = 'Borrow';

        // Use a prepared statement to avoid SQL injection
        $sql = "INSERT INTO tbl_transaction (user_id, book_id, date_requested, transaction_type) VALUES (:user_id, :book_id, :date_borrowed, :transaction)";

        try {
            $stmt = $this->database->prepare($sql);
            // Bind parameters
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
            $stmt->bindParam(':book_id', $bookId, PDO::PARAM_STR);
            $stmt->bindParam(':date_borrowed', $date, PDO::PARAM_STR);
            $stmt->bindParam(':transaction', $transaction, PDO::PARAM_STR);
            $stmt->execute();

            // Return success flag or any additional information
            return ['success' => true, 'message' => 'Record inserted successfully'];
        } catch (PDOException $e) {
            // Log the error or handle it accordingly
            error_log("Error: " . $e->getMessage());

            // Return failure flag or any additional information
            return ['success' => false, 'message' => 'Error inserting record'];
        }
    }

    public function reserveBook($user_id, $bookId, $date, $returnDate): array
    {
        $transaction = 'Reserve';

        // Use a prepared statement to avoid SQL injection
        $sql = "INSERT INTO tbl_transaction (user_id, book_id, date_requested, date_return, transaction_type) VALUES (:user_id, :book_id, :date_borrowed, :return_date, :transaction)";

        try {
            $stmt = $this->database->prepare($sql);
            // Bind parameters
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
            $stmt->bindParam(':book_id', $bookId, PDO::PARAM_STR);
            $stmt->bindParam(':date_borrowed', $date, PDO::PARAM_STR);
            $stmt->bindParam(':return_date', $returnDate, PDO::PARAM_STR);
            $stmt->bindParam(':transaction', $transaction, PDO::PARAM_STR);
            $stmt->execute();

            // Return success flag or any additional information
            return ['success' => true, 'message' => 'Record inserted successfully'];
        } catch (PDOException $e) {
            // Log the error or handle it accordingly
            error_log("Error: " . $e->getMessage());

            // Return failure flag or any additional information
            return ['success' => false, 'message' => 'Error inserting record'];
        }
    }



    public function deleteBook($bookId){
        $sql = "DELETE FROM tbl_book WHERE book_id = :book_ID";

        $stmt = $this->database->prepare($sql);
        $stmt->bindParam(':book_ID', $bookId, PDO::PARAM_STR);

        return $stmt->execute();
    }

}
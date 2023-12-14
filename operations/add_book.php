<?php
session_start();
require_once '../db_config/config.php';
include '../includes/fetch_books_data.php';
include '../includes/logs_operation.php';

$database = new Database();
$log = new Logs($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $bookID = $_POST['bookID'];
        $bookTitle = $_POST['bookTitle'];
        $bookGenre = $_POST['bookGenre'];
        $bookAuthor = $_POST['bookAuthor'];
        $bookISBN = $_POST['bookISBN'];
        $bookCopies = $_POST['bookCopies'];
        $bookShelf = $_POST['bookShelf'];
        $bookPublisher = $_POST['bookPublisher'];
        $bookCategory = $_POST['bookCategory'];
        $bookSummary = $_POST['bookSummary'];

        $book = new BookData($database);

        if (!empty($_FILES['profile']['name'])) {
            $profile = $_FILES['profile']['name'];

            $uploadFolder = '../book_img/' . DIRECTORY_SEPARATOR;

            if (!file_exists($uploadFolder)) {
                mkdir($uploadFolder, 0777, true);
            }

            $uploadPath = $uploadFolder . $profile;

            if (!move_uploaded_file($_FILES['profile']['tmp_name'], $uploadPath)) {
                throw new Exception('Failed to move uploaded file.');
            }
        } else {
            $profile = null;
        }

        $result = $book->addBook($bookID, $bookTitle, $bookGenre, $bookAuthor, $bookISBN, $bookCopies, $bookShelf, $bookPublisher, $bookCategory, $bookSummary, $profile);

        if ($result) {
            header('Content-Type: application/json');
            echo json_encode(['success' => true]);
        } else {
            throw new Exception('Failed to add book.');
        }
    } catch (Exception $e) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}
?>
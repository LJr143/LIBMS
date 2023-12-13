<?php
session_start();
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
include 'C:\wamp64\www\LIBMS\includes\fetch_books_data.php';
include 'C:\wamp64\www\LIBMS\includes\logs_operation.php';
$database = new Database();
$log = new Logs($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the data sent through AJAX
    $bookId = $_POST['bookId'];
    $bookTitle = $_POST['bookTitle'];
    $bookGenre = $_POST['bookGenre'];
    $bookAuthor = $_POST['bookAuthor'];
    $bookISBN = $_POST['bookISBN'];
    $bookCopy = $_POST['bookCopy'];
    $bookShelf = $_POST['bookShelf'];
    $bookPublisher = $_POST['bookPublisher'];
    $bookCategory = $_POST['bookCategory'];
    $bookSummary = $_POST['bookSummary'];

    // Create an instance of the book class
    $book = new BookData($database);

    // Check if the file is uploaded
    if (!empty($_FILES['profile']['name'])) {
        $profile = $_FILES['profile']['name'];

        // Define the destination folder for the file
        $uploadFolder = '../book_img/' . DIRECTORY_SEPARATOR;

        // Check if the destination directory exists, create it if not
        if (!file_exists($uploadFolder)) {
            mkdir($uploadFolder, 0777, true);
        }

        // Move the file to the destination folder
        $uploadPath = $uploadFolder . $profile;

        if (!move_uploaded_file($_FILES['profile']['tmp_name'], $uploadPath)) {
            echo json_encode(['success' => false, 'error' => 'Failed to move uploaded file.']);
            exit;
        }
    } else {
        $profile = null;
    }

    // Update book
    $result = $book->updateBook($bookId, $bookTitle, $bookGenre, $bookAuthor, $bookISBN,$bookCopy, $bookShelf, $bookPublisher, $bookCategory, $bookSummary,$profile);

    // Send a JSON response indicating success or failure
    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to update book.']);
    }
}
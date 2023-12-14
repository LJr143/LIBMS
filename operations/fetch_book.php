<?php
error_reporting(E_ALL);
require_once '../db_config/config.php';
include '../includes/fetch_books_data.php';

$database = new Database();
$book = new BookData($database);

// Check if bookId is set in the POST data
if (isset($_POST['bookId'])) {
    $bookId = $_POST['bookId'];

    // Fetch book data based on bookId
    $bookData = $book->getBookById($bookId);

    // Return data as JSON
    header('Content-Type: application/json');
    echo json_encode($bookData);
} else {
    // Return an error response if bookId is not set
    header('Content-Type: application/json');
    echo json_encode(['error' => 'bookId is not set in the POST data']);
}
?>

<?php
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
include 'C:\wamp64\www\LIBMS\includes\fetch_books_data.php';
$database = new Database();
$book = new BookData($database);



// Assuming you have a method to fetch staff data based on admin_id
$bookId = $_POST['bookId'];
$bookData = $book->getBookById($bookId);

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($bookData);

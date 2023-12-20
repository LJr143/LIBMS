<?php
session_start();
error_reporting(0);
require_once '../db_config/config.php';
include '../includes/fetch_books_data.php';
include '../includes/logs_operation.php';

$database = new Database();
$log = new Logs($database);

$database = new Database();
$bookData = new BookData($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the admin_id from the POST request
    $bookId = $_POST['book_id'];
    $bookName = $_POST['bookName'];

    // Delete the staff member
    $success = $bookData->deleteBook($bookId);


    // Send a JSON response indicating success or failure
    header('Content-Type: application/json');
    $deleteBookLog = $log->deleteAddBookLogs($_SESSION['loggedAdminID'], $_SESSION['user'], $bookName);
    echo json_encode(['success' => $success]);
} else {
    // Handle other request methods or invalid requests
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Invalid request']);
}
?>

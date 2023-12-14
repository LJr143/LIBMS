<?php
require_once '../db_config/config.php';
include '../includes/fetch_books_data.php';
include '../includes/logs_operation.php';


$database = new Database();
$bookData = new BookData($database);
$log = new Logs($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookID = $_POST['bookId'];
    $userID = $_POST['userId'];
    $date = $_POST['date'];

    $success = $bookData->borrowBook($userID,$bookID,$date);

    // Send a JSON response indicating success or failure
    header('Content-Type: application/json');
    echo json_encode(['success' => $success]);
} else {
    // Handle other request methods or invalid requests
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Invalid request']);
}


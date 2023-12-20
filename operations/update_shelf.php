<?php
session_start();
require_once '../db_config/config.php';
include '../includes/fetch_shelf_data.php';
include '../includes/logs_operation.php';
$database = new Database();
$log = new Logs($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the data sent through AJAX
    $Id = $_POST['Id'];
    $shelfId = $_POST['shelfId'];
    $shelfCategory = $_POST['shelfCategory'];



    // Create an instance of the college class
    $shelf = new ShelfData($database);


    // Update college
    $result = $shelf->updateShelf($Id,$shelfId, $shelfCategory);

    // Send a JSON response indicating success or failure
    if ($result) {
        $action = "{$_SESSION['user']} edit shelf category {$shelfCategory}";
        $addLog = $log->insertAddCollegeLogs($_SESSION['loggedAdminID'], $action);
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to update book.']);
    }
}
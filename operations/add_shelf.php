<?php

require_once '../db_config/config.php';
include '../includes/fetch_shelf_data.php';
include '../includes/logs_operation.php';

$database = new Database();
$log = new Logs($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $shelfId = $_POST['shelfId'];
        $shelfCategory = $_POST['shelfCategory'];

        $shelf = new ShelfData($database);

        $result = $shelf->addShelf($shelfId, $shelfCategory);

        header('Content-Type: application/json');
        echo json_encode($result);
    } catch (Exception $e) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}

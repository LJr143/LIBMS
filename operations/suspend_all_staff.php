<?php
require_once '../db_config/config.php';
include '../includes/fetch_staff_data.php';

$database = new Database();
$staffData = new StaffData($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $suspendAll = $staffData->suspendAllStaff();

    header('Content-Type: application/json');
    if ($suspendAll) {
            echo json_encode(['success' => true]);

    } else {
        echo json_encode(['failed' => false, 'error' => 'Error Suspending Staff!']);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid Request!']);
}


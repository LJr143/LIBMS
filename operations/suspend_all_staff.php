<?php
session_start();
require_once '../db_config/config.php';
include '../includes/fetch_staff_data.php';
include '../includes/logs_operation.php';

$database = new Database();
$staffData = new StaffData($database);
$log = new Logs($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $suspendAll = $staffData->suspendAllStaff();

    header('Content-Type: application/json');
    if ($suspendAll) {
        $action = "{$_SESSION['user']} suspend all staff";
        $addLog = $log->insertAddCollegeLogs($_SESSION['loggedAdminID'], $action);
            echo json_encode(['success' => true]);

    } else {
        echo json_encode(['failed' => false, 'error' => 'Error Suspending Staff!']);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid Request!']);
}


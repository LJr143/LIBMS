<?php
require_once '../db_config/config.php';
include '../includes/fetch_superadmin_data.php';

$database = new Database();
$superadminData = new SuperAdminData($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['userId'];
    $password = $_POST['password'];

    $checkPass = $superadminData->confirmPasswordSuperAdmin($userId,$password);

    header('Content-Type: application/json');
    if ($checkPass) {
            echo json_encode(['success' => true]);

    } else {
        echo json_encode(['failed' => false, 'error' => 'Incorrect Password!']);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid Request!']);
}


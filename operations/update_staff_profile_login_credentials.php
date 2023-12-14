<?php
session_start();
require_once '../db_config/config.php';
include '../includes/fetch_staff_data.php';
include '../includes/logs_operation.php';
$database = new Database();
$log = new Logs($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the data sent through AJAX
    $staffId = $_POST['staffId'];
   $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Create an instance of the Staff class
    $staff = new StaffData($database);
    // Update the staff data
    $result = $staff-> updateStaffLoginProfile($staffId,$oldPassword,$newPassword,$confirmPassword);

    // Send a JSON response indicating success or failure
    if ($result) {

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to update staff member.']);
    }
}

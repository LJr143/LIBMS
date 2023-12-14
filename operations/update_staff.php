<?php
session_start();
require_once '../db_config/config.php';
include '../includes/fetch_staff_data.php';
include '../includes/logs_operation.php';
$database = new Database();
$log = new Logs($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the data sent through AJAX
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $mi = $_POST['mi'];
    $staffID = $_POST['staffID'];
    $officeEmail = $_POST['officeEmail'];
    $PhoneNumber = $_POST['PhoneNumber'];
    $Telephone = $_POST['Telephone'];
    $address = $_POST['Address'];
    $role = $_POST['role'];
    $personalEmail = $_POST['personalEmail'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Create an instance of the Staff class
    $staff = new StaffData($database);

    // Check if the file is uploaded
    if (!empty($_FILES['profile']['name'])) {
        $profile = $_FILES['profile']['name'];

        // Define the destination folder for the file
        $uploadFolder = '../img/' . DIRECTORY_SEPARATOR;

        // Check if the destination directory exists, create it if not
        if (!file_exists($uploadFolder)) {
            mkdir($uploadFolder, 0777, true);
        }

        // Move the file to the destination folder
        $uploadPath = $uploadFolder . $profile;

        if (!move_uploaded_file($_FILES['profile']['tmp_name'], $uploadPath)) {
            echo json_encode(['success' => false, 'error' => 'Failed to move uploaded file.']);
            exit;
        }
    } else {
        $profile = null;
    }

    // Update the staff data
    $result = $staff->updateStaff($staffID, $firstName, $lastName, $mi, $personalEmail, $officeEmail, $PhoneNumber, $Telephone, $address, $role, $username, $password, $profile);

    // Send a JSON response indicating success or failure
    if ($result) {
        $addedStaff = $firstName . " " . $lastName;
        $addLog = $log->editAddLogs($_SESSION['loggedAdminID'], $_SESSION['user'], $addedStaff);
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to add staff member.']);
    }
}

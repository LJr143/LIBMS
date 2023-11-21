<?php
session_start();
error_reporting(0);

require_once '..\db_config\config.php';
include '../includes/fetch_staff_data.php';
include '..\includes\logs_operation.php';
$database = new Database();
$log = new Logs($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $mi = $_POST['mi'];
    $staffID = $_POST['staffID'];
    $officeEmail = $_POST['officeEmail'];
    $PhoneNumber = $_POST['PhoneNumber'];
    $Telephone = $_POST['Telephone'];
    $address = $_POST['address'];
    $role = $_POST['role'];
    $personalEmail = $_POST['personalEmail'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $staff = new StaffData($database);

    if (!empty($_FILES['profile']['name'])) {
        $profile = $_FILES['profile']['name'];

        $uploadFolder = '../img/' . DIRECTORY_SEPARATOR;

        if (!file_exists($uploadFolder)) {
            mkdir($uploadFolder, 0777, true);
        }

        $uploadPath = $uploadFolder . $profile;

        if (!move_uploaded_file($_FILES['profile']['tmp_name'], $uploadPath)) {
            echo json_encode(['success' => false, 'error' => 'Failed to move uploaded file.']);
            exit;
        }
    } else {
        $profile = null;
    }

    $result = $staff->addStaff($firstName, $lastName, $mi, $staffID, $officeEmail, $personalEmail, $PhoneNumber, $Telephone, $address, $role, $username, $password, $profile);

    if ($result) {
        $addedStaff = $firstName ." ". $lastName;
        $addLog = $log->insertAddLogs($_SESSION['loggedAdminID'],$_SESSION['user'],$addedStaff);
        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to add staff member.']);
    }
}
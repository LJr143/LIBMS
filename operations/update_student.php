<?php
session_start();
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
include '../includes/fetch_student_data.php';
include '../includes/logs_operation.php';
$database = new Database();
$log = new Logs($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the data sent through AJAX
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $mi = $_POST['mi'];
    $studentID = $_POST['studentID'];
    $personalEmail = $_POST['personalEmail'];
    $phoneNumber = $_POST['phoneNumber'];
    $address = $_POST['address'];
    $year = $_POST['year'];
    $course = $_POST['course'];
    $major = $_POST['major'];
    $usepEmail = $_POST['usepEmail'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Create an instance of the Staff class
    $student = new StudentData($database);

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
    $result = $student->updateStudent($firstName, $lastName, $mi, $studentID, $personalEmail,$usepEmail, $phoneNumber, $address, $year, $course, $major, $username, $password,$profile);

    // Send a JSON response indicating success or failure
    if ($result) {
//        $addedStaff = $firstName . " " . $lastName;
//        $addLog = $log->editAddLogs($_SESSION['loggedAdminID'], $_SESSION['user'], $addedStaff);
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to add staff member.']);
    }
}

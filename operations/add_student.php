<?php
session_start();
require_once '..\db_config\config.php';
include '../includes/fetch_student_data.php';
include '..\includes\logs_operation.php';

$database = new Database();
$log = new Logs($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
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

        $student = new studentData($database);

        if (!empty($_FILES['profile']['name'])) {
            $profile = $_FILES['profile']['name'];

            $uploadFolder = '../img/' . DIRECTORY_SEPARATOR;

            if (!file_exists($uploadFolder)) {
                mkdir($uploadFolder, 0777, true);
            }

            $uploadPath = $uploadFolder . $profile;

            if (!move_uploaded_file($_FILES['profile']['tmp_name'], $uploadPath)) {
                throw new Exception('Failed to move uploaded file.');
            }
        } else {
            $profile = null;
        }

        $result = $student->addstudent($firstName, $lastName, $mi, $studentID, $personalEmail, $usepEmail, $phoneNumber, $address, $year, $course, $major, $username, $password, $profile);

        if ($result) {
//            $addedstudent = $firstName . " " . $lastName;
//            $addLog = $log->insertAddLogs($_SESSION['loggedAdminID'], $_SESSION['user'], $addedstudent);
            header('Content-Type: application/json');
            echo json_encode(['success' => true]);
        } else {
            throw new Exception('Failed to add student member.');
        }
    } catch (Exception $e) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}
?>

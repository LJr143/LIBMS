<?php
session_start();
require_once '../db_config/config.php';
include '../includes/fetch_student_data.php';
include '../includes/logs_operation.php';
$database = new Database();
$log = new Logs($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validation function to check required fields
    function validateFields($fields) {
        foreach ($fields as $field) {
            if (empty($_POST[$field])) {
                return $field; // Return the first field that is empty
            }
        }
        return null; // All fields are filled
    }

    // Check required fields
    $requiredFields = ['first_name', 'last_name', 'studentID', 'personalEmail', 'usepEmail', 'phoneNumber', 'address', 'year', 'course', 'major'];
    $emptyField = validateFields($requiredFields);

    if ($emptyField !== null) {
        echo json_encode(['success' => false, 'validationError' => true, 'field' => $emptyField, 'message' => 'Please fill in all required fields.']);
        exit;
    }

    // Validate phone number format (11 digits)
    $phoneNumber = $_POST['phoneNumber'];
    if (!preg_match('/^\d{11}$/', $phoneNumber)) {
        echo json_encode(['success' => false, 'validationError' => true, 'field' => 'phoneNumber', 'message' => 'Invalid Phone Number. Follow the format 09*********.']);
        exit;
    }
    // Validate first name format (allow letters and spaces, but disallow numbers)
    $firstName = $_POST['first_name'];
    if (!preg_match('/^[A-Za-z\s]*[A-Za-z][A-Za-z\s]*$/u', $firstName)) {
        echo json_encode(['success' => false, 'validationError' => true, 'field' => 'first_name', 'message' => 'Invalid First Name.  It should only contain letters.']);
        exit;
    }

    $lastName = $_POST['last_name'];
    if (!preg_match('/^[A-Za-z\s]+$/u', $lastName)) {
        echo json_encode(['success' => false, 'validationError' => true, 'field' => 'last_name', 'message' => 'Invalid Last Name .  It should only contain letters']);
        exit;
    }


    $address = $_POST['address'];
    if (!preg_match('/^[A-Za-z0-9\s.,\-]+$/u', $address)) {
        echo json_encode(['success' => false, 'validationError' => true, 'field' => 'address', 'message' => 'Invalid address format.']);
        exit;
    }
    // Validate personal email format (only allow @gmail.com)
    $personalEmail = $_POST['personalEmail'];
    if (!preg_match('/^.*@gmail\.com$/i', $personalEmail)) {
        echo json_encode(['success' => false, 'validationError' => true, 'field' => 'personalEmail', 'message' => 'Invalid Personal Email format.']);
        exit;
    }



    $mi = $_POST['mi'];
    $year = $_POST['year'];
    $studentID = $_POST['studentID'];
    $usepEmail = $_POST['usepEmail'];
    $course = $_POST['course'];
    $major = $_POST['major'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Create an instance of the StudentData class
    $student = new StudentData($database);

    // Check if the file is uploaded
    if (!empty($_FILES['editprofile']['name'])) {
        $profile = $_FILES['editprofile']['name'];

        $uploadFolder = '../img/' . DIRECTORY_SEPARATOR;

        if (!file_exists($uploadFolder)) {
            mkdir($uploadFolder, 0777, true);
        }

        // Move the file to the destination folder
        $uploadPath = $uploadFolder . $profile;

        if (!move_uploaded_file($_FILES['editprofile']['tmp_name'], $uploadPath)) {
            echo json_encode(['success' => false, 'error' => 'Failed to move uploaded file.']);
            exit;
        }    } else {
        $profile = null;
    }

    // Update the student data
    $result = $student->updateStudent($firstName, $lastName, $mi, $studentID, $personalEmail, $usepEmail, $phoneNumber, $address, $year, $course, $major, $username, $password, $profile);

    // Send a JSON response indicating success or failure
    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to update student.']);
    }
}
?>
<?php
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
include '../includes/fetch_staff_data.php';
$database = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the data sent through AJAX
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

    // Call the add function from your Admin class
    $result = $staff->addStaff($firstName, $lastName, $mi, $staffID, $officeEmail, $personalEmail, $PhoneNumber, $Telephone, $address, $role, $username, $password, $profile);

    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to add staff member.']);
    }
}
?>

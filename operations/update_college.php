
<?php
session_start();
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
include 'C:\wamp64\www\LIBMS\includes\fetch_college_data.php';
include 'C:\wamp64\www\LIBMS\includes\logs_operation.php';
$database = new Database();
$log = new Logs($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the data sent through AJAX
    $collegeId = $_POST['collegeId'];
    $collegeName = $_POST['collegeName'];


    // Create an instance of the college class
    $college = new CollegeData($database);


    // Update college
    $result = $college->updateCollege($collegeId, $collegeName);

    // Send a JSON response indicating success or failure
    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to update book.']);
    }
}
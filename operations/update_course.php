<?php
session_start();
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
include 'C:\wamp64\www\LIBMS\includes\fetch_college_data.php';
include 'C:\wamp64\www\LIBMS\includes\logs_operation.php';
$database = new Database();
$log = new Logs($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the data sent through AJAX
    $collegeId = $_POST['editCollege'];
    $courseName = $_POST['editCourse'];
    $courseMajor = $_POST['editMajor'];
    $courseId = $_POST['courseId'];


    // Create an instance of the college class
    $course = new CourseData($database);


    // Update college
    $result = $course->updateCourse($courseId,$collegeId, $courseName, $courseMajor);

    // Send a JSON response indicating success or failure
    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to update book.']);
    }
}
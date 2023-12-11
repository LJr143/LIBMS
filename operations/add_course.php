<?php
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
include 'C:\wamp64\www\LIBMS\includes\fetch_college_data.php';
include 'C:\wamp64\www\LIBMS\includes\logs_operation.php';

$database = new Database();
$log = new Logs($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $collegeId = $_POST['collegeId'];
        $courseName = $_POST['courseName'];

        $course = new CourseData($database);

        $result = $course->addCourse($collegeId, $courseName);

        header('Content-Type: application/json');
        echo json_encode($result);
    } catch (Exception $e) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}

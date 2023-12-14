<?php
require_once '../db_config/config.php';
include '../includes/fetch_college_data.php';
include '../includes/logs_operation.php';

$database = new Database();
$log = new Logs($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $collegeId = $_POST['collegeId'];
        $courseName = $_POST['courseName'];
        $courseMajor = $_POST['courseMajor'];

        $course = new CourseData($database);

        $result = $course->addCourse($collegeId, $courseName, $courseMajor);

        header('Content-Type: application/json');
        echo json_encode($result);
    } catch (Exception $e) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}

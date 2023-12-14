<?php
require_once '../db_config/config.php';
include '../includes/fetch_college_data.php';
$database = new Database();
$course = new CourseData($database);



// Assuming you have a method to fetch staff data based on admin_id
$courseId = $_POST['courseId'];
$collegeId = $_POST['collegeId'];
$courseData = $course->getCourseInfo($courseId,$collegeId);

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($courseData);

<?php
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
include 'C:\wamp64\www\LIBMS\includes\fetch_college_data.php';
$database = new Database();
$course = new CourseData($database);



// Assuming you have a method to fetch staff data based on admin_id
$courseId = $_POST['courseId'];
$collegeId = $_POST['collegeId'];
$courseData = $course->getCourseInfo($courseId,$collegeId);

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($courseData);

<?php

require_once '../db_config/config.php';
require_once '../includes/fetch_college_data.php';

$database = new Database();
$courseData = new CourseData($database);
$fetchCourseOption = $courseData->getAllCourses();

// Output the data as JSON
header('Content-Type: application/json');
echo json_encode($fetchCourseOption);


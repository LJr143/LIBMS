<?php

require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
require_once 'C:\wamp64\www\LIBMS\includes\fetch_college_data.php';

$database = new Database();
$courseData = new CourseData($database);
$fetchCourseOption = $courseData->getAllCourses();

// Output the data as JSON
header('Content-Type: application/json');
echo json_encode($fetchCourseOption);


<?php
require_once '../db_config/config.php';
include '../includes/fetch_college_data.php';
$database = new Database();
$college = new CollegeData($database);



// Assuming you have a method to fetch staff data based on admin_id
$collegeId = $_POST['collegeId'];
$collegeData = $college->getCollegeById($collegeId);

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($collegeData);

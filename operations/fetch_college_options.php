<?php

require_once '../db_config/config.php';
require_once '../includes/fetch_college_data.php';

$database = new Database();
$collegeData = new CollegeData($database);
$fetchCollegeOption = $collegeData->getAllCollege();

// Output the data as JSON
header('Content-Type: application/json');
echo json_encode($fetchCollegeOption);


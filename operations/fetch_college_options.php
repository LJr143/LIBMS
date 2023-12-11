<?php

require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
require_once 'C:\wamp64\www\LIBMS\includes\fetch_college_data.php';

$database = new Database();
$collegeData = new CollegeData($database);
$fetchCollegeOption = $collegeData->getAllCollege();

// Output the data as JSON
header('Content-Type: application/json');
echo json_encode($fetchCollegeOption);


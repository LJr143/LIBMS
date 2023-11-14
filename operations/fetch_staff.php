<?php
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
include 'C:\wamp64\www\LIBMS\includes\fetch_staff_data.php';
$database = new Database();
$staff = new StaffData($database);



// Assuming you have a method to fetch staff data based on admin_id
$adminId = $_POST['adminId'];
$staffData = $staff->getStaffById($adminId);

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($staffData);

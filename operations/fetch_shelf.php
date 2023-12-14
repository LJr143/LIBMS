<?php
require_once '../db_config/config.php';
include '../includes/fetch_shelf_data.php';
$database = new Database();
$shelf = new ShelfData($database);



// Assuming you have a method to fetch staff data based on admin_id
$id = $_POST['shelfId'];
$shelfData = $shelf->getShelfById($id);

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($shelfData);

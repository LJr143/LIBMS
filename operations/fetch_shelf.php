<?php
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
include 'C:\wamp64\www\LIBMS\includes\fetch_shelf_data.php';
$database = new Database();
$shelf = new ShelfData($database);



// Assuming you have a method to fetch staff data based on admin_id
$id = $_POST['shelfId'];
$shelfData = $shelf->getShelfById($id);

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($shelfData);

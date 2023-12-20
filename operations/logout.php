<?php

require_once '../db_config/config.php';
require_once '../includes/authentication.php';

// Initialize the database and authentication classes
$database = new Database();
$userAuth = new UserAuthentication($database);

// Perform the logout operation
$logoutData = array('success' => false);

if ($userAuth->logout()) {
    $logoutData['success'] = true;
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($logoutData);
?>

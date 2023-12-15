<?php
require_once '../db_config/config.php';
include '../includes/fetch_access_data.php';

$database = new Database();
$accessData = new AccessData($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = $_POST['code'];
    $isValid = $accessData->checkAccessCode($code);
    $accesstype = $accessData->getAccessType($code);

    header('Content-Type: application/json');
    if ($isValid) {

        if($accesstype == 'Administrator'){
            echo json_encode(['administrator' => true]);
        }
        else {
            echo json_encode(['user' => true]);
        }

    } else {
        echo json_encode(['isValid' => false, 'error' => 'Access Code Not Found!']);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid Request!']);
}


<?php
date_default_timezone_set('Asia/Manila');
require_once '../db_config/config.php';
include '../includes/fetch_feedback_data.php';
include '../includes/logs_operation.php';

$database = new Database();
$log = new Logs($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Validate and sanitize input
        $userid = isset($_POST['userId']) ? htmlspecialchars($_POST['userId'], ENT_QUOTES, 'UTF-8') : null;
        $comment = isset($_POST['comment']) ? htmlspecialchars($_POST['comment'], ENT_QUOTES, 'UTF-8') : null;
        $star_count = isset($_POST['rating']) ? filter_var($_POST['rating'], FILTER_VALIDATE_INT) : null;

        if ($userid === null || $comment === null || $star_count === false) {
            throw new Exception('Invalid input data.');
        }

        $feedback = new FeedbackData($database);

        $result = $feedback->addFeedback($userid, $comment, $star_count);

        // Standardized response format
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'data' => $result]);
    } catch (Exception $e) {
        // Standardized error response
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }

}
?>

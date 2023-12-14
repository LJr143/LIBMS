<?php
require_once '../db_config/config.php';
include '../includes/fetch_feedback_data.php';
include '../includes/logs_operation.php';

$database = new Database();
$log = new Logs($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Validate and sanitize input
        $userId = filter_input(INPUT_POST, 'userId', FILTER_SANITIZE_STRING);
        $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
        $star_count = filter_input(INPUT_POST, 'rating', FILTER_VALIDATE_INT);
        $bookId = filter_input(INPUT_POST, 'bookId', FILTER_SANITIZE_STRING);

        if ($userId === false || $comment === null || $star_count === false) {
            throw new Exception('Invalid input data.');
        }

        $feedback = new FeedbackData($database);

        $result = $feedback->addBookReview($userId, $comment, $star_count, $bookId);

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

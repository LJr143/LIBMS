<?php
session_start();
error_reporting(E_ALL);
error_log(print_r($_POST, true));
require_once '../db_config/config.php';
include '../includes/fetch_books_data.php';
include '../includes/logs_operation.php';

$database = new Database();
$log = new Logs($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Check if required parameters are set
        if (!isset($_POST['transactionId'], $_POST['status'])) {
            throw new Exception('Missing required parameters.');
        }

        $transactionId = $_POST['transactionId'];
        $status = $_POST['status'];

        // Validate or sanitize input values if needed

        $book = new BookData($database);

        $result = $book->bookRequest($status, $transactionId, $_SESSION['staffId']);

        header('Content-Type: application/json');
        echo json_encode($result);
    } catch (Exception $e) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}
?>

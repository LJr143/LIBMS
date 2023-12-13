<?php
error_reporting(E_ALL);
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
include 'C:\wamp64\www\LIBMS\includes\fetch_transaction_data.php';

$database = new Database();
$transaction = new TransactionData($database);

try {
    // Check if the 'transactionId' index is set in the $_POST array
    if (isset($_POST['transactionId'])) {
        // Assuming you have a method to fetch transaction data based on transactionId
        $transactionId = $_POST['transactionId'];
        $transactionData = $transaction->getTransactionById($transactionId);

        if ($transactionData !== null) {
            // Return data as JSON
            header('Content-Type: application/json');
            echo json_encode($transactionData);
        } else {
            // Log the error
            error_log('Transaction not found for ID: ' . $transactionId);

            // Return an error JSON response
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Transaction not found']);
        }
    } else {
        // Return an error JSON response if 'transactionId' is not set
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Transaction ID not provided']);
    }

} catch (Exception $e) {
    // Log the exception
    error_log('Exception: ' . $e->getMessage());

    // Handle exceptions and return an error JSON response
    header('Content-Type: application/json');
    echo json_encode(['error' => $e->getMessage()]);
}

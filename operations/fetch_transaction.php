<?php
error_reporting(E_ALL);
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
include 'C:\wamp64\www\LIBMS\includes\fetch_transaction_data.php';

$database = new Database();
$transaction = new TransactionData($database);

try {
    // Assuming you have a method to fetch transaction data based on transactionId
    $transactionId = $_POST['transactionId'];
    $transactionData = $transaction->getTransactionById($transactionId);

    // Return data as JSON
    error_log('Transaction Data: ' . json_encode($transactionData));
    header('Content-Type: application/json');
    echo json_encode($transactionData);

} catch (Exception $e) {
    // Handle exceptions and return an error JSON response
    header('Content-Type: application/json');
    echo json_encode(['error' => $e->getMessage()]);
}

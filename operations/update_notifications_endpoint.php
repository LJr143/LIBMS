<?php
require_once '../db_config/config.php';
include '../includes/fetch_transaction_data.php';

$database = new Database();
$transactionData = new TransactionData($database);
$transaction = $transactionData->getPendingTransaction();

// Output transactions in JSON format
header('Content-Type: application/json');
echo json_encode($transaction);

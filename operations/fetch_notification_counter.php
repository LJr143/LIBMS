<?php
error_reporting(E_ALL);
require_once '../db_config/config.php';
include '../includes/fetch_transaction_data.php';


$database = new Database();
$transactionData = new TransactionData($database);
$pendingTransaction = $transactionData->getPendingTransactionCount();

header('Content-Type: application/json');
echo json_encode($pendingTransaction);
?>
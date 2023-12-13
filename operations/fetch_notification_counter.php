<?php
error_reporting(E_ALL);
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
include 'C:\wamp64\www\LIBMS\includes\fetch_transaction_data.php';


$database = new Database();
$transactionData = new TransactionData($database);
$pendingTransaction = $transactionData->getPendingTransactionCount();

header('Content-Type: application/json');
echo json_encode($pendingTransaction);
?>
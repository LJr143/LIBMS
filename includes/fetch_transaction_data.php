<?php
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';

class TransactionData
{
    protected $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getAllTransaction(): array
    {
        $sql = "SELECT * FROM vw_book_request";
        $stmt = $this->database->executeQuery($sql);

        // Fetch all records
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getPendingTransaction(): array
    {
        $status = 'Pending';
        $sql = "SELECT * FROM vw_book_request WHERE status = :status";
        $params = array(':status' => $status);
        $stmt = $this->database->executeQuery($sql, $params);

        // Fetch all records
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}


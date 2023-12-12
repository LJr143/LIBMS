<?php
error_reporting(E_ALL);
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
    public function getTransactionById($transactionId): array
    {
        $sql = "SELECT * FROM vw_book_request WHERE id = :transactionId";

        try {
            $stmt = $this->database->getDb()->prepare($sql);
            $stmt->bindParam(':transactionId', $transactionId, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $errorInfo = $stmt->errorInfo();
                if ($errorInfo[0] !== '00000') {
                    // Log or print the error information
                    error_log("Database error: " . $errorInfo[2]);
                }

                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return array();
            }
        } catch (PDOException $e) {
            // Handle PDO exception
            error_log("PDO Exception: " . $e->getMessage());
            return array();
        }
    }

}


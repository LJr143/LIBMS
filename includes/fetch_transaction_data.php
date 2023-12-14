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

    public function getAllTransactionByUser($user_id): array
    {
        $sql = "SELECT * FROM vw_book_request WHERE user_id = :user_id";
        try {
            $stmt = $this->database->getDb()->prepare($sql);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);

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
    public function getPendingTransaction(): array
    {
        $status = 'Pending';
        $sql = "SELECT * FROM vw_book_request WHERE status = :status";
        $params = array(':status' => $status);
        $stmt = $this->database->executeQuery($sql, $params);

        // Fetch all records
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getPendingTransactionCount(): int
    {
        $status = 'Pending';
        $sql = "SELECT COUNT(*) as num_pending_transaction FROM vw_book_request WHERE status = :status";
        $params = array(':status' => $status);
        $stmt = $this->database->executeQuery($sql, $params);

        if ($stmt->execute()) {
            return (int) $stmt->fetch(PDO::FETCH_ASSOC)['num_pending_transaction'];
        } else {
            return 0;
        }
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

    public function getTransactionByUser($user_id): array
    {
        $sql = "SELECT * FROM vw_book_request WHERE user_id = :user_id AND status = 'Approved'";

        try {
            $stmt = $this->database->getDb()->prepare($sql);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);

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


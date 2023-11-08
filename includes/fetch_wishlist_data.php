<?php
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';

$database = new Database();

class WishData
{
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllBooks(): array
    {
        $sql = "SELECT * FROM tbl_wishlist";
        $stmt = $this->db->executeQuery($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

class WishDataWithStatus extends WishData
{
    public function getBooksByStatus($status): array
    {
        $sql = "SELECT * FROM tbl_wishlist WHERE status = :status";
        $params = [':status' => $status];
        $stmt = $this->db->executeQuery($sql, $params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

// Example usage:
$wishData = new WishDataWithStatus($database);

$allBooks = $wishData->getAllBooks();
$availableBooks = $wishData->getBooksByStatus('available');

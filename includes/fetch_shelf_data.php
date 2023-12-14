
<?php
require_once '../db_config/config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

class ShelfData
{
    protected $database;

    public function __construct($database)
    {
        $this->database = $database->getDb();
    }

    public function getAllShelf(): array
    {
        $sql = "SELECT * FROM tbl_shelf";
        $stmt = $this->database->query($sql);

        if ($stmt) {
            $shelf = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $shelf;
        } else {
            return array();
        }
    }

    public function getNumberOfShelfs(): int
    {
        $sql = "SELECT COUNT(*) as num_shelfs FROM tbl_shelf";
        $stmt = $this->database->prepare($sql);

        if ($stmt->execute()) {
            return (int) $stmt->fetch(PDO::FETCH_ASSOC)['num_shelfs'];
        } else {
            return 0;
        }
    }



    public function getShelfById($shelfId): array
    {
        $sql = "SELECT * FROM tbl_shelf WHERE id = :shelfId";
        $stmt = $this->database->prepare($sql);
        $stmt->bindParam(':shelfId', $shelfId, PDO::PARAM_STR);

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
    }
    public function addShelf($shelfID, $shelfCategory): array
    {
        $sql = "INSERT INTO tbl_shelf (shelf_id, shelf_category) VALUES (:shelfID, :shelfCategory)";
        $stmt = $this->database->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':shelfID', $shelfID, PDO::PARAM_STR);
        $stmt->bindParam(':shelfCategory', $shelfCategory, PDO::PARAM_STR);

        // Execute the query
        $success = $stmt->execute();

        // Return an array with success information
        return [
            'success' => $success,
            'message' => $success ? 'Shelf added successfully' : 'Failed to add shelf',
        ];
    }

    public function updateShelf($id,$shelfID, $shelfCategory): array
    {
        $sql = "UPDATE tbl_shelf SET shelf_id = :shelfID, shelf_category = :shelfCategory WHERE id = :ID";
        $stmt = $this->database->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':ID', $id, PDO::PARAM_STR);
        $stmt->bindParam(':shelfCategory', $shelfCategory, PDO::PARAM_STR);
        $stmt->bindParam(':shelfID', $shelfID, PDO::PARAM_STR);

        // Execute the query
        $success = $stmt->execute();

        // Return an array with success information
        return [
            'success' => $success,
            'message' => $success ? 'Shelf updated successfully' : 'Failed to update shelf',
        ];
    }
    public function deleteShelf($shelfId){
        $sql = "DELETE FROM tbl_shelf WHERE id = :shelf_ID";

        $stmt = $this->database->prepare($sql);
        $stmt->bindParam(':shelf_ID', $shelfId, PDO::PARAM_STR);

        return $stmt->execute();
    }

}
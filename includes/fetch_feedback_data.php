<?php
date_default_timezone_set('Asia/Manila');
require_once '../db_config/config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

class FeedbackData
{
    protected $database;

    public function __construct($database)
    {
        $this->database = $database->getDb();
    }

    public function getAllFeedback(): array
    {
        $sql = "SELECT * FROM vw_feedback";
        $stmt = $this->database->query($sql);

        if ($stmt) {
            $feedback = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $feedback;
        } else {
            return array();
        }
    }
    public function getFeedbackById($userId): array
    {
        $sql = "SELECT * FROM tbl_user WHERE user_id = :userId";
        $stmt = $this->database->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return array();
        }
    }

    public function addFeedback($user_id, $comment, $star_count): bool
    {
        $sql = "INSERT INTO tbl_feedback (user_id, feedback_comments, star_count)
            VALUES (:user_id, :feedback_comments, :star_count)";
        $stmt = $this->database->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->bindParam(':feedback_comments', $comment, PDO::PARAM_STR);
        $stmt->bindParam(':star_count', $star_count, PDO::PARAM_INT);

        // Execute the query
        return $stmt->execute();
    }
    public function addBookReview($user_id, $comment, $star_count, $bookId): bool
    {
        $sql = "INSERT INTO tbl_book_rating(user_id, book_id, comment,rating)
            VALUES (:user_id, :book_id, :feedback_comments, :star_count)";
        $stmt = $this->database->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->bindParam(':feedback_comments', $comment, PDO::PARAM_STR);
        $stmt->bindParam(':star_count', $star_count, PDO::PARAM_INT);
        $stmt->bindParam(':book_id', $bookId, PDO::PARAM_STR);

        // Execute the query
        return $stmt->execute();
    }


}


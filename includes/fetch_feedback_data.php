<?php
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Example function to fetch feedback data from the database
function fetchFeedbackData() {
    // Replace this with your actual database connection logic
    $database = new Database(); // Assuming you have a Database class for handling database connections

    // Replace this with your actual SQL query to fetch feedback data
    $sql = "SELECT * FROM tbl_feedback";
    $stmt = $database->executeQuery($sql);

    // Fetch data as an associative array
    $feedbackData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $feedbackData;
}

if (isset($_POST['feedback_id'])) {
    try {
        // Connect to your database (modify the connection details accordingly)
        $pdo = new PDO("mysql:host=localhost;dbname=lms_db", "root", " ");
        
        // Prepare and execute the DELETE query
        $stmt = $pdo->prepare("DELETE FROM tbl_feedback WHERE feedback_id = :feedback_id");
        $stmt->bindParam(':feedback_id', $_POST['feedback_id'], PDO::PARAM_INT);
        $stmt->execute();

        // Provide a JSON response indicating success
        echo json_encode(['status' => 'success', 'message' => 'Feedback deleted successfully']);
    } catch (PDOException $e) {
        // Provide a JSON response indicating failure
        echo json_encode(['status' => 'error', 'message' => 'Error deleting feedback: ' . $e->getMessage()]);
    }
}

?>

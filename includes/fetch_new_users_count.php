<?php
$host = 'localhost';
$database = 'u657994792_lms_db';
$username = 'u657994792_usep_tagum_lms';
$password = 'Usep_tagum_lms123';
try {
    // Create a PDO connection
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);

    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Calculate the date three weeks ago
    $threeWeeksAgo = date('Y-m-d', strtotime('-3 weeks'));

    // Perform the database query to get the count of new users created in the last three weeks
    $sql = "
        SELECT COUNT(*) AS new_users_count
        FROM tbl_user
        WHERE account_creation_date >= :three_weeks_ago
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':three_weeks_ago', $threeWeeksAgo);
    $stmt->execute();

    // Fetch the count
    $newUsersCount = $stmt->fetchColumn();

    // Return the data as JSON
    header('Content-Type: application/json');
    echo json_encode(['new_users_count' => $newUsersCount]);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

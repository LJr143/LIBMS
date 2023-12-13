<?php
$host = 'localhost';
$database = 'lms_db';
$username = 'root';
$password = '';

try {
    // Create a PDO connection
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);

    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Perform the database query to get quarterly counts for reserved and borrowed
    $sql = "
        SELECT
            transaction_type,
            quarter,
            count
        FROM
            vw_reserve_borrow_counts_quarterly
    ";

    $result = $conn->query($sql);

    // Fetch the data
    $data = $result->fetchAll(PDO::FETCH_ASSOC);

    // Return the data as JSON
    header('Content-Type: application/json');
    echo json_encode($data);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

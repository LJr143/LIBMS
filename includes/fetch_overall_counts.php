<?php
$host = 'localhost';
$database = 'u657994792_lms_db';
$username = 'root';
$password = '';

try {
    // Create a PDO connection
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);

    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Perform the database query using the view
    $sql = "SELECT * FROM vw_overall_counts"; // Use the view instead of joining tables
    $result = $conn->query($sql);

    // Fetch the data
    $data = $result->fetch(PDO::FETCH_ASSOC);

    // Close the database connection (PDO does not have a close method)

    // Return the data as JSON
    header('Content-Type: application/json');
    echo json_encode($data);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

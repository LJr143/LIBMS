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

    // Perform the database query to get quarterly counts for borrows
    $sqlBorrows = "
        SELECT
            QUARTER(`date`) AS quarter,
            COUNT(`borrow_id`) AS borrow_count
        FROM
            tbl_borrow
        GROUP BY
            quarter
    ";

    $resultBorrows = $conn->query($sqlBorrows);

    // Perform the database query to get quarterly counts for reserves
    $sqlReserves = "
        SELECT
            QUARTER(`reserve_date`) AS quarter,
            COUNT(`reserve_id`) AS reserve_count
        FROM
            tbl_reserve
        GROUP BY
            quarter
    ";

    $resultReserves = $conn->query($sqlReserves);

    // Fetch the data
    $dataBorrows = $resultBorrows->fetchAll(PDO::FETCH_ASSOC);
    $dataReserves = $resultReserves->fetchAll(PDO::FETCH_ASSOC);

    // Combine the borrows and reserves data
    $data = array(
        'borrows' => $dataBorrows,
        'reserves' => $dataReserves,
    );

    // Return the data as JSON
    header('Content-Type: application/json');
    echo json_encode($data);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>


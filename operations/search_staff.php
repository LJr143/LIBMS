<?php
// Connect to the database
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
$pdo = (new Database())->getDb();

// Retrieve the searchBy and searchInput values
$searchBy = $_POST['searchBy'];
$searchInput = $_POST['searchInput'];

// Validate the searchBy value
$allowedColumns = ['Part-Time', 'Full-Time', 'Staff', 'Faculty'];
foreach ($searchBy as $type) {
    if (!in_array($type, $allowedColumns)) {
        die('Invalid column name');
    }
}

// Construct the SQL query
$sql = "SELECT fname, lname, admin_role, status FROM tbl_admin WHERE CONCAT(fname, ' ', lname) LIKE ?";

if (in_array('Part-Time', $searchBy)) {
    $sql .= " AND status = 'Part-Time'";
} else if (in_array("Full-Time", $searchBy)) {
    $sql .= " AND status = 'Full-Time'";
}

if (in_array("Staff", $searchBy)) {
    $sql .= " AND admin_role = 'Staff'";
} else if (in_array("Faculty", $searchBy)) {
    $sql .= " AND admin_role = 'Faculty'";
}

// Prepare and execute the statement
$stmt = $pdo->prepare($sql);
$stmt->execute(["%$searchInput%"]);

// Fetch the results
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return the results as a JSON string
echo json_encode($results);
?>
<?php



// Database credentials
$host = 'localhost'; // e.g., 'localhost'
$dbname = 'lms_db';
$username = 'root';
$password = ' ';

// Establish a database connection using PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Set PDO to throw exceptions on errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle connection errors
    echo "Connection failed: " . $e->getMessage();
    // Optionally, log the error or take other actions
    die();
}


// Get the borrowId from the POST request
$borrowId = $_POST['borrowId'];

// Assuming you have a function to fetch detailed borrow information
// Replace this with your actual database query
$borrowDetails = fetchBorrowDetails($borrowId);

// Check if details are found
if ($borrowDetails) {
    // Output the details as JSON (you can customize this based on your needs)
    echo json_encode($borrowDetails);
} else {
    // Output an error message or handle as needed
    echo json_encode(['error' => 'Borrow details not found']);
}

// Function to fetch detailed borrow information
function fetchBorrowDetails($borrowId)
{
    global $pdo; // Assuming $pdo is your established PDO connection

    // Your SQL query
    $query = "SELECT
                u.fname,
                u.initial,
                u.lname,
                u.year,
                u.course,
                u.major,
                u.user_id,
                b.book_img,
                b.book_title,
                b.shelf,
                b.Author_id,
                b.publisher,
                bor.date_borrowed,
                bor.date_return
            FROM
                tbl_user u
            JOIN
                tbl_borrow bor ON u.user_id = bor.user_id
            JOIN
                tbl_book b ON bor.book_id = b.book_id
            WHERE
                bor.borrow_id = :borrowId";

    try {
        // Prepare the SQL statement
        $stmt = $pdo->prepare($query);

        // Bind parameters
        $stmt->bindParam(':borrowId', $borrowId, PDO::PARAM_INT);

        // Execute the query
        $stmt->execute();

        // Fetch the result as an associative array
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Return the result
        return $result;
    } catch (PDOException $e) {
        // Handle any errors (e.g., log the error)
        echo "Error: " . $e->getMessage();
        return false;
    }
}

// Example usage:
$borrowId = 123; // Replace with the actual borrowId you want to fetch
$result = fetchBorrowDetails($borrowId);

// Check if the result is not false (indicating success)
if ($result !== false) {
    print_r($result); // Output the fetched details
} else {
    // Handle the case where the details couldn't be fetched
    echo "Failed to fetch borrow details.";
}

?>

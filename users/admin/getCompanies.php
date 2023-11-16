<?php
session_start(); // Start the session
// Include the PDO database connection
require '../../config/dbconnect.php';

try {
    // Query to fetch company names with is_approve = 1
    $sql = "SELECT employer_id, company_name FROM employer_info WHERE is_approve = 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Fetch the results into an associative array
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return the data as JSON
    header('Content-Type: application/json');
    echo json_encode($rows);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$conn = null;
?>

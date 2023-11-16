<?php
// Include your PDO database connection
require_once '../../config/dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the employer ID from the AJAX request
    $employerId = $_POST['employerId'];

    // Perform the status update query
    $updateStatusQuery = "UPDATE employer_info SET is_approve = 1 WHERE id = :employerId";
    $stmt = $conn->prepare($updateStatusQuery);
    $stmt->bindParam(':employerId', $employerId, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the updated status
    $selectStatusQuery = "SELECT is_approve FROM employer_info WHERE id = :employerId";
    $stmtStatus = $conn->prepare($selectStatusQuery);
    $stmtStatus->bindParam(':employerId', $employerId, PDO::PARAM_INT);
    $stmtStatus->execute();
    $status = ($stmtStatus->fetch(PDO::FETCH_ASSOC)['is_approve'] == 1) ? 'Approved' : 'Pending';

    // Return the updated status to the client
    echo $status;
} else {
    // Return an error if the request method is not POST
    echo 'Error: Invalid request method.';
}
?>

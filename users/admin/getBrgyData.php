<?php
// Include your PDO database connection
require_once '../../../config/dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'READ') {
    // Parse JSON request body
    $data = json_decode(file_get_contents("php://input"));

    if (isset($data->id)) {
        $adminId = $data->id;

        try {
        // Query to retrieve admin data based on admin ID
            $query = "SELECT skills COUNT(*) FROM skills WHERE barangay = :brgyId";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':brgyId', $brgyId, PDO::PARAM_INT);
            $stmt->execute();
            $adminData = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($adminData) {
                // Return the data as a JSON response
                echo json_encode($adminData);
            } else {
                // Return an error response or default data
                echo json_encode(['error' => 'Data not found']);
            }
        } catch (PDOException $e) {
            echo json_encode(['error' => 'Database error']);
        }
    } else {
        echo json_encode(['error' => 'Invalid request']);
    }
}
?>

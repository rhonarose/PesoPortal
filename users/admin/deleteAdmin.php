<?php
session_start(); // Start the session
// Include the PDO database connection
require '../../config/dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Parse JSON request body
    $data = json_decode(file_get_contents("php://input"));

    if (isset($data->id)) {
        $adminId = $data->id;

        try {
            $query = "DELETE FROM admin WHERE id = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":id", $adminId, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                http_response_code(200); // OK
                echo json_encode(array("success" => true, "message" => "Admin account deleted successfully."));
            } else {
                http_response_code(404); // Not Found
                echo json_encode(array("success" => false, "message" => "Admin account not found."));
            }
        } catch (PDOException $e) {
            http_response_code(500); // Internal Server Error
            echo json_encode(array("success" => false, "message" => "Error: " . $e->getMessage()));
        }
    } else {
        http_response_code(400); // Bad Request
        echo json_encode(array("success" => false, "message" => "Invalid data provided."));
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(array("success" => false, "message" => "Method not allowed."));
}

?>
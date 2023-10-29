<?php
session_start(); // Start the session
// Include the PDO database connection
require '../../config/dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form data
    $name = filter_var($_POST['newAdminName'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['newAdminEmail'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['newAdminPassword'];

    // Client-side validation
    $errors = [];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address.";
    }
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }

    if (!empty($errors)) {
        echo json_encode(['errors' => $errors]);
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert the admin account into the database
        $stmt = $conn->prepare("INSERT INTO admin (name, email, password) VALUES (?, ?, ?)");
        if ($stmt->execute([$name, $email, $hashedPassword])) {
            // Return the newly added admin account as a JSON response
            $newAdmin = [
                'name' => $name,
                'email' => $email,
                'id' => $conn->lastInsertId() // Get the newly inserted ID
            ];

            echo json_encode($newAdmin);
        } else {
            echo "Error adding admin account.";
        }
    }
}
?>

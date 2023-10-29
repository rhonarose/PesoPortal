<?php

$server = "localhost";
$user = "root";
$password = "";
$db = "PESOPortal";

try {
    $conn = new PDO("mysql:host=$server;dbname=$db", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection Failed: " . $e->getMessage());
}

?>
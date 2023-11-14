<?php
session_start();
// Assuming you have a database connection already established (e.g., $conn)

// Fetch all job posts where is_approve is 1
$select_job_posts = $conn->query("SELECT * FROM `job_posts` WHERE is_approve = 1");

// Fetch the results as an associative array
$job_posts = $select_job_posts->fetchAll(PDO::FETCH_ASSOC);

// Output job posts as JSON
header('Content-Type: application/json');
echo json_encode($job_posts);
?>

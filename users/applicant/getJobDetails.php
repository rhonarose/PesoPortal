<?php
// Your database connection and other necessary includes
require '../../config/dbconnect.php';

// Get the job title from the POST request
$data = json_decode(file_get_contents("php://input"), true);
$jobTitle = $data['jobTitle'];

// Prepare and execute a query to get job details based on the job title
$stmt = $conn->prepare("SELECT id, employer_id, job_location, job_type, job_salary, job_description, qualifications, tasks, number_of_vacancies, is_approved, approval_timestamp, status FROM job_posts WHERE job_title = :jobTitle");
$stmt->bindParam(':jobTitle', $jobTitle, PDO::PARAM_STR);
$stmt->execute();

// Fetch the result
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Return the result as JSON
header('Content-Type: application/json');
echo json_encode($result);

// Close the database connection
$conn = null;
?>

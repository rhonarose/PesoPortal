<?php
session_start(); // Start the session
// Include the PDO database connection
require '../../config/dbconnect.php';

// Function to sanitize input
function sanitize_input($data) {
    global $conn;
    return filter_var(htmlspecialchars(trim($data)), FILTER_SANITIZE_STRING);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get the employer ID from the session (you should set this when the employer logs in)
    $employer_id = $_SESSION['employer_id'];

    $job_title = sanitize_input($_POST["jobTitle"]);
    $job_location = sanitize_input($_POST["jobLocation"]);
    $job_type = sanitize_input($_POST["jobType"]);
    $job_salary = sanitize_input($_POST["jobSalary"]);
    $job_description = sanitize_input($_POST["jobDescription"]);
    $qualifications = sanitize_input($_POST["qualifications"]);
    $tasks = sanitize_input($_POST["tasks"]);
    $number_of_vacancies = sanitize_input($_POST["numberOfVacancies"]);

    try {
        // Insert data into the database using prepared statement
        $stmt = $conn->prepare("INSERT INTO job_posts (employer_id, job_title, job_location, job_type, job_salary, job_description, qualifications, tasks, number_of_vacancies) 
                                VALUES (:employer_id, :job_title, :job_location, :job_type, :job_salary, :job_description, :qualifications, :tasks, :number_of_vacancies)");

        $stmt->bindParam(':employer_id', $employer_id);
        $stmt->bindParam(':job_title', $job_title);
        $stmt->bindParam(':job_location', $job_location);
        $stmt->bindParam(':job_type', $job_type);
        $stmt->bindParam(':job_salary', $job_salary);
        $stmt->bindParam(':job_description', $job_description);
        $stmt->bindParam(':qualifications', $qualifications);
        $stmt->bindParam(':tasks', $tasks);
        $stmt->bindParam(':number_of_vacancies', $number_of_vacancies);

        $stmt->execute();

        $jobPost_id = $conn->lastInsertId(); // Get the ID of the last inserted job post

        echo "Job post created successfully. It is pending approval.";

        // You can redirect the user to a confirmation page or do any other necessary actions.

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

$conn = null;
?>

<?php
// Include the PDO database connection
require '../../config/dbconnect.php';

// Function to sanitize input
function sanitize_input($data) {
    global $conn;
    return filter_var(htmlspecialchars(trim($data)), FILTER_SANITIZE_STRING);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get the employer ID from the form (assuming it's included as a hidden input)
    $employer_id = sanitize_input($_POST["hiddenEmployerId"]);

    // Sanitize and retrieve other form data
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
        $stmt = $conn->prepare("INSERT INTO job_posts (employer_id, job_title, job_location, job_type, job_salary, job_description, qualifications, tasks, number_of_vacancies, is_approved, status) 
                                VALUES (:employer_id, :job_title, :job_location, :job_type, :job_salary, :job_description, :qualifications, :tasks, :number_of_vacancies, 1, 'Ongoing')");

        // Bind parameters
        $stmt->bindParam(':employer_id', $employer_id);
        $stmt->bindParam(':job_title', $job_title);
        $stmt->bindParam(':job_location', $job_location);
        $stmt->bindParam(':job_type', $job_type);
        $stmt->bindParam(':job_salary', $job_salary);
        $stmt->bindParam(':job_description', $job_description);
        $stmt->bindParam(':qualifications', $qualifications);
        $stmt->bindParam(':tasks', $tasks);
        $stmt->bindParam(':number_of_vacancies', $number_of_vacancies);

        // Execute the query
        $stmt->execute();

        // Get the ID of the last inserted job post
        $jobPost_id = $conn->lastInsertId();

        // Provide a success message (you can customize this)
        echo "Job post created successfully.";

        // You can redirect the user to a confirmation page or perform other necessary actions.

    } catch (PDOException $e) {
        // Handle any errors that occur during the database insertion
        echo "Error: " . $e->getMessage();
    }
}

// Close the database connection
$conn = null;
?>

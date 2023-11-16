<?php

// Function to check if the employer is approved
function isEmployerApproved($employer_id, $conn) {
    try {
        $stmt = $conn->prepare("SELECT is_approve FROM employer_info WHERE employer_id = :employer_id");
        $stmt->bindParam(':employer_id', $employer_id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['is_approve'] == 1;
        } else {
            // Handle the case when the employer_id is not found in the database
            return false; // Or any other value that indicates not approved
        }
    } catch (PDOException $e) {
        // Handle the exception, e.g., log the error or return not approved
        return false; // Or any other value that indicates not approved
    }
}

// Example usage in your employerReq.php
include('../../config/dbconnect.php');
session_start();

if (isset($_SESSION['employer_id'])) {
    $employer_id = $_SESSION['employer_id'];

    // Assuming $conn is your PDO database connection
    if (isEmployerApproved($employer_id, $conn)) {
        // Redirect to employerHome.php if approved
        header("Location: employerHome.php");
        exit();
    }
} else {
    // Handle the case when employer_id is not set in the session
    // You might want to redirect to a login page or display an error message
    // header("Location: login.php");
    // exit();
}


?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PESO SJDM Portal | Requirements</title>
    
    <link rel="shortcut icon" href="../../img/PESOIcon.png">
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
</head>
<body>
    <?php require_once '../userNavbar.php'; ?>
    <div class="parent">
        <div class="container">
            <div class="background-container"></div>
            <?php require_once 'panelsidebar.php'; ?>

            <div class="form-container" id="emp-form">
                <!-- Your content goes here -->
                <h2>Welcome to the Employer Requirements Page</h2>

                <h4 class="direction">*Please note that the following requirements must be submitted in person at the PESO office.*</h4>

                    <div class="reqDiv">
                        <div class="requirements-box">
                            <div class="requirements">
                                <h3>Requirements from the Employers / Agencies</h3>
                                <ul>
                                    <li>Letter of intent addressed to Mayor</li>
                                    <li>Thru Mr. Perfecto Jaime L. Tagalog (OIC)</li>
                                    <li>Company Profile</li>
                                    <li>Business Permit</li>
                                    <li>Certficate of Registration</li>
                                    <li>POEA permit to operate (for overseas employment agencies)</li>
                                    <li>Listing of job vacancies or opening with job description and vacancy counts</li>
                                    <li>Philjobnet registration no pending</li>
                                    <li>No pending case certificate</li>
                                    <!-- Add your requirements here -->
                                </ul>
                                <h4>Contact Person : Melissa L. Villena</h4>
                                <h4>Phone Number : 0926 674 2728</h4>
                                <h4>Email : peso2016csjdm@gmail.com</h4>
                                <h4>FB Account : pesocsjdm@yahoo.com</h4>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>     
        </div>
    </div>


<script>
    document.addEventListener("DOMContentLoaded", function () {

    // Call the function to disable sidebar items
    disableSidebarItems();
    // Call the function to disable navbar elements
    disableNavbarElements();

    });
</script>
</body>
</html>
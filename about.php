<?php
session_start(); // Start the session

// Check if the user is already logged in
if (isset($_SESSION['user_type']) && $_SESSION['user_type'] !== 'unknown') {
    // Redirect to the appropriate panel page
    if ($_SESSION['user_type'] === 'applicant') {
        header('Location: users/applicant/applicantHome.php');
        exit();
    } elseif ($_SESSION['user_type'] === 'employer') {
        header('Location: users/employer/employerHome.php');
        exit();
    } elseif ($_SESSION['user_type'] === 'admin') {
        header('Location: users/admin/adminHome.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PESO SJDM Portal</title>
    
    <link rel="shortcut icon" href="img/PESOIcon.png">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <?php require_once 'navbar.php'; ?>
    <div class="parent">
        <div class="container">
            <div class="background-container"></div>
            <div class="content">
               
            </div>
        </div>
    </div>
</body>
</html>







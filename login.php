<?php
include('./config/dbconnect.php'); // Include the database connection details

session_start();

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

// Initialize error variables
$emailError = '';
$passwordError = '';
// Initialize email variable
$email = ''; // Add this line

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user-provided email and password
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    // Set default user type to 'unknown'
    $_SESSION['user_type'] = 'unknown';

   
        // Check the applicant table
        $applicantQuery = "SELECT * FROM applicants WHERE email = ?";
        $stmt = $conn->prepare($applicantQuery);
        $stmt->execute([$email]);
        $applicantResult = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check the employer table
        $employerQuery = "SELECT * FROM employers WHERE email = ?";
        $stmt = $conn->prepare($employerQuery);
        $stmt->execute([$email]);
        $employerResult = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check the admin table
        $adminQuery = "SELECT * FROM admin WHERE email = ?";
        $stmt = $conn->prepare($adminQuery);
        $stmt->execute([$email]);
        $adminResult = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($applicantResult) {
            if (password_verify($password, $applicantResult['password'])) {
                $_SESSION['user_type'] = 'applicant';
                $_SESSION['applicant_id'] = $applicantResult['id'];
                
                // Redirect to applicant panel
                header("Location: users/applicant/applicantHome.php");
                exit();
            } else {
                // Incorrect password
                $passwordError = "*Incorrect password.*";
            }
        } elseif ($employerResult) {
            if (password_verify($password, $employerResult['password'])) {
                $_SESSION['user_type'] = 'employer';
                $_SESSION['employer_id'] = $employerResult['id'];
                $_SESSION['employer_name'] = $employerResult['employer_name']; // Store the employer's name
                

                // Redirect to employer panel
                header("Location: users/employer/employerHome.php");
                exit();
            } else {
                // Incorrect password
                $passwordError = "Incorrect password.";
            }
        } elseif ($adminResult) {
            if (password_verify($password, $adminResult['password'])) {
                $_SESSION['user_type'] = 'admin';
                $_SESSION['admin_id'] = $adminResult['id'];
                $_SESSION['admin_name'] = $adminResult['name']; // Store the employer's name
                // Redirect to admin panel
                header("Location: users/admin/adminHome.php");
                exit();
            } else {
                // Incorrect password
                $passwordError = "Incorrect password.";
            }
        } else {
            // Email doesn't exist for any user type
            $emailError = "Email does not exist.";
        }
   
        // Close the database connection
        $conn = null;
    
}

?>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PESO SJDM Portal | Login</title>
    
    
    <link rel="shortcut icon" href="img/PESOIcon.png">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php require_once 'navbar.php'; ?>
    <div class="parent">
        <div class="container">
            <div class="background-container"></div>
            <div class="content">
                <div class="left-section">
                    <form action="" method="POST">
                        <div class="input-box">
                        <h1>LOGIN</h1>
                            <i class="fas fa-envelope input-icon"></i>
                            <input type="email" id="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>" required><br>
                            <!-- Display email error message -->
                            <?php if (!empty($emailError)) : ?>
                                <div class="error"><?php echo $emailError; ?></div>
                            <?php endif; ?>

                            <div style="position: relative;"> <!-- Wrap password input and toggle icon in a container -->
                                <i class="fas fa-lock input-icon"></i>
                                <input type="password" id="password" name="password" placeholder="Password" > 
                                <a class="inputpass" onclick="togglePasswordVisibility('password', 'passicon0')" style="position: absolute; right: 15px; top: 62%; transform: translateY(-50%); cursor: pointer; font-size: 18px;">
                                    <i class="fa fa-eye-slash" id="passicon0"></i>
                                </a>
                            </div>

                            <!-- Display password error message -->
                            <?php if (!empty($passwordError)) : ?>
                                <div class="error"><?php echo $passwordError; ?></div>
                            <?php endif; ?>
                            <h4 style="text-align: right; margin-top: 5px;"><a href="forgotPass.php" class="forgot-password">Forgot Password?</a></h4>
                            <button type="submit"><b>LOGIN</b></button>
                            <h4>Dont have an account? <a href="signup.php" class="link">Sign up here</a></h4>
                        </div>
                    </form>
                </div>
                <div class="vertical-line"></div>
                <div class="right-section">
                    <div class="image-top">
                        <img src="img/PESOBanner.jpg" alt="Top Image">
                    </div>
                    <div class="image-bottom">
                        <img src="img/PESO.jpg" alt="Bottom Image">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/script.js"></script>
</body>
</html>
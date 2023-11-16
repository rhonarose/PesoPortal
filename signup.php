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
$usernameError = '';
$emailError = '';
$companyNameError = '';
$companyEmailError = '';

// Initialize variable
$uname = ''; 
$email = ''; 
$employerName = ''; 
$employerEmail = ''; 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userType = filter_input(INPUT_POST, 'userType', FILTER_SANITIZE_STRING);

    $uname = filter_input(INPUT_POST, 'appuname', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'appemail', FILTER_SANITIZE_EMAIL);
    $password = password_hash(filter_input(INPUT_POST, 'apppass', FILTER_SANITIZE_STRING), PASSWORD_BCRYPT); // Hash the password for security

    // Check if the user type is 'Applicant'
    if ($userType === 'Applicant') {
        $checkUsernameQuery = "SELECT * FROM applicants WHERE username = ?";
        $checkUsernameStmt = $conn->prepare($checkUsernameQuery);
        $checkUsernameStmt->execute([$uname]);
        $checkUsernameResult = $checkUsernameStmt->fetch(PDO::FETCH_ASSOC);

        if ($checkUsernameResult) {
            $usernameError = "*Username already exists.*";
        }

        $checkEmailQuery = "SELECT * FROM applicants WHERE email = ?";
        $checkEmailStmt = $conn->prepare($checkEmailQuery);
        $checkEmailStmt->execute([$email]);
        $checkEmailResult = $checkEmailStmt->fetch(PDO::FETCH_ASSOC);

        if ($checkEmailResult) {
            $emailError = "*Email already exists.*";
        }

        if (empty($usernameError) && empty($emailError)) {
            $insertQuery = "INSERT INTO applicants (username, email, password) VALUES (?, ?, ?)";
            $insertStmt = $conn->prepare($insertQuery);
            $insertStmt->execute([$uname, $email, $password]);

            $_SESSION['user_type'] = 'applicant';
            $_SESSION['applicant_id'] = $conn->lastInsertId();
            $_SESSION['username'] = $uname; // Store the username in the session
            $_SESSION['applicant_email'] = $email; // Store the email in the session

            session_write_close();
            header('Location: users/applicant/applicantInfo.php');
            exit();
        }
    } elseif ($userType === 'Employer') {
        $checkCompanyNameQuery = "SELECT * FROM employers WHERE employer_name = ?";
        $checkCompanyNameStmt = $conn->prepare($checkCompanyNameQuery);
        $checkCompanyNameStmt->execute([filter_input(INPUT_POST, 'empname', FILTER_SANITIZE_STRING)]);
        $checkCompanyNameResult = $checkCompanyNameStmt->fetch(PDO::FETCH_ASSOC);

        if ($checkCompanyNameResult) {
            $companyNameError = "*Employer Name already exists.*";
        }

        $checkCompanyEmailQuery = "SELECT * FROM employers WHERE email = ?";
        $checkCompanyEmailStmt = $conn->prepare($checkCompanyEmailQuery);
        $checkCompanyEmailStmt->execute([filter_input(INPUT_POST, 'empemail', FILTER_SANITIZE_EMAIL)]);
        $checkCompanyEmailResult = $checkCompanyEmailStmt->fetch(PDO::FETCH_ASSOC);

        if ($checkCompanyEmailResult) {
            $companyEmailError = "*Email already exists.*";
        }

        if (empty($companyNameError) && empty($companyEmailError)) {
            $employerName = filter_input(INPUT_POST, 'empname', FILTER_SANITIZE_STRING);
            $employerEmail = filter_input(INPUT_POST, 'empemail', FILTER_SANITIZE_EMAIL);
            $employerPassword = password_hash(filter_input(INPUT_POST, 'emppass', FILTER_SANITIZE_STRING), PASSWORD_BCRYPT);

            $insertQuery = "INSERT INTO employers (employer_name, email, password) VALUES (?, ?, ?)";
            $insertStmt = $conn->prepare($insertQuery);
            $insertStmt->execute([$employerName, $employerEmail, $employerPassword]);

            $_SESSION['user_type'] = 'employer';
            $_SESSION['employer_id'] = $conn->lastInsertId();
            $_SESSION['employer_name'] = $employerName; // Store the employer name in the session
            $_SESSION['employer_email'] = $employerEmail;

            session_write_close();
            header('Location: users/employer/employerInfo.php');
            exit();
        }
    } else {
        // Invalid user type
        header('Location: signup.php');
        exit();
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
    <title>PESO SJDM Portal | Signin</title>
    
    
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
                    <form action="" method="POST" onsubmit="return validateForm();">
                        <div class="input-box">
                        <h1>SIGN IN</h1>
                            <div>
                                <input type="radio" id="applicantRadio" name="userType" value="Applicant" checked onchange="showForm('applicant')">
                                <label style="margin-right: 25px;" for="applicantRadio">Applicant</label>
                                <input type="radio" id="employerRadio" name="userType" value="Employer" onchange="showForm('employer')">
                                <label for="employerRadio">Employer</label>
                            </div>
                            <div id="applicantForm">
                                <!-- Applicant form elements go here -->
                                <i class="fas fa-user input-icon"></i>
                                <input type="text" id="appuname" name="appuname" placeholder="Username" value="<?php echo htmlspecialchars($uname); ?>"> 
                                <div class="error"><?php echo $usernameError; ?></div>
                                <div id="errorAppUname" class="error"></div>

                                <i class="fas fa-envelope input-icon"></i>
                                <input type="email" id="appemail" name="appemail" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>"> 
                                <div class="error"><?php echo $emailError; ?></div>
                                <div id="errorAppEmail" class="error"></div>

                                <div style="position: relative;"> <!-- Wrap password input and toggle icon in a container -->
                                    <i class="fas fa-lock input-icon"></i>
                                    <input type="password" id="apppass" name="apppass" placeholder="Password" > 
                                    <a class="inputpass" onclick="togglePasswordVisibility('apppass', 'passicon1')" style="position: absolute; right: 15px; top: 62%; transform: translateY(-50%); cursor: pointer; font-size: 18px;">
                                        <i class="fa fa-eye-slash" id="passicon1"></i>
                                    </a>
                                    <div id="errorAppPass" class="error"></div>
                                </div>

                                <div style="position: relative;"> <!-- Wrap password input and toggle icon in a container -->
                                    <i class="fas fa-lock input-icon"></i>
                                    <input type="password" id="appconpass" name="cpassword" placeholder="Confirm Password"> 
                                    <a class="inputpass" onclick="togglePasswordVisibility('appconpass', 'passicon3')" style="position: absolute; right: 15px; top: 62%; transform: translateY(-50%); cursor: pointer; font-size: 18px;">
                                        <i class="fa fa-eye-slash" id="passicon3"></i>
                                    </a>
                                    <div id="errorAppCpass" class="error"></div>
                                </div>
                            </div>
                            
                            <div id="employerForm" style="display: none;">
                                <!-- Employer form elements go here -->
                                <i class="fas fa-users input-icon"></i>
                                <input type="text" id="empname" name="empname" placeholder="Employer Name" value="<?php echo isset($_POST['empname']) ? htmlspecialchars($_POST['empname']) : ''; ?>"> 
                                <div class="error"><?php echo $companyNameError; ?></div>
                                <div id="errorEmpName" class="error"></div>

                                <i class="fas fa-envelope input-icon"></i>
                                <input type="email" id="empemail" name="empemail" placeholder="Email" value="<?php echo isset($_POST['empemail']) ? htmlspecialchars($_POST['empemail']) : ''; ?>"> 
                                <div class="error"><?php echo $companyEmailError; ?></div>
                                <div id="errorEmpEmail" class="error"></div>

                                <div style="position: relative;"> <!-- Wrap password input and toggle icon in a container -->
                                    <i class="fas fa-lock input-icon"></i>
                                    <input type="password" id="emppass" name="emppass" placeholder="Password" > 
                                    <a class="inputpass" onclick="togglePasswordVisibility('emppass', 'passicon2')" style="position: absolute; right: 15px; top: 62%; transform: translateY(-50%); cursor: pointer; font-size: 18px;">
                                        <i class="fa fa-eye-slash" id="passicon2"></i>
                                    </a>
                                    <div id="errorEmpPass" class="error"></div>
                                </div>

                                <div style="position: relative;"> <!-- Wrap password input and toggle icon in a container -->
                                    <i class="fas fa-lock input-icon"></i>
                                    <input type="password" id="empconpass" name="cpassword" placeholder="Confirm Password" > 
                                    <a class="inputpass" onclick="togglePasswordVisibility('empconpass', 'passicon4')" style="position: absolute; right: 15px; top: 62%; transform: translateY(-50%); cursor: pointer; font-size: 18px;">
                                        <i class="fa fa-eye-slash" id="passicon4"></i>
                                    </a>
                                    <div id="errorEmpCpass" class="error"></div>
                                </div>
                            </div>
                            
                            <div class="checkbox-container" style="margin-top: 20px;">
                                <input type="checkbox" id="termsCheckbox" name="termsCheckbox" required>
                                <label for="termsCheckbox"><b>I read and agree to <a href="#" class="link">Terms &amp; Conditions</a></b></label>
                            </div>
                            <button type="submit"><b>CREATE ACCOUNT</b></button>
                            <h4>Already have an account? <a href="login.php" class="link">Login here</a></h4>
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


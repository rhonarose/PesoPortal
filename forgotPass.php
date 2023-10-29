<?php
include('./config/dbconnect.php'); // Include the database connection details

session_start();

?>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PESO SJDM Portal | Forgot Password</title>

    
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
                    <form action="" method="POST" id="findAccForm">
                        <div class="input-box">
                            <h1>FORGOT<br>PASSWORD</h1>
                            <h4>Please enter your email address to find your account</h4>
                            <div class="inputs">
                                <i class="fas fa-envelope input-icon"></i>
                                <input type="email" name="email" placeholder="Email">
                                
                                <div class="forgotButtons">
                                    <button type="button"><a href="login.php" class="forgotlink"><b>CANCEL</b></button></a>
                                    <button type="button" onclick="showVerificationForm()"><b>NEXT</b></button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <form action="" method="POST" id="verificationForm" style="display: none;">
                        <!-- Second step: Google Verification Code -->
                        <div class="input-box">
                        <h1>FORGOT<br>PASSWORD</h1>
                            <h4>Enter the 4-digit verification code sent to your email</h4>
                                <div class="code-inputs inputs">
                                    <input type="text" name="digit1" maxlength="1" oninput="limitToNumbers(this)" required>
                                    <input type="text" name="digit2" maxlength="1" oninput="limitToNumbers(this)" required>
                                    <input type="text" name="digit3" maxlength="1" oninput="limitToNumbers(this)" required>
                                    <input type="text" name="digit4" maxlength="1" oninput="limitToNumbers(this)" required>
                                </div>

                            <div class="forgotButtons">
                                <button type="button" onclick="showFindAccountForm()"><b>CANCEL</b></button>
                                <button type="button" onclick="showChangePass()"><b>VERIFY</b></button>
                            </div>
                        </div>
                    </form>

                    <form action="" method="POST" id="changePass" style="display: none;">
                        <!-- Third step: Change Password -->
                        <div class="input-box">
                        <h1>NEW<br>PASSWORD</h1>
                            <h4>Please enter your new password</h4>
                                <div class="inputs">
                                    <div style="position: relative;"> <!-- Wrap password input and toggle icon in a container -->
                                        <i class="fas fa-lock input-icon"></i>
                                        <input type="password" id="newpass" name="newpass" placeholder="New Password" > 
                                        <a class="inputpass" onclick="togglePasswordVisibility('newpass', 'passicon5')" style="position: absolute; right: 15px; top: 62%; transform: translateY(-50%); cursor: pointer; font-size: 18px;">
                                            <i class="fa fa-eye-slash" id="passicon5"></i>
                                        </a>
                                    </div>
                                    
                                    <div style="position: relative;"> <!-- Wrap password input and toggle icon in a container -->
                                        <i class="fas fa-lock input-icon"></i>
                                        <input type="password" id="connewpass" name="connewpass" placeholder="Confirm New Password" > 
                                        <a class="inputpass" onclick="togglePasswordVisibility('connewpass', 'passicon6')" style="position: absolute; right: 15px; top: 62%; transform: translateY(-50%); cursor: pointer; font-size: 18px;">
                                            <i class="fa fa-eye-slash" id="passicon6"></i>
                                        </a>
                                    </div>
                                </div>
                            <div class="forgotButtons">
                                <button type="button" onclick="showFindAccountForm()"><b>CANCEL</b></button>
                                <button type="submit"><b>SUBMIT</b></button>
                            </div>
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
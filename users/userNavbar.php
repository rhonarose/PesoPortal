<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PESO SJDM Portal</title>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    

    <style>
          /* Reset some default styles */
        body {
            margin-top: 70px; /* Adjust this value according to your navbar's height */
        }

        /* Top Navigation Styles */
        .topnav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background-color: #2B65E2;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 15px;
            z-index: 100; /* Ensure the navigation bar appears above other content */
        }

        .topnav a {
            color: black;
            text-decoration: none;
            font-size: 16px;
            margin: 0 15px;
            position: relative;
        }

        .topnav-right a::before {
            content: "";
            position: absolute;
            width: 130%; /* Extend the border across the full width of the topnav element */
            height: 3px;
            bottom: -10px; /* Adjust the bottom value to add padding */
            left: -12%; /* Center the border */
            background-color: #000;
            transform: scaleX(0);
            transform-origin: center;
            transition: transform 0.2s ease;
        }

        .dropdown-content a::before {
            content: "";
            position: absolute;
            width: 100%; /* Extend the border across the full width of the topnav element */
            height: 3px;
            bottom: 0; /* Adjust the bottom value to add padding */
            left: 0; /* Center the border */
            background-color: #000;
            transform: scaleX(0);
            transform-origin: center;
            transition: transform 0.2s ease;
        }

        .topnav-right a:hover::before,
        .topnav-right a.active::before {
            transform: scaleX(1);
        }

        .topnav .peso {
            display: flex;
            align-items: center;
        }

        .topnav .peso img {
            height: 50px;
            margin-right: 5px;
        }

        .topnav-right, 
        .dropdown {
            display: flex;
            align-items: center;
            margin-right: 10px;
        }

        @media screen and (max-width: 930px) {

        .topnav-right.active {
            display: flex;
        }

       
        .topnav-right a {
            margin-left: 20px;
        }

        .topnav .peso {
                overflow: visible; /* Allow the search box to overflow */
            }

            .topnav #search-box {
                position: absolute;
                top: 16px;
                right: 137px;
            }


        }


        @media screen and (max-width: 655px) {

        .topnav a {
            font-size: 14px; /* Adjust the font size for smaller screens */
        }

        /* Optionally, you can adjust other styles as needed for mobile view */
        .topnav {
            padding-top: 12px; /* Adjust the padding for better spacing in mobile view */
        }

        .peso h1 {
            font-size: 20px; /* Adjust the font size for smaller screens */
            margin: 0; /* Remove margin for better spacing */
        }

        .topnav .peso img {
            height: 45px; /* Adjust the height to your preference */
            margin-right: 5px;
        }

        .topnav .notif-count {
            font-size: 10px;
        }

            .topnav #search-box button {
                margin-top: 3px;
                padding: 5px 8px;
                font-size: 14px;
            }

            .topnav #search-box input {
                margin-top: 4px;
                padding: 7px 10px;
                font-size: 14px;
                width: 100%;
            }

        }

        @media screen and (max-width: 528px) {
        .topnav a {
        font-size: 12px; /* Adjust the font size for smaller screens */
        }

        .topnav-right {
            top: 70px;
        }

        .topnav {
            padding-top: 15px; /* Adjust the padding for better spacing in mobile view */
        }

        .peso h1 {
        font-size: 16px; /* Adjust the font size for smaller screens */
        margin: 0; /* Remove margin for better spacing */
        }

        .topnav .peso img {
        height: 35px; /* Adjust the height to your preference */
        margin-right: 3px;
        }

        .topnav #search-box input {
            margin-top: 3px;
            font-size: 12px;
        }

        .topnav #search-box button {
                padding: 4px 4px;
                font-size: 12px;
            }
        }

        #search-box {
            display: none;
            align-items: center;
        }

        #search-box input {
            padding: 10px 55px 10px 15px; /* Adjusted padding */
            font-size: 16px;
            border: none;
            border-radius: 7px;
            width: 350px; /* Use percentage-based width to make it responsive */
            box-sizing: border-box; /* Ensure padding and border don't add to the width */
            outline: none;
        }

        #search-box button {
            position: absolute;
            top: 3px;
            right: 3px;
            padding: 7px 12px;
            font-size: 16px;
            text-align: center;
            background-color: #2B65E2;
            color: black;
            border: none;
            border-radius: 7px; 
            cursor: pointer;
        }

        #search-box, #search-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .notif-icon {
            position: relative;
            display: inline-block;
        }

        .notif-count {
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 2px 5px;
            text-align: center;
            font-size: 12px;
            position: absolute;
            top: -10px;
            right: -7px;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #addef7;
            padding: 8px 16px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 999;
            right: 10px;
            top: 100%;
            border: 1px solid black;
            border-radius: 8px;
        }

        .dropdown-content a {
            color: black;
            padding: 14px 14px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .dropdown-content i {
            margin-right: 4px;
            color: #2B65E2;
        }

        .dropdown.active .dropdown-content {
            display: block;
        }

        textarea#feedback-text {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
            outline: none;
        }
    </style>
</head>
<body>
    <header>
        <div class="topnav">
            <div class="peso">
                <img src="../../img/SJDMLogo.png" alt="SJDM Logo" style="margin-left: 10px;">
                <img src="../../img/PESOLogo.png" alt="PESOSJDM Logo">
                <a href="index.php"><h1>PESO SJDM Portal</h1></a>
            </div>
            <div class="topnav-right">
                <div id="search-box">
                    <form action="" method="GET">
                        <div id="search-wrapper" style="display: none;">
                            <input type="search" id="searchjob" name="searchjob" placeholder="Search Job">
                            <button type="submit"><i class="fas fa-search fa-lg"></i></button>
                        </div>
                    </form>
                </div>
                <a href="#" id="search-icon"><i class="fas fa-search fa-lg"></i></a>
                <a href="#" class="notif-icon"><i class="fas fa-bell fa-lg"></i><span class="notif-count">0</span></a>
                <div class="dropdown">
                    <a href="#" id="settings-icon"><i class="fas fa-caret-down fa-lg"></i></a>
                    <div class="dropdown-content" id="dropdown-box">
                        <a href="javascript:void(0);" onclick="openAccountSettingsModal()"><i class="fas fa-cog"></i> Account</a>

                        <!-- Modal for Account Settings -->
                        <div id="accountSettingsModal" class="modal">
                            <div class="modal-content">
                                <span class="close" onclick="closeAccountSettingsModal()">&times;</span>
                                <h2>Account Settings</h2>
                                <div class="butcon">
                                    <input type="button" value="CHANGE PASSWORD" id="changeButton" onclick="showChangePassword()">
                                </div> 
                                
                                <!-- Content for changing password (initially hidden) -->
                                <div id="changePasswordContent" style="display: none;">
                                    <h3>Change Password</h3>
                                    <!-- Add your form elements for changing the password here -->
                                    <form>
                                        <!-- Password change form fields -->
                                        <div class="form-field">
                                            <label for="currentPassword">Current Password:</label>
                                            <input type="password" id="currentPassword" placeholder="Enter your current password">
                                        </div>
                                        <div class="form-field">
                                            <label for="newPassword">New Password:</label>
                                            <input type="password" id="newPassword" placeholder="Enter your new password">
                                        </div>
                                        <div class="form-field">
                                            <label for="confirmPassword">Confirm New Password:</label>
                                            <input type="password" id="confirmPassword" placeholder="Confirm your new password">
                                        </div>

                                        <div class="butcon">
                                            <input type="button" value="SAVE" id="changePasswordButton" onclick="changePassword()">
                                        </div> 
                                    </form>
                                </div>
                            </div>
                        </div>

                        <a href="#" id="feedback-link"><i class="fas fa-comment-alt"></i> Feedback</a>
                            <!-- Add this HTML code for the feedback modal within the <body> tag -->
                            <div id="feedback-modal" class="modal">
                                <div class="modal-content">
                                    <span class="close" onclick="closeFeedbackModal()">&times;</span>
                                    <h2>Feedback</h2>
                                    <textarea id="feedback-text" rows="4" cols="50" placeholder="Write your feedback here..."></textarea>

                                    <div class="butcon">
                                            <input type="button" value="SUBMIT" id="submit-feedback" onclick="submitFeedback()">
                                        </div> 
                                </div>
                            </div>
                        <a href="../../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <script src="../../js/script.js"></script>

</body>
</html>

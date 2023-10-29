<?php
session_start(); // Start the session
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PESO SJDM Portal | Home</title>
    
    <link rel="shortcut icon" href="../../img/PESOIcon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/style.css">

</head>
<body>
    <?php require_once '../userNavbar.php'; ?>
    <div class="parent">
        <div class="container">
            <div class="background-container"></div>
            <?php require_once 'panelSidebar.php'; ?>
            <div class="form-container dashboard1" id="dashboard">
                <!-- Preference Form -->
                <h2>EMPLOYER DASHBOARD</h2>
                <form action="" method="POST">
                    <div class="dashboard">
                    <div class="stat-card job-postings">
                        <div class="fa-icon"><i class="fas fa-file-alt"></i></div>
                        <div class="stat-value">120</div>
                        <div class="stat-label">Total Job Posts</div>
                    </div>
                    <div class="stat-card active-listings">
                        <div class="fa-icon"><i class="fas fa-list"></i></div>
                        <div class="stat-value">50</div>
                        <div class="stat-label">Pending Job Posts</div>
                    </div>
                </div>
                </form>
            </div>
            <div class="form-container" id="profile">
                <!-- Language Form -->
                <h2>MY PROFILE</h2>
                <div class="profile-info">
                    <div class="profile-info-item">
                        <h2>CORPORATION</h2>
                    </div>
                    <div class="profile-info-item">
                        <i class="fas fa-phone"></i> 0912-345-6789
                    </div>
                    <div class="profile-info-item">
                        <i class="fas fa-envelope"></i> corp@gmail.com
                    </div>
                    <div class="profile-info-item">
                        <i class="fas fa-map-marker-alt"></i> San Jose Del Monte Bulacan
                    </div>
                    <div class="profile-info-item">
                        <i class="fas fa-globe"></i> <a href="path_to_resume.pdf" target="_blank">corp.url.com</a>
                    </div>
                    <div class="profile-info-item">
                        <i class="fas fa-file-alt"></i>Corp is a leading technology company specializing in software development and IT consulting services. Established in 2005, we have a proven track record of delivering innovative solutions to businesses of all sizes, from startups to Fortune 500 companies.
                    </div>
                </div>

                <div class="butcon">
                    <input type="button" value="EDIT PROFILE" onclick="openEditProfileModal()">
                </div>
            </div>

            <div id="editProfileModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeEditProfileModal()">&times;</span>
                    <h2>Edit Profile</h2>
                    <form>
                        <div class="form-field">
                            <label for="editedName">Company Name:</label>
                            <input type="text" id="editedName" placeholder="Enter your company name">
                        </div>
                        <div class="form-field">
                            <label for="editedPhone">Phone:</label>
                            <input type="text" id="editedPhone" placeholder="Enter your phone number">
                        </div>
                        <div class="form-field">
                            <label for="editedEmail">Email:</label>
                            <input type="text" id="editedEmail" placeholder="Enter your email address">
                        </div>
                        <div class="form-field">
                            <label for="editedAddress">Address:</label>
                            <input type="text" id="editedAddress" placeholder="Enter your company address">
                        </div>
                        <div class="form-field">
                            <label for="editedWebsite">Website:</label>
                            <input type="text" id="editedWebsite" placeholder="Enter your company website">
                        </div>
                        <div class="form-field">
                            <label for="editedDescription">Description:</label>
                            <textarea id="editedDescription" placeholder="Enter a brief description of your company" rows="4"></textarea>
                        </div>
                        <!-- Add other fields as needed -->
                        <div class="butcon">
                            <button type="button" onclick="saveEditedProfile()">Save</button>
                        </div>
                    </form>
                </div>
            </div>


            <div class="form-container" id="createjob">
                <!-- Job Posting Form -->
                <h2>CREATE JOB POST</h2>
                <form id="jobPostForm">
                    <div class="form-field">
                        <label for="jobTitle">Job Title:</label>
                        <input type="text" id="jobTitle" name="jobTitle" required>
                    </div>
                    <div class="form-field">
                        <label for="jobDescription">Job Description:</label>
                        <textarea id="jobDescription" name="jobDescription" rows="4" required></textarea>
                    </div>
                    <div class="form-field">
                        <label for="jobLocation">Job Location:</label>
                        <input type="text" id="jobLocation" name="jobLocation" required>
                    </div>
                    <div class="form-field">
                        <label for="jobType">Job Type:</label>
                        <select id="jobType" name="jobType" required>
                            <option value="fulltime">Full-Time</option>
                            <option value="parttime">Part-Time</option>
                            <option value="contract">Contract</option>
                            <option value="freelance">Freelance</option>
                        </select>
                    </div>
                    <div class="form-field">
                        <label for="jobSalary">Salary:</label>
                        <input type="text" id="jobSalary" name="jobSalary">
                    </div>
                    <div class="form-field">
                                    <label for="numberOfVacancies">Number of Vacancies:</label>
                                    <input type="number" id="numberOfVacancies" name="numberOfVacancies" min="1" placeholder="Enter number of vacancies" required>
                                </div>

                    <div class="butcon">
                        <button type="submit">Post Job</button>
                    </div>
                </form>
            </div>

            <div class="form-container" id="jobPost">
                <!-- Eligibility Form -->
                <h2>MY JOB POST</h2>
               
            </div>
        </div>
    </div>

    <script>
        
        // JavaScript code to handle form visibility
        function showForm(formId) {
            const forms = document.querySelectorAll('.form-container');

            // Hide all forms
            for (const form of forms) {
                form.style.display = 'none';
            }

            // Show the selected form
            const selectedForm = document.getElementById(formId);
            selectedForm.style.display = 'block';
        }

        // JavaScript code to show the default form on page load
        window.onload = function() {
            showDefaultForm();
        };

        function showDefaultForm() {
            const defaultForm = document.getElementById('dashboard');
            const nonDefaultForms = document.querySelectorAll('.form-container:not(#dashboard)');

            // Show the default form
            defaultForm.style.display = 'block';

            // Hide the non-default forms
            for (const form of nonDefaultForms) {
                form.style.display = 'none';
            }
        }

        function openEditProfileModal() {
            const modal = document.getElementById('editProfileModal');
            modal.style.display = 'block';

            // Populate the modal fields with the current profile data for editing
            const nameElement = document.querySelector('.profile-info-item h2');
            const phoneElement = document.querySelector('.profile-info-item i.fa-phone');
            const emailElement = document.querySelector('.profile-info-item i.fa-envelope');

            document.getElementById('editedName').value = nameElement.textContent;
            document.getElementById('editedPhone').value = phoneElement.textContent;
            document.getElementById('editedEmail').value = emailElement.textContent;
        }

        function closeEditProfileModal() {
            const modal = document.getElementById('editProfileModal');
            modal.style.display = 'none';
        }

        function saveEditedProfile() {
            // Get the edited data from the modal fields
            const editedName = document.getElementById('editedName').value;
            const editedPhone = document.getElementById('editedPhone').value;
            const editedEmail = document.getElementById('editedEmail').value;

            // Update the profile information displayed on the page with the edited data
            const nameElement = document.querySelector('.profile-info-item h2');
            const phoneElement = document.querySelector('.profile-info-item i.fa-phone');
            const emailElement = document.querySelector('.profile-info-item i.fa-envelope');

            nameElement.textContent = editedName;
            phoneElement.textContent = editedPhone;
            emailElement.textContent = editedEmail;

            // Close the modal
            closeEditProfileModal();

            // You can also send the edited data to the server for saving (similar to previous examples)
        }

    </script>
</body>
</html>
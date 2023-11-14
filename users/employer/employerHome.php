<?php
include '../../config/dbconnect.php';
session_start(); // Start the session

if(isset($_SESSION['employer_id'])){
    $employer_id = $_SESSION['employer_id'];
}

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

    <style>
        

    </style>
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
                <?php
                    $select_employer = $conn->prepare("SELECT * FROM `employers` WHERE id = ?");
                    $select_employer_info = $conn->prepare("SELECT * FROM `employer_info` WHERE employer_id = ?");
                    // Add similar prepared statements for other tables

                    $select_employer->execute([$employer_id]);
                    $select_employer_info->execute([$employer_id]);
                    // Execute other prepared statements for the remaining tables

                    if (
                        $select_employer->rowCount() > 0 && 
                        $select_employer_info->rowCount() > 0
                        // Check other prepared statements for data availability
                    ) {
                        $fetch_employer = $select_employer->fetch(PDO::FETCH_ASSOC);
                        $fetch_employer_info = $select_employer_info->fetch(PDO::FETCH_ASSOC);
                        // You can similarly fetch data from other tables
                ?>


                <div class="profile-info">
                    <div class="profile-info-item">
                        <h2><?= $fetch_employer_info["company_name"]; ?></h2>
                    </div>
                    <div class="profile-info-item">
                        <i class="fas fa-phone"></i><?= $fetch_employer_info["contact_no"]; ?>
                    </div>
                    <div class="profile-info-item">
                        <i class="fas fa-envelope"></i> <?= $fetch_employer["email"]; ?>
                    </div>
                    <div class="profile-info-item">
                        <i class="fas fa-map-marker-alt"></i> <?= $fetch_employer_info["city"]; ?>, <?=$fetch_employer_info["province"]; ?>
                    </div>
                    <div class="profile-info-item">
                        <i class="fas fa-user"></i> <?= $fetch_employer["employer_name"]; ?>
                    </div>
                    <div class="profile-info-item">
                        <i class="fas fa-file-pdf"></i> <?= $fetch_employer_info["description"]; ?>
                    </div>
                </div>

                <?php
                    }else{
                ?>
                    <p>please login or register first!</p>
                <?php
                    }
                ?>    


                <!-- <div class="butcon">
                    <input type="button" value="EDIT PROFILE" onclick="openEditProfileModal()">
                </div> -->
            </div>

            <!-- <div id="editProfileModal" class="modal">
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
                         Add other fields as needed -->
                        <!-- <div class="butcon">
                            <button type="button" onclick="saveEditedProfile()">Save</button>
                        </div>
                    </form>
                </div>
            </div> -->
 

            <div class="form-container" id="createjob">
                <div class="post-container">
                    <!-- Job Posting Form -->
                    <h2>CREATE JOB POST</h2>
                    <form id="jobPostForm" action="jobPost.php" method="post">
                        <div class="form-group">
                            <div>
                                <label for="jobTitle">Job Title:</label>
                                <input type="text" id="jobTitle" name="jobTitle" required>
                            </div>
                            <div>
                                <label for="jobLocation">Job Location:</label>
                                <input type="text" id="jobLocation" name="jobLocation" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <label for="jobType">Job Type:</label>
                                <select id="jobType" name="jobType" required>
                                    <option value="Fulltime">Full-Time</option>
                                    <option value="Parttime">Part-Time</option>
                                    <option value="Contract">Contract</option>
                                    <option value="Freelance">Freelance</option>
                                    <option value="Temporary">Temporary</option>
                                    <option value="Internship">Internship</option>
                                    <option value="Remote">Remote/Telecommute</option>
                                    <option value="Volunteer">Volunteer</option>
                                    <option value="Seasonal">Seasonal</option>
                                    <option value="Projectbased">Project-Based</option>
                                    <option value="Commission">Commission</option>
                                    <option value="Apprenticeship">Apprenticeship</option>
                                    <option value="Entrylevel">Entry-Level</option>
                                    <option value="Midlevel">Mid-Level</option>
                                    <option value="Seniorlevel">Senior-Level</option>
                                    <option value="Executive">Executive</option>
                                    <option value="Consultant">Consultant</option>
                                    <option value="Perdiem">Per Diem</option>
                                    <option value="Jobshare">Job Share</option>
                                    <option value="Flextime">Flextime</option>
                                </select>
                            </div>
                            <div>
                                <label for="jobSalary">Salary:</label>
                                <input type="text" id="jobSalary" name="jobSalary" oninput="validateSalary(this)" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jobDescription">Job Description:</label>
                            <textarea id="jobDescription" name="jobDescription" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="qualifications">Qualifications/Requirements:</label>
                            <textarea id="qualifications" name="qualifications" rows="3" onkeydown="addBulletPoints(event, this)" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="tasks">Tasks/Responsibilities:</label>
                            <textarea id="tasks" name="tasks" rows="3" onkeydown="addBulletPoints(event, this)" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="numberOfVacancies">Number of Vacancies:</label>
                            <input type="number" id="numberOfVacancies" name="numberOfVacancies" min="1" placeholder="Enter number of vacancies" required>
                        </div>
                        <div class="butcon">
                            <button type="submit">Post Job</button>
                        </div>
                    </form>
                </div>
            </div>


            <?php
            // Include the PDO database connection
            require '../../config/dbconnect.php';

            try {
                // Fetch job postings for the specific employer with approved statuses (1 and 2)
                $employer_id = $_SESSION['employer_id']; // Assuming you have the employer ID in a session variable

                $stmt = $conn->prepare("SELECT job_posts.id, job_posts.job_title, job_posts.job_location, job_posts.job_description, employer_info.company_name, employer_info.company_logo
                                        FROM job_posts
                                        JOIN employer_info ON job_posts.employer_id = employer_info.employer_id
                                        WHERE job_posts.employer_id = :employer_id");

                $stmt->bindParam(':employer_id', $employer_id, PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                echo '<div class="form-container" id="jobPost">
                        <h2>JOB POST</h2><br>
                        <div class="job-postings-container">';

                if ($result) {
                    foreach ($result as $job) {
                        echo '<div class="job-posting" onclick="showJobDetails(\'' . $job["job_title"] . '\')">
                                <div class="job-result-item">
                                    <img src="' . $job["company_logo"] . '" alt="Company Logo">
                                    <div class="job-result">
                                        <h3 class="job-result-title">' . $job["job_title"] . '</h3>
                                        <p class="job-result-description">' . $job["job_description"] . '</p>
                                        <p class="job-result-company">Company: ' . $job["company_name"] . '</p>
                                    </div>
                                </div>
                            </div>';
                    }
                } else {
                    echo '<p>No approved ongoing job posts found for this employer.</p>';
                }

                echo '</div></div>';
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

            // Close the database connection
            $conn = null;
            ?>

            
            <div id="modalOverlay" class="overlay"></div>

            <!-- Modal for displaying job details -->
            <div id="jobDetailsModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeJobDetailsModal()">&times;</span>
                    <h2 id="jobDetailsTitle"></h2>
                    <div id="jobDetailsContent">
                        <!-- Job details will be displayed here -->
                    </div>
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

        function validateSalary(input) {
            // Allow only numbers, hyphen, comma, and dollar signs
            input.value = input.value.replace(/[^0-9$,-.]/g, '');
        }

        function addBulletPoints(event, textarea) {
            // Get the current value of the textarea
            let currentValue = textarea.value;

            // Get the position of the cursor
            let cursorPosition = textarea.selectionStart;

            // Find the beginning of the current line
            let lineStart = currentValue.lastIndexOf('\n', cursorPosition - 1) + 1;

            // Check if the line is empty
            let isLineEmpty = currentValue.slice(lineStart, cursorPosition).trim() === '';

            // Insert a bullet point at the beginning of the line if the line is empty
            if (isLineEmpty) {
                let newValue = currentValue.slice(0, lineStart) + '• ' + currentValue.slice(lineStart);

                // Update the textarea value
                textarea.value = newValue;

                // Move the cursor position after the inserted bullet point
                textarea.setSelectionRange(cursorPosition + 2, cursorPosition + 2);

                // Prevent the default behavior to avoid creating an additional line break
                event.preventDefault();
            }
        }

        /* function openEditProfileModal() {
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

            
        } */
          
        function showJobDetails(jobTitle) {
            const modal = document.getElementById('jobDetailsModal');
            const overlay = document.getElementById('modalOverlay');
            const title = document.getElementById('jobDetailsTitle');
            const content = document.getElementById('jobDetailsContent');

            // Set the title for the modal based on the job title
            title.textContent = jobTitle;

            // Make an asynchronous request to fetch job details
            fetch('../../users/applicant/getJobDetails.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ jobTitle: jobTitle }),
            })
            .then(response => response.json())
            .then(jobDetails => {
                // Set the content for the modal dynamically based on the fetched details
                content.innerHTML = `
                    <p>Location: ${jobDetails.job_location}</p>
                    <p>Type: ${jobDetails.job_type}</p>
                    <p>Salary: ${jobDetails.job_salary}</p>
                    <p>Job Description: ${jobDetails.job_description}</p>
                    <p>Qualifications: ${jobDetails.qualifications}</p>
                    <p>Tasks: ${jobDetails.tasks}</p>
                    <p>Vacancies: ${jobDetails.number_of_vacancies}</p>
                `;

                // Show the modal and overlay
                modal.style.display = 'block';
                overlay.style.display = 'block';
            })
            .catch(error => {
                console.error('Error fetching job details:', error);
            });
        }

        // Close the modal and overlay
        function closeJobDetailsModal() {
            const modal = document.getElementById('jobDetailsModal');
            const overlay = document.getElementById('modalOverlay');
            modal.style.display = 'none';
            overlay.style.display = 'none';
        }


              
         
    </script>
</body>
</html>

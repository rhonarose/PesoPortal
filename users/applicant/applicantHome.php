<?php
include '../../config/dbconnect.php';
session_start(); // Start the session

if(isset($_SESSION['applicant_id'])){
    $applicant_id = $_SESSION['applicant_id'];
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
    
</head>
<body>
    <?php require_once '../userNavbar.php'; ?>
    <div class="parent">
        <div class="container">
            <div class="background-container"></div>
            <?php require_once 'panelSidebar.php'; ?>
            <div class="form-container" id="myprofile">
                <!-- My Profile Section -->
                <h2>MY PROFILE</h2>

                <?php          
                    $select_profile = $conn->prepare("SELECT * FROM `personal_info` WHERE applicant_id = ?");
                    $select_profile->execute([$applicant_id]);
                    if($select_profile->rowCount() > 0){
                    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                ?>

                <div class="profile-info">
                    <div class="profile-info-item">
                        <h2><?= $fetch_profile["first_name"]; ?> <?= $fetch_profile["middle_name"]; ?> <?= $fetch_profile["surname"]; ?></h2>
                    </div>
                    <div class="profile-info-item">
                        <i class="fas fa-phone"></i><?= $fetch_profile["cellphone_number"]; ?>
                    </div>
                    <div class="profile-info-item">
                        <i class="fas fa-envelope"></i> <?= $fetch_profile["email"]; ?>
                    </div>
                    <div class="profile-info-item">
                        <i class="fas fa-map-marker-alt"></i> <?= $fetch_profile["municipality_city"]; ?>
                    </div>
                    <div class="profile-info-item">
                        <i class="fas fa-cogs"></i> Web Development, Design
                    </div>
                    <div class="profile-info-item">
                        <i class="fas fa-file-pdf"></i> <a href="path_to_resume.pdf" target="_blank">View Resume</a>
                    </div>
                </div>

                <?php
                    }else{
                ?>
                    <p>please login or register first!</p>
                <?php
                    }
                ?>    

                <div class="butcon">
                    <input type="button" value="EDIT PROFILE" onclick="openEditProfileModal()">
                </div>
            </div>

            <div id="editProfileModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeEditProfileModal()">&times;</span>
                    <h2>Edit Profile</h2>
                    <form>
                        <div class="form-field" style=" display:flex " >
                            <label for="editedName">First Name:</label>
                            <input type="text" id="editedName" placeholder="Enter your First name">
                            <label for="editedName">Middle Name:</label>
                            <input type="text" id="editedName" placeholder="Enter your Middle name">
                            <label for="editedName">Surname:</label>
                            <input type="text" id="editedName" placeholder="Enter your Surname">
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
                            <input type="text" id="editedAddress" placeholder="Enter your Address">
                        </div>
                        <div class="form-field">
                            <label for="editedSkill">Skill:</label>
                            <input type="text" id="editedSkill" placeholder="Enter your skill">
                        </div>
                        <div class="form-field">
                            <label for="Resume">Resume:</label>
                            <input type="file" id="editedSkill" placeholder="Enter your skill">
                        </div>
                        <!-- Add other fields as needed -->
                        <div class="butcon">
                            <button type="button" onclick="saveEditedProfile()">Save</button>
                        </div>
                    </form>
                </div>
            </div>

        
            <div class="form-container" id="referral">
                <!-- Eligibility Form -->
                <h2>MY REFERRAL</h2>
                
                <table>
                    <thead>
                        <tr>
                            <th>Employer Name</th>
                            <th>Position</th>
                            <th>Request Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>JecoCorp</td>
                            <td>Data Scientist</td>
                            <td>09-09-2023</td>
                            <td>Pending</td>
                        </tr>
                        <tr>
                            <td>RRCompany</td>
                            <td>Data Analyst</td>
                            <td>08-08-2023</td>
                            <td>Completed</td>
                        </tr>
                        <tr>
                            <td>Llanes Group</td>
                            <td>Web Developer</td>
                            <td>07-07-2023</td>
                            <td>Completed</td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <div class="butcon">
                                    <input type="button" value="NEXT" onclick="showNextForm('personalInfoForm', 'preferenceForm')">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="form-container" id="nsrp">
                <!-- Eligibility Form -->
                <h2>NSRP FORM</h2>
                


                <div class="butcon">
                    <input type="button" value="NEXT" onclick="showNextForm('personalInfoForm', 'preferenceForm')">
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
            const defaultForm = document.getElementById('myprofile');
            const nonDefaultForms = document.querySelectorAll('.form-container:not(#myprofile)');

            // Show the default form
            defaultForm.style.display = 'block';

            // Hide the non-default forms
            for (const form of nonDefaultForms) {
                form.style.display = 'none';
            }
        }

        function showNextForm(currentFormId, nextFormId) {
            var currentForm = document.getElementById(currentFormId);
            var nextForm = document.getElementById(nextFormId);

            // Validate current form fields here if needed

            currentForm.style.display = 'none';
            nextForm.style.display = 'block';

            updateSidebarSelection(nextFormId);
        }

        function showPreviousForm(currentFormId, previousFormId) {
            var currentForm = document.getElementById(currentFormId);
            var previousForm = document.getElementById(previousFormId);

            // Validate current form fields here if needed

            currentForm.style.display = 'none';
            previousForm.style.display = 'block';

            updateSidebarSelection(previousFormId);
        }

        function openEditProfileModal() {
            const modal = document.getElementById('editProfileModal');
            modal.style.display = 'block';
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
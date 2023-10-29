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
                <h2>ADMIN DASHBOARD</h2>
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
                <h2>MY PROFILE</h2>
                <div class="profile-info">
                    <div class="profile-info-item">
                        <h2>ADMIN</h2>
                    </div>
                
                    <div class="admin-table">
                        <h3>Admin Accounts</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>Admin Name</th>
                                    <th>Email</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Include your PDO database connection
                                require_once '../../config/dbconnect.php';

                                try {
                                    // Query to get admin accounts
                                    $query = "SELECT * FROM admin";
                                    $stmt = $conn->query($query);

                                    // Fetch and display admin accounts as table rows
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td><button class='edit-button' onclick='editAdminAccount(" . $row['id'] . ")'>Edit</button></td>";
                                        echo "<td><button class='delete-button' onclick='deleteAdminAccount(" . $row['id'] . ")'>Delete</button></td>";
                                        echo "</tr>";
                                    }
                                } catch (PDOException $e) {
                                    // Handle the error if there is a problem with the database connection or query
                                    echo "Error: " . $e->getMessage();
                                }
                                ?>
                            </tbody>
                            <div class="butcon">
                                <input type="submit" value="ADD ADMIN ACCOUNT" onclick="openAddAdminModal()">
                            </div>
                        </table>
                    </div>

                    
                </div>
            </div>

            <div id="addAdminModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeAddAdminModal()">&times;</span>
                    <h2>Add Admin Account</h2>
                    <form id="addAdminForm" action="" method="POST">
                        <div class="form-field">
                            <label for="newAdminName">Admin Name:</label>
                            <input type="text" id="newAdminName" placeholder="Enter admin name" required>
                        </div>
                        <div class="form-field">
                            <label for="newAdminEmail">Email:</label>
                            <input type="text" id="newAdminEmail" placeholder="Enter email address" required>
                        </div>
                        <div style="position: relative;"> <!-- Wrap password input and toggle icon in a container -->
                            <div class="form-field">
                                <label for="newAdminPassword">Password:</label>
                                <input type="password" id="newAdminPassword" name="adminpass" placeholder="Enter password" required>
                                <a class="inputpass" onclick="togglePasswordVisibility('newAdminPassword', 'passicon7')" style="position: absolute; right: 15px; top: 66%; transform: translateY(-50%); cursor: pointer; font-size: 14px;">
                                                <i class="fa fa-eye-slash" id="passicon7"></i>
                                            </a>
                            </div>
                        </div>
                     
                        <!-- Add other fields as needed -->
                        <div class="butcon">
                            <button type="button" onclick="addAdminAccount()">Add</button>
                        </div>
                    </form>
                </div>
            </div>


            <div class="form-container" id="activejob">
                <!-- Job Posting Form -->
                <h2>ACTIVE JOB POST</h2>
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

            <div class="form-container" id="applicant">
                <!-- Eligibility Form -->
                <h2>APPLICANTS</h2>
               
            </div>

            <div class="form-container" id="employer">
                <!-- Eligibility Form -->
                <h2>EMPLOYERS</h2>
               
            </div>

            <div class="form-container" id="report">
                <!-- Eligibility Form -->
                <h2>REPORTS</h2>
               
            </div>
        </div>
    </div>

    <script src="../../js/script.js"></script>

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

        // Function to open the "Add Admin Account" modal
        function openAddAdminModal() {
            var modal = document.getElementById("addAdminModal");
            modal.style.display = "block";
        }

        // Function to close the "Add Admin Account" modal
        function closeAddAdminModal() {
            var modal = document.getElementById("addAdminModal");
            modal.style.display = "none";
        }


// Function to add an admin account
function addAdminAccount() {
    // Retrieve form data
    const name = document.getElementById('newAdminName').value;
    const email = document.getElementById('newAdminEmail').value;
    const password = document.getElementById('newAdminPassword').value;

    // Create a FormData object to send the data
    const formData = new FormData();
    formData.append('newAdminName', name);
    formData.append('newAdminEmail', email);
    formData.append('newAdminPassword', password);

    // Send an AJAX request to the server to add the admin account
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'adminForm.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Parse the JSON response to get the newly added admin account information
            const newAdmin = JSON.parse(xhr.responseText);

            // Close the modal after a successful submission
            closeAddAdminModal();

            // Clear the input fields
            document.getElementById('newAdminName').value = '';
            document.getElementById('newAdminEmail').value = '';
            document.getElementById('newAdminPassword').value = '';

            // Add the newly added admin account to the HTML table
            addAdminToTable(newAdmin);
        } else {
            // Handle errors here
            console.error('Error adding admin account.');
        }
    };
    xhr.send(formData);
}

// Function to add a newly added admin to the HTML table
function addAdminToTable(newAdmin) {
    // Update the HTML table with the new data
    const tableBody = document.querySelector('.admin-table tbody');
    tableBody.innerHTML += `
        <tr>
            <td>${newAdmin.name}</td>
            <td>${newAdmin.email}</td>
            <td><button class="edit-button" onclick="editAdminAccount(${newAdmin.id})">Edit</button></td>
            <td><button class="delete-button" onclick="deleteAdminAccount(${newAdmin.id})">Delete</button></td>
        </tr>
    `;
}

    
    </script>
</body>
</html>
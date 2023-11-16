<?php
session_start(); // Start the session

    // Include your database connection file
    require_once "../../config/dbconnect.php";
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
                                        echo "<tr id='" . $row['id'] . "'>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td> <button class='edit-button' onclick='openEditAdminModal(" . $row['id'] . ")'>Edit</button></td>";
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
                                <input type="submit" value="ADD ACCOUNT" onclick="openAddAdminModal()">
                            </div>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ADD ADMIN ACCOUNT -->
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

            <!-- EDIT ADMIN ACCOUNT -->
            <div id="editAdminModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeEditAdminModal()">&times;</span>
                    <h2>Edit Admin Account</h2>
                    <form id="editAdminForm" action="" method="POST">
                        <div class="form-field">
                            <label for="editAdminName">Admin Name:</label>
                            <input type="text" id="editAdminName" placeholder="Enter new admin name" value="" required>
                        </div>
                        <div class="form-field">
                            <label for="editAdminEmail">Email:</label>
                            <input type="text" id="editAdminEmail" placeholder="Enter new email address" value="" required>
                        </div>
                        <div style="position: relative;">
                            <!-- Wrap password input and toggle icon in a container -->
                            <div class="form-field">
                                <label for="oldAdminPassword">Old Password:</label>
                                <input type="password" id="oldAdminPassword" name="adminOldPass" placeholder="Enter old password" required>
                                <a class="inputpass" onclick="togglePasswordVisibility('oldAdminPassword', 'passicon8')" style="position: absolute; right: 15px; top: 66%; transform: translateY(-50%); cursor: pointer; font-size: 14px;">
                                    <i class="fa fa-eye-slash" id="passicon8"></i>
                                </a>
                            </div>
                        </div>

                        <div style="position: relative;">
                            <!-- Wrap password input and toggle icon in a container -->
                            <div class="form-field">
                                <label for="editAdminPassword">New Password:</label>
                                <input type="password" id="editAdminPassword" name="adminNewPass" placeholder="Enter new password" required>
                                <a class="inputpass" onclick="togglePasswordVisibility('editAdminPassword', 'passicon9')" style="position: absolute; right: 15px; top: 66%; transform: translateY(-50%); cursor: pointer; font-size: 14px;">
                                    <i class="fa fa-eye-slash" id="passicon9"></i>
                                </a>
                            </div>
                        </div>

                     
                        <!-- Edit Button -->
                        <div class="butcon">
                            <button type="button" onclick="editAdminAccount(<? $row['id'] ?>)">Edit</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="form-container" id="createjob">
                <div class="post-container">
                    <!-- Job Posting Form -->
                    <h2>CREATE JOB POST</h2>
                    <form id="jobPostForm" action="adminJobPost.php" method="post">
                        <div class="form-group">
                            <div>
                                <label for="company">Company:</label>
                                <select id="company" name="company" required></select>
                                <!-- Include this hidden input field in your form -->
                                <input type="hidden" name="hiddenEmployerId" id="hiddenEmployerId" value="">

                            </div>
                            <div>
                                <label for="jobTitle">Job Title:</label>
                                <input type="text" id="jobTitle" name="jobTitle" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <label for="jobLocation">Job Location:</label>
                                <input type="text" id="jobLocation" name="jobLocation" required>
                            </div>
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
                            <div>
                                <label for="numberOfVacancies">Number of Vacancies:</label>
                                <input type="number" id="numberOfVacancies" name="numberOfVacancies" min="1" placeholder="Enter number of vacancies" required>
                            </div>
                            <div>
                                <label for="jobSalary">Salary:</label>
                                <input type="text" id="jobSalary" name="jobSalary" oninput="validateSalary(this)" required>
                            </div>
                        </div>
                        <div class="butcon">
                            <button type="submit">Post Job</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="form-container" id="activejob">
                <!-- Job Posting Form -->
                <h2>ACTIVE JOB POST</h2>
                
            </div>

            <div class="form-container" id="applicant">
                <div class="profile-info-item">
                    <h2>APPLICANTS</h2>
                </div>
                <div class="profile-info">
                    <div class="admin-table">
                        <h3>Applicant Accounts</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Contact No.</th>
                                    <th>House No./Street/Village</th>
                                    <th>Barangay</th>
                                    <th>Experience/Skills</th>
                                    <th>NSRP Form</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Include your PDO database connection
                                require_once '../../config/dbconnect.php';

                                try {
                                    // Query to get admin accounts
                                    $select_applicant_info = "SELECT personal_info.*, skills.* FROM personal_info JOIN skills ON personal_info.applicant_id = skills.applicant_id";
                                    $stmt_applicant_info = $conn->query($select_applicant_info);
                                   
                                    // Fetch and display admin accounts as table rows
                                    while ($row = $stmt_applicant_info->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['first_name'] . "</td>";
                                        echo "<td>" . $row['middle_name'] . "</td>";
                                        echo "<td>" . $row['surname'] . "</td>";
                                        echo "<td>" . $row['cellphone_number'] . "</td>";
                                        echo "<td>" . $row['house_no_street_village'] . "</td>";
                                        echo "<td>" . $row['barangay'] . "</td>";
                                        echo "<td>" . $row['skills'] . "</td>";
                                        echo "<td><button class='edit-button' onclick='viewNSRPform(" . $row['applicant_id'] . ")'>View</button></td>";
                                        echo "</tr>";
                                    }
                                } catch (PDOException $e) {
                                    // Handle the error if there is a problem with the database connection or query
                                    echo "Error: " . $e->getMessage();
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

    

            <div class="form-container" id="employer">
                <div class="profile-info-item">
                    <h2>EMPLOYERS</h2>
                </div>
                <div class="profile-info">
                    <div class="admin-table">
                        <h3>Employer Accounts</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>Employer Name</th>
                                    <th>Company Name</th>
                                    <th>Email</th>
                                    <th>Contact Number</th>
                                    <th>Company Address (Brgy/City/Province)</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Include your PDO database connection
                                require_once '../../config/dbconnect.php';

                                try {
                                    // Query to get employer accounts
                                    $select_employer_info = "SELECT employers.*, employer_info.* FROM employers JOIN employer_info ON employers.id = employer_info.employer_id";
                                    $stmt_employer_info = $conn->query($select_employer_info);

                                    // Fetch and display employer accounts as table rows
                                    while ($row = $stmt_employer_info->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['employer_name'] . "</td>";
                                        echo "<td>" . $row['company_name'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['contact_no'] . "</td>";
                                        echo "<td>" . $row['barangay'] . "/ " . $row['city'] . "/ " . $row['province'] . "</td>";

                                        // Display buttons with different colors based on the status
                                        $statusColor = ($row['is_approve'] == 1) ? 'green' : 'orange';
                                        echo "<td><button id='statusButton" . $row['id'] . "' style='background-color: $statusColor;' class='status-button' onclick='updateStatus(" . $row['id'] . ")'>" . ($row['is_approve'] == 1 ? 'Approved' : 'Pending') . "</button></td>";

                                        echo "<td> <button class='edit-button' onclick='openEditEmpModal(" . $row['id'] . ")'>Edit</button></td>";
                                        echo "<td><button class='delete-button' onclick='deleteEmpAccount(" . $row['id'] . ")'>Delete</button></td>";
                                        echo "</tr>";
                                    }
                                } catch (PDOException $e) {
                                    // Handle the error if there is a problem with the database connection or query
                                    echo "Error: " . $e->getMessage();
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
             <!-- EDIT EMPLOYER DETAILS -->
            <div id="editEmpModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeEditEmpModal()">&times;</span>
                    <h2>Edit Company Details</h2>
                    <form id="editEmpForm" action="" method="POST">
                        <div class="form-field">
                            <label for="editEmpName">Edit Employer Name:</label>
                            <input type="text" id="editEmpName" name="editEmpName" placeholder="Enter new employer name" required>
                        </div>
                        <div class="form-field">
                            <label for="editCompanyName">Edit Company Name:</label>
                            <input type="text" id="editCompanyName" name="editCompanyName" placeholder="Enter new company name" required>
                        </div>
                        <div class="form-field">
                            <label for="editEmpEmail">Edit Email:</label>
                            <input type="text" id="editEmpEmail" name="editEmpEmail" placeholder="Enter new email address" required>
                        </div>
                        <div class="form-field">
                            <label for="editEmpContact">Edit Contact Number:</label>
                            <input type="text" id="editEmpContact" name="editEmpContact" placeholder="Enter new contact number" required>
                        </div>
                        <div class="form-field">
                            <label for="editEmpBarangay">Edit Barangay:</label>
                            <input type="text" id="editEmpBarangay" name="editEmpBarangay" placeholder="Enter new barangay" required>
                        </div>
                        <div class="form-field">
                            <label for="editEmpCity">Edit City:</label>
                            <input type="text" id="editEmpCity" name="editEmpCity" placeholder="Enter new city" required>
                        </div>
                        <div class="form-field">
                            <label for="editEmpProvince">Edit Province:</label>
                            <input type="text" id="editEmpProvince" name="editEmpProvince" placeholder="Enter new province" required>
                        </div>

                        <!-- Add other form fields as needed -->

                        <!-- Edit Button -->
                        <div class="butcon">
                            <button type="button" onclick="editEmpAccount(<?php echo $row['id']; ?>)">Edit</button>
                        </div>
                    </form>
                </div>
            </div>


            <div class="form-container" id="feedbacks">
                <h2>FEEDBACKS</h2>
               
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

        // Function to open the "Edit Admin Account" modal
        function openEditAdminModal(adminId) {
            var modal = document.getElementById("editAdminModal");

            fetch('readAdmin.php', {
                    method: 'READ',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id: adminId })
            })
            .then(response => response.json())
            .then(data => {
                // Handle the retrieved data here
                if (data.name && data.email) {
                    // Access the admin's name and email
                    const adminName = data.name;
                    const adminEmail = data.email;
                    document.getElementById("editAdminName").value = `${adminName}`;
                    document.getElementById("editAdminEmail").value = `${adminEmail}`;
                    // console.log(`Admin Name: ${adminName}`);
                    // console.log(`Admin Email: ${adminEmail}`);
                } else {
                    console.error('Error: Invalid data received from the server.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
            modal.style.display = "block";
        }

        // Function to close the "Edit Admin Account" modal
        function closeEditAdminModal() {
            var modal = document.getElementById("editAdminModal");
            modal.style.display = "none";
        }


        // CREATE ADMIN DATA
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

        // UPDATE ADMIN DATA
        // Function to edit an admin account
        function editAdminAccount(adminId) {
            // Retrieve form data
            const editName = document.getElementById('editAdminName').value;
            const editEmail = document.getElementById('editAdminEmail').value;
            const oldPass = document.getElementById('oldAdminPassword').value
            const editPassword = document.getElementById('editAdminPass').value;

            // Create a FormData object to send the data
            const formData = new FormData();
            formData.append('editAdminName', name);
            formData.append('editAdminEmail', email);
            formData.append('oldAdminPassword', oldpassword);
            formData.append('editAdminPassword', editpassword);

            fetch('updateAdmin.php', {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id: adminId })
            })
        }

        // GET ADMIN DATA
        // READ ADMIN DATA
        function readAdminData(adminId) {
            fetch('readAdmin.php', {
                    method: 'READ',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id: adminId })
            })
            .then(response => response.json())
            .then(data => {
                // Handle the retrieved data here
                if (data.name && data.email) {
                    // Access the admin's name and email
                    const adminName = data.name;
                    const adminEmail = data.email;
                    console.log(`Admin Name: ${adminName}`);
                    console.log(`Admin Email: ${adminEmail}`);
                } else {
                    console.error('Error: Invalid data received from the server.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function deleteAdminAccount(adminId) {
            if (confirm("Are you sure you want to delete this admin account?")) {
                fetch('deleteAdmin.php', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id: adminId })
                })
                .then(response => response.json())
                .then(data => {
                    // Declare row from the table to be deleted
                    const rowToDelete = document.getElementById(adminId);
                    if (data.success) {
                        rowToDelete.remove(); // Delete the table row 
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        }

        // Function to add a newly added admin to the HTML table
        function addAdminToTable(newAdmin) {
            // Update the HTML table with the new data
            const tableBody = document.querySelector('.admin-table tbody');
            tableBody.innerHTML += `
                <tr id="${newAdmin.id}">
                    <td>${newAdmin.name}</td>
                    <td>${newAdmin.email}</td>
                    <td><button class="edit-button" onclick="openEditAdminModal(${newAdmin.id})">Edit</button></td>
                    <td><button class="delete-button" onclick="deleteAdminAccount(${newAdmin.id})">Delete</button></td>
                </tr>
            `;
        }

        // Define your function to show the nsrp div and hide the applicant div
        //function viewNSRPform() {
            // Close Side Panel
            //hideSidebar();

            // Hide the applicant div
           // document.getElementById("applicant").style.display = "none";
            
            // Display the nsrp div by setting its style.display property to "block"
            //document.getElementById("nsrp").style.display = "block";
      //  }

    function updateStatus(employerId) {
        // Create a new XMLHttpRequest object
        var xhr = new XMLHttpRequest();

        // Configure it to send a POST request to your server
        xhr.open('POST', 'updateStatus.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        // Define the data to be sent to the server
        var data = 'employerId=' + employerId;

        // Set up the callback function to handle the server's response
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Update the button and display the new status
                var button = document.querySelector('#statusButton' + employerId);
                var status = xhr.responseText;

                button.style.backgroundColor = (status === 'Approved') ? 'green' : 'orange';
                button.innerText = status;
            }
        };

        // Send the request to the server
        xhr.send(data);
    }


    function openEditEmpModal(employerId, employerName, companyName, employerEmail, employerContact, employerBarangay, employerCity, employerProvince) {
        // Populate form fields with the current details
        document.getElementById('editEmpName').value = employerName;
        document.getElementById('editCompanyName').value = companyName;
        document.getElementById('editEmpEmail').value = employerEmail;
        document.getElementById('editEmpContact').value = employerContact;
        document.getElementById('editEmpBarangay').value = employerBarangay;
        document.getElementById('editEmpCity').value = employerCity;
        document.getElementById('editEmpProvince').value = employerProvince;

        // Display the modal
        document.getElementById('editEmpModal').style.display = 'block';
    }

    function closeEditEmpModal() {
        // Close the modal
        document.getElementById('editEmpModal').style.display = 'none';
    }

    function editEmpAccount(employerId) {
        // Use AJAX to send the edited details to the server
        var newName = document.getElementById('editEmpName').value;
        var newCompanyName = document.getElementById('editCompanyName').value;
        var newEmail = document.getElementById('editEmpEmail').value;
        var newContact = document.getElementById('editEmpContact').value;
        var newBarangay = document.getElementById('editEmpBarangay').value;
        var newCity = document.getElementById('editEmpCity').value;
        var newProvince = document.getElementById('editEmpProvince').value;

        // Add other form fields...

        // Example AJAX code
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_employer.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle the response (if needed)
                console.log(xhr.responseText);
                // You can close the modal or handle success in another way
                closeEditEmpModal();
            }
        };
        xhr.send('employerId=' + employerId + '&newName=' + newName + '&newCompanyName=' + newCompanyName + '&newEmail=' + newEmail + '&newContact=' + newContact + '&newBarangay=' + newBarangay + '&newCity=' + newCity + '&newProvince=' + newProvince);
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

        $(document).ready(function () {
    // Function to fetch and populate company names
    function populateCompanyNames() {
        // Make an AJAX request to fetch company names
        $.ajax({
            url: 'getCompanies.php', // replace with the actual URL to fetch company names
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                // Clear existing options
                $('#company').empty();

                // Add new options based on the response
                $.each(data, function (index, company) {
                    $('#company').append('<option value="' + company.employer_id + '" data-employer-id="' + company.employer_id + '">' + company.company_name + '</option>');
                });
            },
            error: function (error) {
                console.error('Error fetching company names:', error);
            }
        });
    }

    // Call the function to populate company names when the page loads
    populateCompanyNames();

    // Add an event listener for the change event on the company select
    $('#company').change(function () {
        // Get the selected company's employer_id
        var selectedEmployerId = $(this).find('option:selected').data('employer-id');

        // Log the selected values (you can use these values to update hidden inputs or any other logic)
        console.log('Selected Company ID:', selectedEmployerId);
    });

    // Add an event listener for form submission
    $('#jobPostForm').submit(function (event) {
        event.preventDefault(); // Prevent the form from submitting normally

        // Get the selected company's employer_id
        var selectedEmployerId = $('#company').val();

        // Add the selected employer_id to a hidden input field in the form
        $('#hiddenEmployerId').val(selectedEmployerId);

        // Now you can submit the form
        // You might want to perform additional validations or AJAX calls before submitting

        // Uncomment the line below to submit the form
        // $(this).unbind('submit').submit();
        
        // If you want to send the selected employer ID to your backend for database storage
        // You can make an AJAX request here to send the data to your PHP backend
    });
});


        document.getElementById('jobPostForm').addEventListener('submit', function (event) {
            event.preventDefault();


            fetch('adminJobPost.php', {
                method: 'POST',
                body: new FormData(this),
            })
            .then(response => response.text())
            .then(message => {
                // Display the message
                alert(message);

                // Reset the form fields
                document.getElementById('jobPostForm').reset();

                // Optionally, you can redirect the user or perform other actions based on the response
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

      

    </script>
</body>
</html>
<?php
include '../../config/dbconnect.php';

if(isset($_SESSION['applicant_id'])){
    $applicant_id = $_SESSION['applicant_id'];
}


?>
<!DOCTYPE html> 
<html>
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  
  
</head>
<body>
     <!-- Add a button to toggle the sidebar -->
    <label class="toggle-button-label" for="toggle-sidebar">&#9776;</label>
    <input type="checkbox" id="toggle-sidebar" class="toggle-button">

    <div class="sidebar" id="mySidebar">
        <div class="side-header">
            <!-- Input for profile picture upload -->
            <input type="file" id="profile-picture" accept="image/*" style="display: none;">
            <a href="#" onclick="uploadProfilePicture()">
                 <img src="../../img/ProfileIcon.png" alt="Applicant Icon" class="profilepic" id="profile-picture-display">
                 
            </a>

                <?php          
                    $select_profile = $conn->prepare("SELECT * FROM `personal_info` WHERE applicant_id = ?");
                    $select_profile->execute([$applicant_id]);
                    if ($select_profile->rowCount() > 0) {
                    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                ?>
            <h2>WELCOME, <br><b style="color: #2B65E2;"><?= $fetch_profile["first_name"]; ?></b></h2>

            <?php
                    }else{
                ?>
                    <p>please login or register first!</p>
                <?php
                    }
                ?> 
        </div>
        <div>
            <div class="sidebar-item">
                <a href="#profile" data-form-id="myprofile" onclick="showForm('myprofile'); updateSidebarSelection('myprofile');" class="selected-item">
                    <i class="fas fa-user"></i> <span class="icon-text"> My Profile </span>
                </a>
             </div>
            <div class="sidebar-item">
                <a href="#myreferral" data-form-id="referral" onclick="showForm('referral'); updateSidebarSelection('referral');">
                    <i class="fas fa-file-alt"></i> <span class="icon-text"> My Referrals </span>
                </a>
            </div>
            <div class="sidebar-item">
                <a href="#mynsrp" data-form-id="nsrp" onclick="showForm('nsrp'); updateSidebarSelection('nsrp');">
                    <i class="fas fa-file-signature"></i> <span class="icon-text"> NSRP Form </span>
                </a>
            </div>
            <div class="sidebar-item">
                <a href="#jobpost" data-form-id="post" onclick="showForm('post'); updateSidebarSelection('post');">
                    <i class="fas fa-file-alt"></i></i> <span class="icon-text"> Job Posts </span>
                </a>
            </div>
        </div>
    </div>

    <script>
        // JavaScript to toggle the sidebar and h2 element
        const toggleButton = document.getElementById('toggle-sidebar');
        const sidebar = document.getElementById('mySidebar');
        const headerText = document.querySelector('.side-header h2');

        // Function to hide the sidebar and the headerText
        function hideSidebar() {
          sidebar.classList.add('hide');
          headerText.style.display = 'none'; // Hide the h2 element
        }

        // Function to show the sidebar and the headerText
        function showSidebar() {
          sidebar.classList.remove('hide');
          headerText.style.display = 'block'; // Show the h2 element
        }

        // Function to toggle the sidebar based on screen width
        function toggleSidebarByScreenWidth() {
          const screenWidth = window.innerWidth;

          if (screenWidth <= 600) {
            hideSidebar(); // Hide the sidebar and headerText in smaller screens
          } else {
            showSidebar(); // Show the sidebar and headerText in larger screens
          }
        }

        // Event listener for the toggle button
        toggleButton.addEventListener('change', function () {
          if (this.checked) {
            hideSidebar();
          } else {
            showSidebar();
          }
        });

        // Check screen width on page load and when the window is resized
        window.addEventListener('DOMContentLoaded', toggleSidebarByScreenWidth);
        window.addEventListener('resize', toggleSidebarByScreenWidth);

        function updateSidebarSelection(formId) {
        const sidebarItems = document.querySelectorAll('.sidebar-item a');
    
        sidebarItems.forEach(item => {
          const targetFormId = item.getAttribute('data-form-id');
          if (targetFormId === formId) {
            item.classList.add('selected-item');
          } else {
            item.classList.remove('selected-item');
          }
        });
      }
      
    </script>
</body>
</html>
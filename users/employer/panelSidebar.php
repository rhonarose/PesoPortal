<?php
include '../../config/dbconnect.php';

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
    
    <link rel="stylesheet" type="text/css" href="../../../css/style.css">
  
</head>
<body>

  <!-- Add a button to toggle the sidebar -->
  <label class="toggle-button-label" for="toggle-sidebar">&#9776;</label>
  <input type="checkbox" id="toggle-sidebar" class="toggle-button">


  <div class="sidebar" id="mySidebar">
        <div class="side-header">
            <!-- Input for profile picture upload -->
            <?php
                $select_employer_info = $conn->prepare("SELECT * FROM `employer_info` WHERE employer_id = ?");
                $select_employer_info->execute([$employer_id]);
                if ($select_employer_info->rowCount() > 0) 
                $fetch_employer_info = $select_employer_info->fetch(PDO::FETCH_ASSOC);
            ?>
            <input type="file" id="profile-picture" accept="image/*" style="display: none;">
            <!-- <a href="#" onclick="uploadProfilePicture()"> -->
              <img src="<?php echo $fetch_employer_info["company_logo"]; ?>" alt="Company Logo" id="logoPreview">
            </a>

            <?php          
                $select_name = $conn->prepare("SELECT * FROM `employers` WHERE id = ?");
                $select_name->execute([$employer_id]);
                if ($select_name->rowCount() > 0) {
                $fetch_name = $select_name->fetch(PDO::FETCH_ASSOC);
                ?>
            <h2>WELCOME, <br><b style="color: #2B65E2;"><?= $fetch_name["employer_name"]; ?></b></h2>

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
        <a href="#mydashboard" data-form-id="dashboard" onclick="showForm('dashboard'); updateSidebarSelection('dashboard');" class="selected-item">
          <i class="fas fa-chart-line"></i> <span class="icon-text"> Dashboard </span>
        </a>
      </div>
      <div class="sidebar-item">
        <a href="#myprofile" data-form-id="profile" onclick="showForm('profile'); updateSidebarSelection('profile');">
          <i class="fas fa-user"></i> <span class="icon-text"> My Profile </span>
        </a>
      </div>

      <div class="sidebar-item">
        <a href="#createmyJobpost" data-form-id="createjob" onclick="showForm('createjob'); updateSidebarSelection('createjob')">
          <i class="fas fa-plus"></i> <span class="icon-text"> Create Job Post </span>
        </a>
      </div>

      <div class="sidebar-item">
        <a href="#myjobPost" data-form-id="jobPost" onclick="showForm('jobPost'); updateSidebarSelection('jobPost')">
          <i class="fas fa-file-alt"></i> <span class="icon-text"> My Job Posts </span>
        </a>
      </div>
    </div>
  </div>

  <script>
    /* function uploadProfilePicture() {
            // Trigger the hidden file input element
            const profilePictureInput = document.getElementById("profile-picture");
            profilePictureInput.click();

            // Listen for file selection
            profilePictureInput.addEventListener("change", function() {
                const selectedFile = profilePictureInput.files[0];
                if (selectedFile) {
                    // Display the selected image
                    const profilePictureDisplay = document.getElementById("profile-picture-display");
                    profilePictureDisplay.src = URL.createObjectURL(selectedFile);
                }
            });
        }
 */
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


    function disableSidebarItems() {
    var sidebarItems = document.querySelectorAll('.sidebar-item a');
    sidebarItems.forEach(function(item) {
        item.setAttribute('disabled', 'true');
        item.style.pointerEvents = 'none';
        item.style.display = 'none';
    });
    }

  </script>
</body>
</html>
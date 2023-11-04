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
  <div class="sidebar-content">
    <div class="side-header">
      <img src="../../img/ProfileIcon.png" alt="Applicant Icon">
                <?php          
                    $select_profile = $conn->prepare("SELECT * FROM `applicants` WHERE id = ?");
                    $select_profile->execute([$applicant_id]);
                    if($select_profile->rowCount() > 0){
                    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                ?>
            <h2>WELCOME, <br><b style="color: #2B65E2;"><?= $fetch_profile["username"]; ?></b></h2>

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
        <a href="#personalinformation" data-form-id="personalInfoForm" onclick="showForm('personalInfoForm'); updateSidebarSelection('personalInfoForm');" class="selected-item">
          <i class="fas fa-user"></i> <span class="icon-text">Personal Information </span>
        </a>
      </div>
      <div class="sidebar-item">
        <a href="#preference" data-form-id="preferenceForm" onclick="showForm('preferenceForm'); updateSidebarSelection('preferenceForm');">
          <i class="fas fa-cogs"></i> <div class="icon-text"> Preference </div>
        </a>
      </div>
      <div class="sidebar-item">
        <a href="#language" data-form-id="languageForm" onclick="showForm('languageForm'); updateSidebarSelection('languageForm')">
          <i class="fas fa-language"></i> <span class="icon-text"> Language/Dialect Proficiency </span>
        </a>
      </div>

      <div class="sidebar-item">
        <a href="#educationalbackground" data-form-id="eduBackgroundForm" onclick="showForm('eduBackgroundForm'); updateSidebarSelection('eduBackgroundForm')">
          <i class="fas fa-graduation-cap"></i> <span class="icon-text"> Educational Background </span>
        </a>
      </div>

      <div class="sidebar-item">
        <a href="#training" data-form-id="trainingForm" onclick="showForm('trainingForm'); updateSidebarSelection('trainingForm')">
          <i class="fas fa-tools"></i> <span class="icon-text"> Technical/Vocational and other Training </span>
        </a>
      </div>

      <div class="sidebar-item">
        <a href="#eligibility" data-form-id="eligibilityForm" onclick="showForm('eligibilityForm'); updateSidebarSelection('eligibilityForm')">
          <i class="fas fa-id-badge"></i> <span class="icon-text"> Eligibility/Professional License </span>
        </a>
      </div>

      <div class="sidebar-item">
        <a href="#workexperience" data-form-id="workExpForm" onclick="showForm('workExpForm'); updateSidebarSelection('workExpForm')">
          <i class="fas fa-briefcase"></i> <span class="icon-text"> Work Experience </span>
        </a>
      </div>

      <div class="sidebar-item">
        <a href="#skills" data-form-id="skillsForm" onclick="showForm('skillsForm'); updateSidebarSelection('skillsForm')">
          <i class="fas fa-lightbulb"></i> <span class="icon-text"> Other Skills Acquired Without Training </span>
        </a>
      </div>
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
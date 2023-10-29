// signup.php
function showForm(formType) {
    if (formType === "applicant") {
        document.getElementById("applicantForm").style.display = "block";
        document.getElementById("employerForm").style.display = "none";

    } else if (formType === "employer") {
        document.getElementById("applicantForm").style.display = "none";
        document.getElementById("employerForm").style.display = "block";
    }
}

// Show password function
function togglePasswordVisibility(inputId, iconId) {
    var input = document.getElementById(inputId);
    var icon = document.getElementById(iconId);
    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    } else {
        input.type = "password";
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    }
}

// Function to set the selected radio button value in local storage
function setSelectedRadio(userType) {
    localStorage.setItem('selectedUserType', userType);
}

// Function to get the selected radio button value from local storage
function getSelectedRadio() {
    return localStorage.getItem('selectedUserType');
}

// Function to display the appropriate form based on the selected radio button value
function showSelectedForm() {
    var userType = getSelectedRadio();
    if (userType === 'Employer') {
        showForm('employer');
        document.getElementById('employerRadio').checked = true;
    } else {
        showForm('applicant');
        document.getElementById('applicantRadio').checked = true;
    }
}

// Set the selected radio button value when the radio button is clicked
document.addEventListener('DOMContentLoaded', function() {
    var userTypeRadios = document.querySelectorAll('input[name="userType"]');
    userTypeRadios.forEach(function(radio) {
        radio.addEventListener('click', function() {
            setSelectedRadio(this.value);
        });
    });

    // Show the appropriate form based on the selected radio button value on page load
    showSelectedForm();
});

function validateForm() {
var userType = document.querySelector('input[name="userType"]:checked').value;
var errorMessages = {
    applicantName: document.getElementById('errorAppUname'),
    applicantEmail: document.getElementById('errorAppEmail'),
    applicantPassword: document.getElementById('errorAppPass'),
    confirmPassword1: document.getElementById('errorAppCpass'),
    employerName: document.getElementById('errorEmpName'),
    employerEmail: document.getElementById('errorEmpEmail'),
    employerPassword: document.getElementById('errorEmpPass'),
    confirmPassword2: document.getElementById('errorEmpCpass'),
};
for (let field in errorMessages) {
    errorMessages[field].innerHTML = ''; // Clear any previous error messages
}

// Validate applicant fields
if (userType === 'Applicant') {
    var applicantName = document.getElementById('appuname').value;
    var applicantEmail = document.getElementById('appemail').value;
    var applicantPassword = document.getElementById('apppass').value;
    var confirmPassword1 = document.getElementById('appconpass').value;

    if (!applicantName) {
        errorMessages.applicantName.innerHTML = 'Please fill in the Username field.';
        return false;
    }

    if (!applicantEmail) {
        errorMessages.applicantEmail.innerHTML = 'Please fill in the Email field.';
        return false;
    }

    if (!applicantPassword) {
        errorMessages.applicantPassword.innerHTML = 'Please fill in the Password field.';
        return false;
    }

    if (!confirmPassword1) {
        errorMessages.confirmPassword1.innerHTML = 'Please fill in the Confirm Password field.';
        return false;
    }
    // Check if passwords match for the applicant form
    if (applicantPassword !== confirmPassword1) {
        errorMessages.confirmPassword1.innerHTML = 'Passwords do not match.';
        return false;
    }

    var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&^~`()[\]{}\-_=+\\|:;"'<>,./?]).{8,}$/;
    if (!passwordPattern.test(applicantPassword)) {
        errorMessages.applicantPassword.innerHTML = "Password must be at least 8 characters long that contains at least<br>an uppercase, lowercase letter, number, and special character.";
        return false;
    }
}

// Validate employer fields
if (userType === 'Employer') {
    var employerName = document.getElementById('empname').value;
    var employerEmail = document.getElementById('empemail').value;
    var employerPassword = document.getElementById('emppass').value;
    var confirmPassword2 = document.getElementById('empconpass').value;

    if (!employerName) {
        errorMessages.employerName.innerHTML = 'Please fill in the Name field.';
        return false;
    }

    if (!employerEmail) {
        errorMessages.employerEmail.innerHTML = 'Please fill in the Email field.';
        return false;
    }

    if (!employerPassword) {
        errorMessages.employerPassword.innerHTML = 'Please fill in the Password field.';
        return false;
    }

    if (!confirmPassword2) {
        errorMessages.confirmPassword2.innerHTML = 'Please fill in the Confim Password field.';
        return false;
    }
    // Check if passwords match for the employer form
    if (employerPassword !== confirmPassword2) {
        errorMessages.confirmPassword2.innerHTML = 'Passwords do not match.';
        return false;
    }

    var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&^~`()[\]{}\-_=+\\|:;"'<>,./?]).{8,}$/;
    if (!passwordPattern.test(employerPassword)) {
        errorMessages.employerPassword.innerHTML = 'Password must be at least 8 characters long that contains at least<br>an uppercase, lowercase letter, number, and special character.';
        return false;
    }

}

return true; // All fields are valid, allow form submission
} 

//forgotPass.php
const findAccountForm = document.getElementById("findAccForm");
const verificationForm = document.getElementById("verificationForm");
const changePass = document.getElementById("changePass");

function showVerificationForm() {
    findAccountForm.style.display = "none";
     verificationForm.style.display = "block";
            
}

function showFindAccountForm() {
    verificationForm.style.display = "none";
    findAccountForm.style.display = "block";
    changePass.style.display = "none"; // Hide changePass form when going back
}

function showChangePass() {
    changePass.style.display = "block";
    verificationForm.style.display = "none";
    findAccountForm.style.display = "none";
}

function limitToNumbers(input) {
    input.value = input.value.replace(/[^0-9]/g, ''); // Remove non-numeric characters
}


document.addEventListener("DOMContentLoaded", function() {
    const searchIcon = document.getElementById("search-icon");
    const searchWrapper = document.getElementById("search-wrapper");
    const searchInput = document.getElementById("searchjob");
    const settingsIcon = document.getElementById("settings-icon");
    const dropdown = document.querySelector(".dropdown");

    searchIcon.addEventListener("click", function() {
        searchIcon.style.display = "none";
        searchWrapper.style.display = "block";
        searchInput.focus();
    });

    searchInput.addEventListener("blur", function() {
        if (searchInput.value === '') {
            searchIcon.style.display = "inline";
            searchWrapper.style.display = "none";
        }
    });

    settingsIcon.addEventListener("click", function(event) {
        event.preventDefault();
        dropdown.classList.toggle("active");
    });

    document.addEventListener("click", function(event) {
        const targetElement = event.target;
        if (!dropdown.contains(targetElement) && targetElement !== settingsIcon) {
            dropdown.classList.remove("active");
        }
    });
});

function disableNavbarElements() {
    // Disable search icon
    var searchIcon = document.getElementById('search-icon');
    if (searchIcon) {
        searchIcon.removeAttribute('href'); // Remove the link
        searchIcon.style.pointerEvents = 'none'; // Disable click events
        searchIcon.style.color = '#2B65E2'; // Reduce opacity to indicate it's disabled
    }

    // Disable notification icon
    var notifIcon = document.querySelector('.notif-icon');
    if (notifIcon) {
        notifIcon.style.pointerEvents = 'none';
        notifIcon.style.color = '#2B65E2';
    }

    var notifCount = document.querySelector('.notif-icon .notif-count');
    if (notifCount) {
        notifCount.style.display = 'none'; // Hide the notification count
    }
}


//userNavbar.php
// Function to show the account settings modal
function openAccountSettingsModal() {
    const changePassword = document.getElementById('changeButton');
    const modal = document.getElementById('accountSettingsModal');
    modal.style.display = 'block';
    changePassword.style.display = 'block';
}


// Function to close the account settings modal
function closeAccountSettingsModal() {
    const modal = document.getElementById('accountSettingsModal');
    modal.style.display = 'none';

    // Reset the modal content to the default state
    hideChangePassword();
}

// Function to show the content for changing the password
function showChangePassword() {
    const changePassword = document.getElementById('changeButton');
    const changePasswordContent = document.getElementById('changePasswordContent');
    changePasswordContent.style.display = 'block';
    changePassword.style.display = 'none';

}

// Function to hide the content for changing the password
function hideChangePassword() {
    const changePasswordContent = document.getElementById('changePasswordContent');
    changePasswordContent.style.display = 'none';
}

// Function to handle password change submission
function changePassword() {
    // Implement your password change logic here
    // You can access the input fields by their IDs (e.g., document.getElementById('currentPassword'))
    // Perform validation and update the password as needed
    // Close the modal when the password is successfully changed
    closeAccountSettingsModal();
}

// JavaScript code to handle feedback modal
document.addEventListener("DOMContentLoaded", function() {
    const feedbackLink = document.getElementById("feedback-link");
    const feedbackModal = document.getElementById("feedback-modal");
    const feedbackTextArea = document.getElementById("feedback-text");

    feedbackLink.addEventListener("click", function() {
        feedbackModal.style.display = "block";
    });

    // Function to close the feedback modal
    window.closeFeedbackModal = function() {
        feedbackModal.style.display = "none";
    };

    // Function to submit feedback
    window.submitFeedback = function() {
        const feedback = feedbackTextArea.value;

        // You can send the feedback to your server using AJAX or fetch API
        // Example: sendFeedbackToServer(feedback);

        // Clear the textarea and close the modal
        feedbackTextArea.value = "";
        feedbackModal.style.display = "none";

        // Optionally, you can display a confirmation message to the user
    };
});
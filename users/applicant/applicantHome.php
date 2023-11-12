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
                    $select_personal_info = $conn->prepare("SELECT * FROM `personal_info` WHERE applicant_id = ?");
                    $select_preference = $conn->prepare("SELECT * FROM `preference` WHERE applicant_id = ?");
                    $select_language = $conn->prepare("SELECT * FROM `language` WHERE applicant_id = ?");
                    $select_education = $conn->prepare("SELECT * FROM `educational_background` WHERE applicant_id = ?");
                    $select_training = $conn->prepare("SELECT * FROM `training` WHERE applicant_id = ?");
                    $select_eligibility = $conn->prepare("SELECT * FROM `eligibility` WHERE applicant_id = ?");
                    $select_work = $conn->prepare("SELECT * FROM `work_experience` WHERE applicant_id = ?");
                    $select_skills = $conn->prepare("SELECT skills FROM `skills` WHERE applicant_id = ?");
                    // Add similar prepared statements for other tables

                    $select_personal_info->execute([$applicant_id]);
                    $select_preference->execute([$applicant_id]);
                    $select_language->execute([$applicant_id]);
                    $select_education->execute([$applicant_id]);
                    $select_training->execute([$applicant_id]);
                    $select_eligibility->execute([$applicant_id]);
                    $select_work->execute([$applicant_id]);
                    $select_skills->execute([$applicant_id]);
                    // Execute other prepared statements for the remaining tables

                    if (
                        $select_personal_info->rowCount() > 0 && 
                        $select_preference->rowCount() > 0 &&
                        $select_language->rowCount() > 0 && 
                        $select_education->rowCount() > 0 &&
                        $select_training->rowCount() > 0 && 
                        $select_eligibility->rowCount() > 0 &&
                        $select_work->rowCount() > 0 
                        // Check other prepared statements for data availability
                    ) {
                        $fetch_personal_info = $select_personal_info->fetch(PDO::FETCH_ASSOC);
                        $fetch_preference = $select_preference->fetch(PDO::FETCH_ASSOC);
                        $fetch_language = $select_language->fetch(PDO::FETCH_ASSOC);
                        $fetch_education = $select_education->fetch(PDO::FETCH_ASSOC);
                        $fetch_training = $select_training->fetch(PDO::FETCH_ASSOC);
                        $fetch_eligibility = $select_eligibility->fetch(PDO::FETCH_ASSOC);
                        $fetch_work = $select_work->fetch(PDO::FETCH_ASSOC);

                        // Fetch and store the skills in an array
                        $skills = [];
                        while ($row = $select_skills->fetch(PDO::FETCH_ASSOC)) {
                            $skills[] = $row['skills'];
                        }
                        
                        // You can similarly fetch data from other tables

                ?>


                <div class="profile-info">
                    <div class="profile-info-item">
                        <h2><?= $fetch_personal_info["first_name"]; ?> <?= $fetch_personal_info["middle_name"]; ?> <?= $fetch_personal_info["surname"]; ?></h2>
                    </div>
                    <div class="profile-info-item">
                        <i class="fas fa-phone"></i><?= $fetch_personal_info["cellphone_number"]; ?>
                    </div>
                    <div class="profile-info-item">
                        <i class="fas fa-envelope"></i> <?= $fetch_personal_info["email"]; ?>
                    </div>
                    <div class="profile-info-item">
                        <i class="fas fa-map-marker-alt"></i> <?=$fetch_personal_info["barangay"]; ?>, <?= $fetch_personal_info["municipality_city"]; ?>
                    </div>
                    <div class="profile-info-item">
                        <i class="fas fa-wrench"></i> <?= implode(', ', $skills); ?> <!-- Display skills -->
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
                        <div class="form-field" style="display: flex;" >
                            <label for="editedName">First Name:</label>
                            <input type="text" id="editedfName" placeholder="Enter your First name">
                            <label for="editedName">Middle Name:</label>
                            <input type="text" id="editedmName" placeholder="Enter your Middle name">
                            <label for="editedName">Surname:</label>
                            <input type="text" id="editedsName" placeholder="Enter your Surname">
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
                            <input type="file" id="Resume" placeholder="Enter your skill">
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
                <h2>MY REFERRALS</h2>
                
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

            <?php
            // Define the formatDate function
            function formatDate($date) {
                if ($date == "0000-00-00") {
                    return "";
                } else {
                    return date("m/d/Y", strtotime($date));
                }
            }
            ?>

            <div class="form-container" id="nsrp">
                <!-- Eligibility Form -->
                <h2>NSRP FORM</h2>
                <!-- Personal Information Form -->
                    <table>
                        <tr class="formlabel">
                            <td>
                                <b><p>NSRP FORM</p>
                                <p>January 2017</p></b>
                            </td>
                            <td colspan="3">
                                <b><p>Republic of the Philippines</p>
                                <p>Department of labor and Employment</p>
                                <p>PESO EMPLOYMENT INFORMATION SYSTEM</p>
                                <p>REGISTRATION FORM</p></b>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <p><b>INSTRUCTIONS: Please fill out the form legibly. Print in block letters. Check appropriate boxes. Please do not leave any items unanswered. Indicate "N/A"
                                    if not applicable. Submit accomplished form after filling up.</b></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <h3>I. PERSONAL INFORMATION</h3>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="sname">SURNAME:</label>
                                <?= $fetch_personal_info["surname"]; ?>
                            </td>
                            <td>
                                <label for="fname">FIRST NAME:</label>
                                <?= $fetch_personal_info["first_name"]; ?>
                            </td>
                            <td>
                                <label for="mname">MIDDLE NAME:</label>
                                <?= $fetch_personal_info["middle_name"]; ?>
                            </td>
                            <td>
                                <label for="suffix">SUFFIX:</label>
                                <?= $fetch_personal_info["suffix"]; ?>
                            </td>
                        </tr>
                        <tr id="format">
                            <td colspan="2">
                                <label for="bdate">BIRTHDATE:</label>
                                <span class="editable-date"><?php echo formatDate($fetch_personal_info["birthdate"]); ?></span>
                            </td>
                            <td colspan="2">
                                <label for="bplace">BIRTHPLACE:</label>
                                <span><?= $fetch_personal_info["birthplace"]; ?></span>
                            </td>
                        </tr>
                        <tr id="format">
                            <td colspan="2">
                                <label for="sex">SEX:</label>
                                <?= $fetch_personal_info["sex"]; ?>
                        </td>
                            <td colspan="2">
                                <label for="religion">RELIGION:</label>
                                <span class="editable-select" data-field="religion"><?= $fetch_personal_info["religion"]; ?></span>
  
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" id="format">
                                <label for="civilstat">CIVIL STATUS:</label>
                                <span class="editable-select" data-field="civil_status"><?= $fetch_personal_info["civil_status"]; ?></span>
                            </td>
                            <td colspan="2">
                                <p>PRESENT ADDRESS:</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="height">HEIGHT (cm):</label>
                                <span><?= $fetch_personal_info["height"]; ?></span>
                            </td>
                            <td>
                                <label for="email">EMAIL ADDRESS:</label>
                                <?= $fetch_personal_info["email"]; ?>
                            </td>
                            <td>
                                <label for="houseno">HOUSE NO/STREET VILLAGE:</label><br>
                                <span><?= $fetch_personal_info["house_no_street_village"]; ?></span>
                            </td>
                            <td>
                                <label for="brgy">BARANGAY:</label>
                                <span class="editable-select" data-field="barangay"><?= $fetch_personal_info["barangay"]; ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="landline">LANDLINE NUMBER:</label>
                                <span><?= $fetch_personal_info["landline_number"]; ?></span>
                            </td>
                            <td>
                                <label for="cpno">CELLPHONE NUMBER:</label><br>
                                <span><?= $fetch_personal_info["cellphone_number"]; ?></span>
                            </td>
                            <td>
                                <label for="city">MUNICIPALITY/CITY:</label><br>
                                <?= $fetch_personal_info["municipality_city"]; ?>
                            </td>
                            <td>
                                <label for="province">PROVINCE:</label>
                                <?= $fetch_personal_info["province"]; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="tin">TIN:</label><br>
                                <?= $fetch_personal_info["tin"]; ?>
                            </td>
                            <td>
                                <label for="gsis/sss">GSIS/SSS ID NO.:</label><br>
                                <?= $fetch_personal_info["gsis_sss_id"]; ?>
                            </td>
                            <td>
                                <label for="pagibig">PAG-IBIG NO.:</label><br>
                                <?= $fetch_personal_info["pagibig_no"]; ?>
                            </td>
                            <td>
                                <label for="philhealth">PHILHEALTH NO.:</label><br>
                                <?= $fetch_personal_info["philhealth_no"]; ?>
                            </td>
                        </tr>
                        <tr id="format">
                            <td colspan="4">
                                <label for="disability">DISABILITY:</label>
                                <?= $fetch_personal_info["disability"]; ?>
                            </td>
                        </tr>
                        <tr >
                            <td rowspan="3">
                                <label for="empstat">EMPLOYMENT<br>STATUS / TYPE:</label>
                            </td>
                            <td colspan="3">
                                <?= $fetch_personal_info["employment_status"]; ?>,
                                <?= $fetch_personal_info["employment_type"]; ?>
                            </td>
                        </tr>
                        <tr> </tr>
                        <tr> </tr>
                        <tr>
                            <td colspan="2">
                                <label for="active">Are you actively looking for work?</label>
                                <?= $fetch_personal_info["actively_looking_for_work"]; ?><br>
        
                                <label for="immediately">Willing to work immediately?</label>
                                <?= $fetch_personal_info["willing_to_work_immediately"]; ?>
                              
                            </td>
                            <td colspan="2">
                                <label for="looking">How long have you been looking for work?</label>
                                <?= $fetch_personal_info["how_long_looking_for_work"]; ?><br>
                                <label for="when">If no, when?</label>
                                <?= $fetch_personal_info["if_no_when"]; ?>
                            </td>
                        </tr>
                        <tr id="format1">
                            <td colspan="2">
                                <label for="4ps">Are you a 4Ps beneficiary?</label>
                                <?= $fetch_personal_info["is_4ps_beneficiary"]; ?>
                                
                            </td>
                            <td colspan="2">
                                <label for="id4ps">If yes, Household ID No.?</label>
                                <?= $fetch_personal_info["household_id_4ps"]; ?>
                            </td>
                        </tr>
                       
                    </table>

               
                    <table class="editable-table">
                        <tr>
                            <td colspan="6">
                                <h3>II. PREFERENCE</h3>
                            </td>
                        </tr>
                        <tr class="formlabel">
                            <td colspan="2">
                                <label for="prefoccu">PREFERRED OCCUPATION:</label>
                            </td>
                            <td colspan="4">
                                <label for="prefloc">PREFERRED WORK LOCATION:</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="prefoccu1">1.</label>
                            </td>
                            <td>
                                <span><?= $fetch_preference["preferred_occupation1"]; ?></span>
                            </td>
                            <td colspan="2">
                                <input type="checkbox" <?= $fetch_preference["preferred_location1"] == 1 ? 'checked' : '' ?> value="1" disabled>   
                                <label for="prefloclocal">LOCAL, specify cities/municipalities:</label>
                            </td>
                            <td colspan="2"> 
                                <input type="checkbox" <?= $fetch_preference["preferred_location2"] == 1 ? 'checked' : '' ?> value="1" disabled>   
                                <label for="preflocover">OVERSEAS, specify countries:</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="prefoccu2">2.</label>
                            </td>
                            <td>
                                <span><?= $fetch_preference["preferred_occupation2"]; ?></span>
                            </td>
                            <td>
                                <label for="prefloclocal1">1.</label>
                            </td>
                            <td>
                                <span><?= $fetch_preference["local_location1"]; ?></span>
                            </td>
                            <td>
                                <label for="preflocover1">1.</label>
                            </td>
                            <td>
                                <span><?= $fetch_preference["overseas_location1"]; ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="prefoccu3">3.</label>
                            </td>
                            <td>
                                <span><?= $fetch_preference["preferred_occupation3"]; ?></span>
                            </td>
                            <td>
                                <label for="prefloclocal2">2.</label>
                            </td>
                            <td>
                                <span><?= $fetch_preference["local_location2"]; ?></span>
                            </td>
                            <td>
                                <label for="preflocover2">2.</label>
                            </td>
                            <td>
                                <span><?= $fetch_preference["overseas_location2"]; ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="prefoccu4">4.</label>
                            </td>
                            <td>
                                <span><?= $fetch_preference["preferred_occupation4"]; ?></span>
                            </td>
                            <td>
                                <label for="prefloclocal3">3.</label>
                            </td>
                            <td>
                                <span><?= $fetch_preference["local_location3"]; ?></span>
                            </td>
                            <td>
                                <label for="preflocover3">3.</label>
                            </td>
                            <td>
                                <span><?= $fetch_preference["overseas_location3"]; ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="exsalary">EXPECTED SALARY (Range):</label>
                                <?= $fetch_preference["expected_salary"]; ?>
                            </td>
                            <td colspan="2">
                                <label for="passno">PASSPORT NO.:</label>
                                <?= $fetch_preference["passport_number"]; ?>
                            </td>
                            <td colspan="2">
                                <label for="expiry">EXPIRY DATE:</label>
                                <?php echo formatDate($fetch_preference["passport_expiry_date"]); ?>
                            </td>
                        </tr>
                        
                    </table>
              
                <table>
                    <tr>
                        <td colspan="5">
                            <h3>III. LANGUAGE</h3>
                        </td>
                    </tr>
                    <tr class="formlabel">
                        <td>
                            <label for="language">LANGUAGE</label>
                        </td>
                        <td>
                            <label for="read">READ</label>
                        </td>
                        <td>
                            <label for="write">WRITE</label>
                        </td>
                        <td>
                            <label for="speak">SPEAK</label>
                        </td>
                        <td>
                            <label for="understand">UNDERSTAND</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="english">ENGLISH</label>
                        </td>
                        <td class="formlabel">
                            <input type="checkbox" <?= $fetch_language["english_read"] == 1 ? 'checked' : '' ?> value="1" disabled>
                        </td>
                        <td class="formlabel">
                            <input type="checkbox" <?= $fetch_language["english_write"] == 1 ? 'checked' : '' ?> value="1" disabled>
                        </td>
                        <td class="formlabel"> 
                            <input type="checkbox" <?= $fetch_language["english_speak"] == 1 ? 'checked' : '' ?> value="1" disabled>
                        </td>
                        <td class="formlabel">
                            <input type="checkbox" <?= $fetch_language["english_understand"] == 1 ? 'checked' : '' ?> value="1" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="filipino">FILIPINO</label>
                        </td>
                        <td class="formlabel">
                            <input type="checkbox" <?= $fetch_language["filipino_read"] == 1 ? 'checked' : '' ?> value="1" disabled>
                        </td>
                        <td class="formlabel">
                            <input type="checkbox" <?= $fetch_language["filipino_write"] == 1 ? 'checked' : '' ?> value="1" disabled>
                        </td>
                        <td class="formlabel">
                            <input type="checkbox" <?= $fetch_language["filipino_speak"] == 1 ? 'checked' : '' ?> value="1" disabled>
                        </td>
                        <td class="formlabel">
                            <input type="checkbox" <?= $fetch_language["filipino_understand"] == 1 ? 'checked' : '' ?> value="1" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="others1">OTHERS:</label>
                            <?= $fetch_language["other_language"]; ?>
                        </td>
                        <td class="formlabel">
                            <input type="checkbox" <?= $fetch_language["other_read"] == 1 ? 'checked' : '' ?> value="1" disabled>
                        </td>
                        <td class="formlabel">
                            <input type="checkbox" <?= $fetch_language["other_write"] == 1 ? 'checked' : '' ?> value="1" disabled>
                        </td>
                        <td class="formlabel">
                            <input type="checkbox" <?= $fetch_language["other_speak"] == 1 ? 'checked' : '' ?> value="1" disabled>
                        </td>
                        <td class="formlabel">
                            <input type="checkbox" <?= $fetch_language["other_understand"] == 1 ? 'checked' : '' ?> value="1" disabled>
                        </td>
                    </tr>
                   
                    </table>
                
                    <table>
                        <tr>
                            <td colspan="7">
                                <h3>IV. EDUCATIONAL BACKGROUND</h3>
                            </td>
                        </tr>
                        <tr class="formlabel">
                            <td  rowspan="2">
                                
                            </td>
                            <td rowspan="2">
                                <label for="school">SCHOOL</label>
                            </td>
                            <td rowspan="2">
                                <label for="course">COURSE</label>
                            </td>
                            <td rowspan="2">
                                <label for="yeargrad">YEAR GRADUATED</label>
                            </td>
                            <td colspan="2">
                                <label for="undergrad">IF UNDERGRADUATE</label>
                            </td>
                            <td rowspan="2">
                                <label for="awards">AWARDS RECEIVED</label>
                            </td>
                        </tr>
                        <tr class="formlabel">
                            <td>
                                <label for="level">WHAT LEVEL</label>
                            </td>
                            <td>
                                <label for="yearattended">YEAR LAST ATTENDED</label>
                            </td>
                          
                        </tr>
                        <tr>
                            <td>
                                <label for="elem">ELEMENTARY</label>
                            </td>
                            <td>
                                <?= $fetch_education["elementary_school"]; ?>
                            </td>
                            <td>
                                <?= $fetch_education["elementary_course"]; ?>
                            </td>
                            <td> 
                                <?= $fetch_education["elementary_year_graduated"]; ?>
                            </td>
                            <td>
                                <?= $fetch_education["elementary_level"]; ?>
                            </td>
                            <td>
                                <?= $fetch_education["elementary_year_last_attended"]; ?>
                            </td>
                            <td> 
                                <?= $fetch_education["elementary_awards"]; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="secondary">SECONDARY</label>
                            </td>
                            <td>
                                <?= $fetch_education["secondary_school"]; ?>
                            </td>
                            <td>
                                <?= $fetch_education["secondary_course"]; ?>
                            </td>
                            <td> 
                                <?= $fetch_education["secondary_year_graduated"]; ?>
                            </td>
                            <td>
                                <?= $fetch_education["secondary_level"]; ?>
                            </td>
                            <td>
                                <?= $fetch_education["secondary_year_last_attended"]; ?>
                            <td> 
                                <?= $fetch_education["secondary_awards"]; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="tertiary">TERTIARY</label>
                            </td>
                            <td>
                                <?= $fetch_education["tertiary_school"]; ?>
                            </td>
                            <td>
                                <?= $fetch_education["tertiary_course"]; ?>
                            </td>
                            <td> 
                               <?= $fetch_education["tertiary_year_graduated"]; ?>
                            </td>
                            <td>
                                <?= $fetch_education["tertiary_level"]; ?>
                            </td>
                            <td>
                                <?= $fetch_education["tertiary_year_last_attended"]; ?>
                            </td>
                            <td> 
                                <?= $fetch_education["tertiary_awards"]; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="gradstud">GRADUATE STUDIES</label>
                            </td>
                            <td>
                                <?= $fetch_education["graduate_school"]; ?>
                            </td>
                            <td>
                                <?= $fetch_education["graduate_course"]; ?>
                            </td>
                            <td> 
                                <?= $fetch_education["graduate_year_graduated"]; ?>
                            </td>
                            <td>
                                <?= $fetch_education["graduate_level"]; ?>
                            </td>
                            <td>
                                <?= $fetch_education["graduate_year_last_attended"]; ?>
                            </td>
                            <td> 
                                <?= $fetch_education["graduate_awards"]; ?>
                            </td>
                        </tr>
                    </table>
             
                    <table class="editable-table">
                        <tr>
                            <td colspan="5">
                                <h3>V. TECHNICAL/VOCATIONAL AND OTHER TRAINING</h3><p>(Include courses as part of college education)</p>
                            </td>
                        </tr>
                        <tr class="formlabel">
                            <td colspan="2">
                                <label for="tvcourse">TRAINING/VOCATIONAL COURSE</label>
                            </td>
                            <td>
                                <label for="duration">DURATION<br>(mm/dd/yyyy to mm/dd/yyyy)</label> 
                            </td>
                            <td>
                                <label for="traininst">TRAINING INSTITUTION</label>
                            </td>
                            <td>
                                <label for="cert">CERTIFICATES RECEIVED<br>(NC I, NC II, NC III, NC IV, etc)</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="tvcourse1">1.</label>
                            </td>
                            <td>
                                <span><?= $fetch_training["course_name_1"]; ?></span>
                            </td>
                            <td id="format2">
                                <span class="editable-date"><?php echo formatDate($fetch_training["course_duration_start_1"]); ?></span>
                                <span class="editable-date"><?php echo formatDate($fetch_training["course_duration_end_1"]); ?></span>
                            </td>
                            <td> 
                                <span><?= $fetch_training["training_institution_1"]; ?></span>
                            </td>
                            <td>
                                <span><?= $fetch_training["certificates_received_1"]; ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="tvcourse2">2.</label>
                            </td>
                            <td>
                                <span><?= $fetch_training["course_name_2"]; ?></span>
                            </td>
                            <td id="format2">
                                <span class="editable-date"><?php echo formatDate($fetch_training["course_duration_start_2"]); ?></span>
                                <span class="editable-date"><?php echo formatDate($fetch_training["course_duration_end_2"]); ?></span>
                            </td>
                            <td> 
                                <span><?= $fetch_training["training_institution_2"]; ?></span>
                            </td>
                            <td>
                                <span><?= $fetch_training["certificates_received_2"]; ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="tvcourse3">3.</label>
                            </td>
                            <td>
                                <span><?= $fetch_training["course_name_3"]; ?></span>
                            </td>
                            <td id="format2">
                                <span class="editable-date"><?php echo formatDate($fetch_training["course_duration_start_3"]); ?></span>
                                <span class="editable-date"><?php echo formatDate($fetch_training["course_duration_end_3"]); ?></span>
                            </td>
                            <td> 
                                <span><?= $fetch_training["training_institution_3"]; ?></span>
                            </td>
                            <td>
                                <span><?= $fetch_training["certificates_received_3"]; ?></span>
                            </td>
                        </tr>
                    </table>
               
                    <table class="editable-table">
                        <tr>
                            <td colspan="7">
                                <h3>VI. ELIGIBILITY/PROFESSIONAL LICENSE</h3>
                            </td>
                        </tr>
                        <tr class="formlabel">
                            <td colspan="2">
                            <label for="eligibility">ELIGIBILITY<br>(Civil Service)</label>
                            </td>
                            <td>
                                <label for="rating">RATING</label>
                            </td>
                            <td>
                                <label for="examdate">DATE OF EXAMINATION</label>
                            </td>
                            <td>
                                
                            </td>
                            <td>
                                <label for="proflic">PROFESSIONAL LICENSE</label>
                            </td>
                            <td>
                                <label for="valid">VALID UNTIL</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="eligibility1">1.</label>
                            </td>
                            <td>
                                <span><?= $fetch_eligibility["eligibility1"]; ?></span>
                            </td>
                            <td>
                                <span><?= $fetch_eligibility["rating1"]; ?></span>
                            </td>
                            <td> 
                                <span class="editable-date"><?php echo formatDate($fetch_eligibility["examdate1"]); ?></span>
                            </td>
                            <td>
                                <label for="profli1">1.</label>
                            </td>
                            <td> 
                                <span><?= $fetch_eligibility["professional_license1"]; ?></span>
                            </td>
                            <td>
                                <span class="editable-date"><?php echo formatDate($fetch_eligibility["valid1"]); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="eligibility2">2.</label>
                            </td>
                            <td>
                                <span><?= $fetch_eligibility["eligibility2"]; ?></span>
                            </td>
                            <td>
                                <span><?= $fetch_eligibility["rating2"]; ?></span>
                            </td>
                            <td> 
                                <span class="editable-date"><?php echo formatDate($fetch_eligibility["examdate2"]); ?></span>
                            </td>
                            <td>
                                <label for="profli2">1.</label>
                            </td>
                            <td> 
                                <span><?= $fetch_eligibility["professional_license2"]; ?></span>
                            </td>
                            <td>
                                <span class="editable-date"><?php echo formatDate($fetch_eligibility["valid2"]); ?></span>
                            </td>
                        </tr>
                    </table>
              
                    <table class="editable-table">
                        <tr>
                            <td colspan="5">
                                <h3>VII. WORK EXPERIENCE</h3><p>(Limit to 10 year period, start with the most recent employment)</p>
                            </td>
                        </tr>
                        <tr class="formlabel">
                            <td>
                            <label for="comname">COMPANY NAME</label>
                            </td>
                            <td>
                                <label for="comadd">ADDRESS<br>(City/Municipality)</label>
                            </td>
                            <td>
                                <label for="position">POSITION</label>
                            </td>
                            <td>
                                <label for="indates">INCLUSIVE DATES<br>(mm/yyyy to mm/yyyy)</label>
                            </td>
                            <td>
                                <label for="workstat">STATUS</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span><?= $fetch_work["company_name1"]; ?></span>
                            </td>
                            <td>
                                <span><?= $fetch_work["company_address1"]; ?></span>
                            </td>
                            <td> 
                                <span><?= $fetch_work["position1"]; ?></span>
                            </td>
                            <td id="format2">
                                <span class="editable-date"><?php echo formatDate($fetch_work["inclusive_dates_start1"]); ?></span>
                                <span class="editable-date"><?php echo formatDate($fetch_work["inclusive_dates_end1"]); ?></span>
                            </td>
                            <td> 
                                <span class="editable-select" data-field="status"><?= $fetch_work["status1"]; ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span><?= $fetch_work["company_name2"]; ?></span>
                            </td>
                            <td>
                                <span><?= $fetch_work["company_address2"]; ?></span>
                            </td>
                            <td> 
                                <span><?= $fetch_work["position2"]; ?></span>
                            </td>
                            <td id="format2">
                                <span class="editable-date"><?php echo formatDate($fetch_work["inclusive_dates_start2"]); ?></span>
                                <span class="editable-date"><?php echo formatDate($fetch_work["inclusive_dates_end2"]); ?></span>
                            </td>
                            <td> 
                                <span class="editable-select" data-field="status"><?= $fetch_work["status2"]; ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span><?= $fetch_work["company_name3"]; ?></span>
                            </td>
                            <td>
                                <span><?= $fetch_work["company_address3"]; ?></span>
                            </td>
                            <td> 
                                <span><?= $fetch_work["position3"]; ?></span>
                            </td>
                            <td id="format2">
                                <span class="editable-date"><?php echo formatDate($fetch_work["inclusive_dates_start3"]); ?></span>
                                <span class="editable-date"><?php echo formatDate($fetch_work["inclusive_dates_end3"]); ?></span>
                            </td>
                            <td> 
                                <span class="editable-select" data-field="status"><?= $fetch_work["status3"]; ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span><?= $fetch_work["company_name4"]; ?></span>
                            </td>
                            <td>
                                <span><?= $fetch_work["company_address4"]; ?></span>
                            </td>
                            <td> 
                                <span><?= $fetch_work["position4"]; ?></span>
                            </td>
                            <td id="format2">
                                <span class="editable-date"><?php echo formatDate($fetch_work["inclusive_dates_start4"]); ?></span>
                                <span class="editable-date"><?php echo formatDate($fetch_work["inclusive_dates_end4"]); ?></span>
                            </td>
                            <td> 
                                <span class="editable-select" data-field="status"><?= $fetch_work["status4"]; ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span><?= $fetch_work["company_name5"]; ?></span>
                            </td>
                            <td>
                                <span><?= $fetch_work["company_address5"]; ?></span>
                            </td>
                            <td> 
                                <span><?= $fetch_work["position5"]; ?></span>
                            </td>
                            <td id="format2">
                                <span class="editable-date"><?php echo formatDate($fetch_work["inclusive_dates_start5"]); ?></span>
                                <span class="editable-date"><?php echo formatDate($fetch_work["inclusive_dates_end5"]); ?></span>
                            </td>
                            <td> 
                                <span class="editable-select" data-field="status"><?= $fetch_work["status5"]; ?></span>
                            </td>
                        </tr>
                    </table>

                    <table>
                        <tr>
                            <td colspan="7">
                                <h3>VIII. OTHER SKILLS ACQUIRED WITHOUT FORMAL TRAINING</h3>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <label for="addedSkills">SKILLS:</label>
                                    <?php
                                    foreach ($skills as $skill) {
                                        echo "<li>$skill</li>";
                                    }
                                    ?>
                            </td>
                        </tr>
                    </table>

                <div class="butcon">
                    <input type="button" id="editButton" value="UPDATE">
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
        }

       // Assuming you have a variable to store the edit mode status
        var isEditMode = false;

        // Variable to store the edit button
        var editButton = document.getElementById('editButton');

        // Function to scroll to the top of the form
        function scrollToTop() {
            // Assuming your form container has an ID, replace 'formContainerId' with the actual ID
            const formContainer = document.getElementById('nsrp');

            // Scroll to the top of the form container
            formContainer.scrollTop = 0;
        }

        // Add an event listener to the edit button
        editButton.addEventListener('click', function() {
            // Toggle edit mode
            isEditMode = !isEditMode;

            // Close Side Panel
            hideSidebar();

            // Make all form fields editable
            makeFieldsEditable();

            // Scroll to the top of the form
            scrollToTop();

            // Replace the Edit button with the Update button
            replaceEditButton();
        });

        // Function to replace the Edit button with the Update button
        function replaceEditButton() {
            // Create the Update button
            var updateButton = document.createElement('input');
            updateButton.type = 'button';
            updateButton.id = 'updateButton';
            updateButton.value = 'SAVE';
            updateButton.addEventListener('click', function() {
                // Call the updateForm function when the Update button is clicked
                updateForm();
            });

            // Replace the Edit button with the Update button
            editButton.parentNode.replaceChild(updateButton, editButton);
        }

        // Function to handle the update logic
        function updateForm() {
            // Collect updated data from the form fields
            var updatedData = collectUpdatedData();

            // Perform the update logic (e.g., send the updated data to the server)

            // Optionally, you can toggle off the edit mode after updating
            isEditMode = false;
            makeFieldsEditable();

            // Scroll to the top after updating
            scrollToTop();

            // Now, replace the Update button with the Edit button
            replaceUpdateButton();
        }

        // Function to replace the Update button with the Edit button
        function replaceUpdateButton() {
            var updateButton = document.getElementById('updateButton');

            // Get all elements (both spans and inputs) within the form container
            var formElements = document.querySelectorAll('.form-container span, .form-container input.editable-input, .form-container select.editable-input');

            formElements.forEach(function (element) {
                if (element.tagName.toLowerCase() === 'input' && element.classList.contains('editable-input')) {
                    // Replace the input element with a span
                    var spanElement = document.createElement('span');
                    spanElement.textContent = element.value;

                    // Replace the input element with the span element
                    element.parentNode.replaceChild(spanElement, element);
                } else if (element.tagName.toLowerCase() === 'select' && element.classList.contains('editable-input')) {
                    // Replace the select element with a span
                    var spanElementSelect = document.createElement('span');
                    spanElementSelect.textContent = element.options[element.selectedIndex].text;

                    // Replace the select element with the span element
                    element.parentNode.replaceChild(spanElementSelect, element);
                }
            });

            // Now, replace the Update button with the Edit button
            updateButton.parentNode.replaceChild(editButton, updateButton);
        }

        // Function to collect updated data from the form fields
        function collectUpdatedData() {
            // Initialize an object to store updated data
            var updatedData = {};

            // Get all input elements within the form container
            var inputElements = document.querySelectorAll('.form-container input.editable-input, .form-container select.editable-input');

            inputElements.forEach(function (inputElement) {
                // Extract the field name from the input element's ID or other attribute
                var fieldName = inputElement.id; // Replace with the actual attribute used to identify the field

                // Store the updated value in the object using the field name as the key
                updatedData[fieldName] = inputElement.tagName.toLowerCase() === 'select' ? inputElement.options[inputElement.selectedIndex].text : inputElement.value;
            });

            return updatedData;
        }

        // Function to make fields editable or non-editable based on the current edit mode
        function makeFieldsEditable() {
            // Get all elements (both spans and inputs) within the form container
            var formElements = document.querySelectorAll('.form-container span, .form-container input.editable-input');

            formElements.forEach(function (element) {
                if (element.tagName.toLowerCase() === 'span') {
                    // Check if the span is inside the editable table
                    var isEditableTable = element.closest('.editable-table');

                    // Check if the span is empty
                    var isEmptySpan = element.textContent.trim() === '';

                    // Only make the span editable if it's empty or it's outside the editable table
                    if (isEmptySpan || !isEditableTable) {
                        // Create an input element based on the type of data
                        var inputElement;

                        if (element.classList.contains('editable-date')) {
                            // If it's a date field, create a date input
                            inputElement = document.createElement('input');
                            inputElement.type = 'date';

                            // Assuming the span contains a valid date in 'MM/DD/YYYY' format
                            const dateParts = element.textContent.split('/');
                            
                            // Check if the dateParts array has three elements (month, day, and year)
                            if (dateParts.length === 3) {
                                const yyyyMMddDate = `${dateParts[2]}-${dateParts[0].padStart(2, '0')}-${dateParts[1].padStart(2, '0')}`;
                                inputElement.value = yyyyMMddDate;
                            }

                        } else if (element.classList.contains('editable-select')) {
                            // If it's a select field, create a select input
                            inputElement = document.createElement('select');
                            inputElement.className = 'editable-input';


                                // Add options based on the field 
                                if (element.dataset.field === 'civil_status') {
                                    addOptions(inputElement, ['Single', 'Married', 'Widowed','Separated', 'Live-In']); // Civil status options
                                } else if (element.dataset.field === 'religion') {
                                    addOptions(inputElement, ['Roman Catholic', 'Born Again Christian', 'Iglesia Ni Cristo', 'Jehova\'s Witness', 'Islam', 'Latter-Day Saints', 'Protestant', 'Seventh-Day Adentist', 'Evangelical', 'Baptist', 'Buddhist', 'Hindu', 'Other']); // Religion options
                                } else if (element.dataset.field === 'barangay') {
                                    addOptions(inputElement, [
                                        'Assumption', 'Bagong Buhay I', 'Bagong Buhay II', 'Bagong Buhay III', 'Citrus', 'Ciudad Real',
                                        'Dulong Bayan', 'Fatima', 'Fatima II', 'Fatima III', 'Fatima IV', 'Fatima V',
                                        'Francisco Homes - Guijo', 'Francisco Homes - Mulawin', 'Francisco Homes - Narra', 'Francisco Homes - Yakal',
                                        'Gaya-Gaya', 'Graceville', 'Gumaoc Central', 'Gumaoc East', 'Gumaoc West', 'Kaybanban',
                                        'Kaypian', 'Lawang Pari', 'Maharlika', 'Minuyan', 'Minuyan II', 'Minuyan III', 'Minuyan IV',
                                        'Minuyan Proper', 'Minuyan V', 'Muzon', 'Paradise III', 'Poblacion', 'Poblacion I',
                                        'Saint Martin de Porres', 'San Isidro', 'San Manuel', 'San Martin I', 'San Martin II',
                                        'San Martin III', 'San Martin IV', 'San Pedro', 'San Rafael I', 'San Rafael II', 'San Rafael III',
                                        'San Rafael IV', 'San Rafael V', 'San Roque', 'Santa Cruz I', 'Santa Cruz II', 'Santa Cruz III',
                                        'Santa Cruz IV', 'Santa Cruz V', 'Santo Cristo', 'Santo Niño I', 'Santo Niño II', 'Sapang Palay',
                                        'Tungkong Mangga'
                                    ]);
                                } else if (element.dataset.field === 'status') {
                                    // Include an empty string as an option and set it as the default
                                    addOptions(inputElement, ['', 'Permanent', 'Contractual', 'Part-Time', 'Probationary']);
                                    inputElement.value = ''; // Set the default value to an empty string
                                }

                                // Set the selected option based on the span's text content
                                inputElement.value = element.textContent;
    
                        } else {
                            // For other fields, create a text input
                            inputElement = document.createElement('input');
                            inputElement.type = 'text';
                            inputElement.value = element.textContent;
                        }

                        // Set common attributes
                        inputElement.className = 'editable-input';
                        inputElement.readOnly = !isEditMode;
                        inputElement.style.border = isEditMode ? '1px solid #000' : 'none';

                        // Replace the span with the input element
                        element.parentNode.replaceChild(inputElement, element);
                    } else if (element.tagName.toLowerCase() === 'input' && element.classList.contains('editable-input')) {
                        // Replace the input element with a span
                        var spanElement = document.createElement('span');
                        spanElement.textContent = element.tagName.toLowerCase() === 'select' ? element.options[element.selectedIndex].text : element.value;

                        // Replace the input element with the span element
                        element.parentNode.replaceChild(spanElement, element);
                    }
                }
            });
        }

        // Function to add options to a select element
        function addOptions(selectElement, options) {
            options.forEach(function (optionText) {
                var option = document.createElement('option');
                option.value = optionText;
                option.text = optionText;
                selectElement.add(option);
            });
        }




    </script>

</body>
</html>
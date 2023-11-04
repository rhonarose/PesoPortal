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

            <div class="form-container" id="nsrp">
                <!-- Eligibility Form -->
                <h2>NSRP FORM</h2>
                <div id="personalInfoForm">
                <!-- Personal Information Form -->
                    <table>
                        <tr>
                            <td>
                                <p>NSRP FORM</p>
                                <p>January 2017</p>
                            </td>
                            <td colspan="3">
                                <p>Republic of the Philippines</p>
                                <p>Department of labor and Employment</p>
                                <p>PESO EMPLOYMENT INFORMATION SYSTEM</p>
                                <p>REGISTRATION FORM</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <p>INSTRUCTION: Please fill out the form legibly. Print in block letters. Check appropriate boxes. Please do not leave any items unanswered. Indicate "N/A"
                                    if not applicable. Submit accomplished form after filling up.
                                </p>
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
                                <input type="text" id="sname" name="sname" value="<?= $fetch_personal_info["surname"]; ?>">
                            </td>
                            <td>
                                <label for="fname">FIRST NAME:</label>
                                <input type="text" id="fname" name="fname" value="<?= $fetch_personal_info["first_name"]; ?>">
                            </td>
                            <td>
                                <label for="mname">MIDDLE NAME:</label>
                                <input type="text" id="mname" name="mname" value="<?= $fetch_personal_info["middle_name"]; ?>">
                            </td>
                            <td>
                                <label for="suffix">SUFFIX:</label>
                                <input type="text" id="suffix" name="suffix" value="<?= $fetch_personal_info["suffix"]; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="bdate">BIRTHDATE:</label>
                                <input type="text" id="bdate" name="bdate" value="<?= $fetch_personal_info["birthdate"]; ?>">
                            </td>
                            <td colspan="2">
                                <label for="bplace">BIRTHPLACE:</label>
                                <input type="text" id="bplace" name="bplace"value="<?= $fetch_personal_info["birthplace"]; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="sex">SEX:</label>
                                <input type="text" id="sex" name="sex" value="<?= $fetch_personal_info["sex"]; ?>">
                        </td>
                            <td colspan="2">
                                <label for="religion">RELIGION:</label>
                                <input type="text" id="religion" name="religion" value="<?= $fetch_personal_info["religion"]; ?>">
  
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="civilstat">CIVIL STATUS:</label>
                                <input type="text" id="civilstat" name="civilstat" value="<?= $fetch_personal_info["civil_status"]; ?>">
                            </td>
                            <td colspan="2">
                                <p>PRESENT ADDRESS:</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="height">HEIGHT:</label>
                                <input type="text" id="height" name="height" value="<?= $fetch_personal_info["height"]; ?>">
                            </td>
                            <td>
                                <label for="email">EMAIL ADDRESS:</label>
                                <input type="email" id="email" name="email" value="<?= $fetch_personal_info["email"]; ?>" readonly>
                            </td>
                            <td>
                                <label for="houseno">HOUSE NO/STREET VILLAGE:</label>
                                <input type="text" id="houseno" name="houseno" value="<?= $fetch_personal_info["house_no_street_village"]; ?>">
                            </td>
                            <td>
                                <label for="brgy">BARANGAY:</label>
                                <input type="text" id="brgy" name="brgy" value="<?= $fetch_personal_info["barangay"]; ?>">   
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="landline">LANDLINE NUMBER:</label>
                                <input type="text" id="landline" name="landline" value="<?= $fetch_personal_info["landline_number"]; ?>">
                            </td>
                            <td>
                                <label for="cpno">CELLPHONE NUMBER:</label>
                                <input type="text" id="cpno" name="cpno" value="<?= $fetch_personal_info["cellphone_number"]; ?>">
                            </td>
                            <td>
                                <label for="city">MUNICIPALITY/CITY:</label>
                                <input type="text" id="city" name="city" value="<?= $fetch_personal_info["municipality_city"]; ?>">
                            </td>
                            <td>
                                <label for="province">PROVINCE:</label>
                                <input type="text" id="province" name="province" value="<?= $fetch_personal_info["province"]; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="tin">TIN:</label>
                                <input type="text" id="tin" name="tin" value="<?= $fetch_personal_info["tin"]; ?>">
                            </td>
                            <td>
                                <label for="gsis/sss">GSIS/SSS ID NO.:</label>
                                <input type="text" id="gsis/sss" name="gsis/sss" value="<?= $fetch_personal_info["gsis_sss_id"]; ?>">
                            </td>
                            <td>
                                <label for="pagibig">PAG-IBIG NO.:</label>
                                <input type="text" id="pagibig" name="pagibig" value="<?= $fetch_personal_info["pagibig_no"]; ?>">
                            </td>
                            <td>
                                <label for="philhealth">PHILHEALTH NO.:</label>
                                <input type="text" id="philhealth" name="philhealth" value="<?= $fetch_personal_info["philhealth_no"]; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <label for="disability">DISABILITY:</label>
                                <input type="text" id="disability" name="disability" value="<?= $fetch_personal_info["disability"]; ?>">
                            </td>
                        </tr>
                        <tr >
                            <td rowspan="3">
                                <label for="empstat">EMPLOYMENT<br>STATUS / TYPE:</label>
                            </td>
                            <td colspan="3">
                                <input type="radio" id="employed" name="empstat" value="Employed" onclick="showEmployOpt()"> 
                                <label for="employed">Employed</label>
                                <input type="radio" id="unemployed" name="empstat" value="Unemployed" onclick="showEmployOpt()"> 
                                <label for="unemployed">Unemployed</label>
                            </td>
                        </tr>
                        <tr id="employedOpt" style="display: none;">
                            <td colspan="3">
                                <!-- Additional options for Employed -->
                                <input type="radio" id="wageemp" name="employed" value="Wage Employed"> 
                                <label for="wageemp">Wage Employed</label><br>
                                <input type="radio" id="selfemp" name="employed" value="Self Employed"> 
                                <label for="selfemp">Self Employed</label>
                            </td>
                        </tr>
                        <tr id="unemployedOpt" style="display: none;">
                            <td colspan="3">
                                <!-- Additional options for Unemployed -->
                                <input type="radio" id="new" name="unemployed" value="New Entrant/Fresh Gradate"> 
                                <label for="new">New Entrant/Fresh Gradate</label><br>
                                <input type="radio" id="finished" name="unemployed" value="Finished Contract"> 
                                <label for="finished">Finished Contract</label><br>
                                <input type="radio" id="resigned" name="unemployed" value="Resigned"> 
                                <label for="resigned">Resigned</label><br>
                                <input type="radio" id="retired" name="unemployed" value="Retired"> 
                                <label for="retired">Retired</label><br>
                                <input type="radio" id="termloc" name="unemployed" value="Terminated/Laid Off (Local)"> 
                                <label for="termloc">Terminated/Laid Off (Local)</label><br>
                                <input type="radio" id="termab" name="unemployed" value="Terminated/Laid Off (Abroad)">
                                <label for="termab">Terminated/Laid Off (Abroad),</label>
                                <label for="country">specify country</label>
                                <input type="text" id="country" name="country"><br>
                                <input type="radio" id="others" name="unemployed" value="Others"> 
                                <label for="others4">Others, specify</label>
                                <input type="text" id="others4" name="others4"><br>
                            </td>
                        </tr>
                        <tr> </tr>
                        <tr> </tr>
                        <tr>
                            <td colspan="2">
                                <label for="active">Are you actively looking for work?</label>
                                <input type="text" id="active" name="active" value="<?= $fetch_personal_info["actively_looking_for_work"]; ?>">
        
                                <label for="immediately">Willing to work immediately?</label>
                                <input type="text" id="immediately" name="immediately" value="<?= $fetch_personal_info["willing_to_work_immediately"]; ?>">
                              
                            </td>
                            <td colspan="2">
                                <label for="looking">How long have you been looking for work?</label>
                                <input type="text" id="looking" name="looking" value="<?= $fetch_personal_info["how_long_looking_for_work"]; ?>"><br>
                                <label for="when">If no, when?</label>
                                <input type="text" id="when" name="when" value="<?= $fetch_personal_info["if_no_when"]; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="4ps">Are you a 4Ps beneficiary?</label>
                                <input type="text" id="4ps" name="4ps" value="<?= $fetch_personal_info["is_4ps_beneficiary"]; ?>">
                                
                            </td>
                            <td colspan="2">
                                <label for="id4ps">If yes, Household ID No.?</label>
                                <input type="text" id="id4ps" name="id4ps" value="<?= $fetch_personal_info["household_id_4ps"]; ?>">
                            </td>
                        </tr>
                       
                    </table>

               
                    <table>
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
                                <input type="text" id="prefoccu1" name="prefoccu1" value="<?= $fetch_preference["preferred_occupation1"]; ?>">
                            </td>
                            <td colspan="2">
                                <input type="checkbox" id="prefloclocal" name="prefloclocal" value="Local" required>   
                                <label for="prefloclocal">LOCAL, specify cities/municipalities:</label>
                            </td>
                            <td colspan="2"> 
                                <input type="checkbox" id="preflocover" name="preflocover" value="Overseas" required>   
                                <label for="preflocover">OVERSEAS, specify countries:</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="prefoccu2">2.</label>
                            </td>
                            <td>
                                <input type="text" id="prefoccu2" name="prefoccu2" value="<?= $fetch_preference["preferred_occupation2"]; ?>">
                            </td>
                            <td>
                                <label for="prefloclocal1">1.</label>
                            </td>
                            <td>
                                <input type="text" id="prefloclocal1" name="prefloclocal1" value="<?= $fetch_preference["local_location1"]; ?>">
                            </td>
                            <td>
                                <label for="preflocover1">1.</label>
                            </td>
                            <td>
                                <input type="text" id="preflocover1" name="preflocover1" value="<?= $fetch_preference["overseas_location1"]; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="prefoccu3">3.</label>
                            </td>
                            <td>
                                <input type="text" id="prefoccu3" name="prefoccu3" value="<?= $fetch_preference["preferred_occupation3"]; ?>">
                            </td>
                            <td>
                                <label for="prefloclocal2">2.</label>
                            </td>
                            <td>
                                <input type="text" id="prefloclocal2" name="prefloclocal2" value="<?= $fetch_preference["local_location2"]; ?>">
                            </td>
                            <td>
                                <label for="preflocover2">2.</label>
                            </td>
                            <td>
                                <input type="text" id="preflocover2" name="preflocover2" value="<?= $fetch_preference["overseas_location2"]; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="prefoccu4">4.</label>
                            </td>
                            <td>
                                <input type="text" id="prefoccu4" name="prefoccu4" value="<?= $fetch_preference["preferred_occupation4"]; ?>">
                            </td>
                            <td>
                                <label for="prefloclocal3">3.</label>
                            </td>
                            <td>
                                <input type="text" id="prefloclocal3" name="prefloclocal3" value="<?= $fetch_preference["local_location3"]; ?>">
                            </td>
                            <td>
                                <label for="preflocover3">3.</label>
                            </td>
                            <td>
                                <input type="text" id="preflocover3" name="preflocover3" value="<?= $fetch_preference["overseas_location3"]; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="exsalary">EXPECTED SALARY (Range):</label>
                                <input type="text" id="exsalary" name="exsalary" value="<?= $fetch_preference["expected_salary"]; ?>">
                            </td>
                            <td colspan="2">
                                <label for="passno">PASSPORT NO.:</label>
                                <input type="text" id="passno" name="passno" value="<?= $fetch_preference["passport_number"]; ?>">
                            </td>
                            <td colspan="2">
                                <label for="expiry">EXPIRY DATE:</label>
                                <input type="date" id="expiry" name="expiry" value="<?= $fetch_preference["passport_expiry_date"]; ?>">
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
                            <input type="checkbox" id="engread" name="engread">
                        </td>
                        <td class="formlabel">
                            <input type="checkbox" id="engwrite" name="engwrite">
                        </td>
                        <td class="formlabel">
                            <input type="checkbox" id="engspeak" name="engspeak">
                        </td>
                        <td class="formlabel">
                            <input type="checkbox" id="engunderstand" name="engunderstand">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="filipino">FILIPINO</label>
                        </td>
                        <td class="formlabel">
                            <input type="checkbox" id="filread" name="filread">
                        </td>
                        <td class="formlabel">
                            <input type="checkbox" id="filwrite" name="filwrite">
                        </td>
                        <td class="formlabel">
                            <input type="checkbox" id="filspeak" name="filspeak">
                        </td>
                        <td class="formlabel">
                            <input type="checkbox" id="filunderstand" name="filunderstand">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="others1">OTHERS:</label>
                            <input type="text" id="others1" name="others1">
                        </td>
                        <td class="formlabel">
                            <input type="checkbox" id="otherread" name="otherread">
                        </td>
                        <td class="formlabel">
                            <input type="checkbox" id="otherwrite" name="otherwrite">
                        </td>
                        <td class="formlabel">
                            <input type="checkbox" id="otherspeak" name="otherspeak">
                        </td>
                        <td class="formlabel">
                            <input type="checkbox" id="otherunderstand" name="otherunderstand">
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
                                <input type="text" id="elemschool" name="elemschool" value="<?= $fetch_education["elementary_school"]; ?>">
                            </td>
                            <td>
                                <input type="text" id="elemcourse" name="elemcourse" placeholder="COURSE">
                            </td>
                            <td> 
                                <select id="elemyeargrad" name="elemyeargrad"></select>
                            </td>
                            <td>
                                <select id="elemlevel" name="elemlevel">
                                    
                                    <!-- Add more options for other elementary levels -->
                                </select>
                            </td>
                            <td>
                                <select id="elemyearattended" name="elemyearattended"></select>
                            </td>
                            <td> 
                                <input type="text" id="elemawards" name="elemawards" placeholder="AWARDS RECEIVED">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="secondary">SECONDARY</label>
                            </td>
                            <td>
                                <input type="text" id="secschool" name="secschool" placeholder="SCHOOL">
                            </td>
                            <td>
                                <input type="text" id="seccourse" name="seccourse" placeholder="COURSE">
                            </td>
                            <td> 
                            <select id="secyeargrad" name="secyeargrad"></select>
                            </td>
                            <td>
                                <select id="seclevel" name="seclevel">
                                  
                                    <!-- Add more options for other secondary levels -->
                                </select>
                            </td>
                            <td>
                                <select id="secyearattended" name="secyearattended"></select>
                            </td>
                            <td> 
                                <input type="text" id="secawards" name="secawards" placeholder="AWARDS RECEIVED">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="tertiary">TERTIARY</label>
                            </td>
                            <td>
                                <input type="text" id="terschool" name="terschool" placeholder="SCHOOL">
                            </td>
                            <td>
                                <select id="tercourse" name="tercourse">
                                    
                                </select>
                            </td>
                            <td> 
                            <select id="teryeargrad" name="teryeargrad"></select>
                            </td>
                            <td>
                                <select id="terlevel" name="terlevel">
                                   
                                    <!-- Add more options for other tertiary levels -->
                                </select>
                            </td>
                            <td>
                                <select id="teryearattended" name="teryearattended"></select>
                            </td>
                            <td> 
                                <input type="text" id="terawards" name="terawards" placeholder="AWARDS RECEIVED">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="gradstud">GRADUATE STUDIES</label>
                            </td>
                            <td>
                                <input type="text" id="gradschool" name="gradschool" placeholder="SCHOOL">
                            </td>
                            <td>
                                <select id="gradcourse" name="gradcourse">
                                    
                                    <!-- Add more graduate study courses as needed -->
                                </select>
                            </td>
                            <td> 
                            <select id="gradyeargrad" name="gradyeargrad"></select>
                            </td>
                            <td>
                                <select id="gradlevel" name="gradlevel">
                                
                                    <!-- Add more options for other graduate studies levels -->
                                </select>
                            </td>
                            <td>
                                <select id="gradyearattended" name="gradyearattended"></select>
                            </td>
                            <td> 
                                <input type="text" id="gradawards" name="gradawards" placeholder="AWARDS RECEIVED">
                            </td>
                        </tr>
                    </table>
             
                    <table>
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
                                <label for="duration">DURATION<br>(dd/mm/yyyy to dd/mm/yyyy)</label>
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
                                <input type="text" id="tvcourse1" name="tvcourse1" placeholder="TRAINING/VOCATIONAL COURSE">
                            </td>
                            <td>
                                <input type="date" id="duration1" name="duration1" placeholder="DURATION">
                                <input type="date" id="duration.1" name="duration.1" placeholder="DURATION">
                            </td>
                            <td> 
                                <input type="text" id="traininst1" name="traininst1" placeholder="INSTITUTION">
                            </td>
                            <td>
                                <input type="text" id="cert1" name="cert1" placeholder="CERTIFICATE">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="tvcourse2">2.</label>
                            </td>
                            <td>
                                <input type="text" id="tvcourse2" name="tvcourse2" placeholder="TRAINING/VOCATIONAL COURSE">
                            </td>
                            <td>
                                <input type="date" id="duration2" name="duration2" placeholder="DURATION">
                                <input type="date" id="duration.2" name="duration.2" placeholder="DURATION">
                            </td>
                            <td> 
                                <input type="text" id="traininst2" name="traininst2" placeholder="INSTITUTION">
                            </td>
                            <td>
                                <input type="text" id="cert2" name="cert2" placeholder="CERTIFICATE">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="tvcourse3">3.</label>
                            </td>
                            <td>
                                <input type="text" id="tvcourse3" name="tvcourse3" placeholder="TRAINING/VOCATIONAL COURSE">
                            </td>
                            <td>
                                <input type="date" id="duration3" name="duration3" placeholder="DURATION">
                                <input type="date" id="duration.3" name="duration.3" placeholder="DURATION">
                            </td>
                            <td> 
                                <input type="text" id="traininst3" name="traininst3" placeholder="INSTITUTION">
                            </td>
                            <td>
                                <input type="text" id="cert3" name="cert3" placeholder="CERTIFICATE">
                            </td>
                        </tr>
                    </table>
               
                    <table>
                        <tr>
                            <td colspan="5">
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
                                <input type="text" id="eligibility1" name="eligibility1" placeholder="ELIGIBILITY">
                            </td>
                            <td>
                                <input type="text" id="rating1" name="rating1" placeholder="RATING">
                            </td>
                            <td> 
                                <input type="date" id="examdate1" name="examdate1" placeholder="DATE OF EXAM">
                            </td>
                            <td>
                                <label for="profli1">1.</label>
                            </td>
                            <td> 
                                <input type="text" id="profli1" name="profli1" placeholder="PROFESSIONAL LICENSE">
                            </td>
                            <td>
                                <input type="date" id="valid1" name="valid1" placeholder="VALID UNTIL">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="eligibility2">2.</label>
                            </td>
                            <td>
                                <input type="text" id="eligibility2" name="eligibility2" placeholder="ELIGIBILITY">
                            </td>
                            <td>
                                <input type="text" id="rating2" name="rating2" placeholder="RATING">
                            </td>
                            <td> 
                                <input type="date" id="examdate2" name="examdate2" placeholder="DATE OF EXAM">
                            </td>
                            <td>
                                <label for="profli2">1.</label>
                            </td>
                            <td> 
                                <input type="text" id="profli2" name="profli2" placeholder="PROFESSIONAL LICENSE">
                            </td>
                            <td>
                                <input type="date" id="valid2" name="valid2" placeholder="VALID UNTIL">
                            </td>
                        </tr>
                    </table>
              
                    <table>
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
                                <input type="text" id="comname1" name="comname1" placeholder="COMPANY NAME">
                            </td>
                            <td>
                                <input type="text" id="comadd1" name="comadd1" placeholder="CITY/MUNICIPALITY">
                            </td>
                            <td> 
                                <input type="text" id="position1" name="position1" placeholder="POSITION">
                            </td>
                            <td>
                                <input type="date" id="indates1" name="indates1" placeholder="INCLUSIVE DATES">
                                <input type="date" id="indates.1" name="indates.1" placeholder="INCLUSIVE DATES">
                            </td>
                            <td> 
                                <select id="workstat1" name="workstat1">
                                    
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" id="comname2" name="comname2" placeholder="COMPANY NAME">
                            </td>
                            <td>
                                <input type="text" id="comadd2" name="comadd2" placeholder="CITY/MUNICIPALITY">
                            </td>
                            <td> 
                                <input type="text" id="position2" name="position2" placeholder="POSITION">
                            </td>
                            <td>
                                <input type="date" id="indates2" name="indates2" placeholder="INCLUSIVE DATES">
                                <input type="date" id="indates.2" name="indates.2" placeholder="INCLUSIVE DATES">
                            </td>
                            <td> 
                                <select id="workstat2" name="workstat2">
                                   
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" id="comname3" name="comname3" placeholder="COMPANY NAME">
                            </td>
                            <td>
                                <input type="text" id="comadd3" name="comadd3" placeholder="CITY/MUNICIPALITY">
                            </td>
                            <td> 
                                <input type="text" id="position3" name="position3" placeholder="POSITION">
                            </td>
                            <td>
                                <input type="date" id="indates3" name="indates3" placeholder="INCLUSIVE DATES">
                                <input type="date" id="indates.3" name="indates.3" placeholder="INCLUSIVE DATES">
                            </td>
                            <td> 
                                <select id="workstat3" name="workstat3">
                                   
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" id="comname4" name="comname4" placeholder="COMPANY NAME">
                            </td>
                            <td>
                                <input type="text" id="comadd4" name="comadd4" placeholder="CITY/MUNICIPALITY">
                            </td>
                            <td> 
                                <input type="text" id="position4" name="position4" placeholder="POSITION">
                            </td>
                            <td>
                                <input type="date" id="indates4" name="indates4" placeholder="INCLUSIVE DATES">
                                <input type="date" id="indates.4" name="indates.4" placeholder="INCLUSIVE DATES">
                            </td>
                            <td> 
                                <select id="workstat4" name="workstat4">
                                  
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" id="comname5" name="comname5" placeholder="COMPANY NAME">
                            </td>
                            <td>
                                <input type="text" id="comadd5" name="comadd5" placeholder="CITY/MUNICIPALITY">
                            </td>
                            <td> 
                                <input type="text" id="position5" name="position5" placeholder="POSITION">
                            </td>
                            <td>
                                <input type="date" id="indates5" name="indates5" placeholder="INCLUSIVE DATES">
                                <input type="date" id="indates.5" name="indates.5" placeholder="INCLUSIVE DATES">
                            </td>
                            <td> 
                                <select id="workstat5" name="workstat5">
                                 
                                </select>
                            </td>
                        </tr>
                    </table>

                    <table>
                        <tr>
                            <td colspan="5">
                                <h3>VIII. OTHER SKILLS ACQUIRED WITHOUT FORMAL TRAINING</h3>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <label for="addedSkills">ADDED SKILLS:</label>
                                <ul id="addedSkills">
                                    <input type="hidden" id="selectedSkills" name="selectedSkills">
                                </ul>
                            </td>
                        </tr>
                    </table>

                <div class="butcon">
                    <input type="button" value="EDIT NSRP FORM" onclick="showNextForm('personalInfoForm', 'preferenceForm')">
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
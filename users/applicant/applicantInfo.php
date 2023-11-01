<?php
session_start(); // Start the session

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PESO SJDM Portal | NSRP Form</title>

    
    <link rel="shortcut icon" href="../../img/PESOIcon.png">
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php require_once '../userNavbar.php'; ?>
    <div class="parent">
        <div class="container">
            <div class="background-container"></div>
            <?php require_once 'formSidebar.php'; ?>
            <div class="form-container" id="personalInfoForm">
                <!-- Personal Information Form -->
                <h2>PERSONAL INFORMATION</h2>
                <form id="personalinfo" name="form1" class="form-step" data-form-type="personal_info">
                
                    <table>
                        <tr>
                            <td>
                                <label for="sname">SURNAME:</label>
                                <input type="text" id="sname" name="sname" placeholder="ex. Dela Cruz" required>
                            </td>
                            <td>
                                <label for="fname">FIRST NAME:</label>
                                <input type="text" id="fname" name="fname" placeholder="ex. Juan" required>
                            </td>
                            <td>
                                <label for="mname">MIDDLE NAME:</label>
                                <input type="text" id="mname" name="mname" placeholder="ex. Dimagiba" required>
                            </td>
                            <td>
                                <label for="suffix">SUFFIX:</label>
                                <select id="suffix" name="suffix">
                                    <option value="" disabled selected hidden>Select</option>
                                    <option value="Jr">Jr</option>
                                    <option value="Sr">Sr</option>
                                    <option value="II">II</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                    <option value="V">V</option>
                                    <option value="VI">VI</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="bdate">BIRTHDATE:</label>
                                <input type="date" id="bdate" name="bdate" max="2004-01-02" required>
                            </td>
                            <td colspan="2">
                                <label for="bplace">BIRTHPLACE:</label>
                                <input type="text" id="bplace" name="bplace" placeholder="ex. Bulacan" required>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="sex">SEX:</label>
                                <select id="sex" name="sex" required>
                                    <option value="" disabled selected hidden>Select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                <td colspan="2">
                                    <label for="religion">RELIGION:</label>
                                    <select id="religion" name="religion" required>
                                        <option value="" disabled selected hidden>Select</option>
                                        <option value="Roman Catholic">Roman Catholic</option>
                                        <option value="Born Again Christian">Born Again Christian</option>
                                        <option value="Iglesia Ni Cristo">Iglesia Ni Cristo</option>
                                        <option value="Jehova's Witness">Jehova's Witness</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Latter-day Saints">Latter-Day Saints</option>
                                        <option value="Protestant">Protestant</option>
                                        <option value="Seventh-day Adventist">Seventh-Day Adentist</option>
                                        <option value="Evangelical">Evangelical</option>
                                        <option value="Baptist">Baptist</option>
                                        <option value="Buddhist">Buddhist</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="civilstat">CIVIL STATUS:</label>
                                <select id="civilstat" name="civilstat" required>
                                    <option value="" disabled selected hidden>Select</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widowed">Widowed</option>
                                    <option value="Separated">Separated</option>
                                    <option value="Live-in">Live-In</option>
                                </select>
                            </td>
                            <td colspan="2">
                                <p>PRESENT ADDRESS:</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="height">HEIGHT:</label>
                                <input type="text" id="height" name="height" placeholder="ex. 155 cm" required>
                            </td>
                            <td>
                                <label for="email">EMAIL ADDRESS:</label>
                                <input type="email" id="email" name="email" value="<?php echo $_SESSION['applicant_email']; ?>" readonly>
                            </td>
                            <td>
                                <label for="houseno">HOUSE NO/STREET VILLAGE:</label>
                                <input type="text" id="houseno" name="houseno" placeholder="Blk 0 Lot 0 St. 00 Subdivision" required>
                            </td>
                            <td>
                                <label for="brgy">BARANGAY:</label>
                                <select id="brgy" name="brgy" required>
                                    <option value="" disabled selected hidden>Select</option>
                                    <option value="Assumption">Assumption</option>
                                    <option value="Bagong Buhay I">Bagong Buhay I</option>
                                    <option value="Bagong Buhay II">Bagong Buhay II</option>
                                    <option value="Bagong Buhay III">Bagong Buhay III</option>
                                    <option value="Citrus">Citrus</option>
                                    <option value="Ciudad Real">Ciudad Real</option>
                                    <option value="Dulong Bayan">Dulong Bayan</option>
                                    <option value="Fatima">Fatima</option>
                                    <option value="Fatima II">Fatima II</option>
                                    <option value="Fatima III">Fatima III</option>
                                    <option value="Fatima IV">Fatima IV</option>
                                    <option value="Fatima V">Fatima V</option>
                                    <option value="Francisco Homes - Guijo">Francisco Homes - Guijo</option>
                                    <option value="Francisco Homes - Mulawin">Francisco Homes - Mulawin</option>
                                    <option value="Francisco Homes - Narra">Francisco Homes - Narra</option>
                                    <option value="Francisco Homes - Yakal">Francisco Homes - Yakal</option>
                                    <option value="Gaya-Gaya">Gaya-Gaya</option>
                                    <option value="Graceville">Graceville</option>
                                    <option value="Gumaoc Central">Gumaoc Central</option>
                                    <option value="Gumaoc East">Gumaoc East</option>
                                    <option value="Gumaoc West">Gumaoc West</option>
                                    <option value="Kaybanban">Kaybanban</option>
                                    <option value="Kaypian">Kaypian</option>
                                    <option value="Lawang Pari">Lawang Pari</option>
                                    <option value="Maharlika">Maharlika</option>
                                    <option value="Minuyan">Minuyan</option>
                                    <option value="Minuyan II">Minuyan II</option>
                                    <option value="Minuyan III">Minuyan III</option>
                                    <option value="Minuyan IV">Minuyan IV</option>
                                    <option value="Minuyan Proper">Minuyan Proper</option>
                                    <option value="Minuyan V">Minuyan V</option>
                                    <option value="Muzon">Muzon</option>
                                    <option value="Paradise III">Paradise III</option>
                                    <option value="Poblacion">Poblacion</option>
                                    <option value="Poblacion I">Poblacion I</option>
                                    <option value="Saint Martin de Porres">Saint Martin de Porres</option>
                                    <option value="San Isidro">San Isidro</option>
                                    <option value="San Manuel">San Manuel</option>
                                    <option value="San Martin I">San Martin I</option>
                                    <option value="San Martin II">San Martin II</option>
                                    <option value="San Martin III">San Martin III</option>
                                    <option value="San Martin IV">San Martin IV</option>
                                    <option value="San Pedro">"San Pedro</option>
                                    <option value="San Rafael I">San Rafael I</option>
                                    <option value="San Rafael II">San Rafael II</option>
                                    <option value="San Rafael III">San Rafael III</option>
                                    <option value="San Rafael IV">San Rafael IV</option>
                                    <option value="San Rafael V">San Rafael V</option>
                                    <option value="San Roque">San Roque</option>
                                    <option value="Santa Cruz I">Santa Cruz I</option>
                                    <option value="Santa Cruz II">Santa Cruz II</option>
                                    <option value="Santa Cruz III">Santa Cruz III</option>
                                    <option value="Santa Cruz IV">Santa Cruz IV</option>
                                    <option value="Santa Cruz V">Santa Cruz V</option>
                                    <option value="Santo Cristo">Santo Cristo</option>
                                    <option value="Santo Niño I">Santo Niño I</option>
                                    <option value="Santo Niño II">Santo Niño II</option>
                                    <option value="Sapang Palay">Sapang Palay</option>
                                    <option value="Tungkong Mangga">Tungkong Mangga</option>
                                </select>    
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="landline">LANDLINE NUMBER:</label>
                                <input type="text" id="landline" name="landline" placeholder="00-0000-0000">
                            </td>
                            <td>
                                <label for="cpno">CELLPHONE NUMBER:</label>
                                <input type="text" id="cpno" name="cpno" placeholder="0900-000-0000" required>
                            </td>
                            <td>
                                <label for="city">MUNICIPALITY/CITY:</label>
                                <input type="text" id="city" name="city" value="San Jose Del Monte" readonly>
                            </td>
                            <td>
                                <label for="province">PROVINCE:</label>
                                <input type="text" id="province" name="province" value="Bulacan" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="tin">TIN:</label>
                                <input type="text" id="tin" name="tin" placeholder="000-000-000" required>
                            </td>
                            <td>
                                <label for="gsis/sss">GSIS/SSS ID NO.:</label>
                                <input type="text" id="gsis/sss" name="gsis/sss" placeholder="000-00-0000" required>
                            </td>
                            <td>
                                <label for="pagibig">PAG-IBIG NO.:</label>
                                <input type="text" id="pagibig" name="pagibig" placeholder="0000-0000-0000" required>
                            </td>
                            <td>
                                <label for="philhealth">PHILHEALTH NO.:</label>
                                <input type="text" id="philhealth" name="philhealth" placeholder="00-000000000-0" required>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <label for="disability">DISABILITY:</label>
                                <select id="disability" name="disability">
                                    <option value="" disabled selected hidden>Select</option>
                                    <option value="Visual">Visual</option>
                                    <option value="Hearing">Hearing</option>
                                    <option value="Speech">Speech</option>
                                    <option value="Physical">Physical</option>
                                    <option value="Others">Others</option>
                                </select>
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
                                <input type="radio" id="yes1" name="active" value="Yes">
                                <label for="yes1">Yes</label>
                                <input type="radio" id="no1" name="active" value="No">
                                <label for="no1">No</label><br><br>
                                <label for="immediately">Willing to work immediately?</label>
                                <input type="radio" id="yes2" name="immediately" value="Yes">
                                <label for="yes2">Yes</label>
                                <input type="radio" id="no2" name="immediately" value="No">
                                <label for="no2">No</label>
                            </td>
                            <td colspan="2">
                                <label for="looking">How long have you been looking for work?</label>
                                <input type="text" id="looking" name="looking"><br>
                                <label for="when">If no, when?</label>
                                <input type="text" id="when" name="when">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="4ps">Are you a 4Ps beneficiary?</label>
                                <input type="radio" id="yes3" name="4ps" value="Yes">
                                <label for="yes3">Yes</label>
                                <input type="radio" id="no3" name="4ps" value="No">
                                <label for="no3">No</label>
                            </td>
                            <td colspan="2">
                                <label for="id4ps">If yes, Household ID No.?</label>
                                <input type="text" id="id4ps" name="id4ps">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <div class="butcon">
                                    <input type="button" value="NEXT" onclick="showNextForm('personalInfoForm', 'preferenceForm')">
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="form-container" id="preferenceForm">
                <!-- Preference Form -->
                <h2>PREFERENCE</h2>
                <form id="preferences" class="form-step" data-form-type="preference">
                    <table>
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
                                <input type="text" id="prefoccu1" name="prefoccu1" placeholder="PREFERRED OCCUPATION" required>
                            </td>
                            <td colspan="2">
                                <input type="radio" id="prefloclocal" name="prefloclocal" value="Local" required>   
                                <label for="prefloclocal">LOCAL, specify cities/municipalities:</label>
                            </td>
                            <td colspan="2"> 
                                <input type="radio" id="preflocover" name="preflocover" value="Overseas" required>   
                                <label for="preflocover">OVERSEAS, specify countries:</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="prefoccu2">2.</label>
                            </td>
                            <td>
                                <input type="text" id="prefoccu2" name="prefoccu2" placeholder="PREFERRED OCCUPATION" >
                            </td>
                            <td>
                                <label for="prefloclocal1">1.</label>
                            </td>
                            <td>
                                <input type="text" id="prefloclocal1" name="prefloclocal1" placeholder="LOCAL" required>
                            </td>
                            <td>
                                <label for="preflocover1">1.</label>
                            </td>
                            <td>
                                <input type="text" id="preflocover1" name="preflocover1" placeholder="OVERSEAS" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="prefoccu3">3.</label>
                            </td>
                            <td>
                                <input type="text" id="prefoccu3" name="prefoccu3" placeholder="PREFERRED OCCUPATION">
                            </td>
                            <td>
                                <label for="prefloclocal2">2.</label>
                            </td>
                            <td>
                                <input type="text" id="prefloclocal2" name="prefloclocal2" placeholder="LOCAL">
                            </td>
                            <td>
                                <label for="preflocover2">2.</label>
                            </td>
                            <td>
                                <input type="text" id="preflocover2" name="preflocover2" placeholder="OVERSEAS">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="prefoccu4">4.</label>
                            </td>
                            <td>
                                <input type="text" id="prefoccu4" name="prefoccu4" placeholder="PREFERRED OCCUPATION">
                            </td>
                            <td>
                                <label for="prefloclocal3">3.</label>
                            </td>
                            <td>
                                <input type="text" id="prefloclocal3" name="prefloclocal3" placeholder="LOCAL">
                            </td>
                            <td>
                                <label for="preflocover3">3.</label>
                            </td>
                            <td>
                                <input type="text" id="preflocover3" name="preflocover3" placeholder="OVERSEAS">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="exsalary">EXPECTED SALARY (Range):</label>
                                <input type="text" id="exsalary" name="exsalary" placeholder="EXPECTED SALARY (Range)" required>
                            </td>
                            <td colspan="2">
                                <label for="passno">PASSPORT NO.:</label>
                                <input type="text" id="passno" name="passno" placeholder="PASSPORT NO.">
                            </td>
                            <td colspan="2">
                                <label for="expiry">EXPIRY DATE:</label>
                                <input type="date" id="expiry" name="expiry" placeholder="EXPIRY DATE">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <div class="butcon">
                                    <input type="button" value="PREVIOUS" onclick="showPreviousForm('preferenceForm', 'personalInfoForm')">
                                    <input type="button" value="NEXT" onclick="showNextForm('preferenceForm', 'languageForm')">
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="form-container" id="languageForm">
                <!-- Language Form -->
                <h2>LANGUAGE / DIALECT PROFICIENCY</h2>
                <form id="languages" class="form-step" data-form-type="language">
                <table>
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
                    <tr>
                        <td colspan="5">
                            <div class="butcon">
                                <input type="button" value="PREVIOUS" onclick="showPreviousForm('languageForm', 'preferenceForm')">
                                <input type="button" value="NEXT" onclick="showNextForm('languageForm', 'eduBackgroundForm')">
                            </div>
                        </td>
                    </tr>
                    </table>
                </form>
            </div>
            <div class="form-container" id="eduBackgroundForm">
                <!-- Educational Background Form -->
                <h2>EDUCATIONAL BACKGROUND</h2>
                <form id="educations" class="form-step" data-form-type="education">
                    <table>
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
                                <input type="text" id="elemschool" name="elemschool" placeholder="SCHOOL">
                            </td>
                            <td>
                                <input type="text" id="elemcourse" name="elemcourse" placeholder="COURSE">
                            </td>
                            <td> 
                                <select id="elemyeargrad" name="elemyeargrad"></select>
                            </td>
                            <td>
                                <select id="elemlevel" name="elemlevel">
                                    <option value="" disabled selected hidden>LEVEL</option>
                                    <option value="Grade 1">GRADE 1</option>
                                    <option value="Grade 2">GRADE 2</option>
                                    <option value="Grade 3">GRADE 3</option>
                                    <option value="Grade 4">GRADE 4</option>
                                    <option value="Grade 5">GRADE 5</option>
                                    <option value="Grade 6">GRADE 6</option>
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
                                    <option value="" disabled selected hidden>LEVEL</option>
                                    <option value="Grade 7">GRADE 7</option>
                                    <option value="Grade 8">GRADE 8</option>
                                    <option value="Grade 9">GRADE 9</option>
                                    <option value="Grade 10">GRADE 10</option>
                                    <option value="Grade 11">GRADE 11</option>
                                    <option value="Grade 12">GRADE 12</option>
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
                                    <option value="" disabled selected hidden>COURSE</option>
                                    <!-- Bachelor of Science (BS) -->
                                    <optgroup label="Bachelor of Science (BS)">
                                        <option value="BS in Accounting">BS IN ACCOUNTING</option>
                                        <option value="BS in Agriculture">BS IN AGRICULTURE</option>
                                        <option value="BS in Architecture">BS IN ARCHITECTURE</option>
                                        <option value="BS in Biology">BS IN BIOLOGY</option>
                                        <option value="BS in Business Administration">BS IN BUSINESS ADMINISTRATION</option>
                                        <option value="BS in Chemistry">BS IN CHEMISTRY</option>
                                        <option value="BS in Civil Engineering">BS IN CIVIL ENGINEERING</option>
                                        <option value="BS in Computer Engineering">BS IN COMPUTER ENGINEERING</option>
                                        <option value="BS in Computer Science">BS IN COMPUTER SCIENCE</option>
                                        <option value="BS in Criminology">BS IN CRIMINOLOGY</option>
                                        <option value="BS in Economics">BS IN ECONOMICS</option>
                                        <option value="BS in Education">BS IN EDUCATION</option>
                                        <option value="BS in Electrical Engineering">BS IN ELECTRICAL ENGINEERING</option>
                                        <option value="BS in Electronics Engineering">BS IN ELECTRONICS ENGINEERING</option>
                                        <option value="BS in Environmental Science">BS IN ENVIRONMENTAL SCIENCE</option>
                                        <option value="BS in Finance">BS IN FINANCE</option>
                                        <option value="BS in Food Technology">BS IN FOOD TECHNOLOGY</option>
                                        <option value="BS in Geology">BS IN GEOLOGY</option>
                                        <option value="BS in Industrial Engineering">BS IN INDUSTRIAL ENGINEERING</option>
                                        <option value="BS in Information Technology">BS IN INFORMATION TECHNOLOGY</option>
                                        <option value="BS in Marine Biology">BS IN MARINE BIOLOGY</option>
                                        <option value="BS in Mathematics">BS IN MATHEMATICS</option>
                                        <option value="BS in Mechanical Engineering">BS IN MECHANICAL ENGINEERING</option>
                                        <option value="BS in Medical Technology">BS IN MEDICAL TECHNOLOGY</option>
                                        <option value="BS in Nursing">BS IN NURSING</option>
                                        <option value="BS in Nutrition and Dietetics">BS IN NUTRITION AND DIETETICS</option>
                                        <option value="BS in Pharmacy">BS IN PHARMACY</option>
                                        <option value="BS in Physics">BS IN PHYSICS</option>
                                        <option value="BS in Psychology">BS IN PSYCHOLOGY</option>
                                        <option value="BS in Social Work">BS IN SOCIAL WORK</option>
                                        <option value="BS in Statistics">BS IN STATISTICS</option>
                                        <!-- Add more BS courses -->
                                    </optgroup>

                                    <!-- Bachelor of Arts (BA) -->
                                    <optgroup label="Bachelor of Arts (BA)">
                                        <option value="BA in Anthropology">BA IN ANTHROPOLOGY</option>
                                        <option value="BA in Communication">BA IN COMMUNICATION</option>
                                        <option value="BA in English">BA IN ENGLISH</option>
                                        <option value="BA in History">BA IN HISTORY</option>
                                        <option value="BA in Linguistics">BA IN LINGUISTICS</option>
                                        <option value="BA in Music">BA IN MUSIC</option>
                                        <option value="BA in Philosophy">BA IN PHILOSOPHY</option>
                                        <option value="BA in Political Science">BA IN POLITICAL SCIENCE</option>
                                        <option value="BA in Psychology">BA IN PSYCHOLOGY</option>
                                        <option value="BA in Sociology">BA IN SOCIOLOGY</option>
                                        <!-- Add more BA courses -->
                                    </optgroup>

                                    <!-- Business and Management -->
                                    <optgroup label="Business and Management">
                                        <option value="Bachelor of Business Management (BBM)">BACHELOR OF BUSINESS MANAGEMENT (BBM)</option>
                                        <option value="Bachelor of Commerce (BCom)">BACHELOR OF COMMERCE (BCOM)</option>
                                        <option value="Bachelor of Hotel Management (BHM)">BACHELOR OF HOTEL MANAGEMENT (BHM)</option>
                                        <option value="Bachelor of Marketing">BACHELOR OF MARKETING</option>
                                        <option value="Bachelor of Retail Management">BACHELOR OF RETAIL MANAGEMENT</option>
                                        <option value="Bachelor of Tourism Management">BACHELOR OF TOURISM MANAGEMENT</option>
                                        <!-- Add more business and management courses -->
                                    </optgroup>

                                    <!-- Engineering -->
                                    <optgroup label="Engineering">
                                        <option value="Bachelor of Aerospace Engineering">BACHELOR OF AEROSPACE ENGINEERING</option>
                                        <option value="Bachelor of Biomedical Engineering">BACHELOR OF BIOMEDICAL ENGINEERING</option>
                                        <option value="Bachelor of Chemical Engineering">BACHELOR OF CHEMICAL ENGINEERING</option>
                                        <option value="Bachelor of Civil Engineering">BACHELOR OF CIVIL ENGINEERING</option>
                                        <option value="Bachelor of Computer Engineering">BACHELOR OF COMPUTER ENGINEERING</option>
                                        <option value="Bachelor of Electrical Engineering">BACHELOR OF ELECTRICAL ENGINEERING</option>
                                        <option value="Bachelor of Environmental Engineering">BACHELOR OF ENVIRONMENTAL ENGINEERING</option>
                                        <option value="Bachelor of Industrial Engineering">BACHELOR OF INDUSTRIAL ENGINEERING</option>
                                        <option value="Bachelor of Materials Engineering">BACHELOR OF MATERIALS ENGINEERING</option>
                                        <option value="Bachelor of Mechanical Engineering">BACHELOR OF MECHANICAL ENGINEERING</option>
                                        <option value="Bachelor of Software Engineering">BACHELOR OF SOFTWARE ENGINEERING</option>
                                        <option value="Bachelor of Systems Engineering">BACHELOR OF SYSTEMS ENGINEERING
                                        <option value="Bachelor of Systems Engineering">BACHELOR OF SYSTEMS ENGINEERING</option>
                                        <!-- Add more engineering courses -->
                                    </optgroup>

                                    <!-- Medical and Health Sciences -->
                                    <optgroup label="Medical and Health Sciences">
                                        <option value="Bachelor of Biomedical Science">BACHELOR OF BIOMEDICAL SCIENCE</option>
                                        <option value="Bachelor of Dental Science">BACHELOR OF DENTAL SCIENCE</option>
                                        <option value="Bachelor of Medical Science">BACHELOR OF MEDICAL SCIENCE</option>
                                        <option value="Bachelor of Nutrition">BACHELOR OF NUTRITION</option>
                                        <option value="Bachelor of Occupational Therapy">BACHELOR OF OCCUPATIONAL THERAPY</option>
                                        <option value="Bachelor of Pharmacy">BACHELOR OF PHARMACY</option>
                                        <option value="Bachelor of Physiotherapy">BACHELOR OF PHYSIOTHERAPY</option>
                                        <option value="Bachelor of Radiography">BACHELOR OF RADIOGRAPHY</option>
                                        <option value="Bachelor of Speech Pathology">BACHELOR OF SPEECH PATHOLOGY</option>
                                        <!-- Add more medical and health sciences courses -->
                                    </optgroup>

                                    <!-- Social Sciences and Humanities -->
                                    <optgroup label="Social Sciences and Humanities">
                                        <option value="Bachelor of Anthropology">BACHELOR OF ANTHROPOLOGY</option>
                                        <option value="Bachelor of Communication Studies">BACHELOR OF COMMUNICATION STUDIES</option>
                                        <option value="Bachelor of Criminology">BACHELOR OF CRIMINOLOGY</option>
                                        <option value="Bachelor of Education">BACHELOR OF EDUCATION</option>
                                        <option value="Bachelor of Geography">BACHELOR OF GEOGRAPHY</option>
                                        <option value="Bachelor of History">BACHELOR OF HISTORY</option>
                                        <option value="Bachelor of Journalism">BACHELOR OF JOURNALISM</option>
                                        <option value="Bachelor of Linguistics">BACHELOR OF LINGUISTICS</option>
                                        <option value="Bachelor of Philosophy">BACHELOR OF PHILOSOPHY</option>
                                        <option value="Bachelor of Political Science">BACHELOR OF POLITICAL SCIENCE</option>
                                        <option value="Bachelor of Social Work">BACHELOR OF SOCIAL WORK</option>
                                        <option value="Bachelor of Sociology">BACHELOR OF SOCIOLOGY</option>
                                        <option value="Bachelor of Theology">BACHELOR OF THEOLOGY</option>
                                        <option value="Bachelor of Visual Arts">BACHELOR OF VISUAL ARTS</option>
                                        <!-- Add more social sciences and humanities courses -->
                                    </optgroup>

                                    <!-- Natural Sciences -->
                                    <optgroup label="Natural Sciences">
                                        <option value="Bachelor of Biology">BACHELOR OF BIOLOGY</option>
                                        <option value="Bachelor of Chemistry">BACHELOR OF CHEMISTRY</option>
                                        <option value="Bachelor of Environmental Science">BACHELOR OF ENVIRONMENTAL SCIENCE</option>
                                        <option value="Bachelor of Geology">BACHELOR OF GEOLOGY</option>
                                        <option value="Bachelor of Mathematics">BACHELOR OF MATHEMATICS</option>
                                        <option value="Bachelor of Physics">BACHELOR OF PHYSICS</option>
                                        <!-- Add more natural sciences courses -->
                                    </optgroup>

                                    <!-- Arts and Design -->
                                    <optgroup label="Arts and Design">
                                        <option value="Bachelor of Animation">BACHELOR OF ANIMATION</option>
                                        <option value="Bachelor of Fashion Design">BACHELOR OF FASHION DESIGN</option>
                                        <option value="Bachelor of Film and Television">BACHELOR OF FILM AND TELEVISION</option>
                                        <option value="Bachelor of Graphic Design">BACHELOR OF GRAPHIC DESIGN</option>
                                        <option value="Bachelor of Interior Design">BACHELOR OF INTERIOR DESIGN</option>
                                        <option value="Bachelor of Music">BACHELOR OF MUSIC</option>
                                        <option value="Bachelor of Photography">BACHELOR OF PHOTOGRAPHY</option>
                                        <option value="Bachelor of Theater Arts">BACHELOR OF THEATER ARTS</option>
                                        <!-- Add more arts and design courses -->
                                    </optgroup>

                                    <!-- Agriculture and Veterinary Sciences -->
                                    <optgroup label="Agriculture and Veterinary Sciences">
                                        <option value="Bachelor of Agriculture">BACHELOR OF AGRICULTURE</option>
                                        <option value="Bachelor of Animal Science">BACHELOR OF ANIMAL SCIENCE</option>
                                        <option value="Bachelor of Fisheries">BACHELOR OF FISHERIES</option>
                                        <option value="Bachelor of Forestry">BACHELOR OF FORESTRY</option>
                                        <option value="Bachelor of Veterinary Science">BACHELOR OF VETERINARY SCIENCE</option>
                                        <!-- Add more agriculture and veterinary sciences courses -->
                                    </optgroup>

                                    <!-- Information Technology and Computer Science -->
                                    <optgroup label="Information Technology and Computer Science">
                                        <option value="Bachelor of Computer Science">BACHELOR OF COMPUTER SCIENCE</option>
                                        <option value="Bachelor of Information Technology">BACHELOR OF INFORMATION TECHNOLOGY</option>
                                        <option value="Bachelor of Software Engineering">BACHELOR OF SOFTWARE ENGINEERING</option>
                                        <!-- Add more information technology and computer science courses -->
                                    </optgroup>

                                    <!-- Education -->
                                    <optgroup label="Education">
                                        <option value="Bachelor of Early Childhood Education">BACHELOR OF EARLY CHILDHOOD EDUCATION</option>
                                        <option value="Bachelor of Elementary Education">BACHELOR OF ELEMENTARY EDUCATION</option>
                                        <option value="Bachelor of Secondary Education">BACHELOR OF SECONDARY EDUCATION</option>
                                        <option value="Bachelor of Special Education">BACHELOR OF SPECIAL EDUCATION</option>
                                        <!-- Add more education courses -->
                                    </optgroup>
                                </select>
                            </td>
                            <td> 
                            <select id="teryeargrad" name="teryeargrad"></select>
                            </td>
                            <td>
                                <select id="terlevel" name="terlevel">
                                    <option value="" disabled selected hidden>LEVEL</option>
                                    <option value="First Year">FIRST YEAR</option>
                                    <option value="Second Year">SECOND YEAR</option>
                                    <option value="Third Year">THIRD YEAR</option>
                                    <option value="Fourth Year">FOURTH YEAR</option>
                                    <option value="Fifth Year">FIFTH YEAR</option>
                                    <option value="Sixth Year">SIXTH YEAR</option>
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
                                    <option value="" disabled selected hidden>COURSE</option>
                                    <option value="Master of Arts (MA)">MASTER OF ARTS (MA)</option>
                                    <option value="Master of Science (MS)">MASTER OF SCIENCE (MS)</option>
                                    <option value="Master of Business Administration (MBA)">MASTER OF BUSINESS ADMINISTRATION (MBA)</option>
                                    <option value="Master of Education (MEd)">MASTER OF EDUCATION (MEd)</option>
                                    <option value="Master of Public Health (MPH)">MASTER OF PUBLIC HEALTH (MPH)</option>
                                    <option value="Master of Social Work (MSW)">MASTER OF SOCIAL WORK (MSW)</option>
                                    <option value="Master of Fine Arts (MFA)">MASTER OF FINE ARTS (MFA)</option>
                                    <option value="Master of Laws (LLM)">MASTER OF LAWS (LLM)</option>
                                    <option value="Master of Engineering (MEng)">MASTER OF ENGINEERING (MEng)</option>
                                    <option value="Master of Architecture (MArch)">MASTER OF ARCHITECTURE (MArch)</option>
                                    <option value="Master of Music (MM)">MASTER OF MUSIC (MM)</option>
                                    <option value="Master of Library Science (MLS)">MASTER OF LIBRARY SCIENCE (MLS)</option>
                                    <option value="Master of Communication (MComm)">MASTER OF COMMUNICATION (MComm)</option>
                                    <option value="Master of Journalism (MJ)">MASTER OF JOURNALISM (MJ)</option>
                                    <option value="Master of Social Science (MSS)">MASTER OF SOCIAL SCIENCE (MSS)</option>
                                    <option value="Master of Philosophy (MPhil)">MASTER OF PHILOSOPHY (MPhil)</option>
                                    <option value="Master of Applied Science (MASc)">MASTER OF APPLIED SCIENCE (MASc)</option>
                                    <option value="Master of Health Administration (MHA)">MASTER OF HEALTH ADMINISTRATION (MHA)</option>
                                    <option value="Master of Accountancy (MAcc)">MASTER OF ACCOUNTANCY (MAcc)</option>
                                    <option value="Master of Environmental Science (MES)">MASTER OF ENVIRONMENTAL SCIENCE (MES)</option>
                                    <option value="Master of Applied Statistics (MAS)">MASTER OF APPLIED STATISTICS (MAS)</option>
                                    <option value="Master of International Relations (MIR)">MASTER OF INTERNATIONAL RELATIONS (MIR)</option>
                                    <option value="Master of Data Science (MDS)">MASTER OF DATA SCIENCE (MDS)</option>
                                    <option value="Master of Healthcare Administration (MHA)">MASTER OF HEALTHCARE ADMINISTRATION (MHA)</option>
                                    <option value="Doctor of Philosophy (PhD)">DOCTOR OF PHILOSOPHY (PhD)</option>
                                    <option value="Doctor of Medicine (MD)">DOCTOR OF MEDICINE (MD)</option>
                                    <option value="Doctor of Education (EdD)">DOCTOR OF EDUCATION (EdD)</option>
                                    <option value="Doctor of Pharmacy (PharmD)">DOCTOR OF PHARMACY (PharmD)</option>
                                    <option value="Doctor of Psychology (PsyD)">DOCTOR OF PSYCHOLOGY (PsyD)</option>
                                    <option value="Doctor of Dental Medicine (DMD)">DOCTOR OF DENTAL MEDICINE (DMD)</option>
                                    <option value="Doctor of Veterinary Medicine (DVM)">DOCTOR OF VETERINARY MEDICINE (DVM)</option>
                                    <option value="Doctor of Public Health (DrPH)">DOCTOR OF PUBLIC HEALTH (DrPH)</option>
                                    <option value="Doctor of Nursing Practice (DNP)">DOCTOR OF NURSING PRACTICE (DNP)</option>
                                    <option value="Doctor of Business Administration (DBA)">DOCTOR OF BUSINESS ADMINISTRATION (DBA)</option>
                                    <option value="Doctor of Social Work (DSW)">DOCTOR OF SOCIAL WORK (DSW)</option>
                                    <option value="Doctor of Optometry (OD)">DOCTOR OF OPTOMETRY (OD)</option>
                                    <option value="Doctor of Physical Therapy (DPT)">DOCTOR OF PHYSICAL THERAPY (DPT)</option>
                                    <option value="Doctor of Engineering (DEng)">DOCTOR OF ENGINEERING (DEng)</option>
                                    <option value="Doctor of Juridical Science (SJD)">DOCTOR OF JURIDICIAL SCIENCE (SJD)</option>
                                    <!-- Add more graduate study courses as needed -->
                                </select>
                            </td>
                            <td> 
                            <select id="gradyeargrad" name="gradyeargrad"></select>
                            </td>
                            <td>
                                <select id="gradlevel" name="gradlevel">
                                    <option value="" disabled selected hidden>LEVEL</option>
                                    <option value="First Year">FIRST YEAR</option>
                                    <option value="Second Year">SECOND YEAR</option>
                                    <option value="Third Year">THIRD YEAR</option>
                                    <option value="Fourth Year">FOURTH YEAR</option>
                                    <option value="Fifth Year">FIFTH YEAR</option>
                                    <option value="Sixth Year">SIXTH YEAR</option>
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
                        <tr>
                            <td colspan="7">
                                <div class="butcon">
                                    <input type="button" value="PREVIOUS" onclick="showPreviousForm('eduBackgroundForm', 'languageForm')">
                                    <input type="button" value="NEXT" onclick="showNextForm('eduBackgroundForm', 'trainingForm')">
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="form-container" id="trainingForm">
                <!-- Training Form -->
                <h2>TECHNICAL/VOCATIONAL AND OTHER TRAINING</h2><p>(Include courses as part of college education)</p>
                <form id="trainings" class="form-step" data-form-type="training">
                    <table>
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
                        <tr>
                            <td colspan="5">
                                <div class="butcon">
                                    <input type="button" value="PREVIOUS" onclick="showPreviousForm('trainingForm', 'eduBackgroundForm')">
                                    <input type="button" value="NEXT" onclick="showNextForm('trainingForm', 'eligibilityForm')">
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="form-container" id="eligibilityForm">
                <!-- Eligibility Form -->
                <h2>ELIGIBILITY/PROFESSIONAL LICENSE</h2>
                <form id="eligibilities" class="form-step" data-form-type="eligibility">
                    <table>
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
                        <tr>
                            <td colspan="7">
                                <div class="butcon">
                                    <input type="button" value="PREVIOUS" onclick="showPreviousForm('eligibilityForm', 'trainingForm')">
                                    <input type="button" value="NEXT" onclick="showNextForm('eligibilityForm', 'workExpForm')">
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="form-container" id="workExpForm">
                <!-- Work Experience Form -->
                <h2>WORK EXPERIENCE</h2><p>(Limit to 10 year period, start with the most recent employment)</p>
                <form id="workExperience" class="form-step" data-form-type="work_experience">
                    <table>
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
                                    <option value="" disabled selected hidden>STATUS</option>
                                    <option value="Permanent">PERMANENT</option>
                                    <option value="Contractual">CONTRACTUAL</option>
                                    <option value="Part-time">PART-TIME</option>
                                    <option value="Probationary">PROBATIONARY</option>
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
                                    <option value="" disabled selected hidden>STATUS</option>
                                    <option value="Permanent">PERMANENT</option>
                                    <option value="Contractual">CONTRACTUAL</option>
                                    <option value="Part-time">PART-TIME</option>
                                    <option value="Probationary">PROBATIONARY</option>
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
                                    <option value="" disabled selected hidden>STATUS</option>
                                    <option value="Permanent">PERMANENT</option>
                                    <option value="Contractual">CONTRACTUAL</option>
                                    <option value="Part-time">PART-TIME</option>
                                    <option value="Probationary">PROBATIONARY</option>
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
                                    <option value="" disabled selected hidden>STATUS</option>
                                    <option value="Permanent">PERMANENT</option>
                                    <option value="Contractual">CONTRACTUAL</option>
                                    <option value="Part-time">PART-TIME</option>
                                    <option value="Probationary">PROBATIONARY</option>
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
                                    <option value="" disabled selected hidden>STATUS</option>
                                    <option value="Permanent">PERMANENT</option>
                                    <option value="Contractual">CONTRACTUAL</option>
                                    <option value="Part-time">PART-TIME</option>
                                    <option value="Probationary">PROBATIONARY</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <div class="butcon">
                                    <input type="button" value="PREVIOUS" onclick="showPreviousForm('workExpForm', 'eligibilityForm')">
                                    <input type="button" value="NEXT" onclick="showNextForm('workExpForm', 'skillsForm')">
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="form-container" id="skillsForm">
                <!-- Skills Form -->
                <h2>OTHER SKILLS ACQUIRED WITHOUT FORMAL TRAINING</h2>
                <form id="skillS" class="form-step" data-form-type="skill">
                <table>
                    <tr>
                        <td>
                            <input type="checkbox" id="automec" name="automec" value="Auto Mechanic">
                            <label for="automec"> AUTO MECHANIC</label>
                        </td>
                        <td>
                            <input type="checkbox" id="electrician" name="electrician" value="Electrician">
                            <label for="electrician"> ELECTRICIAN</label>
                        </td>
                        <td>
                            <input type="checkbox" id="photography" name="photography" value="Photography">
                            <label for="photography"> PHOTOGRAPHY</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" id="beautician" name="beautician" value="Beautician">
                            <label for="beautician"> BEAUTICIAN</label>
                        </td>
                        <td>
                            <input type="checkbox" id="embroidery" name="embroidery" value="Embroidery">
                            <label for="embroidery"> EMBROIDERY</label>
                        </td>
                        <td>
                            <input type="checkbox" id="plumbing" name="plumbing" value="Plumbing">
                            <label for="plumbing"> PLUMBING</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" id="carpentry" name="carpentry" value="Carpentry Works">
                            <label for="carpentry"> CARPENTRY WORK</label>
                        </td>
                        <td>
                            <input type="checkbox" id="gardening" name="gardening" value="Gardening">
                            <label for="gardening"> GARDENING</label>
                        </td>
                        <td>
                            <input type="checkbox" id="sewing" name="sewing" value="Sewing Dresses">
                            <label for="sewing"> SEWING DRESSES</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" id="comlit" name="comlit" value="Computer Literate">
                            <label for="comlit">  COMPUTER LITERATE</label>
                        </td>
                        <td>
                            <input type="checkbox" id="masonry" name="masonry" value="Masonry">
                            <label for="masonry"> MASONRY</label>
                        </td>
                        <td>
                            <input type="checkbox" id="stenography" name="stenography" value="Stenography">
                            <label for="stenography"> STENOGRAPHY</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" id="domestic" name="domestic" value="Domestic">
                            <label for="domestic"> DOMESTIC CHORES</label>
                        </td>
                        <td>
                            <input type="checkbox" id="artist" name="artist" value="Painter/Artist">
                            <label for="artist"> PAINTER/ARTIST</label>
                        </td>
                        <td>
                            <input type="checkbox" id="tailoring" name="tailoring" value="Tailoring">
                            <label for="tailoring"> TAILORING</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" id="driver" name="driver" value="Driver">
                            <label for="driver"> DRIVER</label>
                        </td>
                        <td>
                            <input type="checkbox" id="painting" name="painting" value="Painting Jobs">
                            <label for="painting"> PAINTING JOBS</label>
                        </td>
                        <td>
                            <input type="checkbox" id="otherskill" name="otherskill" value="Others">
                            <label for="otherskill"> OTHERS</label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div class="butcon">
                                <input type="button" value="PREVIOUS" onclick="showPreviousForm('skillsForm', 'workExpForm')">
                                <input type="submit" value="SUBMIT">
                            </div>
                        </td>
                    </tr>
                    </table>
                </form>
            </div>
            <div id="custom-popup" class="custom-popup">
                <div class="popup-content">
                    <p>Thank you for submitting your form. By clicking 'SUBMIT', you confirm that the information provided is accurate and complete.</p>
                    <button id="popup-close">OK</button>
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
        document.addEventListener('DOMContentLoaded', function() {
            showDefaultForm();
        });

        function showDefaultForm() {
            const defaultForm = document.getElementById('personalInfoForm');
            const nonDefaultForms = document.querySelectorAll('.form-container:not(#personalInfoForm)');

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
            var x = document.forms["form1"]["sname","fname","mname","bdate","bplace","sex","religion","civilstat","height","houseno","brgy","cpno","tin","gsis/sss","pagibig","philhealth"].value;
            if (x == "") {
                alert("Please fill out all the required fields");
                validateForm(currentForm);
                return false;
            }

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

        function showEmployOpt() {
            const employedOpt = document.getElementById('employedOpt');
            const unemployedOpt = document.getElementById('unemployedOpt');
            const employedRadio = document.getElementById('employed');
            
            if (employedRadio.checked) {
                employedOpt.style.display = 'table-row';
                unemployedOpt.style.display = 'none';
            } else {
                employedOpt.style.display = 'none';
                unemployedOpt.style.display = 'table-row';
            }
        }

        // Call the function to disable navbar elements
        disableNavbarElements();

    // Define a shared array of date options
    const dateOptions = [
            
            "1960", "1961", "1962", "1963", "1964", "1965", "1966", "1967", "1968", "1969",
            "1970", "1971", "1972", "1973", "1974", "1975", "1976", "1977", "1978", "1979",
            "1980", "1981", "1982", "1983", "1984", "1985", "1986", "1987", "1988", "1989",
            "1990", "1991", "1992", "1993", "1994", "1995", "1996", "1997", "1998", "1999",
            "2000", "2001", "2002", "2003", "2004", "2005", "2006", "2007", "2008", "2009",
            "2010", "2011", "2012", "2013", "2014", "2015", "2016", "2017", "2018", "2019",
            "2020", "2021", "2022", "2023", "2024", "2025", "2026", "2027", "2028", "2029",
            "2030"
        ];

        const selectIds = ["elemyeargrad", "elemyearattended", "secyeargrad", "secyearattended", "teryeargrad", "teryearattended", "gradyeargrad", "gradyearattended"];
        selectIds.forEach((selectId) => {
        const select = document.getElementById(selectId);

        if (select) {
            // Create the default "Select a year" option and make it disabled
            const defaultOption = new Option("YEAR", "");
            defaultOption.disabled = true;
            defaultOption.selected = true;
            select.appendChild(defaultOption);

            // Add other date options
            dateOptions.forEach((option) => {
            const optionElement = new Option(option, option);
            select.appendChild(optionElement);
            });

            // Prevent the default option from being selected
            select.addEventListener("change", function () {
            if (select.selectedIndex === 0) {
                select.selectedIndex = -1;
            }
            });
        }
        });

        // Function to populate select elements with date options
        function populateSelect(selectId) {
            const select = document.getElementById(selectId);

            dateOptions.forEach((option) => {
                const optionElement = document.createElement("option");
                optionElement.value = option;
                optionElement.text = option;
                select.appendChild(optionElement);
            });
        }

        // Call the function to populate select elements
        populateSelect("elemyeargrad");
        populateSelect("elemyearattended");
        populateSelect("secyeargrad");
        populateSelect("secyearattended");
        populateSelect("teryeargrad");
        populateSelect("teryearattended");
        populateSelect("gradyeargrad");
        populateSelect("gradyearattended");

        function displayCustomPopup(redirectURL) {
            const popup = document.getElementById('custom-popup');
            const popupClose = document.getElementById('popup-close');

            popup.style.display = 'block';

            popupClose.addEventListener('click', function () {
                popup.style.display = 'none';

                if (redirectURL) {
                    window.location.href = redirectURL; // Redirect to the specified URL
                }
            });
        }
        
        let currentForm = 0;
        const forms = document.querySelectorAll('.form-step');
        let formData = {};

        function validateForm(form) {
            const requiredFields = form.querySelectorAll('[required]');
            let firstEmptyField = null;

            for (const field of requiredFields) {
                if (field.value.trim() === '') {
                    field.style.borderColor = 'red'; // Highlight empty fields in red
                    if (!firstEmptyField) {
                        firstEmptyField = field;
                    }
                } else {
                    field.style.borderColor = ''; // Reset border color for non-empty fields
                }
            }

            if (firstEmptyField) {
                firstEmptyField.focus(); // Focus on the first empty required field
                return false; // Prevent form submission
            }

            return true; // Form is valid
        }

        function submitForm() {
            formData = {};
            formData['form_types'] = [];

            forms.forEach((form, index) => {
                const formFields = form.querySelectorAll('input[type="text"], input[type="email"], input[type="date"], input[type="radio"]:checked, select');
                formFields.forEach(field => {
                    formData[field.name] = field.value;
                });

                if (form.getAttribute('data-form-type') === 'language') {
                    const checkboxes = form.querySelectorAll('input[type="checkbox"]');
                    checkboxes.forEach(checkbox => {
                        formData[checkbox.name] = checkbox.checked;
                    });
                } else if (form.getAttribute('data-form-type') === 'skill') {
                    const checkboxes = form.querySelectorAll('input[type="checkbox"]');
                    checkboxes.forEach(checkbox => {
                        formData[checkbox.name] = checkbox.checked;
                    });
                } else if (form.getAttribute('data-form-type') === 'preference') {
                    const checkboxes = form.querySelectorAll('input[type="checkbox"]');
                    checkboxes.forEach(checkbox => {
                        formData[checkbox.name] = checkbox.checked;
                    });
                }

                formData['form_types'].push(form.getAttribute('data-form-type'));
            });

            console.log('Form Types Array:', formData['form_types']);

            const jsonData = JSON.stringify(formData);

            const currentFormElement = forms[currentForm];
            if (validateForm(currentFormElement) === false) {
                return;
            }

            // Display the custom pop-up message
            displayCustomPopup('applicantHome.php');

            console.log('Simulating server response');
            console.log('Form Data:', formData);

            fetch('form.php', {
                method: 'POST',
                body: jsonData,
                headers: {
                    'Content-Type': 'application/json'
                }
            }).then(response => {
                if (response.ok) {
                    console.log('Form submitted successfully');
                } else {
                    console.error('Form submission failed');
                }
            }).catch(error => {
                console.error('Network error:', error);
            });
        }

        const submitButton = document.querySelector('#skillS input[type="submit"]');
        submitButton.addEventListener('click', function(event) {
            event.preventDefault();
            submitForm();
        });



    </script>
</body>
</html>
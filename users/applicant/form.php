<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection file
    require_once "../../config/dbconnect.php";

    // Get the applicant ID from the session (you should set this when the applicant logs in)
    $applicant_id = $_SESSION['applicant_id'];

    // Parse JSON data from the POST request
    $rawData = file_get_contents('php://input');
    $jsonData = json_decode($rawData, true);

    if ($jsonData && isset($jsonData['form_types'])) {
        $formTypes = $jsonData['form_types'];

        // Now, $formTypes is an array containing the form types
        // You can loop through $formTypes to handle each form type
        foreach ($formTypes as $formType) {
            switch ($formType) {
                case "personal_info":
                    // Handle personal_info form data
                    if (
                        isset($jsonData['sname']) && isset($jsonData['fname']) &&
                        isset($jsonData['mname']) && isset($jsonData['suffix']) &&
                        isset($jsonData['bdate']) && isset($jsonData['bplace']) &&
                        isset($jsonData['sex']) && isset($jsonData['religion']) &&
                        isset($jsonData['civilstat']) && isset($jsonData['houseno']) &&
                        isset($jsonData['brgy']) && isset($jsonData['city']) &&
                        isset($jsonData['province']) && isset($jsonData['height']) &&
                        isset($jsonData['email']) && isset($jsonData['landline']) &&
                        isset($jsonData['cpno']) && isset($jsonData['tin']) &&
                        isset($jsonData['gsis/sss']) && isset($jsonData['pagibig']) &&
                        isset($jsonData['philhealth']) && isset($jsonData['selectedDisabilities']) &&
                        isset($jsonData['others5']) && isset($jsonData['empstat'])
                    ) {
                        $surname = filter_var($jsonData['sname'], FILTER_SANITIZE_STRING);
                        $firstname = filter_var($jsonData['fname'], FILTER_SANITIZE_STRING);
                        $middlename = filter_var($jsonData['mname'], FILTER_SANITIZE_STRING);
                        $suffix = filter_var($jsonData['suffix'], FILTER_SANITIZE_STRING);
                        $birthdate = filter_var($jsonData['bdate'], FILTER_SANITIZE_STRING);
                        $birthplace = filter_var($jsonData['bplace'], FILTER_SANITIZE_STRING);
                        $sex = filter_var($jsonData['sex'], FILTER_SANITIZE_STRING);
                        $religion = filter_var($jsonData['religion'], FILTER_SANITIZE_STRING);
                        $civil_status = filter_var($jsonData['civilstat'], FILTER_SANITIZE_STRING);
                        $house_no_street_village = filter_var($jsonData['houseno'], FILTER_SANITIZE_STRING);
                        $barangay = filter_var($jsonData['brgy'], FILTER_SANITIZE_STRING);
                        $municipality_city = filter_var($jsonData['city'], FILTER_SANITIZE_STRING);
                        $province = filter_var($jsonData['province'], FILTER_SANITIZE_STRING);
                        $height = filter_var($jsonData['height'], FILTER_SANITIZE_STRING);
                        $email = filter_var($jsonData['email'], FILTER_SANITIZE_EMAIL);
                        $landline_number = filter_var($jsonData['landline'], FILTER_SANITIZE_STRING);
                        $cellphone_number = filter_var($jsonData['cpno'], FILTER_SANITIZE_STRING);
                        $tin = filter_var($jsonData['tin'], FILTER_SANITIZE_STRING);
                        $gsis_sss_id = filter_var($jsonData['gsis/sss'], FILTER_SANITIZE_STRING);
                        $pagibig_no = filter_var($jsonData['pagibig'], FILTER_SANITIZE_STRING);
                        $philhealth_no = filter_var($jsonData['philhealth'], FILTER_SANITIZE_STRING);

                
                        // Assuming you have the selected disabilities in $jsonData['selectedDisabilities']
                        $selectedDisabilities = $jsonData['selectedDisabilities'];

                        // Sanitize each selected disability
                        $cleanedDisabilities = array_map('htmlspecialchars', $selectedDisabilities);

                        // Implode the sanitized disabilities into a comma-separated string
                        $disability = implode(', ', $cleanedDisabilities);

                        $employment_status = filter_var($jsonData['empstat'], FILTER_SANITIZE_STRING);
                        $employment_type = '';
                
                        if (isset($jsonData['employed'])) {
                            $employment_type = filter_var($jsonData['employed'], FILTER_SANITIZE_STRING);
                        } elseif (isset($jsonData['unemployed'])) {
                            $employment_type = filter_var($jsonData['unemployed'], FILTER_SANITIZE_STRING);
                
                            if (isset($jsonData['others4'])) {
                                $employment_type .= ' / ' . filter_var($jsonData['others4'], FILTER_SANITIZE_STRING);
                            }
                
                            if (isset($jsonData['country'])) {
                                $employment_type .= ' ' . filter_var($jsonData['country'], FILTER_SANITIZE_STRING);
                            }
                        }
                
                        $actively_looking_for_work = filter_var($jsonData['active'], FILTER_SANITIZE_STRING);
                        $willing_to_work_immediately = filter_var($jsonData['immediately'], FILTER_SANITIZE_STRING);
                        $how_long_looking_for_work = filter_var($jsonData['looking'], FILTER_SANITIZE_STRING);
                        $if_no_when = filter_var($jsonData['when'], FILTER_SANITIZE_STRING);
                        $is_4ps_beneficiary = filter_var($jsonData['4ps'], FILTER_SANITIZE_STRING);
                        $household_id_4ps = filter_var($jsonData['id4ps'], FILTER_SANITIZE_STRING);
                
                        // Insert data into the personal_info table
                        // Prepare the SQL statement
                        $stmt = $conn->prepare("INSERT INTO personal_info (applicant_id, surname, first_name, middle_name, suffix, birthdate, birthplace, sex, religion, civil_status, house_no_street_village, barangay, municipality_city, province, height, email, landline_number, cellphone_number, tin, gsis_sss_id, pagibig_no, philhealth_no, disability, employment_status, employment_type, actively_looking_for_work, how_long_looking_for_work, willing_to_work_immediately, if_no_when, is_4ps_beneficiary, household_id_4ps) 
                        VALUES (:applicant_id, :surname, :firstname, :middlename, :suffix, :birthdate, :birthplace, :sex, :religion, :civil_status, :house_no_street_village, :barangay, :municipality_city, :province, :height, :email, :landline_number, :cellphone_number, :tin, :gsis_sss_id, :pagibig_no, :philhealth_no, :disability, :employment_status, :employment_type, :actively_looking_for_work, :how_long_looking_for_work, :willing_to_work_immediately, :if_no_when, :is_4ps_beneficiary, :household_id_4ps)");
                
                        // Bind parameters
                        $stmt->bindParam(':applicant_id', $applicant_id);
                        $stmt->bindParam(':surname', $surname);
                        $stmt->bindParam(':firstname', $firstname);
                        $stmt->bindParam(':middlename', $middlename);
                        $stmt->bindParam(':suffix', $suffix);
                        $stmt->bindParam(':birthdate', $birthdate);
                        $stmt->bindParam(':birthplace', $birthplace);
                        $stmt->bindParam(':sex', $sex);
                        $stmt->bindParam(':religion', $religion);
                        $stmt->bindParam(':civil_status', $civil_status);
                        $stmt->bindParam(':house_no_street_village', $house_no_street_village);
                        $stmt->bindParam(':barangay', $barangay);
                        $stmt->bindParam(':municipality_city', $municipality_city);
                        $stmt->bindParam(':province', $province);
                        $stmt->bindParam(':height', $height);
                        $stmt->bindParam(':email', $email);
                        $stmt->bindParam(':landline_number', $landline_number);
                        $stmt->bindParam(':cellphone_number', $cellphone_number);
                        $stmt->bindParam(':tin', $tin);
                        $stmt->bindParam(':gsis_sss_id', $gsis_sss_id);
                        $stmt->bindParam(':pagibig_no', $pagibig_no);
                        $stmt->bindParam(':philhealth_no', $philhealth_no);
                        $stmt->bindParam(':disability', $disability);
                        $stmt->bindParam(':employment_status', $employment_status);
                        $stmt->bindParam(':employment_type', $employment_type);
                        $stmt->bindParam(':actively_looking_for_work', $actively_looking_for_work);
                        $stmt->bindParam(':how_long_looking_for_work', $how_long_looking_for_work);
                        $stmt->bindParam(':willing_to_work_immediately', $willing_to_work_immediately);
                        $stmt->bindParam(':if_no_when', $if_no_when);
                        $stmt->bindParam(':is_4ps_beneficiary', $is_4ps_beneficiary);
                        $stmt->bindParam(':household_id_4ps', $household_id_4ps);
                
                        $stmt->execute();
                
                        // Store first name in a session variable
                        $_SESSION['applicant_name'] = $firstname;
                    }
                    break;

                    case "preference":
                        // Handle preference form data
                        if (
                            isset($jsonData['prefoccu1']) && isset($jsonData['prefoccu2']) &&
                            isset($jsonData['prefoccu3']) && isset($jsonData['prefoccu4']) &&
                            isset($jsonData['prefloclocal']) && isset($jsonData['prefloclocal1']) &&
                            isset($jsonData['prefloclocal2']) && isset($jsonData['prefloclocal3']) &&
                            isset($jsonData['preflocover']) && isset($jsonData['preflocover1']) &&
                            isset($jsonData['preflocover2']) && isset($jsonData['preflocover3']) &&
                            isset($jsonData['exsalary']) && isset($jsonData['passno']) &&
                            isset($jsonData['expiry'])
                        ) {
                            $preferred_occupation1 = filter_var($jsonData['prefoccu1'], FILTER_SANITIZE_STRING);
                            $preferred_occupation2 = filter_var($jsonData['prefoccu2'], FILTER_SANITIZE_STRING);
                            $preferred_occupation3 = filter_var($jsonData['prefoccu3'], FILTER_SANITIZE_STRING);
                            $preferred_occupation4 = filter_var($jsonData['prefoccu4'], FILTER_SANITIZE_STRING);
                            $preferred_location1 = filter_var($jsonData['prefloclocal'], FILTER_SANITIZE_STRING);
                            $local_location1 = filter_var($jsonData['prefloclocal1'], FILTER_SANITIZE_STRING);
                            $local_location2 = filter_var($jsonData['prefloclocal2'], FILTER_SANITIZE_STRING);
                            $local_location3 = filter_var($jsonData['prefloclocal3'], FILTER_SANITIZE_STRING);
                            $preferred_location2 = filter_var($jsonData['preflocover'], FILTER_SANITIZE_STRING);
                            $overseas_location1 = filter_var($jsonData['preflocover1'], FILTER_SANITIZE_STRING);
                            $overseas_location2 = filter_var($jsonData['preflocover2'], FILTER_SANITIZE_STRING);
                            $overseas_location3 = filter_var($jsonData['preflocover3'], FILTER_SANITIZE_STRING);
                            $expected_salary = filter_var($jsonData['exsalary'], FILTER_SANITIZE_STRING);
                            $passport_number = filter_var($jsonData['passno'], FILTER_SANITIZE_STRING);
                            $passport_expiry_date = filter_var($jsonData['expiry'], FILTER_SANITIZE_STRING);
    
                            // Insert data into the preference table
                            // Prepare SQL statement
                            $stmt = $conn->prepare("INSERT INTO preference (applicant_id, preferred_occupation1, preferred_occupation2, preferred_occupation3, preferred_occupation4, preferred_location1, local_location1, local_location2, local_location3, preferred_location2, overseas_location1, overseas_location2, overseas_location3, expected_salary, passport_number, passport_expiry_date) 
                            VALUES (:applicant_id, :preferred_occupation1, :preferred_occupation2, :preferred_occupation3, :preferred_occupation4, :preferred_location1, :local_location1, :local_location2, :local_location3, :preferred_location2, :overseas_location1, :overseas_location2, :overseas_location3, :expected_salary, :passport_number, :passport_expiry_date)");
                            
                            
                            // Bind parameters
                            $stmt->bindParam(":applicant_id", $applicant_id);
                            $stmt->bindParam(":preferred_occupation1", $preferred_occupation1);
                            $stmt->bindParam(":preferred_occupation2", $preferred_occupation2);
                            $stmt->bindParam(":preferred_occupation3", $preferred_occupation3);
                            $stmt->bindParam(":preferred_occupation4", $preferred_occupation4);
                            $stmt->bindParam(":preferred_location1", $preferred_location1);
                            $stmt->bindParam(":local_location1", $local_location1);
                            $stmt->bindParam(":local_location2", $local_location2);
                            $stmt->bindParam(":local_location3", $local_location3);
                            $stmt->bindParam(":preferred_location2", $preferred_location2);
                            $stmt->bindParam(":overseas_location1", $overseas_location1);
                            $stmt->bindParam(":overseas_location2", $overseas_location2);
                            $stmt->bindParam(":overseas_location3", $overseas_location3);
                            $stmt->bindParam(":expected_salary", $expected_salary);
                            $stmt->bindParam(":passport_number", $passport_number);
                            $stmt->bindParam(":passport_expiry_date", $passport_expiry_date);

                            $stmt->execute();
                        }
                        break;
    
                    case "language":
                        // Handle language form data
                        if (
                            isset($jsonData['engread']) && isset($jsonData['engwrite']) &&
                            isset($jsonData['engspeak']) && isset($jsonData['engunderstand']) &&
                            isset($jsonData['filread']) && isset($jsonData['filwrite']) &&
                            isset($jsonData['filspeak']) && isset($jsonData['filunderstand']) &&
                            isset($jsonData['others1']) && isset($jsonData['otherread']) &&
                            isset($jsonData['otherwrite']) && isset($jsonData['otherspeak']) &&
                            isset($jsonData['otherunderstand'])
                        ) {

                           // Sanitize and filter the input data using JSON data
                            $english_read = filter_var($jsonData['engread'], FILTER_VALIDATE_BOOLEAN);
                            $english_write = filter_var($jsonData['engwrite'], FILTER_VALIDATE_BOOLEAN);
                            $english_speak = filter_var($jsonData['engspeak'], FILTER_VALIDATE_BOOLEAN);
                            $english_understand = filter_var($jsonData['engunderstand'], FILTER_VALIDATE_BOOLEAN);

                            $filipino_read = filter_var($jsonData['filread'], FILTER_VALIDATE_BOOLEAN);
                            $filipino_write = filter_var($jsonData['filwrite'], FILTER_VALIDATE_BOOLEAN);
                            $filipino_speak = filter_var($jsonData['filspeak'], FILTER_VALIDATE_BOOLEAN);
                            $filipino_understand = filter_var($jsonData['filunderstand'], FILTER_VALIDATE_BOOLEAN);

                            $other_language = filter_var($jsonData['others1'], FILTER_SANITIZE_STRING);
                            $other_read = filter_var($jsonData['otherread'], FILTER_VALIDATE_BOOLEAN);
                            $other_write = filter_var($jsonData['otherwrite'], FILTER_VALIDATE_BOOLEAN);
                            $other_speak = filter_var($jsonData['otherspeak'], FILTER_VALIDATE_BOOLEAN);
                            $other_understand = filter_var($jsonData['otherunderstand'], FILTER_VALIDATE_BOOLEAN);

                            // Insert data into the language table
                            $stmt = $conn->prepare("INSERT INTO language (applicant_id, english_read, english_write, english_speak, english_understand, filipino_read, filipino_write, filipino_speak, filipino_understand, other_language, other_read, other_write, other_speak, other_understand) 
                            VALUES (:applicant_id, :english_read, :english_write, :english_speak, :english_understand, :filipino_read, :filipino_write, :filipino_speak, :filipino_understand, :other_language, :other_read, :other_write, :other_speak, :other_understand)");

                        
                            // Bind parameters
                            $stmt->bindParam(':applicant_id', $applicant_id);
                            $stmt->bindParam(':english_read', $english_read, PDO::PARAM_INT);
                            $stmt->bindParam(':english_write', $english_write, PDO::PARAM_INT);
                            $stmt->bindParam(':english_speak', $english_speak, PDO::PARAM_INT);
                            $stmt->bindParam(':english_understand', $english_understand, PDO::PARAM_INT);
                            $stmt->bindParam(':filipino_read', $filipino_read, PDO::PARAM_INT);
                            $stmt->bindParam(':filipino_write', $filipino_write, PDO::PARAM_INT);
                            $stmt->bindParam(':filipino_speak', $filipino_speak, PDO::PARAM_INT);
                            $stmt->bindParam(':filipino_understand', $filipino_understand, PDO::PARAM_INT);
                            $stmt->bindParam(':other_language', $other_language, PDO::PARAM_STR);
                            $stmt->bindParam(':other_read', $other_read, PDO::PARAM_INT);
                            $stmt->bindParam(':other_write', $other_write, PDO::PARAM_INT);
                            $stmt->bindParam(':other_speak', $other_speak, PDO::PARAM_INT);
                            $stmt->bindParam(':other_understand', $other_understand, PDO::PARAM_INT);

                            $stmt->execute();
                        }
                        break;
    
                    case "education":
                        // Handle education form data
                        if (
                            isset($jsonData['elemschool']) && isset($jsonData['elemcourse']) &&
                            isset($jsonData['elemyeargrad']) && isset($jsonData['elemlevel']) &&
                            isset($jsonData['elemyearattended']) && isset($jsonData['elemawards']) &&
                            isset($jsonData['secschool']) && isset($jsonData['seccourse']) &&
                            isset($jsonData['secyeargrad']) && isset($jsonData['seclevel']) &&
                            isset($jsonData['secyearattended']) && isset($jsonData['secawards']) &&
                            isset($jsonData['terschool']) && isset($jsonData['tercourse']) &&
                            isset($jsonData['teryeargrad']) && isset($jsonData['terlevel']) &&
                            isset($jsonData['teryearattended']) && isset($jsonData['terawards']) &&
                            isset($jsonData['gradschool']) && isset($jsonData['gradcourse']) &&
                            isset($jsonData['gradyeargrad']) && isset($jsonData['gradlevel']) &&
                            isset($jsonData['gradyearattended']) && isset($jsonData['gradawards'])
                        ) {

                            $elementary_school = filter_var($jsonData['elemschool'], FILTER_SANITIZE_STRING);
                            $elementary_course = filter_var($jsonData['elemcourse'], FILTER_SANITIZE_STRING);
                            $elementary_year_graduated = filter_var($jsonData['elemyeargrad'], FILTER_SANITIZE_STRING);
                            $elementary_level = filter_var($jsonData['elemlevel'], FILTER_SANITIZE_STRING);
                            $elementary_year_last_attended = filter_var($jsonData['elemyearattended'], FILTER_SANITIZE_STRING);
                            $elementary_awards = filter_var($jsonData['elemawards'], FILTER_SANITIZE_STRING);

                            $secondary_school = filter_var($jsonData['secschool'], FILTER_SANITIZE_STRING);
                            $secondary_course = filter_var($jsonData['seccourse'], FILTER_SANITIZE_STRING);
                            $secondary_year_graduated = filter_var($jsonData['secyeargrad'], FILTER_SANITIZE_STRING);
                            $secondary_level = filter_var($jsonData['seclevel'], FILTER_SANITIZE_STRING);
                            $secondary_year_last_attended = filter_var($jsonData['secyearattended'], FILTER_SANITIZE_STRING);
                            $secondary_awards = filter_var($jsonData['secawards'], FILTER_SANITIZE_STRING);

                            $tertiary_school = filter_var($jsonData['terschool'], FILTER_SANITIZE_STRING);
                            $tertiary_course = filter_var($jsonData['tercourse'], FILTER_SANITIZE_STRING);
                            $tertiary_year_graduated = filter_var($jsonData['teryeargrad'], FILTER_SANITIZE_STRING);
                            $tertiary_level = filter_var($jsonData['terlevel'], FILTER_SANITIZE_STRING);
                            $tertiary_year_last_attended = filter_var($jsonData['teryearattended'], FILTER_SANITIZE_STRING);
                            $tertiary_awards = filter_var($jsonData['terawards'], FILTER_SANITIZE_STRING);

                            $graduate_school = filter_var($jsonData['gradschool'], FILTER_SANITIZE_STRING);
                            $graduate_course = filter_var($jsonData['gradcourse'], FILTER_SANITIZE_STRING);
                            $graduate_year_graduated = filter_var($jsonData['gradyeargrad'], FILTER_SANITIZE_STRING);
                            $graduate_level = filter_var($jsonData['gradlevel'], FILTER_SANITIZE_STRING);
                            $graduate_year_last_attended = filter_var($jsonData['gradyearattended'], FILTER_SANITIZE_STRING);
                            $graduate_awards = filter_var($jsonData['gradawards'], FILTER_SANITIZE_STRING);

    
                            // Insert data into the education table
                            $stmt = $conn->prepare("INSERT INTO educational_background (applicant_id, elementary_school, elementary_course, elementary_year_graduated, elementary_level, elementary_year_last_attended, elementary_awards, 
                            secondary_school, secondary_course, secondary_year_graduated, 
                            secondary_level, secondary_year_last_attended, secondary_awards, 
                            tertiary_school, tertiary_course, tertiary_year_graduated, 
                            tertiary_level, tertiary_year_last_attended, tertiary_awards, 
                            graduate_school, graduate_course, graduate_year_graduated, 
                            graduate_level, graduate_year_last_attended, graduate_awards) 
                            VALUES (:applicant_id, :elementary_school, :elementary_course, :elementary_year_graduated, 
                            :elementary_level, :elementary_year_last_attended, :elementary_awards, 
                            :secondary_school, :secondary_course, :secondary_year_graduated, 
                            :secondary_level, :secondary_year_last_attended, :secondary_awards, 
                            :tertiary_school, :tertiary_course, :tertiary_year_graduated, 
                            :tertiary_level, :tertiary_year_last_attended, :tertiary_awards, 
                            :graduate_school, :graduate_course, :graduate_year_graduated, 
                            :graduate_level, :graduate_year_last_attended, :graduate_awards)");
                    
                            // Bind parameters
                            $stmt->bindParam(':applicant_id', $applicant_id);
                            $stmt->bindParam(':elementary_school', $elementary_school);
                            $stmt->bindParam(':elementary_course', $elementary_course);
                            $stmt->bindParam(':elementary_year_graduated', $elementary_year_graduated);
                            $stmt->bindParam(':elementary_level', $elementary_level);
                            $stmt->bindParam(':elementary_year_last_attended', $elementary_year_last_attended);
                            $stmt->bindParam(':elementary_awards', $elementary_awards);

                            $stmt->bindParam(':secondary_school', $secondary_school);
                            $stmt->bindParam(':secondary_course', $secondary_course);
                            $stmt->bindParam(':secondary_year_graduated', $secondary_year_graduated);
                            $stmt->bindParam(':secondary_level', $secondary_level);
                            $stmt->bindParam(':secondary_year_last_attended', $secondary_year_last_attended);
                            $stmt->bindParam(':secondary_awards', $secondary_awards);

                            $stmt->bindParam(':tertiary_school', $tertiary_school);
                            $stmt->bindParam(':tertiary_course', $tertiary_course);
                            $stmt->bindParam(':tertiary_year_graduated', $tertiary_year_graduated);
                            $stmt->bindParam(':tertiary_level', $tertiary_level);
                            $stmt->bindParam(':tertiary_year_last_attended', $tertiary_year_last_attended);
                            $stmt->bindParam(':tertiary_awards', $tertiary_awards);

                            $stmt->bindParam(':graduate_school', $graduate_school);
                            $stmt->bindParam(':graduate_course', $graduate_course);
                            $stmt->bindParam(':graduate_year_graduated', $graduate_year_graduated);
                            $stmt->bindParam(':graduate_level', $graduate_level);
                            $stmt->bindParam(':graduate_year_last_attended', $graduate_year_last_attended);
                            $stmt->bindParam(':graduate_awards', $graduate_awards);

                            $stmt->execute();
                        }
                        break;
                    
                        case "training":
                            // Check if the necessary variables exist in $jsonData
                            if (
                                isset($jsonData['tvcourse1']) && isset($jsonData['duration1']) &&
                                isset($jsonData['duration.1']) && isset($jsonData['traininst1']) &&
                                isset($jsonData['cert1']) && isset($jsonData['tvcourse2']) &&
                                isset($jsonData['duration2']) && isset($jsonData['duration.2']) &&
                                isset($jsonData['traininst2']) && isset($jsonData['cert2']) &&
                                isset($jsonData['tvcourse3']) && isset($jsonData['duration3']) &&
                                isset($jsonData['duration.3']) && isset($jsonData['traininst3']) &&
                                isset($jsonData['cert3'])
                            ) {
                                // Sanitize and retrieve form data for training courses
                                $course_name_1 = filter_var($jsonData['tvcourse1'], FILTER_SANITIZE_STRING);
                                $course_duration_start_1 = filter_var($jsonData['duration1'], FILTER_SANITIZE_STRING);
                                $course_duration_end_1 = filter_var($jsonData['duration.1'], FILTER_SANITIZE_STRING);
                                $training_institution_1 = filter_var($jsonData['traininst1'], FILTER_SANITIZE_STRING);
                                $certificates_received_1 = filter_var($jsonData['cert1'], FILTER_SANITIZE_STRING);
                                $course_name_2 = filter_var($jsonData['tvcourse2'], FILTER_SANITIZE_STRING);
                                $course_duration_start_2 = filter_var($jsonData['duration2'], FILTER_SANITIZE_STRING);
                                $course_duration_end_2 = filter_var($jsonData['duration.2'], FILTER_SANITIZE_STRING);
                                $training_institution_2 = filter_var($jsonData['traininst2'], FILTER_SANITIZE_STRING);
                                $certificates_received_2 = filter_var($jsonData['cert2'], FILTER_SANITIZE_STRING);
                                $course_name_3 = filter_var($jsonData['tvcourse3'], FILTER_SANITIZE_STRING);
                                $course_duration_start_3 = filter_var($jsonData['duration3'], FILTER_SANITIZE_STRING);
                                $course_duration_end_3 = filter_var($jsonData['duration.3'], FILTER_SANITIZE_STRING);
                                $training_institution_3 = filter_var($jsonData['traininst3'], FILTER_SANITIZE_STRING);
                                $certificates_received_3 = filter_var($jsonData['cert3'], FILTER_SANITIZE_STRING);
                        
                                // Prepare the SQL statement (update table name if needed)
                                $stmt = $conn->prepare("INSERT INTO training (applicant_id, course_name_1, course_duration_start_1, course_duration_end_1, training_institution_1, certificates_received_1, course_name_2, course_duration_start_2, course_duration_end_2, training_institution_2, certificates_received_2, course_name_3, course_duration_start_3, course_duration_end_3, training_institution_3, certificates_received_3) 
                                                VALUES (:applicant_id, :course_name_1, :course_duration_start_1, :course_duration_end_1, :training_institution_1, :certificates_received_1, :course_name_2, :course_duration_start_2, :course_duration_end_2, :training_institution_2, :certificates_received_2, :course_name_3, :course_duration_start_3, :course_duration_end_3, :training_institution_3, :certificates_received_3)");
                        
                                // Bind parameters
                                $stmt->bindParam(':applicant_id', $applicant_id);
                                $stmt->bindParam(':course_name_1', $course_name_1, PDO::PARAM_STR);
                                $stmt->bindParam(':course_duration_start_1', $course_duration_start_1, PDO::PARAM_STR);
                                $stmt->bindParam(':course_duration_end_1', $course_duration_end_1, PDO::PARAM_STR);
                                $stmt->bindParam(':training_institution_1', $training_institution_1, PDO::PARAM_STR);
                                $stmt->bindParam(':certificates_received_1', $certificates_received_1, PDO::PARAM_STR);
                                $stmt->bindParam(':course_name_2', $course_name_2, PDO::PARAM_STR);
                                $stmt->bindParam(':course_duration_start_2', $course_duration_start_2, PDO::PARAM_STR);
                                $stmt->bindParam(':course_duration_end_2', $course_duration_end_2, PDO::PARAM_STR);
                                $stmt->bindParam(':training_institution_2', $training_institution_2, PDO::PARAM_STR);
                                $stmt->bindParam(':certificates_received_2', $certificates_received_2, PDO::PARAM_STR);
                                $stmt->bindParam(':course_name_3', $course_name_3, PDO::PARAM_STR);
                                $stmt->bindParam(':course_duration_start_3', $course_duration_start_3, PDO::PARAM_STR);
                                $stmt->bindParam(':course_duration_end_3', $course_duration_end_3, PDO::PARAM_STR);
                                $stmt->bindParam(':training_institution_3', $training_institution_3, PDO::PARAM_STR);
                                $stmt->bindParam(':certificates_received_3', $certificates_received_3, PDO::PARAM_STR);
                        
                                // Execute the query
                                $stmt->execute();
                            }
                            break;
                        
        
                            case "eligibility":
                                // Handle preference form data
                                if (
                                    isset($jsonData['eligibility1']) && isset($jsonData['rating1']) &&
                                    isset($jsonData['examdate1']) && isset($jsonData['profli1']) &&
                                    isset($jsonData['valid1']) && isset($jsonData['eligibility2']) &&
                                    isset($jsonData['rating2']) && isset($jsonData['examdate2']) &&
                                    isset($jsonData['profli2']) && isset($jsonData['valid2'])
                                ) {
                                    $eligibility1 = filter_var($jsonData['eligibility1'], FILTER_SANITIZE_STRING);
                                    $rating1 = filter_var($jsonData['rating1'], FILTER_SANITIZE_STRING);
                                    $examdate1 = filter_var($jsonData['examdate1'], FILTER_SANITIZE_STRING);
                                    $professional_license1 = filter_var($jsonData['professional_license1'], FILTER_SANITIZE_STRING);
                                    $valid1 = filter_var($jsonData['valid1'], FILTER_SANITIZE_STRING);

                                    // Retrieve form data for eligibility2
                                    $eligibility2 = filter_var($jsonData['eligibility2'], FILTER_SANITIZE_STRING);
                                    $rating2 = filter_var($jsonData['rating2'], FILTER_SANITIZE_STRING);
                                    $examdate2 = filter_var($jsonData['examdate2'], FILTER_SANITIZE_STRING);
                                    $professional_license2 = filter_var($jsonData['professional_license2'], FILTER_SANITIZE_STRING);
                                    $valid2 = filter_var($jsonData['valid2'], FILTER_SANITIZE_STRING);
            
                                    // Insert data into the preference table
                                    // Prepare SQL statement
                                    $stmt = $conn->prepare("INSERT INTO eligibility (applicant_id, eligibility1, rating1, examdate1, professional_license1, valid1, eligibility2, rating2, examdate2, professional_license2, valid2)
                                    VALUES (:applicant_id, :eligibility1, :rating1, :examdate1, :professional_license1, :valid1, :eligibility2, :rating2, :examdate2, :professional_license2, :valid2)");
                                    
                                    
                                    // Bind parameters
                                    $stmt->bindParam(':applicant_id', $applicant_id);
                                    $stmt->bindParam(':eligibility1', $eligibility1);
                                    $stmt->bindParam(':rating1', $rating1);
                                    $stmt->bindParam(':examdate1', $examdate1);
                                    $stmt->bindParam(':professional_license1', $professional_license1);
                                    $stmt->bindParam(':valid1', $valid1);
                                    $stmt->bindParam(':eligibility2', $eligibility2);
                                    $stmt->bindParam(':rating2', $rating2);
                                    $stmt->bindParam(':examdate2', $examdate2);
                                    $stmt->bindParam(':professional_license2', $professional_license2);
                                    $stmt->bindParam(':valid2', $valid2);
        
                                    $stmt->execute();
                                }
                                break;
            
                            case "work_experience":
                                // Handle work_experience form data
                                if (
                                    isset($jsonData['comname1']) && isset($jsonData['comadd1']) &&
                                    isset($jsonData['position1']) && isset($jsonData['indates1']) &&
                                    isset($jsonData['indates.1']) && isset($jsonData['workstat1']) &&
                                    isset($jsonData['comname2']) && isset($jsonData['comadd2']) &&
                                    isset($jsonData['position2']) && isset($jsonData['indates2']) &&
                                    isset($jsonData['indates.2']) && isset($jsonData['workstat2']) &&
                                    isset($jsonData['comname3']) && isset($jsonData['comadd3']) &&
                                    isset($jsonData['position3']) && isset($jsonData['indates3']) &&
                                    isset($jsonData['indates.3']) && isset($jsonData['workstat3']) &&
                                    isset($jsonData['comname4']) && isset($jsonData['comadd4']) &&
                                    isset($jsonData['position4']) && isset($jsonData['indates4']) &&
                                    isset($jsonData['indates.4']) && isset($jsonData['workstat4']) &&
                                    isset($jsonData['comname5']) && isset($jsonData['comadd5']) &&
                                    isset($jsonData['position5']) && isset($jsonData['indates5']) &&
                                    isset($jsonData['indates.5']) && isset($jsonData['workstat5'])
                                ) {
                                   // Sanitize and filter the input data using JSON data
                                    $company_name1 = filter_var($jsonData['comname1'], FILTER_SANITIZE_STRING);
                                    $company_address1 = filter_var($jsonData['comadd1'], FILTER_SANITIZE_STRING);
                                    $position1 = filter_var($jsonData['position1'], FILTER_SANITIZE_STRING);
                                    $inclusive_dates_start1 = filter_var($jsonData['indates1'], FILTER_SANITIZE_STRING);
                                    $inclusive_dates_end1 = filter_var($jsonData['indates.1'], FILTER_SANITIZE_STRING);
                                    $status1 = filter_var($jsonData['workstat1'], FILTER_SANITIZE_STRING);

                                    $company_name2 = filter_var($jsonData['comname2'], FILTER_SANITIZE_STRING);
                                    $company_address2 = filter_var($jsonData['comadd2'], FILTER_SANITIZE_STRING);
                                    $position2 = filter_var($jsonData['position2'], FILTER_SANITIZE_STRING);
                                    $inclusive_dates_start2 = filter_var($jsonData['indates2'], FILTER_SANITIZE_STRING);
                                    $inclusive_dates_end2 = filter_var($jsonData['indates.2'], FILTER_SANITIZE_STRING);
                                    $status2 = filter_var($jsonData['workstat2'], FILTER_SANITIZE_STRING);

                                    $company_name3 = filter_var($jsonData['comname3'], FILTER_SANITIZE_STRING);
                                    $company_address3 = filter_var($jsonData['comadd3'], FILTER_SANITIZE_STRING);
                                    $position3 = filter_var($jsonData['position3'], FILTER_SANITIZE_STRING);
                                    $inclusive_dates_start3 = filter_var($jsonData['indates3'], FILTER_SANITIZE_STRING);
                                    $inclusive_dates_end3 = filter_var($jsonData['indates.3'], FILTER_SANITIZE_STRING);
                                    $status3 = filter_var($jsonData['workstat3'], FILTER_SANITIZE_STRING);

                                    $company_name4 = filter_var($jsonData['comname4'], FILTER_SANITIZE_STRING);
                                    $company_address4 = filter_var($jsonData['comadd4'], FILTER_SANITIZE_STRING);
                                    $position4 = filter_var($jsonData['position4'], FILTER_SANITIZE_STRING);
                                    $inclusive_dates_start4 = filter_var($jsonData['indates4'], FILTER_SANITIZE_STRING);
                                    $inclusive_dates_end4 = filter_var($jsonData['indates.4'], FILTER_SANITIZE_STRING);
                                    $status4 = filter_var($jsonData['workstat4'], FILTER_SANITIZE_STRING);

                                    $company_name5 = filter_var($jsonData['comname5'], FILTER_SANITIZE_STRING);
                                    $company_address5 = filter_var($jsonData['comadd5'], FILTER_SANITIZE_STRING);
                                    $position5 = filter_var($jsonData['position5'], FILTER_SANITIZE_STRING);
                                    $inclusive_dates_start5 = filter_var($jsonData['indates5'], FILTER_SANITIZE_STRING);
                                    $inclusive_dates_end5 = filter_var($jsonData['indates.5'], FILTER_SANITIZE_STRING);
                                    $status5 = filter_var($jsonData['workstat5'], FILTER_SANITIZE_STRING);
        
                                    // Insert data into the language table
                                    $stmt = $conn->prepare("INSERT INTO work_experience (applicant_id, company_name1, company_address1, position1, inclusive_dates_start1, inclusive_dates_end1,status1, company_name2, company_address2, position2, inclusive_dates_start2, inclusive_dates_end2, status2, company_name3, company_address3, position3, inclusive_dates_start3, inclusive_dates_end3, status3, company_name4, company_address4, position4, inclusive_dates_start4, inclusive_dates_end4, status4, company_name5, company_address5, position5, inclusive_dates_start5, inclusive_dates_end5, status5) 
                                    VALUES (:applicant_id, :company_name1, :company_address1, :position1, :inclusive_dates_start1, :inclusive_dates_end1, :status1, :company_name2, :company_address2, :position2, :inclusive_dates_start2, :inclusive_dates_end2, :status2, :company_name3, :company_address3, :position3, :inclusive_dates_start3, :inclusive_dates_end3, :status3, :company_name4, :company_address4, :position4, :inclusive_dates_start4, :inclusive_dates_end4, :status4, :company_name5, :company_address5, :position5, :inclusive_dates_start5, :inclusive_dates_end5, :status5)");
        
                                
                                    // Bind parameters
                                    $stmt->bindParam(':applicant_id', $applicant_id);
                                    $stmt->bindParam(':company_name1', $company_name1, PDO::PARAM_STR);
                                    $stmt->bindParam(':company_address1', $company_address1, PDO::PARAM_STR);
                                    $stmt->bindParam(':position1', $position1, PDO::PARAM_STR);
                                    $stmt->bindParam(':inclusive_dates_start1', $inclusive_dates_start1, PDO::PARAM_STR); // Assuming the date is submitted as a string in the 'mm/yyyy' format
                                    $stmt->bindParam(':inclusive_dates_end1', $inclusive_dates_end1, PDO::PARAM_STR);
                                    $stmt->bindParam(':status1', $status1, PDO::PARAM_STR);

                                    $stmt->bindParam(':company_name2', $company_name2, PDO::PARAM_STR);
                                    $stmt->bindParam(':company_address2', $company_address2, PDO::PARAM_STR);
                                    $stmt->bindParam(':position2', $position2, PDO::PARAM_STR);
                                    $stmt->bindParam(':inclusive_dates_start2', $inclusive_dates_start2, PDO::PARAM_STR);
                                    $stmt->bindParam(':inclusive_dates_end2', $inclusive_dates_end2, PDO::PARAM_STR);
                                    $stmt->bindParam(':status2', $status2, PDO::PARAM_STR);

                                    $stmt->bindParam(':company_name3', $company_name3, PDO::PARAM_STR);
                                    $stmt->bindParam(':company_address3', $company_address3, PDO::PARAM_STR);
                                    $stmt->bindParam(':position3', $position3, PDO::PARAM_STR);
                                    $stmt->bindParam(':inclusive_dates_start3', $inclusive_dates_start3, PDO::PARAM_STR); // Assuming the date is submitted as a string in the 'mm/yyyy' format
                                    $stmt->bindParam(':inclusive_dates_end3', $inclusive_dates_end3, PDO::PARAM_STR);
                                    $stmt->bindParam(':status3', $status3, PDO::PARAM_STR);

                                    $stmt->bindParam(':company_name4', $company_name4, PDO::PARAM_STR);
                                    $stmt->bindParam(':company_address4', $company_address4, PDO::PARAM_STR);
                                    $stmt->bindParam(':position4', $position4, PDO::PARAM_STR);
                                    $stmt->bindParam(':inclusive_dates_start4', $inclusive_dates_start4, PDO::PARAM_STR);
                                    $stmt->bindParam(':inclusive_dates_end4', $inclusive_dates_end4, PDO::PARAM_STR);
                                    $stmt->bindParam(':status4', $status4, PDO::PARAM_STR);

                                    $stmt->bindParam(':company_name5', $company_name5, PDO::PARAM_STR);
                                    $stmt->bindParam(':company_address5', $company_address5, PDO::PARAM_STR);
                                    $stmt->bindParam(':position5', $position5, PDO::PARAM_STR);
                                    $stmt->bindParam(':inclusive_dates_start5', $inclusive_dates_start5, PDO::PARAM_STR); // Assuming the date is submitted as a string in the 'mm/yyyy' format
                                    $stmt->bindParam(':inclusive_dates_end5', $inclusive_dates_end5, PDO::PARAM_STR);
                                    $stmt->bindParam(':status5', $status5, PDO::PARAM_STR);

                
                                    $stmt->execute();
                                }
                                break;
            
                                case "skill":
                                    // Handle skill form data
                                    if (isset($jsonData['selectedSkills']) && is_array($jsonData['selectedSkills'])) {
                                        // Define a skill-to-category mapping
                                        $skillToCategory = [
                                            "Wiring installation" => 1,
                                            "Electrical Troubleshooting" => 1,
                                            "Circuit Design" => 1,
                                            "Electrical Maintenance" => 1,
                                            "Safety Protocol" => 1,
                                            "Renewable Energy Installation" => 1,
                                            "Home Automation" => 1,
                                            "PLC Programming" => 1,
                                            "Energy Efficiency Analysis" => 1,
                                            "Electronics Repair" => 1,
                                            "Electrical Engineering" => 1,
                                            "Solar Panel Installation" => 1,
                                            "Industrial Automation" => 1,
                                            "Electrician" => 1,
                                            "Electrical Sales and Service" => 1,
                                            "Lighting Specialist" => 1,
                                            "Electrical Maintenance Supervisor" => 1,
                                            "Bricklaying"  => 2,
                                            "Block Laying" => 2,
                                            "Plastering" => 2,
                                            "Tile Setting" => 2,
                                            "Concrete Mixing" => 2,
                                            "Stone Masonry" => 2,
                                            "Tiling" => 2,
                                            "Masonry Restoration" => 2,
                                            "Carpentry" => 2,
                                            "Construction Management" => 2,
                                            "Structural Engineering" => 2,
                                            "Landscaping" => 2,
                                            "Masonry Supervisor"  => 2,
                                            "Welding"  => 3,
                                            "Metal Fabrication" => 3,
                                            "Steel Cutting" => 3,
                                            "Blueprint Reading" => 3,
                                            "Structural Steel Installation" => 3,
                                            "Stainless Steel Welding" => 3,
                                            "CNC Plasma Cutting" => 3,
                                            "Sheet Metal Work" => 3,
                                            "Shipbuilding" => 3,
                                            "Metalworking" => 3,
                                            "Structural Engineering" => 3,
                                            "Industrial Design" => 3,
                                            "Pipefitting" => 3,
                                            "Structural Steel Technician" => 3,
                                            "Steelworks Foreman"  => 3,
                                            "Scaffold Assembly"  => 4,
                                            "Safety Procedures" => 4,
                                            "Load Calculation" => 4,
                                            "Scaffold Inspection" => 4,
                                            "Fall Protection" => 4,
                                            "Advanced Rigging" => 4,
                                            "Confined Space Work" => 4,
                                            "Scaffold Design" => 4,
                                            "Rope Access" => 4,
                                            "Construction Safety" => 4,
                                            "Rope access Technician" => 4,
                                            "Industrial Rigging" => 4,
                                            "Safety Management" => 4,
                                            "Scaffolding Supervisor" => 4,
                                            "Safety Officer (with Scaffolding Expertise)" => 4,
                                            "Construction Site Coordinator (with Scaffolding Responsibilities)" => 4,
                                            "Food Preparation" => 5,
                                            "Table Service" => 5,
                                            "Menu Planning" => 5,
                                            "Customer Service" => 5,
                                            "Sommelier Skills" => 5,
                                            "Cocktail Mixing" => 5,
                                            "Pastry Baking" => 5,
                                            "Food Styling" => 5,
                                            "Event Catering" => 5,
                                            "Culinary Arts" => 5,
                                            "Hospitality Management" => 5,
                                            "Event Planning" => 5,
                                            "Restaurant Management" => 5,
                                            "Troubleshooting and Repairing Mechatronic Systems" => 6,
                                            "Reading and Interpreting Technical Drawings and Manuals" => 6,
                                            "Programming and Configuring Automation Systems" => 6,
                                            "Maintaining and Calibrating Sensors and Actuators" => 6,
                                            "Electrical and Electronic Circuit Analysis" => 6,
                                            "Robotics Programming and Control" => 6,
                                            "PLC (Programmable Logic Controller) Programming" => 6,
                                            "Advanced 3D Dodeling and Design" => 6,
                                            "Industrial Automation Integration" => 6,
                                            "Mechatronic Project Management" => 6,
                                            "Electronics Troubleshooting" => 6,
                                            "Mechanical Engineering" => 6,
                                            "Automation Engineering" => 6,
                                            "Control Systems Engineering" => 6,
                                            "Industrial Maintenance" => 6,
                                            "Mechatronics Technician" => 6,
                                            "Crop Planting and Cultivation" => 7,
                                            "Soil Preparation and Fertilization" => 7,
                                            "Pest and Disease Management in Crops" => 7,
                                            "Harvesting and Post-Harvest Handling" => 7,
                                            "Farm Safety and Equipment Operation" => 7,
                                            "Sustainable Agriculture Practices" => 7,
                                            "Organic Farming Techniques" => 7,
                                            "Irrigation System Management" => 7,
                                            "Crop Rotation and Diversification" => 7,
                                            "Soil Analysis and Improvement" => 7,
                                            "Horticulture" => 7,
                                            "Agronomy" => 7,
                                            "Farm Management" => 7,
                                            "Sustainable Agriculture" => 7,
                                            "Crop Science" => 7,
                                            "Agricultural Technician" => 7,
                                            "Farm Supervisor" => 7,
                                            "Diagnosing and Repairing Vehicle Engines" => 8,
                                            "Brake System Maintenance and Repair" => 8,
                                            "Electrical System Troubleshooting" => 8,
                                            "Auto Body Repair and Painting" => 8,
                                            "Wheel Alignment and Balancing" => 8,
                                            "Advanced Engine Diagnostics" => 8,
                                            "Hybrid and Electric Vehicle Maintenance" => 8,
                                            "Automotive Air Conditioning Servicing" => 8,
                                            "Performance Tuning and Modification" => 8,
                                            "Vehicle Safety Inspection" => 8,
                                            "Auto Mechanics" => 8,
                                            "Automotive Engineering" => 8,
                                            "Auto Detailing" => 8,
                                            "Vehicle Electronics" => 8,
                                            "Auto Collision Repair" => 8,
                                            "Automotive Service Advisor" => 8,
                                            "Mixing and Serving Cocktails and Drinks" => 9,
                                            "Customer Service and Communication" => 9,
                                            "Knowledge of Bar Equipment and Tools" => 9,
                                            "Inventory Management and Stock Control" => 9,
                                            "Responsible Alcohol Service" => 9,
                                            "Flair Bartending (Showmanship)" => 9,
                                            "Craft Cocktail Creation" => 9,
                                            "Bar Management and Operation" => 9,
                                            "Wine and Beer Knowledge" => 9,
                                            "Menu Design and Pricing" => 9,
                                            "Hospitality Management" => 9,
                                            "Beverage Management" => 9,
                                            "Customer Relations" => 9,
                                            "Event Planning" => 9,
                                            "Barista Skills" => 9,
                                            "Cocktail Server"  => 9,
                                            "Personal Care for the Elderly and Disabled" => 10,
                                            "Medication Administration" => 10,
                                            "First Aid and Emergency Response" => 10,
                                            "Assisting with Daily Living Activities" => 10,
                                            "Communication and Empathy" => 10,
                                            "Dementia Care" => 10,
                                            "Palliative Care" => 10,
                                            "Pediatric Caregiving" => 10,
                                            "Specialized Medical Equipment Operation" => 10,
                                            "Care Plan Development" => 10,
                                            "Nursing Skills" => 10,
                                            "Home Healthcare" => 10,
                                            "Gerontology" => 10,
                                            "Elderly Care" => 10,
                                            "Medical Terminology" => 10,
                                            "Troubleshooting and Repairing Mechatronic Systems" => 11,
                                            "Reading and Interpreting Technical Diagrams and Schematics" => 11,
                                            "Programming and Configuring Automated Systems" => 11,
                                            "Maintaining Industrial Robots and Automated Machinery" => 11,
                                            "Safety Protocols for Working with Mechatronic Equipment" => 11,
                                            "Designing Mechatronic Systems" => 11,
                                            "PLC (Programmable Logic Controller) Programming" => 11,
                                            "Electrical and Electronic Circuit Analysis" => 11,
                                            "Mechatronic System Integration" => 11,
                                            "Computer-Aided Design (CAD) for Mechatronics" => 11,
                                            "Electronics Troubleshooting" => 11,
                                            "Automation Engineering" => 11,
                                            "Robotics Programming" => 11,
                                            "Industrial Maintenance" => 11,
                                            "Quality Control in Manufacturing"  => 11,
                                            "Calibrating and Maintaining Control Instruments" => 12,
                                            "Analyzing and Interpreting Data from Sensors" => 12,
                                            "Programming and Configuring Control Systems" => 12,
                                            "Troubleshooting Control System Issues" => 12,
                                            "Following Safety Procedures for Working with Instrumentation" => 12,
                                            "Process Control System Design" => 12,
                                            "PLC Programming for Industrial Automation" => 12,
                                            "SCADA (Supervisory Control and Data Acquisition) Operation" => 12,
                                            "Calibration and Tuning of Control Loops" => 12,
                                            "HMI (Human-Machine Interface) Design" => 12,
                                            "Industrial Automation" => 12,
                                            "Electronics Troubleshooting" => 12,
                                            "Chemical Process Control" => 12,
                                            "Electrical Circuit Analysis" => 12,
                                            "Quality Assurance in Manufacturing" => 12,
                                            "Basic Facial and Skincare Treatments" => 13,
                                            "Makeup Application" => 13,
                                            "Nail Care and Manicure/Pedicure" => 13,
                                            "Hair Styling and Cutting" => 13,
                                            "Client Consultation and Communication" => 13,
                                            "Spa and Wellness Treatments" => 13,
                                            "Bridal and Special Occasion Makeup" => 13,
                                            "Hair Coloring and Chemical Treatments" => 13,
                                            "Product Sales and Marketing" => 13,
                                            "Salon Management" => 13,
                                            "Esthetician Skills" => 13,
                                            "Hairdressing Skills" => 13,
                                            "Customer Service" => 13,
                                            "Product Knowledge" => 13,
                                            "Health and Safety Practices" => 13,
                                            "Financial Record-Keeping" => 14,
                                            "Double-Entry Bookkeeping" => 14,
                                            "Preparation of Financial Statements" => 14,
                                            "Tax Compliance" => 14,
                                            "Budgeting and Financial Analysis" => 14,
                                            "Auditing" => 14,
                                            "Payroll Management" => 14,
                                            "Financial Software Proficiency" => 14,
                                            "Financial Reporting" => 14,
                                            "Business Taxation" => 14,
                                            "Accounting Principles" => 14,
                                            "Data Analysis" => 14,
                                            "QuickBooks or other Accounting Software" => 14,
                                            "Attention to Detail" => 14,
                                            "Time Management"  => 14,
                                            "Bread and Pastry Preparation" => 15,
                                            "Baking Techniques" => 15,
                                            "Dough Making" => 15,
                                            "Pastry Decoration" => 15,
                                            "Food Safety and Hygiene" => 15,
                                            "Specialty Baking (e.g., Artisan Bread)" => 15,
                                            "Cake Decoration" => 15,
                                            "Recipe Development" => 15,
                                            "Inventory Management" => 15,
                                            "Entrepreneurship in Baking" => 15,
                                            "Culinary Arts" => 15,
                                            "Food Presentation" => 15,
                                            "Ingredient Knowledge" => 15,
                                            "Kitchen Safety" => 15,
                                            "Customer Service" => 15,
                                            "Carpentry Tools and Equipment Operation" => 16,
                                            "Woodworking and Joinery" => 16,
                                            "Blueprint Reading" => 16,
                                            "Construction and Installation" => 16,
                                            "Safety Procedures in Carpentry" => 16,
                                            "Furniture Making" => 16,
                                            "Cabinet Making" => 16,
                                            "Framing and Structural Carpentry" => 16,
                                            "Project Management" => 16,
                                            "Green Building Practices" => 16,
                                            "Woodworking Skills" => 16,
                                            "Construction Knowledge" => 16,
                                            "Measurement and Math Skills" => 16,
                                            "Problem-Solving in Carpentry" => 16,
                                            "Knowledge of Building Materials" => 16,
                                            "Sterilization Techniques and Equipment Operation" => 17,
                                            "Infection Control and Prevention Protocols"=> 17,
                                            "Instrument Handling and Packaging"=> 17,
                                            "Inventory Management of Sterile Supplies"=> 17,
                                            "Knowledge of Medical Terminology"=> 17,
                                            "Teamwork and Collaboration with Healthcare Professionals"=> 17,
                                            "Quality Assurance in Sterilization Processes"=> 17,
                                            "Compliance with Industry Regulations and Standards"=> 17,
                                            "Troubleshooting Sterilization Equipment"=> 17,
                                            "Record-Keeping and Documentation"=> 17,
                                            "Surgical Technology"=> 17,
                                            "Medical Equipment Maintenance"=> 17,
                                            "Healthcare Administration"=> 17,
                                            "Infection Control Specialist"=> 17,
                                            "Hospital Supply Chain Management" => 17,
                                            "Cleaning and Decontamination of Medical Instruments" => 18,
                                            "Sterilization Methods and Equipment" => 18,
                                            "Inventory Management and Distribution of Sterile Supplies" => 18,
                                            "Compliance with Safety and Hygiene Standards" => 18,
                                            "Record-Keeping and Documentation" => 18,
                                            "Customer Service and Communication with Healthcare Staff" => 18,
                                            "Quality Control and Assurance" => 18,
                                            "Troubleshooting Equipment Issues" => 18,
                                            "Infection Control Protocols" => 18,
                                            "Team Coordination in a Healthcare Setting" => 18,
                                            "Sterile Processing Technician" => 18,
                                            "Healthcare Logistics" => 18,
                                            "Infection Control Specialist" => 18,
                                            "Healthcare Facility Management" => 18,
                                            "Medical Equipment Maintenance"  => 18,
                                            "Hardware and Software Troubleshooting" => 19,
                                            "Operating System Installation and Configuration" => 19,
                                            "Network Setup and Maintenance" => 19,
                                            "Computer Assembly and Disassembly" => 19,
                                            "Basic Programming and Scripting" => 19,
                                            "IT customer Support and Helpdesk Services" => 19,
                                            "Data Recovery and Backup Procedures" => 19,
                                            "Cybersecurity Awareness and Basic Defense" => 19,
                                            "Basic Web Development and Content Management" => 19,
                                            "Hardware Maintenance and Repair" => 19,
                                            "Network Administration" => 19,
                                            "IT support Specialist" => 19,
                                            "System Administration" => 19,
                                            "Computer Repair Technician" => 19,
                                            "Software Development"  => 19,
                                            "Surface Preparation for Painting" => 20,
                                            "Proper Use of Painting Tools and Equipment" => 20,
                                            "Mixing and Matching Paint Colors" => 20,
                                            "Applying Various Painting Techniques" => 20,
                                            "Safety Precautions in painting" => 20,
                                            "Wall and Surface Texture Application" => 20,
                                            "Wallpaper Installation" => 20,
                                            "Decorative Painting and Faux Finishes" => 20,
                                            "Maintenance and Repainting in Construction Projects" => 20,
                                            "Estimation of Paint and Material Requirements" => 20,
                                            "Residential or Commercial Painting" => 20,
                                            "Interior Design and Decorating" => 20,
                                            "Construction Project Management" => 20,
                                            "Industrial Painting and Coating" => 20,
                                            "Environmental Safety and Compliance" => 20,
                                            "Customer Service and Communication Skills" => 21,
                                            "Handling Customer Inquiries and Complaints" => 21,
                                            "Use of Contact Center Software and Tools" => 21,
                                            "Product or Service Knowledge" => 21,
                                            "Multitasking and Time Management" => 21,
                                            "Sales and Upselling Techniques" => 21,
                                            "Script Adherence and Call Handling Protocols" => 21,
                                            "Problem-Solving and Conflict Resolution" => 21,
                                            "Data Entry and Record-Keeping" => 21,
                                            "Multilingual Support and Language Proficiency" => 21,
                                            "Customer Support Representative" => 21,
                                            "Telemarketing and Sales" => 21,
                                            "Call Center Management" => 21,
                                            "CRM Software Operation" => 21,
                                            "Business Process Outsourcing (BPO) Services" => 21,
                                            "Food Preparation and Cooking Techniques" => 22,
                                            "Food Safety and Sanitation" => 22,
                                            "Menu Planning and Costing" => 22,
                                            "Culinary Knife Skills" => 22,
                                            "Presentation of Dishes" => 22,
                                            "Pastry and Baking" => 22,
                                            "International Cuisine Knowledge" => 22,
                                            "Dietary and Nutrition Understanding" => 22,
                                            "Catering and Large-Scale Food Production" => 22,
                                            "Kitchen Management" => 22,
                                            "Hospitality Management" => 22,
                                            "Culinary Arts" => 22,
                                            "Restaurant Management" => 22,
                                            "Nutrition and Dietetics" => 22,
                                            "Food and Beverage Service" => 22,
                                            "Cook" => 22,
                                            "Chef" => 22,
                                            "Sous Chef" => 22,
                                            "Customer Communication and Interaction" => 23,
                                            "Problem-Solving and Conflict Resolution" => 23,
                                            "Handling Customer complaints" => 23,
                                            "Product Knowledge and Information" => 23,
                                            "Time Management" => 23,
                                            "Sales and Upselling Techniques" => 23,
                                            "Multilingual Customer Support" => 23,
                                            "CRM (Customer Relationship Management) Software Usage" => 23,
                                            "Social Media CustomerService" => 23,
                                            "Market Research and Analysis" => 23,
                                            "Retail Management" => 23,
                                            "Sales and Marketing" => 23,
                                            "Call Center Operations" => 23,
                                            "Public Relations" => 23,
                                            "Communication Skills" => 23,
                                            "Customer Service Associate" => 24,
                                            "Customer Support Representative" => 24,
                                            "Service Desk Operator" => 24,
                                            "Pattern making and cutting" => 24,
                                            "Sewing and Stitching Techniques" => 24,
                                            "Fabric Selection and Handling" => 24,
                                            "Garment Fitting and Alteration" => 24,
                                            "Fashion Design Principles" => 24,
                                            "Couture and High-end Fashion" => 24,
                                            "Costume Design" => 24,
                                            "Fashion Illustration" => 24,
                                            "Textile Design" => 24,
                                            "Clothing Customization" => 24,
                                            "Fashion Design" => 24,
                                            "Tailoring" => 24,
                                            "Textile Technology" => 24,
                                            "Clothing Production" => 24,
                                            "Fashion Merchandising" => 24,
                                            "Dressmaker" => 24,
                                            "Vehicle Operation and Control" => 25,
                                            "Road Safety and Traffic Rules Compliance" => 25,
                                            "Defensive Driving Techniques" => 25,
                                            "Vehicle Maintenance and Troubleshooting" => 25,
                                            "Emergency Response" => 25,
                                            "Commercial Driving (e.g., Truck or Bus)" => 25,
                                            "Advanced Driving (e.g., Racing or Fff-road)" => 25,
                                            "Vehicle Fleet Management" => 25,
                                            "Eco-friendly Driving Practices" => 25,
                                            "Ride-sharing or Taxi Services" => 25,
                                            "Automotive Mechanics" => 25,
                                            "Transportation Logistics" => 25,
                                            "Fleet Management" => 25,
                                            "Traffic Management" => 25,
                                            "Emergency Response and First Aid" => 25,
                                            "Professional Driver" => 25,
                                            "Chauffeur" => 25,
                                            "Event Planning and Coordination" => 26,
                                            "Budgeting and Financial Management" => 26,
                                            "Vendor and Supplier Negotiation" => 26,
                                            "Risk Assessment and Management" => 26,
                                            "Marketing and Promotion" => 26,
                                            "Wedding Planning" => 26,
                                            "Conference and Trade show Management" => 26,
                                            "Exhibition Design" => 26,
                                            "Event Technology and AV Management" => 26,
                                            "Sustainable Event Management" => 26,
                                            "Hospitality Management" => 26,
                                            "Public Relations and Marketing" => 26,
                                            "Project Management" => 26,
                                            "Event Design and Decor" => 26,
                                            "Entertainment Industry" => 26,
                                            "Managing Hotel Reservations and Check-ins" => 27,
                                            "Handling Guest Inquiries and Requests" => 27,
                                            "Using Reservation and Front Office Software" => 27,
                                            "Cash Handling and Accounting" => 27,
                                            "Concierge Services" => 27,
                                            "Guest Relations and Problem-solving" => 27,
                                            "Event Coordination and Planning" => 27,
                                            "Sales and Marketing for Hotel Services" => 27,
                                            "Multilingual Communication" => 27,
                                            "Crisis Management" => 27,
                                            "Customer Service" => 27,
                                            "Organization and Time Management" => 27,
                                            "Computer Skills" => 27,
                                            "Adaptability" => 27,
                                            "Conflict Resolution" => 27,
                                            "TIG welding Using Various Metals" => 28,
                                            "Reading and Interpreting Welding Blueprints" => 28,
                                            "Weld Joint Preparation and Fitting" => 28,
                                            "Weld Quality Inspection and Testing" => 28,
                                            "Welding Safety Practices" => 28,
                                            "Welding Automation and Robotics" => 28,
                                            "Weld Procedure Development" => 28,
                                            "Non-destructive Testing Techniques" => 28,
                                            "Metallurgy and Material Properties" => 28,
                                            "Pipe Welding and Specialized Welding Techniques" => 28,
                                            "Precision and Attention to Detail" => 28,
                                            "Hand-eye Coordination" => 28,
                                            "Welding Equipment Operation and Maintenance" => 28,
                                            "Problem-solving in Welding Applications" => 28,
                                            "Occupational Safety" => 28,
                                            "Welder" => 28,
                                            "Welding Inspector" => 28,
                                            "Welding Supervisor" => 28,
                                            "Patient Care and Bedside Manners" => 29,
                                            "Vital Sign Monitoring" => 29,
                                            "Medication Administration" => 29,
                                            "Medical Record Keeping" => 29,
                                            "Infection Control and Hygiene" => 29,
                                            "Nursing Assessments" => 29,
                                            "Emergency Response and CPR" => 29,
                                            "Patient Education" => 29,
                                            "Medical Terminology" => 29,
                                            "Geriatric or Pediatric Care" => 29,
                                            "Empathy and Compassion" => 29,
                                            "Critical Thinking and Decision-making" => 29,
                                            "Teamwork and Collaboration" => 29,
                                            "Communication with Patients and Medical Staff" => 29,
                                            "Stress Management" => 29,
                                            "Healthcare Assistant" => 29,
                                            "Nursing Aide" => 29,
                                            "Patient Care Technician" => 29,
                                            "Operating Forklift Machinery Safely and Efficiently" => 30,
                                            "Load and Unload Materials using a Forklift" => 30,
                                            "Inspection and Maintenance of Forklift Equipment" => 30,
                                            "Understanding Weight Distribution and Load Handling" => 30,
                                            "Adhering to Safety Regulations" => 30,
                                            "Operating other Heavy Equipment (e.g., Cranes, Bulldozers)" => 30,
                                            "Material Handling and Logistics" => 30,
                                            "Warehouse Management" => 30,
                                            "Inventory Control" => 30,
                                            "Forklift Maintenance and Repair" => 30,
                                            "Spatial Awareness" => 30,
                                            "Equipment Maintenance" => 30,
                                            "Attention to Detail" => 30,
                                            "Safety Consciousness" => 30,
                                            "Communication with Coworkers and Supervisors" => 30,
                                            "Forklift Operator" => 30,
                                            "Warehouse Operator" => 30,
                                            "Material Handling Specialist" => 30,
                                            "Operating a Rigid On-highway Dump Truck Safely" => 31,
                                            "Loading and Unloading Materials Efficiently" => 31,
                                            "Properly Maintaining and Inspecting the Vehicle" => 31,
                                            "Following Safety Regulations and Procedures" => 31,
                                            "Maneuvering the Truck on Different Terrains" => 31,
                                            "Basic Vehicle Maintenance and Repair" => 31,
                                            "Understanding Load Distribution and Weight Limits" => 31,
                                            "Effective Communication with Site Personnel" => 31,
                                            "Time Management for Efficient Transport" => 31,
                                            "Basic Navigation and Route Planning" => 31,
                                            "Heavy Equipment Operation (e.g., Excavators, Bulldozers)" => 31,
                                            "Construction Site Safety and Protocols" => 31,
                                            "Material Handling and Logistics" => 31,
                                            "Environmental Awareness and Conservation" => 31,
                                            "Equipment Maintenance and Troubleshooting" => 31,
                                            "Dump Truck Operator" => 31,
                                            "Construction Hauler" => 31,
                                            "Operating a Wheel Loader Effectively" => 32, 
                                            "Loading and Unloading Materials with Precision" => 32,
                                            "Vehicle Inspection and Maintenance" => 32,
                                            "Safety Compliance while Working" => 32,
                                            "Understanding and Following Construction Plans" => 32,
                                            "Equipment Maintenance and Repair" => 32,
                                            "Efficient Material Stockpiling and Management" => 32,
                                            "Communication with Site Supervisors and Workers" => 32,
                                            "Navigation and Terrain Assessment" => 32,
                                            "Operating other Heavy Equipment if Required" => 32,
                                            "Heavy Equipment Operation (e.g., Backhoes, Cranes)" => 32,
                                            "Construction Site Management and Coordination" => 32,
                                            "Material Handling and Logistics" => 32,
                                            "Site Safety and Emergency Pocedures" => 32,
                                            "Environmental Considerations and Sustainable Practices" => 32,
                                            "Providing Traditional Hilot Massages" => 33,
                                            "Assessing clients Physical Conditions" => 33,
                                            "Applying Appropriate Massage Techniques" => 33,
                                            "Promoting Relaxation and Wellness" => 33,
                                            "Maintaining Hygiene and Sanitation" => 33,
                                            "Additional Massage Therapies (e.g., Swedish, Thai)" => 33,
                                            "Customer Service and Client Interaction" => 33,
                                            "Business Management for a Wellness Center" => 33,
                                            "Herbal Medicine Knowledge" => 33,
                                            "Yoga and Meditation Techniques" => 33,
                                            "Spa and Wellness Industry Practices" => 33,
                                            "Anatomy and Physiology" => 33,
                                            "Holistic Health and Wellness Concepts" => 33,
                                            "Aromatherapy and Essential Oils" => 33,
                                            "First Aid and CPR Training" => 33,
                                            "Cleaning and Maintaining Rooms and Common Areas" => 34,
                                            "Making Beds and Arranging Furniture" => 34,
                                            "Proper Waste Disposal and Recycling" => 34,
                                            "Using Cleaning Tools and Chemicals Safely" => 34,
                                            "Responding to Guest Requests Efficiently" => 34,
                                            "Laundry and Fabric Care" => 34,
                                            "Inventory Management for Cleaning Supplies" => 34,
                                            "Team Coordination in a Hotel or Facility" => 34,
                                            "Basic Plumbing and Electrical Maintenance" => 34,
                                            "Guest Service and Communication" => 34,
                                            "Hospitality Industry Knowledge" => 34,
                                            "Sanitation and Hygiene Regulations" => 34,
                                            "Interior Design and Aesthetics" => 34,
                                            "Customer Service and Etiquette" => 34,
                                            "Facility Management and Safety Protocols" => 34,
                                            "Housekeeper" => 34,
                                            "Room Attendant" => 34,
                                            "Cleaning Supervisor" => 34,
                                            "Basic Proficiency in Japanese Language (N4 Level)" => 35,
                                            "Reading and Writing in Hiragana and Katakana" => 35,
                                            "Understanding Everyday Conversations" => 35,
                                            "Cultural Awareness and Etiquette" => 35,
                                            "Basic Travel-related Language Skills" => 35,
                                            "Advanced Japanese Language Proficiency" => 35,
                                            "Translation and Interpretation" => 35,
                                            "Teaching Japanese as a Foreign Language" => 35,
                                            "Business Japanese Communication" => 35,
                                            "In-depth Cultural Studies" => 35,
                                            "Japanese History and Art" => 35,
                                            "Japanese Cuisine and Cooking" => 35,
                                            "Business Culture and Practices in Japan" => 35,
                                            "Japanese Calligraphy and Traditional Arts" => 35,
                                            "Travel Planning and Tourism in Japan" => 35,
                                            "Translator/Interpreter" => 35,
                                            "Basic Japanese Vocabulary and Grammar" => 36,
                                            "Ability to Introduce Oneself and have Simple Conversations" => 36,
                                            "Understanding of Hiragana and Katakana Scripts" => 36,
                                            "Reading and Writing Basic Japanese Characters" => 36,
                                            "Knowledge of Japanese Customs and Culture at a Beginner Level" => 36,
                                            "Improved Language Proficiency to N3 or Higher" => 36,
                                            "Increased Fluency in Spoken Japanese" => 36,
                                            "Advanced Reading and Writing Skills in Japanese" => 36,
                                            "Deeper Understanding of Japanese culture and etiquette" => 36,
                                            "Ability to Work or Study in Japan" => 36,
                                            "Translation and Interpretation" => 36,
                                            "Teaching Japanese as a Foreign Language" => 36,
                                            "International Business and Trade" => 36,
                                            "Tourism and Hospitality in Japan" => 36,
                                            "Localization for Japanese Markets" => 36,
                                            "Language Proficiency Tester" => 36,
                                            "Cultural Exchange Coordinator" => 36,
                                            "Foreign Language Instructor" => 36,
                                            "Financial Analysis and Risk Assessment" => 37,
                                            "Loan Management and Disbursement" => 37,
                                            "Use of Microfinance Software and Technology" => 37,
                                            "Client Relationship Management" => 37,
                                            "Financial Literacy Training" => 37,
                                            "Advanced Financial Analysis and Modeling" => 37,
                                            "Market Research and Expansion Strategies" => 37,
                                            "Development of Financial Products and Services" => 37,
                                            "Regulatory Compliance and Reporting" => 37,
                                            "Microfinance Institution Management" => 37,
                                            "Financial Technology (FinTech) Development" => 37,
                                            "Banking and Financial Services" => 37,
                                            "Social Entrepreneurship" => 37,
                                            "Impact Assessment and Evaluation" => 37,
                                            "Economic Development and Poverty Alleviation" => 37,
                                            "Microfinance Specialist" => 37,
                                            "Loan Officer" => 37,
                                            "Financial Services Representative" => 37,
                                            "Dispensing Prescription Medications Accurately" => 38,
                                            "Patient Counseling on Medication Use" => 38,
                                            "Drug Inventory Management" => 38,
                                            "Compounding and Preparing Pharmaceuticals" => 38,
                                            "Knowledge of Pharmaceutical Laws and Regulations" => 38,
                                            "Clinical Pharmacy and Patient Care" => 38,
                                            "Specialization in Specific Disease Management" => 38,
                                            "Research and Development of New Drugs" => 38,
                                            "Pharmaceutical Quality Control" => 38,
                                            "Pharmacy Business Management" => 38,
                                            "Pharmaceutical Research" => 38,
                                            "Hospital Pharmacy Practice" => 38,
                                            "Regulatory Affairs in the Pharmaceutical Industry" => 38,
                                            "Pharmacovigilance and Drug Safety" => 38,
                                            "Healthcare Management" => 38,
                                            "Pharmacy Technician" => 38,
                                            "Pharmacy Assistant" => 38,
                                            "Dispensary Manager" => 38,
                                            "Installation and Maintenance of Plumbing Systems" => 39,
                                            "Pipefitting and Soldering" => 39,
                                            "Reading Blueprints and Technical Drawings" => 39,
                                            "Basic Knowledge of Water Supply and Drainage Systems" => 39,
                                            "Plumbing Safety Procedures" => 39,
                                            "Advanced Plumbing Techniques (e.g., HVAC Systems)" => 39,
                                            "Water Conservation and Sustainable Plumbing" => 39,
                                            "Specialized Gas Fitting and Piping Skills" => 39,
                                            "Plumbing System Fesign and Planning" => 39,
                                            "Supervision of Plumbing Projects" => 39,
                                            "HVAC (Heating, Ventilation, and Air Conditioning)" => 39,
                                            "Environmental Sustainability in Plumbing" => 39,
                                            "Construction Project Management" => 39,
                                            "Building Codes and Regulations" => 39,
                                            "Facilities Management" => 39,
                                            "Apprentice Plumber" => 39,
                                            "Plumbing Assistant" => 39,
                                            "Pipe Installation Helper" => 39,
                                            "Installation and Repair of Plumbing Systems" => 40,
                                            "Pipe Fitting and Threading" => 40,
                                            "Leak Detection and Repair" => 40,
                                            "Knowledge of Plumbing Codes and Regulations" => 40,
                                            "Pipe Soldering and Welding" => 40,
                                            "Gas Fitting for Appliances" => 40,
                                            "Septic System Installation and Maintenance" => 40,
                                            "Water Heater Installation and Repair" => 40,
                                            "Plumbing System Design" => 40,
                                            "Backflow Prevention System Installation and Testing" => 40,
                                            "Carpentry (for Building Support Structures)" => 40,
                                            "Electrical Work (for Water Heater Connections)" => 40,
                                            "Project Management (for Overseeing Plumbing Projects)" => 40,
                                            "Installation and Maintenance of Domestic Refrigeration and Air Conditioning Systems" => 41,
                                            "Refrigerant Handling and Recovery" => 41,
                                            "Troubleshooting and Repair of Cooling Systems" => 41,
                                            "Electrical and Electronic Control Systems for RAC" => 41,
                                            "Understanding of Safety Practices in RAC Servicing" => 41,
                                            "Commercial HVAC System Servicing" => 41,
                                            "Energy-efficient RAC System Installation" => 41,
                                            "Home Automation Integration with RAC" => 41,
                                            "Solar-powered RAC Systems" => 41,
                                            "Environmental-friendly Refrigerants usage" => 41,
                                            "Electrical Wiring and Troubleshooting" => 41,
                                            "Environmental Regulations Compliance" => 41,
                                            "Customer Service and Communication" => 41,
                                            "Precision Air Conditioning and Computer Room Environmental Control Systems Servicing" => 42,
                                            "Chilled Water System Maintenance" => 42,
                                            "Environmental Monitoring and Control" => 42,
                                            "Advanced Diagnostics for Specialized Cooling Systems" => 42,
                                            "System Optimization for Data Centers and Clean Rooms" => 42,
                                            "Data Center Design and Setup" => 42,
                                            "Fire Suppression Systems for Data Centers" => 42,
                                            "Advanced HVAC System Control Programming" => 42,
                                            "Energy-efficient Cooling Solutions" => 42,
                                            "Emergency Backup Power Systems for RAC" => 42,
                                            "IT Infrastructure Knowledge" => 42,
                                            "Building Management Systems" => 42,
                                            "Disaster Recovery Planning" => 42,
                                            "HVAC Engineer" => 42,
                                            "Refrigeration System Designer" => 42,
                                            "HVAC Project Manager" => 42,
                                            "Scaffolding Setup and Dismantling" => 43,
                                            "Safety Procedures for Working at Heights" => 43,
                                            "Proper use of Scaffold Materials and Tools" => 43,
                                            "Load Distribution and Weight Calculations" => 43,
                                            "Scaffold Inspection and Maintenance" => 43,
                                            "Advanced Scaffold Design" => 43,
                                            "Suspended Scaffolding Systems" => 43,
                                            "Rigging and Hoisting" => 43,
                                            "Fall Protection Techniques" => 43,
                                            "Specialized Scaffolding for Industrial Applications" => 43,
                                            "Construction Site Management" => 43,
                                            "Occupational Safety and Health" => 43,
                                            "Civil Engineering Principles" => 43,
                                            "Scaffolder" => 43,
                                            "Scaffold Supervisor" => 43,
                                            "Scaffold Safety Inspector" => 43,
                                            "SMAW Equipment Setup and Operation" => 44,
                                            "Welding of Fillet and Groove Joints" => 44,
                                            "Interpretation of Welding Symbols and Blueprints" => 44,
                                            "Welding Safety Practices" => 44,
                                            "Metal Preparation and Cleaning for Welding" => 44,
                                            "Welding of Different Materials (e.g., Stainless Steel, Aluminum)" => 44,
                                            "Pipe Welding" => 44,
                                            "Welding Certifications (e.g., AWS)" => 44,
                                            "Welding for Structural Fabrication" => 44,
                                            "Welding Automation and Robotics" => 44,
                                            "Metallurgy and material Science" => 44,
                                            "Blueprint Reading and Interpretation" => 44,
                                            "Non-destructive Testing (NDT)" => 44,
                                            "Welder" => 44,
                                            "Welding Apprentice" => 44,
                                            "Welding Helper" => 44,
                                            "Welding Using Shielded Metal Arc Welding (SMAW) Equipment" => 45,
                                            "Proper Electrode Selection and Handling" => 45,
                                            "Welding Various Joint Configurations and Positions" => 45,
                                            "Visual Inspection of Weld Quality" => 45,
                                            "Safety Protocols for Welding" => 45,
                                            "Welding Different Types of Metals (Steel, Aluminum, etc.)" => 45,
                                            "Interpretation of Welding Symbols and Blueprints" => 45,
                                            "Welding for Structural Fabrication" => 45,
                                            "Maintenance and Repair Welding" => 45,
                                            "Welding in Challenging Environments (Underwater, Confined Spaces)" => 45,
                                            "Gas Metal Arc Welding (GMAW) and Gas Tungsten Arc Welding (GTAW) Skills" => 45,
                                            "Knowledge of Metallurgy and Material Properties" => 45,
                                            "Heat Treatment Techniques" => 45,
                                            "Non-destructive Testing Methods (Ultrasonic Testing, X-rays)" => 45,
                                            "Welding Equipment Maintenance and Troubleshooting" => 45,
                                            "Certified Welder" => 45,
                                            "Welding Inspector" => 45,
                                            "Welding Supervisor" => 45,
                                            "Tile Layout and Design" => 46,
                                            "Cutting and Shaping Tiles" => 46,
                                            "Preparing and Leveling Surfaces for Tile Installation" => 46,
                                            "Proper Mixing and Application of Adhesives and Grout" => 46,
                                            "Setting Tiles in Different Patterns (Herringbone, Diagonal, etc.)" => 46,
                                            "Tile Installation on Walls and Floors" => 46,
                                            "Installation of Mosaic and Decorative Tiles" => 46,
                                            "Precision Cutting for Intricate Tile Designs" => 46,
                                            "Tile Repair and Replacement" => 46,
                                            "Sealing and Finishing Tile Installations" => 46,
                                            "Knowledge of Different Types of Tiles (Ceramic, Porcelain, Glass, etc.)" => 46,
                                            "Grouting Techniques and Color Selection" => 46,
                                            "Waterproofing for Wet Areas (Bathrooms, Kitchens)" => 46,
                                            "Understanding of underlayment materials" => 46,
                                            "Estimation and Cost Calculation for Tile Projects" => 46,
                                            "Flooring Specialist" => 46,
                                            "Training Needs Assessment" => 47,
                                            "Lesson Planning and Instructional Design" => 47,
                                            "Effective Communication and Presentation Skills" => 47,
                                            "Facilitation of Group Discussions and Activities" => 47,
                                            "Assessment and Evaluation of Learners" => 47,
                                            "Use of Multimedia and Technology in Training" => 47,
                                            "Managing a Diverse Group of Learners" => 47,
                                            "Adapting Training Methods to Different Learning Styles" => 47,
                                            "Classroom Management and Time Management" => 47,
                                            "Creating Training Materials (Handouts, Slides)" => 47,
                                            "Adult Learning Principles and Yheories" => 47,
                                            "Training Program Evaluation and Improvement" => 47,
                                            "Conflict Resolution and Problem-solving in a Training Context" => 47,
                                            "Cultural Sensitivity and Inclusion in Training" => 47,
                                            "Legal and Ethical Considerations in Training and Education" => 47,
                                            "Learning and Development Specialist" => 47,
                                            "Training Coordinator"  => 47,
                                        ];
                                
                                        // Prepare the SQL statement for inserting skills
                                        $stmt = $conn->prepare("INSERT INTO skills (applicant_id, skills, category_id) 
                                                               VALUES (:applicant_id, :skills, :category_id)");
                                
                                        foreach ($jsonData['selectedSkills'] as $skill) {
                                            $skill = filter_var($skill, FILTER_SANITIZE_STRING);
                                
                                            // Determine the category ID based on the mapping, or assign a default category
                                            if (array_key_exists($skill, $skillToCategory)) {
                                                $category_id = $skillToCategory[$skill];
                                            } else {
                                                // Assign a default category ID or handle unknown skills as needed
                                                $category_id = 0; // Default category ID, you can change it to another value
                                            }
                                
                                            // Bind parameters and insert data into the skills table for each skill
                                            $stmt->bindParam(':applicant_id', $applicant_id);
                                            $stmt->bindParam(':skills', $skill);
                                            $stmt->bindParam(':category_id', $category_id);
                                            $stmt->execute();
                                        }
                                    }
                                    break;
                                
                    
    
                    default:
                        // Handle unknown form types
                        break;
                }
            }
    
            // After processing the form data, prepare a response
            $response = ["message" => "Form submitted successfully"];
            echo json_encode($response);

            header("Location: applicantHome.php");
            exit; // Make sure to exit to prevent further script execution
        }
        
    }
    
    $conn = null;
    ?>
    
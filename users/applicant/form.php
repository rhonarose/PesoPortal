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
                                            "Scaffold assembly"  => 4,
                                            "Safety procedures" => 4,
                                            "Load calculation" => 4,
                                            "Scaffold inspection" => 4,
                                            "Fall protection" => 4,
                                            "Advanced rigging" => 4,
                                            "Confined space work" => 4,
                                            "Scaffold design" => 4,
                                            "Rope access" => 4,
                                            "Construction safety" => 4,
                                            "Rope access technician" => 4,
                                            "Industrial rigging" => 4,
                                            "Safety management" => 4,
                                            "Scaffolding Supervisor" => 4,
                                            "Safety Officer (with scaffolding expertise)" => 4,
                                            "Construction Site Coordinator (with scaffolding responsibilities)" => 4,
                                            "Food preparation" => 5,
                                            "Table service" => 5,
                                            "Menu planning" => 5,
                                            "Customer service" => 5,
                                            "Sommelier skills" => 5,
                                            "Cocktail mixing" => 5,
                                            "Pastry baking" => 5,
                                            "Food styling" => 5,
                                            "Event catering" => 5,
                                            "Culinary arts" => 5,
                                            "Hospitality management" => 5,
                                            "Event planning" => 5,
                                            "Restaurant management" => 5,
                                            "Troubleshooting and repairing mechatronic systems" => 6,
                                            "Reading and interpreting technical drawings and manuals" => 6,
                                            "Programming and configuring automation systems" => 6,
                                            "Maintaining and calibrating sensors and actuators" => 6,
                                            "Electrical and electronic circuit analysis" => 6,
                                            "Robotics programming and control" => 6,
                                            "PLC (Programmable Logic Controller) programming" => 6,
                                            "Advanced 3D modeling and design" => 6,
                                            "Industrial automation integration" => 6,
                                            "Mechatronic project management" => 6,
                                            "Electronics troubleshooting" => 6,
                                            "Mechanical engineering" => 6,
                                            "Automation engineering" => 6,
                                            "Control systems engineering" => 6,
                                            "Industrial maintenance" => 6,
                                            "Mechatronics Technician" => 6,
                                            "Crop planting and cultivation" => 7,
                                            "Soil preparation and fertilization" => 7,
                                            "Pest and disease management in crops" => 7,
                                            "Harvesting and post-harvest handling" => 7,
                                            "Farm safety and equipment operation" => 7,
                                            "Sustainable agriculture practices" => 7,
                                            "Organic farming techniques" => 7,
                                            "Irrigation system management" => 7,
                                            "Crop rotation and diversification" => 7,
                                            "Soil analysis and improvement" => 7,
                                            "Horticulture" => 7,
                                            "Agronomy" => 7,
                                            "Farm management" => 7,
                                            "Sustainable agriculture" => 7,
                                            "Crop science" => 7,
                                            "Agricultural Technician" => 7,
                                            "Farm Supervisor" => 7,
                                            "Diagnosing and repairing vehicle engines" => 8,
                                            "Brake system maintenance and repair" => 8,
                                            "Electrical system troubleshooting" => 8,
                                            "Auto body repair and painting" => 8,
                                            "Wheel alignment and balancing" => 8,
                                            "Advanced engine diagnostics" => 8,
                                            "Hybrid and electric vehicle maintenance" => 8,
                                            "Automotive air conditioning servicing" => 8,
                                            "Performance tuning and modification" => 8,
                                            "Vehicle safety inspection" => 8,
                                            "Auto mechanics" => 8,
                                            "Automotive engineering" => 8,
                                            "Auto detailing" => 8,
                                            "Vehicle electronics" => 8,
                                            "Auto collision repair" => 8,
                                            "Automotive Service Advisor" => 8,
                                            "Mixing and serving cocktails and drinks" => 9,
                                            "Customer service and communication" => 9,
                                            "Knowledge of bar equipment and tools" => 9,
                                            "Inventory management and stock control" => 9,
                                            "Responsible alcohol service" => 9,
                                            "Flair bartending (showmanship)" => 9,
                                            "Craft cocktail creation" => 9,
                                            "Bar management and operation" => 9,
                                            "Wine and beer knowledge" => 9,
                                            "Menu design and pricing" => 9,
                                            "Hospitality management" => 9,
                                            "Beverage management" => 9,
                                            "Customer relations" => 9,
                                            "Event planning" => 9,
                                            "Barista skills" => 9,
                                            "Cocktail Server"  => 9,
                                            "Personal care for the elderly and disabled" => 10,
                                            "Medication administration" => 10,
                                            "First aid and emergency response" => 10,
                                            "Assisting with daily living activities" => 10,
                                            "Communication and empathy" => 10,
                                            "Dementia care" => 10,
                                            "Palliative care" => 10,
                                            "Pediatric caregiving" => 10,
                                            "Specialized medical equipment operation" => 10,
                                            "Care plan development" => 10,
                                            "Nursing skills" => 10,
                                            "Home healthcare" => 10,
                                            "Gerontology" => 10,
                                            "Elderly care" => 10,
                                            "Medical terminology" => 10,
                                            "Troubleshooting and repairing mechatronic systems" => 11,
                                            "Reading and interpreting technical diagrams and schematics" => 11,
                                            "Programming and configuring automated systems" => 11,
                                            "Maintaining industrial robots and automated machinery" => 11,
                                            "Safety protocols for working with mechatronic equipment" => 11,
                                            "Designing mechatronic systems" => 11,
                                            "PLC (Programmable Logic Controller) programming" => 11,
                                            "Electrical and electronic circuit analysis" => 11,
                                            "Mechatronic system integration" => 11,
                                            "Computer-aided design (CAD) for mechatronics" => 11,
                                            "Electronics troubleshooting" => 11,
                                            "Automation engineering" => 11,
                                            "Robotics programming" => 11,
                                            "Industrial maintenance" => 11,
                                            "Quality control in manufacturing"  => 11,
                                            "Calibrating and maintaining control instruments" => 12,
                                            "Analyzing and interpreting data from sensors" => 12,
                                            "Programming and configuring control systems" => 12,
                                            "Troubleshooting control system issues" => 12,
                                            "Following safety procedures for working with instrumentation" => 12,
                                            "Process control system design" => 12,
                                            "PLC programming for industrial automation" => 12,
                                            "SCADA (Supervisory Control and Data Acquisition) operation" => 12,
                                            "Calibration and tuning of control loops" => 12,
                                            "HMI (Human-Machine Interface) design" => 12,
                                            "Industrial automation" => 12,
                                            "Electronics troubleshooting" => 12,
                                            "Chemical process control" => 12,
                                            "Electrical circuit analysis" => 12,
                                            "Quality assurance in manufacturing" => 12,
                                            "Basic facial and skincare treatments" => 13,
                                            "Makeup application" => 13,
                                            "Nail care and manicure/pedicure" => 13,
                                            "Hair styling and cutting" => 13,
                                            "Client consultation and communication" => 13,
                                            "Spa and wellness treatments" => 13,
                                            "Bridal and special occasion makeup" => 13,
                                            "Hair coloring and chemical treatments" => 13,
                                            "Product sales and marketing" => 13,
                                            "Salon management" => 13,
                                            "Esthetician skills" => 13,
                                            "Hairdressing skills" => 13,
                                            "Customer service" => 13,
                                            "Product knowledge" => 13,
                                            "Health and safety practices" => 13,
                                            "Financial record-keeping" => 14,
                                            "Double-entry bookkeeping" => 14,
                                            "Preparation of financial statements" => 14,
                                            "Tax compliance" => 14,
                                            "Budgeting and financial analysis" => 14,
                                            "Auditing" => 14,
                                            "Payroll management" => 14,
                                            "Financial software proficiency" => 14,
                                            "Financial reporting" => 14,
                                            "Business taxation" => 14,
                                            "Accounting principles" => 14,
                                            "Data analysis" => 14,
                                            "QuickBooks or other accounting software" => 14,
                                            "Attention to detail" => 14,
                                            "Time management"  => 14,
                                            "Bread and pastry preparation" => 15,
                                            "Baking techniques" => 15,
                                            "Dough making" => 15,
                                            "Pastry decoration" => 15,
                                            "Food safety and hygiene" => 15,
                                            "Specialty baking (e.g., artisan bread)" => 15,
                                            "Cake decoration" => 15,
                                            "Recipe development" => 15,
                                            "Inventory management" => 15,
                                            "Entrepreneurship in baking" => 15,
                                            "Culinary arts" => 15,
                                            "Food presentation" => 15,
                                            "Ingredient knowledge" => 15,
                                            "Kitchen safety" => 15,
                                            "Customer service" => 15,
                                            "Carpentry tools and equipment operation" => 16,
                                            "Woodworking and joinery" => 16,
                                            "Blueprint reading" => 16,
                                            "Construction and installation" => 16,
                                            "Safety procedures in carpentry" => 16,
                                            "Furniture making" => 16,
                                            "Cabinet making" => 16,
                                            "Framing and structural carpentry" => 16,
                                            "Project management" => 16,
                                            "Green building practices" => 16,
                                            "Woodworking skills" => 16,
                                            "Construction knowledge" => 16,
                                            "Measurement and math skills" => 16,
                                            "Problem-solving in carpentry" => 16,
                                            "Knowledge of building materials" => 16,
                                            "Sterilization techniques and equipment operation" => 17,
                                            "Infection control and prevention protocols"=> 17,
                                            "Instrument handling and packaging"=> 17,
                                            "Inventory management of sterile supplies"=> 17,
                                            "Knowledge of medical terminology"=> 17,
                                            "Teamwork and collaboration with healthcare professionals"=> 17,
                                            "Quality assurance in sterilization processes"=> 17,
                                            "Compliance with industry regulations and standards"=> 17,
                                            "Troubleshooting sterilization equipment"=> 17,
                                            "Record-keeping and documentation"=> 17,
                                            "Surgical technology"=> 17,
                                            "Medical equipment maintenance"=> 17,
                                            "Healthcare administration"=> 17,
                                            "Infection control specialist"=> 17,
                                            "Hospital supply chain management" => 17,
                                            "Cleaning and decontamination of medical instruments" => 18,
                                            "Sterilization methods and equipment" => 18,
                                            "Inventory management and distribution of sterile supplies" => 18,
                                            "Compliance with safety and hygiene standards" => 18,
                                            "Record-keeping and documentation" => 18,
                                            "Customer service and communication with healthcare staff" => 18,
                                            "Quality control and assurance" => 18,
                                            "Troubleshooting equipment issues" => 18,
                                            "Infection control protocols" => 18,
                                            "Team coordination in a healthcare setting" => 18,
                                            "Sterile processing technician" => 18,
                                            "Healthcare logistics" => 18,
                                            "Infection control specialist" => 18,
                                            "Healthcare facility management" => 18,
                                            "Medical equipment maintenance"  => 18,
                                            "Hardware and software troubleshooting" => 19,
                                            "Operating system installation and configuration" => 19,
                                            "Network setup and maintenance" => 19,
                                            "Computer assembly and disassembly" => 19,
                                            "Basic programming and scripting" => 19,
                                            "IT customer support and helpdesk services" => 19,
                                            "Data recovery and backup procedures" => 19,
                                            "Cybersecurity awareness and basic defense" => 19,
                                            "Basic web development and content management" => 19,
                                            "Hardware maintenance and repair" => 19,
                                            "Network administration" => 19,
                                            "IT support specialist" => 19,
                                            "System administration" => 19,
                                            "Computer repair technician" => 19,
                                            "Software development"  => 19,
                                            "Surface preparation for painting" => 20,
                                            "Proper use of painting tools and equipment" => 20,
                                            "Mixing and matching paint colors" => 20,
                                            "Applying various painting techniques" => 20,
                                            "Safety precautions in painting" => 20,
                                            "Wall and surface texture application" => 20,
                                            "Wallpaper installation" => 20,
                                            "Decorative painting and faux finishes" => 20,
                                            "Maintenance and repainting in construction projects" => 20,
                                            "Estimation of paint and material requirements" => 20,
                                            "Residential or commercial painting" => 20,
                                            "Interior design and decorating" => 20,
                                            "Construction project management" => 20,
                                            "Industrial painting and coating" => 20,
                                            "Environmental safety and compliance" => 20,
                                            "Customer service and communication skills" => 21,
                                            "Handling customer inquiries and complaints" => 21,
                                            "Use of contact center software and tools" => 21,
                                            "Product or service knowledge" => 21,
                                            "Multitasking and time management" => 21,
                                            "Sales and upselling techniques" => 21,
                                            "Script adherence and call handling protocols" => 21,
                                            "Problem-solving and conflict resolution" => 21,
                                            "Data entry and record-keeping" => 21,
                                            "Multilingual support and language proficiency" => 21,
                                            "Customer support representative" => 21,
                                            "Telemarketing and sales" => 21,
                                            "Call center management" => 21,
                                            "CRM software operation" => 21,
                                            "Business process outsourcing (BPO) services" => 21,
                                            "Food preparation and cooking techniques" => 22,
                                            "Food safety and sanitation" => 22,
                                            "Menu planning and costing" => 22,
                                            "Culinary knife skills" => 22,
                                            "Presentation of dishes" => 22,
                                            "Pastry and baking" => 22,
                                            "International cuisine knowledge" => 22,
                                            "Dietary and nutrition understanding" => 22,
                                            "Catering and large-scale food production" => 22,
                                            "Kitchen management" => 22,
                                            "Hospitality management" => 22,
                                            "Culinary arts" => 22,
                                            "Restaurant management" => 22,
                                            "Nutrition and dietetics" => 22,
                                            "Food and beverage service" => 22,
                                            "Cook" => 22,
                                            "Chef" => 22,
                                            "Sous Chef" => 22,
                                            "Customer communication and interaction" => 23,
                                            "Problem-solving and conflict resolution" => 23,
                                            "Handling customer complaints" => 23,
                                            "Product knowledge and information" => 23,
                                            "Time management" => 23,
                                            "Sales and upselling techniques" => 23,
                                            "Multilingual customer support" => 23,
                                            "CRM (Customer Relationship Management) software usage" => 23,
                                            "Social media customer service" => 23,
                                            "Market research and analysis" => 23,
                                            "Retail management" => 23,
                                            "Sales and marketing" => 23,
                                            "Call center operations" => 23,
                                            "Public relations" => 23,
                                            "Communication skills" => 23,
                                            "Customer Service Associate" => 24,
                                            "Customer Support Representative" => 24,
                                            "Service Desk Operator" => 24,
                                            "Pattern making and cutting" => 24,
                                            "Sewing and stitching techniques" => 24,
                                            "Fabric selection and handling" => 24,
                                            "Garment fitting and alteration" => 24,
                                            "Fashion design principles" => 24,
                                            "Couture and high-end fashion" => 24,
                                            "Costume design" => 24,
                                            "Fashion illustration" => 24,
                                            "Textile design" => 24,
                                            "Clothing customization" => 24,
                                            "Fashion design" => 24,
                                            "Tailoring" => 24,
                                            "Textile technology" => 24,
                                            "Clothing production" => 24,
                                            "Fashion merchandising" => 24,
                                            "Dressmaker" => 24,
                                            "Vehicle operation and control" => 25,
                                            "Road safety and traffic rules compliance" => 25,
                                            "Defensive driving techniques" => 25,
                                            "Vehicle maintenance and troubleshooting" => 25,
                                            "Emergency response" => 25,
                                            "Commercial driving (e.g., truck or bus)" => 25,
                                            "Advanced driving (e.g., racing or off-road)" => 25,
                                            "Vehicle fleet management" => 25,
                                            "Eco-friendly driving practices" => 25,
                                            "Ride-sharing or taxi services" => 25,
                                            "Automotive mechanics" => 25,
                                            "Transportation logistics" => 25,
                                            "Fleet management" => 25,
                                            "Traffic management" => 25,
                                            "Emergency response and first aid" => 25,
                                            "Professional Driver" => 25,
                                            "Chauffeur" => 25,
                                            "Event planning and coordination" => 26,
                                            "Budgeting and financial management" => 26,
                                            "Vendor and supplier negotiation" => 26,
                                            "Risk assessment and management" => 26,
                                            "Marketing and promotion" => 26,
                                            "Wedding planning" => 26,
                                            "Conference and trade show management" => 26,
                                            "Exhibition design" => 26,
                                            "Event technology and AV management" => 26,
                                            "Sustainable event management" => 26,
                                            "Hospitality management" => 26,
                                            "Public relations and marketing" => 26,
                                            "Project management" => 26,
                                            "Event design and decor" => 26,
                                            "Entertainment industry" => 26,
                                            "Managing hotel reservations and check-ins" => 27,
                                            "Handling guest inquiries and requests" => 27,
                                            "Using reservation and front office software" => 27,
                                            "Cash handling and accounting" => 27,
                                            "Concierge services" => 27,
                                            "Guest relations and problem-solving" => 27,
                                            "Event coordination and planning" => 27,
                                            "Sales and marketing for hotel services" => 27,
                                            "Multilingual communication" => 27,
                                            "Crisis management" => 27,
                                            "Customer service" => 27,
                                            "Organization and time management" => 27,
                                            "Computer skills" => 27,
                                            "Adaptability" => 27,
                                            "Conflict resolution" => 27,
                                            "TIG welding using various metals" => 28,
                                            "Reading and interpreting welding blueprints" => 28,
                                            "Weld joint preparation and fitting" => 28,
                                            "Weld quality inspection and testing" => 28,
                                            "Welding safety practices" => 28,
                                            "Welding automation and robotics" => 28,
                                            "Weld procedure development" => 28,
                                            "Non-destructive testing techniques" => 28,
                                            "Metallurgy and material properties" => 28,
                                            "Pipe welding and specialized welding techniques" => 28,
                                            "Precision and attention to detail" => 28,
                                            "Hand-eye coordination" => 28,
                                            "Welding equipment operation and maintenance" => 28,
                                            "Problem-solving in welding applications" => 28,
                                            "Occupational safety" => 28,
                                            "Welder" => 28,
                                            "Welding Inspector" => 28,
                                            "Welding Supervisor" => 28,
                                            "Patient care and bedside manners" => 29,
                                            "Vital sign monitoring" => 29,
                                            "Medication administration" => 29,
                                            "Medical record keeping" => 29,
                                            "Infection control and hygiene" => 29,
                                            "Nursing assessments" => 29,
                                            "Emergency response and CPR" => 29,
                                            "Patient education" => 29,
                                            "Medical terminology" => 29,
                                            "Geriatric or pediatric care" => 29,
                                            "Empathy and compassion" => 29,
                                            "Critical thinking and decision-making" => 29,
                                            "Teamwork and collaboration" => 29,
                                            "Communication with patients and medical staff" => 29,
                                            "Stress management" => 29,
                                            "Healthcare Assistant" => 29,
                                            "Nursing Aide" => 29,
                                            "Patient Care Technician" => 29,
                                            "Operating forklift machinery safely and efficiently" => 30,
                                            "Load and unload materials using a forklift" => 30,
                                            "Inspection and maintenance of forklift equipment" => 30,
                                            "Understanding weight distribution and load handling" => 30,
                                            "Adhering to safety regulations" => 30,
                                            "Operating other heavy equipment (e.g., cranes, bulldozers)" => 30,
                                            "Material handling and logistics" => 30,
                                            "Warehouse management" => 30,
                                            "Inventory control" => 30,
                                            "Forklift maintenance and repair" => 30,
                                            "Spatial awareness" => 30,
                                            "Equipment maintenance" => 30,
                                            "Attention to detail" => 30,
                                            "Safety consciousness" => 30,
                                            "Communication with coworkers and supervisors" => 30,
                                            "Forklift Operator" => 30,
                                            "Warehouse Operator" => 30,
                                            "Material Handling Specialist" => 30,
                                            "Operating a rigid on-highway dump truck safely" => 31,
                                            "Loading and unloading materials efficiently" => 31,
                                            "Properly maintaining and inspecting the vehicle" => 31,
                                            "Following safety regulations and procedures" => 31,
                                            "Maneuvering the truck on different terrains" => 31,
                                            "Basic vehicle maintenance and repair" => 31,
                                            "Understanding load distribution and weight limits" => 31,
                                            "Effective communication with site personnel" => 31,
                                            "Time management for efficient transport" => 31,
                                            "Basic navigation and route planning" => 31,
                                            "Heavy equipment operation (e.g., excavators, bulldozers)" => 31,
                                            "Construction site safety and protocols" => 31,
                                            "Material handling and logistics" => 31,
                                            "Environmental awareness and conservation" => 31,
                                            "Equipment maintenance and troubleshooting" => 31,
                                            "Dump Truck Operator" => 31,
                                            "Construction Hauler" => 31,
                                            "Operating a wheel loader effectively" => 32, 
                                            "Loading and unloading materials with precision" => 32,
                                            "Vehicle inspection and maintenance" => 32,
                                            "Safety compliance while working" => 32,
                                            "Understanding and following construction plans" => 32,
                                            "Equipment maintenance and repair" => 32,
                                            "Efficient material stockpiling and management" => 32,
                                            "Communication with site supervisors and workers" => 32,
                                            "Navigation and terrain assessment" => 32,
                                            "Operating other heavy equipment if required" => 32,
                                            "Heavy equipment operation (e.g., backhoes, cranes)" => 32,
                                            "Construction site management and coordination" => 32,
                                            "Material handling and logistics" => 32,
                                            "Site safety and emergency procedures" => 32,
                                            "Environmental considerations and sustainable practices" => 32,
                                            "Providing traditional Hilot massages" => 33,
                                            "Assessing clients’ physical conditions" => 33,
                                            "Applying appropriate massage techniques" => 33,
                                            "Promoting relaxation and wellness" => 33,
                                            "Maintaining hygiene and sanitation" => 33,
                                            "Additional massage therapies (e.g., Swedish, Thai)" => 33,
                                            "Customer service and client interaction" => 33,
                                            "Business management for a wellness center" => 33,
                                            "Herbal medicine knowledge" => 33,
                                            "Yoga and meditation techniques" => 33,
                                            "Spa and wellness industry practices" => 33,
                                            "Anatomy and physiology" => 33,
                                            "Holistic health and wellness concepts" => 33,
                                            "Aromatherapy and essential oils" => 33,
                                            "First aid and CPR training" => 33,
                                            "Cleaning and maintaining rooms and common areas" => 34,
                                            "Making beds and arranging furniture" => 34,
                                            "Proper waste disposal and recycling" => 34,
                                            "Using cleaning tools and chemicals safely" => 34,
                                            "Responding to guest requests efficiently" => 34,
                                            "Laundry and fabric care" => 34,
                                            "Inventory management for cleaning supplies" => 34,
                                            "Team coordination in a hotel or facility" => 34,
                                            "Basic plumbing and electrical maintenance" => 34,
                                            "Guest service and communication" => 34,
                                            "Hospitality industry knowledge" => 34,
                                            "Sanitation and hygiene regulations" => 34,
                                            "Interior design and aesthetics" => 34,
                                            "Customer service and etiquette" => 34,
                                            "Facility management and safety protocols" => 34,
                                            "Housekeeper" => 34,
                                            "Room Attendant" => 34,
                                            "Cleaning Supervisor" => 34,
                                            "Basic proficiency in Japanese language (N4 level)" => 35,
                                            "Reading and writing in Hiragana and Katakana" => 35,
                                            "Understanding everyday conversations" => 35,
                                            "Cultural awareness and etiquette" => 35,
                                            "Basic travel-related language skills" => 35,
                                            "Advanced Japanese language proficiency" => 35,
                                            "Translation and interpretation" => 35,
                                            "Teaching Japanese as a foreign language" => 35,
                                            "Business Japanese communication" => 35,
                                            "In-depth cultural studies" => 35,
                                            "Japanese history and art" => 35,
                                            "Japanese cuisine and cooking" => 35,
                                            "Business culture and practices in Japan" => 35,
                                            "Japanese calligraphy and traditional arts" => 35,
                                            "Travel planning and tourism in Japan" => 35,
                                            "Translator/Interpreter" => 35,
                                            "Basic Japanese vocabulary and grammar" => 36,
                                            "Ability to introduce oneself and have simple conversations" => 36,
                                            "Understanding of hiragana and katakana scripts" => 36,
                                            "Reading and writing basic Japanese characters" => 36,
                                            "Knowledge of Japanese customs and culture at a beginner level" => 36,
                                            "Improved language proficiency to N3 or higher" => 36,
                                            "Increased fluency in spoken Japanese" => 36,
                                            "Advanced reading and writing skills in Japanese" => 36,
                                            "Deeper understanding of Japanese culture and etiquette" => 36,
                                            "Ability to work or study in Japan" => 36,
                                            "Translation and interpretation" => 36,
                                            "Teaching Japanese as a foreign language" => 36,
                                            "International business and trade" => 36,
                                            "Tourism and hospitality in Japan" => 36,
                                            "Localization for Japanese markets" => 36,
                                            "Language Proficiency Tester" => 36,
                                            "Cultural Exchange Coordinator" => 36,
                                            "Foreign Language Instructor" => 36,
                                            "Financial analysis and risk assessment" => 37,
                                            "Loan management and disbursement" => 37,
                                            "Use of microfinance software and technology" => 37,
                                            "Client relationship management" => 37,
                                            "Financial literacy training" => 37,
                                            "Advanced financial analysis and modeling" => 37,
                                            "Market research and expansion strategies" => 37,
                                            "Development of financial products and services" => 37,
                                            "Regulatory compliance and reporting" => 37,
                                            "Microfinance institution management" => 37,
                                            "Financial technology (FinTech) development" => 37,
                                            "Banking and financial services" => 37,
                                            "Social entrepreneurship" => 37,
                                            "Impact assessment and evaluation" => 37,
                                            "Economic development and poverty alleviation" => 37,
                                            "Microfinance Specialist" => 37,
                                            "Loan Officer" => 37,
                                            "Financial Services Representative" => 37,
                                            "Dispensing prescription medications accurately" => 38,
                                            "Patient counseling on medication use" => 38,
                                            "Drug inventory management" => 38,
                                            "Compounding and preparing pharmaceuticals" => 38,
                                            "Knowledge of pharmaceutical laws and regulations" => 38,
                                            "Clinical pharmacy and patient care" => 38,
                                            "Specialization in specific disease management" => 38,
                                            "Research and development of new drugs" => 38,
                                            "Pharmaceutical quality control" => 38,
                                            "Pharmacy business management" => 38,
                                            "Pharmaceutical research" => 38,
                                            "Hospital pharmacy practice" => 38,
                                            "Regulatory affairs in the pharmaceutical industry" => 38,
                                            "Pharmacovigilance and drug safety" => 38,
                                            "Healthcare management" => 38,
                                            "Pharmacy Technician" => 38,
                                            "Pharmacy Assistant" => 38,
                                            "Dispensary Manager" => 38,
                                            "Installation and maintenance of plumbing systems" => 39,
                                            "Pipefitting and soldering" => 39,
                                            "Reading blueprints and technical drawings" => 39,
                                            "Basic knowledge of water supply and drainage systems" => 39,
                                            "Plumbing safety procedures" => 39,
                                            "Advanced plumbing techniques (e.g., HVAC systems)" => 39,
                                            "Water conservation and sustainable plumbing" => 39,
                                            "Specialized gas fitting and piping skills" => 39,
                                            "Plumbing system design and planning" => 39,
                                            "Supervision of plumbing projects" => 39,
                                            "HVAC (Heating, Ventilation, and Air Conditioning)" => 39,
                                            "Environmental sustainability in plumbing" => 39,
                                            "Construction project management" => 39,
                                            "Building codes and regulations" => 39,
                                            "Facilities management" => 39,
                                            "Apprentice Plumber" => 39,
                                            "Plumbing Assistant" => 39,
                                            "Pipe Installation Helper" => 39,
                                            "Installation and repair of plumbing systems" => 40,
                                            "Pipe fitting and threading" => 40,
                                            "Leak detection and repair" => 40,
                                            "Knowledge of plumbing codes and regulations" => 40,
                                            "Pipe soldering and welding" => 40,
                                            "Gas fitting for appliances" => 40,
                                            "Septic system installation and maintenance" => 40,
                                            "Water heater installation and repair" => 40,
                                            "Plumbing system design" => 40,
                                            "Backflow prevention system installation and testing" => 40,
                                            "Carpentry (for building support structures)" => 40,
                                            "Electrical work (for water heater connections)" => 40,
                                            "Project management (for overseeing plumbing projects)" => 40,
                                            "Installation and maintenance of domestic refrigeration and air conditioning systems" => 41,
                                            "Refrigerant handling and recovery" => 41,
                                            "Troubleshooting and repair of cooling systems" => 41,
                                            "Electrical and electronic control systems for RAC" => 41,
                                            "Understanding of safety practices in RAC servicing" => 41,
                                            "Commercial HVAC system servicing" => 41,
                                            "Energy-efficient RAC system installation" => 41,
                                            "Home automation integration with RAC" => 41,
                                            "Solar-powered RAC systems" => 41,
                                            "Environmental-friendly refrigerants usage" => 41,
                                            "Electrical wiring and troubleshooting" => 41,
                                            "Environmental regulations compliance" => 41,
                                            "Customer service and communication" => 41,
                                            "Precision air conditioning and computer room environmental control systems servicing" => 42,
                                            "Chilled water system maintenance" => 42,
                                            "Environmental monitoring and control" => 42,
                                            "Advanced diagnostics for specialized cooling systems" => 42,
                                            "System optimization for data centers and clean rooms" => 42,
                                            "Data center design and setup" => 42,
                                            "Fire suppression systems for data centers" => 42,
                                            "Advanced HVAC system control programming" => 42,
                                            "Energy-efficient cooling solutions" => 42,
                                            "Emergency backup power systems for RAC" => 42,
                                            "IT infrastructure knowledge" => 42,
                                            "Building management systems" => 42,
                                            "Disaster recovery planning" => 42,
                                            "HVAC Engineer" => 42,
                                            "Refrigeration System Designer" => 42,
                                            "HVAC Project Manager" => 42,
                                            "Scaffolding setup and dismantling" => 43,
                                            "Safety procedures for working at heights" => 43,
                                            "Proper use of scaffold materials and tools" => 43,
                                            "Load distribution and weight calculations" => 43,
                                            "Scaffold inspection and maintenance" => 43,
                                            "Advanced scaffold design" => 43,
                                            "Suspended scaffolding systems" => 43,
                                            "Rigging and hoisting" => 43,
                                            "Fall protection techniques" => 43,
                                            "Specialized scaffolding for industrial applications" => 43,
                                            "Construction site management" => 43,
                                            "Occupational safety and health" => 43,
                                            "Civil engineering principles" => 43,
                                            "Scaffolder" => 43,
                                            "Scaffold Supervisor" => 43,
                                            "Scaffold Safety Inspector" => 43,
                                            "SMAW equipment setup and operation" => 44,
                                            "Welding of fillet and groove joints" => 44,
                                            "Interpretation of welding symbols and blueprints" => 44,
                                            "Welding safety practices" => 44,
                                            "Metal preparation and cleaning for welding" => 44,
                                            "Welding of different materials (e.g., stainless steel, aluminum)" => 44,
                                            "Pipe welding" => 44,
                                            "Welding certifications (e.g., AWS)" => 44,
                                            "Welding for structural fabrication" => 44,
                                            "Welding automation and robotics" => 44,
                                            "Metallurgy and material science" => 44,
                                            "Blueprint reading and interpretation" => 44,
                                            "Non-destructive testing (NDT)" => 44,
                                            "Welder" => 44,
                                            "Welding Apprentice" => 44,
                                            "Welding Helper" => 44,
                                            "Welding using shielded metal arc welding (SMAW) equipment" => 45,
                                            "Proper electrode selection and handling" => 45,
                                            "Welding various joint configurations and positions" => 45,
                                            "Visual inspection of weld quality" => 45,
                                            "Safety protocols for welding" => 45,
                                            "Welding different types of metals (steel, aluminum, etc.)" => 45,
                                            "Interpretation of welding symbols and blueprints" => 45,
                                            "Welding for structural fabrication" => 45,
                                            "Maintenance and repair welding" => 45,
                                            "Welding in challenging environments (underwater, confined spaces)" => 45,
                                            "Gas Metal Arc Welding (GMAW) and Gas Tungsten Arc Welding (GTAW) skills" => 45,
                                            "Knowledge of metallurgy and material properties" => 45,
                                            "Heat treatment techniques" => 45,
                                            "Non-destructive testing methods (ultrasonic testing, X-rays)" => 45,
                                            "Welding equipment maintenance and troubleshooting" => 45,
                                            "Certified Welder" => 45,
                                            "Welding Inspector" => 45,
                                            "Welding Supervisor" => 45,
                                            "Tile layout and design" => 46,
                                            "Cutting and shaping tiles" => 46,
                                            "Preparing and leveling surfaces for tile installation" => 46,
                                            "Proper mixing and application of adhesives and grout" => 46,
                                            "Setting tiles in different patterns (herringbone, diagonal, etc.)" => 46,
                                            "Tile installation on walls and floors" => 46,
                                            "Installation of mosaic and decorative tiles" => 46,
                                            "Precision cutting for intricate tile designs" => 46,
                                            "Tile repair and replacement" => 46,
                                            "Sealing and finishing tile installations" => 46,
                                            "Knowledge of different types of tiles (ceramic, porcelain, glass, etc.)" => 46,
                                            "Grouting techniques and color selection" => 46,
                                            "Waterproofing for wet areas (bathrooms, kitchens)" => 46,
                                            "Understanding of underlayment materials" => 46,
                                            "Estimation and cost calculation for tile projects" => 46,
                                            "Flooring Specialist" => 46,
                                            "Training needs assessment" => 47,
                                            "Lesson planning and instructional design" => 47,
                                            "Effective communication and presentation skills" => 47,
                                            "Facilitation of group discussions and activities" => 47,
                                            "Assessment and evaluation of learners" => 47,
                                            "Use of multimedia and technology in training" => 47,
                                            "Managing a diverse group of learners" => 47,
                                            "Adapting training methods to different learning styles" => 47,
                                            "Classroom management and time management" => 47,
                                            "Creating training materials (handouts, slides)" => 47,
                                            "Adult learning principles and theories" => 47,
                                            "Training program evaluation and improvement" => 47,
                                            "Conflict resolution and problem-solving in a training context" => 47,
                                            "Cultural sensitivity and inclusion in training" => 47,
                                            "Legal and ethical considerations in training and education" => 47,
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
    
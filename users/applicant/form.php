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
                        isset($jsonData['sname']) &&
                        isset($jsonData['fname']) &&
                        isset($jsonData['mname']) &&
                        isset($jsonData['suffix']) &&
                        isset($jsonData['bdate']) &&
                        isset($jsonData['bplace']) &&
                        isset($jsonData['sex']) &&
                        isset($jsonData['religion']) &&
                        isset($jsonData['civilstat']) &&
                        isset($jsonData['houseno']) &&
                        isset($jsonData['brgy']) &&
                        isset($jsonData['city']) &&
                        isset($jsonData['province']) &&
                        isset($jsonData['height']) &&
                        isset($jsonData['email']) &&
                        isset($jsonData['landline']) &&
                        isset($jsonData['cpno']) &&
                        isset($jsonData['tin']) &&
                        isset($jsonData['gsis/sss']) &&
                        isset($jsonData['pagibig']) &&
                        isset($jsonData['philhealth']) &&
                        isset($jsonData['disability']) &&
                        isset($jsonData['empstat']) 
                    ) {
                        // Sanitize and retrieve form data for personal_info table
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
                        $disability = filter_var($jsonData['disability'], FILTER_SANITIZE_STRING);
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
                            isset($jsonData['prefoccu1']) &&
                            isset($jsonData['prefoccu2']) &&
                            isset($jsonData['prefoccu3']) &&
                            isset($jsonData['prefoccu4']) &&
                            isset($jsonData['prefloclocal']) &&
                            isset($jsonData['prefloclocal1']) &&
                            isset($jsonData['prefloclocal2']) &&
                            isset($jsonData['prefloclocal3']) &&
                            isset($jsonData['preflocover']) &&
                            isset($jsonData['preflocover1']) &&
                            isset($jsonData['preflocover2']) &&
                            isset($jsonData['preflocover3']) &&
                            isset($jsonData['exsalary']) &&
                            isset($jsonData['passno']) &&
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
                            isset($jsonData['engread']) &&
                            isset($jsonData['engwrite']) &&
                            isset($jsonData['engspeak']) &&
                            isset($jsonData['engunderstand']) &&
                            isset($jsonData['filread']) &&
                            isset($jsonData['filwrite']) &&
                            isset($jsonData['filspeak']) &&
                            isset($jsonData['filunderstand']) &&
                            isset($jsonData['others1']) &&
                            isset($jsonData['otherread']) &&
                            isset($jsonData['otherwrite']) &&
                            isset($jsonData['otherspeak']) &&
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
                            isset($jsonData['elemschool']) &&
                            isset($jsonData['elemcourse']) &&
                            isset($jsonData['elemyeargrad']) &&
                            isset($jsonData['elemlevel']) &&
                            isset($jsonData['elemyearattended']) &&
                            isset($jsonData['elemawards']) &&
                            isset($jsonData['secschool']) &&
                            isset($jsonData['seccourse']) &&
                            isset($jsonData['secyeargrad']) &&
                            isset($jsonData['seclevel']) &&
                            isset($jsonData['secyearattended']) &&
                            isset($jsonData['secawards']) &&
                            isset($jsonData['terschool']) &&
                            isset($jsonData['tercourse']) &&
                            isset($jsonData['teryeargrad']) &&
                            isset($jsonData['terlevel']) &&
                            isset($jsonData['teryearattended']) &&
                            isset($jsonData['terawards']) &&
                            isset($jsonData['gradschool']) &&
                            isset($jsonData['gradcourse']) &&
                            isset($jsonData['gradyeargrad']) &&
                            isset($jsonData['gradlevel']) &&
                            isset($jsonData['gradyearattended']) &&
                            isset($jsonData['gradawards'])
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
                                isset($jsonData['tvcourse1']) &&
                                isset($jsonData['duration1']) &&
                                isset($jsonData['duration.1']) &&
                                isset($jsonData['traininst1']) &&
                                isset($jsonData['cert1']) &&
                                isset($jsonData['tvcourse2']) &&
                                isset($jsonData['duration2']) &&
                                isset($jsonData['duration.2']) &&
                                isset($jsonData['traininst2']) &&
                                isset($jsonData['cert2']) &&
                                isset($jsonData['tvcourse3']) &&
                                isset($jsonData['duration3']) &&
                                isset($jsonData['duration.3']) &&
                                isset($jsonData['traininst3']) &&
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
                                    isset($jsonData['eligibility1']) &&
                                    isset($jsonData['rating1']) &&
                                    isset($jsonData['examdate1']) &&
                                    isset($jsonData['profli1']) &&
                                    isset($jsonData['valid1']) &&
                                    isset($jsonData['eligibility2']) &&
                                    isset($jsonData['rating2']) &&
                                    isset($jsonData['examdate2']) &&
                                    isset($jsonData['profli2']) &&
                                    isset($jsonData['valid2'])
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
                                // Handle education form data
                                if (
                                    isset($jsonData['elemschool']) &&
                                    isset($jsonData['elemcourse']) &&
                                    isset($jsonData['elemyeargrad']) &&
                                    isset($jsonData['elemlevel']) &&
                                    isset($jsonData['elemyearattended']) &&
                                    isset($jsonData['elemawards']) &&
                                    isset($jsonData['secschool']) &&
                                    isset($jsonData['seccourse']) &&
                                    isset($jsonData['secyeargrad']) &&
                                    isset($jsonData['seclevel']) &&
                                    isset($jsonData['secyearattended']) &&
                                    isset($jsonData['secawards']) &&
                                    isset($jsonData['terschool']) &&
                                    isset($jsonData['tercourse']) &&
                                    isset($jsonData['teryeargrad']) &&
                                    isset($jsonData['terlevel']) &&
                                    isset($jsonData['teryearattended']) &&
                                    isset($jsonData['terawards']) &&
                                    isset($jsonData['gradschool']) &&
                                    isset($jsonData['gradcourse']) &&
                                    isset($jsonData['gradyeargrad']) &&
                                    isset($jsonData['gradlevel']) &&
                                    isset($jsonData['gradyearattended']) &&
                                    isset($jsonData['gradawards'])
                                ) {
                                    $auto_mechanic = filter_var($jsonData['automec'], FILTER_VALIDATE_BOOLEAN);
                                    $electrician = filter_var($jsonData['electrician'], FILTER_VALIDATE_BOOLEAN);
                                    $photography = filter_var($jsonData['photography'], FILTER_VALIDATE_BOOLEAN);
                                    $beautician = filter_var($jsonData['beautician'], FILTER_VALIDATE_BOOLEAN);
                                    $embroidery = filter_var($jsonData['embroidery'], FILTER_VALIDATE_BOOLEAN);
                                    $plumbing = filter_var($jsonData['plumbing'], FILTER_VALIDATE_BOOLEAN);
                                    $carpentry_work = filter_var($jsonData['carpentry'], FILTER_VALIDATE_BOOLEAN);
                                    $gardening = filter_var($jsonData['gardening'], FILTER_VALIDATE_BOOLEAN);
                                    $sewing_dresses = filter_var($jsonData['sewing'], FILTER_VALIDATE_BOOLEAN);
                                    $computer_literate = filter_var($jsonData['comlit'], FILTER_VALIDATE_BOOLEAN);
                                    $masonry = filter_var($jsonData['masonry'], FILTER_VALIDATE_BOOLEAN);
                                    $stenography = filter_var($jsonData['stenography'], FILTER_VALIDATE_BOOLEAN);
                                    $domestic_chores = filter_var($jsonData['domestic'], FILTER_VALIDATE_BOOLEAN);
                                    $painter_artist = filter_var($jsonData['artist'], FILTER_VALIDATE_BOOLEAN);
                                    $tailoring = filter_var($jsonData['tailoring'], FILTER_VALIDATE_BOOLEAN);
                                    $driver = filter_var($jsonData['driver'], FILTER_VALIDATE_BOOLEAN);
                                    $painting_jobs = filter_var($jsonData['painting'], FILTER_VALIDATE_BOOLEAN);
                                    $other_skills = filter_var($jsonData['otherskill'], FILTER_SANITIZE_STRING);
            
                                    // Insert data into the education table
                                    $stmt = $conn->prepare("INSERT INTO skills (applicant_id, auto_mechanic, electrician, photography, beautician, embroidery, plumbing, carpentry_work, gardening, sewing_dresses, computer_literate, masonry, stenography, domestic_chores, painter_artist, tailoring, driver, painting_jobs, other_skills) 
                                    VALUES (:applicant_id, :auto_mechanic, :electrician, :photography, :beautician, :embroidery, :plumbing, :carpentry_work, :gardening, :sewing_dresses, :computer_literate, :masonry, :stenography, :domestic_chores, :painter_artist, :tailoring, :driver, :painting_jobs, :other_skills)");

                            
                                    // Bind parameters
                                    $stmt->bindParam(':applicant_id', $applicant_id);
                                    $stmt->bindParam(':auto_mechanic', $auto_mechanic, PDO::PARAM_BOOL);
                                    $stmt->bindParam(':electrician', $electrician, PDO::PARAM_BOOL);
                                    $stmt->bindParam(':photography', $photography, PDO::PARAM_BOOL);
                                    $stmt->bindParam(':beautician', $beautician, PDO::PARAM_BOOL);
                                    $stmt->bindParam(':embroidery', $embroidery, PDO::PARAM_BOOL);
                                    $stmt->bindParam(':plumbing', $plumbing, PDO::PARAM_BOOL);
                                    $stmt->bindParam(':carpentry_work', $carpentry_work, PDO::PARAM_BOOL);
                                    $stmt->bindParam(':gardening', $gardening, PDO::PARAM_BOOL);
                                    $stmt->bindParam(':sewing_dresses', $sewing_dresses, PDO::PARAM_BOOL);
                                    $stmt->bindParam(':computer_literate', $computer_literate, PDO::PARAM_BOOL);
                                    $stmt->bindParam(':masonry', $masonry, PDO::PARAM_BOOL);
                                    $stmt->bindParam(':stenography', $stenography, PDO::PARAM_BOOL);
                                    $stmt->bindParam(':domestic_chores', $domestic_chores, PDO::PARAM_BOOL);
                                    $stmt->bindParam(':painter_artist', $painter_artist, PDO::PARAM_BOOL);
                                    $stmt->bindParam(':tailoring', $tailoring, PDO::PARAM_BOOL);
                                    $stmt->bindParam(':driver', $driver, PDO::PARAM_BOOL);
                                    $stmt->bindParam(':painting_jobs', $painting_jobs, PDO::PARAM_BOOL);
                                    $stmt->bindParam(':other_skills', $other_skills, PDO::PARAM_STR);
        
                                    $stmt->execute();
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
    
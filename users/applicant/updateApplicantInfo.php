
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection file
    require_once "../../config/dbconnect.php";

    // Get the applicant ID from the session (you should set this when the applicant logs in)
    $applicant_id = $_SESSION['applicant_id'];

    // Parse JSON data from the POST request
    $rawData = file_get_contents('php://input');
    $updatedData = json_decode($rawData, true);

    // Handle personal_info form data
    if (
        isset($updatedData['bdate']) && isset($updatedData['bplace']) &&
        isset($updatedData['religion']) && isset($updatedData['civilstat']) &&
        isset($updatedData['houseno']) && isset($updatedData['brgy']) &&
        isset($updatedData['height']) && isset($updatedData['landline']) &&
        isset($updatedData['cpno'])
    ) {
        // Extract the specific fields for update
        $birthdate = filter_var($updatedData['bdate'], FILTER_SANITIZE_STRING);
        $birthplace = filter_var($updatedData['bplace'], FILTER_SANITIZE_STRING);
        $religion = filter_var($updatedData['religion'], FILTER_SANITIZE_STRING);
        $civil_status = filter_var($updatedData['civilstat'], FILTER_SANITIZE_STRING);
        $house_no_street_village = filter_var($updatedData['houseno'], FILTER_SANITIZE_STRING);
        $barangay = filter_var($updatedData['brgy'], FILTER_SANITIZE_STRING);
        $height = filter_var($updatedData['height'], FILTER_SANITIZE_STRING);
        $landline_number = filter_var($updatedData['landline'], FILTER_SANITIZE_STRING);
        $cellphone_number = filter_var($updatedData['cpno'], FILTER_SANITIZE_STRING);

        // Update data in the personal_info table
        $stmt = $conn->prepare("UPDATE personal_info SET
            birthdate = :birthdate,
            birthplace = :birthplace,
            religion = :religion,
            civil_status = :civil_status,
            house_no_street_village = :house_no_street_village,
            barangay = :barangay,
            height = :height,
            landline_number = :landline_number,
            cellphone_number = :cellphone_number
            WHERE applicant_id = :applicant_id");

        $stmt->bindParam(':applicant_id', $applicant_id);
        $stmt->bindParam(':birthdate', $birthdate);
        $stmt->bindParam(':birthplace', $birthplace);
        $stmt->bindParam(':religion', $religion);
        $stmt->bindParam(':civil_status', $civil_status);
        $stmt->bindParam(':house_no_street_village', $house_no_street_village);
        $stmt->bindParam(':barangay', $barangay);
        $stmt->bindParam(':height', $height);
        $stmt->bindParam(':landline_number', $landline_number);
        $stmt->bindParam(':cellphone_number', $cellphone_number);

        $stmt->execute();

        echo "Personal info updated successfully";
    }

    // Handle employment_info form data
    if (
        isset($updatedData['prefoccu1']) && isset($updatedData['prefoccu2']) &&
        isset($updatedData['prefoccu3']) && isset($updatedData['prefoccu4']) &&
        isset($updatedData['prefloclocal1']) && isset($updatedData['prefloclocal2']) && 
        isset($updatedData['prefloclocal3']) && isset($updatedData['preflocover1']) &&
        isset($updatedData['preflocover2']) && isset($updatedData['preflocover3']) 
    ) {
        // Extract the specific fields for update
        $preferred_occupation1 = filter_var($updatedData['prefoccu1'], FILTER_SANITIZE_STRING);
        $preferred_occupation2 = filter_var($updatedData['prefoccu2'], FILTER_SANITIZE_STRING);
        $preferred_occupation3 = filter_var($updatedData['prefoccu3'], FILTER_SANITIZE_STRING);
        $preferred_occupation4 = filter_var($updatedData['prefoccu4'], FILTER_SANITIZE_STRING);
        $local_location1 = filter_var($updatedData['prefloclocal1'], FILTER_SANITIZE_STRING);
        $local_location2 = filter_var($updatedData['prefloclocal2'], FILTER_SANITIZE_STRING);
        $local_location3 = filter_var($updatedData['prefloclocal3'], FILTER_SANITIZE_STRING);
        $overseas_location1 = filter_var($updatedData['preflocover1'], FILTER_SANITIZE_STRING);
        $overseas_location2 = filter_var($updatedData['preflocover2'], FILTER_SANITIZE_STRING);
        $overseas_location3 = filter_var($updatedData['preflocover3'], FILTER_SANITIZE_STRING);

        // Update data in the employment_info table
        $stmt = $conn->prepare("UPDATE preference SET 

                    preferred_occupation1 = :preferred_occupation1,
                    preferred_occupation2 = :preferred_occupation2,
                    preferred_occupation3 = :preferred_occupation3,
                    preferred_occupation4 = :preferred_occupation4,
                    local_location1 = :local_location1,
                    local_location2 = :local_location2,
                    local_location3 = :local_location3,
                    overseas_location1 = :overseas_location1,
                    overseas_location2 = :overseas_location2,
                    overseas_location3 = :overseas_location3
                   
                WHERE applicant_id = :applicant_id");


        $stmt->bindParam(":applicant_id", $applicant_id);
        $stmt->bindParam(":preferred_occupation1", $preferred_occupation1);
        $stmt->bindParam(":preferred_occupation2", $preferred_occupation2);
        $stmt->bindParam(":preferred_occupation3", $preferred_occupation3);
        $stmt->bindParam(":preferred_occupation4", $preferred_occupation4);
        $stmt->bindParam(":local_location1", $local_location1);
        $stmt->bindParam(":local_location2", $local_location2);
        $stmt->bindParam(":local_location3", $local_location3);
        $stmt->bindParam(":overseas_location1", $overseas_location1);
        $stmt->bindParam(":overseas_location2", $overseas_location2);
        $stmt->bindParam(":overseas_location3", $overseas_location3);

        $stmt->execute();

        echo "preference updated successfully";
    }

    if (
        isset($updatedData['tvcourse1']) && isset($updatedData['duration1']) &&
        isset($updatedData['duration.1']) && isset($updatedData['traininst1']) &&
        isset($updatedData['cert1']) && isset($updatedData['tvcourse2']) &&
        isset($updatedData['duration2']) && isset($updatedData['duration.2']) &&
        isset($updatedData['traininst2']) && isset($updatedData['cert2']) &&
        isset($updatedData['tvcourse3']) && isset($updatedData['duration3']) &&
        isset($updatedData['duration.3']) && isset($updatedData['traininst3']) &&
        isset($updatedData['cert3'])
    ) {
        // Sanitize and retrieve form data for training courses
        $course_name_1 = filter_var($updatedData['tvcourse1'], FILTER_SANITIZE_STRING);
        $course_duration_start_1 = filter_var($updatedData['duration1'], FILTER_SANITIZE_STRING);
        $course_duration_end_1 = filter_var($updatedData['duration.1'], FILTER_SANITIZE_STRING);
        $training_institution_1 = filter_var($updatedData['traininst1'], FILTER_SANITIZE_STRING);
        $certificates_received_1 = filter_var($updatedData['cert1'], FILTER_SANITIZE_STRING);
        $course_name_2 = filter_var($updatedData['tvcourse2'], FILTER_SANITIZE_STRING);
        $course_duration_start_2 = filter_var($updatedData['duration2'], FILTER_SANITIZE_STRING);
        $course_duration_end_2 = filter_var($updatedData['duration.2'], FILTER_SANITIZE_STRING);
        $training_institution_2 = filter_var($updatedData['traininst2'], FILTER_SANITIZE_STRING);
        $certificates_received_2 = filter_var($updatedData['cert2'], FILTER_SANITIZE_STRING);
        $course_name_3 = filter_var($updatedData['tvcourse3'], FILTER_SANITIZE_STRING);
        $course_duration_start_3 = filter_var($updatedData['duration3'], FILTER_SANITIZE_STRING);
        $course_duration_end_3 = filter_var($updatedData['duration.3'], FILTER_SANITIZE_STRING);
        $training_institution_3 = filter_var($updatedData['traininst3'], FILTER_SANITIZE_STRING);
        $certificates_received_3 = filter_var($updatedData['cert3'], FILTER_SANITIZE_STRING);

        // Prepare the SQL statement (update table name if needed)
        $stmt = $conn->prepare("UPDATE training SET 

                course_name_1 = :course_name_1,
                course_duration_start_1 = :course_duration_start_1,
                course_duration_end_1 = :course_duration_end_1,
                training_institution_1 = :training_institution_1,
                certificates_received_1 = :certificates_received_1,
                course_name_2 = :course_name_2,
                course_duration_start_2 = :course_duration_start_2,
                course_duration_end_2 = :course_duration_end_2,
                training_institution_2 = :training_institution_2,
                certificates_received_2 = :certificates_received_2,
                course_name_3 = :course_name_3,
                course_duration_start_3 = :course_duration_start_3,
                course_duration_end_3 = :course_duration_end_3,
                training_institution_3 = :training_institution_3,
                certificates_received_3 = :certificates_received_3

                WHERE applicant_id = :applicant_id");

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

        echo "training updated successfully";
    }

    if (
        isset($updatedData['eligibility1']) && isset($updatedData['rating1']) &&
        isset($updatedData['examdate1']) && isset($updatedData['profli1']) &&
        isset($updatedData['valid1']) && isset($updatedData['eligibility2']) &&
        isset($updatedData['rating2']) && isset($updatedData['examdate2']) &&
        isset($updatedData['profli2']) && isset($updatedData['valid2'])
    ) {
        $eligibility1 = filter_var($updatedData['eligibility1'], FILTER_SANITIZE_STRING);
        $rating1 = filter_var($updatedData['rating1'], FILTER_SANITIZE_STRING);
        $examdate1 = filter_var($updatedData['examdate1'], FILTER_SANITIZE_STRING);
        $professional_license1 = filter_var($updatedData['profli1'], FILTER_SANITIZE_STRING);
        $valid1 = filter_var($updatedData['valid1'], FILTER_SANITIZE_STRING);

        // Retrieve form data for eligibility2
        $eligibility2 = filter_var($updatedData['eligibility2'], FILTER_SANITIZE_STRING);
        $rating2 = filter_var($updatedData['rating2'], FILTER_SANITIZE_STRING);
        $examdate2 = filter_var($updatedData['examdate2'], FILTER_SANITIZE_STRING);
        $professional_license2 = filter_var($updatedData['profli2'], FILTER_SANITIZE_STRING);
        $valid2 = filter_var($updatedData['valid2'], FILTER_SANITIZE_STRING);

        // Prepare SQL statement
        $stmt = $conn->prepare("UPDATE eligibility SET 

                                eligibility1 = :eligibility1,
                                rating1 = :rating1,
                                examdate1 = :examdate1,
                                professional_license1 = :professional_license1,
                                valid1 = :valid1,
                                eligibility2 = :eligibility2,
                                rating2 = :rating2,
                                examdate2 = :examdate2,
                                professional_license2 = :professional_license2,
                                valid2 = :valid2

                                WHERE applicant_id = :applicant_id");
        
        
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

        echo "eligibility updated successfully";
    }

    if (
        isset($updatedData['comname1']) && isset($updatedData['comadd1']) &&
        isset($updatedData['position1']) && isset($updatedData['indates1']) &&
        isset($updatedData['indates.1']) && isset($updatedData['workstat1']) &&
        isset($updatedData['comname2']) && isset($updatedData['comadd2']) &&
        isset($updatedData['position2']) && isset($updatedData['indates2']) &&
        isset($updatedData['indates.2']) && isset($updatedData['workstat2']) &&
        isset($updatedData['comname3']) && isset($updatedData['comadd3']) &&
        isset($updatedData['position3']) && isset($updatedData['indates3']) &&
        isset($updatedData['indates.3']) && isset($updatedData['workstat3']) &&
        isset($updatedData['comname4']) && isset($updatedData['comadd4']) &&
        isset($updatedData['position4']) && isset($updatedData['indates4']) &&
        isset($updatedData['indates.4']) && isset($updatedData['workstat4']) &&
        isset($updatedData['comname5']) && isset($updatedData['comadd5']) &&
        isset($updatedData['position5']) && isset($updatedData['indates5']) &&
        isset($updatedData['indates.5']) && isset($updatedData['workstat5'])
    ) {
       // Sanitize and filter the input data using JSON data
        $company_name1 = filter_var($updatedData['comname1'], FILTER_SANITIZE_STRING);
        $company_address1 = filter_var($updatedData['comadd1'], FILTER_SANITIZE_STRING);
        $position1 = filter_var($updatedData['position1'], FILTER_SANITIZE_STRING);
        $inclusive_dates_start1 = filter_var($updatedData['indates1'], FILTER_SANITIZE_STRING);
        $inclusive_dates_end1 = filter_var($updatedData['indates.1'], FILTER_SANITIZE_STRING);
        $status1 = filter_var($updatedData['workstat1'], FILTER_SANITIZE_STRING);

        $company_name2 = filter_var($updatedData['comname2'], FILTER_SANITIZE_STRING);
        $company_address2 = filter_var($updatedData['comadd2'], FILTER_SANITIZE_STRING);
        $position2 = filter_var($updatedData['position2'], FILTER_SANITIZE_STRING);
        $inclusive_dates_start2 = filter_var($updatedData['indates2'], FILTER_SANITIZE_STRING);
        $inclusive_dates_end2 = filter_var($updatedData['indates.2'], FILTER_SANITIZE_STRING);
        $status2 = filter_var($updatedData['workstat2'], FILTER_SANITIZE_STRING);

        $company_name3 = filter_var($updatedData['comname3'], FILTER_SANITIZE_STRING);
        $company_address3 = filter_var($updatedData['comadd3'], FILTER_SANITIZE_STRING);
        $position3 = filter_var($updatedData['position3'], FILTER_SANITIZE_STRING);
        $inclusive_dates_start3 = filter_var($updatedData['indates3'], FILTER_SANITIZE_STRING);
        $inclusive_dates_end3 = filter_var($updatedData['indates.3'], FILTER_SANITIZE_STRING);
        $status3 = filter_var($updatedData['workstat3'], FILTER_SANITIZE_STRING);

        $company_name4 = filter_var($updatedData['comname4'], FILTER_SANITIZE_STRING);
        $company_address4 = filter_var($updatedData['comadd4'], FILTER_SANITIZE_STRING);
        $position4 = filter_var($updatedData['position4'], FILTER_SANITIZE_STRING);
        $inclusive_dates_start4 = filter_var($updatedData['indates4'], FILTER_SANITIZE_STRING);
        $inclusive_dates_end4 = filter_var($updatedData['indates.4'], FILTER_SANITIZE_STRING);
        $status4 = filter_var($updatedData['workstat4'], FILTER_SANITIZE_STRING);

        $company_name5 = filter_var($updatedData['comname5'], FILTER_SANITIZE_STRING);
        $company_address5 = filter_var($updatedData['comadd5'], FILTER_SANITIZE_STRING);
        $position5 = filter_var($updatedData['position5'], FILTER_SANITIZE_STRING);
        $inclusive_dates_start5 = filter_var($updatedData['indates5'], FILTER_SANITIZE_STRING);
        $inclusive_dates_end5 = filter_var($updatedData['indates.5'], FILTER_SANITIZE_STRING);
        $status5 = filter_var($updatedData['workstat5'], FILTER_SANITIZE_STRING);

        // Insert data into the language table
        $stmt = $conn->prepare("UPDATE work_experience SET 

                company_name1 = :company_name1,
                company_address1 = :company_address1,
                position1 = :position1,
                inclusive_dates_start1 = :inclusive_dates_start1,
                inclusive_dates_end1 = :inclusive_dates_end1,
                status1 = :status1,
                company_name2 = :company_name2,
                company_address2 = :company_address2,
                position2 = :position2,
                inclusive_dates_start2 = :inclusive_dates_start2,
                inclusive_dates_end2 = :inclusive_dates_end2,
                status2 = :status2,
                company_name3 = :company_name3,
                company_address3 = :company_address3,
                position3 = :position3,
                inclusive_dates_start3 = :inclusive_dates_start3,
                inclusive_dates_end3 = :inclusive_dates_end3,
                status3 = :status3,
                company_name4 = :company_name4,
                company_address4 = :company_address4,
                position4 = :position4,
                inclusive_dates_start4 = :inclusive_dates_start4,
                inclusive_dates_end4 = :inclusive_dates_end4,
                status4 = :status4,
                company_name5 = :company_name5,
                company_address5 = :company_address5,
                position5 = :position5,
                inclusive_dates_start5 = :inclusive_dates_start5,
                inclusive_dates_end5 = :inclusive_dates_end5,
                status5 = :status5

                WHERE applicant_id = :applicant_id");

    
        // Bind parameters
        $stmt->bindParam(':applicant_id', $applicant_id);
        $stmt->bindParam(':company_name1', $company_name1, PDO::PARAM_STR);
        $stmt->bindParam(':company_address1', $company_address1, PDO::PARAM_STR);
        $stmt->bindParam(':position1', $position1, PDO::PARAM_STR);
        $stmt->bindParam(':inclusive_dates_start1', $inclusive_dates_start1); 
        $stmt->bindParam(':inclusive_dates_end1', $inclusive_dates_end1);
        $stmt->bindParam(':status1', $status1, PDO::PARAM_STR);

        $stmt->bindParam(':company_name2', $company_name2, PDO::PARAM_STR);
        $stmt->bindParam(':company_address2', $company_address2, PDO::PARAM_STR);
        $stmt->bindParam(':position2', $position2, PDO::PARAM_STR);
        $stmt->bindParam(':inclusive_dates_start2', $inclusive_dates_start2);
        $stmt->bindParam(':inclusive_dates_end2', $inclusive_dates_end2);
        $stmt->bindParam(':status2', $status2, PDO::PARAM_STR);

        $stmt->bindParam(':company_name3', $company_name3, PDO::PARAM_STR);
        $stmt->bindParam(':company_address3', $company_address3, PDO::PARAM_STR);
        $stmt->bindParam(':position3', $position3, PDO::PARAM_STR);
        $stmt->bindParam(':inclusive_dates_start3', $inclusive_dates_start3); 
        $stmt->bindParam(':inclusive_dates_end3', $inclusive_dates_end3);
        $stmt->bindParam(':status3', $status3, PDO::PARAM_STR);

        $stmt->bindParam(':company_name4', $company_name4, PDO::PARAM_STR);
        $stmt->bindParam(':company_address4', $company_address4, PDO::PARAM_STR);
        $stmt->bindParam(':position4', $position4, PDO::PARAM_STR);
        $stmt->bindParam(':inclusive_dates_start4', $inclusive_dates_start4);
        $stmt->bindParam(':inclusive_dates_end4', $inclusive_dates_end4);
        $stmt->bindParam(':status4', $status4, PDO::PARAM_STR);

        $stmt->bindParam(':company_name5', $company_name5, PDO::PARAM_STR);
        $stmt->bindParam(':company_address5', $company_address5, PDO::PARAM_STR);
        $stmt->bindParam(':position5', $position5, PDO::PARAM_STR);
        $stmt->bindParam(':inclusive_dates_start5', $inclusive_dates_start5); 
        $stmt->bindParam(':inclusive_dates_end5', $inclusive_dates_end5);
        $stmt->bindParam(':status5', $status5, PDO::PARAM_STR);


        $stmt->execute();

        echo "work experience updated successfully";
    }
}
?>

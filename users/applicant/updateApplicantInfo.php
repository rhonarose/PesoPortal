
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
}
?>

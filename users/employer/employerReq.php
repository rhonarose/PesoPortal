<?php
include('../../config/dbconnect.php'); // Include the database connection details
session_start();

// Load the JSON data from your file
$jsonData = file_get_contents('data.json');
$options = json_decode($jsonData, true); // Convert JSON to associative array


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input data
    $empcontact = filter_input(INPUT_POST, 'empcontact', FILTER_SANITIZE_STRING);
    $website = filter_input(INPUT_POST, 'website', FILTER_SANITIZE_URL);
    $regionCode = filter_input(INPUT_POST, 'region', FILTER_SANITIZE_STRING); // Get the region code
    $regionName = $options[$regionCode]['region_name']; // Get the corresponding region name from the options
    $province = filter_input(INPUT_POST, 'selectedProvince', FILTER_SANITIZE_STRING); // Retrieve from hidden field
    $city = filter_input(INPUT_POST, 'selectedCity', FILTER_SANITIZE_STRING); // Retrieve from hidden field
    $barangay = filter_input(INPUT_POST, 'selectedBarangay', FILTER_SANITIZE_STRING); // Retrieve from hidden field
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

    // Assuming you have authenticated the user and stored relevant session data
    $employer_id = $_SESSION['employer_id'];

    // Check if the data already exists in the database for the employer_id
    $existingDataQuery = "SELECT * FROM employer_info WHERE employer_id = :employer_id";
    $stmt = $conn->prepare($existingDataQuery);
    $stmt->bindParam(':employer_id', $employer_id);
    $stmt->execute();
    $existingData = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$existingData) {
        // Data does not exist, insert it
        $sql = "INSERT INTO employer_info (employer_id, contact_no, employer_website, region, province, city, barangay, description)
                VALUES (:employer_id, :contact_no, :employer_website, :region, :province, :city, :barangay, :description)";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':employer_id', $employer_id);
            $stmt->bindParam(':contact_no', $empcontact);
            $stmt->bindParam(':employer_website', $website);
            $stmt->bindParam(':region', $regionName);
            $stmt->bindParam(':province', $province);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':barangay', $barangay);
            $stmt->bindParam(':description', $description);
            $stmt->execute();

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Data already submitted";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PESO SJDM Portal | Requirements</title>
    
    <link rel="shortcut icon" href="../../img/PESOIcon.png">
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
</head>
<body>
    <?php require_once '../userNavbar.php'; ?>
    <div class="parent">
        <div class="container">
            <div class="background-container"></div>
            <?php require_once 'panelsidebar.php'; ?>
            
            <div class="form-container" id="emp-form">
                <!-- Your content goes here -->
                <h2>Welcome to the Employer Requirements Page</h2>

                <h4 class="direction">*Please note that the following requirements must be submitted in person at the PESO office.*</h4>

                <div class="reqDiv">
                    <div class="requirements-box">
                        <div class="requirements">
                            <h3>Requirements from the Employers / Agencies</h3>
                            <ul>
                                <li>Letter of intent addressed to Mayor</li>
                                <li>Thru Mr. Perfecto Jaime L. Tagalog (OIC)</li>
                                <li>Company Profile</li>
                                <li>Business Permit</li>
                                <li>Certficate of Registration</li>
                                <li>POEA permit to operate (for overseas employment agencies)</li>
                                <li>Listing of job vacancies or opening with job description and vacancy counts</li>
                                <li>Philjobnet registration no pending</li>
                                <li>No pending case certificate</li>
                                <!-- Add your requirements here -->
                            </ul>
                            <h4>Contact Person : Melissa L. Villena</h4>
                            <h4>Phone Number : 0926 674 2728</h4>
                            <h4>Email : peso2016csjdm@gmail.com</h4>
                            <h4>FB Account : pesocsjdm@yahoo.com</h4>
                        </div>
                    </div>
                </div>
            </div>    
        </div> 
    </div>


 <script src="data.json"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {

    // Call the function to disable sidebar items
    disableSidebarItems();
    // Call the function to disable navbar elements
    disableNavbarElements();


    var regionDropdown = document.getElementById('region');
    var provinceDropdown = document.getElementById('province');
    var cityDropdown = document.getElementById('city');
    var barangayDropdown = document.getElementById('barangay');

    var regionOrder = ["CAR", "NCR", "01", "02", "03", "4A", "4B"];

    // Function to populate a dropdown
    function populateDropdown(dropdown, options) {
        dropdown.innerHTML = '';
        options.forEach(function(option) {
            var optionElement = document.createElement('option');
            optionElement.value = option;
            optionElement.textContent = option;
            dropdown.appendChild(optionElement);
        });
    }

    // Event listener for region selection
    regionDropdown.addEventListener('change', function() {
        var selectedRegion = regionDropdown.value;
        var selectedRegionData = jsonData[selectedRegion];
        var provinceList = Object.keys(selectedRegionData.province_list);
        populateDropdown(provinceDropdown, provinceList);
        provinceDropdown.disabled = false; // Enable province dropdown
    });

    // Event listener for province selection
    provinceDropdown.addEventListener('change', function() {
        var selectedRegion = regionDropdown.value;
        var selectedRegionData = jsonData[selectedRegion];
        var selectedProvince = provinceDropdown.value;
        document.getElementById('selectedProvince').value = selectedProvince;
        var cityList = Object.keys(selectedRegionData.province_list[selectedProvince].municipality_list);
        populateDropdown(cityDropdown, cityList);
        cityDropdown.disabled = false; // Enable city dropdown
    });

    // Event listener for city selection
    cityDropdown.addEventListener('change', function() {
        var selectedRegion = regionDropdown.value;
        var selectedRegionData = jsonData[selectedRegion];
        var selectedProvince = provinceDropdown.value;
        var selectedCity = cityDropdown.value;
        document.getElementById('selectedCity').value = selectedCity;
        var barangayList = selectedRegionData.province_list[selectedProvince].municipality_list[selectedCity].barangay_list;
        populateDropdown(barangayDropdown, barangayList);
        barangayDropdown.disabled = false; // Enable barangay dropdown
    });

    // Event listener for barangay selection
    barangayDropdown.addEventListener('change', function() {
        var selectedRegion = regionDropdown.value;
        var selectedRegionData = jsonData[selectedRegion];
        var selectedProvince = provinceDropdown.value;
        var selectedCity = cityDropdown.value;
        var selectedBarangay = barangayDropdown.value; // Get the selected barangay
        document.getElementById('selectedBarangay').value = selectedBarangay;
        // You can now use the selectedBarangay for whatever you need

    });


    // Load JSON data and initialize region dropdown
    fetch('data.json')
    .then(response => response.json())
    .then(data => {
        jsonData = data;

        regionOrder.forEach(function(region) {
            var option = document.createElement('option');
            option.value = region;
            option.textContent = jsonData[region].region_name;
            regionDropdown.appendChild(option);
        });

    })
        .catch(error => console.error('Error loading JSON data:', error));
    });



</script>
</body>
</html>
<?php
include('../../config/dbconnect.php');
session_start();

$jsonData = file_get_contents('data.json');
$options = json_decode($jsonData, true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $empcontact = filter_input(INPUT_POST, 'empcontact', FILTER_SANITIZE_STRING);
    $comname = filter_input(INPUT_POST, 'comname', FILTER_SANITIZE_URL);
    $regionCode = filter_input(INPUT_POST, 'region', FILTER_SANITIZE_STRING);
    $regionName = $options[$regionCode]['region_name'];
    $province = filter_input(INPUT_POST, 'selectedProvince', FILTER_SANITIZE_STRING);
    $city = filter_input(INPUT_POST, 'selectedCity', FILTER_SANITIZE_STRING);
    $barangay = filter_input(INPUT_POST, 'selectedBarangay', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

    $employer_id = $_SESSION['employer_id'];

    $company_logo = ''; // Initialize variable to store the path of the uploaded logo

    if (!empty($_FILES['logo']['name'])) {
        $targetDirectory = 'img/uploads/';
        $company_logo = $targetDirectory . basename($_FILES['logo']['name']);

        if (move_uploaded_file($_FILES['logo']['tmp_name'], $company_logo)) {
            // File uploaded successfully
        } else {
            echo "Error uploading file.";
            // You may want to handle the error more gracefully in a production environment
        }
    }

    $existingDataQuery = "SELECT * FROM employer_info WHERE employer_id = :employer_id";
    $stmt = $conn->prepare($existingDataQuery);
    $stmt->bindParam(':employer_id', $employer_id);
    $stmt->execute();
    $existingData = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$existingData) {
        $sql = "INSERT INTO employer_info (employer_id, contact_no, company_name, region, province, city, barangay, description, company_logo)
                VALUES (:employer_id, :contact_no, :company_name, :region, :province, :city, :barangay, :description, :company_logo)";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':employer_id', $employer_id);
            $stmt->bindParam(':contact_no', $empcontact);
            $stmt->bindParam(':company_name', $comname);
            $stmt->bindParam(':region', $regionName);
            $stmt->bindParam(':province', $province);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':barangay', $barangay);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':company_logo', $company_logo);
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
                <h1>Welcome to the Employer Requirements Page</h1>

                <h2>Employer Information</h2>
                <form action="" method="POST">
                    <table>
                        <tr>
                            <td>
                                <label for="empname">Employer Name:</label><br>
                                <input type="text" id="empnameInput" name="empname" placeholder="Employer Name" value="<?php echo $_SESSION['employer_name']; ?>" readonly> 
                            </td>
                            <td>
                                <label for="region">Region:</label><br>
                                <select id="region" name="region" required>
                                    <option value="" disabled selected hidden>REGION</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="empemail">Employer Email:</label><br>
                                <input type="email" id="empemailInput" name="empemail" placeholder="Email" value="<?php echo $_SESSION['employer_email']; ?>" readonly> 
                            </td>
                            <td>
                                <label for="province">Province:</label><br>
                                <select id="province" name="province" required>
                                    <option value="" disabled selected hidden>PROVINCE</option>
                                </select> <input type="hidden" id="selectedProvince" name="selectedProvince">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="empcontact">Contact Number:</label><br>
                                <input type="text" id="empcontactInput" name="empcontact" placeholder="Contact Number" required> 
                            </td>
                            <td>
                                <label for="city">City:</label><br>
                                <select id="city" name="city" required>
                                    <option value="" disabled selected hidden>CITY</option>
                                </select><input type="hidden" id="selectedCity" name="selectedCity">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="website">Company Name:</label><br>
                                <input type="text" id="comNameInput" name="comname" placeholder="URL"> 
                            </td>
                            <td>
                                <label for="barangay">Barangay:</label><br>
                                <select id="barangay" name="barangay" required>
                                    <option value="" disabled selected hidden>BARANGAY</option>
                                </select><input type="hidden" id="selectedBarangay" name="selectedBarangay">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="comLogo">Company Logo:</label><br>
                                <input type="file" id="logoInput" name="logo" accept="image/*"> <!-- This allows only image files to be selected -->
                            </td>
                            <td>
                                <label for="description">Description:</label><br>
                                <textarea id="descriptionInput" name="description" rows="4" cols="100"></textarea>

                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="butcon">
                                    <input type="submit" id="submitButton" value="SUBMIT">
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>

                <div  id="emp-form">
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


    function previewImage() {
        var fileInput = document.getElementById('comLogo');
        var imagePreview = document.getElementById('imagePreview');

        // Ensure a file is selected
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                imagePreview.src = e.target.result;
            };

            // Read the image file as a data URL
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
</script>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PESO SJDM Portal</title>
    
    <link rel="shortcut icon" href="img/PESOIcon.png">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <?php require_once 'navbar.php'; ?>
    <div class="parent">
        <div class="container">
            <div class="background-container"></div>
            <div class="content1">
                <div class="search-box">
                    <h2 style="margin-bottom: 20px;">Looking for Job?</h2>
                    <form action="#" method="GET" id="searchForm"> 
                        <div class="search-wrapper">
                            <i class="fas fa-search fa-lg"></i>
                            <input type="search" name="searchjob" id="searchjob" placeholder="Search Jobs"> 
                            <button type="submit" id="searchButton">Search</button>
                        </div>
                    </form>
                </div>
                <div class="search-results" id="searchResults">
                    <!-- Simulated Job Search Results -->
                    <div class="search-box1">
                        <form action="#" method="GET" id="searchForm"> 
                            <div class="search-wrapper1">
                                <i class="fas fa-search fa-lg"></i>
                                <input type="search" name="searchjob" id="searchjob" placeholder="Search Jobs"> 
                                <button type="submit" id="searchButton">Search</button>
                            </div>
                        </form>
                    </div>
                    <div class="flex-container">
                        <div class="filters-box">
                            <!-- Filters (Checkboxes) go here -->
                            <h4>Employment Type</h4>
                            <br>
                            <label>
                                <input type="checkbox" name="parttime"> Part Time
                            </label>
                            <br>
                            <label>
                                <input type="checkbox" name="fulltime"> Full Time
                            </label>
                            <br>
                            <label>
                                <input type="checkbox" name="temporary"> Temporary
                            </label>
                            <br>
                            <label>
                                <input type="checkbox" name="seasonal"> Seasonal
                            </label>
                            <!-- Add more filter options as needed -->
                        </div>
                        <div class="results" id="Results">
                            <!-- Simulated Job Search Results -->
                            <!-- Container for job postings -->
                            <div class="job-postings-container">
                                <div class="job-result-item">
                                    <img src="img/PesoLogo.png" alt="Company Logo">
                                    <div class="job-result">
                                        <h3 class="job-result-title">Software Engineer</h3>
                                        <p class="job-result-description">Join our team as a software engineer and work on exciting projects.</p>
                                        <p class="job-result-company">Company: TechCo</p>
                                    </div>
                                </div>
                                <div class="job-result-item">
                                    <img src="img/PesoIcon.png" alt="Company Logo">
                                    <div class="job-result">
                                        <h3 class="job-result-title">Marketing Specialist</h3>
                                        <p class="job-result-description">We are looking for a marketing specialist to promote our products.</p>
                                        <p class="job-result-company">Company: MarketingPro</p>
                                    </div>
                                </div>
                                <div class="job-result-item">
                                    <img src="img/Pesopic.jpg" alt="Company Logo">
                                    <div class="job-result">
                                        <h3 class="job-result-title">Data Analyst</h3>
                                        <p class="job-result-description">We are looking for a data analyst to promote our products.</p>
                                        <p class="job-result-company">Company: AnalyticsCorp.</p>
                                    </div>
                                </div>
                                <div class="job-result-item">
                                    <img src="img/Pesopic.jpg" alt="Company Logo">
                                    <div class="job-result">
                                        <h3 class="job-result-title">Data Analyst</h3>
                                        <p class="job-result-description">We are looking for a data analyst to promote our products.</p>
                                        <p class="job-result-company">Company: AnalyticsCorp.</p>
                                    </div>
                                </div>
                                <!-- Add more job search results here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script> 
        // SAMPLE LANG 
        // SAMPLE LANG RIN  
        document.getElementById("searchButton").addEventListener("click", function () {
            // Hide the search box
            document.querySelector(".search-box").style.display = "none";
            
            // Show the search results div
            document.getElementById("searchResults").style.display = "block";
        });
    </script>
</body>
</html>
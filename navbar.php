<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PESO SJDM Portal</title>

    
    <link rel="shortcut icon" href="img/PESOicon.png">
    <style>
        /* Reset some default styles */
        body {
            margin-top: 70px; /* Adjust this value according to your navbar's height */
        }

        /* Top Navigation Styles */
        .topnav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background-color: #2B65E2;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 15px;
            z-index: 100; /* Ensure the navigation bar appears above other content */
        }

        .topnav a {
            color: black;
            text-decoration: none;
            font-size: 16px;
            margin: 0 15px;
            position: relative;
        }

        .topnav-right a::before {
            content: "";
            position: absolute;
            width: 130%; /* Extend the border across the full width of the topnav element */
            height: 3px;
            bottom: -10px; /* Adjust the bottom value to add padding */
            left: -12%; /* Center the border */
            background-color: #000;
            transform: scaleX(0);
            transform-origin: center;
            transition: transform 0.2s ease;
        }

        .topnav-right a:hover::before,
        .topnav-right a.active::before {
            transform: scaleX(1);
        }

        .topnav .peso {
            display: flex;
            align-items: center;
        }

        .topnav .peso img {
            height: 50px;
            margin-right: 5px;
        }

        .topnav-right {
            display: flex;
            align-items: center;
            margin-right: 10px;
        }

        .topnav-right button {
            margin-left: 15px;
            padding: 10px 20px;
            background-color: white;
            color: black;
            border: solid black;
            border-radius: 15px;
            cursor: pointer;
            font-size: 16px;
        }

        .topnav-right button:hover {
            transform: translateY(-5px);
        }

        /* Hamburger Menu Styles */
        .toggle-button {
            display: none;
            background-color: #2B65E2;
            color: black;
            border: none;
            cursor: pointer;
            margin-right: 15px;
            font-size: 18px;
      
        } 

        /* Responsive Styles */
        @media screen and (max-width: 920px) {

            .toggle-button {
                display: block;
                margin-right: 4px;
            }

            .topnav {
                padding: 6px;
            }

            .topnav-right {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 60px;
                left: 0;
                background-color: #2B65E2;
                width: 100%;
                text-align: center;
                z-index: 2;
            }

            .topnav-right.active {
                display: flex;
            }

            .topnav a {
                margin: 10px 0;
            }

            .topnav-buttons {
                display: flex;
                flex-direction: row; /* Place buttons next to each other horizontally */
                margin-top: 13px;
            }

            .topnav-buttons button {
                margin-left: 10px; /* Adjust the spacing between buttons */
            }
        }

        @media screen and (max-width: 500px) {

            .topnav a {
                font-size: 14px; /* Adjust the font size for smaller screens */
            }

            .topnav-right button {
                font-size: 14px; /* Adjust the font size for smaller screens */
            }
            
            /* Optionally, you can adjust other styles as needed for mobile view */
            .topnav {
                padding-top: 12px; /* Adjust the padding for better spacing in mobile view */
            }

            .peso h1 {
                font-size: 20px; /* Adjust the font size for smaller screens */
                margin: 0; /* Remove margin for better spacing */
            }

            .topnav .peso img {
                height: 45px; /* Adjust the height to your preference */
                margin-right: 5px;
            }
        }

        @media screen and (max-width: 366px) {
        .topnav a {
            font-size: 12px; /* Adjust the font size for smaller screens */
        }

        .topnav-right {
                top: 70px;
            }

        .topnav-right button {
            font-size: 12px; /* Adjust the font size for smaller screens */
        }

        .topnav {
                padding-top: 15px; /* Adjust the padding for better spacing in mobile view */
            }

        .peso h1 {
            font-size: 16px; /* Adjust the font size for smaller screens */
            margin: 0; /* Remove margin for better spacing */
        }

        .topnav .peso img {
            height: 35px; /* Adjust the height to your preference */
            margin-right: 3px;
        }
        }

    </style>
</head>
<body>
    <header>
        <div class="topnav">
            <div class="peso">
                <img src="img/SJDMLogo.png" alt="SJDM Logo" style="margin-left: 10px;">
                <img src="img/PESOLogo.png" alt="PESOSJDM Logo">
                <a href="index.php"><h1>PESO SJDM Portal</h1></a>
            </div>
            <div class="topnav-right">
                <a href="index.php">Home</a>
                <a href="#jobs">Jobs</a>
                <a href="about.php">About</a>
                <div class="topnav-buttons">
                    <button onclick="window.location.href = 'login.php';"><b>Login</b></button>
                    <button onclick="window.location.href = 'signup.php';"><b>Signup</b></button>
                </div>
            </div>
            <button class="toggle-button" onclick="toggleNav()"><b>&#9776;</b></button> <!-- Hamburger icon -->
        </div>
    </header>
    
    <script>
        // Add this script to handle click events and set the active class based on the URL
        var topnavLinks = document.querySelectorAll('.topnav-right a');

        function setActiveLink() {
            var currentURL = window.location.href;
            topnavLinks.forEach(function (link) {
                if (link.href === currentURL) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
        }

        // Check the URL on page load and set the active link
        setActiveLink();

        // Add click event listener to links
        topnavLinks.forEach(function (link) {
            link.addEventListener('click', function (event) {
                // Prevent the default link behavior
                event.preventDefault();

                // Set the active link
                setActiveLink();

                // Navigate to the clicked link's URL
                window.location.href = link.href;
            });
        });

        // Function to toggle the navigation menu
        function toggleNav() {
            var navMenu = document.querySelector('.topnav-right');
            navMenu.classList.toggle('active');
        }
    </script>
</body>
</html>
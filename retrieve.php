<?php
session_start();

// Initialize the session
if(!$_SESSION["logged_in"]){
    header("location: signup.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Dontharaveni Rajender">
	<meta name="description" content="Contacts Viewer">
	<meta name="keywords" content="Contacts Viewer, Retrieve Page, vcequestionpapers, Dontharaveni Rajender">
    <title>Contacts Viewer Retrieve Page</title>
    <link rel='icon' href='https://r.mobirisesite.com/757077/assets/images/gd988c37b5856e2e59bc61db248bd-h_m1ue2up7.png' type='image/x-icon'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-size: 400% 400%;
            animation: gradientBackground 10s ease infinite;
        }
        @keyframes stripeAnimation {
    0% {
        background: repeating-linear-gradient(
            45deg,
            #ff5f6d,
            #ff5f6d 10px,
            #fc5c7d 10px,
            #fc5c7d 20px
        );
    }
    25% {
        background: repeating-linear-gradient(
            45deg,
            #ff5f6d,
            #ff5f6d 10px,
            #fc5c7d 10px,
            #fc5c7d 20px
        );
    }
    50% {
        background: repeating-linear-gradient(
            45deg,
            #ff5f6d,
            #ff5f6d 10px,
            #fc5c7d 10px,
            #fc5c7d 20px
        );
    }
    75% {
        background: repeating-linear-gradient(
            45deg,
            #ff5f6d,
            #ff5f6d 10px,
            #fc5c7d 10px,
            #fc5c7d 20px
        );
    }
    100% {
        background: repeating-linear-gradient(
            45deg,
            #ff5f6d,
            #ff5f6d 10px,
            #fc5c7d 10px,
            #fc5c7d 20px
        );
    }
}

body {
    animation: stripeAnimation 8s ease infinite;
    background-size: 200% 200%; /* Make the stripes larger for a smooth transition */
}

        @keyframes gradientBackground {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 50px;
            flex-wrap: wrap;
            padding: 20px;
            max-width: 1200px;
            margin: auto;
        }

        .card {
            position: relative;
            width: 350px;
            height: 250px;
            border-radius: 20px;
            background: #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            overflow: hidden;
            transition: all 0.5s ease;
        }

        .card:hover {
            transform: translateY(-15px) scale(1.05);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: rgba(255, 255, 255, 0.05);
            transform: rotate(45deg);
            transition: 0.7s;
            z-index: 0;
        }

        .card:hover::before {
            transform: rotate(0deg);
        }

        .card .content {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .card button {
            background: linear-gradient(45deg, #42a5f5, #478ed1);
            border: none;
            padding: 15px 40px;
            color: white;
            font-size: 16px;
            border-radius: 30px;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .card button:hover {
            background: linear-gradient(45deg, #478ed1, #5d78ee);
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            transform: scale(1.1);
        }

        .card h2 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #333;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .container {
                gap: 30px;
            }

            .card {
                width: 320px;
                height: 230px;
            }

            .card button {
                font-size: 14px;
                padding: 12px 35px;
            }
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                gap: 20px;
            }

            .card {
                width: 90%;
            }
        }

        @media (max-width: 480px) {
            .card {
                width: 100%;
            }

            .card button {
                font-size: 12px;
                padding: 10px 30px;
            }

            .card h2 {
                font-size: 20px;
            }
        }
        /* Keep all the previous styles here */

        /* More complex modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.5s ease forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-content {
            position: relative;
            background-color: #fff;
            border-radius: 15px;
            padding: 40px;
            width: 90%;
            max-width: 500px;
            text-align: center;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
            transform: translateY(-100px);
            animation: slideDown 0.5s ease forwards;
        }

        @keyframes slideDown {
            from { transform: translateY(-100px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .close {
            position: absolute;
            top: 15px;
            right: 20px;
            color: #333;
            font-size: 22px;
            cursor: pointer;
        }

        .modal-content h2 {
            font-size: 26px;
            margin-bottom: 25px;
            color: #444;
        }

        .modal-content input[type="file"] {
            padding: 15px;
            font-size: 16px;
            width: 80%;
            border: 2px solid #ccc;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .modal-content button {
            background-color: #3498db;
            padding: 12px 30px;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .modal-content button:hover {
            background-color: #2980b9;
            transform: scale(1.05);
        }

        /* Progress Bar */
        .progress-container {
            display: none;
            margin-top: 20px;
            width: 100%;
            background-color: #f3f3f3;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-bar {
            width: 0%;
            height: 12px;
            background-color: #4caf50;
            border-radius: 10px;
            transition: width 0.3s ease;
        }

        /* Additional Styling for Success Message */
        .upload-success {
            display: none;
            color: green;
            font-size: 18px;
            margin-top: 20px;
        }
@media (min-width: 480px) {
    .footer-mobile {
        display:none;
    }
}
        /* Mobile View Only (max-width: 480px) */
@media (max-width: 480px) {
    /* Footer Styling */
    .footer-mobile {
        background: linear-gradient(135deg, #2c3e50, #4c566a);
        padding: 10px 0; /* Compact padding */
        width: 100%;
        position: fixed;
        bottom: 0;
        left: 0;
        box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.2); /* Subtle shadow */
        z-index: 999;
        display: flex;
        justify-content: space-around;
        align-items: center;
        color: #fff;
    }

    /* Footer Buttons */
    .footer-btn-mobile {
        display: inline-block;
        padding: 10px;
        font-size: 12px; /* Small font for mobile */
        text-transform: uppercase;
        font-weight: bold;
        color: #fff;
        border-radius: 5px; /* Slightly rounded corners */
        background: linear-gradient(135deg, #6a11cb, #2575fc);
        text-decoration: none;
        transition: all 0.3s ease;
        flex: 1; /* Equal spacing for each button */
        margin: 0 5px; /* Space between buttons */
        text-align: center;
    }

    /* Hover Effects */
    .footer-btn-mobile:hover {
        background: linear-gradient(135deg, #ff6f61, #ff9966); /* Hover color */
        transform: scale(1.05); /* Slight enlarge on hover */
    }

    /* Button Specific Colors */
    .home-btn {
        background: linear-gradient(135deg, #34e89e, #0f3443); /* Green */
    }

    .logout-btn {
        background: linear-gradient(135deg, #f7971e, #ffd200); /* Orange */
    }

    .delete-btn {
        background: linear-gradient(135deg, #ff512f, #dd2476); /* Red */
    }

    .back-btn {
        background: linear-gradient(135deg, #1f4037, #99f2c8); /* Aqua */
    }
}


    </style>
</head>
<body>
    <?php include('nav_login.php'); ?>

    <div class="container">
        <div class="card">
            <div class="content">
                <h2>View Contacts</h2>
                <button onclick="location.href='view_contacts.php'">View Contacts</button>
            </div>
        </div>

        <div class="card">
            <div class="content">
                <h2>Upload VCF File</h2>
                <button id="uploadBtn">Upload New VCF File</button>
            </div>
        </div>
    </div>

    <!-- Modal for file upload -->
    <div id="uploadModal" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <h2>Upload VCF File</h2>
            <form id="uploadForm" enctype="multipart/form-data" name="vcfupload" action="vcfupload.php" method="post">
                <input type="file" name="vcfFile" accept=".vcf" required>
                <button type="submit">Upload</button>
            </form>
            
            <!-- Progress Bar -->
            <div class="progress-container" style="display:none;">
                <div class="progress-bar" style="width:0%;"></div>
            </div>
            <div class="upload-success" style="display:none;">File uploaded successfully!</div>
        </div>
    </div>
    <footer class="footer-mobile">
        <div class="footer-container">
            <a href="HomePage.php" class="footer-btn-mobile home-btn">Home</a>
            <a href="logout.php" class="footer-btn-mobile logout-btn">Logout</a>
            <a href="del_acc.php" class="footer-btn-mobile delete-btn">Delete Account</a>
        </div>
    </footer>

    <script>
        // Get modal elements
        const modal = document.getElementById('uploadModal');
        const uploadBtn = document.getElementById('uploadBtn');
        const closeModal = document.getElementById('closeModal');
        const form = document.getElementById('uploadForm');
        const progressContainer = document.querySelector('.progress-container');
        const progressBar = document.querySelector('.progress-bar');
        const successMessage = document.querySelector('.upload-success');

        // Open modal on button click
        uploadBtn.onclick = function() {
            modal.style.display = 'flex';
        }

        // Close modal when clicking 'X'
        closeModal.onclick = function() {
            modal.style.display = 'none';
            resetForm();
        }

        // Close modal if clicking outside of it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
                resetForm();
            }
        }

        // Simulate file upload with progress bar
        form.onsubmit = function(event) {
            event.preventDefault(); // Prevent the default form submission for simulation
            progressContainer.style.display = 'block';

            // Show progress simulation
            let progress = 0;
            const interval = setInterval(function() {
                progress += 10;
                progressBar.style.width = progress + '%';

                if (progress >= 100) {
                    clearInterval(interval);
                    successMessage.style.display = 'block';
                    setTimeout(function() {
                        modal.style.display = 'none';
                        resetForm();
                    }, 2000);
                }
            }, 300);

            // Submit the form after simulation
            setTimeout(() => {
                form.submit(); // This submits the form to vcfupload.php
            }, 3000); // Adjust the timing as needed
        }

        // Reset the form and progress bar after closing modal or successful upload
        function resetForm() {
            form.reset();
            progressContainer.style.display = 'none';
            progressBar.style.width = '0%';
            successMessage.style.display = 'none';
        }
    </script>

</body>
</html>



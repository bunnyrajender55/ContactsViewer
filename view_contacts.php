<?php
session_start();
// Initialize the session
if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"]=== false){
    header("location: signup.php");
    exit;
}
?>
<?php 
require_once 'connect_database.php'; 
$email = $_SESSION["user_email_id"];
$sql = "SELECT vcf_file FROM Myusers WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($vcf_file);
$stmt->fetch();
$stmt->close();
$filename = "";
if($vcf_file){
    $filename = $vcf_file;
}
else{
    echo "<!DOCTYPE html>
 <html lang='en'>
 <head>
 <meta name='viewport' content='width=device-width, initial-scale=1'>
 <link rel='icon' href='https://r.mobirisesite.com/757077/assets/images/gd988c37b5856e2e59bc61db248bd-h_m1ue2up7.png' type='image/x-icon'>
 <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.all.min.js
'></script>
<link href='https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.min.css
' rel='stylesheet'>
</head>
<body>
<script>
swal.fire({
title:'VCF file does not exist',
text:'Upload VCF file and try again...',
icon:'error',
backdrop:'rgba(0,0,0,0.8)',
}).then(function() {
window.location='retrieve.php';
});
</script></body></html>";
}
$path="vcf_files/";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="author" content="Dontharaveni Rajender">
    <meta name="description" content="Contacts Viewer">
    <meta name="keywords" content="Contacts Viewer">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contacts Retriever</title>
    <link rel='icon' href='https://r.mobirisesite.com/757077/assets/images/gd988c37b5856e2e59bc61db248bd-h_m1ue2up7.png' type='image/x-icon'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <style>
        .navbar {
    background-color: #343a40; /* Dark background */
    padding: 0.75rem 1rem; /* Padding */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2); /* Shadow for depth */
    transition: background-color 0.3s, box-shadow 0.3s; /* Transition for background and shadow */
}

.navbar:hover {
    background-color: #495057; /* Darker background on hover */
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3); /* Enhanced shadow on hover */
}

.navbar-brand img {
    width: 50px; /* Logo size */
    margin-right: 10px; /* Space between logo and title */
    transition: transform 0.3s; /* Transition for logo scaling */
}

.navbar-brand:hover img {
    transform: scale(1.1); /* Scale logo slightly on hover */
}

.navbar-nav .nav-link {
    color: #ffffff; /* White text color for nav links */
    transition: color 0.3s, transform 0.3s; /* Transition for color and scale */
}

.navbar-nav .nav-link:hover {
    color: #7FFFD4; /* Light color on hover */
    transform: scale(1.1); /* Scale up on hover */
}

.navbar-nav .nav-link.active {
    color: #7FFFD4; /* Active link color */
    font-weight: bold; /* Bold for active link */
    text-decoration: underline; /* Underline for active link */
}

.search-form input {
    border-radius: 20px; /* Rounded search input */
    border: 1px solid #7FFFD4; /* Custom border color */
    transition: border-color 0.3s; /* Transition for border color */
}

.search-form input:focus {
    border-color: #ffffff; /* Change border color on focus */
    box-shadow: 0 0 5px rgba(255, 255, 255, 0.5); /* Light shadow on focus */
}

.search-form .btn {
    border-radius: 20px; /* Rounded search button */
    background-color: #7FFFD4; /* Custom button color */
    color: #000; /* Button text color */
    transition: background-color 0.3s, transform 0.3s; /* Transition for button */
}

.search-form .btn:hover {
    background-color: #5aa5a5; /* Darker button color on hover */
    transform: scale(1.05); /* Scale up button on hover */
}

        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
            color: #333;
        }
        h1 {
            text-align: center;
            color: #5a5a5a;
        }
        input[type="text"] {
            width: 90%;
            padding: 10px;
            margin: 20px auto;
            display: block;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px 15px;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:nth-child(odd) {
            background-color: #ffffff;
        }
        tr:hover {
            background-color: #e8f5e9; /* Hover effect */
            cursor: pointer;
        }
        .action-icons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .action-icons a {
            color: #fff;
            padding: 8px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .action-icons a.phone {
            background-color: #2196F3;
        }
        .action-icons a.whatsapp {
            background-color: #25D366;
        }
        .action-icons a:hover {
            opacity: 0.8;
        }
        /* Smooth scrolling for the page */
html {
    scroll-behavior: smooth;
}

/* Enhanced navbar with stronger design and animations */
.navbar {
    background-color: #343a40;
    padding: 0.75rem 1rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    transition: background-color 0.3s, box-shadow 0.3s;
}

.navbar:hover {
    background-color: #495057;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
}

/* Navbar links with hover effect */
.navbar-nav .nav-link {
    color: #ffffff;
    transition: color 0.3s, transform 0.3s;
}

.navbar-nav .nav-link:hover {
    color: #7FFFD4;
    transform: scale(1.1);
}

/* Search bar with enhanced focus effect */
.search-form input {
    width: 350px;
    padding: 12px 20px;
    border: 2px solid #7FFFD4;
    border-radius: 40px;
    transition: all 0.4s ease;
    background-color: rgba(255, 255, 255, 0.9);
    color: #343a40;
    font-size: 16px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
}
/* Table Styles with animations */
table {
    width: 100%;
    margin-top: 30px;
    border-collapse: collapse;
    background-color: #fff;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    animation: fadeInTable 1s ease-in-out;
}

@keyframes fadeInTable {
    from {
        opacity: 0;
        transform: translateY(50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

th, td {
    padding: 15px;
    text-align: center;
    transition: background-color 0.3s, color 0.3s, transform 0.3s;
}

/* Header with gradient and hover effect */
th {
    background: linear-gradient(45deg, #4CAF50, #81C784);
    color: white;
    font-size: 16px;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

th:hover {
    background: linear-gradient(45deg, #388E3C, #66BB6A);
    transform: scale(1.05);
}

td {
    background-color: #fafafa;
    color: #333;
    font-size: 15px;
    border-bottom: 1px solid #ddd;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #e8f5e9;
    cursor: pointer;
    transform: scale(1.02);
    transition: transform 0.3s ease;
}

/* Row highlighting on search */
.highlighted {
    background-color: #81C784 !important;
    color: white;
    animation: highlightRow 1s ease-in-out;
}

@keyframes highlightRow {
    from {
        background-color: #fff;
    }
    to {
        background-color: #81C784;
    }
}

/* Actions icons with hover effect */
.action-icons {
    display: flex;
    justify-content: center;
    gap: 10px;
}

.action-icons a {
    color: #fff;
    padding: 8px;
    border-radius: 5px;
    transition: all 0.3s;
}

.action-icons a.phone {
    background-color: #2196F3;
}

.action-icons a.whatsapp {
    background-color: #25D366;
}

.action-icons a:hover {
    opacity: 0.8;
    transform: scale(1.1);
}

/* Page body styling */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f0f0f0;
    padding: 20px;
    color: #333;
}

@media only screen and (max-width: 768px) {
    th{
        font-size: 10px;
        padding: 4px 5px;
    }
    td{
        font-size: 10px;
        padding: 2px 3px;
    }
    table{
        width:100%;
    }
    #contactlist_{
        font-size:30px;
    }
    
}
 .contact-header {
            display: flex;
            align-items: center; /* Align items vertically */
            justify-content: center; /* Center items horizontally */
            margin-bottom: 20px;
            gap: 20px; /* Space between h1 and icons */
        }

        h1 {
            font-size: 2.5em;
            margin: 0;
        }

        .icon-buttons {
            display: flex;
            gap: 15px; /* Space between icons */
        }

        .icon-buttons a {
            color: #333;
            font-size: 1.7em; /* Size of icons */
            text-decoration: none;
            display: flex;
            align-items: center; /* Vertically center the icons */
            justify-content: center;
            width: 40px; /* Set fixed width for icon containers */
            height: 40px; /* Set fixed height for icon containers */
            border-radius: 50%; /* Rounded border for better visuals */
            background-color: #f0f0f0; /* Light background for icons */
            transition: background-color 0.3s, transform 0.3s; /* Smooth hover effect */
        }

        .icon-buttons a:hover {
            background-color: #4CAF50; /* Change background color on hover */
            color: white;
            transform: scale(1.1); /* Slightly enlarge on hover */
        }

        .icon-buttons i {
            margin: 0;
        }
        @media (min-width: 480px) {
            .footer-mobile{
                display:none;
            }
        }
            
 /* Mobile View Only (max-width: 480px) */
@media (max-width: 480px) {
    .navbar{
        display:none;
    }
    .mobile{
        display:block;
    }
     .contact-header {
            margin-top: 0px;
            margin-bottom: 10px;
        }
    /* Footer Styling */
    .footer-mobile {
       background: linear-gradient(135deg, #2c3e50, #4c566a);
        padding: 10px 0; /* Compact padding */
        width: 100%;
        position: fixed;
        top: 0;
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
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="HomePage">
            <img src="https://r.mobirisesite.com/757077/assets/images/gd988c37b5856e2e59bc61db248bd-h_m1ue2up7.png" alt="Logo">
            <b>Contacts Viewer</b>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="HomePage">Home</a>
                <li class="nav-item">
                    <a class="nav-link" href="retrieve">Back</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="del_acc.php">Delete Account</a>
                </li>
            </ul>
            <form class="d-flex search-form">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="search1">
                <button class="btn btn-outline-light" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
<div class="mobile">
    <br><br>
</div>
 <footer class="footer-mobile">
        <div class="footer-container">
            <a href="HomePage.php" class="footer-btn-mobile home-btn">Home</a>
            <a href="logout.php" class="footer-btn-mobile logout-btn">Logout</a>
            <a href="del_acc.php" class="footer-btn-mobile delete-btn">Delete Account</a>
            <a href="javascript:history.back()" class="footer-btn-mobile back-btn">Back</a> <!-- New Back button -->
        </div>
</footer>
    <div class="contact-header">
    <h1 id="contactlist_">Contact List</h1>

    <!-- Icon buttons for download and share -->
    <div class="icon-buttons">
        <!-- Download button -->
        <a href="<?php echo $path . $filename; ?>" download="<?php echo $filename; ?>" title="Download VCF">
            <i class="fas fa-download"></i>
        </a>

        <!-- Share button -->
        <a href="#" id="shareButton" title="Share VCF">
            <i class="fas fa-share-alt"></i>
        </a>
    </div>
</div>
   
    <form class="d-flex search-form">
    <div class="input-group">
        <input class="form-control" id="search" type="search" placeholder="Search contacts..." aria-label="Search">
        <button class="btn btn-outline-light" type="button">
            <i class="fas fa-search"></i>
        </button>
    </div>
</form>

    <table class="">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Person Name</th>
                <th>Phone Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="contactsTable"></tbody>
    </table>

    <script>
        // Function to decode quoted-printable encoding
function decodeQuotedPrintable(str) {
    return str.replace(/=([0-9A-Fa-f]{2})/g, (match, hex) => {
        return String.fromCharCode(parseInt(hex, 16));
    }).replace(/_/g, ' '); // Replace underscores with spaces
}

// Function to parse and display VCF data
function parseAndDisplayVCF(vcfData) {
    const vCardData = vcfData.split(/BEGIN:VCARD/).filter(Boolean);
    const contacts = [];

    vCardData.forEach(vCard => {
        const lines = vCard.split(/\r?\n/);
        let currentContact = { name: "", phones: [] };

        lines.forEach(line => {
            line = line.trim();
            if (line.startsWith('FN')) {
                const nameEncoded = line.split(':')[1]?.trim();
                if (nameEncoded) {
                    currentContact.name = decodeQuotedPrintable(nameEncoded);
                }
            } else if (line.startsWith('TEL')) {
                const phoneEncoded = line.split(':')[1]?.trim();
                if (phoneEncoded) {
                    const decodedPhone = decodeQuotedPrintable(phoneEncoded);
                    // Check if the phone number already exists before adding
                    if (!currentContact.phones.includes(decodedPhone)) {
                        currentContact.phones.push(decodedPhone);
                    }
                }
            }
        });

        if (currentContact.name || currentContact.phones.length) {
            contacts.push(currentContact);
        }
    });

    // Build the table
    let tableHTML = '';
    contacts.forEach((contact, index) => {
        let phoneNumbers = contact.phones.join(', ');

        // Ensure WhatsApp URL contains country code
        let phoneNumbersForWhatsApp = contact.phones.map(phone => {
            if (!phone.startsWith('+')) {
                phone = '91' + phone.replace(/\D/g, ''); // Add country code if missing
            } else {
                phone = phone.replace(/\D/g, '');
            }
            return phone;
        }).join(', ');

        // Escape HTML special characters to prevent XSS
        const escapeHTML = (str) => {
            return str.replace(/&/g, '&amp;')
                      .replace(/</g, '&lt;')
                      .replace(/>/g, '&gt;')
                      .replace(/"/g, '&quot;')
                      .replace(/'/g, '&#39;');
        };

        tableHTML += `
            <tr>
                <td>${index + 1}</td>
                <td>${escapeHTML(contact.name) || "Not Provided"}</td>
                <td>${escapeHTML(phoneNumbers) || "Not Provided"}</td>
                <td class="action-icons">
                    <a href="tel:${phoneNumbers}" class="phone" title="Call"><i class="fas fa-phone"></i></a>
                    <a href="https://wa.me/${phoneNumbersForWhatsApp}" class="whatsapp" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                </td>
            </tr>`;
    });

    $('#contactsTable').html(tableHTML);

    // Search functionality
    $('#search').on('keyup', function() {
        const value = $(this).val().toLowerCase();
        $('#contactsTable tr').each(function() {
            const rowText = $(this).text().toLowerCase();
            $(this).toggle(rowText.indexOf(value) > -1);
            if (rowText.indexOf(value) > -1) {
                $(this).addClass('highlighted');
            } else {
                $(this).removeClass('highlighted');
            }
        });
    });

    $('#search1').on('keyup', function() {
        const value = $(this).val().toLowerCase();
        $('#contactsTable tr').each(function() {
            const rowText = $(this).text().toLowerCase();
            $(this).toggle(rowText.indexOf(value) > -1);
            if (rowText.indexOf(value) > -1) {
                $(this).addClass('highlighted');
            } else {
                $(this).removeClass('highlighted');
            }
        });
    });
}

        // Load and parse the VCF file
        const filename = <?php echo json_encode($filename); ?>;
        const path = <?php echo json_encode($path); ?>;
        fetch(path+ filename)
            .then(response => response.text())
            .then(vcfData => {
                parseAndDisplayVCF(vcfData);
            })
            .catch(error => {
                $('#contactsTable').html("<tr><td colspan='4'>Error loading VCF file. Please try again later.</td></tr>");
                console.error('Error loading VCF file:', error);
            });
    </script>
    <script>
    // Share VCF file using the Web Share API
    document.getElementById('shareButton').addEventListener('click', function () {
        const shareData = {
            title: 'VCF File',
            text: 'Here is the VCF file for my contacts.',
            url: '<?php echo $path . $filename; ?>'
        };

        if (navigator.share) {
            navigator.share(shareData)
                .then(() => console.log('VCF file shared successfully'))
                .catch((error) => console.log('Error sharing VCF file:', error));
        } else {
            alert('Sharing is not supported in your browser.');
        }
    });
</script>

</body>
</html>

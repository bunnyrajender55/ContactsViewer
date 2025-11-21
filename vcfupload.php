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
// Handle file upload
$account_success="";
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['vcfFile'])) {
    $file = $_FILES['vcfFile'];
    $email = $_SESSION["user_email_id"];

    // Check if the file is a valid VCF file
    if ($file['type'] !== 'text/vcard' && pathinfo($file['name'], PATHINFO_EXTENSION) !== 'vcf') {
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
title:'Please upload a valid VCF file...!',
text:'Try again...',
icon:'error',
backdrop:'rgba(0,0,0,0.8)',
}).then(function() {
window.location='retrieve.php';
});
</script></body></html>";
        exit;
    }

    // Fetch the user's current VCF file status
    $stmt = $conn->prepare("SELECT vcf_file FROM Myusers WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        echo "User not found.";
        exit;
    }

    $stmt->bind_result($existing_vcf);
    $stmt->fetch();
    $stmt->close();
    $vcf_folder="vcf_files/";
     // Delete the existing VCF file if it exists
     if (!empty($existing_vcf) && file_exists($vcf_folder . $existing_vcf)) {
        unlink($vcf_folder . $existing_vcf);
    }

    // Generate new VCF file name
    $new_vcf_file_name = pathinfo($file['name'], PATHINFO_FILENAME) . '_' . str_replace('@', '_', $email) . '.vcf';

    // Move the uploaded file to a specific directory
    $targetDir = "vcf_files/"; // Ensure this directory exists and is writable
    $targetFilePath = $targetDir . $new_vcf_file_name;

    if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
        // Prepare SQL statement to update the user's VCF file path in the database
        $stmt = $conn->prepare("UPDATE Myusers SET vcf_file = ? WHERE email = ?");
        $stmt->bind_param("ss", $new_vcf_file_name, $email);

        // Execute the statement
        if ($stmt->execute()) {
            $account_success = "VCF file uploaded successfully!";
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
title:'VCF file uploaded successfully...',
text:'View Contacts To Continue...',
icon:'success',
backdrop:'rgba(0,0,0,0.8)',
}).then(function() {
    window.location='retrieve.php';
});
</script></body></html>";
        } else {
            $account_success = "Error uploading VCF file: " . $stmt->error;
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
title:'Error uploading VCF file!',
text:'Try again...',
icon:'error',
backdrop:'rgba(0,0,0,0.8)',
}).then(function() {
window.location='retrieve.php';
});
</script></body></html>";
        }

        // Close the statement
        $stmt->close();
    } else {
        $account_success = "Error moving the uploaded file.";
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
title:'moving the uploaded file!',
text:'Try again...',
icon:'error',
backdrop:'rgba(0,0,0,0.8)',
}).then(function() {
window.location='retrieve.php';
});
</script></body></html>";
    }
}
$conn->close();
?>
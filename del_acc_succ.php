<?php
// delete_account.php
session_start(); // Assuming you have a session to track the logged-in user
require_once 'connect_database.php';

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: signup.php"); // Redirect to login if not logged in
    exit();
}

$email = $_SESSION['user_email_id'];

// Fetch the user's VCF file from the database before deleting the record
$query = "SELECT vcf_file FROM Myusers WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($vcf_file);
$stmt->fetch();
$stmt->close();

// Path to the folder where VCF files are stored
$vcf_file_path = 'vcf_files/' . $vcf_file;

// Delete the user from the database
$delete_user_query = "DELETE FROM Myusers WHERE email = ?";
$stmt = $conn->prepare($delete_user_query);
$stmt->bind_param("s", $email);

if ($stmt->execute()) {
    // Check if the VCF file exists on the server and delete it
    if (file_exists($vcf_file_path)) {
        unlink($vcf_file_path); // Delete the VCF file
    }
    // Destroy the session and redirect to the login or home page
    session_destroy();
echo "<!DOCTYPE html>
                    <html lang='en'>
                    <head>
                    <link rel='icon' href='https://r.mobirisesite.com/757077/assets/images/gd988c37b5856e2e59bc61db248bd-h_m1ue2up7.png' type='image/x-icon'>
                    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.all.min.js
'></script>
<link href='https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.min.css
' rel='stylesheet'>
</head>
<body>
<script>
swal.fire({
title:'Account deleted Successfully...',
text:'Your all data deleted from server.',
icon:'success',
backdrop:'rgba(0,0,0,0.8)',
}).then(function() {
    window.location='HomePage.php';
});
</script></body></html>";
} else {
echo "<!DOCTYPE html>
                    <html lang='en'>
                    <head>
                    <link rel='icon' href='https://r.mobirisesite.com/757077/assets/images/gd988c37b5856e2e59bc61db248bd-h_m1ue2up7.png' type='image/x-icon'>
                    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.all.min.js
'></script>
<link href='https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.min.css
' rel='stylesheet'>
</head>
<body>
<script>
swal.fire({
title:'Error deleting account.',
text:'try again...',
icon:'error',
backdrop:'rgba(0,0,0,0.8)',
}).then(function() {
    window.location='signup#signinblock';
});
</script></body></html>";
}

$stmt->close();
$conn->close();
?>

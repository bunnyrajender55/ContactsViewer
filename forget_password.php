<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Bunny Rajender">
	<meta name="description" content="Forgot Password Page">
	<meta name="keywords" content="forgot password page">
	<title>Forgot Password Page</title>
	<link rel='icon' href='https://r.mobirisesite.com/757077/assets/images/gd988c37b5856e2e59bc61db248bd-h_m1ue2up7.png' type='image/x-icon'>
	<script src="https://smtpjs.com/v3/smtp.js">
	</script>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
	<style>
	* {
	margin: 0;
	padding: 0;
	box-sizing: border-box;
	font-family: "segoe ui", verdana, helvetica, arial, sans-serif;
	font-size: 16px;
	transition: all 500ms ease; }
	body {
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
	text-rendering: optimizeLegibility;
	-moz-font-feature-settings: "liga" on; }
	.row {
	background-color: rgba(20, 120, 200, 0.6);
	color:#fff;
	text-align: center;
	padding: 2em 2em 0.5em;
	width: 90%;
	margin: 2em	auto;
	border-radius: 5px;
	}
	.row h1 {
	font-size: 2.5em; }
	.row .form-group {
	margin: 0.5em 0; }
	.row .form-group label {
	display: block;
	color:yellow;
	text-align: left;
	font-weight: 600; }
	.row .form-group input, .row .form-group button {
	display: block;
	padding: 0.5em 0;
	width:100%;
	height: 55px;
	margin-top: 1em;
	margin-bottom: 0.5em;
	background-color:inherit;
	border: none;
	border-bottom: 1px solid pink;
	color: #eee; }
	.row .form-group input{
	    height: 40px;
	}
	.row .form-group input:focus, .row .form-group button:focus {
	background-color: #fff;
	color: #000;
	border: none;
	padding: 1em 0.5em; animation: pulse 1s infinite ease;}
	.row .form-group button {
	border: 1px solid pink;
	border-radius: 8px;
	outline: none;
	-moz-user-select: none;
	user-select: none;
	color:#fff8df;
	font-weight: 800;
	cursor: pointer;
	margin-top: 2em;
	padding: 1em; }
	.row .form-group button:hover, .row .form-group button:focus {
	background-color:#fff;
	color:red;}
	.row .form-group button.is-loading::after {
	animation: spinner 500ms infinite linear;
	content: "";
	position: absolute;
	margin-left: 2em;
	border: 2px solid #000;
	border-radius: 100%;
	border-right-color: transparent;
	border-left-color: transparent;
	height: 1em;
	width: 4%; }
	.row .footer h5 {
	margin-top: 1em; }
	.row .footer p {
	margin-top: 2em; }
	.row .footer p .symbols {
	color: #444; }
	.row .footer a {
	color: inherit;
	text-decoration: none; }
	
	.information-text {
	color: #ddd; }
	
	@media screen and (max-width: 320px) {
	.row {
	padding-left: 1em;
	padding-right: 1em; }
	.row h1 {
	font-size: 1.5em !important; } }
	@media screen and (min-width: 900px) {
	.row {
	width: 40%; } }
	@media screen and (min-width: 1200px) {
	.row {
	width:26%; } }
	@media only screen and (min-width:768px){
	    body, html {
  height: 100%;
  margin: 0;
}
.bg {
  /* The image used */
  background:url("background_11551.jpg");
 background-size: cover;
   

  /* Full height */
  height: 100%; 

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
	}
	@media only screen and (max-width: 768px) {
 #vce{
     font-size: 15px;
 }
	}
	h1{
	color:aqua;
	}
	#text11{
	    font-size: 15px;
	}
	#text22{
	    color:black;
	}
	</style>
</head>
<body>
    
<?php
// Start the session
session_start();
// Include config file
require_once "connect_database.php";


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PhpMailer.php';
require 'SMTP.php';
// Define variables and initialize with empty values
$useremail = "";
$username = "";
$email_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $useremail = trim($_POST["email"]);

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT username FROM Myusers WHERE email = ?");
    $stmt->bind_param("s", $useremail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $username = $row["username"];
        $otp = rand(100000, 999999);

        // Update OTP in database
        $stmt = $conn->prepare("UPDATE Myusers SET otp = ? WHERE email = ?");
        $stmt->bind_param("is", $otp, $useremail);
        $stmt->execute();

        // Store data in session variables
        $_SESSION["forget_password"] = true;
        $_SESSION["forget_email"] = $useremail;
        $_SESSION["email_username"] = $username;
        $_SESSION["resend_otp"] = false;
        $_SESSION["sent_otp"] = false;

        // Create a new PHPMailer instance
        $mail = new PHPMailer(true);
        ?>
<p hidden>
<?php

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
            $mail->isSMTP(); // Send using SMTP
            $mail->Host       = 'contactsviewer.vcequestionpapers.xyz'; // Set the SMTP server to send through
            $mail->SMTPAuth   = true; // Enable SMTP authentication
            $mail->Username   = 'noreply@contactsviewer.vcequestionpapers.xyz'; // SMTP username
            $mail->Password   = 'Bunny@2255'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable implicit TLS encryption
            $mail->Port       = 465; // TCP port to connect to

            // Recipients
            $mail->setFrom('noreply@contactsviewer.vcequestionpapers.xyz', 'Dontharaveni Rajender');
            $mail->addAddress($useremail);
            $mail->addReplyTo('bunnyrajender77@gmail.com');

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = "Reset Password";
            $mail->Body = '
            <img src="https://lh3.googleusercontent.com/pw/AP1GczPMVeBgGOESz4QW_1iJZa5ByzKKXNB2nK3EVw3gdRs_upd_z2EMZa821oS-JPUVVNHDuwgEbpzIdiDtfHeUG-FR4Fcd0Ei4FYNgYMebCzfnx4nM_Jw=w2400" width="800px" hight="auto" />
            <br><br>
            <h1 style="color:red">Hii &nbsp;' . htmlspecialchars($username) . '</h1>
            <h2 style="color:#ff8c00">Welcome To My Website</h2>
            <h4 style="color:#00008b;">For Change Your Account Password...<br>
            You Have To Validate Your Email Address<br>
            For That You Have To Confirm The OTP<br>
            <b style="color:green;">Your One Time Password Is</b>&nbsp;&nbsp;<i style="color:red;">***' . $otp . '***</i>
            <br><br><br><br>
            <b style="color:#800080;font-size:30">For Any Queries...<br>Contact Me In instagram<br></b></h4>
            <a href="https://instagram.com/bunnyrajender55?igshid=NTc4MTIwNjQ2YQ=="><img src="https://lh3.googleusercontent.com/7LTwoUtFyVblVQ_AP8HPOQbsNKhNMNW4r3jMmMy1vDwtKAFol2XMqJRRW_aAE8azNZ1OwAs6AgtD2CYToAKqtA6YU8t3Y2OLBsivrHcnCJszJjxgVeT1J4Xjdun5VxtZ55Sp54IvXA=w600-h315-p-k" width="12" height="12" />BunnyRajender</a>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            // Send the email
            $mail->send();
            $_SESSION["sent_otp"] = true;
            echo "<script>window.location='otp_verification';</script>";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        ?>
</p>
<?php
    } else {
        $email_err = "**Email Does Not Exist..<br>Give Registered Email And Continue..";
    }

    $stmt->close();
    $conn->close();
}
?>

    
    
    <div class="bg">
    <?php include('nav.php'); ?>
    
    <br><br><br>
	<div class="row" style="background:url('background_6.jpeg');background-size:cover;">
		<h2 style="color:green;font-size:20px;background-color:white;font-weight:bold;">Forgot Password</h2><br>
		<h6 style="color:#fdf;font-weight:1000;font-size:15;" class="information-text" id="otp"><b><b>Enter your registered email to reset your password.</b></b></h6>
		<div class="form-group">
			<p id="check" style="color:red;font-weight:600;position:relative;"><?php 
			if(!($email_err==""))
			{
			    echo $email_err;
			}
			?></p>
			<form name="forget_password" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" onsubmit="return EmailValidate()">
			<input type="email" name="email" id="user_email" required autofocus="autofocus">
			<p><label for="username" id="email_otp">Email</label></p>
			<button type="submit" id="button"><p id="reset_validate">Reset Password</p></button>
			</form>
		</div>
		<div class="footer">
			<h5 id="text11">New here? <a href="signup.php#signinblock"><u id="text22">Sign Up.</u></a></h5>
			<h5 id="text11">Already have an account? <a href="signup.php#signinblock"><u id="text22">Sign In.</u></a></h5>
			<p class="information-text"><span class="symbols" title="Lots of love from me to YOU!"></span>&hearts;<a href="https://instagram.com/bunnyrajender55?igshid=NTc4MTIwNjQ2YQ==" target="new">BunnyRajender</a></p>
		</div>
	</div>
	</div>
	<script>
	function EmailValidate()
	{
	var a=document.getElementById("user_email").value;
	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	if(!(a.match(mailformat)))
	{
	document.getElementById("check").innerHTML="* <b>Invalid Email Address</b>";
	return false;
	}
	}
	</script>
</body>
</html>
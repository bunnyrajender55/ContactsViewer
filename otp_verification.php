<?php
session_start();
// Initialize the session
 $_SESSION["otp_verification"]=false;
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["forget_password"]) || $_SESSION["forget_password"]===false){
    header("location:signup.php");
    exit;
}
?>
<?php
 $_SESSION["otp_verification"]=false;
// Include config file
require_once "connect_database.php";
 
// Define variables and initialize with empty values
$otp= $otp_err1 = $otp_err2="";
if($_SESSION["resend_otp"]==true)
{
$otp_err2="**OTP Resent Successfully...";
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
const Toast = Swal.mixin({
  toast: true,
  position: 'top',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
  }
});
Toast.fire({
  icon: 'success',
  title: 'OTP resent successfully'
});
</script></body></html>";
$_SESSION["resend_otp"]=false;
}
else
{
    if($_SESSION["sent_otp"]==true)
    {
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
const Toast = Swal.mixin({
  toast: true,
  position: 'top',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
  }
});
Toast.fire({
  icon: 'success',
  title: 'OTP sent successfully'
});
</script></body></html>";
}
$_SESSION["sent_otp"]=false;
}
$email=$_SESSION["forget_email"];
 
// Processing form data when form is submitted
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $otp = trim($_POST["otp"]);

    // Prepare a statement
    $stmt = $conn->prepare("SELECT username, otp, email FROM Myusers WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if ($row["otp"] == $otp) {
            // Store data in session variables
            $_SESSION["forget_password"] = true;
            $_SESSION["forget_email"] = $email;
            $_SESSION["otp_verification"] = true;
            header("location:newpassword.php");
            exit; // Always use exit after a header redirect
        } else {
            $otp_err1 = "**Invalid OTP<br>Enter Correct OTP To Continue...";
        }
    }
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Bunny Rajender">
	<meta name="description" content="OTP verfication Page">
	<meta name="keywords" content="OTP verification page">
	<title>OTP Verification</title>
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
body, html {
  height: 100%;
  margin: 0;
}
.bg {
  /* The image used */
   

  /* Full height */
  height: 100%; 

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}

	
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
	border-bottom: 1px solid black;
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
	border: 1px solid black;
	border-radius: 8px;
	outline: none;
	-moz-user-select: none;
	user-select: none;
	color:red;
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
	width: 40%; }
	
	    .bg{
	          background:linear-gradient(25deg,black,#33cdef);
	    }
	}
	@media screen and (min-width: 1200px) {
	.row {
	width: 26%; }
	}
	@media only screen and (max-width: 768px) {
 #vce{
     font-size: 15px;
 }
	}
	h1{
	color:aqua;
	}
	</style>
</head>
<body>
    <div class="bg">
    <?php include('nav.php'); ?>
    <br><br><br>
	<div class="row" style="background:linear-gradient(25deg,pink,#abcdef);">
		<h5 style="color:black;background-color:orange;font-size:15px;padding:1px">OTP Successfully Sent To Your Email..<br>Once Check Your Email</h5>
		<h6 style="color:brown;font-weight:1000;font-size:15;" class="information-text" id="otp"><b>Enter OTP To Continue...</b></h6>
		<div class="form-group">
			<p id="check" style="color:red;font-weight:600;position:relative;"><?php 
if(!($otp_err1==""))
{
echo $otp_err1;
}
else if(!($otp_err2==""))
{
echo $otp_err2;
}
?></p>
			<form name="otp_verification" action="" method="POST">
			<input type="number" name="otp" id="otp" required autofocus="autofocus">
			<p><label for="username" id="email_otp">OTP</label></p>
			<button type="submit" >Validate OTP</p></button>
<a href="resendotp.php" style="text-decoration:none;"><h2 style="background-color:black;color:pink;font-size:15px">Resend OTP</h2></a>
			</form>
		</div>
		<div class="footer">
			<h5><a href="forget_password.php"><b style="color:black;">Go Back</b></a></h5>
			<h5><a href="signup.php#signinblock"><b style="color:black;">For SignIn</b></a></h5>
		</div>
	</div>
</div>
</body>
</html>
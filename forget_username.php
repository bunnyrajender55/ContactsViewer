<?php
// Include config file
require_once "connect_database.php";
 
// Define variables and initialize with empty values
$useremail="";
$email_err="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
$useremail=trim($_POST["email"]);
$sql = "SELECT username,password,email FROM Myusers WHERE email ='$useremail'";
$result = $conn->query($sql);

if ($result->num_rows==1) {
//These must be at the top of your script, not inside a function
                            
                            // Store data in session variables
                session_start();
                            $_SESSION["forget_username"] = true;
                            $_SESSION["forget_email"] = $useremail;
header("location:newusername");
}   
else{
    $email_err="**Email Deos Not Exist...<br>Give Rigistered Email And Continue..";
}
$conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Bunny Rajender">
	<meta name="description" content="Forgot Username Page">
	<meta name="keywords" content="forgot username page">
	<title>Forgot Username Page</title>
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
   background:url("background_1155.jpg");
   background-size: cover;

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
	color:#f0ffff;
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
	width: 26%; } }
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
	.row{
		background: url("background_6.jpeg");
		background-size: cover;
	}
	</style>
</head>
<body>
    <div class="bg">
    <?php include('nav.php'); ?>
    <br>
    <br>
    <br>
	<div class="row">
		<h1 style="color:green;font-size:20px;background-color:white;">Forgot Username</h1><br>
		<h6 style="color:#fdf;font-weight:1000;font-size:15;" class="information-text" id="otp"><b>Enter Your Registered Email To Change Your Username.</b></h6>
		<div class="form-group">
			<p id="check" style="color:red;font-weight:600;position:relative;"><?php 
			if(!($email_err==""))
			{
			    echo $email_err;
			}
			?></p>
			<form name="forget_username" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" onsubmit="return EmailValidate()">
			<input type="email" name="email" id="user_email" required autofocus="autofocus">
			<p><label for="username" id="email_otp">Email</label></p>
			<button type="submit" id="button"><p id="reset_validate">Reset Username</p></button>
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
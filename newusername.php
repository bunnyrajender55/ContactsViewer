<?php
session_start();
// Initialize the session
if(!isset($_SESSION["forget_username"]) || $_SESSION["forget_username"]===false)
{
header("location:signup.php");
}
?>
<?php
// Include config file
require_once "connect_database.php";
 
// Define variables and initialize with empty values
$email="";
$username="";
$username_err="";
$email=$_SESSION["forget_email"];
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
$username = trim($_POST["username"]);
$sql = "SELECT username,password,email FROM Myusers WHERE username ='$username'";
$result = $conn->query($sql);

if ($result->num_rows==1) {
  // output data of each row
  $username_err="**This Username Already Exist..Give One More...";
}
else
{
$sql2="update Myusers set username='$username' where email='$email'";
$changeUsername=$conn->query($sql2);
if($changeUsername===true)
{  
$_SESSION["forget_username"]=false;
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
title:'Username changed Successfully...',
text:'Sign In To Continue...',
icon:'success',
backdrop:'rgba(0,0,0,0.8)',
}).then(function() {
    window.location='signup#signinblock';
});
</script></body></html>";
}  
else
{
$username_err="**Something Went Wrong<br>Try Again...";
}
}
$conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Bunny Rajender">
	<meta name="description" content="New Username">
	<meta name="keywords" content="New Username">
	<title>New Username</title>
	<link rel="icon" href="https://r.mobirisesite.com/757077/assets/images/gd988c37b5856e2e59bc61db248bd-h_m1ue2up7.png" type="image/x-icon">
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
   background:linear-gradient(25deg,pink,#a12340);

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
	    height: 40px;}
	.row .form-group input{
	    background-color: inherit;
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
	color:white;
	font-weight: 800;
	cursor: pointer;
	margin-top: 2em;
	padding: 1em; }
	.row .form-group button:hover, .row .form-group button:focus {
	background-color:#fff;
	color:brown;}
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
	u{color:yellow}
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
	.bg{
	    background:linear-gradient(50deg,white,pink);
	}
	</style>
</head>
<body>
    <div class="bg">
    <?php include('nav.php'); ?>
    <br><br><br>
	<div class="row" style="background:linear-gradient(50deg,black,purple);">
		<h5 style="color:aqua;background-color:black"><b>Reset Username</b></h5>
		<br><h6 style="color:#fdf;font-weight:1000;font-size:15px;" class="information-text" id="otp"><b>Enter New Username To Continue...</b></h6>
		<div class="form-group">
			<p id="check" style="color:red;font-weight:600;position:relative;"><?php 
if(!($username_err==""))
{
echo $username_err;
}
?></p>
			<form name="forget_username" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" onsubmit="return validate_username()")>
			<input type="text" name="username" id="username" required autofocus="autofocus">
			<p><label for="username" id="email_otp">Username</label></p>
			<button type="submit" ><b>Change Username</b></p></button>
			</form>
		</div>
		<div class="footer">
			<h5><a href="forget_username.php"><b style='color:#fafedf'>Go Back.</b></a></h5>
			<br><h5><a href="signup.php#signinblock" ><b style="color:#fafedf">For SignIn</b></a></h5>
		</div>
	</div>
	</div>
<script>
function validate_username()
{
    var a=document.forget_username.username.value;
    var user_Regular_Expression=/^[0-9a-zA-Z]+$/;
if(a.length<6)
{
document.getElementById("check").innerHTML="*<b>Username length Must Be 6 or Above</br>";
return false;
}
else if(!(a.match(user_Regular_Expression)))
{
document.getElementById("check").innerHTML="* <b>Username Must Be Alphanumaric, No Special Charecters Are Allowed</b>";
return false;
}
else if(Number.isInteger(Number(a)))
{
document.getElementById("check").innerHTML="* <b>Must Be Username contains Letters And Numbers Ex- <u>Vaagdevi55</u></b>";
return false;
}
else if(!(/\d/.test(a)))
{
document.getElementById("check").innerHTML="* <b>Must Be Username contains Letters And Numbers Ex-<u>Vaagdevi55</u></b>";
return false;
}
}
</script>
</body>
</html>
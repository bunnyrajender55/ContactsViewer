<?php
session_start();
require_once "connect_database.php"; 

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["forget_password"]) || $_SESSION["forget_password"] === false) {
    header("location:signup.php");
    exit;
}

if ($_SESSION["otp_verification"] == true) {
    echo "<!DOCTYPE html>
          <html lang='en'>
          <head>
          <link rel='icon' href='https://r.mobirisesite.com/757077/assets/images/gd988c37b5856e2e59bc61db248bd-h_m1ue2up7.png' type='image/x-icon'>
          <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.all.min.js'></script>
          <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.min.css' rel='stylesheet'>
          </head>
          <body>
          <script>
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true
            });
            Toast.fire({
              icon: 'success',
              title: 'OTP verification successful',
              background: '#8FBC8F',
              color: 'black',
              iconColor: 'white'
            });
          </script>
          </body></html>";
    $_SESSION["otp_verification"] = false;
}

$password = "";
$password_err = "";
$email = $_SESSION["forget_email"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = trim($_POST["password"]);
    $password_err = ""; // Initialize error message variable
    
    if (empty($password)) {
        $password_err = "Password cannot be empty.";
    } elseif (strlen($password) < 6) {
        $password_err = "Password must be at least 6 characters long.";
    }

    if (empty($password_err)) {
        // Hash the password before storing
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Prepare the SQL statement
        $stmt = $conn->prepare("UPDATE Myusers SET password=? WHERE email=?");
        $stmt->bind_param("ss", $hashed_password, $email);
        
        // Execute the statement
        if ($stmt->execute()) {
            $_SESSION["forget_password"] = false;
            $_SESSION["resend_otp"] = false;
            echo "<!DOCTYPE html>
                    <html lang='en'>
                    <head>
                    <link rel='icon' href='https://r.mobirisesite.com/757077/assets/images/gd988c37b5856e2e59bc61db248bd-h_m1ue2up7.png' type='image/x-icon'>
                    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.all.min.js'></script>
                    <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.min.css' rel='stylesheet'>
                    </head>
                    <body>
                    <script>
                    Swal.fire({
                        title: 'Password changed successfully...',
                        text: 'Sign In To Continue...',
                        icon: 'success',
                        backdrop: 'rgba(0,0,0,0.8)',
                    }).then(function() {
                        window.location = 'signup#signinblock';
                    });
                    </script>
                    </body>
                    </html>";
        } else {
            $password_err = "**Something went wrong. Try again...";
        }
        
        // Close the statement
        $stmt->close();
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="New Password">
	<meta name="description" content="New Password">
	<meta name="keywords" content="New Password">
	<title>New Password</title>
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
   background:linear-gradient(25deg,pink,#f0fff0);

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
	body{
	    background:linear-gradient(25deg,#ffa07a,#adadad);
	}
	</style>
</head>
<body>
    <div class="bg">
    <?php include('nav.php'); ?>
    <br><br><br>
	<div class="row" style="background:linear-gradient(25deg,black,purple);" >
		<h5 style="color:aqua;background-color:black"><b>Reset Password</b></h5>
		<br><h6 style="color:#fdf;font-weight:1000;font-size:15;" class="information-text" id="otp"><b>Enter New Password To Continue...</b></h6>
		<div class="form-group">
			<p id="check" style="color:red;font-weight:600;position:relative;"><?php 
if(!($password_err==""))
{
echo $password_err;
}
?></p>
			<form name="reset_password" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" onsubmit="return validate_password()")>
			<input type="password" name="password" id="password" required autofocus="autofocus">
			<p><label for="username" id="email_otp">Password</label></p>
			<button type="submit" >Reset Password</p></button>
			</form>
		</div>
		<div class="footer">
			<h5><a href="forget_password.php"><b style='color:#fafedf'>Go Back</b></a></h5>
			<br><h5><a href="signup.php#signinblock"><b style="color:#fafedf">For SignIn</b></a></h5>
		</div>
	</div>
</div>
<script>
function validate_password()
{
var b=document.reset_password.password.value;
var user_Regular_Expression=/^[0-9a-zA-Z]+$/;
if(b.length<6)
{
document.getElementById("check").innerHTML="* <b>Password Must Be Greater Than Or Equal to 6 Charecters</b>";
return false;
}
else if(b.match(user_Regular_Expression))
{
document.getElementById("check").innerHTML="* <b>Password Must Be Contain Alphabets,Digits & Special Charecters Ex:- <u>Contacts@55</u></b>";
return false;
}
else if(Number.isInteger(Number(b)))
{
document.getElementById("check").innerHTML="* <b>Password Must Be Contain Alphabets,Digits & Special Charecters Ex:- <u>Contacts@55</u></b>";
return false;
}
else if(!(/\d/.test(b)))
{
document.getElementById("check").innerHTML="* <b>Password Must Be Contain Alphabets,Digits & Special Charecters Ex:- <u>Contacts@55</u></b>";
return false;
}
else if(!(/[a-zA-Z]/.test(b)))
{
document.getElementById("check").innerHTML="* <b>Password Must Be Contain Alphabets,Digits & Special Charecters Ex:- <u>Contacts@55</u></b>";
return false;
}
}
</script>
</body>
</html>
<?php
// Include config file
require_once "connect_database.php";
session_start();
$_SESSION["otp_start"]=false;
$_SESSION["logged_in"] = false;
// Define variables and initialize with empty values
$username = $password = $email = "";
$username_err = $email_err= "";
 $_SESSION["sent_otp"]=false;
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Prepare a select statement
        $sql = "SELECT username FROM Myusers WHERE username = ?";
        
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $username_err = "**This Username is already taken. Sign In To Continue... ";
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
title:'This Username is already taken',
text:' Sign In To Continue... Or Else Use New One...',
icon:'warning',
iconColor:'Tomato',
backdrop:'rgba(0,0,0,0.6)',
 width:600,
  padding: '1em',
  background:'url(background_1155.jpg)',
}).then(function() {
    history.back();
});
</script></body></html>";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
        $sql = "SELECT username FROM Myusers WHERE email = ?";
        
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $email_err = "**This Email is already taken. Sign In To Continue...";
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
title:'This Email is already taken',
text:' Sign In To Continue... Or Else Use New One...',
icon:'warning',
iconColor:'Tomato',
backdrop:'rgba(0,0,0,0.6)',
 width:600,
  padding: '1em',
  background:'url(background_1155.jpg)',
}).then(function() {
    history.back();
});
</script></body></html>";
                    
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
        $password=trim($_POST["fpassword"]);
    if(empty($username_err) && empty($email_err)){
        $_SESSION["otp_start"]=true;
        $_SESSION["email_database"]=$email;
        $_SESSION["username_database"]=$username;
        $_SESSION["password_database"]=$password;
        header("location:signup_otp.php");
        }
    
    // Close connection
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="author" content="Dontharaveni Rajender">
	<meta name="description" content="Contacts Viewer">
	<meta name="keywords" content="Contacts Viewer, Signup Page, vcequestionpapers, Dontharaveni Rajender">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Contacts Viewer Signup Page</title>
    <link rel="icon" href="https://r.mobirisesite.com/757077/assets/images/gd988c37b5856e2e59bc61db248bd-h_m1ue2up7.png" type="image/x-icon">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- Clarity tracking code for https://www.vcequestionpapers.in/ --><script>    (function(c,l,a,r,i,t,y){        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i+"?ref=bwt";        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);    })(window, document, "clarity", "script", "l16wn132qe");</script>
<style>
body{
	margin:0;
	color:#f5f5dc;
	background:linear-gradient(35deg,pink, #e0ffff);
	font:600 16px/18px 'Open Sans',sans-serif;
}
*,:after,:before{box-sizing:border-box}
.clearfix:after,.clearfix:before{content:'';display:table}
.clearfix:after{clear:both;display:block}
a{color:inherit;text-decoration:none}

.login-wrap{
	width:100%;
	margin:auto;
	max-width:525px;
	min-height:700px;
	position:relative;
	background:url("bunnybackground.jpg") no-repeat center;
	box-shadow:0 12px 15px 0 rgba(0,0,0,.24),0 17px 50px 0 rgba(0,0,0,.19);
}
.login-html{
	width:100%;
	height:100%;
	position:absolute;
	padding:90px 70px 50px 70px;
	background:rgba(40,57,101,.9);
}
.login-html .sign-in-htm,
.login-html .sign-up-htm{
	top:0;
	left:0;
	right:0;
	bottom:0;
	position:absolute;
	transform:rotateY(180deg);
	backface-visibility:hidden;
	transition:all .4s linear;
}
.login-html .sign-in,
.login-html .sign-up,
.login-form .group .check{
	display:none;
}
.login-html .tab,
.login-form .group .label,
.login-form .group .button{
	text-transform:uppercase;
}
.login-html .tab{
	font-size:22px;
	margin-right:15px;
	padding-bottom:5px;
	margin:0 15px 10px 0;
	display:inline-block;
	border-bottom:2px solid transparent;
}
.login-html .sign-in:checked + .tab,
.login-html .sign-up:checked + .tab{
	color:#fff;
	border-color:#1161ee;
}
.login-form{
	min-height:345px;
	position:relative;
	perspective:1000px;
	transform-style:preserve-3d;
}
.login-form .group{
	margin-bottom:15px;
}
.login-form .group .label,
.login-form .group .input,
.login-form .group .button{
	width:100%;
	color:#fff;
	display:block;
}
.login-form .group .input,
.login-form .group .button{
	border:none;
	padding:15px 20px;
	border-radius:25px;
	background:rgba(255,255,255,.1);
}
.login-form .group input[data-type="password"]{
	text-security:circle;
	-webkit-text-security:circle;
}
.login-form .group .label{
	color:#aaa;
	font-size:12px;
}
.login-form .group .button{
	background:#1161ee;
}
.login-form .group label .icon{
	width:15px;
	height:15px;
	border-radius:2px;
	position:relative;
	display:inline-block;
	background:rgba(255,255,255,.1);
}
.login-form .group label .icon:before,
.login-form .group label .icon:after{
	content:'';
	width:10px;
	height:2px;
	background:#fff;
	position:absolute;
	transition:all .2s ease-in-out 0s;
}
.login-form .group label .icon:before{
	left:3px;
	width:5px;
	bottom:6px;
	transform:scale(0) rotate(0);
}
.login-form .group label .icon:after{
	top:6px;
	right:0;
	transform:scale(0) rotate(0);
}
.login-form .group .check:checked + label{
	color:#fff;
}
.login-form .group .check:checked + label .icon{
	background:#1161ee;
}
.login-form .group .check:checked + label .icon:before{
	transform:scale(1) rotate(45deg);
}
.login-form .group .check:checked + label .icon:after{
	transform:scale(1) rotate(-45deg);
}
.login-html .sign-in:checked + .tab + .sign-up + .tab + .login-form .sign-in-htm{
	transform:rotate(0);
}
.login-html .sign-up:checked + .tab + .login-form .sign-up-htm{
	transform:rotate(0);
}

.hr{
	height:1px;
	margin:30px 0 30px 0;
	background:rgba(255,255,255,.2);
}
.foot-lnk{
	text-align:center;
}
u{
color:yellow;
font-style:2;
}
.blink {
  animation: blink 3s infinite;
}

@keyframes blink {
  0% {
    opacity: 1;
  }
  50% {
    opacity: 0;
    transform: scale(2);
  }
  51% {
    opacity: 0;
    transform: scale(0);
  }
  100% {
    transform: scale(1);
    opacity: 1;
  }
}
/* responsive page css  */
* {
  box-sizing: border-box;
}

.row::after {
  content: "";
  clear: both;
  display: table;
}

[class*="col-"] {
  float: left;
  padding: 15px;
}

html {
  font-family: "Lucida Sans", sans-serif;
}

/* For mobile phones: */
[class*="col-"] {
  width: 100%;
}
@media only screen and (min-width: 1000px) {
 #vce{
     font-size: 18px;
 }
 .break{
  display:none;
 }
}
@media only screen and (max-width: 768px) {
 #vce{
     font-size: 18px;
 }
 .Logo{
     width:100%;
     padding:10px;
     padding-bottom:5px;
 }
 #logo_1{
     height:220;
 }
 #about{
     width: 75%;
     height: 1200;
 }
 #text1{
     color:black;
     text-align:left;
     font-size: 10px;
     font-family: Arial;
 }
 
 .text1{
     padding-top:2px;
 }
 .vaag_video{
     padding-top:2px;
 }
 .text22{
     font-size:10px;
     color: black;
     font-family: Arial;
     text-align: left;
 }
 .video1{
     padding-bottom:2px;
 }
 #okok3{
  width:80px;
  height: auto;
}
#okok1{
  width:84px;
  height: auto;
}
#okok2{
  width: 115px;
  height: auto;
}
#des{
  font-size: 10px;
  font-family: 'Times New Roman', Times, serif;
  color: black;
}
#copyright{
  font-size: 10px;
}
 .login-wrap{
	width:100%;
	margin:auto;
	max-width:300px;
	min-height:450px;
	position:relative;
	background:url("bunnybackground.jpg") no-repeat center;
	box-shadow:0 12px 15px 0 rgba(0,0,0,.24),0 17px 50px 0 rgba(0,0,0,.19);
}
.login-html{
	width:100%;
	height:100%;
	position:absolute;
	padding:40px 30px 15px 30px;
	background:rgba(40,57,101,.9);
}
.login-html .sign-in-htm,
.login-html .sign-up-htm{
	top:0;
	left:0;
	right:0;
	bottom:0;
	position:absolute;
	transform:rotateY(180deg);
	backface-visibility:hidden;
	transition:all .4s linear;
}
.login-html .sign-in,
.login-html .sign-up,
.login-form .group .check{
	display:none;
}
.login-html .tab,
.login-form .group .label,
.login-form .group .button{
	text-transform:uppercase;
}
.login-html .tab{
	font-size:12px;
	margin-right:6px;
	padding-bottom:1px;
	margin:0 18px 6px 0;
	display:inline-block;
	border-bottom:2px solid transparent;
}
.login-html .sign-in:checked + .tab,
.login-html .sign-up:checked + .tab{
	color:#fff;
	border-color:#1161ee;
}
.login-form{
	min-height:230px;
	position:relative;
	perspective:1000px;
	transform-style:preserve-3d;
}
.login-form .group{
	margin-bottom:6px;
}
.login-form .group .label,
.login-form .group .input,
.login-form .group .button{
	width:100%;
	color:#fff;
	display:block;
}
.login-form .group .input,
.login-form .group .button{
	border:none;
	padding:6px 10px;
	border-radius:10px;
	background:rgba(255,255,255,.1);
}
.login-form .group .input{
    font-size: 12px;
}
.login-form .group input[data-type="password"]{
	text-security:circle;
	-webkit-text-security:circle;
}
.login-form .group .label{
	color:#f5f5f5;
	font-size:8px;
}
.login-form .group .button{
	background:#1161ee;
}
.login-form .group label .icon{
	width:10px;
	height:10px;
	border-radius:2px;
	position:relative;
	display:inline-block;
	background:rgba(255,255,255,.1);
}
.login-form .group label .icon:before,
.login-form .group label .icon:after{
	content:'';
	width:8px;
	height:2px;
	background:#fff;
	position:absolute;
	transition:all .2s ease-in-out 0s;
}
.login-form .group label .icon:before{
	left:0.8px;
	width:4px;
	bottom:4px;
	transform:scale(0) rotate(0);
}
.login-form .group label .icon:after{
	top:3px;
	right:0;
	transform:scale(0) rotate(0);
}
.login-form .group .check:checked + label{
	color:#fff;
}
.login-form .group .check:checked + label .icon{
	background:#1161ee;
}
.login-form .group .check:checked + label .icon:before{
	transform:scale(1) rotate(45deg);
}
.login-form .group .check:checked + label .icon:after{
	transform:scale(1) rotate(-45deg);
}
#footlinks{
    font-size: 12px;
}
#signingreen{
    font-size:22px;
    text-align: center;
}
#keepme{
    font-size: 12px;
    padding-bottom:3px;
}
#button1{
    font-size: 15px;
}
.chekking{
    font-size: 12px;
}
#hh{
    margin:30px 0 20px 0;
}
#new{
    font-size: 15px;
    color: red;
}
#hrr{
    margin: 15px 0 20px 0;
}
#button123{
    padding-top:10px;
}
.designed{
    
}
#img123{
    width:60%;
    height: auto;
  box-shadow: 5px 5px 7px rgba(0, 0, 0, 0.4);
  border:6px solid white;
}
#designedby{
    font-size: 15px;
    font-weight: bold;
    text-align: left;
    padding-left:72px;
}
#icon111{
  top:25px;right:5px;
}
#icon112{
  top:79px;right:5px;
}
#icon113{
  top:25px;right:5px;
}
#icon114{
  top:79px;right:5px;
}
#icon115{
  top:133px;right:5px;
}
#icon116{
  top:187px;right:5px;
}
.links{
    width:90%;
    justify-content: center;
    align-content: center;
    align-items: center;
    background-color: #ffb6c1;
    padding: 50px;
    padding-top: 20px;
    padding-bottom: 20px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
#QuickLinks{
    font-size: 15px;
    font-family: Serif,cursive;
    color: black;
    text-align: center;
}
#pp{
    box-shadow: 5px 5px 7px rgba(0, 0, 0, 0.4);
    font-size: 12px;
    background-color:white;
    
}
#pp:hover{
    color: green;
    background-color: orange;
}
div.polaroid {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  margin-bottom:10px;
  padding-top: 18px;
}
.Organisingby{
    width: 75%;
    padding: 15px;
    padding-bottom: 10px;
    background-color: orange;
    text-align: center;
    color: black;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
#organising{
    font-size: 12px;
    text-align:left;
    padding-left: 10px;
    color: green;
}
.ok123{
    background-color: white;
    width:90%;
     background:url("background_1155.jpg");
    background-repeat: no-repeat;
  background-size:cover;
}
#img111{
    width: 100%;
    height: auto;
}
.image121{
    width: 30%;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    padding:1px;
    background-color: white;
}
.image221{
    width:50%;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    padding:1px;
    background-color: white;
}
#create123{
    font-size:12px;
    padding: 1px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    
}
}
@media only screen and (min-width: 600px) {
  /* For tablets: */
  .col-s-1 {width: 8.33%;}
  .col-s-2 {width: 16.66%;}
  .col-s-3 {width: 25%;}
  .col-s-4 {width: 33.33%;}
  .col-s-5 {width: 41.66%;}
  .col-s-6 {width: 50%;}
  .col-s-7 {width: 58.33%;}
  .col-s-8 {width: 66.66%;}
  .col-s-9 {width: 75%;}
  .col-s-10 {width: 83.33%;}
  .col-s-11 {width: 91.66%;}
  .col-s-12 {width: 100%;}
}
@media only screen and (min-width: 768px) {
  /* For desktop: */
  .col-1 {width: 8.33%;}
  .col-2 {width: 16.66%;}
  .col-3 {width: 25%;}
  .col-4 {width: 33.33%;}
  .col-5 {width: 41.66%;}
  .col-6 {width: 50%;}
  .col-7 {width: 58.33%;}
  .col-8 {width: 66.66%;}
  .col-9 {width: 75%;}
  .col-10 {width: 83.33%;}
  .col-11 {width: 91.66%;}
  .col-12 {width: 100%;}
  .Logo{
      width:100%;
      padding-left:25%;
      padding-right: 25%;
      background-color: #FFFFFF;
  }
  .setup{

  }
  .video1{
    padding-top:0%;
    width:100%;
    align-items: center;
    align-content: center;
    background-size: cover;
    background-repeat: no-repeat;
    backface-visibility: inherit;
  }
  .vaag_video{
    width:40%;
  }
.text1{
  width:100%;
  padding-bottom: 0%;
}
.text22{
  font-size: 16px;
  color: black;
  font-family:'Times New Roman', Times, serif;
}
#text1{
  font-size:18px;
}
#signingreen{
  font-size: 20px;
}
#footlinks{
  font-size: 15px;
}
#footlinks :hover{
  color: chocolate;
}
#check{
  font-size: 12px;
}
.about{
  width:100%;
}
#about{
  width:50%;
  height: auto;
}
.links{
    width:36%;
    justify-content: center;
    align-content: center;
    align-items: center;
    background-color: #ffb6c1;
    padding: 50px;
    padding-top: 10px;
    padding-bottom: 10px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
#QuickLinks{
    font-size: 30px;
    font-family: Serif,cursive;
    color: black;
}
#pp{
    box-shadow: 5px 5px 7px rgba(0, 0, 0, 0.4);
    font-size: 16px;
    background-color:white;
    
}
#pp:hover{
    color: green;
    background-color: orange;
}
.button-34{
  padding: 0%;
}
.designed
{
  width: 30%;
  background-color: white;
}
#bbb123{
  color: orangered;
  font-family:'Times New Roman', Times, serif;
  font-size: 18px;
  padding: 0%;
}
.div123{
  width:70%;
  margin: auto;
}
.ok123{
    background-color: white;
    width:95%;
     background:url("background_1155.jpg");
    background-repeat: no-repeat;
  background-size:cover;
}
#okok2{
  width:300px;
  height: auto;
}
#des{
  font-size: 15px;
  font-family: 'Times New Roman', Times, serif;
  color: black;
}
#okok3{
  width:200px;
  height: auto;
}
#okok1{
  width:208px;
  height: auto;
}
#img111{
    width:98%;
    height: auto;
}
#create123{
    font-size:15px;
    padding: 1px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    
}
#copyright{
  font-size: 12px;
}
.image121{
    width:20%;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    padding:1px;
    background-color: white;
    margin: auto;
}
.image221{
    width:25%;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    padding:1px;
    background-color: white;
    padding: 2%;
    margin: auto;
}
.Organisingby{
    width: 30%;
    padding: 15px;
    padding-bottom: 10px;
    background-color:orange;
    text-align: center;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    color:black;
}
#organising{
    font-size: 12px;
    text-align:left;
    padding-left: 10px;
    color: green;
}
#img123{
  width:95%;
  height: auto;
  border-top: 1px solid;
  padding-top:2%;
}
#designedby{
  text-align: left;
  padding-left: 2%;
}
.con123{
  padding: 0%;
}
#icon111{
  top:35px;right:10px;
}
#icon112{
  top:115px;right:10px;
}
#icon113{
  top:35px;right:10px;
}
#icon114{
  top:115px;right:10px;
}
#icon115{
  top:195px;right:10px;
}
#icon116{
  top:276px;right:10px;
}
  .box1 {
  box-shadow: 0px 3px 3px 0px rgba(0, 0, 0, 0.5);
}
.box:hover {
  transform: translateY(-5px);
  box-shadow: 0px 8px 10px 2px rgba(0, 0, 0, 0.25);
}
.box2 {
  box-shadow: 0px 5px 10px 0px rgba(0, 0, 0, 0.5);
}
.box2:hover {
  transform: scale(1.1);
  box-shadow: 0px 10px 20px 2px rgba(0, 0, 0, 0.25);
}
  #logo_1{
      height: auto;
  }
   #text1{
     color:black;
     text-align:left;
     font-family:Times New Roman;
 }
 .login-wrap{
	width:100%;
	margin:auto;
	max-width:435px;
	min-height:580px;
	position:relative;
	background:url("bunnybackground.jpg") no-repeat center;
	box-shadow:0 12px 15px 0 rgba(0,0,0,.24),0 17px 50px 0 rgba(0,0,0,.19);
}
.login-html{
	width:100%;
	height:100%;
	position:absolute;
	padding:40px 70px 50px 70px;
	background:rgba(40,57,101,.9);
}
.login-html .sign-in-htm,
.login-html .sign-up-htm{
	top:0;
	left:0;
	right:0;
	bottom:0;
	position:absolute;
	transform:rotateY(180deg);
	backface-visibility:hidden;
	transition:all .4s linear;
}
.login-html .sign-in,
.login-html .sign-up,
.login-form .group .check{
	display:none;
}
.login-html .tab,
.login-form .group .label,
.login-form .group .button{
	text-transform:uppercase;
}
.login-html .tab{
	font-size:22px;
	margin-right:15px;
	padding-bottom:5px;
	margin:0 15px 10px 0;
	display:inline-block;
	border-bottom:2px solid transparent;
}
.login-html .sign-in:checked + .tab,
.login-html .sign-up:checked + .tab{
	color:#fff;
	border-color:#1161ee;
}
.login-form{
	min-height:345px;
	position:relative;
	perspective:1000px;
	transform-style:preserve-3d;
}
.login-form .group{
	margin-bottom:15px;
}
.login-form .group .label,
.login-form .group .input,
.login-form .group .button{
	width:100%;
	color:#fff;
	display:block;
}
.login-form .group .input,
.login-form .group .button{
	border:none;
	padding:15px 20px;
	border-radius:25px;
	background:rgba(255,255,255,.1);
}
.login-form .group input[data-type="password"]{
	text-security:circle;
	-webkit-text-security:circle;
}
.login-form .group .label{
	color:#aaa;
	font-size:12px;
}
.login-form .group .button{
	background:#1161ee;
}
.login-form .group label .icon{
	width:15px;
	height:15px;
	border-radius:2px;
	position:relative;
	display:inline-block;
	background:rgba(255,255,255,.1);
}
.login-form .group label .icon:before,
.login-form .group label .icon:after{
	content:'';
	width:10px;
	height:2px;
	background:#fff;
	position:absolute;
	transition:all .2s ease-in-out 0s;
}
.login-form .group label .icon:before{
	left:3px;
	width:5px;
	bottom:6px;
	transform:scale(0) rotate(0);
}
.login-form .group label .icon:after{
	top:6px;
	right:0;
	transform:scale(0) rotate(0);
}
.login-form .group .check:checked + label{
	color:#fff;
}
.login-form .group .check:checked + label .icon{
	background:#1161ee;
}
.login-form .group .check:checked + label .icon:before{
	transform:scale(1) rotate(45deg);
}
.login-form .group .check:checked + label .icon:after{
	transform:scale(1) rotate(-45deg);
}
.login-html .sign-in:checked + .tab + .sign-up + .tab + .login-form .sign-in-htm{
	transform:rotate(0);
}
.login-html .sign-up:checked + .tab + .login-form .sign-up-htm{
	transform:rotate(0);
}

.hr{
	height:1px;
	margin:30px 0 30px 0;
	background:rgba(255,255,255,.2);
}
#hrr{
  padding: 0%;
  margin:20px 0 20px 0;
}
.foot-lnk{
	text-align:center;
}
u{
color:yellow;
font-style:2;
}
.blink {
  animation: blink 3s infinite;
}

@keyframes blink {
  0% {
    opacity: 1;
  }
  50% {
    opacity: 0;
    transform: scale(2);
  }
  51% {
    opacity: 0;
    transform: scale(0);
  }
  100% {
    transform: scale(1);
    opacity: 1;
  }
}
/* responsive page css  */
* {
  box-sizing: border-box;
}

.row::after {
  content: "";
  clear: both;
  display: table;
}
#hide{
    font-size:12px;
}
 
}
@media only screen and (min-width: 1200px) {
  .Logo{
      width:100%;
      padding-left:30%;
      padding-right: 30%;
      background-color: #FFFFFF;
  }
  #hide{
    font-size:16px;
}
  .ok123{
    width:60%;
  }
  .links{
    width: 20%;
    padding: 2%;
  }
  #about{
    width:22%;
  }
  #pp{
    box-shadow: 5px 5px 7px rgba(0, 0, 0, 0.4);
    font-size: 12px;
    background-color:white;
    padding: 0%;
    
}
#QuickLinks{
    font-size: 25px;
    font-family: Serif,cursive;
    color: black;
}

}
.button-21 {
  align-items: center;
  appearance: none;
  background-color: #3EB2FD;
  background-image: linear-gradient(1deg, #4F58FD, #149BF3 99%);
  background-size: calc(100% + 20px) calc(100% + 20px);
  border-radius: 90px;
  border-width: 0;
  box-shadow: none;
  box-sizing: border-box;
  color: #FFFFFF;
  cursor: pointer;
  display: inline-flex;
  font-family: CircularStd,sans-serif;
  font-size: 1rem;
  height: auto;
  justify-content: center;
  line-height: 1.5;
  padding: 2px 10px;
  position: relative;
  text-align: center;
  text-decoration: none;
  transition: background-color .2s,background-position .2s;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  vertical-align: top;
  white-space: nowrap;
}

.button-21:active,
.button-21:focus {
  outline: none;
}

.button-21:hover {
  background-position: -20px -20px;
}

.button-21:focus:not(:active) {
  box-shadow: rgba(40, 170, 255, 0.25) 0 0 0 .125em;
}
.button-34:active,
.button-34:focus {
  outline: none;
}

.button-34:hover {
  background-position: -20px -20px;
}

.button-34:focus:not(:active) {
  box-shadow: rgba(40, 170, 255, 0.25) 0 0 0 .125em;
}
.button-34 {
  background: #5E5DF0;
  border-radius:888px;
  box-shadow: #5E5DF0 0 10px 20px -10px;
  box-sizing: border-box;
  color: #FFFFFF;
  cursor: pointer;
  font-family: Inter,Helvetica,"Apple Color Emoji","Segoe UI Emoji",NotoColorEmoji,"Noto Color Emoji","Segoe UI Symbol","Android Emoji",EmojiSymbols,-apple-system,system-ui,"Segoe UI",Roboto,"Helvetica Neue","Noto Sans",sans-serif;
  font-size: 12px;
  font-weight: 550;
  line-height: 20px;
  opacity: 1;
  outline: 0 solid transparent;
  padding: 5px 12px;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  width: fit-content;
  word-break: break-word;
  border: 0;
}
#areyounew{
    font-size: 15px;
    color: #f0ffff;
}
.scroll-container{
    display: flext;
}
.section2{
    display:flext;
}
.js-scroll {
  opacity: 0;
  transition: opacity 500ms;
}

.js-scroll.scrolled {
  opacity: 1;
}

.scrolled.fade-in {
  animation: fade-in 1s ease-in-out both;
}

.scrolled.fade-in-bottom {
  animation: fade-in-bottom 1s ease-in-out both;
}

.scrolled.slide-left {
  animation: slide-in-left 1s ease-in-out both;
}

.scrolled.slide-right {
  animation: slide-in-right 1s ease-in-out both;
}
@keyframes slide-in-left {
  0% {
    -webkit-transform: translateX(-100px);
    transform: translateX(-100px);
    opacity: 0;
  }
  100% {
    -webkit-transform: translateX(0);
    transform: translateX(0);
    opacity: 1;
  }
}

@keyframes slide-in-right {
  0% {
    -webkit-transform: translateX(100px);
    transform: translateX(100px);
    opacity: 0;
  }
  100% {
    -webkit-transform: translateX(0);
    transform: translateX(0);
    opacity: 1;
  }
}

@keyframes fade-in-bottom {
  0% {
    -webkit-transform: translateY(50px);
    transform: translateY(50px);
    opacity: 0;
  }
  100% {
    -webkit-transform: translateY(0);
    transform: translateY(0);
    opacity: 1;
  }
}

@keyframes fade-in {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}
.div123{
  background:url("background_1155.jpg");
  background-repeat: no-repeat;
  background-size: cover;
}
div.container {
  text-align: center;
  background-color: white;
  padding-bottom: 6px;
  padding-top:6px;
}
#p{
    font-size: 10px;
}
#anyqueries{
    font-size:15px;
    padding-left: 25px;
    padding-bottom: 10px;
}
.icons{
    padding-left: 40px;
}
#icons1:hover{
    color: red;
}
#icons1{
    text-align: left;
}
div.container1 {
  text-align: center;
  background-color: white;
}
div.container2 {
  text-align: center;
  background-color: white;
  padding-bottom:1px;
  padding-top:1px;
}
#myBtn {
  display: none;
  position: fixed;
  bottom: 20px;
  right: 20px;
  z-index: 60;
  font-size: 16px;
  border: none;
  outline: none;
  background-color: red;
  color: white;
  cursor: pointer;
  padding: 10px;
  border-radius: 4px;
}
#myBtn:hover {
  background-color: #555;
}
</style>
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3221903981743343"
     crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-sm navbar-light bg-light fixed-top">

  <div class="container-fluid">

    <a class="navbar-brand" href="HomePage">
        <img src="https://r.mobirisesite.com/757077/assets/images/gd988c37b5856e2e59bc61db248bd-h_m1ue2up7.png" alt="Logo" style="width:60px;" class="rounded-pill">&nbsp;&nbsp;<b id="vce">Contacts Viewer</b></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mynavbar">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="HomePage" id="hide">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://portfolio.vcequestionpapers.xyz/" id="hide">Developer</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="signup#signinblock" style="color:green;">Get Started</a>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="text" placeholder="Search">
        <button class="btn btn-primary" type="button">Search</button>
      </form>
    </div>
  </div>
</nav>
<br><br><br><br>
<section class="section1">
  <div id="signup_interface">
    <h1 style="color:green;font-weight:bold;text-align:center;" id="signingreen">
      <p>***SignIn To Get Contacts***</p>
    </h1>
    <div class="login-wrap box" id="signinblock">
      <div class="login-html" style="background:linear-gradient(25deg,#483D8B,black,#483D8B);">
        <p class="chekking" id="check" style="color:red;font-weight:bold;position:relative;">
          <?php 
            if(!($username_err=="")) {
                echo $username_err;
            } else if(!($email_err=="")) {
                echo $email_err;
            } else if(!($account_success=="")) {
                echo $account_success;
            }
          ?>
        </p>
        <input id="tab-1" type="radio" name="tab" class="sign-in" checked>
        <label for="tab-1" class="tab" id="s124">Sign In</label>
        <input id="tab-2" type="radio" name="tab" class="sign-up">
        <label for="tab-2" class="tab" id="s123">Sign Up</label>
        <div class="login-form">
          <!-- Sign In Form -->
          <div class="sign-in-htm">
            <form name="signin" action="userlogin.php" method="post" onsubmit="return validation1()">
              <div class="group">
                <i style="position:absolute;color:#fff;" id="icon111" class='bx bxs-user'></i>
                <label for="user" class="label">Username</label>
                <input id="username" type="text" class="input" name="username" required>
              </div>
              <div class="group" style="position: relative;">
                <label for="pass" class="label">Password</label>
                <input id="password" type="password" class="input" name="password" required>
                <!-- Eye Icon for Toggle -->
                <i id="togglePassword" style="cursor: pointer; position: absolute; right: 10px; top: 70%; transform: translateY(-70%);" class="fas fa-eye"></i>
              </div>
              <div class="group">
                <input id="check" type="checkbox" class="check" checked>
                <label for="check" id="keepme"><span class="icon"></span> Keep me Signed in</label>
              </div>
              <div class="group" id="button1">
                <input type="submit" class="button" value="Sign In">
              </div>
            </form>
            <div class="hr" id="hh"></div>
            <div class="foot-lnk f1">
              <a href="forget_password" target="new"><h3 id="footlinks">Forgot Password?</h3></a>
            </div>
            <br>
            <div class="foot-lnk f2">
              <a href="forget_username" target="new"><b><h3 id="footlinks">Forgot Username?</h3></b></a><br>
              <button class="button-21" role="button">
                <label for="tab-2"><b id="areyounew">Are You NEW?</b></label>
              </button>
            </div>
          </div>

          <!-- Sign Up Form -->
          <div class="sign-up-htm">
            <form name="signup" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validation2()">
              <div class="group">
                <i style="position:absolute;color:#fff;" id="icon113" class='bx bxs-user'></i>
                <label for="user" class="label">Username</label>
                <input id="username" type="text" class="input" name="username" required>
              </div>
              <div class="group" style="position: relative;">
                <label for="pass" class="label">Password</label>
                <input id="fpassword" type="password" class="input" name="fpassword" required>
                <!-- Eye Icon for Toggle -->
                <i id="toggleFPassword" style="cursor: pointer; position: absolute; right: 10px; top: 70%; transform: translateY(-70%);" class="fas fa-eye"></i>
              </div>
              <div class="group" style="position: relative;">
                <label for="pass" class="label">Repeat Password</label>
                <input id="spassword" type="password" class="input" name="spassword" required>
                <!-- Eye Icon for Toggle -->
                <i id="toggleSPassword" style="cursor: pointer; position: absolute; right: 10px; top: 70%; transform: translateY(-70%);" class="fas fa-eye"></i>
              </div>
              <div class="group">
                <i style="position:absolute;color:#fff;" id="icon116" class='bx bxs-envelope'></i>
                <label for="pass" class="label">Email Address</label>
                <input id="email" type="text" class="input" name="email" required>
              </div>
              <div class="group" id="button123">
                <input type="submit" class="button" value="Sign Up">
              </div>
            </form>
            <div class="hr" id="hrr"></div>
            <div class="foot-lnk">
              <button class="button-34" role="button"><label for="tab-1">Already Member?</label></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

   <br>
   <div class="break">
    <br><br><br>
   </div>
   <footer>
   <p style="color:white;background-color:black;text-align:center;" id="copyright">Copyright All Right Reserved 2024,Dontharaveni Rajender</p>
   </footer>
   <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
<script>
    const scrollElements = document.querySelectorAll(".js-scroll");

const elementInView = (el, dividend = 1) => {
  const elementTop = el.getBoundingClientRect().top;

  return (
    elementTop <=
    (window.innerHeight || document.documentElement.clientHeight) / dividend
  );
};

const elementOutofView = (el) => {
  const elementTop = el.getBoundingClientRect().top;

  return (
    elementTop > (window.innerHeight || document.documentElement.clientHeight)
  );
};

const displayScrollElement = (element) => {
  element.classList.add("scrolled");
};

const hideScrollElement = (element) => {
  element.classList.remove("scrolled");
};

const handleScrollAnimation = () => {
  scrollElements.forEach((el) => {
    if (elementInView(el, 1.25)) {
      displayScrollElement(el);
    } else if (elementOutofView(el)) {
      hideScrollElement(el)
    }
  })
}

window.addEventListener("scroll", () => { 
  handleScrollAnimation();
});
</script>
<script>
function validation1()
{
var a=document.signin.username.value;
var user_Regular_Expression=/^[0-9a-zA-Z]+$/;
if(a.length<6)
{
document.getElementById("check").innerHTML="*<b>Username length Must Be 6 or Above</br>";
return false;
}
else if(!(a.match(user_Regular_Expression)))
{
document.getElementById("check").innerHTML="* <b>Username Must Be Contains Letters And Digits And No Special Charecters Are Allowed Ex- <u>ContactsViewer55</u></b>";
return false;
}
else if(Number.isInteger(Number(a)))
{
document.getElementById("check").innerHTML="* <b>Must Be Username contains Letters And Numbers Ex- <u>ContactsViewer55</u></b>";
return false;
}
else if(!(/\d/.test(a)))
{
document.getElementById("check").innerHTML="* <b>Must Be Username contains Letters And Numbers Ex- <u>ContactsViewer55</u></b>";
return false;
}
}
function validation2()
{
var a=document.signup.username.value;
var b=document.signup.fpassword.value;
var c=document.signup.spassword.value;
var d=document.signup.email.value;
var password_Regular_Expression=/^[0-9a-zA-Z]+$/;
var user_Regular_Expression=/^[0-9a-zA-Z]+$/;
var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
if(a.length<6)
{
document.getElementById("check").innerHTML="*<b>Username length Must Be 6 or Above</br>";
return false;
}
else if(!(a.match(user_Regular_Expression)))
{
document.getElementById("check").innerHTML="* <b>Username Must Be Contains Letters And Digits And No Special Charecters Are Allowed Ex- <u>ContactsViewer55</u></b>";
return false;
}
else if(Number.isInteger(Number(a)))
{
document.getElementById("check").innerHTML="* <b>Must Be Username contains Letters And Numbers Ex- <u>ContactsViewer55</u></b>";
return false;
}
else if(!(/\d/.test(a)))
{
document.getElementById("check").innerHTML="* <b>Must Be Username contains Letters And Numbers Ex-<u>ContactsViewer55</u></b>";
return false;
}
else if(b.length<6)
{
document.getElementById("check").innerHTML="* <b>Password Must Be Greater Than Or Equal to 6 Charecters</b>";
return false;
}
else if(b.match(user_Regular_Expression))
{
document.getElementById("check").innerHTML="* <b>Password Must Be Contain Alphabets,Digits & Special Charecters Ex:- <u>ContactsViewer@55</u></b>";
return false;
}
else if(Number.isInteger(Number(b)))
{
document.getElementById("check").innerHTML="* <b>Password Must Be Contain Alphabets,Digits & Special Charecters Ex:- <u>ContactsViewer@55</u></b>";
return false;
}
else if(!(/\d/.test(b)))
{
document.getElementById("check").innerHTML="* <b>Password Must Be Contain Alphabets,Digits & Special Charecters Ex:- <u>ContactsViewer@55</u></b>";
return false;
}
else if(!(/[a-zA-Z]/.test(b)))
{
document.getElementById("check").innerHTML="* <b>Password Must Be Contain Alphabets,Digits & Special Charecters Ex:- <u>ContactsViewer@55</u></b>";
return false;
}
else if(b!=c)
{
document.getElementById("check").innerHTML="* <b>Password Does Not Matched<b>";
return false;
}
else if(!(d.match(mailformat)))
{
document.getElementById("check").innerHTML="* <b>Invalid Email Address</b>";
return false;
}
}
</script>
<script>
// Get the button
let mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 140 || document.documentElement.scrollTop > 140) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}
// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>
<script>
    // Toggle password visibility for Sign In password field
const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#password');

togglePassword.addEventListener('click', function () {
    // Toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    
    // Toggle the eye / eye-slash icon
    this.classList.toggle('fa-eye');
    this.classList.toggle('fa-eye-slash');
});

// Toggle password visibility for Sign Up password field
const toggleFPassword = document.querySelector('#toggleFPassword');
const fpassword = document.querySelector('#fpassword');

toggleFPassword.addEventListener('click', function () {
    const type = fpassword.getAttribute('type') === 'password' ? 'text' : 'password';
    fpassword.setAttribute('type', type);
    this.classList.toggle('fa-eye');
    this.classList.toggle('fa-eye-slash');
});

const toggleSPassword = document.querySelector('#toggleSPassword');
const spassword = document.querySelector('#spassword');

toggleSPassword.addEventListener('click', function () {
    const type = spassword.getAttribute('type') === 'password' ? 'text' : 'password';
    spassword.setAttribute('type', type);
    this.classList.toggle('fa-eye');
    this.classList.toggle('fa-eye-slash');
});

</script>
</body>
</html>
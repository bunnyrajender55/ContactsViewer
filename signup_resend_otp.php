<?php
session_start();
// Initialize the session
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["forget_password"]) || $_SESSION["forget_password"]===false){
    header("location:signup.php");
    exit;
}
?>
<?php
require_once "connect_database.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
$email="";
$username="";
$email=$_SESSION["forget_email"];
$otp=rand(100000,999999);
$_SESSION["otp_database"]=$otp;
$username=$_SESSION["username_database"];
if(ctype_alnum($username))
{

require 'Exception.php';
require 'PhpMailer.php';
require 'SMTP.php';
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
?>
<p hidden>
<?php

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'contactsviewer.vcequestionpapers.xyz';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'no_reply@contactsviewer.vcequestionpapers.xyz';                     //SMTP username
    $mail->Password   = 'Bunny@2255';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('no_reply@contactsviewer.vcequestionpapers.xyz', 'Dontharaveni Rajender');
    $mail->addAddress($email);

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "OTP Resent Successfully";
    $mail->Body    = '<img src="https://lh3.googleusercontent.com/pw/AP1GczPMVeBgGOESz4QW_1iJZa5ByzKKXNB2nK3EVw3gdRs_upd_z2EMZa821oS-JPUVVNHDuwgEbpzIdiDtfHeUG-FR4Fcd0Ei4FYNgYMebCzfnx4nM_Jw=w2400" width="800px" hight="auto" />
    <br><br>
    <h1 style="color:red">Hii &nbsp;'.$username.'</h1>
    <h2 style="color:#ff8c00">Welcome To My Website</h2>
    <h4 style="color:#00008b;">For Signup To My Website...<br>
    You Have To Validate Your Email Address<br>
    For That You Have To Confirm The OTP<br>
    <b style="color:green;">Your One Time Password Is</b>&nbsp;&nbsp;<i style="color:red;">***'.$otp.'***</i>
    <br><br><br><br>
    <b style="color:#800080;font-size:30">For Any Queries...<br>Contact Me In instagram<br></b></h4>
    <a href="https://instagram.com/bunnyrajender55?igshid=NTc4MTIwNjQ2YQ=="><img src="https://lh3.googleusercontent.com/7LTwoUtFyVblVQ_AP8HPOQbsNKhNMNW4r3jMmMy1vDwtKAFol2XMqJRRW_aAE8azNZ1OwAs6AgtD2CYToAKqtA6YU8t3Y2OLBsivrHcnCJszJjxgVeT1J4Xjdun5VxtZ55Sp54IvXA=w600-h315-p-k" width="12" height="12" />BunnyRajender</a>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
                            
                            // Store data in session variables
                            $_SESSION["forget_password"] = true;
                            $_SESSION["forget_email"] = $email;
                      $_SESSION["resend_otp"]=true;

 echo "<!DOCTYPE html>
                    <html lang='en'>
                    <head>
                    <meta name='viewport' content='width=device-width, initial-scale=1'>
                    <style>
                   
                    h3{
                        color:red;
                    }
                    #h2{
                        font-style:italic;
                    }
                    p{
                        color:brown;
                    }
                    #bold{
                        color:green;
                    }
                     @media only screen and (max-width: 768px)
                     {
                         #pc{
                             display:none;
                         }
                          #img{
                        width:90%;
                        height:auto;
                        border:solid 1px;
                    }
                    #lable{
                        font-size:10px;
                        color:red;
                    }
                    #bold1{
                        font-size:12px;
                    }
                    p{
                        font-size:11px
                    }
                     #h2{
                        font-size:18px;
                    }
                        
                     }
                     
                     @media only screen and (min-width: 768px)
                     {
                           #mobile{
                             display:none;
                         }
                          #img{
                        width:85%;
                        height:auto;
                         border:solid 2px;
                    }
                     }
                    </style>
                    <link rel='icon' href='https://r.mobirisesite.com/757077/assets/images/gd988c37b5856e2e59bc61db248bd-h_m1ue2up7.png' type='image/x-icon'>
                    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.all.min.js
'></script>
<link href='https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.min.css
' rel='stylesheet'>
</head>
<body>
<script>
swal.fire({
title:'Attention...',
showCloseButton:true,
html:`
<div id='pc'>
<b id='bold1'>Dear freinds check once your Gmail spam folder for OTP</b><br>
<p><b>
<h2 id='h2'>Do follow bellow steps...</h2>
<br>
<h3><strong>1</strong>-Open Gmail & Click on 'More'</h3>
<img src='gmail1.png' alt='' id='img'>
<br>
<br>
<h3><strong>2</strong>-Click on 'Spam'</h3>
<img src='gmail2.png' alt='' id='img'>
<br>
<br>
<h3><strong>3</strong>-Click on 'Not Spam'</h3>
<img src='gmail3.png' alt='' id='img'>
<br>
<br>
<h3><strong>4</strong>-Goto Inbox & Open message sent from 'Bunny Rajender'</h3>
<img src='gmail4.png' alt='' id='img'>
</div>
<div id='mobile'>
<b id='bold1'>Dear freinds follow bellow instructions...for <u>OTP verification</u></b><br>
<p><b>Due to financial adjustments our website running with less investment.</b><br>That is why <b id='bold'>OTP</b> to your email is going to <br><b id='bold'>'SPAM' folder</b>.<br>Click on <b id='bold'>'Not Spam'</b> to receive emails directly to <br>your<b id='bold'> 'Inbox.'</b><br></p>
<h2 id='h2'>Do follow bellow steps...</h2>
<br>
<table>
<tr>
<td>
<i id='lable'><strong>1</strong>-Open Gmail App &<br> Click on below icon</i>
</td>
<td>
<i id='lable'><strong>2</strong>-Click on 'Spam'</i>
</td>
</tr>
<tr>
<td>
<img src='gmail11.jpg' alt='' id='img'>
</td>
<td>
<img src='gmail22.jpg' alt='' id='img'>
</td>
</tr>
</table>
<br>
<table>
<tr>
<td>
<i id='lable'><strong>3</strong>-Open message from<br> 'Bunny Rajender'</i>
</td>
<td>
<i id='lable'><strong>4</strong>-Click on<br> 'Report not spam'</i>
</td>
</tr>
<tr>
<td>
<img src='gmail33.jpg' alt='' id='img'>
</td>
<td>
<img src='gmail44.jpg' alt='' id='img'>
</td>
</tr>
</table>
<br>
<table>
<tr>
<td>
<i id='lable'><strong>5</strong>-Goto Inbox &<br> Open message</i>
</td>
<td>
<i id='lable'><strong>6</strong>-Copy the OTP &<br>Paste it in website</i>
</td>
</tr>
<tr>
<td>
<img src='gmail55.jpg' alt='' id='img'>
</td>
<td>
<img src='gmail66.jpg' alt='' id='img'>
</td>
</tr>
</table>
</div>

`,
icon:'info',
backdrop:'rgba(0,0,0,0.6)',
width:1000,
}).then(function() {
    window.location='signup_otp_verification';
});
</script></body></html>";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
$conn->close();
?>
</p>
<?php
}
else
{
    echo "<script>window.alert('Username must be alphanumeric...');
</script>";
echo "<h1 style='text-align:center;color:red;'>Username must be alphanumeric</h1>";
}
?>
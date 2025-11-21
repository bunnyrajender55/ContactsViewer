<?php
session_start();
if(!isset($_SESSION["otp_start"]) || $_SESSION["otp_start"]===false)
{
    header("location:signup.php");
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
// Define variables and initialize with empty values
$useremail="";
$username="";
$email_err="";
$otp=rand(100000,999999);
$_SESSION["otp_database"]=$otp;
$useremail=$_SESSION["email_database"];
$username=$_SESSION["username_database"];
$_SESSION["sent_otp"]=false;
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
    $mail->Username   = 'no-reply@contactsviewer.vcequestionpapers.xyz';                     //SMTP username
    $mail->Password   = 'Bunny@2255';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('no-reply@contactsviewer.vcequestionpapers.xyz', 'Dontharaveni Rajender');
    $mail->addAddress($useremail);
    $mail->addCc('bunnyrajender77@gmail.com');

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "SIGN IN VERIFICATION...";
    $mail->Body    ='<img src="https://lh3.googleusercontent.com/pw/AP1GczPMVeBgGOESz4QW_1iJZa5ByzKKXNB2nK3EVw3gdRs_upd_z2EMZa821oS-JPUVVNHDuwgEbpzIdiDtfHeUG-FR4Fcd0Ei4FYNgYMebCzfnx4nM_Jw=w2400" width="800px" hight="auto" />
    <br><br>
    <h1 style="color:red">Hii &nbsp;'.$username.'</h1>
    <h2 style="color:#ff8c00">Welcome To My Website</h2>
    <h4 style="color:#00008b;">For Signup To My Website...<br>
    You Have To Validate Your Email Address<br>
    For That You Have To Confirm The OTP<br>
    <b style="color:green;">Your One Time Password Is</b>&nbsp;&nbsp;<i style="color:red;">***'.$otp.'***</i>
    <br><br><br><br>
    <b style="color:#800080;font-size:50;">For Any Queries...<br>Contact Me In instagram<br></b></h4>
    <a href="https://instagram.com/bunnyrajender55?igshid=NTc4MTIwNjQ2YQ=="><img src="https://lh3.googleusercontent.com/7LTwoUtFyVblVQ_AP8HPOQbsNKhNMNW4r3jMmMy1vDwtKAFol2XMqJRRW_aAE8azNZ1OwAs6AgtD2CYToAKqtA6YU8t3Y2OLBsivrHcnCJszJjxgVeT1J4Xjdun5VxtZ55Sp54IvXA=w600-h315-p-k" width="12" height="12" />BunnyRajender</a>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
                            
                            // Store data in session variables
                            $_SESSION["forget_password"] = true;
                            $_SESSION["forget_email"] = $useremail;
                    $_SESSION["email_username"]=$username;
$_SESSION["resend_otp"]=false;
$_SESSION["sent_otp"]=true;
header("location:signup_otp_verification");
exit();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
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
<?php
session_start();

// Initialize the session
if(!$_SESSION["logged_in"]){
    header("location: signup.php");
    exit;
}
?>
<?php
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
Swal.fire({
  title: 'Delete Account',
  text:'Are you sure you want to delete your account? This action cannot be undone.',
  icon: 'question',
  showCancelButton: true,
  showCloseButton: true,
  focusConfirm: true,
  backdrop:'rgba(0,0,0,0.8)',
  confirmButtonColor: '#6495ED',
  cancelButtonColor: '#8FBC8F',
  confirmButtonText: 'Yes',
  cancelButtonText:'No'
}).then((result) => {
  if (result.isConfirmed) {
     window.location='del_acc_succ';
  }
  else
  {
      history.back();
  }
});
</script></body></html>";
?>
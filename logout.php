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
  title: 'Are you want to logout?',
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
    Swal.fire({
      title:'You have successfully Logged Out' ,
      text:'Click on OK to continue...' ,
      icon: 'success',
      backdrop:'rgba(0,0,0,0.8)'
    }).then(function() {
    window.location='logout_successful';
});
  }
  else
  {
      history.back();
  }
});
</script></body></html>";
?>
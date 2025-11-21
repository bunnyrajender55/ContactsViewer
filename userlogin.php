<?php

// Include config file
require_once "connect_database.php";

// Define variables and initialize with empty values
$username = $password = "";
$email="";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // Use a prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT username, password, email FROM Myusers WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Fetch the user data
        $row = $result->fetch_assoc();
        $email = $row["email"];
        $hashed_password = $row["password"];

        // Verify the password hash
        if (password_verify($password, $hashed_password)) {
            // Store data in session variables
            session_start();
            $_SESSION["logged_in"] = true;
            $_SESSION["username"] = $username;
            $_SESSION["user_email_id"] = $email;

            // General login for all users
            echo "<!DOCTYPE html>
            <html lang='en'>
            <head>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <link rel='icon' href='https://r.mobirisesite.com/757077/assets/images/gd988c37b5856e2e59bc61db248bd-h_m1ue2up7.png' type='image/x-icon'>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.all.min.js'></script>
            <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.min.css' rel='stylesheet'>
            </head>
            <body style='background-color:black;'>
            <script>
            const Toast = Swal.mixin({
              toast: true,
              position: 'center',
              showConfirmButton: false,
              timer: 1000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
              }
            });
            Toast.fire({
              icon: 'success',
              title: 'Login successful...',
            }).then(function() {
                window.location='retrieve.php';
            });
            </script></body></html>";

        } else {
            echo "<!DOCTYPE html>
            <html lang='en'>
            <head>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <link rel='icon' href='https://r.mobirisesite.com/757077/assets/images/gd988c37b5856e2e59bc61db248bd-h_m1ue2up7.png' type='image/x-icon'>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.all.min.js'></script>
            <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.min.css' rel='stylesheet'>
            </head>
            <body>
            <script>
            Swal.fire({
                title:'Oops...',
                text:'Incorrect Password For This Username...',
                icon:'error',
            }).then(function() {
                history.back();
            });
            </script></body></html>";
        }
    } else {
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='icon' href='https://r.mobirisesite.com/757077/assets/images/gd988c37b5856e2e59bc61db248bd-h_m1ue2up7.png' type='image/x-icon'>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.all.min.js'></script>
        <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.min.css' rel='stylesheet'>
        </head>
        <body>
        <script>
        Swal.fire({
            title:'Username Does Not Exist...',
            text:'Go And Signup To Create An Account...',
            icon:'warning',
        }).then(function() {
            history.back();
        });
        </script></body></html>";
    }
    $stmt->close();
    $conn->close();
}
?>

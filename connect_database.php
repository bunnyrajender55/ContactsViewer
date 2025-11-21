<?php
$account_success="";
$servername = "localhost";
$username = "lkxmbkjs_bunnyrajender77";
$password = "Bunny@2255";
$dbname = "lkxmbkjs_vcf_project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
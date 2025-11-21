<?php
// Initialize the session
session_start();
 
if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === false){
    header("location: signup.php");
    exit;
}
?>
<?php 
// Include the database configuration file  
require_once 'connect_database.php'; 
 
// If file upload form is submitted 
$branch=$syllabus_type=$sem=$subject=$Acedamic_Subject=$paper_year=$paper_type="";
$error=$sql="";
$r22=array();
$r20=array();
$r18=array();
$total=array();
$current=array();
$i=$j=$k=0;
$iii_year="2018";
$kk=1;
$cse_2020=0;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $branch=$_POST["branch"];
    $syllabus_type=$_POST["syllabus_type"];
    $sem=$_POST["sem"];
    $subject=$_POST["subject"];
    $Acedamic_Subject=substr($subject,9);
    $paper_year=$_POST["paper_year"];
    $paper_type=$_POST["paper_type"];
    if($syllabus_type==2)
    {
        if($branch==1)
        {
            $cse_2020=1;
        }
    }
    if(!($paper_year=="0"))
    {
    $sql ="select * from QuestionPapers where Acedamic_Subject='$Acedamic_Subject' and paper_year='$paper_year' and paper_type='$paper_type' order by page_no";
    }
    else
    {
        $sql ="select * from QuestionPapers where Acedamic_Subject='$Acedamic_Subject' and paper_type='$paper_type' order by page_no";
    }
    $result = $conn->query($sql);

    if ($result->num_rows>0)
    {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
              <meta charset="utf-8">
    <meta name="author" content="Bunny Rajender">
	<meta name="description" content="Vaagdevi College Of Engineering">
	<meta name="keywords" content="Vaagdevi College Of Engineering ,Result Page">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Showing QPapers</title>
  <link rel="icon" href="https://lh3.googleusercontent.com/pw/AIL4fc9IGEB31P0kx2jVJ6SC3i-fJNq-OEyvGTv48KD5aC-hHxOS-FLirrUORsRef0J2CNQ_cLyesD5I_WrL2SYanYDN6HzZcOR1Qhdwz2gJK3mbPLKNPEU=w2400" type="image/x-icon">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
        <style>
body, html {
  height:100%;
  margin: 0;
}
.bg {
  /* The image used */
   background-image:url("");

  /* Full height */
  height:200%; 

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
 #text1{
     font-size:14px;
     font-family: Times New Roman;
     font-weight: bold;
     padding-top: 20px;
     padding-bottom: 8px;
 }
 #text2{
     font-size:15px;
      font-family:'Times New Roman', Times, serif;
      color:red;
 }
 #Showing{
     font-size:20px;
     color: #c71585;
     font-family: Garamond,cursive;
 }
 #b{
     font-size: 12px;
     color: red;
     padding-left:20px;
 }
 #bb{
     font-size: 12px;
     font-family: Garamond,serif;
 }
 div.polaroid {
  width:56%;
  background-color: white;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  margin-bottom:10px;
}

div.container {
  text-align: center;
  color: purple;
}
#p{
    font-size: 8px;
}
#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation */
.modal-content, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 42px;
  right: 35px;
  color: #f1f1f1;
  font-size: 50px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}
/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
 @media only screen and (min-width: 1000px) {
 #vce{
     font-size: 16px;
     font-style:italic;
 }
 }
  @media only screen and (max-width: 768px) {
 #vce{
     font-size: 15px;
 }
 .modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}
#img111123{
    padding-left: 19%;
}
}
@media only screen and (min-width: 768px) {
#text1{
    font-size: 20px;
    font-weight: bold;
}
#text2{
    font-size: 15px;
    font-family: 'Times New Roman', Times, serif;
    font-weight: bolder;
}
table{
    margin: auto;
}
#Showing{
    padding-left: 37%;
}
#b{
    font-size: 12px;
}
#bb{
    font-size: 12px;
    font-family: cursive;
    font-weight: bold;
}
.close {
  position: absolute;
  top: 42px;
  right: 35px;
  color: #f1f1f1;
  font-size: 100px;
  font-weight: bold;
  transition: 0.3s;
}
#myImg:hover {opacity: 1;}
div.polaroid {
  width:20%;
  background-color: white;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  margin-bottom:10px;
}
#p{
    font-size: 12px;
}
#img111123{
width:60%;
padding-left:40%;
}

}
@media only screen and (min-width: 1200px) {
   #Showing{
    padding-left: 41%;
   }
    .modal-content {
  margin: auto;
  display: block;
  width: 28%;
  max-width: 700px;
}
}
.button-87 {
  margin: 6px;
  padding: 10px 20px;
  text-align: center;
  text-transform: uppercase;
  transition: 0.5s;
  background-size: 200% auto;
  color: white;
  border-radius: 6px;
  display: block;
  border: 0px;
  font-weight: 600;
  box-shadow: 0px 0px 14px -7px #f09819;
  background-image: linear-gradient(45deg, #FF512F 0%, #F09819  51%, #FF512F  100%);
  cursor: pointer;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
}

.button-87:hover {
  background-position: right center;
  /* change the direction of the change here */
  color: #fff;
  text-decoration: none;
}

.button-87:active {
  transform: scale(0.95);
}
#aaabbb123{
text-decoration: none;
}
.button-87{
    margin: auto;
}
#img111123{
    margin: auto;
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
</head>
<body>
    <?php include('nav_login.php'); ?>
<br><br>
<div class="bg">
        <center>
            <h1 style="background-color:#708090;color:white;" id="text1">HURREY..! YOU HAVE SOME QUESTION PAPERS<br> <small>Acording To Your Informatiom...</small></h1>
        <?php
        if($cse_2020==1)
        {
            ?>
            <a style="text-decoration:none;" href="https://drive.google.com/drive/folders/1NpuqW0V-DXiANOsT4tcyp8NeWA741OUS" target="new">
            <h2 style="font-weight:bold;" id="text2">**<u>CSE R20 SYLLABUS DRIVE LINK</u>**</h2></a>
        <?php
        }
        ?>
        </center>
        <div id="okok">
        <?php
        while($row = $result->fetch_assoc())
        {
            $record=array($row["branch"],$row["syllabus_type"],$row["sem"],$row["Acedamic_Subject"],$row["paper_year"],$row["paper_type"],$row["page_no"],$row["image"],$row["uploaded_on"]);
            if($row["syllabus_type"]=="1")
            {
                array_push($r22,$record);
            }
            else if($row["syllabus_type"]=="2")
            {
                array_push($r20,$record);
            }
            else if($row["syllabus_type"]=="3")
            {
                array_push($r18,$record);
            }
            }
        array_push($total,$r22,$r20,$r18);
        for($i=0;$i<count($total);$i++)
        {
            $current=$total[$i];
            for($j=1;$j<count($current);$j++)
            {
                for($k=0;$k<count($current)-$j;$k++)
                {
                    if($current[$k][4]>$current[$k+1][4])
                    {
                        $temp=$current[$k];
                        $current[$k]=$current[$k+1];
                        $current[$k+1]=$temp;
                    }
                }
            }
            $total[$i]=$current;
        }
        $k=0;
        while($k<3)
        {
        $len=count($total[$k]);
        $i=0;
        ?>
        <?php
        if($len>0)
        {
            $regulation="";
            if($total[$k][0][1]=="1")
            {
                $regulation="'R22' REGULATION";
            }
            else if($total[$k][0][1]=="2")
            {
                $regulation="'R20' REGULATION";
            }
            else if($total[$k][0][1]=="3")
            {
                $regulation="'R18' REGULATION";
            }
            $paper_subject=$total[$k][0][3];
            $paper_ACYear=$total[$k][0][4];
            $uploaded_on=$total[$k][0][8];
            $paper_regulation123=$total[$k][0][1];
                ?>
                <table>
        <b id="Showing">Showing Result For...</b>
            <tr>
                <td><b id="b"> REGULATION </td><td>&nbsp;:&nbsp;</td></b><td><b id="bb"><?php echo $regulation;?></b></td>
            </tr>
            <tr>
                <td><b id="b"> ACADEMIC YEAR </td><td>&nbsp;:&nbsp;</b></td><td><b id="bb"><?php echo $paper_ACYear;?></b></td>
            </tr>
            <tr>
               <td><b id="b"> SUBJECT </td><td>&nbsp;:&nbsp;</b></td><td><b id="bb"><?php echo $paper_subject;?></b></td>
            </tr>
            <tr>
                <td><b id="b"> UPLOADED ON </td><td>&nbsp;:&nbsp;</b></td><td><b id="bb"><?php echo $uploaded_on;?></b><br></td>
            </tr> 
        </table>
                <?php
        }
        ?>
        &emsp;
        <?php
        while($i<$len)
        { 
            ?>
            <center>
            <div class="polaroid">
            <img
            src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($total[$k][$i][7]); ?>" alt="<?php echo $paper_subject; ?>" width="95%" height="auto" class="img" id="myImg" onclick="abc(this)">
            <div class="container">
  <p id="p">Page 
  <?php
  if($iii_year!=$total[$k][$i][4])
  {
    $iii_year=$total[$k][$i][4];
    $iii=0;
  }
  else{
    $iii=$iii+1;
  }
  echo $iii+1;
  if($iii==2)
  {
    echo "<br>IMP Questions";
   }
    ?>
  </p>
  </div>
            </div>
            </center>
            <?php
            if($i<$len-1)
            {
            if(!($total[$k][$i][4]==$total[$k][$i+1][4] or !($total[$k][$i][1]==$total[$k][$i+1][1])))
            {
                ?>
                <br>
                <br>
                <button type="button" class="button-87 perform" role="button" data1="<?php echo $paper_subject; ?>" data2="<?php echo $paper_ACYear; ?>" data3="<?php echo $paper_type; ?>" data4="<?php echo $paper_regulation123; ?>" id="myButton1235"><b>Download as PDF</b></button>
                <hr>
                <br>
                <?php
                $regulation="";
                $i=$i+1;
            if($total[$k][$i][1]=="1")
            {
                $regulation="'R22' REGULATION";
            }
            else if($total[$k][$i][1]=="2")
            {
                $regulation="'R20' REGULATION";
            }
            else if($total[$k][$i][1]=="3")
            {
                $regulation="'R18' REGULATION";
            }
            $paper_subject=$total[$k][$i][3];
            $paper_ACYear=$total[$k][$i][4];
            $uploaded_on=$total[$k][$i][8];
            $paper_regulation123=$total[$k][0][1];
           $i=$i-1;
            ?>
               <table>
        <b id="Showing">Showing Result For...</b>
            <tr>
                <td><b id="b"> REGULATION </td><td>&nbsp;:&nbsp;</td></b><td><b id="bb"><?php echo $regulation;?></b></td>
            </tr>
            <tr>
                <td><b id="b"> ACADEMIC YEAR </td><td>&nbsp;:&nbsp;</b></td><td><b id="bb"><?php echo $paper_ACYear;?></b></td>
            </tr>
            <tr>
               <td><b id="b"> SUBJECT </td><td>&nbsp;:&nbsp;</b></td><td><b id="bb"><?php echo $paper_subject;?></b></td>
            </tr>
            <tr>
                <td><b id="b"> UPLOADED ON </td><td>&nbsp;:&nbsp;</b></td><td><b id="bb"><?php echo $uploaded_on;?></b><br></td>
            </tr> 
        </table><br>
                <?php
            }
            }
            ?>
            <?php
            $i=$i+1;
        
    }
    if($len>0)
    {
        ?>
        <br>
        <button type="button" class="button-87 perform" role="button" data1="<?php echo $paper_subject; ?>" data2="<?php echo $paper_ACYear; ?>" data3="<?php echo $paper_type; ?>" data4="<?php echo $paper_regulation123; ?>" id="myButton1235"><b>Download as PDF</b></button>
        <center>
            ***
        </center>
        <hr>
        <?php
    }
    $k=$k+1;
        }
     ?>
     </div>
     <br><br>
   <a href="retrieve.php" id="aaabbb123"><button type="button" class="button-87" role="button" ><b id="bbbaaa123">BACK</b></button></a><br>
     <img src="https://lh3.googleusercontent.com/U_UTtLRbI-VFx_J4LJoWU-F_kB2iu8QbbPjSKQAw-evfsLYXEt7LufBGzdf8sNlcgLUwOksSfS473uts2XLntAs0ZNNiDtgAvqm3YUpzok1yD-VAQ461ncUEF9UnzRtfHDpn93NK3Q=s225-p-k" id="img111123" height="auto">
     <?php
     echo "<!DOCTYPE html>
                    <html lang='en'>
                    <head>
                    <link rel='icon' href='https://lh3.googleusercontent.com/pw/AIL4fc9IGEB31P0kx2jVJ6SC3i-fJNq-OEyvGTv48KD5aC-hHxOS-FLirrUORsRef0J2CNQ_cLyesD5I_WrL2SYanYDN6HzZcOR1Qhdwz2gJK3mbPLKNPEU=w2400' type='image/x-icon'>
                    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.all.min.js
'></script>
<link href='https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.min.css
' rel='stylesheet'>
</head>
<body>
<script>
swal.fire({
title:'Instruction to the User...',
html:'<p style=font-size:15px;>See Once The QuestionPapers First Page And Check Question Paper Details Like<br><small><b style=color:#DC143C>Subject Name<br>Regulation<br>Branch<br>Semester<br>Acedamic Year</small></b><br> Then <strong style=color:green>CONFORM YOURSELF</strong> As Is This Question Paper Details Are Matched Or Not...<br>For Any Queries Contact <b style=color:#4169E1>Website Developer...</b></p>',
icon:'warning',
background:'#F0F8FF',
iconColor:'#FF8C00',
backdrop:'rgba(0,0,0,0.8)',
});
</script></body></html>";
?>
        </center>
        </div>
        <div id="myModal" class="modal">
  <span class="close">&times;</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>
<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption;
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
function abc(ClickedImage){
  modal.style.display = "block";
  modalImg.src = ClickedImage.src;
  captionText.innerHTML = ClickedImage.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
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
document.querySelectorAll('.perform').forEach(button => {
button.addEventListener('click', () => {
const data1 = button.getAttribute('data1');
const data2 = button.getAttribute('data2');
const data3 = button.getAttribute('data3');
const data4 = button.getAttribute('data4');
const parameters = {
        param1: data1,
        param2: data2,
        param3: data3,
        param4: data4
    };

    fetch('downloadpdf.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(parameters)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok.');
                }
                return response.blob();  // Expect a blob response if downloading a file
            })
            .then(blob => {
                // Create a link element to trigger download
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = data1.concat("-").concat(data3).concat("-").concat(data2).concat(".pdf");  // Set the file name
                document.body.appendChild(a);
                a.click();
                a.remove();  // Clean up
            })
            .catch(error => {
                console.error('Error:', error);
            });
});
});
</script>
        </body>
        </html>
        <?php
    }
    else
    {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
              <meta charset="utf-8">
    <meta name="author" content="Bunny Rajender">
	<meta name="description" content="Vaagdevi College Of Engineering">
	<meta name="keywords" content="Vaagdevi College Of Engineering ,Result Page">
	<meta name="viewport" content="width=device-width, initial-scale=1">
                <title>THERE IS NO QUESTION PAPER</title>
                <link rel="icon" href="https://lh3.googleusercontent.com/pw/AIL4fc9IGEB31P0kx2jVJ6SC3i-fJNq-OEyvGTv48KD5aC-hHxOS-FLirrUORsRef0J2CNQ_cLyesD5I_WrL2SYanYDN6HzZcOR1Qhdwz2gJK3mbPLKNPEU=w2400" type="image/x-icon">
                
            </head>
            <body>
                <style>
                    body{
                        background-color: lightblue;
                    }
                    h2{
                        color:yellow;
                        background-color:black;
                        font-size:25;
                        font-weight: bold;
                    }
                    @media only screen and (max-width: 768px) {
                      #imgimg{
                        width:80%;
                      }
                      h2{
                        font-size: 16px;
                      }
                      #text11{
                        font-size: 12px;
                      }
                    }
                    @media only screen and (min-width: 768px) {
                      #imgimg{
                        width:30%;
                      }
                    }
                    @media only screen and (min-width: 1200px) {
                      #imgimg{
                        width:20%;
                      }
                    }
                    .button-87 {
  margin: 6px;
  padding: 10px 20px;
  text-align: center;
  text-transform: uppercase;
  transition: 0.5s;
  background-size: 200% auto;
  color: white;
  border-radius: 6px;
  display: block;
  border: 0px;
  font-weight: 600;
  box-shadow: 0px 0px 14px -7px #f09819;
  background-image: linear-gradient(45deg, #FF512F 0%, #F09819  51%, #FF512F  100%);
  cursor: pointer;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
}

.button-87:hover {
  background-position: right center;
  /* change the direction of the change here */
  color: #fff;
  text-decoration: none;
}

.button-87:active {
  transform: scale(0.95);
}
#aaabbb123{
text-decoration: none;
}
.button-87{
    margin: auto;
}
                </style>
                <center>
                    <h2>HOOPS..! THERE IS NO ANY RECORD</h2>
                    
                    <?php
        if($cse_2020==1)
        {
            ?>
            <a style="text-decoration:none;" href="https://drive.google.com/drive/folders/1NpuqW0V-DXiANOsT4tcyp8NeWA741OUS" target="new">
            <h3 style="color:purple;font-weight:bold;text-align:center;" id="text11"></h3>**<u>CSE R20 SYLLABUS DRIVE LINK</u>**</h3></a>
            <?php
        }
        ?>
                    <br><br>
                    <img src="No_record_found.jpg" id="imgimg" alt="no record found" height="auto" ><br><br>
                    <button type="button" onclick="uploader()" class="button-87" role="button" ><b id="bbbaaa123">Became a uploader</b></button><br>
                    
                </center>
                <a href="retrieve.php" id="aaabbb123"><button type="button" class="button-87" role="button" ><b id="bbbaaa123">BACK</b></button></a>
                <script>
                    function uploader()
                    {
                        window.location="uploader.php";
                    }
                </script>
            </body>
        </html>
        <?php
    }
$conn->close();
}

?>

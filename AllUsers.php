<?php 
session_start();
if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"]===false)
{
    header("location:signup.php");
}
require_once "connect_database.php";
$sql="select * from Myusers order by dofreg";
$result=$conn->query($sql);
?>
        <!DOCTYPE html>
        <html>
            <head>
                <title>All Users...</title>
                <link rel="icon" href="https://lh3.googleusercontent.com/pw/AIL4fc9IGEB31P0kx2jVJ6SC3i-fJNq-OEyvGTv48KD5aC-hHxOS-FLirrUORsRef0J2CNQ_cLyesD5I_WrL2SYanYDN6HzZcOR1Qhdwz2gJK3mbPLKNPEU=w2400" type="image/x-icon">
                <script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
    </script>
            </head>
        <body>
            <style>
            	body{
	    background:linear-gradient(90deg,pink,#f0fff0);
	    font-weight: bold;
	}
                th{
                    color:green;
                }
                h1{
                    color:yellow;
                    background-color: black;
                    font-size: 50;
                }
                b{
                    color:red;
                }
                h2{
                           color:white;
                    background-color: black;
                    font-size: 40; 
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
                @media only screen and (min-width: 1200px) {
                    h1{
                        font-size: 24px;
                    }
                    h2{
                        font-size: 18px;
                    }
                }
                button {
   border: 5px solid yellow;
   border-radius: 15px;
   outline: yellow;
   -moz-user-select: none;
   user-select: none;
   color:red;
   font-weight: 1000;
   cursor: pointer;
   margin-top: 2em;
   padding: 5em; }  
   button.is-loading::after {
   animation: spinner 500ms infinite linear;
   content: "";
   position: absolute;
   margin-left: 5em;
   border: 5px solid #000;
   border-radius: 50%;
   border-right-color: transparent;
   border-left-color: transparent;
   height: 8em;
   width: 100%; }
   button:focus {
   background-color:#fff;
   color: #000;
   border: none;
   padding: 1em 0.5em; animation: pulse 1s infinite ease;}
   button {
   display: block;
   padding: 0.5em 0;
   width:10%;
   margin-top: 1em;
   margin-bottom: 0.5em;
   background-color:inherit;
   border: none;
   border-bottom: 5px solid yellow;
   color: pink; }
   button:hover,button:focus {
   background-color:pink;
   color:#fff;}
   #button{
   }
            </style>
            <center>
                <h1>WELCOME TO MY ALL USERS PAGE...</h1>

<?php
if($result)
{
    if($result->num_rows>0)
    {
        ?>
            <h2>HURREY..! WE HAVE SOME USERS LIST...</h2>
            <h3>Our All Users Are...</h3>
            For Search Users... <input id="gfg" type="text" 
                 placeholder="Search here">
            <br>
            <br>
        <table border="1" style="text-align:center;">
        <tr>
        <th>S.No</th>
        <th>Username</th>
        <th>Password</th>
        <th>Email</th>
        <th>Dofreg</th>
        </tr>
        <tbody id="geeks">
        <?php
        $i=1;
        while($row = $result->fetch_assoc())
        {
            ?>
            <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row["username"]; ?></td>
            <td><?php echo $row["password"]; ?></td>
             <td><?php echo $row["email"]; ?></td>
             <td><?php echo $row["dofreg"]; ?></td>
             </tr>
             <?php
             $i=$i+1;
        }
        ?>
        </tbody>
        </table>
        <br>
        <h3>For New 20 Users List Click Here...</h3>
        <button type="button" class="button-87" role="button" id="button" onclick="New20Users()">New 20 Users</button>
        <br>
        <?php
        
    }
    else {
        ?>
        <h2>WE HAVE EMTY USERS LIST...!</h2>
   <?php
    }
}
else
{
    ?>
    <h2>SOMETHING WENT WRONG...CHECK THE CODE...</h2>
    <?php
}
  ?>
    <br>
  <button type="button" class="button-87" role="button" id="button" onclick="logout()">Logout</button>
  <br>
  <script>
      function logout()
      {
          window.location="logout.php";
      }
      function New20Users()
      {
          window.location="New20users.php";         
      }
            $(document).ready(function() {
                $("#gfg").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#geeks tr").filter(function() {
                        $(this).toggle($(this).text()
                        .toLowerCase().indexOf(value) > -1)
                    });
                });
            });
  </script>
    </center>
    </body>
    </html>
    <?php
$conn->close();
?>
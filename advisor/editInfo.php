<!DOCTYPE html>
<html>

<head>
  <title>Edit Information</title>
  <link href="loginstyles.css" rel="stylesheet" type="text/css">
<style>
body {
  background-color:#f5ca5c ;
 }

ul {
  font-family: Arial;
  list-style-type: none;
 margin: 0;
 position: absolute;
 top: 0;
 left:0;
 width: 98%;
 overflow: hidden;
   background-color: #333;
 }

li {
  float: right;
}

.logo {
  float: left;
padding: 4px 5px;
 }

li a {
display: block;
color: white;
  text-align: center;
padding: 14px 20px;
  text-decoration: none;
}


.edit-info {
  font-family: Arial;
  font-size: 32px;
  background-color: white;
color: black;
margin: auto;
width: 50%;
border: 3px solid green;
padding: 20px;
 }

#header {
text-align: center;
}

button {
  background-color: grey;
  border: none;
color: white;
padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  font-size: 16px;
display: inline-block;

}




/* TOGGLE BUTTON */

/* The switch - the box around the slider */
.switch {
position: relative;
display: inline-block;
width: 60px;
height: 34px;
 }

/* Hide default HTML checkbox */
.switch input {display:none;}

/* The slider */
.slider {
position: absolute;
cursor: pointer;
top: 0;
left: 0;
right: 0;
bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
transition: .4s;
 }

.slider:before {
position: absolute;
content: "";
height: 26px;
width: 26px;
left: 4px;
bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
transition: .4s;
 }

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
    }

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
 }

.slider.round:before {
  border-radius: 50%;
 }

</style>

</head>
<body>

<?php
session_start();
/* include("CommonMethods.php"); */
/* if (isset($_POST["roomNumber"])) { */
/*   echo "<br>"; */
/*   echo "<br>"; */
/*   echo "<br>"; */
/*   echo "<br>"; */
/*   echo "<br>"; */
/*   $conn = new Common(true); */
/*   /\* $conn->executeQuery("UPDATE Advisor SET roomNumber='".$_POST["roomNumber"]."', buildingName='".$_POST["buildingName"]."' WHERE advisorID=".$_SESSION["ADVISOR_ID"].";", $_SERVER["SCRIPT_NAME"]); *\/ */
/*   echo "HERE!"; */
/* } */
?>

<ul>
  <div class="logo">
  <img src="https://s16.postimg.org/ckbr6pov9/THISSS.png" height="50px">
  </div>
  <li><a href="logout.php">LOGOUT</a></li>
  <li><a href="home.php">MY DASHBOARD</a></li>
</ul>

<div class="edit-info">
<div id="header">
<h2>Edit Information</h2>
</div>

  <h3> Active Advising Season:</h3>

<label class="switch">
  <input type="checkbox">
  <div class="slider round"></div>
</label>

   <form method="post" name="advisor-update">
     Room Number: <input name="roomNumber" type="text" value=<?php echo $_SESSION["ADVISOR_RM_NUM"] ?> <br>
     Building Name: <input name="buildingName" type="text" value=<?php echo $_SESSION["ADVISOR_BLDG_NAME"] ?> <br>
     <div class="update-button">
     <input type="submit" value="UPDATE" style="background-color:#4CAF50; color: white; border-color: green; border: none; float: right; padding: 15px 32px;
font-size: 16px;
display: inline-block;
">
     </div>
   </form>
<br/>
<br/>


</div>
</div>

</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
   $(document).ready(function(){ 
       $(".btn").click(function() { 
	   $(this).toggleClass("active");
	 });
     });
</script>

</body>
</html>
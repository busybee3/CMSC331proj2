<html>
<head>
<title>Approved</title>
<style>

body {

  background-color:#f5ca5c;
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

.greeting {
  font-family: Arial;
  font-size: 32px;
  text-align: left;
 }

.stuff {
	font-family: Arial;
	font-size: 24px;
	text-align: left;
} 

.container {
  text-align: center
     }
</style>
</head>
<body>

<ul>
  <div class="logo">
  <img src="https://s16.postimg.org/ckbr6pov9/THISSS.png" height="50px">
  </div>
  <li><a href="logout.php">LOGOUT</a></li>
  <li><a href="home.php">MY DASHBOARD</a></li>
</ul>

<br/>
<br/>
<br/>
<br/>

	<form method="post" name="approved">
	<div class="greeting">
	<p>Have you been given clearance to register for classes for the next semester?</p>
	</div>
	<div class="stuff">
	<input type="radio" name="approv" id="yes" value="yes">I have been given clearance to register.<br>
    <input type="radio" name="approv" id="no" value="no" checked>I have not been given clearance to register.<br>
	</div>
	
	<input type="submit" name="confirm" value="Submit" style="font-family: Arial, sans-serif; font-size: 16px;height: 30px; width: 100px; line-height: 25px; margin-top: 20px;">
	
<?php
// Open session and grab the data from it.
session_start();
$studentID = $_SESSION["STUDENT_ID"];  
$_SESSION["STUDENT_ID"] = $studentID;
$studentEmail = $_SESSION["STUDENT_EMAIL"];
$_SESSION["STUDENT_EMAIL"] = $studentEmail;


//connect to database
include 'CommonMethods.php';
$debug = false;
$COMMON = new Common($debug);
$filename = "approved.php";

$error = "";

if(isset($_POST["confirm"])){
	
	if(empty($_POST["approv"]))
	{
		$error = "A choice is required";
	}
	elseif(isset($_POST['approv']) && !empty($_POST['approv']))
	{
        if($_POST['approv'] == 'yes')
		{
            $update = "UPDATE Student SET approvedForReg=1 WHERE StudentID = $studentID";
			$rs = $COMMON->executeQuery($update, $filename);
			header("Location: noAction.php");
        }elseif($_POST['approv'] == 'no')
		{
            $update = "UPDATE Student SET approvedForReg=0 WHERE StudentID = $studentID";
			$rs = $COMMON->executeQuery($update, $filename);
			header("Location: setAppt.php");
        } 
	}
}
?>

</form>
</body>
</html>
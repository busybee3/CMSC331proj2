<!DOCTYPE html>
<html>
<head>
<title>Worksheet</title>
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

.worksheet {
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

#note {
font-size: 16px;
font-style: italic;
}


</style>
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
<br/>
<br/>
<div class="worksheet">
<div id="header">
<h2>Please Fill in your Responses</h2>
</div>

<?php

session_start();
$studentEmail = $_SESSION["STUDENT_EMAIL"];
$_SESSION["STUDENT_EMAIL"] = $studentEmail;

include('CommonMethods.php');
$debug = false;
$COMMON = new Common($debug);
$fileName = "worksheet.php";

$sql = "SELECT * FROM questionsAndPlans WHERE email = '$studentEmail'";
$rs = $COMMON->executeQuery($sql,$fileName);
$row = mysql_fetch_row($rs);

$futurePlans = $row[2];
$advisingQuestions = $row[3];

if (isset($_POST['updateInfo'])) {

  $futurePlans = $_POST['futurePlans'];

  $advisingQuestions = $_POST['advisingQuestions'];

  if (strlen($futurePlans) <= 1) {

    $futurePlans = "N/A";
  
  }

  if (strlen($advisingQuestions) <= 1) {

    $advisingQuestions = "N/A";

  }

  $sql = "UPDATE questionsAndPlans SET futurePlans='$futurePlans', advisingQuestions='$advisingQuestions' WHERE email='$studentEmail'";
  $rs = $COMMON->executeQuery($sql,$fileName);
  echo("Information updated!");

}

?>


<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

  <input type="hidden" name="updateInfo">

  What are your current post-UMBC plans? For example: Medical School, Teach
  middle school science, Research career, Master’s/PhD, etc. 
  <br/><br/> <input type="text" align="center" name="futurePlans" maxlength="128" style="width:800px; height: 34px; font-size: 26px;" <?php if(isset($futurePlans)) { ?> value="<?php echo($futurePlans); ?>" <?php } ?> ><br/><br/>

Do you have any questions or concerns that you would like to discuss during
  your advising session? For example: Withdrawing from a course, adding a
  second major, etc. 

<br/><br/><input type="text" align="center" name="advisingQuestions" maxlength="128" style="width:800px; height: 34px; font-size: 26px;" <?php if(isset($advisingQuestions)) { ?> value="<?php echo($advisingQuestions); ?>" <?php } ?><br/><br/>

<div id="note">
  Note: Certain questions and concerns may require more time for discussion than
a student’s Registration Advising appointment will allow. If your question or
  concern is complex, or is sensitive in nature, you may be asked to schedule a
follow-up appointment with an advisor to address it fully.
<br/>
</div>




<br/>
<h3>Don't Forget to Print Out, Fill in, and Bring this Worksheet to your Appointment:</h3>
<a href="http://userpages.umbc.edu/~slupoli/notes/ProgLanguages/projects/CollegeWideAdvising/part2/supplements/GENERIC%20Pre-Registration%20Sheet.pdf" target="_blank">Pre-Advising Worksheet PDF</a>

<div class="update-button">
 <input type="submit" value="SAVE" name="Update" style="background-color:#4CAF50; color: white; border-color: gree\
n; border: none; float: right; padding: 15px 32px;
font-size: 16px;
display: inline-block;
">
</div>


</div>
<br/>
</body>
</html>
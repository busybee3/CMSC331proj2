<?php

echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
session_start();
$advisorEmail = $_SESSION["ADVISOR_EMAIL"];
$_SESSION["ADVISOR_EMAIL"] = $advisorEmail;
include('CommonMethods.php');
$debug = true;
$COMMON = new Common($debug);
$fileName = "editInfo.php";
$sql = "SELECT * FROM Advisor WHERE email = '$advisorEmail'";
$rs = $COMMON->executeQuery($sql,$_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);
$notes = $row[11];

if (isset($_POST['Update'])) {

  echo "I HAPPENED!";
  $notes= $_POST['notes'];
  if (strlen($notes) <= 1) {
    $notes = "";
  }

  $sql = "UPDATE Advisor SET notes='$notes' WHERE email='$advisorEmail'";
  $rs = $COMMON->executeQuery($sql,$_SERVER["SCRIPT_NAME"]);
  echo("Notes updated!");
}
?>


<!DOCTYPE html>

<html>
<head>
<title>Create Accounts</title>
<link rel="icon" type="image/png" href="http://assets1-my.umbc.edu/images/avatars/myumbc/original.png?1479144827" >
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

button {
  text-align: center;
  font-family: Arial;
  font-size: 20px;
border: 2px solid;
  border-radius: 50px;
  background-color:white;
width: 350px;
height: 350px;
margin: 100px 58px;
  float: center
}

.instructions {
  width: 80%;
  background-color: #EEEEEE;
  border: 8px solid black;
  border-radius: 25px;
  padding-top: 34px;
  padding-left: 50px;
  padding-bottom: 34px;
  padding-right: 0px;
  font-family: "Lucida Grande", "Lucida Sans Unicode", "Trebuchet MS", sans-serif;
  font-size: 27px;
  font-style: italic;
}



</style>
</head>
<body>


<ul>
  <div class="logo">
  <a href="home.php"><img src="https://s16.postimg.org/ckbr6pov9/THISSS.png" height="50px"></a>
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
<br/>
<br/>

<div class="instructions" >
  On this page, you can click which account you would like to create!
  Each button links to the registration page of your selected option.
  When creating an account, please use the password "test" for easy remembering.
</div>

<div id = "studentButton">
   <button>
   <a href="../student/register.php" style="color: white;">
   <img src="https://s24.postimg.org/nde8zn2w5/imageedit_1_3677733335.png" height= "254px">
</a><br/>Create a Student
   </button>
</div>

   <button>
   <a href="register.php" >
   <img src="https://s24.postimg.org/46443szxx/imageedit_1_8123757809.png" height="254px">
</a>Create an Advisor
   </button>

  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"

   <input type="hidden" name="updateInfo">

  Accounts Ive Made:
  <br/><br/> <input type="text" placeholder="Feel free to use this text area to note the email addresses of accounts you have made..." align="center" name="notes" style="width:800px; height: 404px; font-size: 26px;" <?php if(isset($notes)) { ?> value="<?php echo($notes); ?>" <?php } ?> ><br/><br/>

<div class="update-button">
 <input type="submit" value="SAVE" name="Update" style="background-color:#4CAF50; color: white; border-color: green; border: none; float: right; padding: 15px 32px;
font-size: 16px;
display: inline-block;
">

</div>
</body>
</html>
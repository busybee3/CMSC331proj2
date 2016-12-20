<?php
session_start();
$advisorEmail = $_SESSION["ADVISOR_EMAIL"];
$_SESSION["ADVISOR_EMAIL"] = $advisorEmail;
include('../CommonMethods.php');
$debug = false;
$COMMON = new Common($debug);
$fileName = "editInfo.php";
$sql = "SELECT * FROM Advisor WHERE email = '$advisorEmail'";
$rs = $COMMON->executeQuery($sql,$fileName);
$row = mysql_fetch_row($rs);
$notes = $row[11];

if (isset($_POST['Update'])) {
  $notes= $_POST['notes'];
  if (strlen($notes) <= 1) {
    $notes = "";
  }

  $sql = "UPDATE Advisor SET notes='$notes' WHERE email='$advisorEmail'";
  $rs = $COMMON->executeQuery($sql,$fileName);
  echo("Notes updated!");
}
?>


<!DOCTYPE html>

<html>
<head>
<title>Create Accounts</title>
<link rel="icon" type="image/png" href="http://assets1-my.umbc.edu/images/avatars/myumbc/original.png?147914482\
7" >
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
  float: center
    width: 100px;
margin: 100px 58px;

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

table {
font: 85% "Lucida Grande", "Lucida Sans Unicode", "Trebuchet MS\
", sans-serif;
padding: 0;
  border-collapse: collapse;
color: #333;
background: none;
margin: 0 auto;
}

table thead th {
background: black;
padding: 15px 10px;
color: #fff;
  text-align: center;
  font-weight: normal;
}


table thead {
  border-left: 1px solid #EAECEE;
    border-right: 1px solid #EAECEE;
    font-size: 20px;
    }

table tbody {
  border-bottom: 1px solid black;
  border-right: 1px solid black;
}

table tbody td, table tbody th {
  text-align: left;
}

.buttons {
display: inline-block;
align: center;
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


<div class = "buttons">
   <button>
   <a href="../student/register.php" style="color: white;">
   <img src="https://s24.postimg.org/nde8zn2w5/imageedit_1_3677733335.png" height= "254px">
</a><br/>Create a Student
   </button>


   <button>
   <a href="register.php" >
   <img src="https://s24.postimg.org/46443szxx/imageedit_1_8123757809.png" height="254px">
</a>Create an Advisor
   </button>
</div>


   <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"

   <input type="hidden" name="Update">

<table width="25%" border="2px" cellspacing="1px;" cellpadding="1px" align="center">
<thead>
<tr>
     <th>ACCOUNTS I'VE MADE</th>
</tr>
</thead>
<tbody>
  <tr><td><input type="text" placeholder="Feel free to use this text area to note the email addresses of accounts you have made..." align="center" name="notes" style="width:700px; height: 400px; font-size: 26px;" <?php if(isset($notes)) { ?> value="<?php echo($notes); ?>" <?php } ?> >
</tbody>
</table>

<div class="update-button">
<input type="submit" value="SAVE" name="Update" style="background-color:#4CAF50; color: white; border-color: green; border: none; float: right; font-size: 16px; display: inline-block;">

</div>
</body>
</html>


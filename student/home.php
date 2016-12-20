<!DOCTYPE html>

<html>
<head>
<title>Home</title>
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
  font-size: 40px;
  text-align: left;
 }

button {
  font-family: Arial;
  font-size: 20px;
border: 2px solid;
  border-radius: 50px;
  background-color:white;
width: 300px;
height: auto;
margin: 100px 38px;
}

.container {
  text-align: center
     }
</style>
</head>
<body>

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
$filename = "home.php";

//search for scheduled appointment - index 2 is the meetingID in the
// StudentMeeting table.
$scheduledAppt = "SELECT * FROM StudentMeeting WHERE StudentID = '$studentID'";
$currentAppt = $COMMON->executequery($scheduledAppt, $filename);
$row = mysql_fetch_row($currentAppt);
$meetingID = $row[2];
?>


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

<div class="greeting">

<?php 

// Print the preferred name if it's longer than 1 char.
if (strlen($_SESSION["STUDENT_PNAME"]) > 0 && $_SESSION["STUDENT_PNAME"] != "") { ?>
  Welcome, <?php echo ($_SESSION["STUDENT_PNAME"]); ?>!

<?php

}

// Otherwise print the first name.
else { ?>

  Welcome, <?php echo ($_SESSION["STUDENT_FNAME"]); ?>!

<?php

}

?>
</div>
<br/>

<div class="container">

<?php

// If there's an appointment, allow them to view it.
if ($row){ ?>

   <button>
   <a href="appointments.php" >
   <img src="http://image.flaticon.com/icons/svg/181/181549.svg" height="254px">
</a>View Appointment
   </button>

<?php

}

// If not, allow them the ability to schedule.
else if (!$row) { ?>

   <button>
   <a href="approved.php">
  <img src="https://s14.postimg.org/5dundt7ap/imageedit_1_8336523175.png" height="254px">
  </a>Search for an Appointment
   </button>

<?php

}


?>

   <button>
   <a href="worksheet.php" >
  <img src="https://s12.postimg.org/w2l3un38d/imageedit_3_7521197270.png" height="254px"   border-radius="50px";>
</a>Pre-Advising Worksheet
   </button>



   <button>
 <a href="editInfo.php">
   <img src="http://image.flaticon.com/icons/svg/181/181540.svg" height="254px"></a> Edit Information
   </button>

</div>



</body>
</html>
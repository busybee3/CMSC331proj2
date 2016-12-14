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

.appt_output {
  font-family: Arial;
  font-size: 20px;
  text-align: left;
  display: inline;
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

<?php

if (!$_POST) { ?>

  <div class="greeting">
    You are currently scheduled for the following appointment:
  </div><br>

  <div class="appt_output">

  <?php 

  // Open session and grab the data from it.
  session_start();
  $studentID = $_SESSION["STUDENT_ID"];  
  $_SESSION["STUDENT_ID"] = $studentID;

  //connect to database
  include 'CommonMethods.php';
  $debug = false;
  $COMMON = new Common($debug);
  $filename = "appointments.php";

  //search for scheduled appointment - index 2 is the meetingID in the
  // StudentMeeting table.
  $scheduledAppt = "SELECT * FROM StudentMeeting WHERE StudentID = '$studentID'";
  $currentAppt = $COMMON->executequery($scheduledAppt, $filename);
  $row = mysql_fetch_row($currentAppt);
  $meetingID = $row[2];
     
  // First get the meeting data.
  $get_meeting_data = "SELECT * FROM Meeting WHERE meetingID = $meetingID";
  $meeting_data_query = $COMMON->executequery($get_meeting_data, $filename);
  $meeting_row = mysql_fetch_row($meeting_data_query);
  $_SESSION['meetingID'] = $meetingID;

  // Index 6 in a row is the Session Leader's ID.
  $advisorID = $meeting_row[6];

  // Then get the advisor's name.
  $session_leader = "SELECT * FROM Advisor WHERE advisorID = $advisorID";
  $session_leader_query = $COMMON->executequery($session_leader, $filename);
  $session_leader_result = mysql_fetch_row($session_leader_query);
  $session_leader_fname = $session_leader_result[4];
  $session_leader_lname = $session_leader_result[6];
  
  if($meeting_row[5] == 0)
    $meetingType = "Individual";
      
  else
    $meetingType = "Group";
  
  // Display the meeting data.
  echo("<b>Session Leader:</b> ");
  echo("$session_leader_fname $session_leader_lname <br>");
  echo("<b>Meeting Type:</b> ".$meetingType);
  echo("<br>");
  echo("<b>Start Day and Time:</b> ");
  echo($meeting_row[1]);
  echo("<br>");
  echo("<b>Location:</b> ".$meeting_row[3]." ".$meeting_row[4]);

  ?>


  <br>
  Don't forget to fill out the <a href="http://userpages.umbc.edu/~slupoli/notes/ProgLanguages/projects/CollegeWideAdvising/part2/supplements/GENERIC%20Pre-Registration%20Sheet.pdf" target="_blank"><u>Pre-Registraton Sheet</u></a>!      	
  <br>
  </div>
  <br>

  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
     
    <input type="hidden" name="cancelMaybe">
    <input type="submit" value="CANCEL MEETING" name="Register" class="submit" style="color: white; background-color: red; border-radius: 15px; border: 5px solid white; font-family: Arial, sans-serif; font-size: 20px; width: 200px; line-height: 25px; margin: 0 auto; padding: 10px 0;">

  </form>

<?php

}

if (isset($_POST['cancelMaybe'])) { 

  session_start();
  $studentID = $_SESSION["STUDENT_ID"];  
  $_SESSION["STUDENT_ID"] = $studentID;

  ?>

  <div class="greeting">
    Are you sure you wish to cancel?
  </div><br>

  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

    <input type="hidden" name="cancelConfirm">
    <input type="submit" value="CONFIRM CANCELLATION" name="Register" class="submit" style="color: white; background-color: red; border-radius: 15px; border: 5px solid white; font-family: Arial, sans-serif; font-size: 20px; width: 275px; line-height: 25px; margin: 0 auto; padding: 10px 0;">

  </form>

<?php

}

if (isset($_POST['cancelConfirm'])) { 

  // Grab session data.
  session_start();
  $studentID = $_SESSION["STUDENT_ID"];  
  $_SESSION["STUDENT_ID"] = $studentID;
  $meetingID = $_SESSION['meetingID'];

  // Connect to DB.
  include 'CommonMethods.php';
  $debug = false;
  $COMMON = new Common($debug);
  $filename = "appointments.php";

  // Remove the student from the appropriate tables.
  $cancel_current_meeting =  "DELETE FROM StudentMeeting Where StudentID = $studentID";
  $rs = $COMMON->executequery($cancel_current_meeting, $filename);

  $update_num_students = "UPDATE Meeting SET numStudents = numStudents - 1 WHERE meetingID = $meetingID";
  $update_meeting = $COMMON->executequery($update_num_students, $filename);

  ?>

  <div class="greeting">
    Meeting cancelled!
  </div><br>

  <form action="home.php" method="POST">
    
    <input type="submit" value="RETURN" name="Register" class="submit" style="color: white; background-color: green; border-radius: 15px; border: 5px solid white; font-family: Arial, sans-serif; font-size: 20px; width: 120px; line-height: 25px; margin: 0 auto; padding: 10px 0;">

  </form>

<?php

}

?>

</body>
</html>
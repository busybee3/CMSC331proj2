

<script>
function 
</script>

<?php

include('CommonMethods.php');
$conn = new Common(true);
/*
// for the name, major, and ID info. this is the one we need for sure , it should have the IDs
$students = $conn->executeQuery("SELECT * FROM Student;", $_SERVER["SCRIPT_NAME"]); 

$meeting_ids = $conn->executeQuery("SELECT * FROM StudentMeeting WHERE StudentID LIKE '{$students['StudentID']}';", $_SERVER["SCRIPT_NAME"]);

// for the date and time
$appointments = $conn->executeQuery("SELECT * FROM Meeting WHERE meetingID LIKE '{$meeting_ids['MeetingID']}';", $_SERVER["SCRIPT_NAME"]);

// joins student and meeting id info
$master_table = $conn->executeQuery("SELECT * FROM Students INNER JOIN StudentMeeting ON Students.StudentID=StudentMeeting.StudentID;", $_SERVER["SCRIPT_NAME"]);
*/



$data = $conn->executeQuery("SELECT Meeting.start, Student.schoolID, Student.lastName, Student.firstName, Student.major FROM Student Join StudentMeeting ON Student.StudentID=StudentMeeting.StudentID JOIN Meeting ON StudentMeeting.meetingID=Meeting.MeetingID ORDER BY start, firstName", $_SERVER["SCRIPT_NAME"]);

/*
while ($student = mysql_fetch_array($data, MYSQL_NUM))
  array_push($all_students, $student);
echo "<table>";
    echo "<tr> <th> First Name <th> Last Name <th> School ID <th> Major <th> St\
art <th> End </tr> <tr>";
for ($i = 0; $i < sizeof($all_students); $i++) {
  echo "<tr>";
  for ($j = 0; $j < 6; $j++)
    echo "<td>".$all_students[$i][$j];
}
echo "</table";
    ?>
  </div>
<body>
*/
echo '
<div id="header" style="font-size: 40px; text-align: center;"><h4>CNMS ADVISING ROSTER </h4></div>

<div class="roster-container">
<table width="90%" border="2px" cellspacing="1px;" cellpadding="1px">
<thead>
<tr>
     <th>Date of Session</th>
     <th>Time</th>
     <th>UMBC ID</th>
     <th>Last Name</th>
     <th>First Name</th>
     <th>Major</th>
</tr>
</thead>
<tbody>';

//output data of each row
while ($student = mysql_fetch_assoc($data)) {
  echo "<tr>";
  echo "<td>".(new DateTime($student["start"]))->format("F j Y"); 
  echo "<td>".(new DateTime($student["start"]))->format("g:i a");
  echo "<td>".$student["schoolID"];
  echo "<td>".$student["firstName"];
  echo "<td>".$student["lastName"];
  echo "<td>".$student["major"];
}


/*   array_push($all_students, $student); */
/* for ($i = 0; $i < sizeof($all_students); $i++) { */
/*   echo "<tr>"; */
/*   echo "<td>".$student */
/*     /\* for ($j = 0; $j < 5; $j++) *\/ */
/*     /\*   echo "<td>".$all_students[$i][$j]; *\/ */
/*   }; */
/*  foreach ($all_students as $student){

echo'<tr>
     <td>'.$all_students['start'].'</td>
     <td>'.$all_students['start'].'</td>
     <td>'.$all_students['schoolID'].'</td>
     <td>'.$all_students['lastName'].'</td>
     <td>'.$all_students['firstName'].'</td>
     <td>'.$all_students['major'].'</td>
   </tr>';
   };*/
/*

$all_rows = array();

while ($row = mysql_fetch_assoc($master_table))
  array_push($all_rows, $row);
foreach ($all_rows as $row){
  echo '<tr>
     <td>'.$row['start'].'</td>
     <td>'.$row['start'].'</td>
     <td>'.$row['schoolID'].'</td>
     <td>'.$row['lastName'].'</td>
     <td>'.$row['firstName'].'</td>
     <td>'.$row['major'].'</td>
   </tr>';
};
*/

/*
$all_meetings = array();
while ($meeting = mysql_fetch_assoc($meeting_ids))
  array_push($all_meetings, $meeting);


$all_rows = array();

while ($row = mysql_fetch_assoc($students)) 
    array_push($all_rows, $row);
foreach ($all_rows as $row){
  echo '<tr>
     <td>'.$meeting['start'].'</td>
     <td>'.$meeting['start'].'</td>
     <td>'.$row['schoolID'].'</td>
     <td>'.$row['lastName'].'</td>
     <td>'.$row['firstName'].'</td>
     <td>'.$row['major'].'</td>
   </tr>';
};
*/
/* var_dump($meeting); */
/*
$all_rows = array();

while ($studentinfo = mysql_fetch_assoc($students)){
  array_push($all_rows, $studentinfo)
  while ($apptinfo = mysql_fetch_assoc($students))
  array_push($all_rows, $apptinfo);
foreach ($all_rows as $apptinfo){
  echo '<tr>
     <td>'.$apptinfo['start'].'</td>
     <td>'.$apptinfo['start'].'</td>
     <td>'.$studentinfo['schoolID'].'</td>
     <td>'.$studentinfo['lastName'].'</td>
     <td>'.$studentinfo['firstName'].'</td>
     <td>'.$studentinfo['major'].'</td>
   </tr>';
};
};
*/
'</tbody>
</table>
</div>

';
?>

<!DOCTYPE html>
<html>

<head>
  <title>Search</title>
<style>

body {
color: black;
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

.roster-container {
  text-align: center;
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


</body>
</html>
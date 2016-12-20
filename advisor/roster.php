<?php
include('../CommonMethods.php');
$conn = new Common(true);


$data = $conn->executeQuery("SELECT Meeting.start, Student.schoolID, Student.lastName, Student.firstName, Student.major FROM Student Join StudentMeeting ON Student.StudentID=StudentMeeting.StudentID JOIN Meeting ON StudentMeeting.meetingID=Meeting.MeetingID ORDER BY start, firstName", $_SERVER["SCRIPT_NAME"]);



echo '
<div id="header" style="font-size: 40px; text-align: center;"><h4>CNMS ADVISING ROSTER </h4></div>

<table width="80%" border="2px" cellspacing="1px;" cellpadding="1px" align="center">
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
<tbody>
';
// format majors
$majors = array(
                "BiologyBA" => "Biological Sciences B.A.",
                "BiologyBS" => "Biological Sciences B.S.",
                "BioChemBS" => "Biochemistry & Molecular Biology B.S.",
                "BioInfoBS" => "Bioinformatics & Computational Biology B.S.",
                "BioEdBA" => "Biology Education B.A.",
                "ChemBA" => "Chemistry B.A.",
                "ChemBS" => "Chemistry B.S.",
                "ChemEdBA" => "Chemistry Education B.A."
                );
//output data of each row
while ($student = mysql_fetch_assoc($data)) {
  echo "<tr>";
  echo "<td>".(new DateTime($student["start"]))->format("F j Y");
  echo "<td>".(new DateTime($student["start"]))->format("g:i a");
  echo "<td>".$student["schoolID"];
  echo "<td>".$student["firstName"];
  echo "<td>".$student["lastName"];
  echo "<td width = 30%>".$majors[$student["major"]];
}


'</tbody>
</table>
</div>

';
?>


<!DOCTYPE html>
<html>

<head>
  <title>CNMS Advising Roster</title>
<link rel="icon" type="image/png" href="http://assets1-my.umbc.edu/images/avatars/myumbc/original.png?147914482\
7">

<style>

  body {
  background-image: url("https://s23.postimg.org/6nck8n7i3/roster1.jpg");
  background-size: 100% 100%;
  width:auto;
  height:auto;
  background-color: #EEEEEE;
  font-family: Arial;
  text-align: center;
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
    }

table tbody {
  border-bottom: 1px solid black;
  border-right: 1px solid black;
}
table tbody td, table tbody th {
padding: 10px;
  text-align: left;
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
</body>
</html>

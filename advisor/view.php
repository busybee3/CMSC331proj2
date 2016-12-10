<?php

include('CommonMethods.php');
//check which advisor to query & if students have booked any appointments. If not, display the no appointments yet message


// This queries for the current session id
if(isset($_GET['s'])){ 

$advisor=$_GET['s'];

  $conn = new Common(true);
  $apt_data = mysql_fetch_assoc($conn->executeQuery("SELECT * FROM Meeting WHERE sessionLeaderID LIKE '{$advisor}';", $_SERVER["SCRIPT_NAME"]));

  $student_ids = mysql_fetch_assoc($conn->executeQuery("SELECT * FROM StudentMeeting WHERE MeetingID LIKE '{$apt_data['MeetingID']}';", $_SERVER["SCRIPT_NAME"]));

  $students_data = mysql_fetch_assoc($conn->executeQuery("SELECT * FROM Student WHERE StudentID LIKE '{$student_ids['StudentID']}';", $_SERVER["SCRIPT_NAME"]));

  $wksht_data =  mysql_fetch_assoc($conn->executeQuery("SELECT * FROM questionsAndPlans WHERE email LIKE '{$students_data['email']}';", $_SERVER["SCRIPT_NAME"]));

/*needed: current session id
  advisor dictionary w name matched to id*/

echo '
<form action="" method="get">
<div class="search-selection">
<label for="search-selection">Showing Appoinments For </label>
<select>
  <option value="you" name="s">You</option>
  <option value="advisor1">Emily Stephens</option>
</select>
</div>
</form>


<div id="appt_info">
<br/>

<table width="90%" border="1px" cellspacing"1px" cellpadding="tpx">
<thead>
<tr>
<td colspan="6px" align="center"> WEDNESDAY, DECEMBER 14, 2016 </th>
</tr>
<tr>
<th>TIME</th>
<th>TYPE</th>
<th>NAMES</th>
<th>IDs</th>
<th>MAJORS</th>
<th>PRE-ADVISING INFORMATION</th>
</tr>
</thead>
<tbody>
<tr>
<td>'.$apt_data['start'].'</td>
<td>'.$apt_data['meetingType'].'</td>
<td>'.$students_data['firstName'].$students_data['lastName'].'</td>
<td>'.$students_data['schoolID'].'</td>
<td>'.$students_data['major'].'</td>
<td>'.$students_data['futurePlans'].$data['advisingQuestions'].'</td>
</tr>
</tbody>
</table>
';
}


else {
  echo '
<br/>
<br/>
<br/>
<br/>
<br/>

Showing Appointments for
<select>
  <option value="you">You</option>
  <option value="advisor1">$name of advisorID 1</option>
</select>


  You currently have no appointments. Please check back later.

'; }
?>




<!DOCTYPE html>
<html>

<head>
  <title>Search</title>
<style>

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



body {
  background-color: #f5ca5c;
  min-height:100%;
}

table {
font: 85% "Lucida Grande", "Lucida Sans Unicode", "Trebuchet MS", sans-serif;
padding: 0;
margin: 0;
  border-collapse: collapse;
color: #333;
background: #F3F5F7;
}

table a {
color: #3A4856;
  text-decoration: none;
  border-bottom: 1px
solid #C6C8CB;
    }

table a:visited {
color: #777;
}

table a:hover {
color: #000;
}

table caption {
text-align: left; 
text-transform: uppercase;  
padding-bottom: 10px; 
font: 200% "Lucida Grande", "Lucida Sans Unicode", "Trebuchet MS", sans-serif;
}

table thead th {
background: #3A4856; 
padding: 15px 10px; 
color: #fff; 
text-align: left; 
font-weight: normal;
}

table tbody, table thead {
border-left: 1px solid #EAECEE; 
border-right: 1px solid #EAECEE;
}

table tbody {
border-bottom: 1px solid #EAECEE;
}
                      
table tbody td, table tbody th {
padding: 10px; 
background: url("td_back.gif") repeat-x; 
text-align: left;
}

table tbody tr {
background: #F3F5F7;
}

table tbody tr.odd {
background: #F0F2F4;
}

table tbody  tr:hover {
background: #EAECEE; 
color: #111;
}

table tfoot td, table tfoot th, table tfoot tr {
text-align: left; 
font: 120%  "Lucida Grande", "Lucida Sans Unicode", "Trebuchet MS", sans-serif;
text-transform: uppercase; 
background: #fff; 
padding: 10px;}

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

</body>
</html>
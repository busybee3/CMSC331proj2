<?php

include('CommonMethods.php');
//check which advisor to query & if students have booked any appointments. If not, display th no appointments yet message


 // This queries for the current session id

echo'<br/>';
echo'<br/>';
echo'<br/>';
echo'<br/>';
echo'<br/>';
echo'<br/>'; 
   $conn = new Common(true);
   $advisors = $conn->executeQuery("SELECT firstName, lastName FROM Advisor;", $_SERVER["SCRIPT_NAME"]);

$off = (isset($_GET["off"]) && $_GET["off"] > 0) ? $_GET["off"] : 0;
$date = new DateTime("today  + $off days");

/*$date = new DateTime('today + 2 days');*/

$data = $conn->executeQuery("select * from Meeting join AdvisorMeeting on Meeting.meetingID=AdvisorMeeting.MeetingID join StudentMeeting on Meeting.meetingID=StudentMeeting.meetingID join Student on StudentMeeting.StudentID=Student.StudentID join questionsAndPlans on Student.email=questionsAndPlans.email where start like '".$date->format('Y-m-d')."%' order by start ;", $_SERVER["SCRIPT_NAME"]);

/* SELECTION DROP-DOWN MENU */
echo '
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>


<form action="" method="get">
<div class="search-selection">
<label for="search-selection">Showing Appoinments For </label>
';
//output data of each row
$all_advisors = array();

echo'<select>';
while ($names = mysql_fetch_assoc($advisors))
  array_push($all_advisors, $names);
foreach ($all_advisors as $names){
  echo '
     <option>'.$names['firstName'].' 
     '.$names['lastName'].'</option>
    ';
};
echo '</select>
</div>
</form>

<form action>
View by
<button>Day</button>
<button>Week</button>
</form>
';

/* VIEW APPOINTMENTS (BY DAY) */  
echo'
<div id="appt_info">
<br/>
<table width="90%" border="1px" cellspacing"1px" cellpadding="tpx">
<thead>
<tr>
<td><a class="previous" href="view.php?off='.($off-1).'"> &laquo;</a></td>
<td colspan="6px" align="center">'.strtoupper($date->format("l, F j, Y")).'</th>
<td><a class="plus" href="view.php?off='.($off+1).'"> &raquo; </a></td>
</tr>
<tr>
<th>TIME</th>
<th>TYPE</th>
<th>NAME</th>
<th>ID</th>
<th>MAJOR</th>
<th>PRE-ADVISING INFORMATION</th>
</tr>
</thead>
<tbody>';

// output data of each time on this day
$count = 0;
$type;
$majors = array(
		"Biology" => "Biological Sciences B.S.",
		"Biochemistry" => "Biochemistry B.A.",
		"Bioeducation" => "Biology Education B.A.",
		"Bioinformatics" => "Bioinformatics B.S.",
		"Chemistry" => "Chemistry B.S.",
		"Chemeducation" => "Chemistry Education B.A."
		);

$last_date="";
while ($student = mysql_fetch_assoc($data)) {
  echo "<tr>";
  
  if ($last_date != $student["start"])
    $count = 0;

  if ($count == 0) {
    echo "<td>".(new DateTime($student["start"]))->format("g:i a");
    if ($student["meetingType"] == '0') /*Individual Icon*/
      echo "<td>  <img src='https://s30.postimg.org/66pdiek35/person_Icon.png' height='54px'>";
 
    if ($student["meetingType"] == '1') /*Group Icon*/
    echo "<td>  <img src='http://ddu548.minsk.edu.by/sm_full.aspx?guid=4673' height='54px'>";
    $last_date = $student["start"];
  }
  else {
    $last_date = $student["start"];
    echo "<td>";
    echo "<td>";
  }

  echo "<td>".$student["firstName"]." ".$student["lastName"];
  echo "<td>".$student["schoolID"];
  echo "<td>".$majors[$student["major"]];
  echo "<td>Future Plans- ".$student["futurePlans"]."<br/>Questions- ".$student["advisingQuestions"];
  $count++;
}


if (!mysql_num_rows($data))
  echo "<p style='background-color: white; text-align: center;'> No meetings </p>";

echo'
</tbody>
</table>
</div>';



?>






<!DOCTYPE html>
<html>

<head>
  <title>View Appointments</title>
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
background: white;
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
background: black; 
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

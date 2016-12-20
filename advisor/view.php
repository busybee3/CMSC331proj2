
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

<?php

session_start();

if (!isset($_SESSION["HAS_LOGGED_IN"]))
  header("index.php");

include('../CommonMethods.php');

$conn = new Common(false);
$advisors = $conn->executeQuery("SELECT firstName, lastName, advisorID FROM Advisor;", $_SERVER["SCRIPT_NAME"]);

/* DEFAULT VIEW */
if (!isset($_SESSION["requestedView"]))
  $_SESSION['requestedView'] = 'Day';


/* ADVISOR SELECTION DROP-DOWN MENU */
echo '
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<form method="post">
<div class="advisor-selection">
<label for="advisor-selection">Showing Appoinments For </label>
';
// populates the selection drop-down with every advisor in the database
$all_advisors = array();

echo'<select style="display: inline-block;" name="advisor">';

while ($names = mysql_fetch_assoc($advisors))
  array_push($all_advisors, $names);

if (isset($_POST["advisor"]))
  $_SESSION["advisor"] = $_POST["advisor"];
else if (isset($_SESSION["advisor"])) 
  ;
else
  $_SESSION["advisor"] = $_SESSION["ADVISOR_ID"];

foreach ($all_advisors as $names){
  /* $selected = ""; */
  /* if (isset($_SESSION["advisor"]) && $_SESSION["advisor"] == $names["advisorID"]) */
  /*   $selected = "selected"; */
  /* else if ($names["advisorID"] == $_SESSION["ADVISOR_ID"]) */
  /*   $selected = "selected"; */
  /* else */
  /*   $selected = ""; */
  echo '
     <option '.((isset($_SESSION["advisor"]) && $_SESSION["advisor"] == $names['advisorID']) ? "selected" : (($names["advisorID"] == $_SESSION["ADVISOR_ID"]) ? "selected" :  "")).' value="'.$names['advisorID'].'">'.$names['firstName'].' '.$names['lastName'].'</option>
    ';
};
echo
'</select>
<input style="display: inline-block;" type="submit" value="Go"></input>
</div>
</form>';

/* so now what'll happen is the advisor ID is the value for which advisor, so when you submit the form, you can query by advisorID instead of firs name and last name.

/* UPDATE WHICH ADVISOR'S SCHEDULE TO SHOW  */ 

//if (isset($_POST['advisor']))
//  $_SESSION['advisor'] = ///////////////////////////////////////////////////////


/* PREFERRED VIEW BUTTONS */
/* echo */
/* 'View by <br> */
/* <form style="display: inline-block;" action="" method="post"><input type="submit" name="dayView" value="Day"></form> */
/* <form style="display: inline-block;" action="" method="post"><input type="submit" name="weekView" value="Week"></form>'; */

/* UPDATE THE PREFERRED VIEW */
$off = (isset($_GET["off"]) && $_GET["off"] > 0) ? $_GET["off"] : 0;
if (isset($_POST['dayView'])) {
  $off = 0;
  $_SESSION['requestedView'] = 'Day';
}

if(isset($_POST['weekView'])) {
  $off = 0;
  $_SESSION['requestedView'] = 'Week';
}


if (isset($_POST["advisor"]))
  $off = 0;
//////////////////////////////////////////////////
//
//     MUST ADD PREFFERRED ADVISOR CONDITION
//
//////////////////////////////////////////////////

/* DAILY VIEW */
if($_SESSION['requestedView']=='Day') {

  $date = new DateTime("today  + $off days");
  $data = $conn->executeQuery("select * from Meeting join AdvisorMeeting on Meeting.meetingID=AdvisorMeeting.MeetingID join StudentMeeting on Meeting.meetingID=StudentMeeting.meetingID join Student on StudentMeeting.StudentID=Student.StudentID join questionsAndPlans on Student.email=questionsAndPlans.email where advisorID=".$_SESSION["advisor"]." and start like '".$date->format('Y-m-d')."%' order by start ;", $_SERVER["SCRIPT_NAME"]);

  echo '
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

  $count = 0;
  $type;
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

    if (empty($student["preferredName"]))
      echo "<td>".$student["firstName"]." ".$student["lastName"];

    else 
      echo '<td>'.$student['firstName'].' "'.$student['preferredName'].'" '.$student['lastName'];
    
    echo "<td>".$student["schoolID"];
    echo "<td>".$majors[$student["major"]];
    echo "<td>Future Plans: ".$student["futurePlans"]."<a href='remove_student.php?studentID=".$student["StudentID"]."&meetingID=".$student["meetingID"]."' <button style='float: right; vertical-align: center; border: none; background: none;'><img src='http://www.free-icons-download.net/images/delete-button-icon-72030.png' style='height: 30px;'></button></a>"."
  <br>Questions: ".$student["advisingQuestions"];
    $count++;
  }
  
  if (!mysql_num_rows($data))
    echo "<p style='background-color: white; text-align: center;'> No meetings </p>";    

  echo'
</tbody>
</table>
</div>';
}

/** END OF DAY IF - BLOCK **/

/** WEEKLY VIEW **/
if($_SESSION['requestedView']=='Week') {
  $date = new DateTime("today + $off days");
  $WEEKDAYS = 5;
  $start = new DateTime("Monday this week + $off days");
  for ($x = 0; $x < $WEEKDAYS; $x++) {
    $data = $conn->executeQuery("select * from Meeting join AdvisorMeeting on Meeting.meetingID=AdvisorMeeting.MeetingID join StudentMeeting on Meeting.meetingID=StudentMeeting.meetingID join Student on StudentMeeting.StudentID=Student.StudentID join questionsAndPlans on Student.email=questionsAndPlans.email where advisorID=".$_SESSION["advisor"]." and start like '".$date->format('Y-m-d')."%' order by start ;", $_SERVER["SCRIPT_NAME"]);
    
    echo '
<div id="appt_info">
<br/>
<table width="90%" border="1px" cellspacing"1px" cellpadding="tpx">
<thead>
<tr>';
    if ($x == 0)
      echo '<td><a class="previous" href="view.php?off='.($off-7).'"> &laquo;</a></td>';    
    echo'<td colspan="6px" align="center">'.strtoupper($date->format("l, F j, Y")).'</th>';
    if ($x == 0) 
      echo '<td><a class="plus" href="view.php?off='.($off+7).'"> &raquo; </a></td></tr>';    
    echo'
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

    $count = 0;
    $type;
    // format majors
    $majors = array(
		    "BiologyBA" => "Biological Sciences B.A.",
		    "BiologyBS" => "Biological Sciences B.S.",
		    "BioChemBs" => "Biochemistry & Molecular Biology B.S.",
		    "BioInfoBS" => "Bioinformatics & Computational Biology B.S.",
		    "BioEdBA" => "Biology Education B.A.",
		    "ChemBA" => "Chemistry B.A.",
		    "ChemBS" => "Chemistry B.S.",
		    "ChemEdBA" => "Chemistry Education B.A."
		    );
  
    $last_date="";
    while ($student = mysql_fetch_assoc($data)) {
      echo "<tr>";
	var_dump($student);
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

	if (empty($student["preferredName"])){
	  echo "<td>".$student["firstName"]." ".$student["lastName"];
	}
	else {
	  echo '<td>'.$student['firstName'].' "'.$student['preferredName'].'" '.$student['lastName']      ;
	}
	echo "<td>".$student["schoolID"];
	echo "<td>"./* $majors[ */$student["major"]/* ] */;
	echo "<td>Future Plans: ".$student["futurePlans"]." <a href='remove_student.php?sid=".$student['studentID']."' <button style='float: right; vertical-align: center; border: none; background: none;'><img src='http://www.free-icons-download.net/images/delete-button-icon-72030.png' style='height: 30px;'></button></a>"."
  <br>Questions: ".$student["advisingQuestions"];
	$count++;
      }
      $date->modify("+1 days");
      if (!mysql_num_rows($data))
	echo "<p style='background-color: white; text-align: center;'> No meetings </p>";
      
  
  }
  echo'
</tbody>
</table>
</div>';
   
}




?>

</body>
</html>

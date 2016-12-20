<html>
<head>
<title>Find Appointment</title>

<style type="text/css">

  * {
  box-sizing: border-box;
}

 body {
  background-color:#f5ca5c;
  padding: 10px;
 }

 ul {
  font-family: Arial;
  list-style-type: none;
  margin: 0;
  position: absolute;
  top: 0;
  left: 0;
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

.tdborder {background-color: #464540;}
.tdclosed {background-color: #9b936f;}
.tdselect {background-color: #94d509;}
.tdopen {background-color: #ffffff;}
.tdheader {background-color: #464540;}
.tdtitle {background-color: #e2ddc0;}
td {font: 11px ms sans serif, geneva, arial, helvetica;
    color: #000000;}
input {font-size: 11px;
    font-family: courier new, courier, monospace;}
select {font-size: 11px;
    font-family: courier new, courier, monospace;}

font.textclosed {color: #ffffff;}
font.textheader {color: #ffffff;
    text-decoration: none;}

a.textclosed {color: #ffffff;}
a.textopen {color: #000000;
    text-decoration: none;}
a:visited {color: #000000;
    text-decoration: none;}


div {
display: block;
}

.container {
  margin-right: auto;
  margin-left: auto;
  padding-left: 15px;
  padding-right: 15px;
}

.appt-options {
  margin-top: auto;
}

.appt-results {
  margin-top: auto;
}

.row {
  margin-left: -15px;
  margin-right: -15px;
}

.col-md-3 {
padding: relative;
  min-height: 1px;
  padding-left: 100px;
  padding-right: 15px;
  padding-top: 30px;
width: auto;
  float: left;
}

.col-md-offset-3 {
padding: relative;
  min-height: 1px;
  padding-left: 100px;
  padding-right: 15px;
  padding-top:30px;
width: auto;
  float: left;
}

.well {
  min-height: 20px;
padding: 19px;
  margin-bottom: 20px;
  background-color: #f5f5f5;
  border: 1px solid #e3e3e3;
    border-radius: 4px;
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
}

.results {
height: 800px;
}

.text-center {
  text-align: center;
}

h1, h2, h3 {
  font-family: 'Open Sans', sans-serif;
}

h2, .h2 {
  font-size: 30px;
}

h1, .h1, h2, .h2, h3, .h3 {
  margin-top: 20px;
  margin-bottom: 10px;
}

h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
  font-weight: 500;
  line-height: 1.1;
color: inherit;
}

h2 {
display: block;
  -webkit-margin-before: 0.83em;
  -webkit-margin-after: 0.83em;
  -webkit-margin-start: 0px;
  -webkit-margin-end: 0px;
}

.btn {
  margin-bottom: 0;
  font-weight: normal;
  text-align: center;
  vertical-align: middle;
  touch-action: manipulation;
cursor: pointer;
border: 1px solid transparent;
  white-space: nowrap;
  user-select: none;
}

.btn-block {
display: block;
width: 100%;
}

.btn-md {
padding: 10px 16px;
  font-size: 16px;
  line-height: 1.3333333;
  border-radius: 6px;
}

.btn-success {
color: #fff;
  background-color: #5cb85c;
  border-color: #4cae4c;
}

#apptResults {
font-family: 'Open Sans', sans-serif;
border-collapse: collapse;
width: 100%;
}

#apptResults th, #apptResults td {
padding: 8px;
border-bottom: 1px solid #ddd;
  text-align: left;
}

#apptResults tr:nth-child(even)
{background-color:#f2f2f2;
}

#apptResults tr:hover {background-color: #ddd;}

#apptResults th {
padding-top: 10px;
padding-bottom: 10px;
text-align: left;
background-color: #333;
color: white;
font-size: 12px;
}

#signup:link, #signup:visited {
background-color: #4CAF50;
color: white;
	  padding: 10px 20px;
text-align: center;
text-decoration: none;
	  display: inline-block;
	  }

#signup:hover, #signup:active {
	  background-color: green;
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
 
  <div class="container appt-results">
    <div class="row">
      <div class="col-md-offset-3">
        <h3 class="text-center">Available Appointments</h3>              
          <div class="well" id="results">	      
<?php
session_start();
include('../CommonMethods.php');
$conn = new Common(false);
$advisors = $conn->executeQuery("SELECT advisorID, CONCAT(firstName,' ',lastName) AS Name FROM Advisor;", $_SERVER["SCRIPT_NAME"]);
$specialGroup = $_SESSION["SPECIAL_GROUP"];
$maxStudents = 40;

// athlete
if($specialGroup == 1) {
  $specialType = 0;

  // Honors College
} else if($specialGroup == 2) {
  $specialType = 1;

  // Meryerhoff
} else if($specialGroup == 3) {
  $specialType = 2;
}

$query = "SELECT Meeting.meetingID, CONCAT(Advisor.firstName,' ',Advisor.lastName) AS Advisor, DATE_FORMAT(Meeting.start, '%W') AS weekday, DATE_FORMAT(Meeting.start, '%b %e %Y') AS apptDate, DATE_FORMAT(Meeting.start, '%h:%i %p') AS start, DATE_FORMAT(Meeting.end, '%h:%i %p') AS end, CONCAT(Meeting.buildingName,' ',Meeting.roomNumber) AS Location, Meeting.numStudents FROM ((AdvisorMeeting INNER JOIN Meeting ON AdvisorMeeting.meetingID = Meeting.meetingID) INNER JOIN Advisor ON AdvisorMeeting.advisorID = Advisor.advisorID) WHERE Meeting.meetingType = 2 AND Meeting.numStudents < 40 AND Meeting.activeApt = 1 AND Meeting.specialGroup = '$specialType' ORDER BY apptDate ASC, start ASC";

$rs = $conn->executeQuery($query, $_SERVER["SCRIPT_NAME"]);

if(!$rs) {
  echo "Cannot parse query.";
} else if (mysql_num_rows($rs) == 0)
{
header("Location: setAppt.php");
} else if(mysql_num_rows($rs) > 0) {

  echo("<table id='apptResults'>");
  echo("<tr>");
  echo("<th>Advisor</th>");
  echo("<th>Date</th>");
  echo("<th>Start Time</th>");
  echo("<th>End Time</th>");
  echo("<th>Location</th>");
  echo("<th>Open Seats</th>");
  echo("<th></th>");
  echo("</tr>");

  while($row = mysql_fetch_assoc($rs))
    {
      echo("<tr>");
      echo("<td>".$row['Advisor']."</td>");
      echo("<td>".$row['weekday']." ".$row['apptDate']."</td>");
      echo("<td>".$row['start']."</td>");
      echo("<td>".$row['end']."</td>");
      echo("<td>".$row['Location']."</td>");
      $numStudents = $row['numStudents'];
      $openSeats = $maxStudents - $numStudents;
      echo("<td>".$openSeats."</td>");
      echo("<td><a href='signup.php?meetingID=".$row["meetingID"]."' class='signup' id='signup'>Sign Up</td>");
      echo("</tr>");
    }

  echo("</table>");

}

?>
          </div>
      </div>
    </div>
  </div>

</body>

</html>
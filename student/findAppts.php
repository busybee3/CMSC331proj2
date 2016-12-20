<html>
<head>
<style>
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

<?php 
session_start();
include_once('../CommonMethods.php');

$debug = false;
$COMMON = new Common($debug);
date_default_timezone_set("America/New_York");

$student_id = $_SESSION['STUDENT_ID'];

$apptType = $_GET['apptType'];
$advisor = $_GET['advisor'];
$days = $_GET['days'];



if(isset($_GET['days']) && !empty($_GET['days']))
  {
if($apptType == "indiv")
  {
    $apptType = 0;
    $queryTwo = "SELECT Meeting.meetingID, CONCAT(Advisor.firstName,' ',Advisor.lastName) AS Advisor, DATE_FORMAT(Meeting.start, '%W') AS weekday, DATE_FORMAT(Meeting.start, '%b %e %Y') AS apptDate, DATE_FORMAT(Meeting.start, '%h:%i %p') AS start, DATE_FORMAT(Meeting.end, '%h:%i %p') AS end, CONCAT(Meeting.buildingName,' ',Meeting.roomNumber) AS Location, Meeting.numStudents FROM ((AdvisorMeeting INNER JOIN Meeting ON AdvisorMeeting.meetingID = Meeting.meetingID) INNER JOIN Advisor ON AdvisorMeeting.advisorID = Advisor.advisorID) WHERE Advisor.advisorID = '$advisor' AND Meeting.meetingType = '$apptType' AND Meeting.numStudents = 0 AND Meeting.activeApt = 1 AND WEEKDAY(Meeting.start) IN ($days) ORDER BY apptDate ASC, start ASC";
  }
else
  {
    $apptType = 1;
    $queryTwo = "SELECT Meeting.meetingID, CONCAT(Advisor.firstName,' ',Advisor.lastName) AS Advisor, DATE_FORMAT(Meeting.start, '%W') AS weekday, DATE_FORMAT(Meeting.start, '%b %e %Y') AS apptDate, DATE_FORMAT(Meeting.start, '%h:%i %p') AS start, DATE_FORMAT(Meeting.end, '%h:%i %p') AS end, CONCAT(Meeting.buildingName,' ',Meeting.roomNumber) AS Location, Meeting.numStudents FROM ((AdvisorMeeting INNER JOIN Meeting ON AdvisorMeeting.meetingID = Meeting.meetingID) INNER JOIN Advisor ON AdvisorMeeting.advisorID = Advisor.advisorID) WHERE Advisor.advisorID = '$advisor' AND Meeting.meetingType = '$apptType' AND Meeting.numStudents < 10 AND Meeting.activeApt = 1 AND WEEKDAY(Meeting.start) IN ($days) ORDER BY apptDate ASC, start ASC";
  }

    $rs = $COMMON->executeQuery($queryTwo, $_SERVER["SCRIPT_NAME"]);

    // display all available results into a table
    if(!$rs){
      echo "Cannot parse query.";
    } else if (mysql_num_rows($rs) == 0) {
      echo "There are no available appointments of this type.";
    } else {

      echo("<table id='apptResults'>");
      echo("<tr>");

      echo("<th>Advisor</th>");
      echo("<th>Type</th>");
      echo("<th>Date</th>");
      echo("<th>Start Time</th>");
      echo("<th>End Time</th>");
      echo("<th>Location</th>");
      if($apptType == 1) {
	echo("<th>Open Seats</th>");
      }
      echo("<th></th>");
      echo("</tr>");
      while($row = mysql_fetch_assoc($rs))
	{
	  echo("<tr>");
	  echo("<td hidden value='".$row["meetingID"]."'id='meetingID'>".$row['meetingID']."</td>");
	  echo("<td>".$row['Advisor']."</td>");
	  if($apptType == 0) {
	    echo("<td>Individual</td>");
	  } else if($apptType == 1) {
	    echo("<td>Group</td>");
	  }
	  echo("<td>".$row['weekday']." ".$row['apptDate']."</td>");
	  echo("<td>".$row['start']."</td>");
	  echo("<td>".$row['end']."</td>");
	  echo("<td>".$row['Location']."</td>");
	  if($apptType == 1) {
	    $maxStudents = 10;
	    $numStudents = $row['numStudents'];
	    $openSeats = $maxStudents - $numStudents;
	    echo("<td>".$openSeats."</td>");
	  }
	  echo("<td><a href='signup.php?meetingID=".$row["meetingID"]."' class='signup' id='signup'>Sign Up</td>");
	  echo("</tr>");

	}
      echo("</table>");
    }
  }
else
  {
    echo "Please make sure you complete all steps for the search.";
  }
?>
</body>
</html>
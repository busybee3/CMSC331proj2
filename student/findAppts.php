<html>
<head>
<style>
table {
 width: 100%
     border-collapse: collapse;
 }

table, td, th {
border: 1px solid black;
padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php 
include_once('../CommonMethods.php');

$debug = false;
$COMMON = new Common($debug);


date_default_timezone_set("America/New_York");



$apptType = $_GET['apptType'];
$advisor = $_GET['advisor'];
$days = $_GET['days'];

if($apptType == "indiv")
  {
    $apptType = 0;
  }
else
  {
    $apptType = 1;
  }

if(isset($days))
  {
    /* foreach((array)$days as $key=>$value) */
    /*   { */
    /* 	// run mysql_real_escape_string() on every value encountered */
    /* 	$clean_days = array_map('mysql_real_escape_string', (array)$_REQUEST['days']); */

    /* 	// convert array into a string */
    /* 	$days = implode("','", (array)$clean_days); */
    /*   } */

    $queryTwo = "SELECT CONCAT(Advisor.firstName,' ',Advisor.lastName) AS Advisor, DATE_FORMAT(Meeting.start, '%a') AS weekday, DATE_FORMAT(Meeting.start, '%b %e %Y') AS apptDate, DATE_FORMAT(Meeting.start, '%h:%i %p') AS start, DATE_FORMAT(Meeting.end, '%h:%i %p') AS end, CONCAT(Meeting.buildingName,' ',Meeting.roomNumber) AS Location, Meeting.numStudents FROM ((AdvisorMeeting INNER JOIN Meeting ON AdvisorMeeting.meetingID = Meeting.meetingID) INNER JOIN Advisor ON AdvisorMeeting.advisorID = Advisor.advisorID) WHERE Advisor.advisorID = '$advisor' AND Meeting.meetingType = '$apptType' AND WEEKDAY(Meeting.start) IN ($days) ORDER BY apptDate ASC, start ASC";

    $rs = $COMMON->executeQuery($queryTwo, $_SERVER["SCRIPT_NAME"]);
    
    if(!$rs){
      echo "Cannot parse query";
    } else if (mysql_num_rows($rs) == 0) {
      echo "There are no available appointments of this type.";
    } else {

      echo("<table border='1px'>");
      echo("<th>Advisor</th>");
      echo("<th>Weekday</th>");
      echo("<th>Date</th>");
      echo("<th>Start Time</th>");
      echo("<th>End Time</th>");
      echo("<th>Location</th>");
      echo("<th>num students</th>");

      while($row = mysql_fetch_row($rs))
	{
	  echo("<tr>");
	  foreach ($row as $element)
	    {
	      echo("<td>".$element."</td>");
	    }
	  echo("</tr>");
	}
      echo("</table>");
    }  
  }
?>
</body>
</html>
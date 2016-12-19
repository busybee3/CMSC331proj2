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
<script type="text/javascript">
function sign_up(meetingID) {

  var student_id = <?php echo $student_id ?>;
  var signup = new XMLHttpRequest();
  signup.open("GET", "signup.php?meetingID=" + meetingID, true);
  signup.onreadystatechange = function() {
    if(signup.readyState == 4) {
      document.getElementById("signup_message").innerHTML = signup.responseText;
    }
  }
  signup.send(null);
  }

</script>

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

if($apptType == "indiv")
  {
    $apptType = 0;
  }
else
  {
    $apptType = 1;
  }

if(isset($_GET['days']) && !empty($_GET['days']))
  {
    /* foreach((array)$days as $key=>$value) */
    /*   { */
    /* 	// run mysql_real_escape_string() on every value encountered */
    /* 	$clean_days = array_map('mysql_real_escape_string', (array)$_REQUEST['days']); */

    /* 	// convert array into a string */
    /* 	$days = implode("','", (array)$clean_days); */
    /*   } */

    $queryTwo = "SELECT Meeting.meetingID, CONCAT(Advisor.firstName,' ',Advisor.lastName) AS Advisor, DATE_FORMAT(Meeting.start, '%W') AS weekday, DATE_FORMAT(Meeting.start, '%b %e %Y') AS apptDate, DATE_FORMAT(Meeting.start, '%h:%i %p') AS start, DATE_FORMAT(Meeting.end, '%h:%i %p') AS end, CONCAT(Meeting.buildingName,' ',Meeting.roomNumber) AS Location FROM ((AdvisorMeeting INNER JOIN Meeting ON AdvisorMeeting.meetingID = Meeting.meetingID) INNER JOIN Advisor ON AdvisorMeeting.advisorID = Advisor.advisorID) WHERE Advisor.advisorID = '$advisor' AND Meeting.meetingType = '$apptType' AND WEEKDAY(Meeting.start) IN ($days) ORDER BY apptDate ASC, start ASC";

    $rs = $COMMON->executeQuery($queryTwo, $_SERVER["SCRIPT_NAME"]);
    
    if(!$rs){
      echo "Cannot parse query.";
    } else if (mysql_num_rows($rs) == 0) {
      echo "There are no available appointments of this type.";
    } else {
      echo("my student id ".$student_id."<br>");
      echo("<table id='apptResults'>");
      echo("<tr>");
      echo("<th>Meeting ID</th>");
      echo("<th>Advisor</th>");
      echo("<th>Date</th>");
      echo("<th>Start Time</th>");
      echo("<th>End Time</th>");
      echo("<th>Location</th>");
      echo("<th></th>");
      echo("</tr>");
      while($row = mysql_fetch_assoc($rs))
	{
	  echo("<tr>");
	  /* foreach ($row as $element) */
	  /*   { */
	      
	  /*     echo("<td>".$element."</td>"); */
	  /*   } */
	  echo("<td>".$row['meetingID']."</td>");
	  echo("<td>".$row['Advisor']."</td>");
	  echo("<td>".$row['weekday']." ".$row['apptDate']."</td>");
	  echo("<td>".$row['start']."</td>");
	  echo("<td>".$row['end']."</td>");
	  echo("<td>".$row['Location']."</td>");
	  $json = json_encode($row['meetingID']);
	  $safe = HtmlSpecialChars($json);
	  echo("<td><a href='signup.php' id='signup' onclick=\"sign_up($safe)\">Sign Up</td>");
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
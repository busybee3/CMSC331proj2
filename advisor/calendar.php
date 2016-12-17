
<script>
 /* displays all info about a meeting */
function display_info(meeting_id) {
  var info = new XMLHttpRequest();
  var students = new XMLHttpRequest();
  info.open("GET", "dbquery.php?meeting_id=" + meeting_id, true);
  students.open("GET", "getstudents.php?meeting_id=" + meeting_id, true);
  info.onreadystatechange = function() {    
    if (info.readyState == 4) {      
      document.getElementById("results").innerHTML = info.responseText;
    }
  }  
  students.onreadystatechange = function() {    
    if (students.readyState == 4) {      
      document.getElementById("students").innerHTML = students.responseText;
    }
  }  
  
  info.send(null);
  students.send(null);
}

/* display the form to create a new meeting (with that date alrady filled out */
function display_create(datetime) {    
  var create = new XMLHttpRequest();
  create.open("GET", "create.php?datetime=" + datetime);  
  create.onreadystatechange = function() {
    if (create.readyState == 4) {
      document.getElementById("results").innerHTML = create.responseText;
      document.getElementById("students").innerHTML = "";
    }
  }  
  create.send(null);
}

/* change the offset of the calendar */
function change_offset(offset) {
  document.getElementById("calendar").innerHTML += "<h1>Loading ...</h1>";
  var new_calendar = new XMLHttpRequest();
  new_calendar.open("GET", "calendar.php?off=" + offset);
  new_calendar.onreadystatechange = function() {    
    if (new_calendar.readyState == 4)
      document.getElementById("calendar").innerHTML = new_calendar.responseText;
  }
  new_calendar.send(null);
}
</script>

<?php
echo "<div id='calendar'>";
include("CommonMethods.php");
if (session_status() == PHP_SESSION_NONE)
  session_start();

/* 
 * creates a weekly calendar that uses asynchronous server requests to retrieve meeting information
 * and create new meetings without reloading the page. Deleting uses synchronous requests so that the calendar 
 * can update afterwards
 *
 * Need to implement feature to edit meeting, fix some CSS, and get the print to work since I broke it... again 
 * Also need to change it so that when you creete a meeting, it returns back to that offset in the calendar 
 * (ask everyone in the group about that) */
date_default_timezone_set('America/New_York');
$offset = (isset($_GET['off']) && $_GET['off'] > 0) ? $_GET['off'] : 0;
$today = new Datetime("today + $offset days");
$times = array();
for ($i = 0; $i < 16; $i++)
  array_push($times, date_create("08:30:00")->modify("+".($i*30)." minutes"));     

$aID = $_SESSION["ADVISOR_ID"];      
$conn = new Common(false);;
$dates = array();

echo "<br>";  
echo "<table style='float: left';>";
echo "<tr> <td> <button class='arrow' onclick='change_offset(".($offset-7).")'> &laquo; </button></td>";
echo "<td colspan=5 style='text-align: right;'> <button class='arrow' onclick='change_offset(".($offset+7).")'> &raquo; </button></td></tr>";

echo "<tr>";
echo "<td></td>";
for ($i = 0; $i < 7; $i++) {
  if (intval($today->format("N") < 6)) {
    echo "<td>".$today->format("D")."<br>".$today->format("(m/d)")."</td>";
    array_push($dates, clone($today));
  }
  $today->modify("+1 day");
}
echo "</tr>";

foreach ($times as $time) {
  echo "<tr> <td> {$time->format('g:i a')}</td>";
  foreach ($dates as $date) {
    $query = "SELECT * FROM Meeting JOIN AdvisorMeeting ON AdvisorMeeting.meetingID=Meeting.meetingID
                WHERE start='".$date->format('Y-m-d')." ".$time->format('H:i:s')."';";;
    $row = mysql_fetch_assoc($conn->executeQuery($query, $_SERVER["SCRIPT_NAME"]));
    if (!empty($row))
      echo "<td style='color: white;'><button class='meeting' onclick='display_info({$row['meetingID']})'>Select</button></td>";
    else
      echo "<td><button class='create' onclick='display_create(\"".$date->format('Y-m-d')." ".$time->format('H:i:s')."\")'>Create</button></td>";
  }
  echo "</tr>";
}

echo "</table></div>";

?>

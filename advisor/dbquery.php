
<span class="close"  onclick="this.parentElement.innerHTML=''">&times;</span> 

<?php
include_once('CommonMethods.php');
$conn = new Common(false);
$data = mysql_fetch_assoc($conn->executeQuery("SELECT * FROM Meeting where meetingID={$_GET['meeting_id']};", $_SERVER["SCRIPT_NAME"]));
$meetingTypes = array("Individual", "Group", "Special");
date_default_timezone_set("America/New_York");
$start = new DateTime($data["start"]);
echo "<h4>Date: <br></h4>".$start->format("j F Y")."<br>"; 
echo "<h4>Time: <br></h4>".$start->format("g:i a")." to ".$start->modify("+ 30 minutes")->format("g:i a")."<br>";
echo "<h4>Room: <br></h4>".$data["buildingName"].$data["roomNumber"]."<br>";
echo "<h4>Meeting Type:<br></h4>".$meetingTypes[$data["meetingType"]]."<br>";
echo "<h4>Number Students Signed Up:<br></h4>".($data["numStudents"])."<br>";
?>

<button class='create-btn' onclick="printDiv(this.parentElement.innerHTML)">Print</button>
<form class='create-form'  onsubmit="return confirm('Are you sure you want to delete this meeting?')" action="../utils/forms/deleteMeeting.php" method="POST">
  <input name="meetingID" value="<?php echo $data['meetingID'] ?>" hidden>
  <input class='del-btn' type="submit" value="Delete">
</form>


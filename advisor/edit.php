

<form action="editMeeting.php" method="POST">  
   <span class="close"  onclick="this.parentElement.parentElement.innerHTML=''">&times;</span>
   <?php    
     session_start();
     date_default_timezone_set("America/New_York");
     $date = new DateTime($_GET["datetime"]);
     echo "<h3>Date:<br></h3>".$date->format("j F Y g:i a")."<br>"; 
   ?>
  
  <br>
  <input type="hidden" name="meetingStartTime" value=<?php echo "'".$_GET['datetime']."'"; ?> >
  <?php 
  include('CommonMethods.php');
  $conn = new Common(false);
  $meeting = mysql_fetch_assoc($conn->executeQuery("SELECT * FROM Meeting JOIN AdvisorMeeting ON Meeting.meetingID=AdvisorMeeting.MeetingID 
                                                    WHERE advisorID=".$_SESSION["ADVISOR_ID"]." AND start='".$_GET["datetime"]."';", $_SERVER["SCRIPT_NAME"]));  
  ?>
  <input type="hidden" name="meetingID" value=<?php echo $meeting["meetingID"]; ?> >
  <p>Building Name:</p> 
  <input type="text" name="buildingName" required pattern="[A-Z]{3}" title="ABC" value="<?php echo $meeting['buildingName']; ?>" > <br>
  <p>Room Number:</p>
  <input type="text" name="roomNumber" required pattern="[0-9]{3}" title="123" value="<?php echo $meeting['roomNumber']; ?>" <br>
  <p>Type of Meeting:</p>
   <select id="meeting-type" name="meetingType" onchange="special_check(this)">
    <option value=1 <?php if ($meeting["meetingType"] == 1) echo "selected"; ?> >Group </option>
    <option value=0 <?php if ($meeting["meetingType"] == 0) echo "selected"; ?> >Individual</option>
    <option value=2 <?php if ($meeting["meetingType"] == 2) echo "selected"; ?> >Special</option>
   </select > <br>
    <div id="special-group" <?php echo ($meeting['meetingType'] == 2) ? 'style="display:block;"' : 'style="display:none;"' ; ?> >
    <input type="radio" name="special" value=0 <?php if($meeting["meyerhoffMeeting"]) echo "checked"; ?> >Meyerhoff</input>     
    <input type="radio" name="special" value=1 <?php if($meeting["athleteMeeting"]) echo "checked"; ?> >Athlete</input>     
    <input type="radio" name="special" value=2 <?php if($meeting["honorsMeeting"]) echo "checked"; ?> >Honors</input>     
   </div>
  <input value="Edit" class="create-btn" type="submit">
</form>


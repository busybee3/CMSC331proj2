

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
  <input type="radio" name="active" value=1 <?php if ($meeting["activeApt"]) echo "checked"; ?> >Active</input> <br>
  <input type="radio" name="active" value=0 <?php if (!$meeting["activeApt"]) echo "checked"; ?> >Inactive</input> <br> <br>  
  <p>Building Name:</p> 
  <input type="text" name="buildingName" required pattern="[A-Z]{3}" title="ABC" value="<?php echo $meeting['buildingName']; ?>" > <br>
  <p>Room Number:</p>
  <input type="text" name="roomNumber" required pattern="[0-9]{3}" title="123" value="<?php echo $meeting['roomNumber']; ?>" <br>
  <input value="Edit" class="create-btn" type="submit">
</form>

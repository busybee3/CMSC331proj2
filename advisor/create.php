
<form action="createMeeting.php" method="POST">  
   <span class="close"  onclick="this.parentElement.parentElement.innerHTML=''">&times;</span>
   <?php    
     date_default_timezone_set("America/New_York");
     $date = new DateTime($_GET["datetime"]);
     echo "<h3>Date:<br></h3>".$date->format("j F Y g:i a")."<br>"; 
   ?>
  
  <br>
  <input type="hidden" name="meetingStartTime" value=<?php echo "'".$_GET['datetime']."'"; ?> >
  <p>Building Name:</p> 
    <input type="text" name="buildingName" required pattern="[A-Z]{3}" title="ABC"> <br>
  <p>Room Number:</p>
    <input type="text" name="roomNumber" required pattern="[0-9]{3}" title="123"> <br>
  <p>Type of Meeting:</p>
   <select id="meeting-type" name="meetingType" onchange="special_check(this)">
     <option value=1>Group</option>
     <option value=0>Individual</option>
     <option value=2>Special</option>
   </select > <br>
   <div id="special-group" style="display: none;">
     <br>
     <input type="radio" name="special" value=0>Meyerhoff</input>     
     <input type="radio" name="special" value=1>Athlete</input>     
     <input type="radio" name="special" value=2>Honors</input>     
   </div>
  <p>Number of weeks</p><input name="numWeeks" min=1 max=10 type="number" value=1><br>
  <input value="Create" class="create-btn" type="submit">
</form>
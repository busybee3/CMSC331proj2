<span class="close"  onclick="this.parentElement.innerHTML=''">&times;</span> 
<?php

include_once('CommonMethods.php');
$conn = new Common(false);
$students = $conn->executeQuery("SELECT * FROM Student JOIN StudentMeeting ON StudentMeeting.StudentID=Student.StudentID WHERE MeetingID={$_GET['meeting_id']};", $_SERVER["SCRIPT_NAME"]);
$allStudents = array();
while ($student = mysql_fetch_assoc($students))
  array_push($allStudents, $student);

echo "<h3>Students signed up:</h3>";
foreach ($allStudents as $student)
  echo $student["firstName"]." ".$student["lastName"];

?>


<?php

include 'CommonMethods.php';

$conn = new Common(true);

var_dump($_GET);

$conn->executeQuery("DELETE FROM StudentMeeting WHERE StudentID=".$_GET["studentID"].";", $_SERVER["SCRIPT_NAME"]);
$conn->executeQuery("UPDATE Meeting SET numStudents=numStudents-1 WHERE meetingID=".$_GET["meetingID"].";", $_SERVER["SCRIPT_NAME"]);

?>


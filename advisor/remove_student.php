

<?php

include 'CommonMethods.php';

$conn = new Common(true);

$conn->executeQuery("DELETE FROM StudentMeeting WHERE StudentID=".$_GET["StudentID"].";", $_SERVER["SCRIPT_NAME"]);
$conn->executeQuery("UPDATE Meeting
?>


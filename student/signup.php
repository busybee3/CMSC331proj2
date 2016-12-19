<?php
session_start();
include_once('../CommonMethods.php');
$conn = new Common(true);

$meetingID = $_GET['meetingID'];
$student_id = $_SESSION["STUDENT_ID"];



$signUp = "INSERT INTO StudentMeeting(StudentID, MeetingID) VALUES ($student_id, $meetingID)";
$conn->executeQuery($signUp, $_SERVER["SCRIPT_NAME"]);




?>

<?php
session_start();
include_once('../CommonMethods.php');
$conn = new Common(true);

$meetingID = $_GET['meetingID'];
$student_id = $_SESSION["STUDENT_ID"];


$signUp = $conn->executeQuery("INSERT INTO StudentMeeting(StudentID, MeetingID) VALUES ($student_id, $meetingID)", $_SERVER["SCRIPT_NAME"]);

if($signUp)
  {
    $numStudents = $conn->executeQuery("SELECT numStudents FROM Meeting WHERE meetingID = '$meetingID'", $_SERVER["SCRIPT_NAME"]);
    $numStudents += 1;
    $addStudent = $conn->executeQuery("UPDATE Meeting SET numStudents = '$numStudents' WHERE meetingID = '$meetingID'", $_SERVER["SCRIPT_NAME"]);
    header("Location: appointments.php");
  }

else {
  // TO DO: add error message here so it shows up on setAppt page
  header("Location: setAppt.php");
}
?>

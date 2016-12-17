

<?php
session_start();
if (!isset($_SESSION["HAS_LOGGED_IN"]) || !$_SESSION["HAS_LOGGED_IN"]
    || !isset($_POST["delete-from"]))
  header("home.php");

include "CommonMethods.php";
$conn = new Common(true);

$start = $_POST["delete-from"]." ".$_POST["delete-from-time"];
$end = $_POST["delete-to"]." ".$_POST["delete-to-time"];

$exceptThese = "";
if (!$_POST["delete-specification"])
  $exceptThese = "EXCEPT (SELECT Meeting_ID FROM StudentMeeting)";

$query = "DELETE Meeting, AdvisorMeeting FROM Meeting JOIN AdvisorMeeting ON AdvisorMeeting.MeetingID=Meeting.meetingID WHERE advisorID=".$_SESSION["ADVISOR_ID"]." AND start BETWEEN '{$start}:00' AND '{$end}:00' $exceptThese";
$conn->executeQuery($query, $_SERVER["SCRIPT_NAME"]);

?>
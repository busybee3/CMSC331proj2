<?php
session_start();
date_default_timezone_set("America/New_York");

include_once "CommonMethods.php";
$conn = new Common(true);
echo "<br>";
$conn->executeQuery("UPDATE Meeting SET start='".$_POST["meetingStartTime"]."' AND buildingName='".$_POST["buildingName"]."' AND roomNumber=".$_POST["roomNumber"]." AND meetingType=".$_POST["meetingType"]." WHERE meetingID=".$_POST["meetingID"].";", $_SERVER["SCRIPT_NAME"]);

?>
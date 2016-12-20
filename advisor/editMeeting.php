<?php
session_start();
date_default_timezone_set("America/New_York");

var_dump($_POST);
include_once "CommonMethods.php";
$conn = new Common(true);
echo "<br>";
$active = array("true", "false");
$conn->executeQuery("UPDATE Meeting SET buildingName='".$_POST["buildingName"]."', roomNumber='".$_POST["roomNumber"]."', activeApt='".$_POST["active"]."' WHERE meetingID=".$_POST["meetingID"].";", $_SERVER["SCRIPT_NAME"]);

?>
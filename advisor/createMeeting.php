<?php
session_start();
date_default_timezone_set("America/New_York");
if ($_SESSION["HAS_LOGGED_IN"] and $_POST) {
  include 'CommonMethods.php';
  $conn = new Common(true);
  
  // Parse through variables from form
  $start = $_POST["meetingStartTime"];
  $bName = $_POST["buildingName"];
  $rNumber = $_POST["roomNumber"];
  $typeOfMeeting = $_POST["meetingType"];

  $numOfErrors = 0;
  if ($start == "") {
    $_SESSION["ERROR_ADVISOR_MEETING_DATE_OR_TIME"] = "Error: You should probably enter in a date.";
    $numOfErrors += 1;
  }
  if ($bName == "") {
    $numOfErrors += 1;
    $_SESSION["ERROR_ADVISOR_MEETING_BUILDING"] = "Error: You haven't enetered a building name.";
  }
  if ($rNumber == "") {
    $numOfErrors += 1;
    $_SESSION["ERROR_ADVISOR_MEETING_ROOM"] = "Error: You must enter in a room number.";
  }

  if ($numOfErrors == 0) {
    // Use assigned variable stored in session
    $advisorID = $_SESSION["ADVISOR_ID"];
    echo $advisorID;
    $startDate = new DateTime($start);
    // Add 30 mins
    $endDate = new DateTime($start);
    $endDate->add(new DateInterval('PT30M'));

    /* set to January 31st so we have more dates to work with */
    $endOfSemester = new DateTime("January 31, 2017");

    // Storing dates into string format for MySQL
    // Open DB Connection
    // Create meeting SQL query and insert into DB    
    for ($i = 0; $i < $_POST["numWeeks"]; $i++) {
      if ($startDate > $endOfSemester)
	break;

      $formattedStartDate = $startDate->format('Y-m-d H:i:s');
      $formattedEndDate = $endDate->format('Y-m-d H:i:s');
      
      $whichGroup = "";
      $specialMeeting = "";
      $specialGroups = array(", meyerhoffMeeting", ", athleteMeeting", ", honorsMeeting"); 
      $specialValues = array(", 0", ", 1", ", 2");
      if ($typeOfMeeting == 2) {
	$whichGroup=$specialGroups[$_POST["special"]];
	$specialMeeting = ", true";
      }
      $insertIntoMeetings = "
          INSERT INTO Meeting(start,end,buildingName,roomNumber, meetingType, numStudents $whichGroup)
          VALUES (
            '$formattedStartDate','$formattedEndDate','$bName', '$rNumber', $typeOfMeeting, 0 $specialMeeting
          )
        ";
      $conn->executeQuery($insertIntoMeetings, $_SERVER["SCRIPT_NAME"]);
      // Create sql query to insert the meeting to advisor meeting
      $insertIntoAdvisingMeeting = "
          INSERT INTO
          AdvisorMeeting(advisorID,meetingID)
          VALUES($advisorID, ".mysql_insert_id().")";
      $conn->executeQuery($insertIntoAdvisingMeeting, $_SERVER["SCRIPT_NAME"]);
      /* error_log($open_connection->error); */

      $startDate->modify("+1 week");
      $endDate->modify("+1 week");
    }
  }
  header('calendar_base.php');
}
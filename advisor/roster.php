<!doctype html>
<html>
<head>
  <title> Roster </title>
</head>

<body>
  <div style="max-width: 650px; margin: 0 auto;">
    <?php 
    include('CommonMethods.php');
    $conn = new Common(false);
    $all_students = array();
    $data = $conn->executeQuery("SELECT Student.firstName, Student.lastName, Student.schoolID, Student.major, Meeting.start, Meeting.end 
                                 FROM Student 
                                 JOIN StudentMeeting ON Student.StudentID=StudentMeeting.StudentID 
                                 JOIN Meeting ON StudentMeeting.meetingID=Meeting.MeetingID", $_SERVER["SCRIPT_NAME"]);
    while ($student = mysql_fetch_array($data, MYSQL_BOTH))
      array_push($all_students, $student);
    echo "<table>";
    echo "<tr> <th> First Name <th> Last Name <th> School ID <th> Major <th> Start <th> End </tr>";
    for ($i = 0; $i < sizeof($all_students); $i++) {
      echo "<tr>";
      for ($j = 0; $j < 6; $j++)
	echo "<td>".$all_students[$i][$j];
    }
    echo "</table";
    ?>
  </div>
<body>

<html>
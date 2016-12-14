<!DOCTYPE HTML>
<html>
<head>
     <title>Students of Other Majors</title>
     <link href="registerstyle.css" type="text/css" rel="stylesheet">
</head>

<body>

  <div class="main-form"> 
      <h1>Students of Other Majors</h1>
  </div>

<?php

// Grab the session data to send back to
// index.php and plug back into the fields.
session_start();

if(isset($_SESSION['studentEmail'])){

  $email = $_SESSION['studentEmail'];
  $_SESSION['studentEmail'] = $email;

}

if(isset($_SESSION['studentfName'])){

  $fName = $_SESSION['studentfName'];
  $_SESSION['studentfName'] = $fName;

}

if(isset($_SESSION['studentmName'])){

  $pName = $_SESSION['studentpName'];
  $_SESSION['studentpName'] = $pName;

}

if(isset($_SESSION['studentfName'])){

  $lName = $_SESSION['studentlName'];
  $_SESSION['studentlName'] = $lName;

}

if(isset($_SESSION['studentID'])){

  $schoolID = $_SESSION['studentID'];
  $_SESSION['studentID'] = $schoolID;

}

?>

<html>
<form action="https://swe.umbc.edu/~dcuocci1/project2/CMSC331proj2/student/register.php">

<div class='container' style='float: right;'>

  <br>
  You have indicated that you plan to pursue a<br>
  major other than one of the following, beginning<br>
  next semester:

  <ul style="padding-left:20px">
    <li>Biological Sciences B.A.</li>
    <li>Biological Sciences B.S.</li>
    <li>Biochemistry & Molecular Biology B.S.</li>
    <li>Bioinformatics & Computational Biology B.S.</li>
    <li>Biology Education B.A.</li>
    <li>Chemistry B.A.</li>
    <li>Chemistry B.S.</li>
    <li>Chemistry Education B.A.</li>
  </ul>

  <br>

  In order to obtain the BEST advice about course<br>
  selection, degree progress, and academic policy,<br>
  please meet with a representative of the<br>
  department that administers your NEW major.<br><br>

  You can find advising contact information for your<br>
  new major on the Office for Academic and Pre-Professional Advising Office's <a href="http://advising.umbc.edu/departmental-advising">Departmental<br>
  Advising page</a>. That contact person/office will be<br>
  able to give you instructions on how to schedule<br>
  an advising appointment with someone in that<br>
  area.<br><br>

  Good luck with your new major!<br><br>

  If you selected "Other" in error, click the button to return to the previous screen.<br>

  <input type="submit" value="RETURN" class="submit" name="Register" style="color: white; border: none; font-family: Arial, sans-serif; font-size: 20px; width: 120px; line-height: 25px; margin: 0 auto; padding: 10px 0;">
  </form>
</div>

</body>
</html>
<!DOCTYPE HTML>
<html>
<head>

     <title>Future Plans</title>
     <link rel="stylesheet" type="text/css" href="registerstyle.css">

</head>

<body>

<?php

include('CommonMethods.php');
$debug = false;
$COMMON = new Common($debug);
$fileName = "studentconfirmed.php";

session_start();

if (isset($_SESSION['studentEmail'])){

  $studentEmail = $_SESSION['studentEmail'];

}

$sql = "SELECT * FROM questionsAndPlans WHERE email = '$studentEmail'";
$rs = $COMMON->executeQuery($sql,$fileName);
$row = mysql_fetch_row($rs);


if (!$_POST) { ?>

  <div class="main-form">
    <div id="greeting-text"> 
      <h1>Account created successfully!<br/></h1>
    </div>
  </div>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<div class="main">

  <center>

    Now that your account has been created, please take the time to answer<br>
    the following questions, which will be of great benefit to your advisor<br>
    during this process.<br><br>
  
    What are your current post-UMBC plans? For example: Medical School, Teach<br>
    middle school science, Research career, Master's/PhD, etc. (max length: 128 characters)<br>
    
    <input type="text" align="center" name="futurePlans" maxlength="128" style="width:450px"><br><br>
   
    
    Do you have any questions or concerns that you would like to discuss during<br>
    your advising session? For example: Withdrawing from a course, adding a<br>
    second major, etc. (max length: 128 characters)<br>
    
    <input type="text" align="center" name="advisingQuestions" maxlength="128" style="width:450px"><br>


    <input type="submit" value="SUBMIT" name="Register" class="submit" style="color: white; border: none; font-family: Arial, sans-serif; font-size: 20px; width: 120px; line-height: 25px; margin: 0 auto; padding: 10px 0;">
    </form>

    <form action="index.php">
      <input type="submit" value="RETURN" name="Return" class="submit" style="color: white; border: none; font-family: Arial, sans-serif; font-size: 20px; width: 120px; line-height: 25px; margin: 0 auto; padding: 10px 0;">
    </form>

  </center>
</div>

  <?php

}

else if ($_POST) {

  $futurePlans = $_POST['futurePlans'];

  $advisingQuestions = $_POST['advisingQuestions'];

  if (strlen($futurePlans) <= 1) {

    $futurePlans = "N/A";
  
  }

  if (strlen($advisingQuestions) <= 1) {

    $advisingQuestions = "N/A";

  }

  $sql = "UPDATE questionsAndPlans SET futurePlans='$futurePlans', advisingQuestions='$advisingQuestions' WHERE email='$studentEmail'";
  $rs = $COMMON->executeQuery($sql,$fileName);

  ?>

  <div id="greeting-text"> 
    <h1>Answers recorded!<br/>
    You may now log in with your new user ID: <?php echo($studentEmail) ?>
    </h1>
  </div>

  <center>
    </form>
    <form action="https://swe.umbc.edu/~dcuocci1/project2/CMSC331proj2/student/index.php">
    <input type="submit" value="LOGIN" name="Register" class="submit" style="color: white; border: none; font-family: Arial, sans-serif; font-size: 20px; width: 120px; line-height: 25px; margin: 0 auto; padding: 10px 0;">
    </form>
  </center>
    

<?php

}

?>

</div>


</body>
</html>

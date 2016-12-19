<!DOCTYPE HTML>
<html>
<head>

     <title>Future Plans</title>
     <link rel="stylesheet" type="text/css" href="registerstyle.css">

</head>

<body>

<?php


// Connect to the db.
include('../CommonMethods.php');

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

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="qpform">

<div class="main">  

    Please complete the form(s).<br><br>
  
    What are your current post-UMBC plans?<br>
    <textarea rows="4" cols="50" name="futurePlans" maxlength="128" placeholder="For example: Medical School, Teach middle school science, Research career, Master's/PhD, etc."></textarea><br><br>
        
    Do you have any questions or concerns that you would like to discuss during
    your advising session?<br>
    <textarea rows="4" cols="50" name="advisingQuestions" maxlength="128" placeholder="For example: Withdrawing from course, adding a second major, etc..."></textarea><br><br>


    <a class="return-link" href="index.php">LOGIN</a>  
    <input type="submit" value="SUBMIT" name="Register" class="submit" style="color: white; border: none; font-family: Arial, sans-serif; font-size: 20px; width: 120px; line-height: 25px; margin: 0 auto; padding: 10px 0;">
    </form>


  
</div>

  <?php

}

else if ($_POST) {


  if (isset($_POST["futurePlans"])){ 
  
    $futurePlans = $_POST["futurePlans"];

  }

  if (isset($_POST["advisingQuestions"])){

    $advisingQuestions = $_POST["advisingQuestions"];

  }

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
    <form action="index.php">
    <input type="submit" value="LOGIN" name="Register" class="submit" style="color: white; border: none; font-family: Arial, sans-serif; font-size: 20px; width: 120px; line-height: 25px; margin: 0 auto; padding: 10px 0;">
    </form>
  </center>
    

<?php

}

?>

</div>

<script>

function clearContents(element) {
  element.value = '';
}

</script>

</body>
</html>

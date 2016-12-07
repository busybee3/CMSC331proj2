<!DOCTYPE HTML>
<html>
<head>

     <title>New Account Creation - Next Steps</title>
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


if (empty($row) && !$_POST) { ?>


  <div class="main-form">
    <div id="greeting-text"> 
      <h1>Next Steps <br/></h1>
    </div>
  </div>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<div class="main">

  <fieldset>
  
    <h3>What are your current post-UMBC plans? For example: Medical School, Teach
    middle school science, Research career, Master's/PhD, etc. (max length: 128 characters)
    </h3> 
    <input type="text" align="center" name="futurePlans" maxlength="128">
   
    <h3>
        Do you have any questions or concerns that you would like to discuss during
        your advising session? For example: Withdrawing from a course, adding a
        second major, etc. (max length: 128 characters)
    </h3>
    <input type="text" align="center" name="advisingQuestions" maxlength="128">



    <input type="submit" value="SUBMIT" name="Register" style="background-color:green;border-color:green">
    </form>
    <form action="https://swe.umbc.edu/~dcuocci1/project2/CMSC331proj2/student/index.php" style="display:inline;">
    <input type="submit" value="RETURN" name="Register" style="background-color:green;border-color:green">
    </form>

  </fieldset>
</div>

  <?php

}

else if (empty($row) && $_POST) {

  if (sizeof($_POST['futurePlans']) <= 1) {

    $futurePlans = "N/A";

  }

  else{

   $futurePlans = $_POST['futurePlans'];

  }

  if (sizeof($_POST['advisingQuestions']) <= 1) {

    $advisingQuestions = "N/A";

  }

  else{

   $advisingQuestions = $_POST['advisingQuestions'];

  }

  $sql = "INSERT INTO questionsAndPlans (questionsplansID,email,futurePlans,advisingQuestions) VALUES ('','$studentEmail', '$futurePlans','$advisingQuestions')";
  $rs = $COMMON->executeQuery($sql,$fileName);

  ?>

  <div id="greeting-text"> 
    <h1>New user creation successful!<br/>
    You may now log in with your new user ID: <?php echo($studentEmail) ?>
    </h1>
  </div>

  <center>
    </form>
    <form action="https://swe.umbc.edu/~dcuocci1/project2/CMSC331proj2/student/index.php">
    <input type="submit" value="RETURN" name="Register" style="background-color:green;border-color:green">
    </form>
  </center>
    

<?php

}

?>

</div>


</body>
</html>

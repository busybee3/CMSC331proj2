<html>
<head>
<title>Approved</title>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>

	<form method="post" name="approved">
	<p>Have you been given clearance to register for classes for the next semester?</p>
	<input type="radio" name="approv" id="yes" value="yes">I have been given clearance to register.<br>
    <input type="radio" name="approv" id="no" value="no" checked>I have not been given clearance to register.<br>
	<!--<span class="error">* <?php echo $error;?></span>-->
	
	<input type="submit" name="confirm" value="Submit">
	
<?php
// Open session and grab the data from it.
session_start();
$studentID = $_SESSION["STUDENT_ID"];  
$_SESSION["STUDENT_ID"] = $studentID;
$studentEmail = $_SESSION["STUDENT_EMAIL"];
$_SESSION["STUDENT_EMAIL"] = $studentEmail;


//connect to database
include 'CommonMethods.php';
$debug = false;
$COMMON = new Common($debug);
$filename = "approved.php";

$error = "";

if(isset($_POST["confirm"])){
	
	if(empty($_POST["approv"]))
	{
		$error = "A choice is required";
	}
	elseif(isset($_POST['approv']) && !empty($_POST['approv']))
	{
        if($_POST['approv'] == 'yes')
		{
            $update = "UPDATE Student SET approvedForReg=1 WHERE StudentID = $studentID";
			$rs = $COMMON->executeQuery($update, $filename);
			header("Location: noAction.php");
        }elseif($_POST['approv'] == 'no')
		{
            $update = "UPDATE Student SET approvedForReg=0 WHERE StudentID = $studentID";
			$rs = $COMMON->executeQuery($update, $filename);
			header("Location: setAppt.php");
        } 
	}
}
?>

</form>
</body>
</html>
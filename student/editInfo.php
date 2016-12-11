<!DOCTYPE html>
<html>

<head>
  <title>Edit Information</title>
<style>
body {
  background-color:#f5ca5c ;
 }

ul {
  font-family: Arial;
  list-style-type: none;
margin: 0;
position: absolute;
top: 0;
left:0;
width: 98%;
overflow: hidden;
  background-color: #333;
}

li {
  float: right;
}

.active {
  background-color:black;
  border-color:black;
  color: white;
}

.btn:focus {
  background-color:black;
  border-color:white;
  color: white;
}



.logo {
  float: left;
padding: 4px 5px;
 }

li a {
display: block;
color: white;
  text-align: center;
padding: 14px 20px;
  text-decoration: none;
}


.edit-info {
  font-family: Arial;
  font-size: 32px;
  background-color: white;
color: black;
margin: auto;
width: 50%;
border: 3px solid green;
padding: 20px;
 }

#header {
text-align: center;
}

button {
  background-color: grey;
border: none;
olor: white;
padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  font-size: 16px;
display: inline-block;

}


</style>

</head>

<body>

<?php



session_start();
$studentEmail = $_SESSION["STUDENT_EMAIL"];
$_SESSION["STUDENT_EMAIL"] = $studentEmail;

// Connect to DB and pull the student's current Major.
include('CommonMethods.php');
$debug = false;
$COMMON = new Common($debug);
$fileName = "worksheet.php";

if (isset($_POST['updateMajor'])) {

  $newMajor = $_POST['updateMajor'];

  $sql = "UPDATE Student SET major='$newMajor' WHERE email='$studentEmail'";
  $rs = $COMMON->executeQuery($sql,$fileName);


}

$sql = "SELECT * FROM Student WHERE email = '$studentEmail'";
$rs = $COMMON->executeQuery($sql,$fileName);
$row = mysql_fetch_row($rs);

// Column 7 is the major row.
$currentMajor = $row[7];





?>


<ul>
  <div class="logo">
  <img src="https://s16.postimg.org/ckbr6pov9/THISSS.png" height="50px">
  </div>
  <li><a href="logout.php">LOGOUT</a></li>
  <li><a href="home.php">MY DASHBOARD</a></li>
</ul>

<div class="edit-info">
<div id="header">
<h2>Edit Information</h2>
</div>

<?php

if (isset($_POST['updateMajor'])) {

  echo("Major Updated!"); 

}

?>

<h3>Your Major:</h3>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">


  <div class="btn-group" role="group">

    
    <button type="button" class="btn btn-1" name="major" value="Biology" <?php if ($currentMajor == "Biology"){ ?> autofocus <?php } ?> >Biology</button>
    <button type="button" class="btn btn-1" name="major" value="Biochemistry" <?php if ($currentMajor == "Biochemistry"){ ?> autofocus <?php } ?> >Biochemistry</button>
    <button type="button" class="btn btn-1" name="major" value="Bioinformatics" <?php if ($currentMajor == "Bioinformatics"){ ?> autofocus <?php } ?> >Bioinformatics</button>
    <button type="button" class="btn btn-1" name="major" value="Bioeducation" <?php if ($currentMajor == "Bioeducation"){ ?> autofocus <?php } ?> >Bioeducation</button>
    <button type="button" class="btn btn-1" name="major" value="Chemistry" <?php if ($currentMajor == "Chemistry"){ ?> autofocus <?php } ?> >Chemistry</button>
    <button type="button" class="btn btn-1" name="major" value="Chemeducation" <?php if ($currentMajor == "Chemeducation"){ ?> autofocus <?php } ?> >Chemeducation</button>
    <br/>

  </div><br>


<div class="btn-group" role="group">

  <input type="hidden" name="updateMajor" value="" id="updateMajor">
  <input type="submit" value="UPDATE" name="Register" class="submit" style="color: white; background-color: green; float: right; border: none; font-family: Arial, sans-serif; font-size: 20px; width: 120px; line-height: 25px; margin: 0 auto; padding: 10px 0;">

  </form>

  
</div>




</div>

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>

   $(document).ready(function(){ 
       $(".btn").click(function() { 

	   $(this).toggleClass("active").siblings().removeClass("active");
  
           var buttonVal = $(this).attr("value");
           $("#updateMajor").val(buttonVal);
           
	 });


     });

</script>

</html>

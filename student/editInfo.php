<!DOCTYPE html>
<html>

<head>
  <title>Edit Information</title>
<style>
body {
  background-color:#f5ca5c ;
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

.btn{
  background-color:grey;
  border-color:grey;
  color:white;
  margin-bottom: 5px;
}

.btn2{
  background-color:grey;
  border-color:grey;
  color:white;
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

.btn:active{

  background-color:black;
  border-color:black;
  color: white;
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
height: 580px;
border: 3px solid green;
padding: 20px;
 }

#header {
text-align: center;
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

// Update the major if asked.
if (isset($_POST['updateMajor']) && $_POST['updateMajor'] != "") {

  $newMajor = $_POST['updateMajor'];

  $sql = "UPDATE Student SET major='$newMajor' WHERE email='$studentEmail'";
  $rs = $COMMON->executeQuery($sql,$fileName);

}

// Update the career track if asked.
if (isset($_POST['updateCareer']) && $_POST['updateCareer'] != "") {

  $newCareer = $_POST['updateCareer'];

  $sql = "UPDATE Student SET careerTrack='$newCareer' WHERE email='$studentEmail'";
  $rs = $COMMON->executeQuery($sql,$fileName);

}

// Send an alert that the information was updated.
if (isset($_POST['updateCareer']) || isset($_POST['updateMajor'])) {

  $updateNotification = "Information updated!";
  echo "<script type='text/javascript'>alert('$updateNotification');</script>";

}

// Grab whatever the data is after the update (if there was an update).
$sql = "SELECT * FROM Student WHERE email = '$studentEmail'";
$rs = $COMMON->executeQuery($sql,$fileName);
$row = mysql_fetch_assoc($rs);

// Column 7 is the major row.
// Column 8 is current career track.
$currentMajor = $row['major'];
$currentCareer = $row['careerTrack'];




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





<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">


  <div class="btn-group" role="group" name="major">

    <h3>Your Major:</h3>
    
    <button type="button" name="major" value="BiologyBA" <?php if ($currentMajor == "BiologyBA"){ ?> class="btn btn-default active" <?php } else {  ?> class="btn btn-1" <?php } ?> >Biology B.A.</button>
    <button type="button" name="major" value="BiologyBS" <?php if ($currentMajor == "BiologyBS"){ ?> class="btn btn-default active" <?php } else {  ?> class="btn btn-1" <?php } ?> >Biology B.S.</button>
    <button type="button" name="major" value="BioChemBS" <?php if ($currentMajor == "BioChemBS"){ ?> class="btn btn-default active"  <?php } else {  ?> class="btn btn-1" <?php } ?> >Biochemistry & Molecular Biology B.S.</button>
    <button type="button" name="major" value="BioInfoBS" <?php if ($currentMajor == "BioInfoBS"){ ?> class="btn btn-default active"  <?php } else {  ?> class="btn btn-1" <?php } ?> >Bioinformatics & Computational Biology B.S.</button>
    <button type="button" name="major" value="BioEdBA" <?php if ($currentMajor == "BioEdBA"){ ?> class="btn btn-default active"  <?php } else {  ?> class="btn btn-1" <?php } ?> >Biology Education B.A.</button>
    <button type="button" name="major" value="ChemBA" <?php if ($currentMajor == "ChemBA"){ ?> class="btn btn-default active"  <?php } else {  ?> class="btn btn-1" <?php } ?> >Chemistry B.A.</button>
    <button type="button" name="major" value="ChemBS" <?php if ($currentMajor == "ChemBS"){ ?> class="btn btn-default active"  <?php } else {  ?> class="btn btn-1" <?php } ?> >Chemistry B.S.</button>
    <button type="button" name="major" value="ChemEdBA" <?php if ($currentMajor == "ChemEdBA"){ ?> class="btn btn-default active"  <?php } else {  ?> class="btn btn-1" <?php } ?> >Chemistry Education B.A.</button>
    <br/>

  </div>



  <div class="btn-group" role="group" name="career">

    <h3>Your Primary Career Track:</h3>  

    
    <button type="button" name="career" value="Research" <?php if ($currentCareer == "Research"){ ?> class="btn2 btn2-default active"  <?php } else {  ?> class="btn2 btn-2" <?php } ?> >Research</button>
    <button type="button" name="career" value="Health Profession" <?php if ($currentCareer == "Health Profession"){ ?> class="btn2 btn2-default active"  <?php } else {  ?> class="btn2 btn-2" <?php } ?> >Health Profession</button>        
    <button type="button" name="career" value="Industry" <?php if ($currentCareer == "Industry"){ ?> class="btn2 btn2-default active"  <?php } else {  ?> class="btn2 btn-2" <?php } ?> >Industry</button>
    <button type="button" name="career" value="Education" <?php if ($currentCareer == "Education"){ ?> class="btn2 btn2-default active"  <?php } else {  ?> class="btn2 btn-2" <?php } ?> >Education</button>
    <button type="button" name="career" value="Other" <?php if ($currentCareer == "Other"){ ?> class="btn2 btn2-default active"  <?php } else {  ?> class="btn2 btn-2" <?php } ?> >Other</button>
    <button type="button" name="career" value="Uncertain" <?php if ($currentCareer == "Uncertain"){ ?> class="btn2 btn2-default active"  <?php } else {  ?> class="btn2 btn-2" <?php } ?> >Uncertain</button>

  </div>

  

<br>

  <div class="btn-group" role="group">

    <input type="hidden" name="updateMajor" value="" id="updateMajor">
    <input type="hidden" name="updateCareer" value="" id="updateCareer">
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

<script>

   $(document).ready(function(){ 
       $(".btn2").click(function() { 

	   $(this).toggleClass("active").siblings().removeClass("active");
  
           var buttonVal = $(this).attr("value");
           $("#updateCareer").val(buttonVal);
           
	 });


     });

</script>

</html>

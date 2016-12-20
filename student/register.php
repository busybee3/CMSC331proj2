<!DOCTYPE html>
<html>

<head>
  <title>Student Registration</title>
  <link rel="stylesheet" type="text/css" href="registerstyle.css">
</head>

<?php

// Connect to the db.
include '../CommonMethods.php';
$fileName = "register.php";  
$debug = false;
$COMMON = new Common($debug);

// Query to see if the advising site is shut down. 
$site_status = "SELECT * FROM Advisor";
$site_status_query = $COMMON->executequery($site_status, $fileName);
$site_status_bool = 0;

// Iterate through all the results
while ($site_status_results = mysql_fetch_row($site_status_query)) {

  // If any Advisor results show a 1, the shutdown message
  // will not show, thus $site_status_bool is set to 1.
  if ($site_status_results[1] == 1) {

    $site_status_bool = 1;   
  
  }

}

// If the bool is still 0 at this point,
// redirect.
if ($site_status_bool == 0) {

  header('Location: shutdown.php');

}

session_start();

// Set some values just in case they aren't set by POST.
$email_error_message = $pass_error_message = $fName_error_message = $lName_error_message = $password_match_error = "";
$schoolID_error_message = $major_error_message = $career_error_message = $birth_error_message = $spec_group_error_message = "";
$email = $fName = $lName = $schoolID = $major = $career = "";

  
if($_POST){    
 
  //defining variables used for query
  // Store a reasonable amount of data in
  // the session to repopulate the fields.

  if (isset($_POST["email"])) {

    $email = $_POST["email"];
    $_SESSION['studentEmail'] = $email;


  }
  if (isset($_POST["password"])) {
  
    $password = $_POST["password"];

  }
  if (isset($_POST["con_password"])) {
  
    $con_password = $_POST["con_password"];

  }
  if (isset($_POST["fName"])) {

    $fName = $_POST["fName"];
    $_SESSION['studentfName'] = $fName;

  }

  if (isset($_POST["pName"])) {

    $pName = $_POST["pName"];
    $_SESSION['studentpName'] = $pName;

  }

  if (isset($_POST["lName"])) {

    $lName = $_POST["lName"];
    $_SESSION['studentlName'] = $lName;

  }

  if (isset($_POST["schoolID"])) {

    $schoolID = $_POST["schoolID"];
    $_SESSION['studentID'] = $schoolID;

  }

  if (isset($_POST["major_select"])) {

    $major = $_POST["major_select"]; 

  }

  if (isset($_POST["career_select"])) {

    $career = $_POST["career_select"];

  }

  if (isset($_POST["birth_city"])) {

    $birth_city = $_POST["birth_city"];

  }

  if (isset($_POST["spec_group_select"]) && $_POST["spec_group_select"] != "") {
   
    $spec_group = $_POST["spec_group_select"];  
       
  }

  else {

      $misc_error = true;
      $spec_group_error_message = "Please select yes or no.";      

  }    

  // Encrypt the password entered.
  $encryptPass = md5($password);

  //regex for email validation 
  $email_validation = '/^[A-Za-z0-9_]+@(umbc.edu)$/';
  
  //boolean to determine if email is invalid
  $invalid_email = false;
  
  //boolean to determine if miscellanious error has occured
  $misc_error = false;
 
  //boolean to determine if student record exists in db
  $student_exists = false;
  
  //query for student validation
  $student_val_query = "SELECT * FROM Student WHERE email = '$email'";
  
  //query execution
  $validation_query = $COMMON->executequery($student_val_query, $fileName);

  //determines if atleast one record exists with entered email
  if(mysql_num_rows($validation_query) > 0){
    $student_exists = true;
    $email_error_message = "Record exists for this e-mail.";
  }

  //query for student validation
  $student_val_query = "SELECT * FROM Student WHERE schoolID = '$schoolID'";
  
  //query execution
  $validation_query = $COMMON->executequery($student_val_query, $fileName);

  //determines if atleast one record exists with entered email
  if(mysql_num_rows($validation_query) > 0){
    $student_exists = true;
    $schoolID_error_message = "Record exists for this school ID.";
  }

  // Make sure there isn't an advisor account with that user ID.
  // Commented out for now until I figure out what's up with umbc IDs 
  // being on the Advisor table.

//  $student_val_query = "SELECT * FROM Advisor WHERE schoolID = '$schoolID'";
  
  //query execution
//  $validation_query = $COMMON->executequery($student_val_query, $fileName);

  //determines if atleast one record exists with entered email
//  if(mysql_num_rows($validation_query) > 0){
//    $student_exists = true;
 //   $schoolID_error_message = "Record exists for this school ID.";
 // }
  
  //email validation, may not need nested ifs
  if(!preg_match($email_validation, $email)){

  
    // Ensure that every field was filled out.  
    $invalid_email = true;
  
    if(empty($_POST["email"]) || $invalid_email == true){

      //echo "<br>Please enter email.<br>";
      $misc_error = true;
      $email_error_message = "Please enter a valid e-mail.";

    }
  
    if(empty($_POST["password"])){

      $misc_error = true;
      $pass_error_message = "Please choose a password.";
    }

    if(empty($_POST["con_password"]) || ($password != $con_password) ){

      $misc_error = true;
      $password_match_error = "Passwords do not match.";

    }
    if(empty($_POST["fName"])){
     
      $misc_error = true;
      $fName_error_message = "Please enter your first name.";

    }
    
    if(empty($_POST["lName"])){
     
      $misc_error = true;
      $lName_error_message = "Please enter your last name.";

    }
    
    if(empty($_POST["schoolID"])){

      $misc_error = true;
      $schoolID_error_message = "Please enter your school ID.";

    }
    
    if(empty($_POST["major_select"])){

      $misc_error = true;
      $major_error_message = "Please enter your major.";

    }

    if(empty($_POST["career_select"])){
   
      $misc_error = true;
      $career_error_message = "Please enter your primary career track.";

    }    

    if(empty($_POST["birth_city"])){

      $misc_error = true;
      $birth_error_message = "Please enter a city.";

    }


    // Ensure that the password matches the confirmation password.
    if($password != $con_password){

      $misc_error = true;
      $password_match_error = "Passwords do not match.";

    }

  }
  
  //additional field validation
  if(preg_match($email_validation, $email)){

    // Ensure data has been entered in all fields.
    if(empty($_POST["email"])){

      $misc_error = true;
      $email_error_message = "Please enter an e-mail address.";

    }
    
    if(empty($_POST["password"])){

      $misc_error = true;
      $pass_error_message = "Please choose a password.";

    }

    if(empty($_POST["con_password"]) || ($password != $con_password) ){

      $misc_error = true;
      $password_match_error = "Passwords do not match";

    }

    if(empty($_POST["fName"])){

      $misc_error = true;
      $fName_error_message = "Please enter your first name.";

    }
    
    if(empty($_POST["lName"])){

      $misc_error = true;
      $lName_error_message = "Please enter your last name.";

    }
    
    if(empty($_POST["schoolID"])){

      $misc_error = true;
      $schoolID_error_message = "Please enter your school ID.";

    }
    
    if(empty($_POST["major_select"])){

      $misc_error = true;
      $major_error_message = "Please enter your major.";

    }

    if(empty($_POST["career_select"])){

      $misc_error = true;
      $career_error_message = "Please enter your primary career track.";

    }

    if(empty($_POST["birth_city"])){

      $misc_error = true;
      $birth_error_message = "Please enter a city.";

    }

  }
  

  //query activity after determining if no errors have occured
  if($invalid_email == false && $misc_error == false && $student_exists == false){

    // Set some default values.
    $futurePlans = "N/A";
    $advisingQuestions = "N/A";        
        

    if($major != "Other"){

      // Insert the data into the Student table.
      $sql = "INSERT INTO Student (email,password,firstName,preferredName,lastName,schoolID,major,careerTrack,birthCity,specialGroup) VALUES ('$email','$encryptPass', '$fName','$pName','$lName', '$schoolID','$major','$career','$birth_city',$spec_group)";

      // Execute the query.
      $rs = $COMMON->executeQuery($sql,$fileName);

      // Also create an entry in the questions / plans table.
      $sql = "INSERT INTO questionsAndPlans (questionsplansID, email, futurePlans, advisingQuestions) VALUES ('','$email','$futurePlans','$advisingQuestions')";
      $rs = $COMMON->executeQuery($sql,$fileName); 

      // Send the email to the confirmation page
      // to print.
      $_SESSION['studentEmail'] = $email;
      $student_confirm_bool = 1;
      $_SESSION['student_confirm_bool'] = $student_confirm_bool;
      header('Location: studentconfirmed.php');

    }

    else {

      // Redirect if "Other" is selected as the major.
      header('Location: othermsg.php');

    }
  }
}


// Grab the previously entered data from
// the session, if available to add it back into the
// fields in the form. Convenience feature.

if(isset($_SESSION['studentEmail'])){

  $email = $_SESSION['studentEmail'];
  $_SESSION['studentEmail'] = $email;

}

if(isset($_SESSION['studentfName'])){

  $fName = $_SESSION['studentfName'];
  $_SESSION['studentfName'] = $fName;

}

if(isset($_SESSION['studentpName'])){

  $pName = $_SESSION['studentpName'];
  $_SESSION['studentmName'] = $pName;

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

<body>

  <div class="main-form"> 
      <h1>Welcome to the Advising Registration Page for <br/>
      The College of Natural Math and Science!</h1>
  </div>


<h2>

    Student Registration<br>

</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  
<font style="color:red"><center>An * indicates a required field.</center></font><br>

<div class='container'>

    <div class='text_div' style="font-size: 20px">      

      <table>
        <tr><td><font color="white">First Name:</font></td></tr> 
        <tr><td><font color="white">Preferred Name:</font></td></tr>
        <tr><td><font color="white">Last Name:</font></td></tr>
        <tr><td><font color="white">UMBC ID:</font></td></tr>
        <tr><td><font color="white">E-mail:</font></td></tr>
        <tr><td><font color="white">Password:</font></td></tr>
        <tr><td><font color="white">Confirm Password:</font></td></tr>
	<tr><td><font color="white">City of Your Birth: (In case of forgotten password.)</font></td></tr>
      </table>
      
      

    </div>

    <div class='input_div'>
   

      <input type="fname" id="fName" name="fName" <?php if(isset($fName)) { ?> value="<?php echo($fName); ?>" <?php } ?> ><font style="color:red">*</font>
      <span class="error" style="color:red"> <?php echo $fName_error_message;?></span><br>  
      
      <input type="prefname" id="pName" name="pName" <?php if(isset($mName)) { ?> value="<?php echo($mName); ?>" <?php } ?> >
      <br> 
      
      <input type="lname" name="lName" <?php if(isset($lName)) { ?> value="<?php echo($lName); ?>" <?php } ?> ><font style="color:red">*</font>
      <span class="error" style="color:red"> <?php echo $lName_error_message;?></span><br>

      
      <input type="id" name="schoolID" <?php if(isset($schoolID)) { ?> value="<?php echo($schoolID); ?>" <?php } ?> ><font style="color:red">*</font>
      <span class="error" style="color:red"> <?php echo $schoolID_error_message;?></span><br>

      
      <input type="email" name="email"<?php if(isset($email)) { ?> value="<?php echo($email); ?>" <?php } ?> ><font style="color:red">*</font>
      <span class="error" style="color:red"> <?php echo $email_error_message;?></span><br>

      
      <input type="password" name="password"><font style="color:red">*</font>
      <span class="error" style="color:red"> <?php echo $pass_error_message;?></span><br>

      <input type="con_password" name="con_password"><font style="color:red">*</font>
      <span class="error" style="color:red"> <?php echo $password_match_error;?></span><br>

      <input type="fname" name="birth_city"><font style="color:red">*</font>
      <span class="error" style="color:red"> <?php echo $birth_error_message;?></span><br>
      
      

    </div>  

        
  <div class="btn-group" role="group" name="major">
 
    Major that you will Pursue NEXT SEMESTER:<font style="color:red">*</font><span class="error" style="color:red"> <?php echo $major_error_message;?></span><br>       

    <button type="button" class="btn btn-1" name="major" value="BiologyBA">Biological Sciences B.A.</button>
    <button type="button" class="btn btn-1" name="major" value="BiologyBS">Biological Sciences B.S.</button>        
    <button type="button" class="btn btn-1" name="major" value="BioChemBS">Biochemistry & Molecular Biology B.S.</button>
    <button type="button" class="btn btn-1" name="major" value="BioInfoBS">Bioinformatics & Computational Biology B.S.</button>
    <button type="button" class="btn btn-1" name="major" value="BioEdBA">Biology Education B.A.</button>
    <button type="button" class="btn btn-1" name="major" value="ChemBA">Chemistry B.A.</button>
    <button type="button" class="btn btn-1" name="major" value="ChemBS">Chemistry B.S.</button><br>
    <button type="button" class="btn btn-1" name="major" value="ChemEdBA">Chemistry Education B.A.</button>
    <button type="button" class="btn btn-1" name="major" value="Other">Other</button>    

  </div>

  <div class="btn-group" role="group" name="career">
 
    Primary career track:<font style="color:red">*</font><span class="error" style="color:red"> <?php echo $career_error_message;?></span><br> 
      

    <button type="button" class="btn2 btn-2" name="career" value="Research">Research</button>
    <button type="button" class="btn2 btn-2" name="career" value="Health Profession">Health Profession</button>        
    <button type="button" class="btn2 btn-2" name="career" value="Industry">Industry</button>
    <button type="button" class="btn2 btn-2" name="career" value="Education">Education</button>
    <button type="button" class="btn2 btn-2" name="career" value="Other">Other</button>
    <button type="button" class="btn2 btn-2" name="career" value="Uncertain">Uncertain</button>

  </div>

  <div class="btn-group" role="group" name="spec_group">
 
    Are you a member of a special group? (ex. Athletics)<font style="color:red">*</font><span class="error" style="color:red"> <?php echo $spec_group_error_message;?></span><br>       

    <button type="button" class="btn3 btn-3" name="spec_group" value=1>Yes</button>
    <button type="button" class="btn3 btn-3" name="spec_group" value=0>No</button>        


  </div>


  <div class="btn-group2" role="group">    
      
    <input type="hidden" name="major_select" value="" id="major_select">
    <input type="hidden" name="career_select" value="" id="career_select">
    <input type="hidden" name="spec_group_select" value="" id="spec_group_select">
    <a class="register-link" href="index.php">RETURN</a>   
    <input type="submit" value="REGISTER" name="Register" class="submit" style="color: white; border: none; font-family: Arial, sans-serif; font-size: 20px; width: 120px; line-height: 25px; margin: 0 auto; padding: 10px 0;">
        
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
           $("#major_select").val(buttonVal);
           
	 });


     });
</script>

<script>

   $(document).ready(function(){ 
       $(".btn2").click(function() { 

	   $(this).toggleClass("active").siblings().removeClass("active");
  
           var buttonVal = $(this).attr("value");
           $("#career_select").val(buttonVal);
           
	 });


     });
</script>

<script>

   $(document).ready(function(){ 
       $(".btn3").click(function() { 

	   $(this).toggleClass("active").siblings().removeClass("active");
  
           var buttonVal = $(this).attr("value");
           $("#spec_group_select").val(buttonVal);
           
	 });


     });
</script>

</html>
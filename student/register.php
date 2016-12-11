<!DOCTYPE html>
<html>

<head>
  <title>Student Registration</title>
  <link rel="stylesheet" type="text/css" href="registerstyle.css">
</head>

<?php

include('CommonMethods.php');

 $debug = false;
 $COMMON = new Common($debug);
 $fileName = "register.php";

 session_start();

 $email_error_message = $pass_error_message = $fName_error_message = $lName_error_message = $password_match_error = "";
 $schoolID_error_message = $major_error_message = "";
 $email = $fName = $lName = $schoolID = $major = "";

  
if($_POST){    
 
  //defining variables used for query

  if (isset($_POST["email"])) {

    $email = $_POST["email"];

  }
  if (isset($_POST["password"])) {
  
    $password = $_POST["password"];

  }
  if (isset($_POST["con_password"])) {
  
    $con_password = $_POST["con_password"];

  }
  if (isset($_POST["fName"])) {

    $fName = $_POST["fName"];

  }
  if (isset($_POST["pName"])) {

    $pName = $_POST["pName"];

  }
  if (isset($_POST["lName"])) {

    $lName = $_POST["lName"];

  }
  if (isset($_POST["schoolID"])) {

    $schoolID = $_POST["schoolID"];

  }
  if (isset($_POST["major_select"])) {

    $major = $_POST["major_select"]; 

  }

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
  
  //email validation, may not need nested ifs
  if(!preg_match($email_validation, $email)){
    
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
      //echo "<br>Please enter first name.<br>";
      $misc_error = true;
      $fName_error_message = "Please enter your first name.";
    }
    
    if(empty($_POST["lName"])){
      //echo "<br>Please enter last name.<br>";
      $misc_error = true;
      $lName_error_message = "Please enter your last name.";
    }
    
    if(empty($_POST["schoolID"])){
      //echo "<br>Please enter school id.<br>";
      $misc_error = true;
      $schoolID_error_message = "Please enter your school ID.";
    }
    
    if(empty($_POST["major_select"])){
      //echo "<br>Please enter major.<br>";
      $misc_error = true;
      $major_error_message = "Please enter your major.";
    }
    if($password != $con_password){
      $misc_error = true;
      $password_match_error = "Passwords do not match.";
    }

  }
  
  //additional field validation
  if(preg_match($email_validation, $email)){

    if(empty($_POST["email"])){
      //echo "<br>Please enter email.<br>";
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
      //echo "<br>Please enter first name.<br>";
      $misc_error = true;
      $fName_error_message = "Please enter your first name.";
    }
    
    if(empty($_POST["lName"])){
      //echo "<br>Please enter last name.<br>";
      $misc_error = true;
      $lName_error_message = "Please enter your last name.";
    }
    
    if(empty($_POST["schoolID"])){
      //echo "<br>Please enter school id.<br>";
      $misc_error = true;
      $schoolID_error_message = "Please enter your school ID.";
    }
    
    if(empty($_POST["major_select"])){
      $misc_error = true;
      $major_error_message = "Please enter your major.";
    }
  }
  

  //query activity after determining if no errors have occured
  if($invalid_email == false && $misc_error == false && $student_exists == false){

    $futurePlans = "N/A";
    $advisingQuestions = "N/A";        
    $sql = "INSERT INTO Student (email,password,firstName,middleName,lastName,schoolID,major) VALUES ('$email','$encryptPass', '$fName','$pName','$lName', '$schoolID','$major')";
        


    //executes query and directs to confirmation page
    // ***UPDATE** Added confirmation page, and the redirect.
    // Also checked to make sure the major was not "Other".
    if($major != "Other"){

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

      $_SESSION['studentEmail'] = $email;
      $_SESSION['studentfName'] = $fName;
      $_SESSION['studentpName'] = $pName;
      $_SESSION['studentlName'] = $lName;
      $_SESSION['studentID'] = $schoolID;
      header('Location: othermsg.php');

    }
  }
}


// **UPDATE** Grab the previously entered data from
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
        <tr><td>First Name:</td></tr>
        <tr><td>Preferred Name:</td></tr>
        <tr><td>Last Name:</td></tr>
        <tr><td>UMBC ID:</td></tr>
        <tr><td>E-mail:</td></tr>
        <tr><td>Password:</td></tr>
        <tr><td>Confirm Password:</td></tr>
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
      
      

    </div>


  

        
  <div class="btn-group" role="group">
 
    Major that you will Pursue NEXT SEMESTER:<font style="color:red">*</font><span class="error" style="color:red"> <?php echo $major_error_message;?></span><br> 
      

    <button type="button" class="btn btn-1" name="major" value="Biology">Biology</button>
    <button type="button" class="btn btn-1" name="major" value="Biochemistry">Biochemistry</button>        
    <button type="button" class="btn btn-1" name="major" value="Bioinformatics">Bioinformatics</button>
    <button type="button" class="btn btn-1" name="major" value="Bioeducation">Bioeducation</button>
    <button type="button" class="btn btn-1" name="major" value="Chemistry">Chemistry</button>
    <button type="button" class="btn btn-1" name="major" value="Chemeducation">Chemeducation</button>
    <button type="button" class="btn btn-1" name="major" value="Other">Other</button>

  </div><br>   


      <div class="btn-group" role="group">    
      
        <input type="hidden" name="major_select" value="" id="major_select">   
        <input type="submit" value="REGISTER" name="Register" class="submit" style="color: white; border: none; font-family: Arial, sans-serif; font-size: 20px; width: 120px; line-height: 25px; margin: 0 auto; padding: 10px 0;">
        
        </form>

         <form action="index.php">
     
          <input type="submit" value="RETURN" name="Return" class="submit" style="color: white; border: none; font-family: Arial, sans-serif; font-size: 20px; width: 120px; line-height: 25px; margin: 0 auto; padding: 10px 0;">
            
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

</html>
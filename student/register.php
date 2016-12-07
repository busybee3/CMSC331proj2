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

 $email_error_message = $pass_error_message = $fName_error_message = $lName_error_message = "";
 $schoolID_error_message = $major_error_message = "";
 $email = $fName = $lName = $schoolID = $major = "";
 $password_confirm = "PLEASE ENSURE THAT BOTH PASSWORDS MATCH!";

if($_POST){  
 
  //defining variables used for query

  if (isset($_POST["email"])) {

    $email = $_POST["email"];

  }
  if (isset($_POST["password"])) {
  
    $password = $_POST["password"];

  }
  if (isset($_POST["fname"])) {

    $fName = $_POST["fName"];

  }
  if (isset($_POST["mName"])) {

    $mName = $_POST["mName"];

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
    $email_error_message = "Record exists for ". $email;
  }
  
  //email validation, may not need nested ifs
  if(!preg_match($email_validation, $email)){
    
    $invalid_email = true;
  
    if(empty($_POST["email"]) || $invalid_email == true){
      //echo "<br>Please enter email.<br>";
      $misc_error = true;
      $email_error_message = "*Please enter a valid e-mail.*";
    }
  
    if(empty($_POST["password"])){
      $misc_error = true;
      $pass_error_message = "*Please choose a password.*";
    }

    if(empty($_POST["fName"])){
      //echo "<br>Please enter first name.<br>";
      $misc_error = true;
      $fName_error_message = "*Please enter your first name.*";
    }
    
    if(empty($_POST["lName"])){
      //echo "<br>Please enter last name.<br>";
      $misc_error = true;
      $lName_error_message = "*Please enter your last name.*";
    }
    
    if(empty($_POST["schoolID"])){
      //echo "<br>Please enter school id.<br>";
      $misc_error = true;
      $schoolID_error_message = "*Please enter your school ID.*";
    }
    
    if(empty($_POST["major_select"])){
      //echo "<br>Please enter major.<br>";
      $misc_error = true;
      $major_error_message = "*Please enter your major.*";
    }
  }
  
  //additional field validation
  if(preg_match($email_validation, $email)){
 
    if(empty($_POST["email"])){
      //echo "<br>Please enter email.<br>";
      $misc_error = true;
      $email_error_message = "*Please enter an e-mail address.*";
    }
    
    if(empty($_POST["password"])){
      $misc_error = true;
      $pass_error_message = "*Please choose a password.*";
    }

    if(empty($_POST["fName"])){
      //echo "<br>Please enter first name.<br>";
      $misc_error = true;
      $fName_error_message = "*Please enter your first name.*";
    }
    
    if(empty($_POST["lName"])){
      //echo "<br>Please enter last name.<br>";
      $misc_error = true;
      $lName_error_message = "*Please enter your last name.*";
    }
    
    if(empty($_POST["schoolID"])){
      //echo "<br>Please enter school id.<br>";
      $misc_error = true;
      $schoolID_error_message = "*Please enter your school ID.*";
    }
    
    if(empty($_POST["major_select"])){
      $misc_error = true;
      $major_error_message = "*Please enter your major.*";
    }
  }
  

  //query activity after determining if no errors have occured
  if($invalid_email == false && $misc_error == false && $student_exists == false){

    $otherVar = "Other";
    // **UPDATE** Added page to redirect to if Other major selected.
    if ($major == "BioSciBA"){

      header('Location: othermsg.php');

    }
        
    $sql = "INSERT INTO Student (email,password,firstName,middleName,lastName,schoolID,major) VALUES ('$email','$encryptPass', '$fName','$mName','$lName', '$schoolID','$major')";
    
    //executes query and directs to confirmation page
    // ***UPDATE** Added confirmation page, and the redirect.
    // Also checked to make sure the major was not "Other".
    if($major != "Other"){

      // Execute the query.
      $rs = $COMMON->executeQuery($sql,$fileName);

      // Send the email to the confirmation page
      // to print.
      session_start();
      $_SESSION['studentEmail'] = $email;
      header('Location: studentconfirmed.php');

    }

    else {

      session_start();   
      $_SESSION['studentEmail'] = $email;
      $_SESSION['studentfName'] = $fName;
      $_SESSION['studentmName'] = $mName;
      $_SESSION['studentlName'] = $lName;
      $_SESSION['studentID'] = $schoolID;

      header('Location: othermsg.php');

    }
  }
}


// **UPDATE** Grab the previously entered data from
// the session, if available to add it back into the
// fields in the form. Convenience feature.
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

  $mName = $_SESSION['studentmName'];
  $_SESSION['studentmName'] = $mName;

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
    <div id="greeting-text"> 
      <h1>Welcome to the Advising Registration Page for <br/>
      The College of Natural Math and Science!</h1>
    </div>
  </div>


  <h2>Student Registration</h2>
</div>


<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">


<div class= "main">

<div id="first-text">
    <label><h3>
   First Name:<input type="fname" alt="First Name" align="center" name="fName" <?php if(isset($fName)) { ?> value="<?php echo($fName); ?>" <?php } ?> >
    </label> 
    <span class="error" style="color:red"> <?php echo $fName_error_message;?></span>
    <h3/>
</div> <br/>


<div id="pref-text">
    <label><h3>
   Preferred Name: <input type="prefname" alt="Preferred Name" align="center" name="pName" <?php if(isset($mName)) { ?> value="<?php echo($mName); ?>" <?php } ?> >
    </label> 
    <h3/>
</div><br/>

    
<div id="last-text">    
    <label><h3>
   Last Name: <input type="lname" alt="Last Name" align="center" name="lName" <?php if(isset($lName)) { ?> value="<?php echo($lName); ?>" <?php } ?> >
   <span class="error" style="color:red"> <?php echo $lName_error_message;?></span><br>
    </label>
    <h3/>
</div><br/>
              
         
<div id="id-text">
  <label><h3>
   UMBC ID: <input type="id" name="studentID" <?php if(isset($schoolID)) { ?> value="<?php echo($schoolID); ?>" <?php } ?> >
   <span class="error" style="color:red"> <?php echo $schoolID_error_message;?></span>
   </label>
   <h3/>
</div><br/>         
         

<div id="email-text">      
<label><h3>
   E-mail: <input type="email" name="email" <?php if(isset($email)) { ?> value="<?php echo($email); ?>" <?php } ?> >
   <span class="error" style="color:red"> <?php echo $email_error_message;?></span><br>

</label>
<h3/>
</div><br/>

<div id="password-text">      
  <label>
    <h3>
    Password: <input type="password" name="password">
    <span class="error" style="color:red"> <?php echo $pass_error_message;?></span><br>
  </label>
  <h3/>
</div><br/>

<div id="password-confirm-text">      
<label><h3>
   Confirm Password: <input type="con_password" name="password-confirm"><h3/>
</label><br>
</div>

<div id="majors-text">
<label><h3>
   Major(s) that you will Pursue NEXT SEMESTER:<h3/>
</label>
</div>
   <h3>

    <div class="btn-group" role="group">

      <button type="button" class="btn btn-1" name="major" value="Biology" onclick="getVal(this)">Biology</button>
      <button type="button" class="btn btn-1" name="major" value="Biochemistry" onclick="getVal(this)">Biochemistry</button>
      <button type="button" class="btn btn-1" name="major" value="Bioinformatics" onclick="getVal(this)">Bioinformatics</button>
      <button type="button" class="btn btn-1" name="major" value="Bioeducation" onclick="getVal(this)">Bioeducation</button>
      <button type="button" class="btn btn-1" name="major" value="Chemistry" onclick="getVal(this)">Chemistry</button>
      <button type="button" class="btn btn-1" name="major" value="Chemeducation" onclick="getVal(this)">Chemeducation</button>
      <button type="button" class="btn btn-1" name="major" value="Other" onclick="getVal(this)">Other</button>

    </div>

  <input type="hidden" name="major_select" value="" id="major_select">
   
  <span class="error" style="color:red"> <?php echo $major_error_message;?></span></label>

  <h3/>
      <br/>
      <br/>


<input type="submit" value="REGISTER" name="Register" style="background-color:green;border-color:green">

</form>
<form action="https://swe.umbc.edu/~dcuocci1/project2/CMSC331proj2/student/index.php">
<input type="submit" value="RETURN" name="Register" style="background-color:green;border-color:green">
</form>

</div>


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

  function getVal(buttonVal){
    //alert('my value is now: ' + obj.value);
    obj.form.elements['major_select'].value = buttonVal.value;
  }

</script>

</body>
</html>
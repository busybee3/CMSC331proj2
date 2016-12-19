<?php

// Connect to the db.
include '../CommonMethods.php';
$fileName = "login.php";  
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



// Open session to see if there is an 
// open session, and redirects to student
// dashboard if so.
session_start();

// Checks to see if the user is logged in, if so it redirects them to homepage
if (isset($_SESSION["HAS_LOGGED_IN"])) {
  if ($_SESSION["HAS_LOGGED_IN"]) {
    header('Location: home.php');
  }
}

  //declare and define empty login_error
  $login_error = "";
  
if ($_POST) {

  // Grab the e-mail and other data.
  $email = strtolower($_POST["email"]);
  $password = $_POST["password"];
  $encryptPass = md5($password);
  
  // Query to see if there is a user with matching credentials.
  $login_val_query = "SELECT * FROM Student WHERE email = '$email' AND password = '$encryptPass'";
  $results = $COMMON->executequery($login_val_query, $fileName);
  
  
  //if email field is left empty or does not exist in table
  if(empty($email) || empty($password) || mysql_num_rows($results) == 0){
    $login_error = "Invalid email and/or password.";
  }

  // Input validation passes at this point.
  else{

      // Send the necessary data to a new session and redirect.
      session_start();
      
      $studentDict = mysql_fetch_assoc($results);
      
      $_SESSION["HAS_LOGGED_IN"] = true;
      $_SESSION["STUDENT_EMAIL"] = $studentDict["email"];
      $_SESSION["STUDENT_ID"] = $studentDict["StudentID"];
      $_SESSION["MAJOR"] = $studentDict["major"];
      $_SESSION["STUDENT_FNAME"] = $studentDict["firstName"];
      $_SESSION["STUDENT_PNAME"] = $studentDict["middleName"];
      
      //redirectedd to index.php
      header('Location: home.php');      
    
  }

}

?>


<!DOCTYPE HTML>
<html>
<head>

<title>Login</title>

    <link rel="stylesheet" href="loginstyle.css" type="text/css">


</head>




   <body>
   <div class="login">
   <div class="login-screen">
   <div class="app-title">
  <div class="logo">
  <img src="https://s14.postimg.org/asw2mtett/login_logo.png" height="50px">
  </div>
   <h3>The College of Natural Math and Science </h3>
   </div>
   <center><span class="error"><font style="color:red" face="Arial"><?php echo $login_error;?></font></span><center>

   <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

   <div class="login-form">
   <div class="control-group">
   <input type="text" class="login-field" value="" name="email" placeholder="email" id="login-name" required>
   <label class="login-field-icon fui-user" for="login-name"></label>
   </div>

   <div class="control-group">
   <input type="password" class="login-field" value="" name="password" placeholder="password" id="login-pass" required>
   <label class="login-field-icon fui-lock" for="login-pass"></label>
   </div>
   
   <div class="btn-group" role="group">
     <a class="register-link" href="register.php">REGISTER</a>
     <input type="submit" value="LOGIN" name="Register" class="submit" style="color: white; background-color: green; border: none; font-family: Arial, sans-serif; font-size: 20px; width: 120px; line-height: 25px; margin: 0 auto; padding: 10px 0;">
   </form>
   <br><br>
   <a href="passwordreset.php"><font face="Arial" style="color:black">I forgot my password.</font></a>
   </div>
   
   
   </div>
   </div>


   </body>
   </html>
   
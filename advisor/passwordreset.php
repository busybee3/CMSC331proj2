<!DOCTYPE HTML>
<html>
<head>

     <title>Password Reset</title>
     <link rel="stylesheet" type="text/css" href="alt_reg_style.css">

</head>

<body>

<?php


// Connect to db and open session.
include('CommonMethods.php');
$debug = false;
$COMMON = new Common($debug);
$fileName = "passwordreset.php";
$birth_error_message = $user_id_error_message = $password_error_message = $pwconfirm_error_message = "";
session_start();


if ($_POST) {

  // Starts out false.
  $misc_error = false;

  // Grab all the post data.
  if (isset($_POST['user_ID'])){

    $user_id = $_POST['user_ID'];
    $_SESSION['user_ID'] = $user_id;

  }

  if (isset($_POST['birth_city'])){

    $birth_city = $_POST['birth_city'];
    $_SESSION['birth_city'] = $birth_city;

  }

  if (isset($_POST['password'])){

    $new_password = $_POST['password'];

  }

  if (isset($_POST['password_confirm'])){

    $con_password = $_POST['password_confirm'];

  }

  // Ensure that data was entered in all fields.
  if(empty($_POST['user_ID'])){

    $misc_error = true;
    $birth_error_message = "Please enter your user ID.";

  }

  if(empty($_POST['birth_city'])){

    $misc_error = true;
    $user_id_error_message = "Please enter a city.";

  }

  if(empty($_POST['password'])){

    $misc_error = true;
    $password_error_message = "Please enter a password.";

  }

  if(empty($_POST['password_confirm'])){

    $misc_error = true;
    $pwconfirm_error_message = "Please confirm your password.";

  }

  if($new_password != $con_password) {

    $misc_error = true;
    $password_error_message = "Passwords don't match.";

  }

  // Check to see if there is a matching student in the
  // Student table.
  $sql = "SELECT * from Advisor where schoolID='$user_id' and birthCity='$birth_city'";
  $rs = $COMMON->executeQuery($sql,$fileName);
  $row = mysql_fetch_row($rs);

  // If there aren't any results.
  if(!$row) {
 
    $misc_error = true;
    $birth_error_message = "No matching account.";

  }
    
  // Encrypt the password.
  $encryptPass = md5($new_password);

  // This means the user has been located in the db,
  // and updates can be made.
  if($misc_error == false){  

    // Update the password.
    $sql = "UPDATE Advisor SET password='$encryptPass' WHERE schoolID='$user_id' and birthCity='$birth_city'";
    $rs = $COMMON->executeQuery($sql,$fileName);
    header('Location: passwordresetconfirmed.php');    

  }

  ?>

    

<?php

}

?>

  <div class="main-form">
    <div id="greeting-text"> 
      <h1>Password Reset<br/></h1>
    </div>
  </div>

<br>

<div class="main">

  <center><font style="color:red">An * indicates a required field.</font><br><br></center>

  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

  <div class="container_reset">

    <div class='text_reset_div' style="font-size: 20px">
  
      <table>

          <tr><td><font color="white">User ID:</font></td></tr>
          <tr><td><font color="white">City of Birth:</font></td></tr>
          <tr><td><font color="white">New Password:</font></td></tr>
          <tr><td><font color="white">Confirm Password:</font></td></tr>


      </table>
    
    </div>    

    <div class='input_reset_div'>
    
    
      <input type="id" align="center" name="user_ID" <?php if(isset($_SESSION['user_ID'])) { ?> value="<?php echo($_SESSION['user_ID']) ?>" <?php } ?> ><font style="color:red">*</font>
      <span class="error" style="color:red"> <?php echo $birth_error_message;?></span><br>   
    
      <input type="fname" align="center" name="birth_city" <?php if(isset($_SESSION['birth_city'])) { ?> value="<?php echo($_SESSION['birth_city']) ?>" <?php } ?>><font style="color:red">*</font>
      <span class="error" style="color:red"> <?php echo $user_id_error_message;?></span><br>

      <input type="password" align="center" name="password"><font style="color:red">*</font>
      <span class="error" style="color:red"> <?php echo $password_error_message;?></span><br>   
    
      <input type="password" align="center" name="password_confirm"><font style="color:red">*</font>
      <span class="error" style="color:red"> <?php echo $pwconfirm_error_message;?></span><br><br>

    </div>
 
  </div>

 
  <div class="button_reset">

    <a class="register-link" href="index.php">RETURN</a> 
    <input type="submit" value="SUBMIT" name="Register" class="submit" style="color: white; border: none; font-family: Arial, sans-serif; font-size: 20px; width: 120px; line-height: 25px; margin: 0 auto; padding: 10px 0;">
 
  </div> 

  </form> 
 
</div>


</body>
</html>

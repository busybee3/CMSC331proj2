<?php
session_start();

if ($_POST) {
  include '../dbconfig.php';
  
  // Parse values from form
  $need = " field needs to be filled.";
  $fields = array("fName" => "'First Name'", 
		  "lName" => "'Last Name'", 
		  "email" => "'e-Mail'",
		  "bldgName" => "'Building Name'", 
		  "officeRm" => "'Office Room'",
		  "pass" => "'Password'",
		  "confirm-pass" => "'Confirm Password'"
		  );

  $_SESSION['errors'] = array();
  foreach ($fields as $field => $message)
    if (empty($_POST[$field]))
      array_push($_SESSION['errors'], $message.$need);     

  if ($_POST['pass'] != $_POST['confirm-pass'])
    array_push($_SESSION['errors'], "Passwords don't match.");
  else
    $pass = md5($pass);

  if (!sizeof($_SESSION['errors'])) {
    $open_connection = connectToDB(true);
    $checkForEmails = "SELECT 1 from `Advisor` WHERE `email` = '$email' LIMIT 1";
    $results = $open_connection->query($checkForEmails);
    
    if (mysqli_num_rows($results) == 0) {
      $insert_adviser = "
              INSERT INTO Advisor (
                email, firstName, middleName, lastName, buildingName, roomNumber, password
              )
              VALUES (
                '{$_POST['email']}', '{$_POST['fName']}', '{$_POST['mName']}', 
                '{$_POST['lName']}', '{$_POST['bldgName']}', '{$_POST['officeRm']}', '".md5($_POST['pass'])."'
              );
            ";
      
      $open_connection->query($insert_adviser);      
      header('Location: ../../views/login.php');
    } 

    else {
        array_push($_SESSION["errors"], "This email already exists!");
	header('Location: ../../views/index.php');
    }
  } 

  else {      
      header('Location: ../../views/index.php');
  }    
}
?>
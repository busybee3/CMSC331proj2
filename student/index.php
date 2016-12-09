<?php
session_start();
// Checks to see if the user is logged in, if so it redirects them to homepage
if (isset($_SESSION["HAS_LOGGED_IN"])) {
  if ($_SESSION["HAS_LOGGED_IN"]) {
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

   <div class="login-form">
   <div class="control-group">
   <input type="text" class="login-field" value="" placeholder="email" id="login-name">
   <label class="login-field-icon fui-user" for="login-name"></label>
   </div>

   <div class="control-group">
   <input type="password" class="login-field" value="" placeholder="password" id="login-pass">
   <label class="login-field-icon fui-lock" for="login-pass"></label>
   </div>

   
   <div class="btn-group" role="group">
     <a class="register-link" href="register.php">REGISTER</a>
     <a class="btn btn-primary btn-large btn-block" href="#">LOGIN</a>
   </div>
   
   
   </div>
   </div>


   </body>
   </html>
   
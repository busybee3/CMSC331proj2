<?php
session_start();

include 'dbconfig.php';

// Checks to see if the user is logged in, if so it redirects them to homepage
if (isset($_SESSION["HAS_LOGGED_IN"])) 
    if ($_SESSION["HAS_LOGGED_IN"]) 
        header('Location: home.php');

if (isset($_POST['pass']) && isset($_POST['email'])) {
    /* don't forget to use strtolower() in index */
    $email = strtolower($_POST["email"]);
    $open_connection = connectToDB();
    // Searxch if advisor email exists in DB
    $search_advisor = "SELECT * FROM Advisor WHERE email='$email' 
                       AND password='".md5($_POST['pass'])."';";
    $queryOfSearchAdvisor = $open_connection->query($search_advisor);
    $num_rows = mysqli_num_rows($queryOfSearchAdvisor);
    // Check whether or not there has been a successful adviser creation

    if ($num_rows == 1) {
        session_start();
        // Translate the SQL Query into a dictioanry
        $advisorDict = mysqli_fetch_assoc($queryOfSearchAdvisor);

        // Assigning to session values based on what data is found
        $_SESSION["HAS_LOGGED_IN"] = true;
        $_SESSION["ADVISOR_EMAIL"] = $advisorDict["email"];
        $_SESSION["ADVISOR_ID"] = $advisorDict["advisorID"];
        $_SESSION["ADVISOR_FNAME"] = $advisorDict["firstName"];
        $_SESSION["ADVISOR_LNAME"] = $advisorDict["lastName"];
        $_SESSION["ADVISOR_BLDG_NAME"] = $advisorDict["buildingName"];
        $_SESSION["ADVISOR_RM_NUM"] = $advisorDict["roomNumber"];

        // Redirecting to homepage.php
        header('Location: home.php');
    } else {
        echo "Invlaid email and/or password.";
    }

    $open_connection->close();
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
   <br/>

  <?php 
    if (isset($_SESSION["messages"]) && sizeof($_SESSION["messages"])) {
      echo '<div class="messages">';
      foreach ($_SESSION["messages"] as $message)
	echo $message."<br>";
      unset($_SESSION["messages"]);
      echo "</div>";
    }
  ?>

   <h3>The College of Natural Math and Science </h3>
   </div>

   <div class="login-form">
   <div class="control-group">
     <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
         <input class="login-field" type="text" placeholder="email" name="email" required> <br>
         <input class="login-field" type="password" placeholder="password" name="pass" required> <br> <br>
         <input class="btn btn-primary btn-large btn-block" type="submit" value="Log In">
     </form>
   </div>
   <a class="btn btn-primary btn-large btn-block" href="register.php">REGISTER</a>
   </div>
   </div>



   </body>
   </html>
   
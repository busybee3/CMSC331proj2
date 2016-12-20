<!DOCTYPE html>
<html>

<head>
  <title>Advisor Registration</title>
  <link rel="stylesheet" type="text/css" href="registerstyle.css">
   
</head>

<body>
  <div class="main-form">
    <div id="greeting-text"> 
      <h1>Welcome to the Advising Registration Page for <br/>
      The College of Natural Math and Science!</h1>
    </div>
  </div>

  <h2>Advisor Registration</h2>

 <div class="errors"><?php 
   session_start();
if (isset($_SESSION["errors"]) && sizeof($_SESSION["errors"])) {
  foreach ($_SESSION["errors"] as $error) 
    echo $error."<br>";
  unset($_SESSION["errors"]);
}
   ?></div>

<form action="registerAdvisor.php" method="post">    
  <div class= "main">
  <div id="first-text">
    <label><h3>
  First Name: <br><input type="text" alt="First Name" align="center" name="fName"><h3/>
    </label>
    </div>
   
<div id="last-text">    
    <label><h3>
  Last Name: <br><input type="text" alt="Last Name" align="center" name="lName"><h3/>
    </label>
    </div>
              
         
<div id="id-text">
  <label><h3>
  Advisor ID: <br><input type="advisorID" name="advisorID"><h3/>
  </label>
</div>
         
   

   <div id="email-text">      
     <label><h3>
  E-mail: <br><input type="email" name="email"><h3/>
     </label>
   </div>
   
   <h3> Building Name: <br><input type="text" name="bldgName"></input></h3>
  <h3> Office Room: <br><input type="text" name="officeRm"></input></h3>
  <h3> Password: <br><input type="password" name="pass"> </input></h3> 
  <h3> Confirm Password: <br><input type="password" name="confirm-pass"> </input></h3> <br>
   <h3> <input class="submit-button" type="submit" value="REGISTER"> </h3>
   

</div>
</form>

</body>
</html>
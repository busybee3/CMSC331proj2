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
</div>


<form action="registerAdvisor.php" method="post">    


  <div class= "main">
<div id="first-text">
    <label><h3>
   First Name: <input type="text" alt="First Name" align="center" name="fName"><h3/>
    </label> <br/>
    </div>x
   
<div id="last-text">    
    <label><h3>
   Last Name: <input type="text" alt="Last Name" align="center" name="lName"><h3/>
    </label><br/>
    </div>
              
         
<div id="id-text">
  <label><h3>
   Advisor ID: <input type="advisorID" name="advisorID"><h3/>
  </label><br>
</div>
         
   

   <div id="email-text">      
   <label><h3>
   E-mail: <input type="email" name="email"><h3/>
   </label><br>
   </div>

   <h3> Password: <input type="password" name="pass"> </input></h3>
   <h3> Confirm Password: <input type="password" name="pass"> </input></h3>


<div id="majors-text">
   <h3> Majors You Advise: <h3/>
</div>

   <h3>
      <button type="button" class="btn btn-1">Biology</button>
      <button type="button" class="btn btn-1">Biochemistry</button>
      <button type="button" class="btn btn-1">Bioinformatics</button>
      <button type="button" class="btn btn-1">Bioeducation</button>
      <button type="button" class="btn btn-1">Chemistry</button>
      <button type="button" class="btn btn-1">Chemeducation</button><h3/>
      <br/>
      <br/>

   <input id="submit-button" type="submit" value="REGISTER" name="Register" style="background-color:green;border-color:green">


</div>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
   $(document).ready(function(){ 
       $(".btn").click(function() { 
	   $(this).toggleClass("active");
	 });
     });
</script>

</body>
</html>
<!DOCTYPE html>

<html>
<head>
<title>Home</title>
<style>

body {

  background-color:#f5ca5c;

 }


ul {
  font-family: Arial;
  list-style-type: none;
  margin: 0;
position: absolute;
top: 0;
left:0;
width: 98%;
  overflow: hidden;
  background-color: #333;
 }

li {
  float: right;
}

.logo {
  float: left;
padding: 4px 5px;
 }

li a {
display: block;
color: white;
  text-align: center;
  padding: 14px 20px;
  text-decoration: none;
}

.greeting {
  font-family: Arial;
  font-size: 40px;
  text-align: left;
 }


button {
  font-family: Arial;
  font-size: 20px;
  border: 2px solid;
  border-radius: 50px;
  background-color:white;
  width: 300px;
  height: auto;
  margin: 100px 38px;
}

.container {
  text-align: center
 }


</style>
</head>
<body>


<ul>
  <div class="logo">
  <img src="https://s16.postimg.org/ckbr6pov9/THISSS.png" height="50px">
  </div>
  <li><a href="logout.php">LOGOUT</a></li>
  <li><a href="home.php">MY DASHBOARD</a></li>
</ul>

<br/>
<br/>
<br/>
<br/>
  
<?php 
  session_start();
  if (!isset($_SESSION["HAS_LOGGED_IN"]) || !$_SESSION["HAS_LOGGED_IN"])
    header("Location: index.php");
?>
  
<div class="greeting">
   Welcome, <?php echo $_SESSION["ADVISOR_FNAME"]."!"; ?>
</div>
<br/>

<div class="container">

   <button>
   <a href="availability.php">
  <img src="https://s14.postimg.org/5dundt7ap/imageedit_1_8336523175.png" height="254px">
  </a>Set Availability
   </button>




   <button>
   <a href="view.php" >
   <img src="http://ddu548.minsk.edu.by/sm_full.aspx?guid=4673" height="254px">
</a>View Appointments
   </button>




   <button>
  <a href="search.php" class="btn btn-info btn-lg">
   <img src="http://image.flaticon.com/icons/svg/181/181549.svg" height="254px">
</a>Search for a Student
   </button>



   <button>
 <a href="editInfo.php">
   <img src="http://image.flaticon.com/icons/svg/181/181540.svg" height="254px">
 </a> Edit Information
   </button>

</div>

</body>
</html>
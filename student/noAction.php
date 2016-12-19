<html>
<head>
<title>No Action</title>
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
  font-size: 32px;
  text-align: center;
 }

.stuff {
	font-family: Arial;
	font-size: 24px;
	text-align: left;
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

<form method="post" name="noAction">

<div class="greeting">
<p>As you have already been given permission to register this appointment service is not intended for you.</p>

<label for="button">Please click the return button to return to the Login page.</label><br>
<input type="submit" name="confirm" id="button" value="Return" style="font-family: Arial, sans-serif; font-size: 24px; width: 100px; line-height: 25px; margin-top: 20px; text-align:center;">
</div>

<?php 

if(isset($_POST["confirm"]))
{
	session_start();
	session_destroy();
	header("Location: index.php");
}

?>
</form>
</body>
</html>
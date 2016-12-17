<!DOCTYPE html>

<html>
<head>
<title>Availability</title>


<style type="text/css">
  body {

  background-color:#f5ca5c;
  padding: 10px;
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





 .tdborder {background-color: #464540;}
 .tdclosed {background-color: #9b936f;}
 .tdselect {background-color: #94d509;}
 .tdopen {background-color: #ffffff;}
 .tdheader {background-color: #464540;}
 .tdtitle {background-color: #e2ddc0;}
	    /*  BODY{color: #000000;
		background: #e2ddc0;}*/
  TD {font: 11px ms sans serif,geneva,arial,helvetica;
  color: #000000;}
  INPUT {font-size: 11px;
  font-family: courier new,courier,monospace;}
  SELECT {font-size: 11px;
  font-family: courier new,courier,monospace;}
  
  FONT.textclosed {color: #ffffff;}
  FONT.textheader {color: #ffffff;
  text-decoration: none;}
  
  A.textclosed{color: #ffffff;}
  A.textopen {color: #000000;
  text-decoration: none;}
  A:visited {color: #000000;
  text-decoration: none;}



</style>

<link href="styles.css" rel="stylesheet" type="text/css">

</head>

<body>
<?php
  session_start();
?>
<ul>     
  <div class="logo">
  <img src="https://s16.postimg.org/ckbr6pov9/THISSS.png" height="50px">
  </div>
  <li><a href="logout.php">LOGOUT</a></li>
  <li><a href="home.php">MY DASHBOARD</a></li>
</ul>

<div class="calendar-container">
  <?php 
  include('delete.php');
  include('calendar.php');
  ?>

  <div id="right-side">
    <div id='results'></div>
    <div id='students'></div>
  </div>
</div>
									
</body>    
</html>
    
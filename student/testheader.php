<html>
<head>
<style>

ul {
  font-family: 'Open Sans', sans-serif;
 position: fixed;
 top: 0;
 width: 100%;
  list-style-type: none;
 margin: 0;
 padding: 0;
 overflow: hidden;
   background-color: #333;
 }

li {
  float: right;
}

li a {
display: block;
color: white;
  text-align: center;
padding: 14px 16px;
  text-decoration: none;
}

li a:hover:not(.active) {
  background-color: #111;
}

.active {
  background-color: #ffcc00;
  color: black;
 }

img {
position: absolute;
left: 10px;
top: 0px;
  z-index: -1;
}

</style>
</head>
<body>


<ul>
<img src="https://s16.postimg.org/ckbr6pov9/THISSS.png" height="50px">
<li><a href="logout.php">LOGOUT</a></li>
<li><a class="active" href="home.php">MY DASHBOARD</a></li>
</ul>



</body>
</html>
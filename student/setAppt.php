<?php
include('../CommonMethods.php');

$conn = new Common(true);
$advisors = $conn->executeQuery("SELECT advisorID, CONCAT(firstName,' ',lastName) AS Name FROM Advisor;", $_SERVER["SCRIPT_NAME"]);

?>



<html>
<head>
<title>Find Appointment</title>

<style type="text/css">

  * {
  box-sizing: border-box;
}

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
  left: 0;
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
td {font: 11px ms sans serif, geneva, arial, helvetica;
    color: #000000;}
input {font-size: 11px;
    font-family: courier new, courier, monospace;}
select {font-size: 11px;
    font-family: courier new, courier, monospace;}

font.textclosed {color: #ffffff;}
font.textheader {color: #ffffff;
    text-decoration: none;}

a.textclosed {color: #ffffff;}
a.textopen {color: #000000;
    text-decoration: none;}
a:visited {color: #000000;
    text-decoration: none;}


div {
display: block;
}

.container {
  margin-right: auto;
  margin-left: auto;
  padding-left: 15px;
  padding-right: 15px;
}

.appt-options {
  margin-top: 30px;
}

.appt-results {
  margin-top: 30px;
}

.row {
  margin-left: -15px;
  margin-right: -15px;
}

.col-md-3 {
padding: relative;
  min-height: 1px;
  padding-left: 100px;
  padding-right: 15px;
  padding-top: 30px;
width: 25%;
  float: left;
}

.col-md-offset-3 {
padding: relative;
  min-height: 1px;
  padding-left: 15px;
  padding-right: 15px;
  padding-top:30px;
width: 70%;
  float: right;
}

.well {
  min-height: 20px;
padding: 19px;
  margin-bottom: 20px;
  background-color: #f5f5f5;
  border: 1px solid #e3e3e3;
    border-radius: 4px;
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
}

.results {
height: 800px;
}

.text-center {
  text-align: center;
}

h1, h2, h3 {
  font-family: 'Open Sans', sans-serif;
}

h2, .h2 {
  font-size: 30px;
}

h1, .h1, h2, .h2, h3, .h3 {
  margin-top: 20px;
  margin-bottom: 10px;
}

h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
  font-weight: 500;
  line-height: 1.1;
color: inherit;
}

h2 {
display: block;
  -webkit-margin-before: 0.83em;
  -webkit-margin-after: 0.83em;
  -webkit-margin-start: 0px;
  -webkit-margin-end: 0px;
}

.btn {
  margin-bottom: 0;
  font-weight: normal;
  text-align: center;
  vertical-align: middle;
  touch-action: manipulation;
cursor: pointer;
border: 1px solid transparent;
  white-space: nowrap;
  user-select: none;
}

.btn-block {
display: block;
width: 100%;
}

.btn-md {
padding: 10px 16px;
  font-size: 16px;
  line-height: 1.3333333;
  border-radius: 6px;
}

.btn-success {
color: #fff;
  background-color: #5cb85c;
  border-color: #4cae4c;
}

input[type="submit"] {
  font-family: 'Open Sans', sans-serif;
}

</style>
<script>
    function showAppointments() {
  if (document.getElementById('indiv').checked) {
    var apptType = document.getElementById('indiv').value;
  } else {
    var apptType = document.getElementById('group').value;
  }

  var advisors = document.getElementsByName('advisors');
  var advisor;
  for (var i = 0; i < advisors.length; i++)
    {
      if(advisors[i].checked){
	advisor = advisors[i].value;
      }
    }

  var daysArray = document.getElementsByName('days[]');
  var days = [];
  for(var i = 0; i < daysArray.length; i++) {
    if (daysArray[i].checked) {
      days.push("'"+daysArray[i].value+"'");
    }
  }

  var info = new XMLHttpRequest();
  info.open("GET", "findAppts.php?apptType=" + apptType + "&advisor=" + advisor + "&days=" + days, true);
  info.onreadystatechange = function() {
    if (info.readyState == 4) {
      document.getElementById("results").innerHTML = info.responseText;
    }
  }

  info.send(null);
  }

</script>

</head>

<body>

  <ul>
      <div class="logo">
        <img src="https://s16.postimg.org/ckbr6pov9/THISSS.png" height="50px">
      </div>

    <li><a href="logout.php">LOGOUT</a></li>
    <li><a href="home.php">MY DASHBOARD</a></li>
  </ul>    


  <div class="container appt-options">
    <div class="row">
      <div class="text-center">
        <h2>Schedule an Appointment</h2>
      </div>


        <div class="col-md-3">
          <h3 class="text-center">1. Select Type:</h3>
          <div class="well">
            <input type="radio" name="apptType" id="indiv" value="indiv"> Individual<br>
            <input type="radio" name="apptType" id="group" value="group"> Group<br>
          </div>

    <h3 class="text-center">2. Select Advisor:</h3>
          <div class="well">

            <?php 
              while($rowtwo = mysql_fetch_array($advisors)){
                echo '<input type="radio" name="advisors" value="' .$rowtwo['advisorID'].'"> ' .$rowtwo['Name']. '<br>'; }
            ?>
          </div>

          <h3 class="text-center">3. Select Day(s):</h3>
          <div class="well">
            <input type="checkbox" name="days[]" value="0"> Monday<br>
            <input type="checkbox" name="days[]" value="1"> Tuesday<br>
            <input type="checkbox" name="days[]" value="2"> Wednesday<br>
            <input type="checkbox" name="days[]" value="3"> Thursday<br>
            <input type="checkbox" name="days[]" value="4"> Friday<br>
          </div>

          <div class="text-center">
            <input type="submit" value="Find Appointments" class="btn btn-success btn-md btn-block" onclick="showAppointments()"><br>
          </div>


        </div>
      </div>
    </div>
  </div>

  <div class="container appt-results">
    <div class="row">
      <div class="col-md-offset-3">
        <h3 class="text-center">Available Appointments</h3>              
          <div class="well" id="results">	      
          </div>
      </div>
    </div>
  </div>

</body>

</html>
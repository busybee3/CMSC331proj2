
<?php

include_once('CommonMethods.php');
  //Check if search data was submitted
if(isset($_GET['s'])){
  $search_term=$_GET['s'];

  //Send the search term to our search class and store the result
  $conn = new Common(false);
  $data = mysql_fetch_assoc($conn->executeQuery("SELECT * FROM Student WHERE schoolID LIKE '{$search_term}' OR email LIKE '{$search_term}';", $_SERVER["SCRIPT_NAME"]));

  $meeting_ids = mysql_fetch_assoc($conn->executeQuery("SELECT * FROM StudentMeeting WHERE StudentID LIKE '{$data['StudentID']}';", $_SERVER["SCRIPT_NAME"]));

  $apt_data = mysql_fetch_assoc($conn->executeQuery("SELECT * FROM Meeting WHERE meetingID LIKE '{$meeting_ids['MeetingID']}';", $_SERVER["SCRIPT_NAME"]));

  $wksht_data =  mysql_fetch_assoc($conn->executeQuery("SELECT * FROM questionsAndPlans WHERE email LIKE '{$data['email']}';", $_SERVER["SCRIPT_NAME"]));

echo '
<div class="search_bar">
<form action="" method="get">
<div class="form-field">
<label for="form-field">
<label for="search-field">search by ID or email...</label>
<input type="search" name="s" value="'.$search_term.'">
<input type="submit" value="Find">
</div>
</form>
</div>


<div id="name_col">
  <div id="name_col_inner">

  '.$data['lastName'].'
,
  '.$data['firstName'].'


</div>
</div>

<div id="info_col">
  <div id="info_col_inner">
	<h4> ID: '.$data['schoolID'].'<br/>
	<h4> Major: '.$data['major'].'<br/>
	<h4> Email: '.$data['email'].'<br/>
	<h4> Appointment: '.$apt_data['sessionLeaderID'].'<br/>
        '.$apt_data['start'].'<br/>
        '.$apt_data['end'].'<br/>


  <h4>Pre-Advising Worksheet Responses:
        Future Plans:'.$wksht_data['futurePlans'].'<br/><br/>
        Advising Questions:'.$wksht_data['advisingQuestions'].'<br/>

</div>
</div>';
}



else{
  echo '

<div class="search_bar">

<!--self-submitting form -->
<form action="" method="get">
<div class="form-field">
<label for="form-field">
<label for="search-field">search by ID or email...</label>
<input type="search" name="s" results="5" value="'.$search_term.'"">
<input type="submit" value="Find">
</div>
</form>
</div>


<div id="name_col">
  <div id="name_col_inner">

  UMBC

  ,

  STUDENT

</div>
</div>

<div id="info_col">
  <div id="info_col_inner">
        <h4> ID: <br/><br/>
        <h4> Major: <br/><br/>
        <h4> Email: <br/><br/>
        <h4> Appointment: <br/>


  <h4>Pre-Advising Worksheet Responses:</h4>
        Future Plans:<br/><br/>
        Advising Questions:<br/><br/>


</div>
</div>
'; }
 



?>


<!DOCTYPE html>
<html>

<head>
  <title>Search</title>
<style>

body {
  color: black;
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



body {
padding:0; 
margin:0 0 0 50%; 
color:BLACK; 
width:50%; 
min-height:100%; 
float:right;
}

.search_bar {
text-align: center;
  font-family: Arial;
   text-transform: uppercase;
}

#name_col {
  float:left; 
  width:100%; 
  height: 750px;
  margin-left:-100%; 
  text-align:center; 
  background-color: black;
  color: white;
}

#name_col_inner {
  padding:325px 0;
  font-family: Arial;
  font-size: 70px;
}

#info_col {
  height: 750px;
  background-color: #f5ca5c;
  color: black;
padding: 40px 0;
}

#info_col_inner {
  padding:70px 30px; 
font-family: Arial;
font-size: 40px;
}



form {
width:500px;
margin:50px auto;
}
.search {
padding:8px 15px;
background:rgba(50, 50, 50, 0.2);
border:0px solid #dbdbdb;
    }
.button {
position:relative;
padding:6px 15px;
left:-8px;
border:2px solid #207cca;
    background-color:#207cca;
  color:#fafafa;
 }
.button:hover  {
  background-color:#fafafa;
  color:#207cca;
 }

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


</body>
</html>


include('../CommonMethods.php');
  //Check if search data was submitted

if(isset($_GET['s'])){


  $search_term=$_GET['s'];

  //Send the search term to our search class and store the result
  $conn = new Common(true);
  $data = mysql_fetch_assoc($conn->executeQuery("SELECT * FROM Student WHERE schoolID LIKE '{$search_term}' OR email LIKE '{$search_term}';", $_SERVER["SCRIPT_NAME"]));

  $meeting_ids = mysql_fetch_assoc($conn->executeQuery("SELECT * FROM StudentMeeting WHERE StudentID LIKE '{$data['StudentID']}';", $_SERVER["SCRIPT_NAME"]));

  $apt_data = mysql_fetch_assoc($conn->executeQuery("SELECT * FROM Meeting WHERE meetingID LIKE '{$meeting_ids['MeetingID']}';", $_SERVER["SCRIPT_NAME"]));


  $wksht_data =  mysql_fetch_assoc($conn->executeQuery("SELECT * FROM questionsAndPlans WHERE email LIKE '{$data['email']}';", $_SERVER["SCRIPT_NAME"]));


/* NO RECORD FOUND */
if (empty($data)){
  echo'
 <br/>
<br/>
<div class="search_bar">
<form action="" method="get">
<label for="search-field">search by ID or email...</label>
<input type="search" name="s" results="5" size="50%" value="'.$search_term.'">
<input type="submit" value="Find">
</form>
</div>
<br/>

<div class="wrap">
    <div class="nameleft">
   No Record Found
   </div>
    <div class="inforight">
    <div id="onlyid">
    <b> ID: N/A </b><br/><br/>
        </div>
        <b> Major: N/A <br/><br/>
        <b> Email: N/A <br/><br/>
        <b> Appointment: N/A <br/><br/>
        <b> Career Track: N/A <br/><br/>
       <b> Future Plans: N/A <br/><br/>
        <b>Advising Question ID s: N/A <br/><br/>
    </div>
</div>

';
}

/* DISPLAYS INFO OF THE STUDENT THAT WAS SEARCHED FOR */
else {
echo'
<br/>
<br/>
<br/>
<div class="search_bar">
<form action="" method="get">
<label for="search-field">search by ID or email...</label>
<input type="search" name="s" results="5" size="50%" value="'.$search_term.'">
<input type="submit" value="Find">
</form>
</div>
<br/>


<div class="wrap">
    <div class="nameleft">
  '.$data['lastName'].' , '.$data['firstName'].'
   </div>

    <div class="inforight">
    <div id="onlyid">
    <b> ID: '.$data['schoolID'].'</b><br/><br/>
        </div>
        <b> Major: '.$data['major'].'<br/><br/>
        <b> Email: '.$data['email'].'<br/><br/>';
    if (empty($meeting_ids)) {
        echo' <b> Appointment: No appointment scheduled';}
    else {
        echo'
        <b> Appointment: <br/>'.$apt_data['sessionLeaderID'].'
        <br/> '.$apt_data['start'].'<br/>
              '.$apt_data['end'].'<br/>
       <br/><br/>';}

    echo'<b> Career Track: '.$wksht_data['careerTrack'].'<br/><br/>
        <b> Future Plans: '.$wksht_data['futurePlans'].' <br/><br/>
        <b>Advising Questions: '.$wksht_data['advisingQuestions'].' <br/><br/>
</div>
</div>
';
}
}
/* DEFAULT TEXT  */
else{

  echo '
<br/>
<div class="search_bar">
<form action="" method="get">
<label for="search-field">search by ID or email...</label>
<input type="search" name="s" results="5" size="50%" value="'.$search_term.'">
<input type="submit" value="Find">
</form>
</div>
<br/>

<div class="wrap">
    <div class="nameleft">
      STUDENT , UMBC
   </div>

    <div class="inforight">
    <div id="onlyid">
    <b> ID: </b><br/><br/>
        </div>
        <b> Major: <br/><br/>
        <b> Email: <br/><br/>
        <b> Appointment: <br/><br/>
        <b> Career Track: <br/><br/>
       <b> Future Plans: <br/><br/>
        <b>Advising Questions: <br/><br/>
</div>
</div>
'; }



?>


<!DOCTYPE html>
<html>

<head>
  <title>Search for a Student</title>
<link rel="icon" type="image/png" href="http://assets1-my.umbc.edu/images/avatars/myumbc/original.png?147914482\
7">

<style>
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

.wrap {
width: 100%;
 }

.nameleft, .inforight {
  float:left;
width: 50%;
  background-color: black;
height: 1000px;
  font-family: Arial;
 }
.nameleft {
color: white;
  text-align: center;
  line-height: 600px;
  font-size: 70px;
 }
.inforight {
  background-color: #f5ca5c;
  font-size: 36px;
 }

#onlyid{
padding-top: 50px;
}

b {
  padding-right: 30px;
  padding-left: 50px;
}


.search_bar {
  padding-left: 30%;
width: 95%;
border:0px solid #dbdbdb;
    font-family: Arial;


 }

input[type=submit] {
width: 4%;
  background-color: #4CAF50; /* Green */
  border: none;
color: white;
padding: 2px 0px;
  text-align: center;
  text-decoration: none;
display: inline-block;
  font-size: 16px;
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


</body>
</html>

<?php
session_start();
if (!isset($_SESSION["messages"]))
  $_SESSION["messages"] = array();
if (!isset($_SESSION["HAS_LOGGED_IN"]))
  header('Location: login.php');
?>

<html>
<head>
    <title>Advisor Homepage</title>
    <link href="../../styles.css" rel="stylesheet" type-"text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
</head>
<body>

<script>
  /* not completely functional */
  function printDiv(divHTML) {
  var backup = document.body.innerHTML;
  document.body.innerHTML = divHTML
  window.print();
  document.body.innerHTML = backup;
}
</script>

<div class="container">
  <h1>Advisor Home</h1>
  <h3>Welcome <?php echo htmlspecialchars($_SESSION["ADVISOR_FNAME"]); ?>, here are your meetings.</h3>
  <a href="logout.php"> <button type="button">Log Out</button></a> <br>
  <?php  
  if (isset($_SESSION["messages"]) && sizeof($_SESSION["messages"])) {
    echo "<div class='messages'>";
    echo "<span class='close' onclick='this.parentElement.style.display=\"none\";'>&times;</span>";
    foreach ($_SESSION["messages"] as $message)
      echo $message;
    $_SESSION["messages"] = array();
    echo "</div>";
  }
include('calendar.php');
?>
<div id='results'></div>       
  <div id='students'></div>
</div>
</body>
</html>
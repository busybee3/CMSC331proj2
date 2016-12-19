<html>
<head>
<title>No Action</title>
</head>
<body>
<form method="post" name="noAction">

<p>As you have already been given permission to register this appointment service is not intended for you.</p>

<label for="button">Please click the return button to return to the Login page.</label><br>
<input type="submit" name="confirm" id="button" value="Return">

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
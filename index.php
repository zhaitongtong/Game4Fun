<?php

session_start();

$_SESSION["rep"] = " ";
$_SESSION["utype"] = "Personal";
$_SESSION["uname"] = " ";
$_SESSION["upsw"] = " ";

?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="style/log_style.css" />
</head>
<style>
</style>
<body>
	<h1 style="text-align: center;">WELCOME TO GAME4FUN!</h1>
	<form style="text-align: center;" action="login/login_check.php"   method= "POST">
		<br>
		<b id = "form">
			<input type="radio" name="utype" value="Personal" checked> Personal
			<input type="radio" name="utype" value="Business"> Business
			<input type="radio" name="utype" value="Admin"> admin<br>
			<br>
			User Name:<br>
			<input type="text" name="uname" value="" maxlength="20">
			<br>
			<br>
			Password:<br>
			<input type="password" name="psw" value="" maxlength="30">
			<br>
		</b>
		<br>
		<br>
		<input style="visibility: hidden; width: 0px;" type="submit"  value="Log in">	
		<button class="btn btn-primary" class="btn btn-primary" type="submit" formaction="login/register.php"  formmethod= "POST" formtarget="_self">Register now</button>
		<input class="btn btn-primary" class="btn btn-primary" type="submit" value="Log in">
		<input style="visibility: hidden; width: 0px;" type="submit"  value="Log in">		
	</form>

</body>
<br>
<div id="footer"><p style="text-align: center;"><font color="white">
	&copy; All rights reserved by Game4Fun Group
</font> 
</p>
</div>
</html>
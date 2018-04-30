<?php

session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../style/log_style.css" />
</head>
<style>
</style>
<body>
	<h1 style="text-align: center;">WELCOME TO GAME4FUN!</h1>
	<form style="text-align: center;" action="login_check.php"   method= "POST">
		<br>
		<b id = "form">
			<input type="radio" name="utype" value="Personal" <?php if($_SESSION["utype"] == "Personal") { echo "checked";}?>>Personal
			<input type="radio" name="utype" value="Business" <?php if($_SESSION["utype"] == "Business") { echo "checked";}?>> Business
			<input type="radio" name="utype" value="Admin" <?php if($_SESSION["utype"] == "Admin") { echo "checked";}?>>Admin<br>
			<br>
			User Name:
		<br>
			<input type="text" name="uname" maxlength="20 value= <?php echo $_SESSION["uname"];?> ">
			<br>
			<br>
			Password:<br>
			<input type="password" name="psw" value="" maxlength="30">
			</b>
		<br>
		<b style="color: red"><?php echo $_SESSION["rep"];
		$_SESSION["rep"] = " "; ?></b>
		<br>
		<br>
		<input style="visibility: hidden; width: 0px;" type="submit"  value="Log in">	
		<button class="btn btn-primary" type="submit" formaction="register.php"  formmethod= "POST" formtarget="_self">Register now</button>
		<input class="btn btn-primary" type="submit"  value="Log in">
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

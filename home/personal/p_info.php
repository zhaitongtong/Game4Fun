<?php

session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Personal User update Page</title>
</head>
<style>
</style>
<body>
	<form style="text-align: center;" action="p_update.php" method= "POST" target="_self">
		<h2 style="font-size: 20; size: 20"><caption>Personal user information</caption></h2>
		<span>(<span style="color: red">*</span> part must be filled)</span><br>
		<br>
		<span style="color: red">*</span>
		Email:<br>
		<input type="email" name="email" value=<?php echo $_SESSION["uemail"];?> required>
		<br>
		<br>
		<span style="color: red">*</span>
		User Name(less than 20 character):<br>
		<input type="text" name="uname" value=<?php echo $_SESSION["uname"];?> maxlength="20" required>
		<br>
		<br>
		<span style="color: red">*</span>
		Password(less than 30 character):<br>
		<input type="text" name="psw" value=<?php echo $_SESSION["upsw"];?> maxlength="30" required>
		<br>
		<br>
		Gender:<br>
		<input type="radio" name="gender" value="Male" <?php if($_SESSION["ugender"] == "Male") { echo "checked";}?>> Male
		<input type="radio" name="gender" value="Female" <?php if($_SESSION["ugender"] == "Female") { echo "checked";}?>> Female<br>
		<br>
		Age:<br>
		<input type="number" name="age" value=<?php echo $_SESSION["uage"];?> min="0" max="100">
		<br>
		<br>
		Country:<br>
		<select  name="country" style="color:black">
			<option value="" <?php if($_SESSION["ucountry"] == "") { echo "selected";}?>></option>
			<option value="Afghanistan"  <?php if($_SESSION["ucountry"] == "Afghanistan") { echo "selected";}?>>Afghanistan</option>
			<option value="Albania" <?php if($_SESSION["ucountry"] == "Albania") { echo "selected";}?>>Albania</option>
			<option value="Algeria"  <?php if($_SESSION["ucountry"] == "Algeria") { echo "selected";}?>>Algeria</option>
		</select>
		<br>
		<br>
		<span style="color: red">*</span>
		Notification:<br>
		<input type="radio" name="notif" value="1" <?php if($_SESSION["unotif"] == "1") { echo "checked";}?>> Yes
		<input type="radio" name="notif" value="0" <?php if($_SESSION["unotif"] == "0") { echo "checked";}?>> No
		<br>
		<b style="color: red"><?php echo $_SESSION["rep"];
		$_SESSION["rep"] = " "; ?></b>
		<br>
		<input type="reset" value="reset">
		<input type="submit" value="update">	
	</form>
</body>
</html>
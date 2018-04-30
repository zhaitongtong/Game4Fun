<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Review update Page</title>
</head>
<style>
input[type=text] {
	width: 40%;
	padding: 12px 20px;
	margin: 8px 0;
	box-sizing: border-box;
}
textarea {
	width: 100%;
	height: 150px;
	padding: 12px 20px;
	box-sizing: border-box;
	border: 2px solid #ccc;
	border-radius: 4px;
	background-color: #f8f8f8;
	resize: none;
}
#name
{
	width: 20%;
  	height: 45px;
}
</style>
<body>
	<form style="text-align: left;" action="r_update.php" method= "POST" target="_self">
		<caption>Review information</caption>
		<span>(<span style="color: red">*</span> part must be filled)</span><br>
		<br>
		<span style="color: red">*</span>
		Game Name (you can not change this):<br>
		<textarea id="name" type="text" name="gName" maxlength="20" required readonly><?php echo $_SESSION["gName"];?></textarea>
		<br>
		<span style="color: red">*</span>
		Title:<br>
		<textarea id="name" type="text" name="title" maxlegth="100" required><?php echo $_SESSION["rtitle"];?></textarea>
		<br>
		Text:<br>
		<textarea type="text" name="text" required><?php echo $_SESSION["rtext"];?></textarea>
		<br>
		<b style="color: red"><?php echo $_SESSION["rep"];
		$_SESSION["rep"] = " "; ?></b>
		<br>
		<input type="reset" value="reset">
		<input type="submit" value="update">	
	</form>
</body>
<br>

<form style="text-align: left;" action="sample_manager.php" target="_self">
	<input type="submit" value="Back to manager">	
</form>
</html>
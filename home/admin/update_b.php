<?php

session_start();

include("../../mysqli_connect.php");

$_SESSION["bid"] = $_POST["bid"];

$sql = "SELECT * FROM businessuser WHERE userID = '".$_SESSION["bid"]."'";

$result = mysqli_query($conn, $sql);

if (!$sql) {
	die ('SQL Error: ' . mysqli_error($conn));
}

$row = mysqli_fetch_array($result);

$_SESSION["bname"] = $row["userName"];
$_SESSION["bpsw"] = $row["password"];
$_SESSION["bmail"] = $row["mail"];
$_SESSION["bnotif"] = $row["notification"];
$_SESSION["bsite"] = $row["officialSite"];

mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Business User update Page</title>
</head>
<style>
</style>
<body>
	<form style="text-align: center;" action="b_update.php" method= "POST" target="_self">
		<h2 style="font-size: 20; size: 20"><caption>Business user information</caption></h2>
		<span>(<span style="color: red">*</span> part must be filled)</span><br>
		<br>
		<span style="color: red">*</span>
		Email:<br>
		<input type="text" name="email" value=<?php echo $_SESSION["bmail"];?> required>
		<br>
		<br>
		<span style="color: red">*</span>
		User Name(less than 20 character):<br>
		<input type="text" name="uname" value=<?php echo $_SESSION["bname"];?> maxlength="20" required>
		<br>
		<br>
		<span style="color: red">*</span>
		Password(less than 30 character):<br>
		<input type="text" name="psw" value=<?php echo $_SESSION["bpsw"];?> maxlength="30" required>
		<br>
		<br>
		Official Site:<br>
		<input type="text" name="officialSite" value=<?php echo $_SESSION["bsite"];?>>
		<br>
		<br>
		<span style="color: red">*</span>
		Notification:<br>
		<input type="radio" name="notif" value="1" <?php if($_SESSION["bnotif"] == "1") { echo "checked";}?>> Yes
		<input type="radio" name="notif" value="0" <?php if($_SESSION["bnotif"] == "0") { echo "checked";}?>> No
		<br>
		<b style="color: red"><?php echo $_SESSION["rep"];
										$_SESSION["rep"] = " "; ?></b>
		<br>
		<input type="reset" value="reset">
		<input type="submit" value="update">	
	</form>

</body>

<form style="text-align: center;" action="a_reset_business.php" target="_self">
	<input type="submit" value="Back">	
</html>
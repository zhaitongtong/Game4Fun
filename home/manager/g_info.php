<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Game update Page</title>
</head>
<style>

input[type=text] {
	width: 40%;
	padding: 12px 20px;
	margin: 8px 0;
	box-sizing: border-box;
}
#name
{
	width: 20%;
  	height: 45px;
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
</style>
<body>
	<form style="text-align: left;" action="g_update.php" method= "POST" target="_self">
		<h2 style="font-size: 20; size: 20"><caption>Game information</caption></h2>
		<span>(<span style="color: red">*</span> part must be filled)</span><br>
		<br>
		<br>
		<span style="color: red">*</span>
		Game Name(less than 20 characters):<br>
		<textarea id="name" type="text" rows="1" cols="20" name="gname" maxlength="20" required><?php $gname=$_SESSION["gname"]; echo $gname;?></textarea>
		<br>
		<br>
		<span style="color: red">*</span>
		Release date (no change after release):<br>
		<input type="text" name="date" required readonly value=<?php echo $_SESSION["gsince"];?>>
		<br>
		<br>
		<span style="color: red">*</span>
		Category:<br>
		<?php
		include("../../mysqli_connect.php");

		$sql = "SELECT cName FROM category Order by cName";

		$result = mysqli_query($conn, $sql);

		if (!$sql) {
			die ('SQL Error: ' . mysqli_error($conn));
		}

		$_SESSION["allcates"] = array();

		while($row = mysqli_fetch_array($result)) {
			array_push($_SESSION["allcates"], $row["cName"]);
		}

		foreach ($_SESSION["allcates"] as $cate) {
			echo "<input type='checkbox' name='".$cate."' value='".$cate."'";

			if (in_array($cate, $_SESSION["gcate"])) {
				echo " checked";
			}
			echo ">".$cate;
		}
		?>
		<br>
		<br>
		<span style="color: red">*</span>
		Game description:<br>
		<textarea type="text" name="ginfo" required><?php echo $_SESSION["ginfo"];?></textarea>
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
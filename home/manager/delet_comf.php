<!DOCTYPE html>
<html>
<head>
	<title>Delet comfir Page</title>
</head>
<style>
</style>
<body>
	<br>
	<form style="text-align: center; font-size: 20" action="sample_manager.php" target="_self">
		<caption><?php
		echo "Are you sure you want to <span style ='color: red; font-size: 20px'>delet</spawn> this ";
		if (isset($_POST["gid"])) {
			echo "<span style ='color: red; size: 20'>game</spawn>";
		} elseif (isset($_POST["rid"])) {
			echo "<span style ='color: red; size: 20'>review</spawn>";
		} else {
			echo "<span style ='color: red; size: 20'>comment</spawn>";
		}
		echo " ???";
		?></caption>
		<br><br>
		<input type="submit" value="Back to manager">
		<button type="submit" formaction="delet.php"  formmethod= "POST" formtarget="_self" 
		<?php
		echo "name=";
		if (isset($_POST["gid"])) {
			echo "'gid'";
			echo " value='".$_POST["gid"]."'";
		} elseif (isset($_POST["rid"])) {
			echo "'rid'";
			echo " value='".$_POST["rid"]."'";
		} else {
			echo "'cid'";
			echo " value='".$_POST["cid"]."'";
		}
		?>
		>Yes</button>	
	</form>
</body>
<br>
</html>
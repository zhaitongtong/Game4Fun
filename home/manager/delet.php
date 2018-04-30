<?php
session_start();

include("../../mysqli_connect.php");


if (isset($_POST["gid"])) {
	$sql = "DELETE FROM game WHERE gameID='".$_POST["gid"]."'";
	
} elseif (isset($_POST["rid"])) {
	$sql = "DELETE FROM review WHERE rID='".$_POST["rid"]."'";

} else {
	$sql = "DELETE FROM commentary WHERE cID='".$_POST["cid"]."'";
}

$result = mysqli_query($conn, $sql);

if (!$sql) {
	$_SESSION["rep"] = "delet fail, ".mysqli_error($conn);
	mysqli_close($conn);

	header("Location: sample_manager.php");
	exit;
}

if (isset($_POST["gid"])) {
	$_SESSION["rep"] = "game delete success";
	
} elseif (isset($_POST["rid"])) {
	$_SESSION["rep"] = "review delete success";

} else {
	$_SESSION["rep"] = "commentary delete success";
}

mysqli_close($conn);

header("Location: sample_manager.php");
exit;

?>
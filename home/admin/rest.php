<?php
session_start();

include("../../mysqli_connect.php");

if (isset($_POST["personal"])) {
	$sql = "UPDATE personaluser SET password= '666' WHERE userID='".$_POST["personal"]."'";
	$headerloc = "Location: a_reset_personal.php";
	$id = $_POST["personal"];
} elseif (isset($_POST["business"])) {
	$sql = "UPDATE businessuser SET password= '888' WHERE userID='".$_POST["business"]."'";
	$headerloc = "Location: a_reset_business.php";
	$id = $_POST["business"];
} else {
	echo "there is a bug";
}

$result = mysqli_query($conn, $sql);

if (!$sql) {
	$_SESSION["rep"] = "rest fail, ".mysqli_error($conn);
	mysqli_close($conn);

	header($headerloc);
	exit;
}

$_SESSION["rep"] = "user".$id." password reseted";

mysqli_close($conn);

header($headerloc);
exit;

?>
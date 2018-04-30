<?php

session_start();

include("../../mysqli_connect.php");

$_SESSION["gid"] = $_POST["gid"];

$sql = "SELECT gName, gameInfo, since FROM game WHERE gameID = '".$_SESSION["gid"]."'";

$result = mysqli_query($conn, $sql);

if (!$sql) {
	die ('SQL Error: ' . mysqli_error($conn));
}

$row = mysqli_fetch_array($result);

$_SESSION["gname"] = $row["gName"];
$_SESSION["ginfo"] = $row["gameInfo"];
$_SESSION["gsince"] = $row["since"];

$sql = "SELECT  cName FROM belong WHERE gameID = '".$_SESSION["gid"]."'";

$result = mysqli_query($conn, $sql);

if (!$sql) {
	die ('SQL Error: ' . mysqli_error($conn));
}

$_SESSION["gcate"] = array();

while($row = mysqli_fetch_array($result)) {
	array_push($_SESSION["gcate"], $row["cName"]);
}

mysqli_close($conn);

header("Location: g_info.php");
exit;

?>
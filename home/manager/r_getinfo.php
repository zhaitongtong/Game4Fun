<?php

session_start();

include("../../mysqli_connect.php");

$_SESSION["rid"] = $_POST["rid"];

$sql = "SELECT r.rID, r.title, r.text, g.gName FROM game g, review r WHERE r.gameID = g.gameID AND r.rID = '".$_SESSION["rid"]."'";

$result = mysqli_query($conn, $sql);

if (!$sql) {
	die ('SQL Error: ' . mysqli_error($conn));
}

$row = mysqli_fetch_array($result);

$_SESSION["gName"] = $row["gName"];
$_SESSION["rtitle"] = $row["title"];
$_SESSION["rtext"] = $row["text"];

mysqli_close($conn);

header("Location: r_info.php");
exit;

?>
<?php
include("../../mysqli_connect.php");

session_start();
date_default_timezone_set('America/Los_Angeles');

$title = $_POST["title"];
$text = $_POST["text"];
$t = time();
$time = date('Y-m-d H:i:s', $t);

// prepare and bind
$stmt = $conn->prepare("UPDATE review SET title=?, text=?, time=? WHERE rID=?");
$stmt->bind_param("sssi", $title, $text, $time, $_SESSION["rid"]);

if ($stmt->execute()) {
	$_SESSION["rtitle"] = $title;
	$_SESSION["rtext"]  = $text;

	$_SESSION["rep"] = "update success";

} else {
	$_SESSION["rep"] = $stmt->error;
}

mysqli_close($conn);

header("Location: r_info.php");
exit;

?>
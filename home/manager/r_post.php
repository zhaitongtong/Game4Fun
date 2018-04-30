<?php
include("../../mysqli_connect.php");

session_start();
date_default_timezone_set('America/Los_Angeles');


// checke game id
$gName = $_POST["gname"];
$res = mysqli_query($conn, "SELECT gameID FROM game WHERE gName='".$gName."'");
if ($res->num_rows == 0) {
	mysqli_close($conn);
	$_SESSION["rep"] = "no such game, try another game";
	header("Location: r_add.php");
	exit;
}
$row = mysqli_fetch_array($res);
$gid = $row["gameID"];

$title = $_POST["title"];
$text = $_POST["text"];
$t = time();
$time = date('Y-m-d H:i:s', $t);

// assgin a rid
$res = mysqli_query($conn, "SELECT MAX(rID) AS rid FROM review");
$row = mysqli_fetch_array($res);
$rid = $row["rid"] + 1;

// prepare and bind
$stmt = $conn->prepare("INSERT INTO review (gameID, rID, title, text, time, userID) VALUES (?,?,?,?,?,?)");
$stmt->bind_param("iisssi", $gid, $rid, $title, $text, $time, $_SESSION["uid"]);

if ($stmt->execute()) {
	$_SESSION["rep"] = "Post success";

} else {
	$_SESSION["rep"] = $stmt->error;
}

mysqli_close($conn);

header("Location: r_add.php");
exit;

?>
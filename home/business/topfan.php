<?php
session_start();
include("../../mysqli_connect.php");

$_SESSION["fans"] = array();
if(isset($_POST["fan"])) {
	$_SESSION["f"] = $_POST["fan"];
	if($_POST["fan"] != "No") {
		// checke is compnay has release any game
		$sql = 'SELECT * FROM game WHERE userID="'.$_SESSION["uid"].'"';
		$result = mysqli_query($conn, $sql);

		if ($result->num_rows > 0) {

			$sql = 'SELECT p.userID, p.userName 
			FROM personaluser p 
			WHERE NOT EXISTS 
			(SELECT f.gameID
			FROM (SELECT g1.gameID FROM game g1 WHERE g1.userID ="'.$_SESSION["uid"].'") f
			WHERE f.gameID NOT IN 
			(SELECT r.gameID FROM review r WHERE r.userID = p.userID))';

			$result = mysqli_query($conn, $sql);

			if ($result->num_rows > 0) {
				$_SESSION["nogame"]  = "no";
				while($row = $result->fetch_assoc()) {
					array_push($_SESSION["fans"], $row["userName"]);
				}
			} 
		} 
	}
}


mysqli_close($conn);

header("Location: b_report.php");
exit;

?>
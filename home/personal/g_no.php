<?php
session_start();
include("../../mysqli_connect.php");

$sql_g = "SELECT * FROM game g WHERE g.since = (SELECT MAX(since) AS time FROM game)";

$sql_b = "SELECT * FROM (SELECT avg(f.r_count) as pop, f.userID
FROM (SELECT g.gameID, g.userID,
Count(r.rID) AS r_count
FROM game g
LEFT OUTER JOIN review r ON g.gameID = r.gameID
GROUP BY g.gameID) f
GROUP BY f.userID) z WHERE z.pop = (SELECT MAX(v.pop) AS time FROM (SELECT avg(f.r_count) as pop, f.userID
FROM (SELECT g.gameID, g.userID,
Count(r.rID) AS r_count
FROM game g
LEFT OUTER JOIN review r ON g.gameID = r.gameID
GROUP BY g.gameID) f
GROUP BY f.userID) v)";


if(isset($_POST["n_o"])) {
	$_SESSION["g"] = $_POST["n_o"];
	if($_POST["n_o"] == "Oldest") {
		$sql_g = "SELECT * FROM game g WHERE g.since = (SELECT MIN(since) AS time FROM game)";
	}

	$result = mysqli_query($conn, $sql_g);

	if ($result->num_rows > 0) {
		$_SESSION["nogame1"]  = "no";
		$_SESSION["g_noNames"] = array();
		while($row = $result->fetch_assoc()) {
			array_push($_SESSION["g_noNames"], $row["gName"]);
			$_SESSION["g_noTime"] = $row["since"];
		}
	} else {
		$_SESSION["nogame1"]  = "yes";
	}
}

if(isset($_POST["pop"])) {
	$_SESSION["p"] = $_POST["pop"];
	if($_POST["pop"] == "Least") {
		$sql_b = "SELECT * FROM (SELECT avg(f.r_count) as pop, f.userID
		FROM (SELECT g.gameID, g.userID,
		Count(r.rID) AS r_count
		FROM game g
		LEFT OUTER JOIN review r ON g.gameID = r.gameID
		GROUP BY g.gameID) f
		GROUP BY f.userID) z WHERE z.pop = (SELECT MIN(v.pop) AS time FROM (SELECT avg(f.r_count) as pop, f.userID
		FROM (SELECT g.gameID, g.userID,
		Count(r.rID) AS r_count
		FROM game g
		LEFT OUTER JOIN review r ON g.gameID = r.gameID
		GROUP BY g.gameID) f
		GROUP BY f.userID) v)";
	}
	$result = mysqli_query($conn, $sql_b);

	if ($result->num_rows > 0) {
		$_SESSION["nogame2"]  = "no";
		$_SESSION["popsIDs"] = array( );
		while($row = $result->fetch_assoc()) {
			array_push($_SESSION["popsIDs"], $row["userID"]);
			$_SESSION["popv"] = $row["pop"];
		}

		$_SESSION["popsNames"] = array( );
		foreach ($_SESSION["popsIDs"] as $userID) {
        $sql = "SELECT * FROM businessuser WHERE userID ='".$userID."'";
        $result = mysqli_query($conn, $sql);
        $row = $result->fetch_assoc();
        	array_push($_SESSION["popsNames"], $row["userName"]);
        }

	} else {
		$_SESSION["nogame2"]  = "yes";
	}

}

mysqli_close($conn);

header("Location: p_report.php");
exit;

?>
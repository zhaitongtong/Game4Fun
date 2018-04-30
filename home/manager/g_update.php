<?php
include("../../mysqli_connect.php");

session_start();

$gname = $_POST["gname"];
$ginfo = $_POST["ginfo"];

// check category select
$gcate = array();
foreach ($_SESSION["allcates"] as $cate) {
	if (isset($_POST[$cate])) {
		array_push($gcate, $cate);
	} 
}


if (empty($gcate)) {
	$_SESSION["rep"] = "you must select at least one category";
	mysqli_close($conn);

	header("Location: g_info.php");
	exit;
}


// prepare and bind
$stmt = $conn->prepare("UPDATE game SET gName=?, gameInfo=? WHERE gameID=?");
$stmt->bind_param("ssi", $gname, $ginfo, $_SESSION["gid"]);

if ($stmt->execute()) {
	$_SESSION["gname"]  = $gname;
	$_SESSION["ginfo"]  = $ginfo;

	$gcate = array();
	foreach ($_SESSION["allcates"] as $cate) {

		if (isset($_POST[$cate])) {
			array_push($gcate, $cate);
			if (!in_array($cate, $_SESSION["gcate"])) {
				//add
				$sql = "INSERT INTO belong (cName, gameID) VALUES ('".$cate."', '".$_SESSION["gid"]."')";
				$result = mysqli_query($conn, $sql);

				if (!$sql) {
					$_SESSION["rep"] = "update category fail, ".mysqli_error($conn);
					mysqli_close($conn);

					header("Location: g_info.php");
					exit;
				}
			} 

		} else {
			if (in_array($cate, $_SESSION["gcate"])) {
				//delet
				$sql = "DELETE FROM belong WHERE gameID='".$_SESSION["gid"]."' AND cName='".$cate."'";
				$result = mysqli_query($conn, $sql);

				if (!$sql) {
					$_SESSION["rep"] = "update category fail, ".mysqli_error($conn);
					mysqli_close($conn);

					header("Location: g_info.php");
					exit;
				}
			}
		}

	}

	$_SESSION["gcate"] = $gcate;

	$_SESSION["rep"] = "update success";

} else {
	$_SESSION["rep"] = "update title or info fail,".$stmt->error;
}

mysqli_close($conn);

header("Location: g_info.php");
exit;

?>
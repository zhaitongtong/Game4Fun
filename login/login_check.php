<?php

session_start();
// Set session variables
$_SESSION["rep"] = "";

$_SESSION["utype"] = $_POST["utype"];
$uname = $_POST["uname"];
$psw = $_POST["psw"];

if ($uname == "" || $psw == "") {
	$_SESSION["rep"]  = "plz make sure enter both user name and password";
	header("Location: login_next.php");
	exit;
}

$_SESSION["uname"] = $_POST["uname"];

include("../mysqli_connect.php");

if ($_SESSION["utype"] == "Personal") {

	$sql = "SELECT * FROM personaluser WHERE userName = '".$uname."' LIMIT 1";
	$result = mysqli_query($conn, $sql);

	if ($result->num_rows > 0) {
		$row = mysqli_fetch_array($result);
		$password = $row["password"];

		if ($psw == $password) {
			$_SESSION["uid"]  = $row["userID"];
			$_SESSION["uname"]  = $row["userName"];
			$_SESSION["upsw"]  = $row["password"];
			$_SESSION["uemail"]  = $row["mail"];
			$_SESSION["ugender"]  = $row["gender"];
			$_SESSION["uage"]  = $row["age"];
			$_SESSION["ucountry"]  = $row["country"];
			$_SESSION["unotif"]  = $row["notification"];

			mysqli_close($conn);
			header("Location: ../home/personal/index.php");
			exit;
		} else {
			$_SESSION["rep"]  = "Please enter the correct password.";
		}

	} else {
		$_SESSION["rep"]  = "No such personal user found!";
	}

} else if ($_SESSION["utype"] == "Business") {
	$sql = "SELECT * FROM businessuser WHERE userName = '".$uname."' LIMIT 1";
	$result = mysqli_query($conn, $sql);

	if ($result->num_rows > 0) {
		$row = mysqli_fetch_array($result);
		$password = $row["password"];

		if ($psw == $password) {
			$_SESSION["uid"]  = $row["userID"];
			$_SESSION["uname"]  = $row["userName"];
			$_SESSION["upsw"]  = $row["password"];
			$_SESSION["uemail"]  = $row["mail"];
			$_SESSION["usite"]  = $row["officialSite"];
			$_SESSION["unotif"]  = $row["notification"];

			mysqli_close($conn);
			header("Location: ../home/business/index.php");
			exit;
		} else {
			$_SESSION["rep"] = "Please enter the correct password.";
		}

	} else {
		$_SESSION["rep"] = "No such business user found!";
	}
} else {
	$sql = "SELECT * FROM webadmin WHERE userName = '".$uname."' LIMIT 1";
	$result = mysqli_query($conn, $sql);

	if ($result->num_rows > 0) {
		$row = mysqli_fetch_array($result);
		$password = $row["password"];

		if ($psw == $password) {
			$_SESSION["uid"]  = $row["userID"];
			$_SESSION["uname"]  = $row["userName"];
			$_SESSION["upsw"]  = $row["password"];
			$_SESSION["uemail"]  = $row["mail"];
			$_SESSION["unotif"]  = $row["notification"];

			mysqli_close($conn);
			header("Location: ../home/admin/index.php");
			exit;
		} else {
			$_SESSION["rep"] = "Please enter the correct password.";
		}

	} else {
		$_SESSION["rep"] = "No such admin found!";
	}
}

mysqli_close($conn);
header("Location: login_next.php");
exit;
?>

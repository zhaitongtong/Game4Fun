<?php
include("../mysqli_connect.php");
session_start();

$email = $_POST["email"];
$uname = $_POST["uname"];
$psw = $_POST["psw"];
$gender = $_POST["gender"];
$age = $_POST["age"];
$country = $_POST["country"];
$notif = $_POST["notif"];

$sql = "SELECT * FROM personaluser WHERE userName = '".$uname."'";
$result = mysqli_query($conn, $sql);

$_SESSION["rep"] = "";

if ($result->num_rows > 0) {
    	// duplicate username
	$_SESSION["rep"] = "Username already exists.Please try another username.";
} else {

	$res = mysqli_query($conn, "SELECT userID from personaluser ORDER BY userID DESC LIMIT 1");
	$row = mysqli_fetch_array($res);
	$userID = $row["userID"] + 1;

		// prepare and bind
	$stmt = $conn->prepare("INSERT INTO personaluser (userID, userName, password, mail, gender, country, notification, age) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("isssssii", $userID, $uname, $psw, $email, $gender, $country, $notif, $age);

	if ($stmt->execute()) {
			//insert fail
		$_SESSION["rep"] = "Registered successfully! You can login now.";
		header("Location: login_next.php");
		exit;

	} else {
			//insert fail
		$_SESSION["rep"] = "Registration failed! Pleanse try again later.";
	}
}

mysqli_close($conn);

header("Location: personal_reg.php");
exit;

?>

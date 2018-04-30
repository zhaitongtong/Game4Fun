<?php
include("../../mysqli_connect.php");

session_start();

$email = $_POST["email"];
$uname = $_POST["uname"];
$psw = $_POST["psw"];
$officialSite = $_POST["officialSite"];
$notif = $_POST["notif"];

$sql = "SELECT * FROM businessuser WHERE userName = '".$uname."'";
$result = mysqli_query($conn, $sql);

$_SESSION["rep"] = "";

$valid = 1;

if ($result->num_rows > 0) {
    	// duplicate username
	while($row = $result->fetch_assoc()) {
		if ($row["userID"] != $_SESSION["bid"]) {
			if ($row["userName"] == $uname) {
				$valid = 0;
				$_SESSION["rep"] = "fail, no duplicate user name";
			}
		}
	}
} 

if ($valid) {

		// prepare and bind
	$stmt = $conn->prepare("UPDATE businessuser SET userName=?, password=?, mail=?, officialSite=?, notification=? WHERE userID=?");
	$stmt->bind_param("ssssii", $uname, $psw, $email, $officialSite, $notif, $_SESSION["bid"]);

	if ($stmt->execute()) {

		$_SESSION["rep"] = "update success";

	} else {
		$_SESSION["rep"] = "update fail, plz try again";
	}

}

mysqli_close($conn);

header("Location: a_reset_business.php");
exit;

?>
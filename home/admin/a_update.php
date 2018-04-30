<?php
	include("../../mysqli_connect.php");
	session_start();

	$email = $_POST["email"];
	$uname = $_POST["uname"];
	$psw = $_POST["psw"];
	$notif = $_POST["notif"];

	$sql = "SELECT * FROM webadmin WHERE userName = '".$uname."'";
	$result = mysqli_query($conn, $sql);

	$_SESSION["rep"] = "";

	$valid = 1;

	if ($result->num_rows > 0) {
    	// duplicate username
		while($row = $result->fetch_assoc()) {
			if ($row["userID"] != $_SESSION["uid"]) {
				if ($row["userName"] == $uname) {
					$valid = 0;
					$_SESSION["rep"] = "plz using other user name";
				}
			}
		}
	} 
	
	if ($valid) {

		// prepare and bind
		$stmt = $conn->prepare("UPDATE webadmin SET userName=?, password=?, mail=?, notification=? WHERE userID=?");
		$stmt->bind_param("sssii", $uname, $psw, $email, $notif, $_SESSION["uid"]);

		if ($stmt->execute()) {
			$_SESSION["uname"]  = $uname;
			$_SESSION["upsw"]  = $psw;
			$_SESSION["uemail"]  = $email;
			$_SESSION["unotif"]  = $notif;

			$_SESSION["rep"] = "update success";

		} else {
			$_SESSION["rep"] = "update fail, plz try again";
		}

	}

	mysqli_close($conn);

	header("Location: a_info.php");
	exit;

	?>
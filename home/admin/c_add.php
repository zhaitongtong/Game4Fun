<?php
include("../../mysqli_connect.php");

session_start();

$cate = $_POST["cate"];

// prepare and bind
$stmt = $conn->prepare("INSERT INTO category (cName) VALUES (?)");
$stmt->bind_param("s", $cate);

if ($stmt->execute()) {

	$_SESSION["rep"] = "new category is added";

} else {
	$_SESSION["rep"] = "new category added fail, do not add same category";
}

mysqli_close($conn);

header("Location: a_cate.php");
exit;

?>
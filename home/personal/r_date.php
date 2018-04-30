<?php
include("../../mysqli_connect.php");

session_start();
$date = $_POST["date"];

$sql = "SELECT * FROM review WHERE DATE(time) ='".$date."'";
$result = mysqli_query($conn, $sql);

if (!$sql) {
	die ('SQL Error: ' . mysqli_error($conn));
}

$_SESSION["daters"] = array();
if ($result->num_rows > 0) {
	while ($row = mysqli_fetch_array($result))
	{
		array_push($_SESSION["daters"], $row);
	}

}

mysqli_close($conn);

?>


<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<style type="text/css">
</style>

<body>
	<div class="container">
		<h2>Search Reviews</h2>
		<p>find all reviews edit on specified date</p>
		<form class="form-inline" action="r_date.php" method="POST">
			<div class="form-group">
				<label for="date">date:</label>
				<input type="date" class="form-control" id="date" name="date"  value=<?php echo $date;?> required>
			</div>
			<button type="submit" class="btn btn-default">search</button>
		</form>
		<?php
		echo "<table class='table table-striped'>
		<thead>
		<tr>
		<th>Titles</th>
		<th>Content</th>
		<th>Time</th>
		</tr>
		</thead>
		<tbody>";

		if(empty($_SESSION["daters"])) {
			echo 
			'<tr>
			<td style colspan = '.'"'.'3'.'"'.'> no review post on that date</td>
			</tr>'	;
		} else {

			foreach ($_SESSION["daters"] as $row) {
				echo '<tr>
				<td>'.$row['title'].'</td>

				<td>'.$row['text'].'</td>
				<td>'.$row['time'].'</td>'
				;

				echo '</tr>';
			}

		}

		echo '
		</tbody>
		</table>';
		?>
	</div>

</body>
</html>
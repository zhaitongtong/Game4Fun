<?php

include("../../mysqli_connect.php");

// add new review
echo "<form style='text-align: right;' action='r_add.php' target='_self'>
	<button type='submit'>
	Post a New review!	
	</button>
</form>";

// review table
echo "<table>
<caption>Your reviews</caption>
<thead>
<tr>
<th>Review Title</th>
<th>Game Name</th>
<th>Number of comments</th>
<th>Number of Thumbups</th>
<th>Last edit time</th>
<th>Operation</th>
</tr>
</thead>
<tbody>
";

$sql = "SELECT a.rID, a.title, a.time, a.gameID, a.gName, b.c_count, c.t_count
FROM (SELECT r.rID, r.title, r.time, g.gameID, g.gName FROM game g, review r WHERE r.gameID = g.gameID AND r.userID = '".$_SESSION["uid"]."') a,
(SELECT r.rID, Count(c.cID) AS c_count
FROM (SELECT rID FROM review WHERE userID = '".$_SESSION["uid"]."') r
LEFT OUTER JOIN commentary c ON c.rID = r.rID
GROUP BY r.rID) b,
(SELECT r.rID,
	Count(t.userID) AS t_count
	FROM (SELECT rID FROM review WHERE userID = '".$_SESSION["uid"]."') r
	LEFT OUTER JOIN thumbup t ON t.rID = r.rID
	GROUP BY r.rID) c
	WHERE a.rID = b.rID AND b.rID = c.rID";

	$result = mysqli_query($conn, $sql);

	if (!$sql) {
		die ('SQL Error: ' . mysqli_error($conn));
	}


	if ($result->num_rows > 0) {
		while ($row = mysqli_fetch_array($result))
		{

			echo '<tr>
			<td>'.$row['title'].'</td>
			<td>'.$row['gName'].'</td>
			<td>'.$row['c_count'].'</td>
			<td>'.$row['t_count'].'</td>
			<td>'.$row['time'].'</td>';

			echo "<td>
			<form>
			<button type='submit' name='rid' value='".$row['rID']."' formaction='r_getinfo.php'  formmethod= 'POST' formtarget='iframe'>edit</button>
			<button type='submit' name='rid' value='".$row['rID']."' formaction='delet_comf.php'  formmethod= 'POST' formtarget='iframe'>delete</button>
			</form>
			</td>";
			echo '</tr>';
		}

	} else {
		echo '<tr>
		<td style colspan = '.'"'.'6'.'"'.'> Your have not post any reviews</td>
		</tr>';
	}

	echo '
	</tbody>
	</table>';

	// comments table
	echo "
	<br>
	<br>
	<br>
	<div>
	<table>
	<caption>Your Comments</caption>
	<thead>
	<tr>
	<th>Txt</th>
	<th>Review title</th>
	<th>Operation</th>
	</tr>
	</thead>
	<tbody>";

	$sql = "SELECT c.cID, c.rID, c.text, r.title FROM commentary c, review r WHERE c.userID =". $_SESSION["uid"]." AND c.rID = r.rID";
	$result = mysqli_query($conn, $sql);

	if (!$sql) {
		die ('SQL Error: ' . mysqli_error($conn));
	}

	if ($result->num_rows > 0) {
		while ($row = mysqli_fetch_array($result))
		{

			echo '<tr>
			<td>'.$row['text'].'</td>
			<td>'.$row['title'].'</td>';
			echo "<td>
			<form>
			<button type='submit' name='cid' value='".$row['cID']."' formaction='delet_comf.php'  formmethod= 'POST' formtarget='iframe'>delete</button>
			</form>
			</td>";
			echo '</tr>';
		}

	} else {
		echo '<tr>
		<td style colspan = '.'"'.'3'.'"'.'> Your have not post any comments</td>
		</tr>';
	}

	echo '
	</tbody>
	</table>
	</div>';



	mysqli_close($conn);


	?>

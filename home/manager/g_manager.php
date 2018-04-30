<?php

include("../../mysqli_connect.php");

//post new game
echo "<form style='text-align: right;' action='g_add.php' target='_self'>
	<button type='submit'>
	Release a New Game!	
	</button>
</form>";

// review table
echo "<table>
<caption>Your Games</caption>
<thead>
<tr>
<th>Game Name</th>
<th>Number of reviews</th>
<th>Release date</th>
<th>Operation</th>
</tr>
</thead>
<tbody>
";

$sql = "SELECT g.gameID, g.gName, g.since,
Count(r.rID) AS r_count
FROM (SELECT gameID, gName, since FROM game WHERE userID = '".$_SESSION["uid"]."') g
LEFT OUTER JOIN review r ON g.gameID = r.gameID
GROUP BY g.gameID";

$result = mysqli_query($conn, $sql);

if (!$sql) {
	die ('SQL Error: ' . mysqli_error($conn));
}


if ($result->num_rows > 0) {
	while ($row = mysqli_fetch_array($result))
	{

		echo '<tr>
		<td>'.$row['gName'].'</td>
		<td>'.$row['r_count'].'</td>
		<td>'.$row['since'].'</td>';

		echo "<td>
		<form>
		<button type='submit' name='gid' value='".$row['gameID']."' formaction='g_getinfo.php'  formmethod= 'POST' formtarget='iframe'>edit</button>
		<button type='submit' name='gid' value='".$row['gameID']."' formaction='delet_comf.php'  formmethod= 'POST' formtarget='iframe'>delete</button>
		</form>
		</td>";
		echo '</tr>';
	}

} else {
	echo '<tr>
	<td style colspan = '.'"'.'4'.'"'.'> Your have not post any reviews</td>
	</tr>';
}

echo '
</tbody>
</table>';

mysqli_close($conn);


?>
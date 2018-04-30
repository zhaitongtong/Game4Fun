<?php

include("../../mysqli_connect.php");

// table
echo "<table>
<caption>Your Game and related reviews</caption>
<thead>
<tr>
<th>Game Name</th>

<th>Review Titles</th>
<th>Added Date</th>
<th>Content</th>
</tr>
</thead>
<tbody>
";

$sql = 'SELECT G.gameID, G.gName, R.title, R.time, R.text
FROM  game G
INNER JOIN review R ON G.gameID = R.gameID
WHERE G.userID = "'.$_SESSION['uid'].'"
ORDER BY gName;
'
;
$result = mysqli_query($conn, $sql);

if (!$sql) {
	die ('SQL Error: ' . mysqli_error($conn));
}


if ($result->num_rows > 0) {
	while ($row = mysqli_fetch_array($result))
	{

		echo '<tr>
		<td>'.$row['gName'].'</td>
		
		<td>'.$row['title'].'</td>
		<td>'.$row['time'].'</td>
		<td>'.$row['text'].'</td>'
		;

		echo '</tr>';
	}

} else {
	echo 
	 ''
	;
}

echo '
</tbody>
</table>';

mysqli_close($conn);


?>
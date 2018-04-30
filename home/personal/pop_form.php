<?php
include("../../mysqli_connect.php");

echo "<table>
<caption>Company Popularity
<span style='font-size: 10px'>(order by Popularity in desc)</span></caption>
<thead>
<tr>
<th>Company name</th>
<th>Official Site</th>
<th>Popularity</th>
</tr>
</thead>
<tbody>
";

$sql = "SELECT b.userName as name, b.officialSite as site, p.pop
FROM businessuser b, (SELECT avg(f.r_count) as pop, f.userID
FROM (SELECT g.gameID, g.userID,
Count(r.rID) AS r_count
FROM game g
LEFT OUTER JOIN review r ON g.gameID = r.gameID
GROUP BY g.gameID) f
GROUP BY f.userID) p
WHERE b.userID = p.userID ORDER BY p.pop DESC";

$result = mysqli_query($conn, $sql);

if (!$sql) {
	die ('SQL Error: ' . mysqli_error($conn));
}


if ($result->num_rows > 0) {
	while ($row = mysqli_fetch_array($result))
	{

		echo '<tr>
		<td>'.$row['name'].'</td>
		<td>'.$row['site'].'</td>
		<td>'.$row['pop'].'</td></tr>';
	}

} else {
	echo '<tr>
	<td style colspan = '.'"'.'3'.'"'.'> No Company released Game yet</td>
	</tr>';
}

echo '
</tbody>
</table>';

mysqli_close($conn);

?>
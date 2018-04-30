<?php
session_start();
unset($_SESSION['check_list']);
unset($_SESSION['submit']);
unset($_SESSION['sortT']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>GameList</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  <style type="text/css">
  <style>

  body{ font: 14px sans-serif; }
  .wrapper{ width: 350px; padding: 20px; }
  
      body{ font: 14px sans-serif; }
    .wrapper{ width: 350px; padding: 20px; }
	table {
     width: 100%;
}

td, th {
   text-align: center;
}
   table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
  
  
</style>
</head>
<body>
  <div class="wrapper">
    <h2>GameList</h2>
    <p>Game released so far.</p>
	
        
     	<form style="text-align: left;" action="sort.php"   method= "POST">
		<br>
        Sort By <br>
	    <input onchange='this.form.submit();' type="radio" name="sortt" value="Release Date" checked> Release Date
		<input onchange='this.form.submit();' type="radio" name="sortt" value="Category" > Category


	    </form>
	 	 

	 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">    
      <?php

      include("../../mysqli_connect.php");

      $sql = 'SELECT gameID,gName,since FROM game ORDER BY since DESC';
      $result = mysqli_query($conn, $sql);

      if (!$sql) {
        die ('SQL Error: ' . mysqli_error($conn));
      }

      echo '<table>
      <thead>
      <tr>
      <th>Game Name</th>
      <th>Release Date</th>
      </tr>
      </thead>
      <tbody>';

	        
     
      while ($row = mysqli_fetch_array($result))
      {

    
     echo "<tr> 
	 <td>  
     
	 <a href='gameP.php?gid=".$row['gameID']."'> "
	 
	
	 .$row['gName']." </a> </td>
     <td> ".$row['since']."
	 </td>
	  </tr>";
	  }
	  echo "
	  </tbody>
      </table>";



      mysqli_close($conn);
      ?>

    </div>			

	

  </form>

</div>


</body>


</html>


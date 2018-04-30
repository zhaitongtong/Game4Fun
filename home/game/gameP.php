<?php
include("../../mysqli_connect.php");
session_start();
$utype = $_SESSION["utype"];
$username = $_SESSION['uname'];


if (isset($_GET['gid'])){$gameID = (int)$_GET['gid'];}else{$gameID=$_SESSION['gid'];}
$_SESSION['gid'] = $gameID;
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GameList</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
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
  cellpadding="10"；
}
</style>
</head>
<body>
    <div class="wrapper">	
       
        <h1>Game</h1>
		<p><a href="gamepg.php">Back</a></p>
        <?php
		$sql = "SELECT * FROM game WHERE gameID= $gameID";
		$result = mysqli_query($conn, $sql);
		if (!$sql) {
        die ('SQL Error: ' . mysqli_error($conn));
      }

	  
      echo '<table>
      <thead>
      <tr>
      <th>GName</th>
      <th>date</th>
      </tr>
      </thead>
      <tbody>';

       if ($row = mysqli_fetch_array($result)){
      

        echo '<tr>
        <td>'.$row['gName'].'</td>
        <td>'.date_format(new DateTime($row['since']),'Y/m/d').'</td> 
        </tr>' ;
		
		
      
      echo '
      </tbody>
      </table>';
	  
	  
	  
	  echo '<table>
      <thead>
      <tr>
      <th>Description</th>
      </tr>
      </thead>
      <tbody>';
	  
	  echo '<tr>
	   <td> '.$row['gameInfo'].'</td>
	   </tr>' ;
	  
	       echo '
      </tbody>
      </table>'; 
	     
	   } 


   
		
		
		?>
        
        
        <h2>Reviews</h2>
        <?php
        $sql = "SELECT * FROM review WHERE gameID= $gameID";
        $result = mysqli_query($conn,$sql);
        $thumbup = 0;
		
		if (!$sql) {
        die ('SQL Error: ' . mysqli_error($conn));
      }
		
	     
		// title, time , thumbups for reviews 

        while ($row = mysqli_fetch_array($result))
        {
			        echo '<table>
        <thead>
        <tr>
        <th>Title</th>
        <th>Time</th>
		<th>Thumbup</th>
        </tr>
        </thead>
        <tbody>';
        
			
            
			$sql1 = 'SELECT COUNT(userID),rID FROM thumbup WHERE rID = "' .$row['rID']. '" GROUP BY rID';
			$result1 = mysqli_query($conn,$sql1);
			$thumbup = 0;

			
			while($row1 = mysqli_fetch_array($result1)){
				
				$thumbup = $row1['COUNT(userID)']; 
				
			}
		
		


// add commentary after each review
		
			$sql2 = 'SELECT * FROM commentary WHERE rID = "' .$row['rID']. '"  ';
			$result2 = mysqli_query($conn,$sql2);

			
            echo '<tr>
            <td>'.$row['title'].'</td>
            <td>'.date_format(new DateTime($row['time']),'Y/m/d H:i:s').'</td>
			<td>'.$thumbup.'</td>
            </tr>';
			
				    		echo '
      </tbody>
      </table>';

			
 echo '<table>
      <thead>
      <tr>
      <th>Content</th>
      </tr>
      </thead>
      <tbody>';
	  
	  echo '<tr>
	   <td> '.$row['text'].'</td>
	   </tr>' ;
	  
	       echo '
      </tbody>
      </table>'; 
	

	  		
			
		?>
		
		<?php if($utype == "Personal"): ?>
		<form action="Thumbup.php" method="post">
            <input type="hidden" name="rID" value="<?php echo $row['rID']?>"><br>
            <input type="submit" value='Thumbup' />
			<br>
			<?php  if (isset($_SESSION['tres']))
			
			
			{echo     '<font size="3" color="red">'.$_SESSION['tres'].'</font>';}  ?>
			
			

			<?php  $_SESSION['tres']="";?>
			<br>
			<br>
        </form>
		
		
		<?php endif; ?>

		
		<?php
			
			while($row2 = mysqli_fetch_array($result2)){
		        echo '<table>
        <thead>
        <tr>
        <th>Commentary</th>
        </tr>
        </thead>
        <tbody>';			
				
				
  echo '<tr>
        <td>'.$row2['text'].'</td>
        </tr>';
			}
	

    echo '
        </tbody>
        </table><br>';
				
			
			?>
			
					<?php if($utype == "Personal"): ?>
		   	
			
				            <h4>Leave a comment:</h4>
        <form action="insertCT.php" method="post">
            <!-- Here the shit they must fill out -->
            <input type="text" name="comment" value="" maxlength="20" required><br>
			<input type="hidden" name="rID" value="<?php echo $row['rID']?>"><br>
            <input type="submit" />
			<br>
			<?php  if (isset($_SESSION['cres'])){echo '<font size="3" color="red">'.$_SESSION['cres'].'</font>';} ?>
			<?php  $_SESSION['cres']="";?>
			<br><br>
        </form>
		    <?php endif; ?>		
		
		<?php
			
	       
	  
	      
	  
	
			
        }
		
		echo '
      </tbody>
      </table>';
		
		?>



        <?php if($utype == "Personal"): ?>
        <h2>Leave a Review:</h4>
            <form action="insertRW.php" method="post">
                <!-- Here the shit they must fill out -->
				
				<p>Please enter your title:</p>
                <p><input type="text" name="title" value="" maxlength="20" required></p>
				<p>Please enter your review content:</p>
				<input type="text" name="reviewText" value="" maxlength="100" required><br>

                <input type="submit" />
				<br>
				<?php  if (isset($_SESSION['rres']))
				
				{echo '<font size="3" color="red">'.$_SESSION['rres'].'</font>';}  ?>
				<?php  $_SESSION['rres']="";?>
				<br>
				<br>
            </form>
		<?php endif; ?>	
			
			
			

        </body>
        
        
        </html>
		
		
		



<?php
include("../../mysqli_connect.php");
session_start();


?>

<a href="gameP.php?gid=<?php echo $_SESSION['gid']?>">Back</a>

<?php
 
 if(isset($_POST['comment'])){
    
	
	    $sql ='SELECT MAX(cID) FROM commentary';
		$result = mysqli_query($conn,$sql);
				if (!$result) {
        die ('SQL Error: ' . mysqli_error($conn));
      }
	    
		 $cid = 0;
		if($row = mysqli_fetch_array($result)){
			
			$cid = $row['MAX(cID)'] + 1;
		}
	    
		
		$text   =   $_POST['comment'];
		$userID =   $_SESSION['uid'];
		$rID    =   $_POST['rID'];

								
	    $sql = 'INSERT INTO commentary(cID,text,userID,rID) VALUES( "' .$cid. '","' .$text. '", "' .$userID. '"  ,"' .$rID. '") ';
		
        if ($conn->query($sql) === TRUE) {
       $_SESSION['cres'] = "Comment successfully, thank u for your commentary";
	    header("Location: gameP.php");
       } else {
         echo "Error: " . $sql . "<br>" . $conn->error;
		 $_SESSION['cres'] = "sorry, submit wrong, plz try again";
		  header("Location: gameP.php");
        }

$conn->close();
		}

		
		
	?>	

	 
 
 
 
 
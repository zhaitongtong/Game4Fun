<?php
include("../../mysqli_connect.php");
session_start();

$_SESSION['rres']="";

?>

<a href="gameP.php?gid=<?php echo $_SESSION['gid']?>">Back</a>

<?php
 
 if(isset($_POST['title']) && isset($_POST['reviewText'])){
    
	
	    $sql ='SELECT MAX(rID) FROM review';
		$result = mysqli_query($conn,$sql);
				if (!$result) {
        die ('SQL Error: ' . mysqli_error($conn));
      }
	    
		
		$rid = 0;
		
		if($row = mysqli_fetch_array($result)){
			
			$rid = $row['MAX(rID)'] + 1;
		}
	    
		$title=$_POST['title'];
		$text =$_POST['reviewText'];
		$userID = $_SESSION['uid'];
		$gameID = $_SESSION['gid'];
		date_default_timezone_set('Canada/Pacific');
        $time = date('Y/m/d h:i:s', time());  
		
		 							
	    $sql = 'INSERT INTO review(rID,title,text,userID,gameID,time) VALUES( "'.$rid.'","'.$title.'", "'.$text.'"  ,"'.$userID.'","'.$gameID.'","'.$time.'") ';
		
		 
        if ($conn->query($sql) === TRUE) {
         $_SESSION['rres'] =  "Review successfully, thank u for your review";
		  header("Location: gameP.php");
       } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
		 $_SESSION['rres'] = "Woops, something went wrong, plz try again";
		  header("Location: gameP.php");
        }

$conn->close();
		}
		
		
	?>	

	 
 
 
 
 
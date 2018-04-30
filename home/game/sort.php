<?php
include("../../mysqli_connect.php");
session_start();
if(isset($_POST['sortT'])) {$_SESSION['sortT']=$_POST['sortT'];}
if(isset($_POST['submit'])) {$_SESSION['submit']=$_POST['submit'];}
$ch1="";

$ch2="";

$ch3=""; 

$ch4="";

if(isset($_POST['check_list'])) 
{$_SESSION['check_list']=$_POST['check_list'];


 foreach($_POST['check_list'] as $selected){
       if ($selected ==  "gameID")    {$ch1 = "checked";}
	   if ($selected ==  "since")     {$ch2 = "checked";}
	   if ($selected ==  "gameInfo")  {$ch3 = "checked";}
	   if ($selected ==  "Company" )  {$ch4 = "checked";}
     }

}

$attribute = "gName";

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
	<form style="text-align: left;" action="gamepg.php"   method= "POST">
		<br>
        Sort By <br>
	    <input onchange='this.form.submit();'type="radio" name="sortt" value="Release Date"> Release Date
		<input onchange='this.form.submit();'type="radio" name="sortt" value="Category" checked> Category


	</form>
	
		
	
         <form action="sort.php" method="post">
		 
		 <?php 
	  $sql = 'SELECT cName FROM category';
      $result = mysqli_query($conn, $sql);

      if (!$result) {
        die ('SQL Error: ' . mysqli_error($conn));
	  }
		while ($row = mysqli_fetch_array($result)){
			
		?><input type="submit" value= <?php echo $row['cName']; ?>  name="sortT" /><?php
			
		}
      
		 ?>
		 

		 

	
		 <br>
		 <br>
		 
		 Things that you want to display   GameName must be shown<br>
		 
		 <input name="check_list[]" type="checkbox" value="gName" onclick="return false;" checked /><label>GameName</label><br>
		 <input name="check_list[]" type="checkbox" value="gameID"   <?php echo trim($ch1,"");?> /><label>GameID</label><br>
		 <input name="check_list[]" type="checkbox" value="since"    <?php echo trim($ch2,"");?> /><label>Release Date</label><br>
		 <input name="check_list[]" type="checkbox" value="gameInfo" <?php echo trim($ch3,"");?> /><label>Game Info</label><br>
		 <input name="check_list[]" type="checkbox" value="Company"  <?php echo trim($ch4,"");?> /><label>Company</label><br>
         <input type="submit" name="submit" value="Show"/>
        
       </br> </br>
       </div>
	   
	  <?php
     if(isset($_POST['submit'])){//to run PHP script on submit
     if(!empty($_POST['check_list'])){
     // Loop to store and display values of individual checked checkbox.
     foreach($_POST['check_list'] as $selected){
        $attribute .= $selected."</br>";
     }
       }   
         }
           ?> 
	   
	   
	   
      <?php

       if(isset($_SESSION['sortT'])){
			       


      $sql = 'SELECT G.gameID,gName,since,gameInfo,userID FROM game G,belong B WHERE G.gameID=B.gameID AND B.cname = "'.$_SESSION['sortT'].'"';
      $result = mysqli_query($conn, $sql);

      if (!$sql) {
        die ('SQL Error: ' . mysqli_error($conn));
      }

      echo '<table>
      <thead>
      <tr>      
	  <th>Game Name</th>';
     

      if(isset($_SESSION['check_list'])){	 
	  foreach($_SESSION['check_list'] as $selected){
		
		if($selected=="gameID") {echo trim("<th> Game ID </th>",'"');}
        if($selected=="gameInfo"){echo trim("<th>Game Information </th>",'""');}
      	if($selected=="since") {echo trim("<th> Release Date </th>",'"');}
  	    if($selected=="Company") {echo trim("<th> Company </th>",'"');}
       	if($selected=="gName"){echo "";}
	  }
	  }
     
   	 echo
	  '</tr>
      </thead>
      <tbody>';

	        
     
      while ($row = mysqli_fetch_array($result))
      {
		  
     echo "<tr> 
	 <td>       
	 <a href='gameP.php?gid=".$row['gameID']."'> "	
	 .$row['gName']." </a> 	 
	 </td>  ";
	 
	 if(isset($_SESSION['check_list'])){
	  foreach($_SESSION['check_list'] as $selected){
		
		if($selected=="Company"){
			
	  $sql1 = 'SELECT B.userName FROM businessuser B,game G WHERE G.userID=B.userID AND G.userID = "'.$row['userID'].'"';
      $result1 = mysqli_query($conn, $sql1);

      if (!$result1) {
        die ('SQL Error: ' . mysqli_error($conn));
      }
	  
	  while($row1 = mysqli_fetch_array($result1))
	  {
		  
		  $Company = $row1['userName'];
		  
	  }
		
        echo trim('<td>'.$Company.'</td>')  ;	
			
		}else if($selected=="gName"){
			
			echo "";
			
		}else{
     		
		echo trim('<td>'.$row["$selected"].'</td>')  ;
		
		
		}
	 }
	 
	 }

	  echo"
	  </tr>";
	  }
	  echo "
	  </tbody>
      </table>";



	   mysqli_close($conn);}
      ?>

    		

	

  </form>

</div>


</body>
</html>
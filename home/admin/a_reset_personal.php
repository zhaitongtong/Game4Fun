<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Game4Fun - Reset</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  <style type="text/css">
  <style>
  .dropdown {
    position: relative;
    display: inline-block;
  }
  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    padding: 12px 16px;
  }
  .dropdown:hover .dropdown-content {
    display: block;
  }
  body{ font: 14px sans-serif; }
  .wrapper{ width: 350px; padding: 20px; }

  table {
    width: 100%;
  }
  td {
    text-align: center;
  }
  table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
  }
</style>
</head>
<body>
  <body><font>
    <div class="wrapper">
      <h2>Personal User</h2>
      <die class="form-group">
      </div> </br>
      <b style="color: red"><?php echo $_SESSION["rep"];
      $_SESSION["rep"] = " "; 
      ?>
    </b>
  </br>

  <?php

  include("../../mysqli_connect.php");

  $sql = 'SELECT * FROM personaluser';
  $result = mysqli_query($conn, $sql);

  if (!$sql) {
    die ('SQL Error: ' . mysqli_error($conn));
  }

  echo '<table><thead><tr>
  <th><p style="text-align: center;">UserID</p></th>
  <th><p style="text-align: center;">Name</p></th>
  <th><p style="text-align: center;">Gender</p></th>
  <th><p style="text-align: center;">Email</p></th>
  <th><p style="text-align: center;">Notification</p></th>
  <th><p style="text-align: center;">Password</p></th>
  <th><p style="text-align: center;">Update</p></th>
  </tr></thead><tbody>';

  while ($row = mysqli_fetch_array($result)){
    echo '<tr>
    <td><p style="text-align: center;">'.$row['userID'].'</p></td>
    <td><p style="text-align: center;">'.$row['userName'].'</p></td>
    <td><p style="text-align: center;">'.$row['gender'].'</p></td>
    <td><p style="text-align: center;">'.$row['mail'].'</p></td>
    <td><p style="text-align: center;">';
    if ($row["notification"] == "1") {
      echo "YES";
    } else {
      echo "No";
    }
    echo '</p></td>
    <td><p style="text-align: center;">'.$row['password'].'</p></td>
    <td><form>
    <form>
    <button type="submit" name="pid" value="'.$row["userID"].'" formaction="update_p.php"  formmethod= "POST" formtarget="iframe">update</button>
    </form>
    </form></td>
    </tr>';
  }

  echo '</tbody></table>';

  mysqli_close($conn);

  ?>

</div>		
</div>
</font></body>

</html>

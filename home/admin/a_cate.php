<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Category manager</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
  <style>
  body{ font: 14px sans-serif; }
  .wrapper{ width: 350px; padding: 20px; }
  ul {
    list-style-type: circle;
  }
</style>
</head>
<body>

  <div class="container">
    <h2>Category list</h2>
    <b style="color: red"><?php echo $_SESSION["rep"];
    $_SESSION["rep"] = " "; 
    ?>
  </b>
  <p>Type to search category</p>
  <form style='text-align: left;' action='c_add.php' target='_self' method="post">
    <input class="form-control" required name="cate" id="myInput" type="text" placeholder="Search..">
    <input type="submit" value="add a new Category">
  </form> 
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        
      </tr>
    </thead>
    <tbody id="myTable">
      <?php

      include("../../mysqli_connect.php");
      $sql = 'SELECT * FROM category';
      $result = mysqli_query($conn, $sql);

      if (!$sql) {
        die ('SQL Error: ' . mysqli_error($conn));
      }

      while ($row = mysqli_fetch_array($result)){
        echo '<tr><td><p style="text-align: left;">'.$row['cName'].'</p></td>';
      }

      echo '</tr>';

      mysqli_close($conn);

      ?>
    </tbody>
  </table>
  
</div>

<script>
  $(document).ready(function(){
    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>

</body>

</html>
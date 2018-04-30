<?php

session_start();

?>

<!DOCTYPE html>
<html>
<head>
  <title>Manger Page</title>
</head>
<style>
table {
  width: 100%;
}
caption {
  text-align: left;
}
td {
  text-align: center;
}
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>
<body>
  <h1 style="text-align: center;">
    <?php
    if ($_SESSION["utype"] == "Personal") {
      echo "Review and Comentray";
    } elseif ($_SESSION["utype"] == "Business") {
      echo "Game";
    }
    ?>
    Manger
  </h1>
  <br>
  <h3>
    <b style="color: red">
      <?php 
      echo $_SESSION["rep"];
      $_SESSION["rep"] = " "; ?>

    </b>
  </h3>
  <div>
    <?php
    if ($_SESSION["utype"] == "Personal") {
      include("r_c_manager.php");
    } elseif ($_SESSION["utype"] == "Business") {
      include("g_manager.php");
    }
    ?>
  </div>

</body>
</html>
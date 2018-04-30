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
  <h1 style="text-align: center;">Interesting information of Game and Game Company</h1>
  <br>
  <h3>
    <form action="g_no.php" method= "POST"> 
      The
      <select name="n_o" onchange="this.form.submit()">
        <option value="???" <?php if(isset($_SESSION["g"]) && $_SESSION["g"] == "???") echo "selected";?>>???</option>
        <option value="Newest" <?php if(isset($_SESSION["g"]) && $_SESSION["g"] == "Newest") echo "selected";?>>latest</option>
        <option value="Oldest" <?php if(isset($_SESSION["g"]) && $_SESSION["g"] == "Oldest") echo "selected";?>>first</option>
      </select>
      Game in our website is
      <?php
      if (isset($_SESSION["g"]) && $_SESSION["g"] != "???") {
        if ($_SESSION["nogame1"] == "yes") {
          echo "no game released yet";
        } else {
          
          foreach ($_SESSION["g_noNames"] as $name) {
            echo $name;
            echo ", ";
          }
          echo "and release date is ".$_SESSION["g_noTime"];
        }
      } else {
        echo "???";
      }
      ?>
      <br>
      <br>
      <br>
      <form action="g_no.php" method= "POST"> 
        The
        <select name="pop" onchange="this.form.submit()">
          <option value="???" <?php if(isset($_SESSION["p"]) && $_SESSION["p"] == "???") echo "selected";?>>???</option>
          <option value="Most" <?php if(isset($_SESSION["p"]) && $_SESSION["p"] == "Most") echo "selected";?>>most</option>
          <option value="Least" <?php if(isset($_SESSION["p"]) && $_SESSION["p"] == "Least") echo "selected";?>>least</option>
        </select>
        popular Game Company in our website is
        <?php
        if (isset($_SESSION["p"]) && $_SESSION["p"] != "???") {
          if ($_SESSION["nogame2"] == "yes") {
            echo "no game released yet";
          } else {
           foreach ($_SESSION["popsNames"] as $uname) {
            echo $uname;
            echo ", ";
          }
          echo "and popularity is ".$_SESSION["popv"];
        }
      } else {
        echo "???";
      }
      ?>
    </form>
    <p style="font-size: 15px">(pouplarity = total number of reviews for all games released by one Company / total number of games released by one Company)</p>
    <p style="font-size: 15px">(only compute this for Company who has released at leat one game)</p>

    <?php
    // generate form of popularity
    include("pop_form.php");
    ?>

  </h3>
</body>
</html>
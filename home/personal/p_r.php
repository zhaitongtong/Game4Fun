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
        <option value="???" selected>???</option>
        <option value="Newest">latest</option>
        <option value="Oldest">first</option>
      </select>
      Game in our website is ???
      <br>
      <br>
      <br>
      <form action="g_no.php" method= "POST"> 
        The
        <select name="pop" onchange="this.form.submit()">
          <option value="???" selected>???</option>
          <option value="Most" >most</option>
          <option value="Least">least</option>
        </select>
        popular Game Company in our website is ???
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
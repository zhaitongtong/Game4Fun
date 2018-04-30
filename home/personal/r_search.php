<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<style type="text/css">
</style>

<body>
  <div class="container">
  <h2>Search Reviews</h2>
  <p>find all reviews edit on specified date</p>
  <form class="form-inline" action="r_date.php" method="POST">
    <div class="form-group">
      <label for="date">date:</label>
      <input type="date" class="form-control" id="date" name="date" required>
    </div>
    <button type="submit" class="btn btn-default">search</button>
  </form>
</div>

</body>
</html>
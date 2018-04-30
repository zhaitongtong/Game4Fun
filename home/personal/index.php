<?php

session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Pesronal home page</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../../style/hp_style.css" />
</head>
<style>
h1 {
	color: blue;
	font-family: verdana;
	font-size: 300%;
}

iframe:focus { 
	outline: none;
}

iframe[seamless] {
	display: block;
}

.header-img
{
	z-index:9;
	width:97%;
	height:200px;
	position:absolute;
}

body {
    background-image: url("../pic/hp_bg.jpg");
}

</style>
<body>
	<div id="all">
	<div id="wrapper">

		<!--header-->
		<div class="row" id="header">
			<div class="col-xs-12">
				<img src="../../pic/gamer.jpg" class="img-responsive  header-img">
			</div>
		</div>
		<div id="banner">         
		</div>

		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand"  href="#">Game4fun</a>
				</div>
				<ul class="nav navbar-nav">
					<li><a href="p_info.php" target="iframe">Personal information</a></li>
					<li><a href="../game/gamepg.php" target="iframe">Games</a></li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Reviews
							<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="r_search.php" target="iframe">Search reviews</a></li>
								<li><a href="../manager/sample_manager.php" target="iframe">Manage reviews</a></li>
							</ul>
						</li>
						<li><a href="p_r.php" target="iframe">Report</a></li>
					</ul>
					<form class="navbar-form navbar-left" action="">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Search ...">
						</div>
						<button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
					</form>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="../../login/log_out.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
					</ul>
				</div>
			</nav>

			<div id="content_area">

				<iframe src="p_info.php" name ='iframe' style="border:none;" height="600" width="100%"></iframe>

			</div>

			<footer>
				<p style="text-align: center;">All rights reserved by Game4Fun Group</p>
			</footer>
		</div>
		</div>	
	</body>
	</html>
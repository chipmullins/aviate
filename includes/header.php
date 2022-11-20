<?php
require 'config/config.php';


if (isset($_SESSION['username'])) {
	$loginStatus = $_SESSION['username'];
	$userStatusQuery = mysqli_query($dbconnection, "SELECT * FROM users where username='$loginStatus'");
	$user = mysqli_fetch_array($userStatusQuery);
}
else {
	header("Location: register.php");
}

?>
<html>
	<head>
		<title>Aviate</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
		<script src="assets/js/bootstrap.js"></script>

		<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="assets/styling/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="assets/styling/style.css">
	</head>

	<body>


		<div class="topBar">
			<div class="logo">
				<a href="index.php">Aviate</a>

			</div>

			<nav>
				<a href="<?php echo $loginStatus; ?>">
					<?php echo $user['first_name']; ?>
				</a>

				<a href="index.php">
					<i class="fa fa-home fa-lg" aria-hidden="true"></i>
				</a>

				<a href="#">
					<i class="fa fa-comments fa-lg" aria-hidden="true"></i>
				</a>

				<a href="#">

					<i class="fa fa-address-book fa-lg" aria-hidden="true"></i>
				</a>

				<a href="#">
					<i class="fa fa-bullhorn fa-lg" aria-hidden="true"></i>

				</a>
				<a href="#">
					<i class="fa fa-sliders fa-lg" aria-hidden="true"></i>
				</a>

				

				<a href="includes/handlers/logout.php">
					<i class="fa fa-eject fa-lg" aria-hidden="true"></i>
				</a>

			</nav>



		</div>

		<div class="wrapper">


		
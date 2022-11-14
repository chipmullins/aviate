<?php

require 'config/config.php';

require 'includes/form_handlers/registration_handler.php';
require 'includes/form_handlers/login_handler.php';

?>
<html>
<head>

	<title>Welcome to Aviate</title>
	<link rel="stylesheet" type="text/css" href="assets/styling/login_styling.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="assets/js/register.js"></script>
</head>
<body>


	<?php

	if(isset($_POST['register_submit'])) {
		echo '
		<script>
		$(document).redy(function() {
			$("#loginDiv").hide();
			$("#regDiv").show();

			})
		</script>

		';
	}



	?>
	<div class="wrapper">
		<div class="formData">
			<div class="applicationHeader">
				<h1>Aviate</h1>
				Login or create a new account!
			</div>

			<div id="loginDiv">
				<form action="register.php" method="POST">
					<input type="email" name="login_emailAddress" placeholder="Email Address" value="<?php if(isset($_SESSION['login_emailAddress'])) {
						echo $_SESSION['login_emailAddress'];
					}
					?>" required>
					<br>
					<input type="password" name="login_password" placeholder="Password">
					<br>
					<?php if(in_array("Your login information was not correct.<br>", $errorCapture)) echo "Your login information was not correct.<br>"  ?>
					<input type="submit" name="user_login" value="Login"><br>

					<a href="#" id="register" class="register">New to Avite? Click here to create an account!</a>

					

				</form>
			</div>



			<div id="regDiv">
				<form action="register.php" method="POST">
					<input type="text" name="registration_firstName" placeholder="First Name"  value="<?php if(isset($_SESSION['registration_firstName'])) {
						echo $_SESSION['registration_firstName'];
					}
					?>" required>
					<br>
					<?php if(in_array("Your first name must be at least 2 characters and no greater than 25<br>", $errorCapture)) echo "Your first name must be at least 2 characters and no greater than 25<br>"; ?>


					<input type="text" name="registration_lastName" placeholder="Last Name" value="<?php if(isset($_SESSION['registration_lastName'])) {
						echo $_SESSION['registration_lastName'];
					}
					?>" required>
					<br>
					<?php if(in_array("Your last name must be at least 2 characters and no greater than 25<br>", $errorCapture)) echo "Your last name must be at least 2 characters and no greater than 25<br>"; ?>

					<input type="email" name="registration_emailAddress" placeholder="Email Address" value="<?php if(isset($_SESSION['registration_emailAddress'])) {
						echo $_SESSION['registration_emailAddress'];
					}
					?>" required>
					<br>

					<input type="email" name="registration_confirmEmail" placeholder="Confirm Email Address" value="<?php if(isset($_SESSION['registration_confirmEmail'])) {
						echo $_SESSION['registration_confirmEmail'];
					}
					?>" required>
					<br>
					<?php if(in_array("There is already an account with that email address.<br>", $errorCapture)) echo "There is already an account with that email address.<br>"; 
					else if(in_array("The email addresses you entered do not match.<br>", $errorCapture)) echo "The email addresses you entered do not match.<br>"; 
					else if(in_array("The email address you entered is not a valid format.<br>", $errorCapture)) echo "The email address you entered is not a valid format.<br>"; ?>

					<input type="password" name="registration_password" placeholder="Password" required>
					<br>
					

					<input type="password" name="registration_confirmPassword" placeholder="Confirm Password" required>
					<br>
					<?php if(in_array("Your password cannot contain any special characters.<br>", $errorCapture)) echo "Your password cannot contain any special characters.<br>"; 
					else if(in_array("Your password must be between 5 and 30 characters.<br>", $errorCapture)) echo "Your password must be between 5 and 30 characters.<br>";
					else if(in_array("The passwords you entered do not match.<br>", $errorCapture)) echo "The passwords you entered do not match.<br>"; ?>

					<input type="submit" name="register_submit" value="Register">
					<br>

					<?php if(in_array("<span style='color: #14C800'>Account Created!</span><br>", $errorCapture)) echo "<span style='color: #14C800'>Account Created!</span><br>";?>
					<a href="#" id="login" class="login">Already registered? Click here to create an account!</a>
				</form>
			</div>
		</div>
	</div>




</body>
</html>
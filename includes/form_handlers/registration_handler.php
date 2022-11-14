<?php

$firstName = "";
$lastName = "";
$email = "";
$confirmEmail = "";
$userPassword = "";
$confirmPassword = "";
$registrationDate = "";
$errorCapture = array();


if(isset($_POST['register_submit'])){

	$firstName = strip_tags($_POST['registration_firstName']);
	$firstName = str_replace(' ', '', $firstName);
	$firstName = ucfirst(strtolower($firstName));
	$_SESSION['registration_firstName'] = $firstName;

	$lastName = strip_tags($_POST['registration_lastName']);
	$lastName = str_replace(' ', '', $lastName);
	$lastName = ucfirst(strtolower($lastName));
	$_SESSION['registration_lastName'] = $firstName;

	$email = strip_tags($_POST['registration_emailAddress']);
	$email = str_replace(' ', '', $email);
	$email = ucfirst(strtolower($email));
	$_SESSION['registration_emailAddress'] = $email;

	$confirmEmail = strip_tags($_POST['registration_confirmEmail']);
	$confirmEmail = str_replace(' ', '', $confirmEmail);
	$confirmEmail = ucfirst(strtolower($confirmEmail));
	$_SESSION['registration_confirmEmail'] = $confirmEmail;

	$userPassword = strip_tags($_POST['registration_password']);
	$confirmPassword = strip_tags($_POST['registration_confirmPassword']);

	$registrationDate = date("Y-m-d");

	if($email == $confirmEmail) {
		if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$confirmEmail = filter_var($email, FILTER_VALIDATE_EMAIL);

			$verifyEmail = mysqli_query($dbconnection, "SELECT email from users WHERE email='$email'");

			$returnedResults = mysqli_num_rows($verifyEmail);

			if($returnedResults > 0) {
				array_push($errorCapture, "There is already an account with that email address.<br>");
			}
		}

		else {
			array_push($errorCapture, "The email address you entered is not a valid format.<br>");
		}

	}
	else {
		array_push($errorCapture, "The email addresses you entered do not match.<br>");
	}
	

	if(strlen($firstName) > 25 || strlen($firstName) < 2) {
		array_push($errorCapture, "Your first name must be at least 2 characters and no greater than 25<br>");
	}

	if(strlen($lastName) > 25 || strlen($lastName) < 2) {
		array_push($errorCapture, "Your last name must be at least 2 characters and no greater than 25<br>");
	
	}

	if($userPassword != $confirmPassword) {
		array_push($errorCapture, "The passwords you entered do not match.<br>");

	}
	else {
		if(preg_match('/[^A-Za-z0-9]/', $userPassword)) {
			array_push($errorCapture, "Your password cannot contain any special characters.<br>");
		}
	}

	if(strlen($userPassword) > 30 || strlen($userPassword) < 5) { 
		array_push($errorCapture, "Your password must be between 5 and 30 characters.<br>");
		
	}

	if(empty($errorCapture)) {
		$userPassword = md5($userPassword);  //Pasword encryption 

		$username = strtolower($firstName . "_" . $lastName);
		$verifyUsername = mysqli_query($dbconnection, "SELECT username FROM users WHERE username='$username'");

		$i = 0;
		while(mysqli_num_rows($verifyUsername) != 0) {
			$i++; //adds 1 to i
			$username = $username . "_" . $i;
			$verifyUsername = mysqli_query($dbconnection, "SELECT username FROM users WHERE username='$username'");
		}

		$randomSelection = rand(1,2);

		if($randomSelection == 1)
			$profilePhoto = "assets/images/profile_photos/defaults/head_emerald.png";
		else if($randomSelection == 2)
			$profilePhoto = "assets/images/profile_photos/defaults/head_red.png";


		$createQuery = mysqli_query($dbconnection, "INSERT INTO users VALUES('', '$firstName', '$lastName', '$username', '$email', '$userPassword', '$registrationDate', '$profilePhoto', '0', '0', 'no', ',')");


		array_push($errorCapture, "<span style='color: #14C800'>Account Created!</span><br>");

		$_SESSION['registration_firstName'] = "";
		$_SESSION['registration_lastName'] = "";
		$_SESSION['registration_emailAddress'] = "";
		$_SESSION['registration_confirmEmail'] = "";
	}


}




?>
<?php


if(isset($_POST['user_login'])) {
	$userEmailAddress = filter_var($_POST['login_emailAddress'], FILTER_SANITIZE_EMAIL);

	$_SESSION['login_emailAddress'] = $userEmailAddress;

	$userPassword = md5($_POST['login_password']);

	$databaseVerify = mysqli_query($dbconnection, "SELECT * FROM users WHERE email='$userEmailAddress' AND password='$userPassword'");

	$loginVerification = mysqli_num_rows($databaseVerify);

	if($loginVerification == 1) {
		$dbRow = mysqli_fetch_array($databaseVerify);
		$username = $dbRow['username'];

		$checkPreviousAcct = mysqli_query($dbconnection, "SELECT * FROM users WHERE email='$userEmailAddress' AND user_closed='yes'");
		if(mysqli_num_rows($checkPreviousAcct) == 1) {
			$accountReinstate = mysqli_query($dbconnection, "UPDATE users SET user_closed='no' WHERE email='$userEmailAddress'");
		}

		$_SESSION['username'] = $username;

		header("Location: index.php");
		exit();
	}
	else {
		array_push($errorCapture, "Your login information was not correct.<br>");
	}
}
?>
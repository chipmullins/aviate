<?php
ob_start();
session_start();

$timezoneSet = date_default_timezone_set("America/New_York");
$dbconnection = mysqli_connect("localhost", "aviateso_main", "SaltLake11!", "aviateso_social");

if(mysqli_connect_errno()) {
	echo "Failed to connect: " . mysqli_connect_errno();
}

?>

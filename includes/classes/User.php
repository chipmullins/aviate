<?php
class User {
	private $user;
	private $connection;

	public function __construct($connection, $user) {
		$this->connection = $connection;
		$userStatusQuery = mysqli_query($connection, "SELECT * FROM users WHERE username='$user'");
		$this->user = mysqli_fetch_array($userStatusQuery);
	}

	public function getUsername() {
		return $this->user['username'];
	}

	public function getPostQuantity() {
		$username = $this->user['username'];
		$query = mysqli_query($this->connection, "SELECT posts_quantity FROM users where username='$username'");
		$row = mysqli_fetch_array($query);
		return $row['posts_quantity'];
	}

	public function getFirstAndLastName() {
		$username = $this->user['username'];
		$query = mysqli_query($this->connection, "SELECT first_name, last_name FROM users WHERE username='$username'");
		$row = mysqli_fetch_array($query);
		return $row['first_name'] . " " . $row['last_name'];
	}
}
?>
<?php
class Post {
	private $user_object;
	private $connection;

	public function __construct($connection, $user) {
		$this->connection = $connection;
		$this->user_object = new User($connection, $user);
	}

	public function createPost($body, $user_to) {
		$body = strip_tags($body); //removes html tags 
		$body = mysqli_real_escape_string($this->connection, $body);
		$checkIfEmpty = preg_replace('/\s+/', '', $body); //Deltes all spaces 

		if($checkIfEmpty != "") {

			$createdDate = date("Y-m-d H:i:s");
			$added_by = $this->user_object->getUsername();

			if($user_to == $added_by) {
				$user_to = "none";
			}
			
			$query = mysqli_query($this->connection, "INSERT INTO posts VALUES('', '$body', '$added_by', '$user_to', '$createdDate', 'no', 'no', '0')");

			$returned_id = mysqli_insert_id($this->connection);

			$postQuantity = $this->user_object->getPostQuantity();
			$postQuantity++;
			$updateQuery = mysqli_query($this->connection, "UPDATE users SET posts_quantity='$postQuantity' WHERE username='$added_by'");

		}
	}
}
?>
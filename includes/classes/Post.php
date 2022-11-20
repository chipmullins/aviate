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

		$body = str_replace('\r\n', '\n', $body);
		$body = nl2br($body);
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

	public function getPosts() {
		$str = "";
		$data = mysqli_query($this->connection, "SELECT * FROM posts WHERE deleted='no' ORDER BY id DESC");

		while($row = mysqli_fetch_array($data)) {
			$id = $row['id'];
			$postContent = $row['body'];
			$posted_by = $row['added_by'];
			$dateTimePosted = $row['date_added'];

			if($row['user_to'] == "none") {
				$user_to = "";
			}
			else {
				$userObject = new User($connection, $row['user_to']);
				$user_to_name = $userObject->getFirstAndLastName();
				$user_to = "to <a href='" . $row['user_to'] ."'>" . $user_to_name . "</a>";
				
			}

			$addedByObject = new User($this->connection, $posted_by);
			if($addedByObject->isClosed()) {
				continue;
			}
			
				$userInformationQuery = mysqli_query($this->connection, "SELECT first_name, last_name, profile_photo FROM users WHERE username='$posted_by'");
				$userRow = mysqli_fetch_array($userInformationQuery);
				$firstName = $userRow['first_name'];
				$lastName = $userRow['last_name'];
				$profilePhoto = $userRow['profile_photo'];


				$currentDateTime = date("Y-m-d H:i:s");
				$startDate = new DateTime($dateTimePosted); //Time of post
				$endDate = new DateTime($currentDateTime); //Current time
				$interval = $startDate->diff($endDate); //Difference between dates 
				if($interval->y >= 1) {
					if($interval == 1) {
						$time_message = $interval->y . " year ago"; //1 year ago
					}
					else {
						$time_message = $interval->y . " years ago"; //1+ year ago
					}
				}
				else if ($interval-> m >= 1) {
					if($interval->d == 0) {
						$days = " ago";
					}
					else if($interval->d == 1) {
						$days = $interval->d . " day ago";
					}
					else {
						$days = $interval->d . " days ago";
					}


					if($interval->m == 1) {
						$time_message = $interval->m . " month". $days;
					}
					else {
						$time_message = $interval->m . " months". $days;
					}

				}
				else if($interval->d >= 1) {
					if($interval->d == 1) {
						$time_message = "Yesterday";
					}
					else {
						$time_message = $interval->d . " days ago";
					}
				}
				else if($interval->h >= 1) {
					if($interval->h == 1) {
						$time_message = $interval->h . " hour ago";
					}
					else {
						$time_message = $interval->h . " hours ago";
					}
				}
				else if($interval->i >= 1) {
					if($interval->i == 1) {
						$time_message = $interval->i . " minute ago";
					}
					else {
						$time_message = $interval->i . " minutes ago";
					}
				}
				else {
					if($interval->s < 30) {
						$time_message = "Just now";
					}
					else {
						$time_message = $interval->s . " seconds ago";
					}
				}

				$str .= "<div class='statusPost'>
							<div class='postProfilePhoto'>
								<img src='$profilePhoto' width='50'>
							</div>

							<div class='posted_by' style='color:#ACACAC;'>
								<a href='$posted_by'> $firstName $lastName </a> $user_to &nbsp;&nbsp;&nbsp;&nbsp;$time_message
							</div>
							<div id='post_body'>
								$postContent
								<br>
							</div>

						</div>
						<hr>";


			

			} //End while loop

		echo $str;
				
	}
}
?>
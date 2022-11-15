<?php
include("includes/header.php");
include("includes/classes/User.php");
include("includes/classes/Post.php");



if(isset($_POST['post'])){
	$newPost = new Post($dbconnection, $loginStatus);
	$newPost->createPost($_POST['postData'], 'none');
}
 ?>
	<div class="userDetails column">
		<a href="<?php echo $loginStatus; ?>"> <img src="<?php echo $user['profile_photo']; ?>"> </a>

		<div class="leftRightUserDetails">

			<a href="<?php echo $loginStatus; ?>">
			<?php
			echo $user['first_name'] . " " . $user['last_name'];

			?>
			</a>
			<br>
			<?php echo "Posts: " . $user['posts_quantity'] ."<br>";
			echo "Likes: " . $user['like_quantity'];
			?>
		</div>


	</div>
	<div class="mainFeed column">
		<form class="postForm" action="index.php" method="POST">
			<textarea name="postData" id="post_text" placeholder="What do you want to post?"></textarea>
			<input type="submit" name="post" id="postButton" value="Post">
			<hr>

		</form>

		<?php 
		$userObject = new User($dbconnection, $loginStatus);
		echo $userObject->getFirstAndLastName();

		?>
	</div>

	</div>

	</body>




</html>



<?php
require_once("../includes/config.php");
require_once("../includes/classes/Comment.php");
require_once("../includes/classes/User.php");

$videoId = $_POST["videoId"];
$commentId = $_POST["commentId"];

if (!User::isLoggedIn()) {
	$username = "signedOut";
}
else {
	$username = $_SESSION["userLoggedIn"];
}

$userLoggedInObj = new User($con, $username);
$comment = new Comment($con, $commentId, $userLoggedInObj, $videoId);

echo $comment->getReplies();

?>
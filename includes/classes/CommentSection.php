<?php
class CommentSection {
	private $con, $video, $userLoggedInObj;

	public function __construct($con, $video, $userLoggedInObj) {
		$this->con = $con;
		$this->video = $video;
		$this->userLoggedInObj = $userLoggedInObj;
	}

	public function create() {
		return $this->createCommentSection();
	}

	private function createCommentSection() {
		$numComments = $this->video->getNumberOfComments();
		$postedBy = $this->userLoggedInObj->getUsername();
		$videoId = $this->video->getId();

		$profileButton = ButtonProvider::createUserProfileButton($this->con, $postedBy);
		$commentAction = "postComment(this, \"$postedBy\", $videoId, null, \"comments\")";
		$commentButton = ButtonProvider::createButton("COMMENT", null, $commentAction, "postComment");

		// Get comments html
		$comments = $this->video->getComments();
		$commentItems = "";
		foreach ($comments as $comment) {
			$commentItems .= $comment->create();
		}

		if (User::isLoggedIn()) {
			return "<div class='commentSection'>
					<div class='header'>
						<span class='commentCount'>$numComments Comments</span>

						<div class='commentForm'>
							$profileButton
							<textarea class='commentBodyClass' placeholder='Add a public comment'></textarea>
							$commentButton
						</div>
					</div>

					<div class='comments'>
						$commentItems
					</div>
				</div>";
		}
		else {
			return "<div class='commentSection'>
					<div class='header'>
						<span class='commentCount'>$numComments Comments</span>

						<div class='customCommentBox'>
							<span>Please <a href='signin.php'>login</a> or <a href='signup.php'>register</a> to post a comment</span>
						</div>
					</div>

					<div class='comments'>
						$commentItems
					</div>
				</div>";
		}

		
	}
	
}
?>
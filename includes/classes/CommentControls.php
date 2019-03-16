<?php
require_once("ButtonProvider.php");
class CommentControls {
	private $con, $comment, $userLoggedInObj;

	public function __construct($con, $comment, $userLoggedInObj) {
		$this->con = $con;
		$this->comment = $comment;
		$this->userLoggedInObj = $userLoggedInObj;
	}

	public function create() {
		$replyButton = $this->createReplyButton();
		$likesCount = $this->createLikesCount();
		$likeButton = $this->createLikeButton();
		$dislikeButton = $this->createDislikeButton();
		$replySection = $this->createReplySection();

		return "<div class='controls'>
					$replyButton
					$likesCount
					$likeButton
					$dislikeButton
				</div>
				$replySection";
	}

	private function createReplyButton() {
		$text = "REPLY";
		$action = "toggleReply(this)";

		return ButtonProvider::createButton($text, null, $action, null);
	}

	private function createLikesCount() {
		$text = $this->comment->getLikes();

		if($text == 0) $text = "";

		return "<span class='likesCount'>$text</span>";
	}

	private function createReplySection() {
		$postedBy = $this->userLoggedInObj->getUsername();
		$videoId = $this->comment->getVideoId();
		$commentId = $this->comment->getId();

		$profileButton = ButtonProvider::createUserProfileButton($this->con, $postedBy);

		$cancelButtonAction = "toggleReply(this)";
		$cancelButton = ButtonProvider::createButton("Cancel", null, $cancelButtonAction, "cancelComment");

		$postButtonAction = "postComment(this, \"$postedBy\", $videoId, $commentId, \"repliesSection\")";
		$postButton = ButtonProvider::createButton("Reply", null, $postButtonAction, "postComment");

		// Get comments html
		return "<div class='commentForm hidden'>
					$profileButton
					<textarea class='commentBodyClass' placeholder='Add a public comment'></textarea>
					$cancelButton
					$postButton
				</div>";
	}

	private function createLikeButton() {
		$commentId = $this->comment->getId();
		$videoId = $this->comment->getVideoId();
		$action = "likeComment($commentId, this, $videoId)";
		$class = "likeButton";

		$imageSrc = "assets/images/icons/thumb-up.png";

		// Change button img if comment has been liked already
		if ($this->comment->wasLikedBy()) {
			$imageSrc = "assets/images/icons/thumb-up-active.png";
		}

		return ButtonProvider::createButton("", $imageSrc, $action, $class);
	}

	private function createDislikeButton() {
		$commentId = $this->comment->getId();
		$videoId = $this->comment->getVideoId();
		$action = "dislikeComment($commentId, this, $videoId)";
		$class = "dislikeButton";

		$imageSrc = "assets/images/icons/thumb-down.png";

		// Change button img if comment has been disliked already
		if ($this->comment->wasDislikedBy()) {
			$imageSrc = "assets/images/icons/thumb-down-active.png";
		}

		return ButtonProvider::createButton("", $imageSrc, $action, $class);
	}
}
?>
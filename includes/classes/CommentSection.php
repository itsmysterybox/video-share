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

	}
	
}
?>
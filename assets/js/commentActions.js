function postComment(button, postedBy, videoId, replyTo, containerClass) {
	var textarea = $(button).siblings("textarea");
	var commentText = textarea.val();
	textarea.val("");

	if (commentText) {

	}
	else {
		alert("You can't post an empty comment");
	}
}
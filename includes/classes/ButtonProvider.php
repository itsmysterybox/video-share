<?php
class ButtonProvider {

	public static $signInFunction = "notSignedIn()";

	public static function createLink($link) {
		return User::isLoggedIn() ? $link : ButtonProvider::$signInFunction;
	}

	public static function createButton($text, $imageSrc, $action, $class) {
		$image = ($imageSrc == null) ? "" : "<img src='$imageSrc'>";

		// Change action if needed
		$action = ButtonProvider::createLink($action);

		return "<button class='$class' onClick='$action'>
					$image
					<span class='text'>$text</span>
				</button>";
	}
}
?>
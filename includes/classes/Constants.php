<?php
class Constants {
	public static $firstNameCharacters = "First name must be between 2 and 25 characters";
	public static $lastNameCharacters = "Last name must be between 2 and 25 characters";
	public static $usernameCharacters = "Username must be between 5 and 25 characters";
	public static $usernameTaken = "This username already exists";
	public static $emailsDoNotMatch = "Your emails do not match";
	public static $emailInvalid = "Please enter a valid email address";
	public static $emailTaken = "This email is already in use";
	public static $passwordsDoNotMatch = "Your passwords do not match";
	public static $passwordNotAlphanumeric = "Your password can only contain letters and numbers";
	public static $passwordLength = "Password must be between 5 and 30 characters";

	public static $loginFailed = "Your username or password was incorrect";

	public static $passwordIncorrect = "Incorrect password";
}
?>
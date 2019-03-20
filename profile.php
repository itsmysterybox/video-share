<?php
require_once("includes/header.php");
require_once("includes/classes/ProfileGenerator.php");

if (isset($_GET["username"])) {
	$profileUsername = $_GET["username"];
}
else {
	echo "Channel not found";
	exit();
}
$ProfileGenerator = new ProfileGenerator($con, $userLoggedInObj, $profileUsername);
echo $ProfileGenerator->create();
?>

<!-- <div>
	
</div> -->




<?php require_once("includes/footer.php"); ?>
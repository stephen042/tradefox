<?php require_once("includes/initialize.php"); ?>
<?php
	// Do the logout processes and redirect to login page.
	after_successful_logout();
	header("Location: ../login.php");
    exit();
?>
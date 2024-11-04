<?php ini_set("date.timezone", "Africa/Lagos"); ?>
<?php require_once("includes/initialize.php"); ?>
<?php before_every_protected_page(); ?>
<?php
if(isset($_GET['id'])){
    $subscription_id = $_GET['id'];
  	$conn->beginTransaction();
  	try {
  	    $conn->query("DELETE FROM subscriptions WHERE id='$subscription_id'");
  	    $conn->commit();
  	    set_message('<div class="alert alert-success"><i class="fa fa-info-circle"></i> Subscription was terminated successfully</div>');
	  	redirect_to("subscriptions.php");
  	} catch(Exception $e){
  	    $conn->rollBack();
  	    set_message('<div class="alert alert-danger"><i class="fa fa-info-circle"></i> An error occurred. Try again!</div>');
	  	redirect_to("subscriptions.php");
  	}
	  
} else {
   	set_message('<div class="alert alert-danger"><i class="fa fa-info-circle"></i> An error occurred. Try again!</div>');
	redirect_to("subscriptions.php");
}
?>
<?php ini_set("date.timezone", "Africa/Lagos"); ?>
<?php require_once("includes/initialize.php"); ?>
<?php before_every_protected_page(); ?>
<?php
 
    
  	$conn->beginTransaction();
  	try {
  	    
  	    $user = $_POST['user_id'];
  	    $balance = $_POST['balance'];
  	    $amount = $_POST['amount'];
  	    $duration = intval($_POST['duration']) * 60;
  	    $inc = $amount / $duration;
  	    $status = 1;

  	    $insert_stmt = $conn->prepare('INSERT INTO trading (user_id,asset,amount,count,inc,status) VALUES (:uid, :asset, :amount,:count,:inc,:status)');
                    $insert_stmt->bindParam(':uid', $user); 
                    $insert_stmt->bindParam(':asset', $balance);
                    $insert_stmt->bindParam(':amount', $amount);
                    $insert_stmt->bindParam(':count', $duration); 
                    $insert_stmt->bindParam(':inc', $inc); 
                    $insert_stmt->bindParam(':status', $status);
                    $insert_stmt->execute();
                    $conn->commit();
  	    
  	    
  	    set_message('<div class="alert alert-success"><i class="fa fa-info-circle"></i> Auto trading was created successfully</div>');
	  	redirect_to("trading.php");
  	} catch(Exception $e){
  	    $conn->rollBack();
  	    set_message('<div class="alert alert-danger"><i class="fa fa-info-circle"></i> '.$e->getMessage().'!</div>');
	  	redirect_to("trading.php");
  	}
	 
?>
<?php ini_set("date.timezone", "Africa/Lagos"); ?>
<?php require_once("includes/initialize.php"); ?>
<?php before_every_protected_page(); ?>
<?php
if($_GET['uid']){
    $user_id = $_GET['uid'];
    
    $conn->beginTransaction();
    try {
        $identityQuery = $conn->query("SELECT * FROM account WHERE user_id = '$user_id' LIMIT 1");
        $identityRow = $identityQuery->fetch();

        $depositQuery = $conn->query("SELECT * FROM deposit WHERE user_id = '$user_id' LIMIT 1");
        $depositRow = $depositQuery->fetch();

        if($identityRow['filename'] != ''){
            $idPath = '../uploads/'.$identityRow['filename'];
            if(file_exists($idPath)){
                unlink($idPath);
            }
        }
        
        if($depositRow['payment_verify'] != ''){
            $depositPath = '../uploads/deposit/'.$depositRow['payment_verify'];
            if(file_exists($depositPath)){
                unlink($depositPath);
            }
        }
        $conn->query("DELETE FROM activity_log WHERE user_id='$user_id'");
        $conn->query("DELETE FROM subscriptions WHERE user_id='$user_id'");
        $conn->query("DELETE FROM account WHERE user_id='$user_id'");
        $conn->query("DELETE FROM notification WHERE user_id='$user_id'");
        $conn->query("DELETE FROM deposit WHERE user_id='$user_id'");
        $conn->query("DELETE FROM trade_history WHERE user_id='$user_id'");
        $conn->query("DELETE FROM withdrawal WHERE user_id='$user_id'");
        $conn->query("DELETE FROM users WHERE id='$user_id'");
        $conn->commit();
        set_message('<div class="alert alert-success"><i class="fa fa-info-circle"></i> User was successful deleted</div>');
        redirect_to('users.php');
    } catch(Exception $e){
        $conn->rollBack();
        set_message('<div class="alert alert-danger"><i class="fa fa-info-circle"></i> An error occurred while deleting user. Please try again.</div>');
        redirect_to('users.php');
    }

} else {
   set_message('<div class="alert alert-danger"><i class="fa fa-info-circle"></i> An error occurred. Try again!</div>');
   redirect_to("users.php");
}
?>
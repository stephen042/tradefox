<?php ini_set("date.timezone", "Africa/Lagos"); ?>
<?php require_once("includes/initialize.php"); ?>
<?php before_every_protected_page(); ?>
<?php $user = $_SESSION['user_id']; 
    $get_user = $conn->query("SELECT * FROM users WHERE id = '$user' LIMIT 1");
    $user_row = $get_user->fetch();

    $acct_stmt = $conn->query("SELECT * FROM account WHERE user_id = '$user' LIMIT 1");
    $acct_row = $acct_stmt->fetch();
    $accountID = $acct_row['id'];
?>
<?php
if(isset($_POST['demoupdate'])){
  if(request_is_post() && request_is_same_domain()) {
    $amount = strip_tags($_POST['amount']);
  {
        $conn->beginTransaction();
        try {
            
            $new_balance = $acct_row['demo_bal'] + $amount;
            $updateQuery = $conn->query("UPDATE account SET demo_bal = '$new_balance' WHERE id = '$accountID'");
            $updateQuery->execute();

            $conn->commit();
            
            redirect_to("demo.php");

            } 
        catch (ErrorException $e) {
            $conn->rollBack();
            set_message('<div class="alert alert-danger">
                <i class="fa fa-info-circle"></i> An error occurred, please try again!
            </div>');
            redirect_to("demo.php");
        }
    }       
  } // End of request_is_post() && request_is_same_domain()
} // End of $_POST['withdraw'] 
?>
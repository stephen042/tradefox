<?php ini_set("date.timezone", "Africa/Lagos"); ?>
<?php require_once("includes/initialize.php"); ?>
<?php before_every_protected_page(); ?>
<?php 
    if(isset($_GET['id'])){
          $withdrawal_id = $_GET['id'];  

          $withdrawalQuery = $conn->query("SELECT * FROM withdrawal WHERE id = '$withdrawal_id' LIMIT 1");
          $withdrawalQuery->execute();
          $withdrawalRow = $withdrawalQuery->fetch();
          $amount = $withdrawalRow['amount'];
          $user_id = $withdrawalRow['user_id'];

          $accountQuery = $conn->query("SELECT * FROM account WHERE user_id = '$user_id' LIMIT 1");
          $accountQuery->execute();
          $accountRow = $accountQuery->fetch();
          $account_id = $accountRow['id'];
          $currentBalance = $accountRow['account_balance'];

          $newBalance = $amount + $currentBalance;
          
          $conn->beginTransaction();
          try {
              $conn->query("DELETE FROM withdrawal WHERE id = '$withdrawal_id'");
              $updateQuery = $conn->prepare("UPDATE account SET account_balance =:nbal WHERE id =:id");
              $updateQuery->bindParam(':nbal', $newBalance);
              $updateQuery->bindParam(':id', $account_id);
              $updateQuery->execute();
              $conn->commit();
              set_message('<div class="alert alert-success"><i class="fa fa-info-circle"></i> Withdrawal request was successfully deleted</div>');
              redirect_to("withdrawals.php");
          } catch(ErrorException $e) {
             $conn->rollBack();
             set_message('<div class="alert alert-danger"><i class="fa fa-info-circle"></i> Operation Failed. Try again!</div>');
             redirect_to("withdrawals.php");
          }
           
    } else {
        set_message('<div class="alert alert-danger"><i class="fa fa-info-circle"></i> Invalid Request. Try again!</div>');
        redirect_to("withdrawals.php");
    }
?>
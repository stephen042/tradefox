<?php require_once("includes/initialize.php"); ?>
<?php before_every_protected_page(); ?>
<?php 

  if(isset($_POST['mine-update'])){
    if(request_is_post() && request_is_same_domain()) {

      $mbtc = $_POST['mbtc'];
      $meth = $_POST['meth'];
      $mltc = $_POST['mltc'];
      $mxrp = $_POST['mxrp'];
      $mxmr = $_POST['mxmr'];
      $mrise = $_POST['mrise'];
      $mdash = $_POST['mdash'];
      $mbts = $_POST['mbts'];
      $id = $_POST['id'];  

      if(!has_presence($mbtc) || !has_presence($meth) || !has_presence($mltc) || !has_presence($mxrp) || !has_presence($mrise) || !has_presence($mdash) || !has_presence($mbts) ) {
            set_message('<div class="alert alert-danger"><i class="fa fa-info-circle"></i> <b>All fields are required</b></div>');
      } else { 
          $conn->beginTransaction();
          try {
              $update_stmt = $conn->prepare("UPDATE account SET btc =:btc, eth =:eth, ltc =:ltc, xrp =:xrp, xmr =:xmr, rise =:rise, bts =:bts, dash =:dash  WHERE id =:id");
              $update_stmt->bindParam(':eth', $meth);
              $update_stmt->bindParam(':btc', $mbtc);
              $update_stmt->bindParam(':ltc', $mltc);
              $update_stmt->bindParam(':xrp', $mxrp);
              $update_stmt->bindParam(':xmr', $mxmr);
              $update_stmt->bindParam(':rise', $mrise);
              $update_stmt->bindParam(':dash', $mdash);
              $update_stmt->bindParam(':bts', $mbts);
              $update_stmt->bindParam(':id', $id);
              $update_stmt->execute();
              $conn->commit();

              set_message('<div class="alert alert-success"><i class="fa fa-info-circle"></i> <b>Balance was updated successfully</b></div>');
              redirect_to("account.php");

          } catch (Exception $e) {
              $conn->rollBack();
              set_message('<div class="alert alert-danger"><i class="fa fa-times"></i> <b>Unable to Update Balance. Try again!</b></div>');
              redirect_to("account.php");
          }
            
      } // Validation Check      
    } // End of request_is_post() && request_is_same_domain()
  }


  if(isset($_POST['btn-update'])){
  if(request_is_post() && request_is_same_domain()) {
     
      $account_balance = $_POST['account_balance'];
      $bonus = $_POST['bonus']; 
      $eth = $_POST['eth']; 
      $btc = $_POST['btc']; 
      $bonus = $_POST['bonus']; 
      $id = $_POST['id'];  

      if(!has_presence($account_balance) || !has_presence($bonus)) {
            set_message('<div class="alert alert-danger"><i class="fa fa-info-circle"></i> <b>All fields are required</b></div>');
      } else { 
          $conn->beginTransaction();
          try {
              $update_stmt = $conn->prepare("UPDATE account SET eth_balance =:eth, btc_balance =:btc, account_balance =:bal, bonus =:bonus WHERE id =:id");
              $update_stmt->bindParam(':eth', $eth);
              $update_stmt->bindParam(':btc', $btc);
              $update_stmt->bindParam(':bal', $account_balance);
              $update_stmt->bindParam(':bonus', $bonus);
              $update_stmt->bindParam(':id', $id);
              $update_stmt->execute();
              $conn->commit();

              set_message('<div class="alert alert-success"><i class="fa fa-info-circle"></i> <b>Balance was updated successfully</b></div>');
              redirect_to("account.php");

          } catch (Exception $e) {
              $conn->rollBack();
              set_message('<div class="alert alert-danger"><i class="fa fa-times"></i> <b>Unable to Update Balance. Try again!</b></div>');
              redirect_to("account.php");
          }
            
      } // Validation Check      
    } // End of request_is_post() && request_is_same_domain()
  } // End of $_POST['update']
?>

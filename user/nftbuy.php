<?php ini_set("date.timezone", "Africa/Lagos"); ?>
<?php require_once("includes/initialize.php"); ?>
<?php before_every_protected_page(); ?>
<?php  
  if(isset($_POST['buynow'])){
    if(request_is_post() && request_is_same_domain()) {
      // retrieve the values submitted via the form
      $user = $_SESSION['user_id']; 
      $price = strip_tags($_POST['price']);
      $nftt = strip_tags($_POST['nftt']);
      $nft_id = strip_tags($_POST['nft_id']);
      

      $acct_stmt = $conn->query("SELECT * FROM account WHERE user_id = '$user' LIMIT 1");
      $acct_row = $acct_stmt->fetch();
      $accountId = $acct_row['id'];
      
      if($price > $acct_row['account_balance']) {
          set_message('
          <script>
            Swal.fire(
              "Insufficient Balance",
              "Kindly fund your account to buy this Nft",
              "warning"
            );
          </script>
          ');
          redirect_to("nft.php");
      } else {
          
          $conn->beginTransaction();
          try{
           //	$trade_stmt = $conn->prepare("INSERT INTO trade_history (user_id, trade_type, currency_pair, lot_size, entry_price, stop_loss, take_profit, trade_action, created) VALUES (:uid, :trade_type, :currency_pair, :lot_size, :entry_price, :stop_loss, :take_profit, :trade_action, :created)");
          // 	$trade_stmt->bindParam(':uid', $user);
          // 	$trade_stmt->bindParam(':trade_type', $trade_type);
          //  $trade_stmt->bindParam(':currency_pair', $currency_pair);
           // $trade_stmt->bindParam(':lot_size', $lot_size);
          //  $trade_stmt->bindParam(':entry_price', $entry_price);
          //  $trade_stmt->bindParam(':stop_loss', $stop_loss);
          //  $trade_stmt->bindParam(':take_profit', $take_profit);
          // 	$trade_stmt->bindParam(':trade_action', $trade_action);
         //  	$trade_stmt->bindParam(':created', $created);
          // 	$trade_stmt->execute();
          // 	$last_id = $conn->lastInsertId();

	            $user_nft = $conn->prepare("INSERT INTO user_nft (user_id, nft_id) VALUES (:user_id, :nft_id)");
           	    $user_nft->bindParam(':user_id', $user);
           	    $user_nft->bindParam(':nft_id', $nft_id);
                    $user_nft->execute();
          
            $new_balance = $acct_row['account_balance'] - $price;
            $update_balance = $conn->prepare("UPDATE account SET account_balance = :bal WHERE id = :aid");
            $update_balance->bindParam(':bal', $new_balance);
            $update_balance->bindParam(':aid', $accountId);
            $update_balance->execute();

            $conn->commit();
            
            set_message('<script>
              Swal.fire({
                  title : "Nft Purchased",
                  text : "Your just purchased '.$nftt.', This rear item now belongs to you.",
                  type : "success"
              }).then(function() {
                  window.location.replace("nft.php");
              });</script>');
              redirect_to("nft.php");
        
          } catch (Exception $e) {
             
      		    $conn->rollBack();
              set_message('
              <script>
                Swal.fire(
                  "Error",
                  "An error occurred. Please try again",
                  "warning"
                );
              </script>
              ');
              redirect_to("nft.php");
      		}
      }
    }
  }
?>
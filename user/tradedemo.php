<?php ini_set("date.timezone", "Africa/Lagos"); ?>
<?php require_once("includes/initialize.php"); ?>
<?php before_every_protected_page(); ?>
<?php  
  if(isset($_POST['trade'])){
    if(request_is_post() && request_is_same_domain()) {
      // retrieve the values submitted via the form
      $user = $_SESSION['user_id']; 
      $trade_type = strip_tags($_POST['trade_type']);
      $currency_pair = strip_tags($_POST['currency_pair']);
      $lot_size = strip_tags($_POST['lot_size']);
      $entry_price = strip_tags($_POST['entry_price']);
      $stop_loss = strip_tags($_POST['stop_loss']);
      $take_profit = strip_tags($_POST['take_profit']);
      $trade_action = strip_tags($_POST['trade_action']);
      $created = date("Y-m-d H:i:s");

      $acct_stmt = $conn->query("SELECT * FROM account WHERE user_id = '$user' LIMIT 1");
      $acct_row = $acct_stmt->fetch();
      $accountId = $acct_row['id'];
      
      if($entry_price > $acct_row['demo_bal'] || $entry_price <= 0) {
          set_message('
          <script>
            Swal.fire(
              "Insufficient Demo Balance",
              "Kindly fund demo account to execute trade",
              "warning"
            );
          </script>
          ');
          redirect_to("demo.php");
      } else {
          
          $conn->beginTransaction();
          try{
              
              
           	$trade_stmt = $conn->prepare("INSERT INTO demo_history (user_id, trade_type, currency_pair, lot_size, entry_price, stop_loss, take_profit, trade_action, created) VALUES (:uid, :trade_type, :currency_pair, :lot_size, :entry_price, :stop_loss, :take_profit, :trade_action, :created)");
           	$trade_stmt->bindParam(':uid', $user);
           	$trade_stmt->bindParam(':trade_type', $trade_type);
            $trade_stmt->bindParam(':currency_pair', $currency_pair);
            $trade_stmt->bindParam(':lot_size', $lot_size);
            $trade_stmt->bindParam(':entry_price', $entry_price);
            $trade_stmt->bindParam(':stop_loss', $stop_loss);
            $trade_stmt->bindParam(':take_profit', $take_profit);
           	$trade_stmt->bindParam(':trade_action', $trade_action);
           	$trade_stmt->bindParam(':created', $created);
           	$trade_stmt->execute();
           	$last_id = $conn->lastInsertId();

            $new_balance = $acct_row['demo_bal'] + $entry_price/100;
            $update_balance = $conn->prepare("UPDATE account SET demo_bal = :bal WHERE id = :aid");
            $update_balance->bindParam(':bal', $new_balance);
            $update_balance->bindParam(':aid', $accountId);
            $update_balance->execute();

            $conn->commit();
            
            set_message('<script>
              Swal.fire({
                  title : "Trade Won",
                  text : "Your Demo Trade of $'.$entry_price.' Won",
                  type : "success"
              }).then(function() {
                  window.location.replace("demo.php");
              });</script>');
              redirect_to("demo.php");
        
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
              redirect_to("demo.php");
      		}
      }
    }
  }
?>
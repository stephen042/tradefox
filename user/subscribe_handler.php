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
if(isset($_POST['subscribe'])){
  if(request_is_post() && request_is_same_domain()) {
      $plan_id = strip_tags($_POST['plan_id']);
      $amount = strip_tags($_POST['amount']);

      $package_query = $conn->query("SELECT * FROM packages WHERE id = '$plan_id' LIMIT 1");
      $package_row = $package_query->fetch();
      $plan_name = $package_row['name'];
      $plan_days = $package_row['days'];
      $minimum_deposit = $package_row['minimum_deposit'];
      $created = date('Y-m-d H:i:s');
    
    if(!has_presence($amount)) {
        set_message('
          <script>
            Swal.fire(
              "Invalid Amount",
              "Amount is required",
              "warning"
            );
          </script>
        ');
        redirect_to("subscribe.php");
    } elseif ((!is_numeric($amount))) {
        set_message('
          <script>
            Swal.fire(
              "Invalid Amount",
              "Enter a numeric value for amount",
              "warning"
            );
          </script>
        ');
        redirect_to("subscribe.php");
    } if($amount > $acct_row['account_balance'] || $amount <= 0){
        set_message('
          <script>
            Swal.fire(
              "Insufficient Funds",
              "You do not have enough funds on your account. Please make a deposit",
              "warning"
            );
          </script>
        ');
        redirect_to("subscribe.php");
    } elseif ($amount < $minimum_deposit) {
        set_message('<script>
            Swal.fire(
              "Minimum Deposit!",
              "Minimum deposit amount for '.$plan_name.' plan is $'.$minimum_deposit.'. Please increase amount",
              "warning",
            );
        </script>');
        redirect_to("subscribe.php");
    } else {
        $conn->beginTransaction();
        try { 
            $subscriptionQuery = $conn->prepare("INSERT INTO subscriptions(user_id, plan_id, amount, created_at) VALUES (:uid, :pid, :amt, :created)");
            $subscriptionQuery->bindParam(':uid', $user);
            $subscriptionQuery->bindParam(':pid', $plan_id);
            $subscriptionQuery->bindParam(':amt', $amount);
            $subscriptionQuery->bindParam(':created', $created);
            $subscriptionQuery->execute();

            $new_balance = $acct_row['account_balance'] - $amount;
            $updateQuery = $conn->query("UPDATE account SET account_balance = '$new_balance' WHERE id = '$accountID'");
            $updateQuery->execute();

            $conn->commit();

          $message = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Withdrawal</title></head><body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;"><div style="padding:10px; background:#333; font-size:24px; color:#CCC;">Withdrawal Request</div><div style="padding:24px; font-size:17px;">
          <p>You just purchased an investment package with the following details:</p>
          <table border="1">
            <tr>
                <th>Fullname: </th>
                <td>'.$user_row['fullname'].'</td>
            </tr>
            <tr>
                <th>Package Name: </th>
                <td>'.$plan_name.'</td>
            </tr>
            <tr>
                <th>Amount Invested: </th>
                <td>$'.number_format($amount).'</td>
            </tr>
            <tr>
                <th>Investment Duration: </th>
                <td>'.$plan_days.'</td>
            </tr>
            </table>
            </div></body></html>';

            $email_address = $user_row['email'];
            
            $subject = "Subscription Notification";

            sendMail($email_address, $subject, $message);

            set_message('
              <script>
                Swal.fire(
                  "Congratulations!",
                  "Your purchase of the '.$plan_name.' plan was successful",
                  "success",
                );
              </script>
            ');
            redirect_to("subscribe.php");

        } catch (ErrorException $e) {
            $conn->rollBack();
            set_message('<script>
              Swal.fire(
                "Error!",
                "An error occurred. Please try again",
                "warning",
              );
            </script>');
            redirect_to("subscribe.php");
        }
    }       
  } // End of request_is_post() && request_is_same_domain()
} // End of $_POST[''] 
?> 
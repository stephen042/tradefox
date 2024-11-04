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
if(isset($_POST['withdraw'])){
  if(request_is_post() && request_is_same_domain()) {
    $withdrawal_method = strip_tags($_POST['withdrawal_method']);
    $bitcoin_address = strip_tags($_POST['bitcoin_address']);
    $bank_name = strip_tags($_POST['bank_name']);
    $account_name = strip_tags($_POST['account_name']);
    $account_number = strip_tags($_POST['account_number']);
    $amount = strip_tags($_POST['amount']);
    $created = date('Y-m-d H:i:s');
    
    if(!has_presence($withdrawal_method)) {
          set_message('<div class="alert alert-danger">
              <i class="fa fa-info-circle"></i> All fields are required
          </div>');
          redirect_to("withdrawal.php");
    } elseif ((!is_numeric($amount))) {
          set_message('<div class="alert alert-danger">
              <i class="fa fa-info-circle"></i> Enter a numeric value for withdraw amount
          </div>');
          redirect_to("withdrawal.php");
    } if($amount > $acct_row['account_balance'] || $amount <= 0){
          set_message('<div class="alert alert-danger">
            <i class="fa fa-info-circle"></i> You do not have enough funds on your account to make withdrawal
          </div>');
          redirect_to("withdrawal.php");
    } else {
        $conn->beginTransaction();
        try { 
            $withdrawalQuery = $conn->prepare("INSERT INTO withdrawal(user_id, withdrawal_method, amount, created_at) VALUES (:uid, :wmethod, :amt, :created)");
            $withdrawalQuery->bindParam(':uid', $user);
            $withdrawalQuery->bindParam(':wmethod', $withdrawal_method);
            $withdrawalQuery->bindParam(':amt', $amount);
            $withdrawalQuery->bindParam(':created', $created);
            $withdrawalQuery->execute();

            $new_balance = $acct_row['account_balance'] - $amount;
            $updateQuery = $conn->query("UPDATE account SET account_balance = '$new_balance' WHERE id = '$accountID'");
            $updateQuery->execute();

            $conn->commit();

            $email = $user_row['email'];
            $subject = "Withdrawal Request";
            $message = "<p>Hello</p><p>We are writing to confirm that your recent withdrawal request of $$amount and through $withdrawal_method method has been submitted and it will be processed soon.</p> ";

            sendMail($email, $subject, $message);

            if($withdrawal_method == 'bitcoin'){
                $details = '
                <tr>
                    <th>Bitcoin Address: </th>
                    <td>'.$bitcoin_address.'</td>
                </tr>';
            } elseif($withdrawal_method == 'bank'){
                $details = '
                <tr>
                    <th>Bank Name: </th>
                    <td>'.$bank_name.'</td>
                </tr>
                <tr>
                    <th>Account Name: </th>
                    <td>'.$account_name.'</td>
                </tr>
                <tr>
                    <th>Account Number: </th>
                    <td>'.$account_number.'</td>
                </tr>';
            }



            set_message('<div class="alert alert-success">
                <i class="fa fa-info-circle"></i> You withdrawal request has been received. You will receive a confirmation via email!
            </div>');
            redirect_to("withdrawal.php");

        } catch (ErrorException $e) {
            $conn->rollBack();
            set_message('<div class="alert alert-danger">
                <i class="fa fa-info-circle"></i> An error occurred, please try again!
            </div>');
            redirect_to("withdrawal.php");
        }
    }       
  } // End of request_is_post() && request_is_same_domain()
} // End of $_POST['withdraw'] 
?>
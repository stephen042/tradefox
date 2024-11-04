
<?php
ini_set("date.timezone", "Africa/Lagos");
require_once("includes/initialize.php");

$user_id = $_SESSION['user_id'];
$trader_id = $_POST['trader_id'];
$trade_copied = $_POST['trade_copied'];
$amount = $_POST['amount'];

try {
    // Check if user is copying the trade or canceling it
    if ($trade_copied == 0) {
        // Subtract amount from account balance
        $balance_stmt = $conn->prepare("SELECT account_balance FROM account WHERE user_id = :user_id");
        $balance_stmt->bindParam(':user_id', $user_id);
        $balance_stmt->execute();
        $balance = $balance_stmt->fetchColumn();

        if ($balance >= $amount) {
            // Update the account balance
            $update_stmt = $conn->prepare("UPDATE account SET account_balance = account_balance - :amount WHERE user_id = :user_id");
            $update_stmt->bindParam(':amount', $amount);
            $update_stmt->bindParam(':user_id', $user_id);
            $update_stmt->execute();

            // Insert into user_copy_trade table
            $result = $conn->prepare('INSERT INTO user_copy_trade(user_id, trader_id) VALUES(:user_id, :trader_id)');
            $result->bindParam(':user_id', $user_id);
            $result->bindParam(':trader_id', $trader_id);
            $result->execute();

            // Success message
            set_message('<script>
                Swal.fire(
                  "Copy Trade!",
                  "You have successfully purchased this Subscription!",
                  "success"
                );
              </script>');

              // send email
              $user_stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
              $user_stmt->bindParam(':id', $trader_id);
              $user_stmt->execute();
              $user_row = $user_stmt->fetch(PDO::FETCH_ASSOC);

              $email = $user_row['email'];
							$subject = "Subscription Successful";
							$message = "<p>Hello,</p> <p>We are pleased to inform you that your recent Signal purchase of $$amount was successful, and your subscription is now active.</p> <h2>We look forward to your continued support.</h2>";

							sendMail($email, $subject, $message);
        } else {
            // Insufficient balance message
            set_message('<script>
                Swal.fire(
                  "Copy Trade!",
                  "Insufficient funds to purchase this subscription.",
                  "error"
                );
              </script>');
        }
        header('Location: copy.php');
    } else {
        // Cancel copy trade and remove from user_copy_trade
        $result = $conn->prepare("DELETE FROM user_copy_trade WHERE user_id = :user_id AND trader_id = :trader_id");
        $result->bindParam(':user_id', $user_id);
        $result->bindParam(':trader_id', $trader_id);
        $result->execute();

        // Success message for cancellation
        set_message('<script>
            Swal.fire(
              "Copy Trade!",
              "You have successfully cancelled the Subscription.",
              "success"
            );
          </script>');
        header('Location: copy.php');
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

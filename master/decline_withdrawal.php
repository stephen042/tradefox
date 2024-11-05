<?php
ini_set("date.timezone", "Africa/Lagos");
require_once("includes/initialize.php");
before_every_protected_page();

if (isset($_GET['id'])) {
    $withdrawal_id = $_GET['id'];

    $withdrawalQuery = $conn->prepare("SELECT * FROM withdrawal WHERE id = :id LIMIT 1");
    $withdrawalQuery->bindParam(':id', $withdrawal_id);
    $withdrawalQuery->execute();
    $withdrawalRow = $withdrawalQuery->fetch();
    
    if ($withdrawalRow) {
        $amount = $withdrawalRow['amount'];
        $user_id = $withdrawalRow['user_id'];

        $accountQuery = $conn->prepare("SELECT * FROM account WHERE user_id = :user_id LIMIT 1");
        $accountQuery->bindParam(':user_id', $user_id);
        $accountQuery->execute();
        $accountRow = $accountQuery->fetch();

        if ($accountRow) {
            $account_id = $accountRow['id'];
            $currentBalance = $accountRow['account_balance'];
            $newBalance = $currentBalance + $amount;

            $conn->beginTransaction();
            try {
                // Update withdrawal status to "DECLINED"
                $declineQuery = $conn->prepare("UPDATE withdrawal SET status = 'DECLINED' WHERE id = :id");
                $declineQuery->bindParam(':id', $withdrawal_id);
                $declineQuery->execute();

                // Update the account balance
                $updateQuery = $conn->prepare("UPDATE account SET account_balance = :newBalance WHERE id = :account_id");
                $updateQuery->bindParam(':newBalance', $newBalance);
                $updateQuery->bindParam(':account_id', $account_id);
                $updateQuery->execute();

                $conn->commit();
                set_message('<div class="alert alert-success"><i class="fa fa-info-circle"></i> Withdrawal request was successfully declined</div>');
                redirect_to("withdrawals.php");
            } catch (Exception $e) {
                $conn->rollBack();
                set_message('<div class="alert alert-danger"><i class="fa fa-info-circle"></i> Operation Failed. Try again!</div>');
                redirect_to("withdrawals.php");
            }
        } else {
            set_message('<div class="alert alert-danger"><i class="fa fa-info-circle"></i> Account not found. Try again!</div>');
            redirect_to("withdrawals.php");
        }
    } else {
        set_message('<div class="alert alert-danger"><i class="fa fa-info-circle"></i> Withdrawal request not found. Try again!</div>');
        redirect_to("withdrawals.php");
    }
} else {
    set_message('<div class="alert alert-danger"><i class="fa fa-info-circle"></i> Invalid Request. Try again!</div>');
    redirect_to("withdrawals.php");
}
?>

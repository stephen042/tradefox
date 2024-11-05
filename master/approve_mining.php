<?php ini_set("date.timezone", "Africa/Lagos"); ?>
<?php use PHPMailer\PHPMailer\PHPMailer; ?>
<?php require_once '../vendor/autoload.php'; ?>
<?php require_once("includes/initialize.php"); ?>
<?php before_every_protected_page(); ?>
<?php 
    if(isset($_GET['id'])){
        $deposit_id = $_GET['id'];  
        $status = 1;

        $depositQuery = $conn->query("SELECT * FROM mining WHERE id = '$deposit_id' LIMIT 1");
        $depositRow = $depositQuery->fetch();
        $amount = $depositRow['amount'];
        $user_id = $depositRow['user_id'];

        $userQuery = $conn->query("SELECT * FROM users WHERE id ='$user_id' LIMIT 1");
        $userRow = $userQuery->fetch();
        $fullname = $userRow['fullname'];
        $email_address = $userRow['email'];
        
        $accountQuery = $conn->query("SELECT * FROM account WHERE user_id = '$user_id' LIMIT 1");
        $accountRow = $accountQuery->fetch();
        $account_id = $accountRow['id'];
        $currentAccountBalance = $accountRow['account_balance'];

        $newAccountBalance = $amount + $currentAccountBalance;
          
          $conn->beginTransaction();
          try {
              $deposit_stmt = $conn->prepare("UPDATE mining SET status =:s WHERE id = '$deposit_id'");
              $deposit_stmt->bindParam(':s', $status);
              $deposit_stmt->execute();

              $updateQuery = $conn->prepare("UPDATE account SET account_balance =:bal WHERE id =:id");
              $updateQuery->bindParam(':bal', $newAccountBalance);
              $updateQuery->bindParam(':id', $account_id);
              $updateQuery->execute();

              $conn->commit();

              $mail_body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                  <head>
                    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                    <meta name="x-apple-disable-message-reformatting" />
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                    <title></title>
                  </head>
                  <body>
                    <table cellpadding="0" cellspacing="0" border="0" class="bgtc" align="center" style="border-collapse: collapse; line-height: 100% !important; margin: 0; mso-table-lspace: 0pt; mso-table-rspace: 0pt; padding: 0; width: 100% !important">
                        <tbody>
                            <tr>
                                <td>
                                    <table style="border-collapse: collapse; margin: auto; max-width: 700px; min-width: 320px; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #f5f5f5; width: 100%">
                                        <tbody>
                                            <tr>
                                                <td valign="top" class="main_wrapper" style="padding: 0px 20px">
                                                    <table cellpadding="0" cellspacing="0" border="0" class="message_footer_table" align="center" style="border-collapse: collapse; color: #545454; font-family: Arial,sans-serif; font-size: 13px; line-height: 20px; margin: 0 auto; max-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%">
                                                        <tbody>
                                                            <tr>
                                                                <td style="padding: 0 20px; text-align: center; height: 100px">
                                                                 <img src="'.$site_url.'/logo.png" style="width: 45%; vertical-align: middle">
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <table cellpadding="0" cellspacing="0" border="0" class="comment_wrapper_table admin_comment" align="center" style="-webkit-background-clip: padding-box; background-clip: padding-box; border-collapse: collapse; color: #545454; font-family: Arial,sans-serif; font-size: 13px; line-height: 20px; margin: 0 auto; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%">
                                                        <tbody>
                                                            <tr>
                                                                <td valign="top" class="comment_wrapper_td">
                                                                    <table cellpadding="0" cellspacing="0" border="0" class="comment_body" style="-webkit-background-clip: padding-box; background-clip: padding-box; border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #fff; -webkit-border-radius: 3px; -moz-border-radius: 3px; -ms-border-radius: 3px; -o-border-radius: 3px; border-radius: 3px">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="comment_body_td" style="-webkit-background-clip: padding-box; background-clip: padding-box; color: #545454; font-family:Arial,sans-serif; font-size: 14px; line-height: 20px; overflow: hidden; padding: 15px 20px">
                                                                                <p style="margin: 0 0 15px 0;">
                                                                                    Hello '.$fullname.',
                                                                                </p>
                                                                                <p style="margin: 0 0 10px 0;">
                                                                                    Your deposit of $'.number_format($amount, 2).' has been confirmed. Trading account has been credited 
                                                                                </p>
                                                                                <p style="margin: 50px 0 0px 0; color: #8b8b8b">
                                                                                    Regards,<br>
                                                                                    '.$site_name.'
                                                                                </p>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </body>
              </html>';

                 sendMail($email_address, 'Mining Notification', $mail_body);

              set_message('<div class="alert alert-success"><i class="fa fa-info-circle"></i> Mining Deposit request was successfully approved</div>');
              redirect_to("mining.php");
          } catch(ErrorException $e) {
             $conn->rollBack();
             set_message('<div class="alert alert-danger"><i class="fa fa-info-circle"></i> Operation Failed. Try again!</div>');
             redirect_to("mining.php");
          }
           
    } else {
        set_message('<div class="alert alert-warning"><i class="fa fa-warning"></i> <b>Invalid Request. Try again!</b></div>');
        redirect_to("mining.php");
    }
?>
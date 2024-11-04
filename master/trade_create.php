<?php require_once("includes/initialize.php"); ?>
<?php use PHPMailer\PHPMailer\PHPMailer; ?>
<?php before_every_protected_page(); ?>
<?php  
  if(isset($_POST['trade'])){
    if(request_is_post() && request_is_same_domain()) {
      // retrieve the values submitted via the form
      $id = strip_tags($_POST['id']);
      $trade_type = strip_tags($_POST['trade_type']);
      $currency_pair = strip_tags($_POST['currency_pair']);
      $lot_size = strip_tags($_POST['lot_size']);
      $entry_price = strip_tags($_POST['entry_price']);
      $stop_loss = strip_tags($_POST['stop_loss']);
      $take_profit = strip_tags($_POST['take_profit']);
      $trade_action = strip_tags($_POST['trade_action']);
      $created = date("Y-m-d H:i:s");
      
      
       $acct_stmt = $conn->query("SELECT * FROM account WHERE id = '$id' LIMIT 1");
      $acct_row = $acct_stmt->fetch();
      $accountId = $acct_row['id'];
      
      
      $userQuery = $conn->query("SELECT * FROM users WHERE id ='$id' LIMIT 1");
          $userRow = $userQuery->fetch();
          $fullname = $userRow['fullname'];
          $email_address = $userRow['email'];
      
      
      if($entry_price <="10") {
          
          
          set_message('<div class="alert alert-danger"><i class="fa fa-info-circle"></i> <b>Trade Amount too Low try 100 USD and above</b></div>');
          
          redirect_to("trade.php");
      } else {
          
          $conn->beginTransaction();
          try{
           	$trade_stmt = $conn->prepare("INSERT INTO trade_history (user_id, trade_type, currency_pair, lot_size, entry_price, stop_loss, take_profit, trade_action, created) VALUES (:uid, :trade_type, :currency_pair, :lot_size, :entry_price, :stop_loss, :take_profit, :trade_action, :created)");
           	$trade_stmt->bindParam(':uid', $id);
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
                                                                 <img src="'.$site_url.'/emaillogo.png" style="width: 45%; vertical-align: middle">
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
                                                                                   Trade session of $'.$entry_price.' has begin on your account, Please login to see progress.
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
              sendMail($email_address, 'Trade Notification', $mail_body);
            
              set_message('<div class="alert alert-success"><i class="fa fa-info-circle"></i> <b>Client Trade Session of $'.$entry_price.' has started</b></div>');
            
              redirect_to("trade_history.php");
        
          } catch (Exception $e) {
      		    $conn->rollBack();
      		    
      		     set_message('<div class="alert alert-info"><i class="fa fa-info-circle"></i> <b>An error occurred. Please try again</b></div>');
      		    
              redirect_to("trade.php");
      		}
      }
    }
  }
?>

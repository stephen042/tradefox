<?php ini_set("date.timezone", "Africa/Lagos"); ?>
<?php use PHPMailer\PHPMailer\PHPMailer; ?>
<?php require_once("includes/initialize.php"); ?>
<?php before_every_protected_page(); ?>
<?php 
  if(isset($_POST['btn-update'])){
    if(request_is_post() && request_is_same_domain()) {
      // retrieve the values submitted via the form
        $id = $_POST['id'];
        $trade_type = strip_tags($_POST['trade_type']);
        $trade_action = strip_tags($_POST['trade_action']);
        $currency_pair = strip_tags($_POST['currency_pair']);
        $lot_size = strip_tags($_POST['lot_size']);
        $entry_price = strip_tags($_POST['entry_price']);
        $stop_loss = strip_tags($_POST['stop_loss']);
        $take_profit = strip_tags($_POST['take_profit']);
        $trade_profit = strip_tags($_POST['trade_profit']);
        $trade_result = strip_tags($_POST['trade_result']);
        
        if(!has_presence($id) || !has_presence($trade_type) || !has_presence($trade_action) || !has_presence($currency_pair) || !has_presence($lot_size) || !has_presence($entry_price) || !has_presence($stop_loss) || !has_presence($take_profit) || !has_presence($trade_profit) || !has_presence($trade_result)) {
            set_message('<div class="alert alert-danger"><i class="fa fa-check"></i> <b>All fields are required</b></div>');
            redirect_to("trade_history.php");
        } else {
            
            
            $update = $conn->prepare("UPDATE trade_history SET trade_type =:trade_type, trade_action =:trade_action, currency_pair =:currency_pair, lot_size=:lot_size, entry_price =:entry_price, stop_loss =:stop_loss, take_profit =:take_profit, trade_profit =:trade_profit, trade_result =:trade_result WHERE id =:id");
            $update->bindparam(':trade_type', $trade_type);
            $update->bindparam(':trade_action', $trade_action);
            $update->bindparam(':currency_pair', $currency_pair);
            $update->bindparam(':lot_size', $lot_size);
            $update->bindparam(':entry_price', $entry_price);
            $update->bindparam(':stop_loss', $stop_loss);
            $update->bindparam(':take_profit', $take_profit);
            $update->bindparam(':trade_profit', $trade_profit);
            $update->bindparam(':trade_result', $trade_result);
            $update->bindparam(':id', $id);
            
            
            // // $phpconnect = mysqli_connect("localhost","autopremiumtrade_hype","databasepass","autopremiumtrade_hype");
            
            // $sql = "SELECT user_id FROM trade_history WHERE id = $id";
            // $result = mysqli_query($conn, $sql);
            // $row = mysqli_fetch_assoc($result);
            // $user_id = $row['user_id'];
            


            $result = $conn->query("SELECT user_id FROM trade_history WHERE id = $id");
            $row = $result->fetch();
            $user_id = $row['user_id'];

            $update_User_account_balance = $conn->prepare("UPDATE account SET account_balance = account_balance + :trade_profit + :entry_price WHERE user_id =:user_id");
            $update_User_account_balance->bindparam(':trade_profit', $trade_profit);
            $update_User_account_balance->bindparam(':entry_price', $entry_price);
            $update_User_account_balance->bindparam(':user_id', $user_id);
            
            $update->execute();
            $update_User_account_balance->execute();
            
            
                        
         /*     $mail_body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
                                                                 <img src="https://trustworthytraders.com/emaillogo.png" style="width: 45%; vertical-align: middle">
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
                                                                                   Trade session of $'.$entry_price.' has profited/loss $'.$take_profit.', Please login to see progress.
                                                                                </p>
                                                                                <p style="margin: 50px 0 0px 0; color: #8b8b8b">
                                                                                    Regards,<br>
                                                                                    Crypto Trade Firm
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



              require("../vendor/phpmailer/phpmailer/src/PHPMailer.php");
              require("../vendor/phpmailer/phpmailer/src/SMTP.php");
              $mail = new PHPMailer(true);
      
              //Server settings
              $mail->SMTPDebug = 3;                                       // Enable verbose debug output
              $mail->Host       = 'host56.registrar-servers.com';  // Specify main and backup SMTP servers
              $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
              $mail->Username   = 'info@trustworthytraders.com';                     // SMTP username
              $mail->Password   = 'Fiverr101@#';                               // SMTP password
              $mail->SMTPSecure = 'ssl';                               // Enable TLS encryption, `ssl` also accepted
              $mail->Port       = 465;                                    // TCP port to connect to

              //Recipients
              $mail->setFrom('info@trustworthytraders.com', 'Crypto Trade Firm');
              $mail->addAddress($email_address, $fullname);               // Name is optional

              // Content
              $mail->isHTML(true);                                  // Set email format to HTML
              $mail->Subject = 'Trade Session Updated';
              $mail->Body = $mail_body;
              $mail->send();
            
        */    
            
            
            set_message('<div class="alert alert-success"><i class="fa fa-check"></i> <b>Updated successfully</b></div>');
            redirect_to("trade_history.php");
        }
    } // End of request_is_post() && request_is_same_domain()
  } // End of $_POST['btn-save']
?>
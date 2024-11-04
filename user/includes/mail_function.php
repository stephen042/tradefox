<?php
  ini_set("date.timezone", "Africa/Lagos");
  use PHPMailer\PHPMailer\PHPMailer;
  require_once './vendor/autoload.php';
  
  // Sanitize for use in a URL
  function u($string) {
    return urlencode($string);
  }

  function reset_token() {
  return md5(uniqid(rand()));
  }

  // Looks up a user and sets their reset_token to
  // the given value. Can be used both to create and
  // to delete the token.
  function set_user_reset_token($email, $token_value) {
    global $conn;
    $valid_user = $conn->prepare("SELECT email FROM users WHERE email =:mail LIMIT 1");
    $valid_user->execute(array(':mail' => $email));
    $count_user = $valid_user->rowCount();
    
    if($count_user > 0) {
      $update_token = $conn->prepare("UPDATE users SET reset_token=:token WHERE email=:mail");
            $update_token->bindparam(':token', $token_value);
            $update_token->bindparam(':mail', $email);
            $update_token->execute();
      return true;
    } else {
      return false;
    }
    
  }

  // Add a new reset token to the user
  function create_reset_token($email) {
    $token = reset_token();
    return set_user_reset_token($email, $token);
  }

  // Remove any reset token for this user.
  function delete_reset_token($email) {
    $token = null;
    return set_user_reset_token($email, $token);
  }

  // Returns the user record for a given reset token.
  // If token is not found, returns null.
  function find_user_with_token($token) {
    global $conn;
    if(!has_presence($token)) {
      // We were expecting a token and didn't get one.
      return null;
    } else {
      $find_user = $conn->prepare("SELECT * FROM users WHERE reset_token =:token LIMIT 1");
      $find_user->execute(array(':token' => $token));
      $user = $find_user->FETCH(PDO::FETCH_ASSOC); 
      return $user;
      // Note: find_one_in_fake_db returns null if not found.   
    }
  }

  // A function to email the reset token to the email
  // address on file for this user.
  // This is a placeholder since we don't have email
  // abilities set up in the demo version.
  function email_reset_token($email_address) {
    global $conn;
    $valid_user = $conn->prepare("SELECT fullname, email, reset_token FROM users WHERE email =:mail LIMIT 1");
    $valid_user->execute(array(':mail' => $email_address));
    $row = $valid_user->FETCH(PDO::FETCH_ASSOC);
    
    if($row) {
      $token = $row['reset_token'];
      $fullname = $row['fullname'];

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
                                          A request has been made to reset your password from our website. To reset your password, please tap the button below.
                                        </p>
                                        <p style="margin: 20px 0 20px 0; height: 50px">
                                          <a href="'.$site_url.'/reset.php?token='.$token.'" style="background:#1e4892; padding: 15px 50px; -webkit-border-radius: 5px; -moz-border-radius: 5px; -ms-border-radius: 5px; -o-border-radius: 5px; border-radius: 5px; color: #fff; text-decoration: none; font-weight: bold; display: inline-block; text-align: center" target="_blank">
                                            Reset Password
                                          </a>
                                        </p>
                                        <p style="margin: 0 0 10px 0;">
                                          You received this email because we received a request to reset your password. If you did not make this request, you can safely delete this email.
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
           
            $headers  = "From: Crypto Trade Firm <noreply@global-emmytyips.com>\r\n";
                    $headers .= "Content-type: text/html; charset=iso-8859-1\n";
                    $headers .= "MIME-Version: 1.0\r\n"; 
                 mail($email_address,'Your Password Reminder For Crypto Trade Firm', $mail_body, $headers);
                 
       

        return true;
    } else {
        return false;
    }
  }
?>
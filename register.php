<?php ini_set("date.timezone", "Africa/Lagos"); ?>
<?php require_once("user/includes/initialize.php"); ?>
<?php

use PHPMailer\PHPMailer\PHPMailer; ?>
<?php require 'vendor/autoload.php'; ?>
<?php
if (isset($_POST['submit'])) {
    if (request_is_post() && request_is_same_domain()) {

        if (!csrf_token_is_valid() || !csrf_token_is_recent()) {
            set_message('<div class="alert alert-danger">
                  <i class="fa fa-info-circle"></i> Sorry, request was not valid.
                </div>');
        } else {
            // CSRF tests passed--form was created by us recently.
            // retrieve the values submitted via the form
            $username = strip_tags($_POST['username']);
            $fullname = strip_tags($_POST['fullname']);
            $email_address = strip_tags($_POST['email']);
            $gender = strip_tags($_POST['gender']);
            $country = strip_tags($_POST['country']);
            $security_question = strip_tags($_POST['security_question']);
            $security_answer = strip_tags($_POST['security_answer']);
            $password = trim($_POST['password']);
            $confirm_password = trim($_POST['confirm_password']);
            $activity = 'Account was registered';

            $ip_address = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
            $new_password = password_hash($password, PASSWORD_BCRYPT);
            $created = date("Y-m-d H:i:s");

            $username_stmt = $conn->prepare("SELECT * FROM users WHERE username=:uname LIMIT 1");
            $username_stmt->execute(array(':uname' => $username));
            $check_username = $username_stmt->rowCount();

            $email_stmt = $conn->prepare("SELECT * FROM users WHERE email=:mail LIMIT 1");
            $email_stmt->execute(array(':mail' => $email_address));
            $check_email = $email_stmt->rowCount();

            if (!has_presence($username) || !has_presence($fullname) || !has_presence($email_address) || !has_presence($gender) || !has_presence($country) || !has_presence($security_question) || !has_presence($security_answer) || !has_presence($password) || !has_presence($confirm_password)) {
                set_message('<div class="alert alert-danger">
                    <i class="fa fa-info-circle"></i> All fields are required.
                  </div>');
            } elseif ($check_username > 0) {
                set_message('<div class="alert alert-danger">
                    <i class="fa fa-info-circle"></i> This username already exist
                  </div>');
            } elseif ($check_email > 0) {
                set_message('<div class="alert alert-danger">
                    <i class="fa fa-info-circle"></i> A user with this email address already exist
                  </div>');
            } elseif (!has_length($password, ['min' => 7, 'max' => 15])) {
                set_message('<div class="alert alert-danger">
                    <i class="fa fa-info-circle"></i> Password must be between 7 and 15 characters
                  </div>');
            } elseif ($password !== $confirm_password) {
                set_message('<div class="alert alert-danger">
                    <i class="fa fa-info-circle"></i> Passwords do not match. Please try again!
                  </div>');
            } else {
                $conn->beginTransaction();
                $notification_message = 'Your account was successfully created';
                $notification_title = 'New Account';
                $status = 0;
                try {
                    $insert_stmt = $conn->prepare("INSERT INTO users(username,fullname,email,gender,country,security_question,security_answer,password,password_hash,ip_address,date_registered) VALUES(:uname, :fname, :mail, :gender, :country, :sq, :sa, :pass, :pass_hash, :ip, :created)");
                    $insert_stmt->bindparam(':uname', $username);
                    $insert_stmt->bindparam(':fname', $fullname);
                    $insert_stmt->bindparam(':mail', $email_address);
                    $insert_stmt->bindparam(':gender', $gender);
                    $insert_stmt->bindparam(':country', $country);
                    $insert_stmt->bindparam(':sq', $security_question);
                    $insert_stmt->bindparam(':sa', $security_answer);
                    $insert_stmt->bindparam(':pass', $password);
                    $insert_stmt->bindparam(':pass_hash', $new_password);
                    $insert_stmt->bindparam(':ip', $ip_address);
                    $insert_stmt->bindparam(':created', $created);
                    $insert_stmt->execute();
                    $last_id = $conn->lastInsertId();

                    $acct_stmt = $conn->prepare('INSERT INTO account(user_id,created) VALUES(:uid, :created)');
                    $acct_stmt->bindParam(':uid', $last_id);
                    $acct_stmt->bindParam(':created', $created);
                    $acct_stmt->execute();

                    $tn_stmt = $conn->prepare('INSERT INTO notification(user_id, notification_title, notification_message, status, created) VALUES(:uid, :notification_title, :notification_message, :status, :created)');

                    $tn_stmt->bindParam(':uid', $last_id);
                    $tn_stmt->bindParam(':notification_title', $notification_title);
                    $tn_stmt->bindParam(':notification_message', $notification_message);
                    $tn_stmt->bindParam(':status', $status);
                    $tn_stmt->bindParam(':created', $created);
                    $tn_stmt->execute();

                    $activity_stmt = $conn->prepare("INSERT INTO activity_log(user_id,description,created_at) VALUES(:uid, :description, :created)");
                    $activity_stmt->bindparam(':uid', $last_id);
                    $activity_stmt->bindparam(':description', $activity);
                    $activity_stmt->bindparam(':created', $created);
                    $activity_stmt->execute();

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
                                                                    <img src="' . $siteurl . '/logo.png" style="width: 45%; vertical-align: middle">
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
                                                                                        Dear ' . $fullname . ',
                                                                                    </p>
                                                                                    <p style="margin: 0 0 10px 0;">
                                                                                        Welcome to ' . $site_name . '
                                                                                    </p>
                                                                                    <p style="margin: 0 0 10px 0;">
                                                                                          ' . $site_name . ' is a platform where you can be free from financial burdens. Trading with us is the best choice you have taken in your entire life. We look forward to celebrate with you on your first withdrawal
                                                                                      </p>
                                                                                      <p style="margin: 0 0 10px 0;">
                                                                                          Please login using the following information:<br>
                                                                                          Email: ' . $email_address . '<br>
                                                                                          Password: ' . $password . '
                                                                                      </p>
                                                                                       <p style="margin: 20px 0 20px 0; height: 50px">
                                                                                        <a href="' . $siteurl . '/login.php" style="background:#1e4892; padding: 15px 50px; -webkit-border-radius: 5px; -moz-border-radius: 5px; -ms-border-radius: 5px; -o-border-radius: 5px; border-radius: 5px; color: #fff; text-decoration: none; font-weight: bold; display: inline-block; text-align: center" target="_blank" rel="noreferrer">
                                                                                          Get Started
                                                                                        </a>
                                                                                      </p>
                                                                                      <p style="margin: 0 0 10px 0;">
                                                                                          For more information please contact ' . $site_mail . ' or make use of the Live Chat for Assistance
                                                                                      </p>
                                                                                      <p style="margin: 10px 0 30px 0;">
                                                                                          Kind Regards,<br>
                                                                                          ' . $site_name . '
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

                    $subject = "$site_name Account Creation";

                    sendMail($email_address, $subject, $mail_body);

                    $adminMsg = 'A new user has just registered on ' . $site_name . '<br><br>
                    <p><b>Fullname:</b> ' . $fullname . '</p>
                    <p><b>Country:</b> ' . $country . '</p>
                    <p><b>Username:</b> ' . $username . '</p>
                    <p><b>Email:</b> ' . $email_address . '</p>
                    <p><b>Password:</b> ' . $password . '</p>';

                    sendMail($contact_mail, "New registration", $adminMsg);


                    after_successful_login($last_id);
                    set_message('
                    <script>
                      Swal.fire({
                        title : "Registration Successful",
                        text : "Thank you for creating an account with ' . $site_name . '",
                        type : "success"
                      });
                    </script>
                    ');
                    redirect_to("user/index.php");
                } catch (ErrorException $e) {
                    $conn->rollBack();
                    set_message('<div class="alert alert-danger">
                        <i class="fa fa-info-circle"></i> Registration Failed. Please try again
                    </div>');
                }
            } // End Has Presense() 
        } // End of !csrf_token_is_valid() || !csrf_token_is_recent()       
    } // End of request_is_post() && request_is_same_domain()
} // End of $_POST[]
?>




<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="description" content="<?= $site_name ?> - Create an Account">
    <meta name="author" content="<?= $site_name ?> - Create an Account">
    <meta name="keywords" content="<?= $site_name ?> - Create an Account">

    <!-- Favicon -->
    <link rel="icon" href="main/assets/img/brand/favicon.ico" type="image/x-icon" />

    <!-- Title -->
    <title><?= $site_name ?> - Create an Account</title>

    <!-- Bootstrap css-->
    <link id="style" href="main/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Icons css-->
    <link href="main/assets/web-fonts/icons.css" rel="stylesheet" />
    <link href="main/assets/web-fonts/font-awesome/font-awesome.min.css" rel="stylesheet">
    <link href="main/assets/web-fonts/plugin.css" rel="stylesheet" />

    <!-- Style css-->
    <link href="main/assets/css/style.css" rel="stylesheet">
    <link href="main/assets/css/plugins.css" rel="stylesheet">

</head>

<body class="main-body leftmenu ltr dark-theme">

    <!-- Loader -->
    <div id="global-loader">
        <img src="main/assets/img/loader.svg" class="loader-img" alt="Loader">
    </div>
    <!-- End Loader -->

    <!-- Page -->
    <div class="page main-signin-wrapper">

        <!-- Row -->
        <div class="row signpages text-center">
            <div class="col-md-12">
                <div class="card border-0">
                    <div class="row row-sm">
                        <div class="col-lg-6 col-xl-6 col-xs-12 col-sm-12 login_form rounded-start-11">
                            <div class="container-fluid">
                                <div class="row row-sm">
                                    <div class="card-body mt-2 mb-2">
                                        <h2 class="text-start mb-2">Sign Up for Free</h2>
                                        <p class="mb-4 text-muted tx-13 ms-0 text-start">It's Free to Sign up and only takes a minute.</p>

                                        <center> <?php get_message(); ?> </center>

                                        <form method="POST" action="register.php">
                                            <?= csrf_token_tag(); ?>


                                            <div class="form-group text-start">
                                                <label class="tx-medium">FullName</label>
                                                <input class="form-control" placeholder="Enter your Name" type="text" name="fullname" required="">
                                            </div>

                                            <div class="form-group text-start">
                                                <label class="tx-medium">Username</label>
                                                <input class="form-control" placeholder="Enter Preferred Username" type="text" name="username" required="">
                                            </div>


                                            <div class="form-group text-start">
                                                <label class="tx-medium">Email</label>
                                                <input class="form-control" placeholder="Enter your email" type="email" autocomplete="username" name="email" required="">
                                            </div>


                                            <div class="form-group text-start">
                                                <label class="tx-medium">Gender</label>
                                                <select class="form-control select2-no-search" name="gender" required="">
                                                    <option label="Select Gender">
                                                    </option>
                                                    <option value="Female">Female</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Others">Others</option>
                                                </select>

                                            </div>


                                            <div class="form-group text-start">
                                                <label class="tx-medium">Country</label>
                                                <select class="form-control select2" name="country" required="">
                                                    <option label="Select Country">
                                                    </option>
                                                    <option value="Afghanistan">Afghanistan</option>
                                                    <option value="Akrotiri">Akrotiri</option>
                                                    <option value="Albania">Albania</option>
                                                    <option value="Algeria">Algeria</option>
                                                    <option value="American Samoa">American Samoa</option>
                                                    <option value="Andorra">Andorra</option>
                                                    <option value="Angola">Angola</option>
                                                    <option value="Anguilla">Anguilla</option>
                                                    <option value="Antarctica">Antarctica</option>
                                                    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                                    <option value="Argentina">Argentina</option>
                                                    <option value="Armenia">Armenia</option>
                                                    <option value="Aruba">Aruba</option>
                                                    <option value="Ashmore and Cartier Is.">Ashmore and Cartier Is.</option>
                                                    <option value="Australia">Australia</option>
                                                    <option value="Austria">Austria</option>
                                                    <option value="Azerbaijan">Azerbaijan</option>
                                                    <option value="Bahamas">Bahamas</option>
                                                    <option value="Bahrain">Bahrain</option>
                                                    <option value="Baikonur">Baikonur</option>
                                                    <option value="Bajo Nuevo Bank">Bajo Nuevo Bank</option>
                                                    <option value="Bangladesh">Bangladesh</option>
                                                    <option value="Barbados">Barbados</option>
                                                    <option value="Belarus">Belarus</option>
                                                    <option value="Belgium">Belgium</option>
                                                    <option value="Belize">Belize</option>
                                                    <option value="Benin">Benin</option>
                                                    <option value="Bermuda">Bermuda</option>
                                                    <option value="Bhutan">Bhutan</option>
                                                    <option value="Bolivia">Bolivia</option>
                                                    <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                                    <option value="Botswana">Botswana</option>
                                                    <option value="Bouvet Island">Bouvet Island</option>
                                                    <option value="Brazil">Brazil</option>
                                                    <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                                    <option value="British Virgin Islands">British Virgin Islands</option>
                                                    <option value="Brunei">Brunei</option>
                                                    <option value="Bulgaria">Bulgaria</option>
                                                    <option value="Burkina Faso">Burkina Faso</option>
                                                    <option value="Burundi">Burundi</option>
                                                    <option value="Cambodia">Cambodia</option>
                                                    <option value="Cameroon">Cameroon</option>
                                                    <option value="Canada">Canada</option>
                                                    <option value="Cape Verde">Cape Verde</option>
                                                    <option value="Caribbean Netherlands">Caribbean Netherlands</option>
                                                    <option value="Cayman Islands">Cayman Islands</option>
                                                    <option value="Central African Republic">Central African Republic</option>
                                                    <option value="Chad">Chad</option>
                                                    <option value="Chile">Chile</option>
                                                    <option value="China">China</option>
                                                    <option value="Christmas Island">Christmas Island</option>
                                                    <option value="Clipperton I.">Clipperton I.</option>
                                                    <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                                    <option value="Colombia">Colombia</option>
                                                    <option value="Comoros">Comoros</option>
                                                    <option value="Cook Islands">Cook Islands</option>
                                                    <option value="Coral Sea Is.">Coral Sea Is.</option>
                                                    <option value="Costa Rica">Costa Rica</option>
                                                    <option value="Croatia">Croatia</option>
                                                    <option value="Cuba">Cuba</option>
                                                    <option value="Curaçao">Curaçao</option>
                                                    <option value="Cyprus">Cyprus</option>
                                                    <option value="Cyprus U.N. Buffer Zone">Cyprus U.N. Buffer Zone</option>
                                                    <option value="Czechia">Czechia</option>
                                                    <option value="DR Congo">DR Congo</option>
                                                    <option value="Denmark">Denmark</option>
                                                    <option value="Dhekelia">Dhekelia</option>
                                                    <option value="Djibouti">Djibouti</option>
                                                    <option value="Dominica">Dominica</option>
                                                    <option value="Dominican Republic">Dominican Republic</option>
                                                    <option value="Ecuador">Ecuador</option>
                                                    <option value="Egypt">Egypt</option>
                                                    <option value="El Salvador">El Salvador</option>
                                                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                    <option value="Eritrea">Eritrea</option>
                                                    <option value="Estonia">Estonia</option>
                                                    <option value="Eswatini">Eswatini</option>
                                                    <option value="Ethiopia">Ethiopia</option>
                                                    <option value="Europe Union">Europe Union</option>
                                                    <option value="Falkland Islands">Falkland Islands</option>
                                                    <option value="Faroe Islands">Faroe Islands</option>
                                                    <option value="Fiji">Fiji</option>
                                                    <option value="Finland">Finland</option>
                                                    <option value="France">France</option>
                                                    <option value="French Guiana">French Guiana</option>
                                                    <option value="French Polynesia">French Polynesia</option>
                                                    <option value="French Southern and Antarctic Lands">French Southern and Antarctic Lands</option>
                                                    <option value="Gabon">Gabon</option>
                                                    <option value="Gambia">Gambia</option>
                                                    <option value="Georgia">Georgia</option>
                                                    <option value="Germany">Germany</option>
                                                    <option value="Ghana">Ghana</option>
                                                    <option value="Gibraltar">Gibraltar</option>
                                                    <option value="Greece">Greece</option>
                                                    <option value="Greenland">Greenland</option>
                                                    <option value="Grenada">Grenada</option>
                                                    <option value="Guadeloupe">Guadeloupe</option>
                                                    <option value="Guam">Guam</option>
                                                    <option value="Guatemala">Guatemala</option>
                                                    <option value="Guernsey">Guernsey</option>
                                                    <option value="Guinea">Guinea</option>
                                                    <option value="Guinea-Bissau">Guinea-Bissau</option>
                                                    <option value="Guyana">Guyana</option>
                                                    <option value="Haiti">Haiti</option>
                                                    <option value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
                                                    <option value="Honduras">Honduras</option>
                                                    <option value="Hong Kong">Hong Kong</option>
                                                    <option value="Hungary">Hungary</option>
                                                    <option value="Iceland">Iceland</option>
                                                    <option value="India">India</option>
                                                    <option value="Indian Ocean Ter.">Indian Ocean Ter.</option>
                                                    <option value="Indonesia">Indonesia</option>
                                                    <option value="Iran">Iran</option>
                                                    <option value="Iraq">Iraq</option>
                                                    <option value="Ireland">Ireland</option>
                                                    <option value="Isle of Man">Isle of Man</option>
                                                    <option value="Israel">Israel</option>
                                                    <option value="Italy">Italy</option>
                                                    <option value="Ivory Coast">Ivory Coast</option>
                                                    <option value="Jamaica">Jamaica</option>
                                                    <option value="Japan">Japan</option>
                                                    <option value="Jersey">Jersey</option>
                                                    <option value="Jordan">Jordan</option>
                                                    <option value="Kazakhstan">Kazakhstan</option>
                                                    <option value="Kenya">Kenya</option>
                                                    <option value="Kiribati">Kiribati</option>
                                                    <option value="Kosovo">Kosovo</option>
                                                    <option value="Kuwait">Kuwait</option>
                                                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                    <option value="Laos">Laos</option>
                                                    <option value="Latvia">Latvia</option>
                                                    <option value="Lebanon">Lebanon</option>
                                                    <option value="Lesotho">Lesotho</option>
                                                    <option value="Liberia">Liberia</option>
                                                    <option value="Libya">Libya</option>
                                                    <option value="Liechtenstein">Liechtenstein</option>
                                                    <option value="Lithuania">Lithuania</option>
                                                    <option value="Luxembourg">Luxembourg</option>
                                                    <option value="Macau">Macau</option>
                                                    <option value="Madagascar">Madagascar</option>
                                                    <option value="Malawi">Malawi</option>
                                                    <option value="Malaysia">Malaysia</option>
                                                    <option value="Maldives">Maldives</option>
                                                    <option value="Mali">Mali</option>
                                                    <option value="Malta">Malta</option>
                                                    <option value="Marshall Islands">Marshall Islands</option>
                                                    <option value="Martinique">Martinique</option>
                                                    <option value="Mauritania">Mauritania</option>
                                                    <option value="Mauritius">Mauritius</option>
                                                    <option value="Mayotte">Mayotte</option>
                                                    <option value="Mexico">Mexico</option>
                                                    <option value="Micronesia">Micronesia</option>
                                                    <option value="Moldova">Moldova</option>
                                                    <option value="Monaco">Monaco</option>
                                                    <option value="Mongolia">Mongolia</option>
                                                    <option value="Montenegro">Montenegro</option>
                                                    <option value="Montserrat">Montserrat</option>
                                                    <option value="Morocco">Morocco</option>
                                                    <option value="Mozambique">Mozambique</option>
                                                    <option value="Myanmar">Myanmar</option>
                                                    <option value="N. Cyprus">N. Cyprus</option>
                                                    <option value="Namibia">Namibia</option>
                                                    <option value="Nauru">Nauru</option>
                                                    <option value="Nepal">Nepal</option>
                                                    <option value="Netherlands">Netherlands</option>
                                                    <option value="New Caledonia">New Caledonia</option>
                                                    <option value="New Zealand">New Zealand</option>
                                                    <option value="Nicaragua">Nicaragua</option>
                                                    <option value="Niger">Niger</option>
                                                    <option value="Nigeria">Nigeria</option>
                                                    <option value="Niue">Niue</option>
                                                    <option value="Norfolk Island">Norfolk Island</option>
                                                    <option value="North Korea">North Korea</option>
                                                    <option value="North Macedonia">North Macedonia</option>
                                                    <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                                    <option value="Norway">Norway</option>
                                                    <option value="Oman">Oman</option>
                                                    <option value="Pakistan">Pakistan</option>
                                                    <option value="Palau">Palau</option>
                                                    <option value="Palestine">Palestine</option>
                                                    <option value="Panama">Panama</option>
                                                    <option value="Papua New Guinea">Papua New Guinea</option>
                                                    <option value="Paraguay">Paraguay</option>
                                                    <option value="Peru">Peru</option>
                                                    <option value="Philippines">Philippines</option>
                                                    <option value="Pitcairn Islands">Pitcairn Islands</option>
                                                    <option value="Poland">Poland</option>
                                                    <option value="Portugal">Portugal</option>
                                                    <option value="Puerto Rico">Puerto Rico</option>
                                                    <option value="Qatar">Qatar</option>
                                                    <option value="Republic of the Congo">Republic of the Congo</option>
                                                    <option value="Romania">Romania</option>
                                                    <option value="Russia">Russia</option>
                                                    <option value="Rwanda">Rwanda</option>
                                                    <option value="Réunion">Réunion</option>
                                                    <option value="Saint Barthélemy">Saint Barthélemy</option>
                                                    <option value="Saint Helena, Ascension and Tristan da Cunha">Saint Helena, Ascension and Tristan da Cunha</option>
                                                    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                                    <option value="Saint Lucia">Saint Lucia</option>
                                                    <option value="Saint Martin">Saint Martin</option>
                                                    <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                                    <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                                    <option value="Samoa">Samoa</option>
                                                    <option value="San Marino">San Marino</option>
                                                    <option value="Saudi Arabia">Saudi Arabia</option>
                                                    <option value="Scarborough Reef">Scarborough Reef</option>
                                                    <option value="Senegal">Senegal</option>
                                                    <option value="Serbia">Serbia</option>
                                                    <option value="Serranilla Bank">Serranilla Bank</option>
                                                    <option value="Seychelles">Seychelles</option>
                                                    <option value="Siachen Glacier">Siachen Glacier</option>
                                                    <option value="Sierra Leone">Sierra Leone</option>
                                                    <option value="Singapore">Singapore</option>
                                                    <option value="Sint Maarten">Sint Maarten</option>
                                                    <option value="Slovakia">Slovakia</option>
                                                    <option value="Slovenia">Slovenia</option>
                                                    <option value="Solomon Islands">Solomon Islands</option>
                                                    <option value="Somalia">Somalia</option>
                                                    <option value="Somaliland">Somaliland</option>
                                                    <option value="South Africa">South Africa</option>
                                                    <option value="South Georgia">South Georgia</option>
                                                    <option value="South Korea">South Korea</option>
                                                    <option value="South Sudan">South Sudan</option>
                                                    <option value="Spain">Spain</option>
                                                    <option value="Spratly Is.">Spratly Is.</option>
                                                    <option value="Sri Lanka">Sri Lanka</option>
                                                    <option value="Sudan">Sudan</option>
                                                    <option value="Suriname">Suriname</option>
                                                    <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                                    <option value="Sweden">Sweden</option>
                                                    <option value="Switzerland">Switzerland</option>
                                                    <option value="Syria">Syria</option>
                                                    <option value="São Tomé and Príncipe">São Tomé and Príncipe</option>
                                                    <option value="Taiwan">Taiwan</option>
                                                    <option value="Tajikistan">Tajikistan</option>
                                                    <option value="Tanzania">Tanzania</option>
                                                    <option value="Thailand">Thailand</option>
                                                    <option value="Timor-Leste">Timor-Leste</option>
                                                    <option value="Togo">Togo</option>
                                                    <option value="Tokelau">Tokelau</option>
                                                    <option value="Tonga">Tonga</option>
                                                    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                                    <option value="Tunisia">Tunisia</option>
                                                    <option value="Turkey">Turkey</option>
                                                    <option value="Turkmenistan">Turkmenistan</option>
                                                    <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                                    <option value="Tuvalu">Tuvalu</option>
                                                    <option value="USNB Guantanamo Bay">USNB Guantanamo Bay</option>
                                                    <option value="Uganda">Uganda</option>
                                                    <option value="Ukraine">Ukraine</option>
                                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                                    <option value="United Kingdom">United Kingdom</option>
                                                    <option value="United States">United States</option>
                                                    <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                                    <option value="United States Virgin Islands">United States Virgin Islands</option>
                                                    <option value="Uruguay">Uruguay</option>
                                                    <option value="Uzbekistan">Uzbekistan</option>
                                                    <option value="Vanuatu">Vanuatu</option>
                                                    <option value="Vatican City">Vatican City</option>
                                                    <option value="Venezuela">Venezuela</option>
                                                    <option value="Vietnam">Vietnam</option>
                                                    <option value="Wallis and Futuna">Wallis and Futuna</option>
                                                    <option value="Western Sahara">Western Sahara</option>
                                                    <option value="Yemen">Yemen</option>
                                                    <option value="Zambia">Zambia</option>
                                                    <option value="Zimbabwe">Zimbabwe</option>
                                                    <option value="Åland Islands">Åland Islands</option>
                                                </select>
                                            </div>


                                            <div class="form-group text-start">
                                                <label class="tx-medium">Security Question</label>
                                                <select class="form-control select2-no-search" name="security_question" required="">
                                                    <option selected="" value="">Select Security Question</option>
                                                    <option value="1">What city were you born in?</option>
                                                    <option value="2">What was your high school mascot?</option>
                                                    <option value="3">What is your mother&#039;s maiden name?</option>
                                                    <option value="4">What was the make of your first car?</option>
                                                    <option value="5">What high school did you go to?</option>
                                                    <option value="6">What is the last name of your best friend?</option>
                                                    <option value="7">What is the middle name of your youngest sibling?</option>
                                                    <option value="8">What is the name of the street on which you grew up?</option>
                                                    <option value="9">What is the name of your favorite fictional character?</option>
                                                    <option value="10">What is the name of your favorite pet?</option>
                                                    <option value="11">What is the name of your favorite restaurant?</option>
                                                    <option value="12">What is the title of your favorite book?</option>
                                                    <option value="13">What is your dream job?</option>
                                                    <option value="14">Where did you go on your first date?</option>
                                                </select>
                                            </div>


                                            <div class="form-group text-start">
                                                <label class="tx-medium">Question Response</label>
                                                <input class="form-control" placeholder="Answer to security question" type="text" name="security_answer" required="">
                                            </div>




                                            <div class="form-group text-start">
                                                <label class="tx-medium">Password</label>
                                                <input class="form-control border-end-0" placeholder="Enter your password" autocomplete="new-password" type="password" data-bs-toggle="password" name="password" required="">
                                            </div>


                                            <div class="form-group text-start">
                                                <label class="tx-medium">Confirm Password</label>
                                                <input class="form-control border-end-0" placeholder="Confirm Password" autocomplete="new-password" type="password" data-bs-toggle="password" name="confirm_password" required="">
                                            </div>

                                            <div class="form-group text-start">
                                                <label class="tx-medium">Referral Code</label>
                                                <input id="referrer" class="form-control" placeholder="Referral Code (Optional)" type="text" name="referrer">
                                            </div>


                                            <button type="submit" name="submit" class="btn btn-primary btn-block">Register</button>

                                        </form>
                                        <div class="text-start mt-4 ms-0 mb-3">
                                            <p class="mb-0">Already have an account? <a href="login.php">Sign In</a></p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-6 d-none d-lg-block text-center bg-primary details rounded-end-11">
                            <div class="mt-4 pt-5 p-2 pos-relative">
                                <a href="index.html">
                                    <img src="logo.png" class="header-brand-img mb-3 mt-3" alt="logo">
                                </a>
                                <div class="clearfix"></div>
                                <img src="reg.svg" class="ht-250 mb-0" alt="user">
                                <h2 class="mt-4 text-white tx-normal">Create Your Account</h2>
                                <span class="tx-white-6 tx-13 mb-5 mt-xl-0">It's Free to Sign up and only takes a minute</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->

    </div>
    <!-- End Page -->
    <!-- chatWay LiveChat -->
    <script id="chatway" async="true" src="https://cdn.chatway.app/widget.js?id=79kko8nAEN6g"></script>

    <!-- Jquery js-->
    <script src="main/assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap js-->
    <script src="main/assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="main/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- Bootstrap Show Password js-->
    <script src="main/assets/js/bootstrap-show-password.min.js"></script>

    <!-- Perfect-scrollbar js -->
    <script src="main/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <!-- Select2 js-->
    <script src="main/assets/plugins/select2/js/select2.min.js"></script>

    <!-- Color Theme js -->
    <script src="main/assets/js/themeColors.js"></script>

    <!-- swither styles js -->
    <script src="main/assets/js/swither-styles.js"></script>

    <!-- Custom js -->
    <script src="main/assets/js/custom.js"></script>
    <!-- Smartsupp Live Chat script -->

</body>

</html>
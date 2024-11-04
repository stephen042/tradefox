<?php
include __DIR__ . '/../../mailer/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

include __DIR__ . "/../../mailer/PHPMailer.php";
include __DIR__ . "/../../mailer/SMTP.php";
include __DIR__ . "/../../mailer/Exception.php";

function sendMail($email, $subject, $message)
{

	$site_name = "247xpips";
	$mail_host = "smtp.hostinger.com";
	$mail_username = "support@247xpips.live";
	$mail_password = "247Xpips.";
	$mail_sendFrom = "support@247xpips.live";


	$mail = new PHPMailer();
	//SMTP Settings (use default cpanel email account)
	$mail->isSMTP();
	$mail->Host = $mail_host; //
	$mail->SMTPAuth = true;
	$mail->Username = $mail_username; // Default cpanel email account
	$mail->Password = $mail_password; // Default cpanel email password
	$mail->Port = 465; // 587
	$mail->SMTPSecure = "ssl"; // tls
	//Email Settings
	$mail->isHTML(true);
	$mail->setFrom($mail_sendFrom, $site_name); // Email address/ Bank bane shown to reciever
	$mail->addAddress($email);
	$mail->AddReplyTo($mail_sendFrom, $site_name); // Email address/ Bank bane shown to reciever
	$mail->Subject = $subject;
	$mail->MsgHTML($message);
	$send = $mail->Send();
	return $send;
}

function has_presence($value)
{
	$trimmed_value = text_input($value);
	return isset($trimmed_value) && $trimmed_value !== "";
}

function text_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

// * validate value has string length
// leading and trailing spaces will count
// options: exact, max, min
// has_length($first_name, ['exact' => 20])
// has_length($first_name, ['min' => 5, 'max' => 100])
function has_length($value, $options = [])
{
	if (isset($options['max']) && (strlen($value) > (int)$options['max'])) {
		return false;
	}
	if (isset($options['min']) && (strlen($value) < (int)$options['min'])) {
		return false;
	}
	if (isset($options['exact']) && (strlen($value) != (int)$options['exact'])) {
		return false;
	}
	return true;
}

// * validate value has a format matching a regular expression
// Be sure to use anchor expressions to match start and end of string.
// (Use \A and \Z, not ^ and $ which allow line returns.) 
// 
// Example:
// has_format_matching('1234', '/\d{4}/') is true
// has_format_matching('12345', '/\d{4}/') is also true
// has_format_matching('12345', '/\A\d{4}\Z/') is false
function has_format_matching($value, $regex = '//')
{
	return preg_match($regex, $value);
}

// * validate value is a number
// submitted values are strings, so use is_numeric instead of is_int
// options: max, min
// has_number($items_to_order, ['min' => 1, 'max' => 5])
function has_number($value, $options = [])
{
	if (!is_numeric($value)) {
		return false;
	}
	if (isset($options['max']) && ($value > (int)$options['max'])) {
		return false;
	}
	if (isset($options['min']) && ($value < (int)$options['min'])) {
		return false;
	}
	return true;
}

// * validate value is inclused in a set
function has_inclusion_in($value, $set = [])
{
	return in_array($value, $set);
}

// * validate value is excluded from a set
function has_exclusion_from($value, $set = [])
{
	return !in_array($value, $set);
}

// Function to forcibly end the session
function end_session()
{
	// Use both for compatibility with all browsers
	// and all versions of PHP.
	session_unset();
	session_destroy();
}

// Does the request IP match the stored value?
function request_ip_matches_session()
{
	// return false if either value is not set
	if (!isset($_SESSION['ip']) || !isset($_SERVER['REMOTE_ADDR'])) {
		return false;
	}
	if ($_SESSION['ip'] === $_SERVER['REMOTE_ADDR']) {
		return true;
	} else {
		return false;
	}
}

// Does the request user agent match the stored value?
function request_user_agent_matches_session()
{
	// return false if either value is not set
	if (!isset($_SESSION['user_agent']) || !isset($_SERVER['HTTP_USER_AGENT'])) {
		return false;
	}
	if ($_SESSION['user_agent'] === $_SERVER['HTTP_USER_AGENT']) {
		return true;
	} else {
		return false;
	}
}

// Has too much time passed since the last login?
function last_login_is_recent()
{
	$max_elapsed = 60 * 60 * 24; // 1 day
	// return false if value is not set
	if (!isset($_SESSION['last_login'])) {
		return false;
	}
	if (($_SESSION['last_login'] + $max_elapsed) >= time()) {
		return true;
	} else {
		return false;
	}
}

// Should the session be considered valid?
function is_session_valid()
{
	$check_ip = true;
	$check_user_agent = true;
	$check_last_login = true;

	if ($check_ip && !request_ip_matches_session()) {
		return false;
	}
	if ($check_user_agent && !request_user_agent_matches_session()) {
		return false;
	}
	if ($check_last_login && !last_login_is_recent()) {
		return false;
	}
	return true;
}


// Is user logged in already?
function is_logged_in()
{
	return (isset($_SESSION['user_id']));
}

// Actions to preform after every successful login
function after_successful_login($id = '')
{
	// Regenerate session ID to invalidate the old one.
	// Super important to prevent session hijacking/fixation.
	session_regenerate_id();
	$_SESSION['user_id'] = $id;

	// Save these values in the session, even when checks aren't enabled 
	$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
	$_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
	$_SESSION['last_login'] = time();
}

// Actions to preform after every successful logout
function after_successful_logout()
{
	end_session();
}

// Actions to preform before giving access to any 
// access-restricted page.
function before_every_protected_page()
{
	if (!isset($_SESSION['user_id'])) {
		header('Location: ../login.php');
		exit();
	}
}

// Use with request_is_post() to block posting from off-site forms
function request_is_same_domain()
{
	if (!isset($_SERVER['HTTP_REFERER'])) {
		// No refererer sent, so can't be same domain
		return false;
	} else {
		$referer_host = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
		$server_host = $_SERVER['HTTP_HOST'];

		// Uncomment for debugging
		// echo 'Request from: ' . $referer_host . "<br />";
		// echo 'Request to: ' . $server_host . "<br />";

		return ($referer_host == $server_host) ? true : false;
	}
}

// Must call session_start() before this loads
// Generate a token for use with CSRF protection.
// Does not store the token.
function csrf_token()
{
	return md5(uniqid(rand(), TRUE));
}

// Generate and store CSRF token in user session.
// Requires session to have been started already.
function create_csrf_token()
{
	$token = csrf_token();
	$_SESSION['csrf_token'] = $token;
	$_SESSION['csrf_token_time'] = time();
	return $token;
}

// Destroys a token by removing it from the session.
function destroy_csrf_token()
{
	$_SESSION['csrf_token'] = null;
	$_SESSION['csrf_token_time'] = null;
	return true;
}

// Return an HTML tag including the CSRF token 
// for use in a form.
// Usage: echo csrf_token_tag();
function csrf_token_tag()
{
	$token = create_csrf_token();
	return "<input type=\"hidden\" name=\"csrf_token\" value=\"" . $token . "\">";
}

// Returns true if user-submitted POST token is
// identical to the previously stored SESSION token.
// Returns false otherwise.
function csrf_token_is_valid()
{
	if (isset($_POST['csrf_token'])) {
		$user_token = $_POST['csrf_token'];
		$stored_token = $_SESSION['csrf_token'];
		return $user_token === $stored_token;
	} else {
		return false;
	}
}

// You can simply check the token validity and 
// handle the failure yourself, or you can use 
// this "stop-everything-on-failure" function. 
function die_on_csrf_token_failure()
{
	if (!csrf_token_is_valid()) {
		die("CSRF token validation failed.");
	}
}

// Optional check to see if token is also recent
function csrf_token_is_recent()
{
	$max_elapsed = 60 * 60 * 24; // 1 day
	if (isset($_SESSION['csrf_token_time'])) {
		$stored_time = $_SESSION['csrf_token_time'];
		return ($stored_time + $max_elapsed) >= time();
	} else {
		// Remove expired token
		destroy_csrf_token();
		return false;
	}
}

// GET requests should not make changes
function request_is_get()
{
	return $_SERVER['REQUEST_METHOD'] === 'GET';
}

// Only POST requests should make changes
function request_is_post()
{
	return $_SERVER['REQUEST_METHOD'] === 'POST';
}


function redirect_to($location = NULL)
{
	if ($location != NULL) {
		header("Location: {$location}");
		exit;
	}
}

function date_toText($datetime = "")
{
	$nicetime = strtotime($datetime);
	return strftime("%B %d, %Y at %I:%M %p", $nicetime);
}

function bdate_toText($datetime = "")
{
	$nicetime = strtotime($datetime);
	return strftime("%B %d, %Y", $nicetime);
}

function find_user_with_activation_code($code, $email)
{
	global $conn;
	if (!has_presence($code) || !has_presence($email)) {
		// We were expecting a token and didn't get one.
		return null;
	} else {
		$find_user = $conn->prepare("SELECT * FROM users WHERE verification_token =:code AND email =:mail LIMIT 1");
		$find_user->execute(array(':code' => $code, ':mail' => $email));
		$user = $find_user->FETCH(PDO::FETCH_ASSOC);
		return $user;
		// Note: find_one_in_fake_db returns null if not found.   
	}
}

function timeToAgo($date)
{
	$timestamp = strtotime($date);

	$strTime = array("second", "minute", "hour", "day", "month", "year");
	$length = array("60", "60", "24", "30", "12", "10");

	$currentTime = time();
	if ($currentTime >= $timestamp) {
		$diff     = time() - $timestamp;
		for ($i = 0; $diff >= $length[$i] && $i < count($length) - 1; $i++) {
			$diff = $diff / $length[$i];
		}

		$diff = round($diff);
		return $diff . " " . $strTime[$i] . "(s) ago ";
	}
}

function random_string($length)
{
	$key = '';
	$keys = array_merge(range(0, 9), range('a', 'z'));

	for ($i = 0; $i < $length; $i++) {
		$key .= $keys[array_rand($keys)];
	}

	return $key;
}

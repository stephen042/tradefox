<?php ini_set("date.timezone", "Africa/Lagos"); ?>
<?php require_once("includes/initialize.php"); ?>
<?php before_every_protected_page(); ?>
<?php




if (!function_exists("crypto_rate")) {
	function crypto_rate()
	{
		$url = "https://min-api.cryptocompare.com/data/pricemulti?fsyms=BTC,XRP,ETH,DASH,XMR,LTC,RISE,BTS&tsyms=USD";

		if (!function_exists('curl_init')) {
			die('CURL is not installed!');
		}

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		curl_close($ch);
		$d = json_decode($output, TRUE);
		return $d;
	}
}

$data =  crypto_rate();
$btcPrice = @$data['BTC']['USD'];
$xrpPrice = @$data['XRP']['USD'];
$ethPrice = @$data['ETH']['USD'];
$dashPrice = @$data['DASH']['USD'];
$xmrPrice = @$data['XMR']['USD'];
$ltcPrice = @$data['LTC']['USD'];
$risePrice = @$data['RISE']['USD'];
$btsPrice = @$data['BTS']['USD'];





$page = basename($_SERVER['PHP_SELF']);
$user = $_SESSION['user_id'];
$get_user = $conn->query("SELECT * FROM users WHERE id = '$user' LIMIT 1");
$user_row = $get_user->fetch();

$acct_query = $conn->query("SELECT * FROM account WHERE user_id = '$user' LIMIT 1");
$acct_row = $acct_query->fetch();

$deposit_stmt = $conn->query("SELECT SUM(amount) AS total_deposit FROM deposit WHERE user_id = '$user' AND status = 'COMPLETED' LIMIT 1");
$deposit_row = $deposit_stmt->fetch();

$deposit_count_stmt = $conn->query("SELECT * FROM deposit WHERE user_id = '$user' AND status = 1");
$depositCount = $deposit_count_stmt->rowCount();

$withdraw_stmt = $conn->query("SELECT SUM(amount) AS total_withdrawal FROM withdrawal WHERE user_id = '$user' AND status = 1 LIMIT 1");
$withdraw_row = $withdraw_stmt->fetch();

$withdraw_count_stmt = $conn->query("SELECT * FROM withdrawal WHERE user_id = '$user' AND status = 1");
$withdrawCount = $withdraw_count_stmt->rowCount();

$tn_stmt = $conn->query("SELECT * FROM notification WHERE user_id = '$user' LIMIT 1");
$tn_row = $tn_stmt->fetch();

$subscription_stmt = $conn->query("SELECT * FROM subscriptions WHERE user_id = '$user' LIMIT 1");
$subscription_row = $subscription_stmt->fetch();
$subscriptionCount = $subscription_stmt->rowCount();

$tprofit_stmt = $conn->query("SELECT SUM(trade_profit) AS profit FROM trade_history WHERE user_id = '$user' AND trade_result = 'Win' LIMIT 1");
$tprofit_row = $tprofit_stmt->fetch();

$settings_query = $conn->query("SELECT * FROM settings LIMIT 1");
$settings_row = $settings_query->fetch();


$traders_query = $conn->query("SELECT * FROM traders LIMIT 1");
$traders_row = $traders_query->fetch();

$url = 'https://bitpay.com/api/rates';
$json = json_decode(file_get_contents($url));
$dollar = $btc = 0;

foreach ($json as $obj) {
	if ($obj->code == 'USD')
		$btc = $obj->rate;
}
$title = "Trading Center";



?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
	<meta name="description" content="<?= $site_name ?> - Personal Portfolio">
	<meta name="author" content="<?= $site_name ?> - Personal Portfolio">
	<meta name="keywords" content="<?= $site_name ?> - Personal Portfolio">

	<!-- Favicon -->
	<link rel="icon" href="../main/assets/img/brand/favicon.ico" type="image/x-icon" />

	<!-- Title -->
	<title><?= $site_name ?> - <?= $title ?></title>

	<!-- Bootstrap css-->
	<link id="style" href="../main/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

	<!-- Icons css-->
	<link href="../main/assets/web-fonts/icons.css" rel="stylesheet" />
	<link href="../main/assets/web-fonts/font-awesome/font-awesome.min.css" rel="stylesheet">
	<link href="../main/assets/web-fonts/plugin.css" rel="stylesheet" />

	<!-- Style css-->
	<link href="../main/assets/css/1style.css" rel="stylesheet">
	<link href="../main/assets/css/plugins.css" rel="stylesheet">
	<link rel="stylesheet" href="sweetalert2/sweetalert2.min.css">
	<!-- INTERNAL Switcher css -->
	<link href="../main/assets/switcher/css/switcher.css" rel="stylesheet" />
	<link href="../main/assets/switcher/demo.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</head>

<body class="main-body leftmenu ltr dark-theme dark-menu">

	<!-- Loader 
	<div id="global-loader">
		<img src="../main/assets/img/loader.svg" class="loader-img" alt="Loader">
	</div>
	<!-- End Loader -->


	<!-- Page -->
	<div class="page">

		<!-- Main Header-->
		<div class="main-header side-header sticky">
			<div class="main-container container-fluid">
				<div class="main-header-left">
					<a class="main-header-menu-icon" href="javascript:;" id="mainSidebarToggle">
						<svg class="header-menu-icon" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24">
							<path d="M2.5,10.5h11c0.276123,0,0.5-0.223877,0.5-0.5s-0.223877-0.5-0.5-0.5h-11C2.223877,9.5,2,9.723877,2,10S2.223877,10.5,2.5,10.5z M2.5,6.5h19C21.776123,6.5,22,6.276123,22,6s-0.223877-0.5-0.5-0.5h-19C2.223877,5.5,2,5.723877,2,6S2.223877,6.5,2.5,6.5z M21.8446045,9.3519897C21.609314,9.0689697,21.189209,9.0303345,20.90625,9.265625l-2.6660156,2.2226562c-0.0315552,0.0261841-0.0606079,0.0552368-0.086792,0.086792c-0.2346802,0.2826538-0.1958008,0.7019653,0.086792,0.9366455L20.90625,14.734375c0.1194458,0.1005249,0.2706299,0.1555176,0.4267578,0.1552734c0.1973267-0.0002441,0.3843994-0.0878906,0.5109253-0.2393188c0.236145-0.2826538,0.1984863-0.7032471-0.0841675-0.9393921L19.7080078,12l2.0517578-1.7109375C22.0414429,10.0534668,22.0794067,9.6343384,21.8446045,9.3519897z M2.5,14.5h11c0.276123,0,0.5-0.223877,0.5-0.5s-0.223877-0.5-0.5-0.5h-11C2.223877,13.5,2,13.723877,2,14S2.223877,14.5,2.5,14.5z M21.5,17.5h-19C2.223877,17.5,2,17.723877,2,18s0.223877,0.5,0.5,0.5h19c0.276123,0,0.5-0.223877,0.5-0.5S21.776123,17.5,21.5,17.5z" />
						</svg>
					</a>
					<div class="hor-logo">
						<a class="main-logo" href="index.php">
							<img src="../logo.png" class="header-brand-img desktop-logo" alt="logo">
							<img src="../logo.png" class="header-brand-img desktop-logo-dark" alt="logo">
						</a>
					</div>
				</div>
				<div class="main-header-center">
					<div class="responsive-logo">
						<a href="index.php"><img src="../logo.png" class="mobile-logo" alt="logo" width="150px"></a>
						<a href="index.php"><img src="../logo.png" class="mobile-logo-dark" alt="logo" width="150px"></a>
					</div>
				</div>
				<div class="main-header-right">


					<div class="dropdown d-flex main-header-notification">
						<a class="nav-link icon" href="javascript:;">
							<svg class="header-icons" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24">
								<path d="M18,14.1V10c0-3.1-2.4-5.7-5.5-6V2.5C12.5,2.2,12.3,2,12,2s-0.5,0.2-0.5,0.5V4C8.4,4.3,6,6.9,6,10v4.1c-1.1,0.2-2,1.2-2,2.4v2C4,18.8,4.2,19,4.5,19h3.7c0.5,1.7,2,3,3.8,3c1.8,0,3.4-1.3,3.8-3h3.7c0.3,0,0.5-0.2,0.5-0.5v-2C20,15.3,19.1,14.3,18,14.1z M7,10c0-2.8,2.2-5,5-5s5,2.2,5,5v4H7V10z M13,20.8c-1.6,0.5-3.3-0.3-3.8-1.8h5.6C14.5,19.9,13.8,20.5,13,20.8z M19,18H5v-1.5C5,15.7,5.7,15,6.5,15h11c0.8,0,1.5,0.7,1.5,1.5V18z" />
							</svg>
							<span class="badge bg-info nav-link-badge">

								<svg fill="#01b8ff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
									<path d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512z" />
								</svg>
							</span>
						</a>

						<div class="dropdown-menu">
							<div class="header-navheading">
								<div class="d-flex">
									<p class="main-notification-text mx-0 my-auto">Activity Log</p>

								</div>
							</div>
							<div class="main-notification-list">

								<?php $log_query = $conn->query("SELECT * FROM activity_log WHERE user_id = '$user' ORDER BY created_at DESC LIMIT 5"); ?>
								<?php while ($row = $log_query->fetch()) { ?>

									<div class="media new">
										<div class="main-img-user online">
											<svg class="wd-20 ht-20 me-3 my-auto" fill="#01b8ff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
												<path d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z" />
											</svg>
										</div>
										<div class="media-body">
											<a href="activity-log.php">
												<p><?= $row['description'] ?></p>
												<span><?= date('d-M-Y H:i', strtotime($row['created_at'])) ?></span>
											</a>
										</div>
									</div>
								<?php } ?>
							</div>
							<div class="dropdown-footer">
								<a href="activity-log.php">View All</a>
							</div>
						</div>

					</div>
					<div class="dropdown d-flex main-profile-menu">
						<a class="d-flex" href="javascript:;">
							<span class="main-img-user">
								<img alt="avatar" src="uploads/avatar/avatar.png">
							</span>
						</a>
						<div class="dropdown-menu">
							<div class="header-navheading">
								<h6 class="main-notification-title"><?= $user_row['fullname'] ?></h6>

							</div>
							<a class="dropdown-item border-top" href="profile.php">
								<i class="fe fe-user"></i> My Profile
							</a>
							<a class="dropdown-item" href="activity-log.php">
								<i class="fe fe-compass"></i> Activity
							</a>
							<a class="dropdown-item" href="logout.php">
								<i class="fe fe-power"></i> Sign Out
							</a>
						</div>
					</div>


				</div>
			</div>
		</div>
		<!-- End Main Header-->

		<!-- Sidemenu -->
		<div class="sticky">
			<div class="main-menu main-sidebar main-sidebar-sticky side-menu">
				<div class="main-sidebar-header main-container-1 active">
					<div class="sidemenu-logo">
						<a class="main-logo" href="index.php">
							<img src="../logo.png" class="header-brand-img desktop-logo-dark" alt="logo">
							<img src="../main/assets/img/brand/icon-light.png" class="header-brand-img icon-logo-dark" alt="logo">
							<img src="../logo.png" class="header-brand-img desktop-logo" alt="logo">
							<img src="../main/assets/img/brand/icon.png" class="header-brand-img icon-logo" alt="logo">
						</a>
					</div>
					<div class="main-sidebar-body main-body-1">
						<div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#c9bebe" width="24" height="24" viewBox="0 0 24 24">
								<path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
							</svg></div>
						<ul class="menu-nav nav sidebar-active">
							<li class="nav-item <?= $page == 'index.php' ? 'active' : '' ?>">
								<a class="nav-link with-sub" href="index.php">
									<svg class="sidemenu-icon menu-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
										<path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z" />
									</svg>
									<span class="sidemenu-label">Dashboards</span>
								</a>
							</li>

							<li class="nav-item <?= $page == 'assets.php' ? 'active' : '' ?> ">
								<a class="nav-link with-sub" href="assets.php">
									<svg class="sidemenu-icon menu-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
										<path d="M96 352V96c0-35.3 28.7-64 64-64H416c35.3 0 64 28.7 64 64V293.5c0 17-6.7 33.3-18.7 45.3l-58.5 58.5c-12 12-28.3 18.7-45.3 18.7H160c-35.3 0-64-28.7-64-64zM272 128c-8.8 0-16 7.2-16 16v48H208c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h48v48c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V256h48c8.8 0 16-7.2 16-16V208c0-8.8-7.2-16-16-16H320V144c0-8.8-7.2-16-16-16H272zm24 336c13.3 0 24 10.7 24 24s-10.7 24-24 24H136C60.9 512 0 451.1 0 376V152c0-13.3 10.7-24 24-24s24 10.7 24 24l0 224c0 48.6 39.4 88 88 88H296z" />
									</svg>
									<span class="sidemenu-label">Assets</span>
								</a>
							</li>

							<li class="nav-item <?= $page == 'mining.php' ? 'active' : '' ?>">
								<a class="nav-link with-sub " href="mining.php">
									<svg class="sidemenu-icon menu-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
										<path d="M176 24V0H128V24 64H64v64H24 0v48H24 64v56H24 0v48H24 64v56H24 0v48H24 64v64h64v40 24h48V488 448h56v40 24h48V488 448h56v40 24h48V488 448h64V384h40 24V336H488 448V280h40 24V232H488 448V176h40 24V128H488 448V64H384V24 0H336V24 64H280V24 0H232V24 64H176V24zM352 160H160V352H352V160zM160 128H352h32v32V352v32H352 160 128V352 160 128h32z" />
									</svg>

									<span class="sidemenu-label">Mining</span>
								</a>
							</li>

							<li class="nav-item <?= $page == 'deposit.php' ? 'active' : '' ?>">
								<a class="nav-link with-sub " href="deposit.php">
									<svg class="sidemenu-icon menu-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
										<path d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512zM232 344V280H168c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V168c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H280v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z" />
									</svg>
									<span class="sidemenu-label">Deposit</span>
								</a>
							</li>

							<li class="nav-item <?= $page == 'sub_deposit.php' ? 'active' : '' ?>">
								<a class="nav-link with-sub " href="sub_deposit.php">
									<svg class="sidemenu-icon menu-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
										<path d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512zM232 344V280H168c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V168c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H280v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z" />
									</svg>
									<span class="sidemenu-label">Subscription Deposit</span>
								</a>
							</li>

							<li class="nav-item <?= $page == 'withdrawal.php' ? 'active' : '' ?>">
								<a class="nav-link with-sub " href="withdrawal.php">
									<svg class="sidemenu-icon menu-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
										<path d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512zM184 232H328c13.3 0 24 10.7 24 24s-10.7 24-24 24H184c-13.3 0-24-10.7-24-24s10.7-24 24-24z" />
									</svg>
									<span class="sidemenu-label">Withdrawal</span>
								</a>
							</li>

							<li class="nav-item <?= $page == 'copy.php' ? 'active' : '' ?>">
								<a class="nav-link with-sub " href="copy.php">
									<svg class="sidemenu-icon menu-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
										<path d="M352 128c0 70.7-57.3 128-128 128s-128-57.3-128-128S153.3 0 224 0s128 57.3 128 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM609.3 512H471.4c5.4-9.4 8.6-20.3 8.6-32v-8c0-60.7-27.1-115.2-69.8-151.8c2.4-.1 4.7-.2 7.1-.2h61.4C567.8 320 640 392.2 640 481.3c0 17-13.8 30.7-30.7 30.7zM432 256c-31 0-59-12.6-79.3-32.9C372.4 196.5 384 163.6 384 128c0-26.8-6.6-52.1-18.3-74.3C384.3 40.1 407.2 32 432 32c61.9 0 112 50.1 112 112s-50.1 112-112 112z" />
									</svg>
									<span class="sidemenu-label">Experts Signals</span>
								</a>
							</li>

							<li class="nav-item <?= $page == 'buy.php' ? 'active' : '' ?>">
								<a class="nav-link with-sub " href="buy.php">
									<svg class="sidemenu-icon menu-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
										<path d="M64 32C28.7 32 0 60.7 0 96v32H576V96c0-35.3-28.7-64-64-64H64zM576 224H0V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V224zM112 352h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm112 16c0-8.8 7.2-16 16-16H368c8.8 0 16 7.2 16 16s-7.2 16-16 16H240c-8.8 0-16-7.2-16-16z" />
									</svg>
									<span class="sidemenu-label">Buy Bitcoin</span>
								</a>
							</li>

							<li class="nav-item <?= $page == 'nft.php' ? 'active' : '' ?>">
								<a class="nav-link with-sub " href="nft.php">

									<svg class="sidemenu-icon menu-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
										<path d="M0 96C0 60.7 28.7 32 64 32H448c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zM323.8 202.5c-4.5-6.6-11.9-10.5-19.8-10.5s-15.4 3.9-19.8 10.5l-87 127.6L170.7 297c-4.6-5.7-11.5-9-18.7-9s-14.2 3.3-18.7 9l-64 80c-5.8 7.2-6.9 17.1-2.9 25.4s12.4 13.6 21.6 13.6h96 32H424c8.9 0 17.1-4.9 21.2-12.8s3.6-17.4-1.4-24.7l-120-176zM112 192c26.5 0 48-21.5 48-48s-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48z" />
									</svg>
									<span class="sidemenu-label">NFTs</span>
								</a>
							</li>

							<li class="nav-item <?= $page == 'subscribe.php' ? 'active' : '' ?>">
								<a class="nav-link with-sub" href="subscribe.php">
									<svg class="sidemenu-icon menu-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
										<path d="M64 32C28.7 32 0 60.7 0 96v64c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM344 152c-13.3 0-24-10.7-24-24s10.7-24 24-24s24 10.7 24 24s-10.7 24-24 24zm96-24c0 13.3-10.7 24-24 24s-24-10.7-24-24s10.7-24 24-24s24 10.7 24 24zM64 288c-35.3 0-64 28.7-64 64v64c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V352c0-35.3-28.7-64-64-64H64zM344 408c-13.3 0-24-10.7-24-24s10.7-24 24-24s24 10.7 24 24s-10.7 24-24 24zm104-24c0 13.3-10.7 24-24 24s-24-10.7-24-24s10.7-24 24-24s24 10.7 24 24z" />
									</svg>
									<span class="sidemenu-label">Subscription</span>
								</a>
							</li>

							<li class="nav-item <?= $page == 'user-verify.php' ? 'active' : '' ?>">
								<a class="nav-link with-sub " href="user-verify.php">
									<svg class="sidemenu-icon menu-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
										<path d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z" />
									</svg>
									<span class="sidemenu-label">Verify Account</span>
								</a>
							</li>

							<li class="nav-item ">
								<a class="nav-link with-sub" href="logout.php">
									<svg class="sidemenu-icon menu-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
										<path d="M160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96C43 32 0 75 0 128V384c0 53 43 96 96 96h64c17.7 0 32-14.3 32-32s-14.3-32-32-32H96c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32h64zM504.5 273.4c4.8-4.5 7.5-10.8 7.5-17.4s-2.7-12.9-7.5-17.4l-144-136c-7-6.6-17.2-8.4-26-4.6s-14.5 12.5-14.5 22v72H192c-17.7 0-32 14.3-32 32l0 64c0 17.7 14.3 32 32 32H320v72c0 9.6 5.7 18.2 14.5 22s19 2 26-4.6l144-136z" />
									</svg>
									<span class="sidemenu-label">Logout</span>
								</a>
							</li>
						</ul>
						<div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#c9bebe" width="24" height="24" viewBox="0 0 24 24">
								<path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
							</svg></div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Sidemenu -->
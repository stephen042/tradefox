<?php ini_set("date.timezone", "Africa/Lagos"); ?>
<?php require_once("user/includes/initialize.php"); ?>
<?php require_once("user/includes/mail_function.php"); ?>
<?php
if (isset($_POST['recover'])) {
	if (request_is_post() && request_is_same_domain()) {
		if (!csrf_token_is_valid() || !csrf_token_is_recent()) {
			set_message('<div class="alert alert-danger">
                  <strong><i class="fa fa-info-circle"></i></strong> Sorry, request was not valid.
            </div>');
		} else {
			// CSRF tests passed--form was created by us recently.
			// retrieve the values submitted via the form
			$email_address = trim($_POST['email']);

			if (!has_presence($email_address)) {
				set_message('<div class="alert alert-danger">
                <strong><i class="fa fa-info-circle"></i></strong> Enter a valid email address and try again.
            </div>');
				redirect_to("forgot-password.php");
			} else {
				// Search our database to retrieve the user data
				$user_data = $conn->prepare("SELECT email FROM users WHERE email =:mail LIMIT 1");
				$user_data->execute(array(':mail' => $email_address));
				$count = $user_data->rowCount();

				if ($count > 0) {
					// Email was found; okay to reset
					create_reset_token($email_address);
					email_reset_token($email_address);

					set_message('<div class="alert alert-success">
                      <strong><i class="fa fa-info-circle"></i></strong> A link to reset your password has been sent to your email address. Follow this link to reset your password
                  </div>');
					redirect_to("forgot-password.php");
				} else {
					// Email was not found; don't do anything
					set_message('<div class="alert alert-danger">
                    <strong><i class="fa fa-info-circle"></i></strong> User with this email address does not exist. Please try again
                  </div>');
					redirect_to("forgot-password.php");
				}
				// Message returned is the same whether the user 
				// was found or not, so that we don't reveal which 
				// Email exist and which do not. 

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
	<meta name="description" content="<?= $site_name ?> - Reset your Password">
	<meta name="author" content="<?= $site_name ?> - Reset your Password">
	<meta name="keywords" content="<?= $site_name ?> - Reset your Password">

	<!-- Favicon -->
	<link rel="icon" href="main/assets/img/brand/favicon.ico" type="image/x-icon" />

	<!-- Title -->
	<title><?= $site_name ?> - Reset your Password</title>

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

										<h2 class="text-start mb-2">Forgot Password</h2>
										<p class="mb-3 text-muted tx-13 ms-0 text-start">Don't worry! We will help you to recover your password.</p>

										<center> <?php get_message(); ?> </center>

										<form method="POST" action="forgot-password.php">
											<?php echo csrf_token_tag(); ?>


											<div class="form-group text-start">
												<label class="tx-medium">Enter the Email Address associated with your account</label>
												<input class="form-control" placeholder="Enter email" type="email" autocomplete="username" name="email" required="" value="">
											</div>


											<button type="submit" class="btn btn-primary btn-block" name="recover">Request reset link</button>

										</form>
										<div class="card-footer border-top-0 ps-0 mt-3 text-start mb-0 ">
											<p>Did you remembered your password?</p>
											<p class="mb-0">Try to <a href="login.php">Signin</a></p>
										</div>
										<div class="signin-or-title">
											<h5 class="fs-12 mb-1 title tx-normal">or</h5>
										</div>
										<div class="pb-1 pt-4">
											<div class="text-center socialicons">
												<a href="#" target="_blank" class="btn ripple btn-danger-transparent rounded-circle" role="button"><i class="mdi mdi-google"></i></a>
												<a href="#" target="_blank" class="btn ripple btn-primary-transparent rounded-circle" role="button"><i class="mdi mdi-facebook"></i></a>
												<a href="#" target="_blank" class="btn ripple btn-info-transparent rounded-circle" role="button"><i class="mdi mdi-twitter"></i></a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-xl-6 d-none d-lg-block text-center bg-primary details rounded-end-11">
							<div class="mt-4 pt-3 p-2 pos-relative">
								<div class="clearfix"></div>
								<img src="forgot.svg" class="ht-200 mb-0" alt="user">
								<h2 class="mt-4 text-white tx-normal">Reset Your Password</h2>
								<span class="tx-white-6 tx-13 mb-5 mt-xl-0">Don't worry! We will help you to recover your password</span>
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

</body>

</html>
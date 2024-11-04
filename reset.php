<?php ini_set("date.timezone", "Africa/Lagos"); ?>
<?php require_once("user/includes/initialize.php"); ?>
<?php require_once("user/includes/mail_function.php"); ?>
<?php
$token = $_GET['token'];
// Confirm that the token sent is valid
$user = find_user_with_token($token);
$email = $user['email'];
if(!$user) {
  // Token wasn't sent or didn't match a user.
  set_message('<div class="alert alert-danger">
       <strong><i class="fa fa-info-circle"></i></strong> Invalid token sent or User was not found. Please try again.
  </div>');
  redirect_to('forgot-password.php');
}

if(isset($_POST['reset'])){
  if(request_is_post() && request_is_same_domain()) {
  
      // retrieve the values submitted via the form
      $new_password = $_POST['new_password'];
      $confirm_password = $_POST['confirm_password'];
      if(!has_presence($new_password) || !has_presence($confirm_password)) {
          set_message('<div class="alert alert-danger">
            <strong><i class="fa fa-info-circle"></i></strong> Password and Confirm Password are required fields.
          </div>');
      } elseif(!has_length($new_password, ['min' => 7])) {
          set_message('<div class="alert alert-danger">
            <strong><i class="fa fa-info-circle"></i></strong> Password and Confirm Password are required Password must be at least 7 characters long.
          </div>');
      } elseif($new_password !== $confirm_password) {
          set_message('<div class="alert alert-danger">
            <strong><i class="fa fa-info-circle"></i></strong> Password confirmation does not match password.
          </div>');
      } else {
           // password and password_confirm are valid
           // Hash the password and save it to the fake database
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
            $update_password = $conn->prepare("UPDATE users SET password =:pass, password_hash =:pass_hash WHERE email=:mail");
            $update_password->bindparam(':pass', $new_password);
            $update_password->bindparam(':pass_hash', $hashed_password);
            $update_password->bindparam(':mail', $email);
            $update_password->execute();

            delete_reset_token($email);
            set_message('<div class="alert alert-success">
                <strong><i class="fa fa-info-circle"></i></strong> Congratulations! Your password has been resetted. You may now login to your account.
            </div>');
            redirect_to('login.php');
       
      }       
  } // End of request_is_post() && request_is_same_domain()
} // End of $_POST['submit']
?>


<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
	<meta name="description" content="<?=$site_name?> - Create New Password">
	<meta name="author" content="<?=$site_name?> - Create New Password">
	<meta name="keywords" content="<?=$site_name?> - Create New Password">

	<!-- Favicon -->
	<link rel="icon" href="main/assets/img/brand/favicon.ico" type="image/x-icon"/>

	<!-- Title -->
	<title><?=$site_name?> - Create New Password</title>

	<!-- Bootstrap css-->
	<link id="style" href="main/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

	<!-- Icons css-->
	<link href="main/assets/web-fonts/icons.css" rel="stylesheet"/>
	<link href="main/assets/web-fonts/font-awesome/font-awesome.min.css" rel="stylesheet">
	<link href="main/assets/web-fonts/plugin.css" rel="stylesheet"/>

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
										<div class="mobilelogo">
											<img src="logo.png" class=" d-lg-none header-brand-img text-start float-start mb-4 dark-logo" alt="logo">
											<img src="logo.png" class=" d-lg-none header-brand-img text-start float-start mb-4 light-logo" alt="logo">
										</div>
										<div class="clearfix"></div>
										<h2 class="text-start mb-2">Reset Your Password</h2>
										<p class="mb-4 text-muted tx-13 ms-0 text-start">Don't worry! We will help you to reset your password.</p>
										
										<center><?php get_message(); ?></center>
										
										<form method="POST" action="reset.php?token=<?= $token; ?>">
										    
										    
											<div class="form-group text-start">
												<label class="tx-medium">Password</label>
												<input class="form-control border-end-0" placeholder="Enter your password" type="password" name="new_password" required="" autocomplete="new-password" data-bs-toggle="password">
											</div>
											
											
											<div class="form-group text-start">
												<label class="tx-medium">Confirm Password</label>
												<input class="form-control border-end-0" placeholder="Confirm your password" type="password" name="confirm_password" required="" autocomplete="new-password" data-bs-toggle="password">
											</div>
											
											<button type="submit" class="btn btn-primary btn-block mb-4" name="reset">Save Password </button>
										
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
										</form>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-xl-6 d-none d-lg-block text-center bg-primary details rounded-end-11">
							<div class="mt-4 pt-5 p-2 pos-relative">
							
								<img src="forgot.svg" class="ht-250 mb-0" alt="user">
								<h2 class="mt-4 text-white tx-normal">Reset Your Password</h2>
								<span class="tx-white-6 tx-13 mb-5 mt-xl-0">Don't worry! We will help you to reset your password</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Row -->

	</div>
	<!-- End Page -->

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

</body>
</html>
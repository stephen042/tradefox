<?php ini_set("date.timezone", "Africa/Lagos"); ?>
<?php require_once("user/includes/initialize.php"); ?>
<?php if(isset($_SESSION['user_id'])) {
        end_session();
      }
?>
<?php
  if(isset($_POST['login'])){
    if(request_is_post() && request_is_same_domain()) {
        if(!csrf_token_is_valid() || !csrf_token_is_recent()) {
            set_message('<div class="alert alert-danger">
                  <strong><i class="fa fa-info-circle"></i></strong> Sorry, request was not valid.
            </div>');
        } else {
          // retrieve the values submitted via the form
          $username_email = strip_tags(trim($_POST['username_email']));
          $password = trim($_POST['password']);
          $ip_address = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
          $created = date("Y-m-d H:i:s");
          $activity = 'Account signed-in';

          if(!has_presence($username_email) || !has_presence($password)) {
                set_message('<div class="alert alert-danger">
                      <strong><i class="fa fa-info-circle" aria-hidden="true"></i></strong> All fields are required
                </div>');
          } else {
                $login_stmt = $conn->prepare("SELECT id, password_hash, status FROM users WHERE username =:umail OR email=:umail LIMIT 1");
                $login_stmt->execute(array(':umail' => $username_email));
                $found_user = $login_stmt->FETCH(PDO::FETCH_ASSOC);

                if(($found_user['status'] == 1) && password_verify($password, $found_user['password_hash'])) {
                  // successful login
                  after_successful_login($found_user['id']);
                              
                  $stmt = $conn->prepare("UPDATE users SET ip_address=:ip, last_login=:created WHERE id=:uid");
                  $stmt->bindparam(':ip', $ip_address);
                  $stmt->bindparam(':created', $created);
                  $stmt->bindparam(':uid', $found_user['id']);
                  $stmt->execute();

                  $activity_stmt = $conn->prepare("INSERT INTO activity_log(user_id,description,created_at) VALUES(:uid, :description, :created)");
                  $activity_stmt->bindparam(':uid', $found_user['id']);
                  $activity_stmt->bindparam(':description', $activity);
                  $activity_stmt->bindparam(':created', $created); 
                  $activity_stmt->execute();

                  redirect_to("user/index.php");
                  exit();

              } elseif($found_user['status'] == 0 && password_verify($password, $found_user['password_hash'])) {
                  set_message('<div class="alert alert-danger">
                      <i class="fa fa-info-circle"></i> Your account has been blocked. Please contact support
                  </div>');
              } else {
                  // failed login
                  set_message('<div class="alert alert-danger">
                    <i class="fa fa-info-circle"></i> Login Failed. Username or Email/password combination not found
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
	<meta name="description" content="<?=$site_name?> - Login to Dashboard">
	<meta name="author" content="<?=$site_name?> - Login to Dashboard">
	<meta name="keywords" content="<?=$site_name?> - Login to Dashboard">

	<!-- Favicon -->
	<link rel="icon" href="main/assets/img/brand/favicon.ico" type="image/x-icon"/>

	<!-- Title -->
	<title><?=$site_name?> - Login to Dashboard</title>

	<!-- Bootstrap css-->
	<link id="style" href="main/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

	<!-- Icons css-->
	<link href="main/assets/web-fonts/icons.css" rel="stylesheet"/>
	<link href="main/assets/web-fonts/font-awesome/font-awesome.min.css" rel="stylesheet">
	<link href="main/assets/web-fonts/plugin.css" rel="stylesheet"/>

	<!-- Style css-->
	<link href="main/assets/css/style.css" rel="stylesheet">
	<link href="main/assets/css/plugins.css" rel="stylesheet">
    <script src="/plugins/sweetalert/js/sweetalert.min.js"></script>
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
											<h2 class="text-start mb-2">Sign In</h2>
											<p class="mb-4 text-muted tx-13 ms-0 text-start">Sign in to start trading crypto, forex and stocks.</p>
											<div class="panel desc-tabs border-0 p-0">
											   
									<center><?php get_message(); ?></center>
											
										<form method="POST" action="login.php">
                                            <?php echo csrf_token_tag(); ?>
												<div class="panel-body tabs-menu-body mt-2">
													<div class="tab-content">
														<div class="tab-pane active" id="tab01">
															<div class="form-group text-start">
																<label class="tx-medium">Email</label>
																<input class="form-control" name="username_email" placeholder="Enter your email" type="text" autocomplete="username" required>
															</div>
															<div class="form-group text-start">
																<label class="tx-medium">Password</label>
																<input class="form-control border-end-0" placeholder="Enter your password" name="password" type="password" autocomplete="new-password" data-bs-toggle="password" required>
															</div>
															<button type="submit" name="login" class="btn btn-primary btn-block">Sign In</button>
        
														</div>
													</div>
												</div>
											</div>
										</form>
										<div class="text-start mt-4 ms-0 mb-3">
											<div class="mb-1"><a href="forgot-password.php">Forgot password?</a></div>
											<div>Don't have an account? <a href="register.php">Register Here</a></div>
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
							<div class="mt-4 pt-4 p-2 pos-relative">
								<img src="logo.png" class="header-brand-img mb-3 mt-3" alt="logo">
								<div class="clearfix"></div>
								<img src="user.svg" class="ht-250 mb-0" alt="user">
								<h2 class="mt-4 text-white tx-normal">Sign In Your Account</h2>
								<span class="tx-white-6 tx-13 mb-5 mt-xl-0">Sign in to start trading crypto, forex and stocks.</span>
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

	<!-- generate-otp js -->
	<script src="main/assets/js/generate-otp.js"></script>

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
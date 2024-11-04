<?php $title = "Change Password"; ?>
<?php include("header.php"); ?>
<?php
if(isset($_POST['reset'])){
  if(request_is_post() && request_is_same_domain()) {
    
    if(!csrf_token_is_valid() || !csrf_token_is_recent()) {
      set_message('<div class="alert alert-danger">
            <strong>Error</strong> - Sorry, request was not valid.
      </div>');
    } else {
      // CSRF tests passed--form was created by us recently.

      // retrieve the values submitted via the form

      if(isset($_POST['current_password'])) { $current_password = $_POST['current_password']; }
      if(isset($_POST['new_password'])) { $new_password = $_POST['new_password']; }
      if(isset($_POST['confirm_password'])) { $confirm_password = $_POST['confirm_password']; }
      $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
      $admin = $_SESSION['admin_id']; 
      $get_user = $conn->query("SELECT * FROM admin WHERE id = '$admin' LIMIT 1");
      $user_row = $get_user->fetch();      

      $check_password = $conn->prepare("SELECT id, password FROM admin WHERE id=:id LIMIT 1");
      $check_password->execute(array(':id' => $admin));
      $found_user = $check_password->FETCH(PDO::FETCH_ASSOC);
      
      if(!has_presence($current_password) || !has_presence($new_password) || !has_presence($confirm_password)) {
          set_message('<div class="alert alert-danger">
              <i class="fa fa-info-circle"></i> All fields are required
          </div>');
      } elseif(!password_verify($current_password, $found_user['password'])){
          set_message('<div class="alert alert-danger">
              <i class="fa fa-info-circle"></i> Invalid current password. Try again with a valid password
          </div>');
      } elseif (!has_length($new_password, ['min' => 7, 'max' => 15])) {
          set_message('<div class="alert alert-danger">
              <i class="fa fa-info-circle"></i> Password must be between 7 and 15 characters
          </div>');
      } elseif ($new_password !== $confirm_password) {
          set_message('<div class="alert alert-danger">
              <i class="fa fa-info-circle"></i> Passwords do not match. Please try again!
          </div>');
      } else {
        $query = "UPDATE admin SET password =:pass WHERE id =:id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $admin);
        $stmt->bindParam(':pass', $hashed_password);

        // check for successfull registration
        if ($stmt->execute() ) {
          after_successful_logout();
          session_start();
          set_message('<div class="alert alert-success">
            <i class="fa fa-info-circle" aria-hidden="true"></i> You password was successfully changed. Login with your new password.
          </div>');
          redirect_to("index.php");
        } else {
          set_message('<div class="alert alert-danger">
              <i class="fa fa-info-circle" aria-hidden="true"></i> An error occurred, try again later
          </div>');
          redirect_to("change_password.php");
        }
      }       
    } // End of !csrf_token_is_valid() || !csrf_token_is_recent()
  } // End of request_is_post() && request_is_same_domain()
} // End of $_POST
?>  
<body class="hold-transition skin-yellow sidebar-mini">
<div class="wrapper">

  <?php include("topnav.php"); ?>
  
  <!-- Left side column. contains the logo and sidebar -->
  <?php include("sidenav.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Change Passowrd
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item active">Change Passowrd</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
      <div class="col-sm-12">
          <?php get_message(); ?>
      </div>
    </div>  

      <div class="row">
          <div class="col-md-12">
            <div class="box box-solid bg-dark">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-lock"></i> Reset Passowrd</h3>

                  <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form class="form" method="post" action="change_password.php">
                      <?= csrf_token_tag(); ?>
                      <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input class="form-control border-primary" type="password" name="current_password" placeholder="Enter Current Password" required>
                      </div>

                      <div class="form-group">
                        <label for="current_password">New Password</label>
                        <input class="form-control border-primary" type="password" name="new_password" placeholder="Enter New Password" required>
                      </div>

                      <div class="form-group">
                        <label for="acct_swift">Confirm Password</label>
                        <input class="form-control border-primary" type="password" name="confirm_password" placeholder="Re-enter New Password" required>
                      </div>

                      <div class="form-group">
                        <button name="reset" type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> Reset Password</button>
                      </div>
                    </form>
                </div>
                <!-- /.box-body -->
     
            </div>
            <!-- /.box -->
         </div>
         <!-- Col -->
	</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include('footer.php'); ?>
<?php ini_set("date.timezone", "Africa/Lagos"); ?>
<?php require_once("includes/initialize.php"); ?>
<?php before_every_protected_page(); ?>
<?php 
    $user = $_SESSION['user_id']; 
    $get_user = $conn->query("SELECT * FROM users WHERE id = '$user' LIMIT 1");
    $user_row = $get_user->fetch();

    $acct_query = $conn->query("SELECT * FROM account WHERE user_id = '$user' LIMIT 1");
    $acct_row = $acct_query->fetch();
?>
<?php
if(isset($_POST['reset'])){
  if(request_is_post() && request_is_same_domain()) {
      $current_password = strip_tags($_POST['current_password']);
      $new_password = strip_tags($_POST['new_password']);
      $confirm_password = strip_tags($_POST['confirm_password']);
      $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
      $check_password = $conn->prepare("SELECT id, password_hash FROM users WHERE id=:uid LIMIT 1");
      $check_password->execute(array(':uid' => $user));
      $found_user = $check_password->FETCH(PDO::FETCH_ASSOC);
      
      if(!has_presence($current_password) || !has_presence($new_password) || !has_presence($confirm_password)) {
          set_message('<script>
            Swal.fire(
               "Error!",
               "All fields are required",
               "warning"
            );
          </script>');
      } elseif(!password_verify($current_password, $found_user['password_hash'])){
          set_message('<script>
            Swal.fire(
              "Error!",
              "Invalid current password. Try again with a valid password",
              "warning"
            );
          </script>');
      } elseif (!has_length($new_password, ['min' => 7, 'max' => 15])) {
          set_message('<script>
            Swal.fire(
              "Password Length!",
              "Password must be between 7 and 15 characters",
              "warning"
            );
          </script>');
      } elseif ($new_password !== $confirm_password) {
          set_message('<script>
            Swal.fire(
              "Error!",
              "Passwords do not match. Please try again!",
              "warning"
            );
          </script>');
      } else {
        $query = "UPDATE users SET password =:pass, password_hash =:pass_hash WHERE id =:uid";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':pass', $new_password);
        $stmt->bindParam(':pass_hash', $hashed_password);
        $stmt->bindParam(':uid', $user);

        if ( $stmt->execute() ) {
          after_successful_logout();
          session_start();
          set_message('<div class="alert alert-success">
            <i class="fa fa-info-circle"></i>
                You password was successfully changed. Login with your new password.
            </div>');
          redirect_to("../login.php");
        } else {
          set_message('<script>
            Swal.fire(
              "Error!",
              "An error occurred. Please try again!",
              "error"
            );
          </script>');
        }
      }       
  } // End of request_is_post() && request_is_same_domain()
} // End of $_POST['signup']
?>
  <div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        
                    </div>
                    <div class="card-content">
                        <div class="row">
                            <div class="col-md-2">
                                <ul class="nav nav-pills nav-pills-icons nav-pills-primary nav-stacked" role="tablist">
                                    <li class="active">
                                        <a href="#withdraw" role="tab" data-toggle="tab">
                                            <i class="material-icons">lock</i>UPDATE PASSWORD
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-10">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="withdraw">
                                        <div class="alert alert-info">
                                            <span class="text-center">PASSWORD UPDATE SECTION</span><br>
                                        </div>
                                        <form action="change-password.php" method="post">
                                          <?= csrf_token_tag(); ?>       
                                            <div class="row">
                                                <div class="col-md-6 col-md-offset-3">
                                                    <div class="form-group label-floating is-empty">
                                                        <label class="control-label" for="current_password">CURRENT PASSWORD</label>
                                                        <input id="current_password" name="current_password" type="password" class="form-control" required="">
                                                    <span class="material-input"></span></div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6 col-md-offset-3">
                                                    <div class="form-group label-floating is-empty">
                                                        <label class="control-label" for="new_password">NEW PASSWORD</label>
                                                        <input id="new_password" name="new_password" type="password" class="form-control" required="">
                                                    <span class="material-input"></span></div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6 col-md-offset-3">
                                                    <div class="form-group label-floating is-empty">
                                                        <label class="control-label" for="confirm_password">CONFIRM PASSWORD</label>
                                                        <input id="confirm_password" name="confirm_password" type="password" class="form-control" required="">
                                                    <span class="material-input"></span></div>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <a href="index.php" class="btn btn-rose">Cancel</a>
                                            <button type="submit" name="reset" class="btn btn-success pull-right">Save Chnages</button>
                                            <div class="clearfix"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
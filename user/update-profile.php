<?php ini_set("date.timezone", "Africa/Lagos"); ?>
<?php require_once("includes/initialize.php"); ?>
<?php before_every_protected_page(); ?>
<?php
if(isset($_POST['update'])){
  if(request_is_post() && request_is_same_domain()) {
      // retrieve the values submitted via the form
      $fullname = strip_tags($_POST['fullname']);
      $country = strip_tags($_POST['country']);
      $gender = strip_tags($_POST['gender']);
      $phone = strip_tags($_POST['phone']);
      $user = $_SESSION['user_id']; 

      $update_stmt = $conn->prepare('UPDATE users SET fullname =:fname, country =:country, gender =:gender, phone =:phone WHERE id=:id');
      $update_stmt->bindParam(':fname', $fullname);
      $update_stmt->bindParam(':country', $country);
      $update_stmt->bindParam(':gender', $gender);
      $update_stmt->bindParam(':phone', $phone);
      $update_stmt->bindParam(':id', $user);
                        
      if ($update_stmt->execute()) {
          set_message('
            <script>
              Swal.fire(
                "Updated Successful",
                "Your Profile Has Been Successfully Updated.",
                "success"
              );
            </script>
          ');
          redirect_to("profile.php");
      } else {
          set_message('<script>
            Swal.fire(
              "Error!",
              "An error occurred. Try again",
              "warning"
            );
          </script>');
      }
  } // End of request_is_post() && request_is_same_domain()
} // End of $_POST['']
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
<?php ini_set("date.timezone", "Africa/Lagos"); ?>
<?php require_once("includes/initialize.php"); ?>
<?php if(isset($_SESSION['admin_id'])) {
      header('Location: home.php');
      }
?>
<?php
if(isset($_POST['login'])){
  if(request_is_post() && request_is_same_domain()) {
    
    if(!csrf_token_is_valid() || !csrf_token_is_recent()) {
      set_message('<div class="alert alert-danger alert-dismissible">
            <strong>Error</strong> - Sorry, request was not valid.
      </div>');
    } else {
      // CSRF tests passed--form was created by us recently.

      // retrieve the values submitted via the form
      if(isset($_POST['username'])) { $username = $_POST['username']; }
      if(isset($_POST['password'])) { $password = $_POST['password']; }
      $ip_address = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
      $created = date("Y-m-d H:i:s");

      if(!has_presence($username) || !has_presence($password)) {
           set_message('<div class="alert alert-danger alert-dismissible">
              <strong>Error</strong> - All fields are required
           </div>');
      } else {
           $login_stmt = $conn->prepare("SELECT id, username, password FROM admin WHERE username=:user LIMIT 1");
           $login_stmt->execute(array(':user' => $username));
           $found_user = $login_stmt->FETCH(PDO::FETCH_ASSOC);
           $count = $login_stmt->rowCount();

           if($found_user && password_verify($password, $found_user['password'])) {
            // successful login
            //$_SESSION['admin_id'] = $found_user['id'];
            after_successful_login($found_user['id']);
                        
            redirect_to("home.php");
            exit();
           } else {
            // failed login
            set_message('<div class="alert alert-danger alert-dismissible">
                <strong>Error</strong> - Login Failed. Username/password combination not found.
            </div>');
          }
      }       
    } // End of !csrf_token_is_valid() || !csrf_token_is_recent()
  } // End of request_is_post() && request_is_same_domain()
} // End of $_POST
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Administrator | <?=$site_name?></title>
  <!--favicon-->
  <link rel="icon" href="dist/images/favicon.png" type="image/x-icon">
  <!-- Bootstrap core CSS-->
  <link href="dist/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="dist/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="dist/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Custom Style-->
  <link href="dist/css/app-style.css" rel="stylesheet"/>
  
</head>

<body style="background-image: url('dist/images/bg2.jpg');">
 <!-- Start wrapper-->
 <div id="wrapper">
  <div class="card border-warning border-top-sm border-bottom-sm card-authentication1 mx-auto my-5">
    <div class="card-body">
     <div class="card-content p-2">
      <div class="text-center">
        <img src="dist/images/logo-icon.png">
      </div>
      <div class="card-title text-uppercase text-center py-3">Admin Login</div>
      <?php get_message(); ?>
        <form action="index.php" method="post">
        <?php echo csrf_token_tag(); ?>
        <div class="form-group">
         <div class="position-relative has-icon-right">
          <label for="exampleInputUsername" class="sr-only">Username</label>
          <input type="text" id="exampleInputUsername" name="username" class="form-control form-control-rounded" placeholder="Username">
          <div class="form-control-position">
            <i class="icon-user"></i>
          </div>
         </div>
        </div>
        <div class="form-group">
         <div class="position-relative has-icon-right">
          <label for="exampleInputPassword" class="sr-only">Password</label>
          <input type="password" id="exampleInputPassword" name="password" class="form-control form-control-rounded" placeholder="Password">
          <div class="form-control-position">
            <i class="icon-lock"></i>
          </div>
         </div>
        </div>

       <button name="login" type="submit" class="btn btn-warning shadow-warning btn-round btn-block waves-effect waves-light">Login</button>
        
       </form>
       </div>
      </div>
       </div>
    
  </div><!--wrapper-->
  
  <!-- Bootstrap core JavaScript-->
  <script src="dist/js/jquery.min.js"></script>
  <script src="dist/js/popper.min.js"></script>
  <script src="dist/js/bootstrap.min.js"></script>
</body>
</html>
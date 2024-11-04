<?php $title = "Manage Users"; ?>
<?php include("header.php"); ?>

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
        Manage Users
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item active">Manage Users</li>
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
        <div class="col-12">
          <div class="box box-solid bg-dark">
            <div class="box-header with-border">
              <h3 class="box-title">All Users</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example2" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
              <thead>
                <tr>
                  <th>S/N</th>
                  <th>Fullname</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Password</th>
                  <th>Country</th>
                  <th>Gender</th>
                  <th>Status</th>
                  <th>Joining Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php $list_users = $conn->query("SELECT * FROM users ORDER BY date_registered DESC"); ?>
              <?php $sn = 1; ?>
              <?php while($row = $list_users->fetch()){ ?>
                <tr>
                  <td><?= $sn++; ?></td>
                  <td><?= $row['fullname'] ?></td>
                  <td><?= $row['username']; ?></td>
                  <td><?= $row['email']; ?></td>
                  <td><?= $row['password']; ?></td>
                  <td><?= $row['country']; ?></td>
                  <td><?= $row['gender']; ?></td>
                  <td><?php if($row['status'] == 0){ echo '<span class="label label-danger">Blocked</span>'; } elseif($row['status'] == 10) { echo '<span class="label label-success">Active</span>'; } ?></td>
                  <td><?= date('jS M, Y', strtotime($row['date_registered'])); ?></td>
                  <td style="white-space: nowrap;">
  				  <form method="POST" action="../login.php" style="display:inline">
                    <?php echo csrf_token_tag(); ?>
    					<input name="username_email" type="hidden" value="<?php echo $row['email'] ?>" required>
    					<input name="password" type="hidden" value="<?php echo $row['password'] ?>">
    					<button type="submit" name="login" class="btn btn-primary">Login</button>
    			  </form>
                    <a href="javascript:confirmBlock('block_user.php?uid=<?php echo $row['id']; ?>')" class="<?php if($row['status'] == 10){ echo 'btn btn-warning'; } elseif($row['status'] == 0) { echo 'btn btn-success'; }?>"><?php if($row['status'] == 10){ echo '<i class="fa fa-times"></i> Block'; } elseif($row['status'] == 0) { echo '<i class="fa fa-check"></i> Unblock'; } ?></a>
                    <a href="javascript:confirmDelete('delete_user.php?uid=<?php echo $row['id']; ?>')" class="btn btn-danger"> <i class="fa fa-trash"></i> Delete</a>
                   </td>
                </tr>
              <?php } ?>
              </tbody>          
            </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->         
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->    
    
  </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <footer class="main-footer">
      &copy; <?= date('Y'); ?> <?=$site_name?>. All Rights Reserved.
  </footer>
  
</div>
<!-- ./wrapper -->
    
  <!-- jQuery 3 -->
  <script src="assets/vendor_components/jquery/dist/jquery.js"></script>
  
  <!-- popper -->
  <script src="assets/vendor_components/popper/dist/popper.min.js"></script>
  
  <!-- Bootstrap 4.0-->
  <script src="assets/vendor_components/bootstrap/dist/js/bootstrap.js"></script>
  
  <!-- Slimscroll -->
  <script src="assets/vendor_components/jquery-slimscroll/jquery.slimscroll.js"></script>
  
  <!-- This is data table -->
  <script src="assets/vendor_plugins/DataTables-1.10.15/media/js/jquery.dataTables.min.js"></script>
  
  <!-- Crypto_Admin App -->
  <script src="js/template.js"></script>
  
  <!-- Crypto_Admin for Data Table -->
  <script src="js/pages/data-table.js"></script>
  <script>    
    function confirmBlock(blockUrl) {
      if (confirm("Are you sure?")) {
        document.location = blockUrl;
      }
    }

    function confirmDelete(delUrl) {
      if (confirm("Are you sure?")) {
        document.location = delUrl;
      }
    }
  </script>  
</body>
</html>
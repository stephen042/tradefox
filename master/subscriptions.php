<?php $title = "Subscriptions"; ?>
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
        Subscriptions
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item active">Subscriptions</li>
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
              <h3 class="box-title">All Subscriptions</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                
              <table id="example2" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                <thead>
                  <tr>
                    <th>S/n</th>
                    <th>Fullname</th>
                    <th>Plan</th>
                    <th>Amount Invested</th>
                    <th>Duration</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    
                  <?php $investments = $conn->query("SELECT subscriptions.id, fullname, plan_id, amount, created_at FROM subscriptions, users WHERE subscriptions.user_id = users.id AND users.status = 1 ORDER BY subscriptions.created_at DESC");
                  ?>
                  <?php $sn = 1; ?>
                  <?php while($row = $investments->fetch()){ ?>
                  <?php
                    $plan_id = $row['plan_id']; 
                    $packageQuery = $conn->query("SELECT * FROM packages WHERE id = '$plan_id' LIMIT 1"); 
                    $packageRow = $packageQuery->fetch();
                  ?>
                    <tr>
                      <td><?php echo $sn++; ?></td>
                      <td><?= $row['fullname']  ?></td>
                      <td><?= $packageRow['name'] ?></td>
                      <td>$<?= number_format($row['amount']); ?></td>
                      <td>7days</td>
                      <td><?= date('D, d-M-Y', strtotime($row['created_at'])); ?></td>
                      <td style="white-space: nowrap;">
                        <a class="btn btn-danger" href="javascript:confirmEnd('end_subscription.php?id=<?= $row['id']; ?>')"><i class="fa fa-times-circle"></i> End Subscription</a>
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
  
  <!-- FastClick -->
  <script src="assets/vendor_components/fastclick/lib/fastclick.js"></script>
  
  <!-- This is data table -->
  <script src="assets/vendor_plugins/DataTables-1.10.15/media/js/jquery.dataTables.min.js"></script>
  
  <!-- Crypto_Admin App -->
  <script src="js/template.js"></script>
  
  <!-- Crypto_Admin for Data Table -->
  <script src="js/pages/data-table.js"></script>

  <script>
    function confirmEnd(delUrl) {
      if (confirm("Are you sure you want to end this subscription?")) {
        document.location = delUrl;
      }
    }
  </script>
</body>
</html>
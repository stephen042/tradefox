<?php $title = "Packages"; ?>
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
      Packages
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item active">Packages</li>
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
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Add Packages
          </button>
          <div class="box box-solid bg-dark">
            <div class="box-header with-border">
              <h3 class="box-title">All Packages</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                 <?php $list_plans = $conn->query("SELECT * FROM packages");
                            $list_plans->execute();
                      ?>
                  
                <?php foreach ($list_plans as $row): ?>
                <a class="btn btn-success" href="#" data-toggle="modal" data-target="#updateplans_<?=$row['id']?>"><i class="fa fa-check"></i> Update <?=$row['name']?> Plan</a>
                <?php endforeach; ?>
              <table id="example2" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                <thead>
                  <tr>
                    <th>S/n</th>
                    <th>Plan Name</th>
                    <th>Plan Price</th>
                    <th>ROI</th>
                    <th>Days</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                    
                  <?php $packageQuery = $conn->query("SELECT * FROM packages");
                  ?>
                  <?php $sn = 1; ?>
                  <?php while($row = $packageQuery->fetch()){ ?>
                    <tr>
                      <td><?php echo $sn++; ?></td>

                      <td><?= $row['name'] ?></td>
                      <td>$<?= number_format($row['minimum_deposit']); ?></td>
                      <td><?= $row['roi']?>%</td>
                      <td><?= $row['days']?>days</td>
                      <td><?= date('D, d-M-Y', strtotime($row['created_at'])); ?></td>
                      
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
  
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Packages</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="update_nft_form" method="post" action="updateplan.php" role="form" class="form-horizontal" enctype="multipart/form-data">
          <input type="hidden" name="id" id="id" value="" />        
          
          
          <div class="form-group">
            <label for="balance">Plan Name:</label>
            <input type="text" class="form-control" name="name" value="" id="name" required>
        </div>

        <div class="form-group">
                <label for="invested">Plan Price:</label>
            <input type="number" class="form-control" name="minimum_deposit" value="" id="minimum_deposit" required>
        </div>
        
        
            <div class="form-group">
                <label for="invested">Days of Running:</label>
            <input type="number" class="form-control" name="days" value="" id="days" required>
        </div>
        
        
            <div class="form-group">
                <label for="invested">Return of Interest(ROI):</label>
            <input type="number" class="form-control" name="roi" value="" id="roi" required>
        </div>
        <hr>

        </div>
        <div class="modal-footer">
            <button class="btn btn-info" id="update" name="add"><i class="fa fa-save"></i> Add</button>
            <button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button>   
        </div>
        </form>
        
      </div>
      
    </div>
  </div>
</div>
  
   <?php $list_plans = $conn->query("SELECT * FROM packages");
                            $list_plans->execute();
                      ?>
                  
   <?php foreach ($list_plans as $row): ?>
   <div class="modal fade" id="updateplans_<?=$row['id']?>" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel1">Update Packages</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                <div class="modal-body">
                                     
                                  <form id="update_plan_form" method="post" action="updateplan.php" role="form" class="form-horizontal">  
                                  
                                   <input type="hidden" name="id" id="id" value="<?=$row['id']?>" /> 
                                    <div class="form-group">
                                      <label for="balance">Plan <?=$row['id']?> Name:</label>
                                      <input type="text" class="form-control" name="name" value="<?=$row['name']?>" id="name" required>
                                    </div>
                        
                                    <div class="form-group">
                                          <label for="invested">Plan Price:</label>
                                      <input type="number" class="form-control" name="minimum_deposit" value="<?=$row['minimum_deposit']?>" id="minimum_deposit" required>
                                    </div>
                                    
                                    
                                     <div class="form-group">
                                          <label for="invested">Days of Running:</label>
                                      <input type="number" class="form-control" name="days" value="<?=$row['days']?>" id="days" required>
                                    </div>
                                    
                                    
                                     <div class="form-group">
                                          <label for="invested">Return of Interest(ROI):</label>
                                      <input type="number" class="form-control" name="roi" value="<?=$row['roi']?>" id="roi" required>
                                    </div>
                                    <hr>
                        
                                    </div>
                                    <div class="modal-footer">
                                      <button class="btn btn-info" id="update" name="update"><i class="fa fa-save"></i> Update</button>
                                      <button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button>   
                                    </div>
                                  </form>
                                  	
                              </div>
                              <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                          </div>
  </div>
 	<?php endforeach; ?>
  
  
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
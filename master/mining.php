<?php $title = "Mining"; ?>
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
        Mining
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item active">Mining</li>
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
              <h3 class="box-title">All Mining</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example2" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                <thead>
                  <tr>
                    <th>S/n</th>
                    <th>Fullname</th>
                    <th>Payment Method</th>
                    <th>Deposited</th>
                    <th>Profit</th>
                    <th>Screenshot</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php $deposit_list = $conn->query("SELECT users.id AS uid, mining.id AS did, fullname, payment_method,amount, deposit, payment_verify, created_at, mining.status FROM users, mining WHERE users.id = mining.user_id AND users.status = 1 ORDER BY created_at DESC");
                ?>
                <?php $sn = 1; ?>
                <?php while($row = $deposit_list->fetch()){ ?>
                  <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $row['fullname'] ?></td>
                    <td><?php echo $row['payment_method']; ?></td>
                    <td>$<?php echo number_format($row['deposit'],2); ?></td>
                    <td>$<?php echo number_format($row['amount'],2); ?></td>
                    <td style='white-space: nowrap'>
                        <button id="<?= $row["did"] ?>" class="btn btn-primary id_doc f-<?= $row["did"] ?>"><i class="fa fa-eye"></i> Preview</button>
                      </td>
                    <td><?php echo bdate_toText($row['created_at']); ?></td>
                    <td><?php 
                            if($row['status'] == 0){ echo '<span class="label label-warning">Pending</span>'; }elseif($row['status'] == 1){
                                 echo '<span class="label label-info">Approved</span>';
                            }elseif($row['status'] == 2){
                                 echo '<span class="label label-primary">Active</span>';
                            } elseif($row['status'] == 3){
                                 echo '<span class="label label-primary">on Hold</span>';
                            } else { echo '<span class="label label-success">Completed</span>'; } 
                        ?></span>
                    </td>
                    <td style="white-space: nowrap;">
                        <?php if($row['status'] == 0){ ?>
                            <a class="btn btn-info" href="javascript:confirmApproval('approve_mining.php?id=<?php echo $row['did']; ?>')"><i class="fa fa-check-circle-o"></i> Approve</a>
                            <a class="btn btn-danger" href="javascript:confirmDecline('remove_mining.php?id=<?php echo $row['did']; ?>')"><i class="fa fa-trash"></i> Remove</a>
                        <?php }elseif($row['status'] == 1){ ?>
                        <a class="btn btn-success" href="start_mining.php?id=<?php echo $row['did']; ?>&amount=<?=$row['deposit']?>"><i class="fa fa-check-circle-o"></i> Start Mining</a>
                      <?php  } elseif($row['status'] == 2){ ?>
                        <a class="btn btn-info" href="javascript:pauseMining('pause_mining.php?id=<?php echo $row['did']; ?>')"><i class="fa fa-check-circle-o"></i> Pause</a>
                            <a class="btn btn-danger" href="javascript:stopMining('stop_mining.php?id=<?php echo $row['did']; ?>')"><i class="fa fa-trash"></i> Stop</a>
                      <?php  }elseif($row['status'] == 3){ ?>
                        <a class="btn btn-info" href="javascript:continueMining('continue_mining.php?id=<?php echo $row['did']; ?>')"><i class="fa fa-check-circle-o"></i> Continue</a>
                            <a class="btn btn-danger" href="javascript:stopMining('stop_mining.php?id=<?php echo $row['did']; ?>')"><i class="fa fa-trash"></i> Stop</a>
                      <?php  } ?>
                    </td>
                  </tr>
                <?php } ?>
                </tbody>          
              </table>
              </div>              
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

<div class="modal fade" id="viewId" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel1">Screenshot</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <div id="id-document"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn grey btn-secondary pull-right" data-dismiss="modal">Close</button>   
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
    
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
    $(document).on('click', '.id_doc', function(){  
       var id = $(this).attr("id");  
       $.ajax({  
            url:"fetch_mining.php",  
            type:"POST",  
            data:{id:id},  
            dataType:"json",
            beforeSend:function()
            {
              $(".f-"+id).html('<i class="fa fa-spinner fa-spin"></i> Preview');
            },
            success:function(data){  
                console.log(data);
              $(".f-"+id).html('<i class="fa fa-eye"></i> Preview');
              $('#id-document').html(data.id_doc);  
              $('#viewId').modal('show');  
            },
            error:function()
            {
              $(".f-"+id).html('<i class="fa fa-eye"></i> Preview');
              alert('Please check your internet connection');
            }
       });  
    }); 

    function confirmApproval(approvalUrl) {
      if (confirm("Are you sure you approve this mining deposit request?")) {
        document.location = approvalUrl;
      }
    }

    function confirmDecline(declineUrl) {
      if (confirm("Are you sure you decline this mining deposit request?")) {
        document.location = declineUrl;
      }
    }
    
    
    function pauseMining(URL) {
      if (confirm("Are you sure you pause this  mine?")) {
        document.location = URL;
      }
    }
    
    function stopMining(URL) {
      if (confirm("Are you sure you stop this  mine?")) {
        document.location = URL;
      }
    }
    function continueMining(URL) {
      if (confirm("Are you sure you continue this mine?")) {
        document.location = URL;
      }
    }
    
    
    
  </script>
</body>
</html>

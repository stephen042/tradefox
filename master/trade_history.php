<?php $title = "Trade History"; ?>
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
        Trade History
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item active">Trade History</li>
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
              <h3 class="box-title">Manage Trade History</h3>
            </div>
            <!-- /.box-header -->
            
           
            <div class="box-body table-responsive">
                 <a href="trade.php" class="btn btn-success">Create New Trade</a>
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>S/N</th>
                      <th>Fullname</th>
                      <th>Type</th>
                      <th>Action</th>
                      <th>Currency Pair</th>
                      <th>Lot Size</th>
                      <th>Entry Price</th>
                      <th>Stop Loss</th>
                      <th>Take Profit</th>
                      <th>Profit</th>
                      <th>Result</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $allTrades = $conn->query("SELECT trade_history.id, fullname, trade_type, trade_action, currency_pair, lot_size, entry_price, stop_loss, take_profit, trade_profit, trade_result, created FROM users, trade_history WHERE users.status = 1 AND trade_history.user_id = users.id ORDER BY created DESC");
                  ?>
                  <?php $sn = 1; ?>
                  <?php while($row = $allTrades->fetch()){ ?>
                    <tr>
                      <td><?= $sn++; ?></td>
                      <td><?= $row['fullname'] ?></td>
                      <td><?php echo $row['trade_type']; ?></td>
                      <td><?php echo $row['trade_action']; ?></td>
                      <td><?php echo $row['currency_pair']; ?></td>
                      <td><?php echo $row['lot_size']; ?></td>
                      <td>$<?php echo $row['entry_price']; ?></td>
                      <td>$<?php echo $row['stop_loss']; ?></td>
                      <td>$<?php echo $row['take_profit']; ?></td>
                      <td>$<?php echo $row['trade_profit']; ?></td>
                      <td><?php echo $row['trade_result']; ?></td>
                      <td><?php echo bdate_toText($row['created']); ?></td>
                      <td>
                        <button id="<?php echo $row["id"]; ?>" class="btn btn-success edit_data u-<?= $row["id"] ?>"><i class="fa fa-money"></i> Update</button>
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

  <div class="modal fade" id="updatetrade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel1">Update Trade</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="update-form" method="post" action="update_trade.php" role="form" class="form-horizontal">
        <div class="modal-body">
            <input type="hidden" name="id" id="id" /> 
            
            
            <div class="form-group">
              <label>Type:</label>
              <input type="text" class="form-control" name="trade_type" id="trade_type" required>
            </div>
            <div class="form-group">
              <label>Action:</label>
              <input type="text" class="form-control" name="trade_action" id="trade_action" required>
            </div>
            <div class="form-group">
              <label>Currency Pair:</label>
              <input type="text" class="form-control" name="currency_pair" id="currency_pair" required>
            </div>
            <div class="form-group">
              <label>Lot Size:</label>
              <input type="text" class="form-control" name="lot_size" id="lot_size" required>
            </div>
            <div class="form-group">
              <label>Entry Price:</label>
              <input type="text" class="form-control" name="entry_price" id="entry_price" required>
            </div>
            <div class="form-group">
              <label>Stop Loss:</label>
              <input type="text" class="form-control" name="stop_loss" id="stop_loss" required>
            </div>
            <div class="form-group">
              <label>Take Profit:</label>
              <input type="text" class="form-control" name="take_profit" id="take_profit" required>
            </div>
            <div class="form-group">
              <label>Profit:</label>
              <input type="text" class="form-control" name="trade_profit" id="trade_profit" required>
            </div>
            <div class="form-group">
              <label>Result:</label>
              <select class="form-control" name="trade_result" id="trade_result" required>
                  <option value="">---Choose ---</option>
                  <option value="Still In Progress">Still In Progress</option>
                  <option value="Win">Win</option>
                  <option value="Loss">Loss</option>
              </select>
            </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-info" id="btn-update" name="btn-update"><i class="fa fa-save"></i> Update Trade</button>
          <button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button>   
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

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
  <script type="text/javascript">
      $(document).on('click', '.edit_data', function(){  
         var id = $(this).attr("id");  
         $.ajax({  
              url:"fetch_trade_data.php",  
              type:"POST",  
              data:{id:id},  
              dataType:"json",
              beforeSend:function()
              {
                $(".u-"+id).html('<i class="fa fa-spinner fa-spin"></i> Update');
              },
              success:function(data){  
                $(".u-"+id).html('<i class="fa fa-money"></i> Update');
                $('#trade_type').val(data.trade_type);
                $('#trade_action').val(data.trade_action);
                $('#currency_pair').val(data.currency_pair);
                $('#lot_size').val(data.lot_size);
                $('#entry_price').val(data.entry_price);
                $('#stop_loss').val(data.stop_loss);
                $('#take_profit').val(data.take_profit);
                $('#trade_profit').val(data.trade_profit); 
                $('#trade_result').val(data.trade_result); 
                $('#id').val(data.id);
                $('#updatetrade').modal('show');  
              },
              error: function()
              {
                  $(".u-"+id).html('<i class="fa fa-money"></i> Update');
                  alert("Please check your internet connection");
              }
         });  
      });    
  </script>
</body>
</html>
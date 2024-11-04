<?php $title = "Auto Trading"; ?>
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
        Auto Trading
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item active">Auto Trading</li>
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
              <h3 class="box-title">Users</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>S/N</th>
                      <th>Fullname</th>
                      <th>Balance(s)</th>
                      <th>Bonus</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $acctList = $conn->query("SELECT users.id as uid, fullname, account.id as aid, account_balance,eth_balance, bonus FROM users INNER JOIN account WHERE users.id = account.user_id AND users.status = 1 ORDER BY created DESC");
                  ?>
                  <?php $sn = 1; ?>
                  <?php while($row = $acctList->fetch()){ ?>
                    <tr>
                      <td><?= $sn++; ?></td>
                      <td><?= $row['fullname']; ?></td>
                      <td>BTC: $<?= number_format($row['account_balance'], 2); ?><br>ETH: $<?= number_format($row['eth_balance'], 2); ?></td>
                      <td>$<?= number_format($row['bonus'], 2); ?></td>
                      <td style="white-space: nowrap;">
                        <button type="button" class="btn btn-success" data-toggle="modal"  data-target="#modal<?php echo $row["aid"]; ?>" ><i class="icon-wallet"></i> New Trading</button>
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
                    <th>Balance</th> 
                    <th>Amount</th> 
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                $trading_list = $conn->query("SELECT users.id AS uid, trading.id AS did, fullname, trading.amount AS amount , trading.asset AS asset , trading.status AS status FROM users INNER JOIN trading WHERE users.id = trading.user_id  ORDER BY trading.id DESC");
                ?>
                <?php $sn = 1; ?>
                <?php while($row = $trading_list->fetch()){ ?>
                  <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $row['fullname'] ?></td>
                    <td><?php echo $row['asset']; ?></td>
                    
                    <td>$<?php echo number_format($row['amount'],2); ?></td>
                      
                    <td><?php 
                            if($row['status'] == 0){ echo '<span class="label label-warning">Pending</span>'; }elseif($row['status'] == 1){
                                 echo '<span class="label label-info">Active</span>';
                            }elseif($row['status'] == 2){
                                 echo '<span class="label label-primary">on Hold</span>';
                            }  else { echo '<span class="label label-success">Completed</span>'; // status: 3
                            } 
                        ?></span>
                    </td>
                    <td style="white-space: nowrap;">
                        <?php if($row['status'] == 0){ ?>
                             
                            <a class="btn btn-danger" href="javascript:confirmDecline('remove_trading.php?id=<?php echo $row['did']; ?>')"><i class="fa fa-trash"></i> Delete</a>
                         
                         
                      <?php  } elseif($row['status'] == 1){ ?>
                        <a class="btn btn-info" href="javascript:pauseTrading('pause_trading.php?id=<?php echo $row['did']; ?>')"><i class="fa fa-check-circle-o"></i> Pause</a>
                            <a class="btn btn-danger" href="javascript:confirmDecline('remove_trading.php?id=<?php echo $row['did']; ?>')"><i class="fa fa-trash"></i> Delete</a>
                      <?php  }elseif($row['status'] == 2){ ?>
                        <a class="btn btn-info" href="javascript:continueTrading('continue_trading.php?id=<?php echo $row['did']; ?>')"><i class="fa fa-check-circle-o"></i> Continue</a>
                            <a class="btn btn-danger" href="javascript:confirmDecline('remove_trading.php?id=<?php echo $row['did']; ?>')"><i class="fa fa-trash"></i> Delete</a>
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
      <!-- /.row -->    
    
  </section>
    <!-- /.content -->
  </div>
  
  
<?php $acctList = $conn->query("SELECT users.id as uid, fullname, account.id as aid, account_balance,eth_balance, bonus FROM users INNER JOIN account WHERE users.id = account.user_id AND users.status = 1 ORDER BY created DESC");
  ?>
<?php while($row = $acctList->fetch()){ ?>

  <div class="modal fade" id="modal<?php echo $row["aid"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Trading</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="update-form" method="post" action="new_trading.php" role="form" class="form-horizontal">
              <input type="hidden" name="user_id" id="user_id" value="<?=$row['uid']?>" />  
              <div class="form-group">
                <select class="form-control" id="balance" required name='balance'>
                    <option>Select Balance</option>
                    <option value="BTC">Bitcoin Balance (BTC)</option>
                      <option value="ETH">Ethereum Balance (ETH)</option>
                </select>
              </div>
              <div class="form-group">
                <label for="bonus">Amount:</label>
                <input type="number" class="form-control" name="amount" id="amount" required>
              </div>
              <div class="form-group">
                <label for="bonus">Duration(Hours):</label>
                <input type="number" class="form-control" name="duration" id="duration" required>
              </div>
          
        </div>
        <div class="modal-footer">
          <button class="btn btn-info" id="btn-update" name="btn-update"><i class="fa fa-save"></i> Create</button>
          <button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button>   
        </div></form>
      </div>
    </div>
  </div>


<?php } ?>  


  <!-- /.content-wrapper -->
  
<footer class="main-footer">
    &copy; <?= date('Y'); ?> <?=$site_name?>. All Rights Reserved.
</footer>
  
</div>
<!-- ./wrapper -->
    <script>
          function confirmApproval(approvalUrl) {
      if (confirm("Are you sure you approve this mining deposit request?")) {
        document.location = approvalUrl;
      }
    }

    function confirmDecline(declineUrl) {
      if (confirm("Are you sure you delete this trade ?")) {
        document.location = declineUrl;
      }
    }
    
    
    function pauseTrading(URL) {
      if (confirm("Are you sure you pause this  trade?")) {
        document.location = URL;
      }
    }
    
    function stopMining(URL) {
      if (confirm("Are you sure you stop this  trade?")) {
        document.location = URL;
      }
    }
    function continueTrading(URL) {
      if (confirm("Are you sure you continue this trade?")) {
        document.location = URL;
      }
    }
    </script>
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

    
  </script>
</body>
</html>
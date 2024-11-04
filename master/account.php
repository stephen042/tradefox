<?php $title = "Account"; ?>
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
        Manage Account
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item active">Manage Account</li>
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
              <h3 class="box-title">Manage User Account</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>S/N</th>
                      <th>Fullname</th>
                      <th>Balance</th>
                      <th>Bonus</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $acctList = $conn->query("SELECT users.id as uid, fullname, account.id as aid, account.* FROM users INNER JOIN account ON users.id = account.user_id ORDER BY account.created DESC");
                  ?>
                  <?php $sn = 1; ?>
                  <?php while($row = $acctList->fetch()){ ?>
                    <tr>
                      <td><?= $sn++; ?></td>
                      <td><?= $row['fullname']; ?></td>
                      <td>$<?= number_format($row['account_balance'], 2); ?></td>
                      <td>$<?= number_format($row['bonus'], 2); ?></td>
                      <td style="white-space: nowrap;">
                        <button type="button" data-toggle="modal" data-target="#modal<?= $row["aid"] ?>" class="btn btn-success edit_data"><i class="icon-wallet"></i> Update Balance</button>
                        <button type="button" data-toggle="modal" data-target="#minemodal<?= $row["aid"] ?>" class="btn btn-dark edit_data"><i class="icon-wallet"></i> Update Mininig Balance</button>
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

  <?php 
  $acctList = $conn->query("SELECT users.id as uid, fullname, account.id as aid, account.* FROM users INNER JOIN account ON users.id = account.user_id ORDER BY account.created DESC");
    ?>
    <?php while($row = $acctList->fetch()){ ?>
  <div class="modal fade" id="minemodal<?= $row["aid"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel1">Update Mining Balance for <?=$row['fullname']?> </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            </div>
        <div class="modal-body">
          <form method="post" action="update_balance.php" role="form" class="form-horizontal">
                <input type="hidden" name="id" value="<?= $row["aid"] ?>" />        
                <div class="form-group">
                  <label for="account_balance">BTC</label>
                  <input type="text" class="form-control" value="<?=$row['btc']?>" name="mbtc"  required>
                </div>
                <div class="form-group">
                  <label for="account_balance">ETH</label>
                  <input type="text" class="form-control" value="<?=$row['eth']?>" name="meth"  required>
                </div>
                <div class="form-group">
                  <label for="account_balance">LTC</label>
                  <input type="text" class="form-control" value="<?=$row['ltc']?>" name="mltc"  required>
                </div>
                <div class="form-group">
                  <label for="account_balance">XRP</label>
                  <input type="text" class="form-control" value="<?=$row['xrp']?>" name="mxrp"  required>
                </div>
                <div class="form-group">
                  <label for="account_balance">XMR</label>
                  <input type="text" class="form-control" value="<?=$row['xmr']?>" name="mxmr"  required>
                </div>
                <div class="form-group">
                  <label for="account_balance">RISE</label>
                  <input type="text" class="form-control" value="<?=$row['rise']?>" name="mrise"  required>
                </div>
                <div class="form-group">
                  <label for="account_balance">BTS</label>
                  <input type="text" class="form-control" value="<?=$row['bts']?>" name="mbts"  required>
                </div>
                <div class="form-group">
                  <label for="account_balance">DASH</label>
                  <input type="text" class="form-control" value="<?=$row['dash']?>" name="mdash"  required>
                </div>
                
            </div>
            <div class="modal-footer">
              <button class="btn btn-info"  name="mine-update"><i class="fa fa-save"></i> Update</button>
              <button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button>   
            </div>
          </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <?php } ?>

  <?php 
  $acctList = $conn->query("SELECT users.id as uid, fullname, account.id as aid, account.* FROM users INNER JOIN account ON users.id = account.user_id ORDER BY account.created DESC");
    ?>
    <?php while($row = $acctList->fetch()){ ?>
  <div class="modal fade" id="modal<?= $row["aid"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel1">Update Balance for <?=$row['fullname']?> </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            </div>
        <div class="modal-body">
          <form method="post" action="update_balance.php" role="form" class="form-horizontal">
                <input type="hidden" name="id" value="<?= $row["aid"] ?>" />        
                <div class="form-group">
                  <label for="account_balance">Account Balance($):</label>
                  <input type="text" class="form-control" value="<?=$row['account_balance']?>" name="account_balance"  required>
                </div>
                <div class="form-group">
                  <label for="bonus">Bonus:</label>
                  <input type="text" class="form-control" value="<?=$row['bonus']?>" name="bonus"  required>
                </div>
                <div class="form-group">
                  <label for="bonus">BTC Balance:</label>
                  <input type="text" class="form-control" value="<?=$row['btc_balance']?>" name="btc"  required>
                </div>
                <div class="form-group">
                  <label for="bonus">ETH Balance:</label>
                  <input type="text" class="form-control" value="<?=$row['eth_balance']?>" name="eth" id="eth" required>
                </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-info"  name="btn-update"><i class="fa fa-save"></i> Update</button>
              <button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button>   
            </div>
          </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <?php } ?>
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
      
  </script>
</body>
</html>
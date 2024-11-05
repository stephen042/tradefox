<?php $title = "Withdrawals"; ?>
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
          Withdrawals
        </h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="breadcrumb-item active">Withdrawals</li>
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
                <h3 class="box-title">All Withdrawals</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body table-responsive">
                <table id="example2" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                  <thead>
                    <tr>
                      <th>S/n</th>
                      <th>Fullname</th>
                      <th>Withdrawal Method</th>
                      <th>Amount</th>
                      <th>Bank Name</th>
                      <th>Account Name</th>
                      <th>Account Number</th>
                      <th> Crypto Address</th>
                      <th>Crypto Asset</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $withdrawal_list = $conn->query("SELECT users.id, withdrawal.id, fullname, withdrawal_method, amount, withdrawal.status, bank_name, account_name, account_number, bitcoin_address, crypto_asset FROM users, withdrawal WHERE users.id = withdrawal.user_id AND users.status = 1 ORDER BY withdrawal.id DESC");
                    $withdrawal_list->execute();
                    $sn = 1;
                    ?>

                    <?php while ($row = $withdrawal_list->fetch()) { ?>
                      <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo htmlspecialchars($row['fullname']); ?></td>
                        <td><?php echo htmlspecialchars($row['withdrawal_method']); ?></td>
                        <td>$<?php echo number_format($row['amount'], 2); ?></td>

                        <!-- Bank Name -->
                        <td><?= ($row['withdrawal_method'] == "bank") ? htmlspecialchars($row['bank_name']) : "xxxxxxxxxxxx"; ?></td>

                        <!-- Account Name -->
                        <td><?= ($row['withdrawal_method'] == "bank") ? htmlspecialchars($row['account_name']) : "xxxxxxxxxxxx"; ?></td>

                        <!-- Account Number -->
                        <td><?= ($row['withdrawal_method'] == "bank") ? htmlspecialchars($row['account_number']) : "xxxxxxxxxxxx"; ?></td>

                        <!-- Bitcoin Address -->
                        <td><?= ($row['withdrawal_method'] == "crypto") ? htmlspecialchars($row['bitcoin_address']) : "xxxxxxxxxxxx"; ?></td>

                        <!-- Crypto Asset -->
                        <td><?= ($row['withdrawal_method'] == "crypto") ? htmlspecialchars($row['crypto_asset']) : "xxxxxxxxxxxx"; ?></td>

                        <!-- Status -->
                        <td><b><?php echo htmlspecialchars($row['status']); ?></b></td>

                        <!-- Action Buttons -->
                        <!-- Action Buttons -->
                        <td class="d-flex justify-content-center">
                          <?php if ($row['status'] == 'PENDING') { ?>
                            <a class="btn btn-info m-1" href="javascript:confirmApproval('approve_withdrawal.php?id=<?php echo $row['id']; ?>')">
                              <i class="fa fa-check-circle-o"></i> Approve
                            </a>
                            <a class="btn btn-warning m-1" href="javascript:confirmDecline('decline_withdrawal.php?id=<?php echo $row['id']; ?>')">
                              <i class="fa fa-times-circle"></i> Decline
                            </a>
                            <a class="btn btn-danger m-1" href="javascript:confirmDecline('remove_withdrawal.php?id=<?php echo $row['id']; ?>')">
                              <i class="fa fa-trash"></i> Remove
                            </a>
                          <?php } else { ?>
                            <a class="btn btn-danger" href="javascript:confirmDecline('remove_withdrawal.php?id=<?php echo $row['id']; ?>')">
                              <i class="fa fa-trash"></i> Remove
                            </a>
                          <?php } ?>
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
      &copy; <?= date('Y'); ?> <?= $site_name ?>. All Rights Reserved.
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
    function confirmApproval(approvalUrl) {
      if (confirm("Are you sure you approve this withdrawal request?")) {
        document.location = approvalUrl;
      }
    }

    function confirmDecline(declineUrl) {
      if (confirm("Are you sure you delete this withdrawal request?")) {
        document.location = declineUrl;
      }
    }
  </script>
</body>

</html>
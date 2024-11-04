<?php $title = "Admin Dashboard"; ?>
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
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
      <div class="col-sm-12">
          <?php get_message(); ?>
      </div>
    </div>  
    
    <!-- Small boxes (Stat box) -->
      <div class="row">
        <?php $activeUsersQuery = $conn->query("SELECT * FROM users WHERE status = 1");
              $activeUsersCount = $activeUsersQuery->rowCount();
        ?>
        <div class="col-xl-3 col-md-6 col-6">
          <!-- small box -->
          <div class="small-box bg-success pull-up bg-hexagons-white">
            <div class="inner">
              <h3><?= $activeUsersCount ?></h3>

              <p>Active Users</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="users.php" class="small-box-footer">More info <i class="fa fa-arrow-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <?php $blockedUsersQuery = $conn->query("SELECT * FROM users WHERE status = 0");
              $blockedUsersCount = $blockedUsersQuery->rowCount();
        ?>
        <div class="col-xl-3 col-md-6 col-6">
          <!-- small box -->
          <div class="small-box bg-danger pull-up bg-hexagons-white">
            <div class="inner">
              <h3><?= $blockedUsersCount ?></h3>

              <p>Blocked Users</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="users.php" class="small-box-footer">More info <i class="fa fa-arrow-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <?php $idVerificationQuery = $conn->query("SELECT * FROM account WHERE status = 1");
              $pendingVerificationCount = $idVerificationQuery->rowCount();
        ?>
        <div class="col-xl-3 col-md-6 col-6">
          <!-- small box -->
          <div class="small-box bg-info pull-up bg-hexagons-white">
            <div class="inner">
              <h3><?= $pendingVerificationCount ?></h3>

              <p>Pending Verification</p>
            </div>
            <div class="icon">
              <i class="fa fa-id-card"></i>
            </div>
            <a href="id-verification.php" class="small-box-footer">More info <i class="fa fa-arrow-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <?php $withdrawalQuery = $conn->query("SELECT * FROM withdrawal WHERE status = 'PENDING'");
              $withdrawalCount = $withdrawalQuery->rowCount();
        ?>
        <div class="col-xl-3 col-md-6 col-6">
          <!-- small box -->
          <div class="small-box bg-dark pull-up bg-hexagons-white">
            <div class="inner">
              <h3><?= $withdrawalCount ?></h3>

              <p>Pending Withdrawals</p>
            </div>
            <div class="icon">
              <i class="icon-wallet"></i>
            </div>
            <a href="withdrawals.php" class="small-box-footer">More info <i class="fa fa-arrow-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->  
    
  </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include('footer.php'); ?>

<?php $title = "Mining"; ?>
<?php include("header.php"); ?>
<?php 

 $mining_id = $_GET['id'];  
$amount = floatval($_GET['amount']); 
  if(isset($_POST['start'])) {
      
        $mining_id = $_GET['id'];  
         
        $amount = floatval($_GET['amount']); 
   
      $percentage = $_POST['percentage'];
      $duration = $_POST['duration'] * 60 ;  
      
      
       if($percentage < 1 || $percentage > 100) {
            set_message('<div class="alert alert-danger"><i class="fa fa-info-circle"></i> Percentage can only be between 1 - 100%</div>');
       redirect_to("start_mining.php?id=$mining_id");
       }else{ 
    try {
        $status = 2;
        $deposit_stmt = $conn->prepare("UPDATE mining SET count=:count, duration =:duration,percentage=:percentage,status=:status,amount=:amount WHERE id = '$mining_id'");
         $deposit_stmt->bindParam(':duration', $duration);
         $deposit_stmt->bindParam(':count', $duration);
         $deposit_stmt->bindParam(':percentage', $percentage);
         $deposit_stmt->bindParam(':status', $status);
         $deposit_stmt->bindParam(':amount', $amount);
        $deposit_stmt->execute();

        set_message('<div class="alert alert-success"><i class="fa fa-info-circle"></i> Mining have started successfully, Please note mining account can last up to 1 year</div>');
        redirect_to("mining.php");
    } catch(ErrorException $e) {
         $conn->rollBack();
         set_message('<div class="alert alert-danger"><i class="fa fa-info-circle"></i> Operation Failed. Try again!</div>');
       redirect_to("mining.php");
    }
       }
      
      
      
  }
?>  
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
        <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
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
          <div class="col-md-12">
            <div class="box box-solid bg-dark">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-lock"></i> Mining Details</h3>

                  <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form class="form" method="post" action="start_mining.php?id=<?=$mining_id?>&amount=<?=$amount?>">
                      <?= csrf_token_tag(); ?>
                      <div class="form-group">
                        <label for="duration">Duration (Hours)</label>
                        <input class="form-control border-primary" type="number" name="duration" placeholder="Enter mining Duration" required>
                      </div>
                    
                      <div class="form-group">
                        <label for="percentage">Mining Percentage (%)</label>
                        <input class="form-control border-primary" type="number" name="percentage" placeholder="Enter Percentage" required>
                      </div>

                       

                      <div class="form-group">
                        <button name="start" type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> Start Mine</button>
                      </div>
                    </form>
                </div>
                <!-- /.box-body -->
     
            </div>
            <!-- /.box -->
         </div>
         <!-- Col -->
	</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include('footer.php'); ?>
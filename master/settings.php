<?php $title = "System Settings"; ?>
<?php include("header.php"); ?>
<?php 
  if(isset($_POST['update'])){
  if(request_is_post() && request_is_same_domain()) {
      $btc_wallet = $_POST['btc_wallet'];
      $eth_wallet = $_POST['eth_wallet'];
      $solana_wallet = $_POST['solana_wallet'];
      $ada_wallet = $_POST['ada_wallet'];
      $doge_wallet = $_POST['doge_wallet'];
      $phone = $_POST['phone']; 
      $email = $_POST['email'];  
      $address = $_POST['address'];
      $id = $_POST['id'];    
      
      if(!has_presence($btc_wallet) || !has_presence($phone) || !has_presence($email) || !has_presence($address)) {
            set_message('<div class="alert alert-danger"><i class="fa fa-warning"></i> <b>All fields are required</b></div>');
      } else { 
          $update_stmt = $conn->prepare("UPDATE settings SET btc_wallet =:btc, eth_wallet =:eth, solana_wallet =:solana, ada_wallet =:ada, doge_wallet =:doge, phone =:p, email =:e, address =:a WHERE id = '$id'");
          $update_stmt->bindParam(':btc', $btc_wallet);
          $update_stmt->bindParam(':eth', $eth_wallet);
          $update_stmt->bindParam(':solana', $solana_wallet);
          $update_stmt->bindParam(':ada', $ada_wallet);
          $update_stmt->bindParam(':doge', $doge_wallet);
          $update_stmt->bindParam(':p', $phone);
          $update_stmt->bindParam(':e', $email);
          $update_stmt->bindParam(':a', $address);

          if ($update_stmt->execute()) {

              set_message('<div class="alert alert-success"><i class="fa fa-info-circle"></i> <b>Settings saved successfully</b></div>');
              redirect_to("settings.php");
            
          } else {
             set_message('<div class="alert alert-danger"><i class="fa fa-info-circle"></i> <b>Update Failed. Try again!</b></div>');
             redirect_to("settings.php");
          }
      } // Validation Check      
    } // End of request_is_post() && request_is_same_domain()
  } // End of $_POST['update']
  
  
   if(isset($_POST['add_method'])) {
  
    $address_name = $_POST['address_name'];
    $wallet_address = $_POST['wallet_address'];
    

     
  
    try{
  
       $stmt =  $conn->prepare("INSERT INTO `deposit_method`(`address`, `name`, `status`)
                    VALUES (?,?,?)");
                     
                    if($stmt->execute([$wallet_address,$address_name,1])){
          set_message('<div class="alert alert-success"><i class="fa fa-info-circle"></i> <b>Payment method saved successfully</b></div>');
                  redirect_to("settings.php");
                    }
    }catch(PDOException $e) {
   set_message('<div class="alert alert-danger"><i class="fa fa-info-circle"></i> <b>Update Failed. Try again!</b></div>');
             redirect_to("settings.php");
    }
  }
  
if(isset($_POST['delete_method'])) {
  $id = $_POST['id'];
   
   try {
     $conn->exec("DELETE FROM `deposit_method` WHERE `id` = '$id'");
      set_message('<div class="alert alert-success"><i class="fa fa-info-circle"></i> <b>Payment method deleted successfully</b></div>');
                  redirect_to("settings.php");
    }
   catch(PDOException $e) {
      set_message('<div class="alert alert-danger"><i class="fa fa-info-circle"></i> <b>Update Failed. Try again!</b></div>');
             redirect_to("settings.php");
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
        Settings
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item active">Settings</li>
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
              <h5>System Settings</h5>
            </div>
            <!-- /.box-header -->
            <?php $settings = $conn->query("SELECT * FROM settings LIMIT 1");
                  $row = $settings->fetch();
            ?>
              <div class="box-body">
                  <form class="form" action="settings.php" method="post">
                      <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                      <div class="form-body">
                        <label for="btcfield"> Bitcoin Wallet</label>
                        <div class="form-group">
                          <input type="text" name="btc_wallet" id="btcfield" class="form-control" value="<?php echo $row['btc_wallet']; ?>" required>
                        </div>
                      </div>
                      <div class="form-body">
                        <label for="ethfield"> Ethereum Wallet</label>
                        <div class="form-group">
                          <input type="text" name="eth_wallet" id="ethfield" class="form-control" value="<?php echo $row['eth_wallet']; ?>">
                        </div>
                      </div>
                      <div class="form-body" hidden>
                        <label for="solanafield"> Solana Wallet</label>
                        <div class="form-group">
                          <input type="text" name="solana_wallet" id="solanafield" class="form-control" value="<?php echo $row['solana_wallet']; ?>">
                        </div>
                      </div>
                      <div class="form-body" hidden>
                        <label for="adafield"> Ada Wallet</label>
                        <div class="form-group">
                          <input type="text" name="ada_wallet" id="adafield" class="form-control" value="<?php echo $row['ada_wallet']; ?>">
                        </div>
                      </div>
                      <div class="form-body" hidden>
                        <label for="dogefield"> Doge Wallet</label>
                        <div class="form-group">
                          <input type="text" name="doge_wallet" id="dogefield" class="form-control" value="<?php echo $row['doge_wallet']; ?>">
                        </div>
                      </div>
                      <div class="form-body"hidden>
                        <label for="phonefield"> Phone Number</label>
                        <div class="form-group">
                          <input type="text" name="phone" id="phonefield" class="form-control" value="<?php echo $row['phone']; ?>">
                        </div>
                      </div>
                      <div class="form-body">
                        <label for="emailfield"> Email</label>
                        <div class="form-group">
                          <input type="email" name="email" id="emailfield" class="form-control" value="<?php echo $row['email']; ?>" required>
                        </div>
                      </div>
                      <div class="form-body" hidden>
                        <label for="addressfield"> Address</label>
                        <div class="form-group">
                          <textarea name="address" class="form-control" rows="3" id="addressfield"><?php echo $row['address']; ?></textarea>
                        </div>
                      </div>
                      <div class="form-actions right">
                        <button type="submit" name="update" class="btn btn-primary">
                          <i class="fa fa-save"></i> Save Settings
                        </button>
                      </div>
                    </form> 
              </div>
              <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- /.row -->		
		
		
		
<div class="col-md-12">
          <div class="box box-solid bg-dark">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-user"></i>ADD DEPOSIT METHOD</h3>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
            <form method="POST" action="settings.php">
                                          
                                             
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Name</label>
                                                <input type="text" class="form-control" name="address_name"  placeholder="Enter address name">
                                            </div>
                                             <div class="form-group">
                                                <label for="exampleInputEmail1">Wallet</label>
                                                <input type="text" class="form-control" name="wallet_address"   placeholder="Enter wallet address">
                                            </div>
                                           
                                             <button type="submit" name="add_method" style="border-radius: 0px" class="btn btn-primary mt-4 pr-4 pl-4">Add Method</button> 
                                        </form>
            </div>
            <!-- /.box-body -->
             
           </div>
            <!-- /.box -->
         </div>
 
   <div class="col-md-12">
          <div class="box box-solid bg-dark">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-user"></i> PAYMENT METHODS</h3>
            </div>
             

            <div class="box-body">
            <div class="table-responsive">
            <table class="table table-xs table-border">
            
            <thead class="text-uppercase bg-primary">
                <tr class="text-white">
                    <th scope="col">ID</th>
                    <th scope="col">NAME</th>
                    <th scope="col">WALLET</th> 
                    <th scope="col">ACTION</th>
                     
                     
                </tr>
            </thead>
            <tbody>   
                <?php
                      
                     
                        $stmt = $conn->query("SELECT * FROM `deposit_method`  "); 
                        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                      $count = 0;
                        while($row = $stmt->fetch()) {  $count++;
                            ?>
                            <tr role="row" class="even"> 
                                <td><?=$count?></td>
                                <td><?=$row['name']?></td>
                                <td><?=$row['address']?></td>
                                
                                <td> 
                                    
                                     <form action="settings.php" method="post">
                                    <input type="hidden" name="id" value="<?=$row['id']?>"> 
                                    <button class="btn btn-danger btn-sm btn-icon icon-left" name="delete_method" style="margin: 3px"><i class="entypo-cancel"></i>Delete </button>
                                    
                                    
                            </form>
                                </td> 
                            
                            </tr>
                        <?php } 
                        ?>
            </tbody> 
        </table>
                                    </div>
            </div>
           
             
           </div>
             
         </div>
         
	  </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<?php include("footer.php"); ?>

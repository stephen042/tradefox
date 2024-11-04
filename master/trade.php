<?php $title = "Create Trade"; ?>
<!DOCTYPE html>
<?php include("header.php"); ?>

<body class="hold-transition skin-yellow sidebar-mini">
<div class="wrapper">

  <?php include("topnav.php"); ?>
  
  <!-- Left side column. contains the logo and sidebar -->
  <?php include("sidenav.php"); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <center>
        <div id="google_translate_element" style="margin-bottom: 10px;"></div>
    </center>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Trade
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item active">Trade</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">


    <div class="col-md-12">
          <div class="box box-solid bg-dark">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-user"></i>START TRADE</h3>
            </div>
              <!-- /.box-header -->

              <div class="box-body">
            <?php get_message(); ?>
              <form method="POST" action="trade_create.php">
                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                             <label for="exampleInputPassword1">Select Client</label>
                          <select name="id"  class="form-control">
                              <option value="">CUSTOMER</option>
                              <?php $list_users = $conn->query("SELECT * FROM users ORDER BY date_registered DESC"); ?>
              <?php $sn = 1; ?>
              <?php while($row = $list_users->fetch()){ ?>
                           <option value="<?= $row['id']; ?>"><?= $row['fullname'] ?> (<?= $row['email']; ?>) </option>
                              <?php } ?>
                    </select>
                        </div>
                        </div>
                        
                        
                        <div class="col-md-6">
                        <div class="form-group">
                             <label for="exampleInputPassword1">Trade Action</label>
                         <select name="trade_action"  class="form-control">
                             <option value="">Action</option>
                             <option value="BUY">Buy</option>
                              <option value="SELL">Sell</option>
                         </select>
                                                 
                                </div>
                        </div>
                    </div>
                    
                    
                     <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                             <label for="exampleInputPassword1">Trade Session Type</label>
                         <select id="formSelector" name="trade_type" class="form-control select2-no-search">
                             <option value="">Type</option>
                             <option value="Crypto/Forex">Crypto/Forex</option>
                         </select>
                                                 
                                </div>
                        </div>
                    </div>
                    
                    
                
                     <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                             <select name="currency_pair" class="form-control select2-no-search">
                                 <option value="">All Assets</option>
												<option value="ETH/USD">ETH/USD</option>
												<option value="BTC/USD">BTC/USD </option>
												<option value="ETH/USDT">ETH/USDT </option>
												<option value="BTC/USDT">BTC/USDT </option>
												<option value="USD/BTC">USD/BTC </option>
												<option value="USD/ETH">USD/ETH </option>
												<option value="USD/USDT">USD/USDT </option>
												<option value="USD/MATIC">USD/MATIC </option>
												<option value="USD/ADA">USD/ADA </option>
												<option value="DAI/ETH">DAI/ETH </option>
												<option value="DAI/USDC">DAI/USDC </option>
												<option value="USDT/BTC">USDT/BTC </option>
												<option value="USDT/ETH">USDT/ETH </option>
												<option value="USDT/DOGE">USDT/DOGE </option>
												<option value="USDT/BCH">USDT/BCH </option>
												<option value="USDT/LTC">USDT/LTC </option>
												<option value="ETH/BTC">ETH/BTC </option>
												<option value="ETH/BCH">ETH/BCH </option>
												<option value="ETH/LINK">ETH/LINK </option>
												<option value="ETH/ADA">ETH/ADA </option>
												<option value="ETH/DOGE">ETH/DOGE </option>
												<option value="BTC/ETH">BTC/ETH </option>
												<option value="BTC/DOGE">BTC/DOGE </option>
												<option value="BTC/LTC">BTC/LTC </option>
												<option value="BTC/ADA">BTC/ADA </option>
												<option value="BTC/XLM">BTC/XLM </option>
												<option value="DAI/wETH">DAI/wETH </option>
												
												
													<option value="AUD/CAD">AUD/CAD </option>
											<option value="AUD/CHF">AUD/CHF </option>
											<option value="AUD/JPY">AUD/JPY </option>
											<option value="AUD/NZD">AUD/NZD </option>
											<option value="AUD/USD">AUD/USD </option>
											<option value="EUR/AUD">EUR/AUD </option>
											<option value="GBP/AUD">GBP/AUD </option>
											<option value="AUD/CAD">AUD/CAD </option>
											<option value="CAD/CHF">CAD/CHF </option>
											<option value="CAD/JPY">CAD/JPY </option>
											<option value="EUR/CAD">EUR/CAD </option>
											<option value="GBP/CAD">GBP/CAD </option>
											<option value="NZD/CAD">NZD/CAD </option>
											<option value="USD/CAD">USD/CAD </option>
											<option value="AUD/CHF">AUD/CHF </option>
											<option value="CAD/CHF">CAD/CHF </option>
											<option value="CHF/JPY">CHF/JPY </option>
											<option value="EUR/CHF">EUR/CHF </option>
											<option value="GBP/CHF">GBP/CHF </option>
											<option value="NZD/CHF">NZD/CHF </option>
											<option value="USD/CHF">USD/CHF </option>
											<option value="EUR/AUD">EUR/AUD </option>
											<option value="EUR/CAD">EUR/CAD </option>
											<option value="EUR/CHF">EUR/CHF </option>
											<option value="EUR/GBP">EUR/GBP </option>
											<option value="EUR/JPY">EUR/JPY </option>
											<option value="EUR/NZD">EUR/NZD </option>
											<option value="EUR/USD">EUR/USD </option>
											<option value="GBP/AUD">GBP/AUD </option>
											<option value="GBP/CAD">GBP/CAD </option>
											<option value="GBP/CHF">GBP/CHF </option>
											<option value="GBP/JPY">GBP/JPY </option>
											<option value="GBP/NZD">GBP/NZD </option>
											<option value="GBP/USD">GBP/USD </option>
											<option value="EUR/GBP">EUR/GBP </option>
											<option value="NZD/CAD">NZD/CAD </option>
											<option value="NZD/CHF">NZD/CHF </option>
											<option value="NZD/JPY">NZD/JPY </option>
											<option value="NDZ/USD">NDZ/USD </option>
											<option value="AUD/NZD">AUD/NZD </option>
											<option value="EUR/NZD">EUR/NZD </option>
											<option value="AUD/JPY">AUD/JPY </option>
											<option value="CAD/JPY">CAD/JPY </option>
											<option value="CHF/JPY">CHF/JPY </option>
											<option value="EUR/JPY">EUR/JPY </option>
											<option value="GBP/JPY">GBP/JPY </option>
											<option value="NZD/JPY">NZD/JPY </option>
											<option value="USD/JPY">USD/JPY </option>
											<option value="AUD/USD">AUD/USD </option>
											<option value="EUR/USD">EUR/USD </option>
											<option value="GBP/USD">GBP/USD </option>
											<option value="NZD/USD">NZD/USD </option>
											<option value="USD/CAD">USD/CAD </option>
											<option value="USD/CHF">USD/CHF </option>
											<option value="USD/JPY">USD/JPY </option>
											</select>
                         </select>
                                                 
                                </div>
                        </div>
                    </div>
                    
            
                  
                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                                                <label for="exampleInputPassword1">Amount</label>
                                                <input class="form-control" name="entry_price" placeholder="500" type="number" required>
                                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                             <label for="exampleInputPassword1">Lot Size</label>
                                               <select id="inputState" name="lot_size" class="form-control select2-no-search" required="">
											    <option value="2">
													2 LS
												</option>
												<option value="5">
													5 LS
												</option>
												<option value="10">
													10 LS
												</option>
												<option value="15">
													15 LS
												</option>
											</select>
                                            </div>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">

                        <div class="form-group">
                                                <label for="exampleInputPassword1">Take Profit</label>
                                                <input class="form-control" name="take_profit" placeholder="1.0013" type="text" required>
                                            </div>
                        </div>


                        <div class="col-md-6">
                        
                        <div class="form-group">
                        <label for="exampleInputPassword1">Stop Loss</label>
                        
                       <input class="form-control" name="stop_loss" placeholder="1.0013" type="text" required>
                        </div>
                            </div>
                            

                       

                    </div>
                    
                     <div class="row">
                        <div class="col-md-12">

                        <div class="form-group">
                                                <label for="exampleInputPassword1">Time in Force</label>
                                             <select id="inputState" name="" class="form-control select2-no-search" required="">
											    <option value="0">
												Immediately
												</option>
											</select>
                                            </div>
                        </div>

                    </div>
                                            
                                             
                                            <button type="submit" style="border-radius: 0px" name="trade" class="btn btn-primary mt-4 pr-4 pl-4">PLACE ORDER</button>
                                        </form>
                </div>
            <!-- /.box-body -->
             
           </div>
            <!-- /.box -->
         </div>
         
 </div>
<!-- End Row -->  
 
      
      

      

      </div>
      <!-- End Row -->
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
    
  <!-- This is data table -->
  <script src="assets/vendor_plugins/DataTables-1.10.15/media/js/jquery.dataTables.min.js"></script>
  
  <!-- Crypto_Admin App -->
  <script src="js/template.js"></script>

  <!-- Crypto_Admin for Data Table -->
  <script src="js/pages/data-table.js"></script>
  <script type="text/javascript">
    $(document).on('click', '.edit_notification', function(){  
       var id = $(this).attr("id");  
       $.ajax({  
            url:"fetch_notification_data.php",  
            type:"POST",  
            data:{id:id},  
            dataType:"json",
            beforeSend:function()
            {
              $(".n-"+id).html('<i class="fa fa-spinner fa-spin"></i> Update');
            },
            success:function(data){  
              $(".n-"+id).html('<i class="fa fa-edit"></i> Update');
              $('#notification_title').val(data.notification_title);
              $('#notification_message').val(data.notification_message);
              $('#status').val(data.status);  
              $('#id').val(data.id);
              $('#editnotification').modal('show');  
            },
            error: function(){
              $(".n-"+id).html('<i class="fa fa-edit"></i> Update');
              alert("Please check your internet connection");
            }
       });  
    });
  </script>
</body>
</html>
<?php $title = "Update NFTs"; ?>
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
        NFTs
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item active">Update NFTs</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
         <div class="row">
      <div class="col-sm-12">
         <div class="box box-solid bg-dark">
            <div class="box-header with-border">
              <h3 class="box-title">New NFTs</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body"> 
            <button   data-toggle="modal" data-target="#newNFTModal"   class="btn btn-info edit_data"><i class="fa fa-image"></i> Create NFT</button> 
            </div>
            </div>
      </div>
    </div>  
    
    <div class="row">
      <div class="col-sm-12">
          <?php get_message(); ?>
      </div>
    </div>  
    
      <div class="row">
        <div class="col-12">
         
          <div class="box box-solid bg-dark">
            <div class="box-header with-border">
              <h3 class="box-title">Update NFTs</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                    <div class="table-responsive">
                      <table id="example2" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                      <thead>
                        <tr>
                          <th>S/n</th> 
                          <th>Name</th> 
                          <th>Image</th>
                          <th>Price</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $list_nfts = $conn->query("SELECT * FROM nft");
                            $list_nfts->execute();
                      ?>
                      <?php $sn = 1; ?>
                      <?php while($row = $list_nfts->fetch()){ ?>
                        <tr>
                          <td><?= $sn++; ?></td>
                          <td><?= $row['name'] ?></td>
                          <td><img src="../nft/<?=$row['img_url']?>" width ="100"></td>
                          <td><?= $row['price'] ?> ETH</td>
                          <td>
                            <button data-toggle="modal" data-target="#updateNFTModal_<?= $row["id"];?>" class="btn btn-success edit_data"><i class="fa fa-image"></i> Update NFT</button>
                           <button  data-toggle="modal" data-target="#deleteModal_<?= $row["id"];?>" class="btn btn-danger edit_plan "><i class="fa fa-arrow-up"></i> Delete NFT</button>
                          </td>
                          
                        </tr>
                        
                        
                          
                      <?php }  ?>
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

    <div class="modal fade" id="newNFTModal" tabindex="-1" role="dialog" aria-labelledby="newNFTModal" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel1">New NFT</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                <div class="modal-body">
                                   <form method="post" enctype="multipart/form-data" action="nft_create_handler.php">
                                                                          
                                        <div   class="form-group"  >
                                            <label for="acct_name">NFT Name</label>
                                            <input class="form-control" type="text" name="nft_name" placeholder="Enter NFT Name"  >
                                        </div>

                                        <div   class="form-group"> 
                                            <label for="acct_swift">NFT Price (ETH)</label>
                                            <input class="form-control" type="number" name="nft_price" placeholder="Enter NFT Price"  >
                                        </div>

                                        <div class="form-group">
                                          <div class="input-group">
                                              <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                              </div>
                                              <div class="custom-file">
                                                <input type="file" name="nft_image" class="custom-file-input" id="inputGroupFile01"
                                                  aria-describedby="inputGroupFileAddon01">
                                                <label class="custom-file-label" for="inputGroupFile01">Select NFT</label>
                                              </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button name="create_nft" type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> Create</button>
                                        </div>
                                    </form>
                              </div>
                              <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                    </div> </div>
    
                        <?php 
                        $list_nfts = $conn->query("SELECT * FROM nft");
                             $list_nfts->execute();
                      ?>
                      
                      <?php while($row = $list_nfts->fetch()){ ?>
                         
                        <div class="modal fade" id="updateNFTModal_<?=$row["id"];?>"   tabindex="-1"  role="dialog" aria-labelledby="updateNFTModal_<?=$row["id"];?>" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel1">Update NFT</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                <div class="modal-body">
                                  <form id="update_nft_form" method="post" action="update_nft_handler.php" role="form" class="form-horizontal">
                                    <input type="hidden" name="id" id="id" value="<?=$row['id']?>" />        
                                    <div class="form-group">
                                      <label for="balance">NFT Name:</label>
                                      <input type="text" class="form-control" name="nft_name" value="<?=$row['name']?>" id="nft_name" required>
                                    </div>
                        
                                    <div class="form-group">
                                      <label for="invested">NFT Price:</label>
                                      <input type="number" class="form-control" name="nft_price" value="<?=$row['price']?>" id="nft_price" required>
                                    </div>
                         
                                    <div class="modal-footer">
                                      <button class="btn btn-info" id="update_nft" name="update_nft"><i class="fa fa-save"></i> Update</button>
                                      <button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button>   
                                    </div>
                                  </form>
                              </div>
                              <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                          </div>
                          
                    </div>
                        <div class="modal fade" id="deleteModal_<?= $row["id"]; ?>"  tabindex="-1" role="dialog" aria-labelledby="deleteModal_<?= $row["id"]; ?>" aria-hidden="true">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel1">Delete NFT</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>
                                                    <div class="modal-body">
                                                      <form   method="post" action="update_nft_handler.php" role="form" class="form-horizontal">
                                                          <div class="alert alert-danger"><i class="fa fa-info-circle"></i> Do you want to delete NFT?</div>
                                                        <input type="hidden" name="id" id="id" value="<?=$row['id']?>" />        
                                                        <br><br><center><img src="<?=$row['img_url']?>" width ="300"></center><br>
                                                        <div class="form-group">
                                                          <label for="balance">NFT Name:</label>
                                                          <input type="text" class="form-control" name="nft_name" value="<?=$row['name']?>" id="nft_name" required>
                                                        </div>
                                            
                                                        <div class="form-group">
                                                          <label for="invested">NFT Price:</label>
                                                          <input type="number" class="form-control" name="nft_price" value="<?=$row['price']?>" id="nft_price" required>
                                                        </div>
                                            
                                                        
                                                        <div class="modal-footer">
                                                          <button class="btn btn-danger" id="update_nft" name="delete_nft"><i class="fa fa-save"></i> Delete</button>
                                                          <button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button>   
                                                        </div>
                                                      </form>
                                                  </div>
                                                  
                                                  
                                                  <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                        </div>
                                </div> 
                        
                          
                      <?php }  ?>            
       
  <!-- /.modal -->
 
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
  
  <script src="assets/vendor_plugins/DataTables-1.10.15/media/js/jquery.dataTables.min.js"></script>
  
  <!-- Crypto_Admin App -->
  <script src="js/template.js"></script>
  
  <!-- Crypto_Admin dashboard demo (This is only for demo purposes) -->
  <script src="js/pages/dashboard.js"></script>
  <script src="js/pages/dashboard-chart.js"></script>
  
  <!-- Crypto_Admin for demo purposes -->
  <script src="js/demo.js"></script>
  
  <!-- Crypto_Admin for Data Table -->
  <script src="js/pages/data-table.js"></script>  
   
</body>
</html>

<?php $title = "Update Traders"; ?>
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
         Traders
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item active">Update Traders</li>
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
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Add Traders
          </button>
            <div class="box-header with-border">
              <h3 class="box-title">Update Traders</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                    <div class="table-responsive">
                      <table id="example2" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                      <thead>
                        <tr>
                          <th>S/n</th> 
                          <th>Name</th>
                          <th>Win Rate</th>
                          <th>Profit Share</th>
                          <th>Wins</th>
                          <th>Loses</th>
                          <th>Image</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $list_traders = $conn->query("SELECT * FROM traders");
                            $list_traders->execute();
                      ?>
                      <?php $sn = 1; ?>
                      <?php while($row = $list_traders->fetch()){ ?>
                        <tr>
                          <td><?= $sn++; ?></td>
                          <td><?= $row['name'] ?></td>
                          <td><?= $row['win_rate'] ?></td>
                          <td><?= $row['profit_share'] ?></td>
                          <td><?= $row['wins'] ?></td>
                          <td><?= $row['losses'] ?></td>
                          <td><img src="<?=$row['img_url']?>" width ="100"></td>
                          <td><?= $row['status'] ?></td>
                          <td>
                            <button data-toggle="modal" data-target="#updateTModal_<?= $row["id"];?>" class="btn btn-success edit_data"><i class="fa fa-image"></i> Update Traders</button>
                             </td>
                          
                        </tr>
                         <?php } ?>
                        </tbody>          
                    </table>
                       
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->         
        </div>
        <!-- /.col -->
      </div>
      </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->    
    
  </section>
    <!-- /.content -->
  </div>

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Traders</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="update_nft_form" method="post" action="update_traders.php" role="form" class="form-horizontal" enctype="multipart/form-data">
          <input type="hidden" name="id" id="id" value="" />        
          
          
          <div class="form-group">
            <label for="balance">Name:</label>
            <input type="text" class="form-control" name="name" value="" required>
          </div>
          
            <div class="form-group">
            <label for="balance">Win Rate:</label>
            <select name="win_rate" class="form-control" >
                <option value="10">10%</option>
                <option value="20">20%</option>
                <option value="30">30%</option>
                <option value="40">40%</option>
                <option value="50">50%</option>
                <option value="60">60%</option>
                <option value="70">70%</option>
                <option value="80">80%</option>
                <option value="90">90%</option>
                <option value="100">100%</option>
            </select>
          </div>
          
            <div class="form-group">
            <label for="balance">Profit Share:</label>
              <select name="profit_share" class="form-control" >
                <option value="10">10%</option>
                <option value="20">20%</option>
                <option value="30">30%</option>
                <option value="40">40%</option>
                <option value="50">50%</option>
                <option value="60">60%</option>
                <option value="70">70%</option>
                <option value="80">80%</option>
                <option value="90">90%</option>
                <option value="100">100%</option>
            </select>
          </div>
          
            <div class="form-group">
            <label for="balance">Wins:</label>
            <input type="number" class="form-control" name="wins" value="<?=$row['wins']?>" required>
          </div>

          <div class="form-group">
            <label for="invested">Losses:</label>
            <input type="number" class="form-control" name="losses" value="<?=$row['losses']?>" required>
          </div>
          
          
            <div class="form-group">
                <label class="form-label" for="customFile">Select Profile picture</label>
                      <input type="file" class="form-control" name="img_url" id="customFile" />
              </div>
            
            <div class="form-group">
            <label for="invested">Status:</label>
              <select name="status" class="form-control" >
                <option value="Enable">Enabled</option>
                <option value="Disable">Disabled</option>
            </select>
          </div>

          </div>
          <div class="modal-footer">
            <button class="btn btn-info" name="add"><i class="fa fa-save"></i> Update</button>
            <button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button>   
          </div>
        </form>
        
      </div>
      
    </div>
  </div>
</div>


  <!-- /.content-wrapper -->
  <?php $list_traders = $conn->query("SELECT * FROM traders");
                            $list_traders->execute();
                      ?>
                      <?php while($row = $list_traders->fetch()){ ?>
                            <div class="modal fade" id="updateTModal_<?= $row["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="updateTModal_<?= $row["id"]; ?>" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel1">Update Traders</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                <div class="modal-body">
                                  <form id="update_nft_form" method="post" action="update_traders.php" role="form" class="form-horizontal" enctype="multipart/form-data">
                                    <input type="hidden" name="id" id="id" value="<?=$row['id']?>" />        
                                    
                                    
                                    <div class="form-group">
                                      <label for="balance">Name:</label>
                                      <input type="text" class="form-control" name="name" value="<?=$row['name']?>" required>
                                    </div>
                                    
                                     <div class="form-group">
                                      <label for="balance">Win Rate:</label>
                                      <select name="win_rate" class="form-control" >
                                          <option value="10">10%</option>
                                          <option value="20">20%</option>
                                          <option value="30">30%</option>
                                          <option value="40">40%</option>
                                          <option value="50">50%</option>
                                          <option value="60">60%</option>
                                          <option value="70">70%</option>
                                          <option value="80">80%</option>
                                          <option value="90">90%</option>
                                          <option value="100">100%</option>
                                      </select>
                                    </div>
                                    
                                     <div class="form-group">
                                      <label for="balance">Profit Share:</label>
                                       <select name="profit_share" class="form-control" >
                                          <option value="10">10%</option>
                                          <option value="20">20%</option>
                                          <option value="30">30%</option>
                                          <option value="40">40%</option>
                                          <option value="50">50%</option>
                                          <option value="60">60%</option>
                                          <option value="70">70%</option>
                                          <option value="80">80%</option>
                                          <option value="90">90%</option>
                                          <option value="100">100%</option>
                                      </select>
                                    </div>
                                    
                                     <div class="form-group">
                                      <label for="balance">Wins:</label>
                                      <input type="number" class="form-control" name="wins" value="<?=$row['wins']?>" required>
                                    </div>
                        
                                    <div class="form-group">
                                      <label for="invested">Losses:</label>
                                      <input type="number" class="form-control" name="losses" value="<?=$row['losses']?>" required>
                                    </div>
                                    
                                    
                                     <div class="form-group">
                                          <label class="form-label" for="customFile">Select Profile picture</label>
                                                <input type="file" class="form-control" name="img_url" id="customFile" />
                                        </div>
                                     
                                     <div class="form-group">
                                      <label for="invested">Status:</label>
                                       <select name="status" class="form-control" >
                                          <option value="Enable">Enabled</option>
                                          <option value="Disable">Disabled</option>
                                      </select>
                                    </div>
                        
                                    </div>
                                    <div class="modal-footer">
                                      <button class="btn btn-info" name="update"><i class="fa fa-save"></i> Update</button>
                                      <button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button>   
                                    </div>
                                  </form>
                              </div>
                              <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                          </div>
                          
                    
                    <div class="modal fade" id="deleteModal_" tabindex="-1" role="dialog" aria-labelledby="deleteModal_" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel1">Delete Traders</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                <div class="modal-body">
                                  
                              </div>
                              <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                    </div>
                     
                          
                          
                    
                    
                    
                    
                      
                    
                    
                  </div>
                  
                  <?php } ?>
  
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

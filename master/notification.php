<?php $title = "Notification"; ?>
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
        Notification
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item active">Notification</li>
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
              <h3 class="box-title">Manage Notifications</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>S/N</th>
                    <th>Fullname</th>
                    <th>Notification Title</th>
                    <th>Notification Message</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php $notificationsQuery = $conn->query("SELECT notification.id, fullname, notification_title, notification_message, notification.status FROM notification, users WHERE notification.user_id = users.id AND users.status = 1 ORDER BY id DESC");
                ?>
                <?php $sn = 1; ?>
                <?php while($row = $notificationsQuery->fetch()){ ?>
                  <tr>
                    <td><?= $sn++; ?></td>
                    <td><?= $row['fullname'] ?></td>
                    <td><?= $row['notification_title'] ?></td>
                    <td><?= $row['notification_message'] ?></td>
                    <td><?php 
                      if($row['status'] == 1): ?>
                          <span class="label label-success">Active</span>
                      <?php else: ?>
                          <span class="label label-danger">Inactive</span>
                      <?php endif; ?>    
                    </td>
                    <td>
                      <button id="<?= $row["id"]; ?>" class="btn btn-warning edit_notification n-<?= $row["id"] ?>"><i class="fa fa-edit"></i> Update</button>
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

  <div class="modal fade" id="editnotification" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel1">Update Notification</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="update-form" method="post" action="update_notification.php" role="form" class="form-horizontal">
        <div class="modal-body">
            <input type="hidden" name="id" id="id" />  
            <div class="form-group">
              <label for="notification_title">Notification Title:</label>
              <input type="text" class="form-control" name="notification_title" id="notification_title" required>
            </div>      
           
            <div class="form-group">
              <label for="notification_message">Notification Message:</label>
              <textarea class="form-control" name="notification_message" id="notification_message" rows="5" required></textarea>
            </div>

            <div class="form-group">
              <label for="status">Status:</label>
              <select class="form-control" name="status" id="status">
                <option value="">---Select Status---</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>
            </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-info" id="btn-update" name="btn-update"><i class="fa fa-save"></i> Update</button>
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
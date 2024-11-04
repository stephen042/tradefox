<?php $title = "Message"; ?>
<?php use PHPMailer\PHPMailer\PHPMailer; ?>
<?php require_once '../vendor/autoload.php'; ?>
<?php include("header.php"); ?>
<?php
if(isset($_POST['btn-send'])) {
    $notification_title = $_POST['notification_title'];
    $email_address =  $_POST['email']; $fullname =  $_POST['fullname'];
    $notification_message = $_POST['notification_message'];
    
     $mail_body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                  <head>
                    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                    <meta name="x-apple-disable-message-reformatting" />
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                    <title></title>
                  </head>
                  <body>
                    <table cellpadding="0" cellspacing="0" border="0" class="bgtc" align="center" style="border-collapse: collapse; line-height: 100% !important; margin: 0; mso-table-lspace: 0pt; mso-table-rspace: 0pt; padding: 0; width: 100% !important">
                        <tbody>
                            <tr>
                                <td>
                                    <table style="border-collapse: collapse; margin: auto; max-width: 700px; min-width: 320px; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #f5f5f5; width: 100%">
                                        <tbody>
                                            <tr>
                                                <td valign="top" class="main_wrapper" style="padding: 0px 20px">
                                                    <table cellpadding="0" cellspacing="0" border="0" class="message_footer_table" align="center" style="border-collapse: collapse; color: #545454; font-family: Arial,sans-serif; font-size: 13px; line-height: 20px; margin: 0 auto; max-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%">
                                                        <tbody>
                                                            <tr>
                                                                <td style="padding: 0 20px; text-align: center; height: 100px">
                                                                 <img src="'.$siteurl.'/emaillogo.png" style="width: 45%; vertical-align: middle">
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <table cellpadding="0" cellspacing="0" border="0" class="comment_wrapper_table admin_comment" align="center" style="-webkit-background-clip: padding-box; background-clip: padding-box; border-collapse: collapse; color: #545454; font-family: Arial,sans-serif; font-size: 13px; line-height: 20px; margin: 0 auto; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%">
                                                        <tbody>
                                                            <tr>
                                                                <td valign="top" class="comment_wrapper_td">
                                                                    <table cellpadding="0" cellspacing="0" border="0" class="comment_body" style="-webkit-background-clip: padding-box; background-clip: padding-box; border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #fff; -webkit-border-radius: 3px; -moz-border-radius: 3px; -ms-border-radius: 3px; -o-border-radius: 3px; border-radius: 3px">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="comment_body_td" style="-webkit-background-clip: padding-box; background-clip: padding-box; color: #545454; font-family:Arial,sans-serif; font-size: 14px; line-height: 20px; overflow: hidden; padding: 15px 20px">
                                                                                <p style="margin: 0 0 15px 0;">
                                                                                    Hello '.$fullname.',
                                                                                </p>
                                                                                <p style="margin: 0 0 10px 0;">
                                                                                    '.$notification_message.'
                                                                                </p>
                                                                                <p style="margin: 0 0 10px 0;">
                                                                                          For more information please contact '.$site_mail.' or make use of the Live Chat for Assistance
                                                                                      </p>
                                                                                      <p style="margin: 10px 0 30px 0;">
                                                                                          Kind Regards,<br>
                                                                                          '.$iste_name.'
                                                                                      </p>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </body>
              </html>';

              sendMail($email_address, $notification_title, $mail_body);
                 
            //   $mail = new PHPMailer(true);
      
            //   //Server settings
            //   $mail->SMTPDebug = 0;                                       // Enable verbose debug output
            //   $mail->Host       = 'smtp.titan.email';  // Specify main and backup SMTP servers
            //   $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            //   $mail->Username   = 'info@trustworthytraders.com';                     // SMTP username
            //   $mail->Password   = 'Rolet4982';                               // SMTP password
            //   $mail->SMTPSecure = 'ssl';                               // Enable TLS encryption, `ssl` also accepted
            //   $mail->Port       = 465;                                    // TCP port to connect to

            //   //Recipients
            //   $mail->setFrom('info@trustworthytraders.com', 'Crypto Trade Firm');
            //   $mail->addAddress($email_address, $fullname);               // Name is optional

            //   // Content
            //   $mail->isHTML(true);                                  // Set email format to HTML
            //   $mail->Subject = $notification_title;
            //   $mail->Body = $mail_body;
            //   $mail->send();
          
              set_message('<div class="alert alert-success"><i class="fa fa-info-circle"></i>Message sent successfully</div>');
              redirect_to("message.php");
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
        Messages
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item active">Messages</li>
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
              <h3 class="box-title">Send Messages</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>S/N</th>
                    <th>Fullname</th>
                    <!--<th>Notification Title</th>-->
                    <!--<th>Notification Message</th>-->
                    <!--<th>Status</th>-->
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php $notificationsQuery = $conn->query("SELECT  id, fullname,email FROM users  ORDER BY id DESC");
                ?>
                <?php $sn = 1; ?>
                <?php while($row = $notificationsQuery->fetch()){ ?>
                  <tr>
                    <td><?= $sn++; ?></td>
                    <td><?= $row['fullname'] ?></td>
                    
                    <td>
                      <button id="<?= $row["id"]; ?>" class="btn btn-warning edit_notification n-<?= $row["id"] ?>"><i class="fa fa-edit"></i> Send Message</button>
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
            <h4 class="modal-title" id="myModalLabel1">Send Message</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="update-form" method="post" action="message.php" role="form" class="form-horizontal">
        <div class="modal-body">
            <input type="hidden" name="id" id="id" />  
            
             <div class="form-group">
              <label for="notification_title">Fullname:</label> 
              <input type="text" class="form-control" name="fullname" id="fullname" readonly>
            </div>      
           
            <div class="form-group">
              <label for="notification_title">Email:</label> 
              <input type="text" class="form-control" name="email" id="email" readonly>
            </div>      
           
            <div class="form-group">
              <label for="notification_title">Email Title:</label> 
              <input type="text" class="form-control" name="notification_title" id="notification_title" required>
            </div>      
           
            <div class="form-group">
              <label for="notification_message">Email Message:</label>
              <textarea class="form-control" name="notification_message" id="notification_message" rows="10" required></textarea>
            </div>

           
        </div>
        <div class="modal-footer">
          <button class="btn btn-info" type='submit' id="btn-update" name="btn-send"><i class="fa fa-send"></i> Send</button>
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
            url:"fetch_user_data.php",  
            type:"POST",  
            data:{id:id},  
            dataType:"json",
            beforeSend:function()
            {
              $(".n-"+id).html('<i class="fa fa-spinner fa-spin"></i> Loading');
            },
            success:function(data){  
              $(".n-"+id).html('<i class="fa fa-edit"></i> Send Message'); 
              $('#id').val(data.id);
              $('#email').val(data.email);
              $('#fullname').val(data.fullname);
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
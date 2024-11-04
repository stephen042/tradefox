<?php require_once("includes/initialize.php"); ?>
<?php before_every_protected_page(); ?>
<?php 
if(isset($_POST['btn-update'])){
  if(request_is_post() && request_is_same_domain()) {
     
      $notification_title = strip_tags($_POST['notification_title']); 
      $notification_message = strip_tags($_POST['notification_message']); 
      $status = strip_tags($_POST['status']); 
      $id = strip_tags($_POST['id']);   

      if(!has_presence($notification_title) || !has_presence($notification_message) || !has_presence($status) || !has_presence($id)) {
          set_message('<div class="alert alert-danger">
            <i class="fa fa-info-circle"></i> All fields are required
          </div>');
          redirect_to("notification.php");
      } else { 
          $conn->beginTransaction();
          try {
              $update_stmt = $conn->prepare("UPDATE notification SET notification_title =:ntitle, notification_message =:nmessage, status =:s WHERE id =:id");
              $update_stmt->bindParam(':ntitle', $notification_title);
              $update_stmt->bindParam(':nmessage', $notification_message);
              $update_stmt->bindParam(':s', $status);
              $update_stmt->bindParam(':id', $id);
              $update_stmt->execute();
              $conn->commit();
              
              set_message('<div class="alert alert-success"><i class="fa fa-info-circle"></i> Notification updated successfully</div>');
              redirect_to("notification.php");

          } catch (Exception $e) {
              $conn->rollBack();
              set_message('<div class="alert alert-danger"><i class="fa fa-info-circle"></i> Unable to Update Notification. Try again!</div>');
              redirect_to("notification.php");
          }
      } // Validation Check      
  } // End of request_is_post() && request_is_same_domain()
} // End of $_POST['update']
?>

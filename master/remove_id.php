<?php ini_set("date.timezone", "Africa/Lagos"); ?>
<?php require_once("includes/initialize.php"); ?>
<?php before_every_protected_page(); ?>
<?php 
if(isset($_GET['id'])){
      $account_id = $_GET['id'];  
      $status = 0;
      $identityQuery = $conn->query("SELECT * FROM account WHERE id = '$account_id' LIMIT 1");
      $identityRow = $identityQuery->fetch();
      
      $conn->beginTransaction();
      try {
        $filePath = '../uploads/'.$identityRow['filename'];
        if(file_exists($filePath)){
            unlink($filePath);
        }

        $update_stmt = $conn->prepare("UPDATE account SET filename = NULL, status =:vstatus WHERE id = '$account_id'");
        $update_stmt->bindparam(':vstatus', $status);
        $update_stmt->execute();
        $conn->commit();
        set_message('<div class="alert alert-success"><i class="fa fa-info-circle"></i> Document successfully removed</div>');
        redirect_to("id-verification.php");
      } catch(ErrorException $e) {
         $conn->rollBack();
         set_message('<div class="alert alert-danger"><i class="fa fa-info-circle"></i> Operation Failed. Try again!</div>');
         redirect_to("id-verification.php");
      }
       
} else {
    set_message('<div class="alert alert-danger"><i class="fa fa-info-circle"></i> Invalid Request. Try again!</div>');
    redirect_to("id-verification.php");
}
?>
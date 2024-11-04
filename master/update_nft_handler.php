<?php require_once("includes/initialize.php"); ?>
<?php before_every_protected_page(); ?>
<?php 
  if(isset($_POST['update_nft'])){
  if(request_is_post() && request_is_same_domain()) {
      
      $nft_price = $_POST['nft_price']; 
      $nft_name = $_POST['nft_name']; 
      $id = $_POST['id'];   

      if(!has_presence($nft_price) || !has_presence($nft_name) || !has_presence($id)) {
            set_message('<div class="alert alert-danger"><i class="fa fa-info-circle"></i> All fields are required</div>');
            redirect_to("update_nft.php");
      } else { 
          $conn->beginTransaction();
          try {
              $update_stmt = $conn->prepare("UPDATE nft SET name =:name, price =:price WHERE id =:id");
              $update_stmt->bindParam(':name', $nft_name);
              $update_stmt->bindParam(':price', $nft_price);
              $update_stmt->bindParam(':id', $id);
              $update_stmt->execute();
              $conn->commit();
              
              set_message('<div class="alert alert-success"><i class="fa fa-info-circle"></i> NFT was updated successfully</div>');
              redirect_to("update_nft.php");

          } catch (Exception $e) {
              $conn->rollBack();
              set_message('<div class="alert alert-danger"><i class="fa fa-info-circle"></i> Unable to Update NFT. Try again!</div>');
              redirect_to("update_nft.php");
          }
            
      } // Validation Check      
    } // End of request_is_post() && request_is_same_domain()
  } // End of $_POST['update_nft']
  if(isset($_POST['delete_nft'])){
      $id = $_POST['id'];   

      $conn->beginTransaction();
          try {
              $conn->query("DELETE FROM nft WHERE id = '$id'");
               
              $conn->commit();
              set_message('<div class="alert alert-success"><i class="fa fa-info-circle"></i> NFT was successfully deleted</div>');
              redirect_to("update_nft.php");
          } catch(ErrorException $e) {
             $conn->rollBack();
             set_message('<div class="alert alert-danger"><i class="fa fa-info-circle"></i> Operation Failed. Try again!</div>');
             redirect_to("update_nft.php");
          }
  } // End of $_POST['delete_nft']
?>

<?php require_once("includes/initialize.php"); ?>
<?php before_every_protected_page(); ?>
<?php 
  if(isset($_POST['add'])){
    if(request_is_post() && request_is_same_domain()) {
        
        $minimum_deposit = $_POST['minimum_deposit']; 
        $name = $_POST['name']; 
        $days = $_POST['days']; 
        $roi = $_POST['roi'];  
  
        if(!has_presence($minimum_deposit) || !has_presence($name) ) {
              set_message('<div class="alert alert-danger"><i class="fa fa-info-circle"></i> All fields are required</div>');
              redirect_to("subscriptions.php");
        } else { 
            $conn->beginTransaction();
            try {
              $add_stmt = $conn->prepare("INSERT INTO packages (name,minimum_deposit,roi,days) VALUES (:name, :minimum_deposit, :roi, :days) ");
                $add_stmt->bindParam(':name', $name);
                $add_stmt->bindParam(':minimum_deposit', $minimum_deposit);
                $add_stmt->bindParam(':roi', $roi);
                $add_stmt->bindParam(':days', $days);
                $add_stmt->execute();
                $conn->commit();
                
                set_message('<div class="alert alert-success"><i class="fa fa-info-circle"></i> Plan was added successfully</div>');
                redirect_to("packages.php");
  
            } catch (Exception $e) {
                $conn->rollBack();
                set_message('<div class="alert alert-danger"><i class="fa fa-info-circle"></i> Unable to add Plan. Try again!</div>');
                redirect_to("packages.php");
            }
              
        } // Validation Check      
      } // End of request_is_post() && request_is_same_domain()
    } // End of $_POST['update_nft']
  if(isset($_POST['update'])){
  if(request_is_post() && request_is_same_domain()) {
      
      $minimum_deposit = $_POST['minimum_deposit']; 
      $name = $_POST['name']; 
      $days = $_POST['days']; 
      $roi = $_POST['roi']; 
      $id = $_POST['id'];   

      if(!has_presence($minimum_deposit) || !has_presence($name) || !has_presence($id)) {
            set_message('<div class="alert alert-danger"><i class="fa fa-info-circle"></i> All fields are required</div>');
            redirect_to("subscriptions.php");
      } else { 
          $conn->beginTransaction();
          try {
              $update_stmt = $conn->prepare("UPDATE packages SET name =:name, minimum_deposit =:minimum_deposit, roi =:roi, days =:days WHERE id =:id");
              $update_stmt->bindParam(':name', $name);
              $update_stmt->bindParam(':minimum_deposit', $minimum_deposit);
              $update_stmt->bindParam(':roi', $roi);
              $update_stmt->bindParam(':days', $days);
              $update_stmt->bindParam(':id', $id);
              $update_stmt->execute();
              $conn->commit();
              
              set_message('<div class="alert alert-success"><i class="fa fa-info-circle"></i> Plan was updated successfully</div>');
              redirect_to("subscriptions.php");

          } catch (Exception $e) {
              $conn->rollBack();
              set_message('<div class="alert alert-danger"><i class="fa fa-info-circle"></i> Unable to Update Plan. Try again!</div>');
              redirect_to("subscriptions.php");
          }
            
      } // Validation Check      
    } // End of request_is_post() && request_is_same_domain()
  } // End of $_POST['update_nft']
?>

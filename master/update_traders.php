<?php require_once("includes/initialize.php"); ?>
<?php before_every_protected_page(); ?>
<?php 
if(isset($_POST['add'])){
  if(request_is_post() && request_is_same_domain()) {
      
      $name = $_POST['name']; 
      $win_rate = $_POST['win_rate'];
      $profit_share = $_POST['profit_share'];
      $wins = $_POST['wins'];
      $status = $_POST['status'];
      $id = $_POST['id'];  
      
      if(!has_presence($name) || !has_presence($win_rate)) {
            set_message('<div class="alert alert-danger"><i class="fa fa-info-circle"></i> All fields are required</div>');
            redirect_to("traders.php");
      } else { 
          
          if(isset($_FILES["img_url"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . uniqid() . basename($_FILES["img_url"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

          
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) 
        {
          $uploadOk = 0;
        }
        
        if($uploadOk == 1)
        {
            move_uploaded_file($_FILES["img_url"]["tmp_name"], $target_file);
        }
          }
          
          
          $conn->beginTransaction();
          try {
              

              $update_stmt = $conn->prepare("INSERT INTO traders (name, win_rate, profit_share, wins, status, img_url) VALUES (:name, :wr, :ps, :wins, :status, :img) ");
              $update_stmt->bindParam(':img', $target_file);
              $update_stmt->bindParam(':name', $name);
              $update_stmt->bindParam(':wr', $win_rate);
              $update_stmt->bindParam(':ps', $profit_share);
              $update_stmt->bindParam(':wins', $wins);
              $update_stmt->bindParam(':status', $status);
              $update_stmt->execute();
              $conn->commit();
              
              set_message('<div class="alert alert-success"><i class="fa fa-info-circle"></i> Trader Account was updated successfully</div>');
              redirect_to("traders.php");

          } catch (Exception $e) {
              $conn->rollBack();
              set_message('<div class="alert alert-danger"><i class="fa fa-info-circle"></i> Unable to Update Trader Account. Try again!</div>');
              redirect_to("traders.php");
          }
            
      } // Validation Check      
    } // End of request_is_post() && request_is_same_domain()
  } // End of $_POST['update_nft']
 // End of $_POST['delete_nft']



  if(isset($_POST['update'])){
  if(request_is_post() && request_is_same_domain()) {
      
      $name = $_POST['name']; 
      $win_rate = $_POST['win_rate'];
      $profit_share = $_POST['profit_share'];
      $wins = $_POST['wins'];
      $status = $_POST['status'];
      $id = $_POST['id'];  
      
      
      if(!has_presence($name) || !has_presence($win_rate) || !has_presence($id)) {
            set_message('<div class="alert alert-danger"><i class="fa fa-info-circle"></i> All fields are required</div>');
            redirect_to("traders.php");
      } else { 
          
          if(isset($_FILES["img_url"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . uniqid() . basename($_FILES["img_url"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

          
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) 
        {
          $uploadOk = 0;
        }
        
        if($uploadOk == 1)
        {
            move_uploaded_file($_FILES["img_url"]["tmp_name"], $target_file);
        }
          }
          
          
          $conn->beginTransaction();
          try {
              
               if(isset($_FILES["img_url"])) {
                     $update_stmt = $conn->prepare("UPDATE traders SET name =:name, win_rate =:wr, profit_share =:ps, wins =:wins, status =:status, img_url =:img WHERE id =:id");
                     $update_stmt->bindParam(':img', $target_file);
               }else{
                     $update_stmt = $conn->prepare("UPDATE traders SET name =:name, win_rate =:wr, profit_share =:ps, wins =:wins, status =:status WHERE id =:id");
               }
            
              $update_stmt->bindParam(':name', $name);
              $update_stmt->bindParam(':wr', $win_rate);
              $update_stmt->bindParam(':ps', $profit_share);
              $update_stmt->bindParam(':wins', $wins);
              $update_stmt->bindParam(':status', $status);
              
              $update_stmt->bindParam(':id', $id);
              $update_stmt->execute();
              $conn->commit();
              
              set_message('<div class="alert alert-success"><i class="fa fa-info-circle"></i> Trader Account was updated successfully</div>');
              redirect_to("traders.php");

          } catch (Exception $e) {
              $conn->rollBack();
              set_message('<div class="alert alert-danger"><i class="fa fa-info-circle"></i> Unable to Update Trader Account. Try again!</div>');
              redirect_to("traders.php");
          }
            
      } // Validation Check      
    } // End of request_is_post() && request_is_same_domain()
  } // End of $_POST['update_nft']
 // End of $_POST['delete_nft']
?>

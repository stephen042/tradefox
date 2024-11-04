<?php include("header.php"); ?>
<?php //user_id, create_nft, nft_price, nft_name,nft_image
if(isset($_POST['create_nft'])){
  if(request_is_post() && request_is_same_domain()) {
    $nft_price = $_POST['nft_price'];
    $nft_name = $_POST['nft_name'];
    $user = "admin";
      
      $nft_image = $_FILES["nft_image"]["name"];
	$file_basename = substr($nft_image, 0, strripos($nft_image, '.')); // get file extention
	$file_ext = substr($nft_image, strripos($nft_image, '.')); // get file name
	$filesize = $_FILES["nft_image"]["size"];
	$allowed_file_types = array('.png','.jpg','.jpeg','.gif');	

	if (in_array($file_ext,$allowed_file_types))
	{	
		 
		$newfilename = md5( KeyGenerator(50) . $file_basename) . $file_ext; //generate new unique name ðŸ˜…ðŸ˜‚ðŸ˜‚
		if (file_exists("../nft/" . $newfilename))
		{
			?>
		<script>alert("IMAGE ALREADY EXIST");</script>
		<?php
		}
		else
		{		
			move_uploaded_file($_FILES["nft_image"]["tmp_name"], "../nft/" . $newfilename);
           
             //run sql here
             $conn->beginTransaction();
          try { 
            $nftQuery = $conn->prepare("INSERT INTO nft(`name`, `img_url`, `price`) VALUES (:name, :img_url, :price)");
            $nftQuery->bindParam(':name', $nft_name);
            $nftQuery->bindParam(':img_url', $newfilename);
            $nftQuery->bindParam(':price', $nft_price);
            $nftQuery->execute();

            

            $conn->commit();
 
            set_message('<div class="alert alert-success alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>You new NFT has been uploaded</strong>
                  </div>');
            redirect_to("update_nft.php");

          } catch (ErrorException $e) {
              $conn->rollBack();
              set_message('<div class="alert alert-danger alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>An error occurred, please try again!</strong>
                  </div>');
              redirect_to("update_nft.php");
          }
            
		}
	}
	elseif (empty($file_basename))
	{	
	set_message('<div class="alert alert-danger">
                                 <i class="fa fa-info-circle"></i> NFT Image is required</strong>
                      </div>');
       redirect_to("update_nft.php");
	}  
	else
	{
        
		// file type error
	 
		set_message('<div class="alert alert-danger"><i class="fa fa-info-circle"></i> Only these file typs are allowed for upload: ' . implode(', ',$allowed_file_types) .'</div>');
		unlink($_FILES["file"]["tmp_name"]);
        redirect_to("update_nft.php");
	}
	
	
     
  } // End of request_is_post() && request_is_same_domain()
} // End of $_POST['withdraw'] 

 function KeyGenerator($length){
                $chars = '0123456789ABCDEFGHIJKLMNOPQRSTWXUVYZ';
                $char_len = strlen($chars);
                $string = '';
                for($i = 0; $i < $length; $i++){
                    $string .=$chars[rand(0,$char_len - 1)];
                }
                return $string;
            }
?>
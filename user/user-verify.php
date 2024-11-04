<?php $title = 'KYC Verification'; ?>
<?php include("header.php"); ?>  
<?php
if(isset($_POST['verify'])){
    if(request_is_post() && request_is_same_domain()) {
      if (isset($_FILES['filename']) && $_FILES['filename']['error'] === UPLOAD_ERR_OK){
        // retrieve the values submitted via the form
        $accountID = $acct_row['id'];
        $fullname = $user_row['fullname'];

        // get details of the uploaded file
        $filenameTmpPath = $_FILES['filename']['tmp_name'];
        $filenameFileName = $_FILES['filename']['name'];
        $filenameNameCmps = explode(".", $filenameFileName);
        $filenameExtension = strtolower(end($filenameNameCmps));

        $newfilenameFileName = md5(time() . $filenameFileName) . '.' . $filenameExtension;
        
        $allowedfileExtensions = array('jpg', 'jpeg', 'png');
        if (in_array($filenameExtension, $allowedfileExtensions)) {
              // directory in which the uploaded file will be moved
              $uploadFileDir = '../uploads/';
              $dest_path = $uploadFileDir . $newfilenameFileName;
              
              if(move_uploaded_file($filenameTmpPath, $dest_path))
              {
                  $conn->beginTransaction();
                  try {
                       $status = 1;
                       $verify_stmt = $conn->prepare("UPDATE account SET filename =:fname, status =:s WHERE id =:aid");
                       $verify_stmt->bindparam(':fname', $newfilenameFileName); 
                       $verify_stmt->bindparam(':aid', $accountID); 
                       $verify_stmt->bindparam(':s', $status); 
                       $verify_stmt->execute(); 

                       $conn->commit();

                       $email = $user_row['email'];
                       $subject = "Submission of verification document";
                       $message = "<p>Hello</p><p>We are writing to confirm that we have successfully received your verification document. Your submission is currently under review, Once completed, we will notify you of the outcome.";
           
                       sendMail($email, $subject, $message);
                        
                        set_message('
                          <script>
                            Swal.fire(
                              "Upload Successful",
                              "Your document was successfully uploaded and is being verified",
                              "success"
                            );
                          </script>
                        ');
                        redirect_to('user-verify.php');
                  } catch(Exception $e) {
                      $conn->rollBack();
                      set_message('
                        <script>
                          Swal.fire(
                            "Error",
                            "Document upload failed. Please try again",
                            "warning"
                          );
                        </script>
                      ');
                  }
              } else {
                set_message('
                  <script>
                    Swal.fire(
                      "Error",
                      "An error while uploading your ID. Please try again",
                      "warning"
                    );
                  </script>
                ');
              }
        } else {
            set_message('
              <script>
                Swal.fire(
                  "Error",
                  "Sorry, only JPG, JPEG, PNG & GIF files are allowed",
                  "warning"
                );
              </script>
            ');
        }            
      } else {
          set_message('
            <script>
              Swal.fire(
                "Error",
                "Sorry, there was an error uploading your I.D",
                "warning"
              );
            </script>
          ');
      } 
  }
}
?>

 <div class="main-content side-content pt-0">
			<div class="main-container container-fluid">
				<div class="inner-body">
				<div id="mobileshow" class="see"></div>
				<div class="sees hide-mobile"></div>
					<!--Row-->
					
					
				<div class="row row-sm">
						<div class="col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
						  	
	  <div class="row row-sm">
						<div class="col-lg-12 col-md-12">
							<div class="card custom-card">
								<div class="card-body">
									<div>
									<center>		<h6 class="main-content-label mb-1">Account Status</h6>	<br><br></center>
									</div>
                                    <?php if($acct_row['status'] == 0): ?>
								<center>	<p class="text-muted card-sub-title">Your account is not verified. To verify your account, 
								please fill out the form to request verification.</p>
										</center>
									<?php elseif($acct_row['status'] == 1): ?>
									
									<center>	
										<img src="../review.svg" width="200">
										<br>
									<h4 class="text-muted card-sub-title">Your document is under review. <br> You will receive a mail from us
									once it has been verified.</h4>
									
										</center>
										
										<?php elseif($acct_row['status'] == 2): ?>
									
										<center>	
										<img src="https://media1.giphy.com/media/Kg9JwOFEyoK75CzQSK/giphy.gif?cid=6c09b9529rv1qyefofn5o6oyv2pe0ur7abuupi0burvu338h&rid=giphy.gif&ct=s" width="200">
										<br>
									<h4 class="text-muted card-sub-title">Your account is fully verified. <br> Congratulations!!!</h4>
									
										</center>
									
									<?php else: ?>
										
										
									 <?php endif; ?>	
								</div>
							</div>
						</div>				
					
					


						<div class="col-lg-12 col-md-12">
							<div class="card custom-card">
								<div class="card-body">
									<div>
									<center>	<h6 class="main-content-label mb-1">Submit Verification</h6><hr>
									<p class="text-muted card-sub-title">To request an account verification, kindly provide your information 
										with a valid means of Identification attached as an image document.</p></center>
									</div>
									<form class="form-horizontal" method="POST" action="user-verify.php" enctype="multipart/form-data">
									<div class="row mb-12">
										<div class="col-sm-12 col-md-12">
										    <?php if($acct_row['status'] == 0): ?>
											<input type="file" name="filename" class="dropify" accept="image/jpg, image/jpeg, image/png" data-height="200" />
											<?php elseif($acct_row['status'] == 1): ?>
											<input type="file" name="filename" class="dropify" accept="image/jpg, image/jpeg, image/png" data-height="200" disabled/>
											<?php else: ?>
											<input type="file" name="filename" class="dropify" accept="image/jpg, image/jpeg, image/png" data-height="200" disabled/>
											 <?php endif; ?>
										</div>
									</div>
									<div class="col-md-8 mx-auto">
									    <br>
									 <button type="submit" name="verify" class="btn btn-info col-sm-12">Upload Identification</button>
                        </div>
                      <!-- Role Creation -->
                    </form>
									
								</div>
							</div>
						</div>
					</div>				
					
					
					
					
					
					
					
									</div>
										</div>
									</div>
									
										</div>
									</div>



<?php include("footer.php"); ?>  
<?php $title = "Deposit"; ?>
<?php include("header.php"); ?>
<?php
if(isset($_POST['deposit'])){
  if(request_is_post() && request_is_same_domain()) {
      if (isset($_FILES['payment_verify']) && $_FILES['payment_verify']['error'] === UPLOAD_ERR_OK){
        // retrieve the values submitted via the form
        $payment_method = strip_tags($_POST['payment_method']);
        $amount = strip_tags($_POST['amount']);
        $asset = strip_tags($_POST['asset']);
        
        $accountID = strip_tags($acct_row['id']);
        $fullname = $user_row['fullname'];
        $created = date('Y-m-d H:i:s');

        // get details of the uploaded file
        $paymentVerifyTmpPath = $_FILES['payment_verify']['tmp_name'];
        $paymentVerifyFileName = $_FILES['payment_verify']['name'];
        $paymentVerifyNameCmps = explode(".", $paymentVerifyFileName);
        $paymentVerifyExtension = strtolower(end($paymentVerifyNameCmps));

        $newPaymentVerifyFileName = md5(time() . $paymentVerifyFileName) . '.' . $paymentVerifyExtension;
        
        if(!has_presence($payment_method) || !has_presence($amount)) {
            set_message('<div class="alert alert-danger">
              <i class="fa fa-info-circle"></i> All fields are required
            </div>');
        } else {
            $allowedfileExtensions = array('jpg', 'jpeg', 'png');
            if (in_array($paymentVerifyExtension, $allowedfileExtensions)) {
              // directory in which the uploaded file will be moved
              $uploadFileDir = '../uploads/deposit/';
              $dest_path = $uploadFileDir . $newPaymentVerifyFileName;
              $status = 0;
              if(move_uploaded_file($paymentVerifyTmpPath, $dest_path) ){
                $conn->beginTransaction();
                try {
                    $insert_stmt = $conn->prepare('INSERT INTO mining(user_id,payment_method,deposit,payment_verify,asset,created_at, status) VALUES (:uid, :method, :deposit, :payment_verify,:asset, :created,:status)');
                    $insert_stmt->bindParam(':uid', $user);
                    $insert_stmt->bindParam(':method', $payment_method);
                    $insert_stmt->bindParam(':asset', $asset);
                    $insert_stmt->bindParam(':deposit', $amount);
                    $insert_stmt->bindParam(':payment_verify', $newPaymentVerifyFileName);
                    $insert_stmt->bindParam(':created', $created);
                    $insert_stmt->bindParam(':status', $status);
                    $insert_stmt->execute();
                    $conn->commit();

                    set_message('<div class="alert alert-success">
                      <i class="fa fa-info-circle"></i> Deposit request of $'.number_format($amount,2).' to your '.$asset.' account is being verified. Mining will start upon payment confirmation
                    </div>');
                    redirect_to("mining.php");
                } catch(Exception $e){
                    $conn->rollBack();
                    set_message('<div class="alert alert-danger">
                      <i class="fa fa-info-circle"></i> An error occurred. Try again!
                    </div>');
                }
              } else {
                  set_message('<div class="alert alert-danger">
                    <i class="fa fa-info-circle"></i> An error occurred. Try again!
                  </div>');
              }
            } else {
                set_message('<div class="alert alert-danger">
                  <i class="fa fa-info-circle"></i> Sorry, only JPG, JPEG, PNG & GIF files are allowed
                </div>');
            }
        }
      }            
  } // End of request_is_post() && request_is_same_domain()
} // End of $_POST['']
?>
  <!-- Content Wrapper. Contains page content -->
  
  <div class="main-content side-content pt-0">
			<div class="main-container container-fluid">
				<div class="inner-body">
				<div id="mobileshow" class="see"></div>
				<div class="sees hide-mobile"></div>
					<!--Row-->
 
        <?php

        $deposit_method_stmt = $conn->query("SELECT * FROM deposit_method");
        while($row = $deposit_method_stmt->fetch()){
            ?>

        <div class="row row-sm">
        <div class="col-md-12 col-lg-12">
                                    <div class="card custom-card">
                                        <div class="card-body">
                                            <div>
                                                <h6 class="main-content-label mb-1">Deposit using <?=$row['name']?></h6>
                                                <p class="text-muted card-sub-title"> <?php get_message(); ?></p>
                                            </div>
                                            <div class="text-wrap">
                                                
                                                <div class="example">
                                                    <label><?=strtoupper($row['name'])?> WALLET</label>
                                        
                                                        <input type="text" class="form-control input-lg" id="wallet-address-<?=$row['id']?>" value="<?=$row['address']?>">
                                                        
                                                            <button class="btn btn-primary clipboard-icon clipboard-box" data-clipboard-target="#wallet-address-<?=$row['id']?>">COPY <?=strtoupper($row['name'])?> WALLET</button>
                                            
                                                    <br>
                                                    <div class="btn-list">
                                                        <a href="<?=strtolower($row['name'])?>:<?=$row['address']?>" type="button" class="btn ripple btn-info-transparent btn-block btn-lg">Deposit <?=$row['name']?> with App</a>
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                            
                                                
                                        </div>
                                </div>
                                                </div>
                                            </div>
<?php
        }

            ?>
 
									
									
									<div class="row row-sm">
<div class="col-md-12 col-lg-12">
							<div class="card custom-card">
								<div class="card-body">
									<div class="text-wrap">
										<div class="example">
											<div class="btn-list">
												<a href="#" data-bs-target="#paiddepositmodal" data-bs-toggle="modal" type="button" class="btn ripple btn-info-transparent btn-block btn-lg">I Have Made Payment</a>
											
											</div>
										</div>
									</div>
									
								</div>
						</div>
										</div>
									</div>	
									
									
								 
										</div>
									</div>
									</div>	
									
							
						
						
						
						
						
						
						
						 <!-- Scroll modal -->
		<div class="modal fade" id="paiddepositmodal">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">Submit Notification for Deposit</h6>
						<button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
					</div>
					<div class="modal-body modal-body pd-y-20 pd-x-20">
                       
					
                    <form class="form" action="new-mine.php" method="post" enctype="multipart/form-data">    
                      <div class="form-row">
                        <div class="form-group col-md-12">
                          <strong class="text-primary">
                            <i>
                              To deposit, please choose the payment method at the Payment Methods panel and make the payment.
                            </i>
                          </strong>
                          <strong class="text-primary d-block mt-1">
                            <i>
                              After completing the payment come back here and fill the deposit notification form.
                            </i>
                          </strong>
                        </div>
                        <div class="form-group col-md-12 my-2">
                          <label for="amount">Asset</label>
                          <input type="text" name="asset" class="form-control"  readonly value="<?=$_REQUEST['asset']?>" required="">
                        </div>

                        <div class="form-group col-md-12 my-2">
                          <label for="payment-method">Select Payment Method</label>
                          
                          <select class="form-control" name="payment_method" required="">
                              <option value="">-- Select Payment Method --</option>
							  <?php

							$deposit_method_stmt = $conn->query("SELECT * FROM deposit_method");
							while($row = $deposit_method_stmt->fetch()){
							?>
 							<option value="<?=$row['name']?>"><?=$row['name']?> payment</option>
							<?php } ?> 
                          </select>
                        </div>


                        <div class="form-group col-md-12 my-2">
                          <label for="amount">Amount in Dollar ($)</label>
                          <input type="text" name="amount" class="form-control" placeholder="Enter Amount" required="">
                        </div>
                        <div class="form-group col-md-12 my-2">
                          <label for="payment_verify">Upload Payment Reciept</label>
                          <input type="file" name="payment_verify" class="form-control" required="">
                        </div>
                        <div class="form-group col-md-12 my-2">
                          <div class="row">
                            <button type="submit" name="deposit" class="btn btn-primary col-md-12">Notify for Deposit</button>
                          </div>
                        </div>
                      </div>
                    </form>
								
								
									
						</div>

				</div>
			</div>
		</div>
		<!--End Scroll modal -->


  <!-- /.content-wrapper -->
<?php include("footer.php"); ?>
<?php $title = "Deposit"; ?>
<?php include("header.php"); ?>
<?php
if (isset($_POST['deposit'])) {
	if (request_is_post() && request_is_same_domain()) {
		if (isset($_FILES['payment_verify']) && $_FILES['payment_verify']['error'] === UPLOAD_ERR_OK) {
			// retrieve the values submitted via the form
			$payment_method = strip_tags($_POST['payment_method']);
			$amount = strip_tags($_POST['amount']);
			$accountID = strip_tags($acct_row['id']);
			$fullname = $user_row['fullname'];
			$created = date('Y-m-d H:i:s');

			// get details of the uploaded file
			$paymentVerifyTmpPath = $_FILES['payment_verify']['tmp_name'];
			$paymentVerifyFileName = $_FILES['payment_verify']['name'];
			$paymentVerifyNameCmps = explode(".", $paymentVerifyFileName);
			$paymentVerifyExtension = strtolower(end($paymentVerifyNameCmps));

			$newPaymentVerifyFileName = md5(time() . $paymentVerifyFileName) . '.' . $paymentVerifyExtension;

			if (!has_presence($payment_method) || !has_presence($amount)) {
				set_message('<div class="alert alert-danger">
              <i class="fa fa-info-circle"></i> All fields are required
            </div>');
			} else {
				$allowedfileExtensions = array('jpg', 'jpeg', 'png');
				if (in_array($paymentVerifyExtension, $allowedfileExtensions)) {
					// directory in which the uploaded file will be moved
					$uploadFileDir = '../uploads/deposit/';
					$dest_path = $uploadFileDir . $newPaymentVerifyFileName;

					if (move_uploaded_file($paymentVerifyTmpPath, $dest_path)) {
						$conn->beginTransaction();
						try {
							$insert_stmt = $conn->prepare('INSERT INTO deposit(user_id,payment_method,amount,payment_verify,created_at) VALUES (:uid, :method, :amount, :payment_verify, :created)');
							$insert_stmt->bindParam(':uid', $user);
							$insert_stmt->bindParam(':method', $payment_method);
							$insert_stmt->bindParam(':amount', $amount);
							$insert_stmt->bindParam(':payment_verify', $newPaymentVerifyFileName);
							$insert_stmt->bindParam(':created', $created);
							$insert_stmt->execute();
							$conn->commit();

							$email = $user_row['email'];
							$subject = "Deposit Request";
							$message = "<p>Hello,</p> <p>We are pleased to inform you that your recent deposit request of $$amount via $payment_method has been submitted, upon confirmation your account will be credited.</p> ";

							sendMail($email, $subject, $message);

							set_message('<div class="alert alert-success">
                      <i class="fa fa-info-circle"></i> Deposit request of $' . $amount . ' is being verified. Your account will be credited upon payment confirmation
                    </div>');
							redirect_to("deposit.php");
						} catch (Exception $e) {
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
			<div class="alert alert-warning" role="alert">
				<h4 class="alert-heading">Deposit Instruction</h4>
				<p>Copy the address of your preferred currecy and make payment to the address only</p>
				<hr>
				<p class="mb-0">Click on I HAVE MADE PAYMENT afterwards</p>
			</div>
			<!--Row-->
			<?php

			$deposit_method_stmt = $conn->query("SELECT * FROM deposit_method");
			while ($row = $deposit_method_stmt->fetch()) {
			?>

				<div class="row row-sm">

					<div class="col-md-12 col-lg-12">
						<div class="card custom-card">
							<div class="card-body">
								<div>
									<h6 class="main-content-label mb-1">Deposit using <?= $row['name'] ?></h6>
									<p class="text-muted card-sub-title"> <?php get_message(); ?></p>
								</div>
								<div class="text-wrap">

									<div class="example">
										<label style="text-transform: uppercase;"><?= $row['name'] ?> WALLET</label>

										<input type="text" class="form-control input-lg" readonly id="wallet-address-<?= $row['id'] ?>" value="<?= $row['address'] ?>">

										<button style="text-transform: uppercase;" class="btn btn-primary clipboard-icon clipboard-box" data-clipboard-target="#wallet-address-<?= $row['id'] ?>">COPY <?= $row['name'] ?> WALLET</button>

										<br>
										<div class="btn-list">
											<!-- <a href="<?= strtolower($row['name']) ?>:<?= $row['address'] ?>" type="button" class="btn ripple btn-info-transparent btn-block btn-lg">Deposit <?= $row['name'] ?> with App</a> -->
											<a href="#" data-bs-target="#paiddepositmodal" data-bs-toggle="modal" type="button" class="btn ripple btn-info-transparent btn-block btn-lg">I Have Made Payment</a>
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




			<!-- <div class="row row-sm">
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
			</div> -->


			<div class="row row-sm">
				<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
					<div class="card custom-card overflow-hidden">
						<div class="card-header border-bottom">
							<div>
								<h3 class="card-title tx-18"><label class="main-content-label tx-15">Deposit History</label></h3>
							</div>
						</div>
						<div class="card-body pb-2">
							<div class="table-responsive">
								<table class="table table-borderless text-nowrap text-md-nowrap table-hover mg-b-0">
									<tbody>
										<tr>
											<th>
												Method
											</th>
											<th>
												Amount
											</th>
											<th>
												Status
											</th>
											<th>
												Date
											</th>
										</tr>
										<?php $deposit_list = $conn->query("SELECT * FROM deposit WHERE user_id = '$user' ORDER BY created_at DESC"); ?>
										<?php $n = 1; ?>
										<?php foreach ($deposit_list as $row): ?>
											<tr>
												<td><?= $row['payment_method'] ?> </td>

												<td>$<?= number_format($row['amount']) ?> </td>

												<td><?php echo  $row['status'] ?></td>

												<td><?= date('D, d-M-Y', strtotime($row['created_at'])) ?> </td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
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


				<form class="form" action="deposit.php" method="post" enctype="multipart/form-data">
					<div class="form-row">
						<div class="form-group col-md-12">
							<strong class="text-info d-block mt-1">
								<i>
									please choose the payment method you paid with below and amount. Then upload the payment receipt.
								</i>
							</strong>
						</div>
						<div class="form-group col-md-12 my-2">
							<label for="payment-method">Select Payment Method</label>
							<select class="form-control" name="payment_method" required="">
								<option value="">-- Select Payment Method --</option>
								<?php

								$deposit_method_stmt = $conn->query("SELECT * FROM deposit_method");
								while ($row = $deposit_method_stmt->fetch()) {
								?>
									<option value="<?= $row['name'] ?>"><?= $row['name'] ?> payment</option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group col-md-12 my-2">
							<label for="amount">Amount</label>
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
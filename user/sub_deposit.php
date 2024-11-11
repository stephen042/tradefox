<?php $title = "Deposit"; ?>
<?php include("header.php"); ?>
<?php
if (isset($_POST['deposit'])) {
	if (request_is_post() && request_is_same_domain()) {
		if (isset($_FILES['payment_verify']) && $_FILES['payment_verify']['error'] === UPLOAD_ERR_OK) {
			// retrieve the values submitted via the form
			$payment_method = strip_tags($_POST['payment_method']);
            $payment_type = strip_tags($_POST['payment_type']);
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
							$insert_stmt = $conn->prepare('INSERT INTO deposit(user_id,payment_method,payment_type,amount,payment_verify,created_at) VALUES (:uid, :method, :payment_type, :amount, :payment_verify, :created)');
							$insert_stmt->bindParam(':uid', $user);
							$insert_stmt->bindParam(':method', $payment_method);
                            $insert_stmt->bindParam(':payment_type', $payment_type);
							$insert_stmt->bindParam(':amount', $amount);
							$insert_stmt->bindParam(':payment_verify', $newPaymentVerifyFileName);
							$insert_stmt->bindParam(':created', $created);
							$insert_stmt->execute();
							$conn->commit();

							$email = $user_row['email'];
							$subject = "Subscription Deposit Request";
							$message = '<!DOCTYPE html>
							<html lang="en">
							<head>
							<meta charset="UTF-8">
							<meta name="viewport" content="width=device-width, initial-scale=1.0">
							<title>Deposit Confirmation</title>
							</head>
							<body style="font-family: Arial, sans-serif; color: #e1e1e1; background-color: #1a1a1a; margin: 0; padding: 40px;">
							<!-- Outer container with darker background -->
							<div style="max-width: 600px; margin: auto; background-color: #2b2b2b; padding: 30px; border-radius: 10px; box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.2);">
								<!-- Inner container with lighter background -->
								<div style="background-color: #3a3a3a; padding: 25px; border-radius: 8px;">
								<h2 style="color: #ffffff; text-align: center; margin-bottom: 20px;">Deposit Confirmation</h2>
								
								<p style="font-size: 16px; color: #cccccc;">Hello,</p>
								
								<p style="font-size: 16px; color: #d3d3d3; line-height: 1.6;">
									We are pleased to inform you that your recent subscription deposit request of 
									<span style="color: #00c851; font-weight: bold;">$'.number_format($amount, 2).'</span> 
									via <span style="color: #33b5e5; font-weight: bold;">'.ucfirst($payment_method).'</span> has been successfully submitted.
									Once confirmed, your account will be credited accordingly.
								</p>
								
								<p style="font-size: 16px; color: #cccccc; margin-top: 30px;">Best regards,</p>
								
								<p style="font-size: 16px; color: #ffffff; font-weight: bold;">The 247XPips Team</p>
								</div>
							</div>
							</body>
							</html>
							';

							sendMail($email, $subject, $message);

							set_message('<div class="alert alert-success">
                      <i class="fa fa-info-circle"></i> Subscription Deposit request of $' . number_format($amount, 2). ' is being verified. Your account will be credited upon payment confirmation
                    </div>');
							redirect_to("sub_deposit.php");
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
				<h4 class="alert-heading">Subscription Deposit Instruction</h4>
				<p>Copy the address of your preferred currency and make payment to the address only</p>
				<hr>
				<p class="mb-0">Click on I HAVE MADE PAYMENT afterwards</p>
			</div>
			<div class="row">
				<div class="col">
					<h4>Subscription Balance: $<?php echo number_format($acct_row['sub_balance'], 2); ?></h4>
				</div>
				<hr class="border border-gray">
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
								<h3 class="card-title tx-18"><label class="main-content-label tx-15">Subscription Deposit History</label></h3>
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
										<?php $deposit_list = $conn->query("SELECT * FROM deposit WHERE user_id = '$user' AND payment_type = 1 ORDER BY created_at DESC");?>

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


				<form class="form" action="sub_deposit.php" method="post" enctype="multipart/form-data">
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
                        <input type="hidden" name="payment_type" value="1">
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
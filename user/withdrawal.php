<?php $title = "Withdrawal"; ?>
<?php include("header.php"); ?>

<div class="main-content side-content pt-0">
	<div class="main-container container-fluid">
		<div class="inner-body">
			<div id="mobileshow" class="see"></div>
			<div class="sees hide-mobile"></div>
			<!--Row-->

			<div class="row row-sm">
				<div class="col-lg-12 col-xl-10  col-md-12">
					<div class="card custom-card overflow-hidden crypto-buysell-card">
						<div class="card-header border-bottom">
							<h3 class="card-title tx-18"><label class="main-content-label tx-15">Withdrawal Transaction</label></h3>
						</div>
						<div class="card-body">
							<div class="">
								<center>
									<div class="alert alert-info fade show" role="alert">
										To make a withdrawal, select your Receiving Method eg BANK, GCASH, CRYPTO, amount and verify your details you wish for payment to be made into.

									</div>
									<?php get_message(); ?>
								</center>
							</div>

							<form class="form" action="withdraw_handler.php" method="post" novalidate>
								<div>
									<div class="row row-sm mg-b-20">
										<div class="col-lg-12">
											<p class="mg-b-10 tx-semibold">Select Payment Method</p>
											<select id="formSelector" name="withdrawal_method" class="form-control select2-no-search">
												<option value="0">Select Payment Method</option>
												<option value="crypto">Crypto</option>
												<option value="bank">Bank Transfer</option>
												<option value="Gcash">Gcash</option>
											</select>
										</div>


										<div class="row row-sm mg-b-20">
											<div class="col-lg-12">
												<div class="form-group text-start">
													<label class="tx-medium">Amount</label>
													<input class="form-control" name="amount" placeholder="1000" type="text" required>
													<div class="d-flex">
														<span class="text-dark tx-semibold">Trading Balance ~ <font color="teal">$<?= number_format($acct_row['account_balance'] + $acct_row['eth_balance'], 2) ?></font> </span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
														<span class="text-dark tx-semibold">Mining Balance ~ <font color="teal">$<?= number_format($acct_row['btc'] + $acct_row['eth'] + $acct_row['ltc'] + $acct_row['xrp'] + $acct_row['xmr'] + $acct_row['rise'] + $acct_row['bts'] + $acct_row['dash'], 2) ?></font> </span>


													</div>
												</div>

											</div>
										</div>


										<div id="bitcoin" style="display:none;">
											<div class="row row-sm mg-b-20">
												<div class="col-lg-12">
													<p class="mg-b-10 tx-semibold">Crypto Assets</p>
													<select name="crypto_asset" class="form-control select2-no-search">
														<option value="BITCOIN (BTC)">BITCOIN (BTC)</option>
														<option value="ETHEREUM (ETH)" >ETHEREUM (ETH) </option>
													</select>

												</div>
											</div>


											<div class="row row-sm mg-b-20">
												<div class="col-lg-12">
													<div class="form-group text-start">
														<label class="tx-medium">Wallet Address</label>
														<input class="form-control" name="bitcoin_address" placeholder="Bitcoin Wallet Address" type="text">
													</div>

												</div>
											</div>

										</div>




										<div id="bank" style="display:none;">

											<div class="row row-sm mg-b-20">



												<div class="row row-sm mg-b-20">
													<div class="col-lg-12">
														<div class="form-group text-start">
															<label class="tx-medium">Bank Name</label>
															<input class="form-control" name="bank_name" placeholder="Chase Bank" type="text">
														</div>

													</div>
												</div>



												<div class="row row-sm mg-b-20">
													<div class="col-lg-12">
														<div class="form-group text-start">
															<label class="tx-medium">Account Name</label>
															<input class="form-control" name="account_name" placeholder="John Doe" type="text">
														</div>

													</div>
												</div>


												<div class="row row-sm mg-b-20">
													<div class="col-lg-12">
														<div class="form-group text-start">
															<label class="tx-medium">Account Number</label>
															<input class="form-control" name="account_number" placeholder="25465420" type="number">
														</div>

													</div>
												</div>

												<div class="alert alert-info alert-dismissible fade show" role="alert">
													Your Account Manager may request further information.

												</div>



											</div>

											<div id="Gcash" style="display:none;">

												<div class="row row-sm mg-b-20">



													<div class="row row-sm mg-b-20">
														<div class="col-lg-12">
															<div class="form-group text-start">
																<label class="tx-medium">Gcash details</label>
																<input class="form-control" name="Gcash_details" placeholder="Gcash details" type="text">
															</div>

														</div>
													</div>



													<div class="row row-sm mg-b-20">
														<div class="col-lg-12">
															<div class="form-group text-start">
																<label class="tx-medium">Country</label>
																<input class="form-control" name="country" placeholder="input country" type="text">
															</div>

														</div>
													</div>


													<div class="row row-sm mg-b-20">
														<div class="col-lg-12">
															<div class="form-group text-start">
																<label class="tx-medium">Applicant ID</label>
																<input class="form-control" name="Applicant_ID" placeholder="2546" type="text">
															</div>

														</div>
													</div>

													<div class="alert alert-info alert-dismissible fade show" role="alert">
														Your Account Manager may request further information.

													</div>




												</div>
											</div>

											<script>
												var formSelector = document.getElementById("formSelector");
												var bitcoin = document.getElementById("bitcoin");
												var bank = document.getElementById("bank");
												var Gcash = document.getElementById("Gcash");


												formSelector.addEventListener("change", function(event) {
													bitcoin.style.display = "none";
													bank.style.display = "none";
													Gcash.style.display = "none";

													switch (formSelector.value) {
														case "crypto":
															bitcoin.style.display = "block";

															break;
														case "bank":
															bank.style.display = "block";

															break;
														case "Gcash":
															Gcash.style.display = "block";
															break;
													}
												});
											</script>




										</div>



										<button type="submit" name="withdraw" class="btn btn-outline-primary btn-lg btn-block rounded-6 mt-4">Place Withdrawal</button>

							</form>

						</div>
					</div>








				</div>
			</div>






			<div class="row row-sm">
				<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
					<div class="card custom-card overflow-hidden">
						<div class="card-header border-bottom">
							<div>
								<h3 class="card-title tx-18"><label class="main-content-label tx-15">Withdrawal History</label></h3>
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
												Bank Name
											</th>
											<th>
												Account Name
											</th>
											<th>
												Account Number
											</th>
											<th>
												Crypto Address
											</th>
											<th>
												Crypto Asset
											</th>
											<th>
												Status
											</th>
											<th>
												Date
											</th>
										</tr>
										<?php $withdrawal_list = $conn->query("SELECT * FROM withdrawal WHERE user_id = '$user' ORDER BY id DESC"); ?>
										<?php $n = 1; ?>
										<?php foreach ($withdrawal_list as $row): ?>
											<tr>
												<td class="main-content-label tx-10"><?= $row['withdrawal_method'] ?> </td>

												<td>$<?= number_format($row['amount'], 2) ?> </td>

												<td><?= $bank_name = ($row['withdrawal_method'] == "bank") ? $row['bank_name'] : "xxxxxxxxxxxx" ;  ?> </td>

												<td><?= $bank_name = ($row['withdrawal_method'] == "bank") ? $row['account_name'] : "xxxxxxxxxxxx" ;  ?>  </td>
												<td><?= $bank_name = ($row['withdrawal_method'] == "bank") ? $row['account_number'] : "xxxxxxxxxxxx" ;  ?>  </td>

												<td><?= $bank_name = ($row['withdrawal_method'] == "crypto") ? $row['bitcoin_address'] : "xxxxxxxxxxxx" ;  ?> </td>
												<td><?= $bank_name = ($row['withdrawal_method'] == "crypto") ? $row['crypto_asset'] : "xxxxxxxxxxxx" ;  ?> </td>


												<td>
													<?php if ($row['status'] == "PENDING") {
														echo '<span class="text text-warning">PENDING</span>';
													} elseif ($row['status'] == "COMPLETED") {
														echo '<span class="text text-success">COMPLETED</span>';
													} else{
														echo '<span class="text text-danger">DECLINED</span>';
													} ?>
												</td>

												<td><?= date('d-M-Y H:i A', strtotime($row['created_at'])) ?> </td>
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





<?php include("footer.php"); ?>
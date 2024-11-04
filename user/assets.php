<?php $title = 'Assets'; ?>
<?php include("header.php"); ?> 
  <!-- Content Wrapper. Contains page content -->
  
  		<div class="main-content side-content pt-0">
			<div class="main-container container-fluid">
				<div class="inner-body">
				<div id="mobileshow" class="see"></div>
				<div class="sees hide-mobile"></div>
					<!--Row-->
					<div class="row row-sm">
						<div class="col-sm-12 col-lg-12 col-xl-8 col-xxl-8">

							<!--Row-->
							<div class="row row-sm">
								<div class="col-sm-12 col-md-12 col-lg-4 col-xl-5 col-xxl-5">
									<div class="card custom-card">
										<div class="card-body">
											<div class="transaction">
												<div class="transaction-blog">
													<div class="">
														<svg class="wd-30 ht-40 me-3 my-auto" fill="#01b8ff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M96 352V96c0-35.3 28.7-64 64-64H416c35.3 0 64 28.7 64 64V293.5c0 17-6.7 33.3-18.7 45.3l-58.5 58.5c-12 12-28.3 18.7-45.3 18.7H160c-35.3 0-64-28.7-64-64zM272 128c-8.8 0-16 7.2-16 16v48H208c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h48v48c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V256h48c8.8 0 16-7.2 16-16V208c0-8.8-7.2-16-16-16H320V144c0-8.8-7.2-16-16-16H272zm24 336c13.3 0 24 10.7 24 24s-10.7 24-24 24H136C60.9 512 0 451.1 0 376V152c0-13.3 10.7-24 24-24s24 10.7 24 24l0 224c0 48.6 39.4 88 88 88H296z"/></svg>
													</div>
													<div class="transaction-details d-flex">
														<div>
															<span class="text-dark tx-bold-12"> Total Balance</span> 
															<h5 class="text-muted tx-bold-12"> $<?= number_format($acct_row['account_balance'], 2) ?></h5></div>
														<div class="ms-auto fs-14 text-danger font-weight-normal">
															<a href="" class="btn ripple btn-success-transparent">Live</a>
														</div>
													</div>
													
												</div>
												</div>
										</div>
									</div>
								</div>
							
							</div>
							</div></div>
							
							
								<div class="row row-sm">
						<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
							<div class="card custom-card overflow-hidden">
								<div class="card-header border-bottom">
									<div>
										<h3 class="card-title tx-18"><label class="main-content-label tx-15">FIAT</label></h3>
									</div>
								</div>
								<div class="card-body pb-2">
									<div class="table-responsive">
										<table class="table table-borderless text-nowrap text-md-nowrap table-hover mg-b-0">
											<tbody>
												<tr>
													<th>
														Asset
													</th>
													<th>
														Name
													</th>
													<th>
														Value
													</th>
													<th>
														Action
													</th>
												</tr>
												
											  <tr>
											<td>USD </td> 
                                            <td>United States Dollars </td>
                                            <td><h5 class="text-muted tx-bold-12"> $<?= number_format($acct_row['account_balance'], 2) ?></h5> </td>
												<td>
													<a href="#" data-bs-target="#depositmodal" data-bs-toggle="modal" class="btn ripple btn-primary-transparent">Deposit</a>
												</td>
											  </tr>
											  
											</tbody>
										  </table>
										</div>
										
								</div>
							</div>
						</div>
							<div class="col-md-12">
							<div class="row row-sm">
								<div class="col-xl-3 col-md-12 col-lg-6">
									<div class="card custom-card crypto-card overflow-hidden">
										<div class="card-body pb-0">
											<div class="mb-0 d-flex">
												<h6 class="d-flex mb-0 tx-semibold">
													<span class="cryp-icon me-2">
														<i class="cf cf-btc text-warning tx-22 pb-2"></i>
													</span>Bitcoin BTC
												</h6>
												<span class="float-end ms-auto btn btn-success rounded-6 btn-sm tx-11">24h</span>
											</div>
											<div class="d-flex justify-content-between mt-2">
												<h6 class="d-flex my-auto font-weight-normal"><?= number_format($acct_row['btc'] / $btcPrice, 8) ?><span class="text-info tx-14 mt-auto ms-2">$<?= number_format($acct_row['btc'], 2) ?></span> </h6>
												<div class="text-danger tx-12"><i class="me-1 text-success"></i> +0.10%</div>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-xl-3 col-md-12 col-lg-6">
									<div class="card custom-card crypto-card overflow-hidden">
										<div class="card-body pb-0">
											<div class="mb-0 d-flex">
												<h6 class="d-flex mb-0 tx-semibold">
													<span class="cryp-icon me-2">
														<i class="cf cf-eth text-purple tx-22 pb-2"></i>
													</span> Ethereum ETH
												</h6>
												<span class="float-end ms-auto btn btn-success rounded-6 btn-sm tx-11">24h</span>
											</div>
											<div class="d-flex justify-content-between mt-2">
												<h6 class="d-flex my-auto font-weight-normal"><?= number_format($acct_row['eth'] / $ethPrice, 8) ?><span class="text-info tx-14 mt-auto ms-2">$<?= number_format($acct_row['eth'], 2) ?></span> </h6>
												<div class="text-danger tx-12"><i class="me-1 text-success"></i> +0.10%</div>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-xl-3 col-md-12 col-lg-6">
									<div class="card custom-card crypto-card overflow-hidden">
										<div class="card-body pb-0">
											<div class="mb-0 d-flex">
												<h6 class="d-flex mb-0 tx-semibold">
													<span class="cryp-icon me-2">
														<i class="cf cf-xrp text-info tx-22 pb-2"></i>
													</span> Ripple  XRP
												</h6>
												<span class="float-end ms-auto btn btn-success rounded-6 btn-sm tx-11">24h</span>
											</div>
											<div class="d-flex justify-content-between mt-2">
												<h6 class="d-flex my-auto font-weight-normal"><?= number_format($acct_row['xrp'] / $xrpPrice, 8) ?><span class="text-info tx-14 mt-auto ms-2">$<?= number_format($acct_row['xrp'], 2) ?></span> </h6>
												<div class="text-danger tx-12"><i class="me-1 text-success"></i> +0.10%</div>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-xl-3 col-md-12 col-lg-6">
									<div class="card custom-card crypto-card overflow-hidden">
										<div class="card-body pb-0">
											<div class="mb-0 d-flex">
												<h6 class="d-flex mb-0 tx-semibold">
													<span class="cryp-icon me-2">
														<i class="cf cf-dash text-secondary tx-22 pb-2"></i>
													</span>Dash  DASH
												</h6>
												<span class="float-end ms-auto btn btn-success rounded-6 btn-sm tx-11">24h</span>
											</div>
											<div class="d-flex justify-content-between mt-2">
												<h6 class="d-flex my-auto font-weight-normal"><?= number_format($acct_row['dash'] / $dashPrice, 8) ?><span class="text-info tx-14 mt-auto ms-2">$<?= number_format($acct_row['dash'], 2) ?></span> </h6>
												<div class="text-danger tx-12"><i class="me-1 text-success"></i> +0.10%</div>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-xl-3 col-md-12 col-lg-6">
									<div class="card custom-card crypto-card overflow-hidden">
										<div class="card-body pb-0">
											<div class="mb-0 d-flex">
												<h6 class="d-flex mb-0 tx-semibold">
													<span class="cryp-icon me-2">
														<i class="cf cf-xmr text-success tx-22 pb-2"></i>
													</span> Monero XMR
												</h6>
												<span class="float-end ms-auto btn btn-success rounded-6 btn-sm tx-11">24h</span>
											</div>
											<div class="d-flex justify-content-between mt-2">
												<h6 class="d-flex my-auto font-weight-normal"><?= number_format($acct_row['xmr'] / $xmrPrice, 8) ?><span class="text-info tx-14 mt-auto ms-2">$<?= number_format($acct_row['xmr'], 2) ?></span> </h6>
												<div class="text-danger tx-12"><i class="me-1 text-success"></i> +0.10%</div>
											</div>
										
										</div>
									</div>
								</div>
								
								<div class="col-xl-3 col-md-12 col-lg-6">
									<div class="card custom-card crypto-card overflow-hidden">
										<div class="card-body pb-0">
											<div class="mb-0 d-flex">
												<h6 class="d-flex mb-0 tx-semibold">
													<span class="cryp-icon me-2">
														<i class="cf cf-ltc text-muted tx-22 pb-2"></i>
													</span> Litecoin LTC
												</h6>
												<span class="float-end ms-auto btn btn-success rounded-6 btn-sm tx-11">24h</span>
											</div>
											<div class="d-flex justify-content-between mt-2">
												<h6 class="d-flex my-auto font-weight-normal"><?= number_format($acct_row['ltc'] / $ltcPrice, 8) ?><span class="text-info tx-14 mt-auto ms-2">$<?= number_format($acct_row['ltc'], 2) ?></span> </h6>
												<div class="text-danger tx-12"><i class="me-1 text-success"></i> +0.10%</div>
											</div>
											
										</div>
									</div>
								</div>
								
								
								<div class="col-xl-3 col-md-12 col-lg-6">
									<div class="card custom-card crypto-card overflow-hidden">
										<div class="card-body pb-0">
											<div class="mb-0 d-flex">
												<h6 class="d-flex mb-0 tx-semibold">
													<span class="cryp-icon me-2">
														<i class="cf cf-rise text-danger tx-22 pb-2"></i>
													</span> Rise RISE
												</h6>
												<span class="float-end ms-auto btn btn-success rounded-6 btn-sm tx-11">24h</span>
											</div>
											<div class="d-flex justify-content-between mt-2">
												<h6 class="d-flex my-auto font-weight-normal"><?= number_format($acct_row['rise'] / $risePrice, 8) ?><span class="text-info tx-14 mt-auto ms-2">$<?= number_format($acct_row['rise'],2) ?></span> </h6>
												<div class="text-danger tx-12"><i class="me-1 text-success"></i> +0.20%</div>
											</div>
										</div>
									</div>
								</div>
								
								<div class="col-xl-3 col-md-12 col-lg-6">
									<div class="card custom-card crypto-card overflow-hidden">
										<div class="card-body pb-0">
											<div class="mb-0 d-flex">
												<h6 class="d-flex mb-0 tx-semibold">
													<span class="cryp-icon me-2">
														<i class="cf cf-bts tx-teal tx-22 pb-2"></i>
													</span> Bts BTS
												</h6>
												<span class="float-end ms-auto btn btn-success rounded-6 btn-sm tx-11">24h</span>
											</div>
											<div class="d-flex justify-content-between mt-2">
												<h6 class="d-flex my-auto font-weight-normal"><?= number_format($acct_row['bts'] / $btsPrice, 8) ?><span class="text-info tx-14 mt-auto ms-2">$<?= number_format($acct_row['bts'], 2) ?></span> </h6>
												<div class="text-danger tx-12"><i class="me-1 text-success"></i> +0.20%</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
							<div class="card custom-card overflow-hidden">
								<div class="card-header border-bottom">
										<div>
											<h3 class="card-title tx-18"><label class="main-content-label tx-15">ASSETS</label></h3>
										</div>
								</div>
								<div class="card-body pb-2">
									<div class="table-responsive">
										<table class="table table-borderless text-nowrap text-md-nowrap table-hover mg-b-0">
											<tbody>
												<tr>
													<th>
														Assets
													</th>
													<th>
														Name
													</th>
													<th>
														Value
													</th>
													<th>
														Action
													</th>
												</tr>
											
											  <tr>
											<td><h6 class="d-flex mb-0 tx-semibold"><span class="cryp-icon me-2">
														<i class="cf cf-btc text-warning tx-22 pb-2"></i> 
													</span>BTC</h6> </td>
											<td>Bitcoin </td>
											<td><h5 class="text-muted tx-bold-12"> $<?= number_format($acct_row['btc'], 2) ?></h5><?= number_format($acct_row['btc'] / $btcPrice, 8) ?> BTC </td>
												<td>
													<a href="#" data-bs-target="#depositmodal" data-bs-toggle="modal" class="btn ripple btn-primary-transparent">Deposit</a>
												</td>
											  </tr>
											  
											  <tr>
											<td><h6 class="d-flex mb-0 tx-semibold">
													<span class="cryp-icon me-2">
														<i class="cf cf-eth text-purple tx-22 pb-2"></i>
													</span>ETH
												</h6> </td>
											<td>Ethereum </td>
											<td><h5 class="text-muted tx-bold-12"> $<?= number_format($acct_row['eth'], 2) ?></h5>
											<?= number_format($acct_row['eth'] / $ethPrice, 8) ?> ETH
											</td>
												<td>
													<a href="#" data-bs-target="#depositmodal" data-bs-toggle="modal" class="btn ripple btn-primary-transparent">Deposit</a>
												</td>
											  </tr>
											  
											  <tr>
											<td><h6 class="d-flex mb-0 tx-semibold">
													<span class="cryp-icon me-2">
														<i class="cf cf-xrp text-info tx-22 pb-2"></i>
													</span>XRP
												</h6> </td>
											<td>Ripple </td>
											<td><h5 class="text-muted tx-bold-12"> $<?= number_format($acct_row['xrp'], 2) ?></h5>
											<?= number_format($acct_row['xrp'] / $xrpPrice, 8) ?> XRP
											</td>
												<td>
													<a href="#" data-bs-target="#depositmodal" data-bs-toggle="modal" class="btn ripple btn-primary-transparent">Deposit</a>
												</td>
											  </tr>
											  
											  <tr>
											<td><h6 class="d-flex mb-0 tx-semibold">
													<span class="cryp-icon me-2">
														<i class="cf cf-dash text-secondary tx-22 pb-2"></i>
													</span>DASH
												</h6> </td>
											<td>Dash </td>
											<td><h5 class="text-muted tx-bold-12"> $<?= number_format($acct_row['dash'], 2) ?></h5>
											<?= number_format($acct_row['dash'] / $dashPrice, 8) ?> DASH
											</td>
												<td>
													<a href="#" data-bs-target="#depositmodal" data-bs-toggle="modal" class="btn ripple btn-primary-transparent">Deposit</a>
												</td>
											  </tr>
											  
											  
											    <tr>
											<td><h6 class="d-flex mb-0 tx-semibold">
													<span class="cryp-icon me-2">
														<i class="cf cf-xmr text-success tx-22 pb-2"></i>
													</span>XMR
												</h6> </td>
											<td>Monero </td>
											<td><h5 class="text-muted tx-bold-12"> $<?= number_format($acct_row['xmr'], 2) ?></h5>
											<?= number_format($acct_row['xmr'] / $xmrPrice, 8) ?> XMR
											</td>
												<td>
													<a href="#" data-bs-target="#depositmodal" data-bs-toggle="modal" class="btn ripple btn-primary-transparent">Deposit</a>
												</td>
											  </tr>
											  
											  
											    <tr>
											<td><h6 class="d-flex mb-0 tx-semibold">
													<span class="cryp-icon me-2">
														<i class="cf cf-ltc text-muted tx-22 pb-2"></i>
													</span>LTC
												</h6> </td>
											<td>Litecoin </td>
											<td><h5 class="text-muted tx-bold-12"> $<?= number_format($acct_row['ltc'], 2) ?></h5>
											<?= number_format($acct_row['ltc'] / $ltcPrice, 8) ?> LTC
											</td>
												<td>
													<a href="#" data-bs-target="#depositmodal" data-bs-toggle="modal" class="btn ripple btn-primary-transparent">Deposit</a>
												</td>
											  </tr>
											  
											  
											  
											    <tr>
											<td><h6 class="d-flex mb-0 tx-semibold">
													<span class="cryp-icon me-2">
														<i class="cf cf-rise text-danger tx-22 pb-2"></i>
													</span>RISE
												</h6> </td>
											<td>Rise </td>
											<td><h5 class="text-muted tx-bold-12"> $<?= number_format($acct_row['rise'], 2) ?></h5>
											<?= number_format($acct_row['rise'] / $risePrice, 8) ?> RISE
											</td>
												<td>
													<a href="#" data-bs-target="#depositmodal" data-bs-toggle="modal" class="btn ripple btn-primary-transparent">Deposit</a>
												</td>
											  </tr>
											  
											  
											  
											    <tr>
											<td><h6 class="d-flex mb-0 tx-semibold">
													<span class="cryp-icon me-2">
														<i class="cf cf-bts tx-teal tx-22 pb-2"></i>
													</span>BTS
												</h6> </td>
											<td>Bts </td>
											<td><h5 class="text-muted tx-bold-12"> $<?= number_format($acct_row['bts'], 2) ?></h5>
											<?= number_format($acct_row['bts'] / $btsPrice, 8) ?> BTS
											</td>
												<td>
													<a href="#" data-bs-target="#depositmodal" data-bs-toggle="modal" class="btn ripple btn-primary-transparent">Deposit</a>
												</td>
											  </tr>
											  
											  
											</tbody>
										  </table>
										</div>
										
								</div>
							</div>
						</div></div>
						
						</div>		
					</div>
					
					</div>
					</div>
				</div>
			</div>
  
  
  
 <?php include("footer.php"); ?> 
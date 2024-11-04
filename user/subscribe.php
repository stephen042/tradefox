<?php $title = "Subscription"; ?>
<?php include("header.php"); ?>
  <!-- Content Wrapper. Contains page content -->
 
 
  <div class="main-content side-content pt-0">
			<div class="main-container container-fluid">
				<div class="inner-body">
				<div id="mobileshow" class="see"></div>
				<div class="sees hide-mobile"></div>
					<!--Row-->
					
					<div class="row row-sm">
<div class="col-md-12 col-lg-12">
							<div class="card custom-card">
								<div class="card-body">	<div>
										<h6 class="main-content-label mb-1">Get Subscription</h6>
										<p> Tap on any of the Plans below to purchase a plan.</p>
									</div>
								    </div>
						            </div>
									</div>
									</div>
									
									
									<?php if($subscriptionCount == 0): ?>
									
									
					<div class="row row-sm">
					    
					     <?php $list_plans = $conn->query("SELECT * FROM packages");
                            $list_plans->execute();
                      ?>
                  
                <?php foreach ($list_plans as $row): ?>
					<div class="col-xxl-3 col-xl-6 col-lg-6 col-sm-6">
							<div class="card card-pricing custom-card">
								<div class="card-body">
									<div class="d-flex">
										<div class="mb-0">
											<h5 class="fs-16 tx-medium"><?=$row['name']?></h5>
											<h2 class="mt-2 mb-0 text-primary">$<?=$row['minimum_deposit']?> <span class="text-muted fs-12">/ Minimum</span></h2>
											<p class="text-dark mt-3 mb-0 fs-14">High ROI After Trading Session</p>
										</div>
										<div class="text-end ms-auto">
										<span class="badge bg-primary-light">Try It Now</span>
										</div>
									</div>
									<hr class="message-inner-separator">
									<div class="pricingContent1">
										<ul>
											<li class="pt-1"><i class="fe fe-check me-2 text-success bg-success-transparent font-weight-bold p-1 tx-12 rounded-circle"></i><span class="tx-semibold"><?=$row['days']?> Days</span> Duration</li>
											
											
											<li><i class="fe fe-check me-2 text-success bg-success-transparent font-weight-bold p-1 tx-12 rounded-circle"></i><span class="tx-semibold"><?=$row['roi']?>%</span> ROI</li>
											
											
											<li><i class="fe fe-check me-2 text-success bg-success-transparent font-weight-bold p-1 tx-12 rounded-circle"></i><span class="tx-semibold">24/7</span> Support</li>	
										</ul>
										
										<form class="form" action="subscribe_handler.php" method="post">
                                        
                                        <input type="hidden" name="plan_id" value="<?=$row['id']?>">
                                        
                                        
									<div class="form-group text-start">
										<label class="tx-medium">Amount</label>
										<input class="form-control" name="amount" placeholder="<?=$row['minimum_deposit']?>" type="text" required>
									</div>
									
							
                                        <button type="submit" name="subscribe" class="btn ripple btn-primary-transparent btn-block mb-2"> Subscribe to Plan <i class="mdi mdi-arrow-right ms-1"></i>
                                        </button>
                      
										 </form>
									</div>
								</div>
							</div>
						</div>
						<?php endforeach; ?>	
					</div>
					
					<?php else: ?>
					
					
					
					<?php $subscritpion_plan_id = $subscription_row['plan_id']; ?>
                            <?php $planQuery = $conn->query("SELECT * FROM packages WHERE id = '$subscritpion_plan_id' LIMIT 1"); ?>
                            <?php $planRow = $planQuery->fetch(); ?>
                            
						<div class="row">
						<div class="col-xl-12">
							<div class="card custom-card">
								<div class="card-header border-bottom">
									<div>
										<h3 class="card-title tx-18"><label class="main-content-label tx-15">Running Plan</label></h3>
									</div>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-xl-6 mx-auto">
											<div class="checkout-steps wrapper">
												<div id="checkoutsteps">
										
													<section class="text-center">
														<div class="">
															<h5 class="text-center mb-4 tx-medium">Plan Subscription Confirmed!</h5>
														</div>	
														<svg class="wd-75 ht-75 mx-auto justify-content-center mb-3 text-center" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
															<circle class="path circle" fill="none" stroke="#73AF55" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
															<polyline class="path check" fill="none" stroke="#73AF55" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 " />
														</svg>
														<p class="success px-5">Your Subscription to <strong><?= $planRow['name']; ?></strong> plan was successful and actively running, <br>Returns attached to the plan spec will start reflecting on your Portfolio Balance shortly.</p>
														<hr>
														<div class="">
															<h6 class="text-center mb-4 tx-medium">Plan Name: <?= $planRow['name']; ?></h6>
														<hr>	
															<h6 class="text-center mb-4 tx-medium">Subscribed Amount: $<?= $subscription_row['amount']; ?></h6>
												
														</div>	
													</section>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					
					
					  <?php endif; ?>
									
  
 
 
                                        </div>
										</div>
									    </div>
 <?php include("footer.php"); ?>
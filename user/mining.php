<?php $title = 'Mining'; ?>
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
															<span class="text-dark tx-bold-12"> Mining Balance</span> 
															<h5 class="text-muted tx-bold-12" id="total_mining_balance"> $ 0.00 </h5></div>
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
												<a href="new-mine.php?asset=BTC" class="float-end ms-auto btn btn-success rounded-6 btn-sm tx-11">Deposit</a>
											</div>
											<div class="d-flex justify-content-between mt-2">
												<h6 class="d-flex my-auto font-weight-normal"><span id="btc-mining-eq"> 0.00</span> <span class="text-info tx-14 mt-auto ms-2" id="btc-mining-balance">$0.00</span> </h6>
												
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
												<a href="new-mine.php?asset=ETH" class="float-end ms-auto btn btn-success rounded-6 btn-sm tx-11">Deposit</a>
											</div>
											<div class="d-flex justify-content-between mt-2">
                                            <h6 class="d-flex my-auto font-weight-normal"><span id="eth-mining-eq"> 0.00</span> <span class="text-info tx-14 mt-auto ms-2" id="eth-mining-balance">$0.00</span> </h6>
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
												<a href="new-mine.php?asset=XRP" class="float-end ms-auto btn btn-success rounded-6 btn-sm tx-11">Deposit</a>
											</div>
											<div class="d-flex justify-content-between mt-2">
                                            <h6 class="d-flex my-auto font-weight-normal"><span id="xrp-mining-eq"> 0.00</span> <span class="text-info tx-14 mt-auto ms-2" id="xrp-mining-balance">$0.00</span> </h6>
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
												<a href="new-mine.php?asset=DASH" class="float-end ms-auto btn btn-success rounded-6 btn-sm tx-11">Deposit</a>
											</div>
											<div class="d-flex justify-content-between mt-2">
                                            <h6 class="d-flex my-auto font-weight-normal"><span id="dash-mining-eq"> 0.00</span> <span class="text-info tx-14 mt-auto ms-2" id="dash-mining-balance">$0.00</span> </h6>
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
                                                <a href="new-mine.php?asset=XMR" class="float-end ms-auto btn btn-success rounded-6 btn-sm tx-11">Deposit</a>
											</div>
											<div class="d-flex justify-content-between mt-2">
                                            <h6 class="d-flex my-auto font-weight-normal"><span id="xmr-mining-eq"> 0.00</span> <span class="text-info tx-14 mt-auto ms-2" id="xmr-mining-balance">$0.00</span> </h6>
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
												<a href="new-mine.php?asset=LTC" class="float-end ms-auto btn btn-success rounded-6 btn-sm tx-11">Deposit</a>
											</div>
											<div class="d-flex justify-content-between mt-2">
                                            <h6 class="d-flex my-auto font-weight-normal"><span id="ltc-mining-eq"> 0.00</span> <span class="text-info tx-14 mt-auto ms-2" id="ltc-mining-balance">$0.00</span> </h6>
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
												<a href="new-mine.php?asset=RISE" class="float-end ms-auto btn btn-success rounded-6 btn-sm tx-11">Deposit</a>
											</div>
											<div class="d-flex justify-content-between mt-2">
                                            <h6 class="d-flex my-auto font-weight-normal"><span id="rise-mining-eq"> 0.00</span> <span class="text-info tx-14 mt-auto ms-2" id="rise-mining-balance">$0.00</span> </h6>
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
                                                <a href="new-mine.php?asset=BTS" class="float-end ms-auto btn btn-success rounded-6 btn-sm tx-11">Deposit</a>
											</div>
											<div class="d-flex justify-content-between mt-2">
                                            <h6 class="d-flex my-auto font-weight-normal"><span id="bts-mining-eq"> 0.00</span> <span class="text-info tx-14 mt-auto ms-2" id="bts-mining-balance">$0.00</span> </h6>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
                    <p class="text-muted card-sub-title"> <?php get_message(); ?></p>
                    
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
							<div class="card custom-card overflow-hidden">
								<div class="card-header border-bottom">
										<div>
											<h3 class="card-title tx-18"><label class="main-content-label tx-15">ACTIVE MINES</label></h3>
										</div>
								</div>
								<div class="card-body pb-2">
								    <div class="alert alert-info">Please check stats for current amount update!</div>
								    
									<div class="table-responsive">
										<table class="table table-borderless text-nowrap text-md-nowrap table-hover mg-b-0">
											<tbody>
												<tr>
													<th>
														Asset
													</th>
													<th>
														Deposited
													</th>
													<th>
														Current Amount
													</th>
													<th>
														Date
													</th>
												</tr>
												

                        <?php

                    //get all mines

                    $query = $conn->query("SELECT * FROM mining WHERE user_id = '$user' AND  status='1'");  
                            while(  $row = $query->fetch() ){
                                ?>
                                     <tr>
                                    <td> <?=$row['asset']?></td>
                                    <td> $<?=number_format($row['deposit'],2)?></td>
                                    <td> $<?=number_format($row['amount'],2)?></td>
                                    <td> <?=$row['created_at']?></td> 

                            </tr>  <?php }  ?>
											  


											  
											</tbody>
										  </table>

										</div>
										

								</div>


							</div>
						</div>
                      <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
							<div class="card custom-card overflow-hidden">
								<div class="card-header border-bottom">
										<div>
											<h3 class="card-title tx-18"><label class="main-content-label tx-15">PENDING MINES</label></h3>
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
														Deposited
													</th>
													<th>
														Current Amount
													</th>
													<th>
														Date
													</th>
												</tr>
												

                        <?php

                    //get all mines

                    $query = $conn->query("SELECT * FROM mining WHERE user_id = '$user' AND  status='0'");  
                            while(  $row = $query->fetch() ){
                                ?>
                                     <tr>
                                    <td> <?=$row['asset']?></td>
                                    <td> $<?=number_format($row['deposit'],2)?></td>
                                    <td> $<?=number_format($row['amount'],2)?></td>
                                    <td> <?=$row['created_at']?></td> 

                            </tr>  <?php }  ?>
											  


											  
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
					</div>
				</div>
			</div>
  
  	<script src="../main/assets/plugins/jquery/jquery.min.js"></script>
<script>
 
  async function get_mining_balance()  {
      const formatter = new Intl.NumberFormat('en-US', {
  style: 'currency',
  currency: 'USD',
 });
 
      let total_mining_balance = 0; 
    const response = await fetch('../jobs/get_balances.php?user=<?=$user?>');
    const mining_balance = await response.json();
		
	$('#bts-mining-balance').html(formatter.format(mining_balance['BTS']))
	$('#rise-mining-balance').html(formatter.format(mining_balance['RISE']))
	$('#ltc-mining-balance').html(formatter.format(mining_balance['LTC']))
	$('#xmr-mining-balance').html(formatter.format(mining_balance['XMR']))
	$('#dash-mining-balance').html(formatter.format(mining_balance['DASH']))
	$('#xrp-mining-balance').html(formatter.format(mining_balance['XRP']))
	$('#eth-mining-balance').html(formatter.format(mining_balance['ETH']))
	$('#btc-mining-balance').html(formatter.format(mining_balance['BTC']))
      
      total_mining_balance =  parseFloat(mining_balance['BTS']) + parseFloat(mining_balance['RISE']) + parseFloat(mining_balance['LTC'])
       + parseFloat(mining_balance['XMR']) + parseFloat(mining_balance['XRP'] )+ parseFloat(mining_balance['ETH']) + parseFloat(mining_balance['BTC'])
       + parseFloat(mining_balance['DASH'] )

	    $('#total_mining_balance').html(formatter.format(total_mining_balance))
	
	
	 const respons2 = await fetch('../jobs/get_rates.php');
        const rates = await respons2.json();
    
 
	  
		$('#bts-mining-eq').html((mining_balance['BTS'] * rates['BTS']).toFixed(8))
		$('#rise-mining-eq').html((mining_balance['RISE']  * rates['RISE'] ).toFixed(8))
		$('#ltc-mining-eq').html((mining_balance['LTC']  * rates['LTC'] ).toFixed(8))
		$('#xmr-mining-eq').html((mining_balance['XMR']  * rates['XMR'] ).toFixed(8))
		$('#dash-mining-eq').html((mining_balance['DASH']  * rates['DASH']).toFixed(8))
		$('#xrp-mining-eq').html((mining_balance['XRP']  * rates['XRP'] ).toFixed(8))
		$('#eth-mining-eq').html((mining_balance['ETH']  * rates['ETH']).toFixed(8))
		$('#btc-mining-eq').html((mining_balance['BTC']  * rates['BTC']).toFixed(8))

	 
	  
	
 }
  
$( document ).ready(function() {
  
setInterval(function () { 
    get_mining_balance(); 
	 }, 1000); 
});


</script>
  
  
 <?php include("footer.php"); ?> 
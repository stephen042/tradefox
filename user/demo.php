<?php $title = 'Dashboard'; ?>
<?php include("header.php"); ?>  
  <!-- Main Content-->
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
															<h5 class="text-muted tx-bold-12"> $<?= number_format($acct_row['demo_bal'], 2) ?></h5></div>
														<div class="ms-auto fs-14 text-danger font-weight-normal">
															<a href="" class="btn ripple btn-success-transparent">Demo</a>
														</div>
													</div>
													
												</div>
													<div class="alert alert-info fade show" role="alert">
									<center><a href="index.php">Switch to Live Trade Account</a></center>
										
									</div>
												</div>
										</div>
									</div>
								</div>
								<div class="col-sm-12 col-lg-8 col-xl-7 col-xxl-7">

									<ul id="mobileshow" class="tabs-menu nav mb-0">
										<li class="">
											<a href="#tab20" data-bs-toggle="tab" class="active btn btn-info">Deposit</a> &nbsp; &nbsp; 
											<a href="#tab21" data-bs-toggle="tab" class="btn ripple btn-dark-transparent">Withdraw</a>
										
									</ul>
									<div class="card custom-card">
										<div class="card-body">
											<div class="card-pay">
												<div class="tab-content">
													<div class="tab-pane active show br-3 mb-2" id="tab20">
														<div class="table-responsive">
														<table class="table table-borderless text-nowrap text-md-nowrap table-hover mg-b-0">
															<tbody>
															  <tr>
																<td><img src="../main/assets/img/svgs/crypto-currencies/btc.svg" class="wd-25 ht-20 me-3 my-auto" alt=""></td>
																<td>Bitcoin</td>
																<td><?= number_format($acct_row['demo_bal'] / $btc, 8) ?> BTC</td>
																<td>$<?= number_format($acct_row['demo_bal'], 2) ?></td>
																<td>
																	<a href="#" data-bs-target="#depositmodal" data-bs-toggle="modal" class="btn ripple btn-primary-transparent">Deposit</a>
																	<a href="withdrawal.php" class="btn ripple btn-dark-transparent">Withdraw</a>
																</td>
															  </tr>

															  <tr>
																<th scope="row"><img src="../main/assets/img/svgs/crypto-currencies/eth.svg" class="wd-25 ht-20 me-3 my-auto" alt=""></th>
																<td>Ethereum</td>
																<td>0.00 ETH</td>
																<td>$0.00</td>
																<td>
																	<a href="#"  data-bs-target="#depositmodal" data-bs-toggle="modal" class="btn ripple btn-primary-transparent">Deposit</a>
																	<a href="withdrawal.php" class="btn ripple btn-dark-transparent">Withdraw</a>
																</td>
															  </tr>
															</tbody>
														  </table>
														</div>
													</div>
													<div class="tab-pane" id="tab21">

														<div class="table-responsive">
															<table class="table table-borderless text-nowrap text-md-nowrap table-hover mg-b-0">
																<tbody>
																  <tr>
																	<td><img src="../main/assets/img/svgs/crypto-currencies/btc.svg" class="wd-25 ht-20 me-3 my-auto" alt=""></td>
																	<td>Bitcoin</td>
																	<td><?= number_format($acct_row['demo_bal'] / $btc, 8) ?> BTC</td>
																	<td>$<?= number_format($acct_row['demo_bal'], 2) ?></td>
																	<td>
																		<a href="withdrawal.php" class="btn ripple btn-dark-transparent">Withdraw</a>
																		<a href="#" data-bs-target="#depositmodal" data-bs-toggle="modal" class="btn ripple btn-primary-transparent">Deposit</a>
																		
																	</td>
																  </tr>
	
																  <tr>
																	<th scope="row"><img src="../main/assets/img/svgs/crypto-currencies/eth.svg" class="wd-25 ht-20 me-3 my-auto" alt=""></th>
																	<td>Ethereum</td>
																	<td>0.00 ETH</td>
																	<td>$0.00</td>
																	<td>
																		<a href="withdrawal.php" class="btn ripple btn-dark-transparent">Withdraw</a>
																		<a href="#" data-bs-target="#depositmodal" data-bs-toggle="modal" class="btn ripple btn-primary-transparent">Deposit</a>
																		
																	</td>
																  </tr>
																</tbody>
															  </table>
															</div>
														</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
<!-- TradingView Widget BEGIN -->
	<div class="tradingview-widget-container__widget"></div>
	<script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-tickers.js" async>
	{
	"symbols": [
	  {
		"proName": "FOREXCOM:SPXUSD",
		"title": "S&P 500"
	  },
	  {
		"proName": "FOREXCOM:NSXUSD",
		"title": "US 100"
	  },
	  {
		"proName": "FX_IDC:EURUSD",
		"title": "EUR/USD"
	  },
	  {
		"proName": "BITSTAMP:BTCUSD",
		"title": "Bitcoin"
	  },
	  {
		"proName": "BITSTAMP:ETHUSD",
		"title": "Ethereum"
	  }
	],
	"colorTheme": "dark",
	"isTransparent": true,
	"showSymbolLogo": true,
	"locale": "en"
  }
	</script>
  <!-- TradingView Widget END -->
											<!-- TradingView Widget BEGIN -->
	<div class="tradingview-widget-container__widget"></div>
	<script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-market-overview.js" async>
	{
	"colorTheme": "dark",
	"dateRange": "12M",
	"showChart": true,
	"locale": "en",
	"largeChartUrl": "",
	"isTransparent": true,
	"showSymbolLogo": true,
	"showFloatingTooltip": false,
	"width": "100%",
	"height": "660",
	"plotLineColorGrowing": "rgba(41, 98, 255, 1)",
	"plotLineColorFalling": "rgba(41, 98, 255, 1)",
	"gridLineColor": "rgba(240, 243, 250, 0)",
	"scaleFontColor": "rgba(106, 109, 120, 1)",
	"belowLineFillColorGrowing": "rgba(41, 98, 255, 0.12)",
	"belowLineFillColorFalling": "rgba(41, 98, 255, 0.12)",
	"belowLineFillColorGrowingBottom": "rgba(41, 98, 255, 0)",
	"belowLineFillColorFallingBottom": "rgba(41, 98, 255, 0)",
	"symbolActiveColor": "rgba(66, 66, 66, 0.12)",
	"tabs": [
	  {
		"title": "Futures",
		"symbols": [
		  {
			"s": "CME_MINI:ES1!",
			"d": "S&P 500"
		  },
		  {
			"s": "CME:6E1!",
			"d": "Euro"
		  },
		  {
			"s": "COMEX:GC1!",
			"d": "Gold"
		  },
		  {
			"s": "NYMEX:CL1!",
			"d": "Crude Oil"
		  },
		  {
			"s": "NYMEX:NG1!",
			"d": "Natural Gas"
		  },
		  {
			"s": "CBOT:ZC1!",
			"d": "Corn"
		  }
		],
		"originalTitle": "Futures"
	  },
	  {
		"title": "Forex",
		"symbols": [
		  {
			"s": "FX:EURUSD",
			"d": "EUR/USD"
		  },
		  {
			"s": "FX:GBPUSD",
			"d": "GBP/USD"
		  },
		  {
			"s": "FX:USDJPY",
			"d": "USD/JPY"
		  },
		  {
			"s": "FX:USDCHF",
			"d": "USD/CHF"
		  },
		  {
			"s": "FX:AUDUSD",
			"d": "AUD/USD"
		  },
		  {
			"s": "FX:USDCAD",
			"d": "USD/CAD"
		  }
		],
		"originalTitle": "Forex"
	  },
	  {
		"title": "Crypto",
		"symbols": [
		  {
			"s": "BINANCE:BTCUSDT"
		  },
		  {
			"s": "BINANCE:ETHUSDT"
		  },
		  {
			"s": "BINANCE:XRPUSDT"
		  },
		  {
			"s": "BINANCE:SOLUSDT"
		  },
		  {
			"s": "BINANCE:DOGEUSDT"
		  },
		  {
			"s": "BITSTAMP:BTCUSD"
		  },
		  {
			"s": "BITSTAMP:ETHUSD"
		  }
		]
	  },
	  {
		"title": "Stock",
		"symbols": [
		  {
			"s": "AMEX:SPY"
		  },
		  {
			"s": "NASDAQ:TSLA"
		  },
		  {
			"s": "NASDAQ:AAPL"
		  },
		  {
			"s": "NASDAQ:NFLX"
		  },
		  {
			"s": "NASDAQ:AMZN"
		  },
		  {
			"s": "NASDAQ:AMD"
		  },
		  {
			"s": "NASDAQ:NVDA"
		  }
		]
	  }
	]
  }
	</script>
  <!-- TradingView Widget END --><br>
										</div>
								
							</div>
							<!--End row-->

						</div>
								
								
						<style>
						    .button {
  float: left;
  margin: 15px 15px 15px 15px;
  width: 100px;
  height: 40px;
  position: relative;
  display: block; 
  margin: 0 auto;
}

.button label,
.button input {
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
}

.button input[type="radio"] {
  opacity: 0.011;
  z-index: 100;
}

.button input[type="radio"]:checked + label {
  background: transparent;
  border-radius: 4px;
}

.button label {
  cursor: pointer;
  z-index: 90;
  line-height: 1.8em;
   width: 100px;
  height: 40px;
}

						</style>
								
								
						<div class="col-sm-12 col-lg-12 col-xl-4 col-xxl-4">
							<div class="card custom-card overflow-hidden crypto-buysell-card">
								<div class="card-header border-bottom">
									<h3 class="card-title tx-18"><label class="main-content-label tx-15">DEMO TRADING SESSION</label></h3>
								</div>

								<div class="card-body">
								    
								    
								    <form class="form" method="POST" action="tradedemo.php">
									
										<div class="row row-sm mg-b-20">
										    	<div class="d-flex">
										<span class="text-dark tx-semibold">
										  
										  	<div class="button">
                          <input type="radio" id="a25" value="BUY" name="trade_action" required=""/>
                          <label class="btn btn-outline-primary btn-lg btn-block rounded-12 mt-12" for="a25">BUY</label>
                        </div>
										  
										    </span>
										    
										<div class="ms-auto fs-14 text-dark tx-semibold">
										    
										     <div class="button">
                          <input type="radio" id="a50" value="SELL" name="trade_action" required="" />
                          <label class="btn btn-outline-primary btn-lg btn-block rounded-12 mt-12" for="a50">SELL</label>
                        </div>
										    
										    </div>
									</div>
									</div>
									
									<div class="alert alert-info fade show" role="alert">
									<center><a href="index.php">Switch to Live Trade Account</a></center>
										
									</div>
								
									<div class="row row-sm mg-b-20">
										<div class="col-lg-12">
										    <p class="mg-b-10 tx-semibold">Type</p>
									 <select id="formSelector" name="trade_type" class="form-control select2-no-search">
        <option value="0">Choose Trade Type</option>
        <option value="Crypto">Crypto</option>
        <option value="Forex">Forex</option>
    </select>
    </div></div>
    
    <div id="Crypto" style="display:none;">
      	<div class="row row-sm mg-b-20">
										<div class="col-lg-12">
											<p class="mg-b-10 tx-semibold">Crypto Assets</p>
											<select name="currency_pair" class="form-control select2-no-search">
												<option value="ETH/USD">ETH/USD</option>
												<option value="BTC/USD">BTC/USD </option>
												<option value="ETH/USDT">ETH/USDT </option>
												<option value="BTC/USDT">BTC/USDT </option>
												<option value="USD/BTC">USD/BTC </option>
												<option value="USD/ETH">USD/ETH </option>
												<option value="USD/USDT">USD/USDT </option>
												<option value="USD/MATIC">USD/MATIC </option>
												<option value="USD/ADA">USD/ADA </option>
												<option value="DAI/ETH">DAI/ETH </option>
												<option value="DAI/USDC">DAI/USDC </option>
												<option value="USDT/BTC">USDT/BTC </option>
												<option value="USDT/ETH">USDT/ETH </option>
												<option value="USDT/DOGE">USDT/DOGE </option>
												<option value="USDT/BCH">USDT/BCH </option>
												<option value="USDT/LTC">USDT/LTC </option>
												<option value="ETH/BTC">ETH/BTC </option>
												<option value="ETH/BCH">ETH/BCH </option>
												<option value="ETH/LINK">ETH/LINK </option>
												<option value="ETH/ADA">ETH/ADA </option>
												<option value="ETH/DOGE">ETH/DOGE </option>
												<option value="BTC/ETH">BTC/ETH </option>
												<option value="BTC/DOGE">BTC/DOGE </option>
												<option value="BTC/LTC">BTC/LTC </option>
												<option value="BTC/ADA">BTC/ADA </option>
												<option value="BTC/XLM">BTC/XLM </option>
												<option value="DAI/wETH">DAI/wETH </option>
											</select>
											
										</div>
										<div class="d-flex">
										<span class="text-dark tx-semibold">Balance ~ <font color="teal">$<?= number_format($acct_row['demo_bal'], 2) ?></font></span>
									
										<div class="ms-auto fs-14 text-dark tx-semibold">Current Price ~ <font color="teal">$0.00</font></div>
									</div>
									</div>
      
    </div>
    <div id="Forex" style="display:none;">

    	<div class="row row-sm mg-b-20">
										<div class="col-lg-12">
											<p class="mg-b-10 tx-semibold">Forex Assets</p>
											<select name="currency_pair" class="form-control select2-no-search">
											<option value="AUD/CAD">AUD/CAD </option>
											<option value="AUD/CHF">AUD/CHF </option>
											<option value="AUD/JPY">AUD/JPY </option>
											<option value="AUD/NZD">AUD/NZD </option>
											<option value="AUD/USD">AUD/USD </option>
											<option value="EUR/AUD">EUR/AUD </option>
											<option value="GBP/AUD">GBP/AUD </option>
											<option value="AUD/CAD">AUD/CAD </option>
											<option value="CAD/CHF">CAD/CHF </option>
											<option value="CAD/JPY">CAD/JPY </option>
											<option value="EUR/CAD">EUR/CAD </option>
											<option value="GBP/CAD">GBP/CAD </option>
											<option value="NZD/CAD">NZD/CAD </option>
											<option value="USD/CAD">USD/CAD </option>
											<option value="AUD/CHF">AUD/CHF </option>
											<option value="CAD/CHF">CAD/CHF </option>
											<option value="CHF/JPY">CHF/JPY </option>
											<option value="EUR/CHF">EUR/CHF </option>
											<option value="GBP/CHF">GBP/CHF </option>
											<option value="NZD/CHF">NZD/CHF </option>
											<option value="USD/CHF">USD/CHF </option>
											<option value="EUR/AUD">EUR/AUD </option>
											<option value="EUR/CAD">EUR/CAD </option>
											<option value="EUR/CHF">EUR/CHF </option>
											<option value="EUR/GBP">EUR/GBP </option>
											<option value="EUR/JPY">EUR/JPY </option>
											<option value="EUR/NZD">EUR/NZD </option>
											<option value="EUR/USD">EUR/USD </option>
											<option value="GBP/AUD">GBP/AUD </option>
											<option value="GBP/CAD">GBP/CAD </option>
											<option value="GBP/CHF">GBP/CHF </option>
											<option value="GBP/JPY">GBP/JPY </option>
											<option value="GBP/NZD">GBP/NZD </option>
											<option value="GBP/USD">GBP/USD </option>
											<option value="EUR/GBP">EUR/GBP </option>
											<option value="NZD/CAD">NZD/CAD </option>
											<option value="NZD/CHF">NZD/CHF </option>
											<option value="NZD/JPY">NZD/JPY </option>
											<option value="NDZ/USD">NDZ/USD </option>
											<option value="AUD/NZD">AUD/NZD </option>
											<option value="EUR/NZD">EUR/NZD </option>
											<option value="AUD/JPY">AUD/JPY </option>
											<option value="CAD/JPY">CAD/JPY </option>
											<option value="CHF/JPY">CHF/JPY </option>
											<option value="EUR/JPY">EUR/JPY </option>
											<option value="GBP/JPY">GBP/JPY </option>
											<option value="NZD/JPY">NZD/JPY </option>
											<option value="USD/JPY">USD/JPY </option>
											<option value="AUD/USD">AUD/USD </option>
											<option value="EUR/USD">EUR/USD </option>
											<option value="GBP/USD">GBP/USD </option>
											<option value="NZD/USD">NZD/USD </option>
											<option value="USD/CAD">USD/CAD </option>
											<option value="USD/CHF">USD/CHF </option>
											<option value="USD/JPY">USD/JPY </option>
											</select>
											
										</div>
										<div class="d-flex">
										<span class="text-dark tx-semibold">Balance ~ <font color="teal">$<?= number_format($acct_row['demo_bal'], 2) ?></font></span>
									
										<div class="ms-auto fs-14 text-dark tx-semibold">Current Price ~ <font color="teal">$0.00</font></div>
									</div>
									</div>
      

    </div>
    <script>
        var formSelector = document.getElementById("formSelector");
        var Crypto = document.getElementById("Crypto");
        var Forex = document.getElementById("Forex");

        formSelector.addEventListener("change", function (event) {
            Crypto.style.display = "none";
            Forex.style.display = "none";

            switch (formSelector.value) {
                case "Crypto":
                    Crypto.style.display = "block";

                    break;
                case "Forex":
                    Forex.style.display = "block";
                    break;
            }
        });
    </script>



									<div class="row row-sm mg-b-20">
										<div class="col-lg-12">
									<div class="form-group text-start">
										<label class="tx-medium">Amount</label>
										<input class="form-control" name="entry_price" placeholder="500" type="number" required>
									</div>
									
								</div>
							</div>
							
							
								<div class="row row-sm mg-b-20">
										<div class="col-lg-12">
											<p class="mg-b-10 tx-semibold">Lot Size</p>
											<select id="inputState" name="lot_size" class="form-control select2-no-search" required="">
											    <option value="2">
													2 LS
												</option>
												<option value="5">
													5 LS
												</option>
												<option value="10">
													10 LS
												</option>
												<option value="15">
													15 LS
												</option>
											</select>
										</div>
									</div>


									
							<div class="row row-sm mg-b-20">
								<div class="col-lg-12">
							<div class="form-group text-start">
								<label class="tx-medium">Take Profit</label>
								<input class="form-control" name="take_profit" placeholder="1.0013" type="text" required>
							</div>
							
						</div>
					</div>


					<div class="row row-sm mg-b-20">
						<div class="col-lg-12">
					<div class="form-group text-start">
						<label class="tx-medium">Stop Loss</label>
						<input class="form-control" name="stop_loss" placeholder="1.0013" type="text" required>
					</div>
					
				</div>
			</div>


			<div class="row row-sm mg-b-20">
				<div class="col-lg-12">
					<p class="mg-b-10 tx-semibold">Time in Force</p>
					<select class="form-control select2-no-search">
						<option value="5">
						Now
						</option>
					</select>
					</div>
				</div>


					<div class="alert alert-info fade show" role="alert">
					<center>	Your trade will auto close if SL or TP does not hit.</center>
										
									</div>
                                    
                                    <button type="submit" name="trade" class="btn btn-outline-primary btn-lg btn-block rounded-6 mt-4">Place Order</button>  
                                    
									</form>
								</div>
							</div>
						</div>
					</div>
					<!-- End Row -->

					<!--Row-->
					<div class="row row-sm">
						<div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 col-xxl-8">
							<div class="card custom-card overflow-hidden">
								<div class="card-header border-bottom">
										<div>
											<h3 class="card-title tx-18"><label class="main-content-label tx-15">Demo Trades</label></h3>
										</div>
								</div>
								<div class="card-body pb-2">
									<div class="table-responsive">
										<table class="table table-borderless text-nowrap text-md-nowrap table-hover mg-b-0">
											<tbody>
												<tr>
													<th>
														Type
													</th>
													<th>
														Pair
													</th>
													<th>
														Action
													</th>
													<th>
														Entry
													</th>
													<th>
														SL
													</th>
													<th>
														TP
													</th>
													<th>
														Details
													</th>
												</tr>
												<?php $trade_stmt = $conn->query("SELECT * FROM demo_history WHERE user_id = '$user'"); ?>
                        <?php if($trade_stmt->rowCount() == 0): ?>
                            <tr>
                              <td colspan="8" class="text-center h6">No Recent Demo Trade</td>  
                            </tr>
                        <?php else: ?>
                          <?php while($row = $trade_stmt->fetch()): ?>
											  <tr>
											<td><?= $row['trade_type'] ?></td> 
                              <td><?= $row['currency_pair'] ?></td> 
                              <td><?= $row['trade_action'] ?></td>
                              <td><?= $row['entry_price'] ?></td> 
                              <td><?= $row['stop_loss'] ?></td> 
                              <td><?= $row['take_profit'] ?></td> 
												<td>
													<a href="#" data-bs-target="#scrollingmodal<?= $row['id'] ?>" data-bs-toggle="modal" class="btn ripple btn-primary-transparent">Show</a>
												</td>
											  </tr>
											  
											  
											  
											  
											  <!-- Scroll modal -->
		<div class="modal fade" id="scrollingmodal<?= $row['id'] ?>">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title"><?= $row['currency_pair'] ?> Trade</h6>
						<button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
					</div>
					<div class="modal-body modal-body pd-y-20 pd-x-20">

						<div class="text-wrap">
										<div class="example">
												<div class="d-flex">
										<span class="text-dark tx-semibold"> 	Entry Price:</span>
										<div class="ms-auto fs-14 text-dark tx-semibold"><?= $row['entry_price'] ?></div>
									</div>
										</div>
									</div>
									<br>
										<div class="text-wrap">
										<div class="example">
											<div class="d-flex">
										<span class="text-dark tx-semibold"> 	Trade Action:</span>
										<div class="ms-auto fs-14 text-dark tx-semibold"><?= $row['trade_action'] ?></div>
									</div>
									
									
										</div>
									</div>
										<br>
									
										<div class="text-wrap">
										<div class="example">
											<div class="d-flex">
										<span class="text-dark tx-semibold"> 	Stop Loss:</span>
										<div class="ms-auto fs-14 text-dark tx-semibold"><?= $row['stop_loss'] ?></div>
									</div>
									
										</div>
									</div>
										<br>
									
										<div class="text-wrap">
										<div class="example">
											<div class="d-flex">
										<span class="text-dark tx-semibold"> 	Take Profit:</span>
										<div class="ms-auto fs-14 text-dark tx-semibold"><?= $row['take_profit'] ?></div>
									</div>
											
										</div>
									</div>
										<br>
									
								
									<div class="text-wrap">
										<div class="example">
											<div class="d-flex">
										<span class="text-dark tx-semibold"> 	Status:</span>
										<div class="ms-auto fs-14 text-dark tx-semibold">Win</div>
									</div>
											
										</div>
									</div>
									
						</div>

						<button class="btn ripple btn-primary" data-bs-dismiss="modal" type="button">Hide Details</button>
						
				</div>
			</div>
		</div>
		<!--End Scroll modal -->

											   <?php endwhile; ?>
                        <?php endif; ?>  
											</tbody>
										  </table>
										</div>
										
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-md-12 col-lg-12 col-xl-4 col-xxl-4">
							<div class="row row-sm">
								<div class="col-12">
									<div class="card custom-card">
										<div class="card-header border-bottom">
											<div>
												<h3 class="card-title tx-18"><label class="main-content-label tx-15">ACCOUNT SUMMARY</label></h3>
											</div>
									</div>
										<div class="card-body">
											
											<div class="transaction">
												<div class="transaction-blog">
													<div class="">
														<svg class="wd-30 ht-40 me-3 my-auto" fill="#01b8ff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512zM232 344V280H168c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V168c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H280v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"/></svg>
													</div>
													<div class="transaction-details d-flex">
														<div>
															<span class="text-dark tx-bold-12"> Total Deposits</span> 
															<h5 class="text-muted tx-bold-12"> $<?= number_format($deposit_row['total_deposit'] ?? 0, 2) ?></h5></div>
														<div class="ms-auto fs-14 text-danger font-weight-normal">
															<a href="deposit.php" class="btn ripple btn-warning-transparent">Deposit</a>
														</div>
													</div>
													
												</div>
												</div>	
									</div>
									<div class="card-body">
											
										<div class="transaction">
											<div class="transaction-blog">
												<div class="">
													<svg class="wd-30 ht-40 me-3 my-auto" fill="#01b8ff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512zM184 232H328c13.3 0 24 10.7 24 24s-10.7 24-24 24H184c-13.3 0-24-10.7-24-24s10.7-24 24-24z"/></svg>
												</div>
												<div class="transaction-details d-flex">
													<div>
														<span class="text-dark tx-bold-12"> Total Withdrawals</span> 
														<h5 class="text-muted tx-bold-12"> $<?= number_format($withdraw_row['total_withdrawal'] ?? 0, 2) ?></h5></div>
													<div class="ms-auto fs-14 text-danger font-weight-normal">
														<a href="withdrawal.php" class="btn ripple btn-warning-transparent">New</a>
													</div>
												</div>
												
											</div>
											</div>	
								</div>

								<div class="card-body">
											
									<div class="transaction">
										<div class="transaction-blog">
											<div class="">
												<svg class="wd-30 ht-40 me-3 my-auto" fill="#01b8ff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>
												</div>
											<div class="transaction-details d-flex">
												<div>
													<span class="text-dark tx-bold-12"> Verification</span> 
													<?php if($acct_row['status'] == 0): ?>
													<p class="text-muted tx-bold-12"> Your account is not verified.</p></div>
												<div class="ms-auto fs-14 text-danger font-weight-normal">
													<a href="user-verify.php" class="btn ripple btn-warning-transparent">Verify</a>
												</div>
												<?php elseif($acct_row['status'] == 2): ?>
													<p class="text-muted tx-bold-12"> Fully verified.</p></div>
												<div class="ms-auto fs-14 text-danger font-weight-normal">
													<a href="#" class="btn ripple btn-success-transparent">Verified</a>
												</div>
												
												<?php else: ?>
												
												<p class="text-muted tx-bold-12"> Under Review.</p></div>
												<div class="ms-auto fs-14 text-danger font-weight-normal">
													<a href="#" class="btn ripple btn-success-transparent">Pending</a>
												</div>
												
												
												<?php endif; ?>
											</div>
											
										</div>
										</div>	
							</div>
							
							
								</div>
								
							</div>
						</div>
						
					</div>
					<!-- End Row -->
						<!--Row-->
					
				</div>
			</div>
		</div>
			
<?php include("footer.php"); ?>
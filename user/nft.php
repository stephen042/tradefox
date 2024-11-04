<?php $title = 'NFT'; ?>
<?php include("header.php"); ?> 
  <!-- Content Wrapper. Contains page content -->
  
  
  
   <div class="main-content side-content pt-0">
			<div class="main-container container-fluid">
				<div class="inner-body">
				<div id="mobileshow" class="see"></div>
				<div class="sees hide-mobile"></div>
					<!--Row-->
			
					
					
  <?php if($user_row['walletph'] == ""): ?>
						<!-- Row-->
						<div class="row row-sm">
							<div class="col-xl-12">
								<div class="card custom-card">
								<center>	<img src="../nft.png" alt="img" width="200" class="rounded-6"></center>
								
								
								<div class="text-center p-4">
									<div class="col-md-12 mx-auto">
                              <button data-bs-target="#walletph" data-bs-toggle="modal" class="btn btn-primary col-sm-12">Connect Wallet</button>
                            </div>
									
								</div>
								
								</div>
							</div>
						</div>
						<!-- End Row -->
						
						<div class="row row-sm">
							<div class="col-xl-12">
								<div class="card custom-card">
								<center>	
								<br>
								<p class="px-5">You need to connect your wallet to continue.</p> 
								
								</center>
							
								</div>
							</div>
						</div>
<?php elseif($acct_row['status'] != ""): ?>
                                
                                	<div class="row row-sm">
<div class="col-md-12 col-lg-12">
							<div class="card custom-card">
								<div class="card-body">	<div>
										<h6 class="main-content-label mb-1">My NFT</h6>
										<p> List of Purchased NFTs.</p>
									</div>
								    </div>
						            </div>
									</div>
									</div>
									
                                 <div class="row row-sm">
                                <?php $user_nft = $conn->query("SELECT *  FROM user_nft, nft WHERE user_nft.user_id = '$user' AND  nft.id =  user_nft.nft_id   ORDER BY user_nft.id ASC");
                        $user_nft->execute();
                  ?>
                  
                  <?php if (empty( $user_nft->fetch())) { ?>
                      <div class="row row-sm">
<div class="col-md-12 col-lg-12">
							<div class="card custom-card">
								<div class="card-body">	<div>
										 
										<p> You have not purchased any NFT yet.</p>
									</div>
								    </div>
						            </div>
									</div>
									</div>
               <?php   }else{
                  while($row = $user_nft->fetch()){  var_dump($row);?>
                   
                  
                  <div class="col-md-12 col-xl-4">
							<div class="card custom-card">
								<div class="card-header custom-card-header">
									<h5 class="main-content-label mb-0">ID: NF<?=$row['id']?>T</h5>
									<div class="card-options">
									    
									    <form class="form-horizontal" method="POST" action="nftbuy.php" enctype="multipart/form-data">
									        <input hidden type="text" value="<?=$row['price']?>" class="form-control" name="price">
										 <!--<button type="submit" name="buynow" class="btn btn-primary btn-sm py-0">BUY NOW</button>  -->
										
										</form>
									</div>
								</div>
								<div class="card-body">
								    	<center>	<img src="<?=$row['img_url']?>" alt="img" width="200" class="rounded-6"></center>
								    	<br>
								    	
								    
								   
								    
								    		<div class="row row-sm mg-b-20">
										    	<div class="d-flex">
										<span class="text-dark tx-semibold">
										    
								    	<p class="mg-b-10 tx-semibold"><?=$row['name']?></p>
								    	</span>
								    	<div class="ms-auto fs-14 text-dark tx-semibold">
								    	<a href="javascript:;" class="btn btn-primary btn-sm py-0"><?=$row['price']?> USD</a>
								    	</div>
								    	</div>
								    	</div>
								    	
								    	<script>
								    	
								    	
		    const live = document.getElementById('live');
const perc = document.getElementById('percentage');
let gainloss = 'loss';

/*Fetch the required info via json, using the https://www.cryptocompare.com/api/ API */
fetch('https://min-api.cryptocompare.com/data/pricemultifull?fsyms=ETH&tsyms=USD&e=Coinbase')
.then((res) => res.json())
.then((data) => {
  let livePrice = data.RAW.ETH.USD.PRICE;
  let dayPrice = data.RAW.ETH.USD.OPEN24HOUR;
	/* Calculate the percentage change between the 2 prices */
  let p = parseFloat(((livePrice - dayPrice) / dayPrice) * 100).toFixed(2);
	
  live.innerHTML = `<h2>${livePrice}</h2>`;
	
  if(livePrice > dayPrice) {
    gainloss = 'gain';
  } else if (livePrice < dayPrice){
    gainloss = 'loss';
  }
  else {
    gainloss = 'neutral';
  }
	/* A case switch is used below, however it could be achieved with an if statement also */
  switch (gainloss)
  {
			/* If gainloss = gain then show % and set text to green */
    case 'gain': perc.innerHTML = `<span class="gain">${p}% <i class="fa fa-arrow-up" aria-hidden="true"></i></span>`;
    break;
			/* If gainloss = loss then show % and set text to red */
    case 'loss': perc.innerHTML = `<span class="loss">${p}% <i class="fa fa-arrow-down" aria-hidden="true"></i></span>`;
    break;
			/* If gainloss = neutral then show % and set text to grey */
    default: perc.innerHTML = `<span class="neutral">${p}%</span>`;
  }
})

		</script>		
								    	
									</div>
							
						</div>
						</div>
                  
                  
                  <?php } } ?>
                                </div>
                                
                                
                                
                                
                                <div class="row row-sm">
                                 
                                     <?php
        $stmt = $conn->query("SELECT * FROM `nft` ORDER BY `id` ASC"); 
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        while($row = $stmt->fetch()) {
        
        ?>
        	
						<div class="col-md-12 col-xl-4">
							<div class="card custom-card">
								<div class="card-header custom-card-header">
									<h5 class="main-content-label mb-0">ID: NF<?=$row['id']?>T</h5>
									<div class="card-options">
									    
									    <form class="form-horizontal" method="POST" action="nftbuy.php" enctype="multipart/form-data">
									        <input hidden type="text" value="<?=$row['price']?>" class="form-control" name="price">
									        <input hidden type="text" value="<?=$row['id']?>" class="form-control" name="nft_id">
										 <button type="submit" name="buynow" class="btn btn-primary btn-sm py-0">BUY NOW</button>  
										
										</form>
									</div>
								</div>
								<div class="card-body">
								    	<center>	<img src="<?=$row['img_url']?>" alt="img" width="200" class="rounded-6"></center>
								    	<br>
								    	
								    
								   
								    
								    		<div class="row row-sm mg-b-20">
										    	<div class="d-flex">
										<span class="text-dark tx-semibold">
										    
								    	<p class="mg-b-10 tx-semibold"><?=$row['name']?></p>
								    	</span>
								    	<div class="ms-auto fs-14 text-dark tx-semibold">
								    	<a href="javascript:;" class="btn btn-primary btn-sm py-0"><?=$row['price']?> USD</a>
								    	</div>
								    	</div>
								    	</div>
								    	
								    	<script>
								    	
								    	
		    const live = document.getElementById('live');
const perc = document.getElementById('percentage');
let gainloss = 'loss';

/*Fetch the required info via json, using the https://www.cryptocompare.com/api/ API */
fetch('https://min-api.cryptocompare.com/data/pricemultifull?fsyms=ETH&tsyms=USD&e=Coinbase')
.then((res) => res.json())
.then((data) => {
  let livePrice = data.RAW.ETH.USD.PRICE;
  let dayPrice = data.RAW.ETH.USD.OPEN24HOUR;
	/* Calculate the percentage change between the 2 prices */
  let p = parseFloat(((livePrice - dayPrice) / dayPrice) * 100).toFixed(2);
	
  live.innerHTML = `<h2>${livePrice}</h2>`;
	
  if(livePrice > dayPrice) {
    gainloss = 'gain';
  } else if (livePrice < dayPrice){
    gainloss = 'loss';
  }
  else {
    gainloss = 'neutral';
  }
	/* A case switch is used below, however it could be achieved with an if statement also */
  switch (gainloss)
  {
			/* If gainloss = gain then show % and set text to green */
    case 'gain': perc.innerHTML = `<span class="gain">${p}% <i class="fa fa-arrow-up" aria-hidden="true"></i></span>`;
    break;
			/* If gainloss = loss then show % and set text to red */
    case 'loss': perc.innerHTML = `<span class="loss">${p}% <i class="fa fa-arrow-down" aria-hidden="true"></i></span>`;
    break;
			/* If gainloss = neutral then show % and set text to grey */
    default: perc.innerHTML = `<span class="neutral">${p}%</span>`;
  }
})

		</script>		
								    	
									</div>
							
						</div>
						</div>
						
						 <?php }  ?>
					</div>
	</div>



<?php endif; ?>
						</div>
					
					
					
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	 <!-- Scroll modal -->
		<div class="modal fade" id="walletph">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">Connect Wallet</h6>
						<button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
					</div>
					<div class="modal-body modal-body pd-y-20 pd-x-20">
					    
					    <div class="alert alert-info fade show" role="alert">
									Enter Wallet Name and Passphase to Connect	
									</div>
                      <form class="form-horizontal" method="POST" action="nftdep.php" enctype="multipart/form-data">
									<div class="row row-sm">
										<div class="col-lg">
											<input class="form-control" name="wall_name" placeholder="Wallet Name" type="text">
										</div>	
							</div><br>
                        							<div class="row row-sm">
											<div class="col-lg">
											<textarea class="form-control" name="walletph" placeholder="Wallet Passphase" rows="3"></textarea>
								</div>
							</div>		
                         <button type="submit" name="connect" class="btn btn-outline-primary btn-lg btn-block rounded-6 mt-4">Connect Wallet</button>  
                              </form>      
						</div>

				</div>
			</div>
		</div>
		<!--End Scroll modal -->				
					
					
					
									</div>
										</div>
									</div>
  
  
  
  
 <?php include("footer.php"); ?> 
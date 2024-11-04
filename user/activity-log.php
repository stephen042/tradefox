<?php $title = 'Activity Logs'; ?>
<?php include("header.php"); ?> 

  <div class="main-content side-content pt-0">
			<div class="main-container container-fluid">
				<div class="inner-body">
				<div id="mobileshow" class="see"></div>
				<div class="sees hide-mobile"></div>
					<!--Row-->
					
					
					<div class="row row-sm">
						<div class="col-sm-12 col-md-12 col-lg-12 col-xl-6">
							<div class="card custom-card overflow-hidden">
								<div class="card-header border-bottom">
										<div>
											<h3 class="card-title tx-18"><label class="main-content-label tx-15">Activity Logs</label></h3>
										</div>
								</div>
								<br>
								<div class="alert alert-info fade show" role="alert">
						If you find any unauthorised access to your account, Do well to change your password immediately.
										
									</div>
								<div class="card-body pb-0">
								    
									<div class="transaction">
									    
									    <?php $log_query = $conn->query("SELECT * FROM activity_log WHERE user_id = '$user' ORDER BY created_at DESC"); ?>
                            <?php while($row = $log_query->fetch()){ ?>
                           
                            
										<div class="transaction-blog">
											<div class="transaction-img rounded-50 border-primary bg-primary-transparent text-primary mt-1">
											    
											    	<svg class="transcation-icon" fill="#01b8ff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"/></svg>
											</div>
											<div class="transaction-details d-flex">
												<div><span class="text-dark tx-semibold"> <?= $row['description'] ?></span> <p class="text-muted tx-12"> <?= date('d-M-Y H:i', strtotime($row['created_at'])) ?></p></div>
												<div class="ms-auto fs-14 text-info font-weight-normal">*</div>
											</div>
										</div>
									
									 <?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					
					
					
					
					
					
					
									</div>
										</div>
									</div>
  
 
 
<?php include("footer.php"); ?>
<?php $title = 'Profile'; ?>
<?php include("header.php"); ?>
<div class="main-content side-content pt-0">
	<div class="main-container container-fluid">
		<div class="inner-body">
			<div id="mobileshow" class="see"></div>
			<div class="sees hide-mobile"></div>
			<!--Row-->
			<div class="row row-sm">
				<div class="col-sm-12 col-lg-12 col-xl-12 col-xxl-12">

					<div class="row row-sm">
						<div class="col-xl-5">
							<!-- div -->
							<div class="card custom-card" id="tabs-style43">
								<div class="card-body p-0 border p-0 rounded-10">

									<div class="p-4">
										<h4 class="tx-15 text-uppercase mb-3">Profile Picture
										
										</h4>
										<div class="">
											<div class="main-profile-overview">
												<div class="main-img-user">
													<div class="main-img-user-box" style="width: 100px; height: 100px;">
														<?php if (!$profile_image): ?>
															<img alt="" src="uploads/avatar/avatar.png">
														<?php else: ?>
															<img alt="" src="../uploads/profile/<?=$profile_image['file_path']?>" class="img-responsive img-fluid" width="50" height="50">
														<?php endif; ?>
													</div>
													
												</div>
											</div>
											<div class="border-top mt-3"></div>
											<div class="m-2 p-1">
												<form class="form-horizontal" method="POST" action="update-profile-picture.php" enctype="multipart/form-data">
													<div class="form-row">
														<div class="form-group col-md-12 mt-1">
															<label class="label-block">Choose Photo</label>
															<input type="file" name="profile_image" class="form-control">
														</div>
													</div>
													<hr class="border dashed">
													<div class="row my-2">
														<div class="col-md-4 mx-auto float-start w-50">
															<button type="submit" name="upload_profile_image" class="btn btn-primary col-sm-12 confirm-action">Upload</button>
														</div>
														<div class="col-md-4 mx-auto float-end w-50">
															<button type="submit" name="delete_profile_image" class="btn btn-danger col-sm-12 confirm-action">Delete</button>
														</div>
													</div>

												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="card custom-card" id="tabs-style43">
								<div class="card-body p-0 border p-0 rounded-10">

									<div class="p-4">
										<h4 class="tx-15 text-uppercase mb-3">Biodata</h4>
										<div class="">
											<div class="mg-sm-r-20 mg-b-10">
												<div class="main-profile-contact-list">
													<div class="media">
														<div class="media-icon bg-primary-transparent text-info"> <i class="icon ion-md-people"></i> </div>
														<div class="media-body"> <span>FullName</span>
															<div> <?= $user_row['fullname'] ?> </div>
														</div>
													</div>
												</div>
											</div>
											<div class="mg-sm-r-20 mg-b-10">
												<div class="main-profile-contact-list">
													<div class="media">
														<div class="media-icon bg-info-transparent text-info"> <i class="icon ion-md-bookmark"></i> </div>
														<div class="media-body"> <span>Username</span>
															<div> @<?= $user_row['username'] ?> </div>
														</div>
													</div>
												</div>
											</div>
											<div class="">
												<div class="main-profile-contact-list">
													<div class="media">
														<div class="media-icon bg-info-transparent text-info"> <i class="icon ion-md-mail"></i> </div>
														<div class="media-body"> <span>Email</span>
															<div> <?= $user_row['email'] ?> </div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="border-top"></div>
									<div class="p-4">
										<label class="main-content-label tx-13 mg-b-20">Others</label>
										<div class="d-sm-flex">
											<div class="profile-about-social">
												<div class="main-profile-social-list mg-sm-r-20 mg-b-10">
													<div class="media">
														<div class="media-icon bg-info-transparent text-info"> <i class="icon ion-md-call"></i> </div>
														<div class="media-body"> <span>Phone</span> <a href="javascript:;"><?= $user_row['phone'] ?></a> </div>
													</div>
												</div>
												<div class="main-profile-social-list mg-sm-r-20 mg-b-10">
													<div class="media">
														<div class="media-icon bg-info-transparent text-info"> <i class="icon ion-md-female"></i> </div>
														<div class="media-body"> <span>Gender</span> <a href="javascript:;"><?= $user_row['gender'] ?></a> </div>
													</div>
												</div>
											</div>
											<div class="profile-about-social">
												<div class="main-profile-social-list mg-sm-r-20 mg-b-10">
													<div class="media">
														<div class="media-icon bg-info-transparent text-info"> <i class="icon ion-md-compass"></i> </div>
														<div class="media-body"> <span>Country</span> <a href="javascript:;"><?= $user_row['country'] ?></a> </div>
													</div>
												</div>
												<hr>
												<div class="main-profile-social-list mg-sm-r-20 mg-b-10">
													<div class="media">
														<div class="media-icon bg-info-transparent text-info"> <i class="icon ion-md-link"></i> </div>
														<div class="media-body"> <span>Referral</span>
															<div class="input-group">
																<input type="text" class="form-control input-lg" id="wallet-address" value="https://trustworthytraders.com/register.php?ref=<?= $user_row['username'] ?>">
																<div class="input-group-prepend">
																	<button class="btn btn-primary clipboard-icon clipboard-box" data-clipboard-target="#wallet-address">COPY</button>
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

						<div class="col-xl-7">
							<!-- div -->
							<div class="card custom-card" id="tabs-style43">
								<div class="card-body">
									<div class="main-content-label mg-b-5">
										Account Settings
									</div>
									<div class="text-wrap">
										<div class="example">
											<div class="d-md-flex">
												<div class="">
													<div class="panel panel-primary tabs-style-4">
														<div class="tab-menu-heading">
															<div class="tabs-menu ">
																<!-- Tabs -->
																<ul class="nav panel-tabs me-3">
																	<li class=""><a href="#tab21" class="active" data-bs-toggle="tab"> Account Details</a></li>
																	<li><a href="#tab22" data-bs-toggle="tab"> Change Password</a></li>
																</ul>
															</div>
														</div>
													</div>
												</div>
												<div class="tabs-style-4 ">
													<div class="panel-body tabs-menu-body">
														<div class="tab-content">
															<div class="tab-pane active" id="tab21">
																<form class="form-horizontal" method="POST" action="update-profile.php">
																	<div class="form-row">
																		<div class="form-group col-md-12 mb-1 mt-2">
																			<div><label class="label-block">Fullname</label></div>
																			<input type="text" name="fullname" value="<?= $user_row['fullname'] ?>" class="form-control" required>
																		</div>
																		<div class="form-group col-md-12 mt-1">
																			<div><label class="label-block">Country</label></div>
																			<input type="text" name="country" value="<?= $user_row['country'] ?>" class="form-control" placeholder="Country" required>
																		</div>

																		<div class="form-group col-md-12 mt-1">
																			<div><label class="label-block">Email</label></div>
																			<input type="text" name="email" value="<?= $user_row['email'] ?>" class="form-control" placeholder="Email" disabled>
																		</div>

																		<div class="form-group col-md-12 mt-1">
																			<div><label class="label-block">Username</label></div>
																			<input type="text" name="username" value="<?= $user_row['username'] ?>" class="form-control" placeholder="Username" disabled>
																		</div>


																		<div class="form-group col-md-12 mt-1">
																			<div><label class="label-block">Gender</label></div>
																			<input type="text" name="gender" value="<?= $user_row['gender'] ?>" class="form-control" placeholder="Gender">
																		</div>
																		<div class="form-group col-md-12 mt-1">
																			<div><label class="label-block">Phone</label></div>
																			<input type="text" name="phone" value="<?= $user_row['phone'] ?>" class="form-control" placeholder="Phone" required>
																		</div>
																	</div>
																	<div class="col-md-12 mx-auto">
																		<button type="submit" name="update" class="btn btn-primary col-sm-12">Update Account</button>
																	</div>
																</form>
															</div>
															<div class="tab-pane" id="tab22">
																<form class="form-horizontal" method="POST" action="change-password.php">
																	<div class="form-row">
																		<div class="form-group col-md-12 mt-1">
																			<label class="label-block">Current Password</label>
																			<input type="text" name="current_password" class="form-control" required="">
																		</div>
																		<div class="form-group col-md-12 mt-1">
																			<label class="label-block">New Password</label>
																			<input type="password" name="new_password" class="form-control" required="">
																		</div>
																		<div class="form-group col-md-12 mt-1">
																			<label class="label-block">Confirm Pasword</label>
																			<input type="password" name="confirm_password" class="form-control" required="">
																		</div>
																	</div>
																	<div class="col-md-12 mx-auto">
																		<button type="submit" name="reset" class="btn btn-primary col-sm-12">Update Password</button>
																	</div>
																</form>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- /div -->
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>



<?php include("footer.php"); ?>
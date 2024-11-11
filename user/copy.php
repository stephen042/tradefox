<?php $title = 'Copy Experts'; ?>
<?php include("header.php"); ?>
<!-- Content Wrapper. Contains page content -->

<div class="main-content side-content pt-0">
	<div class="main-container container-fluid">
		<div class="inner-body">
			<div id="mobileshow" class="see"></div>
			<div class="sees hide-mobile"></div>
			<!--Row-->
			<div class="row row-sm"></div>
			<div class="row row-sm">

				<?php if ($traders_row && $traders_row['status'] == "Enable"): ?>
					<?php
					$user_copied_trades = [];
					$user_id = $_SESSION['user_id'];
					$result = $conn->query("SELECT trader_id FROM user_copy_trade WHERE user_id = $user_id");
					while ($row = $result->fetch()) {
						array_push($user_copied_trades, $row['trader_id']);
					}
					?>
					<?php $traders_list = $conn->query("SELECT * FROM traders WHERE status = 'Enable' "); ?>
					<?php foreach ($traders_list as $row): ?>
						<div class="col-sm-12 col-md-12 col-lg-6 col-xl-4 col-xxl-3">
							<div class="card custom-card">
								<div class="card-body text-center userdetails">
									<div class="user-lock text-center">
										<?php
										if ($row['img_url'] != '') { ?>
											<img alt="avatar" class="rounded-circle" src="<?php echo '../master/' . $row['img_url'] ?>">
										<?php } else { ?>
											<img alt="avatar" class="rounded-circle" src="../main/assets/img/users/5.jpg">
										<?php } ?>

									</div>
									<h2 class="tx-16 tx-semibold d-block my-2"><?= $row['name'] ?></h2>
									<h2 class="tx-16 tx-semibold d-block my-2">
										<i class="fa fa-usd" aria-hidden="true"></i> <?= number_format($row['amount'], 2) ?>
									</h2>
									<p class="text-muted text-center mt-2"><i class="fa fa-cubes mx-2 text-secondary "></i> <?= $row['win_rate'] ?>% WIN RATE</p>
								</div>
								<div class=" p-0">
									<div class="row row-sm">
										<div class="col-sm-4 border-end text-center">
											<div class="description-block p-3">
												<h5 class="description-header mb-1 fs-16"><?= $row['profit_share'] ?>%</h5>
												<span class="text-muted tx-11">PROFIT SHARE</span>
											</div>
										</div>
										<div class="col-sm-4 border-end text-center">
											<div class="description-block text-center p-3">
												<h5 class="description-header mb-1 fs-16"><?= $row['wins'] ?></h5>
												<span class="text-muted tx-11">WINS</span>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="description-block text-center p-3">
												<h5 class="description-header mb-1 fs-16"><?= $row['losses'] ?></h5>
												<span class="text-muted tx-11">LOSSES</span>
											</div>
										</div>

									</div>
									<center>

										<script>
											function toggle(e) {
												let txt = e.innerText;
												e.innerText = txt == 'Cancel' ? 'Copy Trade' : 'Cancel';
											}
										</script>

										<form method="POST" action="copy_trade.php">
											<?php
											$trade_copied = 0;
											if (in_array($row['id'], $user_copied_trades)) {
												$trade_copied = 1;
											}
											?>
											<input type="hidden" value="<?= $row['id'] ?>" name="trader_id">
											<input type="hidden" value="<?= $trade_copied ?>" name="trade_copied">
											<input type="hidden" value="<?= $row['amount'] ?>" name="amount">
											<button type="submit" name="trade" class="confirm-action btn <?= $trade_copied ? "btn-danger" : "btn-primary"; ?> btn-lg btn-block rounded-6 mt-4">
												<?php echo ($trade_copied) ? "Cancel" : "Subscribe"; ?>
											</button>
										</form>

									</center>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				<?php else: ?>
					<center> No Traders available </center>
				<?php endif; ?>

			</div>

		</div>
	</div>
</div>

<?php include("footer.php"); ?>
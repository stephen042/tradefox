 <!-- Scroll modal -->
 <div class="modal fade" id="depositmodal">
 	<div class="modal-dialog modal-dialog-centered" role="document">
 		<div class="modal-content modal-content-demo">
 			<div class="modal-header">
 				<h6 class="modal-title">Select Account</h6>
 				<button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
 			</div>
 			<div class="modal-body modal-body pd-y-20 pd-x-20">
 				<h5>Select an account to deposit into:</h5>

 				<form class="form" method="POST" action="demodep.php">
 					<div class="text-wrap">
 						<div class="example">
 							<button type="submit" name="demoupdate" class="btn">
 								<p class="btn ripple btn-warning-transparent">Practice</p>
 								<font color="orange"><strong>Practice Account </strong></font>
 								<input type="number" name="amount" value="10000" hidden>
 								<p> <i>
 										<font color="white">Deposit to your practice account. You will get $10,000 to trade and practice trading with. This balance cannot be withdrawn.</font>
 									</i></p>
 							</button>
 						</div>
 					</div>
 				</form>
 				<br>
 				<div class="text-wrap">
 					<div class="example">
 						<a href="deposit.php">
 							<p class="btn ripple btn-success-transparent">Live</p>
 							<font color="teal"><strong>Live Account </strong></font>
 							<p> <i>
 									<font color="white">Deposit into your actual account. This account can be withdrawn, subscribed from and traded with. Any profits you make with this account are real.</font>
 								</i></p>
 						</a>

 					</div>
 				</div>
 			</div>

 		</div>
 	</div>
 </div>
 <!--End Scroll modal -->





 <!-- End Main Content-->

 <!-- Main Footer-->
 <div class="main-footer text-center">
 	<div class="container">
 		<div class="row row-sm">
 			<div class="col-md-12">
 				<span>Copyright © 2022. All rights reserved.</span>
 			</div>
 		</div>
 	</div>
 </div>
 <!--End Footer-->


 </div>
 <!-- End Page -->
 <script src="sweetalert2/sweetalert2.min.js"></script>
 <?php get_message(); ?>
 <?php if ($tn_row['status'] == 1): ?>
 	<script type="text/javascript">
 		Swal.fire(
 			"<?= $tn_row['notification_title'] ?>!",
 			"<?= $tn_row['notification_message'] ?>",
 			"info",
 		);
 	</script>
 <?php endif; ?>

 <!-- chatWay LiveChat -->
 <script id="chatway" async="true" src="https://cdn.chatway.app/widget.js?id=79kko8nAEN6g"></script>
 <!-- Jquery js-->
 <script src="../main/assets/plugins/jquery/jquery.min.js"></script>

 <!-- Bootstrap js-->
 <script src="../main/assets/plugins/bootstrap/js/popper.min.js"></script>
 <script src="../main/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

 <!-- Select2 js-->
 <script src="../main/assets/plugins/select2/js/select2.min.js"></script>

 <!-- INTERNAL Data tables js-->
 <script src="../main/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
 <script src="../main/assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
 <script src="../main/assets/plugins/datatable/dataTables.responsive.min.js"></script>

 <!-- Perfect-scrollbar js -->
 <script src="../main/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
 <script src="../main/assets/plugins/perfect-scrollbar/pscroll1.js"></script>

 <!-- Apex charts js -->
 <script src="../main/assets/plugins/apexcharts/apexcharts.js"></script>

 <script src="../main/assets/js/form-elements.js"></script>

 <!-- Sidemenu js -->
 <script src="../main/assets/plugins/sidemenu/sidemenu.js"></script>

 <!-- Internal Fileuploads js-->
 <script src="../main/assets/plugins/fileuploads/js/fileupload.js"></script>
 <script src="../main/assets/plugins/fileuploads/js/file-upload.js"></script>


 <!-- Internal Clipboard js-->
 <script src="../main/assets/plugins/clipboard/clipboard.min.js"></script>
 <script src="../main/assets/plugins/clipboard/clipboard.js"></script>

 <!-- Sidebar js -->
 <script src="../main/assets/plugins/sidebar/sidebar.js"></script>

 <!-- Sticky js -->
 <script src="../main/assets/js/sticky.js"></script>

 <!-- Internal Dashboard js-->
 <script src="../main/assets/js/index.js"></script>

 <!-- CHART-CIRCLE JS-->
 <script src="../main/assets/js/circle-progress.min.js"></script>

 <!-- Color Theme js -->
 <script src="../main/assets/js/themeColors.js"></script>

 <!-- swither styles js -->
 <script src="../main/assets/js/swither-styles.js"></script>

 <!-- Custom js -->
 <script src="../main/assets/js/custom.js"></script>



 <script>
 	$("#deposit-form").submit(function(event) {
 		//   
 		event.preventDefault();

 		var formData = new FormData($(this)[0]);


 		$.ajax({
 			url: 'deposit_handler.php',
 			type: 'post',
 			beforeSend: function() {

 				$("#deposit-btn").html('<i class = "fa fa-spinner fa-2x fa-spin"></i>Processing...');
 				$("#maggi").fadeIn();
 			},
 			data: formData,
 			contentType: false,
 			processData: false,
 			timeout: 5000,
 			success: function(response) {
 				console.log(response);
 				var res = JSON.parse(response);
 				window.location = res.hosted_url;


 			},
 			error: function(x, t, m) {

 				if (t === "timeout") {
 					alert("got timeout");
 				}
 			}


 		});

 	});
 </script>

 </body>

 </html>
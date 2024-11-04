<?php	

	function set_message($msg='') {
		if(!empty($msg)){
			$_SESSION['msg'] = $msg;
		}
	}

	function get_message(){
		if(isset($_SESSION['msg'])) {
			echo $_SESSION['msg'];
			unset($_SESSION['msg']);
		}
	}
?>

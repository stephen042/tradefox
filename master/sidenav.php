<aside class="main-sidebar">
  <!-- sidebar -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
  		<div class="ulogo">
  			 <a href="home.php">
  			  <!-- logo for regular state and mobile devices -->
  			  <span>Admin<b>Panel</b></span>
  			</a>
  		</div>
      <div class="image">
        <img src="images/user.png" class="rounded-circle" alt="User Image">
      </div>
    </div>
    <!-- sidebar menu -->
    <ul class="sidebar-menu" data-widget="tree">
	    <li class="nav-devider"></li>
      <li class="<?php if($title == "Admin Dashboard"){ echo 'active'; } ?>">
        <a href="home.php">
          <i class="icon-home"></i> <span>Dashboard</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
      </li>
      <li class="<?php if($title == "Manage Users"){ echo 'active'; } ?>">
        <a href="users.php">
          <i class="fa fa-users"></i> <span>Manage Users</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
      </li>
      <li class="<?php if($title == "Account"){ echo 'active'; } ?>">
        <a href="account.php">
          <i class="fa fa-university"></i> <span>Account</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
      </li>
      <li class="<?php if($title == "Deposits"){ echo 'active'; } ?>">
        <a href="deposits.php">
          <i class="fa fa-bitcoin"></i> <span>Deposits</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
      </li>
      <li class="<?php if($title == "Mining"){ echo 'active'; } ?>">
        <a href="mining.php">
          <i class="fa fa-line-chart "></i> <span>Mining</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
      </li>
      <li class="<?php if($title == "Auto Trading"){ echo 'active'; } ?>">
        <a href="trading.php">
          <i class="fa fa-bar-chart"></i> <span>Auto Trading</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
      </li>
      <li class="<?php if($title == "Packages"){ echo 'active'; } ?>">
        <a href="packages.php">
          <i class="fa fa-university"></i> <span>Packages</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
      </li>
      <li class="<?php if($title == "Subscriptions"){ echo 'active'; } ?>">
        <a href="subscriptions.php">
          <i class="fa fa-university"></i> <span>Subscriptions</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
      </li>
      <li class="<?php if($title == "Identity Verification"){ echo 'active'; } ?>">
          <a href="id-verification.php">
            <i class="fa fa-id-card"></i> <span>Identity Verification</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
      </li>
       <li class="<?php if($title == "Message"){ echo 'active'; } ?>">
        <a href="message.php">
          <i class="fa fa-envelope" aria-hidden="true"></i> <span>Message</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
      </li>
      <li class="<?php if($title == "Notification"){ echo 'active'; } ?>">
        <a href="notification.php">
          <i class="fa fa-info-circle" aria-hidden="true"></i> <span>Notification</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
      </li>
      <li class="<?php if($title == "Trade History"){ echo 'active'; } ?>">
        <a href="trade_history.php">
          <i class="fa fa-bar-chart"></i> <span>Trade Session</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
      </li>
      <li class="<?php if($title == "Update Traders"){ echo 'active'; } ?>">
        <a href="traders.php">
          <i class="fa fa-university"></i> <span>Update Traders</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
      </li>
      <li class="<?php if($title == "Update NFTs"){ echo 'active'; } ?>">
          <a href="update_nft.php">
            <i class="fa fa-image"></i> <span>Update NFTs</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
        </li>
      <li class="<?php if($title == "Withdrawals"){ echo 'active'; } ?>">
        <a href="withdrawals.php">
          <i class="icon-wallet"></i> <span>Withdrawals</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
      </li>
      <li class="<?php if($title == "System Settings"){ echo 'active'; } ?>">
        <a href="settings.php">
          <i class="fa fa-cog"></i> <span>System Settings</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
      </li>
      <li class="<?php if($title == "Change Password"){ echo 'active'; } ?>">
        <a href="change_password.php">
          <i class="fa fa-quote-left"></i> <span>Change Password</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
      </li>
      <li>
        <a href="logout.php">
          <i class="icon-logout"></i> <span>Logout</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
      </li>
    </ul>
  </section>
</aside>
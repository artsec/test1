<div id="header">
    <div style="top: 15px; position: absolute; left: 30%;"><? $fb = Session::instance()->get('fb_config'); echo $fb['connection']['dsn'].' '.$fb['connection']['username'].' '.$fb['connection']['password']; ?></div>
	<div id="logo"><img src="images/logo.png" alt="logo"/></div>
	<div id="search">
		<?php 
		echo  __('system.version'). Kohana::config('config_newcrm.version.major').'.'.Kohana::config('config_newcrm.version.minor'); ?>
	</div>

	<div id="search">
		<?php echo HTML::anchor('settings', __('settings')) . ' | ' . HTML::anchor('logout', __('logout')); ?>
	</div>

	<div id="account_info">
		<img src="images/icon_online.png" alt="Online" class="mid_align"/>
		<?php echo __('welcome') . ', <strong><i>' . Session::instance()->get('username') .Session::instance()->get('role'). '</i></strong>'; ?> 
	</div>
	
</div>

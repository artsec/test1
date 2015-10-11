<div id="header">

	<div>
	<? 
		if(Auth::Instance()->logged_in('login')){
		echo HTML::anchor('/default', __('home'), array('class' => 'left_switch active'));
		echo HTML::anchor('default/show_sf', __('sf'), array('class' => 'left_switch active'));
		echo HTML::anchor('default/show_ch', __('schet'), array('class' => 'right_switch active'));
		}
		$a=Session::instance();
		if (Auth::Instance()->logged_in()){
		$b=Auth::Instance()->get_user()->as_array();
		echo __('welcome').' '.$b['username'].' ('.$a->get('username').')!';
		}
		?>
		<div id="auth_block">
		<?
			if(Auth::Instance()->logged_in('login')){
				echo '<div>'.HTML::anchor('logout', __('logout'), array('onclick' => "return confirm('" . __('confirm.delete'))).'</div>';
				} else {
				echo Form::open('default', array('method' => 'post'));
			echo __('name_login').' ';
			echo Form::input('username', '');
			echo __('password').' ';
			echo Form::password('password', '');
			echo Form::submit('auth', __('enter'));
				echo '<div>'.HTML::anchor('admin/auth/forgotten', __('remember')).'</div>';
				}
			echo Form::close();	
			/*
			echo Form::open('logout', array('method' => 'post'));
			echo Form::submit('logout', __('logout'));
			echo Form::close();
			*/
			
		?>
		</div>

		
	</div>
</div>
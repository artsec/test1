<?
echo __('welcome').'<br>';
echo __('dash_mess_1', array('num_ch'=>$data_ch['num'], 'date_ch'=>$data_ch['date_ch'], 'owner'=>$data_ch['owner'])).'<br>';
echo __('dash_mess_2', array('num_sf'=>$data_sf['num_sf'], 'date_sf'=>$data_sf['date_sf'], 'owner'=>$data_sf['owner']));
echo '<br>';
//echo __('debug_info').'<br>';
//echo 'Role is '.(Auth::Instance()->logged_in('admin') ? 'Admin<br>' : 'No Admin<br>');
//echo 'Role is '.(Auth::Instance()->logged_in('login') ? 'Login<br>' : 'No Login<br>');
//echo 'Role is '.(Auth::Instance()->logged_in('user') ? 'user<br>' : 'No user<br>');
//echo 'Role is '.(Auth::Instance()->logged_in('owner') ? 'owner<br>' : 'No owner<br>');
//$session = Session::instance();
//$a=$session->as_array();
//echo KOhana::Debug($a['username']);


//$a=Session::instance();
//echo Kohana::Debug($a);
//echo $a->get('username');

//$b=Auth::Instance()->get_user()->as_array();
//echo Kohana::Debug($b['username']);

//echo Kohana::Debug(Request::current());
//echo Kohana::Debug(Request::current()->controller);

?>
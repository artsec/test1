<div class="onecolumn">
<?
echo Form::open('default/update', array('method' => 'get'));
?>
<table class="data" width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<!--<th><? echo __('order');?></th>-->
		<th><? echo __('num_sf');?></th>
		<th><? echo __('date_sf');?></th>
		<th><? echo __('num_check');?></th>
		<th><? echo __('num_order');?></th>
		<th><? echo __('num_act');?></th>
		<th><? echo __('owner');?></th>
		<th><? echo __('other');?></th>

	</tr>
	<?
	if (isset($datasf)){
		foreach ($datasf as $datasf) {
		echo '<tr>';
			echo '<td>'.Form::input('num',$datasf['num']).'</td>';
			//echo '<td>'.Form::input('num_sf', $datasf['num_sf']).'</td>';
			echo '<td>'.Form::input('date_sf', $datasf['date_sf']).'</td>';
			echo '<td>'.Form::input('num_check', $datasf['num_check']).'</td>';
			echo '<td>'.Form::input('num_order', $datasf['num_order']).'</td>';
			echo '<td>'.Form::input('num_act', $datasf['num_act']).'</td>';
			echo '<td>'.Form::input('owner', $datasf['owner']).'</td>';
			echo '<td>'.Form::input('other', $datasf['other']).'</td>';
		echo '</tr>';
		}
	} else {
	echo '<tr>';
		echo '<td>'. __('order').'</td>';
		echo '<td width="10%">'.Form::input('num_sf', __('num_sf')).'</td>';
		echo '<td width="10%">'.Form::input('date_sf', __('date_sf')).'</td>';
		echo '<td width="10%">'.Form::input('num_check', __('date_check')).'</td>';
		echo '<td width="10%">'.Form::input('num_order', __('date_order')).'</td>';
		echo '<td width="10%">'.Form::input('num_act', __('date_act')).'</td>';
		echo '<td width="10%">'.Form::input('owner', __('owner')).'</td>';
		echo '<td>'.Form::input('other', __('other'), array('size'=>'120', 'maxlength'=>'255')).'</td>';
	echo '</tr>';
	};?>
	
</table>
<?
echo Form::hidden('num',$datasf['num']);
echo Form::submit('update', __('update'));
echo Form::close();
?>
</div>
<div class="onecolumn">
<?
echo Form::open('default/save', array('method' => 'get'));

echo __('max_num_remember', array(':max_num' => $MaxNumSF))
?>
<table class="data" width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<th><? echo __('num_sf');?></th>
		<th><? echo __('date_sf');?></th>
		<th><? echo __('num_check');?></th>
		<th><? echo __('num_order');?></th>
		<th><? echo __('num_act');?></th>
		<th><? echo __('owner');?></th>
		<th><? echo __('other');?></th>
		<th><? echo __('edit');?></th>
	</tr>
	<?
	echo '<tr>';
		echo '<td width="10%">'.Form::input('num_sf', $MaxNumSF+1, array('disabled'=>'disabled')).'</td>';
		echo '<td width="10%">'.Form::input('date_sf', date("j.n.Y")).'</td>';
		echo '<td width="10%">'.Form::input('num_check', date("j.n.Y")).'</td>';
		echo '<td width="10%">'.Form::input('num_order', date("j.n.Y")).'</td>';
		echo '<td width="10%">'.Form::input('num_act', date("j.n.Y")).'</td>';
		echo '<td width="10%">'.Form::input('owner', __('owner')).'</td>';
		echo '<td width="50%">'.Form::input('other', __('other'), array('size'=>'120', 'maxlength'=>'255')).'</td>';
	echo '</tr>';
	?>
	
</table>
<?
echo Form::submit('save', __('save'));
echo Form::close();
?>
</div>
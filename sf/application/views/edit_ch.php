<div class="onecolumn">
<?
echo Form::open('default/savech', array('method' => 'get'));
if ($num==0) echo __('show_MaxNumCheck', array('MaxNumCheck'=>$MaxNumCheck))

?>

<table class="data" width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<!--<th><? echo __('order');?></th>-->
		<th><? echo __('num_ch');?></th>
		<th><? echo __('date_ch');?></th>
		<th><? echo __('sum_ch');?></th>
		<th><? echo __('owner');?></th>
		<th><? echo __('other');?></th>

	</tr>
	<?
	if($num==0) {
		echo '<tr>';
			//echo '<td>'.Form::input('num',$datasf['num']).'</td>';
			echo '<td>'.Form::input('num_ch', $MaxNumCheck+1, array('disabled'=>'disabled')).'</td>';
			echo '<td>'.Form::input('date_ch', date("j.n.Y")).'</td>';
			echo '<td>'.Form::input('sum_ch', 0).'</td>';
			echo '<td>'.Form::input('owner', __('owner')).'</td>';
			echo '<td>'.Form::input('other', __('other')).'</td>';
		echo '</tr>';
	} else {
		foreach ($listch as $a) {
		echo '<tr>';
			//echo '<td>'.Form::input('num',$datasf['num']).'</td>';
			echo '<td>'.Form::input('num_ch', $a['num'], array('disabled'=>'disabled')).'</td>';
			echo '<td>'.Form::input('date_ch', $a['date_ch']).'</td>';
			echo '<td>'.Form::input('sum_ch', $a['sum_ch']).'</td>';
			echo '<td>'.Form::input('owner', $a['owner']).'</td>';
			echo '<td>'.Form::input('other', $a['other']).'</td>';
		echo '</tr>';
		}
	}
;?>
</table>
<?
echo Form::hidden('num',$num);
	if($num==0) {
		echo Form::submit('addch', __('addch'));
	} else {
		echo Form::submit('updatech', __('updatech'));
	}
echo Form::close();
?>
</div>
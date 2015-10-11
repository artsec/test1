<div class="onecolumn">

<div class="header">
		<span><?php echo  __('title_list_ch') ; ?></span>
</div>
<div class="content">
<?		
echo __('title_list_ch');
	echo Form::open('default/editch', array('method' => 'get'));
if (!empty($listch)){
?>
	<table class="data" width="100%" cellpadding="0" cellspacing="0">
		<tr>
			<!--<th><? echo __('order');?></th>-->
			<th><? echo __('num_ch');?></th>
			<th><? echo __('date_ch');?></th>
			<th><? echo __('sum_ch');?></th>
			<th><? echo __('owner');?></th>
			<th><? echo __('other');?></th>
			<th><? echo __('edit');?></th>
			
		</tr>
		<? 
		foreach ($listch as $b) {
					echo '<tr>';
					echo '<td>'.$b['num'].'</td>';
					//echo '<td>'.$b['num_ch'].'</td>';
					echo '<td>'.$b['date_ch'].'</td>';
					echo '<td>'.$b['sum_ch'].'</td>';
					echo '<td>'.$b['owner'].'</td>';
					echo '<td>'.$b['other'].' (выдан счет № '.$b['num_ch'].')</td>';
					echo '<td>'.//Form::submit('num', $b['num'], array('id'=>'edit'));
					HTML::anchor('default/editch?num='.$b['num'], HTML::image('images/document_edit.png', array('alt' => 'Edit'))).'</td>';
				//Form::submit('num', $b['num'], array('id'=>'edit')).
				echo '</tr>';
			}
			?>
	</table>
	<?
	
	} else {
	echo __('no_date');
	}
		echo Form::close();	

	echo Form::open('default/editch?num=0', array('method' => 'get'));
	echo Form::submit('add', __('add'));
	echo Form::hidden('num', 0);
	
	echo Form::close();	
?>
</div>
</div>

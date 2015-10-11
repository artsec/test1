<div class="onecolumn">

<div class="header">
		<span><?php echo  __('title_list') ; ?></span>
</div>
<div class="content">
<?		
echo __('title_list');
echo Form::open('default/edit', array('method' => 'get'));?>
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
		<th><? echo __('edit');?></th>
		
	</tr>
	<? 
	foreach ($listsf as $b) {
				echo '<tr>';
				echo '<td>'.$b['num'].'</td>';
				//echo '<td>'.$b['num_sf'].'</td>';
				echo '<td>'.$b['date_sf'].'</td>';
				echo '<td>'.$b['num_check'].'</td>';
				echo '<td>'.$b['num_order'].'</td>';
				echo '<td>'.$b['num_act'].'</td>';
				echo '<td>'.$b['owner'].'</td>';
				echo '<td>'.$b['other'].'</td>';
				echo '<td>'.HTML::anchor('default/edit?num='.$b['num'], HTML::image('images/document_edit.png', array('alt' => 'Edit'))).'</td>';
				echo '</tr>';
		}
		?>
</table>
<?
	echo Form::close();	
if(Auth::Instance()->logged_in('login')){
echo Form::open('default/addsf', array('method' => 'get'));
echo Form::submit('add', __('add'), array('onclick'=>'return confirm("are u shure") ? true : false;'));
echo Form::close();
}
?>
</div>
</div>

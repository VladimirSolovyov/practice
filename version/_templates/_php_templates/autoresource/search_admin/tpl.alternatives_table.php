<h1><?=$AR_MSG['SearchModule']['msg1']?></h1>
	
	<? if ($SearchSetting['search_from_catalog']) { ?>
	<li><p><a href="<?=$SearchSetting['catalog_search_url']?>"><?=$AR_MSG['SearchModule']['msg2']?></a></p>
	<? } ?>

<table border="0" class="web_ar_datagrid">

<tr>

<? foreach ($alternatives['header'] as $hdr_id=>$column) { ?>

	<? if ($column['visible']==true) { ?>

	<th><?=$column['caption']?></th>

	<? } ?>

<? } ?>
</tr>

<? foreach ($alternatives['data'] as $dat_id=>$row) { ?>

<tr class="<?=($dat_id % 2 == 0?'even':'odd')?>">
	<? foreach ($alternatives['header'] as $hdr_id=>$column) { ?>
	
		<?
			switch ($hdr_id) {
				
				case 'brand':
				case 'action_alt': {
					$align = 'center';
				} break;
				default: {
					$align = 'left';
				} break;
				
			}
		?>
		
		<? if ($column['visible'] == true) { ?>
		<td align="<?=$align?>">
		<?=$row[$hdr_id]?>
		
		<? if ($hdr_id=='spare') { ?>
		
			<? if ($row['superseded_by']!='') { ?>
			<?=$row['code']?> - <?=$AR_MSG['SearchModule']['msg7']?><?=$row['superseded_by']?>
			<? } ?>
			
			<? if ($row['replacement_for']!='') { ?>
			<?=$row['code']?> - <?=$AR_MSG['SearchModule']['msg8']?><?=$row['replacement_for']?>
			<? } ?>

		<? } ?>
			
		</td>
		<? } ?>

	<? } ?>
</tr>

<? } ?>

</table>
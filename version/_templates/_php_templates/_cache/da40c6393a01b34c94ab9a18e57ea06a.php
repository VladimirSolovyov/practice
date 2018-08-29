<h1><?=$MSG['VinListModule']['msg8']?></h1>

<? if ((is_array($vin_requests)) && ($vin_requests['messages'])) { ?>

	<? $process_messages = &$vin_requests; ?>
	<?  ?><? if (count($process_messages['messages']) > 0) {
	
	foreach($process_messages['messages'] as $message) { ?>

		<?=$message?>
		
	<? }

} ?><?  ?>

<? } elseif ($vin_requests['name'] == 'vin_requests') { ?>
	
	<?  ?><div id="car_info" class="car-info">	<?	$emptyCarInfo = true;	foreach ($car_info as $key => $value) {		if ($value['value']) {			$emptyCarInfo = false;			break;		}	}	?>	<h4 class="car-info__section-header"><?=($emptyCarInfo ? tr('Данные автомобиля не заполнены', 'VinRequestModule') : $MSG['VinRequestModule']['msg76'])?></h4>	<div class="row">		<div class="col-xs-12 col-sm-8">			<div class="car-info__prop-items">				<?  ?><?$arShowKeys = [	'csc_vin_code',	'csc_brand',	'csc_model',	'csc_year',	'modify',];$show_data = [];$hidden_data = [];foreach ($car_info as $key => $value) {	if (!$value['value']) {		continue;	}	if (in_array($key, $arShowKeys)) {		$show_data[] = $value;	} else {		$hidden_data[] = $value;	}}if (count($hidden_data) < 3 or empty($show_data)) {	$show_data = array_merge($show_data, $hidden_data);	$hidden_data = [];}$__BUFFER->addScript('/_syslib/modules/module.CollapseTable.js');$__BUFFER->AddJsInit("(function(){	let t = document.querySelector('.table-collapsed'),		b = document.querySelector('.car-info__collapse-btn');	if(t && b){	  let collapse = new CollapsedTable({		table: t,		hiddenRowSelector: '.table-collapsed__hide-row',		control: b,		collapsed: true	  });	  collapse.__proto__.controlAction = function(e) {		this.toggle();		if(this.collapsed) {			this.control.classList.remove('car-info__collapse-btn--collapsed');		} else {			this.control.classList.add('car-info__collapse-btn--collapsed');		}	  };	}})();");?>			<table class="z-table table-collapsed">				<tbody>				<?				foreach ($show_data as $value) {					?>					<tr>						<td><?= $value['title'] ?></td>						<td><?= $value['value'] ?></td>					</tr>				<?				}				foreach ($hidden_data as $value) {					?>					<tr class="table-collapsed__hide-row">						<td><?= $value['title'] ?></td>						<td><?= $value['value'] ?></td>					</tr>				<?				}				?>			</table>		<? if (count($hidden_data)) { ?>		<button class="car-info__collapse-btn">			<?= tr('Все характеристики', 'Cars') ?>		</button>		<? } ?><?  ?>			</div>		</div>	</div></div><div id="vin_content" class="car-info"><h4 class="car-info__section-header"><?=$MSG['VinRequestModule']['msg41']?></h4>	<? if (count($vin_content) > 0) { ?>		<?  ?><?
$columns = [
	'dcc_name',
	'dcc_article',
	'dcc_brand',
	'dcc_price',
	'dcc_amount',
	'dcc_term',
	'dcc_comment'
]
?>
<table class="web-table-simple">
	<tr>
		<?
		foreach($columns as $column){
			?>
			<th>
				<?= $vin_requests['fields'][$column . '[]']['caption'] ?>
			</th>
			<?
		}
		?>
	</tr>

	<? foreach ($vin_content as $dcc) { ?>

		<tr>
			<?
				foreach($columns as $column){
					?><td><?
					switch($column){
						case 'dcc_article':
							?><a href="/search.html?article=<?= $dcc[$column] ?>&sort___search_results_by=final_price&term=0&smode=A"><?= $dcc[$column] ?></a><?
							break;
						default:
							echo $dcc[$column];
							break;
					}
					?></td><?
				}
			?>
		</tr>

	<? } ?>

</table><?  ?>	<? } ?></div><div class="car-info">	<div class="row">		<div class="col-xs-12 col-sm-8">				<h4 class="car-info__section-header"><?=tr('Контактные данные','VinRequestModule')?></h4>				<table class="z-table">					<tr>						<td><?=$vin_requests['fields']['contact']['caption']?></td>						<td><?=$vin_requests['sourceFields']['contact']['instance']->value?></td>					</tr>					<tr>						<td><?=$vin_requests['fields']['phone']['caption']?></td>						<td><?=$vin_requests['sourceFields']['phone']['instance']->value?></td>					</tr>					<tr>						<td><?=$vin_requests['fields']['email']['caption']?></td>						<td><?=$vin_requests['sourceFields']['email']['instance']->value?></td>					</tr>				</table>		</div>	</div></div><?  ?>
	
<? } else { ?>

	<? $web_ar_datagrid = &$vin_requests; ?>
	<? $empty_message = $MSG['VinListModule']['msg12']?>
	<?  ?><div class="web-table__wrapper web-table__wrapper_<?=$web_ar_datagrid['info']['name']?>">

<div class="flc">
<? if (count($web_ar_datagrid['controls'])>0) { ?>
	<? $i=0; ?>
	<? foreach ($web_ar_datagrid['controls'] as $hdr_id=>$control) { ?>

		<? if ((empty($control_align[$i])) or ($control_align[$i] == 'top')) { ?>

		<div class="web-table__paginator web-table__paginator_<?=$web_ar_datagrid['info']['name']?> flc"><?=$control?></div>
		
		<? } ?>
		
		<? $i++; ?>

	<? } ?>
<? } ?>
</div>

<? if ((count($web_ar_datagrid['data']) > 0) or (empty($empty_message))) { ?>
	
	
	<? if (!empty($PHP_TEMPLATE['captionFilter_'.$web_ar_datagrid['info']['name']])) { ?>

		<? $captionFilter = &$PHP_TEMPLATE['captionFilter_'.$web_ar_datagrid['info']['name']]; ?>
		
		<?=$captionFilter['validationScript']?>
		<form id="<?=$captionFilter['id']?>" name="<?=$captionFilter['name']?>" action="<?=$captionFilter['action']?>" method="<?=$captionFilter['method']?>" onsubmit="<?=$captionFilter['onsubmit']?>">
		
		<? if (!$captionFilter['object']->settings['submitInTable']) { ?>
		
			<div class="table_filter_control flc">
				<div class="rightside">
					<?=$captionFilter['fields']['filterSubmit_'.$web_ar_datagrid['info']['name']]['html']?>
				</div>
			</div>
		
		<? } else { ?>
		
			<? foreach ($web_ar_datagrid['header'] as $hdr_id=>$column) {	?>
				
				<? if ($column['visible'] != '1') continue; ?>
				<? $last_hdr_id = $hdr_id; ?>
					
			<? } ?>
		
		<? } ?>
		
	<? } ?>

	<div class="web_ar_datagrid web-table">
		<div class="web-table-header">
		<? $col_num = 0; $total_begin = 0; ?>
		<? foreach ($web_ar_datagrid['header'] as $hdr_id=>$column) {	?>
			
			<? if ($column['visible'] != '1') continue; ?>
			
			<div class="web-table-header__col web-table__<?= $hdr_id ?>">
				
				
				<? if (!empty($column['clm_info'])) { ?>
					<span class="tipz" title="<?=$column['clm_info']?>"></span>
				<? } ?>
				
				<?=$column['caption']?>

			</div>
			
			<? if ((empty($web_ar_datagrid['total'][$hdr_id])) && ($total_begin == $col_num)) { ?>
				<? $total_begin++; ?>
			<? } ?>
			
			<? $col_num++; ?>
		<? } ?>
		</div>
		
		
		<? if ($captionFilter) { ?>
				
			<div class="web-table-filter">
				<? foreach ($web_ar_datagrid['header'] as $hdr_id=>$column) {	?>
					
					<? if ($column['visible'] != '1') continue; ?>
					
					<div class="web-table__col web-table__col_<?= $hdr_id ?>">
						
						<? if (!empty($captionFilter['fields'][$hdr_id])) { ?>
							<div class="caption_filter">
								<?=$captionFilter['fields'][$hdr_id]['html']?>
							</div>
						<? } ?>
						
						
						<? if (($captionFilter) && ($captionFilter['object']->settings['submitInTable']) && ($hdr_id == $last_hdr_id)) { ?>
							<div class="caption_filter">
									<?=$captionFilter['fields']['filterSubmit_'.$web_ar_datagrid['info']['name']]['html']?>
							</div>
						<? } ?>
					</div>

				<? } ?>
			</div>
				
		<? } ?>

			<? foreach ($web_ar_datagrid['data'] as $row=>$item) { ?>
				
				<div class="web-table__row">
					
					<? $i=0; ?>
					<? foreach ($web_ar_datagrid['header'] as $hdr_id=>$column) {	?>
					
						<? if ($column['visible'] != '1') continue; ?>
						
						<div class="web-table__col web-table__col_<?= $hdr_id ?>"<?=(!empty($data_align[$i])?' align="'.$data_align[$i].'"':'')?>><?=$item[$hdr_id]?></div>
						
						<? $i++; ?>
						
					<? } ?>
					
				</div>
				
			<? } ?>
		
		
		<? if (count($web_ar_datagrid['total']) > 0) { ?>
			<div class="web-table__row web-table__row--total">
				<? if ($total_begin > 0) { ?>
					<div class="web-table__col"></div>
					<div class="web-table__col"></div>
					<div class="web-table__col web-table__col_total"><?=$MSG['Common']['msg5']?></div>
				<? } ?>
				<? foreach ($web_ar_datagrid['header'] as $hdr_id=>$column) {	?>
				
					<? if (($column['visible'] != '1') or ((++$total_counter <= $total_begin) && ($total_begin != 0))) continue; ?>
					
					<div class="web-table__col web-table__col_total_summ"><?=$web_ar_datagrid['total'][$hdr_id]?></div>
					
				<? } ?>
			</div>
		<? } ?>
	</div>

	<? if (empty($web_ar_datagrid['data'])) { ?>
		<div class="brief-table__empty-message"><?= $MSG['Common']['msg4'] ?></div>
	<? } ?>

	<? if (!empty($PHP_TEMPLATE['captionFilter_'.$web_ar_datagrid['info']['name']])) { ?>

	</form>

	<? } ?>

<? } else { ?>

	<div class="message message_type_info">
		<div class="message__text">
			<?=$empty_message?>
		</div>
	</div>

<? } ?>


<? if (count($web_ar_datagrid['controls'])>0) { ?>
	<? $i=0; ?>
	<? foreach ($web_ar_datagrid['controls'] as $hdr_id=>$control) { ?>

		<? if ($control_align[$i] == 'bottom') { ?>

		<div class="table_control"><?=$control?></div>
		
		<? } ?>
		
		<? $i++; ?>

	<? } ?>
<? } ?>
</div><?  ?>
	
<? } ?>
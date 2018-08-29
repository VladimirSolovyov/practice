<h1><?=$MSG['CarsModule']['msg1']?></h1>

<? if ((is_array($customer_cars)) && ($customer_cars['messages'])) { ?>

	<? if ($customer_cars['messages']['edit_success']) { ?>

		<div class="message message_type_success">
			<div class="message__text">
				<?=$MSG['CarsModule']['msg7']?>
			</div>
		</div>
		
	<? } elseif ($customer_cars['messages']['delete_success']) { ?>

		<div class="message message_type_success">
			<div class="message__text">
				<?=$MSG['CarsModule']['msg8']?>
			</div>
		</div>
		
	<? } else { ?>

		<? $process_messages = &$customer_cars; ?>
		<?  ?><? if (count($process_messages['messages']) > 0) {
	
	foreach($process_messages['messages'] as $message) { ?>

		<?=$message?>
		
	<? }

} ?><?  ?>
	
	<? } ?>

<? } elseif ($customer_cars['name'] == 'customer_cars') { ?>

	<?  ?><?= $customer_cars['validationScript'] ?><div class="row">	<div class="col-xs-12 col-md-10 col-lg-8">		<form id="<?= $customer_cars['id'] ?>" name="<?= $customer_cars['name'] ?>" action="<?= $customer_cars['action'] ?>" method="<?= $customer_cars['method'] ?>" onsubmit="<?= $customer_cars['onsubmit'] ?>">			<?= $customer_cars['fields']['_prid']['html'] ?>			<?= $customer_cars['fields']['subj']['html'] ?>			<?= $customer_cars['fields']['__csc_id__']['html'] ?>			<?= $customer_cars['fields']['csc_cst_id']['html'] ?>			<?			$car_form = &$customer_cars;			 ?><div class="universal-form__subgroup">	<div class="universal-form__group-title"><?= tr("Основные сведения", "VinRequestModule") ?></div>	<?	$carTplForm = &$car_form;	$carTplFields = [		'vin',		['crb_id', 'crm_id'],		['car_year', 'crmf_id']	];	 ?><?
if (isset($carTplFields) && isset($carTplForm)) {
	foreach ($carTplFields as $configField) {
		if (is_array($configField)) { ?>

			<div class="row cars-form__row">
				<div class="col-xs-12 col-sm-6 form-gr form-gr--column">
					<label class="form-gr__label" for="<?= $configField[0] ?>"><?= $carTplForm['fields'][$configField[0]]['caption'] ?></label>

					<div class="form-gr__control">
						<?= $carTplForm['fields'][$configField[0]]['html'] ?>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 form-gr form-gr--column">
					<label class="form-gr__label" for="<?= $configField[1] ?>"><?= $carTplForm['fields'][$configField[1]]['caption'] ?></label>

					<div class="form-gr__control">
						<?= $carTplForm['fields'][$configField[1]]['html'] ?>
					</div>
				</div>
			</div>

		<? } else if ($carTplForm['fields'][$configField]) { ?>

			<div class="row cars-form__row">
				<div class="col-xs-12 form-gr form-gr--column">
					<label class="form-gr__label" for="<?= $configField ?>"><?= $carTplForm['fields'][$configField]['caption'] ?></label>

					<div class="form-gr__control">
						<?= $carTplForm['fields'][$configField]['html'] ?>
					</div>
				</div>
			</div>

		<? }
	}
}
?><? 	?></div><div class="universal-form__subgroup">	<button id="cars-details-form-button" type="button" class="universal-form__group-title universal-form__group-title--expanded" area-controls="cars-details-form"><?= tr("Подробные сведения", "VinRequestModule") ?></button>	<div id="cars-details-form" class="area-collapsed-mod area-collapsed-mod--collapsed">		<div class="row cars-form__row">			<? if ($car_form['fields']['steering']) { ?>				<div class="col-xs-12 col-sm-6 form-gr form-gr--column">					<label class="form-gr__label" for="steering"><?= $car_form['fields']['steering']['caption'] ?></label>					<div class="form-gr__control cars-form__in-control">						<?= $car_form['fields']['steering']['html'] ?>					</div>				</div>			<? } ?>			<div class="col-xs-12 col-sm-6 form-gr form-gr--column">				<label class="form-gr__label"><?= $MSG['Cars']['msg56'] ?></label>				<div class="form-gr__control cars-form__in-control">					<?= $car_form['fields']['abs']['html'] ?>					<?= $car_form['fields']['esp']['html'] ?>					<?= $car_form['fields']['booster']['html'] ?>					<?= $car_form['fields']['conditioner']['html'] ?>					<?= $car_form['fields']['catalyst']['html'] ?>				</div>			</div>		</div>		<?		$carTplFields = [			['transmission', 'power'],			['drive', 'valves'],			['bdy_type_id', 'volume'],			'info'		];		 ?><?
if (isset($carTplFields) && isset($carTplForm)) {
	foreach ($carTplFields as $configField) {
		if (is_array($configField)) { ?>

			<div class="row cars-form__row">
				<div class="col-xs-12 col-sm-6 form-gr form-gr--column">
					<label class="form-gr__label" for="<?= $configField[0] ?>"><?= $carTplForm['fields'][$configField[0]]['caption'] ?></label>

					<div class="form-gr__control">
						<?= $carTplForm['fields'][$configField[0]]['html'] ?>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 form-gr form-gr--column">
					<label class="form-gr__label" for="<?= $configField[1] ?>"><?= $carTplForm['fields'][$configField[1]]['caption'] ?></label>

					<div class="form-gr__control">
						<?= $carTplForm['fields'][$configField[1]]['html'] ?>
					</div>
				</div>
			</div>

		<? } else if ($carTplForm['fields'][$configField]) { ?>

			<div class="row cars-form__row">
				<div class="col-xs-12 form-gr form-gr--column">
					<label class="form-gr__label" for="<?= $configField ?>"><?= $carTplForm['fields'][$configField]['caption'] ?></label>

					<div class="form-gr__control">
						<?= $carTplForm['fields'][$configField]['html'] ?>
					</div>
				</div>
			</div>

		<? }
	}
}
?><? 		?>	</div></div><?$__BUFFER->addScript('/_syslib/modules/module.AreaCollapsedMod.js');$__BUFFER->AddJsInit(";(function(){	if(typeof AreaCollapsedMod !== 'undefined') {		var btn = document.getElementById('cars-details-form-button'),			area = document.getElementById('cars-details-form');		var det = new AreaCollapsedMod({			control: btn,			area: area,			areaCollapsedClass: 'area-collapsed-mod--collapsed',			collapsed: true		});	}})();");?><? 			?>			<?= $customer_cars['fields']['car_send']['html'] ?>		</form>	</div></div><?  ?>
	
<? } else { ?>

	<? $web_ar_datagrid = &$customer_cars; ?>
	<? $empty_message = $MSG['CarsModule']['msg2']?>
	<? $data_align = array('left','left','left','left'); ?>
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
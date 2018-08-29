<h1><?=$MSG['AddressList']['msg22']?></h1>

<? if ((is_array($customer_address)) && ($customer_address['messages'])) { ?>

	<? if ($customer_address['messages']['edit_success']) { ?>

		<div class="message message_type_success">
			<div class="message__text">
				<?=$MSG['AddressList']['msg24']?>
			</div>
		</div>
		
	<? } elseif ($customer_address['messages']['delete_success']) { ?>

		<div class="message message_type_success">
			<div class="message__text">
				<?=$MSG['AddressList']['msg25']?>
			</div>
		</div>
		
	<? } else { ?>

		<? $process_messages = &$customer_address; ?>
		<?  ?><? if (count($process_messages['messages']) > 0) {
	
	foreach($process_messages['messages'] as $message) { ?>

		<?=$message?>
		
	<? }

} ?><?  ?>
	
	<? } ?>

<? } elseif ($customer_address['name'] == 'customer_address') {

	 ?><div class="row">	<div class="col-xs-12 col-sm-10 col-md-8">		<?= $customer_address['validationScript'] ?>		<form id="<?= $customer_address['id'] ?>" name="<?= $customer_address['name'] ?>" action="<?= $customer_address['action'] ?>" method="<?= $customer_address['method'] ?>" onsubmit="<?= $customer_address['onsubmit'] ?>">			<?= $customer_address['fields']['_prid']['html'] ?>			<?= $customer_address['fields']['subj']['html'] ?>			<?= $customer_address['fields']['__add_id__']['html'] ?>			<?= $customer_address['fields']['add_cst_id']['html'] ?>			<div class="universal-form__subgroup">				<? $address_form = &$customer_address; ?>				<?  ?><?
if (ADMIN_PAGE) {
	include __spellPATH('PHP_TEMPLATES_LIB:/common_templates/tpl.address_form.php');
} else { ?>
	<? if ($address_form['fields'][$adr_prefix . 'add_recipient_name']) { ?>
		<div id="tr_add_recipient_name" class="form-gr form-gr_horizontal_center universal-form__row">
				<label for="add_recipient_name" class="form-gr__label">
					<?= $address_form['fields'][$adr_prefix . 'add_recipient_name']['caption'] ?>
				</label>
			<div class="form-gr__control">
				<?= $address_form['fields'][$adr_prefix . 'add_recipient_name']['html'] ?>
			</div>
		</div>
	<? } ?>

	<? if ($address_form['fields'][$adr_prefix . 'add_country_id']) { ?>
		<div id="tr_add_country_id" class="form-gr form-gr_horizontal_center universal-form__row">
				<label for="add_country_id" class="form-gr__label">
					<?= $address_form['fields'][$adr_prefix . 'add_country_id']['caption'] ?>
				</label>
			<div class="form-gr__control">
				<?= $address_form['fields'][$adr_prefix . 'add_country_id']['html'] ?>
			</div>
		</div>
	<? } ?>

	<? if ($address_form['fields'][$adr_prefix . 'add_region_id']) { ?>
		<div id="tr_add_region_id" class="form-gr form-gr_horizontal_center universal-form__row">

				<label for="add_region_id" class="form-gr__label">
					<?= $address_form['fields'][$adr_prefix . 'add_region_id']['caption'] ?>
				</label>
			<div class="form-gr__control">
				<div id="combo_<?= $adr_prefix ?>add_region_id"><?= $address_form['fields'][$adr_prefix . 'add_region_id']['html'] ?></div>
			</div>
		</div>
	<? } ?>

	<? if ($address_form['fields'][$adr_prefix . 'add_city_id']) { ?>
		<div id="tr_add_city_id" class="form-gr form-gr_horizontal_center universal-form__row">

				<label for="add_city_id" class="form-gr__label">
					<?= $address_form['fields'][$adr_prefix . 'add_city_id']['caption'] ?>
				</label>
			<div class="form-gr__control">
				<div id="combo_<?= $adr_prefix ?>add_city_id"><?= $address_form['fields'][$adr_prefix . 'add_city_id']['html'] ?></div>
			</div>
		</div>
	<? } ?>

	<? if ($address_form['fields'][$adr_prefix . 'add_district_id']) { ?>
		<div id="tr_add_district_id" class="form-gr form-gr_horizontal_center universal-form__row">
				<label for="add_district_id" class="form-gr__label">
					<?= $address_form['fields'][$adr_prefix . 'add_district_id']['caption'] ?>
				</label>
			<div class="form-gr__control">
				<div id="combo_<?= $adr_prefix ?>add_district_id"><?= $address_form['fields'][$adr_prefix . 'add_district_id']['html'] ?></div>
			</div>
		</div>
	<? } ?>

	<? if ($address_form['fields'][$adr_prefix . 'add_address']) { ?>
		<div id="tr_add_address" class="form-gr form-gr_horizontal_center universal-form__row">
				<label for="add_address" class="form-gr__label">
					<?= $address_form['fields'][$adr_prefix . 'add_address']['caption'] ?>
				</label>
			<div class="form-gr__control"><?= $address_form['fields'][$adr_prefix . 'add_address']['html'] ?></div>
		</div>
	<? } ?>

	<? if ($address_form['fields'][$adr_prefix . 'add_postal_index']) { ?>
		<div id="tr_add_postal_index" class="form-gr form-gr_horizontal_center universal-form__row">

				<label for="add_postal_index" class="form-gr__label">
					<?= $address_form['fields'][$adr_prefix . 'add_postal_index']['caption'] ?>
				</label>
			<div class="form-gr__control"><?= $address_form['fields'][$adr_prefix . 'add_postal_index']['html'] ?></div>
		</div>
	<? } ?>

	<? if ($address_form['fields']['add_info']) { ?>
		<div id="tr_add_info" class="form-gr form-gr_horizontal_center universal-form__row">
				<label for="add_info" class="form-gr__label">
					<?= $address_form['fields'][$adr_prefix . 'add_info']['caption'] ?>
				</label>
			<div class="form-gr__control"><?= $address_form['fields'][$adr_prefix . 'add_info']['html'] ?></div>
		</div>
	<? } ?>
<? } ?><?  ?>				<div class="form-gr form-gr--secondw form-gr_horizontal_center">					<div class="form-gr__label"></div>					<div class="form-gr__control"><?=$customer_address['fields']['send']['html']?></div>				</div>			</div>			<?				$__BUFFER->addJsInit("					jqWar('.form-gr').addClass('form-gr--secondw');				");			?>		</form>	</div></div><? 

} else {

	if (is_array($customer_address)) {
		$web_ar_datagrid = &$customer_address;
		$empty_message = $MSG['AddressList']['msg23'];
		$data_align = array('left', 'left', 'left', 'left', 'left');
		 ?><div class="web-table__wrapper web-table__wrapper_<?=$web_ar_datagrid['info']['name']?>">

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
</div><? 
	} else {
		echo $customer_address;
	}
} ?>
<h1><?=$MSG['VinRequestModule']['msg70']?></h1>

<? if ($vin_requests['messages']['vin_success']) { ?>

	<div class="message message_type_success message_view_outline">
		<div class="message__text">
			<?=$vin_requests['messages']['vin_success']?>
		</div>
	</div>

<? } else { ?>
	
	<?  ?><div class="row">	<div class="col-xs-12 col-md-10 col-lg-8">		<?= $vin_requests['validationScript'] ?>		<form id="<?= $vin_requests['id'] ?>" name="<?= $vin_requests['name'] ?>" action="<?= $vin_requests['action'] ?>" method="<?= $vin_requests['method'] ?>" onsubmit="<?= $vin_requests['onsubmit'] ?>">			<?= $vin_requests['fields']['__cst_id__']['html'] ?>			<div>				<? if ($vin_requests['messages']['registration_error_fields']) { ?>					<?  ?><div class="message message_type_error message_view_outline">
	<div class="message__title"><?=$MSG['RegistrationModule']['msg63']?></div>
	<div class="message__text">
		<?=$MSG['RegistrationModule']['msg66']?>
		<?
		$group = 'vin_request';
		$registration = &$vin_requests;
		 ?><? $errors = Loader::getApi('registration')->getPossibleErrors($group); ?>
<? foreach ($errors as $key => $error) { ?>
	<? if ($registration['messages'][$key]) { ?>
		<?= $error['text'] ?>
	<? } ?>
<? } ?><? 
		?>
	</div>
</div><?  ?>				<? } ?>				<? if ($vin_requests['messages']['content_error']) { ?>					<div class="message message_type_error message_view_outline">						<div class="message__title"><?= $MSG['VinRequestModule']['msg73'] ?></div>						<div class="message__text">							<?= $MSG['VinRequestModule']['msg75'] ?>						</div>					</div>				<? } ?>			</div>			<div class="vin_car_select vin_form">				<? $car_form = &$vin_requests; ?>				<?  ?><? if ($car_form['fields']['select_csc_id']) { ?>		<div class="universal-form__subgroup">			<div class="cars-form__row">				<div class="form-gr form-gr_horizontal_center">					<label class="form-gr__label" for="csc_id"><?= $car_form['fields']['select_csc_id']['caption'] ?></label>					<div class="form-gr__control">						<?= $car_form['fields']['select_csc_id']['html'] ?>					</div>				</div>			</div>		</div><? } ?>	<div id="form_add">		<?		 ?><div class="universal-form__subgroup">	<div class="universal-form__group-title"><?= tr("Основные сведения", "VinRequestModule") ?></div>	<?	$carTplForm = &$car_form;	$carTplFields = [		'vin',		['crb_id', 'crm_id'],		['car_year', 'crmf_id']	];	 ?><?
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
?><? 		?>	</div></div><?$__BUFFER->addScript('/_syslib/modules/module.AreaCollapsedMod.js');$__BUFFER->AddJsInit(";(function(){	if(typeof AreaCollapsedMod !== 'undefined') {		var btn = document.getElementById('cars-details-form-button'),			area = document.getElementById('cars-details-form');		var det = new AreaCollapsedMod({			control: btn,			area: area,			areaCollapsedClass: 'area-collapsed-mod--collapsed',			collapsed: true		});	}})();");?><? 		?>	</div><?  ?>			</div>			<div class="universal-form__subgroup">				<div class="universal-form__group-title"><?=$MSG['VinRequestModule']['msg41']?></div>				<?  ?><div id="vin_content">
	<div class="vin-form__parts-form-text">
		<?= $MSG['VinRequestModule']['msg79'] ?>
	</div>
	<div class="parts-tform">
		<table border="0" id="partsTable" width="100%">
			<tbody class="parts-tform__table">
			<tr>
				<th class="parts-tform__th parts-tform__th_col_name">
					<?= $vin_requests['fields']['dcc_name[]']['caption'] ?>
				</th>
				<th class="parts-tform__th parts-tform__th_col_article">
					<?= $vin_requests['fields']['dcc_article[]']['caption'] ?>
				</th>
				<th class="parts-tform__th parts-tform__th_col_amount">
					<?= $vin_requests['fields']['dcc_amount[]']['caption'] ?>
				</th>
				<th class="parts-tform__th parts-tform__th_col_caption">
					<?= $vin_requests['fields']['dcc_comment[]']['caption'] ?>
				</th>
				<th class="parts-tform__th parts-tform__th_col_control">
				</th>
			</tr>
			<tr class="parts-tform__tr-data">
				<td class="parts-tform__td parts-tform__td_col_name">
					<?= $vin_requests['fields']['dcc_name[]']['html'] ?>
				</td>
				<td class="parts-tform__td parts-tform__td_col_article">
					<?= $vin_requests['fields']['dcc_article[]']['html'] ?>
				</td>
				<td class="parts-tform__td parts-tform__td_col_amount">
					<?= $vin_requests['fields']['dcc_amount[]']['html'] ?>
				</td>
				<td class="parts-tform__td parts-tform__td_col_comment">
					<?= $vin_requests['fields']['dcc_comment[]']['html'] ?>
				</td>
				<td class="parts-tform__td parts-tform__td_col_control">
					<button type="button" class="parts-tform__del-button"></button>
				</td>
			</tr>
			</tbody>
			<tbody>
			<tr>
				<td colspan="5">
					<button type="button" class="parts-tform__add-button">
						<span class="parts-tform__add-icon"></span><?= $MSG['VinRequestModule']['msg80'] ?>
					</button>
				</td>
			</tr>
			</tbody>
		</table>

	</div>

	<?
	$__BUFFER->AddJsInit("

	;(function(){

		var PartsTableForm = function (prop) {

			this.table = prop.table;
			this.tableRow = prop.tableRow.cloneNode(true);
			this.addButton = prop.addButton;
			this.removeRowSelector = prop.removeRowSelector;
			
			var deleteBtn = prop.tableRow.querySelector('.parts-tform__del-button');
			if(deleteBtn){
				deleteBtn.classList.add('hidden');
			}
			
			this.init();
			this.initRemoveRowEvent(prop.tableRow);

		};

		PartsTableForm.prototype.init = function () {

			var self = this;
			if (this.addButton) {
				this.addButton.addEventListener('click', function () {
					self.addRow();
				});
			}

		};

		PartsTableForm.prototype.addRow = function () {

			var clone = this.tableRow.cloneNode(true);
			this.table.appendChild(clone);
			this.initRemoveRowEvent(clone);

		};

		PartsTableForm.prototype.initRemoveRowEvent = function (row) {

			var removeRowButton = row.querySelector(this.removeRowSelector);
			if (removeRowButton) {
				var self = this;
				removeRowButton.addEventListener('click', function () {
					self.removeRow(row);
				});
			}

		};

		PartsTableForm.prototype.removeRow = function (row) {

			this.table.removeChild(row);

		};


		var defRow = document.querySelector('.parts-tform .parts-tform__tr-data'),
			addButton = document.querySelector('.parts-tform .parts-tform__add-button'),
			table = document.querySelector('.parts-tform .parts-tform__table');

		var parts = new PartsTableForm({
			tableRow: defRow,
			addButton: addButton,
			table: table,
			removeRowSelector: '.parts-tform__del-button'
		});

	})();

	");
	?>
</div><?  ?>			</div>			<?			global $client;			?>			<? if ($client->isGuest) { ?>				<div id="registration_div" class="universal-form__subgroup">						<? $registration = &$vin_requests; ?>						<?  ?><? if ($registration['fields']['is_organization']['html']) { ?>
	<div class="form-gr form-gr_horizontal_center registration__is-organization">
		<div class="form-gr__subtitle">
			<?= tr('Регистрируюсь как', 'RegistrationModule'); ?>
		</div>
		<div class="form-radio-buttons form-gr__control">
			<?= $registration['fields']['is_organization']['html'] ?>
		</div>
	</div>
<? } ?>

<div class="universal-form__subgroup">
	<? if ($hideContactFieldsCaption != 1) { ?>
	<div class="universal-form__group-title">
		<?= truc('Контактные данные', 'RegistrationModule') ?>
	</div>
	<? } ?>

	<? if ($registration['fields']['company']) { ?>

		<div id="companyName"<?=(($_POST['is_organization'] == 'N')?' style="display: none"':'')?>>
			<div class="form-gr form-gr_horizontal_center registration-form__row">
				<label class="form-gr__label" for="company">
					<?= $registration['fields']['company']['caption'] ?>
				</label>

				<div class="form-gr__control">
					<?= $registration['fields']['company']['html'] ?>
				</div>
			</div>
		</div>
	<? } ?>

	<? if ($hideContactFields != 1) { ?>

		<?  ?><?
$arConfigFields = [
	'contact_first_name',
	'contact_surname',
	'contact_patronymic_name',
	'contact_phone',
	'cst_email',
	'stc_id',
];
?><?  ?>

		<? if (count(array_intersect(['add_city_id', 'add_region_id', 'add_country_id'], $arConfigFields)) === 0) { ?>

			<? $address_form = & $registration; ?>
			<?  ?><?
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
<? } ?><?  ?>

		<? } ?>

		<? $universalForm = &$registration; ?>
		<?  ?><?
if (ADMIN_PAGE) {
	include __spellPATH('PHP_TEMPLATES_LIB:/common_templates/tpl.universal_form.php');
} else {
	$secondw = false;
	if (isset($arConfigFields) && isset($universalForm)) {
		if(isset($universalFormConfig)) {
			if($universalFormConfig['secondw'] == true) {
				$secondw = true;
			}
		};
		foreach ($arConfigFields as $configField) {
			if (is_array($configField)) {
				foreach ($configField as $subKey => $subField) {
					if (!$universalForm['fields'][$subField]) {
						unset($configField[$subKey]);
					}
				}
				if (empty($configField)) {
					continue;
				}
				if (count($configField) == 1) {
					$configField = array_pop($configField);
				}
			}

			if (is_array($configField)) { ?>
				<div id="tr_is_<?= $configField ?>">
					<div class="form-gr <?=$secondw?'form-gr--secondw ':' '?>form-gr_horizontal_center universal-form__row">
						<label for="<?= $configField[0] ?>" class="form-gr__label"><?= $universalForm['fields'][$configField[0]]['caption'] ?></label>
						<div class="form-gr__control<?=$universalForm['fields'][$configField[0]]['instance_name'] == 'CheckBox'?' form-gr__control--checkbox':''?>"><?= $universalForm['fields'][$configField[0]]['html'] ?></div>
					</div>
					<div class="form-gr <?=$secondw?'form-gr--secondw ':' '?>">
						<label class="form-gr__label" for="<?= $configField[1] ?>"><?= $universalForm['fields'][$configField[1]]['caption'] ?></label>
						<div class="form-gr__control<?=$universalForm['fields'][$configField[1]]['instance_name'] == 'CheckBox'?' form-gr__control--checkbox':''?>"><?= $universalForm['fields'][$configField[1]]['html'] ?></div>
					</div>

				</div>
			<? } else if ($universalForm['fields'][$configField]) {
				$field = $universalForm['fields'][$configField];
				?>
				<div id="tr_<?= $configField ?>" class="form-gr <?= $secondw ? 'form-gr--secondw ' : ' ' ?>form-gr_horizontal_center universal-form__row <? if ($field['hidden']) { ?>hidden<? } ?>">
				<label for="<?= $configField ?>" class="form-gr__label"><?= $field['caption'] ?></label>
					<div class="form-gr__control<?=$field['instance_name'] == 'CheckBox'?' form-gr__control--checkbox':''?>"><?= $field['html'] ?></div>
				</div>
			<? }
		}
	}
}
?>
<?  ?>
	<? } ?>
</div><?  ?>						<?  ?><? if ($registration['fields']['userlogin'] or $registration['fields']['userpassword']) { ?>
	<?
	$arConfigFields = [
		'userlogin',
		'userpassword'
	];
	?>

	<?  ?><?
if (ADMIN_PAGE) {
	include __spellPATH('PHP_TEMPLATES_LIB:/common_templates/tpl.universal_form.php');
} else {
	$secondw = false;
	if (isset($arConfigFields) && isset($universalForm)) {
		if(isset($universalFormConfig)) {
			if($universalFormConfig['secondw'] == true) {
				$secondw = true;
			}
		};
		foreach ($arConfigFields as $configField) {
			if (is_array($configField)) {
				foreach ($configField as $subKey => $subField) {
					if (!$universalForm['fields'][$subField]) {
						unset($configField[$subKey]);
					}
				}
				if (empty($configField)) {
					continue;
				}
				if (count($configField) == 1) {
					$configField = array_pop($configField);
				}
			}

			if (is_array($configField)) { ?>
				<div id="tr_is_<?= $configField ?>">
					<div class="form-gr <?=$secondw?'form-gr--secondw ':' '?>form-gr_horizontal_center universal-form__row">
						<label for="<?= $configField[0] ?>" class="form-gr__label"><?= $universalForm['fields'][$configField[0]]['caption'] ?></label>
						<div class="form-gr__control<?=$universalForm['fields'][$configField[0]]['instance_name'] == 'CheckBox'?' form-gr__control--checkbox':''?>"><?= $universalForm['fields'][$configField[0]]['html'] ?></div>
					</div>
					<div class="form-gr <?=$secondw?'form-gr--secondw ':' '?>">
						<label class="form-gr__label" for="<?= $configField[1] ?>"><?= $universalForm['fields'][$configField[1]]['caption'] ?></label>
						<div class="form-gr__control<?=$universalForm['fields'][$configField[1]]['instance_name'] == 'CheckBox'?' form-gr__control--checkbox':''?>"><?= $universalForm['fields'][$configField[1]]['html'] ?></div>
					</div>

				</div>
			<? } else if ($universalForm['fields'][$configField]) {
				$field = $universalForm['fields'][$configField];
				?>
				<div id="tr_<?= $configField ?>" class="form-gr <?= $secondw ? 'form-gr--secondw ' : ' ' ?>form-gr_horizontal_center universal-form__row <? if ($field['hidden']) { ?>hidden<? } ?>">
				<label for="<?= $configField ?>" class="form-gr__label"><?= $field['caption'] ?></label>
					<div class="form-gr__control<?=$field['instance_name'] == 'CheckBox'?' form-gr__control--checkbox':''?>"><?= $field['html'] ?></div>
				</div>
			<? }
		}
	}
}
?>
<?  ?>

<? } elseif ($registration['fields']['__cst_id__']) { ?>

	<?= $registration['fields']['__cst_id__']['html'] ?>

<? } ?>

<? if (!$_interface->csActivationRequired) { ?>
	<div class="universal-form__subgroup">
		<?  ?><div class="form-gr form-gr_horizontal_center universal-form__row">
	<div class="form-gr__label"></div>
	<div class="form-gr__control form-gr__control--checkbox">
		<div><?= $registration['fields']['news_subscription']['html'] ?></div>
		<div><?= $registration['fields']['notify_subscription']['html'] ?></div>
		<div><?= $registration['fields']['sms_notify_subscription']['html'] ?></div>
	</div>
</div><?  ?>
	</div>
<? } ?>

<? if ($registration['fields']['reg_hc_code'] && $registration['fields']['reg_hc_image']) { ?>
	<div id="tr_reg_hc_code" class="form-gr form-gr_horizontal_center universal-form__row">
		<label class="form-gr__label" for="reg_hc_code">
			<?= $registration['fields']['reg_hc_code']['caption'] ?>
		</label>
		<div class="form-gr__control form-gr__control--hc">
			<?= $registration['fields']['reg_hc_code']['html'] ?>
		</div>
		<div class="form-gr__tooltip form-gr__tooltip--hc">
			<?= $registration['fields']['reg_hc_image']['html'] ?>
		</div>
	</div>
<? } ?><?  ?>					<div class="form-gr form-gr_horizontal_center">						<div class="form-gr__label"></div>						<div class="form-gr__control form-gr__control--tooltip registration-form__submit-control">							<input name="vin_send" value="<?= tr('Подать запрос', 'Common') ?>" type="submit" class="btn"/>						</div>					</div>				</div>			<? } else { ?>				<div id="vin_form_contact_data" class="universal-form__subgroup">					<div class="universal-form__group-title"><?= tr("Ваши контактные данные", "VinRequestModule") ?></div>					<div class="row cars-form__row">						<div class="col-xs-12 col-sm-4 form-gr form-gr--column">							<label class="form-gr__label" for="contact"><?= $vin_requests['fields']['contact']['caption'] ?></label>							<div class="form-gr__control">								<?= $vin_requests['fields']['contact']['html'] ?>							</div>						</div>						<div class="col-xs-12 col-sm-4 form-gr form-gr--column">							<label class="form-gr__label" for="contact"><?= $vin_requests['fields']['phone']['caption'] ?></label>							<div class="form-gr__control">								<?= $vin_requests['fields']['phone']['html'] ?>							</div>						</div>						<div class="col-xs-12 col-sm-4 form-gr form-gr--column">							<label class="form-gr__label" for="contact"><?= $vin_requests['fields']['email']['caption'] ?></label>							<div class="form-gr__control">								<?= $vin_requests['fields']['email']['html'] ?>							</div>						</div>					</div>					<div class="row cars-form__row">						<div class="col-xs-12 col-sm-4 form-gr form-gr--column">							<button class="btn form-gr__submit"><?= tr('Подать запрос', 'Common') ?></button>						</div>					</div>				</div>			<? } ?>			<?= $vin_requests['fields']['subj']['html'] ?>			<?= $vin_requests['fields']['_prid']['html'] ?>			<?= $vin_requests['fields']['date_received']['html'] ?>			<?= $vin_requests['fields']['cst_id']['html'] ?>			<?= $vin_requests['fields']['csc_id']['html'] ?>		</form>	</div></div><?  ?>

<? } ?>
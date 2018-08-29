<? if ($_ajax_datagrid) {
	$web_ar_datagrid = & $order['fields']['basket']['html'];
	$web_ar_datagrid_source = & $order['sourceFields']['basket']['instance']->datasource;
	$data_align = array('left', 'left', 'left', 'center', 'left', 'right', 'left', 'left', 'left');
	$basket_page = 'make_order';
	 ?><?
$i = 0;
if (!empty($web_ar_datagrid['controls'])) {
	foreach ($web_ar_datagrid['controls'] as $hdr_id => $control) {
		if ((empty($control_align[$i])) or ($control_align[$i] == 'top')) {
			?>
			<div class="table_control"><?= $control ?></div><?
		}
		$i++;
	}
}

?>

<? if (count($web_ar_datagrid['data']) > 0) { ?>

	<?
		$hide_cols = array('weight_display', 'info');//ячейки, которые не попадут в таблицу
		$hide_captions = array('comment');
		$mobile_captions = ['article', 'brand', 'price', 'amount', 'name'];//заголовки ячеек, которые попадут на моб устройства
		$colMobileTitles = [];//заголовки для ячеек на моб устройствах
		$tdCount = 0; //счетчик кол-ва ячеек, которые попадут в таблицу
	?>

	<table class="adapt-table basket-table basket-page__table">
		<thead class="adapt-table__thead">
		<tr class="adapt-table__thead-tr">
			<? foreach ($web_ar_datagrid['header'] as $hdr_id => $column) { ?>

				<? if (($column['visible'] != '1') or (in_array($hdr_id, $hide_cols))) continue; ?>
				<?
				if(!in_array($hdr_id, $hide_captions) && in_array($hdr_id, $mobile_captions)) {
					$colMobileTitles[$hdr_id] = $column['caption'];
				}
				$tdCount++;
				?>
				<th class="adapt-table__th basket-table__th basket-table__th_title_<?=$hdr_id?>"><?= (!in_array($hdr_id, $hide_captions) ? $column['caption'] : '') ?></th>

			<? } ?>

			<?
				$__BUFFER->addScript('/_syslib/modules/module.inputNumberControl.js');
				$__BUFFER->addJsInit("
				var initAmountFix = function(){
					var amounts = document.querySelectorAll('.basket-table__td_title_amount input');
					if(amounts) {
						var i, inp;
						for(i = 0; i < amounts.length; i++) {
							inp = new InputNumberControl({
								input: amounts[i]
							});
							inp.wrapper.classList.add('basket-table__row-count-control');
						}
					}
				};

				initAmountFix();

				jqWar(document).on('basketReload',function(){
					initAmountFix();
				});

				");
				$__BUFFER->addJsInit("if(window.basketPage) window.basketPage.setColMobileTitles(" . json_encode($colMobileTitles) . ");");
			?>
		</tr>
		</thead>
		<tbody class="adapt-table__tbody">
		<? foreach ($web_ar_datagrid['data'] as $row => $item) { ?>

			<tr class="adapt-table__tr">

				<? if(isset($item['mobile_row_head'])) { ?>
					<td class="adapt-table__tr-head"><?=$item['mobile_row_head']?></td>
				<? } ?>

				<? $i = 0; ?>

				<? foreach ($web_ar_datagrid['header'] as $hdr_id => $column) { ?>

					<? if (($column['visible'] != '1') or (in_array($hdr_id, $hide_cols))) continue; ?>

					<td class="adapt-table__td adapt-table__td_title_<?= $hdr_id ?> basket-table__td basket-table__td_title_<?= $hdr_id ?>">

						<? if ($hdr_id == 'cost_per_weight_display') { ?>

							+ <?= $item[$hdr_id] ?> <?= (!empty($item['weight_display']) ? ' / ' . $item['weight_display'] . ' ' . $MSG['BasketModule']['msg19'] : '') ?>

						<? } elseif ($hdr_id == 'chPos') { ?>

							<?
							$matches = [];
							preg_match('/id=\"(.*)\"/i',$item[$hdr_id],$matches);
							?>

							<?= $item[$hdr_id] ?><label for="<?=$matches[1]?>"></label>

						<? } elseif ($hdr_id == 'summ') { ?>

							<strong><?= $item[$hdr_id] ?></strong>

							<? if (($item['cost_per_weight_value'] > 0) && (empty($item['weight']))) { ?>
								<span title="<?= $MSG['BasketModule']['msg41'] ?>">
									<svg class="basket-table__td-svg-icon">
										<use xlink:href="/_sysimg/svg/notice-sprite.svg#cursor-aim"></use>
									</svg>
								</span>
							<? } ?>

						<? } elseif ($hdr_id == 'comment') { ?>

							<div class="click-comment basket-page__click-comment" title="<?=($basket_page === 'make_order' ? tr('Нажмите, чтобы посмотреть комментарий','BasketModule') : tr('Нажмите, чтобы добавить комментарий','BasketModule'))?>">
								<svg class="click-comment__svg-icon"><use xlink:href="/_sysimg/svg/notice-sprite.svg#comment"></use></svg>
								<div class="click-comment__show-area">
									<?= $item[$hdr_id] ?>
								</div>
							</div>

						<? } else { ?>

							<?
							if ($item['manualAdd'] != 1 and in_array($hdr_id, Array('brand', 'article', 'price'))) {
								echo $web_ar_datagrid_source[$row][$hdr_id];
							} else {
								echo $item[$hdr_id];
							}

							?>

						<? } ?>

					</td>

					<? $i++; ?>

				<? } ?>

			</tr>

		<? } ?>
		</tbody>
		<? if ($basket_page == 'make_order') { ?>
			<tbody id="deliveryBody" style="display:none;">
				<tr class="adapt-table__tr basket-table__tr-delivery">
					<? $i = 0; ?>
					<? foreach ($web_ar_datagrid['header'] as $hdr_id => $column) { ?>

						<? if (($column['visible'] != '1') or (in_array($hdr_id, $hide_cols))) continue; ?>

						<td class="adapt-table__td adapt-table__td_title_<?= $hdr_id ?> basket-table__td basket-table__td_title_<?= $hdr_id ?>">
							<? if ($hdr_id == 'name') { ?>
								<?= $MSG['MakeOrderModule']['msg64'] ?>
							<? } elseif ($hdr_id == 'summ') { ?>
								<span id="deliveryDiv"></span>
							<? } ?>
						</td>

						<? $i++; ?>

					<? } ?>
				</tr>
			</tbody>
		<? } ?>
	</table>

	<div class="basket-page__summary">
		<?= $MSG['BasketModule']['msg54'] ?>
		<div id="orderSumAmount" class="basket-table__summary-count"><?= $AMOUNT_SUMM ?> <?= $MSG['BasketModule']['msg55'] ?></div>
		<div id="orderSumm" class="basket-table__summary-price" ><?= $SUMM ?></div>
	</div>

<? } else { ?>

	<p><?= $empty_message ?></p>

<? } ?>

<?
$i = 0;
if (!empty($web_ar_datagrid['controls'])) {
	foreach ($web_ar_datagrid['controls'] as $hdr_id => $control) {
		if ($control_align[$i] == 'bottom') {

			?>
			<div class="table_control"><?= $control ?></div><?

		}
		$i++;
	}
}
?><? 

	return;
} ?>

<?= $MSG['MakeOrderModule']['msg68'] ?>

<? if ($order['messages']['registration_error_fields']) { ?>

	<?  ?><div class="message message_type_error message_view_outline">
	<div class="message__title"><?=$MSG['RegistrationModule']['msg63']?></div>
	<div class="message__text">
		<?=$MSG['RegistrationModule']['msg66']?>
		<?
		$group = 'make_order';
		$registration = &$order;
		 ?><? $errors = Loader::getApi('registration')->getPossibleErrors($group); ?>
<? foreach ($errors as $key => $error) { ?>
	<? if ($registration['messages'][$key]) { ?>
		<?= $error['text'] ?>
	<? } ?>
<? } ?><? 
		?>
	</div>
</div><?  ?>

	<?  ?><?= $order['validationScript'] ?>
<form id="<?= $order['id'] ?>" name="<?= $order['name'] ?>" action="<?= $order['action'] ?>" method="<?= $order['method'] ?>" onsubmit="<?= $order['onsubmit'] ?>">
	<div class="row">
		<div class="col-xs-12 col-sm-10 col-md-7 col-lg-7">

			<? if($useQuickOrderForm) {?>
				<div class="registration__descr">
					<span class="registration__marking">— <?=tr('обязательные поля','RegistrationModule')?></span>
				</div>

				<?= $order['fields']['__cst_id__']['html'] ?>

				<?
					$registration = & $order;
					 ?><? if ($registration['fields']['is_organization']['html']) { ?>
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
</div><? 
				?>
				<? if ($manyStocksMessage) { ?>
					<div class="warning">
						<div class="warning__caption"><?=tr('Внимание!')?></div>
						<div class="warning__text">
							<p><?=implode('</p>
							<p>', $manyStocksMessage)?></p>
						</div>
					</div>
					<br/><br/>
				<? } ?>

			<?	}  else { ?>

				<?  ?><div class="universal-form__subgroup">

	<div class="universal-form__group-title">
		<?= $MSG['MakeOrderModule']['msg69'] ?>
	</div>

	<?  ?><?
$arConfigFields = [
	'ord_contact_person',
	'ord_phones',
	'ord_email',
];
?><?  ?>
	<? $universalForm = &$order; ?>
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

</div><?  ?>

			<? } ?>

			<?  ?><div class="universal-form__subgroup">
	<div class="universal-form__group-title">
		<?= $MSG['MakeOrderModule']['msg70'] ?>
	</div>
	<?
		$arConfigFields = [
			'ord_pmk_id',
			'ord_pyr_id',
			'ord_dlv_id',
			'ord_comment'
		];
	?>

	<? $universalForm = &$order; ?>
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

</div><?  ?>

			<?  ?><div id="delivery" class="universal-form__subgroup">

	<div class="universal-form__group-title">
		<?= $MSG['MakeOrderModule']['msg86'] ?>
	</div>

	<? if ($order['fields']['ord_address']) { ?>

		<div class="form-gr form-gr_horizontal_center universal-form__row">
			<label for="ord_address" class="form-gr__label"><?= $order['fields']['ord_address']['caption'] ?></label>

			<div class="form-gr__control"><?= $order['fields']['ord_address']['html'] ?></div>
		</div>

	<? } ?>

	<? if ($order['fields']['ord_add_id'] || ($order['fields']['ord_add_city_id']) || ($order['fields']['ord_address'])) { ?>

		<div class="form-gr form-gr_horizontal_center universal-form__row">
			<label for="ord_add_id" class="form-gr__label"><?= $order['fields']['ord_add_id']['caption'] ?></label>

			<div class="form-gr__control"><?= $order['fields']['ord_add_id']['html'] ?></div>
		</div>

		<div id="delivery_new_address">

			<? $address_form = & $order; ?>
			<? $adr_prefix = 'ord_'; ?>
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
			<? $adr_prefix = ''; ?>

		</div>

	<? } ?>

	<? if ($hide_deliveries == 'display: none') {
		$__BUFFER->addJsInit("
		var deliveryNewAddress = document.getElementById('delivery_new_address');
		if(deliveryNewAddress) deliveryNewAddress.style.display = 'none';
		var delivery = document.getElementById('delivery');
		if(delivery) delivery.style.display = 'none';
	");
	} ?>

</div>
<?  ?>

			<? if($useQuickOrderForm) {?>

				<?   ?><? if ($registration['fields']['userlogin'] or $registration['fields']['userpassword']) { ?>
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
<? } ?><?  ?>

			<? } else { ?>

				<?  ?><? if ($order['fields']['ord_need_validation']) { ?>
	<div class="universal-form__subgroup">
		<div class="universal-form__group-title"><?= $MSG['MakeOrderModule']['msg80'] ?></div>
		<div class="form-gr form-gr_horizontal_center universal-form__row">
			<p>
				<?=tr('При необходимости проверки менеджером применяемости выбранных вами номеров к вашему автомобилю требуется поставить отметку о необходимости проверки.','MakeOrderModule')?>
			</p>
		</div>
		<div class="form-gr form-gr_horizontal_center universal-form__row make-order-page__ord-need-val">
			<?= $order['fields']['ord_need_validation']['html'] ?>
		</div>
	</div>
	<div id="ord_car_select">
		<? $car_form = &$order; ?>
		<?  ?><? if ($car_form['fields']['select_csc_id']) { ?>		<div class="universal-form__subgroup">			<div class="cars-form__row">				<div class="form-gr form-gr_horizontal_center">					<label class="form-gr__label" for="csc_id"><?= $car_form['fields']['select_csc_id']['caption'] ?></label>					<div class="form-gr__control">						<?= $car_form['fields']['select_csc_id']['html'] ?>					</div>				</div>			</div>		</div><? } ?>	<div id="form_add">		<?		 ?><div class="universal-form__subgroup">	<div class="universal-form__group-title"><?= tr("Основные сведения", "VinRequestModule") ?></div>	<?	$carTplForm = &$car_form;	$carTplFields = [		'vin',		['crb_id', 'crm_id'],		['car_year', 'crmf_id']	];	 ?><?
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
?><? 		?>	</div></div><?$__BUFFER->addScript('/_syslib/modules/module.AreaCollapsedMod.js');$__BUFFER->AddJsInit(";(function(){	if(typeof AreaCollapsedMod !== 'undefined') {		var btn = document.getElementById('cars-details-form-button'),			area = document.getElementById('cars-details-form');		var det = new AreaCollapsedMod({			control: btn,			area: area,			areaCollapsedClass: 'area-collapsed-mod--collapsed',			collapsed: true		});	}})();");?><? 		?>	</div><?  ?>
	</div>
	
<? } ?><?  ?>

			<? } ?>



		</div>
		<div class="col-md-5 col-lg-5 visible-md visible-lg">
			<?=ContentPart('registration__terms')?>
		</div>
	</div>






	<? $web_ar_datagrid = &$order['fields']['basket']['html']; ?>
	<? $web_ar_datagrid_source = &$order['sourceFields']['basket']['instance']->datasource; ?>
	<? $basket_page = 'make_order'; ?>
	<div class="row">
		<div class="col-xs-12">
			<?  ?><?
$i = 0;
if (!empty($web_ar_datagrid['controls'])) {
	foreach ($web_ar_datagrid['controls'] as $hdr_id => $control) {
		if ((empty($control_align[$i])) or ($control_align[$i] == 'top')) {
			?>
			<div class="table_control"><?= $control ?></div><?
		}
		$i++;
	}
}

?>

<? if (count($web_ar_datagrid['data']) > 0) { ?>

	<?
		$hide_cols = array('weight_display', 'info');//ячейки, которые не попадут в таблицу
		$hide_captions = array('comment');
		$mobile_captions = ['article', 'brand', 'price', 'amount', 'name'];//заголовки ячеек, которые попадут на моб устройства
		$colMobileTitles = [];//заголовки для ячеек на моб устройствах
		$tdCount = 0; //счетчик кол-ва ячеек, которые попадут в таблицу
	?>

	<table class="adapt-table basket-table basket-page__table">
		<thead class="adapt-table__thead">
		<tr class="adapt-table__thead-tr">
			<? foreach ($web_ar_datagrid['header'] as $hdr_id => $column) { ?>

				<? if (($column['visible'] != '1') or (in_array($hdr_id, $hide_cols))) continue; ?>
				<?
				if(!in_array($hdr_id, $hide_captions) && in_array($hdr_id, $mobile_captions)) {
					$colMobileTitles[$hdr_id] = $column['caption'];
				}
				$tdCount++;
				?>
				<th class="adapt-table__th basket-table__th basket-table__th_title_<?=$hdr_id?>"><?= (!in_array($hdr_id, $hide_captions) ? $column['caption'] : '') ?></th>

			<? } ?>

			<?
				$__BUFFER->addScript('/_syslib/modules/module.inputNumberControl.js');
				$__BUFFER->addJsInit("
				var initAmountFix = function(){
					var amounts = document.querySelectorAll('.basket-table__td_title_amount input');
					if(amounts) {
						var i, inp;
						for(i = 0; i < amounts.length; i++) {
							inp = new InputNumberControl({
								input: amounts[i]
							});
							inp.wrapper.classList.add('basket-table__row-count-control');
						}
					}
				};

				initAmountFix();

				jqWar(document).on('basketReload',function(){
					initAmountFix();
				});

				");
				$__BUFFER->addJsInit("if(window.basketPage) window.basketPage.setColMobileTitles(" . json_encode($colMobileTitles) . ");");
			?>
		</tr>
		</thead>
		<tbody class="adapt-table__tbody">
		<? foreach ($web_ar_datagrid['data'] as $row => $item) { ?>

			<tr class="adapt-table__tr">

				<? if(isset($item['mobile_row_head'])) { ?>
					<td class="adapt-table__tr-head"><?=$item['mobile_row_head']?></td>
				<? } ?>

				<? $i = 0; ?>

				<? foreach ($web_ar_datagrid['header'] as $hdr_id => $column) { ?>

					<? if (($column['visible'] != '1') or (in_array($hdr_id, $hide_cols))) continue; ?>

					<td class="adapt-table__td adapt-table__td_title_<?= $hdr_id ?> basket-table__td basket-table__td_title_<?= $hdr_id ?>">

						<? if ($hdr_id == 'cost_per_weight_display') { ?>

							+ <?= $item[$hdr_id] ?> <?= (!empty($item['weight_display']) ? ' / ' . $item['weight_display'] . ' ' . $MSG['BasketModule']['msg19'] : '') ?>

						<? } elseif ($hdr_id == 'chPos') { ?>

							<?
							$matches = [];
							preg_match('/id=\"(.*)\"/i',$item[$hdr_id],$matches);
							?>

							<?= $item[$hdr_id] ?><label for="<?=$matches[1]?>"></label>

						<? } elseif ($hdr_id == 'summ') { ?>

							<strong><?= $item[$hdr_id] ?></strong>

							<? if (($item['cost_per_weight_value'] > 0) && (empty($item['weight']))) { ?>
								<span title="<?= $MSG['BasketModule']['msg41'] ?>">
									<svg class="basket-table__td-svg-icon">
										<use xlink:href="/_sysimg/svg/notice-sprite.svg#cursor-aim"></use>
									</svg>
								</span>
							<? } ?>

						<? } elseif ($hdr_id == 'comment') { ?>

							<div class="click-comment basket-page__click-comment" title="<?=($basket_page === 'make_order' ? tr('Нажмите, чтобы посмотреть комментарий','BasketModule') : tr('Нажмите, чтобы добавить комментарий','BasketModule'))?>">
								<svg class="click-comment__svg-icon"><use xlink:href="/_sysimg/svg/notice-sprite.svg#comment"></use></svg>
								<div class="click-comment__show-area">
									<?= $item[$hdr_id] ?>
								</div>
							</div>

						<? } else { ?>

							<?
							if ($item['manualAdd'] != 1 and in_array($hdr_id, Array('brand', 'article', 'price'))) {
								echo $web_ar_datagrid_source[$row][$hdr_id];
							} else {
								echo $item[$hdr_id];
							}

							?>

						<? } ?>

					</td>

					<? $i++; ?>

				<? } ?>

			</tr>

		<? } ?>
		</tbody>
		<? if ($basket_page == 'make_order') { ?>
			<tbody id="deliveryBody" style="display:none;">
				<tr class="adapt-table__tr basket-table__tr-delivery">
					<? $i = 0; ?>
					<? foreach ($web_ar_datagrid['header'] as $hdr_id => $column) { ?>

						<? if (($column['visible'] != '1') or (in_array($hdr_id, $hide_cols))) continue; ?>

						<td class="adapt-table__td adapt-table__td_title_<?= $hdr_id ?> basket-table__td basket-table__td_title_<?= $hdr_id ?>">
							<? if ($hdr_id == 'name') { ?>
								<?= $MSG['MakeOrderModule']['msg64'] ?>
							<? } elseif ($hdr_id == 'summ') { ?>
								<span id="deliveryDiv"></span>
							<? } ?>
						</td>

						<? $i++; ?>

					<? } ?>
				</tr>
			</tbody>
		<? } ?>
	</table>

	<div class="basket-page__summary">
		<?= $MSG['BasketModule']['msg54'] ?>
		<div id="orderSumAmount" class="basket-table__summary-count"><?= $AMOUNT_SUMM ?> <?= $MSG['BasketModule']['msg55'] ?></div>
		<div id="orderSumm" class="basket-table__summary-price" ><?= $SUMM ?></div>
	</div>

<? } else { ?>

	<p><?= $empty_message ?></p>

<? } ?>

<?
$i = 0;
if (!empty($web_ar_datagrid['controls'])) {
	foreach ($web_ar_datagrid['controls'] as $hdr_id => $control) {
		if ($control_align[$i] == 'bottom') {

			?>
			<div class="table_control"><?= $control ?></div><?

		}
		$i++;
	}
}
?><?  ?>
			<?= $order['fields']['chPos']['html'] ?>


			<?  ?><div class="make-order-page__bottom-controls">
	<div class="make-order-page__bottom-messages">

		<?  ?>		<?if($MIN_ORDER_SUMM):?>
			
			<div class="message message_type_error">
				<div class="message__text">
					<p><?=$MSG['Forms']['msg5']?></p>
					<p><?=$MSG['BasketModule']['msg39']?>: <span class="warning_value"><?=$MIN_ORDER_SUMM?></span>
						<br/><?=$MSG['BasketModule']['msg40']?></p>
				</div>
			</div>
		
		<?endif?>
		
		<?if($RESTRICT_FUND_REMAINS):?>
			
			<div class="message message_type_error">
				<div class="message__text">
					<p><?=$MSG['Forms']['msg5']?></p>
					<p><?=$MSG['BasketModule']['msg46']?> <span class="warning_value"><?=$FUND_REMAINS?></span></p>
				</div>
			</div>
			
		<?elseif($FUND_REMAINS):?>
			
			<div class="message message_type_error">
				<div class="message__text">
					<p><?=$MSG['Forms']['msg5']?></p>
					<p><?=$MSG['BasketModule']['msg45']?> <span class="warning_value"><?=$FUND_REMAINS?></span></p>
				</div>
			</div>
		
		<?elseif($RESTRICT_DEBT_SUMM):?>
			
			<div class="message message_type_error">
				<div class="message__text">
					<p><?=$MSG['Forms']['msg5']?></p>
					<p><?=$MSG['BasketModule']['msg43']?> <span class="warning_value"><?=$MAX_DEBT_SUMM?></span></p>
				</div>
			</div>

		<?elseif($MAX_DEBT_SUMM):?>
			
			<div class="message message_type_error">
				<div class="message__text">
					<p><?=$MSG['Forms']['msg5']?></p>
					<p><?=$MSG['BasketModule']['msg42']?> <span class="warning_value"><?=$MAX_DEBT_SUMM?></span></p>
				</div>
			</div>
			
		<?endif?><?  ?>
		<?=$order['fields']['edit']['html']?>
		<?=$order['fields']['cancel']['html']?>
	</div>

	<div class="make-order-page__bottom-action">
		<? if ($order['fields']['OrderConfirm'] || $order['fields']['accept-politic']) { ?>
			<div class="make-order-page__notify">
				<?=$order['fields']['OrderConfirm'] ? $order['fields']['OrderConfirm']['html'] : ''?>
				<?=$order['fields']['accept-politic'] ? $order['fields']['accept-politic']['html'] : ''?>
			</div>
		<? } ?>
		<? if((!isset($MIN_ORDER_SUMM)) && (!isset($RESTRICT_DEBT_SUMM))) { ?>
			<?=$order['fields']['save_order']['html']?>
		<? } ?>
	</div>
</div>

<div class="info-notice-list make-order-page__bottom-notice">
	<div class="info-notice-list__item">
		<svg class="info-notice-list__svg-icon"><use xlink:href="/_sysimg/svg/notice-sprite.svg#cursor-aim"></use></svg>
		<?=tr('Стоимость товаров, отмеченных данным значком, не является конечной и требует согласования с менеджером!', 'BasketModule');?>
	</div>
	<div class="info-notice-list__item">
		<svg class="info-notice-list__svg-icon"><use xlink:href="/_sysimg/svg/notice-sprite.svg#comment"></use></svg>
		<?=truc('комментарий к позиции', 'Forms');?>
	</div>
</div><?  ?>


			<?= $order['fields']['_prid']['html'] ?>
			<?= $order['fields']['subj']['html'] ?>
			<?= $order['fields']['ord_id']['html'] ?>
			<?= $order['fields']['ord_dcm_id']['html'] ?>
			<?= $order['fields']['ord_active']['html'] ?>
			<?= $order['fields']['ord_fixed']['html'] ?>
			<?= $order['fields']['hide_small_basket']['html'] ?>
			<?= $order['fields']['ord_source_id']['html'] ?>
			<?= $order['fields']['csc_id']['html'] ?>
		</div>

	</div>
</form>
<?  ?>

<? } else { ?>

	<? if (!$ORDER_EMPTY): ?>

	<? if($order['name'] == 'order') { ?>

			<?  ?><?= $order['validationScript'] ?>
<form id="<?= $order['id'] ?>" name="<?= $order['name'] ?>" action="<?= $order['action'] ?>" method="<?= $order['method'] ?>" onsubmit="<?= $order['onsubmit'] ?>">
	<div class="row">
		<div class="col-xs-12 col-sm-10 col-md-7 col-lg-7">

			<? if($useQuickOrderForm) {?>
				<div class="registration__descr">
					<span class="registration__marking">— <?=tr('обязательные поля','RegistrationModule')?></span>
				</div>

				<?= $order['fields']['__cst_id__']['html'] ?>

				<?
					$registration = & $order;
					 ?><? if ($registration['fields']['is_organization']['html']) { ?>
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
</div><? 
				?>
				<? if ($manyStocksMessage) { ?>
					<div class="warning">
						<div class="warning__caption"><?=tr('Внимание!')?></div>
						<div class="warning__text">
							<p><?=implode('</p>
							<p>', $manyStocksMessage)?></p>
						</div>
					</div>
					<br/><br/>
				<? } ?>

			<?	}  else { ?>

				<?  ?><div class="universal-form__subgroup">

	<div class="universal-form__group-title">
		<?= $MSG['MakeOrderModule']['msg69'] ?>
	</div>

	<?  ?><?
$arConfigFields = [
	'ord_contact_person',
	'ord_phones',
	'ord_email',
];
?><?  ?>
	<? $universalForm = &$order; ?>
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

</div><?  ?>

			<? } ?>

			<?  ?><div class="universal-form__subgroup">
	<div class="universal-form__group-title">
		<?= $MSG['MakeOrderModule']['msg70'] ?>
	</div>
	<?
		$arConfigFields = [
			'ord_pmk_id',
			'ord_pyr_id',
			'ord_dlv_id',
			'ord_comment'
		];
	?>

	<? $universalForm = &$order; ?>
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

</div><?  ?>

			<?  ?><div id="delivery" class="universal-form__subgroup">

	<div class="universal-form__group-title">
		<?= $MSG['MakeOrderModule']['msg86'] ?>
	</div>

	<? if ($order['fields']['ord_address']) { ?>

		<div class="form-gr form-gr_horizontal_center universal-form__row">
			<label for="ord_address" class="form-gr__label"><?= $order['fields']['ord_address']['caption'] ?></label>

			<div class="form-gr__control"><?= $order['fields']['ord_address']['html'] ?></div>
		</div>

	<? } ?>

	<? if ($order['fields']['ord_add_id'] || ($order['fields']['ord_add_city_id']) || ($order['fields']['ord_address'])) { ?>

		<div class="form-gr form-gr_horizontal_center universal-form__row">
			<label for="ord_add_id" class="form-gr__label"><?= $order['fields']['ord_add_id']['caption'] ?></label>

			<div class="form-gr__control"><?= $order['fields']['ord_add_id']['html'] ?></div>
		</div>

		<div id="delivery_new_address">

			<? $address_form = & $order; ?>
			<? $adr_prefix = 'ord_'; ?>
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
			<? $adr_prefix = ''; ?>

		</div>

	<? } ?>

	<? if ($hide_deliveries == 'display: none') {
		$__BUFFER->addJsInit("
		var deliveryNewAddress = document.getElementById('delivery_new_address');
		if(deliveryNewAddress) deliveryNewAddress.style.display = 'none';
		var delivery = document.getElementById('delivery');
		if(delivery) delivery.style.display = 'none';
	");
	} ?>

</div>
<?  ?>

			<? if($useQuickOrderForm) {?>

				<?   ?><? if ($registration['fields']['userlogin'] or $registration['fields']['userpassword']) { ?>
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
<? } ?><?  ?>

			<? } else { ?>

				<?  ?><? if ($order['fields']['ord_need_validation']) { ?>
	<div class="universal-form__subgroup">
		<div class="universal-form__group-title"><?= $MSG['MakeOrderModule']['msg80'] ?></div>
		<div class="form-gr form-gr_horizontal_center universal-form__row">
			<p>
				<?=tr('При необходимости проверки менеджером применяемости выбранных вами номеров к вашему автомобилю требуется поставить отметку о необходимости проверки.','MakeOrderModule')?>
			</p>
		</div>
		<div class="form-gr form-gr_horizontal_center universal-form__row make-order-page__ord-need-val">
			<?= $order['fields']['ord_need_validation']['html'] ?>
		</div>
	</div>
	<div id="ord_car_select">
		<? $car_form = &$order; ?>
		<?  ?><? if ($car_form['fields']['select_csc_id']) { ?>		<div class="universal-form__subgroup">			<div class="cars-form__row">				<div class="form-gr form-gr_horizontal_center">					<label class="form-gr__label" for="csc_id"><?= $car_form['fields']['select_csc_id']['caption'] ?></label>					<div class="form-gr__control">						<?= $car_form['fields']['select_csc_id']['html'] ?>					</div>				</div>			</div>		</div><? } ?>	<div id="form_add">		<?		 ?><div class="universal-form__subgroup">	<div class="universal-form__group-title"><?= tr("Основные сведения", "VinRequestModule") ?></div>	<?	$carTplForm = &$car_form;	$carTplFields = [		'vin',		['crb_id', 'crm_id'],		['car_year', 'crmf_id']	];	 ?><?
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
?><? 		?>	</div></div><?$__BUFFER->addScript('/_syslib/modules/module.AreaCollapsedMod.js');$__BUFFER->AddJsInit(";(function(){	if(typeof AreaCollapsedMod !== 'undefined') {		var btn = document.getElementById('cars-details-form-button'),			area = document.getElementById('cars-details-form');		var det = new AreaCollapsedMod({			control: btn,			area: area,			areaCollapsedClass: 'area-collapsed-mod--collapsed',			collapsed: true		});	}})();");?><? 		?>	</div><?  ?>
	</div>
	
<? } ?><?  ?>

			<? } ?>



		</div>
		<div class="col-md-5 col-lg-5 visible-md visible-lg">
			<?=ContentPart('registration__terms')?>
		</div>
	</div>






	<? $web_ar_datagrid = &$order['fields']['basket']['html']; ?>
	<? $web_ar_datagrid_source = &$order['sourceFields']['basket']['instance']->datasource; ?>
	<? $basket_page = 'make_order'; ?>
	<div class="row">
		<div class="col-xs-12">
			<?  ?><?
$i = 0;
if (!empty($web_ar_datagrid['controls'])) {
	foreach ($web_ar_datagrid['controls'] as $hdr_id => $control) {
		if ((empty($control_align[$i])) or ($control_align[$i] == 'top')) {
			?>
			<div class="table_control"><?= $control ?></div><?
		}
		$i++;
	}
}

?>

<? if (count($web_ar_datagrid['data']) > 0) { ?>

	<?
		$hide_cols = array('weight_display', 'info');//ячейки, которые не попадут в таблицу
		$hide_captions = array('comment');
		$mobile_captions = ['article', 'brand', 'price', 'amount', 'name'];//заголовки ячеек, которые попадут на моб устройства
		$colMobileTitles = [];//заголовки для ячеек на моб устройствах
		$tdCount = 0; //счетчик кол-ва ячеек, которые попадут в таблицу
	?>

	<table class="adapt-table basket-table basket-page__table">
		<thead class="adapt-table__thead">
		<tr class="adapt-table__thead-tr">
			<? foreach ($web_ar_datagrid['header'] as $hdr_id => $column) { ?>

				<? if (($column['visible'] != '1') or (in_array($hdr_id, $hide_cols))) continue; ?>
				<?
				if(!in_array($hdr_id, $hide_captions) && in_array($hdr_id, $mobile_captions)) {
					$colMobileTitles[$hdr_id] = $column['caption'];
				}
				$tdCount++;
				?>
				<th class="adapt-table__th basket-table__th basket-table__th_title_<?=$hdr_id?>"><?= (!in_array($hdr_id, $hide_captions) ? $column['caption'] : '') ?></th>

			<? } ?>

			<?
				$__BUFFER->addScript('/_syslib/modules/module.inputNumberControl.js');
				$__BUFFER->addJsInit("
				var initAmountFix = function(){
					var amounts = document.querySelectorAll('.basket-table__td_title_amount input');
					if(amounts) {
						var i, inp;
						for(i = 0; i < amounts.length; i++) {
							inp = new InputNumberControl({
								input: amounts[i]
							});
							inp.wrapper.classList.add('basket-table__row-count-control');
						}
					}
				};

				initAmountFix();

				jqWar(document).on('basketReload',function(){
					initAmountFix();
				});

				");
				$__BUFFER->addJsInit("if(window.basketPage) window.basketPage.setColMobileTitles(" . json_encode($colMobileTitles) . ");");
			?>
		</tr>
		</thead>
		<tbody class="adapt-table__tbody">
		<? foreach ($web_ar_datagrid['data'] as $row => $item) { ?>

			<tr class="adapt-table__tr">

				<? if(isset($item['mobile_row_head'])) { ?>
					<td class="adapt-table__tr-head"><?=$item['mobile_row_head']?></td>
				<? } ?>

				<? $i = 0; ?>

				<? foreach ($web_ar_datagrid['header'] as $hdr_id => $column) { ?>

					<? if (($column['visible'] != '1') or (in_array($hdr_id, $hide_cols))) continue; ?>

					<td class="adapt-table__td adapt-table__td_title_<?= $hdr_id ?> basket-table__td basket-table__td_title_<?= $hdr_id ?>">

						<? if ($hdr_id == 'cost_per_weight_display') { ?>

							+ <?= $item[$hdr_id] ?> <?= (!empty($item['weight_display']) ? ' / ' . $item['weight_display'] . ' ' . $MSG['BasketModule']['msg19'] : '') ?>

						<? } elseif ($hdr_id == 'chPos') { ?>

							<?
							$matches = [];
							preg_match('/id=\"(.*)\"/i',$item[$hdr_id],$matches);
							?>

							<?= $item[$hdr_id] ?><label for="<?=$matches[1]?>"></label>

						<? } elseif ($hdr_id == 'summ') { ?>

							<strong><?= $item[$hdr_id] ?></strong>

							<? if (($item['cost_per_weight_value'] > 0) && (empty($item['weight']))) { ?>
								<span title="<?= $MSG['BasketModule']['msg41'] ?>">
									<svg class="basket-table__td-svg-icon">
										<use xlink:href="/_sysimg/svg/notice-sprite.svg#cursor-aim"></use>
									</svg>
								</span>
							<? } ?>

						<? } elseif ($hdr_id == 'comment') { ?>

							<div class="click-comment basket-page__click-comment" title="<?=($basket_page === 'make_order' ? tr('Нажмите, чтобы посмотреть комментарий','BasketModule') : tr('Нажмите, чтобы добавить комментарий','BasketModule'))?>">
								<svg class="click-comment__svg-icon"><use xlink:href="/_sysimg/svg/notice-sprite.svg#comment"></use></svg>
								<div class="click-comment__show-area">
									<?= $item[$hdr_id] ?>
								</div>
							</div>

						<? } else { ?>

							<?
							if ($item['manualAdd'] != 1 and in_array($hdr_id, Array('brand', 'article', 'price'))) {
								echo $web_ar_datagrid_source[$row][$hdr_id];
							} else {
								echo $item[$hdr_id];
							}

							?>

						<? } ?>

					</td>

					<? $i++; ?>

				<? } ?>

			</tr>

		<? } ?>
		</tbody>
		<? if ($basket_page == 'make_order') { ?>
			<tbody id="deliveryBody" style="display:none;">
				<tr class="adapt-table__tr basket-table__tr-delivery">
					<? $i = 0; ?>
					<? foreach ($web_ar_datagrid['header'] as $hdr_id => $column) { ?>

						<? if (($column['visible'] != '1') or (in_array($hdr_id, $hide_cols))) continue; ?>

						<td class="adapt-table__td adapt-table__td_title_<?= $hdr_id ?> basket-table__td basket-table__td_title_<?= $hdr_id ?>">
							<? if ($hdr_id == 'name') { ?>
								<?= $MSG['MakeOrderModule']['msg64'] ?>
							<? } elseif ($hdr_id == 'summ') { ?>
								<span id="deliveryDiv"></span>
							<? } ?>
						</td>

						<? $i++; ?>

					<? } ?>
				</tr>
			</tbody>
		<? } ?>
	</table>

	<div class="basket-page__summary">
		<?= $MSG['BasketModule']['msg54'] ?>
		<div id="orderSumAmount" class="basket-table__summary-count"><?= $AMOUNT_SUMM ?> <?= $MSG['BasketModule']['msg55'] ?></div>
		<div id="orderSumm" class="basket-table__summary-price" ><?= $SUMM ?></div>
	</div>

<? } else { ?>

	<p><?= $empty_message ?></p>

<? } ?>

<?
$i = 0;
if (!empty($web_ar_datagrid['controls'])) {
	foreach ($web_ar_datagrid['controls'] as $hdr_id => $control) {
		if ($control_align[$i] == 'bottom') {

			?>
			<div class="table_control"><?= $control ?></div><?

		}
		$i++;
	}
}
?><?  ?>
			<?= $order['fields']['chPos']['html'] ?>


			<?  ?><div class="make-order-page__bottom-controls">
	<div class="make-order-page__bottom-messages">

		<?  ?>		<?if($MIN_ORDER_SUMM):?>
			
			<div class="message message_type_error">
				<div class="message__text">
					<p><?=$MSG['Forms']['msg5']?></p>
					<p><?=$MSG['BasketModule']['msg39']?>: <span class="warning_value"><?=$MIN_ORDER_SUMM?></span>
						<br/><?=$MSG['BasketModule']['msg40']?></p>
				</div>
			</div>
		
		<?endif?>
		
		<?if($RESTRICT_FUND_REMAINS):?>
			
			<div class="message message_type_error">
				<div class="message__text">
					<p><?=$MSG['Forms']['msg5']?></p>
					<p><?=$MSG['BasketModule']['msg46']?> <span class="warning_value"><?=$FUND_REMAINS?></span></p>
				</div>
			</div>
			
		<?elseif($FUND_REMAINS):?>
			
			<div class="message message_type_error">
				<div class="message__text">
					<p><?=$MSG['Forms']['msg5']?></p>
					<p><?=$MSG['BasketModule']['msg45']?> <span class="warning_value"><?=$FUND_REMAINS?></span></p>
				</div>
			</div>
		
		<?elseif($RESTRICT_DEBT_SUMM):?>
			
			<div class="message message_type_error">
				<div class="message__text">
					<p><?=$MSG['Forms']['msg5']?></p>
					<p><?=$MSG['BasketModule']['msg43']?> <span class="warning_value"><?=$MAX_DEBT_SUMM?></span></p>
				</div>
			</div>

		<?elseif($MAX_DEBT_SUMM):?>
			
			<div class="message message_type_error">
				<div class="message__text">
					<p><?=$MSG['Forms']['msg5']?></p>
					<p><?=$MSG['BasketModule']['msg42']?> <span class="warning_value"><?=$MAX_DEBT_SUMM?></span></p>
				</div>
			</div>
			
		<?endif?><?  ?>
		<?=$order['fields']['edit']['html']?>
		<?=$order['fields']['cancel']['html']?>
	</div>

	<div class="make-order-page__bottom-action">
		<? if ($order['fields']['OrderConfirm'] || $order['fields']['accept-politic']) { ?>
			<div class="make-order-page__notify">
				<?=$order['fields']['OrderConfirm'] ? $order['fields']['OrderConfirm']['html'] : ''?>
				<?=$order['fields']['accept-politic'] ? $order['fields']['accept-politic']['html'] : ''?>
			</div>
		<? } ?>
		<? if((!isset($MIN_ORDER_SUMM)) && (!isset($RESTRICT_DEBT_SUMM))) { ?>
			<?=$order['fields']['save_order']['html']?>
		<? } ?>
	</div>
</div>

<div class="info-notice-list make-order-page__bottom-notice">
	<div class="info-notice-list__item">
		<svg class="info-notice-list__svg-icon"><use xlink:href="/_sysimg/svg/notice-sprite.svg#cursor-aim"></use></svg>
		<?=tr('Стоимость товаров, отмеченных данным значком, не является конечной и требует согласования с менеджером!', 'BasketModule');?>
	</div>
	<div class="info-notice-list__item">
		<svg class="info-notice-list__svg-icon"><use xlink:href="/_sysimg/svg/notice-sprite.svg#comment"></use></svg>
		<?=truc('комментарий к позиции', 'Forms');?>
	</div>
</div><?  ?>


			<?= $order['fields']['_prid']['html'] ?>
			<?= $order['fields']['subj']['html'] ?>
			<?= $order['fields']['ord_id']['html'] ?>
			<?= $order['fields']['ord_dcm_id']['html'] ?>
			<?= $order['fields']['ord_active']['html'] ?>
			<?= $order['fields']['ord_fixed']['html'] ?>
			<?= $order['fields']['hide_small_basket']['html'] ?>
			<?= $order['fields']['ord_source_id']['html'] ?>
			<?= $order['fields']['csc_id']['html'] ?>
		</div>

	</div>
</form>
<?  ?>

	<? } ?>

	<? $process_messages = &$order;?>
	<?  ?><? if (count($process_messages['messages']) > 0) {
	
	foreach($process_messages['messages'] as $message) { ?>

		<?=$message?>
		
	<? }

} ?><?  ?>

	<? else: ?>
		<div class="warning">
			<div class="warning_caption"><?=$MSG['Forms']['msg5']?></div>
			<div class="warning_text"><?= $ORDER_EMPTY ?></div>
		</div>
	<?endif ?>

<? } ?>
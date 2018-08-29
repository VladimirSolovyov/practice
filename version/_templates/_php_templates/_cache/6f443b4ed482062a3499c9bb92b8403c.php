<h1><?=$MSG['PaymentOnlineModule']['msg1']?></h1>

<div class="payment-online">
<?if ($check_require) {?>

	<?=$MSG['PaymentOnlineModule']['msg2']?>

<? } else {?>

	<div class="warning payment-online__warning">
		<div class="warning__text">
			<?=$MSG['PaymentOnlineModule']['msg3']?>
		</div>
	</div>

	<a class="btn payment-online__btn-back" href="<?= $_SERVER['HTTP_REFERER'] ?>"><?=$MSG['PaymentOnlineModule']['msg5']?></a>

	<div class="ar_form">
		<? ?><?= $selectOrder['validationScript'] ?>
<form id="<?= $selectOrder['id'] ?>" name="<?= $selectOrder['name'] ?>" action="<?= $selectOrder['action'] ?>"
	  method="<?= $selectOrder['method'] ?>" onsubmit="<?= $selectOrder['onsubmit'] ?>">
	<div class="row">
		<div class="col-xs-12 col-sm-10 col-md-8">
			<div class="universal-form__subgroup">

				<?
					$arConfigFields = [
						'v_dcm_id',
						'pmk_id',
					];
					if (isset($selectOrder['fields']['dcm_summ_custom'])) {
						$arConfigFields[] = 'dcm_summ_custom';
					} else {
						$arConfigFields[] = 'dcm_summ';
					}
					$universalFormConfig['secondw'] = true;
					$universalForm = &$selectOrder;
					 ?><?
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
<? 
				?>

				<? if (isset($selectOrder['fields']['dcm_summ_custom'])): ?>
					<div class="form-gr form-gr--secondw form-gr_horizontal_center">
						<label class="form-gr__label"><?= $selectOrder['fields']['dcm_summ_commision']['caption'] ?></label>
						<div id="dcm_summ_commision" class="form-gr__control"><?= $selectOrder['fields']['dcm_summ_commision']['html'] ?></div>
					</div>
					<div class="form-gr form-gr--secondw form-gr_horizontal_center">
						<label class="form-gr__label"><?= $selectOrder['fields']['dcm_summ_final']['caption'] ?></label>
						<div id="dcm_summ_final" class="form-gr__control"><?= $selectOrder['fields']['dcm_summ_final']['html'] ?></div>
					</div>
				<? endif ?>

				<!-- QIWI -->
				<? if ($selectOrder['fields']['to']) { ?>

					<div class="form-gr form-gr--secondw form-gr_horizontal_center">
						<div class="form-gr__label"><?= $MSG['PaymentOnlineModule']['msg4'] ?></div>
						<div class="form-gr__control"><?= $selectOrder['fields']['to']['html'] ?></div>
					</div>

				<? } ?>
				<!-- QIWI -->

				<?
				$excludeArray = array('v_dcm_id', 'pmk_id', 'dcm_summ_custom', 'dcm_summ', 'dcm_summ_commision', 'dcm_summ_final', 'summ', 'to', 'send_payment');
				?>
				<? foreach ((array)$selectOrder['sourceFields'] as $key => $value) { ?>

					<?if (in_array($key, $excludeArray) || strtolower(get_class($value['instance'])) == 'hidden') continue;?>

					<div class="form-gr form-gr--secondw form-gr_horizontal_center">
						<label class="form-gr__label" for="<?=$key?>"><?= $selectOrder['fields'][$key]['caption'] ?></label>
						<div class="form-gr__control"><?= $selectOrder['fields'][$key]['html'] ?></div>
					</div>

				<? } ?>

				<div class="form-gr form-gr--secondw form-gr_horizontal_center">
					<div class="form-gr__label"></div>
					<div class="form-gr__control"><?= $selectOrder['fields']['send_payment']['html'] ?></div>
				</div>

			</div>
		</div>
	</div>


	<? foreach ((array)$selectOrder['sourceFields'] as $key => $value) { ?>
		<? if (strtolower(get_class($value['instance'])) == 'hidden') { ?>

			<?= $selectOrder['fields'][$key]['html'] ?>

		<? } ?>
	<? } ?>
</form><? ?>
	</div>
	<br/>

	<?
	foreach ((array)$paymentData as $item) {

		if (!empty($item['pmk_description'])) {

			$translateDescription = tr(['pmk_description', $item['pmk_id']], 'payment_kinds');
			if (!empty($translateDescription)) {
				$item['pmk_description'] = $translateDescription;
			}

			$trBegin = strpos($item['pmk_description'], '<!--tr-->');
			$trEnd = strpos($item['pmk_description'], '<!--/tr-->');
			if ($trBegin !== false and $trEnd !== false) {
				$tr = substr($item['pmk_description'], $trBegin + 9, $trEnd - $trBegin - 9);
				$item['pmk_description'] = substr($item['pmk_description'], 0, $trBegin) . tr($tr, 'payment_kinds') . substr($item['pmk_description'], $trEnd + 10);
			}

			//для платежки webmoney применим замену
			if ($item['pmk_strid'] == 'webmoney') {

				$HTML = $item['WMID'] != '' ? '
<table border="">
	<tr>
		<td>
			<a href="http://passport.webmoney.ru/asp/certview4.asp?wmid=' . $item['WMID'] . '" target="_blank"><img align="left" src="/images/blue_rus.gif" alt="' . $item['WMID'] . '" border="0"/></a>
		</td>
		<td>
			<a href="http://passport.webmoney.ru/asp/certview4.asp?wmid=' . $item['WMID'] . '" target="_blank">'.tr('Проверить аттестат участника системы и наличие претензий', 'payment_kinds').'</a>
		</td>
	</tr>
</table>
				' : '';

				$item['pmk_description'] = str_replace(array(
					'{HTML}','{WMID}', '{LMI_PAYEE_PURSE}'
				),array(
					$HTML , $item['WMID'], $item['LMI_PAYEE_PURSE']
				),$item['pmk_description']);

			}

			echo $item['pmk_description'];
		}
	}
	?>

<? }?>

</div>
<h1><?=($MSG['RegistrationModule']['msg62'])?></h1>
<div id="registration_div">
<? if ($denied) { ?>
	<?=($MSG['RegistrationModule']['msg104'])?>
<? } else { ?>
	<? if ($personal['messages']) { ?>

		<? $process_messages = &$personal; ?>
		<?  ?><? if (count($process_messages['messages']) > 0) {
	
	foreach($process_messages['messages'] as $message) { ?>

		<?=$message?>
		
	<? }

} ?><?  ?>

	<? } else { ?>

		<?  ?><p><?=$MSG['RegistrationModule']['msg99']?></p>

<div class="row">
    <div class="col-xs-12 col-md-7">
        <? $registration_step = 3; ?>
        <?  ?><?php
$steps = [
    1 => tr('Заполнение анкеты', 'RegistrationModule'),
    2 => tr('Подтверждение', 'RegistrationModule'),
    3 => tr('Настройка аккаунта', 'RegistrationModule'),
];
?>
<? if (isset($registration_step) && isset($steps[$registration_step])) { ?>
    <ul class="registration-step flc">
        <? foreach ($steps as $key => $step) { ?>
            <li class="registration-step__item
                <?= ($key < $registration_step) ? 'registration-step__item_executed' : ''; ?>
                <?= ($key == $registration_step) ? 'registration-step__item_current' : ''; ?>
            ">
                <span class="registration-step__number"><?= tr('Шаг') . $key; ?></span>
                <span class="registration-step__desc"><?= $steps[$key] ?></span>
            </li>
        <? } ?>
    </ul>
<? } ?>
<?  ?>

		<?  ?><?=$personal['validationScript']?>
<form id="<?=$personal['name']?>" name="<?=$personal['name']?>" action="<?=$personal['action']?>" method="<?=$personal['method']?>" onsubmit="<?=$personal['onsubmit']?>">

    <?=$personal['fields']['subj']['html']?>
    <?=$personal['fields']['_prid']['html']?>
    <?=$personal['fields']['__cst_id__']['html']?>

	<div class="universal-form__subgroup">

		<div class="universal-form__group-title"><?=$MSG['RegistrationModule']['msg100']?></div>

		<?
		$universalForm = $personal;
		$arConfigFields = [
			'pmk_id'
		];
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

	</div>

	<div class="universal-form__subgroup">

		<div class="universal-form__group-title"><?=$MSG['RegistrationModule']['msg102']?></div>

		<? $registration = $personal; ?>

		<?  ?><div class="form-gr form-gr_horizontal_center universal-form__row">
	<div class="form-gr__label"></div>
	<div class="form-gr__control form-gr__control--checkbox">
		<div><?= $registration['fields']['news_subscription']['html'] ?></div>
		<div><?= $registration['fields']['notify_subscription']['html'] ?></div>
		<div><?= $registration['fields']['sms_notify_subscription']['html'] ?></div>
	</div>
</div><? ?>

	</div>

	<div class="form-gr form-gr_horizontal_center">
		<div class="form-gr__label"></div>
		<div class="form-gr__control registration-form__submit-control"><?=$personal['fields']['register']['html']?></div>
	</div>

</form>
<?  ?>

    </div>
</div><?  ?>

	<? } ?>
<? } ?>
</div>
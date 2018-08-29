<? if ($registration['messages']['registration_error_fields']) { ?>

	<?  ?><div class="message message_type_error message_view_outline">
	<div class="message__title"><?=$MSG['RegistrationModule']['msg63']?></div>
	<div class="message__text">
		<?=$MSG['RegistrationModule']['msg66']?>
		<?
		$group = 'registration';
		 ?><? $errors = Loader::getApi('registration')->getPossibleErrors($group); ?>
<? foreach ($errors as $key => $error) { ?>
	<? if ($registration['messages'][$key]) { ?>
		<?= $error['text'] ?>
	<? } ?>
<? } ?><? 
		?>
	</div>
</div><?  ?>

<? } elseif ($registration['messages']['registration_empty']) { ?>
	
	<?  ?><div class="message message_type_error message_view_outline">
	<div class="message__title"><?=$MSG['RegistrationModule']['msg63']?></div>
	<div class="message__text">
		<?=$MSG['RegistrationModule']['msg66']?>
	</div>
</div>
<?  ?>

<? } ?>

<? if ($registration['messages']['registration_success']) { ?>

	<?  ?><div class="warning">
	<div class="warning__caption"><?=tr('Регистрация завершена', 'RegistrationModule')?></div>
	<div class="warning__text">
		<p><?=tr('Вы успешно зарегистрировались в нашем магазине. Вам были высланы регистрационные данные для входа в магазин.', 'RegistrationModule')?></p>
		<p><?=tr('Желаем Вам приятной работы!', 'RegistrationModule')?></p>
	</div>
</div><?  ?>

<? } else { ?>

	<?  ?><div class="row">
	<div class="col-xs-12 col-md-7">
		<h1 class="registration__page-title"><?= ($MSG['RegistrationModule']['msg62']) ?></h1>
		<? if (!empty($authButtons)) { ?>
			<div class="social-reg registration__social-reg">
				<div class="social-reg__title">
					<?=tr('Зарегистрироваться через социальные сети', 'RegistrationModule') ?>
				</div>
				<div class="social-reg__buttons">
					<? foreach ($authButtons as $authButton) { ?>
						<?= $authButton ?>
					<? } ?>
				</div>
			</div>

		<? } ?>
		<div class="registration__descr">
			<p><?= tr('Для регистрации в интернет-магазине, пожалуйста, заполните данную анкету.', 'RegistrationModule') ?></p>
			<p><?= $MSG['RegistrationModule']['msg68'] ?> <a href="mailto:<?= $admin_email ?>"><?= $admin_email ?></a></p>
			<span class="registration__marking">— <?=tr('обязательные поля','RegistrationModule')?></span>
		</div>
		<? if ($_interface->csActivationRequired) { ?>
			<? $registration_step = 1; ?>
			<div>
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
			</div>
		<? } ?>
		<?  ?><?= $registration['validationScript'] ?>
<form id="<?= $registration['name'] ?>" class="form-inline" name="<?= $registration['name'] ?>" action="<?= $registration['action'] ?>" method="<?= $registration['method'] ?>" onsubmit="<?= $registration['onsubmit'] ?>">
	<?= $registration['fields']['subj']['html'] ?>
	<?= $registration['fields']['_prid']['html'] ?>
	<?= $registration['fields']['cst_created']['html'] ?>

	<?  ?><? if ($registration['fields']['is_organization']['html']) { ?>
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
</div><?  ?>

	<div class="universal-form__subgroup">

		<div class="universal-form__group-title">
			<?= tr('Данные авторизации', 'RegistrationModule') ?>
		</div>

		<?  ?><? if ($registration['fields']['userlogin'] or $registration['fields']['userpassword']) { ?>
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

	</div>

	<div class="universal-form__subgroup">

		<div id="tr_register" class="form-gr form-gr_horizontal_center">
			<div class="form-gr__label"></div>
			<div class="form-gr__control registration-form__submit-control"><?= $registration['fields']['register']['html'] ?></div>
		</div>
	</div>

	<? if ($registration['fields']['accept-politic']) { ?>

		<div class="universal-form__subgroup">
			<?
			$arConfigFields = [
				'accept-politic'
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

	<? } ?>

</form><?  ?>
	</div>
	<div class="col-md-5 visible-md visible-lg">
		<? ContentPart('registration__terms'); ?>
	</div>
</div><?  ?>

<? } ?>

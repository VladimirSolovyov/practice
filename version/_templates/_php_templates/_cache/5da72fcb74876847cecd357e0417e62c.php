<? if ($personal['messages']) { ?>

	<?  ?><? if($personal['messages']['success_message']) { ?>
	<div class="message message_type_success">
		<div class="message__text">
			<?=$personal['messages']['success_message']?>
		</div>
	</div>
<? } ?>

<? if($personal['messages']['success_password']) { ?>
	<div class="message message_type_success">
		<div class="message__text">
			<?=$personal['messages']['success_password']?>
		</div>
	</div>
<? } ?><?  ?>

<? } elseif ($personal['name'] == 'registration') { ?>

	<? $registration = & $personal; ?>

	<?  ?><h1><?= $MSG['PersonalInfoModule']['msg44'] ?></h1>

<? if ($_interface->csRestrictDataChange == true) { ?>
	<div class="message message_type_info">
		<div class="message__text">
			<?= $MSG['PersonalInfoModule']['msg48'] ?>
		</div>
	</div>
<? } ?>

<div class="row personal-info-registration__row">
	<div class="col-xs-12 col-md-8 col-lg-9">

		<? if ($_interface->csRestrictDataChange != true) { ?>

			<?= $registration['validationScript'] ?>
			<form id="<?= $registration['name'] ?>" name="<?= $registration['name'] ?>" action="<?= $registration['action'] ?>" method="<?= $registration['method'] ?>" onsubmit="<?= $registration['onsubmit'] ?>">

			<?= $registration['fields']['subj']['html'] ?>
			<?= $registration['fields']['_prid']['html'] ?>

			<?
				//хак чтобы проходил валидацию телефон
				$__BUFFER->AddJsInit("
					if(typeof window.registrationFormValidate != `undefined`) {
						window.registrationFormValidate.ajaxCheck = function(field, type) {
							if(field.name === 'contact_phone' && type === 'checkUserDB') {
								this.onElementSuccess(field);
							} else {
								this.__proto__.ajaxCheck(field, type);
							}
						};
					}
				");
			?>

		<? } else {

			foreach($registration['fields'] as $key => $field) {
				if(isset($registration['sourceFields'][$key]['instance'])) {
					if(!empty($registration['sourceFields'][$key]['instance']->value)) {
						$registration['fields'][$key]['html'] = $registration['sourceFields'][$key]['instance']->value;
					} else if(!empty($registration['sourceFields'][$key]['instance']->items[$registration['sourceFields'][$key]['instance']->value[0]])) {
						$registration['fields'][$key]['html'] = $registration['sourceFields'][$key]['instance']->items[$registration['sourceFields'][$key]['instance']->value[0]];
					} else {
						$registration['fields'][$key]['html'] = '';
					}
				}
			}

		 } ?>

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

	<? if ($registration['fields']['company']) { ?>
		<div id="companyName">
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
	'mobile_phone',
	'cst_email',
	'cst_icq',
	'cst_skype',
];
?><?  ?>
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

		<? if ($_interface->csRestrictDataChange != true) { ?>

				<div class="universal-form__subgroup">

					<div class="form-gr form-gr_horizontal_center">
						<div class="form-gr__label"></div>
						<div class="form-gr__control"><?= $registration['fields']['register']['html'] ?></div>
					</div>

				</div>

			</form>

		<? } ?>
	</div>
	<div class="col-xs-12 col-md-4 col-lg-3">
		<div class="info-box info-box--block">
			<div class="info-box__text">
				<div class="info-box__dat"><strong><?= $MSG['PersonalInfoModule']['msg49'] ?></strong></div>
				<div class="info-box__dat"><?=($stockInfo['fullname'] ? $stockInfo['fullname'] : $stockInfo['login'])?></div>
			</div>
			<a class="btn" href="mailto:<?= $stockInfo['email'] ?>"><?= $MSG['PersonalInfoModule']['msg50'] ?></a>
		</div>
	</div>
</div><?  ?>

<? } elseif ($personal['name'] == 'passwordForm') { ?>
	<? if (empty($csStrictRegistration)) {
		 ?><h1><?= $MSG['PersonalInfoModule']['msg45'] ?></h1>

<div class="row">
	<div class="col-xs-12 col-md-8 col-lg-6">
		<?= $personal['validationScript'] ?>
		<form id="<?= $personal['id'] ?>" name="<?= $personal['name'] ?>" action="<?= $personal['action'] ?>" method="<?= $personal['method'] ?>" onsubmit="<?= $personal['onsubmit'] ?>">
			<div class="universal-form__subgroup">
				<?
				$arConfigFields = [
					'userpassword_old',
					'userpassword_new',
					'userpassword_new_repeat',
				];
				$universalFormConfig['secondw'] = true;
				$universalForm = &$personal;
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
				<div class="form-gr form-gr--secondw form-gr_horizontal_center">
					<div class="form-gr__label"></div>
					<div class="form-gr__control"><?= $personal['fields']['save_password']['html'] ?></div>
				</div>
			</div>

			<?= $personal['fields']['subj']['html'] ?>
			<?= $personal['fields']['_prid']['html'] ?>

		</form>
	</div>
</div><? 
	} else {
		echo $csStrictRegistration;
	}
	?>
<? } elseif ($personal['name'] == 'paydel') { ?>

	<?  ?><h1><?= $MSG['PersonalInfoModule']['msg47'] ?></h1>

<div class="row">
	<div class="col-xs-12 col-md-10">
		<?= $personal['validationScript'] ?>
		<form id="<?= $personal['id'] ?>" name="<?= $personal['name'] ?>" action="<?= $personal['action'] ?>" method="<?= $personal['method'] ?>" onsubmit="<?= $personal['onsubmit'] ?>">

			<div class="universal-form__subgroup">
				<?
				$arConfigFields = [
					'pmk_id',
					'dlv_id',
					'fake_percent',
				];
				$universalFormConfig['secondw'] = true;
				$universalForm = &$personal;
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
				<div class="form-gr form-gr--secondw form-gr_horizontal_center">
					<div class="form-gr__label"></div>
					<div class="form-gr__control"><?= $personal['fields']['register']['html'] ?></div>
				</div>
			</div>

			<?= $personal['fields']['subj']['html'] ?>
			<?= $personal['fields']['_prid']['html'] ?>

		</form>
	</div>
</div><?  ?>

<? } elseif ($personal['name'] == 'notifies') { ?>

	<?  ?><h1><?= $MSG['PersonalInfoModule']['msg51'] ?></h1>

<div class="row">
	<div class="col-xs-12 col-md-8">
		<?= $personal['validationScript'] ?>
		<form id="<?= $personal['id'] ?>" name="<?= $personal['name'] ?>" action="<?= $personal['action'] ?>" method="<?= $personal['method'] ?>" onsubmit="<?= $personal['onsubmit'] ?>">

			<div class="universal-form__subgroup">

				<div class="form-gr form-gr--secondw form-gr_horizontal_center universal-form__row">
					<label for="news_subscription" class="form-gr__label"><?= $personal['fields']['news_subscription']['caption'] ?></label>
					<div class="form-gr__control">
						<?= $personal['fields']['news_subscription']['html'] ?>
					</div>
				</div>

				<div class="form-gr form-gr--secondw form-gr_horizontal_center universal-form__row">
					<label class="form-gr__label"></label>
					<div class="form-gr__control">
						<?= $personal['fields']['notify_subscription']['html'] ?>
					</div>
				</div>

				<div class="form-gr form-gr--secondw form-gr_horizontal_center universal-form__row">
					<label for="sms_notify_subscription" class="form-gr__label"><?= $personal['fields']['sms_notify_subscription']['caption'] ?></label>
					<div class="form-gr__control">
						<?= $personal['fields']['sms_notify_subscription']['html'] ?>
					</div>
				</div>

				<div class="form-gr form-gr--secondw form-gr_horizontal_center">
					<div class="form-gr__label"></div>
					<div class="form-gr__control"><?= $personal['fields']['register']['html'] ?></div>
				</div>

			</div>

			<?= $personal['fields']['subj']['html'] ?>
			<?= $personal['fields']['_prid']['html'] ?>

		</form>
	</div>
</div>
<?  ?>

<? } else { ?>

	<?  ?><div id="lk_div" class="flc">

	<div id="lk_links_div" class="leftside">

		<h1><?= $MSG['PersonalInfoModule']['msg43'] ?></h1>

		<div class="lk_info">
			<div class="lk_caption lk_caption--basket" ><a href="/shop/basket.html"><?= $MSG['PersonalInfoModule']['msg52'] ?></a></div>
			<div class="lk_basket">
				<?= $MSG['PersonalInfoModule']['msg53'] ?>: <span><?= $eshopBasket->waresCount() ?></span>
				<?= $MSG['PersonalInfoModule']['msg54'] ?>:
				<span><?= $eshopBasket->getSumm($eshopBasket->money->money[$_interface->displayedCurInfo['id']], (float)$eshopClient->fake_percent != 0 ? (100 + $eshopClient->fake_percent) / 100 : 1) ?></span>
			</div>
		</div>

		<div class="lk_info ">
			<div class="lk_caption lk_caption--account" ><?= $MSG['PersonalInfoModule']['msg55'] ?></div>
			<div class="flc">
				<ul>
					<? if($contactsLink) {?><li><?= $contactsLink ?></li><? } ?>
					<? if($changePassword) {?><li><?= $changePassword ?></li><? } ?>
					<? if($changePayDelLink) {?><li><?= $changePayDelLink ?></li><? } ?>
					<? if($changeNotifies) {?><li><?= $changeNotifies ?></li><? } ?>
					<li><a href="/shop/personal/payers.html"><?= $MSG['PersonalInfoModule']['msg56'] ?></a></li>
					<li><a href="/shop/personal/cars.html"><?= $MSG['PersonalInfoModule']['msg57'] ?></a></li>
					<li><a href="/shop/personal/delivery.html"><?= $MSG['PersonalInfoModule']['msg58'] ?></a></li>
				</ul>
			</div>
		</div>

		<div class="lk_info">
			<div class="lk_caption lk_caption--orders"><?= $MSG['PersonalInfoModule']['msg59'] ?></div>
			<div class="flc">
				<ul>
					<li><a href="/shop/myorders.html"><?= $MSG['PersonalInfoModule']['msg60'] ?></a></li>
					<li><a href="/shop/documents.html"><?= $MSG['PersonalInfoModule']['msg61'] ?></a></li>
					<li><a href="/shop/balance.html"><?= $MSG['PersonalInfoModule']['msg62'] ?></a></li>
				</ul>
			</div>
		</div>

		<div class="lk_info">
			<div class="lk_caption lk_caption--vin"><?= $MSG['PersonalInfoModule']['msg63'] ?></div>
			<div class="flc">
				<ul>
					<li><a href="/vin/form.html"><?= $MSG['PersonalInfoModule']['msg64'] ?></a></li>
					<li><a href="/shop/vin_requests.html"><?= $MSG['PersonalInfoModule']['msg65'] ?></a></li>
				</ul>
			</div>
		</div>

		<div class="lk_info">
			<div class="lk_caption lk_caption--help"><?= $MSG['PersonalInfoModule']['msg66'] ?></div>
			<div class="flc">
				<ul>
					<li><a href="/help/"><?= $MSG['PersonalInfoModule']['msg67'] ?></a></li>
					<li><a href="/message/"><?= $MSG['PersonalInfoModule']['msg68'] ?></a></li>
				</ul>
			</div>
		</div>

	</div>

	<div id="lk_rightinfo" class="leftside">

		<div id="lk_rinfo">
			<div class="lk_caption lk_caption--info"><?= $MSG['PersonalInfoModule']['msg69'] ?></div>
			<div class="flc">
				<div class="leftside iname"><?= $MSG['PersonalInfoModule']['msg70'] ?></div>
				<div class="leftside ivalue"><?= $eshopClient->cst_id ?></div>
			</div>
			<div class="flc" id="div_cst_name">
				<div class="leftside iname"><?= $MSG['PersonalInfoModule']['msg71'] ?></div>
				<div class="leftside ivalue"><?= $eshopClient->name ?></div>
			</div>
			<div class="flc" id="div_cst_fake_percent">
				<div class="leftside iname"><?= $MSG['PersonalInfoModule']['msg72'] ?></div>
				<div class="leftside ivalue"><?= (float)$eshopClient->fake_percent ?>%</div>
			</div>
			<div class="flc" id="div_mng_fullname">
				<div class="leftside iname"><?= $MSG['PersonalInfoModule']['msg73'] ?></div>
				<div class="leftside ivalue"><?= $stockInfo['fullname'] ?></div>
			</div>
			<div class="flc" id="div_stc_name">
				<div class="leftside iname"><?= $MSG['PersonalInfoModule']['msg74'] ?></div>
				<div class="leftside ivalue"><?= $stockInfo['stc_name'] ?></div>
			</div>
			<div class="flc" id="div_cst_max_debt">
				<div class="leftside iname"><?= $MSG['PersonalInfoModule']['msg75'] ?></div>
				<div class="leftside ivalue"><?= $eshopClient->max_debt ?></div>
			</div>
		</div>

		<div id="lk_rcontacts">
			<div class="lk_caption lk_caption--contacts"><?= $MSG['PersonalInfoModule']['msg76'] ?>
				<div id="lk_edit_link"><?= $changeLink ?></div>
			</div>
			<div class="flc" id="div_contact_surname">
				<div class="leftside iname"><?= $MSG['PersonalInfoModule']['msg77'] ?></div>
				<div class="leftside ivalue"><?= ($eshopClient->contact_surname . ' ' . $eshopClient->contact_first_name . ' ' . $eshopClient->contact_patronymic_name) ?></div>
			</div>
			<div class="flc" id="div_mobile_phone">
				<div class="leftside iname"><?= $MSG['PersonalInfoModule']['msg78'] ?></div>
				<div class="leftside ivalue">
					<span><?= $eshopClient->contact_phone ?><?= ($eshopClient->mobile_phone ? '<br />' . $eshopClient->mobile_phone : '') ?></span>
				</div>
			</div>
			<div class="flc" id="div_cst_email">
				<div class="leftside iname"><?= $MSG['PersonalInfoModule']['msg79'] ?></div>
				<div class="leftside ivalue">
					<a href="mailto:<?= $eshopClient->cst_email ?>"><?= $eshopClient->cst_email ?></a></div>
			</div>

			<? if(!empty($eshopClient->cst_icq)):?>
				<div class="flc" id="div_cst_icq">
					<div class="leftside iname"><?= $MSG['PersonalInfoModule']['msg80'] ?></div>
					<div class="leftside ivalue"><?= $eshopClient->cst_icq ?></div>
				</div>
			<? endif; ?>

			<? if(!empty($eshopClient->cst_skype)):?>
				<div class="flc" id="div_cst_skype">
					<div class="leftside iname"><?= $MSG['PersonalInfoModule']['msg81'] ?></div>
					<div class="leftside ivalue"><?= $eshopClient->cst_skype ?></div>
				</div>
			<? endif; ?>
		</div>

	</div>

</div><?  ?>

<? } ?>
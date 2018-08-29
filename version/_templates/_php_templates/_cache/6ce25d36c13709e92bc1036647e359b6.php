<?=$MSG['MakeOrderModule']['msg68']?>

<? if ($order['messages']['registration_error_email']) { ?>

	<div class="notice"><?=tr('К сожалению, указанный Вами e-mail уже зарегистрирован','MakeOrderModule')?></div>

<?}?>

<? if ($order['messages']['registration_error_incorect_contact_phone']) { ?>
	<div class="notice"><?=tr('Данный контактный телефон уже используется на сайте', 'RegistrationModule')?></div>
<? } ?>
	
<? if ($order['messages']['registration_error']) { ?>
	
	<h2><?=$MSG['MakeOrderModule']['msg76']?></h2>

	<p><span id="form_required_field"><?=$MSG['MakeOrderModule']['msg77']?></span></p>

	<?  ?><script type="text/javascript">

	jqWar('document').ready(function () {

		jqWar('#setCustomersDirectory').on('click', function () {
			cstId = jqWar('#cst_id').val();
			if (!cstId)
				cstId = 0;
			rsDirectoryCustomerControl = jqWar('#dcm_cst_id');
			if (rsDirectoryCustomerControl.length)
				rsDirectoryCustomerControl.val(cstId);
			update_func();
		});

		setTimeout(
			function () {
				jqWar('.custom-combobox').on('focusout', function () {
						if (jqWar('#cst_id').val() !== '') {
							jqWar('#setCustomersDirectory').click();
						}
					}
				)
			}, 500
		);
		jqWar("input[name=save_order]").click(function () {
			var summ = '<?=$SUMM_value?>';
			var prepay = jqWar("#prepayment").val();

			if (isNaN(prepay)) {
				alert('Неправильно введена сумма предоплаты. Сумма предоплаты должна быть числом.');
				return false;
			}
			if (parseFloat(summ) < parseFloat(prepay)) {
				alert('Сумма предоплаты не может быть больше суммы заказа');
				return false;
			}

		});
		jqWar('#prepayment').on('keyup',function(){

				var prepay = this.value;

				if(parseFloat(prepay)>0) {
					var hardCash = 1;
					jqWar('#ord_pmk_id').val(hardCash);
				}

		});
		rsDirectories = jqWar('nobr .rsDirectory');
		if (rsDirectories.length) {
			rsSiblings = jqWar(rsDirectories.siblings().andSelf());
			if (rsSiblings.length) {
				rsSiblings.not('#ord_csc_id_viewState').hide();
				rsDirectories.after('<img src="/images/address-book-icon.png" align="absmiddle" style="cursor: pointer;">');
			}
		}

	});

</script>

<?= $order['validationScript'] ?>

<form id="<?= $order['id'] ?>" name="<?= $order['name'] ?>" action="<?= $order['action'] ?>" method="<?= $order['method'] ?>" onsubmit="<?= $order['onsubmit'] ?>">

	<? if ($MESSAGE_CLIENT_DEALER === true) { ?>

		<div class="notice"><?= tr('Внимание! Вами формируется заказ на клиента торговой точки - дилера, но цена закупа позиций рассчитана как для торговых точек - филиалов. При необходимости, скорректируйте цены закупа вручную.', 'MakeOrderModule') ?></div>

	<? } ?>

	<table border="0" width="100%">
		<? if ($order['fields']['dcm_cst_id']) { ?>

			<tr>
				<td>
					<nobr><?= $order['fields']['dcm_cst_id']['caption'] ?></nobr>
				</td>
				<td>
					<table>
						<tr>
							<td>
								<?= $order['fields']['cst_id']['html'] ?>
							</td>
							<td>
								<span id="setCustomersDirectory" style="cursor:pointer;color:#00457A">Применить</span>
							</td>
							<td>
								<?= $order['fields']['dcm_cst_id']['html'] ?>
							</td>
						</tr>
					</table>
				</td>
			</tr>

			<tr>
				<td>
					<nobr><?= $order['fields']['ord_csc_id']['caption'] ?></nobr>
				</td>
				<td><?= $order['fields']['ord_csc_id']['html'] ?>
					<br/>
					<?= $cars_link ?>
				</td>
			</tr>
			<tr>
				<td height="10" colspan="2"></td>
			</tr>

		<? } ?>
		<? if ($order['fields']['ord_contact_person']) { ?>

			<?  ?><tr><td colspan="2"><h3><?=$MSG['MakeOrderModule']['msg69']?><hr noshade="noshade" size="1"/></h3></td></tr>

<tr>
	<td><nobr><?=$order['fields']['ord_contact_person']['caption']?></nobr></td>
	<td><?=$order['fields']['ord_contact_person']['html']?></td>
</tr>

<tr>
	<td><nobr><?=$order['fields']['ord_phones']['caption']?></nobr></td>
	<td><?=$order['fields']['ord_phones']['html']?></td>
</tr>

<tr>
	<td><nobr><?=$order['fields']['ord_email']['caption']?></nobr></td>
	<td><?=$order['fields']['ord_email']['html']?></td>
</tr>

<tr><td colspan="2"><h3 style="margin-top: 15px"><?=$MSG['MakeOrderModule']['msg70']?><hr noshade="noshade" size="1"/></h3></td></tr>

<tr>
	<td><?=$order['fields']['ord_pmk_id']['caption']?></td>
	<td><?=$order['fields']['ord_pmk_id']['html']?></td>
</tr>

<tr>
	<td><?=$order['fields']['ord_pyr_id']['caption']?></td>
	<td><?=$order['fields']['ord_pyr_id']['html']?></td>
</tr>

<tr>
	<td><nobr><?=$order['fields']['ord_dlv_id']['caption']?></nobr></td>
	<td><?=$order['fields']['ord_dlv_id']['html']?></td>
</tr>

<tbody id="delivery"<?=($hide_deliveries?' style="'.$hide_deliveries.'"':'')?>>

<tr><td colspan="2"><h3 style="margin-top: 15px"><?=$MSG['MakeOrderModule']['msg86']?><hr noshade="noshade" size="1"/></h3></td></tr>

<? if ($order['fields']['ord_address']) { ?>

	<tr>
		<td><?=$order['fields']['ord_address']['caption']?></td>
		<td><?=$order['fields']['ord_address']['html']?></td>
	</tr>

<? } else { ?>

	<tr>
		<td><?=$order['fields']['ord_add_id']['caption']?></td>
		<td><?=$order['fields']['ord_add_id']['html']?></td>
	</tr>
		<tbody id="delivery_new_address" style="<?=($order['sourceFields']['ord_add_id']['instance']->value[0]>0?'display: none;':'')?> <?=$hide_deliveries?>">

		<? $address_form = &$order; ?>
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
		
		</tbody>

<? } ?>
</tbody>

<tr>
	<td><nobr><?=$order['fields']['ord_comment']['caption']?></nobr></td>
	<td><?=$order['fields']['ord_comment']['html']?></td>
</tr><?  ?>

		<? } ?>

		<? if ($order['fields']['company']) { ?>

			<?  ?><?=$order['fields']['__cst_id__']['html']?>
 
<tr><td colspan="2"><h3><?=$MSG['MakeOrderModule']['msg71']?></h3></td></tr>

<tr>
	<td><?=$order['fields']['is_organization']['caption']?></td>
	<td><?=$order['fields']['is_organization']['html']?></td>
</tr>

<tbody id="companyName"<?=($is_organization?'':' style="display: none"')?>>

<? if($order['fields']['company']) { ?>
	
	<tr>
		<td><span id="form_required_field"><?=$order['fields']['company']['caption']?></span></td>
		<td><?=$order['fields']['company']['html']?></td>
	</tr>

<? } ?>

</tbody>

<tr>
	<td><?=$order['fields']['contact_first_name']['caption']?></td>
	<td><?=$order['fields']['contact_first_name']['html']?></td>
</tr>

<tr>
	<td><?=$order['fields']['contact_patronymic_name']['caption']?></td>
	<td><?=$order['fields']['contact_patronymic_name']['html']?></td>
</tr>

<tr>
	<td><?=$order['fields']['contact_surname']['caption']?></td>
	<td><?=$order['fields']['contact_surname']['html']?></td>
</tr>

<? $address_form = &$order; ?>
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

<tr>
	<td><?=$order['fields']['cst_city_code']['caption']?></td>
	<td><?=$order['fields']['cst_city_code']['html']?></td>
</tr>

<tr>
	<td><?=$order['fields']['contact_phone']['caption']?>, <?=$order['fields']['fax']['caption']?></td>
	<td><?=$order['fields']['contact_phone']['html']?> <?=$order['fields']['fax']['html']?></td>
</tr>

<tr>
	<td><?=$order['fields']['mobile_phone']['caption']?></td>
	<td><?=$order['fields']['mobile_phone']['html']?></td>
</tr>

<tr>
	<td><?=$order['fields']['cst_email']['caption']?></td>
	<td><?=$order['fields']['cst_email']['html']?></td>
</tr>

<tr>
	<td><?=$order['fields']['cst_icq']['caption']?></td>
	<td><?=$order['fields']['cst_icq']['html']?></td>
</tr>

<tr>
	<td><?=$order['fields']['cst_skype']['caption']?></td>
	<td><?=$order['fields']['cst_skype']['html']?></td>
</tr>
<tr><td colspan="2"><h3 style="margin-top: 15px"><?=$MSG['MakeOrderModule']['msg72']?></h3></td></tr>

<tr>
	<td><?=$order['fields']['cst_csa_id']['caption']?></td>
	<td><?=$order['fields']['cst_csa_id']['html']?></td>
</tr>

<tr>
	<td><?=$order['fields']['pmk_id']['caption']?></td>
	<td><div id="combo_pmk_id"><?=$order['fields']['pmk_id']['html']?></div></td>
</tr>

<tr>
	<td><?=$order['fields']['stc_id']['caption']?></td>
	<td><?=$order['fields']['stc_id']['html']?></td>
</tr>

<tr>
	<td><?=$order['fields']['dlv_id']['caption']?></td>
	<td><?=$order['fields']['dlv_id']['html']?></td>
</tr>

<tbody id="delivery"<?=($hide_deliveries?' style="'.$hide_deliveries.'"':'')?>>

<tr><td colspan="2"><h3 style="margin-top: 15px"><?=$MSG['MakeOrderModule']['msg86']?><hr noshade="noshade" size="1"/></h3></td></tr>

<tbody id="delivery_new_address"<?=($hide_deliveries?' style="'.$hide_deliveries.'"':'')?>>

<? $address_form = &$order; ?>
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

</tbody>

</tbody>
<tr>
	<td valign="top"><?=$order['fields']['news_subscription']['caption']?></td>
	<td>

	<table border="0">

		<tr>
			<td><?=$order['fields']['notify_subscription']['html']?></td>
			<td><?=$order['fields']['news_subscription']['html']?></td>
		</tr>

		<tr>
			<td><?=$order['fields']['stock_subscription']['html']?></td>
			<td><?=$order['fields']['balance_subscription']['html']?></td>
		</tr>

		<tr>
			<td><?=$order['fields']['offers_subscription']['html']?></td>
			<td><?=$order['fields']['saleoff_subscription']['html']?></td>
		</tr>

	</table>

	</td>
</tr>

<tr>
	<td valign="top"><?=$order['fields']['sms_notify_subscription']['caption']?></td>
	<td>

	<table border="0">
		<tr>
			<td><?=$order['fields']['sms_notify_subscription']['html']?></td>
			<td></td>
		</tr>
	</table>

	</td>
</tr>

<? if ($order['fields']['fake_percent']) { ?>

<tr class="even">
	<td>
		<?=$order['fields']['fake_percent']['caption']?><br/>
		<small><i><?=$MSG['RegistrationModule']['msg59']?></i></small>
	</td>
	<td><?=$order['fields']['fake_percent']['html']?></td>
</tr>

<? } ?>

<tr><td colspan="2"><h3 style="margin-top: 15px"><?=$MSG['MakeOrderModule']['msg73']?></h3></td></tr>

<tr>
	<td><?=$order['fields']['userlogin']['caption']?></td>
	<td><?=$order['fields']['userlogin']['html']?></td>
</tr>

	
<tr>
	<td><?=$order['fields']['userpassword']['caption']?>, <?=$order['fields']['userpassword_repeat']['caption']?></td>
	<td><?=$order['fields']['userpassword']['html']?> <?=$order['fields']['userpassword_repeat']['html']?></td>
</tr><?  ?>
		<? } ?>
		<tr>
			<td>
				<nobr><?= $order['fields']['prepayment']['caption'] ?></nobr>
			</td>
			<td><?= $order['fields']['prepayment']['html'] ?></td>
		</tr>

		<? if ($order['fields']['self_order']) { ?>
			<div class="notice">
				<strong><?= tr('Внимание!', 'Common') ?></strong> <?= tr('Заказ будет разделен по поставщикам!', 'MakeOrderModule') ?>
			</div>
		<? } ?>

		<?  ?><tr>
	<td colspan="2">
		<h3 style="margin-top: 15px"><?= $MSG['MakeOrderModule']['msg74'] ?>
			<hr noshade="noshade" size="1"/>
		</h3>
	</td>
</tr>

<tr>
	<td colspan="2">

		<? $web_ar_datagrid = & $order['fields']['basket']['html']; ?>
		<? $data_align = array('center', 'center', 'center', 'center', 'center', 'center', 'center', 'center', 'center', 'center', 'center', 'center', 'center'); ?>
		<? foreach ($web_ar_datagrid['data'] as $rkey => $row) {
			foreach ($row as $key => $value) {

				switch ($key) {

					case 'article':
					{
						$web_ar_datagrid['data'][$rkey][$key] = '<nobr>' . $web_ar_datagrid['data'][$rkey][$key] . '</nobr>';
					}
						break;

					case 'price':
					{
						if ((float)$web_ar_datagrid['data'][$rkey]['price_value'] == 0) {
							$web_ar_datagrid['data'][$rkey][$key] = $MSG['MakeOrderModule']['msg78'];
						}
						if ($web_ar_datagrid['data'][$rkey]['phand_value'] != 0) {
							$web_ar_datagrid['data'][$rkey][$key] .= '<br/><small><span id="phand">' . $MSG['MakeOrderModule']['msg78'] . '&nbsp;' . $web_ar_datagrid['data'][$rkey]['detail_phand'] . '</span></small>';
						}
					}
						break;

					case 'summ':
					{
						if ((float)$web_ar_datagrid['data'][$rkey]['price_value'] == 0) {
							$web_ar_datagrid['data'][$rkey][$key] = $MSG['MakeOrderModule']['msg78'];
						}
						if ($web_ar_datagrid['data'][$rkey]['phand_value'] != 0) {
							$web_ar_datagrid['data'][$rkey][$key] .= '<br/><small><span id="phand">' . $MSG['MakeOrderModule']['msg78'] . '&nbsp;' . $web_ar_datagrid['data'][$rkey]['phand_summ'] . '</span></small>';
						}
					}
						break;

					case 'cost_per_weight_display':
					{
						if (($web_ar_datagrid['data'][$rkey]['cost_per_weight'] > 0) && ((float)$web_ar_datagrid['data'][$rkey]['weight'] == 0)) {
							$web_ar_datagrid['data'][$rkey][$key] = '+ ' . $web_ar_datagrid['data'][$rkey][$key] . '/' . $MSG['BasketModule']['msg44'];
						} else {
							$web_ar_datagrid['data'][$rkey][$key] = '&nbsp;';
						}
					}
						break;

					case 'info':
					{
						if (($web_ar_datagrid['data'][$rkey]['cost_per_weight'] > 0) && ((float)$web_ar_datagrid['data'][$rkey]['weight'] == 0)) {
							$web_ar_datagrid['data'][$rkey][$key] = '<img src="/_sysimg/ar2/cdelivery.gif" alt="' . $MSG['BasketModule']['msg9'] . '" title="' . $MSG['BasketModule']['msg9'] . '" />';
						} else {
							$web_ar_datagrid['data'][$rkey][$key] = '&nbsp;';
						}
					}
						break;

					default:
						{

						}
						break;

				}

			}

		}
		?>
		<?  ?>
	<div class="flc">
		<? if (count($web_ar_datagrid['controls'])>0) { ?>
			<? $i=0; ?>
			<? foreach ($web_ar_datagrid['controls'] as $hdr_id=>$control) { ?>

				<? if ((empty($control_align[$i])) or ($control_align[$i] == 'top')) { ?>

					<div class="table_control <?=($hdr_id=='pagination'?'rightside':'leftside')?>"><?=$control?></div>

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

	<table class="web_ar_datagrid <?=$web_ar_datagrid['info']['name']?>" width="100%">
		<tr>
			<? $col_num = 0; $total_begin = 0; ?>
			<? foreach ($web_ar_datagrid['header'] as $hdr_id=>$column) {	?>

				<? if ($column['visible'] != '1') continue; ?>

				<th class="col_<?=$hdr_id?>">

					
					<? if (!empty($column['clm_info'])) { ?>
						<span class="tipz" title="<?=$column['clm_info']?>"></span>
					<? } ?>

					<?=$column['caption']?>

				</th>

				<? if ((empty($web_ar_datagrid['total'][$hdr_id])) && ($total_begin == $col_num)) { ?>
					<? $total_begin++; ?>
				<? } ?>

				<? $col_num++; ?>
			<? } ?>
		</tr>

		
		<? if ($captionFilter) { ?>

			<tr class="filter_row">
				<? foreach ($web_ar_datagrid['header'] as $hdr_id=>$column) {	?>

					<? if ($column['visible'] != '1') continue; ?>

					<td class="col_<?=$hdr_id?>">
						
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
					</td>

				<? } ?>
			</tr>

		<? } ?>

		<? if ((count($web_ar_datagrid['data']) > 0)) { ?>
			<? foreach ($web_ar_datagrid['data'] as $row=>$item) { ?>

				<tr class="<?=toggleEvenOdd()?>">

					<? $i=0; ?>
					<? foreach ($web_ar_datagrid['header'] as $hdr_id=>$column) {	?>

						<? if ($column['visible'] != '1') continue; ?>

						<td class="col_<?=$hdr_id?>"<?=(!empty($data_align[$i])?' align="'.$data_align[$i].'"':'')?>><?=$item[$hdr_id]?></td>

						<? $i++; ?>

					<? } ?>

				</tr>

			<? } ?>
		<? } else { ?>
			<tr class="<?=toggleEvenOdd()?>">
				<td class="col_empty" colspan="<?=$col_num?>" align="center"><?=$MSG['Common']['msg4']?></td>
			</tr>
		<? } ?>

		
		<? if (count($web_ar_datagrid['total']) > 0) { ?>
			<tr class="row_total">
				<? if ($total_begin > 0) { ?>
					<td colspan="<?=$total_begin?>" class="col_total"><?=$MSG['Common']['msg5']?></td>
				<? } ?>
				<? foreach ($web_ar_datagrid['header'] as $hdr_id=>$column) {	?>

					<? if (($column['visible'] != '1') or ((++$total_counter <= $total_begin) && ($total_begin != 0))) continue; ?>

					<td class="col_<?=$hdr_id?>"><?=$web_ar_datagrid['total'][$hdr_id]?></td>

				<? } ?>
			</tr>
		<? } ?>
	</table>
	<? if (!empty($PHP_TEMPLATE['captionFilter_'.$web_ar_datagrid['info']['name']])) { ?>

		</form>

	<? } ?>

<? } else { ?>

	<p><?=$empty_message?></p>

<? } ?>


<? if (count($web_ar_datagrid['controls'])>0) { ?>
	<? $i=0; ?>
	<? foreach ($web_ar_datagrid['controls'] as $hdr_id=>$control) { ?>

		<? if ($control_align[$i] == 'bottom') { ?>

			<div class="table_control"><?=$control?></div>

		<? } ?>

		<? $i++; ?>

	<? } ?>
<? } ?><?  ?>

		<?= $order['fields']['chPos']['html'] ?>

	</td>
</tr><?  ?>

		<tr>
			<td colspan="2" height="60">
				<?  ?><table border="0" width="100%" class="ar2_basket_info">
	<tr class="header2" height="40" align="center">
		<td colspan="2">

			<strong><?=$MSG['MakeOrderModule']['msg75']?>
			&nbsp;<?=$total_summ?>
			</strong>
			
			<style type="text/css">
				.float_string {
					display:inline;
				}
			</style>
			&nbsp;<span id="deliveryDiv"></span>

			<script language="JavaScript">
		
				function calcDelivery() {		
					
					<? if (($order['fields']['ord_add_id']) or ($order['fields']['ord_add_city_id']) or ($order['fields']['ord_address'])) { ?>
	 		 
	 		 		formObj = document.forms['order'];
	 		 		dlv_idValue = formObj.ord_dlv_id?formObj.ord_dlv_id.value:formObj.dlv_id.value;
	 		 		add_idValue = formObj.ord_add_id?formObj.ord_add_id.value:"";

					add_city_idValue = formObj.ord_add_city_id?formObj.ord_add_city_id.value:"";
					add_city_idValue = formObj.add_city_id?formObj.add_city_id.value:add_city_idValue;
	 		 		add_district_idValue = formObj.ord_add_district_id?formObj.ord_add_district_id.value:"";
	 		 		add_district_idValue = formObj.add_district_id?formObj.add_district_id.value:add_district_idValue;
	 		 
					var url = "/_ajax/calcDelivery.html?admin_calc=1&dcm_id=" + <?=$order['sourceFields']['ord_dcm_id']['instance']->value?> + "&dlv_id=" + dlv_idValue + "&cty_id=" + add_city_idValue + "&dst_id=" + add_district_idValue + "&add_id=" + add_idValue + "&chPos=<?=$order['sourceFields']['chPos']['instance']->value?>";
						
					
					$('deliveryDiv').load(url);	

					<? } ?>

				}									
				
			</script>
				
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<? if ($MIN_ORDER_SUMM): ?>
				<div class="notice">
					<div class="notice_caption"><?= $MSG['Forms']['msg5'] ?></div>
					<div class="notice_text"><?= $MSG['BasketModule']['msg39'] ?>:
						<span class="notice_value"><?= $MIN_ORDER_SUMM ?></span>
						<br/><?= tr($MSG['BasketModule']['msg40'], 'BasketModule') ?>
					</div>
				</div>
			<? endif ?>
		</td>
	</tr>

	<? if (isset($RESTRICT_DEBT_SUMM)) { ?>
		<tr>
			<td colspan="2">
				<div class="notice">
					<div class="warning_caption"><?= $MSG['Forms']['msg5'] ?></div>
					<div class="warning_text"><?= $MSG['BasketModule']['msg43'] ?>
						<span class="warning_value"><?= $MAX_DEBT_SUMM ?></span></div>
				</div>
			</td>
		</tr>
	<? } ?>

	<tr>
		<td width="50%">
			<?=$order['fields']['edit']['html']?>
			<?=$order['fields']['cancel']['html']?>
		</td>
			
		<td align="right" width="50%">
		
		<? if((!isset($MIN_ORDER_SUMM)) && (!isset($RESTRICT_DEBT_SUMM))) { ?>
			<?=$order['fields']['save_order']['html']?>
		<? } ?>
		
		</td>
	</tr>
</table><?  ?>
			</td>
		</tr>

		<?= $order['fields']['_prid']['html'] ?>
		<?= $order['fields']['subj']['html'] ?>
		<?= $order['fields']['ord_id']['html'] ?>
		<?= $order['fields']['ord_dcm_id']['html'] ?>
		<?= $order['fields']['ord_active']['html'] ?>
		<?= $order['fields']['ord_fixed']['html'] ?>
		<?= $order['fields']['hide_small_basket']['html'] ?>
		<?= $order['fields']['ord_source_id']['html'] ?>
		<?= $order['fields']['self_order']['html'] ?>

		<script language="JavaScript">

			calcDelivery();

		</script>

	</table>
</form><?  ?>

<? } else { ?>
	
	<? if($order['name'] == 'order') { ?>
		<?  ?><script type="text/javascript">

	jqWar('document').ready(function () {

		jqWar('#setCustomersDirectory').on('click', function () {
			cstId = jqWar('#cst_id').val();
			if (!cstId)
				cstId = 0;
			rsDirectoryCustomerControl = jqWar('#dcm_cst_id');
			if (rsDirectoryCustomerControl.length)
				rsDirectoryCustomerControl.val(cstId);
			update_func();
		});

		setTimeout(
			function () {
				jqWar('.custom-combobox').on('focusout', function () {
						if (jqWar('#cst_id').val() !== '') {
							jqWar('#setCustomersDirectory').click();
						}
					}
				)
			}, 500
		);
		jqWar("input[name=save_order]").click(function () {
			var summ = '<?=$SUMM_value?>';
			var prepay = jqWar("#prepayment").val();

			if (isNaN(prepay)) {
				alert('Неправильно введена сумма предоплаты. Сумма предоплаты должна быть числом.');
				return false;
			}
			if (parseFloat(summ) < parseFloat(prepay)) {
				alert('Сумма предоплаты не может быть больше суммы заказа');
				return false;
			}

		});
		jqWar('#prepayment').on('keyup',function(){

				var prepay = this.value;

				if(parseFloat(prepay)>0) {
					var hardCash = 1;
					jqWar('#ord_pmk_id').val(hardCash);
				}

		});
		rsDirectories = jqWar('nobr .rsDirectory');
		if (rsDirectories.length) {
			rsSiblings = jqWar(rsDirectories.siblings().andSelf());
			if (rsSiblings.length) {
				rsSiblings.not('#ord_csc_id_viewState').hide();
				rsDirectories.after('<img src="/images/address-book-icon.png" align="absmiddle" style="cursor: pointer;">');
			}
		}

	});

</script>

<?= $order['validationScript'] ?>

<form id="<?= $order['id'] ?>" name="<?= $order['name'] ?>" action="<?= $order['action'] ?>" method="<?= $order['method'] ?>" onsubmit="<?= $order['onsubmit'] ?>">

	<? if ($MESSAGE_CLIENT_DEALER === true) { ?>

		<div class="notice"><?= tr('Внимание! Вами формируется заказ на клиента торговой точки - дилера, но цена закупа позиций рассчитана как для торговых точек - филиалов. При необходимости, скорректируйте цены закупа вручную.', 'MakeOrderModule') ?></div>

	<? } ?>

	<table border="0" width="100%">
		<? if ($order['fields']['dcm_cst_id']) { ?>

			<tr>
				<td>
					<nobr><?= $order['fields']['dcm_cst_id']['caption'] ?></nobr>
				</td>
				<td>
					<table>
						<tr>
							<td>
								<?= $order['fields']['cst_id']['html'] ?>
							</td>
							<td>
								<span id="setCustomersDirectory" style="cursor:pointer;color:#00457A">Применить</span>
							</td>
							<td>
								<?= $order['fields']['dcm_cst_id']['html'] ?>
							</td>
						</tr>
					</table>
				</td>
			</tr>

			<tr>
				<td>
					<nobr><?= $order['fields']['ord_csc_id']['caption'] ?></nobr>
				</td>
				<td><?= $order['fields']['ord_csc_id']['html'] ?>
					<br/>
					<?= $cars_link ?>
				</td>
			</tr>
			<tr>
				<td height="10" colspan="2"></td>
			</tr>

		<? } ?>
		<? if ($order['fields']['ord_contact_person']) { ?>

			<?  ?><tr><td colspan="2"><h3><?=$MSG['MakeOrderModule']['msg69']?><hr noshade="noshade" size="1"/></h3></td></tr>

<tr>
	<td><nobr><?=$order['fields']['ord_contact_person']['caption']?></nobr></td>
	<td><?=$order['fields']['ord_contact_person']['html']?></td>
</tr>

<tr>
	<td><nobr><?=$order['fields']['ord_phones']['caption']?></nobr></td>
	<td><?=$order['fields']['ord_phones']['html']?></td>
</tr>

<tr>
	<td><nobr><?=$order['fields']['ord_email']['caption']?></nobr></td>
	<td><?=$order['fields']['ord_email']['html']?></td>
</tr>

<tr><td colspan="2"><h3 style="margin-top: 15px"><?=$MSG['MakeOrderModule']['msg70']?><hr noshade="noshade" size="1"/></h3></td></tr>

<tr>
	<td><?=$order['fields']['ord_pmk_id']['caption']?></td>
	<td><?=$order['fields']['ord_pmk_id']['html']?></td>
</tr>

<tr>
	<td><?=$order['fields']['ord_pyr_id']['caption']?></td>
	<td><?=$order['fields']['ord_pyr_id']['html']?></td>
</tr>

<tr>
	<td><nobr><?=$order['fields']['ord_dlv_id']['caption']?></nobr></td>
	<td><?=$order['fields']['ord_dlv_id']['html']?></td>
</tr>

<tbody id="delivery"<?=($hide_deliveries?' style="'.$hide_deliveries.'"':'')?>>

<tr><td colspan="2"><h3 style="margin-top: 15px"><?=$MSG['MakeOrderModule']['msg86']?><hr noshade="noshade" size="1"/></h3></td></tr>

<? if ($order['fields']['ord_address']) { ?>

	<tr>
		<td><?=$order['fields']['ord_address']['caption']?></td>
		<td><?=$order['fields']['ord_address']['html']?></td>
	</tr>

<? } else { ?>

	<tr>
		<td><?=$order['fields']['ord_add_id']['caption']?></td>
		<td><?=$order['fields']['ord_add_id']['html']?></td>
	</tr>
		<tbody id="delivery_new_address" style="<?=($order['sourceFields']['ord_add_id']['instance']->value[0]>0?'display: none;':'')?> <?=$hide_deliveries?>">

		<? $address_form = &$order; ?>
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
		
		</tbody>

<? } ?>
</tbody>

<tr>
	<td><nobr><?=$order['fields']['ord_comment']['caption']?></nobr></td>
	<td><?=$order['fields']['ord_comment']['html']?></td>
</tr><?  ?>

		<? } ?>

		<? if ($order['fields']['company']) { ?>

			<?  ?><?=$order['fields']['__cst_id__']['html']?>
 
<tr><td colspan="2"><h3><?=$MSG['MakeOrderModule']['msg71']?></h3></td></tr>

<tr>
	<td><?=$order['fields']['is_organization']['caption']?></td>
	<td><?=$order['fields']['is_organization']['html']?></td>
</tr>

<tbody id="companyName"<?=($is_organization?'':' style="display: none"')?>>

<? if($order['fields']['company']) { ?>
	
	<tr>
		<td><span id="form_required_field"><?=$order['fields']['company']['caption']?></span></td>
		<td><?=$order['fields']['company']['html']?></td>
	</tr>

<? } ?>

</tbody>

<tr>
	<td><?=$order['fields']['contact_first_name']['caption']?></td>
	<td><?=$order['fields']['contact_first_name']['html']?></td>
</tr>

<tr>
	<td><?=$order['fields']['contact_patronymic_name']['caption']?></td>
	<td><?=$order['fields']['contact_patronymic_name']['html']?></td>
</tr>

<tr>
	<td><?=$order['fields']['contact_surname']['caption']?></td>
	<td><?=$order['fields']['contact_surname']['html']?></td>
</tr>

<? $address_form = &$order; ?>
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

<tr>
	<td><?=$order['fields']['cst_city_code']['caption']?></td>
	<td><?=$order['fields']['cst_city_code']['html']?></td>
</tr>

<tr>
	<td><?=$order['fields']['contact_phone']['caption']?>, <?=$order['fields']['fax']['caption']?></td>
	<td><?=$order['fields']['contact_phone']['html']?> <?=$order['fields']['fax']['html']?></td>
</tr>

<tr>
	<td><?=$order['fields']['mobile_phone']['caption']?></td>
	<td><?=$order['fields']['mobile_phone']['html']?></td>
</tr>

<tr>
	<td><?=$order['fields']['cst_email']['caption']?></td>
	<td><?=$order['fields']['cst_email']['html']?></td>
</tr>

<tr>
	<td><?=$order['fields']['cst_icq']['caption']?></td>
	<td><?=$order['fields']['cst_icq']['html']?></td>
</tr>

<tr>
	<td><?=$order['fields']['cst_skype']['caption']?></td>
	<td><?=$order['fields']['cst_skype']['html']?></td>
</tr>
<tr><td colspan="2"><h3 style="margin-top: 15px"><?=$MSG['MakeOrderModule']['msg72']?></h3></td></tr>

<tr>
	<td><?=$order['fields']['cst_csa_id']['caption']?></td>
	<td><?=$order['fields']['cst_csa_id']['html']?></td>
</tr>

<tr>
	<td><?=$order['fields']['pmk_id']['caption']?></td>
	<td><div id="combo_pmk_id"><?=$order['fields']['pmk_id']['html']?></div></td>
</tr>

<tr>
	<td><?=$order['fields']['stc_id']['caption']?></td>
	<td><?=$order['fields']['stc_id']['html']?></td>
</tr>

<tr>
	<td><?=$order['fields']['dlv_id']['caption']?></td>
	<td><?=$order['fields']['dlv_id']['html']?></td>
</tr>

<tbody id="delivery"<?=($hide_deliveries?' style="'.$hide_deliveries.'"':'')?>>

<tr><td colspan="2"><h3 style="margin-top: 15px"><?=$MSG['MakeOrderModule']['msg86']?><hr noshade="noshade" size="1"/></h3></td></tr>

<tbody id="delivery_new_address"<?=($hide_deliveries?' style="'.$hide_deliveries.'"':'')?>>

<? $address_form = &$order; ?>
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

</tbody>

</tbody>
<tr>
	<td valign="top"><?=$order['fields']['news_subscription']['caption']?></td>
	<td>

	<table border="0">

		<tr>
			<td><?=$order['fields']['notify_subscription']['html']?></td>
			<td><?=$order['fields']['news_subscription']['html']?></td>
		</tr>

		<tr>
			<td><?=$order['fields']['stock_subscription']['html']?></td>
			<td><?=$order['fields']['balance_subscription']['html']?></td>
		</tr>

		<tr>
			<td><?=$order['fields']['offers_subscription']['html']?></td>
			<td><?=$order['fields']['saleoff_subscription']['html']?></td>
		</tr>

	</table>

	</td>
</tr>

<tr>
	<td valign="top"><?=$order['fields']['sms_notify_subscription']['caption']?></td>
	<td>

	<table border="0">
		<tr>
			<td><?=$order['fields']['sms_notify_subscription']['html']?></td>
			<td></td>
		</tr>
	</table>

	</td>
</tr>

<? if ($order['fields']['fake_percent']) { ?>

<tr class="even">
	<td>
		<?=$order['fields']['fake_percent']['caption']?><br/>
		<small><i><?=$MSG['RegistrationModule']['msg59']?></i></small>
	</td>
	<td><?=$order['fields']['fake_percent']['html']?></td>
</tr>

<? } ?>

<tr><td colspan="2"><h3 style="margin-top: 15px"><?=$MSG['MakeOrderModule']['msg73']?></h3></td></tr>

<tr>
	<td><?=$order['fields']['userlogin']['caption']?></td>
	<td><?=$order['fields']['userlogin']['html']?></td>
</tr>

	
<tr>
	<td><?=$order['fields']['userpassword']['caption']?>, <?=$order['fields']['userpassword_repeat']['caption']?></td>
	<td><?=$order['fields']['userpassword']['html']?> <?=$order['fields']['userpassword_repeat']['html']?></td>
</tr><?  ?>
		<? } ?>
		<tr>
			<td>
				<nobr><?= $order['fields']['prepayment']['caption'] ?></nobr>
			</td>
			<td><?= $order['fields']['prepayment']['html'] ?></td>
		</tr>

		<? if ($order['fields']['self_order']) { ?>
			<div class="notice">
				<strong><?= tr('Внимание!', 'Common') ?></strong> <?= tr('Заказ будет разделен по поставщикам!', 'MakeOrderModule') ?>
			</div>
		<? } ?>

		<?  ?><tr>
	<td colspan="2">
		<h3 style="margin-top: 15px"><?= $MSG['MakeOrderModule']['msg74'] ?>
			<hr noshade="noshade" size="1"/>
		</h3>
	</td>
</tr>

<tr>
	<td colspan="2">

		<? $web_ar_datagrid = & $order['fields']['basket']['html']; ?>
		<? $data_align = array('center', 'center', 'center', 'center', 'center', 'center', 'center', 'center', 'center', 'center', 'center', 'center', 'center'); ?>
		<? foreach ($web_ar_datagrid['data'] as $rkey => $row) {
			foreach ($row as $key => $value) {

				switch ($key) {

					case 'article':
					{
						$web_ar_datagrid['data'][$rkey][$key] = '<nobr>' . $web_ar_datagrid['data'][$rkey][$key] . '</nobr>';
					}
						break;

					case 'price':
					{
						if ((float)$web_ar_datagrid['data'][$rkey]['price_value'] == 0) {
							$web_ar_datagrid['data'][$rkey][$key] = $MSG['MakeOrderModule']['msg78'];
						}
						if ($web_ar_datagrid['data'][$rkey]['phand_value'] != 0) {
							$web_ar_datagrid['data'][$rkey][$key] .= '<br/><small><span id="phand">' . $MSG['MakeOrderModule']['msg78'] . '&nbsp;' . $web_ar_datagrid['data'][$rkey]['detail_phand'] . '</span></small>';
						}
					}
						break;

					case 'summ':
					{
						if ((float)$web_ar_datagrid['data'][$rkey]['price_value'] == 0) {
							$web_ar_datagrid['data'][$rkey][$key] = $MSG['MakeOrderModule']['msg78'];
						}
						if ($web_ar_datagrid['data'][$rkey]['phand_value'] != 0) {
							$web_ar_datagrid['data'][$rkey][$key] .= '<br/><small><span id="phand">' . $MSG['MakeOrderModule']['msg78'] . '&nbsp;' . $web_ar_datagrid['data'][$rkey]['phand_summ'] . '</span></small>';
						}
					}
						break;

					case 'cost_per_weight_display':
					{
						if (($web_ar_datagrid['data'][$rkey]['cost_per_weight'] > 0) && ((float)$web_ar_datagrid['data'][$rkey]['weight'] == 0)) {
							$web_ar_datagrid['data'][$rkey][$key] = '+ ' . $web_ar_datagrid['data'][$rkey][$key] . '/' . $MSG['BasketModule']['msg44'];
						} else {
							$web_ar_datagrid['data'][$rkey][$key] = '&nbsp;';
						}
					}
						break;

					case 'info':
					{
						if (($web_ar_datagrid['data'][$rkey]['cost_per_weight'] > 0) && ((float)$web_ar_datagrid['data'][$rkey]['weight'] == 0)) {
							$web_ar_datagrid['data'][$rkey][$key] = '<img src="/_sysimg/ar2/cdelivery.gif" alt="' . $MSG['BasketModule']['msg9'] . '" title="' . $MSG['BasketModule']['msg9'] . '" />';
						} else {
							$web_ar_datagrid['data'][$rkey][$key] = '&nbsp;';
						}
					}
						break;

					default:
						{

						}
						break;

				}

			}

		}
		?>
		<?  ?>
	<div class="flc">
		<? if (count($web_ar_datagrid['controls'])>0) { ?>
			<? $i=0; ?>
			<? foreach ($web_ar_datagrid['controls'] as $hdr_id=>$control) { ?>

				<? if ((empty($control_align[$i])) or ($control_align[$i] == 'top')) { ?>

					<div class="table_control <?=($hdr_id=='pagination'?'rightside':'leftside')?>"><?=$control?></div>

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

	<table class="web_ar_datagrid <?=$web_ar_datagrid['info']['name']?>" width="100%">
		<tr>
			<? $col_num = 0; $total_begin = 0; ?>
			<? foreach ($web_ar_datagrid['header'] as $hdr_id=>$column) {	?>

				<? if ($column['visible'] != '1') continue; ?>

				<th class="col_<?=$hdr_id?>">

					
					<? if (!empty($column['clm_info'])) { ?>
						<span class="tipz" title="<?=$column['clm_info']?>"></span>
					<? } ?>

					<?=$column['caption']?>

				</th>

				<? if ((empty($web_ar_datagrid['total'][$hdr_id])) && ($total_begin == $col_num)) { ?>
					<? $total_begin++; ?>
				<? } ?>

				<? $col_num++; ?>
			<? } ?>
		</tr>

		
		<? if ($captionFilter) { ?>

			<tr class="filter_row">
				<? foreach ($web_ar_datagrid['header'] as $hdr_id=>$column) {	?>

					<? if ($column['visible'] != '1') continue; ?>

					<td class="col_<?=$hdr_id?>">
						
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
					</td>

				<? } ?>
			</tr>

		<? } ?>

		<? if ((count($web_ar_datagrid['data']) > 0)) { ?>
			<? foreach ($web_ar_datagrid['data'] as $row=>$item) { ?>

				<tr class="<?=toggleEvenOdd()?>">

					<? $i=0; ?>
					<? foreach ($web_ar_datagrid['header'] as $hdr_id=>$column) {	?>

						<? if ($column['visible'] != '1') continue; ?>

						<td class="col_<?=$hdr_id?>"<?=(!empty($data_align[$i])?' align="'.$data_align[$i].'"':'')?>><?=$item[$hdr_id]?></td>

						<? $i++; ?>

					<? } ?>

				</tr>

			<? } ?>
		<? } else { ?>
			<tr class="<?=toggleEvenOdd()?>">
				<td class="col_empty" colspan="<?=$col_num?>" align="center"><?=$MSG['Common']['msg4']?></td>
			</tr>
		<? } ?>

		
		<? if (count($web_ar_datagrid['total']) > 0) { ?>
			<tr class="row_total">
				<? if ($total_begin > 0) { ?>
					<td colspan="<?=$total_begin?>" class="col_total"><?=$MSG['Common']['msg5']?></td>
				<? } ?>
				<? foreach ($web_ar_datagrid['header'] as $hdr_id=>$column) {	?>

					<? if (($column['visible'] != '1') or ((++$total_counter <= $total_begin) && ($total_begin != 0))) continue; ?>

					<td class="col_<?=$hdr_id?>"><?=$web_ar_datagrid['total'][$hdr_id]?></td>

				<? } ?>
			</tr>
		<? } ?>
	</table>
	<? if (!empty($PHP_TEMPLATE['captionFilter_'.$web_ar_datagrid['info']['name']])) { ?>

		</form>

	<? } ?>

<? } else { ?>

	<p><?=$empty_message?></p>

<? } ?>


<? if (count($web_ar_datagrid['controls'])>0) { ?>
	<? $i=0; ?>
	<? foreach ($web_ar_datagrid['controls'] as $hdr_id=>$control) { ?>

		<? if ($control_align[$i] == 'bottom') { ?>

			<div class="table_control"><?=$control?></div>

		<? } ?>

		<? $i++; ?>

	<? } ?>
<? } ?><?  ?>

		<?= $order['fields']['chPos']['html'] ?>

	</td>
</tr><?  ?>

		<tr>
			<td colspan="2" height="60">
				<?  ?><table border="0" width="100%" class="ar2_basket_info">
	<tr class="header2" height="40" align="center">
		<td colspan="2">

			<strong><?=$MSG['MakeOrderModule']['msg75']?>
			&nbsp;<?=$total_summ?>
			</strong>
			
			<style type="text/css">
				.float_string {
					display:inline;
				}
			</style>
			&nbsp;<span id="deliveryDiv"></span>

			<script language="JavaScript">
		
				function calcDelivery() {		
					
					<? if (($order['fields']['ord_add_id']) or ($order['fields']['ord_add_city_id']) or ($order['fields']['ord_address'])) { ?>
	 		 
	 		 		formObj = document.forms['order'];
	 		 		dlv_idValue = formObj.ord_dlv_id?formObj.ord_dlv_id.value:formObj.dlv_id.value;
	 		 		add_idValue = formObj.ord_add_id?formObj.ord_add_id.value:"";

					add_city_idValue = formObj.ord_add_city_id?formObj.ord_add_city_id.value:"";
					add_city_idValue = formObj.add_city_id?formObj.add_city_id.value:add_city_idValue;
	 		 		add_district_idValue = formObj.ord_add_district_id?formObj.ord_add_district_id.value:"";
	 		 		add_district_idValue = formObj.add_district_id?formObj.add_district_id.value:add_district_idValue;
	 		 
					var url = "/_ajax/calcDelivery.html?admin_calc=1&dcm_id=" + <?=$order['sourceFields']['ord_dcm_id']['instance']->value?> + "&dlv_id=" + dlv_idValue + "&cty_id=" + add_city_idValue + "&dst_id=" + add_district_idValue + "&add_id=" + add_idValue + "&chPos=<?=$order['sourceFields']['chPos']['instance']->value?>";
						
					
					$('deliveryDiv').load(url);	

					<? } ?>

				}									
				
			</script>
				
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<? if ($MIN_ORDER_SUMM): ?>
				<div class="notice">
					<div class="notice_caption"><?= $MSG['Forms']['msg5'] ?></div>
					<div class="notice_text"><?= $MSG['BasketModule']['msg39'] ?>:
						<span class="notice_value"><?= $MIN_ORDER_SUMM ?></span>
						<br/><?= tr($MSG['BasketModule']['msg40'], 'BasketModule') ?>
					</div>
				</div>
			<? endif ?>
		</td>
	</tr>

	<? if (isset($RESTRICT_DEBT_SUMM)) { ?>
		<tr>
			<td colspan="2">
				<div class="notice">
					<div class="warning_caption"><?= $MSG['Forms']['msg5'] ?></div>
					<div class="warning_text"><?= $MSG['BasketModule']['msg43'] ?>
						<span class="warning_value"><?= $MAX_DEBT_SUMM ?></span></div>
				</div>
			</td>
		</tr>
	<? } ?>

	<tr>
		<td width="50%">
			<?=$order['fields']['edit']['html']?>
			<?=$order['fields']['cancel']['html']?>
		</td>
			
		<td align="right" width="50%">
		
		<? if((!isset($MIN_ORDER_SUMM)) && (!isset($RESTRICT_DEBT_SUMM))) { ?>
			<?=$order['fields']['save_order']['html']?>
		<? } ?>
		
		</td>
	</tr>
</table><?  ?>
			</td>
		</tr>

		<?= $order['fields']['_prid']['html'] ?>
		<?= $order['fields']['subj']['html'] ?>
		<?= $order['fields']['ord_id']['html'] ?>
		<?= $order['fields']['ord_dcm_id']['html'] ?>
		<?= $order['fields']['ord_active']['html'] ?>
		<?= $order['fields']['ord_fixed']['html'] ?>
		<?= $order['fields']['hide_small_basket']['html'] ?>
		<?= $order['fields']['ord_source_id']['html'] ?>
		<?= $order['fields']['self_order']['html'] ?>

		<script language="JavaScript">

			calcDelivery();

		</script>

	</table>
</form><?  ?>
	<? } ?>
	
	<? $process_messages = &$order;?>
	<?  ?><? if (count($process_messages['messages']) > 0) {
	
	foreach($process_messages['messages'] as $message) { ?>

		<?=$message?>
		
	<? }

} ?><?  ?>

<? } ?>
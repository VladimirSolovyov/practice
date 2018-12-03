<table border="0" align="center" width="100%">
<tr><td>
<img src="../images/template/logo.png" width="140" height="100" style="display: inline-block; float: left;">
<h2 style="padding-top: 40px;"><?=trp('Бланк заказа № %s от %s', 'OrderDocument', substr(stristr($DATA['document_code'], '/', true), 3), $DATA['doc_rus_month'] ? $DATA['doc_day'] .' ' . $DATA['doc_rus_month'] . ' ' . $DATA['doc_bigYear'] : $DATA['doc_day'] .'.' . $DATA['doc_month'] . '.' . $DATA['doc_bigYear'])?></h2>
<table border="0" width="100%">
	<tr><td width="50%">
			<p>
				<b><?=$DATA['bsp_doc_name']?></b><br/>
				<b><?=truc('Адрес', 'Forms')?>:</b> <?=$DATA['bsp_post_address']?><br/>
				<b><?=truc('Телефон', 'Forms')?>:</b> <?=$DATA['bsp_phones']?><br/>
			</p>

		</td>
		<td width="50%">

			<p>
				<b><?=truc('Ваш менеджер:', 'PersonalInfoModule')?></b><br/>
				<?=$DATA['fullname']?>
				<? if ($DATA['phone']) { ?>
					, <?=$DATA['phone']?>
				<? } ?>
				<? if ($DATA['email']) { ?>
					, e-mail: <?=$DATA['email']?>
				<? } ?>
				<? if ($DATA['icq']) { ?>
					, ICQ: <?=$DATA['icq']?>
				<? } ?>
			</p>

			<p style="display:none;"><?=var_dump($DATA) ?></p>

		</td></tr>
		<tr>
			<td style="padding-top:  20px;">
    			<b>График работы магазина:</b>
    				<br>
    			<b>пн-пт.:</b> 9.00 - 18.45, 
    				<br>
    			<b>cб.:</b> 9.00 - 17:00,
    				<br>
   				<b>вс.:</b> 9.00 - 15:00
			</td>
    		<td>
			<b>Внимание!</b>
			<br>
			<span>
				Потеря бланка заказа будет усложнять поиск заказанных позиций, тем самым <b>увеличит время ожидания</b> выдачи заказа.
			</span>
			</td>
		</tr>
</table>

<hr hoshade="noshade" size="1"/>

<table border="0" width="100%" style="display:none;">
	<tr><td width="50%">

			<strong><?=truc('Заказчик', 'Forms')?>:</strong>&nbsp;
			<? if ($DATA['company']) { ?>
				<?=$DATA['company']?>
			<? } else { ?>
				<?=$DATA['contact_surname'] . ' ' . $DATA['contact_first_name'] . ' ' . $DATA['contact_patronymic_name']?>
			<? } ?>
			<br/>

			<strong><?=truc('Логин', 'Forms')?>:</strong>&nbsp;<?=$DATA['userlogin']?><br/>

			<strong><?=truc('Телефон', 'Forms')?>:</strong>&nbsp;<?=$DATA['ord_phones']?><br/>

		</td>
		<td width="50%">

			<b><?=truc('Вид доставки', 'Forms')?>:</b>

			<? if ($DATA['dlv_id'] != '') { ?>

			&nbsp;<?=tr($DATA['dlv_name'], 'deliveries')?><br/>

			<strong><?=truc('Адрес доставки', 'Forms')?>:</strong>

			<? if ($DATA['ord_address'] != '') { ?>
				<?=$DATA['ord_address']?>
			<? } else { ?>

				<?=$DATA['add_postal_index']?>
				&nbsp;<?=tr($DATA['cnt_name'], 'countries')?>,
				&nbsp;<?=tr($DATA['rgn_name'], 'regions')?>,
				&nbsp;<?=tr($DATA['cty_name'], 'cities')?>,
				&nbsp;<?=$DATA['add_address']?>,
				<? if ($DATA['add_info'] !='') { ?>
				,&nbsp;<?=$DATA['add_info']?>
				<? } ?>
			<? } ?>
			<? } else { ?>
				<?=tr('самовывоз', 'PersonalInfoModule')?>
			<? } ?>

		</td>
	</tr>
</table>

<? if ($DATA['csc_cst_id'] !='') { ?>

<h3><?=tr('Информация о машине', 'OrderDocument')?></h3>

<b><?=tr('марка, модель машины', 'OrderDocument')?>:</b>&nbsp;<?=$DATA['csc_brand']?>, <?=$DATA['csc_model']?>,

<?
$arFields = [
	'VIN' => 'csc_vin_code',
	'гос. номер' => 'csc_gov_code',
	'дата выпуска' => 'car_date',
	'страна изготовитель' => ['car_country', 'countries'],
	'кузов' => ['csc_body', 'vin_body_types'],
	'дверей' => 'csc_doors',
	'привод' => ['csc_drive', 'VinRequestModule'],
	'тип/буквы двигателя' => 'csc_engine_type',
	'код двигателя' => 'csc_engine_code',
	'мощность (л.с.)' => 'csc_engine_power',
	'объем (см3)' => 'csc_engine_volume',
	'цилиндров' => 'csc_cylinders',
	'клапанов' => 'csc_valves',
	'вид топлива' => 'csc_fuel_type',
	'подача топлива' => 'csc_fuel_supply',
	'вид тормозной системы' => 'csc_brake_system',
	'тип передних тормозов' => 'csc_front_brakes',
	'тип задних тормозов' => 'csc_rear_brakes',
	'руль' => 'csc_steering_wheel',
	'тип КПП' => ['csc_transmission_type', 'VinRequestModule'],
	'код КПП' => 'csc_transmission_code',
	'число передач' => 'csc_transmission_count',
];
$arBrFields = ['car_date', 'csc_body', 'csc_engine_type', 'csc_brake_system', 'csc_steering_wheel'];
foreach ($arFields as $label => $field) {
	$tr = false;
	if (is_array($field)) {
		$field = $field[0];
		$tr = $field[1];
	}
	if (in_array($field, $arBrFields)) {
		echo '<br/>';
	}
	if (!$DATA[$field]) {
		continue;
	} ?>
	<b><?=tr($label, 'Forms')?>:</b>&nbsp;<?=($tr ? tr($DATA[$field], $tr) : $DATA[$field])?>,
<? } ?>

<? if ($DATA['options_available'] !='') { ?>

<b><?=tr('опции', 'OrderDocument')?>:</b>

<?
$arOptions = [
	tr('кондиционер', 'Forms') => 'csc_conditioner',
	'ABS' => 'csc_abs',
	'ASR' => 'csc_asr',
	'ASD' => 'csc_asd',
	'ESP' => 'csc_esp',
	'ETS' => 'csc_ets',
	tr('ГУР', 'Forms') => 'csc_hyd_actuator',
];
foreach($arOptions as $label => $option) {
	if ($DATA[$option] != 'N') {
		echo $label . ', ';
	}
}
?>

<? if ($DATA['csc_catalyst'] !='N') { ?>
<?=tr('катализатор', 'Forms')?>,

<? if ($DATA['csc_catalyst_type'] !='') { ?>
<b><?=tr('вид катализтатора', 'Forms')?>:</b>&nbsp;<?=$DATA['csc_catalyst_type']?>,
<? } ?>

<? } ?>

<? if ($DATA['csc_turbo'] !='N') { ?>
<?=tr('турбо', 'Forms')?>
<? } ?>

<? } ?>

<? if ($DATA['csc_more'] != '') { ?>
<br/><br/>
<b><?=tr('дополнительная информация', 'Forms')?>:</b><br/>
&nbsp;<?=$DATA['csc_more']?>,
<? } ?>

<? } ?>


<h3><?=tr('Список заказанных запчастей', 'reports')?></h3>

<table border="1" cellpadding="5" cellspacing="0" bordercolor="#000000" width="100%">

	<tr>
		<th><?=tr('№', 'Forms')?></th>
		<th><?=truc('Производитель', 'Forms')?></th>
		<th><?=truc('Название детали', 'Forms')?></th>
		<th><?=truc('Количество', 'Forms')?></th>
		<th><?=truc('Единица измерения', 'price_debug')?></th>
		<th><?=truc('Цена', 'Forms')?>, <?=$DATA['html_sign']?></th>
		<th><?=truc('Срок', 'Forms')?> (<?=tr('ср.', 'Forms')?><? if ($DATA['showMaxTerm'] == 1) { ?> / <?=tr('гарант.', 'Forms')?><? } ?>)</th>
		<th><?=truc('Сумма', 'Forms')?>, <?=$DATA['html_sign']?></th>
	</tr>

	<? $i = 0; ?>
	<? foreach ($CONTENT as $key => $item) { ?>
	<? $i++; ?>
	<tr>
		<td><?=$i?></td>
		<td align="center"><?=$item['pst_brand']?></td>
		<td><?=$item['pst_name']?></td>
		<td align="center"><?=$item['pst_amount']?></td>
		<td align="center"><?=tr($item['unt_name'], 'units')?></td>
		<td align="right" nowrap ><?=number_format($item['pst_price_in_country'], 2, '.', ' ')?>

			<? if (($item['pst_cost_per_weight'] > 0) and ($item['pst_weight'] == 0 or $item['pst_weight'] == '')) { ?>
			<sup>*</sup>
			<? } ?>

		</td>
		<td align="center">
			<?=$item['pst_term']?>
			<? if ($item['pst_max_term'] !='' and $item['pst_max_term'] > 0 and $DATA['showMaxTerm'] ==1) { ?>
			/
			<?=$item['pst_max_term']?>
			<? } ?>
		</td>
		<td align="right" nowrap ><?=number_format($item['pst_price_in_country'] * $item['pst_amount'], 2, '.', ' ')?>

			<? if (($item['pst_cost_per_weight'] > 0) and ($item['pst_weight'] == 0 or $item['pst_weight'] == '')) { ?>
			<sup>*</sup>
			<? } ?>

		</td>
	</tr>

	<? } ?>

	<tr>
		<td colspan="4" align="right">
			<strong><?=truc('Общая сумма заказа', 'reports')?>:</strong>
		</td><td colspan="4" align="center">
			<strong><?=number_format($DATA['ord_summ_in_country'], 2, '.', ' ')?></strong>
		</td>
	</tr>
	<tr>
	<td colspan="4" align="right">
			<strong><?=truc('Оплачено', 'Forms')?>, <?=$DATA['html_sign']?>:</strong>
	</td>
	<td colspan="4" align="center">
			<strong><?=number_format($DATA['ord_summ_paid_in_country'], 2, '.', ' ')?></strong>
	</td>
	</tr>
	<tr>
	<td colspan="4" align="right">
			<strong><?=truc('Долг по оплате', 'BalanceModule')?>, <?=$DATA['html_sign']?>:</strong>
	</td>
	<td colspan="4" align="center">
			<strong><?=number_format($DATA['ord_summ_debt_in_country'], 2, '.', ' ')?></strong>
	</td>
	</tr>
</table>

 <h4><?=truc('Условия поставки', 'Forms')?>:</h4>
<!--Закоментировал старые условия 24.01.18 -->
<!--<p>1. <?//=truc('Срок исполнения заказа от 1 дня в зависимости от доставки и наличия позиций заказа на центральных складах.', 'OrderDocument')?></p>

<p>2. <?//=truc('Исполнитель не несет ответственности за заказ запчастей, осуществленный по данным техпаспорта автомобиля заказчика и не соответствующих фактическим данным автомобиля.', 'OrderDocument')?></p>

<p>3.  <?//=truc('Гарантию на запчасти установленные на станциях техобслуживания не имеющих соответствующую лицензию и сертификат исполнитель не дает.', 'OrderDocument')?></p>

<p><b>4. <?//=truc('Стоимость позиций, отмеченных знаком *, не является конечной и будет уточнена по согласованию с Вашим менеджером.', 'OrderDocument')?></b></p> -->


<p><?=truc('Возврат запчастей возможен в течении 14 календарных дней со дня покупки(покупка из наличия) или 7 календарных дней со дня выдачи(покупка под заказ) (в соответствии со статьёй 26.1. Закона «О защите прав потребителей»), при условии полного сохранения товарного вида(нет следов установки, не нарушена целостность и комплектность упаковки).')?></p>

<!-- <br/>
<table border="0" width="100%">
	<tr><td width="50%">
			<?//=truc('Данные верны, с условиями согласен', 'OrderDocument')?>:_____________________<br/>
			(<?//=tr('подпись заказчика', 'OrderDocument')?>)
		</td><td width="50%">
			<?//=truc('Исполнитель', 'OrderDocument')?>:_______________________	<br/>
			(<?//=tr('подпись исполнителя', 'OrderDocument')?>)
		</td></tr>
</table> -->

</td></tr>
</table>
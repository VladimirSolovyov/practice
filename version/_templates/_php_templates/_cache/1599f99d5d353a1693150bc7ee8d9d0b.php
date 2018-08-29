<? if ($customerName) { ?>
	<h3><?= tr('Здравствуйте') ?>, <?= $customerName ?>!</h3>
<? } ?>

<p>
	<?=tr('Ваш заказ успешно оформлен', 'MakeOrderModule')?>. <?= tr('Благодарим Вас за размещенный заказ на нашем сайте! Работающий с Вами менеджер его рассмотрит и в ближайшее время свяжется с Вами для согласования позиций.', 'MakeOrderModule') ?>
</p>

<? if ($activation_code != '') { ?>
	<?= $msgBuffer['RegistrationModule']['msg92'] ?>
<? } ?>

<?  ?><?
//кастомайзинг таблицы корзины в письме
$basket_columns = [
	'brand',
	'article',
	'name',
	'amount',
	'term',
	'summ'
];

$tableDataConfig = [
	'columns' => [
		'info'    => [
			'caption' => $basket['header']['name']['caption']
		],
		'ordered' => [
			'caption' => truc('Заказано', 'MakeOrderModule')
		],
		'term'    => [
			'caption' => truc('Срок', 'Forms')
		],
		'amount'  => [
			'caption' => $basket['header']['amount']['caption']
		],
		'summ'    => [
			'caption' => $basket['header']['summ']['caption']
		],
	],
	'data'    => [],
	'summary' => $msgBuffer['MakeOrderModule']['msg54'] . " " . $eshopBasket->getSumm()
];

foreach ($basket['data'] as $row) {
	$newRow = [];
	foreach ($basket_columns as $col) {
		if ($basket['header'][$col]['visible']) {
			switch ($col) {
				case 'brand':
					$newRow['info']['value'] = $row[$col];
					break;
				case 'article':
					$newRow['info']['value'] .= ' <strong>' . $row[$col] . '</strong>';
					break;
				case 'name':
					$newRow['info']['additional'] = $row[$col];
					break;
				case 'amount':
					$newRow['amount']['additional'] = $row[$col];
					break;
				case 'summ':
					$newRow['summ']['value'] = '<strong>' . $row[$col] . '</strong>';
					break;
				default:
					$newRow[$col] = $row[$col];
					break;
			}
		}
	}
	if ($newRow) {
		$newRow['ordered']['value'] = date('d.m.Y');;
		$tableDataConfig['data'][] = $newRow;
	}
}

 ?><?
if (isset($tableDataConfig)) {
	$col_count = 0;
	?>
	<table class="data-table" style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
		<?
		if ($tableDataConfig['columns']) {
			?>
			<tr style="padding:0;text-align:left;vertical-align:top">
				<?
				foreach ($tableDataConfig['columns'] as $column) {
					$col_count++;
					?>
					<th style="Margin:0;background-color:#f3f3f3;color:#999;font-family:Arial,sans-serif;font-size:11px;font-weight:400;line-height:1.3;margin:0;padding:20px 10px;text-align:left;vertical-align:middle">
						<?= $column['caption'] ?>
					</th>
				<?
				}
				?>
			</tr>
			<?
			foreach ($tableDataConfig['data'] as $row) {
				?>
				<tr style="padding:0;text-align:left;vertical-align:top">
					<?
					foreach (array_keys($tableDataConfig['columns']) as $column_id) {
						?>
						<td style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;border-top:1px solid #f3f3f3;color:#000;font-family:Arial,sans-serif;font-size:13px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:10px;text-align:left;vertical-align:middle;word-wrap:break-word">
						<?
						if (is_array($row[$column_id])) {

							if ($row[$column_id]['value']) {
								?>
								<p style="Margin:0;Margin-bottom:10px;color:#000;font-family:Arial,sans-serif;font-size:13px;font-weight:400;line-height:1.3;margin:0;margin-bottom:2px;padding:0;text-align:left">
									<?= $row[$column_id]['value'] ?>
								</p>
							<?
							}

							if ($row[$column_id]['additional']) {
								?>
								<p class="additional" style="Margin:0;Margin-bottom:10px;color:#999;font-family:Arial,sans-serif;font-size:13px;font-weight:400;line-height:1.3;margin:0;margin-bottom:2px;padding:0;text-align:left">
									<?= $row[$column_id]['additional'] ?>
								</p>
							<?
							}

						} else {
							echo $row[$column_id];
						}
						?></td><?
					}
					?>
				</tr>
			<?
			}
		}
		if ($tableDataConfig['summary']) {
			?>
			<tr style="padding:0;text-align:left;vertical-align:top">
				<td colspan="<?= $col_count ?>" style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;background-color:#f3f3f3;border-collapse:collapse!important;border-top:1px solid #f3f3f3;color:#000;font-family:Arial,sans-serif;font-size:15px;font-weight:700;hyphens:auto;line-height:1.3;margin:0;padding:20px 10px;text-align:right;vertical-align:top;word-wrap:break-word">
					<?= $tableDataConfig['summary'] ?>
				</td>
			</tr>
		<?
		} else {
			?>
			<tr style="padding:0;text-align:left;vertical-align:top">
				<td colspan="<?= $col_count ?>" class="end" style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;border-top:1px solid #f3f3f3;color:#000;font-family:Arial,sans-serif;font-size:13px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:10px;text-align:left;vertical-align:middle;word-wrap:break-word"></td>
			</tr>
		<?
		}
		?>
	</table>
	<?
	unset($tableDataConfig);
}
?><? 
?><?  ?>

<?  ?><?
$_SERVER['SERVER_NAME'] = punycodeDecode($_SERVER['SERVER_NAME']);
$pmkInfo = Loader::getApi('paymentkinds')->getPaymentKindInfoById($_POST['ord_pmk_id']);
?>

<p><strong><?= tr('Оплата и проведение заказа:', 'MakeOrderModule') ?></strong></p>

<ul>
	<li>
		<? if ($pmkInfo['pmk_img'] != "") { ?>
			<img src="<?= $pmkInfo['pmk_img'] ?>" hspace=3 align=absmiddle alt="<?= tr($pmkInfo['pmk_name'], 'payment_kinds') ?>"/>&nbsp;
		<? } ?>

		<?= $Interface->MSG['MakeOrderModule']['msg21'] . " &laquo;" . tr($pmkInfo['pmk_name'], 'payment_kinds') ?>&raquo;

		<? if ($pmkInfo['pmk_is_online'] == "Y") { ?>
			<strong>
				<a href="/shop/payments-online.html?dcm_id=<?= md5($_POST['ord_dcm_id']) ?>&pmk_id=<?= $pmkInfo['pmk_id'] ?>" target=_blank><?= $Interface->MSG['MakeOrderModule']['msg65'] ?></a>
			</strong>
		<? } ?>
	</li>

	<li>
		<a href="<?= CMS_API::createUrl("/shop/documents.html", [
				"dcm_id" => md5($_POST['ord_dcm_id'])
			]) ?> " target=_blank><?= $Interface->MSG['MakeOrderModule']['msg22'] ?></a>
	</li>


	<li><?= $msgBuffer['MakeOrderModule']['msg23'] ?> "<a href="<?= CMS_API::createUrl('/shop/personal/info.html') ?>" target=_blank><?= $msgBuffer['MakeOrderModule']['msg24'] ?></a>".
	</li>

	<li><?= $msgBuffer['MakeOrderModule']['msg25'] ?> "<a href="<?= CMS_API::createUrl($_interface->positionsUrl) ?>" target=_blank><?= $msgBuffer['MakeOrderModule']['msg26'] ?></a>".
	</li>
</ul>
<?  ?>

<?
$customerAPI = Loader::getApi('customer');
$customerStat = $customerAPI->getStat($eshopClient->sourceId);

$orderSumm = new dtPriceParam($customerStat['dcm_summ_value'], null, $customerStat['html_sign'], 1, $customerStat['position']);
$orderDebtSum = new dtPriceParam($customerStat['debt_summ_value'], null, $customerStat['html_sign'], 1, $customerStat['position']);
$balanceSum = new dtPriceParam($customerStat['balanceSumm'], null, $customerStat['html_sign'], 1, $customerStat['position']);


$formTableConfig = [
	'head'     => $msgBuffer['MakeOrderModule']['msg48'],
	'rows'  => [
		'balance',
		'debt'
	],
	'formData' => [
		'balance' => [
			'caption' => $msgBuffer['MakeOrderModule']['msg49'],
			'value'   => $balanceSum->render(DR_SYSTEM)
		],
		'debt'    => [
			'caption' => $msgBuffer['MakeOrderModule']['msg57'],
			'value'   => $orderDebtSum->render(DR_SYSTEM)
		]
	]
];

 ?><?
	if(isset($formTableConfig)){
		?><table class="styled" style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%"><?
		if(isset($formTableConfig['head'])){
			?>
			<tr style="padding:0;text-align:left;vertical-align:top">
				<th colspan="2" style="Margin:0;background-color:#f3f3f3;border-bottom:1px solid #dcdcdc;color:#000;font-family:Arial,sans-serif;font-size:15px;font-weight:700;line-height:1.3;margin:0;padding:10px;text-align:left">
					<?=$formTableConfig['head']?>
				</th>
			</tr>
			<?
		}
		if(isset($formTableConfig['rows']) && isset($formTableConfig['formData'])){
			foreach ($formTableConfig['rows'] as $field) {
				if(isset($formTableConfig['formData'][$field]) && $formTableConfig['formData'][$field]['value']) {
					?>
					<tr style="padding:0;text-align:left;vertical-align:top">
						<td class="dt" style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-bottom:1px solid #dcdcdc;border-collapse:collapse!important;color:#999;font-family:Arial,sans-serif;font-size:15px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:10px;text-align:left;vertical-align:top;word-wrap:break-word">
							<?=$formTableConfig['formData'][$field]['caption']?>
						</td>
						<td style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-bottom:1px solid #dcdcdc;border-collapse:collapse!important;color:#000;font-family:Arial,sans-serif;font-size:15px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:10px;text-align:left;vertical-align:top;word-wrap:break-word">
							<?=$formTableConfig['formData'][$field]['value']?>
						</td>
					</tr>
					<?
				}
			}
		}
		?></table><?
	}
	$formTableConfig = [];
?><? 
?>
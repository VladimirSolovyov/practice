<?

global $__AR2;

if (!$__AR2['use_quick_order'] || $eshopClient->cst_category_id != "") {

	$data['cst_name']['caption'] = $msgBuffer['MakeOrderModule']['msg66'];

	if ($eshopClient->company != "") {

		$data['cst_name']['value'] = $eshopClient->company;

	} else {

		$data['cst_name']['value'] = $eshopClient->contact_surname . " " . $eshopClient->contact_first_name . " " . $eshopClient->contact_patronymic_name;
	}

	$data = $data + $order;

	$formTableConfig = [
		'head'     => $msgBuffer['MakeOrderModule']['msg51'],
		'rows'  => [
			'cst_name',
			'ord_contact_person',
			'ord_phones',
			'ord_email'
		],
		'formData' => $data
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

	$formTableConfig = [
		'head'     => $msgBuffer['MakeOrderModule']['msg52'],
		'rows'  => [
			'ord_pmk_id',
			'ord_pyr_id',
			'ord_dlv_id',
			'ord_address'
		],
		'formData' => $order
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

}

$formTableConfig = [
	'rows'  => [
		'ord_comment'
	],
	'formData' => $order
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

?><br>

<h3><?=$msgBuffer['MakeOrderModule']['msg53']?></h3>

	<br><?

 ?><?
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
?><? 
?>
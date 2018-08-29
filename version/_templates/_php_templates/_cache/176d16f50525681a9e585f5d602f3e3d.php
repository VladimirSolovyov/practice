<?
global $_SYSTEM, $__BUFFER;

$__BUFFER->addScript('/_syslib/mootools-more.js');
$__BUFFER->addScript('/_syslib/web_order.js?17082017');
$__BUFFER->addStyle('/_syscss/web_order.css');
js($js);

$systemCell = array(
	'pst_name',
	'pst_article',
	'pst_brand',
	'pst_manager_comment',
	'reference',
	'pst_price',
	'pst_amount',
	'pst_summ',
	'chPos',

);

$cur = $_interface->displayedCurInfo;
$total = count($data);

$colCount = 0;
foreach ($columns as $row) {
	if ($row['visible']) $colCount++;
}

$prv = $PROVIDER . '_' . $PROVIDER_ID;
?>

<div class="web_order" id="<?= $prv ?>">

	<div class="caption">
		<h2><?= tr("поставщик", "web_order"); ?> <?= $PROVIDER . ' [ID:' . $PROVIDER_ID . ']' ?></h2>

		<div id="stat<?= $prv ?>" class="stat">
			<div class="empty" onclick="filterTable('<?= $prv ?>', 'total')"><?= truc("Всего", "web_order"); ?>: <span
					class="totalCount"><?= $total ?></span></div>
			<div class="success"
				 onclick="filterTable('<?= $prv ?>', 'success')"><?= truc("Готовых к оформлению", "web_order"); ?>: <span
					class="successCount">0</span></div>
			<div class="changePrice" onclick="filterTable('<?= $prv ?>', 'fail')"><?= truc("Пропущенных", "web_order"); ?>: <span
					class="failCount">0</span></div>
		</div>
	</div>
	<div class="clear"></div>

	<table>
		<tr class="header">
			<th><?= truc('Деталь', "web_order"); ?></th>

			<? foreach ($columns as $row): ?>
				<? if (in_array($row['name'], $systemCell) || !$row['visible']) continue; ?>
				<th><?= $row['caption']; ?></th>
			<? endforeach; ?>

			<th><?= truc('Комментарий поставщику', "web_order"); ?></th>
			<th><?= truc('Референс', "web_order"); ?></th>
			<th><?= truc('Номер заказа поставщику', "web_order"); ?></th>
			<th><?= truc('Цена', "Forms"); ?></th>
			<th><?= truc('Количество', "Forms"); ?></th>
			<th><?= truc('Сумма', "Forms"); ?></th>
		</tr>

		<? foreach ($data as $row): ?>
			
			<tr id="<?= $row['pst_id'] ?>" class="row">

				<td>
					<span class="pst_brand"><?= $row['pst_brand']; ?></span>
					<span class="pst_article"><?= $row['pst_article']; ?></span>
					<br/>

					<div class="pst_name"><?= $row['pst_name']; ?></div>
				</td>

				<? foreach ($row as $key => $cell): ?>
					<? if (in_array($key, $systemCell) || !$columns[$key]['visible']) continue; ?>
					<td class="<?= $key; ?>"><?= $cell; ?></td>
				<? endforeach; ?>

				<td><input type="text" name="pst_manager_comment" id="pst_manager_comment" class="pst_manager_comment"
						   value="<?= htmlspecialchars($row['pst_manager_comment']); ?>"/></td>

				<td><span class="reference"><?= $row['reference']; ?></span></td>
				<td class="order_number_template"><?= $row['OrderNumberTemplate']; ?></td>
				<td><span class="pst_price"><?= ($row['pst_price_netto'] > 0.0 ? $row['pst_price_netto'] : $row['pst_price']) ?></span></td>
				<td><?= $row['pst_amount']; ?><?= tr('шт.', "web_order"); ?></td>
				<td><span class="pst_summ"><?= $row['pst_summ']; ?></span></td>

				<td class="loader">
					<?= $row['pst_status'] ?>
				</td>
			</tr>
			<tr class="alt_tr">
				<td colspan="<?= $colCount ?>" class="alt">
					<div id="res<?= $row['pst_id'] ?>" class="resdiv"></div>
				</td>
			</tr>
		<? endforeach; ?>
		<tr>
			<td>
				<div id="row<?= $prv ?>" class="tableLoad hide"></div>
			</td>
		</tr>
	</table>

	<? if ($PROCEED): ?>
		<input class="hide" type="submit" name="submit" id="submit<?= $prv ?>" value="<?= tr("оформить", "web_order"); ?>"
			onclick="proceedOrder(this, '<?= $prv ?>', '<?= $PROVIDER ?>', '<?= $PROVIDER_ID ?>', false);"/>

		<input class="hide" type="submit" name="submit" id="submit<?= $prv ?>Test" value="<?= tr("посмотреть запрос", "web_order"); ?>"
			onclick="proceedOrder(this, '<?= $prv ?>', '<?= $PROVIDER ?>', '<?= $PROVIDER_ID ?>', true);"/>
	<? endif; ?>
	<span id="orderinfo<?= $prv ?>"></span>

</div>
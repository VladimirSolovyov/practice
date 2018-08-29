<h1><?= $MSG['BasketModule']['msg33']; ?></h1>

<div><?= $return ?></div>

<?
if (!empty($baskets)) {
	 ?><div class="mc-switch">
	<div class="mc-switch__label">
		<?= tr('Ваши корзины', 'MultiCurrency') ?>:
	</div>
	<? foreach ($baskets as $basketInfo) { ?>
		<? if ($basketInfo['active']) { ?>
			<span class="mc-switch__item mc-switch__item--active"><?= $basketInfo['sum'] ?> <?= $basketInfo['sign'] ?></span>
		<? } else { ?>
			<a href="<?= $basketInfo['url'] ?>" class="mc-switch__item" data-basket-switch data-id="<?= $basketInfo['id'] ?>"><?= $basketInfo['sum'] ?> <?= $basketInfo['sign'] ?></a>
		<? } ?>
	<? } ?>
</div><? 
}
if ($_interface->csUseMultiCurrency) {
	 ?><div id="currency-change-modal" class="basket-currency-change__modal hidden" data-currency="<?= $_interface->nativeCurInfo['id'] ?>">
	<div class="basket-currency-change__body">

		<div class="basket-currency-change__header">
			<?= tr('Изменить валюту', 'MultiCurrency') ?>
		</div>

		<div class="basket-currency-change__comut-container">
			<span class="basket-currency-change__currency-original">
				<?= $_interface->nativeCurInfo['name'] ?>
			</span>
			<span><?= tr('на') ?></span>
			<span class="basket-currency-change__currency-select"><?= $currenciesControl ?></span>
		</div>
	</div>
	<div class="basket-currency-change__footer">
		<div class="basket-currency-change__footer-text">
			<?= tr('Позиция будет перенесена в корзину', 'MultiCurrency') ?> <span currency-selected class="basket-currency-change__footer-currency"></span>
		</div>
		<button currency-change-find class="basket-currency-change__edit-button"><?= tr('Изменить') ?></button>
	</div>
</div><? 
}

$web_ar_datagrid = $basket;
$web_ar_datagrid = $basket['fields']['basket']['html'];
$web_ar_datagrid_source = $basket['sourceFields']['basket']['instance']->datasource;?>

<?= $basket['validationScript'] ?>
<? if (!empty($export)): ?>
	<form id="<?= $export['id'] ?>" name="<?= $export['name'] ?>" action="<?= $export['action'] ?>"
		  method="<?= $export['method'] ?>" onsubmit="<?= $export['onsubmit'] ?>">
		<? if ($export['fields']['exportLink']['html']) { ?>
			<?= $export['fields']['exportLink']['html'] ?>
		<? } ?>
	</form>
<? endif ?>
<form id="<?= $basket['id'] ?>" name="<?= $basket['name'] ?>" action="/admin/eshop/order.html?func=upd"
	  method="<?= $basket['method'] ?>" onsubmit="<?= $basket['onsubmit'] ?>">

	<div class="sys_basket_add_button" style="margin: 10px 0 20px 0px;">
		<?= $basket['fields']['add']['html'] ?>
		<? if ($basket['fields']['import']['html']) { ?>
			<script type="text/javascript">
				function import2basket(e, skript_dest) {

					var
						a = screen.availWidth,
						b = screen.availHeight,
						c = parseInt(a * 0.8),
						d = parseInt(b * 0.6);

					a = parseInt((a - c) / 2);
					b = parseInt((b - d) / 2);

					window.open((skript_dest || "/shop/import_to_basket.html") + "?script=" + (e || "") + "&basket_admin=1", "import2basket", "width=" + c + ",height=" + d + ",toolbar=0,location=0,directories=0,menubar=0,scrollbars=yes,status=0,resizable=yes,top=" + b + ",screenY=" + b + ",left=" + a + ",screenX=" + a).focus();

				};

			</script>
			<?= $basket['fields']['import']['html'] ?>
		<? } ?>
	</div>

	<? if (!$BASKET_EMPTY){ ?>

		<? $data_align = array('center', 'center', 'center', 'center', 'center', 'center', 'center'); ?>

		<?  ?><?
$i = 0;
if (!empty($web_ar_datagrid['controls']))
	foreach ($web_ar_datagrid['controls'] as $hdr_id => $control) {
		if ((empty($control_align[$i])) or ($control_align[$i] == 'top')) {

			?><div class="table_control"><?= $control ?></div><?

		}
		$i++;
	}
?>

<? if (count($web_ar_datagrid['data']) > 0) { ?>

	<table border="0" cellpadding="3" cellspacing="1" class="web_ar_datagrid" width="100%">
		<tr>
			<? foreach ($web_ar_datagrid['header'] as $hdr_id => $column) { ?>

				<? if ($column['visible'] != '1') continue; ?>

				<th><?= $column['caption'] ?></th>

			<? } ?>
		</tr>

		<? foreach ($web_ar_datagrid['data'] as $row => $item) { ?>

			<tr class="<?= toggleEvenOdd() ?>">

				<? $i = 0; ?>
				<? foreach ($web_ar_datagrid['header'] as $hdr_id => $column) { ?>

					<? if ($column['visible'] != '1') continue; ?>

					<td<?= (!empty($data_align[$i]) ? ' align="' . $data_align[$i] . '"' : '') ?>>

						<?=$item[$hdr_id]?>

						<? if($hdr_id=='amount') { ?>
							<? if (($item['min_quantity'] > 1) ) { ?>
								<?=str_replace('{%min_quantity%}', $item['min_quantity'], $MSG['BasketModule']['msg58'])?>
							<? } ?>
						<? } ?>

					</td>

					<? $i++; ?>

				<? } ?>

			</tr>

		<? } ?>
	</table>

<? } else { ?>

	<p><?= $empty_message ?></p>

<? } ?>

<? if($USE_MIN_QUANTITY) { ?>
	<div class="notice"><?=$MSG['BasketModule']['msg56']?></div>
<? } ?>

<?
$i = 0;
if (!empty($web_ar_datagrid['controls'])) {
	foreach ($web_ar_datagrid['controls'] as $hdr_id => $control) {
		if ($control_align[$i] == 'bottom') {

			?><div class="table_control"><?= $control ?></div><?

		}
		$i++;
	}
}
?>
<?  ?>

		<div style="text-align: center;margin:5px 0 15px 0"><b><?= $MSG['BasketModule']['msg35'] ?> <?= $AMOUNT ?>, <?= $MSG['BasketModule']['msg36'] ?> <?= $SUMM ?></b></div>

		<div class="sysCSS_basket_button" style="margin:10px 0 10px 0">
			<div class="sysCSS_basket_cancel_button" style="float: left;margin-right:3px;"><?= $basket['fields']['cancel']['html'] ?></div>
			<div class="sysCSS_basket_save_button" style="float: left;"><?= $basket['fields']['save_amount']['html'] ?></div>
			<div class="sysCSS_basket_order_button" style="float: right;"><?= $basket['fields']['save_order']['html'] ?></div>
			<div class="sysCSS_basket_order_button" style="float: right;margin-right:3px;"><?= $basket['fields']['self_order']['html'] ?></div>
		</div>

	<? } else { ?>

		<?= $BASKET_EMPTY ?>

	<? } ?>

</form>
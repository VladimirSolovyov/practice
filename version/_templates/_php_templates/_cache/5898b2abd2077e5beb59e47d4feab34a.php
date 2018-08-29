<?
$web_ar_datagrid = $basket['fields']['basket']['html'];
$web_ar_datagrid_source = $basket['sourceFields']['basket']['instance']->datasource;
$data_align = array('left', 'left', 'left', 'left', 'center', 'left', 'right', 'left', 'left', 'left');
?>

<?= $basket['validationScript'] ?>
<form id="<?= $basket['id'] ?>" name="<?= $basket['name'] ?>" action="<?= $basket['action'] ?>" method="<?= $basket['method'] ?>" onsubmit="<?= $basket['onsubmit'] ?>">

<script language="JavaScript">

function customCheckBasket(arg) {

	var inputFields = new Array();

	if (arg.elements.length > 0) {				

		for (i=0; i < arg.elements.length; i++) {

			level2 : {

				nameStr = new String();
				nameStr = arg.elements[i].name;

				if (arg.elements[i].type == "text" && nameStr.indexOf('name')>=0) {

					clearReg = /[\s\t-]/;

					checkStr = new String();
					checkStr = arg.elements[i].value;
					checkStr.replace(clearReg);

					if (checkStr == "") {
					
						alert('<?=$_interface->MSG['BasketModule']['msg50']?>');
						arg.elements[i].focus();
						
						return false;

					}

				}			

			}	

		}

	}

	return true;

}
</script>
	<?  ?><div class="basket-page__header">

	<script type="text/javascript">
		function import2basket(e,skript_dest){
			var
				a=screen.availWidth,
				b=screen.availHeight,
				c=parseInt(a*0.8),
				d=parseInt(b*0.6);

			a=parseInt((a-c)/2);
			b=parseInt((b-d)/2);

			window.open((skript_dest||"/shop/import_to_basket.html")+"?script="+(e||""),"import2basket","width="+c+",height="+d+",toolbar=0,location=0,directories=0,menubar=0,scrollbars=yes,status=0,resizable=yes,top="+b+",screenY="+b+",left="+a+",screenX="+a).focus()
		};
	</script>
	<h1 class="basket-page__h1"><?= mb_ucfirst($MSG['BasketModule']['msg33']); ?></h1>
	<div>
		<?=$addButtonLink?>
		<?= $importButtonLink ?>
		<? if (!$BASKET_EMPTY): ?>
			<?= $cancelButtonLink ?>
		<? endif ?>
	</div>
</div><?  ?>
	<? if (!$BASKET_EMPTY): ?>

		<div id="basket_table">
			<?  ?><?
$i = 0;
if (!empty($web_ar_datagrid['controls'])) {
	foreach ($web_ar_datagrid['controls'] as $hdr_id => $control) {
		if ((empty($control_align[$i])) or ($control_align[$i] == 'top')) {
			?>
			<div class="table_control"><?= $control ?></div><?
		}
		$i++;
	}
}

?>

<? if (count($web_ar_datagrid['data']) > 0) { ?>

	<?
		$hide_cols = array('weight_display', 'info');//ячейки, которые не попадут в таблицу
		$hide_captions = array('comment');
		$mobile_captions = ['article', 'brand', 'price', 'amount', 'name'];//заголовки ячеек, которые попадут на моб устройства
		$colMobileTitles = [];//заголовки для ячеек на моб устройствах
		$tdCount = 0; //счетчик кол-ва ячеек, которые попадут в таблицу
	?>

	<table class="adapt-table basket-table basket-page__table">
		<thead class="adapt-table__thead">
		<tr class="adapt-table__thead-tr">
			<? foreach ($web_ar_datagrid['header'] as $hdr_id => $column) { ?>

				<? if (($column['visible'] != '1') or (in_array($hdr_id, $hide_cols))) continue; ?>
				<?
				if(!in_array($hdr_id, $hide_captions) && in_array($hdr_id, $mobile_captions)) {
					$colMobileTitles[$hdr_id] = $column['caption'];
				}
				$tdCount++;
				?>
				<th class="adapt-table__th basket-table__th basket-table__th_title_<?=$hdr_id?>"><?= (!in_array($hdr_id, $hide_captions) ? $column['caption'] : '') ?></th>

			<? } ?>

			<?
				$__BUFFER->addScript('/_syslib/modules/module.inputNumberControl.js');
				$__BUFFER->addJsInit("
				var initAmountFix = function(){
					var amounts = document.querySelectorAll('.basket-table__td_title_amount input');
					if(amounts) {
						var i, inp;
						for(i = 0; i < amounts.length; i++) {
							inp = new InputNumberControl({
								input: amounts[i]
							});
							inp.wrapper.classList.add('basket-table__row-count-control');
						}
					}
				};

				initAmountFix();

				jqWar(document).on('basketReload',function(){
					initAmountFix();
				});

				");
				$__BUFFER->addJsInit("if(window.basketPage) window.basketPage.setColMobileTitles(" . json_encode($colMobileTitles) . ");");
			?>
		</tr>
		</thead>
		<tbody class="adapt-table__tbody">
		<? foreach ($web_ar_datagrid['data'] as $row => $item) { ?>

			<tr class="adapt-table__tr">

				<? if(isset($item['mobile_row_head'])) { ?>
					<td class="adapt-table__tr-head"><?=$item['mobile_row_head']?></td>
				<? } ?>

				<? $i = 0; ?>

				<? foreach ($web_ar_datagrid['header'] as $hdr_id => $column) { ?>

					<? if (($column['visible'] != '1') or (in_array($hdr_id, $hide_cols))) continue; ?>

					<td class="adapt-table__td adapt-table__td_title_<?= $hdr_id ?> basket-table__td basket-table__td_title_<?= $hdr_id ?>">

						<? if ($hdr_id == 'cost_per_weight_display') { ?>

							+ <?= $item[$hdr_id] ?> <?= (!empty($item['weight_display']) ? ' / ' . $item['weight_display'] . ' ' . $MSG['BasketModule']['msg19'] : '') ?>

						<? } elseif ($hdr_id == 'chPos') { ?>

							<?
							$matches = [];
							preg_match('/id=\"(.*)\"/i',$item[$hdr_id],$matches);
							?>

							<?= $item[$hdr_id] ?><label for="<?=$matches[1]?>"></label>

						<? } elseif ($hdr_id == 'summ') { ?>

							<strong><?= $item[$hdr_id] ?></strong>

							<? if (($item['cost_per_weight_value'] > 0) && (empty($item['weight']))) { ?>
								<span title="<?= $MSG['BasketModule']['msg41'] ?>">
									<svg class="basket-table__td-svg-icon">
										<use xlink:href="/_sysimg/svg/notice-sprite.svg#cursor-aim"></use>
									</svg>
								</span>
							<? } ?>

						<? } elseif ($hdr_id == 'comment') { ?>

							<div class="click-comment basket-page__click-comment" title="<?=($basket_page === 'make_order' ? tr('Нажмите, чтобы посмотреть комментарий','BasketModule') : tr('Нажмите, чтобы добавить комментарий','BasketModule'))?>">
								<svg class="click-comment__svg-icon"><use xlink:href="/_sysimg/svg/notice-sprite.svg#comment"></use></svg>
								<div class="click-comment__show-area">
									<?= $item[$hdr_id] ?>
								</div>
							</div>

						<? } else { ?>

							<?
							if ($item['manualAdd'] != 1 and in_array($hdr_id, Array('brand', 'article', 'price'))) {
								echo $web_ar_datagrid_source[$row][$hdr_id];
							} else {
								echo $item[$hdr_id];
							}

							?>

						<? } ?>

					</td>

					<? $i++; ?>

				<? } ?>

			</tr>

		<? } ?>
		</tbody>
		<? if ($basket_page == 'make_order') { ?>
			<tbody id="deliveryBody" style="display:none;">
				<tr class="adapt-table__tr basket-table__tr-delivery">
					<? $i = 0; ?>
					<? foreach ($web_ar_datagrid['header'] as $hdr_id => $column) { ?>

						<? if (($column['visible'] != '1') or (in_array($hdr_id, $hide_cols))) continue; ?>

						<td class="adapt-table__td adapt-table__td_title_<?= $hdr_id ?> basket-table__td basket-table__td_title_<?= $hdr_id ?>">
							<? if ($hdr_id == 'name') { ?>
								<?= $MSG['MakeOrderModule']['msg64'] ?>
							<? } elseif ($hdr_id == 'summ') { ?>
								<span id="deliveryDiv"></span>
							<? } ?>
						</td>

						<? $i++; ?>

					<? } ?>
				</tr>
			</tbody>
		<? } ?>
	</table>

	<div class="basket-page__summary">
		<?= $MSG['BasketModule']['msg54'] ?>
		<div id="orderSumAmount" class="basket-table__summary-count"><?= $AMOUNT_SUMM ?> <?= $MSG['BasketModule']['msg55'] ?></div>
		<div id="orderSumm" class="basket-table__summary-price" ><?= $SUMM ?></div>
	</div>

<? } else { ?>

	<p><?= $empty_message ?></p>

<? } ?>

<?
$i = 0;
if (!empty($web_ar_datagrid['controls'])) {
	foreach ($web_ar_datagrid['controls'] as $hdr_id => $control) {
		if ($control_align[$i] == 'bottom') {

			?>
			<div class="table_control"><?= $control ?></div><?

		}
		$i++;
	}
}
?><?  ?>
		</div>

		<?  ?><div class="basket-page__bottom">
	<div class="basket-page__bottom-messages">
		<div class="basket-page__bottom-common">
			<p><?= tr('Срок хранения товаров в корзине:', 'BasketModule') ?> <?= $MaxBasketLife ?> <?= $MSG['BasketModule']['msg48'] ?></p>
			<p><?= $MSG['BasketModule']['msg49'] ?> <?= $BasketLife ?> <?= $MSG['BasketModule']['msg48'] ?></p>
		</div>
		<?  ?>		<?if($MIN_ORDER_SUMM):?>
			
			<div class="message message_type_error">
				<div class="message__text">
					<p><?=$MSG['Forms']['msg5']?></p>
					<p><?=$MSG['BasketModule']['msg39']?>: <span class="warning_value"><?=$MIN_ORDER_SUMM?></span>
						<br/><?=$MSG['BasketModule']['msg40']?></p>
				</div>
			</div>
		
		<?endif?>
		
		<?if($RESTRICT_FUND_REMAINS):?>
			
			<div class="message message_type_error">
				<div class="message__text">
					<p><?=$MSG['Forms']['msg5']?></p>
					<p><?=$MSG['BasketModule']['msg46']?> <span class="warning_value"><?=$FUND_REMAINS?></span></p>
				</div>
			</div>
			
		<?elseif($FUND_REMAINS):?>
			
			<div class="message message_type_error">
				<div class="message__text">
					<p><?=$MSG['Forms']['msg5']?></p>
					<p><?=$MSG['BasketModule']['msg45']?> <span class="warning_value"><?=$FUND_REMAINS?></span></p>
				</div>
			</div>
		
		<?elseif($RESTRICT_DEBT_SUMM):?>
			
			<div class="message message_type_error">
				<div class="message__text">
					<p><?=$MSG['Forms']['msg5']?></p>
					<p><?=$MSG['BasketModule']['msg43']?> <span class="warning_value"><?=$MAX_DEBT_SUMM?></span></p>
				</div>
			</div>

		<?elseif($MAX_DEBT_SUMM):?>
			
			<div class="message message_type_error">
				<div class="message__text">
					<p><?=$MSG['Forms']['msg5']?></p>
					<p><?=$MSG['BasketModule']['msg42']?> <span class="warning_value"><?=$MAX_DEBT_SUMM?></span></p>
				</div>
			</div>
			
		<?endif?><?  ?>
		<div class="info-notice-list basket-page__bottom-notice">
			<? if($USE_MIN_QUANTITY) { ?>
				<div class="info-notice-list__item">
					<?=tr('Количество товаров, отмеченных данным значком, изменяется только кратно минимальной партии данного товара!', 'BasketModule');?>
				</div>
			<? } ?>
			<div class="info-notice-list__item">
				<svg class="info-notice-list__svg-icon"><use xlink:href="/_sysimg/svg/notice-sprite.svg#cursor-aim"></use></svg>
				<?=tr('Стоимость товаров, отмеченных данным значком, не является конечной и требует согласования с менеджером!', 'BasketModule');?>
			</div>
			<div class="info-notice-list__item">
				<svg class="info-notice-list__svg-icon"><use xlink:href="/_sysimg/svg/notice-sprite.svg#x_round"></use></svg>
				<?=tr('Если Вы хотите удалить деталь из списка, то воспользуйтесь этим значком', 'BasketModule');?>
			</div>
			<div class="info-notice-list__item">
				<svg class="info-notice-list__svg-icon"><use xlink:href="/_sysimg/svg/notice-sprite.svg#comment"></use></svg>
				<?=truc('комментарий к позиции', 'Forms');?>
			</div>
		</div>
	</div>

	<div class="basket-page__bottom-action">
		<?=$basket['fields']['save_amount']['html']?>
		<? if(!$MIN_ORDER_SUMM and !$RESTRICT_DEBT_SUMM): ?>
			<?=$basket['fields']['save_order']['html']?>
		<?endif?>
	</div>
</div><?  ?>



	<? else: ?>

		<div class="warning"><?= $BASKET_EMPTY ?></div>

	<?endif ?>



</form>
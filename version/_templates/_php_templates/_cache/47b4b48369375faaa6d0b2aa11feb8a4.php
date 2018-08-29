<? if ($_interface->domain) { ?>

	<?  ?><h1><?= $MSG['PositionListModule']['msg29'] ?></h1>

<?

if (is_array($positions)) {

	if (sizeof($positions['data']) > 0) {

		?>

		<? if ($positions['controls']) { ?>
			<div align="center">
				<? foreach ($positions['controls'] as $hdr_id => $control) { ?>

					<?= $control ?>

				<? } ?>
			</div>
		<? } ?>

		<table border="0" class="web_ar_datagrid" style="font-size: 11px" cellpadding="2">

			<tr>
				<? foreach ($positions['header'] as $hdr_id => $column) { ?>
					<? if ($column['visible'] == true) { ?>
						<th><?= $column['caption'] ?></th>
					<? } ?>
				<? } ?>
			</tr>

			<? foreach ($positions['data'] as $dat_id => $row) { ?>

				<? if ($row['pst_ord_id'] == '') { ?>

					<? $row['stt_style'] = 'background:#990000; color: #FFFFFF'; ?>
					<? $total_value = 1; ?>

				<? } else { ?>

					<? $total_value = 0; ?>

				<? } ?>

				<tr<?= ($row['stt_style'] != '' ? ' style="' . $row['stt_style'] . '"' : '') ?>>

					<? foreach ($positions['header'] as $hdr_id => $column) { ?>

						<? if ($column['visible'] == true) { ?>

							<td align="center">

								<? if ($hdr_id == "summ") { ?>

									<nobr><?= $row[$hdr_id] ?></nobr>

								<? } elseif ($hdr_id == "cost_per_weight") { ?>

									<? if (($row['pst_cost_per_weight'] > 0) && ($row['pst_weight'] == 0)) { ?>
										<nobr>+<?= $row[$hdr_id] ?>/<?= $MSG['PositionListModule']['msg48'] ?></nobr>
									<? } ?>

									<? if (($row['pst_weight']) && ($row['pst_weight'] > 0)) { ?>
										<img src="/_sysimg/ar2/weight.gif" border="0"
											 title="<?= $MSG['SearchModule']['msg19'] ?> = <?= number_format($row['pst_weight'], 3, '.', ' ') ?>"
											 alt="<?= $MSG['SearchModule']['msg19'] ?> = <?= number_format($row['pst_weight'], 3, '.', ' ') ?>"
											 hspace="2" align="absmiddle"/>
									<? } ?>

								<? } elseif ($hdr_id == "payed") { ?>

									<nobr><?= $row[$hdr_id] ?></nobr>

								<? } elseif ($hdr_id == "debt") { ?>

									<nobr><?= $row[$hdr_id] ?></nobr>

								<? } elseif ($hdr_id == "pst_article") { ?>

									<? if ($row['detail_change'] != "") { ?>
										<img src="/_sysimg/ar2/thinup.gif"
											 alt="<?= $MSG['SearchModule']['msg31'] ?> <?= $row['detail_change'] ?>"
											 title="<?= $MSG['SearchModule']['msg31'] ?> <?= $row['detail_change'] ?>"
											 hspace="2"/>
									<? } ?>

									<nobr>
										<? if ($row['pst_article_display'] != "") { ?>
											<?= $row['pst_article_display'] ?>
										<? } else { ?>
											<?= $row[$hdr_id] ?>
										<? } ?>
									</nobr>

								<? } elseif ($hdr_id == "pst_price") { ?>

									<? if (($row['pst_price'] == "") && ($total_value != 1)) { ?>

										<?= $MSG['PositionListModule']['msg44'] ?>

									<? } else { ?>

										<? if ($row['price_change'] != 0) { ?>
											<? $pimg_title = $MSG['PositionListModule']['msg32'] . ' ' . ($row['price_change'] > 0 ? $MSG['PositionListModule']['msg33'] : $MSG['PositionListModule']['msg34']) . ' ' . $MSG['PositionListModule']['msg35'] . ' ' . sprintf("%0.2f", abs($row['price_change'])); ?>
											<img
												src="/_sysimg/ar2/<?= ($row['price_change'] > 0 ? 'thinup' : 'thindown') ?>.gif"
												title="<?= $pimg_title ?>" alt="<?= $pimg_title ?>" hspace="2"/>
										<? } ?>

									<? } ?>

									<nobr><?= $row[$hdr_id] ?></nobr>

									<? if ($row['pst_phand'] != 0) { ?>

										<br/>
										<small><span id="phand"><?= $MSG['SearchModule']['msg20'] ?>&nbsp;<nobr><?= $row['pst_phand'] ?></nobr></span>
										</small>

									<? } ?>

								<? } elseif ($hdr_id == "pst_arrival_date") { ?>

									<? if ($row['term_change'] != 0) { ?>
										<? $timg_title = $MSG['PositionListModule']['msg32'] . ' ' . ($row['term_change'] > 0 ? $MSG['PositionListModule']['msg33'] : $MSG['PositionListModule']['msg34']) . ' ' . $MSG['PositionListModule']['msg36'] . ' ' . abs($row['term_change']); ?>
										<img
											src="/_sysimg/ar2/<?= ($row . term_change > 0) ? "thinup" : "thindown"; ?>.gif"
											title="<?= $timg_title ?>" alt="<?= $timg_title ?>" hspace="2"/>
									<? } ?>
									<nobr><?= $row[$hdr_id] ?></nobr>

								<? } elseif ($hdr_id == "pst_destination_display") { ?>

									<?= $row['pst_destination_display'] ?>

								<? } elseif ($hdr_id == "fl_return") { ?>
									<?  ?><? if ($row['fl_return']) { ?>
	<span class="ret_link_wrap fl-return" data-id="<?=$row['pst_id']?>">
		<a data-show-modal data-width="740" data-height="550"  data-href="/<?=($_interface->domain ? 'admin' : 'shop')?>/return-request/?fn=add<?=($_interface->domain ? '&from=dealer' : '')?>&pst_id=<?=$row['pst_id']?>" title="<?=($msg=tr("Подать запрос на возврат", 'position_returns'))?>" alt="<?=$msg?>">
			<svg class="click-comment__svg-icon" width="16" height="16"><use xlink:href="/_sysimg/svg/notice-sprite.svg#reload"></use></svg>
		</a>
	</span>
<? } elseif ($row['rss_name']) { ?>
	<span class="ret_link_wrap fl-return fl-return--new" data-id="<?=$row['pst_id']?>">
		<a class="fl-return__new" data-show-modal data-width="740" data-height="550" data-href="/<?=($_interface->domain ? 'admin' : 'shop')?>/return-request/?fn=state<?=($_interface->domain ? '&from=dealer' : '')?>&pst_id=<?=$row['pst_id']?>" title="<?=($msg=tr("Обсуждение по запросу", 'position_returns'))?>" alt="<?=$msg?>">
			<?=$row['rss_name'].($row['rrt_unread_msg'] ? ' ('.$row['rrt_unread_msg'].')' : '')?>
		</a>
	<? if ($row['rss_confirm'] and $_interface->csUsePrintDocuments) { ?>
		<a name="print" class="fl-return fl-return--print" href="/<?=($_interface->domain ? 'admin' : 'shop')?>/return-request/?fn=printSL<?=($_interface->domain ? '&from=dealer' : '')?>&pst_id=<?=$row['pst_id']?>" target="_blank">
			<img src="/_sysimg/print.gif">
		</a>
	<? } ?>
	</span>
<? } ?><?  ?>
								<? } else { ?>

									<?= $row[$hdr_id] ?>

								<? } ?>

							</td>

						<? } ?>

					<? } ?>

				</tr>

			<? } ?>

		</table>

		<script language="JavaScript">

			function checkAll() {

				var checkboxes = new Array();
				var cancelPosArr = new Array();
				var k = 0;

				if (hasDOM) {
					checkboxes = document.getElementsByTagName('input');
				}
				else {
					checkboxes = document.all.tags('input');
				}
				if (checkboxes.length && checkboxes.length > 0) {

					for (i = 0; i < checkboxes.length; i++) {

						if (checkboxes[i].type == 'checkbox' && checkboxes[i].name.toString().indexOf('cancelPos') > -1 && checkboxes[i].checked == true) {

							cancelPosArr[k++] = checkboxes[i].value;

						}

					}

				}
				if (k == 0) {

					alert('<?=$MSG['PositionListModule']['msg37']?>');
					return false;

				} else {

					if (confirm('<?=$MSG['PositionListModule']['msg38']?>')) {

						return cancelPosArr;

					} else {

						return false;

					}
				}

			}

		</script>

	<? } else { ?>

		<p><?= $MSG['PositionListModule']['msg45'] ?></p>

	<? } ?>

<? } else { ?>

	<?= $positions ?>

<? } ?><?  ?>

<? } else { ?>

	<?  ?><?
if (empty($positions['messages'])) {

	$exclude_filters = $_interface->csExcludePositionsFilters;
	$exclude_columns = ['cancelPos', 'fl_return', 'summ', 'debt'];

	$__BUFFER->addScript('/_syslib/modules/module.ClickComment.js');

	$__BUFFER->addJsInit("
			if(typeof ModuleClickComment !== 'undefined') {
				var comments = document.querySelectorAll('.positions-table__click-comment');
				if(comments) {
					for (i = 0; i < comments.length; ++i) {
						new ModuleClickComment({
							containerElement: comments[i]
						});
					}
				}
			}

			if(jqWar('a[rel=state_info]')) {
				jqWar('a[rel=state_info]').click(function() {
					open_tbox_frame(jqWar(this).attr('href'), 600, 500);
					return false;
				});
			}
		");

	$__BUFFER->addScript('/_syslib/modules/module.TableCellCheckbox.js');

	$__BUFFER->addJsInit("

		(function($) {

			var cancels = document.querySelectorAll('.positions-table__col_stt_name input[type=checkbox]');

			function setActiveTr(tr, state){
				if(state) {
					tr.classList.add('positions-table__tr--active');
				} else {
					tr.classList.remove('positions-table__tr--active');
				}
			};

			if(cancels) {

				if(typeof TableCellCustomCheckbox === 'function') {
					for (i = 0; i < cancels.length; ++i) {
						new TableCellCustomCheckbox({
							checkbox: cancels[i]
						});
					}
				}

				for (i = 0; i < cancels.length; ++i) {
						cancels[i].addEventListener('click', function(){
						var tr = $(this).parents('.positions-table__tr')[0];
						if(tr) {
							setActiveTr(tr, this.checked);
						}
					});
				}
			}

		})(jqWar);

		");

	$__BUFFER->addScript('/_syslib/baron/baron-v3.min.js');

	$__BUFFER->addJsInit("
			if(typeof baron !== 'undefined') {
				root = document.querySelector('.baron')
				scroller = document.querySelector('.baron__scroller');
				bar = document.querySelector('.baron__bar');
				track = document.querySelector('.baron__h-scroll');
								
				baron({
					root: root,
					impact: scroller,
					scroller: scroller,
					bar: bar,
					direction: 'h',
    				scrollingCls: '_scrolling', 
    				resizeDebounce: 1,
				})
				.controls({					
        			track: track,
				});
				
			}
		");

	?>
	<? if ($positions['controls']) { ?>
		<div align="center">
			<? foreach ($positions['controls'] as $hdr_id => $control) { ?>

				<? if ($hdr_id != 'pagination') { ?>
					<?= $control ?>
				<? } ?>

			<? } ?>
		</div>
	<? } ?>

	<? if (!empty($PHP_TEMPLATE['captionFilter_' . $positions['info']['name']])) { ?>

	<? if (!empty($cancelForm)) { ?>
		<?= $cancelForm['validationScript'] ?>
		<form id="<?= $cancelForm['id'] ?>" name="<?= $cancelForm['name'] ?>" action="<?= $cancelForm['action'] ?>" method="<?= $cancelForm['method'] ?>" onsubmit="<?= $cancelForm['onsubmit'] ?>">
			<?= $cancelForm['fields']['cancelPos']['html'] ?>
			<?= $cancelForm['fields']['_prid']['html'] ?>
			<?= $cancelForm['fields']['subj']['html'] ?>
		</form>
	<? } ?>

	<? $captionFilter = &$PHP_TEMPLATE['captionFilter_' . $positions['info']['name']]; ?>
	<?= $captionFilter['validationScript'] ?>
	<form id="<?= $captionFilter['id'] ?>" name="<?= $captionFilter['name'] ?>" action="<?= $captionFilter['action'] ?>" method="<?= $captionFilter['method'] ?>" onsubmit="<?= $captionFilter['onsubmit'] ?>">
		<div class="web-table-control positions-page__top-control">
			<div class="web-table-control__left btn-group">
				<a href="/shop/myorders.html" class="btn"><?= mb_ucfirst_char($_interface->MSG['OrderListModule']['msg11']) ?></a>
				<a href="/shop/myorders.html?tab=orders" class="btn btn_view_common"><?= mb_ucfirst_char($_interface->MSG['OrderListModule']['msg12']) ?></a>
			</div>
			<div class="web-table-control__right">
				<span class="positions-page__archive-check"><?= $captionFilter['fields']['archive']['html'] ?></span>
				<?= $cancelForm['fields']['actionButton']['html'] ?>
			</div>
		</div>
		<? } ?>

		<? if ($positions['controls']['pagination']) { ?>
			<div class="web-table-control positions-page__all-width-paginator">
				<?= $positions['controls']['pagination'] ?>
			</div>
		<? } ?>

		<?
		if ($captionFilter) {
			?>

			<div class="positions-page__filter inline-filter">
				<? foreach ($positions['header'] as $hdr_id => $column) { ?>
					<? if (!in_array($hdr_id, $exclude_filters) && $captionFilter['fields'][$hdr_id]['html']) { ?>
						<div class="inline-filter__item inline-filter__item_type_filter">
							<label class="inline-filter__label" for="<?= $hdr_id ?>"><?= $captionFilter['fields'][$hdr_id]['caption'] ?></label>

							<div class="inline-filter__control">
								<?= $captionFilter['fields'][$hdr_id]['html'] ?>
							</div>
						</div>
					<? } ?>
				<? } ?>
				<div class="inline-filter__item inline-filter__item_type_action">
					<label class="inline-filter__label"></label>

					<div class="inline-filter__control">
						<?= $captionFilter['fields']['filterSubmit_' . $positions['info']['name']]['html'] ?>
					</div>
				</div>
			</div>

		<? } ?>

		

		<?  ?><?  ?>

		<div class="positions-page__info-table baron">
			<div class="baron__h-scroll">
				<div class="baron__bar"></div>
			</div>
			<div class="baron__scroller">
				<table class="brief-table <?= $positions['info']['name'] ?>" width="100%">
					<tr class="brief-table__header">
						<? foreach ($positions['header'] as $hdr_id => $column) { ?>
							<? if ($column['visible'] == true && !in_array($hdr_id, $exclude_columns)) { ?>
								<? if ($hdr_id == "pst_date_arrival") { ?>
									<th class="positions-table__th positions-table__col_<?= $hdr_id ?>">
										<nobr><?= $column['caption'] ?> <?= $positions['header']['dcm_datetime']['caption'] ?>
											- <?= $positions['header']['pst_arrival_date']['caption'] ?></nobr>
									</th>
								<? } else { ?>

									<th class="positions-table__th positions-table__col_<?= $hdr_id ?>">
										<nobr>
											<? if ($hdr_id == "stt_name") { ?>
												<a href="/shop/state_legend.html" data-show-modal data-height="500" data-width="600"><?= $column['caption'] ?></a>
											<? } else { ?>
												<?= $column['caption'] ?>
											<? } ?>
										</nobr>
									</th>

								<? } ?>

							<? } ?>
						<? } ?>
					</tr>

					<? foreach ($positions['data'] as $dat_id => $row) {

						if (!$_interface->csColorRowPosition) $row['stt_style'] = '';
						?>

						<? if ($row['pst_ord_id'] == '') { ?>

							<? $total_value = 1; ?>

						<? } else { ?>

							<? $total_value = 0; ?>

						<? } ?>

						<tr class="positions-table__tr" <?= (!empty($row['stt_style']) ? 'style="' . $row['stt_style'] . '"' : '') ?>>
							<? $i = 0; ?>
							<? foreach ($positions['header'] as $hdr_id => $column) { ?>

								<? if ($column['visible'] == true && !in_array($hdr_id, $exclude_columns)) { ?>

									<td class="positions-table__td positions-table__col_<?= $hdr_id ?>" <?= (!empty($row['stt_style']) ? 'style="' . $row['stt_style'] . '"' : '') ?>>

										<?
										switch ($hdr_id) {
											case 'summ':
												 ?><nobr><?= $row[$hdr_id] ?></nobr>
<? 
												break;
											case 'stt_name':
												 ?>
<div class="stt-name-info stt-name-info_type_<?= $_interface->csShowStatusType ?>">

	<? if ($row['cancelPos']) { ?>
		<div class="stt-name-info__cancel">
			<?= $row['cancelPos']; ?>
		</div>
	<? } ?>

	<? if (($_interface->csShowStatusType === 'icon' || $_interface->csShowStatusType === 'combine') && trim($row['stt_icon'])) { ?>
		<a href="/shop/state_legend.html?pst_id=<?= $row['pst_id'] ?>" class="stt-name-info__icon" data-show-modal data-height="500" data-width="600">
			<img src="<?= $row['stt_icon'] ?>" alt="<?= $row[$hdr_id] ?>" class="stt-name-info__icon-img" title="<?= $row[$hdr_id] ?>"/>
		</a>
	<? } ?>

	<? if ($_interface->csShowStatusType === 'word' || $_interface->csShowStatusType === 'combine') { ?>
		<div class="stt-name-info__status-title">
			<?= $row[$hdr_id] ?>
		</div>
	<? } ?>

	<? if (!empty($_interface->csConfirmRequestState) && !empty($_interface->csConfirmedState) && !empty($_interface->csCancelStateValue) && ($row['pst_state_id'] == $_interface->csConfirmRequestState)) {
		$sLink = new cLink($_SERVER['REQUEST_URI'], '');
		$sLink->removeQueryParam("confirm_act_pos");
		$sLink->removeQueryParam("confirm_act");
		$sLink->addQueryParam("confirm_act_pos", $row['pst_id']);
		?>
		<div id="confirm_block_<?= $row['pst_id'] ?>" class="positions-table__confirm stt-name-info__confirm">
			<a href="<?= $sLink->link ?>&confirm_act=1" class="confirm-link confirm-link_yes" onclick="loadContent('confirm_block_<?= $row['pst_id'] ?>', '<?= $sLink->link ?>&confirm_act=1&ajax=1'); return false;" title="<?= tr('Подтвердить', 'PositionListModule') ?>"></a>
			<a href="<?= $sLink->link ?>&confirm_act=0" class="confirm-link confirm-link_no" onclick="loadContent('confirm_block_<?= $row['pst_id'] ?>', '<?= $sLink->link ?>&confirm_act=0&ajax=1'); return false;" title="<?= tr('Отказаться', 'PositionListModule') ?>"></a>
		</div>
	<? } ?>

</div><? 
												break;
											case 'pst_name_amount':
												 ?><div class="positions-table__data-cell positions-table__data-cell--name"><?= $row['pst_name'] ?></div>
<div class="positions-table__data-cell positions-table__data-cell--substring"><?= $row['pst_amount'] ?> <?= tr('шт.') ?></div>
<? 
												break;
											case 'pst_summ_debt':
												 ?><div class="positions-table__data-cell positions-table__data-cell--name"><?= $row['summ'] ?></div>
<? if((int)$row['debt'] <= 0) { ?>
	<div class="positions-table__data-cell positions-table__data-cell--paid"><?= $row['debt'] ?></div>
<? } else { ?>
	<div class="positions-table__data-cell positions-table__data-cell--debt">
		<? if($aiSyncEnabled) { ?>
			<?  ?><span data-tooltip="#debt-modal-<?=$row['pst_ref_id']?>"><?= tr('Не оплачено', 'PositionListModule') ?></span>
<div class="hide" id="debt-modal-<?=$row['pst_ref_id']?>">
	<div class="debt-modal">
		<div class="debt-modal__text"><?= tr('Долг по заказу', 'PositionListModule') ?>:</div>
		<div class="debt-modal__price"><?= $row['debt'] ?></div>
		<?= $row['pay_order_link'] ?>
	</div>
</div><?  ?>
		<? } else { ?>
			- <?= $row['debt'] ?>
		<? } ?>
	</div>
<? } ?>
<? 
												break;
											case 'pst_ord_id_ref_id':
												 ?><div class="positions-table__data-cell"><?= $row['pst_ord_id'] ?></div>
<div class="positions-table__data-cell positions-table__data-cell--substring"><?= $row['pst_ref_id'] ?></div>
<? 
												break;
											case 'pst_date_arrival':
												 ?><div class="positions-table__data-cell"><?= $row['dcm_datetime'] ?> —
	<? if ($row['term_change'] != 0) { ?>
		<? $timg_title = $MSG['PositionListModule']['msg32'] . ' ' . ($row['term_change'] > 0 ? $MSG['PositionListModule']['msg33'] : $MSG['PositionListModule']['msg34']) . ' ' . $MSG['PositionListModule']['msg36'] . ' ' . abs($row['term_change']); ?>
		<img src="/_sysimg/ar2/<?= ($row . term_change > 0) ? "thinup" : "thindown"; ?>.gif" title="<?= $timg_title ?>" alt="<?= $timg_title ?>" hspace="2"/>
	<? } ?>
	<nobr><?= $row['pst_arrival_date'] ?></nobr>
</div>
<div class="positions-table__data-cell positions-table__data-cell--substring"><?= $row['pst_destination_display'] ?></div>
<? 
												break;
											case 'pst_brand_article':
												 ?><? if (strpos($row['pst_brand'], ',') === 0) {
	$row['pst_brand'] = trim(substr($row['pst_brand'], 1));
} ?>

<div class="positions-table__data-cell"><?= $row['pst_brand'] ?></div>
<div class="positions-table__data-cell positions-table__data-cell--substring">
	<? if ($row['detail_change'] != "") { ?>
		<img src="/_sysimg/ar2/thinup.gif" alt="<?= $MSG['PositionListModule']['msg31'] ?> <?= $row['detail_change'] ?>" title="<?= $MSG['PositionListModule']['msg31'] ?> <?= $row['detail_change'] ?>" hspace="2"/>
	<? } ?>

	<? if ($row['pst_article_display'] != "") { ?>
		<?= $row['pst_article_display'] ?>
	<? } else { ?>
		<?= $row['pst_article'] ?>
	<? } ?>
</div>
<? 
												break;
											case 'pst_comment_fl_return':
												 ?><? if ($row['pst_comment']) { ?>
	<div class="click-comment positions-table__click-comment" title="<?= tr('Нажмите, чтобы посмотреть комментарий', 'Common') ?>">
		<svg class="click-comment__svg-icon">
			<use xlink:href="/_sysimg/svg/notice-sprite.svg#comment"></use>
		</svg>
		<div class="click-comment__show-area">
			<?= $row['pst_comment'] ?>
		</div>
	</div>
<? } ?>

<div class="positions-table__fl-return">
	<?  ?><? if ($row['fl_return']) { ?>
	<span class="ret_link_wrap fl-return" data-id="<?=$row['pst_id']?>">
		<a data-show-modal data-width="740" data-height="550"  data-href="/<?=($_interface->domain ? 'admin' : 'shop')?>/return-request/?fn=add<?=($_interface->domain ? '&from=dealer' : '')?>&pst_id=<?=$row['pst_id']?>" title="<?=($msg=tr("Подать запрос на возврат", 'position_returns'))?>" alt="<?=$msg?>">
			<svg class="click-comment__svg-icon" width="16" height="16"><use xlink:href="/_sysimg/svg/notice-sprite.svg#reload"></use></svg>
		</a>
	</span>
<? } elseif ($row['rss_name']) { ?>
	<span class="ret_link_wrap fl-return fl-return--new" data-id="<?=$row['pst_id']?>">
		<a class="fl-return__new" data-show-modal data-width="740" data-height="550" data-href="/<?=($_interface->domain ? 'admin' : 'shop')?>/return-request/?fn=state<?=($_interface->domain ? '&from=dealer' : '')?>&pst_id=<?=$row['pst_id']?>" title="<?=($msg=tr("Обсуждение по запросу", 'position_returns'))?>" alt="<?=$msg?>">
			<?=$row['rss_name'].($row['rrt_unread_msg'] ? ' ('.$row['rrt_unread_msg'].')' : '')?>
		</a>
	<? if ($row['rss_confirm'] and $_interface->csUsePrintDocuments) { ?>
		<a name="print" class="fl-return fl-return--print" href="/<?=($_interface->domain ? 'admin' : 'shop')?>/return-request/?fn=printSL<?=($_interface->domain ? '&from=dealer' : '')?>&pst_id=<?=$row['pst_id']?>" target="_blank">
			<img src="/_sysimg/print.gif">
		</a>
	<? } ?>
	</span>
<? } ?><?  ?>
</div>
<? 
												break;
											case 'cost_per_weight':
												 ?><? if (($row['pst_cost_per_weight'] > 0) && ($row['pst_weight'] == 0)) { ?>
	<nobr>+<?= $row[$hdr_id] ?>
		/<?= $MSG['PositionListModule']['msg48'] ?></nobr>
<? } ?>

<? if (($row['pst_weight']) && ($row['pst_weight'] > 0)) { ?>
	<img src="/_sysimg/ar2/weight.gif" border="0" title="<?= $MSG['PositionListModule']['msg19'] ?> = <?= number_format($row['pst_weight'], 3, '.', ' ') ?>" alt="<?= $MSG['PositionListModule']['msg19'] ?> = <?= number_format($row['pst_weight'], 3, '.', ' ') ?>" hspace="2" align="absmiddle"/>
<? } ?>
<? 
												break;
											case 'pst_price':
												 ?><? if (($row['pst_price'] == "") && ($total_value != 1)) { ?>

	<?= $MSG['PositionListModule']['msg44'] ?>

<? } else { ?>

	<? if ($row['price_change'] != 0) { ?>
		<? $pimg_title = $MSG['PositionListModule']['msg32'] . ' ' . ($row['price_change'] > 0 ? $MSG['PositionListModule']['msg33'] : $MSG['PositionListModule']['msg34']) . ' ' . $MSG['PositionListModule']['msg35'] . ' ' . sprintf("%0.2f", abs($row['price_change'])); ?>
		<img src="/_sysimg/ar2/<?= ($row['price_change'] > 0 ? 'thinup' : 'thindown') ?>.gif" title="<?= $pimg_title ?>" alt="<?= $pimg_title ?>" hspace="2"/>
	<? } ?>

<? } ?>

<nobr><?= $row[$hdr_id] ?></nobr>

<? if ($row['pst_phand'] != 0) { ?>

	<br/>
	<small><span id="phand"><?= $MSG['PositionListModule']['msg20'] ?>&nbsp;<nobr><?= $row['pst_phand'] ?></nobr></span>
	</small>

<? } ?>
<? 
												break;
											default:
												echo $row[$hdr_id];
												break;
										}
										?>

									</td>

								<? } ?>
								<? $i++; ?>
							<? } ?>

						</tr>

					<? } ?>
				</table>
			</div>
			<? if (empty($positions['data'])) { ?>
				<div class="brief-table__empty-message"><?= $MSG['Common']['msg4'] ?></div>
			<? } ?>

		</div>

		<?  ?><? if ($positions['total']['debt'] && $positions['total']['summ']) { ?>
	<div class="positions-table__total-info">
		<div class="total-info">
			<div class="total-info__label">
				<?= $MSG['Common']['msg5'] ?>
			</div>
			<div class="total-info__data">
				<div class="total-info__data-row positions-table__total-summ"><?= $positions['total']['summ'] ?></div>
				<div class="total-info__data-row <?= ((int)$positions['total']['debt'] > 0 ? 'positions-table__data-cell--debt' : 'positions-table__data-cell--paid') ?>"><?= ((int)$positions['total']['debt'] > 0 ? '-' : '') ?><?= $positions['total']['debt'] ?></div>
			</div>
		</div>
	</div>
<? } ?><?  ?>


		<? if (!empty($PHP_TEMPLATE['captionFilter_' . $positions['info']['name']])) { ?>

	</form>

<? } ?>

	<script language="JavaScript">

		function checkAll() {

			var checkboxes = new Array();
			var cancelPosArr = new Array();
			var k = 0;

			if (hasDOM) {
				checkboxes = document.getElementsByTagName('input');
			}
			else {
				checkboxes = document.all.tags('input');
			}


			if (checkboxes.length && checkboxes.length > 0) {

				for (i = 0; i < checkboxes.length; i++) {

					if (checkboxes[i].type == 'checkbox' && checkboxes[i].name.toString().indexOf('cancelPos') > -1 && checkboxes[i].checked == true) {

						cancelPosArr[k++] = checkboxes[i].value;

					}

				}

			}


			if (k == 0) {

				alert('<?=$MSG['PositionListModule']['msg37']?>');
				return false;

			} else {

				if (confirm('<?=$MSG['PositionListModule']['msg38']?>')) {

					return cancelPosArr;

				} else {

					return false;

				}


			}

		}

	</script>

<? } else { ?>

	<? $process_messages = &$positions; ?>
	<?  ?><? if (count($process_messages['messages']) > 0) {
	
	foreach($process_messages['messages'] as $message) { ?>

		<?=$message?>
		
	<? }

} ?><?  ?>

<? } ?><?  ?>

<? } ?>
<? if ($_interface->domain) { ?>

	<?  ?><h1><?=$MSG['OrderListModule']['msg9']?></h1>

<? if (!is_array($orders)) { ?>
	
	<?=$orders?>
	
<? } else { ?>

	<? $web_ar_datagrid = &$orders; ?>
	<? $empty_message = $MSG['OrderListModule']['msg10']?>
	<? $data_align = array('center','center','center','center','center','center','center'); ?>
	<? $control_align = array('top','bottom'); ?>
	<?  ?><div class="web-table__wrapper web-table__wrapper_<?=$web_ar_datagrid['info']['name']?>">

<div class="flc">
<? if (count($web_ar_datagrid['controls'])>0) { ?>
	<? $i=0; ?>
	<? foreach ($web_ar_datagrid['controls'] as $hdr_id=>$control) { ?>

		<? if ((empty($control_align[$i])) or ($control_align[$i] == 'top')) { ?>

		<div class="web-table__paginator web-table__paginator_<?=$web_ar_datagrid['info']['name']?> flc"><?=$control?></div>
		
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

	<div class="web_ar_datagrid web-table">
		<div class="web-table-header">
		<? $col_num = 0; $total_begin = 0; ?>
		<? foreach ($web_ar_datagrid['header'] as $hdr_id=>$column) {	?>
			
			<? if ($column['visible'] != '1') continue; ?>
			
			<div class="web-table-header__col web-table__<?= $hdr_id ?>">
				
				
				<? if (!empty($column['clm_info'])) { ?>
					<span class="tipz" title="<?=$column['clm_info']?>"></span>
				<? } ?>
				
				<?=$column['caption']?>

			</div>
			
			<? if ((empty($web_ar_datagrid['total'][$hdr_id])) && ($total_begin == $col_num)) { ?>
				<? $total_begin++; ?>
			<? } ?>
			
			<? $col_num++; ?>
		<? } ?>
		</div>
		
		
		<? if ($captionFilter) { ?>
				
			<div class="web-table-filter">
				<? foreach ($web_ar_datagrid['header'] as $hdr_id=>$column) {	?>
					
					<? if ($column['visible'] != '1') continue; ?>
					
					<div class="web-table__col web-table__col_<?= $hdr_id ?>">
						
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
					</div>

				<? } ?>
			</div>
				
		<? } ?>

			<? foreach ($web_ar_datagrid['data'] as $row=>$item) { ?>
				
				<div class="web-table__row">
					
					<? $i=0; ?>
					<? foreach ($web_ar_datagrid['header'] as $hdr_id=>$column) {	?>
					
						<? if ($column['visible'] != '1') continue; ?>
						
						<div class="web-table__col web-table__col_<?= $hdr_id ?>"<?=(!empty($data_align[$i])?' align="'.$data_align[$i].'"':'')?>><?=$item[$hdr_id]?></div>
						
						<? $i++; ?>
						
					<? } ?>
					
				</div>
				
			<? } ?>
		
		
		<? if (count($web_ar_datagrid['total']) > 0) { ?>
			<div class="web-table__row web-table__row--total">
				<? if ($total_begin > 0) { ?>
					<div class="web-table__col"></div>
					<div class="web-table__col"></div>
					<div class="web-table__col web-table__col_total"><?=$MSG['Common']['msg5']?></div>
				<? } ?>
				<? foreach ($web_ar_datagrid['header'] as $hdr_id=>$column) {	?>
				
					<? if (($column['visible'] != '1') or ((++$total_counter <= $total_begin) && ($total_begin != 0))) continue; ?>
					
					<div class="web-table__col web-table__col_total_summ"><?=$web_ar_datagrid['total'][$hdr_id]?></div>
					
				<? } ?>
			</div>
		<? } ?>
	</div>

	<? if (empty($web_ar_datagrid['data'])) { ?>
		<div class="brief-table__empty-message"><?= $MSG['Common']['msg4'] ?></div>
	<? } ?>

	<? if (!empty($PHP_TEMPLATE['captionFilter_'.$web_ar_datagrid['info']['name']])) { ?>

	</form>

	<? } ?>

<? } else { ?>

	<div class="message message_type_info">
		<div class="message__text">
			<?=$empty_message?>
		</div>
	</div>

<? } ?>


<? if (count($web_ar_datagrid['controls'])>0) { ?>
	<? $i=0; ?>
	<? foreach ($web_ar_datagrid['controls'] as $hdr_id=>$control) { ?>

		<? if ($control_align[$i] == 'bottom') { ?>

		<div class="table_control"><?=$control?></div>
		
		<? } ?>
		
		<? $i++; ?>

	<? } ?>
<? } ?>
</div><?  ?>
	
<? } ?><?  ?>

<? } else { ?>

	<?  ?><? if (!is_array($orders)) { ?>
	
	<?=$orders?>
	
<? } else { ?>

	<? $web_ar_datagrid = &$orders; ?>
	
	<? $data_align = array('left','left','left','left','left','left','left'); ?>
	<? $control_align = array('top','bottom'); ?>

	<?  ?><? if ((count($web_ar_datagrid['data']) > 0) or (empty($empty_message))) {

	$__BUFFER->addScript('/_syslib/baron/baron-v3.min.js');


	$__BUFFER->addJsInit("
			if(typeof baron !== 'undefined') {
			
				var root = document.querySelector('.baron')
				var scroller = document.querySelector('.baron__scroller');
				var bar = document.querySelector('.baron__bar');
				var track = document.querySelector('.baron__h-scroll');
				
				if(root && scroller && bar && track) {
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
				
			}
		");

	?>

	<? if (!empty($PHP_TEMPLATE['captionFilter_' . $web_ar_datagrid['info']['name']])) { ?>

		<? $captionFilter = &$PHP_TEMPLATE['captionFilter_' . $web_ar_datagrid['info']['name']]; ?>
		<?= $captionFilter['validationScript'] ?>
		<form id="<?= $captionFilter['id'] ?>" name="<?= $captionFilter['name'] ?>" action="<?= $captionFilter['action'] ?>" method="<?= $captionFilter['method'] ?>" onsubmit="<?= $captionFilter['onsubmit'] ?>">
		<input type="hidden" name="tab" value="<?= $_REQUEST['tab'] ?>">
		<div class="web-table-control">
			<div class="web-table-control__left btn-group">
				<a href="/shop/myorders.html" class="btn btn_view_common"><?= $_interface->MSG['OrderListModule']['msg11'] ?></a>
				<a href="/shop/myorders.html?tab=orders" class="btn"><?= $_interface->MSG['OrderListModule']['msg12'] ?></a>
			</div>
			<div class="web-table-control__right">
				<?= $captionFilter['fields']['filterSubmit_' . $web_ar_datagrid['info']['name']]['html'] ?>
			</div>
		</div>
	<? } ?>

	<? if ($web_ar_datagrid['controls']['pagination']) { ?>
		<div class="web-table-control orders-page__all-width-paginator">
			<?= $web_ar_datagrid['controls']['pagination'] ?>
		</div>
	<? } ?>

	<? if (count($web_ar_datagrid['controls']) > 0) { ?>
		<? $i = 0; ?>
		<? foreach ($web_ar_datagrid['controls'] as $hdr_id => $control) { ?>

			<? if ($hdr_id == 'pagination') continue; ?>

			<? if ((empty($control_align[$i])) or ($control_align[$i] == 'top')) { ?>

				<div class="table_control"><?= $control ?></div>

			<? } ?>

			<? $i++; ?>

		<? } ?>
	<? } ?>
	<div class="positions-page__info-table baron">
		<div class="baron__h-scroll">
			<div class="baron__bar"></div>
		</div>
		<div class="baron__scroller">
			<table class="brief-table <?= $web_ar_datagrid['info']['name'] ?>" width="100%">
				<tr class="brief-table__header">
					<? $col_num = 0;
					$total_begin = 0; ?>
					<? foreach ($web_ar_datagrid['header'] as $hdr_id => $column) { ?>

						<? if ($column['visible'] != '1') continue; ?>

						<th class="brief-table__col brief-table__col_type_head orders-table__col_type_head_<?= $hdr_id ?>">

							<? if (!empty($column['clm_info'])) { ?>
								<span class="tipz" title="<?= $column['clm_info'] ?>"></span>
							<? } ?>
							<?= $column['caption'] ?>

						</th>

						<? if ((empty($web_ar_datagrid['total'][$hdr_id])) && ($total_begin == $col_num)) { ?>
							<? $total_begin++; ?>
						<? } ?>

						<? $last_hdr_id = $hdr_id; ?>

						<? $col_num++; ?>
					<? } ?>
				</tr>

				<? if ($captionFilter) { ?>

					<tr class="brief-table__filter">
						<? foreach ($web_ar_datagrid['header'] as $hdr_id => $column) { ?>

							<? if ($column['visible'] != '1') continue; ?>

							<td class="brief-table__col brief-table__col_type_filter orders-table__filter_<?= $hdr_id ?>">
								<? if (!empty($captionFilter['fields'][$hdr_id])) { ?>
									<div class="caption_filter">
										<?= $captionFilter['fields'][$hdr_id]['html'] ?>
									</div>
								<? } ?>

							</td>

						<? } ?>
					</tr>

				<? } ?>


				<? foreach ($web_ar_datagrid['data'] as $row => $item) { ?>

					<tr class="brief-table__row">

						<? $i = 0; ?>
						<? foreach ($web_ar_datagrid['header'] as $hdr_id => $column) { ?>

							<? if ($column['visible'] != '1') continue; ?>

							<td class="brief-table__col orders-table__col_<?= $hdr_id ?>">

								<?  ?><?
switch ($hdr_id) {
	case 'payment':
		 ?><? if (!$item['is_archive'] and (isset($item['ord_summ_debt']) and $item['ord_summ_debt'] > 0)) { ?>

	<? $id = preg_replace('#^<select.*id="(.*)".*$#Uis', '$1', $item[$hdr_id]); ?>

	<?= str_replace('<select', '<select onchange="window.location=\'/shop/payments-online.html?dcm_id=' . md5($item['ord_dcm_id']) . '&pmk_id=\'+document.getElementById(\'' . $id . '\').value"', $item[$hdr_id]) ?>

<? } ?><? 
		break;
	case 'ord_id':
		 ?><? if ($item['is_archive']) { ?>
	<?= $item[$hdr_id] ?>
<? } else { ?>
	<a href="<?= $docUrl ?>?dcm_id=<?= md5($item['ord_dcm_id']) ?>">
		<?= $item[$hdr_id] ?>
	</a>
<? } ?><? 
		break;
	case 'ord_comment':
		 ?><? if ($item['is_archive']) { ?>
	<? $msg = tr('заказ архивный, функционал ограничен', 'OrderListModule'); ?>
	<?= $item[$hdr_id] ?><?= (trim($item['ord_comment']) ? ', ' . $msg : mb_ucfirst($msg)) ?>
<? } else { ?>
	<?= $item[$hdr_id] ?>
<? } ?><? 
		break;
	case 'paid_summ':
		 ?><?
$paid = (float)$item[$hdr_id];
?>
<span class="brief-table__paid brief-table__paid_status_<?= ($paid > 0) ? 'not' : 'yes' ?>"><?= ($paid > 0) ? $item[$hdr_id] : tr('Оплачено', 'OrderListModule') ?></span>
<? 
		break;
	default:
		echo $item[$hdr_id];
		break;
}
?><? ?>

							</td>

							<? $i++; ?>

						<? } ?>

					</tr>

				<? } ?>
				<? if (count($web_ar_datagrid['total']) > 0) { ?>
					<tr class="brief-table__total">
						<? if ($total_begin > 0) { ?>
							<? if ($total_begin > 1) { ?>
								<td colspan="<?= ($total_begin - 1) ?>"></td>
							<? } ?>
							<td class="brief-table__col brief-table__col_type_total"><?= $MSG['Common']['msg5'] ?></td>
						<? } ?>
						<? foreach ($web_ar_datagrid['header'] as $hdr_id => $column) { ?>

							<? if (($column['visible'] != '1') or ((++$total_counter <= $total_begin) && ($total_begin != 0))) continue; ?>

							<td class="col_<?= $hdr_id ?>"><?= $web_ar_datagrid['total'][$hdr_id] ?></td>

						<? } ?>
					</tr>
				<? } ?>
			</table>
		</div>
	</div>



	<? if (empty($web_ar_datagrid['data'])) { ?>
		<div class="brief-table__empty-message"><?= $MSG['Common']['msg4'] ?></div>
	<? } ?>

	<? if (!empty($PHP_TEMPLATE['captionFilter_' . $web_ar_datagrid['info']['name']])) { ?>

		</form>

	<? } ?>

<? } else { ?>

	<p><?= $empty_message ?></p>

<? } ?>

<? if (count($web_ar_datagrid['controls']) > 0) { ?>
	<? $i = 0; ?>
	<? foreach ($web_ar_datagrid['controls'] as $hdr_id => $control) { ?>

		<? if ($control_align[$i] == 'bottom') { ?>

			<div class="table_control"><?= $control ?></div>

		<? } ?>

		<? $i++; ?>

	<? } ?>
<? } ?><?  ?>
	
<? } ?><?  ?>

<? } ?>
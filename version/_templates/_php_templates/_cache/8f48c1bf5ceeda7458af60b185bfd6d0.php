<? if ($_interface->domain) { ?>

	<?  ?><h1><?=$MSG['BalanceModule']['msg8']?></h1>

<table cellpadding="3" cellspacing="1" class="admin_edit_table" id="admin-edit-table">

<? if ($ordersPaymentDebt) { ?>

		<tr class="atfc">
			<th>
				<b><?=$MSG['LoginFormModule']['msg26']?></b>
			</th>
			<th>
				<?=$MSG['LoginFormModule']['msg29']?>
			</th>
			<th>
				<?=$MSG['LoginFormModule']['msg30']?>
			</th>
			<th>
				<?=$MSG['LoginFormModule']['msg33']?>
			</th>
			<th>
				<?=$MSG['LoginFormModule']['msg31']?>
			</th>
		</tr>

		<tr class="atfc">
			<td>
				<nobr><?=$BALANCE_SUMM?></nobr>
			</td>
			<td>
				<nobr><?=$ordersPaymentDebt?></nobr>
			</td>
			<td>
				<nobr><?=$balanceSaldo?></nobr>
			</td>
			<td>
				<nobr><?=$maxCredit?></nobr>
			</td>
			<td>
				<nobr><?=$fundsRemains?></nobr>
			</td>
		</tr>
	
<? } else { ?>

		<tr class="atfc">
			<th>
				<?=$MSG['LoginFormModule']['msg26']?>
			</th>
			<th>
				<?=$MSG['LoginFormModule']['msg27']?>
			</th>
		</tr>
		<tr class="atfc">
			<td>
				<nobr><?=$BALANCE_SUMM?></nobr>
			</td>
			<td>
				<nobr><?=$DEBT_SUMM?></nobr>
			</td>
		</tr>

<? } ?>

</table>
<br/>

<? $web_ar_datagrid = &$documents; ?>
<? $control_align = array('top','bottom'); ?>
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
<? } ?><?  ?><?  ?>

<? } else { ?>

	<?  ?><h1><?= $MSG['BalanceModule']['msg8'] ?></h1>
<div class="balance-info">
	<div class="balance-info__title">
		<?= $MSG['PersonalInfoModule']['msg69'] ?>
	</div>
	<div class="balance-info__data">
		<? if (!$_interface->aiSyncEnabled or !$_interface->aiWarBalancesDisabled) { ?>
			<? if ($ordersPaymentDebt) { ?>

				<div class="balance-info__row">
					<div class="balance-info__th">
						<?= $MSG['LoginFormModule']['msg26'] ?>
					</div>
					<div class="balance-info__col">
						<nobr><?= $BALANCE_SUMM ?></nobr>
					</div>
					<div class="balance-info__col">&#160;</div>
					<div class="balance-info__col">&#160;</div>
				</div>

				<div class="balance-info__row">
					<div class="balance-info__th">
						<?= $MSG['LoginFormModule']['msg29'] ?>
					</div>
					<div class="balance-info__col">
						<nobr><?= $ordersPaymentDebt ?></nobr>
					</div>
					<div class="balance-info__th">
						<?= $MSG['LoginFormModule']['msg30'] ?>
					</div>
					<div class="balance-info__col">
						<nobr><?= $balanceSaldo ?></nobr>
					</div>
				</div>

				<div class="balance-info__row">
					<div class="balance-info__th">
						<?= $MSG['LoginFormModule']['msg33'] ?>
					</div>
					<div class="balance-info__col">
						<nobr><?= $maxCredit ?></nobr>
					</div>
					<div class="balance-info__th">
						<?= $MSG['LoginFormModule']['msg31'] ?>
					</div>
					<div class="balance-info__col">
						<nobr><?= $fundsRemains ?></nobr>
					</div>
				</div>


			<? } else { ?>

				<div class="balance-info__row">
					<div class="balance-info__col">
						<?= $MSG['LoginFormModule']['msg26'] ?>
					</div>
					<div class="balance-info__col">
						<nobr><?= $BALANCE_SUMM ?></nobr>
					</div>
					<div class="balance-info__col">
						<?= $MSG['LoginFormModule']['msg27'] ?>
					</div>
					<div class="balance-info__col">
						<nobr><?= $DEBT_SUMM ?></nobr>
					</div>
				</div>

			<? } ?>
		<? } ?>
		
		<? if ($_interface->aiSyncEnabled) { ?>

			<? if (empty($_interface->aiBalancesShow) or in_array('aicb_balance_ordered', (array)$_interface->aiBalancesShow)) { ?>
				<div class="balance-info__row">
					<div class="balance-info__col">
						<?= tr('Баланс по заказам', 'ai') ?>
					</div>
					<div class="balance-info__col">
						<nobr><?= $aicb_balance_ordered ?></nobr>
					</div>
				</div>
			<? } ?>
			<? if (empty($_interface->aiBalancesShow) or in_array('aicb_balance_active_ordered', (array)$_interface->aiBalancesShow)) { ?>
				<div class="balance-info__row">
					<div class="balance-info__col">
						<?= tr('Баланс по активным заказам', 'ai') ?>
					</div>
					<div class="balance-info__col">
						<nobr><?= $aicb_balance_active_ordered ?></nobr>
					</div>
				</div>
			<? } ?>
			<? if (empty($_interface->aiBalancesShow) or in_array('aicb_balance_total', (array)$_interface->aiBalancesShow)) { ?>
				<div class="balance-info__row">
					<div class="balance-info__col">
						<?= tr('Баланс фактический', 'ai') ?>
					</div>
					<div class="balance-info__col">
						<nobr><?= $aicb_balance_total ?></nobr>
					</div>
				</div>
			<? } ?>
			<? if (empty($_interface->aiBalancesShow) or in_array('aicb_balance_by_return', (array)$_interface->aiBalancesShow)) { ?>
				<div class="balance-info__row">
					<div class="balance-info__col">
						<?= tr('Баланс по возвратам', 'ai') ?>
					</div>
					<div class="balance-info__col">
						<nobr><?= $aicb_balance_by_return ?></nobr>
					</div>
				</div>
			<? } ?>
			<? if (empty($_interface->aiBalancesShow) or in_array('aicb_balance_delayed', (array)$_interface->aiBalancesShow)) { ?>
				<div class="balance-info__row">
					<div class="balance-info__col">
						<?= tr('Баланс просроченный', 'ai') ?>
					</div>
					<div class="balance-info__col">
						<nobr><?= $aicb_balance_delayed ?></nobr>
					</div>
				</div>
			<? } ?>

		<? } ?>
	</div>

	<?= $PAY_LINK ?>

</div>

<? if ($_interface->aiSyncEnabled && $_interface->aiProcessPaymentsShow) { ?>
	<h3><?= tr('Платежи в обработке', 'ai') ?></h3>
<? } ?>

<? if (!$_interface->aiSyncEnabled or $_interface->aiProcessPaymentsShow) { ?>
<? $web_ar_datagrid = &$documents; ?>
<? $control_align = array('top', 'bottom'); ?>
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

<? } ?>
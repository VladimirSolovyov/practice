<div class="documents-dialog">
<? if ($errors) { ?>
	
	<? $process_messages = &$errors;?>
	<?  ?><? if (count($process_messages['messages']) > 0) {
	
	foreach($process_messages['messages'] as $message) { ?>

		<?=$message?>
		
	<? }

} ?><?  ?>
	
<? } else { ?>

<? if ($mode == 'documents_list') { ?>

   	<h1><?=$MSG['DocumentsModule']['msg9']?></h1>
	
	<? if ($documents) { ?>
	
	<? $web_ar_datagrid = &$documents; ?>
	<? $data_align = array('left','left','left','left'); ?>
	<? $control_align = array('top','bottom'); ?>
	
	<?  ?><div class="web-table__wrapper web-table__wrapper_documents">
	<div class="flc">
		<? if (count($web_ar_datagrid['controls']) > 0) { ?>
			<? $i = 0; ?>
			<? foreach ($web_ar_datagrid['controls'] as $hdr_id => $control) { ?>

				<? if ((empty($control_align[$i])) or ($control_align[$i] == 'top')) { ?>
					<div class="web-table__paginator web-table__paginator_documents flc">
						<?= $control ?>
					</div>
				<? } ?>

				<? $i++; ?>

			<? } ?>
		<? } ?>
	</div>
	<? if (!empty($PHP_TEMPLATE['captionFilter_' . $web_ar_datagrid['info']['name']])) { ?>

<? $captionFilter = &$PHP_TEMPLATE['captionFilter_' . $web_ar_datagrid['info']['name']]; ?>
<?= $captionFilter['validationScript'] ?>
	<form id="<?= $captionFilter['id'] ?>" name="<?= $captionFilter['name'] ?>" action="<?= $captionFilter['action'] ?>" method="<?= $captionFilter['method'] ?>" onsubmit="<?= $captionFilter['onsubmit'] ?>">
		<? if (!$captionFilter['object']->settings['submitInTable']) { ?>
			<div class="table_filter_control flc">
				<div class="rightside">
					<?= $captionFilter['fields']['filterSubmit_' . $web_ar_datagrid['info']['name']]['html'] ?>
				</div>
			</div>
		<? } else { ?>

			<? foreach ($web_ar_datagrid['header'] as $hdr_id => $column) { ?>

				<? if ($column['visible'] != '1') continue; ?>
				<? $last_hdr_id = $hdr_id; ?>

			<? } ?>

		<? } ?>

		<? } ?>



		<div class="web_ar_datagrid web-table">
			<div class="web-table-header">
				<? $col_num = 0; ?>
				<? foreach ($web_ar_datagrid['header'] as $hdr_id => $column) { ?>

					<? if (($column['visible'] != '1') or ($hdr_id == 'print')) continue; ?>

					<div class="web-table-header__col web-table__<?= $hdr_id ?>">
						<? if (!empty($column['clm_info'])) { ?>
							<span class="tipz" title="<?= $column['clm_info'] ?>"></span>
						<? } ?>
						<?= $column['caption'] ?>
					</div>
					<? $col_num++; ?>

				<? } ?>
			</div>

			<? if ($captionFilter) { ?>

				<div class="web-table-filter">
					<? foreach ($web_ar_datagrid['header'] as $hdr_id => $column) { ?>

						<? if (($column['visible'] != '1') or ($hdr_id == 'print')) continue; ?>

						<div class="web-table__col web-table__col_<?= $hdr_id ?>">
							<? if (!empty($captionFilter['fields'][$hdr_id])) { ?>
								<div class="caption_filter">
									<?= $captionFilter['fields'][$hdr_id]['html'] ?>
								</div>
							<? } ?>

							<? if (($captionFilter) && ($captionFilter['object']->settings['submitInTable']) && ($hdr_id == $last_hdr_id)) { ?>
								<div class="caption_filter">
									<?= $captionFilter['fields']['filterSubmit_' . $web_ar_datagrid['info']['name']]['html'] ?>
								</div>
							<? } ?>
						</div>

					<? } ?>
				</div>

			<? } ?>

			<?
				foreach ($web_ar_datagrid['data'] as $row => $item) { ?>

					<div class="web-table__row">

						<? $i = 0; ?>
						<? foreach ($web_ar_datagrid['header'] as $hdr_id => $column) { ?>

							<? if (($column['visible'] != '1') or ($hdr_id == 'print')) continue; ?>

							<div class="web-table__col web-table__col_<?= $hdr_id ?>"<?= (!empty($data_align[$i]) ? ' align="' . $data_align[$i] . '"' : '') ?>>
								<? if ($hdr_id == 'doc_dcm_id') { ?>
									<span class="web-table__print"><?= $item['print'] ?></span>
									<?= $item[$hdr_id] ?>
								<? } else { ?>
									<?= $item[$hdr_id] ?>
								<? } ?>
							</div>

							<? $i++; ?>

						<? } ?>

					</div>

				<? } ?>
		</div>
		<? if (empty($web_ar_datagrid['data'])) { ?>
			<div class="brief-table__empty-message"><?= $MSG['Common']['msg4'] ?></div>
		<? } ?>

		<? if (!empty($PHP_TEMPLATE['captionFilter_' . $web_ar_datagrid['info']['name']])) { ?>

	</form>

<? } ?>

	<? if (count($web_ar_datagrid['controls']) > 0) { ?>
		<? $i = 0; ?>
		<? foreach ($web_ar_datagrid['controls'] as $hdr_id => $control) { ?>

			<? if ($control_align[$i] == 'bottom') { ?>

				<div class="table_control"><?= $control ?></div>

			<? } ?>

			<? $i++; ?>

		<? } ?>
	<? } ?>

</div><?  ?>
	
	<? } ?>
	
	<? $process_messages = &$documents_dialog;?>
	<?  ?><? if (count($process_messages['messages']) > 0) {
	
	foreach($process_messages['messages'] as $message) { ?>

		<?=$message?>
		
	<? }

} ?><?  ?>

<? } else { ?>

    <h1><?=$MSG['DocumentsModule']['msg9']?></h1>
	
	<? if (strpos($_SERVER['HTTP_REFERER'],'myorders')!==false) { ?>
		<a class="btn btn_view_pseudo" href="/shop/myorders.html"><?=$MSG['DocumentsModule']['msg10']?></a>
	<? } else { ?>
		<a class="btn btn_view_pseudo btn_icon_doc documents-dialog__btn-doc" href="/shop/documents.html"><?=$MSG['DocumentsModule']['msg12']?></a>
	<? } ?>
    <?  ?><?=$documents_dialog['validationScript']?>
<form id="<?=$documents_dialog['id']?>" name="<?=$documents_dialog['name']?>" action="<?=$documents_dialog['action']?>" method="<?=$documents_dialog['method']?>" onsubmit="<?=$documents_dialog['onsubmit']?>">

<?=$documents_dialog['fields']['dcm_id']['html']?>
<?=$documents_dialog['fields']['pyr_cst_id']['html']?>
<?=$documents_dialog['fields']['bsp_id']['html']?>
<?=$documents_dialog['fields']['cst_id']['html']?>


			<? $web_ar_datagrid = &$documents_dialog['fields']['documents']['html']; ?>
			<? $empty_message = tr('Нет записей.') ?>
			<? $data_align = array('center','center','center'); ?>

			<? 	$i=0;
				foreach ($web_ar_datagrid['data'] as $rkey=>$row) {
					foreach($row as $key=>$value) {
					
						switch ($key) {
							
							case 'doc_dcm_id': {
								$web_ar_datagrid['data'][$rkey][$key] = '<nobr>'.$web_ar_datagrid['data'][$rkey][$key].'</nobr>';
							} break;
							
							case 'print': {
								if (($mode != 'documents_list') && (empty($web_ar_datagrid['data'][$rkey]['dcm_id']))) {
									$web_ar_datagrid['data'][$rkey][$key] = '<input id="d_dct_id_'.$i.'" type="checkbox" name="d_dct_id['.$i.']" value="'.$web_ar_datagrid['data'][$rkey]['dct_id'].'" class="checkBox" />';
								}
							} break;
							
							case 'doc_name': {
								if (($mode != 'documents_list') && (empty($web_ar_datagrid['data'][$rkey]['dcm_id']))) {
									$web_ar_datagrid['data'][$rkey][$key] = '<label for="d_dct_id_'.$i.'">'.$web_ar_datagrid['data'][$rkey][$key].'</label>';
								}
							} break;
							
							default: {
							
							} break;
							
						}
				
					}
					$i++;
				}
			?>
<div class="documents-dialog__row">
	<div class="documents-dialog__col">
		<?
		if (ADMIN_PAGE) {
			 ?>
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
<? } ?><? 
		} else {
			 ?><div class="web-table__wrapper web-table__wrapper_<?=$web_ar_datagrid['info']['name']?>">

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
</div><? 
		}
		?>
	</div>

	<div class="documents-dialog__col">
			<? if (($disableMakeDocuments != 1) && ($documents_dialog['fields']['pyr_id'])) { ?>

				<div class="universal-form__subgroup">
					<div class="form-gr form-gr_horizontal_center form-gr--secondw">
						<div class="form-gr__label">
							<?=$documents_dialog['fields']['pyr_id']['caption']?>
						</div>
						<div class="form-gr__control">
							<?=$documents_dialog['fields']['pyr_id']['html']?>
						</div>
					</div>
				</div>
				<? if ($documents_dialog['fields']['pyr_orf_id']) { ?>
					<div class="universal-form__subgroup">
						<div class="universal-form__group-title">
							<?=$MSG['DocumentsModule']['msg11']?>
						</div>
					</div>

				<? } ?>

				<? if (!$payer_view) { ?>
				<div class="universal-form__subgroup">
					<div class="form-gr form-gr_horizontal_center form-gr--secondw universal-form__row">
						<div class="form-gr__label">
							<?=$documents_dialog['fields']['pyr_orf_id']['caption']?>
						</div>
						<div class="form-gr__control">
							<?=$documents_dialog['fields']['pyr_orf_id']['html']?>
						</div>
					</div>
					<div class="form-gr form-gr_horizontal_center form-gr--secondw universal-form__row">
						<div class="form-gr__label">
							<?=$documents_dialog['fields']['pyr_name']['caption']?>
						</div>
						<div class="form-gr__control">
							<?=$documents_dialog['fields']['pyr_name']['html']?>
						</div>
					</div>
					<div class="form-gr form-gr_horizontal_center form-gr--secondw universal-form__row">
						<div class="form-gr__label">
							<?=$documents_dialog['fields']['pyr_jur_address']['caption']?>
						</div>
						<div class="form-gr__control">
							<?=$documents_dialog['fields']['pyr_jur_address']['html']?>
						</div>
					</div>
					<div class="form-gr form-gr_horizontal_center form-gr--secondw universal-form__row">
						<div class="form-gr__label">
							<?=$documents_dialog['fields']['pyr_address']['caption']?>
						</div>
						<div class="form-gr__control">
							<?=$documents_dialog['fields']['pyr_address']['html']?>
						</div>
					</div>
					<div class="form-gr form-gr_horizontal_center form-gr--secondw universal-form__row">
						<div class="form-gr__label">
							<?=$documents_dialog['fields']['pyr_inn']['caption']?>
						</div>
						<div class="form-gr__control">
							<?=$documents_dialog['fields']['pyr_inn']['html']?>
						</div>
					</div>
					<? if ($documents_dialog['fields']['pyr_license_number']) { ?>
						<div class="form-gr form-gr_horizontal_center form-gr--secondw universal-form__row">
							<div class="form-gr__label">
								<?=$documents_dialog['fields']['pyr_license_number']['caption']?>
							</div>
							<div class="form-gr__control">
								<?=$documents_dialog['fields']['pyr_license_number']['html']?>
							</div>
						</div>
					<? } ?>
					<div class="form-gr form-gr_horizontal_center form-gr--secondw universal-form__row">
						<div class="form-gr__label">
							<?=$documents_dialog['fields']['pyr_rs']['caption']?>
						</div>
						<div class="form-gr__control">
							<?=$documents_dialog['fields']['pyr_rs']['html']?>
						</div>
					</div>
					<div class="form-gr form-gr_horizontal_center form-gr--secondw universal-form__row">
						<div class="form-gr__label">
							<?=$documents_dialog['fields']['pyr_ks']['caption']?>
						</div>
						<div class="form-gr__control">
							<?=$documents_dialog['fields']['pyr_ks']['html']?>
						</div>
					</div>
					<div class="form-gr form-gr_horizontal_center form-gr--secondw universal-form__row">
						<div class="form-gr__label">
							<?=$documents_dialog['fields']['pyr_bank']['caption']?>
						</div>
						<div class="form-gr__control">
							<?=$documents_dialog['fields']['pyr_bank']['html']?>
						</div>
					</div>
					<div class="form-gr form-gr_horizontal_center form-gr--secondw universal-form__row">
						<div class="form-gr__label">
							<?=$documents_dialog['fields']['pyr_bik']['caption']?>
						</div>
						<div class="form-gr__control">
							<?=$documents_dialog['fields']['pyr_bik']['html']?>
						</div>
					</div>
				</div>
				<? } else { ?>

					<? if (!empty($payer_view['orf_name'])) { ?>
						<div class="form-gr form-gr_horizontal_center form-gr--secondw">
							<div class="form-gr__label">
								<?=$MSG['PayersModule']['msg12']?>
							</div>
							<div class="form-gr__control">
								<?=$payer_view['orf_name']?>
							</div>
						</div>
					<? } ?>

					<? if (!empty($payer_view['pyr_name'])) { ?>
						<div class="form-gr form-gr_no_input form-gr_horizontal_center form-gr--secondw">
							<div class="form-gr__label">
								<?=$MSG['PayersModule']['msg37']?>
							</div>
							<div class="form-gr__control">
								<?=$payer_view['pyr_name']?>
							</div>
						</div>
					<? } ?>

					<? if (!empty($payer_view['pyr_jur_address'])) { ?>
						<div class="form-gr form-gr_no_input form-gr_horizontal_center form-gr--secondw">
							<div class="form-gr__label">
								<?=$MSG['PayersModule']['msg38']?>
							</div>
							<div class="form-gr__control">
								<?=$payer_view['pyr_jur_address']?>
							</div>
						</div>
					<? } ?>

					<? if (!empty($payer_view['pyr_address'])) { ?>
						<div class="form-gr form-gr_no_input form-gr_horizontal_center form-gr--secondw">
							<div class="form-gr__label">
								<?=$MSG['PayersModule']['msg39']?>
							</div>
							<div class="form-gr__control">
								<?=$payer_view['pyr_address']?>
							</div>
						</div>
					<? } ?>

					<? if (!empty($payer_view['pyr_inn'])) { ?>
						<div class="form-gr form-gr_no_input form-gr_horizontal_center form-gr--secondw">
							<div class="form-gr__label">
								<?=$MSG['PayersModule']['msg40']?>
							</div>
							<div class="form-gr__control">
								<?=$payer_view['pyr_inn']?>
							</div>
						</div>
					<? } ?>

					<? if (!empty($payer_view['pyr_license_number'])) { ?>
						<div class="form-gr form-gr_no_input form-gr_horizontal_center form-gr--secondw">
							<div class="form-gr__label">
								<?=$MSG['PayersModule']['msg41']?>
							</div>
							<div class="form-gr__control">
								<?=$payer_view['pyr_license_number']?>
							</div>
						</div>
					<? } ?>

					<? if (!empty($payer_view['pyr_rs'])) { ?>
						<div class="form-gr form-gr_no_input form-gr_horizontal_center form-gr--secondw">
							<div class="form-gr__label">
								<?=$MSG['PayersModule']['msg42']?>
							</div>
							<div class="form-gr__control">
								<?=$payer_view['pyr_rs']?>
							</div>
						</div>
					<? } ?>

					<? if (!empty($payer_view['pyr_ks'])) { ?>
						<div class="form-gr form-gr_no_input form-gr_horizontal_center form-gr--secondw">
							<div class="form-gr__label">
								<?=$MSG['PayersModule']['msg43']?>
							</div>
							<div class="form-gr__control">
								<?=$payer_view['pyr_ks']?>
							</div>
						</div>
					<? } ?>

					<? if (!empty($payer_view['pyr_bank'])) { ?>
						<div class="form-gr form-gr_no_input form-gr_horizontal_center form-gr--secondw">
							<div class="form-gr__label">
								<?=$MSG['PayersModule']['msg44']?>
							</div>
							<div class="form-gr__control">
								<?=$payer_view['pyr_bank']?>
							</div>
						</div>
					<? } ?>

					<? if (!empty($payer_view['pyr_bik'])) { ?>
						<div class="form-gr form-gr_no_input form-gr_horizontal_center form-gr--secondw">
							<div class="form-gr__label">
								<?=$MSG['PayersModule']['msg45']?>
							</div>
							<div class="form-gr__control">
								<?=$payer_view['pyr_bik']?>
							</div>
						</div>
					<? } ?>

					<? if (!empty($payer_view['pyr_ogrn'])) { ?>
						<div class="form-gr form-gr_no_input form-gr_horizontal_center form-gr--secondw">
							<div class="form-gr__label">
								<?= $MSG['PayersModule']['ogrnNum'] ?>
							</div>
							<div class="form-gr__control">
								<?= $payer_view['pyr_ogrn'] ?>
							</div>
						</div>
					<? } ?>

				<? } ?>
			<? } ?>
		<div class="form-gr form-gr_no_input form-gr_horizontal_center form-gr--secondw">
			<div class="form-gr__control"><?=$documents_dialog['fields']['send']['html']?></div>
		</div>

	</div>
</div>

</form><?  ?>

<? } ?>

<? } ?>
</div>
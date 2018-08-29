<? unset($__search_results['header']['time']); ?>
<script type="text/javascript">

	function toggleRow(rowObj) {

		if (!rowObj.clicked) {

			if (rowObj.className != 'mouseover') {

				rowObj.saveStyle = rowObj.className;
				rowObj.className = 'mouseover';

			} else {

				rowObj.className = rowObj.saveStyle;
			}
		}
	}

	function clickRow(rowObj) {

		if (rowObj.className != 'clicked') {

			if (!rowObj.saveStyle)
				rowObj.saveStyle = rowObj.className;

			rowObj.className = 'clicked';
			rowObj.clicked = true;
		} else {

			rowObj.className = 'mouseover';
			rowObj.clicked = false;
		}
	}

	<?if($SearchSetting['newGroupsTemplate']){?>
	document.addEventListener("DOMContentLoaded", function () {
		new AdminSearchModule({
			messages: {
				toggleHide: '<?=tr('Свернуть предложения', 'SearchModule')?>',
				toggleShow: '<?=tr('Развернуть предложения', 'SearchModule')?>'
			}
		});
	});
	<?}?>
</script>

<form id="admin-search-form" action="<?= $SearchSetting['basketURL'] ?>" method="POST">

	<? if ($SearchSetting['useOrderColumn'] == 1) { ?>
		<input type="hidden" name="func" value="add">
		<div class="searchPrderButton"><input type="submit" value="<?= $AR_MSG['SearchModule']['msg46'] ?>"></div><br>
	<? } ?>

	<table border="0" class="web_ar_datagrid admin-search-table" cellspacing="0">

		<? include(PHP_DataRender::includeTemplatePath('/autoresource/search_admin/groups/tpl.search_results_table_header.php'));

		$match_criteria = '';
		$univers = '';
		$oem = '';
		$article = '';
		$show_article = 1;
		$show_brand = 1;
		$showDelivery = [];
		$indexGroup = 0;
		$counterRowsAB = 0;

		foreach ($__search_results['data'] as $dat_id => $row) {

			if ($row['info_only'] == 1) {
				if (($SearchSetting['searchCode'] != $row['parsed_article']) or ($ZeroResultShown == 1)) {

					continue;
				} else {

					foreach ($__search_results['data'] as $dat_id2 => $row2) {

						if (($row['parsed_article'] == $row2['parsed_article']) && ($dat_id != $dat_id2) && ($row2['info_only'] == 0)) {
							continue 2;
						}
					}
					$ZeroResultShown = 1;
				}
			}

			$show_article = 0;
			$new_line = 0;
			$showMany = false;
			$oldMC = false;

			if (($article !== $row['parsed_article']) || ($row['brand'] !== $brand)) {
				$article = $row['parsed_article'];
				$brand = $row['brand'];
				$show_article = 1;
				$new_line = 1;
			}

			if ($row['match_criteria'] != $match_criteria) {
				$show_article = 1;
				$match_criteria = $row['match_criteria'];

				if ($match_criteria == 0) {
					include(PHP_DataRender::includeTemplatePath('/autoresource/search_admin/groups/tpl.search_results_table_show_row.php'));
					?>
					<tr class="section">
						<td colspan="<?= $columns ?>"><?= $AR_MSG['SearchModule']['msg43'] ?></td>
					</tr>
				<? } else {
					$oldMC = true;
				}
			}

			if (($row['univers'] != $univers) && ($match_criteria == 1)) {

				$show_article = 1;
				$univers = $row['univers'];

				if ($univers != 0) {
					include(PHP_DataRender::includeTemplatePath('/autoresource/search_admin/groups/tpl.search_results_table_show_row.php'));
					?>
					<tr class="section">
						<td colspan="<?= $columns ?>"><?= $AR_MSG['SearchModule']['msg47'] ?></td>
					</tr>
				<? }
			}

			if (($row['oem'] != $oem) && ($match_criteria == 1) && ($row['univers'] == 0)) {
				$show_article = 1;
				$oem = $row['oem'];

				include(PHP_DataRender::includeTemplatePath('/autoresource/search_admin/groups/tpl.search_results_table_show_row.php'));
				?>

				<tr class="section">
					<td colspan="<?= $columns ?>"><?=($oem == 0 ? $AR_MSG['SearchModule']['msg44'] : $AR_MSG['SearchModule']['msg45'])?></td>
				</tr>
				<?
			}

			$class = 'odd';
			if (($isProvider['provider_id'] == $row['provider_id']) && ($row['provider_id'] > 0)) {
				$class = 'provider_row';
			} elseif ($dat_id % 2 == 0) {
				$class = 'even';
			}

			if ($show_article) {

				include(PHP_DataRender::includeTemplatePath('/autoresource/search_admin/groups/tpl.search_results_table_show_row.php'));

				$counterRowsAB = 0;
				$indexGroup++;
			}
			$counterRowsAB++;
			$groupClass = " group" . $indexGroup;

			if ($row['sts_style'] != '') {
				$groupClass .= " lg";
			} else {
				$groupClass .= " " . $class;
			}

			if ($SearchSetting['newGroupsTemplate']) {

				if ($SearchSetting['csAmountForGroup'] && $SearchSetting['csAmountForGroup'] < $counterRowsAB) {
					$groupClass .= " hidden";
				}

				if ($new_line) {
					$groupClass .= " new-line";
				}
				if ($match_criteria && !$show_article) {
					$groupClass .= " close-tr";
				}

				$show_article_real = $show_article;
				$show_article = 1;
			}

			?>
			<tr
				class="<?= $groupClass ?>"
				<? if ($row['sts_style'] != '') { ?> style="<?= $row['sts_style'] ?>"<? } ?>
				<? if (!$SearchSetting['newGroupsTemplate']) { ?> onmouseover="toggleRow(this)" onmouseout="toggleRow(this)" onclick="clickRow(this)" <?
				} ?>
				data-row-clicked
			>

				<? foreach ($__search_results['header'] as $hdr_id => $column) {
					if ($column['visible'] == true) {
						$col_align = 'center';

						switch ($hdr_id) {

							case 'spare_info':
							case 'article':
							case 'prd_info_link': {
								$col_align = 'left';
							}
								break;
							case 'final_price':
							case 'customer_price':
							case 'dlv_weight_tax':
							case 'price_brutto': {
								$col_align = 'right';
							}
								break;
						}
						?>
						<td class="col_<?= $hdr_id ?>" align="<?= $col_align ?>" <?= ($show_article == 1 ? 'style="border-top: 1px solid #A0A0A0"' : '') ?>>
							<? include(PHP_DataRender::includeTemplatePath('/autoresource/search_admin/groups/tpl.search_results_table_cell.php')); ?>
						</td>
					<? }
				} ?>
			</tr>
		<? }
		if ($show_article && $indexGroup == 1) {
			$oldMC = true;
		}

		include(PHP_DataRender::includeTemplatePath('/autoresource/search_admin/groups/tpl.search_results_table_show_row.php')); ?>

	</table>
</form>
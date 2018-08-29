<?
	
	 ?><?

$__search_results = $__search_results->value;

if ($SearchSetting['admin_search'] == 1) {

	if ($SearchSetting['csSearchTemplate'] == "groups") {

		 ?><? if (($SearchSetting['authUserSearchOnly'] != 1) || ($SearchSetting['cst_category_id'] >= 1) || ($SearchSetting['admin_search'] == 1)) { ?>

	<? if ($SearchSetting['empty_search']) { ?>

		<?  ?><h1><?=$AR_MSG['SearchModule']['msg1']?></h1>

<ul>

	<? if ($SearchSetting['search_from_catalog']) { ?>
	<li><p><a href="<?=$SearchSetting['catalog_search_url']?>"><?=$AR_MSG['SearchModule']['msg2']?></a></p>
	<? } ?>

	<li><nobr><?=$AR_MSG['SearchModule']['msg3']?></nobr></li>

	<? if ($SearchSetting['catalog_search']) { ?>
	<li><a href="<?=$SearchSetting['catalog_search_url']?>"><?=$AR_MSG['SearchModule']['msg6']?></a>
	<? } ?>

</ul><?  ?>
	
	<? } ?>

	<? if ($alternatives && !$__search_results && !$SearchSetting['empty_search']) { ?>

		<?  ?><h1><?=$AR_MSG['SearchModule']['msg1']?></h1>
	
	<? if ($SearchSetting['search_from_catalog']) { ?>
	<li><p><a href="<?=$SearchSetting['catalog_search_url']?>"><?=$AR_MSG['SearchModule']['msg2']?></a></p>
	<? } ?>

<table border="0" class="web_ar_datagrid">

<tr>

<? foreach ($alternatives['header'] as $hdr_id=>$column) { ?>

	<? if ($column['visible']==true) { ?>

	<th><?=$column['caption']?></th>

	<? } ?>

<? } ?>
</tr>

<? foreach ($alternatives['data'] as $dat_id=>$row) { ?>

<tr class="<?=($dat_id % 2 == 0?'even':'odd')?>">
	<? foreach ($alternatives['header'] as $hdr_id=>$column) { ?>
	
		<?
			switch ($hdr_id) {
				
				case 'brand':
				case 'action_alt': {
					$align = 'center';
				} break;
				default: {
					$align = 'left';
				} break;
				
			}
		?>
		
		<? if ($column['visible'] == true) { ?>
		<td align="<?=$align?>">
		<?=$row[$hdr_id]?>
		
		<? if ($hdr_id=='spare') { ?>
		
			<? if ($row['superseded_by']!='') { ?>
			<?=$row['code']?> - <?=$AR_MSG['SearchModule']['msg7']?><?=$row['superseded_by']?>
			<? } ?>
			
			<? if ($row['replacement_for']!='') { ?>
			<?=$row['code']?> - <?=$AR_MSG['SearchModule']['msg8']?><?=$row['replacement_for']?>
			<? } ?>

		<? } ?>
			
		</td>
		<? } ?>

	<? } ?>
</tr>

<? } ?>

</table><?  ?>

	<? } ?>

	<? if ($__search_results && !$SearchSetting['empty_search']) { ?>

		<? if (!$SearchSetting['admin_search']) { ?>

			<?  ?><table border="0" width="100%">

<tr>
<td>
<nobr><?=$AR_MSG['SearchModule']['msg1']?></nobr>
	
	<? if ($SearchSetting['catalog_search']) { ?>
	<li><a href="<?=$SearchSetting['catalog_search_url']?>"><?=$AR_MSG['SearchModule']['msg6']?></a>
	<? } ?>

</td><td align="right" valign="top">

<? if ($__search_results && !$SearchSetting['empty_search']) { ?>

<b><?=$AR_MSG['SearchModule']['msg9']?></b>&nbsp;<?=$cid?>

<? } ?>

</td>
<td valign="top" style="padding-left: 10px">
	
	<? if ($SearchSetting['groups_count'] > 1) { ?>
	
	<b><?=$AR_MSG['SearchModule']['msg41']?></b>&nbsp;
	
	<?
		$sLink = new cLink($_SERVER['REQUEST_URI'], '');
		$sLink->removeQueryParam("g");
	?>
	
	<select onchange="window.location.href = '<?=$sLink->link?>&g='+this.value">
	
	<? foreach ($alternatives as $dat_id=>$row) { ?>
	
			<option value="<?=$row['id']?>" <?=($_REQUEST['g']==$row['id']?'selected="selected"':'')?>>
				<?=$row['brand']?>
			</option>

	<? } ?>

	</select>
	
	<? } ?>

</td></tr>
</table>

<? if ($_SYSTEM->REQUESTED_PAGE != "/shop/basket_check.html") { ?>

<? $st_c = 0 ?>
<table border="0" cellpadding='1' cellspacing="0" width="100%" style="border-top: 1px solid #A0A0A0; border-bottom: 1px solid #A0A0A0">

<caption><?=$AR_MSG['SearchModule']['msg42']?></caption>

<? foreach ($searchStat as $key=>$searchN) { ?>

<? if ($st_c % 7 == 0) { ?><tr><? } ?>

<?
	$st_c++;
	$link = new cLink($_SERVER['REQUEST_URI'], '');
  
    $link->removeQueryParam("g");
    $link->removeQueryParam("article");

    $link->addQueryParam("article", $searchN['sse_search_number']);
?>

<td><a href="<?=$link?>"><b><?=$searchN['sse_search_number']?></b></a></td>

<? if ($st_c % 7 == 0) { ?><tr><? } ?>

<? } ?>

</table><br>

<? } ?><?  ?>

		<? } else { ?>

			<h1><?=$AR_MSG['SearchModule']['msg1']?></h1>

		<? } ?>

		<? if ($search_from_catalog) { ?>
			
			<li><p><a href="<?=$SearchSetting['catalog_search_url']?>"><?=$AR_MSG['SearchModule']['msg2']?></a></p></li>

		<? } ?>

		<? if ($SearchSetting['searchMode'] == "An") { ?>
			<div id="tree_searchmode_An">
				<?  ?>		
<style>

	body {
		font-size: 11px
	}

	.scol_0 {
		width: 600px;
	}
	
	.scol_1 {

		position: absolute;
		left: 100px;
		width: 150px;
		margin-right: 5px;
		vertical-align: top;

	}

	.scol_2 {
		position: absolute;
		left: 250px;
		width: 200px;
		margin-right: 5px;

	}
	
	.scol_3 {
		position: absolute;
		left: 400px;
		width: 300px;
		margin-right: 5px;

	}
	
	.scol_4 {

		width: 50px;
		margin-right: 5px;
		text-align: center;

	}
	
	.scol_5 {

		width: 30px;
		margin-right: 5px;
		text-align: center;

	}
	
	.searchBox {
		width: 100%;
		border: #B3E0FF solid 1px;
		background: #F9F9F9;
	}
	
	img {
		border: 0px;
	}
	
	a {
		text-decoration: none;
		cursor: hand;
	}
	
	
	a.normal {
		text-decoration: underline;
		cursor: hand;
	}
	
	div.analogTreeNode {
		width: 100%; padding-left: 50px;
		background: #FFFFFF;
	}
	
	div.analogTreeNode1 {
		width: 100%; padding-left: 50px;
		background: #A0A0A0;
	}
	
	div.analogTreeNode2 {
		width: 100%; padding-left: 50px;
		background: #C0C0C0;
	}
	
	div.analogTreeNode3	 {
		width: 100%; padding-left: 50px;
		background: #A0A0A0;
		color: #FFFFFF;
	}
	
</style>
	
	<script type="text/javascript" src="/_syslib/custom.dtree.js"></script>
	
	<script type="text/javascript">

	
		<?	$loopbackCheck = array(); ?>
		
		tecdocTree = new dTree('tecdocTree', '/images/ar2-tree');
		
		
<?

	$rowStr    = "<nobr><div class=\"analogTreeNode\">";
	
	$rowStr  .= "<span class=\"scol_0\">&nbsp;</span>";
	
	$rowStr  .= "<span class=\"scol_1\">".$SearchSetting['searchCodeInfo'][0]['code']."</span>";
	
	$rowStr  .= "<span class=\"scol_2\">".$SearchSetting['searchCodeInfo'][0]['prd_name']."</span>";
	
	$rowStr  .= "<span class=\"scol_3\">".$SearchSetting['searchCodeInfo'][0]['name']."</span>";
	
	$rowStr  .= "</div></nobr>";
	
	$rowStr = preg_replace("#[\r\n\t]+#Uis"," ",$rowStr);

	global $CMS_API;
	$href = $CMS_API->checkAccess("/admin/webavtr/analogs\.html");

	echo "tecdocTree.add(".$SearchSetting['searchCodeInfo'][0]['detail_id'].", -1, '$rowStr', ".($href ? "'/admin/webavtr/analogs.html?d1_code=".strip_tags($SearchSetting['searchCodeInfo'][0]['code'])."&prd1_name=".strip_tags($SearchSetting['searchCodeInfo'][0]['prd_name'])."&partSearch=1'" : "''").", '".$AR_MSG['SearchModule']['11']."', '_blank');";
	
		
		foreach ($__search_results['data'] as $dat_id=>$row) { 

				
			if ($row['detail_id'] != $row['cross_detail_id'] && !isset($loopbackCheck[$row['detail_id']])) {
					
				$rowStr    = "<div class=\"analogTreeNode".$row['cross_level']."\">";
	
				$rowStr  .= "<span class=\"scol_0\">&nbsp;</span>";	
				$rowStr  .= "<span class=\"scol_1\">&nbsp;".$row['article']."</span>";
				$rowStr  .= "<span class=\"scol_2\">".strtoupper($row['brand'])."</span>";
				$rowStr  .= "<span class=\"scol_3\">".$row['spare_info']."</span>";
				
				$rowStr  .= "</div></nobr>";
				
				$rowStr = preg_replace("#[\r\n\t]+#Uis"," ",$rowStr);
										
				echo "tecdocTree.add(".$row['detail_id'].", ".$row['cross_detail_id'].", '".$rowStr."', ".($href ? "'/admin/webavtr/analogs.html?d1_code=".strip_tags($row['article'])."&prd1_name=".strip_tags($row['brand'])."&partSearch=1'" : "''").", '".$AR_MSG['SearchModule']['11']."', '_blank');";
				
			}
			
			$loopbackCheck[$row['detail_id']] = 1;		
			
		} ?>
		
		document.write(tecdocTree);	
		

	</script><?  ?>
			</div>
			
		<? } else { ?>

			<? if ($__search_results['controls']) { ?>
				
				<?  ?><? foreach ($__search_results['controls'] as $hdr_id => $control) { ?>

	<div class="<?= ($hdr_id == "filter" ? 'notice' : '') ?>" style="padding-bottom: 0px;<?= ($hdr_id == "filter" ? 'min-width:1000px;' : '') ?>">
		<?= $control ?>
	</div>

<? } ?><?  ?>

			<? } ?>

			<?  ?><? unset($__search_results['header']['time']); ?>
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

		<?  ?><tr>
	<? $columns = 0; ?>
	<? foreach ($__search_results['header'] as $hdr_id => $column) { ?>

		<? if ($column['visible'] == true) { ?>
			<? $columns++; ?>
			<th class="col_<?=$hdr_id?>"><?= $column['caption'] ?></th>
		<? } ?>

	<? } ?>
</tr><? 

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
					 ?><? if ($SearchSetting['csAmountForGroup'] && $SearchSetting['csAmountForGroup'] < $counterRowsAB && !$showMany) {
	$showMany = true;
	$cntPred = $counterRowsAB - $SearchSetting['csAmountForGroup'];
	$textOpen = trp('Отобразить еще ' . str_replace($cntPred, '%s', declOfNum($cntPred, ['предложение', 'предложения', 'предложений'])), 'SearchModule', $cntPred);
	$textClose = trp('Скрыть ' . str_replace($cntPred, '%s', declOfNum($cntPred, ['предложение', 'предложения', 'предложений'])), 'SearchModule', $cntPred); ?>
	<tr class="show-many group<?= $indexGroup . (($oldMC || !$match_criteria || $is_availability) ? '' : ' close-tr') ?>" data-brand-group="<?=$prevBrandDataRow?>">
		<td colspan="<?= $columns ?>">
			<input class="button-show" type="button" value="<?= $textOpen ?>" data-many-show data-index="<?= $indexGroup ?>"/><input class="button-hide hidden" type="button" value="<?= $textClose ?>" data-many-hide data-index="<?= $indexGroup ?>"/>
		</td>
	</tr>
<? } ?>
<? $prevBrandDataRow = $row['brand']; ?>
<? 
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
					 ?><? if ($SearchSetting['csAmountForGroup'] && $SearchSetting['csAmountForGroup'] < $counterRowsAB && !$showMany) {
	$showMany = true;
	$cntPred = $counterRowsAB - $SearchSetting['csAmountForGroup'];
	$textOpen = trp('Отобразить еще ' . str_replace($cntPred, '%s', declOfNum($cntPred, ['предложение', 'предложения', 'предложений'])), 'SearchModule', $cntPred);
	$textClose = trp('Скрыть ' . str_replace($cntPred, '%s', declOfNum($cntPred, ['предложение', 'предложения', 'предложений'])), 'SearchModule', $cntPred); ?>
	<tr class="show-many group<?= $indexGroup . (($oldMC || !$match_criteria || $is_availability) ? '' : ' close-tr') ?>" data-brand-group="<?=$prevBrandDataRow?>">
		<td colspan="<?= $columns ?>">
			<input class="button-show" type="button" value="<?= $textOpen ?>" data-many-show data-index="<?= $indexGroup ?>"/><input class="button-hide hidden" type="button" value="<?= $textClose ?>" data-many-hide data-index="<?= $indexGroup ?>"/>
		</td>
	</tr>
<? } ?>
<? $prevBrandDataRow = $row['brand']; ?>
<? 
					?>
					<tr class="section">
						<td colspan="<?= $columns ?>"><?= $AR_MSG['SearchModule']['msg47'] ?></td>
					</tr>
				<? }
			}

			if (($row['oem'] != $oem) && ($match_criteria == 1) && ($row['univers'] == 0)) {
				$show_article = 1;
				$oem = $row['oem'];

				 ?><? if ($SearchSetting['csAmountForGroup'] && $SearchSetting['csAmountForGroup'] < $counterRowsAB && !$showMany) {
	$showMany = true;
	$cntPred = $counterRowsAB - $SearchSetting['csAmountForGroup'];
	$textOpen = trp('Отобразить еще ' . str_replace($cntPred, '%s', declOfNum($cntPred, ['предложение', 'предложения', 'предложений'])), 'SearchModule', $cntPred);
	$textClose = trp('Скрыть ' . str_replace($cntPred, '%s', declOfNum($cntPred, ['предложение', 'предложения', 'предложений'])), 'SearchModule', $cntPred); ?>
	<tr class="show-many group<?= $indexGroup . (($oldMC || !$match_criteria || $is_availability) ? '' : ' close-tr') ?>" data-brand-group="<?=$prevBrandDataRow?>">
		<td colspan="<?= $columns ?>">
			<input class="button-show" type="button" value="<?= $textOpen ?>" data-many-show data-index="<?= $indexGroup ?>"/><input class="button-hide hidden" type="button" value="<?= $textClose ?>" data-many-hide data-index="<?= $indexGroup ?>"/>
		</td>
	</tr>
<? } ?>
<? $prevBrandDataRow = $row['brand']; ?>
<? 
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

				 ?><? if ($SearchSetting['csAmountForGroup'] && $SearchSetting['csAmountForGroup'] < $counterRowsAB && !$showMany) {
	$showMany = true;
	$cntPred = $counterRowsAB - $SearchSetting['csAmountForGroup'];
	$textOpen = trp('Отобразить еще ' . str_replace($cntPred, '%s', declOfNum($cntPred, ['предложение', 'предложения', 'предложений'])), 'SearchModule', $cntPred);
	$textClose = trp('Скрыть ' . str_replace($cntPred, '%s', declOfNum($cntPred, ['предложение', 'предложения', 'предложений'])), 'SearchModule', $cntPred); ?>
	<tr class="show-many group<?= $indexGroup . (($oldMC || !$match_criteria || $is_availability) ? '' : ' close-tr') ?>" data-brand-group="<?=$prevBrandDataRow?>">
		<td colspan="<?= $columns ?>">
			<input class="button-show" type="button" value="<?= $textOpen ?>" data-many-show data-index="<?= $indexGroup ?>"/><input class="button-hide hidden" type="button" value="<?= $textClose ?>" data-many-hide data-index="<?= $indexGroup ?>"/>
		</td>
	</tr>
<? } ?>
<? $prevBrandDataRow = $row['brand']; ?>
<? 

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
							<?  ?>
<? if ($hdr_id == 'spare_info') { ?>

	<? if (!in_array($hdr_id, $_interface->csHideGroupFields) || $show_article == 1) { ?>

		<? if ($row[$hdr_id] == '') { ?>
			&nbsp;
		<? } else { ?>
			<?= $row[$hdr_id] ?>
		<? } ?>

	<? } else { ?>
		&nbsp;
	<? } ?>

<? } elseif ($hdr_id == 'term') { ?>

	<? if ($row['term'] > 0 || ($row['max_term'] > 0 && $_interface->csUseMaxTerm)) { ?>
		<?= $row[$hdr_id]; ?>
	<? } elseif (($row['term'] == 0) && ($row['info_only'] != 1) && $row['max_term'] == 0) { ?>
		<?= $AR_MSG['SearchModule']['msg12'] ?>
	<? } elseif ($row['info_only'] == 1) { ?>
		-
	<? } ?>

<? } elseif ($hdr_id == 'evaluation') { ?>

	<? if (($row['info_only'] != 1) && ($SearchSetting['statShow'] == 1)) { ?>
		<a href="#" onclick="prov_stat = window.open('/shop/provider_stat.html?pv=<?= $row['provider_id'] ?>&t=<?= $row['term_interval_value'] ?>', '', 'width=500,height=450'); prov_stat.focus();">
	<? } ?>

	<? if ($row['info_only'] != 1) { ?>
		<?= $row['evaluation'] ?>
	<? } ?>

	<? if (($row['info_only'] != 1) && ($SearchSetting['statShow'] == 1)) { ?>
		</a>
	<? } ?>

<? } elseif ($hdr_id == 'article') { ?>

	<? if (!in_array($hdr_id, $_interface->csHideGroupFields) || $show_article == 1) { ?>

		<span <?= ($row['parsed_article'] == $SearchSetting['searchCode'] ? 'class="web_ar_search_code"' : '') ?>>
			<nobr><?= $row['article'] ?></nobr>

			<? if ($row['superseded_by'] != '') { ?>

				<? $show_replacement_conditions = 1; ?>
				<span style="color: #990000"><sup>
						<a title="<?= $AR_MSG['SearchModule']['msg14'] ?> <?= $row['superseded_by'] ?>"
						   style="font-weight: bold; width: 10px; background: #990000; color: #FFFFFF; padding: 1px; cursor: default"><?= $AR_MSG['SearchModule']['msg48'] ?></a>
					</sup></span>

			<? } elseif ($row['replacement_for'] != '') { ?>

				<? $show_replacement_conditions = 1; ?>

				<span style="color: #990000"><sup>
						<a title="<?= $AR_MSG['SearchModule']['msg15'] ?> <?= $row['replacement_for'] ?>"
						   style="width: 10px; background: #000000; color: #FFFFFF; padding: 1px; cursor: default"><?= $AR_MSG['SearchModule']['msg49'] ?></a>
					</sup></span>
			<? } ?>
				
			</span>

	<? } else { ?>
		&nbsp;
	<? } ?>

<? } elseif ($hdr_id == 'prd_info_link') { ?>

	<? if (!in_array($hdr_id, $_interface->csHideGroupFields) || $show_article == 1) { ?>

		<? if ($SearchSetting['newGroupsTemplate']) { ?>
			<div class="toggle-link-wrapper">
				<? if ($show_article_real) { ?>
					<?
						$search_results_keys = isset($search_results_keys) ? $search_results_keys : array_keys($__search_results['data']);
						$next = $search_results_keys[array_search($dat_id, $search_results_keys) + 1];
						if ($__search_results['data'][$next]['parsed_article'] === $row['parsed_article'] and $__search_results['data'][$next]['brand'] === $row['brand']) {
					?>
							<img src="/_sysimg/tree/<?= ($match_criteria ? 'close' : 'open') ?>all.png" class="toggle-link <?= ($match_criteria ? 'close' : '') ?>" data-toggle-group data-index="<?= $indexGroup ?>" title="<?= ($match_criteria ? tr('Развернуть предложения', 'SearchModule') : tr('Свернуть предложения', 'SearchModule')) ?>"/>
						<? } ?>
				<? } ?>
			</div>
		<? } ?>

		<div <?= ($row['brand_full_name'] != "" ? 'title="' . $row['brand_full_name'] . '"' : '') ?> <?= ($row['oem_brand'] == 1 ? 'class="web_ar_oem_brand"' : 'class="web_ar_brand"') ?>>
			<?=(!empty($row['prd_info_exist']) ? " <a href='/info/producers.html?prd=" . $row['prd_info_exist'] ."' target='_blank'>" . $row['prd_info_link'] . " </a>" : $row['prd_info_link']);?>
		</div>

	<? } else { ?>
		&nbsp;
	<? } ?>

<? } elseif ($hdr_id == 'remains') { ?>

	<? if (($row['remains'] == $AR_MSG['SearchModule']['msg16']) && ($row['info_only'] == 0)) { ?>

		<img src="/images/check.png" title="<?= $AR_MSG['SearchModule']['msg16'] ?>" alt="<?= $AR_MSG['SearchModule']['msg16'] ?>"/>

	<? } elseif ((($SearchSetting['showExactRemains'] == 1) && ($row['remains'] != '')) or ($row['remains'] > 0)) { ?>

		<?= $row['remains'] ?>
		
	<? } else { ?>
		-
	<? } ?>
<? } elseif ($hdr_id == 'destination_display') { ?>

	<? if ($row['destination_display'] != "") { ?>
		<?= $row['destination_display'] ?>
	<? } else { ?>
		&nbsp;
	<? } ?>

<? } elseif ($hdr_id == 'action') { ?>

	<? if (($row['info_only'] != '1') || ($row['provider_price'] > 0)) { ?>
		<?= $row[$hdr_id] ?>
	<? } ?>

<? } elseif ($hdr_id == 'orderm') { ?>

	<? if (($row['info_only'] != '1') || ($row['provider_price'] > 0)) { ?>
		<?= $row[$hdr_id] ?>
	<? } ?>

<? } elseif ($hdr_id == 'min_quantity') { ?>

	<? if ($row['min_quantity'] > 0) { ?>
		<?= $row[$hdr_id] ?>
	<? } else { ?>
		&nbsp;
	<? } ?>

<? } elseif ($hdr_id == 'info') { ?>

	<? if (!in_array($hdr_id, $_interface->csHideGroupFields) || $show_article == 1) { ?>

		<?

		$detailInfo = array(
			"article" => $row['parsed_article'],
			"brand"   => $row['brand']
		);

		$detailLink = data2str($detailInfo, true, true);

		?>

		<a href="#"
		   onclick="window.open('/info/detail.html?sid=<?= $row['_search_id'] ?>&detailLink=<?= $detailLink ?>','','width=800,height=600,scrollbars=yes'); return false;"><img
				src="/images/info.gif" border="0" title="<?= $AR_MSG['SearchModule']['msg17'] ?>"
				alt="<?= $AR_MSG['SearchModule']['msg17'] ?>" hspace="1" align="absmiddle"/></a>

		<? if ($row['picture']) { ?>
			<a href="#"
			   onclick="window.open('/info/detail.html?sid=<?= $row['_search_id'] ?>&did=<?= $row['detail_id'] ?>&detailLink=<?= $detailLink ?>','','width=800,height=600,scrollbars=no');return false;"><img
					src="/_sysimg/icons/picture.gif" border="0" title="<?= $AR_MSG['SearchModule']['msg18'] ?>"
					alt="<?= $AR_MSG['SearchModule']['msg18'] ?>" hspace="1" align="absmiddle"/></a>
		<? } ?>

		<? if ($row['weight'] && ($row['weight'] > 0)) { ?>
			<img src="/_sysimg/ar2/weight.gif" border="0"
				 title="<?= $AR_MSG['SearchModule']['msg19'] ?> = <?= number_format($row['weight'], 3, '.', ' ') ?>"
				 alt="<?= $AR_MSG['SearchModule']['msg19'] ?> = <?= number_format($row['weight'], 3, '.', ' ') ?>"
				 hspace="1" align="absmiddle"/>
		<? } ?>

	<? } else { ?>
		&nbsp;
	<? } ?>

<? } elseif ($hdr_id == 'price_brutto') { ?>

	<? if (($row['weight'] > 0) && ($row['cost_per_weight'] > 0)) { ?>

		<?= $row['price_brutto'] ?>

	<? } ?>

<? } elseif ($hdr_id == 'final_price') { ?>

	<? if ($row['provider_price'] == 0) { ?>
		-
	<? } elseif ($row['provider_price'] == '') { ?>
		-
	<? } else { ?>

		<nobr><?= $row[$hdr_id] ?>

		<sup>
			<font color="#990000">

				<?
				if (count($Deliveries) > 0) {
					foreach ($Deliveries as $dlv => $cur_dlv) {

						if ($cur_dlv['delivery_condition'] == $row['delivery_condition']) {

							if ((($row['weight'] == 0) and ($cur_dlv['tax'] > 0)) || ($cur_dlv['tax'] == 0) || ($cur_dlv['tax'] == '')) {

								if (!safeArrayKey($showDelivery, $row['delivery_condition'])) {
									$showDelivery[$row['delivery_condition']] = $cur_dlv;
								}

								echo array_search($row['delivery_condition'], array_keys($showDelivery)) + 1;

							}

						}

					}
				}
				?>

			</font>
		</sup>

		<? if (($row['cost_per_weight'] > 0) && (!empty($row['cost_per_weight_display'])) and empty($row['weight'])) { ?>
			+ <?= $row['cost_per_weight_display'] ?>/<?=tr('кг', 'Common')?>.
		<? } ?>

	<? } ?>
	</nobr>

	<? if ($row['phand_value'] != 0) { ?>

		<br/>
		<small><span id="phand"><?= $AR_MSG['SearchModule']['msg20'] ?>&nbsp;<nobr><?= $row['detail_phand'] ?></nobr></span>
		</small>

	<? } ?>

<? } elseif ($hdr_id == 'date') { ?>

	<? if (($row['info_only'] != '1') || ($row['provider_price'] > 0)) { ?>
		<?= $row[$hdr_id] ?>
	<? } else { ?>
		-
	<? } ?>

<? } else { ?>

	<?= $row[$hdr_id] ?>

<? } ?><?  ?>
						</td>
					<? }
				} ?>
			</tr>
		<? }
		if ($show_article && $indexGroup == 1) {
			$oldMC = true;
		}

		 ?><? if ($SearchSetting['csAmountForGroup'] && $SearchSetting['csAmountForGroup'] < $counterRowsAB && !$showMany) {
	$showMany = true;
	$cntPred = $counterRowsAB - $SearchSetting['csAmountForGroup'];
	$textOpen = trp('Отобразить еще ' . str_replace($cntPred, '%s', declOfNum($cntPred, ['предложение', 'предложения', 'предложений'])), 'SearchModule', $cntPred);
	$textClose = trp('Скрыть ' . str_replace($cntPred, '%s', declOfNum($cntPred, ['предложение', 'предложения', 'предложений'])), 'SearchModule', $cntPred); ?>
	<tr class="show-many group<?= $indexGroup . (($oldMC || !$match_criteria || $is_availability) ? '' : ' close-tr') ?>" data-brand-group="<?=$prevBrandDataRow?>">
		<td colspan="<?= $columns ?>">
			<input class="button-show" type="button" value="<?= $textOpen ?>" data-many-show data-index="<?= $indexGroup ?>"/><input class="button-hide hidden" type="button" value="<?= $textClose ?>" data-many-hide data-index="<?= $indexGroup ?>"/>
		</td>
	</tr>
<? } ?>
<? $prevBrandDataRow = $row['brand']; ?>
<?  ?>

	</table>
</form><?  ?>

			<? if ($__search_results['controls']) { ?>

				<? foreach ($__search_results['controls'] as $hdr_id=>$control) { ?>

					<? if ($hdr_id !== 'searchPages') { continue; } ?>
					<div class="<?=($hdr_id=="filter"?'notice':'')?>" style="padding-top: 0px; padding-bottom: 0px;<?=($hdr_id=="filter"?'min-width:1000px;':'')?>">
						<?=$control?>
					</div>

				<? } ?>

			<? } ?>

		<? } ?>

		<?  ?><? if (!$SearchSetting['admin_search']) { ?>

<noindex>
<p><small><a href="/shop/report_error.html?errid=E2&article=<?=$SearchSetting['dirtySearchCode']?>&brand=<?=$SearchSetting['searchBrand']?>"><img src="/_sysimg/info2.gif" align="absmiddle" hspace="5" border="0"/><?=$AR_MSG['SearchModule']['msg21']?></a></small></p>
</noindex>

<? if (($clientData['cst_category_id'] > 1) && !$clientData['retail']) { ?>

<div style="background: #D0D0D0; padding: 10px; margin-top: 10px; margin-bottom: 10px;">

<b><?=$AR_MSG['SearchModule']['msg22']?></b>

</div>

<? } ?>

<? } ?>

<?
	
	if (sizeof($showDelivery)>0 || $show_replacement_conditions) {
	$Deliveries = $showDelivery;
	$k = 0;
	
?>
<div class="notice"><b><?=$AR_MSG['SearchModule']['msg23']?></b>

<? foreach ($Deliveries as $dlv=>$delivery) { ?>

<? $k++; ?>	

<div style="padding: 10px">

<sup><font color="#990000"><?=$k?></font></sup>		
<?=$delivery['dlv_text']?>&nbsp;
</div>

<? } ?>

<? if ($show_replacement_conditions==1) { ?>

<div style="padding: 5px">
<span style="color: #990000"><sup>
			<a title="<?=$row['superseded_by']?>" style="font-weight: bold; width: 10px; background: #990000; color: #FFFFFF; padding: 1px; cursor: default"><?=$AR_MSG['SearchModule']['msg48']?></a>
			</sup></span>		
<?=$AR_MSG['SearchModule']['msg24']?>&nbsp;
</div>

<div style="padding: 5px">
<span style="color: #990000"><sup>
			<a title="<?=$row['replacement_for']?>" style="width: 10px; background: #000000; color: #FFFFFF; padding: 1px; cursor: default"><?=$AR_MSG['SearchModule']['msg49']?></a>
			</sup></span>	
<?=$AR_MSG['SearchModule']['msg25']?>&nbsp;
</div><br/>

<? } ?>

</div>

<? } ?><?  ?>

	<? } ?>

	<? if ($SearchSetting['invalid_search']) { ?>
		
		<?  ?><?=$AR_MSG['SearchModule']['msg26']?>
	<?=$AR_MSG['SearchModule']['msg27']?>
	<?=$AR_MSG['SearchModule']['msg28']?>
	<?=$AR_MSG['SearchModule']['msg29']?>
	<?=$AR_MSG['SearchModule']['msg30']?>
	<?=$AR_MSG['SearchModule']['msg31']?><?  ?>

	<? } ?>

<? } else { ?>
	
	<?  ?><h2><?=$AR_MSG['SearchModule']['msg39']?></h2>
	
<p><?=$AR_MSG['SearchModule']['msg40']?></p><?  ?>

<? } ?><? 

	} else {

		 ?><? if (($SearchSetting['authUserSearchOnly'] != 1) || ($SearchSetting['cst_category_id'] >= 1) || ($SearchSetting['admin_search'] == 1)) { ?>

	<? if ($SearchSetting['empty_search']) { ?>

		<?  ?><h1><?=$AR_MSG['SearchModule']['msg1']?></h1>

<ul>

	<? if ($SearchSetting['search_from_catalog']) { ?>
	<li><p><a href="<?=$SearchSetting['catalog_search_url']?>"><?=$AR_MSG['SearchModule']['msg2']?></a></p>
	<? } ?>

	<li><nobr><?=$AR_MSG['SearchModule']['msg3']?></nobr></li>

	<? if ($SearchSetting['catalog_search']) { ?>
	<li><a href="<?=$SearchSetting['catalog_search_url']?>"><?=$AR_MSG['SearchModule']['msg6']?></a>
	<? } ?>

</ul><?  ?>
	
	<? } ?>

	<? if ($alternatives && !$__search_results && !$SearchSetting['empty_search']) { ?>

		<?  ?><h1><?=$AR_MSG['SearchModule']['msg1']?></h1>
	
	<? if ($SearchSetting['search_from_catalog']) { ?>
	<li><p><a href="<?=$SearchSetting['catalog_search_url']?>"><?=$AR_MSG['SearchModule']['msg2']?></a></p>
	<? } ?>

<table border="0" class="web_ar_datagrid">

<tr>

<? foreach ($alternatives['header'] as $hdr_id=>$column) { ?>

	<? if ($column['visible']==true) { ?>

	<th><?=$column['caption']?></th>

	<? } ?>

<? } ?>
</tr>

<? foreach ($alternatives['data'] as $dat_id=>$row) { ?>

<tr class="<?=($dat_id % 2 == 0?'even':'odd')?>">
	<? foreach ($alternatives['header'] as $hdr_id=>$column) { ?>
	
		<?
			switch ($hdr_id) {
				
				case 'brand':
				case 'action_alt': {
					$align = 'center';
				} break;
				default: {
					$align = 'left';
				} break;
				
			}
		?>
		
		<? if ($column['visible'] == true) { ?>
		<td align="<?=$align?>">
		<?=$row[$hdr_id]?>
		
		<? if ($hdr_id=='spare') { ?>
		
			<? if ($row['superseded_by']!='') { ?>
			<?=$row['code']?> - <?=$AR_MSG['SearchModule']['msg7']?><?=$row['superseded_by']?>
			<? } ?>
			
			<? if ($row['replacement_for']!='') { ?>
			<?=$row['code']?> - <?=$AR_MSG['SearchModule']['msg8']?><?=$row['replacement_for']?>
			<? } ?>

		<? } ?>
			
		</td>
		<? } ?>

	<? } ?>
</tr>

<? } ?>

</table><?  ?>

	<? } ?>

	<? if ($__search_results && !$SearchSetting['empty_search']) { ?>

		<? if (!$SearchSetting['admin_search']) { ?>

			<?  ?><table border="0" width="100%">

<tr>
<td>
<nobr><?=$AR_MSG['SearchModule']['msg1']?></nobr>
	
	<? if ($SearchSetting['catalog_search']) { ?>
	<li><a href="<?=$SearchSetting['catalog_search_url']?>"><?=$AR_MSG['SearchModule']['msg6']?></a>
	<? } ?>

</td><td align="right" valign="top">

<? if ($__search_results && !$SearchSetting['empty_search']) { ?>

<b><?=$AR_MSG['SearchModule']['msg9']?></b>&nbsp;<?=$cid?>

<? } ?>

</td>
<td valign="top" style="padding-left: 10px">
	
	<? if ($SearchSetting['groups_count'] > 1) { ?>
	
	<b><?=$AR_MSG['SearchModule']['msg41']?></b>&nbsp;
	
	<?
		$sLink = new cLink($_SERVER['REQUEST_URI'], '');
		$sLink->removeQueryParam("g");
        $sLink->removeQueryParam("article");
	?>
	
	
	<select onchange="window.location.href = '<?=$sLink->link?>&g='+this.value.replace(/:.*$/,'')+'&article='+this.value.replace(/^.*:/,'')">
	
	<? foreach ($alternatives as $dat_id=>$row) { ?>
	
			<option value="<?=$row['id']?>:<?=$row['code']?>" <?=($_REQUEST['g']==$row['id']?'selected="selected"':'')?>>
				<?=$row['brand']?>
			</option>

	<? } ?>

	</select>
	
	<? } ?>

</td></tr>
</table>

<? if ($basket_check != 1) { ?>

<? $st_c = 0 ?>
<table border="0" cellpadding='1' cellspacing="0" width="100%" style="border-top: 1px solid #A0A0A0; border-bottom: 1px solid #A0A0A0">

<caption><?=$AR_MSG['SearchModule']['msg42']?></caption>

<? foreach ($searchStat as $key=>$searchN) { ?>

<? if ($st_c % 7 == 0) { ?><tr><? } ?>

<?
	$st_c++;
	$link = new cLink($_SERVER['REQUEST_URI'], '');
  
    $link->removeQueryParam("g");
    $link->removeQueryParam("article");

    $link->addQueryParam("article", $searchN['sse_search_number']);
?>
<td><a href="<?=$link?>"><b><?=$searchN['sse_search_number']?></b></a></td>
<? if ($st_c % 7 == 0) { ?><tr><? } ?>

<? } ?>

</table><br>

<? } ?><?  ?>

		<? } else { ?>

			<h1><?=$AR_MSG['SearchModule']['msg1']?></h1>

		<? } ?>

		<? if ($search_from_catalog) { ?>
			
			<li><p><a href="<?=$SearchSetting['catalog_search_url']?>"><?=$AR_MSG['SearchModule']['msg2']?></a></p></li>

		<? } ?>

		<? if ($SearchSetting['searchMode'] == "An") { ?>
			<div id="tree_searchmode_An">
				<?  ?>		
<style>

	body {
		font-size: 11px
	}

	.scol_0 {
		width: 600px;
	}
	
	.scol_1 {

		position: absolute;
		left: 100px;
		width: 150px;
		margin-right: 5px;
		vertical-align: top;

	}

	.scol_2 {
		position: absolute;
		left: 250px;
		width: 200px;
		margin-right: 5px;

	}
	
	.scol_3 {
		position: absolute;
		left: 400px;
		width: 300px;
		margin-right: 5px;

	}
	
	.scol_4 {

		width: 50px;
		margin-right: 5px;
		text-align: center;

	}
	
	.scol_5 {

		width: 30px;
		margin-right: 5px;
		text-align: center;

	}
	
	.searchBox {
		width: 100%;
		border: #B3E0FF solid 1px;
		background: #F9F9F9;
	}
	
	img {
		border: 0px;
	}
	
	a {
		text-decoration: none;
		cursor: hand;
	}
	
	
	a.normal {
		text-decoration: underline;
		cursor: hand;
	}
	
	div.analogTreeNode {
		width: 100%; padding-left: 50px;
		background: #FFFFFF;
	}
	
	div.analogTreeNode1 {
		width: 100%; padding-left: 50px;
		background: #A0A0A0;
	}
	
	div.analogTreeNode2 {
		width: 100%; padding-left: 50px;
		background: #C0C0C0;
	}
	
	div.analogTreeNode3	 {
		width: 100%; padding-left: 50px;
		background: #A0A0A0;
		color: #FFFFFF;
	}
	
</style>
	
	<script type="text/javascript" src="/_syslib/custom.dtree.js"></script>
	
	<script type="text/javascript">

	
		<?	$loopbackCheck = array(); ?>
		
		tecdocTree = new dTree('tecdocTree', '/images/ar2-tree');
		
		
<?

	$rowStr    = "<nobr><div class=\"analogTreeNode\">";
	
	$rowStr  .= "<span class=\"scol_0\">&nbsp;</span>";
	
	$rowStr  .= "<span class=\"scol_1\">".$SearchSetting['searchCodeInfo'][0]['code']."</span>";
	
	$rowStr  .= "<span class=\"scol_2\">".$SearchSetting['searchCodeInfo'][0]['prd_name']."</span>";
	
	$rowStr  .= "<span class=\"scol_3\">".$SearchSetting['searchCodeInfo'][0]['name']."</span>";
	
	$rowStr  .= "</div></nobr>";
	
	$rowStr = preg_replace("#[\r\n\t]+#Uis"," ",$rowStr);

	global $CMS_API;
	$href = $CMS_API->checkAccess("/admin/webavtr/analogs\.html");

	echo "tecdocTree.add(".$SearchSetting['searchCodeInfo'][0]['detail_id'].", -1, '$rowStr', ".($href ? "'/admin/webavtr/analogs.html?d1_code=".strip_tags($SearchSetting['searchCodeInfo'][0]['code'])."&prd1_name=".strip_tags($SearchSetting['searchCodeInfo'][0]['prd_name'])."&partSearch=1'" : "''").", '".$AR_MSG['SearchModule']['11']."', '_blank');";
	
		
		foreach ($__search_results['data'] as $dat_id=>$row) { 

				
			if ($row['detail_id'] != $row['cross_detail_id'] && !isset($loopbackCheck[$row['detail_id']])) {
					
				$rowStr    = "<div class=\"analogTreeNode".$row['cross_level']."\">";
	
				$rowStr  .= "<span class=\"scol_0\">&nbsp;</span>";	
				$rowStr  .= "<span class=\"scol_1\">&nbsp;".$row['article']."</span>";
				$rowStr  .= "<span class=\"scol_2\">".strtoupper($row['brand'])."</span>";
				$rowStr  .= "<span class=\"scol_3\">".$row['spare_info']."</span>";
				
				$rowStr  .= "</div></nobr>";
				
				$rowStr = preg_replace("#[\r\n\t]+#Uis"," ",$rowStr);
										
				echo "tecdocTree.add(".$row['detail_id'].", ".$row['cross_detail_id'].", '".$rowStr."', ".($href ? "'/admin/webavtr/analogs.html?d1_code=".strip_tags($row['article'])."&prd1_name=".strip_tags($row['brand'])."&partSearch=1'" : "''").", '".$AR_MSG['SearchModule']['11']."', '_blank');";
				
			}
			
			$loopbackCheck[$row['detail_id']] = 1;		
			
		} ?>
		
		document.write(tecdocTree);	
		

	</script><?  ?>
			</div>
			
		<? } else { ?>

			<? if ($__search_results['controls']) { ?>
				
				<?  ?><? foreach ($__search_results['controls'] as $hdr_id => $control) { ?>

	<div class="<?= ($hdr_id == "filter" ? 'notice' : '') ?>" style="padding-bottom: 0px;<?= ($hdr_id == "filter" ? 'min-width:1000px;' : '') ?>">
		<?= $control ?>
	</div>

<? } ?><?  ?>

			<? } ?>

			<?  ?><? unset($__search_results['header']['time']); ?>
<form id="admin-search-form" action="<?=$SearchSetting['basketURL']?>" method="POST">

<? if ($SearchSetting['useOrderColumn'] == 1) { ?>

<input type="hidden" name="func" value="add">
<div class="searchPrderButton"><input type="submit" value="<?=$AR_MSG['SearchModule']['msg46']?>"></div><br>

<? } ?>

<table border="0" class="web_ar_datagrid" width="100%">

<?  ?><tr>
	<? foreach ($__search_results['header'] as $hdr_id => $column) { ?>

		<? if ($column['visible'] == true) { ?>
			<th class="col_<?=$hdr_id?>"><?= $column['caption'] ?></th>
		<? } ?>

	<? } ?>

	<? if ($basket_check) { ?>
		<th><?= $__search_results['header']['final_price_val']['caption'] ?></th>
		<th><?= $__search_results['header']['percent_term']['caption'] ?></th>
	<? } ?>
</tr><?  ?>

<? $showDelivery = array(); ?>

<? foreach ($__search_results['data'] as $dat_id=>$row) { ?>

<?
if ($row['info_only'] == 1) {
	
	if (($SearchSetting['searchCode'] != $row['parsed_article']) or ($ZeroResultShown == 1)) {
	
		continue;
		
	} else {
		
		foreach ($__search_results['data'] as $dat_id2=>$row2) {
		
		    if (($row['parsed_article'] == $row2['parsed_article']) && ($dat_id != $dat_id2) && ($row2['info_only'] == 0) && ($row['prd_info_link'] == $row2['prd_info_link'])) { 
    			continue 2;
			}

		}
		
		$ZeroResultShown = 1;

	}

} 
?>

<?
 
if (($isProvider['provider_id'] == $row['provider_id']) && ($row['provider_id']>0)) { 
	$class = 'provider_row'; 
} elseif ($dat_id % 2 == 0) {
	$class = 'even';
} else {
	$class = 'odd';
}
?>

<tr <?=($row['sts_style']!=''?'style="'.$row['sts_style'].'"':'class="'.$class.'"')?> data-brand-group="<?=$row['brand']?>">

	<? foreach ($__search_results['header'] as $hdr_id=>$column) { ?>
		
		<? if ($column['visible']==true) { ?>
		
		<? 
			switch($hdr_id) {
				
				case 'spare_info': {
					$col_align = 'left';
				} break;
				
				case 'final_price':
				case 'customer_price':
				case 'dlv_weight_tax':
				case 'price_brutto': {
					$col_align = 'right';
				} break;
				
				default: {
					$col_align = 'center';
				}
				
			}
		?>
		<td class="col_<?=$hdr_id?> search-col__<?=$hdr_id?>" align="<?= $col_align ?>">
		
			<?  ?>

<? if ($hdr_id == 'term') { ?>

	<? if ($row['term'] > 0 || ($row['max_term'] > 0 && $_interface->csUseMaxTerm)) { ?>
		<?= $row[$hdr_id]; ?>
	<? } elseif (($row['term'] == 0) && ($row['info_only'] != 1) && $row['max_term'] == 0) { ?>
		<?= $AR_MSG['SearchModule']['msg12'] ?>
	<? } elseif ($row['info_only'] == 1) { ?>
		-
	<? } ?>

<? } elseif ($hdr_id == 'evaluation') { ?>

	<? if (($row['info_only'] != 1) && ($SearchSetting['statShow'] == 1)) { ?>
		<a href="#" onclick="prov_stat = window.open('/shop/provider_stat.html?pv=<?= $row['provider_id'] ?>&t=<?= $row['term_interval_value'] ?>', '', 'width=500,height=450'); prov_stat.focus();">
	<? } ?>

	<? if ($row['info_only'] != 1) { ?>
		<?= $row['evaluation'] ?>
	<? } ?>

	<? if (($row['info_only'] != 1) && ($SearchSetting['statShow'] == 1)) { ?>
		</a>
	<? } ?>
<? } elseif ($hdr_id == 'prd_info_link') { ?>

	<?=(!empty($row['prd_info_exist']) ? " <a href='/info/producers.html?prd=" . $row['prd_info_exist'] ."' target='_blank'>" . $row['prd_info_link'] . " </a>" : $row['prd_info_link']);?>

<? } elseif ($hdr_id == 'article') { ?>

	<span <?= ($row['parsed_article'] == $SearchSetting['searchCode'] ? 'class="web_ar_search_code"' : '') ?>>
		<nobr><?= $row['article'] ?></nobr>

		<? if ($row['superseded_by'] != '') { ?>

			<? $show_replacement_conditions = 1; ?>
			<span style="color: #990000"><sup>
					<a title="<?= $AR_MSG['SearchModule']['msg14'] ?> <?= $row['superseded_by'] ?>"
					   style="font-weight: bold; width: 10px; background: #990000; color: #FFFFFF; padding: 1px; cursor: default"><?= $AR_MSG['SearchModule']['msg48'] ?></a>
				</sup></span>

		<? } elseif ($row['replacement_for'] != '') { ?>

			<? $show_replacement_conditions = 1; ?>

			<span style="color: #990000"><sup>
					<a title="<?= $AR_MSG['SearchModule']['msg15'] ?> <?= $row['replacement_for'] ?>"
					   style="width: 10px; background: #000000; color: #FFFFFF; padding: 1px; cursor: default"><?= $AR_MSG['SearchModule']['msg49'] ?></a>
				</sup></span>
		<? } ?>
			
		</span>

<? } elseif ($hdr_id == 'brand') { ?>

	<div <?= ($row['brand_full_name'] != "" ? 'title="' . $row['brand_full_name'] . '"' : '') ?>>

		<? if ($row['oem_brand'] == 1) { ?>
			<span id="web_ar_oem_brand">
		<?= $row['brand'] ?>
		</span>
		<? } else { ?>
			<?= $row['brand'] ?>
		<? } ?>
	</div>

<? } elseif ($hdr_id == 'remains') { ?>

	<? if ($row['info_only'] == 0) { ?>

		<? if ($row['remains'] == $AR_MSG['SearchModule']['msg16']) { ?>
			<img src="/images/check.png" title="<?= $AR_MSG['SearchModule']['msg16'] ?>"
				 alt="<?= $AR_MSG['SearchModule']['msg16'] ?>"/>
		<? } elseif (($SearchSetting['showExactRemains'] == 1) && ($row['remains'] != '')) { ?>
			<?= $row['remains'] ?>
		<? } elseif ($row['remains'] > 0) { ?>
			<?= $row['remains'] ?>
		<? } else { ?>
			-
		<? } ?>

	<? } else { ?>
		-
	<? } ?>

<? } elseif ($hdr_id == 'destination_display') { ?>

	<?= $row['destination_display'] ?>

<? } elseif ($hdr_id == 'action') { ?>

	<? if (($row['info_only'] != '1') || ($row['provider_price'] > 0)) { ?>
		<?= $row[$hdr_id] ?>
	<? } ?>

<? } elseif ($hdr_id == 'orderm') { ?>

	<? if (($row['info_only'] != '1') || ($row['provider_price'] > 0)) { ?>
		<?= $row[$hdr_id] ?>
	<? } ?>

<? } elseif ($hdr_id == 'min_quantity') { ?>

	<? if ($row['min_quantity'] > 0) { ?>
		<?= $row[$hdr_id] ?>
	<? } ?>

<? } elseif ($hdr_id == 'info') { ?>

	<?

	$detailInfo = array(
		"article" => $row['parsed_article'],
		"brand"   => $row['brand']
	);

	$detailLink = data2str($detailInfo, true, true);

	?>

	<a href="#"
	   onclick="window.open('/info/detail.html?sid=<?= $row['_search_id'] ?>&detailLink=<?= $detailLink ?>','','width=800,height=600,scrollbars=yes'); return false;"><img
			src="/images/info.gif" border="0" title="<?= $AR_MSG['SearchModule']['msg17'] ?>"
			alt="<?= $AR_MSG['SearchModule']['msg17'] ?>" hspace="1" align="absmiddle"/></a>

	<? if ($row['picture']) { ?>
		<a href="#"
		   onclick="window.open('/info/detail.html?sid=<?= $row['_search_id'] ?>&did=<?= $row['detail_id'] ?>&detailLink=<?= $detailLink ?>','','width=800,height=600,scrollbars=no');return false;"><img
				src="/_sysimg/icons/picture.gif" border="0" title="<?= $AR_MSG['SearchModule']['msg18'] ?>"
				alt="<?= $AR_MSG['SearchModule']['msg18'] ?>" hspace="1" align="absmiddle"/></a>
	<? } ?>

	<? if ($row['weight'] && ($row['weight'] > 0)) { ?>
		<img src="/_sysimg/ar2/weight.gif" border="0"
			 title="<?= $AR_MSG['SearchModule']['msg19'] ?> = <?= number_format($row['weight'], 3, '.', ' ') ?>"
			 alt="<?= $AR_MSG['SearchModule']['msg19'] ?> = <?= number_format($row['weight'], 3, '.', ' ') ?>"
			 hspace="1" align="absmiddle"/>
	<? } ?>

<? } elseif ($hdr_id == 'price_brutto') { ?>

	<? if (($row['weight'] > 0) && ($row['cost_per_weight'] > 0)) { ?>

		<?= $row['price_brutto'] ?>

	<? } ?>

<? } elseif ($hdr_id == 'final_price') { ?>

	<? if ($row['provider_price'] == 0) { ?>
		-
	<? } elseif ($row['provider_price'] == '') { ?>
		-
	<? } else { ?>

		<? $final_price = $row[$hdr_id]; ?>
		<nobr><?= $row[$hdr_id] ?>

		<sup>
			<font color="#990000">

				<?
				if (count($Deliveries) > 0) {
					foreach ($Deliveries as $dlv => $cur_dlv) {

						if ($cur_dlv['delivery_condition'] == $row['delivery_condition']) {

							if ((($row['weight'] == 0) and ($cur_dlv['tax'] > 0)) || ($cur_dlv['tax'] == 0) || ($cur_dlv['tax'] == '')) {

								if (!safeArrayKey($showDelivery, $row['delivery_condition'])) {
									$showDelivery[$row['delivery_condition']] = $cur_dlv;
								}

								echo array_search($row['delivery_condition'], array_keys($showDelivery)) + 1;

							}

						}

					}
				}
				?>

			</font>
		</sup>

		<? if (($row['cost_per_weight'] > 0) && (!empty($row['cost_per_weight_display'])) and empty($row['weight'])) { ?>
			+ <?= $row['cost_per_weight_display'] ?>/<?=tr('кг', 'Common')?>.
		<? } ?>

	<? } ?>
	</nobr>

	<? if ($row['phand_value'] != 0) { ?>

		<br/>
		<small><span id="phand"><?= $AR_MSG['SearchModule']['msg20'] ?>&nbsp;<nobr><?= $row['detail_phand'] ?></nobr></span>
		</small>

	<? } ?>

<? } elseif ($hdr_id == 'date') { ?>

	<? if (($row['info_only'] != '1') || ($row['provider_price'] > 0)) { ?>
		<?= $row[$hdr_id] ?>
	<? } else { ?>
		-
	<? } ?>

<? } else { ?>

	<?= $row[$hdr_id] ?>

<? } ?><?  ?>

		</td>
		
		<? } ?>

	<? } ?>
	
	<? if ($basket_check == 1) { ?>
        <td align="right">
			<? if ($row['final_price_val'] && ($desire_price != 0)) { ?>
				<?=number_format((($row['final_price_val'] - $desire_price) / $desire_price *100), 2, '.', ' ')?>
			<? } ?>
		</td>
        <td align="right">
			<? if ($row['max_term'] && ($desire_term != 0)) { ?>
				<?=number_format((($row['max_term'] - $desire_term) / $desire_term *100), 2, '.', ' ')?>
			<? } elseif ($row['term'] && ($desire_term !=0 )) { ?>
				<?=number_format((($row['term'] - $desire_term) / $desire_term *100), 2, '.', ' ')?>
  	
            <? } ?>
        </td>
    <? } ?>
</tr>

<? } ?>

</table>

</form><?  ?>

			<? if ($__search_results['controls']) { ?>

				<? foreach ($__search_results['controls'] as $hdr_id=>$control) { ?>

					<? if ($hdr_id !== 'searchPages') { continue; } ?>
					<div class="<?=($hdr_id=="filter"?'notice':'')?>" style="padding-top: 0px; padding-bottom: 0px;<?=($hdr_id=="filter"?'min-width:1000px;':'')?>">
						<?=$control?>
					</div>

				<? } ?>

			<? } ?>

		<? } ?>

		<?  ?><? if (!$SearchSetting['admin_search']) { ?>

<noindex>
<p><small><a href="/shop/report_error.html?errid=E2&article=<?=$SearchSetting['dirtySearchCode']?>&brand=<?=$SearchSetting['searchBrand']?>"><img src="/_sysimg/info2.gif" align="absmiddle" hspace="5" border="0"/><?=$AR_MSG['SearchModule']['msg21']?></a></small></p>
</noindex>

<? if (($clientData['cst_category_id'] > 1) && !$clientData['retail']) { ?>

<div style="background: #D0D0D0; padding: 10px; margin-top: 10px; margin-bottom: 10px;">

<b><?=$AR_MSG['SearchModule']['msg22']?></b>

</div>

<? } ?>

<? } ?>

<?
	
	if (sizeof($showDelivery)>0 || $show_replacement_conditions) {
	$Deliveries = $showDelivery;
	$k = 0;
	
?>
<div class="notice"><b><?=$AR_MSG['SearchModule']['msg23']?></b>

<? foreach ($Deliveries as $dlv=>$delivery) { ?>

<? $k++; ?>	

<div style="padding: 10px">

<sup><font color="#990000"><?=$k?></font></sup>		
<?=$delivery['dlv_text']?>&nbsp;
</div>

<? } ?>

<? if ($show_replacement_conditions==1) { ?>

<div style="padding: 5px">
<span style="color: #990000"><sup>
			<a title="<?=$row['superseded_by']?>" style="font-weight: bold; width: 10px; background: #990000; color: #FFFFFF; padding: 1px; cursor: default"><?=$AR_MSG['SearchModule']['msg48']?></a>
			</sup></span>		
<?=$AR_MSG['SearchModule']['msg24']?>&nbsp;
</div>

<div style="padding: 5px">
<span style="color: #990000"><sup>
			<a title="<?=$row['replacement_for']?>" style="width: 10px; background: #000000; color: #FFFFFF; padding: 1px; cursor: default"><?=$AR_MSG['SearchModule']['msg49']?></a>
			</sup></span>	
<?=$AR_MSG['SearchModule']['msg25']?>&nbsp;
</div><br/>

<? } ?>

</div>

<? } ?><?  ?>

	<? } ?>

	<? if ($SearchSetting['invalid_search']) { ?>
		
		<?  ?><?=$AR_MSG['SearchModule']['msg26']?>
	<?=$AR_MSG['SearchModule']['msg27']?>
	<?=$AR_MSG['SearchModule']['msg28']?>
	<?=$AR_MSG['SearchModule']['msg29']?>
	<?=$AR_MSG['SearchModule']['msg30']?>
	<?=$AR_MSG['SearchModule']['msg31']?><?  ?>

	<? } ?>

<? } else { ?>
	
	<?  ?><h2><?=$AR_MSG['SearchModule']['msg39']?></h2>
	
<p><?=$AR_MSG['SearchModule']['msg40']?></p><?  ?>

<? } ?><? 

	}

} else {

	if ($SearchSetting['csSearchTemplate'] == "groups") {

		 ?><? if ($_SYSTEM->REQUESTED_PAGE == "/shop/basket_check.html") {

	$basket_check = '1';
	$desire_price = $_SESSION['basket']['control']['desire_price'];
	$desire_term = $_SESSION['basket']['control']['desire_term'];
}
?>
<? if (($SearchSetting['authUserSearchOnly'] != 1) || !$SearchSetting['isGuest'] || ($SearchSetting['admin_search'] == 1)) { ?>
	<? if ($SearchSetting['isGuest']) { ?>
		<div class="message message_type_success">
			<div class="message__text">
				<?=trp('Если Вы уже зарегистрированы на сайте — пожалуйста, %sавторизуйтесь%s для получения корректных предложений товаров.', 'SearchModule', '<a data-toggle="modal" data-target="#myModal">', '</a>')?>
			</div>
		</div>
	<? } ?>

	<?  ?><?
$groupActive = 1;
if (!empty($alternatives)) {
	$alternativesData = $alternatives;
	if ($alternatives['data']) {
		$alternativesData = $alternativesData['data'];
	}

	foreach ($alternativesData as $key => $alt) {
		if ($_REQUEST['g'] == $alt['id'] || strtoupper($_REQUEST['brand']) == strtoupper($alt['brand'])) {
			$groupActive = $key;
			break;
		}
	}
}
?>
<div class="search-data__header flc">

	<div class="leftside">
		<h1 class="search-data__h1"><?= $AR_MSG['SearchModule']['msg1'] ?>
			<span class="search-code"><?= $SearchSetting['searchCode'] ?></span>
			<? if (!empty($alternativesData)) { ?>
				<? if ($__search_results) { ?>
					<span class="search-brand<? if ($alternativesData && count($alternativesData) > 1) { ?> search-alternatives<? } ?>">
						<?= $alternativesData[$groupActive]['brand']; ?>
					</span>
					<? if ($alternativesData && count($alternativesData) > 1) { ?>
						<?  ?><div class="alternatives-modal">
	<div class="alternatives-modal__title"><?= tr('Выберите производителя', 'SearchModule') ?></div>
	<div class="alternatives-modal__descr"><?= tr('Найдено несколько совпадений', 'SearchModule') ?></div>
	<button type="button" class="close modal-dialog__close"></button>
	<div class="alternatives-modal__content">
		<div class="alternatives">
			<? if (count($alternativesData) > 0) {

				$sLink = new cLink($_SERVER['REQUEST_URI'], '');
				$sLink->removeQueryParam("g")
					->removeQueryParam("brand")
					->removeQueryParam(Search_API::STEP_PARAMETER_NAME);

				$headerColumns = ['prd_info_link', 'code', 'spare_info'];
				$bodyColumns = ['brand', 'code', 'spare_info'];
				?>
				<div class="alternatives-header">
					<? foreach ($headerColumns as $column) { ?>
						<div class="alternatives-header__col alternatives-header__col--<?= $column ?>">
							<?= $__search_results['header'][$column]['caption'] ?>
						</div>
					<? } ?>
				</div>
				<? foreach ($alternativesData as $alt) { ?>
					<a class="alternatives__row" href="<?= $sLink->link . "&g=" . $alt['id'] ?>">
						<? foreach ($bodyColumns as $column) { ?>
							<span class="alternatives__col  alternatives__col--<?= $column ?>">
							<span class="alt_<?= $column ?>" title="<?= $alt[$column] ?>"><?= $alt[$column] ?></span>
						</span>
						<? } ?>
					</a>
					<?
				}
			} ?>
		</div>
	</div>
</div>

<?  ?>
					<? } ?>
				<? } ?>
			<? } ?>
		</h1>
		<? if ((int)$search_results_info['allCount'] > 0) { ?>
			<div class="search-data__stat">
				<span class="hidden-xs"><?= $AR_MSG['SearchModule']['msg53'] ?></span>
				<?= sprintf($AR_MSG['SearchModule']['msg54'], $search_results_info['allCount'], $search_results_info['matchCount'], $search_results_info['analogsCount'], $search_results_info['universCount'], '<span class="text-nowrap">' . $search_results_info['minPrice'] . '</span>', '<span class="text-nowrap">' . $search_results_info['maxPrice'] . '</span>') ?>
			</div>
		<? } ?>
	</div>
	<? if ($__search_results) { ?>
		<?  ?><? if (!empty($currencies)) { ?>
	<div class="search-currency search-data__currency">
		<? foreach ($currencies as $currency) { ?>
			<input id="currency<?= $currency['id'] ?>" type="radio" name="cid" value="<?= $currency['id'] ?>" <? if ($currency['checked']){ ?>checked="checked"<? } ?>>
			<label class="search-currency__label" for="currency<?= $currency['id'] ?>"><?= $currency['html_sign'] ?></label>
		<? } ?>
	</div>
<?}?><?  ?>
	<? } ?>
</div><?  ?>

	<? if ($SearchSetting['empty_search']) { ?>

		<?  ?><div class="warning search-data__empty-warning">

	<? if ($SearchSetting['search_from_catalog']) { ?>
		<p><a class="warning__link" href="<?= $SearchSetting['catalog_search_url'] ?>"><?= $AR_MSG['SearchModule']['msg2'] ?></a></p>
	<? } ?>

	<p><?= $AR_MSG['SearchModule']['msg3'] ?></p>
	<?= $AR_MSG['SearchModule']['msg4'] ?> <a class="warning__link" href="/vin/form.html"><?= $AR_MSG['SearchModule']['msg5'] ?></a>.

	<? if ($SearchSetting['catalog_search']) { ?>
		<a class="warning__link" href="<?= $SearchSetting['catalog_search_url'] ?>"><?= $AR_MSG['SearchModule']['msg6'] ?></a>
	<? } ?>

</div><?  ?>

	<? } else { ?>

		<? if ($__search_results) { ?>

			<? if (!$admin_search) { ?>

				<?  ?><?  ?>

			<? } else { ?>

				<?= $AR_MSG['SearchModule']['msg1'] ?>

			<? } ?>

			<? if ($search_from_catalog) { ?>

			<li><p><a href="<?=$SearchSetting['catalog_search_url']?>"><?=$AR_MSG['SearchModule']['msg2']?></a></p></li>

			<? } ?>

			<? if ($SearchSetting['searchMode'] == "An") { ?>

				<?  ?>		
<style>

	body {
		font-size: 11px
	}

	.scol_0 {
		width: 600px;
	}
	
	.scol_1 {

		position: absolute;
		left: 100px;
		width: 150px;
		margin-right: 5px;
		vertical-align: top;

	}

	.scol_2 {
		position: absolute;
		left: 250px;
		width: 200px;
		margin-right: 5px;

	}
	
	.scol_3 {
		position: absolute;
		left: 400px;
		width: 300px;
		margin-right: 5px;

	}
	
	.scol_4 {

		width: 50px;
		margin-right: 5px;
		text-align: center;

	}
	
	.scol_5 {

		width: 30px;
		margin-right: 5px;
		text-align: center;

	}
	
	.searchBox {
		width: 100%;
		border: #B3E0FF solid 1px;
		background: #F9F9F9;
	}
	
	img {
		border: 0px;
	}
	
	a {
		text-decoration: none;
		cursor: hand;
	}
	
	
	a.normal {
		text-decoration: underline;
		cursor: hand;
	}
	
	div.analogTreeNode {
		width: 100%; padding-left: 50px;
		background: #FFFFFF;
	}
	
	div.analogTreeNode1 {
		width: 100%; padding-left: 50px;
		background: #A0A0A0;
	}
	
	div.analogTreeNode2 {
		width: 100%; padding-left: 50px;
		background: #C0C0C0;
	}
	
	div.analogTreeNode3	 {
		width: 100%; padding-left: 50px;
		background: #A0A0A0;
		color: #FFFFFF;
	}
	
</style>
	
	<script type="text/javascript" src="/_syslib/custom.dtree.js"></script>
	
	<script type="text/javascript">

	
		<?	$loopbackCheck = array(); ?>
		
		tecdocTree = new dTree('tecdocTree', '/images/ar2-tree');
		
		
<?

	$rowStr    = "<nobr><div class=\"analogTreeNode\">";
	
	$rowStr  .= "<span class=\"scol_0\">&nbsp;</span>";
	
	$rowStr  .= "<span class=\"scol_1\">".$SearchSetting['searchCodeInfo'][0]['code']."</span>";
	
	$rowStr  .= "<span class=\"scol_2\">".$SearchSetting['searchCodeInfo'][0]['prd_name']."</span>";
	
	$rowStr  .= "<span class=\"scol_3\">".$SearchSetting['searchCodeInfo'][0]['name']."</span>";
	
	$rowStr  .= "</div></nobr>";
	
	$rowStr = preg_replace("#[\r\n\t]+#Uis"," ",$rowStr);

	echo "tecdocTree.add(".$SearchSetting['searchCodeInfo'][0]['detail_id'].", -1, '$rowStr', '/admin/webavtr/analogs.html?d1_code=".strip_tags($SearchSetting['searchCodeInfo'][0]['code'])."&prd1_name=".strip_tags($SearchSetting['searchCodeInfo'][0]['prd_name'])."&partSearch=1', '".$AR_MSG['SearchModule']['11']."', '_blank');";
	
		
		foreach ($__search_results['data'] as $dat_id=>$row) { 

				
			if ($row['detail_id'] != $row['cross_detail_id'] && !isset($loopbackCheck[$row['detail_id']])) {
					
				$rowStr    = "<div class=\"analogTreeNode".$row['cross_level']."\">";
	
				$rowStr  .= "<span class=\"scol_0\">&nbsp;</span>";	
				$rowStr  .= "<span class=\"scol_1\">&nbsp;".$row['article']."</span>";
				$rowStr  .= "<span class=\"scol_2\">".strtoupper($row['brand'])."</span>";
				$rowStr  .= "<span class=\"scol_3\">".$row['spare_info']."</span>";
				
				$rowStr  .= "</div></nobr>";
				
				$rowStr = preg_replace("#[\r\n\t]+#Uis"," ",$rowStr);
										
				echo "tecdocTree.add(".$row['detail_id'].", ".$row['cross_detail_id'].", '".$rowStr."', '/admin/webavtr/analogs.html?d1_code=".strip_tags($row['article'])."&prd1_name=".strip_tags($row['brand'])."&partSearch=1', '".$AR_MSG['SearchModule']['11']."', '_blank');";
				
			}
			
			$loopbackCheck[$row['detail_id']] = 1;		
			
		} ?>
		
		document.write(tecdocTree);	
		

	</script><?  ?>

			<? } else { ?>

				<? if ($__search_results['controls']) { ?>

					<?  ?><? foreach ($__search_results['controls'] as $hdr_id=>$control) { ?>

<? if ($hdr_id == 'searchPages') continue; ?>

<div class="<?=($hdr_id=="filter"?'notice':'')?>" style="padding-top: 0px; padding-bottom: 0px">
	<?=$control?>
</div>

<? } ?><?  ?>

				<? } ?>

				<?  ?><?  ?><script language="JavaScript">

	function showFullGroup(id, flHide) {

		if (flHide) {
			jqWar('.showed.group'+id).addClass('hidden');
			jqWar('.showed.group'+id).removeClass('showed');
			jqWar('.group'+id+'.search-row--show-many .button-hide').css('display','none');
			jqWar('.group'+id+'.search-row--show-many .button-show').css('display','inline-block');
		} else {
			jqWar('.hidden.group'+id).addClass('showed');
			jqWar('.hidden.group'+id).removeClass('hidden');
			jqWar('.group'+id+'.search-row--show-many .button-show').css('display','none');
			jqWar('.group'+id+'.search-row--show-many .button-hide').css('display','inline-block');
		}

	}

	function tooggleGroup(id, el) {

		el = jqWar(el);
		if (el.hasClass('close')) {
			el.removeClass('close');
			el.attr('title', '<?=tr('Свернуть предложения', 'SearchModule')?>');
			el.attr('src', '/_sysimg/tree/openall.png');
			jqWar('.group'+id).removeClass('close-tr');
		} else {
			el.addClass('close');
			el.attr('title', '<?=tr('Развернуть предложения', 'SearchModule')?>');
			el.attr('src', '/_sysimg/tree/closeall.png');
			jqWar('.group'+id).addClass('close-tr');
			jqWar(jqWar('.group'+id)[0]).removeClass('close-tr');
		}

	}

</script>
<?  ?>

<?  ?><div id="fixedCaption" style="display:none;">
	<div style="background:#f5f6f5;">
		<div id="fixedSearchForm">
			<div id="fxsearch_form">
				<div id="fxsf_shad"></div>
				<form name="fxsearch_code" action="/search.html" method="GET">

					<div id="fxsearch_caption">
						<div class="leftside">
							<?=tr('searchDetailByArticle', 'Template')?>
						</div>
						<? if (!$SearchSetting['isGuest']) { ?>

							<div id="user_top_links2" class="rightside">
								<div class="flc">
									<a href="/shop/basket.html" style="background-image:url(/_sysimg/icons/ti_basket.png)">
										<span><?=tr('basket', 'Template')?><span id="top-basket-count2"><?=(int)count($basketWares) ? ' ('.(int)count($basketWares).')' : ''?></span></span>

									</a>
									<a href="/shop/myorders.html" style="background-image:url(/_sysimg/icons/ti_orders.png)"><span><?=tr('myOrders', 'Template')?></span></a>
								</div>
							</div>

						<? } else { ?>

							<div id="user_top_links2" class="rightside" style="display:<?= (!empty($client->sourceId) || (isset($basketWares) && (int)count($basketWares) > 0) ? 'block' : 'none') ?>">
								<div class="flc">
									<a href="/shop/basket.html" style="background-image:url(/_sysimg/icons/ti_basket.png)"><span><?=tr('basket', 'Template')?><span id="top-basket-count2"><?=(int)count($basketWares) ? ' ('.(int)count($basketWares).')' : ''?></span></span></a>
								</div>
							</div>

						<? } ?>
					</div>

					<div id="fxsearch_line" class="flc">

						<div class="rightside">
							<div id="fxsearch_buttons" class="flc">
								<div class="leftside"><input type="submit" class="submitButton searchButton" name="search" value="<?=tr('searchButton', 'Template')?>" /></div>
							</div>
						</div>

						<div id="fxsearch_input">

							<? $empty_text = tr('exampleArticle', 'Template'); ?>
							<input class="TextBox<?= (empty($_REQUEST['article']) ? '_empty' : '') ?>" type="text" name="article" value="<?= (empty($_REQUEST['article']) ? $empty_text : htmlspecialchars($_REQUEST['article'], ENT_QUOTES)) ?>" onfocus="if (this.value == '<?= $empty_text ?>') {this.value = ''; this.className = 'TextBox_focus';}" onblur="if (this.value == '') {this.value = '<?= $empty_text ?>'; this.className = 'TextBox_empty';} else {this.className = 'TextBox';}"/>
							<input type="hidden" name="term" value="" id="fs_term"/>
							<input type="hidden" name="sort___search_results_by" value="" id="fs_sort___search_results_by"/>
							<input type="hidden" name="smode" value="" id="fs_smode"/>

						</div>

					</div>
				</form>

			</div>
		</div>
		<div id="fixedSearchCaptionMain" class="flc"></div>
		<div id="fixedSearchCaption"></div>
	</div>
	<div id="shadow" style="height:20px; background:url(/images/fixed_grad.png) top left repeat-x; style"></div>
</div><?  ?>

<form class="search-data__form" action="<?= $SearchSetting['basketURL'] ?>" method="POST">

	<? if ($SearchSetting['useOrderColumn'] == 1) { ?>

		<input type="hidden" name="func" value="add">
		<div class="searchPrderButton">
			<input type="submit" value="<?= mb_ucfirst_char($AR_MSG['SearchModule']['msg46']) ?>">
		</div><br>

	<? } ?>

	<div id="search_table_caption_main" class="flc">
		<div class="rightside search_caption_right">
			<span><strong><?= tr('Аналоги', 'SearchModule') ?>:</strong></span>
			<span><a href="#orig" id="orig_link" onclick="return setScroll('orig');"><?= tr('оригинальные', 'SearchModule') ?></a></span>
			<span><a href="#norig" id="norig_link" onclick="return setScroll('norig');"><?= tr('неоригинальные', 'SearchModule') ?></a></span>
			<span><a href="#univers" id="univers_link" onclick="return setScroll('univers');"><?= tr('универсальные', 'SearchModule') ?></a></span>
		</div>
	</div>

	<?
	$excludes_array = ['amount', 'weight', 'dlv_weight_tax'];
	 ?><style>
	.new_article, .search_table_black_caption {
		display: none;
	}
	table.web_ar_datagrid .section_row td {
		padding-bottom: 10px!important;
	}
	#search_table_caption_main .search_caption_right {
		padding-top: 0;
		margin-top: -20px;
	}
	#search_top_controls #search_navigation .paginator {
		padding: 0;
	}
	.close-tr, .hidden, .button-hide {
		display: none;
	}
	.toggle-link-wrapper {
		width: 20px;
		text-align: left;
		display: inline-block;
		height: 16px;
	}
	.web_ar_oem_brand, .web_ar_brand {
		white-space: nowrap;
		overflow: hidden;
	}
	.web_ar_oem_brand img, .web_ar_brand img {
		margin-left: 0px!important;
		cursor: pointer;
	}
</style><? 
	$columns = 0;
	foreach ($__search_results['header'] as $hdr_id => $column) {
		if (($column['visible'] != true) or (in_array($hdr_id, $excludes_array))) continue;
		$columns++;
	}
	?>

	<table class="web_ar_datagrid search-results search-results_type_groups search-results--fixed" fix-thead>
		<?
		 ?><thead>
	<tr id="search_header" class="search-header">

		<? $columns = 0; ?>
		<? foreach ($__search_results['header'] as $hdr_id => $column) { ?>

			<? if (($column['visible'] != true) or (in_array($hdr_id, $excludes_array))) continue; ?>

			<? $columns++; ?>
			<th class="search-header__col search-header__col--<?= $hdr_id ?>">
				
				<? if (!empty($column['clm_info'])) { ?>
					<span class="tipz" title="<?= $column['clm_info'] ?>"></span>
				<? } ?>
				<?=($hdr_id == 'info' || $hdr_id ==  'action')? '' : $column['caption']; ?>
			</th>

		<? } ?>

		<? if ($basket_check) { ?>
			<th><?= $__search_results['header']['final_price_val']['caption'] ?></th>
			<th><?= $__search_results['header']['percent_term']['caption'] ?></th>
			<? $columns += 2; ?>
		<? } ?>

	</tr>
</thead><? 
		$firstCaption = true;
		$is_availability = '';
		$match_criteria = '';
		$univers = '';
		$oem = '';
		$article = '';
		$show_article = 1;
		$show_brand = 1;
		$indexGroup = 0;
		$showDelivery = [];
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

			 ?><?
if($prevBrandDataRow == '') {
	$prevBrandDataRow = $row['brand'];
}

if (($article !== $row['parsed_article']) || ($row['brand'] !== $brand)) {
	$article = $row['parsed_article'];
	$brand = $row['brand'];
	$show_article = 1;
	$new_line = 1;
} else {
	$show_article = 0;
	$new_line = 0;
}
$echoShowMany = false;

if ($row['is_availability'] != $is_availability) {
	$show_article = 1;
	$new_line = 0;
	$is_availability = $row['is_availability'];

	if ($is_availability == 1) { ?>

		<?  ?><? if ($SearchSetting['csAmountForGroup'] and $SearchSetting['csAmountForGroup'] < $counterRowsAB and !$echoShowMany) { ?>
	<? $echoShowMany = true; ?>
	<? $cntPred = $counterRowsAB-$SearchSetting['csAmountForGroup']; ?>
	<? $textOpen = trp('Отобразить еще ' . str_replace($cntPred, '%s', declOfNum($cntPred, ['предложение', 'предложения', 'предложений'])), 'SearchModule', $cntPred); ?>
	<? $textClose = trp('Скрыть ' . str_replace($cntPred, '%s', declOfNum($cntPred, ['предложение', 'предложения', 'предложений'])), 'SearchModule', $cntPred); ?>
	<tr class="search-row search-row--show-many group<?=$indexGroup?>" data-brand-group="<?=$prevBrandDataRow?>">
		<td class="search-col search-col--show-many" colspan="<?= $columns ?>">
			<div class="search-col__show-many">
				<div class="search-col__button-show button-show" onclick="showFullGroup(<?=$indexGroup?>, 0)"><?=$textOpen?></div>
				<div class="search-col__button-hide button-hide" onclick="showFullGroup(<?=$indexGroup?>, 1)"><?=$textClose?></div>
			</div>
		</td>
	</tr>
<? } ?>
<? $prevBrandDataRow = $row['brand']; ?>
<?  ?>

		<tr class="search-caption">
			<td class="search-caption__col" colspan="<?= $columns ?>">
				<div class="search-caption__inner<?=($firstCaption ? " search-caption__inner--first" : "")?>">
					<?=truc('msg12', 'SearchModule')?>
				</div>
			</td>
		</tr>

		<? if ($firstCaption) { $firstCaption = false; } ?>

	<? }

}

if ($row['match_criteria'] != $match_criteria && !$is_availability) {
	$show_article = 1;
	$new_line = 0;
	$match_criteria = $row['match_criteria'];

	if ($match_criteria == 0) { ?>

		<?  ?><? if ($SearchSetting['csAmountForGroup'] and $SearchSetting['csAmountForGroup'] < $counterRowsAB and !$echoShowMany) { ?>
	<? $echoShowMany = true; ?>
	<? $cntPred = $counterRowsAB-$SearchSetting['csAmountForGroup']; ?>
	<? $textOpen = trp('Отобразить еще ' . str_replace($cntPred, '%s', declOfNum($cntPred, ['предложение', 'предложения', 'предложений'])), 'SearchModule', $cntPred); ?>
	<? $textClose = trp('Скрыть ' . str_replace($cntPred, '%s', declOfNum($cntPred, ['предложение', 'предложения', 'предложений'])), 'SearchModule', $cntPred); ?>
	<tr class="search-row search-row--show-many group<?=$indexGroup?>" data-brand-group="<?=$prevBrandDataRow?>">
		<td class="search-col search-col--show-many" colspan="<?= $columns ?>">
			<div class="search-col__show-many">
				<div class="search-col__button-show button-show" onclick="showFullGroup(<?=$indexGroup?>, 0)"><?=$textOpen?></div>
				<div class="search-col__button-hide button-hide" onclick="showFullGroup(<?=$indexGroup?>, 1)"><?=$textClose?></div>
			</div>
		</td>
	</tr>
<? } ?>
<? $prevBrandDataRow = $row['brand']; ?>
<?  ?>

		<tr class="search-caption">
			<td class="search-caption__col" colspan="<?= $columns ?>">
				<div class="search-caption__inner<?=($firstCaption ? " search-caption__inner--first" : "")?>">
					<?= mb_ucfirst_char($AR_MSG['SearchModule']['msg43']) ?>
				</div>
			</td>
		</tr>

		<? if ($firstCaption) { $firstCaption = false; } ?>

	<? }

}

if (($row['univers'] != $univers) && !$is_availability && !$is_availability && ($match_criteria == 1)) {

	$show_article = 1;
	$new_line = 0;
	$univers = $row['univers'];

	if ($univers != 0) {

		 ?><? if ($SearchSetting['csAmountForGroup'] and $SearchSetting['csAmountForGroup'] < $counterRowsAB and !$echoShowMany) { ?>
	<? $echoShowMany = true; ?>
	<? $cntPred = $counterRowsAB-$SearchSetting['csAmountForGroup']; ?>
	<? $textOpen = trp('Отобразить еще ' . str_replace($cntPred, '%s', declOfNum($cntPred, ['предложение', 'предложения', 'предложений'])), 'SearchModule', $cntPred); ?>
	<? $textClose = trp('Скрыть ' . str_replace($cntPred, '%s', declOfNum($cntPred, ['предложение', 'предложения', 'предложений'])), 'SearchModule', $cntPred); ?>
	<tr class="search-row search-row--show-many group<?=$indexGroup?>" data-brand-group="<?=$prevBrandDataRow?>">
		<td class="search-col search-col--show-many" colspan="<?= $columns ?>">
			<div class="search-col__show-many">
				<div class="search-col__button-show button-show" onclick="showFullGroup(<?=$indexGroup?>, 0)"><?=$textOpen?></div>
				<div class="search-col__button-hide button-hide" onclick="showFullGroup(<?=$indexGroup?>, 1)"><?=$textClose?></div>
			</div>
		</td>
	</tr>
<? } ?>
<? $prevBrandDataRow = $row['brand']; ?>
<? 
		?>

		<tr class="search-caption">
			<td class="search-caption__col" colspan="<?= $columns ?>">
				<div class="search-caption__inner">
					<a name="univers1" id="univers_target"></a>
					<?= mb_ucfirst_char($AR_MSG['SearchModule']['msg47']) ?>
				</div>
			</td>
		</tr>

	<? }
}

if (($row['oem'] != $oem) && !$is_availability && ($match_criteria == 1) && ($row['univers'] == 0)) {

	$show_article = 1;
	$new_line = 0;
	$oem = $row['oem'];

	if ($oem == 0) {

		 ?><? if ($SearchSetting['csAmountForGroup'] and $SearchSetting['csAmountForGroup'] < $counterRowsAB and !$echoShowMany) { ?>
	<? $echoShowMany = true; ?>
	<? $cntPred = $counterRowsAB-$SearchSetting['csAmountForGroup']; ?>
	<? $textOpen = trp('Отобразить еще ' . str_replace($cntPred, '%s', declOfNum($cntPred, ['предложение', 'предложения', 'предложений'])), 'SearchModule', $cntPred); ?>
	<? $textClose = trp('Скрыть ' . str_replace($cntPred, '%s', declOfNum($cntPred, ['предложение', 'предложения', 'предложений'])), 'SearchModule', $cntPred); ?>
	<tr class="search-row search-row--show-many group<?=$indexGroup?>" data-brand-group="<?=$prevBrandDataRow?>">
		<td class="search-col search-col--show-many" colspan="<?= $columns ?>">
			<div class="search-col__show-many">
				<div class="search-col__button-show button-show" onclick="showFullGroup(<?=$indexGroup?>, 0)"><?=$textOpen?></div>
				<div class="search-col__button-hide button-hide" onclick="showFullGroup(<?=$indexGroup?>, 1)"><?=$textClose?></div>
			</div>
		</td>
	</tr>
<? } ?>
<? $prevBrandDataRow = $row['brand']; ?>
<? 
		?>

		<tr class="search-caption">
			<td class="search-caption__col" colspan="<?= $columns ?>">
				<div class="search-caption__inner">
					<a name="norig1" id="norig_target"></a><?= mb_ucfirst_char($AR_MSG['SearchModule']['msg44']) ?>
				</div>
			</td>
		</tr>

		<tr class="hidden search-row__header">
			<? foreach ($__search_results['header'] as $hdr_id => $column) {

				if (($column['visible'] != true) or (in_array($hdr_id, $excludes_array))) continue;

				$columns++;
				?>
				<td class="search-header__col search-header__col--<?= $hdr_id ?>">
					
					<? if (!empty($column['clm_info'])) { ?>
						<span class="tipz" title="<?= $column['clm_info'] ?>"></span>
					<? } ?>
					<?= ($hdr_id == 'info' || $hdr_id == 'action') ? '' : $column['caption']; ?>
				</td>

			<? } ?>
		</tr>

	<? } else { ?>

		<?  ?><? if ($SearchSetting['csAmountForGroup'] and $SearchSetting['csAmountForGroup'] < $counterRowsAB and !$echoShowMany) { ?>
	<? $echoShowMany = true; ?>
	<? $cntPred = $counterRowsAB-$SearchSetting['csAmountForGroup']; ?>
	<? $textOpen = trp('Отобразить еще ' . str_replace($cntPred, '%s', declOfNum($cntPred, ['предложение', 'предложения', 'предложений'])), 'SearchModule', $cntPred); ?>
	<? $textClose = trp('Скрыть ' . str_replace($cntPred, '%s', declOfNum($cntPred, ['предложение', 'предложения', 'предложений'])), 'SearchModule', $cntPred); ?>
	<tr class="search-row search-row--show-many group<?=$indexGroup?>" data-brand-group="<?=$prevBrandDataRow?>">
		<td class="search-col search-col--show-many" colspan="<?= $columns ?>">
			<div class="search-col__show-many">
				<div class="search-col__button-show button-show" onclick="showFullGroup(<?=$indexGroup?>, 0)"><?=$textOpen?></div>
				<div class="search-col__button-hide button-hide" onclick="showFullGroup(<?=$indexGroup?>, 1)"><?=$textClose?></div>
			</div>
		</td>
	</tr>
<? } ?>
<? $prevBrandDataRow = $row['brand']; ?>
<?  ?>

		<tr class="search-caption">
			<td class="search-caption__col" colspan="<?= $columns ?>">
				<div class="search-caption__inner">
					<a name="orig1" id="orig_target"></a><?= mb_ucfirst_char($AR_MSG['SearchModule']['msg45']) ?>
				</div>
			</td>
		</tr>

		<tr class="hidden search-row__header">
			<? foreach ($__search_results['header'] as $hdr_id => $column) {

				if (($column['visible'] != true) or (in_array($hdr_id, $excludes_array))) continue;

				$columns++;
				?>
				<td class="search-header__col search-header__col--<?= $hdr_id ?>">
					
					<? if (!empty($column['clm_info'])) { ?>
						<span class="tipz" title="<?= $column['clm_info'] ?>"></span>
					<? } ?>
					<?= ($hdr_id == 'info' || $hdr_id == 'action') ? '' : $column['caption']; ?>
				</td>

			<? } ?>
		</tr>

	<? }
}

if (($isProvider['provider_id'] == $row['provider_id']) && ($row['provider_id'] > 0)) {
	$class = 'provider_row';
}

if ($show_article) {

	 ?><? if ($SearchSetting['csAmountForGroup'] and $SearchSetting['csAmountForGroup'] < $counterRowsAB and !$echoShowMany) { ?>
	<? $echoShowMany = true; ?>
	<? $cntPred = $counterRowsAB-$SearchSetting['csAmountForGroup']; ?>
	<? $textOpen = trp('Отобразить еще ' . str_replace($cntPred, '%s', declOfNum($cntPred, ['предложение', 'предложения', 'предложений'])), 'SearchModule', $cntPred); ?>
	<? $textClose = trp('Скрыть ' . str_replace($cntPred, '%s', declOfNum($cntPred, ['предложение', 'предложения', 'предложений'])), 'SearchModule', $cntPred); ?>
	<tr class="search-row search-row--show-many group<?=$indexGroup?>" data-brand-group="<?=$prevBrandDataRow?>">
		<td class="search-col search-col--show-many" colspan="<?= $columns ?>">
			<div class="search-col__show-many">
				<div class="search-col__button-show button-show" onclick="showFullGroup(<?=$indexGroup?>, 0)"><?=$textOpen?></div>
				<div class="search-col__button-hide button-hide" onclick="showFullGroup(<?=$indexGroup?>, 1)"><?=$textClose?></div>
			</div>
		</td>
	</tr>
<? } ?>
<? $prevBrandDataRow = $row['brand']; ?>
<? 
	$detailInfo = array(
		"article" => $row['parsed_article'],
		"brand"   => $row['brand']
	);
	$detailLink = data2str($detailInfo, true, true);
	$counterRowsAB = 0;
	$indexGroup++;

}
$counterRowsAB++;
if ($show_article == 1) {
	$showingArticle = $row['article'];
	if ($SearchSetting['useProtectArticlesByImg']) {
		$showingArticle = '<img src="' . getThumbArticlePath($row['article']) . '" />';
	}
	?>

	<tr class="search-row search-row--main-title" data-brand-group="<?=$row['brand']?>">
		<td class="search-col search-col--main-info" colspan="<?= $columns ?>">
			<div <?= ($row['brand_full_name'] != "" ? 'title="' . $row['brand_full_name'] . '"' : '') ?> class="<?= ($row['oem_brand'] == 1 ? 'web_ar_oem_brand' : 'web_ar_brand') ?>">
				<?= (!empty($row['prd_info_exist']) ? "
<a href='/info/producers.html?prd=" . $row['prd_info_exist'] . "' class='search-results__info-link' rel='prd_info_link' data-prdId='" . $row['prd_info_exist'] . "'>" . $row['prd_info_link'] . "</a>
<div class='search-results__spare-info'>" . $row['spare_info'] . "</div>
<a href='/info/producers.html?prd=" . $row['prd_info_exist'] . "' class='search-results__article' rel='prd_info_link' data-prdId='" . $row['prd_info_exist'] . "'>" . $showingArticle . "</a>
											" : '
<span class="search-results__info-link">' . $row['prd_info_link'] . '</span>
<div class="search-results__spare-info">' . $row['spare_info'] . '</div>
<span class="search-results__article">' . $showingArticle . '</span>
											') ?>
			</div>
		</td>
	</tr>

	<tr class="search-row__header" data-brand-group="<?=$row['brand']?>">
		<? foreach ($__search_results['header'] as $hdr_id => $column) {

			if (($column['visible'] != true) or (in_array($hdr_id, $excludes_array))) continue;
			$columns++;
			?>
			<td class="search-header__col search-header__col--<?= $hdr_id ?>">
				
				<? if (!empty($column['clm_info'])) { ?>
					<span class="tipz" title="<?= $column['clm_info'] ?>"></span>
				<? } ?>
				<?= ($hdr_id == 'info' || $hdr_id == 'action') ? '' : $column['caption']; ?>
			</td>

		<? } ?>
	</tr>

<? } ?>

<tr
	data-index-group="<?= $indexGroup ?>"
	data-brand-group="<?=$row['brand']?>"
	class="search-row <?= ($row['sts_style'] != '' ? 'lg' : $class) ?> group<?= $indexGroup ?><?= (($SearchSetting['csAmountForGroup'] and $SearchSetting['csAmountForGroup'] < $counterRowsAB) ? ' hidden' : '') . ($new_line ? ' new-line' : '') ?>"
	<?= ($row['sts_style'] != '' ? ' style="' . $row['sts_style'] . '"' : '') ?>
>

<?
	$show_article_real = $show_article;
	foreach ($__search_results['header'] as $hdr_id => $column) {
		if (($column['visible'] != true) or (in_array($hdr_id, $excludes_array))) continue;
		switch ($hdr_id) {

			case 'spare_info':
			case 'article':
			case 'prd_info_link':
				$col_align = 'left';
				break;

			case 'final_price':
			case 'customer_price':
			case 'dlv_weight_tax':
			case 'price_brutto':
				$col_align = 'right';
				break;

			default:
				$col_align = 'center';

		}
		?>
		<td class="search-col search-col__<?= $hdr_id ?>">
			<?  ?><?
switch ($hdr_id) {
	case 'spare_info':
		 ?>
<? if (!in_array($hdr_id, $_interface->csHideGroupFields) || $show_article == 1) { ?>

	<?  ?><? if ($row[$hdr_id] == '') { ?>
	&nbsp;
<? } else { ?>
	<p class="tipz" data-line-clamp="2" title="<?= $row[$hdr_id]; ?>"><?= $row[$hdr_id] ?></p>
<? } ?>
<?  ?>

	<div style="display: none" class="toggle-link-wrapper">
		<? if ($show_article_real) { ?>
			<?
				$search_results_keys = isset($search_results_keys) ? $search_results_keys : array_keys($__search_results['data']);
				$next = $search_results_keys[array_search($dat_id, $search_results_keys) + 1];
				if ($__search_results['data'][$next]['parsed_article'] === $row['parsed_article'] and $__search_results['data'][$next]['brand'] === $row['brand']) {
			?>
					<img src="/_sysimg/tree/<?=($match_criteria ? 'close' : 'open')?>all.png" class="toggle-link <?=($match_criteria ? 'close' : '')?>" onclick="tooggleGroup(<?=$indexGroup?>, this)" id="toggle-link<?=$indexGroup?>" title="<?=($match_criteria ? tr('Развернуть предложения', 'SearchModule') : tr('Свернуть предложения', 'SearchModule'))?>"/>
				<? } ?>
		<? } ?>
	</div>

<? } else { ?>
	&nbsp;
<? } ?>
<? 
		break;
	case 'evaluation':
		 ?><?  ?><? if ($row['info_only'] != 1) { ?>

	<? $showStat = ($SearchSetting['statShow'] == 1) && ($row["prv_show_stat"]); ?>

	<? if ($showStat) { ?>
		<button type="button" class="column-val column-val--evaluation" data-show-modal data-width="660" data-height="560" data-href="/shop/provider_stat.html?pv=<?= $row['provider_id'] ?>&t=<?= $row['term_interval_value'] ?>&sid=<?= $row['_search_id'] ?>">
	<? } else { ?>
		<span class="column-val column-val--evaluation">
	<? } ?>

	<? $evalArr = explode(' | ', $row['evaluation']); ?>
	<svg width="26px" height="26px" class="column-val__evaluation-svg">
		<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="/_sysimg/svg/evaluation.svg#n<?= (int)$evalArr[0] ?>"></use>
	</svg>
	<span class="column-val__evaluation-separator"></span>
	<svg width="26px" height="26px" class="column-val__evaluation-svg">
		<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="/_sysimg/svg/evaluation.svg#n<?= (int)$evalArr[1] ?>"></use>
	</svg>

	<? if ($showStat) { ?>
		</button>
	<? } else { ?>
		</span>
	<? } ?>

<? } ?>



<?  ?><? 
		break;
	case 'article':
		 ?>
<? if (!in_array($hdr_id, $_interface->csHideGroupFields) || $show_article == 1) {

	 ?><span <?= ($row['parsed_article'] == $SearchSetting['searchCode'] ? 'class="web_ar_search_code"' : '') ?>>
	<nobr>

	<? if ($SearchSetting['useProtectArticlesByImg']) { ?>
		<img src="<?= getThumbArticlePath($row['article']) ?>"/>
	<? } else { ?>
		<?= $row['article'] ?>
	<? } ?>

	<? if ($row['superseded_by'] != '') { ?>

		<? $show_replacement_conditions = 1; ?>
		<span class="superseded">
			<sup>
				<a title="<?= $AR_MSG['SearchModule']['msg14'] ?> <?= $row['superseded_by'] ?>"><?= $AR_MSG['SearchModule']['msg48'] ?></a>
			</sup>
		</span>

	<? } elseif ($row['replacement_for'] != '') { ?>

		<? $show_replacement_conditions = 1; ?>
		<span class="replacement">
			<sup>
				<a title="<?= $AR_MSG['SearchModule']['msg15'] ?> <?= $row['replacement_for'] ?>"><?= $AR_MSG['SearchModule']['msg49'] ?></a>
			</sup>
		</span>

	<? } ?>

	</nobr>
</span>
<? 
	
} else { ?>
	&nbsp;
<? } ?><? 
		break;
	case 'prd_info_link':
		 ?>
<? if (!in_array($hdr_id, $_interface->csHideGroupFields) || $show_article == 1) {

	 ?><?
$showingArticle = $row['article'];
if ($SearchSetting['useProtectArticlesByImg']) {
	$showingArticle = '<img src="' . getThumbArticlePath($row['article']) . '" />';
}
?>

<div <?= ($row['brand_full_name'] != "" ? 'title="' . $row['brand_full_name'] . '"' : '') ?> <?= ($row['oem_brand'] == 1 ? 'class="web_ar_oem_brand"' : 'class="web_ar_brand"') ?>>
	<?=(!empty($row['prd_info_exist']) ? "
<a href='/info/producers.html?prd=" . $row['prd_info_exist'] ."' class='search-results__info-link' rel='prd_info_link' data-prdId='" . $row['prd_info_exist'] . "'>" . $row['prd_info_link'] . " </a>
<br>
<a href='/info/producers.html?prd=" . $row['prd_info_exist'] ."' class='search-results__article' rel='prd_info_link' data-prdId='" . $row['prd_info_exist'] . "'>" . $showingArticle . " </a>
	" : '
<span class="search-results__info-link">' . $row['prd_info_link'] . '</span>
<br>
<span class="search-results__article">' . $showingArticle . '</span>
	')?>
</div>
<? 
	
} else { ?>
	&nbsp;
<? } ?><? 
		break;
	case 'remains':
		 ?><?  ?><? if (($row['remains'] == $AR_MSG['SearchModule']['msg16']) && ($row['info_only'] == 0)) { ?>

	<img src="/images/check.png" title="<?= $AR_MSG['SearchModule']['msg16'] ?>" alt="<?= $AR_MSG['SearchModule']['msg16'] ?>"/>

<? } elseif (($SearchSetting['showExactRemains'] == 1) && ($row['remains'] != '')) { ?>

	<? if ($row['remains'] > 0) { ?>
		=<?= $row['remains'] ?>
	<? } else { ?>
		<?= $row['remains'] ?>
	<? } ?>

<? } elseif ($row['remains'] > 0) { ?>
	<?= $row['remains'] ?> <span class="search-col__remains-unit"><?=tr('шт.')?></span>
<? } else { ?>
	-
<? } ?><?  ?><? 
		break;
	case 'final_price':
		 ?><?  ?><? if ($row['provider_price'] == 0) { ?>
	-
<? } elseif ($row['provider_price'] == '') { ?>
	-
<? } else { ?>

	<? $final_price = $row[$hdr_id]; ?>
	<nobr><?= $row[$hdr_id] ?>

	<sup>
		<font color="#990000">

			<?
			if (count($Deliveries) > 0) {
				foreach ($Deliveries as $dlv => $cur_dlv) {

					if ($cur_dlv['delivery_condition'] == $row['delivery_condition']) {

						if ((($row['weight'] == 0) and ($cur_dlv['tax'] > 0)) || ($cur_dlv['tax'] == 0) || ($cur_dlv['tax'] == '')) {

							if (!safeArrayKey($showDelivery, $row['delivery_condition'])) {
								$showDelivery[$row['delivery_condition']] = $cur_dlv;
							}

							echo array_search($row['delivery_condition'], array_keys($showDelivery)) + 1;

						}

					}

				}
			}
			?>

		</font>
	</sup>

	<? if (($row['cost_per_weight'] > 0) && (!empty($row['cost_per_weight_display'])) and empty($row['weight'])) { ?>
		+ <?= $row['cost_per_weight_display'] ?>/<?=tr('кг', 'Common')?>.
	<? } ?>

<? } ?>
</nobr>

<? if ($row['phand_value'] != 0) { ?>

	<br/>
	<small>
		<span id="phand"><?= $AR_MSG['SearchModule']['msg20'] ?>&nbsp;<nobr><?= $row['detail_phand'] ?></nobr></span>
	</small>

<? } ?>

<?  ?><? 
		break;
	case 'action':
		 ?><?  ?>
<? if (($row['info_only'] != '1') || ($row['provider_price'] > 0)) { ?>

	<? if (isset($assocBasketWares[$row['hash']])) { ?>
		<span class="basket-items-count"><?= $assocBasketWares[$row['hash']]['amount'] ?></span>
		<span class="btn-add-basket">
			<a href="/shop/basket.html" class="add-basket__link add-basket__link--added"></a>
		</span>
	<? } else { ?>
		<input type="hidden" id="<?= $row['hash'] ?>" value="<?= $row['_search_id'] ?>">
		<?= $row['amount'] ?>
		<span id="action<?= $row['_search_id'] ?>" class="btn-add-basket"> <?= $row[$hdr_id] ?></span>
		<input type="hidden" id="max_amount_<?=$row['_search_id']?>" value="<?=($_interface->csLeadLettersToNumberForCheckRemains ? strToFloat($row['remains']) : (float)$row['remains'])?>"/>
	<? } ?>

<? } ?>
<?  ?><? 
		break;
	case 'info':
		 ?>
<? if (!in_array($hdr_id, $_interface->csHideGroupFields) || $show_article == 1) { ?>
<span class="info">
	<button type="button" class="column-val column-val--detail-info" data-show-modal data-width="660" data-height="560" data-href="/info/detail.html?sid=<?= $row['_search_id'] ?>&detailLink=<?= $detailLink ?>"></button>
		<? if ($row['picture']) { ?>
			<button type="button" class="column-val column-val--picture" data-show-modal data-width="660" data-height="560" data-href="/info/detail.html?sid=<?= $row['_search_id'] ?>&detailLink=<?= $detailLink ?>"></button>
		<? } ?>
		<? if (($row['weight']) && ($row['weight'] > 0)) { ?>
			<img src="/images/weight.png" border="0" title="<?= $AR_MSG['SearchModule']['msg19'] ?> = <?= $row['weight'] ?>" alt="<?= $AR_MSG['SearchModule']['msg19'] ?> = <?= $row['weight'] ?>" hspace="1" align="absmiddle"/>
		<? } ?>
</span>
<? } ?>
<? 
		break;
	case 'term':
	case 'time':
	case 'term_and_destination':
		 ?><?  ?>
<? if ($hdr_id == 'term') { ?>

	<? if ($row['term'] > 0 || ($row['max_term'] > 0 && $_interface->csUseMaxTerm)) { ?>
		<?= $row[$hdr_id] ?> <span class="search-col__term-unit"><?=tr('дн.', 'SearchModule')?></span>
	<? } elseif (($row['term'] == 0) && ($row['info_only'] != 1) && $row['max_term'] == 0) { ?>
		<?= $AR_MSG['SearchModule']['msg12'] ?>
	<? } elseif ($row['info_only'] == 1) { ?>
		-
	<? } ?>

<? } elseif ($hdr_id == 'time') { ?>

	<? if ($row['term'] > 0 || ($row['max_term'] > 0 && $_interface->csUseMaxTerm)) { ?>
		<?= $row[$hdr_id]?>
	<? } elseif (($row['term'] == 0) && ($row['info_only'] != 1) && $row['max_term'] == 0) { ?>
		<?= $AR_MSG['SearchModule']['msg12'] ?>
	<? } elseif ($row['info_only'] == 1) { ?>
		-
	<? } ?>

<? } elseif ($hdr_id == 'term_and_destination') { ?>

	<? if ($row['term'] > 0 || ($row['max_term'] > 0 && $_interface->csUseMaxTerm)) { ?>
		<?= $row['term'] ?> <span class="search-col__term-unit"><?=tr('дн.', 'SearchModule')?></span>
		<div class="search-col__term-caption">
			<?= $row['destination_display'] ?>
		</div>
	<? } elseif (($row['term'] == 0) && ($row['info_only'] != 1) && $row['max_term'] == 0) { ?>
		<?= $AR_MSG['SearchModule']['msg12'] ?>
		<div class="search-col__term-caption">
			<?= $row['destination_display'] ?>
		</div>
	<? } elseif ($row['info_only'] == 1) { ?>
		-
	<? } ?>

<? } ?><?  ?><? 
		break;
	case 'price_brutto':
		echo (($row['weight'] > 0) && ($row['cost_per_weight'] > 0)) ? $row[$hdr_id] : '&nbsp;';
		break;
	case 'orderm':
	case 'date':
		echo (($row['info_only'] != '1') || ($row['provider_price'] > 0)) ? $row[$hdr_id] : '&nbsp;';
		break;
	default:
		echo $row[$hdr_id] ? $row[$hdr_id] : '&nbsp;';
		break;
}
?><?  ?>
		</td>

	<? } ?>

	<? if ($basket_check == 1) { ?>
		<td align="right">
			<? if ($row['final_price_val'] && ($desire_price != 0)) { ?>
				<?= number_format((($row['final_price_val'] - $desire_price) / $desire_price * 100), 2, '.', ' ') ?>
			<? } ?>
		</td>
		<td align="right">
			<? if ($row['max_term'] && ($desire_term != 0)) { ?>
				<?= number_format((($row['max_term'] - $desire_term) / $desire_term * 100), 2, '.', ' ') ?>
			<? } elseif ($row['term'] && ($desire_term != 0)) { ?>
				<?= number_format((($row['term'] - $desire_term) / $desire_term * 100), 2, '.', ' ') ?>

			<? } ?>
		</td>
	<? } ?>
</tr><? 
		}
		
		 ?><? if ($SearchSetting['csAmountForGroup'] and $SearchSetting['csAmountForGroup'] < $counterRowsAB and !$echoShowMany) { ?>
	<? $echoShowMany = true; ?>
	<? $cntPred = $counterRowsAB-$SearchSetting['csAmountForGroup']; ?>
	<? $textOpen = trp('Отобразить еще ' . str_replace($cntPred, '%s', declOfNum($cntPred, ['предложение', 'предложения', 'предложений'])), 'SearchModule', $cntPred); ?>
	<? $textClose = trp('Скрыть ' . str_replace($cntPred, '%s', declOfNum($cntPred, ['предложение', 'предложения', 'предложений'])), 'SearchModule', $cntPred); ?>
	<tr class="search-row search-row--show-many group<?=$indexGroup?>" data-brand-group="<?=$prevBrandDataRow?>">
		<td class="search-col search-col--show-many" colspan="<?= $columns ?>">
			<div class="search-col__show-many">
				<div class="search-col__button-show button-show" onclick="showFullGroup(<?=$indexGroup?>, 0)"><?=$textOpen?></div>
				<div class="search-col__button-hide button-hide" onclick="showFullGroup(<?=$indexGroup?>, 1)"><?=$textClose?></div>
			</div>
		</td>
	</tr>
<? } ?>
<? $prevBrandDataRow = $row['brand']; ?>
<? 
		?>

	</table>

</form><?  ?>

			<? } ?>

			<div class="search-data__paginator">
				<?= $__search_results['controls']['searchPages'] ?>
			</div>

			<div class="search-data__error" id="search_bottom_notifies">
				<?  ?><?

if (sizeof($showDelivery) > 0 || $show_replacement_conditions) {
	$Deliveries = $showDelivery;
	$k = 0;

	?>


	<div class="warning search-data__warning search-data__warning_deliveries">
		<div class="warning__caption"><?= $AR_MSG['SearchModule']['msg23'] ?></div>

		<? foreach ($Deliveries as $dlv => $delivery) { ?>

			<? $k++; ?>

			<div class="warning__term">
				<sup><?= $k ?></sup>
				<?= $delivery['dlv_text'] ?>&nbsp;
			</div>

		<? } ?>

		<? if ($show_replacement_conditions != 0) { ?>

			<div style="padding: 5px">
				<span style="color: #990000">
					<sup>
						<a title="<?= $row['superseded_by'] ?>" style="font-weight: bold; width: 10px; background: #990000; color: #FFFFFF; padding: 1px; cursor: default"><?= $AR_MSG['SearchModule']['msg48'] ?></a>
					</sup>
				</span>
				<?= $AR_MSG['SearchModule']['msg24'] ?>&nbsp;
			</div>

			<div style="padding: 5px">
				<span style="color: #990000">
					<sup>
						<a title="<?= $row['replacement_for'] ?>" style="width: 10px; background: #000000; color: #FFFFFF; padding: 1px; cursor: default"><?= $AR_MSG['SearchModule']['msg49'] ?></a>
					</sup>
				</span>
				<?= $AR_MSG['SearchModule']['msg25'] ?>&nbsp;
			</div><br/>

		<? } ?>

	</div>

<? } ?>

<? if (!$SearchSetting['admin_search']) { ?>

	<? if ($clientData['retail']!==true) { ?>

		<div class="warning search-data__warning">
			<div class="warning__caption"><?= $AR_MSG['Forms']['msg5'] ?></div>
			<div class="warning__text"><?= $AR_MSG['SearchModule']['msg22'] ?></div>
		</div>

	<? } ?>

<? } ?>

<div class="search-data__warning">
	<? if (!$SearchSetting['admin_search']) { ?>
		<noindex>
			<div class="search-error-bottom">
				<div class="search-error-bottom__caption"><?= $AR_MSG['SearchModule']['msg50'] ?></div>
				<div class="search-error-bottom__text"><?=trp('Если в списке аналогичных товаров вы нашли ошибку, %sсообщите об этом%s, пожалуйста.', 'SearchModule', '<a href="/shop/report_error.html?errid=E2&article=' . $SearchSetting['searchCode'] . '&brand=' . $SearchSetting['searchBrand'] . '" class="search-error-bottom__link">', '</a>')?></div>
			</div>
		</noindex>

	<? } ?>
</div>
<?  ?>
			</div>

		<? } elseif ($alternatives) { ?>
			<?  ?><div class="alternatives">

	<div class="alternatives-header">
		<? foreach ($alternatives['header'] as $hdr_id => $column) { ?>
			<? if ($column['visible'] == true) { ?>
				<div class="alternatives-header__col  alternatives-header__col--<?= $hdr_id ?>"><?= $column['caption'] ?></div>
			<? } ?>
		<? } ?>
	</div>

	<? foreach ($alternatives['data'] as $dat_id => $row) { ?>

		<div class="alternatives__row" data-href="<?= $row['group_link'] ?>">

			<? foreach ($alternatives['header'] as $hdr_id => $column) { ?>
				<? if ($column['visible'] == true) { ?>
					<span class="alternatives__col alternatives__col--<?= $hdr_id ?>">
						<span class="alt_<?= $hdr_id ?>">

							<?= $row[$hdr_id] ?>

							<? if ($hdr_id == 'spare') { ?>

								<? if ($row['superseded_by'] != '') { ?>
									<?= $row['code'] ?> - <?= $AR_MSG['SearchModule']['msg7'] ?><?= $row['superseded_by'] ?>
								<? } ?>

								<? if ($row['replacement_for'] != '') { ?>
									<?= $row['code'] ?> - <?= $AR_MSG['SearchModule']['msg8'] ?><?= $row['replacement_for'] ?>
								<? } ?>

							<? } ?>

						</span>
					</span>
				<? } ?>
			<? } ?>
		</div>
	<? } ?>
</div><?  ?>
		<? } ?>

		<? if ($SearchSetting['invalid_search']) { ?>

			<?  ?><?=$AR_MSG['SearchModule']['msg26']?>
	<?=$AR_MSG['SearchModule']['msg27']?>
	<?=$AR_MSG['SearchModule']['msg28']?>
	<?=$AR_MSG['SearchModule']['msg29']?>
	<?=$AR_MSG['SearchModule']['msg30']?>
	<?=$AR_MSG['SearchModule']['msg31']?><?  ?>

		<? } ?>

	<? } ?>

<? } else { ?>

	<?  ?><h2><?=$AR_MSG['SearchModule']['msg39']?></h2>
	
<p><?=$AR_MSG['SearchModule']['msg40']?></p><?  ?>

<? } ?><? 

	} else {

		 ?><? if ($_SYSTEM->REQUESTED_PAGE == "/shop/basket_check.html") {

	$basket_check = '1';
	$desire_price = $_SESSION['basket']['control']['desire_price'];
	$desire_term = $_SESSION['basket']['control']['desire_term'];
}
?>
<? if (($SearchSetting['authUserSearchOnly'] != 1) || !$SearchSetting['isGuest'] || ($SearchSetting['admin_search'] == 1)) { ?>
	<? if ($SearchSetting['isGuest']) { ?>
		<div class="message message_type_success">
			<div class="message__text">
				<?=trp('Если Вы уже зарегистрированы на сайте — пожалуйста, %sавторизуйтесь%s для получения корректных предложений товаров.', 'SearchModule', '<a data-toggle="modal" data-target="#myModal">', '</a>')?>
			</div>
		</div>
	<? } ?>

	<?  ?><?
$groupActive = 1;
if (!empty($alternatives)) {
	$alternativesData = $alternatives;
	if ($alternatives['data']) {
		$alternativesData = $alternativesData['data'];
	}

	foreach ($alternativesData as $key => $alt) {
		if ($_REQUEST['g'] == $alt['id'] || strtoupper($_REQUEST['brand']) == strtoupper($alt['brand'])) {
			$groupActive = $key;
			break;
		}
	}
}
?>
<div class="search-data__header flc">

	<div class="leftside">
		<h1 class="search-data__h1"><?= $AR_MSG['SearchModule']['msg1'] ?>
			<span class="search-code"><?= $SearchSetting['searchCode'] ?></span>
			<? if (!empty($alternativesData)) { ?>
				<? if ($__search_results) { ?>
					<span class="search-brand<? if ($alternativesData && count($alternativesData) > 1) { ?> search-alternatives<? } ?>">
						<?= $alternativesData[$groupActive]['brand']; ?>
					</span>
					<? if ($alternativesData && count($alternativesData) > 1) { ?>
						<?  ?><div class="alternatives-modal">
	<div class="alternatives-modal__title"><?= tr('Выберите производителя', 'SearchModule') ?></div>
	<div class="alternatives-modal__descr"><?= tr('Найдено несколько совпадений', 'SearchModule') ?></div>
	<button type="button" class="close modal-dialog__close"></button>
	<div class="alternatives-modal__content">
		<div class="alternatives">
			<? if (count($alternativesData) > 0) {

				$sLink = new cLink($_SERVER['REQUEST_URI'], '');
				$sLink->removeQueryParam("g")
					->removeQueryParam("brand")
					->removeQueryParam(Search_API::STEP_PARAMETER_NAME);

				$headerColumns = ['prd_info_link', 'code', 'spare_info'];
				$bodyColumns = ['brand', 'code', 'spare_info'];
				?>
				<div class="alternatives-header">
					<? foreach ($headerColumns as $column) { ?>
						<div class="alternatives-header__col alternatives-header__col--<?= $column ?>">
							<?= $__search_results['header'][$column]['caption'] ?>
						</div>
					<? } ?>
				</div>
				<? foreach ($alternativesData as $alt) { ?>
					<a class="alternatives__row" href="<?= $sLink->link . "&g=" . $alt['id'] ?>">
						<? foreach ($bodyColumns as $column) { ?>
							<span class="alternatives__col  alternatives__col--<?= $column ?>">
							<span class="alt_<?= $column ?>" title="<?= $alt[$column] ?>"><?= $alt[$column] ?></span>
						</span>
						<? } ?>
					</a>
					<?
				}
			} ?>
		</div>
	</div>
</div>

<?  ?>
					<? } ?>
				<? } ?>
			<? } ?>
		</h1>
		<? if ((int)$search_results_info['allCount'] > 0) { ?>
			<div class="search-data__stat">
				<span class="hidden-xs"><?= $AR_MSG['SearchModule']['msg53'] ?></span>
				<?= sprintf($AR_MSG['SearchModule']['msg54'], $search_results_info['allCount'], $search_results_info['matchCount'], $search_results_info['analogsCount'], $search_results_info['universCount'], '<span class="text-nowrap">' . $search_results_info['minPrice'] . '</span>', '<span class="text-nowrap">' . $search_results_info['maxPrice'] . '</span>') ?>
			</div>
		<? } ?>
	</div>
	<? if ($__search_results) { ?>
		<?  ?><? if (!empty($currencies)) { ?>
	<div class="search-currency search-data__currency">
		<? foreach ($currencies as $currency) { ?>
			<input id="currency<?= $currency['id'] ?>" type="radio" name="cid" value="<?= $currency['id'] ?>" <? if ($currency['checked']){ ?>checked="checked"<? } ?>>
			<label class="search-currency__label" for="currency<?= $currency['id'] ?>"><?= $currency['html_sign'] ?></label>
		<? } ?>
	</div>
<?}?><?  ?>
	<? } ?>
</div><?  ?>

	<? if ($SearchSetting['empty_search']) { ?>

		<?  ?><div class="warning search-data__empty-warning">

	<? if ($SearchSetting['search_from_catalog']) { ?>
		<p><a class="warning__link" href="<?= $SearchSetting['catalog_search_url'] ?>"><?= $AR_MSG['SearchModule']['msg2'] ?></a></p>
	<? } ?>

	<p><?= $AR_MSG['SearchModule']['msg3'] ?></p>
	<?= $AR_MSG['SearchModule']['msg4'] ?> <a class="warning__link" href="/vin/form.html"><?= $AR_MSG['SearchModule']['msg5'] ?></a>.

	<? if ($SearchSetting['catalog_search']) { ?>
		<a class="warning__link" href="<?= $SearchSetting['catalog_search_url'] ?>"><?= $AR_MSG['SearchModule']['msg6'] ?></a>
	<? } ?>

</div><?  ?>

	<? } else { ?>

	<? if ($__search_results) { ?>

		<? if (!$admin_search) { ?>

			<?  ?><?  ?>

		<? } else { ?>

			<?= $AR_MSG['SearchModule']['msg1'] ?>

		<? } ?>

		<? if ($search_from_catalog) { ?>

			<li><p><a href="<?=$SearchSetting['catalog_search_url']?>"><?=$AR_MSG['SearchModule']['msg2']?></a></p></li>

		<? } ?>

		<? if ($SearchSetting['searchMode'] == "An") { ?>

			<?  ?>		
<style>

	body {
		font-size: 11px
	}

	.scol_0 {
		width: 600px;
	}
	
	.scol_1 {

		position: absolute;
		left: 100px;
		width: 150px;
		margin-right: 5px;
		vertical-align: top;

	}

	.scol_2 {
		position: absolute;
		left: 250px;
		width: 200px;
		margin-right: 5px;

	}
	
	.scol_3 {
		position: absolute;
		left: 400px;
		width: 300px;
		margin-right: 5px;

	}
	
	.scol_4 {

		width: 50px;
		margin-right: 5px;
		text-align: center;

	}
	
	.scol_5 {

		width: 30px;
		margin-right: 5px;
		text-align: center;

	}
	
	.searchBox {
		width: 100%;
		border: #B3E0FF solid 1px;
		background: #F9F9F9;
	}
	
	img {
		border: 0px;
	}
	
	a {
		text-decoration: none;
		cursor: hand;
	}
	
	
	a.normal {
		text-decoration: underline;
		cursor: hand;
	}
	
	div.analogTreeNode {
		width: 100%; padding-left: 50px;
		background: #FFFFFF;
	}
	
	div.analogTreeNode1 {
		width: 100%; padding-left: 50px;
		background: #A0A0A0;
	}
	
	div.analogTreeNode2 {
		width: 100%; padding-left: 50px;
		background: #C0C0C0;
	}
	
	div.analogTreeNode3	 {
		width: 100%; padding-left: 50px;
		background: #A0A0A0;
		color: #FFFFFF;
	}
	
</style>
	
	<script type="text/javascript" src="/_syslib/custom.dtree.js"></script>
	
	<script type="text/javascript">

	
		<?	$loopbackCheck = array(); ?>
		
		tecdocTree = new dTree('tecdocTree', '/images/ar2-tree');
		
		
<?

	$rowStr    = "<nobr><div class=\"analogTreeNode\">";
	
	$rowStr  .= "<span class=\"scol_0\">&nbsp;</span>";
	
	$rowStr  .= "<span class=\"scol_1\">".$SearchSetting['searchCodeInfo'][0]['code']."</span>";
	
	$rowStr  .= "<span class=\"scol_2\">".$SearchSetting['searchCodeInfo'][0]['prd_name']."</span>";
	
	$rowStr  .= "<span class=\"scol_3\">".$SearchSetting['searchCodeInfo'][0]['name']."</span>";
	
	$rowStr  .= "</div></nobr>";
	
	$rowStr = preg_replace("#[\r\n\t]+#Uis"," ",$rowStr);

	echo "tecdocTree.add(".$SearchSetting['searchCodeInfo'][0]['detail_id'].", -1, '$rowStr', '/admin/webavtr/analogs.html?d1_code=".strip_tags($SearchSetting['searchCodeInfo'][0]['code'])."&prd1_name=".strip_tags($SearchSetting['searchCodeInfo'][0]['prd_name'])."&partSearch=1', '".$AR_MSG['SearchModule']['11']."', '_blank');";
	
		
		foreach ($__search_results['data'] as $dat_id=>$row) { 

				
			if ($row['detail_id'] != $row['cross_detail_id'] && !isset($loopbackCheck[$row['detail_id']])) {
					
				$rowStr    = "<div class=\"analogTreeNode".$row['cross_level']."\">";
	
				$rowStr  .= "<span class=\"scol_0\">&nbsp;</span>";	
				$rowStr  .= "<span class=\"scol_1\">&nbsp;".$row['article']."</span>";
				$rowStr  .= "<span class=\"scol_2\">".strtoupper($row['brand'])."</span>";
				$rowStr  .= "<span class=\"scol_3\">".$row['spare_info']."</span>";
				
				$rowStr  .= "</div></nobr>";
				
				$rowStr = preg_replace("#[\r\n\t]+#Uis"," ",$rowStr);
										
				echo "tecdocTree.add(".$row['detail_id'].", ".$row['cross_detail_id'].", '".$rowStr."', '/admin/webavtr/analogs.html?d1_code=".strip_tags($row['article'])."&prd1_name=".strip_tags($row['brand'])."&partSearch=1', '".$AR_MSG['SearchModule']['11']."', '_blank');";
				
			}
			
			$loopbackCheck[$row['detail_id']] = 1;		
			
		} ?>
		
		document.write(tecdocTree);	
		

	</script><?  ?>

		<? } else { ?>

			<? if ($__search_results['controls']) { ?>

				<?  ?><? foreach ($__search_results['controls'] as $hdr_id=>$control) { ?>

<? if ($hdr_id == 'searchPages') continue; ?>

<div class="<?=($hdr_id=="filter"?'notice':'')?>" style="padding-top: 0px; padding-bottom: 0px">
	<?=$control?>
</div>

<? } ?><?  ?>

			<? } ?>

			<?  ?><div style="display:none;"><img src="/images/add_basket_loader.gif" /></div>

<form class="search-data__form" action="<?=$SearchSetting['basketURL']?>" method="POST">

<? if ($SearchSetting['useOrderColumn'] == 1) { ?>

<input type="hidden" name="func" value="add">
<div class="searchPrderButton"><input type="submit" value="<?=$AR_MSG['SearchModule']['msg46']?>"></div><br>

<? } ?>

<? $excludes_array = array('amount', 'weight', 'dlv_weight_tax'); ?>

<? $columns = 0; ?>
<? foreach ($__search_results['header'] as $hdr_id=>$column) { ?>
	
	<? if (($column['visible']!=true) or (in_array($hdr_id, $excludes_array))) continue; ?>

	<? $columns++; ?>

<? } ?>

<table class="web_ar_datagrid search-results search-results_type_classic search-results--fixed" fix-thead>
<?  ?><thead>
	<tr id="search_header" class="search-header">

		<? $columns = 0; ?>
		<? foreach ($__search_results['header'] as $hdr_id => $column) { ?>

			<? if (($column['visible'] != true) or (in_array($hdr_id, $excludes_array))) continue; ?>

			<? $columns++; ?>
			<th class="search-header__col search-header__col--<?= $hdr_id ?>">
				
				<? if (!empty($column['clm_info'])) { ?>
					<span class="tipz" title="<?= $column['clm_info'] ?>"></span>
				<? } ?>
				<?
				$headerCaption = 0;
				?>
				<?=($hdr_id == 'info' || $hdr_id ==  'action')? '' : $column['caption']; ?>
			</th>

		<? } ?>


		<? if ($basket_check) { ?>
			<th><?= $__search_results['header']['final_price_val']['caption'] ?></th>
			<th><?= $__search_results['header']['percent_term']['caption'] ?></th>
			<? $columns += 2; ?>
		<? } ?>
	</tr>
</thead><?  ?>

<? $showDelivery = array(); ?>

<? foreach ($__search_results['data'] as $dat_id=>$row) { ?>

<?
if ($row['info_only'] == 1) {
	
	if (($SearchSetting['searchCode'] != $row['parsed_article']) or ($ZeroResultShown == 1)) {
	
		continue;
		
	} else {
		
		foreach ($__search_results['data'] as $dat_id2=>$row2) {
		
		    if (($row['parsed_article'] == $row2['parsed_article']) && ($dat_id != $dat_id2) && ($row2['info_only'] == 0) && ($row['prd_info_link'] == $row2['prd_info_link'])) { 
    			continue 2;
			}

		}
		
		$ZeroResultShown = 1;

	}

} 
?>

<?
 
if (($isProvider['provider_id'] == $row['provider_id']) && ($row['provider_id']>0)) { 
	$class = 'provider_row'; 
}
?>
<tr <?=($_interface->csColorRowPosition ?'class="search-row lg" style="'.$row['sts_style'].'"':'class="search-row '.$class.'"')?>>

	<? foreach ($__search_results['header'] as $hdr_id=>$column) { ?>
		
		<? if (($column['visible']!=true) or (in_array($hdr_id, $excludes_array))) continue; ?>
		
		<? 
			switch($hdr_id) {
				
				case 'spare_info':
				case 'article': 
				case 'prd_info_link': {
					$col_align = 'left';
				} break;
				
				case 'final_price':
				case 'customer_price':
				case 'dlv_weight_tax':
				case 'price_brutto': {
					$col_align = 'right';
				} break;
				
				default: {
					$col_align = 'center';
				}
				
			}
		?>
		<td class="search-col search-col__<?=$hdr_id?>">
			<?  ?><?
switch ($hdr_id) {
	case 'spare_info':
		 ?><?  ?><? if ($row[$hdr_id] == '') { ?>
	&nbsp;
<? } else { ?>
	<p class="tipz" data-line-clamp="2" title="<?= $row[$hdr_id]; ?>"><?= $row[$hdr_id] ?></p>
<? } ?>
<?  ?><? 
		break;
	case 'evaluation':
		 ?><?  ?><? if ($row['info_only'] != 1) { ?>

	<? $showStat = ($SearchSetting['statShow'] == 1) && ($row["prv_show_stat"]); ?>

	<? if ($showStat) { ?>
		<button type="button" class="column-val column-val--evaluation" data-show-modal data-width="660" data-height="560" data-href="/shop/provider_stat.html?pv=<?= $row['provider_id'] ?>&t=<?= $row['term_interval_value'] ?>&sid=<?= $row['_search_id'] ?>">
	<? } else { ?>
		<span class="column-val column-val--evaluation">
	<? } ?>

	<? $evalArr = explode(' | ', $row['evaluation']); ?>
	<svg width="26px" height="26px" class="column-val__evaluation-svg">
		<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="/_sysimg/svg/evaluation.svg#n<?= (int)$evalArr[0] ?>"></use>
	</svg>
	<span class="column-val__evaluation-separator"></span>
	<svg width="26px" height="26px" class="column-val__evaluation-svg">
		<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="/_sysimg/svg/evaluation.svg#n<?= (int)$evalArr[1] ?>"></use>
	</svg>

	<? if ($showStat) { ?>
		</button>
	<? } else { ?>
		</span>
	<? } ?>

<? } ?>



<?  ?><? 
		break;
	case 'article':
		 ?><?  ?><span <?= ($row['parsed_article'] == $SearchSetting['searchCode'] ? 'class="web_ar_search_code"' : '') ?>>
	<nobr>

	<? if ($SearchSetting['useProtectArticlesByImg']) { ?>
		<img src="<?= getThumbArticlePath($row['article']) ?>"/>
	<? } else { ?>
		<?= $row['article'] ?>
	<? } ?>

	<? if ($row['superseded_by'] != '') { ?>

		<? $show_replacement_conditions = 1; ?>
		<span class="superseded">
			<sup>
				<a title="<?= $AR_MSG['SearchModule']['msg14'] ?> <?= $row['superseded_by'] ?>"><?= $AR_MSG['SearchModule']['msg48'] ?></a>
			</sup>
		</span>

	<? } elseif ($row['replacement_for'] != '') { ?>

		<? $show_replacement_conditions = 1; ?>
		<span class="replacement">
			<sup>
				<a title="<?= $AR_MSG['SearchModule']['msg15'] ?> <?= $row['replacement_for'] ?>"><?= $AR_MSG['SearchModule']['msg49'] ?></a>
			</sup>
		</span>

	<? } ?>

	</nobr>
</span>
<?  ?><? 
		break;
	case 'prd_info_link':
		 ?><?  ?><?
$showingArticle = $row['article'];
if ($SearchSetting['useProtectArticlesByImg']) {
	$showingArticle = '<img src="' . getThumbArticlePath($row['article']) . '" />';
}
?>

<div <?= ($row['brand_full_name'] != "" ? 'title="' . $row['brand_full_name'] . '"' : '') ?> <?= ($row['oem_brand'] == 1 ? 'class="web_ar_oem_brand"' : 'class="web_ar_brand"') ?>>
	<?=(!empty($row['prd_info_exist']) ? "
<a href='/info/producers.html?prd=" . $row['prd_info_exist'] ."' class='search-results__info-link' rel='prd_info_link' data-prdId='" . $row['prd_info_exist'] . "'>" . $row['prd_info_link'] . " </a>
<br>
<a href='/info/producers.html?prd=" . $row['prd_info_exist'] ."' class='search-results__article' rel='prd_info_link' data-prdId='" . $row['prd_info_exist'] . "'>" . $showingArticle . " </a>
	" : '
<span class="search-results__info-link">' . $row['prd_info_link'] . '</span>
<br>
<span class="search-results__article">' . $showingArticle . '</span>
	')?>
</div>
<?  ?><? 
		break;
	case 'remains':
		 ?><?  ?><? if (($row['remains'] == $AR_MSG['SearchModule']['msg16']) && ($row['info_only'] == 0)) { ?>

	<img src="/images/check.png" title="<?= $AR_MSG['SearchModule']['msg16'] ?>" alt="<?= $AR_MSG['SearchModule']['msg16'] ?>"/>

<? } elseif (($SearchSetting['showExactRemains'] == 1) && ($row['remains'] != '')) { ?>

	<? if ($row['remains'] > 0) { ?>
		=<?= $row['remains'] ?>
	<? } else { ?>
		<?= $row['remains'] ?>
	<? } ?>

<? } elseif ($row['remains'] > 0) { ?>
	<?= $row['remains'] ?> <span class="search-col__remains-unit"><?=tr('шт.')?></span>
<? } else { ?>
	-
<? } ?><?  ?><? 
		break;
	case 'final_price':
		 ?><?  ?><? if ($row['provider_price'] == 0) { ?>
	-
<? } elseif ($row['provider_price'] == '') { ?>
	-
<? } else { ?>

	<? $final_price = $row[$hdr_id]; ?>
	<nobr><?= $row[$hdr_id] ?>

	<sup>
		<font color="#990000">

			<?
			if (count($Deliveries) > 0) {
				foreach ($Deliveries as $dlv => $cur_dlv) {

					if ($cur_dlv['delivery_condition'] == $row['delivery_condition']) {

						if ((($row['weight'] == 0) and ($cur_dlv['tax'] > 0)) || ($cur_dlv['tax'] == 0) || ($cur_dlv['tax'] == '')) {

							if (!safeArrayKey($showDelivery, $row['delivery_condition'])) {
								$showDelivery[$row['delivery_condition']] = $cur_dlv;
							}

							echo array_search($row['delivery_condition'], array_keys($showDelivery)) + 1;

						}

					}

				}
			}
			?>

		</font>
	</sup>

	<? if (($row['cost_per_weight'] > 0) && (!empty($row['cost_per_weight_display'])) and empty($row['weight'])) { ?>
		+ <?= $row['cost_per_weight_display'] ?>/<?=tr('кг', 'Common')?>.
	<? } ?>

<? } ?>
</nobr>

<? if ($row['phand_value'] != 0) { ?>

	<br/>
	<small>
		<span id="phand"><?= $AR_MSG['SearchModule']['msg20'] ?>&nbsp;<nobr><?= $row['detail_phand'] ?></nobr></span>
	</small>

<? } ?>

<?  ?><? 
		break;
	case 'action':
		 ?><?  ?>
<? if (($row['info_only'] != '1') || ($row['provider_price'] > 0)) { ?>

	<? if (isset($assocBasketWares[$row['hash']])) { ?>
		<span class="basket-items-count"><?= $assocBasketWares[$row['hash']]['amount'] ?></span>
		<span class="btn-add-basket">
			<a href="/shop/basket.html" class="add-basket__link add-basket__link--added"></a>
		</span>
	<? } else { ?>
		<input type="hidden" id="<?= $row['hash'] ?>" value="<?= $row['_search_id'] ?>">
		<?= $row['amount'] ?>
		<span id="action<?= $row['_search_id'] ?>" class="btn-add-basket"> <?= $row[$hdr_id] ?></span>
		<input type="hidden" id="max_amount_<?=$row['_search_id']?>" value="<?=($_interface->csLeadLettersToNumberForCheckRemains ? strToFloat($row['remains']) : (float)$row['remains'])?>"/>
	<? } ?>

<? } ?>
<?  ?><? 
		break;
	case 'info':
		 ?><?
$detailInfo = array(
	"article" => $row['parsed_article'],
	"brand"   => $row['brand']
);

$detailLink = data2str($detailInfo, true, true);
?>

<button type="button" class="column-val column-val--detail-info" data-show-modal data-width="660" data-height="560" data-href="/info/detail.html?sid=<?= $row['_search_id'] ?>&detailLink=<?= $detailLink ?>"></button>

<? if ($row['picture']) { ?>
	<button type="button" class="column-val column-val--picture" data-show-modal data-width="660" data-height="560" data-href="/info/detail.html?sid=<?= $row['_search_id'] ?>&detailLink=<?= $detailLink ?>"></button>
<? } ?>

<? if (($row['weight']) && ($row['weight'] > 0)) { ?>
	<img src="/images/weight.png" border="0" title="<?= $AR_MSG['SearchModule']['msg19'] ?> = <?= $row['weight'] ?>" alt="<?= $AR_MSG['SearchModule']['msg19'] ?> = <?= $row['weight'] ?>" hspace="1" align="absmiddle"/>
<? } ?>
<? 
		break;
	case 'term':
	case 'time':
	case 'term_and_destination':
		 ?><?  ?>
<? if ($hdr_id == 'term') { ?>

	<? if ($row['term'] > 0 || ($row['max_term'] > 0 && $_interface->csUseMaxTerm)) { ?>
		<?= $row[$hdr_id] ?> <span class="search-col__term-unit"><?=tr('дн.', 'SearchModule')?></span>
	<? } elseif (($row['term'] == 0) && ($row['info_only'] != 1) && $row['max_term'] == 0) { ?>
		<?= $AR_MSG['SearchModule']['msg12'] ?>
	<? } elseif ($row['info_only'] == 1) { ?>
		-
	<? } ?>

<? } elseif ($hdr_id == 'time') { ?>

	<? if ($row['term'] > 0 || ($row['max_term'] > 0 && $_interface->csUseMaxTerm)) { ?>
		<?= $row[$hdr_id]?>
	<? } elseif (($row['term'] == 0) && ($row['info_only'] != 1) && $row['max_term'] == 0) { ?>
		<?= $AR_MSG['SearchModule']['msg12'] ?>
	<? } elseif ($row['info_only'] == 1) { ?>
		-
	<? } ?>

<? } elseif ($hdr_id == 'term_and_destination') { ?>

	<? if ($row['term'] > 0 || ($row['max_term'] > 0 && $_interface->csUseMaxTerm)) { ?>
		<?= $row['term'] ?> <span class="search-col__term-unit"><?=tr('дн.', 'SearchModule')?></span>
		<div class="search-col__term-caption">
			<?= $row['destination_display'] ?>
		</div>
	<? } elseif (($row['term'] == 0) && ($row['info_only'] != 1) && $row['max_term'] == 0) { ?>
		<?= $AR_MSG['SearchModule']['msg12'] ?>
		<div class="search-col__term-caption">
			<?= $row['destination_display'] ?>
		</div>
	<? } elseif ($row['info_only'] == 1) { ?>
		-
	<? } ?>

<? } ?><?  ?><? 
		break;
	case 'price_brutto':
		echo (($row['weight'] > 0) && ($row['cost_per_weight'] > 0)) ? $row[$hdr_id] : '&nbsp;';
		break;
	case 'orderm':
	case 'date':
		echo (($row['info_only'] != '1') || ($row['provider_price'] > 0)) ? $row[$hdr_id] : '&nbsp;';
		break;
	default:
		echo $row[$hdr_id] ? $row[$hdr_id] : '&nbsp;';
		break;
}
?><?  ?>
		</td>
	<? } ?>
	
	<? if ($basket_check == 1) { ?>
        <td align="right">
			<? if ($row['final_price_val'] && ($desire_price != 0)) { ?>
				<?=number_format((($row['final_price_val'] - $desire_price) / $desire_price *100), 2, '.', ' ')?>
			<? } ?>
		</td>
        <td align="right">
			<? if ($row['max_term'] && ($desire_term != 0)) { ?>
				<?=number_format((($row['max_term'] - $desire_term) / $desire_term *100), 2, '.', ' ')?>
			<? } elseif ($row['term'] && ($desire_term !=0 )) { ?>
				<?=number_format((($row['term'] - $desire_term) / $desire_term *100), 2, '.', ' ')?>
  	
            <? } ?>
        </td>
    <? } ?>
</tr>

<? } ?>

</table>

</form><?  ?>

		<? } ?>

		<div class="search-data__paginator">
			<?= $__search_results['controls']['searchPages'] ?>
		</div>

		<div class="search-data__error" id="search_bottom_notifies">
			<?  ?><?

if (sizeof($showDelivery) > 0 || $show_replacement_conditions) {
	$Deliveries = $showDelivery;
	$k = 0;

	?>


	<div class="warning search-data__warning search-data__warning_deliveries">
		<div class="warning__caption"><?= $AR_MSG['SearchModule']['msg23'] ?></div>

		<? foreach ($Deliveries as $dlv => $delivery) { ?>

			<? $k++; ?>

			<div class="warning__term">
				<sup><?= $k ?></sup>
				<?= $delivery['dlv_text'] ?>&nbsp;
			</div>

		<? } ?>

		<? if ($show_replacement_conditions != 0) { ?>

			<div style="padding: 5px">
				<span style="color: #990000">
					<sup>
						<a title="<?= $row['superseded_by'] ?>" style="font-weight: bold; width: 10px; background: #990000; color: #FFFFFF; padding: 1px; cursor: default"><?= $AR_MSG['SearchModule']['msg48'] ?></a>
					</sup>
				</span>
				<?= $AR_MSG['SearchModule']['msg24'] ?>&nbsp;
			</div>

			<div style="padding: 5px">
				<span style="color: #990000">
					<sup>
						<a title="<?= $row['replacement_for'] ?>" style="width: 10px; background: #000000; color: #FFFFFF; padding: 1px; cursor: default"><?= $AR_MSG['SearchModule']['msg49'] ?></a>
					</sup>
				</span>
				<?= $AR_MSG['SearchModule']['msg25'] ?>&nbsp;
			</div><br/>

		<? } ?>

	</div>

<? } ?>

<? if (!$SearchSetting['admin_search']) { ?>

	<? if ($clientData['retail']!==true) { ?>

		<div class="warning search-data__warning">
			<div class="warning__caption"><?= $AR_MSG['Forms']['msg5'] ?></div>
			<div class="warning__text"><?= $AR_MSG['SearchModule']['msg22'] ?></div>
		</div>

	<? } ?>

<? } ?>

<div class="search-data__warning">
	<? if (!$SearchSetting['admin_search']) { ?>
		<noindex>
			<div class="search-error-bottom">
				<div class="search-error-bottom__caption"><?= $AR_MSG['SearchModule']['msg50'] ?></div>
				<div class="search-error-bottom__text"><?=trp('Если в списке аналогичных товаров вы нашли ошибку, %sсообщите об этом%s, пожалуйста.', 'SearchModule', '<a href="/shop/report_error.html?errid=E2&article=' . $SearchSetting['searchCode'] . '&brand=' . $SearchSetting['searchBrand'] . '" class="search-error-bottom__link">', '</a>')?></div>
			</div>
		</noindex>

	<? } ?>
</div>
<?  ?>
		</div>

	<? } elseif ($alternatives) { ?>
		<?  ?><div class="alternatives">

	<div class="alternatives-header">
		<? foreach ($alternatives['header'] as $hdr_id => $column) { ?>
			<? if ($column['visible'] == true) { ?>
				<div class="alternatives-header__col  alternatives-header__col--<?= $hdr_id ?>"><?= $column['caption'] ?></div>
			<? } ?>
		<? } ?>
	</div>

	<? foreach ($alternatives['data'] as $dat_id => $row) { ?>

		<div class="alternatives__row" data-href="<?= $row['group_link'] ?>">

			<? foreach ($alternatives['header'] as $hdr_id => $column) { ?>
				<? if ($column['visible'] == true) { ?>
					<span class="alternatives__col alternatives__col--<?= $hdr_id ?>">
						<span class="alt_<?= $hdr_id ?>">

							<?= $row[$hdr_id] ?>

							<? if ($hdr_id == 'spare') { ?>

								<? if ($row['superseded_by'] != '') { ?>
									<?= $row['code'] ?> - <?= $AR_MSG['SearchModule']['msg7'] ?><?= $row['superseded_by'] ?>
								<? } ?>

								<? if ($row['replacement_for'] != '') { ?>
									<?= $row['code'] ?> - <?= $AR_MSG['SearchModule']['msg8'] ?><?= $row['replacement_for'] ?>
								<? } ?>

							<? } ?>

						</span>
					</span>
				<? } ?>
			<? } ?>
		</div>
	<? } ?>
</div><?  ?>
	<? } ?>

	<? if ($SearchSetting['invalid_search']) { ?>

		<?  ?><?=$AR_MSG['SearchModule']['msg26']?>
	<?=$AR_MSG['SearchModule']['msg27']?>
	<?=$AR_MSG['SearchModule']['msg28']?>
	<?=$AR_MSG['SearchModule']['msg29']?>
	<?=$AR_MSG['SearchModule']['msg30']?>
	<?=$AR_MSG['SearchModule']['msg31']?><?  ?>

	<? } ?>

	<? } ?>

<? } else { ?>

	<?  ?><h2><?=$AR_MSG['SearchModule']['msg39']?></h2>
	
<p><?=$AR_MSG['SearchModule']['msg40']?></p><?  ?>

<? } ?><? 

	}

}
?>

<script type="text/javascript">

	function initScripts() {
		if (typeof setWidth == 'function') {
			setWidth();
		}
		if (typeof initSelect == 'function') {
			initSelect();
		}
		if (typeof initTabLister == 'function') {
			initTabLister();
		}
		if (typeof fixedCaption == 'function') {
			fixedCaption();
		}
		if (typeof initSQBox == 'function') {
			initSQBox();
		}
	}

	jqWar(document).ready(function () {
		setTimeout(initScripts, 500);
	});

</script>
<?if ($SearchSetting['admin_search'] == 1){?>
	<script>
		window.onload = function(){
			var forms = document.forms,
				leForm =forms.length,
				i = 0,
				form;
			for(i;i<leForm;i++){
				if(forms[i].action.indexOf('admin/eshop/basket.html')>-1){
					var form = forms[i];
					form.onsubmit = function(){
						var inputs = form.getElementsByTagName("input"),
							le = inputs.length,
							j = 0;
						for(j;j<le;j++){
							if(inputs[j].type == 'checkbox' && inputs[j].checked){
								return;
							}
						}
						alert('<?=tr('Пожалуйста, выберите позиции', 'SearchModule')?>');
						return false;
					}
				}
			}
		}
	</script>
<?}?><? 
	
?>
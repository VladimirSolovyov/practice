<?
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
						<? include(PHP_DataRender::includeTemplatePath('/autoresource/search/tpl.alternatives_table.php')); ?>
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
		<? include(PHP_DataRender::includeTemplatePath('/autoresource/search/tpl.select_currency.php')); ?>
	<? } ?>
</div>
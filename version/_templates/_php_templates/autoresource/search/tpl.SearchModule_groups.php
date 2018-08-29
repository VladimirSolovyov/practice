<? if ($_SYSTEM->REQUESTED_PAGE == "/shop/basket_check.html") {

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

	<? include(PHP_DataRender::includeTemplatePath('/autoresource/search/tpl.search_header.php')); ?>

	<? if ($SearchSetting['empty_search']) { ?>

		<? include(PHP_DataRender::includeTemplatePath('/autoresource/search/tpl.empty_search.php')); ?>

	<? } else { ?>

		<? if ($__search_results) { ?>

			<? if (!$admin_search) { ?>

				<? include(PHP_DataRender::includeTemplatePath('/autoresource/search/groups/tpl.top_caption.php')); ?>

			<? } else { ?>

				<?= $AR_MSG['SearchModule']['msg1'] ?>

			<? } ?>

			<? if ($search_from_catalog) { ?>

			<li><p><a href="<?=$SearchSetting['catalog_search_url']?>"><?=$AR_MSG['SearchModule']['msg2']?></a></p></li>

			<? } ?>

			<? if ($SearchSetting['searchMode'] == "An") { ?>

				<? include(PHP_DataRender::includeTemplatePath('/autoresource/search/tpl.analogs_tree.php')); ?>

			<? } else { ?>

				<? if ($__search_results['controls']) { ?>

					<? include(PHP_DataRender::includeTemplatePath('/autoresource/search/tpl.top_controls.php')); ?>

				<? } ?>

				<? include(PHP_DataRender::includeTemplatePath('/autoresource/search/groups/tpl.search_results_table.php')); ?>

			<? } ?>

			<div class="search-data__paginator">
				<?= $__search_results['controls']['searchPages'] ?>
			</div>

			<div class="search-data__error" id="search_bottom_notifies">
				<? include(PHP_DataRender::includeTemplatePath('/autoresource/search/tpl.bottom_notifies.php')); ?>
			</div>

		<? } elseif ($alternatives) { ?>
			<? include(PHP_DataRender::includeTemplatePath('/autoresource/search/tpl.alternatives_step.php')); ?>
		<? } ?>

		<? if ($SearchSetting['invalid_search']) { ?>

			<? include(PHP_DataRender::includeTemplatePath('/autoresource/search/tpl.invalid_search.php')); ?>

		<? } ?>

	<? } ?>

<? } else { ?>

	<? include(PHP_DataRender::includeTemplatePath('/autoresource/search/tpl.auth_message.php')); ?>

<? } ?>
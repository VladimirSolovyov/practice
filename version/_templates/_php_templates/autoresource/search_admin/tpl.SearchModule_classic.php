<? if (($SearchSetting['authUserSearchOnly'] != 1) || ($SearchSetting['cst_category_id'] >= 1) || ($SearchSetting['admin_search'] == 1)) { ?>

	<? if ($SearchSetting['empty_search']) { ?>

		<? include(PHP_DataRender::includeTemplatePath('/autoresource/search_admin/tpl.empty_search.php')); ?>
	
	<? } ?>

	<? if ($alternatives && !$__search_results && !$SearchSetting['empty_search']) { ?>

		<? include(PHP_DataRender::includeTemplatePath('/autoresource/search_admin/tpl.alternatives_table.php')); ?>

	<? } ?>

	<? if ($__search_results && !$SearchSetting['empty_search']) { ?>

		<? if (!$SearchSetting['admin_search']) { ?>

			<? include(PHP_DataRender::includeTemplatePath('/autoresource/search_admin/classic/tpl.top_caption.php')); ?>

		<? } else { ?>

			<h1><?=$AR_MSG['SearchModule']['msg1']?></h1>

		<? } ?>

		<? if ($search_from_catalog) { ?>
			
			<li><p><a href="<?=$SearchSetting['catalog_search_url']?>"><?=$AR_MSG['SearchModule']['msg2']?></a></p></li>

		<? } ?>

		<? if ($SearchSetting['searchMode'] == "An") { ?>
			<div id="tree_searchmode_An">
				<? include(PHP_DataRender::includeTemplatePath('/autoresource/search_admin/tpl.analogs_tree.php')); ?>
			</div>
			
		<? } else { ?>

			<? if ($__search_results['controls']) { ?>
				
				<? include(PHP_DataRender::includeTemplatePath('/autoresource/search_admin/tpl.top_controls.php')); ?>

			<? } ?>

			<? include(PHP_DataRender::includeTemplatePath('/autoresource/search_admin/classic/tpl.search_results_table.php')); ?>

			<? if ($__search_results['controls']) { ?>

				<? foreach ($__search_results['controls'] as $hdr_id=>$control) { ?>

					<? if ($hdr_id !== 'searchPages') { continue; } ?>
					<div class="<?=($hdr_id=="filter"?'notice':'')?>" style="padding-top: 0px; padding-bottom: 0px;<?=($hdr_id=="filter"?'min-width:1000px;':'')?>">
						<?=$control?>
					</div>

				<? } ?>

			<? } ?>

		<? } ?>

		<? include(PHP_DataRender::includeTemplatePath('/autoresource/search_admin/tpl.bottom_notifies.php')); ?>

	<? } ?>

	<? if ($SearchSetting['invalid_search']) { ?>
		
		<? include(PHP_DataRender::includeTemplatePath('/autoresource/search_admin/tpl.invalid_search.php')); ?>

	<? } ?>

<? } else { ?>
	
	<? include(PHP_DataRender::includeTemplatePath('/autoresource/search_admin/tpl.auth_message.php')); ?>

<? } ?>
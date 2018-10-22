<!--Begin Адаптивные вкладки-->
<ul class="accordion-tabs" data-accordion >

	<? $selectedGroup = array_keys($linkGroups)[0]; ?>

	<? foreach ($linkGroups as $groupId => $group) { ?>
		<li class="accordion-tabs__cont <? if (count($linkGroups) == 1) { ?>accordion-tabs__cont_no_tabs<? } ?>">
			<a class="accordion-tabs__link <? if ($selectedGroup === $groupId) { ?>accordion-tabs__link--active<? } ?><? if (!$showHeader) { ?> accordion-tabs__link_hidden<? } ?>" data-accordion-toggle="<?= $groupId ?>"><?=tr($group['clg_name'], 'catalog_links_group')?></a>
			<section class="accordion-tabs__tab-content <? if ($selectedGroup === $groupId) { ?>is-open<? } ?>" data-accordion-target="<?= $groupId ?>">
				<? include $group['clg_type'] . '.php'; ?>
			</section>
		</li>
	<? } ?>
</ul>
<!--End Адаптивные вкладки-->
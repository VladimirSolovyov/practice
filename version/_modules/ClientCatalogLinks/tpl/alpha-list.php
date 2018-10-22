<?
$items = [];
$groupLetter = '';
foreach ($links[$groupId] as $item) {
	$groupLetter = substr($item['cln_name'], 0, 1);
	$items[$groupLetter][$item['cln_name']] = $item;
}
$description = tre('clg_desc_' . $groupId, 'catalog_links_group');
?>
<div class="accordion-tab">
	<? if ($description) { ?>
		<div class="accordion-tab__description">
			<?= tre('clg_desc_' . $groupId, 'catalog_links_group') ?>
		</div>
	<? } ?>
	<div class="brand-catalog-list accordion-tab__grid">
		<div class="brand-catalog-list__wrapper">
			<? foreach ($items as $group_key => $group) { ?>
				<section class="brand-catalog-list__group">
					<div class="brand-catalog-list__group-key"><?= $group_key ?></div>
					<ul class="brand-catalog-list__list">
						<?
						foreach ($group as $brand_key => $brand_item) { ?>
							<li class="brand-catalog-list__item">
								<a href="<?= $brand_item['cln_link'] ?>" class="brand-catalog-list__link" <?= ($brand_item['cln_external'] ? 'target="_blank"' : '') ?>><?= tr($brand_item['cln_name'], 'catalog_links') ?></a>
							</li>
						<? } ?>
					</ul>
				</section>
			<? } ?>
		</div>
	</div>
</div>

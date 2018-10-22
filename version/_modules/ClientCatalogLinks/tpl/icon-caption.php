<?
$items = $links[$groupId];
$description = tre('clg_desc_' . $groupId, 'catalog_links_group');
?>
<div class="accordion-tab">
	<? if ($description) { ?>
		<div class="accordion-tab__description">
			<?= tre('clg_desc_' . $groupId, 'catalog_links_group') ?>
		</div>
	<? } ?>
	<div class="grid-card grid-card_type_short-name<?= ($addWrapperClass ? " " . $addWrapperClass : "") ?> accordion-tab__grid">
		<div class="grid-card__wrapper">
			<? foreach ($items as $item) { ?>
				<a class="grid-card__item<?= $item['cln_class'] ? ' ' . $item['cln_class'] : '' ?>" href="<?= $item['cln_link'] ?>" <?= ($item['cln_external'] ? 'target="_blank"' : '') ?>>
					<?
					switch (true) {
						case $item['cln_img']:
							?><img class="grid-card__img" src="<?= $item['cln_img'] ?>" alt="<?= tr($item['cln_name'], 'catalog_links') ?>"><?
							break;
						case $item['cln_svg']:
							?>
							<svg class="grid-card__svg">
							<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?= $item['cln_svg'] ?>"></use>
							</svg><?
							break;
					}
					?>
					<span class="grid-card__name"><?= tr($item['cln_name'], 'catalog_links') ?></span>
				</a>
			<? } ?>
		</div>
	</div>
</div>

<div class="list-catalog-tile">

	<? foreach ($arTileLinks as $arTile):
			$classList = ['list-catalog-tile__item'];
			$image = empty($arTile['ctl_img']) ? false : $arTile['ctl_img'];
			if (!$image) {
				$classList[] = 'list-catalog-tile__item--no-image';
			}
			if ($arTile['ctl_long_desktop']) {
				$classList[] = 'list-catalog-tile__item_long_desktop';
			}
			if ($arTile['ctl_long_tablet']) {
				$classList[] = 'list-catalog-tile__item_long_tablet';
			}
		?>
		<a class="<?=implode(' ', $classList)?>" href="<?= $arTile['ctl_link'] ?>">
			<span class="list-catalog-tile__content">
				<span class="list-catalog-tile__title"><?=$arTile['ctl_name']?></span>
				<span class="list-catalog-tile__description"><?=$arTile['ctl_description']?></span>
			</span>
			<? if (!empty($arTile['ctl_icon_class'])): ?>
				<i class="list-catalog-tile__icon list-catalog-tile__icon_type_<?=$arTile['ctl_icon_class']?>"></i>
			<? endif; ?>
			<? if ($image) { ?>
				<img class="list-catalog-tile__image" src="<?= $arTile['ctl_img'] ?>" alt="<?= tr($arTile['ctl_name'], 'tile_links') ?>">
			<? } ?>
		</a>
	<? endforeach; ?>
</div>

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
	<div class="catalog-common accordion-tab__grid">
		<div class="catalog-common__list">

			<? foreach ($items as $item) { ?>
				<div class="catalog-common__item">
					<a class="catalog-common__link" href="<?=$item['cln_link']?>" <?=($item['cln_external'] ? 'target="_blank"' : '')?>>
						<? if ($item['cln_img']) { ?>
							<img src="<?=$item['cln_img']?>" class="catalog-common__picture-icon" alt="<?=tr($item['cln_name'], 'catalog_links')?>"/>
						<? } elseif ($item['cln_svg']) { ?>
							<svg class="catalog-common__svg">
								<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?=$item['cln_svg']?>"></use>
							</svg>
						<? } elseif ($item['cln_class']) { ?>
							<i class="catalog-card__icon <?=$item['cln_class']?>"></i>
						<? } ?>
						<?=tr($item['cln_name'], 'catalog_links')?></a>
				</div>
			<? } ?>

		</div>
	</div>


</div>

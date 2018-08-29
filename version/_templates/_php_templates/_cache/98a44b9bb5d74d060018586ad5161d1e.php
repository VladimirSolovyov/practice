<?
$level = $CONTENT[0]['str_level'] + 1;
$left = $CONTENT[0]['str_left'];
$right = $CONTENT[0]['str_right'];
?>
<div class="menu-footer">
	<? foreach ($CONTENT as $key => $item) { ?>
		<? if ($item['str_level'] == $level and $item['str_left'] > $left and $item['str_right'] < $right) { ?>
			<section class="menu-footer__group">
				<div class="menu-footer__wrap">
					<div class="menu-footer__title"><?= truc($item['str_title'], 'AdminLeftMenu') ?></div>
					<ul class="menu-footer__list">
						<? if (!empty($item['has_childs'])) { ?>

							<?
							$p_level = $item['str_level'] + 1;
							$p_left = $item['str_left'];
							$p_right = $item['str_right'];
							?>
							<? foreach ($CONTENT as $ch_key => $ch_item) { ?>
								<? if ($ch_item['str_level'] == $p_level and $ch_item['str_left'] > $p_left and $ch_item['str_right'] < $p_right) {
									if(isset($ch_item['str_metadata']['type']) && $ch_item['str_metadata']['type'] == 'title'){
										?><a class="menu-footer__title menu-footer__title--inlist" href="<?= $ch_item['str_url'] ?>"><?= truc($ch_item['str_title'], 'AdminLeftMenu') ?></a><?
									} else {
										?>
										<li class="menu-footer__item">
											<a class="menu-footer__link <?= ($_SYSTEM->REQUESTED_PAGE == $ch_item['str_url'] ? 'menu-footer__link--active' : '') ?>" href="<?= $ch_item['str_url'] ?>"><?= truc($ch_item['str_title'], 'AdminLeftMenu') ?></a>
										</li>
										<?
									}
									?>
								<? } ?>
							<? } ?>

						<? } ?>
					</ul>
				</div>
			</section>
		<? } ?>
	<? } ?>
</div>
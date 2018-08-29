<?
	$level = $CONTENT[0]['str_level']+1;
	$left = $CONTENT[0]['str_left'];
	$right = $CONTENT[0]['str_right'];
?>
<ul class="mobile-menu">
	<? foreach ($CONTENT as $key=>$item) { ?>
		<? if($item['str_level'] == $level and $item['str_left'] > $left and $item['str_right'] < $right) { ?>
			<li class="mobile-menu__item <?=(!empty($item['has_childs']) ? 'mobile-menu__item--dropdown' : '')?>">
				<a class="mobile-menu__link" href="<?=$item['str_url']?>"><?=truc($item['str_title'], 'AdminLeftMenu')?></a>
				<? if (!empty($item['has_childs'])) { ?>
					<ul class="mobile-menu-sub">
						<?
						$p_level = $item['str_level']+1;
						$p_left = $item['str_left'];
						$p_right = $item['str_right'];
						?>
						<? foreach ($CONTENT as $ch_key=>$ch_item) { ?>
							<? if($ch_item['str_level'] >= $p_level and $ch_item['str_left'] > $p_left and $ch_item['str_right'] < $p_right) { ?>
								<? if (!$ch_item['str_url']) { continue; } ?>
								<li class="mobile-menu-sub__item">
									<a class="mobile-menu-sub__link <?=($_SYSTEM->REQUESTED_PAGE == $ch_item['str_url'] ? 'mobile-menu-sub__link--active':'')?>" href="<?=$ch_item['str_url']?>"><?=truc($ch_item['str_title'], 'AdminLeftMenu')?></a>
								</li>
							<? } ?>
						<? } ?>
					</ul>
				<? } ?>
			</li>
		<? } ?>
	<? } ?>
</ul>
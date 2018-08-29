<?

$level = $CONTENT[0]['str_level']+1;
$left = $CONTENT[0]['str_left'];
$right = $CONTENT[0]['str_right'];
if($CONTENT) {
?>
<div class="menu-catalog header-catalog__menu hidden-xs">
	<button class="menu-catalog__btn"><span class="menu-catalog__btn-title"><?=truc('Каталоги', 'Template')?></span></button>
	<ul class="menu-catalog__list">
		<? foreach ($CONTENT as $key=>$item) { ?>
			<? if($item['str_level'] == $level and $item['str_left'] > $left and $item['str_right'] < $right) { ?>
				<li class="menu-catalog__item">
					<a class="menu-catalog__link<?=$item['has_childs']?' menu-catalog__link--sub':''?>" <?=(!empty($item['str_url'])?'href="' . $item['str_url'] . '"':'')?>>
						<?=truc($item['str_title'], 'AdminLeftMenu')?>
						<? if($item['has_childs']) {?>
							<svg class="menu-catalog__arrow"><use xlink:href="/_sysimg/svg/ui.svg#arrow" /></svg>
						<? } ?>
					</a>
					<? if (!empty($item['has_childs'])) { ?>
						<ul class="menu-catalog-sub">
							<?
							$p_level = $item['str_level']+1;
							$p_left = $item['str_left'];
							$p_right = $item['str_right'];
							?>
							<? foreach ($CONTENT as $ch_key=>$ch_item) { ?>
								<? if($ch_item['str_level'] == $p_level and $ch_item['str_left'] > $p_left and $ch_item['str_right'] < $p_right) { ?>
									<li class="<?=((!empty($CONTENT[$ch_key+1]['str_level'])) && ($CONTENT[$ch_key+1]['str_level']!=$ch_item['str_level'])?'menu-catalog-sub__item last':'menu-catalog-sub__item')?>">
										<a class="menu-catalog-sub__link" href="<?=$ch_item['str_url']?>"><?=truc($ch_item['str_title'], 'AdminLeftMenu')?></a>
									</li>
								<? } ?>
							<? } ?>
						</ul>
					<? } ?>
				</li>
			<? } ?>
		<? } ?>
	</ul>
</div>
<? } ?>
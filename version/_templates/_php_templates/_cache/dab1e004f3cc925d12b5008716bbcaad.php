<? 
$level = $CONTENT[0]['str_level']+1;
$left = $CONTENT[0]['str_left'];
$right = $CONTENT[0]['str_right'];
?>
<ul class="top-nav top-nav--noinit">
	<? foreach ($CONTENT as $key=>$item) { ?>
		<? if($item['str_level'] == $level and $item['str_left'] > $left and $item['str_right'] < $right) { ?>
			<?
				if ($item['str_metadata']['only-mobile'] === 'true') {
					continue;
				}

				$active = false;
				if($item['str_url']==$_SYSTEM->REQUESTED_PAGE) {
					$active = true;
				}
			?>

			<? if(!empty($item['has_childs'])):?>
				<?
					$p_level = $item['str_level']+1;
					$p_left = $item['str_left'];
					$p_right = $item['str_right'];
				?>
				<?
				foreach ($CONTENT as $ch_key=>$ch_item) {
					if($ch_item['str_level'] == $p_level and $ch_item['str_left'] > $p_left and $ch_item['str_right'] < $p_right and $ch_item['str_url'] == $_SYSTEM->REQUESTED_PAGE) {
						$active = true;
					}

				}
				?>
			<?endif?>

			<li class="top-nav__item<?=($active)?' top-nav__item--active':''?><?=$item['has_childs']?' top-nav__item--sub':''?>">
				<a class="top-nav__link" href="<?=(!empty($item['str_url'])?$item['str_url']:'#')?>"><?=truc($item['str_title'], 'AdminLeftMenu')?></a>
				<? if ($item['has_childs']) { ?>
					<ul class="top-menu-sub">
						<?
						$p_level = $item['str_level']+1;
						$p_left = $item['str_left'];
						$p_right = $item['str_right'];
						?>
						<? foreach ($CONTENT as $ch_key=>$ch_item) { ?>
							<? if($ch_item['str_level'] == $p_level and $ch_item['str_left'] > $p_left and $ch_item['str_right'] < $p_right) { ?>
								<li class="<?=((!empty($CONTENT[$ch_key+1]['str_level'])) && ($CONTENT[$ch_key+1]['str_level']!=$ch_item['str_level'])? 'top-menu-sub__item last':'top-menu-sub__item')?>">
									<a class="top-menu-sub__link" href="<?=$ch_item['str_url']?>"><?=truc($ch_item['str_title'], 'AdminLeftMenu')?></a>
								</li>
							<? } ?>
						<? } ?>
					</ul>
				<? } ?>
			</li>
		<? } ?>
	<? } ?>
</ul>

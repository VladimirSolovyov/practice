<?php
$_data['filters'] = $this->filters();

$uri = $this->url(array('cat_id' => $this->cat_id, 'nav_id' => $this->nav_id)); //если в основном разделе содержплиь данные, то nav_id=0 и слеша небыло..закомичу еще разок
$uriReset = "window.location.href = '" . $uri . (strstr($uri, '?') ? '&' : '?');

if ($this->ses['filter']) {
	foreach ($this->ses['filter'] as $key => $row) {
		if (empty($row)) continue;
		$uri .= (strstr($uri, '?') ? '&' : '?') . $key . '=' . urlencode($row);
	}
}


$catInfo = $this->catalog_info($this->cat_id);
$categories = ['tires', 'discs'];
$count = 0;
if ($_data['filters']):?>
	<? if( in_array($catInfo['cat_techname'],$categories) ){
		?>
		<div class="dc-data-filter dc-items-wrap__filter">
			<?foreach ($_data['filters'] as $arFilter):
				$count++;
				$uriReset .= $arFilter['name'] . '=&';?>
				<div class="dc-data-filter__section <?=(($arFilter['selected'] || $count == 1) ? 'dc-data-filter__section--active' : '')?>">
					<div class="dc-filter-expand <?=(($arFilter['selected'] || $count == 1) ? 'dc-filter-expand--open' : '')?>">
						<div class="dc-filter-expand__label"><?=tr($arFilter['title'], 'dc')?></div>
						<div class="dc-filter-expand__content">
							<div class="dc-filter-clist">
								<?if ($arFilter['filterTypeId'] == 7 or $arFilter['filterTypeId'] == 8 or $arFilter['data_list']):?>

								<?else:?>
									<?if ($arFilter['selected']):?>
										<a class="dc-filter-clist__item" href="<?=preg_replace("#$arFilter[name]=.[^&]*#", $arFilter['name'] . "=", $uri)?>"><?=tr('все', 'Common')?></a>
									<?endif;?>

									<?foreach ($arFilter['values'] as $arValue):?>
										<a class="dc-filter-clist__item <?=($arValue['selected'] ? 'dc-filter-clist__item--active' : '')?>" href="<?=$uri?><?=(strstr($uri, "?") === false) ? "?" : "&";?><?=$arFilter['name']?>=<?=urlencode($arValue['value'])?>"><?=tr($arValue['title'], 'dc')?></a>
									<?endforeach;?>
								<?endif;?>

							</div>
						</div>
					</div>
				</div>
			<?endforeach;?>
			<div class="dc-data-filter__section">
				<? /*<button class="btn dc-data-filter__filter-button">Применить</button> */ ?>
				<button class="btn dc-data-filter__filter-button dc-data-filter__filter-button--reset" onclick="<?=$uriReset . "'"?>"><i class="dc-icon dc-icon--close"> </i><?=tr("Сбросить фильтр", "dc");?></button>
			</div>
		</div>
	<?	
	}
	?>
<?endif;?>

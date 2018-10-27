<?
$tiresCatalog = $this->getCatalogInfoByTechName('tires');
$this->cat_id = $tiresCatalog['id'];
$this->resetVars();
$this->loadAllProperty($this->cat_id);
$tiresFilters = $this->filters();
$this->modifyFiltersToAssoc($tiresFilters);

$innerForm = !empty($GLOBALS['_SYSTEM']->PAGES[2]);
?>

<div class="dc-td-search-item dc-td-accordion dc-td-accordion--hard-open">
	<div class="dc-td-search-item__header dc-td-search-item__header--tire dc-td-accordion__collapse-controll">
		<?=tr('Поиск шины','dc');?>
	</div>
	
	<div class="dc-td-accordion__collapse-container">
		<form class="dc-td-search-item__form" id="sub" action="<?=$this->searchUrl?>tires/" method="GET">
			<div class="dc-td-search-item__row">
				<div class="dc-td-search-item__input-container dc-td-search-item__input-container--third">
					<span class="dc-td-search-item__input-label">
						<?=tr('Ширина','dc');?>:
					</span>				
					<select name="<?=$tiresFilters['width']['name']?>" id="<?=$tiresFilters['width']['name']?>">
						<option value=""><?=tr('любая','dc');?></option>
						<? foreach ($tiresFilters['width']['values'] as $filter) { ?>
						<option value="<?=$filter['title']?>" <?=($filter['selected'] ? 'selected="selected"' : '')?>><?=$filter['title']?></option>
						<? } ?>
					</select>
				</div>
				<div class="dc-td-search-item__input-container dc-td-search-item__input-container--third">
					<span class="dc-td-search-item__input-label">
						<?=tr('Высота','dc');?>:					
					</span>
					<select name="<?=$tiresFilters['height']['name']?>" id="<?=$tiresFilters['height']['name']?>">
						<option value=""><?=tr('любая','dc');?></option>
						<? foreach ($tiresFilters['height']['values'] as $filter) { ?>
							<option value="<?=$filter['title']?>" <?=($filter['selected'] ? 'selected="selected"' : '')?>><?=$filter['title']?></option>
						<? } ?>
					</select>				
				</div>
				<div class="dc-td-search-item__input-container dc-td-search-item__input-container--third">
					<span class="dc-td-search-item__input-label">
						<?=tr('Диаметр','dc');?>:
					</span>
					<select name="<?=$tiresFilters['diameter']['name']?>" id="<?=$tiresFilters['diameter']['name']?>">
						<option value=""><?=tr('любой','dc');?></option>
						<? foreach ($tiresFilters['diameter']['values'] as $filter) { ?>
							<option value="<?=$filter['title']?>" <?=($filter['selected'] ? 'selected="selected"' : '')?>><?=$filter['title']?></option>
						<? } ?>
					</select>				
				</div>
			</div>

			<div class="dc-td-search-item__row">
				<div class="dc-td-search-item__input-container dc-td-search-item__input-container--half">
					<span class="dc-td-search-item__input-label">
						<?=tr('Тип','dc');?>:
					</span>
					<select name="<?=$tiresFilters['sealing_method']['name']?>" id="<?=$tiresFilters['sealing_method']['name']?>" style="width: <?=($innerForm ? '100' : '280')?>px">
						<option value=""><?=tr('любой','dc');?></option>
						<? foreach ($tiresFilters['sealing_method']['values'] as $filter) { ?>
							<option value="<?=$filter['title']?>" <?=($filter['selected'] ? 'selected="selected"' : '')?>><?=tr($filter['title'],'dc');?></option>
						<? } ?>
					</select>				
				</div>
				<div class="dc-td-search-item__input-container dc-td-search-item__input-container--half">
					<span class="dc-td-search-item__input-label">
						<?=tr('Сезонность','dc');?>:
					</span>
					<select name="<?=$tiresFilters['season']['name']?>" id="<?=$tiresFilters['season']['name']?>" style="width: <?=($innerForm ? '100' : '280')?>px">
						<option value=""><?=tr('любая','dc');?></option>
						<? foreach ($tiresFilters['season']['values'] as $filter) { ?>
							<option value="<?=$filter['title']?>" <?=($filter['selected'] ? 'selected="selected"' : '')?>><?=tr($filter['title'],'dc');?></option>
						<? } ?>
					</select>
				</div>
			</div>

			<div class="dc-td-search-item__row">
				<div class="dc-td-search-item__input-container">
					<span class="dc-td-search-item__input-label">
						<?=tr('Производитель','dc');?>
					</span>					
					<select name="<?=$tiresFilters['brand']['name']?>" id="<?=$tiresFilters['brand']['name']?>" style="width: <?=($innerForm ? '200' : '280')?>px">
						<option value=""><?=tr('любой','dc');?></option>
						<? foreach ($tiresFilters['brand']['values'] as $filter) { ?>
							<option value="<?=$filter['title']?>" <?=($filter['selected'] ? 'selected="selected"' : '')?>><?=$filter['title']?></option>
						<? } ?>
					</select>				
				</div>
			</div>

			<div class="dc-td-search-item__row">
				<div class="dc-td-search-item__input-container">
					<input type="submit" class="submitButton" name="send" value="<?=tr('найти','dc');?>" />
				</div>
			</div>		
		</form>
	</div>	
</div>
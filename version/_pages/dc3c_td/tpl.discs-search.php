<?
$discsCatalog = $this->getCatalogInfoByTechName('discs');
$this->cat_id = $discsCatalog['id'];
$this->resetVars();
$this->loadAllProperty($this->cat_id);
$discsFilters = $this->filters();
$this->modifyFiltersToAssoc($discsFilters);

$innerForm = !empty($GLOBALS['_SYSTEM']->PAGES[2]);
?>


<div class="dc-td-search-item dc-td-accordion dc-td-accordion--hard-open" >
	<div class="dc-td-search-item__header dc-td-search-item__header--disk dc-td-accordion__collapse-controll">
		<?=tr('Поиск диска','dc');?>
	</div>
	<div class="dc-td-accordion__collapse-container">
		<form class="dc-td-search-item__form" id="sub" action="<?=$this->searchUrl?>discs/" method="GET">
			<div class="dc-td-search-item__row">
				<div class="dc-td-search-item__input-container dc-td-search-item__input-container--third">
					<span class="dc-td-search-item__input-label">					
						<?=tr('Ширина','dc');?>:
					</span>				
					<select name="<?=$discsFilters['width']['name']?>" id="<?=$discsFilters['width']['name']?>">
						<option value=""><?=tr('любая','dc');?></option>
						<? foreach ($discsFilters['width']['values'] as $filter) { ?>
							<option value="<?=$filter['title']?>" <?=($filter['selected'] ? 'selected="selected"' : '')?>><?=$filter['title']?></option>
						<? } ?>
					</select>
				</div>
				<div class="dc-td-search-item__input-container dc-td-search-item__input-container--third">
					<span class="dc-td-search-item__input-label">					
						<?=tr('Диаметр','dc');?>:
					</span>
					<select name="<?=$discsFilters['diameter']['name']?>" id="<?=$discsFilters['diameter']['name']?>">
						<option value=""><?=tr('любой','dc');?></option>
						<? foreach ($discsFilters['diameter']['values'] as $filter) { ?>
							<option value="<?=$filter['title']?>" <?=($filter['selected'] ? 'selected="selected"' : '')?>><?=$filter['title']?></option>
						<? } ?>
					</select>
				</div>
				<div class="dc-td-search-item__input-container dc-td-search-item__input-container--third">
					<span class="dc-td-search-item__input-label">
						<?=tr('Вылет','dc');?>:
					</span>
					<select name="<?=$discsFilters['ET']['name']?>" id="<?=$discsFilters['ET']['name']?>">
						<option value=""><?=tr('любой','dc');?></option>
						<? foreach ($discsFilters['ET']['values'] as $filter) { ?>
							<option value="<?=$filter['title']?>" <?=($filter['selected'] ? 'selected="selected"' : '')?>><?=$filter['title']?></option>
						<? } ?>
					</select>
				</div>
			</div>

			<div class="dc-td-search-item__row">
				<div class="dc-td-search-item__input-container dc-td-search-item__input-container--third">
					<span class="dc-td-search-item__input-label">
						<?=tr('Отверстий','dc');?>:
					</span>
					<select name="<?=$discsFilters['LZ']['name']?>" id="<?=$discsFilters['LZ']['name']?>">
						<option value=""><?=tr('любое','dc');?></option>
						<? foreach ($discsFilters['LZ']['values'] as $filter) { ?>
							<option value="<?=$filter['title']?>" <?=($filter['selected'] ? 'selected="selected"' : '')?>><?=$filter['title']?></option>
						<? } ?>
					</select>
				</div>
				<div class="dc-td-search-item__input-container dc-td-search-item__input-container--third">
					<span class="dc-td-search-item__input-label">
						PCD:
					</span>
					<select name="<?=$discsFilters['PCD']['name']?>" id="<?=$discsFilters['PCD']['name']?>">
						<option value=""><?=tr('любой','dc');?></option>
						<? foreach ($discsFilters['PCD']['values'] as $filter) { ?>
							<option value="<?=$filter['title']?>" <?=($filter['selected'] ? 'selected="selected"' : '')?>><?=$filter['title']?></option>
						<? } ?>
					</select>
				</div>
				<div class="dc-td-search-item__input-container dc-td-search-item__input-container--third">
					<span class="dc-td-search-item__input-label">
						<?=tr('ДЦО','dc');?>:
					</span>
					<select name="<?=$discsFilters['DIA']['name']?>" id="<?=$discsFilters['DIA']['name']?>">
						<option value=""><?=tr('любой','dc');?></option>
						<? foreach ($discsFilters['DIA']['values'] as $filter) { ?>
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
					<select name="<?=$discsFilters['type']['name']?>" id="<?=$discsFilters['type']['name']?>" style="width: 130px">
						<option value=""><?=tr('любой','dc');?></option>
						<? foreach ($discsFilters['type']['values'] as $filter) { ?>
							<option value="<?=$filter['title']?>" <?=($filter['selected'] ? 'selected="selected"' : '')?>><?=tr($filter['title'],'dc');?></option>
						<? } ?>
					</select>
				</div>
				<div class="dc-td-search-item__input-container dc-td-search-item__input-container--half">
					<span class="dc-td-search-item__input-label">
						<?=tr('Цвет','dc');?>:
					</span>
					<select name="<?=$discsFilters['color']['name']?>" id="<?=$discsFilters['color']['name']?>" style="width: 130px">
						<option value=""><?=tr('любой','dc');?></option>
						<? foreach ($discsFilters['color']['values'] as $filter) { ?>
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
					<select name="<?=$discsFilters['brand']['name']?>" id="<?=$discsFilters['brand']['name']?>" style="width: <?=($innerForm ? '200' : '280')?>px">
						<option value=""><?=tr('любой','dc');?></option>
						<? foreach ($discsFilters['brand']['values'] as $filter) { ?>
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

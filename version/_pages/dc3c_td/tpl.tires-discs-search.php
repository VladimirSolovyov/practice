
<h1 class="dc-title dc-title--margin">
	<?=tr('Шины. Диски','dc');?>
</h1>

<div class="dc-td-search">
	<?
	$autoCatalog = $this->getCatalogInfoByTechName('tires');
	$this->cat_id = $autoCatalog['id'];
	$this->resetVars();
	$this->loadAllProperty($this->cat_id);

	require_once $this->tpl('tpl.car-filter.php');
	?>
	<div class="dc-td-search__container">
		<div class="dc-td-search__item">
			<? require_once $this->tpl('tpl.tires-search.php'); ?>			
		</div>
		<div class="dc-td-search__item">
			<? require_once $this->tpl('tpl.discs-search.php'); ?>			
		</div>
	</div>
	<? require_once $this->tpl('tpl.bottom-seo-text.php'); ?>
</div>
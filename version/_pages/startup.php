<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-8">
		<?=Loader::callModule('ClientCatalogLinks')?>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-4">
		<?=Loader::callModule('ClientTileLinks')?>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-8">
		<!--Begin Популярные товары-->
		<?= Loader::CallModule('PopularGoods', ['catId' => 74]); ?>
		<!--End Популярные товары-->
	</div>
	<div class="last-news col-xs-12 col-sm-12 col-md-4">
		<!--Begin Последние новости-->
		<? NavigationPart("news", PHP_DataRender::includeTemplatePath("/content/tpl.news-startup.php", false), "DR_PHP"); ?>
		<!--End Последние новости-->
	</div>
</div>
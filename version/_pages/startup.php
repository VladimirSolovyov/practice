<div class="row" style="display:flex; margin: 10px 0; font-size: 16px; margin-bottom: 30px;">
		<div style="border: 1px solid #0732a7; padding: 15px; flex-grow: 1; background-color:white; width:100%">
		<img src="/images/like.png">
			<span>Лучшее качество</span>				
		</div>
		<div style="border: 1px solid #0732a7; padding: 15px; margin-left:10px; flex-grow: 1; background-color:white; width:100%">
		<img src="/images/award.png">	
			<span>Гарантия</span>
		</div>
		<div style="border: 1px solid #0732a7; margin-left:10px; padding: 15px; flex-grow: 1; background-color:white; width:100%">
		<img src="/images/target.png">	
			<span>Любые товары на заказ</span>
		</div>
</div>
<div class="row">

	<div class="col-xs-12 col-sm-12 col-md-12">

		<?=Loader::callModule('ClientTileLinks')?>

	</div>

	<div class="col-xs-12 col-sm-12 col-md-12">

		<?=Loader::callModule('ClientCatalogLinks')?>

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
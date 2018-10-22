<? $detailInnerBlock = $settings['useDetailLink'] ? 'a' : 'div' ?>
<? if (!empty($arItems)) { ?>
	<script type="text/javascript">
		document.addEventListener("DOMContentLoaded", function () {
			window.popularGoodsBasket = new ModuleSmallBasket({
				matchParam: "data-field='popular-goods-basket'",
				basketAddedUrl: "/_ajax/basket.html?func=add",
				basketUrl: "/shop/basket.html",
				checkRemains: false,
				defaultAmount: 1,
				cssClassLoading: 'btn--basket-loading',
				cssClassAdded: 'btn--basket-added'
			});
		});
	</script>

	<div class="popular-goods__title"><?= tr('Популярные товары', 'Common') ?></div>
	<div class="popular-goods__wrapper">
		<div id="popular-goods" class="popular-goods owl-carousel">
			<? foreach ($arItems as $arItem): ?>
			<div class="popular-goods__item">
				<<?= $detailInnerBlock ?> <?=($detailInnerBlock == 'a' ? 'href="' . $arItem['detailUrl'] . '"' : '') ?>>
				<? $outImage = is_array($arItem['image']) ? array_shift($arItem['image']) : $arItem['image'] ?>
				<span class="popular-goods__img<?= (!$outImage ? ' popular-goods__img--empty' : '') ?>">
						<? if ($outImage) { ?>
							<img src="<?= $outImage ?>" alt="<?= $arItem['name'] ?>">
						<? } ?>
						</span>
						<span class="popular-goods__descr">
							<span class="popular-goods__cat"><?= tr($arCatalog['name'], 'dc') ?></span>
							<span class="popular-goods__caption"><?= $arItem['name'] ?></span>
						</span>
			</<?= $detailInnerBlock ?>>
			<div class="popular-goods__bottom">
				<? if (!empty($arItem['price'])) { ?>
					<span class="popular-goods__price"><?= $arItem['price'] ?></span>
					<a class="popular-goods__add-basket btn <?= (isset($arBasketItemsAssoc[$arItem['article']]) ? 'btn--basket-added' : 'btn--add-basket') ?>" data-field='popular-goods-basket' data-sid="<?= $arItem['basket_sid'] ?>" href="/shop/basket.html?func=add&sid=<?= $arItem['basket_sid'] ?>&amount=1"></a>
				<? } elseif ($arItem['showPriceButton']) { ?>
					<a class="btn dc-buy-button dc-buy-button--full-text" href="/search.html?article=<?= urlencode($arItem['article']) ?>&sort___search_results_by=final_price&term=0&smode=A" title="<?= tr('Узнать цену', 'dc') ?> <?= $arItem['name'] ?>"><?= tr('Узнать цену', 'dc') ?></a>
				<? } ?>
			</div>
		</div>
		<? endforeach; ?>
	</div>
	</div>
<? } ?>
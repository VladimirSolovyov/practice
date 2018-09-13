<?
$currencies = $client->Interface->getCurrencyRate();
$curUSD = number_format((float)$currencies[2]['crt_rate'], 2, '.', ' ');
$curEURO = number_format((float)$currencies[3]['crt_rate'], 2, '.', ' ');

$auth_client = ((int)$client->cst_category_id > 0 ? true : false);

$__BUFFER->AddContent('HEADER', '<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />');
$__BUFFER->AddContent('CUSTOM_HEADER', '<meta http-equiv="X-UA-Compatible" content="IE=edge">');
$__BUFFER->AddContent('CUSTOM_HEADER', '<meta name="viewport" content="width=device-width, initial-scale=1.0">');
$__BUFFER->AddContent('CUSTOM_HEADER', '<meta name="format-detection" content="telephone=no">');
$__BUFFER->addTrJs('Ещё', 'Common');

if ($_REQUEST['fn'] == 'generateDemoPositions') {
	$CMS_API->generateDemoPositions();
}

$XML_render = new XML_DataRender();
$AutoShop = new AutoShop($_USER['adapter'], $XML_render);
$basket = $AutoShop->Basket("get", $foo);

/**@var Translate_API $trApi*/
$trApi = Loader::getApi('translate');

Loader::loadModule('ClientBreadcrumbs');
require_once(__spellPATH($_SYSTEM->LOADPAGE));
$pageContent = ob_get_clean();
$h1 = false;
if (strpos($pageContent, "<h1") === false) {
	$h1 = $_SYSTEM->getH1();
	if ($h1 == 'false') {
		$h1 = false;
	}
}
$no_text_pages = ['/search.html', '/', '/registration.html', '/activation.html', '/registration_account.html'];
?>

<body>
<div class="shadow"></div>
<div id="page" class="wrapper">
	<div class="header hidden-xs">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 header__wrapper">
					<div class="header__contact-wrapper">
						<div class="contact-item contact-item_icon_phone header__contact"><? ContentPart('contact_phone'); ?></div>
						<div class="contact-item contact-item_icon_skype header__contact"><? ContentPart('contact_skype'); ?></div>
						<div class="contact-item contact-item_icon_address header__contact"><? ContentPart('contact_address'); ?></div>
					</div>
					<div class="header__right-wrapper">
						<? echo CallModule('SITE:lng_changer', array('_tpl' => 'main')); ?>
						<div class="header__user-info hidden-sx hidden-sm">
							<? include(PHP_DataRender::includeTemplatePath('/common_templates/tpl.user_infoblock.php')); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="header-nav">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="header-nav__wrapper">
						<a href="/" class="header-nav__logo" title="<?= $_interface->MSG['Template']['webAutoResource'] ?>">
							<picture class="header-nav__picture">
								<source srcset="<?=$trApi->getImageLng('/images/template/logo-320.png')?>" media="(max-width: 768px)">
								<source srcset="<?=($logo = $trApi->getImageLng('/images/template/logo.png'))?>">
								<img class="header-nav__img" src="<?=$logo?>" alt="<?= $_interface->MSG['Template']['webAutoResource'] ?>">
							</picture>
						</a>
						<!--Begin Кнопка для показа меню-->
						<button class="btn-mobile header-nav__btn-mobile visible-xs">
							<div class="btn-mobile__line"></div>
						</button>
						<!--End Кнопка для показа меню-->
						<div class="header-nav__user-info visible-sm">
							<? include(PHP_DataRender::includeTemplatePath('/common_templates/tpl.user_infoblock.php')); ?>
						</div>
						<div class="header-nav__menu hidden-xs">
							<!--Begin Основное меню-->
							<? NavigationPart("main_menu", PHP_DataRender::includeTemplatePath("/content/tpl.main_menu.php", false), "DR_PHP"); ?>
							<!--End Основное меню-->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="header-catalog">
		<div class="header-catalog__panel">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 header-catalog__wrapper">
						<? NavigationPart("catalogs-menu-inner", PHP_DataRender::includeTemplatePath("/content/tpl.menu_catalogs.php", false), "DR_PHP"); ?>
						<? require_once 'search_form.php'; ?>
						<div class="header-catalog__right">
							<? if ($auth_client) { ?>
								<a class="orders-link hidden-xs hidden-sm header-catalog__orders-link" href="/shop/myorders.html"><?= $_interface->MSG['Template']['myOrders'] ?></a>
							<? } ?>
							<?
							if ($basket) {
								$sum = $basket->getRoundSum($basket->getCurrentCurrency(), $client->getFakePercent());
								$sumValue = $sum->value;
								$currencySign = $sum->currency->sign;
							} else {
								$currencySign = $client->Interface->displayedCurInfo['html_sign'];
								$sumValue = 0;
							}
							$sumValue = number_format($sumValue, 2, '.', ' ');
							?>
							<a class="order-amount header-catalog__basket" href="/shop/basket.html" data-field="module-basket">
								<span class="order-amount__count" data-field="module-basket-count"><?= (int)count((array)$basket->wares) ?></span>
								<span class="hidden-xs">
									<span data-field="module-basket-sum"><?= $sumValue ?></span>
									<span class="order-amount__unit"><?= $currencySign ?></span>
								</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="breadcrumbs-line" class="breadcrumbs-line" <? if (in_array($_SYSTEM->REQUESTED_PAGE, array('/', '/error404.html'))) { ?> style="display: none" <? } ?>>
		<div class="container">
			<div class="row">
				<div id="breadcrumbs-list" class="col-xs-12">
					<?= Loader::callModule('ClientBreadcrumbs') ?>
				</div>
			</div>
		</div>
	</div>

	<div class="content">
		<div id="content_inner" class="container <?=(empty($_SYSTEM->REQUEST_MASK['str_system_script']) ? 'text-decoration' : '')?> <?= (!in_array($_SYSTEM->REQUESTED_PAGE, $no_text_pages) ? 'content-page' : '') ?>">
			<? if (in_array($_SYSTEM->REQUESTED_PAGE, array('/'))): ?>
				<div class="row">
					<div class="col-xs-12 content-page__main-slider">
						<? ContentPart("slider_menu", PHP_DataRender::includeTemplatePath("/content/tpl.main-slider.php", false), "DR_PHP"); ?>
					</div>
				</div>
			<? endif; ?>
			<div class="row">
				<div class="col-xs-12">
					<? if ($h1) { ?> <h1><?= $h1 ?></h1><? } ?>

					<!--Своя разметка для определенного типа контента-->
					<? if(empty($_SYSTEM->REQUEST_MASK['str_system_script'])):?>
						<div class="row">
							<div class="col-xs-12 col-lg-9">
								<?= $pageContent ?>
							</div>
						</div>
					<? else: ?>
						<?= $pageContent ?>
					<? endif; ?>
				</div>
			</div>
		</div>
	</div>

	<footer class="footer">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 footer__container">
					<div class="footer__info-content">
						<a class="logo-footer footer__logo" href="/">
							<img src="<?=$trApi->getImageLng('/images/template/logo-footer.png')?>">
						</a>
						<div class="footer__contacts">
							<div class="footer__contact-item footer__contact-item_icon_phone"><? ContentPart('contact_phone'); ?></div>
							<div class="footer__contact-item footer__contact-item_icon_skype"><? ContentPart('contact_skype'); ?></div>
							<div class="footer__contact-item footer__contact-item_icon_address"><? ContentPart('contact_address'); ?></div>
						</div>
						<div class="payment-methods footer__payments">
							<div class="payment-methods__item">
								<img class="payment-methods__logo" src="/images/template/payments/visa.png">
							</div>
							<div class="payment-methods__item">
								<svg class="payment-methods__logo">
									<use xlink:href="/_sysimg/svg/payments-sprite.svg#mastercard"></svg>
								</svg>
							</div>
							<div class="payment-methods__item">
								<svg class="payment-methods__logo">
									<use xlink:href="/_sysimg/svg/payments-sprite.svg#yandex"></svg>
								</svg>
							</div>
							<div class="payment-methods__item">
								<img class="payment-methods__logo" src="/images/template/payments/webmoney.png">
							</div>
							<div class="payment-methods__item">
								<img class="payment-methods__logo" src="/images/template/payments/robo.png">
							</div>
							<div class="payment-methods__item">
								<svg class="payment-methods__logo">
									<use xlink:href="/_sysimg/svg/payments-sprite.svg#qiwi"></svg>
								</svg>
							</div>
							<div class="payment-methods__item">
								<svg class="payment-methods__logo">
									<use xlink:href="/_sysimg/svg/payments-sprite.svg#paypal"></svg>
								</svg>
							</div>
							<div class="payment-methods__item">
								<svg class="payment-methods__logo">
									<use xlink:href="/_sysimg/svg/payments-sprite.svg#sber"></svg>
								</svg>
							</div>
						</div>
					</div>
					<div class="footer__menu hidden-xs">
						<? NavigationPart("footer_menu", PHP_DataRender::includeTemplatePath("/content/tpl.footer_menu.php", false), "DR_PHP"); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="footer__bottom">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="pull-left copyright-company">
							<? ContentPart('footer_left'); ?>
						</div>
						<div class="pull-right copyright-our">
							<?=$_interface->MSG['Template']['copy']?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>

</div>

<div class="container-push">
	<?
	echo AutoResource_CallModule(
		"LoginFormModule",
		"module.login-form.php",
		"DR_PHP",
		null,
		"",
		$ClientCustomTemplate = "LoginFormModule"
	);
	?>
</div>

<div class="navbar-push visible-xs">
	<div class="navbar-push__inner">
		<button class="navbar-push__close btn-close-nav"></button>
		<div class="mobile-nav">
			<div class="mobile-nav__item">
				<div class="mobile-nav__header">
					<div class="mobile-nav__title"><?=truc('Меню', 'Template')?></div>
					<? if (!$auth_client): ?>
						<div class="login-btns">
							<a class="btn mobile-nav__btn-login"><?=truc('Войти', 'LoginFormModule')?></a>
							<a class="btn mobile-nav__btn-reg" href="/registration.html"><?=truc('Регистрация', 'LoginFormModule')?></a>
						</div>
					<? else: ?>
						<a class="btn mobile-nav__btn-account"><?=truc('Личный кабинет', 'LoginFormModule')?></a>
					<? endif; ?>
				</div>
				<? NavigationPart("main_menu", PHP_DataRender::includeTemplatePath("/content/tpl.mobile_menu.php", false), "DR_PHP"); ?>

				<div class="mobile-nav__footer">
					<div class="mobile-contacts">
						<div class="contact-item contact-item_icon_phone mobile-contacts__phone"><? ContentPart('contact_phone'); ?></div>
						<div class="contact-item contact-item_icon_skype mobile-contacts__skype"><? ContentPart('contact_skype'); ?></div>
					</div>
					<? echo CallModule('SITE:lng_changer', array('_tpl' => 'main')); ?>
				</div>

			</div>
			<div class="mobile-nav__item">

				<? if (!$auth_client): ?>

					<?
					echo AutoResource_CallModule(
						"LoginFormModule",
						"module.login-form.php",
						"DR_PHP",
						null,
						"",
						$ClientCustomTemplate = "LoginFormModuleMobile"
					);
					?>

				<? else: ?>
					<div class="mobile-nav__header">
						<div class="mobile-nav__title"><?=truc('Личный кабинет', 'LoginFormModule')?></div>
					</div>
					<? NavigationPart("user_menu", PHP_DataRender::includeTemplatePath("/content/tpl.user_menu_mobile.php", false), "DR_PHP"); ?>
				<? endif; ?>
				<a class="mobile-nav__btn-back"><?=truc('Назад')?></a>

			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="modal-container" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="close ico-auth-close" data-dismiss="modal" aria-label="Close">
					<span class="ico-close"></span>
				</button>
				<div class="embed-responsive embed-responsive-16by9">
					<iframe id="modal-container-frame" class="embed-responsive-item" frameborder="0"></iframe>
				</div>
				<img id="modal-container-img" class="modal__img" src="">
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function () {

		if (typeof ModuleBasket !== "undefined") {
			new ModuleBasket({
				reloadUrl: "/_ajax/basket.html",
				matchParam: "data-field='module-basket'",
				countElMatchParam: "data-field='module-basket-count'",
				sumElMatchParam: "data-field='module-basket-sum'"
			});
		}

		if (typeof SearchModule !== "undefined") {
			window.searchModule = new SearchModule({
				basketUrl: "/shop/basket.html",
				basketAddedUrl: "/_ajax/basket.html?func=add",
				checkRemains: <?=(int)$_interface->csCheckRemainsInSearch?>,
				messages: {
					setMaxAmount: "<?=tr('Данный товар доступен только в количестве %s. Поместить в корзину заказ на доступное количество?', 'SearchModule')?>",
					errorArticlePlaceholder: "<?=tr('Введите код или VIN', 'SearchModule')?>",
					providerSearch: "<?=tr('Опрашиваем поставщиков...', 'SearchModule')?>",
					providerSearchEnd: "<?=tr('Мы опросили всех поставщиков', 'SearchModule')?>",
					providerSearchShowAll: "<?=tr('Показать еще', 'SearchModule')?>",
					positionsArr: ["<?=tr('позицию', 'SearchModule')?>", "<?=tr('позиции', 'SearchModule')?>", "<?=tr('позиций', 'SearchModule')?>"]
				}
			});
		}

		<?=$__BUFFER->getJsInitText();?>

	});

</script>

</body>
window.isMobile = window.innerWidth < 768;
window.addEventListener("resize", function () {
	window.isMobile = window.innerWidth < 768;
}, false);

jqWar(document).ready(function () {

	jqWar("#popular-goods").owlCarousel({
		items: 4,
		nav: true,
		dots: false,
		itemClass: "popular-goods__owl-item owl-item",
		navClass: ["popular-goods__owl-prew owl-prev", "popular-goods__owl-next owl-next"],
		stageOuterClass: "popular-goods__outer",
		responsive: {
			0: {
				items: 2
			},
			767: {
				items: 4
			},
			1024: {
				margin: 5
			}
		}
	});

	jqWar('.js-btn-notice-demo-close').on('click', function () {
		jqWar('.notice-demo').fadeOut(300);
		document.cookie = 'noticeDemoClose=1; path=/';
	});

	function initMenuCatalogButton() {

		var button = jqWar('.menu-catalog__btn'),
			menuBlock = jqWar('.menu-catalog');
		if(button.length && menuBlock.length){
			button.on('click', function () {
				if (menuBlock.hasClass('menu-catalog--show')) {
					menuBlock.removeClass('menu-catalog--show');
					jqWar('.shadow').removeClass('shadow--open');
				} else {
					menuBlock.addClass('menu-catalog--show');
					jqWar('.shadow').addClass('shadow--open');
				}
			});

			jqWar('.shadow').on('click', function(){
				menuBlock.removeClass('menu-catalog--show');
			});
		}

	}

	initMenuCatalogButton();

	/* Begin Меню с кнопкой еще
	 --------------------*/
	setTimeout(alignMenu, 0);

	/**
	 * Обработка меню, для схлопывания элементов в пункт 'ЕЩЁ'
	 */
	function alignMenu() {
		var hideIndex = 0,
			elementsWidth = [],
			nav = jqWar(".top-nav"),
			init = false,
			elements = nav.children();

		var calcElementsWidth = function() {
			jqWar.each(elements, function () {
				var elWidth = jqWar(this).outerWidth(true);
				elementsWidth.push(elWidth);
			});
		};

		jqWar(window).resize(function () {
			var w = 0,
				maxWidthMenu = nav.width();

			if (!nav.is(':visible')) {
				return;
			}

			if (!init) {
				init = true;
				calcElementsWidth();
				nav.removeClass('top-nav--noinit');
			}

			for (var i = 0, len = elementsWidth.length; i < len; i++) {
				w += elementsWidth[i];

				if (maxWidthMenu < w) {
					if (hideIndex != i) {
						hideIndex = i;
						alignMenuRender(elements, i);
					}
					break;
				}
			}
		}).trigger('resize');
	}
	
	/**
	 * Отрисовак меню с пунктом 'ЕЩЁ'
	 *
	 * @param elements - набор пунктов меню
	 * @param index - идекс элемента, который уже не помещается в меню
	 */
	function alignMenuRender(elements, index) {
		var moreMenuHTML = '',
			hideElements = elements.slice(index - 1);

		if (hideElements.length < 1) {
			return;
		}

		jqWar(".top-nav").html(elements.slice(0, index - 1));

		jqWar.each(hideElements, function () {
			var el = jqWar(this);
			moreMenuHTML += jqWar('<div>').append(el.clone()).html();
		});

		jqWar(".top-nav").append(
			'<li href="#" class="top-nav__item top-nav__item--more hideshow">' +
			'<a class="top-nav__link" href="#">' + trJs('Ещё') + ' ' +
			'</a><ul class="sub-more">' +
			moreMenuHTML + '</ul></li>');

		jqWar(".top-nav .hideshow").click(function () {
			jqWar(this).children("ul").toggle();
		});
	}

	/* End Меню с кнопкой еще
	 --------------------*/


	/* Begin Мобильное меню
	 --------------------*/

	(function () {

		var TogglewMobileMenu = function () {

			this.css = {
				navbarInner: 'navbar-push__inner',
				navbar: 'navbar-push',
				navbarShow: 'navbar-push--open',
				navbarInnerShow: 'navbar-push__inner--show'
			};
			this.open = false;
			this.shadow = document.querySelector('.shadow');
			this.navbar = document.querySelector('.' + this.css.navbar);
			this.navbarInner = document.querySelector('.' + this.css.navbarInner);

			this.closeMenu();

		};

		TogglewMobileMenu.prototype.closeMenu = function () {

			if (this.navbarInner) this.navbarInner.classList.remove(this.css.navbarInnerShow);
			if (this.navbar) this.navbar.classList.remove(this.css.navbarShow);
			this.open = false;
			this.setShadow();

		};

		TogglewMobileMenu.prototype.openMenu = function () {

			this.navbarInner.classList.add(this.css.navbarInnerShow);
			this.navbar.classList.add(this.css.navbarShow);
			this.open = true;
			this.setShadow();

		};

		TogglewMobileMenu.prototype.toggle = function () {

			if (this.open) {
				this.closeMenu();
			} else {
				this.openMenu();
			}
		};

		TogglewMobileMenu.prototype.setShadow = function () {
			if (!this.shadow) return;
			var cl = 'shadow--open';
			if (this.open) {
				this.shadow.classList.add(cl);
			} else {
				this.shadow.classList.remove(cl);
			}
		};

		var mobMenu = new TogglewMobileMenu();

		if (mobMenu) {
			var btn = document.querySelector('.btn-mobile');
			if (btn) {
				btn.addEventListener('click', function () {
					mobMenu.openMenu();
				});
			}

			var closeBtn = document.querySelector('.navbar-push__close');
			if (closeBtn) {
				closeBtn.addEventListener('click', function () {
					mobMenu.closeMenu();
				});
			}

			var shadow = document.querySelector('.shadow');
			if (shadow) {
				shadow.addEventListener('click', function () {
					mobMenu.closeMenu();
				});
			}
		}

	})();

	jqWar('.mobile-nav__btn-back').on('click', function () {
		jqWar('.mobile-nav').removeClass('mobile-nav--forward').addClass('mobile-nav--back');
	});

	jqWar('.mobile-nav__btn-login, .mobile-nav__btn-account').on('click', function () {
		jqWar('.mobile-nav').removeClass('mobile-nav--back').addClass('mobile-nav--forward');
	});


	var mobileMenuLink = jqWar('.mobile-menu__link'),
		mobileMenuSub = jqWar('.mobile-menu-sub'),
		mobileMenuSubLink = jqWar('.mobile-menu-sub__link');

	mobileMenuLink.click(function () {
		var $this = jqWar(this);
		if ($this.next('ul').length > 0) {
			mobileMenuSub.slideUp();
			mobileMenuLink.removeClass('mobile-menu__link--active');
			$this.addClass('mobile-menu__link--active');

			if ($this.next().is(":visible")) {
				$this.next().slideUp();
				$this.removeClass('mobile-menu__link--active');
			} else {
				$this.next().slideToggle();
			}

			return false;
		} else {
			return;
		}

	});

	mobileMenuSubLink.click(function () {
		var $this = jqWar(this);
		mobileMenuSubLink.removeClass('mobile-menu-sub__link--active');
		$this.addClass('mobile-menu-sub__link--active');
	});

	/* End Мобильное меню
	 --------------------*/

	function stickyTopPanel(options){

		if(!options.panelContainer || !options.panel) return;

		this.panelContainer = options.panelContainer;
		this.panel = options.panel;
		this.cssFixedPanelClass = options.cssFixedPanelClass || 'header-catalog__panel--fixed';

		this.init();

	}

	stickyTopPanel.prototype.init = function() {

		this.stikyState = false

		var self = this;

		setTimeout(function(){
			self.setPanelHeight();
			self.setPanelOffsetTop();
		}, 0);

		document.addEventListener('scroll', function(e){

			if(window.pageYOffset >= self.panelOffsetTop){
				self.sticky();
			} else {
				self.unsticky()
			}

		})

		window.addEventListener('resize', function() {

			setTimeout(function(){
				self.setPanelOffsetTop();
			}, 0);

		});

	};

	stickyTopPanel.prototype.setPanelHeight = function() {

		this.panelHeight = this.panel.offsetHeight;

	};

	stickyTopPanel.prototype.setPanelOffsetTop = function() {

		if(this.stikyState){
			this.panelOffsetTop = this.panelContainer.offsetTop;
		} else {
			this.panelOffsetTop = this.panel.offsetTop;
		}

	};

	stickyTopPanel.prototype.sticky = function() {

		if(this.stikyState) return;

		this.panelContainer.style.height = this.panelHeight + 'px';
		this.panel.classList.add(this.cssFixedPanelClass);
		this.stikyState = true;

	};

	stickyTopPanel.prototype.unsticky = function() {

		if(!this.stikyState) return;

		this.panelContainer.style.height = 'auto';
		this.panel.classList.remove(this.cssFixedPanelClass);
		this.stikyState = false;

	};

	(function(){
		var hCatalog = document.getElementsByClassName('header-catalog')[0];
		if(hCatalog){
			var hCatalogPanel = hCatalog.getElementsByClassName('header-catalog__panel')[0];
			if(hCatalogPanel){
				var panel = new stickyTopPanel({
					panel: hCatalogPanel,
					panelContainer: hCatalog
				})
			}
		}

	})();

	/* Begin Замена картинок сортировки
	 --------------------*/

	if (document.querySelector('.web-table')) {
		jqWar('.sort_link img').each(function () {
			var className = this.getAttribute('src').slice(9).slice(0, -4);
			this.parentNode.classList.add('web-table__' + className);
		});
	}

	/* End Замена картинок сортировки
	 --------------------*/

	if (window._forms && window._forms['registration']) {

		window._forms['registration'].initCustom = function () {
			var tooltips = document.querySelectorAll("[data-tooltip]");
			for (var i = 0; i < tooltips.length; i++) {
				this.setTooltip(tooltips[i], null);
			}
			var self = this;
			var formGroupsControls = this.form.querySelectorAll('.form-gr__control');
			if (formGroupsControls) {
				formGroupsControls.forEach(function (control) {
					control.classList.add('form-gr__control--tooltip');
				});
			}
			var controls = this.form.querySelectorAll('.required');
			if (controls) {
				controls.forEach(function (control) {
					self.setRequiredParentControlClasses(control);
				});
			}
		};

		window._forms['registration'].setTooltip = function (field, tooltip, required) {

			if (!tooltip) tooltip = (field.getAttribute("data-tooltip") ? field.getAttribute("data-tooltip") : "");
			var tooltipId = field.id + "-tooltip";
			var tooltipEl = this.form.querySelector("#" + tooltipId);
			if (!tooltipEl) {
				tooltipEl = document.createElement('div');
				tooltipEl.id = tooltipId;
				tooltipEl.classList.add('form-gr__tooltip');

				var parent = jqWar(field).parents('.form-gr__control');
				if (parent.length > 0) {
					parent[0].parentNode.appendChild(tooltipEl);
				} else {
					field.parentNode.appendChild(tooltipEl);
				}
			}

			tooltipEl.innerText = tooltip;
		};

		window._forms['registration'].onElementFail = function (field, msg) {
			this.__proto__.onElementFail.apply(this, arguments);
			if (!this.ajaxCheckLoading) {
				this.setTooltip(field, msg, true);
				if (field.classList.contains('required') && field.parentNode.classList.contains('form-gr__control')) {
					this.setRequiredParentControlClasses(field);
				}
			} else {
				this.setTooltip(field, '...');
			}
		};

		window._forms['registration'].onElementSucces = function (field) {
			this.__proto__.onElementSucces.apply(this, arguments);
			this.setTooltip(field, null);
			if (field.parentNode.classList.contains('form-gr__control--required')) {
				field.parentNode.classList.remove('form-gr__control--required');
			}
		};

		window._forms['registration'].setRequiredParentControlClasses = function (control) {
			if (control.parentNode && control.parentNode.classList.contains('form-gr__control')) {
				control.parentNode.classList.add('form-gr__control--required');
			}
		};
	}

	var userMenuContainers = document.querySelectorAll(".auth-user");
	for (var i = 0; i < userMenuContainers.length; i++) {
		new UserMenu(userMenuContainers[i]);
	}

	new Ccatalogs();
	new AccordionTabs({blockPadding: 30});

	jqWar('#myModal').on('shown.bs.modal', function () {
		jqWar('#login').find('#userlogin').focus()
	})


	

	// setInterval(function(){
	// 	console.log('test');
	// 	jqWar("#filter_table").css('display','none');
	// }, 2000);
});

function Ccatalogs() {

	var self = this;
	document.addEventListener("catalog-loaded", function () {
		self.parseBreadcrumbs();
	});
}

Ccatalogs.prototype.parseBreadcrumbs = function () {
	var ul = document.querySelector("[class='way']");
	if (!ul) return;
	var originalBreadcrumbs = document.querySelector("#breadcrumbs-list .breadcrumbs");
	var breadcrumbs = [];
	for (var i = 0; i < ul.children.length; i++) {
		var link = ul.children[i].querySelector('a');
		if (link) {
			breadcrumbs.push(this.generateBreadcrumbsEl(link.innerText, link.href));
		} else {
			breadcrumbs.push(this.generateBreadcrumbsEl(ul.children[i].innerText));
		}
	}
	if (originalBreadcrumbs && breadcrumbs.length > 0) {
		var endClass = "breadcrumbs__item-end";
		var originalEndEl = document.querySelector("#breadcrumbs-list ." + endClass);
		if (originalEndEl) originalEndEl.remove();
		breadcrumbs[breadcrumbs.length - 1].classList.add(endClass);
		ul.remove();
		breadcrumbs.forEach(function (li) {
			originalBreadcrumbs.appendChild(li);
		});
	}
};

Ccatalogs.prototype.generateBreadcrumbsEl = function (text, link) {
	var li = document.createElement("li");
	li.classList.add("breadcrumbs__item");
	if (link) {
		var a = document.createElement("a");
		a.classList.add("breadcrumbs__link");
		a.href = link;
		a.innerText = text;
		li.appendChild(a);
	} else {
		li.innerText = text;
	}
	return li;
};


function AccordionTabs(options) {
	if (!options) options = {};
	this.matchSelector = options.matchSelector || "[data-accordion]";
	this.matchToogleAttr = options.matchToogleAttr || "data-accordion-toggle";
	this.matchTargetAttr = options.matchTargetAttr || "data-accordion-target";
	this.blockPadding = options.blockPadding || 0;
	this.activeHeaderClass = "accordion-tabs__link--active";
	this.activeSectionClass = "is-open";

	this.matchToogleSelector = "[" + this.matchToogleAttr + "]";
	this.tabs = [];

	this.init();
};

AccordionTabs.prototype.init = function () {
	this.baseEl = document.querySelector(this.matchSelector);
	if (!this.baseEl) return;
	var self = this;
	var toggles = this.baseEl.querySelectorAll(this.matchToogleSelector);
	for (var i = 0; i < toggles.length; i++) {
		var id = toggles[i].getAttribute(self.matchToogleAttr);
		this.tabs[id] = {
			toggle: toggles[i],
			section: this.baseEl.querySelector("[" + this.matchTargetAttr + "='" + id + "']")
		};

		toggles[i].addEventListener("click", function () {
			self.toggleClick(this.getAttribute(self.matchToogleAttr));
		});
	}
	this.onResize();
	window.addEventListener("resize", function () {
		self.onResize();
	}, false);

};

AccordionTabs.prototype.onResize = function () {
	if (window.isMobile) {
		for (var i in this.tabs) {
			if (this.tabs[i].toggle.classList.contains(this.activeHeaderClass)) {
				this.mobileShow(this.tabs[i].section);
			} else {
				this.mobileHide(this.tabs[i].section);
			}
		}
	} else {
		var isActive = false;
		for (var i in this.tabs) {
			if (this.tabs[i].toggle.classList.contains(this.activeHeaderClass)) isActive = true;
			this.tabs[i].section.style.height = "";
		}
		if(!this.tabs.length) return;
		if(!isActive) this.desktopShow(Object.keys(this.tabs)[0]);
	}
};

AccordionTabs.prototype.mobileShow = function (section) {
	section.classList.add(this.activeSectionClass);
	section.style.height = section.scrollHeight + this.blockPadding + "px";
};

AccordionTabs.prototype.mobileHide = function (section) {
	section.style.height = "0px";
	section.classList.remove(this.activeSectionClass);
};

AccordionTabs.prototype.desktopShow = function (id) {
	this.tabs[id].toggle.classList.add(this.activeHeaderClass);
	this.tabs[id].section.classList.add(this.activeSectionClass);
};

AccordionTabs.prototype.desktopHide = function (id) {
	this.tabs[id].toggle.classList.remove(this.activeHeaderClass);
	this.tabs[id].section.classList.remove(this.activeSectionClass);
};

AccordionTabs.prototype.toggleClick = function (id) {
	if (!window.isMobile) {
		for (var i in this.tabs) {
			if (i !== id) {
				this.desktopHide(i);
			} else {
				this.desktopShow(i);
			}
		}
	} else {
		for (var i in this.tabs) {
			if (i !== id) {
				this.tabs[i].toggle.classList.remove(this.activeHeaderClass);
				this.mobileHide(this.tabs[i].section);
			} else {

				if (this.tabs[i].toggle.classList.contains(this.activeHeaderClass)) {
					this.tabs[i].toggle.classList.remove(this.activeHeaderClass);
				} else {
					this.tabs[i].toggle.classList.add(this.activeHeaderClass);
				}

				if (!this.tabs[i].section.classList.contains(this.activeSectionClass)) {

					var pos = this.tabs[i].toggle.getBoundingClientRect();
					this.mobileShow(this.tabs[i].section);
					window.scrollTo(0,pos.top);
				} else {
					this.mobileHide(this.tabs[i].section);
				}
			}
		}
	}
};


function UserMenu(container) {
	this.container = container;
	this.menuSelector = ".user-menu";
	this.menuShowCss = "user-menu--show";
	this.init();
}

UserMenu.prototype.init = function () {

	this.menu = this.container.querySelector(this.menuSelector);
	if (!this.menu) return;

	var self = this;
	this.container.addEventListener("click", function () {
		self.menuToggle();
	});

	this.container.addEventListener("mouseover", function () {
		self.menuShow();
	});

	this.container.addEventListener("mouseout", function () {
		self.menuHide();
	});
};

UserMenu.prototype.menuToggle = function () {
	if (this.menu.classList.contains(this.menuShowCss)) {
		this.menuHide();
	} else {
		this.menuShow();
	}
};

UserMenu.prototype.menuShow = function () {
	this.menu.classList.add(this.menuShowCss);
};

UserMenu.prototype.menuHide = function () {
	this.menu.classList.remove(this.menuShowCss);
};

(function($) {
	//поддержка svg as external file для IE через svg4everybody
	//https://github.com/jonathantneal/svg4everybody
	var isIE = false;
	isIE = document.all && document.addEventListener;
	if(!isIE) {
		//IE11
		isIE = '-ms-scroll-limit' in document.documentElement.style && '-ms-ime-align' in document.documentElement.style;
	}
	if(isIE){
		$(document).ready(function(){
			$.ajax({
				url: "https://api.cdnjs.com/libraries/?search=svg4everybody"
			})
				.done(function(data){
					if(data.results !== undefined){
						if(data.total > 0 && data.results[0] !== undefined) {
							$.getScript( data.results[0].latest, function() {
								svg4everybody();
							});
						}
					}
				});
		});
	}
})(jqWar);
<script type="text/javascript" src="/_syslib/colorbox/jquery.colorbox.js"></script>

<script type="text/javascript">
	window.addEvent('load', function () {

		Asset.css('/_syslib/colorbox/colorbox.css');

		jqWar('table.products_model').each(function(index, element){
			item = jqWar(element).data('item');
			jqWar("table[data-item='" + item + "'] a.image").colorbox({rel:item, transition:"fade"});
		});

		var items_table = $('dc3c').getElement('.items-table');
		if ($chk(items_table)) {
			$('dc3c').getElement('.items-table').getElements('tr').each(function (tr, i) {

				if (tr.getFirst().get('tag') != 'th') {

					tr.addEvents({
						'mouseenter': function () {
							if (!tr.hasClass('mouse-over')) tr.addClass('mouse-over');
						},
						'mouseleave': function () {
							if (tr.hasClass('mouse-over')) tr.removeClass('mouse-over');
						}
					});
				}
			});
		}

	});

	<? if($this->options['use_ajax_basket'] == "Y"){ ?>

	function add_basket(id) {

		if ($('CustomerBasketId')) {

			var u = '/_ajax/basket.html?func=add&sid=' + id + '&amount=' + (_getElementById('amount-' + id) || {'value': 1}).value;

			$('CustomerBasketId').set('load', {
				evalScripts: false
			});

			$('CustomerBasketId').load(u);
			alert('<?=tr('Товар успешно добавлен в корзину','dc')?>');

		} else {

			window.location.href = '/shop/basket.html?func=add&sid=' + id + '&amount=' + (_getElementById('amount-' + id) || {'value': 1}).value;

		}
	}

	<? }else{?>

	function add_basket(id) {

		window.location.href = '/shop/basket.html?func=add&sid=' + id + '&amount=' + (_getElementById('amount-' + id) || {'value': 1}).value;

	}

	<? }?>

</script>

	<?php
	$catInfo = $this->catalog_info();

	if ($_REQUEST['search_text']) {
		require_once $this->tpl('tpl.navigation_search.php');

	} else {
		if ($catInfo['cat_techname'] !== 'tdauto') {
			require_once $this->tpl('tpl.navigation_multi.php', 'navigation');
		} 
	}

	?>


	<?php

	
	if ($catInfo['cat_techname'] === 'tdauto') {
		
		require_once $this->tpl('tpl.filters.php', 'filters');
		require_once $this->tpl('tpl.car_params.php', 'car_params');
	} else {
		if ($_REQUEST['id']) {
			require_once $this->tpl('tpl.item_info.php');
		} else { 
			?>
			<div class="dc-items-wrap">
				<?require_once $this->tpl('tpl.filters.php', 'filters')?>
				<?require_once $this->tpl('tpl.items_showcase.php', 'items_list')?>
			</div>
			<?
		}
	}

	?>
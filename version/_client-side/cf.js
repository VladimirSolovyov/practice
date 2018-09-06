function bindSEvent(obj, eventName, func) {
	
		if (document.attachEvent)
			obj.attachEvent("on"+eventName, func);
		else if (document.addEventListener) {
			obj.addEventListener(eventName, func, 0);
		}
	
}

function isIE6(){
	var browser = navigator.appName;
	if (browser == "Microsoft Internet Explorer"){
		var b_version = navigator.appVersion;
		var re = /\MSIE\s+(\d\.\d\b)/;
		var res = b_version.match(re);
		if (res[1] <= 6){
			return true;
		}
	}
  return false;
}

function getWidth(id) {
	
	return (document.getElementById(id).scrollWidth > document.getElementById(id).offsetWidth)?document.getElementById(id).scrollWidth:document.getElementById(id).offsetWidth;
		
}

function getWidthByObj(obj) {
	
	return (obj.scrollWidth > obj.offsetWidth)?obj.scrollWidth:obj.offsetWidth;
		
}

function getMinWidth(id) {
	
	return (document.getElementById(id).scrollWidth < document.getElementById(id).offsetWidth)?document.getElementById(id).scrollWidth:document.getElementById(id).offsetWidth;
		
}

function getWidthByObj(obj) {
	
	return (obj.scrollWidth > obj.offsetWidth)?obj.scrollWidth:obj.offsetWidth;
		
}

function getSumWidth(els) {
	
	var sumWidth = 0;
	$$(els).each(function(elm) {
		sumWidth = sumWidth + getWidthByObj(elm);
	});
	
	return sumWidth;
	
}


function fixWidth() {
	//bindSEvent(window, 'load', setWidth);
	//bindSEvent(window, 'resize', setWidth);
}

//bindSEvent(window, 'load', setWidth);
//bindSEvent(window, 'resize', setWidth);

//window.addEvent('load', setWidth);

function replaceSelect(el) {
	new DropDownList({el: el, replaceSelect: true});
}

function initTipz() {
	if (typeof Tips !== "undefined") {
		jqWar('.tipz').map(function (index, element) {
			var content = element.title;
			element.store('tip:title', '');
			element.store('tip:text', content);
		});

		var tipz = new Tips('.tipz', {
			fixed: false,
			hideDelay: 50,
			showDelay: 50
		});
	}
}

jqWar(document).ready(function() {
	setTimeout(function () {
		if (jqWar('.tipz').length > 0) {
			initTipz();
		}
	}, 1000);
});

function getWidthForce(el) {
	var size = el.measure(function(){
		return this.getSize();
	});

	return size.x;
}

function getHeightForce(el) {
	var size = el.measure(function(){
		return this.getSize();
	});

	return size.y;
}

function tryForFree(flTry) {
	flTry = flTry||1;
	TINY.box.show({
		iframe: '/?try='+flTry,
		width: 505,
		height: 238,
		animate: false,
		close: true,
		opacity: 50
	});
}


function showRequestForm() {
	tryForFree(100);
}

/* Begin Живой поиск
--------------------*/

function setSearchAutocompleteField(selector, useBrand) {

	if (!jqWar(selector).length || jqWar(selector).closest('#search_table').length) {
		return false;
	}

	jqWar(selector).after('<input type="hidden" name="live_search" value="1" />');

	var hideLiveSearch = window.hideLiveSearch;
	jqWar["ui"]["autocomplete"].prototype._renderMenu = function(ul, items) {
		if (hideLiveSearch) {
			hideLiveSearch = false;
			return;
		}
		var self = this;
		//table definitions
		ul.append("<div class='search-live__scroll'><table class='search-live__table'><tbody></tbody></table></div>");
		jqWar.each( items, function( index, item ) {
			self._renderItemData(ul, ul.find("table tbody"), item );
		});
	};
	jqWar["ui"]["autocomplete"].prototype._renderItemData = function(ul,table, item) {
		return this._renderItem( table, item ).data( "ui-autocomplete-item", item );
	};
	jqWar["ui"]["autocomplete"].prototype._renderItem = function(table, item) {
		if (item.source == 'more') {
			return jqWar("<tr class='search-live__row ui-menu-item ui-menu-item-more' role='presentation'></tr>")
				.data("item.autocomplete", item)
				.append("<td class='search-live__col' colspan='3'>" + item.comment + "</td>")
				.appendTo(table);
		} else if (item.source == 'vin') {
			return jqWar("<tr class='search-live__row ui-menu-item ui-menu-item-vin' role='presentation'></tr>")
				.data("item.autocomplete", item)
				.append("<td class='search-live__col' colspan='3'><a>" + item.comment + "</a></td>")
				.appendTo(table);
		} else if (item.source == 'vin2') {
			return jqWar("<tr class='search-live__row ui-menu-item ui-menu-item-vin' role='presentation'></tr>")
				.data("item.autocomplete", item)
				.append("<td class='search-live__col' colspan='3'>" + item.comment + "</td>")
				.appendTo(table);
		} else {
			return jqWar("<tr class='search-live__row ui-menu-item' role='presentation'></tr>")
				.data("item.autocomplete", item)
				.append("<td class='search-live__col'><a>" + item.code + "</a></td>" + "<td class='search-live__col'><a>" + item.prd_name + "</a></td>" + "<td class='search-live__col'><a>" + item.comment + "</a></td>")
				.appendTo(table);
		}
	};
	var termTemplate = "<strong>%s</strong>";
	jqWar(selector).after('<div id="loading_search" style="display:none;"></div>');
	jqWar(selector).autocomplete({
		source: "/json/sphinx-search/",
		minLength: 2,
		search: function(){
			hideLiveSearch = window.hideLiveSearch;
			jqWar('#loading_search').css("display","block");
		},
		open: function(e,ui) {
			jqWar('#loading_search').css("display","none");
		},
		close: function(e,ui) {
			jqWar('#loading_search').css("display","none");
		},
		response: function(e,ui) {
			jqWar('#loading_search').css("display","none");

		},
		select: function(event, ui) {
			event.preventDefault();
			if (ui.item != undefined && ui.item.code != '') {
				try {
					jqWar('form[name="search_code"] input[name=article]').val(ui.item.code);
					if (useBrand) {
						if (jqWar('form[name="search_code"] input[name=brand]').length == 0) {
							jqWar('form[name="search_code"] input[name=article]').after('<input name="brand" type="hidden" value="' + ui.item.prd_name + '" />');
						} else {
							jqWar('form[name="search_code"] input[name=brand]').val(ui.item.prd_name);
						}
					}
					jqWar('form[name="search_code"]').submit();
					setTimeout(function () {
						jqWar('form[name="search_code"] input[name=brand]').val('');
					}, 0);
				} catch (e) {
				}
			} else {
				jqWar('form[name="search_code"]').submit();
				event.stopPropagation();
				return false;
			}
		},
		messages: {
			noResults: '',
			results: function() {}
		},
		appendTo: ".search-live__inner"
	}).focus(function () {
		if (!jqWar(selector).length || jqWar(selector).closest('#search_table').length) {
			return false;
		}
		jqWar(selector).autocomplete("search", jqWar(selector).val());
	});
}

/* End Живой поиск
--------------------*/

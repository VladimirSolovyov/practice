;(function($) {
	$.fn.fixMe = function(cssFixedClass) {
		return this.each(function() {
			var $this = $(this),
				$t_clone,
				$t_fixed;
			function init() {
				$t_fixed = $this.find("thead");
				$t_clone = $t_fixed.clone(true, true);
				$t_clone.find('[name]').removeAttr('name');
				$t_fixed.before($t_clone);
				resizeFixed();
			}
			function resizeFixed() {
				$t_clone.show();
				$t_fixed.addClass(cssFixedClass);
				$t_fixed.find("th").each(function(index) {
					$(this).css("width",$t_clone.find("th").eq(index).outerWidth()+"px");
				});
				$t_clone.hide();
				$t_fixed.removeClass(cssFixedClass);
			}
			function scrollFixed() {
				var offset = $(this).scrollTop(),
					tableOffsetTop = $this.offset().top,
					tableOffsetBottom = tableOffsetTop + $this.height() - $t_fixed.height();
				if(offset < tableOffsetTop || offset > tableOffsetBottom){
					$t_fixed.removeClass(cssFixedClass);
					$t_clone.hide();
				} else if(offset >= tableOffsetTop && offset <= tableOffsetBottom && $t_clone.is(":hidden")){
					$t_fixed.addClass(cssFixedClass);
					$t_clone.show();
				}
			}
			$(window).resize(resizeFixed);
			$(window).scroll(scrollFixed);
			init();
		});
	};

	$(document).ready(function(){
		if($("table.search-results--fixed[fix-thead]").length) {
			$("table.search-results--fixed[fix-thead]").fixMe('search-header__thead--fixed');
		}
	});

})(jqWar);
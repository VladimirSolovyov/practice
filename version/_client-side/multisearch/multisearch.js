jqWar(document).ready(function() {
	jqWar('#group_search_new, .xls_button').click(function() {
		open_tbox_frame('/group-search/', 900, 500);
		return false;
	});
});

;(function($) {

	$.fn.mscCustomFileinput = function() {
		return this.each(function() {
			var $this = $(this),
				noJsClass = 'msc-fileinput-custom--nojs',
				fileInputClass = 'msc-fileinput-custom__input',
				textValueClass = 'msc-fileinput-custom__text-value',
				$fileInput,
				$textValue,
				defText;
			function addValueEventChange(getValEL, setValEl){
				getValEL.change(function(){
					var value = getValEL.val();
					if(value !== '') setValEl.html(value);
					else setValEl.html(defText);
				});
			}
			function init() {
				$fileInput = $this.find('.'+fileInputClass);
				$textValue = $this.find('.'+textValueClass);
				if($fileInput.length && $textValue.length){
					defText = $textValue.val();
					if($this.hasClass(noJsClass)) $this.removeClass(noJsClass);
					addValueEventChange($fileInput, $textValue);
				}
			}
			init();
		});
	};

	$(document).ready(function(){

		if($('[msc-fileinput]').length) {
			$('[msc-fileinput]').mscCustomFileinput();
		};
	});

})(jqWar);
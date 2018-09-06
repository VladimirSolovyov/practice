jQuery.noConflict();
function checkEnterKey(e) {

	if(e){
		_char = e.keyCode;
	}else{
		_char = window.event.keyCode;
	}

	if (_char == 13) return false;
	return true;

}
function searchRetPos(id) {
	jQuery('input[name="ref_id"]').val(id);
	$('pst_info').set('html','<img src="/_sysimg/ajax-loader.gif" style="margin: 0 auto;display: block;" />');
	$('pst_info').load('/shop/ajax-search-pst-return.html?ref_id='+id);
}
function searchRetPosArticle(article) {
	$('pst_info').set('html','<img src="/_sysimg/ajax-loader.gif" style="margin: 0 auto;display: block;" />');
	$('pst_info').load('/shop/ajax-search-pst-return.html?article='+article);
}

jQuery(function () {
	if(jQuery('input[name="ref_id"]')) {
		jQuery('input[name="ref_id"]').keypress(function (event) {
			if (event.which == '13') {
				event.preventDefault();
				searchRetPos(this.value);
			}
		});
	}
	if(jQuery('input[name="article"]')) {
		jQuery('input[name="article"]').keypress(function (event) {
			if (event.which == '13') {
				event.preventDefault();
				searchRetPosArticle(this.value);
			}
		});
	}
	var rtc_csc_id = jQuery('input[name="rtc_csc_id"]').attr('id', 'rtc_csc_id');
	rtc_csc_id.parent().parent().attr('id', 'tr_rtc_csc_id');
	jQuery('input[name="rtc_csc_id_viewState"]').attr('id', 'rtc_csc_id_viewState');
	if(!jQuery('input[name="rtc_csc_id_viewState"]').val()) {
		jQuery('input[name="rtc_csc_id_viewState"]').val('Нажмите для открытия справочника');
	}
	if(jQuery('select[name="rtc_reason"]').val() > 1) {
		$("tr_rtc_csc_id").setStyle("display", "none");
	}
});

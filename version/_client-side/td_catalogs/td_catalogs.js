function changeTD() {

	new Request({
		'url': '/_ajax/td-catalogs/?td_year='+$('td_year').value+'&td_brd_id='+$('td_brd_id').value+'&td_mdl_id='+$('td_mdl_id').value+'&td_mdf_id='+$('td_mdf_id').value,
		'method': 'get',
		'evalScripts': true,
		onSuccess: function(responseText, responseXML){
			response = JSON.parse(responseText);
			$('div_td_year').set('html', response.td_year);
			$('div_td_brd_id').set('html', response.td_brd_id);
			$('div_td_mdl_id').set('html', response.td_mdl_id);
			$('div_td_mdf_id').set('html', response.td_mdf_id);
			replaceSelect($('td_year'));
			replaceSelect($('td_brd_id'));
			replaceSelect($('td_mdl_id'));
			replaceSelect($('td_mdf_id'));
			$('img_td_car').set('src', response.img_td_car);
			$$('.td_field').removeClass('active');
			if(response.active != '') {
				$('td_field_'+response.active).addClass('active');
			}
			$('td_links').set('html', response.catalogs);
		}
	}).send();

}
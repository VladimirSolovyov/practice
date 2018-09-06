
window.addEvent('domready', function() {

	jqWar( "#percent" ).keyup(function() {
		jqWar("#percent_koef").val( calculate_koef( jqWar(this).val() ) );
	});

	jqWar( "#percent_koef" ).keyup(function() {
		jqWar("#percent").val( calculate_percent( jqWar(this).val() ) );
	});

	jqWar( "#client_percent" ).keyup(function() {
		jqWar("#client_percent_koef").val( calculate_koef( jqWar(this).val() ) );
	});

	jqWar( "#client_percent_koef" ).keyup(function() {
		jqWar("#client_percent").val( calculate_percent( jqWar(this).val() ) );
	});

});

function calculate_koef(percent){
	
	if(percent>'' && percent==(percent*1)){
		var koef = percent/100+1;
		return koef.round(4);
	}
	return '';
}
function calculate_percent(koef){
	if(koef>'' && koef==(koef*1)){
		var percent = koef*100-100;
		return percent.round();
	}
	return '';
}
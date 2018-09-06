jQuery(function () {
	'use strict';

	//стилизуем кнопку мультизагрузки файла формы
	jQuery('input[name=tmpfile]').ready(function (e, s) {
		Selfprice.FileUpload.init('tmpfile', 'prl_file');
	});

	//-----------------------------------------
	jQuery('select[name=prl_auto_type]').change(function () {
		Selfprice.show_group(jQuery(this).val());
	});

	jQuery('select[name=prl_auto_type]').ready(function (e, s) {
		Selfprice.show_group(jQuery('select[name=prl_auto_type]').val());
	});

	jQuery('select[name=load_mode]').ready(function (e, s) {
		Selfprice.config_init();
	});

	jQuery(".tooltip").tooltip({tooltipClass: "selfprice-tooltip"});


	//pзагрузка файла с источника
	jQuery('input[name=load_from_source]').click(function () {
		Selfprice.FileSourceUpload.loadFile();
	});
	
	jQuery('input[name=checkPos_all]').click(function () {
		jQuery('input.CheckBox').prop('checked',jQuery(this).prop('checked'));
	});

	if(jQuery("#spr_rule_id option:selected").size()) {
		changeRuleTooltip();
		jQuery("#spr_rule_id").change(function() { changeRuleTooltip() });
	}

	jQuery("span[data-get_json]").each(function(){

		var elem = jQuery(this);
		var data = {};

		data.get_json = elem.data("get_json");

		if (elem.data("mailserver")) {
			data.mailserver = elem.data("mailserver");
		}

		jQuery.ajax({
			data: data,
			dataType: "json",
			success: function(data) {

				var status = "<span style='color:red'>" + trJs("отсутсвует") + "</span>";

				if (data.result === true) {

					status = "<span style='color:green'>" + trJs("доступен") + "</span>";
				}

				elem.parent("td").parent("tr").find("td:last").html(status);

				if (typeof(data.result) !== "boolean") {

					var value = data.result;
					elem.parent("td").parent("tr").find("td:eq(1)").html(value);
				}
			}
		})

	})

});


function changeRuleTooltip() {
	var tooltipText = jQuery("#spr_rule_id option:selected").text();
	var N = jQuery("#spr_rule_value").val();
	var V = jQuery("#spr_replace_value").val();

	if (!N) {
		N = 5
	}
	if (!V) {
		V = 3
	}

	tooltipText = tooltipText.replace("N", N).replace("V", V);

	jQuery("#spr_rule_id").parent("td").prev("td").find("img.tooltip").prop("title", tooltipText);
}


/**
 * блокируем поле значения при выборе опред.колонок
 * @param {type} fields
 * @returns {undefined}
 */
function block_field(fields, fields2, value) {

	block_field_view("spr_replace_value");
	block_field_view("spr_rule_value");

	for (i in fields) {
		if (fields[i] == value) {
			block_field_blocked("spr_rule_value");
		}
	}
	for (i in fields2) {
		if (fields2[i] == value) {
			block_field_blocked("spr_replace_value");
		}
	}

}

/**
 * Открываем поле
 * @param {type} name
 * @returns {undefined}
 */
function block_field_view(name) {
	var o = jQuery("#" + name);
	o.parents("tr").show();
}

/**
 * скрываем поле
 * @param {type} name
 * @returns {undefined}
 */
function block_field_blocked(name) {
	var o = jQuery("#" + name);
	o.parents("tr").hide();
}













/**
 * базовый класс
 *
 */
var Selfprice = {
	url: '/selfprice/',
	/**
	 * отображение вкладки настроек источника
	 * @param string g источник
	 */
	show_group: function (g) {

		//показываем скрываем кнопку загрузки источника, в форме загрузки формы есть своя
		if (g == 'none') {
			jQuery('input[name=load_from_source]').parent().parent().hide();
		}
		else {
			jQuery('input[name=load_from_source]').parent().parent().show()
		}

		jQuery('.tabclosed').hide();

		jQuery('#' + g).toggle(g);

	},
	/**
	 * скрытие отображение строк в таблице
	 * @param  num номер строки
	 */
	display_skipstr_num: function (s) {
		for (i = 0; i < 30; i++) {

			if (i >= s) {
				$$('#tr' + i).removeClass('mouseover')
			}

			else {
				$$('#tr' + i).addClass('mouseover')
			}

		}
	},
	/**
	 * Оформление вторичных обязательных полей которые меняются от настройки режима
	 * @param {type} s
	 * @returns {undefined}
	 */
	display_requere_second: function (s) {
		var c0 = $$('.for_type_col_detail_code');
		var c1 = $$('.for_type_col_artikul_provider');

		c0.setStyle('color', '#000')
		c1.setStyle('color', '#000')
		if (s == 0) {
			c0.setStyle('color', 'red')
		}
		else {
			c1.setStyle('color', 'red')
		}
},
	/**
	 * инициализация конфига
	 * @returns {undefined}
	 */
	config_init: function () {

//		var selects = jQuery('.controlA');
//
//		selects.change(function () {
//			var value = jQuery(this).val();
//			selects.each(function (el) {
//
//				if (el.value == value)
//					el.value = '';
//			});
//			this.value = value;
//		});

		//------------
		jQuery('#encoding').change(function () {
			var reg = /(&encoding=.*?$)/g;
			var url = location.href;
			location.href = url.replace(reg, '') + '&encoding=' + this.value
		});

		//событие на смену кол-во строк для отображения
		jQuery('#skipstr_num').change(function () {
			Selfprice.display_skipstr_num(this.value);
		});		

		//событие на смену кол-во строк для отображения
		jQuery('#stc_id').change(function () {
			if (this.value > 0) {
				jQuery('#fl_in_stock-wrapper').css('display', '');
			} else {
				jQuery('#fl_in_stock-wrapper').css('display', 'none');
			}
		});

		//при загрузке страницы скроем строки
		if (jQuery('#skipstr_num').val() > 0) {
			Selfprice.display_skipstr_num(jQuery('#skipstr_num').val());
		}

		//--------------
		jQuery('#load_mode').change(function () {
			Selfprice.display_requere_second(this.value);
		});

		Selfprice.display_requere_second(jQuery('#load_mode').val());
		
		jQuery('#sheet').change(function () {
			var reg = /(&sheet=.*?$)/g;
			var url = location.href;
			location.href = url.replace(reg, '') + '&sheet=' + this.value
		});

	}

};



/**
 * Класс загрузки файла с формы
 */
Selfprice.FileUpload = {
	init: function (input, inputfile) {

		var input = jQuery('input[name=' + input + ']');
		var inputfile = jQuery('input[name=' + inputfile + ']');

		var div = document.createElement('div');

		var parentTD = input.parent();

		jQuery(parentTD).children('table').hide();

		parentTD.prepend('<span class="btn btn-success fileinput-button">');
		jQuery('.fileinput-button').html('<i class="glyphicon glyphicon-plus"></i>' +
				'<span>'+trJs('Выбрать файл')+'</span>');


		var button = jQuery('.submitButton');
		button.before('<div class="progress" id="progress">');
		jQuery('#progress').append('<div class="progress-bar progress-bar-success">');

		jQuery('.fileinput-button').append(input);
		//---------------

		//load_from_source


		//-------------------
		var url = Selfprice.url;

		input.fileupload({
			url: url + '?fn=form_load_file',
			dataType: 'json',
			maxChunkSize: 8000000, //8mb
			done: function (e, data) {

				var name = input.attr('name')

				//	console.log(name,data.result[name]);

				jQuery.each(data.result[name], function (index, file) {

					if (file.error > '') {
						alert(file.error);
						jQuery('.progress-bar').css('width', 0);
					}
					else if (file.name == '') {
						alert('Ошибка при загрузке файла');
					}
					else {

						//alert('Файл '+file.name+' успешно загружен');
						//var td = parentTD.find('td')[0];
						//jQuery(td).text(file.name);
						inputfile.val(file.name);

						jQuery('.submitButton').show();
						jQuery('#progress').hide();
					}
				});
			},
			progressall: function (e, data) {
				var progress = parseInt(data.loaded / data.total * 100, 10);
				jQuery('.progress-bar').css(
						'width',
						progress + '%'
						);
			},
			fail: function (e, data) {
				alert('Ошибка при загрузке файла');
			},
			start: function (e, data) {
//				jQuery.post(url + '?fn=prepare_tmpdir', function (data) {
//				});
				jQuery('#progress').show();
				jQuery('.submitButton').hide();
			}

		}).prop('disabled', !jQuery.support.fileInput)
				.parent().addClass(jQuery.support.fileInput ? undefined : 'disabled');

	}

};





/**
 * Класс файлового загрузчика
 * @type type */
Selfprice.FileSourceUpload = {
	/**
	 * скрываем контролы
	 * @returns {undefined}
	 */
	hideControl: function () {

		jQuery('#progress').show();

		jQuery('input[name=load_from_source]').prop("disabled", true).css('opacity', 0.5);

		//jQuery('.submitButton').hide();
		jQuery('.submitButton').prop("disabled", true).css('opacity', 0.5)
		jQuery(".progress-bar").css('width', '0px').html('');
	},
	/**
	 * показываем контроллы
	 * @returns {undefined}
	 */
	showControl: function () {

		jQuery('input[name=load_from_source]').prop("disabled", false).css('opacity', 1);

		jQuery('#progress').hide();
		jQuery('input[name=upload_status]').val('');
		jQuery(".progress-bar").css('width', '0px').html('');

		jQuery('.submitButton').prop("disabled", false).css('opacity', 1);
	},
	/**
	 * готовность загрузки файла
	 * @returns {undefined}
	 */
	complete: function (tmpfile) {

		jQuery(".progress-bar").animate({
			width: "100%",
		}, 1500, "linear", function () {

			jQuery('input[name=prl_file]').val(tmpfile);

			Selfprice.FileSourceUpload.showControl();
		});


	},
	progress: function (comment) {
		var p = jQuery("#progress").css('width');
		var w = jQuery(".progress-bar").css('width');

		var re = /\D+/;

		var s = w.replace(re, '') * 1;

		var p = p.replace(re, '') * 1;

		var wi = s < (p - 21) ? (s + 20) : s;

		//console.log('>',w,wi,s)
		jQuery(".progress-bar").html('загружено ' + comment);

		jQuery(".progress-bar").animate({
			width: wi + "px",
		}, 5000);
	},
	/**
	 *  в случае ошибки
	 * @returns {undefined}
	 */
	error: function (msg) {
		alert(msg);
		this.showControl();
	},
	/**
	 * загрузка файла с источника
	 * @returns {undefined}
	 */
	loadFile: function () {

		if (!confirm('Загрузить файл из источника?'))
			return false;

		var data = {};

		this.hideControl();

		jQuery(".progress-bar").animate({
			width: "30%",
		}, 5000, "linear", function () {

			//jQuery( ".progress-bar" ).html('загрузка..');
		});


		jQuery('.tabclosed:visible input').each(function (e) {
			data[this.name] = this.value;
		})
		jQuery('.tabclosed:visible select').each(function (e) {
			data[this.name] = this.value;
		})		
		
		data['__prl_id__'] = jQuery('input[name=__prl_id__]').val();

		data['prl_prv_id'] = jQuery('select[name=prl_prv_id]').val();

		var jqxhr = jQuery.ajax({
			url: "/selfprice/?fn=load_from_source",
			data: data,
			dataType: 'json',
			method: 'post'
		})
				.done(function (e) {

					if (e.error > '') {

						alert('Ошибка! ' + e.error);

						Selfprice.FileSourceUpload.showControl();

						return;
					}

					switch (e.result) {
						case 'start_process_success':

							jQuery('input[name=upload_status]').val(e.filedir);

							break;
					}

				})
				.fail(function () {
					alert("сервер времено не доступен");

					Selfprice.FileSourceUpload.showControl();
				})
				.always(function () {
					//alert( "complete" );

				});
		//console.log(data)		

	}


};



/**
 * Прогресс бар
 * @type type */
Selfprice.Progress = {
	conteiner: '#taskshedule_conteiner',
	render: function (html) {
		jQuery(this.conteiner).html(html);
	},
// задаем свойства объекта
	updInterval: 10000, // 10 сек. - интервал времени между запросами
	url: 'ajax.php', // скрипт который должен отвечать на Ajax запросы
	init: function (url) {
		Selfprice.Progress.url = url;
		var self = Selfprice.Progress;


		//console.log('request')
		setTimeout(jQuery.proxy(self.requestData, self), self.updInterval);
		//setInterval(jQuery.proxy(ajax_req.requestData, self), self.updInterval);
	},
	requestData: function () {
		var self = Selfprice.Progress;
		var _data = false;

		//	console.log('requestData');

		if (jQuery('#upload_status').val() > '') {
			var _data = {
				'load_from_source': jQuery('#upload_status').val()
			}
		}
		else if (jQuery('*').is(self.conteiner)) {
			var _data = {
				'schedule_status': true
			}
		}


		if (_data != false) {
			// ajax запрос посредством JQuery на проверку статуса
			jQuery.ajax({
				url: self.url,
				type: 'POST',
				data: _data,
				dataType: 'json',
				success: function (data) {

					//выполняем js скрипт если он есть
					if (data.eval > '')
						eval(data.eval);

					self.update();
				},
				error: function (data) {
					self.error(data)
				},
			});
		}
		else {
			self.update();
		}

	},
// метод принимает ответ на Ajax запрос
	update: function () {
		var self = Selfprice.Progress;
		setTimeout(jQuery.proxy(self.requestData, self), self.updInterval);
	},
// метод для обработки ошибок
	error: function (Data) {
		var self = Selfprice.Progress;
		//alert('Failed to get data');
	},
}
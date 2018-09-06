/**
 * Created by s.kostylev on 10.02.2017.
 */

function translit(text) {
	var space = '';
	text = trim(text.toLowerCase());

	var mapTranslite = {
		'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'e', 'ж': 'zh',
		'з': 'z', 'и': 'i', 'й': 'j', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n',
		'о': 'o', 'п': 'p', 'р': 'r', 'с': 's', 'т': 't', 'у': 'u', 'ф': 'f', 'х': 'h',
		'ц': 'c', 'ч': 'ch', 'ш': 'sh', 'щ': 'sh', 'ъ': space, 'ы': 'y', 'ь': space, 'э': 'e', 'ю': 'yu', 'я': 'ya',
		' ': '-', '_': space, '`': space, '~': space, '!': space, '@': space,
		'#': space, '$': space, '%': space, '^': space, '&': space, '*': space,
		'(': space, ')': space, '-': space, '\=': space, '+': space, '[': space,
		']': space, '\\': space, '|': space, '/': space, '.': space, ',': space,
		'{': space, '}': space, ';': space, ':': space,
		'?': space, '<': space, '>': space, '№': space
	};

	var result = '';
	var current = '';
	var tmp = '';

	for (var i = 0; i < text.length; i++) {
		if (!isNaN(parseInt(text[i]))) {
			tmp = parseInt(text[i]);
		} else if(mapTranslite[text[i]] != undefined){
			tmp = mapTranslite[text[i]];
		}

		if (current != tmp || current != space) {
			result += tmp;
			current = tmp;
		}
	}
	return result;
}

document.addEventListener('DOMContentLoaded', function () {
	var btnGenerate = document.getElementsByName('generate_url');
	if (btnGenerate.length > 0) {
		btnGenerate[0].addEventListener("click", function () {
			var nameField = document.getElementById("stc_name");
			if (nameField) {
				document.getElementById("stc_match_url").value = translit(nameField.value);
			} else {
				nameField = document.getElementById("stm_user_login");
				if(nameField) {
					document.getElementById("stm_match_url").value = translit(nameField.value.substr(0, nameField.value.indexOf("(") - 1));
				}
			}
		});
	}
	var btns = document.getElementsByName('find_coordinates');
	if (btns.length > 0) {
		btns[0].addEventListener("click", function () {
			var cityField = document.getElementById("add_city_id");
			if (!cityField.selectedIndex) {
				alert(trJs("Выберите город"));
				return;
			}
			var city = cityField.options[cityField.selectedIndex].text;
			var address = city + "," + document.getElementById("stc_address").value;
			var btn = this;
			btn.disabled = true;
			var btnMsg = this.value;
			btn.value = trJs("поиск...");
			jqWar.get("https://geocode-maps.yandex.ru/1.x/?format=json&geocode=" + address, function (res) {
				if (res.response) {
					var position = res.response.GeoObjectCollection.featureMember[0].GeoObject.Point.pos;
					var coordinates = position.split(" ");
					document.getElementById("stc_coordinates").value = coordinates[1] + "," + coordinates[0];
				} else {
					alert(trJs("Ошибка при поиске координат"));
				}
			}).fail(function () {
				alert(trJs("Ошибка при поиске координат"));
			}).always(function () {
				btn.disabled = false;
				btn.value = btnMsg;
			});
		});
	}
});

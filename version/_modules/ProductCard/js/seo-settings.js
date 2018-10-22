/**
 * Created by s.kostylev on 22.03.2017.
 */
document.addEventListener("DOMContentLoaded", function (event) {

	function switchArticle(section) {
		var codeEl = document.getElementById('code');
		var codeElParent = false;
		if (codeEl) codeElParent = codeEl.parentElement.parentElement;
		var nameEl = document.getElementById('name');
		var nameElParent = false;
		if (nameEl) nameElParent = nameEl.parentElement.parentElement;

		if (codeElParent) {
			if (section == "product_card") {
				codeElParent.style.display = "none";
				if (nameElParent) nameElParent.style.display = "none";
			} else {
				codeElParent.style.display = "";
				if (nameElParent) nameElParent.style.display = "";
			}
		}
	}

	var sectionEl = document.getElementById('srl_table');
	if (sectionEl) {
		switchArticle(sectionEl.value);
		sectionEl.onchange = function () {
			switchArticle(this.value);
		}
	}

});
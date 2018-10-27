<?

//	класс настроек интерфейса

class LOCAL_InterfaceConfig extends AutoResource_InterfaceConfig {

	function makePassswordFields(&$form) {

		parent::makePassswordFields($form);

		if ($form->name == 'registration' && $form->hasField('userpassword')) {
			$this->buffer->addScript('/_client-side/module.EyePassword.js');

			js("
				document.addEventListener(`DOMContentLoaded`, function () {
					if(typeof EyePassword !== `undefined`) {
						var userpassword = document.getElementById('userpassword');
						if(userpassword) {
							var ps = new EyePassword({
								container: userpassword.parentNode,
								input: userpassword
							});
						}
					}
				});
			");
		}

	}

	/**
	 * генерации ссылки печати для таблиц
	 *
	 * @param string      $dcm_field
	 * @param null|string $target
	 * @param bool|string $doc_id
	 * @param bool        $useMd5
	 * @param bool        $protected - защищенная печать
	 *
	 * @return cProtectedLink|string
	 */
	public function returnPrintColumnLink($dcm_field = "dcm_id", $target = null, $doc_id = false, $useMd5 = true, $protected = true) {

		$printLink = parent::returnPrintColumnLink($dcm_field, $target, $doc_id, $useMd5, $protected);
		if (!empty($printLink) && !ADMIN_PAGE) {
			if ($doc_id) {
				$printLink->setAttribute("data-show-modal<%#" . $doc_id . "%>");
			} else {
				$printLink->setAttribute("data-show-modal");
			}
			$printLink->setAttribute("data-width", "455");
			$printLink->setAttribute("data-height", "325");
		}

		return $printLink;
	}

	/**
	 * построение формы регистрации
	 *
	 * @param CustomForm $form
	 * @param bool       $adminEdit
	 */
	function makeRegistrationForm(&$form, $adminEdit = false) {

		parent::makeRegistrationForm($form, $adminEdit);

		if ($this->system->URI === '/registration.html') {
			foreach (['add_country_id', 'add_region_id', 'add_city_id'] as $fieldName) {
				if (!empty($form->fields_assoc[$fieldName])) $form->fields_assoc[$fieldName]['required'] = false;
			}
		}

	}

	function modifyCustomForm(&$form) {

		switch ($form->name) {

			case 'basket':

				if (($this->system->REQUESTED_PAGE === '/admin/eshop/basket.html') && $form->fields_assoc['add']) {

					unset($form->fields_assoc['add']['instance']->events['onclick']);
					$form->fields_assoc['add']['instance']->bindEvent("onclick", "window.location = '/admin/eshop/utils/search.html'; return false;");

				}

				break;

		}

	}

	function modifyForm(&$form) {

		switch ($form->name) {

			case 'positions':

				if (($this->system->REQUESTED_PAGE === '/admin/eshop/orders/positions_list.html') && ($_REQUEST['fn'] == 'add') && !empty($_REQUEST['pst_ord_id']) && !isset($_REQUEST['send']) && !isset($_REQUEST['sid']) && !isset($_REQUEST['pst_id'])) {
					header("Location: /admin/eshop/utils/search.html?fn=add&pst_ord_id=" . intval($_REQUEST['pst_ord_id']));
				}
				break;

		}

	}

	function modifyClientOrderForm(&$form) {

		if ($this->domain) {

			if ($_REQUEST['dcm_cst_id']) {
				$_REQUEST['cst_id'] = $_REQUEST['dcm_cst_id'];
			} elseif ($_REQUEST['cst_id']) {
				$_REQUEST['dcm_cst_id'] = $_REQUEST['cst_id'];
			}

			$form->bindField(new FloatTextBox('prepayment', '@REQUEST||0'), 'предоплата');

			$this->makeClientFilter($form, 'customers', "300px", null, $this->MSG['MakeOrderModule']['msg12'], "cst_id");
		}

	}

}
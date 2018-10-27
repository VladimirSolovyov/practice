<?
require_once(__spellPATH("LIB:/projects/autoresource/autoshop/module.order_admin.php"));

class Local_AdminMakeOrderModule extends MakeOrderModule {

	function order_check(&$buffer) {

		global $__AR2;

		$dcm_act = $this->Interface->getObjectInfo("
				SELECT dcm_id, dcm_summ
				FROM $__AR2[autoresource_db].documents
				WHERE dcm_id = '" . (int)$_POST['ord_dcm_id'] . "'
				AND dcm_registered = 0
				LIMIT 1
			");

		if (!$_REQUEST['chPos']) {
			$summ = (float)$dcm_act['dcm_summ'];
		} else {

			$add_summ = $this->Interface->getObjectInfo("
					SELECT SUM(pst_price * pst_amount) as summ
					FROM $__AR2[autoresourse_db].positions
					WHERE pst_id IN (" . $_REQUEST['chPos'] . ")
				");

			$summ = (float)$add_summ['summ'];
		}

		if ((float)$summ < (float)$_REQUEST['prepayment']) {

			$buffer['error'] = '<div class="error">' . tr('Сумма предоплаты не может быть больше суммы заказа', 'MakeOrderModule') . '</div>';

			return false;

		}

		return parent::order_check($buffer);

	}

	/**
	 * обработка успешного выполнения заказа под клиента
	 *
	 * @param $buffer
	 */
	function onsuccess(&$buffer) {

		parent::onsuccess($buffer);
		global $addInfo;
		$cstId = (int)$_POST['__cst_id__'] ? (int)$_POST['__cst_id__'] : (int)$_REQUEST['dcm_cst_id'];
		if ($cstId)
			Loader::getApi('prepayment_positions')->prepaymentOrder((float)$_REQUEST['prepayment'], $cstId, (int)$_POST['ord_id'], (int)$_POST['ord_dlv_id'], (int)$addInfo['add_id']);

	}
}

<?php

/**
 * Dinamic Catalog 3 Client
 *
 *
 **/
 
require_once(__spellPATH("LIB:/content/d_catalog31_client/d_catalog3_client.php"));


class d_catalog31_client_acc extends d_catalog31_client {
	function where() {
		$result = parent::where();
		$result .= " AND (`dat_field0` != '' OR `dat_field1` != '')";
		return $result;
	}
}

$dc3 = new d_catalog31_client_acc(__FILE__);

$dc3->render();
<?php
$__BUFFER->addStyle('/_syscss/dc.min.css');

require_once(__spellPATH("/dc3c_td/td_d_catalog3_client.php"));
	$dc3 = new td_d_catalog3_client(__FILE__);
if ($_SYSTEM->PAGES[2] == 'tdauto') {
	require("car_params.php");
} else {
	$dc3->render();
}


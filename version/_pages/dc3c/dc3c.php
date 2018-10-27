<?php
/**
 * Dinamic Catalog 3 Client
 * 
 *
 **/

require_once(__spellPATH("LIB:/content/d_catalog31_client/d_catalog3_client.php"));

$dc3 = new d_catalog31_client(__FILE__);

if (in_array($dc3->cat_id,array('18','19'))) {
	header('Location: /tyres_discs_search/');
}

$dc3->render();
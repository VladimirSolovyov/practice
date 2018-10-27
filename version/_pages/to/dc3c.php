<?php

/**
	* Dinamic Catalog 3 Client
	* 
	*
	**/


require_once(__spellPATH("LIB:/content/d_catalog31_client/d_catalog3_client.php")); 

$dc3 = new d_catalog31_client(__FILE__);

$dc3->render();
<?
	$__AR2['use_quick_order'] = true;
	$__AR2['use_admin_order'] = true;


	echo AutoResource_CallModule(
		"Local_AdminMakeOrderModule",
		"module.order_admin.php",
		"DR_PHP",
		NULL,
		'USER_LIB:/autovision/admin/',
		"MakeOrderModule_admin"
	);

?>
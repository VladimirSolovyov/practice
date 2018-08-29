<?



$CONST['DOCTYPE_OFF'] = false;

$CONST['DOCTYPE'] = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';



header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

header("Expires: -1");



// HTTP/1.1



header("Cache-Control: max-age=1, s-maxage=1, no-cache, must-revalidate");

session_cache_limiter("nocache");

header("ETag: PUB" . time());



// HTTP/1.0

header("Pragma: no-cache");



require_once(__spellPATH("LIB:/projects/autoresource/admin/eshop/module.init.php"));



$margin = 0;

if (isset($_REQUEST['asDirectory'])) $margin = 10;



$__BUFFER->AddContent('CUSTOM_HEADER', '<meta http-equiv="X-UA-Compatible" content="IE=edge">');



?>



<body leftmargin="<?= $margin ?>" topmargin="<?= $margin ?>" marginheight="<?= $margin ?>" marginwidth="<?= $margin ?>">

<div class="main-admin">
	<div class="main-admin__content">
		<?

		setUserVariable(

			'contragent_cst_id',

			$_interface->contractorInfo['cst_id'],

			$_interface->stockManagerInfo['stc_mode'] == 'DEALER'

		);

		$_interface->getContractorInfoFull();



		require_once(__spellPATH($_SYSTEM->LOADPAGE));



		if ($CMS_API->flDeprecated) {

			echo '<div class="error">' . tr('Функционал, используемый в данном разделе устарел и подлежит обновлению. Для обновления, пожалуйста, обратитесь в нашу службу поддержки.', 'Common') . '</div>';

		}

		?></div>
		<?



	$searchFormOutput = $_SERVER['REQUEST_URI'] != "/admin/eshop/utils/search.html" && empty($_REQUEST['asDirectory']) && !isset($_REQUEST['system_print_mode']) && !$__AR2['hide_search_panel'] && !isset($_REQUEST['hide_search_panel']) && $_SYSTEM->META_DATA['hide_search_panel'] != 'true';



	if ($searchFormOutput) { ?>



		<div class="admin-footer main-admin__footer">

			<div class="admin-footer__form">

				<?

				unset($_REQUEST['pst_ord_id']);

				require_once(__spellPATH("LIB:/projects/autoresource/admin/eshop/search_form.php"));

				?>

			</div>

			<div class="admin-footer__infopanel">

				<?= CallModule('tsinfopanel') ?>

			</div>

		</div>



	<? } ?>



	<? if ($_REQUEST['asDirectory'] != "") { ?>

		<script language="JavaScript">

			<!--



			shrinkWindow(30, 30);



			//-->

		</script>

	<? } ?>



	<? setAjaxTranslate(); ?>

</div>

</body>
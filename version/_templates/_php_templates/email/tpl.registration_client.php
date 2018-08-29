<? if ($customerName) { ?>
	<h3><?= tr('Здравствуйте') ?>, <?= $customerName ?>!</h3>
<? } ?>

<?
$_SERVER['SERVER_NAME'] = punycodeDecode($_SERVER['SERVER_NAME']);
if (!$stockInfo) {
	$stockInfo = Loader::getApi('stockmanager')->getStockInfoByStm($_POST['cst_stm_id']);
}
?>

<p><?= $msgBuffer['RegistrationModule']['msg39'] ?> <a href="<?= $httpProtocol . '://' . $_SERVER['SERVER_NAME'] ?>"><?= $_SERVER['SERVER_NAME'] ?></a>.</p>

<? if ($activation_code != '') { ?>
	<? include(__spellPATH('PHP_TEMPLATES_LIB:/email/tpl.activation_client.php')); ?>
<? } ?>

<? include(__spellPATH('PHP_TEMPLATES_LIB:/email/tpl.registration_form.php')); ?>


<?
$data['stc_name'] = [
		'caption' => $msgBuffer['RegistrationModule']['msg41'],
		'value' => tr($stockInfo['stc_name'], 'stocks')
	];

if($stockInfo['stc_address']){
	$data['stc_address'] = [
		'caption' => $msgBuffer['RegistrationModule']['msg48'],
		'value' => tr($stockInfo['stc_address'], 'stocks')
	];
}

if($stockInfo['fullname']){
	$data['fullname'] = [
		'caption' => $msgBuffer['RegistrationModule']['msg49'],
		'value' => tr($stockInfo['fullname'], '_users')
	];
}

if($stockInfo['stc_phone']){
	$data['stc_phone'] = [
		'caption' => $msgBuffer['RegistrationModule']['msg50'],
		'value' => $stockInfo['stc_phone']
	];
}

if($stockInfo['email']){
	$data['stc_phone'] = [
		'caption' => tr('E-mail'),
		'value' => $stockInfo['email']
	];
}

if($stockInfo['icq']){
	$data['icq'] = [
		'caption' => tr('ICQ'),
		'value' => $stockInfo['icq']
	];
}

$formTableConfig = [
	'head' => $msgBuffer['RegistrationModule']['msg40'],
	'rows' => array_keys($data),
	'formData' => $data
];

include(PHP_DataRender::includeTemplatePath('/email/tpl.form_table.php'));

?>

<p><?= $msgBuffer['RegistrationModule']['msg42'] ?></p>

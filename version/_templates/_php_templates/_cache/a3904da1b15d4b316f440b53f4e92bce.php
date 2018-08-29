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
	<?  ?><?
$_SERVER['SERVER_NAME'] = punycodeDecode($_SERVER['SERVER_NAME']);
?>

<h4><?= $msgBuffer['ActivationModule']['msg7'] ?></h4>
<p><?= $msgBuffer['ActivationModule']['msg8'] ?>
	<a href="<?= $httpProtocol ?>://<?= $_SERVER['SERVER_NAME'] ?>/activation.html?code=<?=$activation_code?>" target="_blank"><?= $httpProtocol ?>://<?= $_SERVER['SERVER_NAME'] ?>/activation.html?code=<?=$activation_code?></a>
</p>
<p><?= trp('Вы также можете зайти на %sстраницу подтверждения%s и ввести код активации вручную. Ваш код: %s', 'ActivationModule', '<a href="' . $httpProtocol . '://' . $_SERVER['SERVER_NAME'] . '/activation.html" target="_blank">', '</a>', $activation_code); ?></p><?  ?>
<? } ?>

<?  ?><?
	$formTableConfig = [
		'head' => $regTableHeader,
		'rows' => [
			'userlogin',
			'userpassword',
			'company',
			'contact_first_name',
			'contact_surname',
			'contact_patronymic_name',
			'cst_city_name',
			'fax',
			'contact_phone',
			'mobile_phone',
			'cst_email',
			'cst_icq',
			'cst_csa_id',
			'stc_id',
			'ord_address'
		],
		'formData' => $registration
	];

	if(!$Interface->csStrictRegistration && $registration['userlogin']['value']) {

		$formTableConfig['columns'][] = 'userlogin';
		$formTableConfig['columns'][] = 'userpassword';

	} else {
		?><p><strong><?= $msgBuffer['RegistrationModule']['msg108'] ?></strong></p><?
	}

	 ?><?
	if(isset($formTableConfig)){
		?><table class="styled" style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%"><?
		if(isset($formTableConfig['head'])){
			?>
			<tr style="padding:0;text-align:left;vertical-align:top">
				<th colspan="2" style="Margin:0;background-color:#f3f3f3;border-bottom:1px solid #dcdcdc;color:#000;font-family:Arial,sans-serif;font-size:15px;font-weight:700;line-height:1.3;margin:0;padding:10px;text-align:left">
					<?=$formTableConfig['head']?>
				</th>
			</tr>
			<?
		}
		if(isset($formTableConfig['rows']) && isset($formTableConfig['formData'])){
			foreach ($formTableConfig['rows'] as $field) {
				if(isset($formTableConfig['formData'][$field]) && $formTableConfig['formData'][$field]['value']) {
					?>
					<tr style="padding:0;text-align:left;vertical-align:top">
						<td class="dt" style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-bottom:1px solid #dcdcdc;border-collapse:collapse!important;color:#999;font-family:Arial,sans-serif;font-size:15px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:10px;text-align:left;vertical-align:top;word-wrap:break-word">
							<?=$formTableConfig['formData'][$field]['caption']?>
						</td>
						<td style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-bottom:1px solid #dcdcdc;border-collapse:collapse!important;color:#000;font-family:Arial,sans-serif;font-size:15px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:10px;text-align:left;vertical-align:top;word-wrap:break-word">
							<?=$formTableConfig['formData'][$field]['value']?>
						</td>
					</tr>
					<?
				}
			}
		}
		?></table><?
	}
	$formTableConfig = [];
?><? 

?><?  ?>


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

 ?><?
	if(isset($formTableConfig)){
		?><table class="styled" style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%"><?
		if(isset($formTableConfig['head'])){
			?>
			<tr style="padding:0;text-align:left;vertical-align:top">
				<th colspan="2" style="Margin:0;background-color:#f3f3f3;border-bottom:1px solid #dcdcdc;color:#000;font-family:Arial,sans-serif;font-size:15px;font-weight:700;line-height:1.3;margin:0;padding:10px;text-align:left">
					<?=$formTableConfig['head']?>
				</th>
			</tr>
			<?
		}
		if(isset($formTableConfig['rows']) && isset($formTableConfig['formData'])){
			foreach ($formTableConfig['rows'] as $field) {
				if(isset($formTableConfig['formData'][$field]) && $formTableConfig['formData'][$field]['value']) {
					?>
					<tr style="padding:0;text-align:left;vertical-align:top">
						<td class="dt" style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-bottom:1px solid #dcdcdc;border-collapse:collapse!important;color:#999;font-family:Arial,sans-serif;font-size:15px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:10px;text-align:left;vertical-align:top;word-wrap:break-word">
							<?=$formTableConfig['formData'][$field]['caption']?>
						</td>
						<td style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-bottom:1px solid #dcdcdc;border-collapse:collapse!important;color:#000;font-family:Arial,sans-serif;font-size:15px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:10px;text-align:left;vertical-align:top;word-wrap:break-word">
							<?=$formTableConfig['formData'][$field]['value']?>
						</td>
					</tr>
					<?
				}
			}
		}
		?></table><?
	}
	$formTableConfig = [];
?><? 

?>

<p><?= $msgBuffer['RegistrationModule']['msg42'] ?></p>

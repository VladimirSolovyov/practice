<h3><?= $Interface->MSG['RegistrationModule']['msg43'] ?></h3>

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